<?php

namespace App\Http\Controllers\Admin\Inventory;

use App\Http\Controllers\Controller;
use App\Models\ItemTransaction;
use App\Models\Product;
use App\Models\Purchase;
use App\Models\Supplier;
use App\Models\TaxRate;
use App\Models\Unit;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class PurchaseController extends Controller
{
    public $data=[];

    public function index(Request $request)
    {
        if ($request->ajax()) {

            if(auth()->user()->role->name == 'admin' || auth()->user()->role->name == 'manager'){
                $purchases = Purchase::with('supplier','creator')->latest();
            }else{
                $purchases = Purchase::where('created_by',auth()->user()->id)->with('supplier','creator')->latest();
            }

            return DataTables::of($purchases)
                    ->addIndexColumn()
                    ->setRowId(function ($purchase) {
                        return 'row'.$purchase->id;
                    })
                    ->addColumn('Supplier Name', function ($purchase) {
                        return $purchase->supplier->name;
                    })
                    ->addColumn('Invoice Number', function ($purchase) {
                        return $purchase->invoice_number;
                    })

                    ->addColumn('Invoice Date', function ($purchase) {
                        return $purchase->invoice_date;
                    })
                    ->addColumn('Payment Mode', function ($purchase) {
                        return ucfirst($purchase->payment_mode);
                    })
                    ->addColumn('Sub Total', function ($purchase) {
                        return $purchase->amount;
                    })
                    ->addColumn('Tax Amount', function ($purchase) {
                        return $purchase->tax_amount;
                    })
                    ->addColumn('Shipping Charge', function ($purchase) {
                        return $purchase->shipping_charge;
                    })
                    ->addColumn('Invoice Amount', function ($purchase) {
                        return $purchase->invoice_amount;
                    })

                    ->addColumn('Added By', function ($purchase) {
                        return $purchase->creator ? $purchase->creator->name : '';
                    })
                    ->addColumn('Created Date', function ($purchase) {
                        return $purchase->created_at->format('d-m-Y');
                    })
                    ->addColumn('Status', function ($purchase) {
                        $status='';
                        if($purchase->is_active ==1){
                            $status ='Active';
                        }else{
                            $status= 'Deactive';
                        }
                        return $status;
                    })

                    ->addColumn('action', function($purchase){
                        if($purchase->is_draft ==1){
                            $class = 'disabled';
                        }else{
                            $class = '';
                        }

                        $model="'purchase'";
                        return '<div class="dropdown">
                                <button class="btn btn-danger btn-sm dropdown-toggle" type="button" id="dropdownMenuSizeButton3" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuSizeButton3">
                                <a class="dropdown-item" href="'.url('inventory/purchases/items-show/'.$purchase->id).'">View Items</a>
                                <a class="dropdown-item '.$class.'" href="'.url('inventory/purchases/draft-items/'.$purchase->id).'">Add items</a>

                                <a class="dropdown-item" onClick="deleteConfirmation('.$purchase->id.','.$model.')" href="#">Delete</a>
                                </div>
                            </div>';

                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        return view('admin.pages.inventory.purchase.list');
    }

    public function create()
    {
        $this->data['products'] = Product::all();
        $this->data['suppliers'] = Supplier::all();
        $this->data['units'] = Unit::all();
        $this->data['taxrates'] = TaxRate::all();
        return view('admin.pages.inventory.purchase.add',['data' => $this->data]);
    }

    public function save(Request $request)
    {
        $request->validate([
            'supplier_id' => 'required|string',
            'invoice_number' =>'required|unique:purchases,invoice_number',
            'invoice_date' => 'required',
        ]);
        if(!$request->has('product_items')){
            return redirect()->back()->with(['warning'=>'products missing.']);
        }
        $data = $request->except(['input_product_id','input_quantity','input_unit_id','input_taxrate_id','input_unit_price','input_total_price','product_items']);
        $data['created_by'] = auth()->user()->id;
        $data['is_draft'] = $request->is_draft == 'on' ? 1 : 0;

        $purchase = recordSave(purchase::class,$data,null,null);
        if($purchase){
            foreach($request->product_items as $item){
                $tranSectItem = new ItemTransaction();

                $tranSectItem->product_id = $item['product_id'];
                $tranSectItem->quantity = $item['quantity'];
                $tranSectItem->unit_id = $item['unit_id'];
                $tranSectItem->tax_rate_id  = $item['tax_rate_id'];
                $tranSectItem->unit_amount = $item['unit_amount'];
                $tranSectItem->total_amount = $item['total_amount'];

                $taxrate = TaxRate::where('id',$item['tax_rate_id'])->pluck('sku')->first();

                $tax_amount = ((float) $taxrate * (float) $item['total_amount'])/100;
                $tranSectItem->tax_amount = $tax_amount;
                $tranSectItem->net_amount = (float) $item['total_amount'] + $tax_amount;
                $tranSectItem->created_by = auth()->user()->id;

                $tranSectItem->type = 'purchase';

                $purchase->transectionItem()->save($tranSectItem);
                //Reflect Stock table
                $data = [
                    'productId' => $item['product_id'],
                    'quantity' => $item['quantity'],
                    'unitId' => $item['unit_id'],
                ];
                $this->updateStockItems($data,'purchase');

            }
        }


        return redirect()->back()->with(['success'=>'purchase has been added successfully.']);
    }

    public function edit($id)
    {

        $this->data['tax_rate'] = TaxRate::all();
        $this->data['purchase'] = purchase::find($id);
        return view('admin.pages.inventory.purchase.edit',['data' => $this->data]);
    }

    // public function update(Request $request)
    // {
    //     $request->validate([
    //         'name' => 'required|string',
    //         'purchase_category_id' =>'required',
    //         'tax_rate_id' => 'required',
    //         'hsn_code' =>'required',
    //     ]);

    //     $data = $request->except(['avatar']);

    //     $purchase = recordSave(purchase::class,$data,null,null);
    //     if($request->avatar !=null){
    //         $image = fileUpload($request->avatar,$purchase,'local');
    //         $image['document_type']='avatar';
    //         $purchase->image()->create($image);
    //     }

    //     return redirect()->back()->with(['success'=>'purchase Has been updated successfully.']);
    // }

    public function changeStatus($id)
    {
        $purchase = purchase::find($id);
        $value = !$purchase->is_active;
        $purchase->update([
            'is_active' => (int) $value,
        ]);

        return redirect()->back()->with(['success'=>'purchase status change successfully.']);
    }

    public function delete($id)
    {
        $purchase = Purchase::find($id);
        $items = $purchase->transectionItem()->get();
        if(count($items) > 0){
            // return redirect()->back()->with(['success'=>'purchase status change successfully.']);
            return bad("",'Cannot deleted !!!');
        }
        $purchase->delete();
    }


    //draft items view
    public function draftItems($id)
    {
        $this->data['products'] = Product::all();
        $this->data['suppliers'] = Supplier::all();
        $this->data['units'] = Unit::all();
        $this->data['taxrates'] = TaxRate::all();
        $this->data['purchase'] = Purchase::with('transectionItem')->findOrfail($id);

        return view('admin.pages.inventory.purchase.draft-item-add',['data' => $this->data]);
    }
}

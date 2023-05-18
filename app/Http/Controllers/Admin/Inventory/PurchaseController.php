<?php

namespace App\Http\Controllers\Admin\Inventory;

use App\Http\Controllers\Controller;
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

            if(auth()->user()->role->name == 'admin'){
                $purchases = Purchase::with('supplier','creator')->latest();
            }else{
                $purchases = Purchase::where('id',auth()->user()->id)->with('supplier','creator')->latest();
            }

            return DataTables::of($purchases)
                    ->addIndexColumn()
                    ->setRowId(function ($purchase) {
                        return 'row'.$purchase->id;
                    })
                    ->addColumn('purchase Category', function ($purchase) {
                        return $purchase->category->name;
                    })
                    ->addColumn('purchase Name', function ($purchase) {
                        return $purchase->name_desc;
                    })

                    ->addColumn('Brand', function ($purchase) {
                        return $purchase->brand !=null ? $purchase->brand->name : '';
                    })
                    ->addColumn('Model No', function ($purchase) {
                        return $purchase->model_no;
                    })
                    ->addColumn('Serial No', function ($purchase) {
                        return $purchase->serial_number;
                    })
                    ->addColumn('Tax Rate', function ($purchase) {
                        return $purchase->tax_rate->sku ;
                    })
                    ->addColumn('Hsn Code', function ($purchase) {
                        return $purchase->hsn_code;
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
                        if($purchase->is_active ==1){
                            $status = 'Deactivate';
                        }else{
                            $status = 'Activate';
                        }
                        return '<div class="dropdown">
                                <button class="btn btn-danger btn-sm dropdown-toggle" type="button" id="dropdownMenuSizeButton3" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuSizeButton3">
                                <a class="dropdown-item" href="'.url('inventory/purchases/edit/'.$purchase->id).'">Edit</a>
                                <a class="dropdown-item" href="'.url('inventory/purchases/change-status/'.$purchase->id).'">'.$status.'</a>

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
        return view('admin.pages.inventory.purchase.add',['data' => $this->data]);
    }

    public function save(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'purchase_category_id' =>'required',
            'tax_rate_id' => 'required',
            'hsn_code' =>'required',
        ]);

        $data = $request->except(['avatar']);
        $data['created_by'] = auth()->user()->id;
        $data['name_desc'] = $request->name. ' '. $request->size.' '. $request->color;

        $purchase = recordSave(purchase::class,$data,null,null);
        if($request->avatar !=null){
            $image = fileUpload($request->avatar,$purchase,'local');
            $image['document_type']='avatar';
            $purchase->image()->create($image);
        }

        return redirect()->back()->with(['success'=>'purchase has been added successfully.']);
    }

    public function edit($id)
    {
        $this->data['category'] = purchaseCategory::all();
        $this->data['brand'] = Brand::all();
        $this->data['tax_rate'] = TaxRate::all();
        $this->data['purchase'] = purchase::find($id);
        return view('admin.pages.inventory.purchase.edit',['data' => $this->data]);
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'purchase_category_id' =>'required',
            'tax_rate_id' => 'required',
            'hsn_code' =>'required',
        ]);

        $data = $request->except(['avatar']);

        $purchase = recordSave(purchase::class,$data,null,null);
        if($request->avatar !=null){
            $image = fileUpload($request->avatar,$purchase,'local');
            $image['document_type']='avatar';
            $purchase->image()->create($image);
        }

        return redirect()->back()->with(['success'=>'purchase Has been updated successfully.']);
    }

    public function changeStatus($id)
    {
        $purchase = purchase::find($id);
        $value = !$purchase->is_active;
        $purchase->update([
            'is_active' => (int) $value,
        ]);

        return redirect()->back()->with(['success'=>'purchase status change successfully.']);
    }
}

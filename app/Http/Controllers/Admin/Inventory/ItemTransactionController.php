<?php

namespace App\Http\Controllers\Admin\Inventory;

use App\Http\Controllers\Controller;
use App\Models\ItemTransaction;
use App\Models\Productitem;
use App\Models\Purchase;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ItemTransactionController extends Controller
{
       /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function index(Request $request)
    // {



    //     $lists = ItemTransaction::where('is_active',1)->get();
    //     if ($request->ajax()) {
    //         $categories = ItemTransaction::limit(10)->latest();

    //         return DataTables::of($categories)
    //         ->addIndexColumn()
    //         ->setRowId(function ($item) {
    //             return 'row'.$item->id;
    //         })
    //         ->addColumn('item Name', function ($item) {
    //             return $item->name;
    //         })
    //         ->addColumn('Sub item Name', function ($item) {
    //             return $item->parrent !=null ? $item->parrent->name :'';
    //         })
    //         ->addColumn('Status', function ($item) {
    //             $status='';
    //             if($item->is_active ==1){
    //                 $status ='Active';
    //             }else{
    //                 $status= 'Deactive';
    //             }
    //             return $status;
    //         })

    //         ->addColumn('action', function($item){
    //             if($item->is_active ==1){
    //                 $status = 'Deactivate';
    //             }else{
    //                 $status = 'Activate';
    //             }
    //             return '<div class="dropdown">
    //                     <button class="btn btn-danger btn-sm dropdown-toggle" type="button" id="dropdownMenuSizeButton3" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    //                     </button>
    //                     <div class="dropdown-menu" aria-labelledby="dropdownMenuSizeButton3">
    //                     <a class="dropdown-item" onClick="editModel('.$item->id.')" href="#">Edit</a>
    //                     <a class="dropdown-item" href="'.url('item/change-status/'.$item->id).'">'.$status.'</a>

    //                     </div>
    //                 </div>';

    //         })
    //         ->rawColumns(['action'])
    //         ->make(true);
    //     }
    //     return view('admin.pages.inventory.product-item',['item' => $lists]);

    // }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, Request $request)
    {


        if ($request->ajax()) {
            $purchase =  Purchase::find($id);

            $items = $purchase->transectionItem()->get();

            return DataTables::of($items)
            ->addIndexColumn()
            ->setRowId(function ($item) {

                return 'row'.$item->id;
            })
            ->addColumn('Product Name', function ($item) {
                return $item->product !=null ? $item->product->name :'';
            })
            ->addColumn('Type', function ($item) {
                return $item->type;
            })
            ->addColumn('Quantity', function ($item) {
                return $item->quantity;
            })
            ->addColumn('Unit', function ($item) {
                return $item->unit !=null ? $item->unit->name :'';
            })
            ->addColumn('Tax Rate', function ($item) {
                return $item->tax_rate !=null ? $item->tax_rate->name :'';
            })
            ->addColumn('Unit Amount', function ($item) {
                return $item->unit_amount;
            })
            ->addColumn('Total Amount', function ($item) {
                return $item->total_amount;
            })
            ->addColumn('Tax Amount', function ($item) {
                return $item->tax_amount;
            })
            ->addColumn('Net Amount', function ($item) {
                return $item->net_amount;
            })
            ->addColumn('Status', function ($item) {
                $status='';
                if($item->is_active ==1){
                    $status ='Active';
                }else{
                    $status= 'Deactive';
                }
                return $status;
            })

            ->addColumn('action', function($item){

                $model="'item'";
                return '<div class="dropdown">
                        <button class="btn btn-danger btn-sm dropdown-toggle" type="button" id="dropdownMenuSizeButton3" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuSizeButton3">
                        <a class="dropdown-item disabled" onClick="editModel('.$item->id.')" href="#">Edit</a>
                        <a class="dropdown-item" onClick="deleteConfirmation('.$item->id.','.$model.')" href="#">Delete</a>

                        </div>
                    </div>';

            })
            ->rawColumns(['action'])
            ->make(true);
        }
        return view('admin.pages.inventory.purchase.item.list',['productId'=> $id]);
    }

    // public function update(Request $request)
    // {
    //     if($request->id !=null){
    //         $request->validate([
    //             'name' => 'required|unique:product_categories,name,'.$request->id.',id',
    //         ]);
    //     }else{
    //         $request->validate([
    //             'name' => 'required|unique:product_categories,name',
    //         ]);
    //     }


    //     recordSave(Productitem::class,$request->all(),null,null);
    //     if($request->id !=null){
    //         return redirect()->back()->with(['success'=>'Designation Has been updated successfully.']);
    //     }
    //     return redirect()->back()->with(['success'=>'Designation Has been created successfully.']);
    // }

    public function edit($id)
    {
        $item = ItemTransaction::find($id);
        return ok($item);
    }


    public function delete($id)
    {
        $item = ItemTransaction::find($id);

        $data = [
            'productId' => $item['product_id'],
            'quantity' => $item['quantity'],
            'unitId' => $item['unit_id'],
        ];
        $this->updateStockItems($data,'delete');

        $item->delete();

        return redirect()->back()->with(['success'=>'item deleted successfully.']);
    }
}

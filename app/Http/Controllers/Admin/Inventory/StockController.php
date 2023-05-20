<?php

namespace App\Http\Controllers\Admin\Inventory;

use App\Http\Controllers\Controller;
use App\Models\stockTransaction;
use App\Models\Productstock;
use App\Models\Purchase;
use App\Models\StockItem;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class StockController extends Controller
{
       /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        if ($request->ajax()) {
            $stocks = StockItem::all();

            return DataTables::of($stocks)
            ->addIndexColumn()
            ->setRowId(function ($stock) {
                return 'row'.$stock->id;
            })
            ->addColumn('Product Name', function ($stock) {
                return $stock->product !=null ? $stock->product->name :'';
            })
            ->addColumn('Quantity', function ($stock) {
                return $stock->quantity;
            })
            ->addColumn('Unit', function ($stock) {
                return $stock->unit !=null ? $stock->unit->name :'';
            })
            ->addColumn('Status', function ($stock) {
                $status='';
                if($stock->is_active ==1){
                    $status ='Active';
                }else{
                    $status= 'Deactive';
                }
                return $status;
            })

            // ->addColumn('action', function($stock){
            //     if($stock->is_active ==1){
            //         $status = 'Deactivate';
            //     }else{
            //         $status = 'Activate';
            //     }
            //     return '<div class="dropdown">
            //             <button class="btn btn-danger btn-sm dropdown-toggle" type="button" id="dropdownMenuSizeButton3" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            //             </button>
            //             <div class="dropdown-menu" aria-labelledby="dropdownMenuSizeButton3">
            //             <a class="dropdown-stock" onClick="editModel('.$stock->id.')" href="#">Edit</a>
            //             <a class="dropdown-stock" href="'.url('stock/change-status/'.$stock->id).'">'.$status.'</a>

            //             </div>
            //         </div>';

            // })
            // ->rawColumns(['action'])
            ->make(true);
        }
        return view('admin.pages.inventory.stock.list');

    }

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

            $stocks = $purchase->transectionstock()->get();

            return DataTables::of($stocks)
            ->addIndexColumn()
            ->setRowId(function ($stock) {

                return 'row'.$stock->id;
            })
            ->addColumn('Product Name', function ($stock) {
                return $stock->product !=null ? $stock->product->name :'';
            })
            ->addColumn('Type', function ($stock) {
                return $stock->type;
            })
            ->addColumn('Quantity', function ($stock) {
                return $stock->quantity;
            })
            ->addColumn('Unit', function ($stock) {
                return $stock->unit !=null ? $stock->unit->name :'';
            })
            ->addColumn('Tax Rate', function ($stock) {
                return $stock->tax_rate !=null ? $stock->tax_rate->name :'';
            })
            ->addColumn('Unit Amount', function ($stock) {
                return $stock->unit_amount;
            })
            ->addColumn('Total Amount', function ($stock) {
                return $stock->total_amount;
            })
            ->addColumn('Tax Amount', function ($stock) {
                return $stock->tax_amount;
            })
            ->addColumn('Net Amount', function ($stock) {
                return $stock->net_amount;
            })
            ->addColumn('Status', function ($stock) {
                $status='';
                if($stock->is_active ==1){
                    $status ='Active';
                }else{
                    $status= 'Deactive';
                }
                return $status;
            })

            ->addColumn('action', function($stock){

                $model="'stock'";
                return '<div class="dropdown">
                        <button class="btn btn-danger btn-sm dropdown-toggle" type="button" id="dropdownMenuSizeButton3" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuSizeButton3">
                        <a class="dropdown-stock disabled" onClick="editModel('.$stock->id.')" href="#">Edit</a>
                        <a class="dropdown-stock" onClick="deleteConfirmation('.$stock->id.','.$model.')" href="#">Delete</a>

                        </div>
                    </div>';

            })
            ->rawColumns(['action'])
            ->make(true);
        }
        return view('admin.pages.inventory.purchase.stock.list',['productId'=> $id]);
    }

    public function delete($id)
    {
        $stock = stockTransaction::find($id);

        $data = [
            'productId' => $stock['product_id'],
            'quantity' => $stock['quantity'],
            'unitId' => $stock['unit_id'],
        ];
        $this->updateStockstocks($data,'delete');

        $stock->delete();

        return redirect()->back()->with(['success'=>'stock deleted successfully.']);
    }
}

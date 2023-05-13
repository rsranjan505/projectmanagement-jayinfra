<?php

namespace App\Http\Controllers\Admin\Settings\Products;

use App\Http\Controllers\Controller;
use App\Models\TaxRate;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class TaxtRateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $taxrates = TaxRate::limit(10)->latest();

            return DataTables::of($taxrates)
            ->addIndexColumn()
            ->setRowId(function ($taxrate) {
                return 'row'.$taxrate->id;
            })

            ->addColumn('Name', function ($taxrate) {
                return $taxrate->name;
            })
            ->addColumn('Value', function ($taxrate) {
                return $taxrate->sku;
            })
            ->addColumn('Status', function ($taxrate) {
                $status='';
                if($taxrate->is_active ==1){
                    $status ='Active';
                }else{
                    $status= 'Deactive';
                }
                return $status;
            })

            ->addColumn('action', function($taxrate){
                if($taxrate->is_active ==1){
                    $status = 'Deactivate';
                }else{
                    $status = 'Activate';
                }
                return '<div class="dropdown">
                        <button class="btn btn-danger btn-sm dropdown-toggle" type="button" id="dropdownMenuSizeButton3" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuSizeButton3">
                        <a class="dropdown-item" onClick="editModel('.$taxrate->id.')" href="#">Edit</a>
                        <a class="dropdown-item" href="'.url('taxrates/change-status/'.$taxrate->id).'">'.$status.'</a>

                        </div>
                    </div>';

            })
            ->rawColumns(['action'])
            ->make(true);
        }
        return view('admin.pages.settings.products.taxrate');

    }

    public function save(Request $request)
    {
        if($request->id !=null){
            $request->validate([
                'name' => 'required|unique:tax_rates,name,'.$request->id.',id',
            ]);
        }else{
            $request->validate([
                'name' => 'required|unique:tax_rates,name',
            ]);
        }

        recordSave(TaxRate::class,$request->all(),null,null);
        if($request->id !=null){
            return redirect()->back()->with(['success'=>'Tax Rate Has been updated successfully.']);
        }
        return redirect()->back()->with(['success'=>'Tax Rate Has been created successfully.']);
    }

    public function edit($id)
    {
        $taxrate = TaxRate::find($id);
        return ok($taxrate);
    }

    public function changeStatus($id)
    {
        $taxrate = TaxRate::find($id);
        $value = !$taxrate->is_active;
        $taxrate->update([
            'is_active' => (int) $value,
        ]);

        return redirect()->back()->with(['success'=>'Tax Rate status change successfully.']);
    }
}

<?php

namespace App\Http\Controllers\Admin\Settings\Products;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class BrandController extends Controller
{
          /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $brands = Brand::limit(10)->latest();

            return DataTables::of($brands)
            ->addIndexColumn()
            ->setRowId(function ($brand) {
                return 'row'.$brand->id;
            })
            ->addColumn('Name', function ($brand) {
                return $brand->name;
            })

            ->addColumn('Status', function ($brand) {
                $status='';
                if($brand->is_active ==1){
                    $status ='Active';
                }else{
                    $status= 'Deactive';
                }
                return $status;
            })

            ->addColumn('action', function($brand){
                if($brand->is_active ==1){
                    $status = 'Deactivate';
                }else{
                    $status = 'Activate';
                }
                return '<div class="dropdown">
                        <button class="btn btn-danger btn-sm dropdown-toggle" type="button" id="dropdownMenuSizeButton3" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuSizeButton3">
                        <a class="dropdown-item" onClick="editModel('.$brand->id.')" href="#">Edit</a>
                        <a class="dropdown-item" href="'.url('settings/brands/change-status/'.$brand->id).'">'.$status.'</a>

                        </div>
                    </div>';

            })
            ->rawColumns(['action'])
            ->make(true);
        }
        return view('admin.pages.settings.products.brands');

    }

    public function save(Request $request)
    {
        if($request->id !=null){
            $request->validate([
                'name' => 'required|unique:brands,name,'.$request->id.',id',
            ]);
        }else{
            $request->validate([
                'name' => 'required|unique:brands,name',
            ]);
        }

        recordSave(Brand::class,$request->all(),null,null);
        if($request->id !=null){
            return redirect()->back()->with(['success'=>'Brand Has been updated successfully.']);
        }
        return redirect()->back()->with(['success'=>'Brand Has been created successfully.']);
    }

    public function edit($id)
    {
        $brand = Brand::find($id);
        return ok($brand);
    }

    public function changeStatus($id)
    {
        $brand = Brand::find($id);
        $value = !$brand->is_active;
        $brand->update([
            'is_active' => (int) $value,
        ]);

        return redirect()->back()->with(['success'=>'Brand status change successfully.']);
    }
}

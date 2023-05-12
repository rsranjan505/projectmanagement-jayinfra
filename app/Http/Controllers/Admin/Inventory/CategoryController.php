<?php

namespace App\Http\Controllers\Admin\Inventory;

use App\Http\Controllers\Controller;
use App\Models\ProductCategory;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class CategoryController extends Controller
{
       /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $lists = ProductCategory::where('is_active',1)->get();
        if ($request->ajax()) {
            $categories = ProductCategory::limit(10)->latest();

            return DataTables::of($categories)
            ->addIndexColumn()
            ->setRowId(function ($category) {
                return 'row'.$category->id;
            })
            ->addColumn('Category Name', function ($category) {
                return $category->name;
            })
            ->addColumn('Sub Category Name', function ($category) {
                return $category->parrent !=null ? $category->parrent->name :'';
            })
            ->addColumn('Status', function ($category) {
                $status='';
                if($category->is_active ==1){
                    $status ='Active';
                }else{
                    $status= 'Deactive';
                }
                return $status;
            })

            ->addColumn('action', function($category){
                if($category->is_active ==1){
                    $status = 'Deactivate';
                }else{
                    $status = 'Activate';
                }
                return '<div class="dropdown">
                        <button class="btn btn-danger btn-sm dropdown-toggle" type="button" id="dropdownMenuSizeButton3" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuSizeButton3">
                        <a class="dropdown-item" onClick="editModel('.$category->id.')" href="#">Edit</a>
                        <a class="dropdown-item" href="'.url('category/change-status/'.$category->id).'">'.$status.'</a>

                        </div>
                    </div>';

            })
            ->rawColumns(['action'])
            ->make(true);
        }
        return view('admin.pages.inventory.product-category',['category' => $lists]);

    }

    public function save(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:product_categories,name',
        ]);


        recordSave(ProductCategory::class,$request->all(),null,null);
        if($request->id !=null){
            return redirect()->back()->with(['success'=>'Designation Has been updated successfully.']);
        }
        return redirect()->back()->with(['success'=>'Designation Has been created successfully.']);
    }

    public function edit($id)
    {
        $category = ProductCategory::find($id);
        return ok($category);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $category =  ProductCategory::find($id);
        return ok($category);
    }

    public function changeStatus($id)
    {
        $category = ProductCategory::find($id);
        $value = !$category->is_active;
        $category->update([
            'is_active' => (int) $value,
        ]);

        return redirect()->back()->with(['success'=>'Category status change successfully.']);
    }
}

<?php

namespace App\Http\Controllers\Admin\Inventory;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\TaxRate;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class MaterialsController extends Controller
{
    public $data=[];

    public function index(Request $request)
    {
        if ($request->ajax()) {

            if(auth()->user()->role->name == 'admin' || auth()->user()->role->name == 'manager'){
                $products = Product::with('category','brand','tax_rate','creator')->limit(10)->latest();
            }else{
                $products = Product::where('created_by',auth()->user()->id)->with('category','brand','tax_rate','creator')->limit(10)->latest();
            }

            return DataTables::of($products)
                    ->addIndexColumn()
                    ->setRowId(function ($product) {
                        return 'row'.$product->id;
                    })
                    ->addColumn('Product Category', function ($product) {
                        return $product->category->name;
                    })
                    ->addColumn('Product Name', function ($product) {
                        return $product->name_desc;
                    })

                    ->addColumn('Brand', function ($product) {
                        return $product->brand !=null ? $product->brand->name : '';
                    })
                    ->addColumn('Model No', function ($product) {
                        return $product->model_no;
                    })
                    ->addColumn('Serial No', function ($product) {
                        return $product->serial_number;
                    })
                    ->addColumn('Tax Rate', function ($product) {
                        return $product->tax_rate->sku ;
                    })
                    ->addColumn('Hsn Code', function ($product) {
                        return $product->hsn_code;
                    })
                    ->addColumn('Added By', function ($product) {
                        return $product->creator ? $product->creator->name : '';
                    })
                    ->addColumn('Created Date', function ($product) {
                        return $product->created_at->format('d-m-Y');
                    })
                    ->addColumn('Status', function ($product) {
                        $status='';
                        if($product->is_active ==1){
                            $status ='Active';
                        }else{
                            $status= 'Deactive';
                        }
                        return $status;
                    })

                    ->addColumn('action', function($product){
                        if($product->is_active ==1){
                            $status = 'Deactivate';
                        }else{
                            $status = 'Activate';
                        }
                        return '<div class="dropdown">
                                <button class="btn btn-danger btn-sm dropdown-toggle" type="button" id="dropdownMenuSizeButton3" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuSizeButton3">
                                <a class="dropdown-item" href="'.url('inventory/products/edit/'.$product->id).'">Edit</a>
                                <a class="dropdown-item" href="'.url('inventory/products/change-status/'.$product->id).'">'.$status.'</a>

                                </div>
                            </div>';

                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        return view('admin.pages.inventory.product.list');
    }

    public function create()
    {
        $this->data['category'] = ProductCategory::all();
        $this->data['brand'] = Brand::all();
        $this->data['tax_rate'] = TaxRate::all();
        return view('admin.pages.inventory.product.add',['data' => $this->data]);
    }

    public function save(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'product_category_id' =>'required',
            'tax_rate_id' => 'required',
            'hsn_code' =>'required',
        ]);

        $data = $request->except(['avatar']);
        $data['created_by'] = auth()->user()->id;
        $data['name_desc'] = $request->name. ' '. $request->size.' '. $request->color;

        $product = recordSave(Product::class,$data,null,null);
        if($request->avatar !=null){
            $image = fileUpload($request->avatar,$product,'local');
            $image['document_type']='avatar';
            $product->image()->create($image);
        }

        return redirect()->back()->with(['success'=>'Product has been added successfully.']);
    }

    public function edit($id)
    {
        $this->data['category'] = ProductCategory::all();
        $this->data['brand'] = Brand::all();
        $this->data['tax_rate'] = TaxRate::all();
        $this->data['product'] = Product::find($id);
        return view('admin.pages.inventory.product.edit',['data' => $this->data]);
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'product_category_id' =>'required',
            'tax_rate_id' => 'required',
            'hsn_code' =>'required',
        ]);

        $data = $request->except(['avatar']);

        $product = recordSave(Product::class,$data,null,null);
        if($request->avatar !=null){
            $image = fileUpload($request->avatar,$product,'local');
            $image['document_type']='avatar';
            $product->image()->create($image);
        }

        return redirect()->back()->with(['success'=>'Product Has been updated successfully.']);
    }

    public function changeStatus($id)
    {
        $product = Product::find($id);
        $value = !$product->is_active;
        $product->update([
            'is_active' => (int) $value,
        ]);

        return redirect()->back()->with(['success'=>'Product status change successfully.']);
    }
}

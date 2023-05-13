<?php

namespace App\Http\Controllers\Admin\Inventory;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Gst;
use App\Models\State;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class SupplierController extends Controller
{
    public $data=[];

    public function index(Request $request)
    {
        if ($request->ajax()) {

            if(auth()->user()->role->name == 'admin'){
                $suppliers = Supplier::with('state','city','gst','creator')->limit(10)->latest();
            }else{
                $suppliers = Supplier::where('id',auth()->user()->id)->with('state','city','gst','creator')->limit(10)->latest();
            }

            return DataTables::of($suppliers)
                    ->addIndexColumn()
                    ->setRowId(function ($supplier) {
                        return 'row'.$supplier->id;
                    })
                    ->addColumn('Contact Name', function ($supplier) {
                        return $supplier->name;
                    })
                    ->addColumn('Business Name', function ($supplier) {
                        return $supplier->business_name;
                    })

                    ->addColumn('Registration Number', function ($supplier) {
                        return $supplier->registration_number;
                    })
                    ->addColumn('Pan', function ($supplier) {
                        return $supplier->pan;
                    })
                    ->addColumn('Email', function ($supplier) {
                        return $supplier->email;
                    })
                    ->addColumn('Mobile', function ($supplier) {
                        return $supplier->mobile;
                    })
                    ->addColumn('Address', function ($supplier) {
                        return $supplier->address;
                    })
                    ->addColumn('City', function ($supplier) {
                        return $supplier->city ? $supplier->city->name : '';
                    })
                    ->addColumn('State', function ($supplier) {
                        return $supplier->state ? $supplier->state->name : '';
                    })
                    ->addColumn('Postcode', function ($supplier) {
                        return $supplier->postcode;
                    })
                    ->addColumn('Added By', function ($supplier) {
                        return $supplier->creator ? $supplier->creator->name : '';
                    })
                    ->addColumn('Created Date', function ($supplier) {
                        return $supplier->created_at->format('d-m-Y');
                    })
                    ->addColumn('Status', function ($supplier) {
                        $status='';
                        if($supplier->is_active ==1){
                            $status ='Active';
                        }else{
                            $status= 'Deactive';
                        }
                        return $status;
                    })

                    ->addColumn('action', function($supplier){
                        if($supplier->is_active ==1){
                            $status = 'Deactivate';
                        }else{
                            $status = 'Activate';
                        }
                        return '<div class="dropdown">
                                <button class="btn btn-danger btn-sm dropdown-toggle" type="button" id="dropdownMenuSizeButton3" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuSizeButton3">
                                <a class="dropdown-item" href="'.url('inventory/suppliers/edit/'.$supplier->id).'">Edit</a>
                                <a class="dropdown-item" href="'.url('inventory/suppliers/change-status/'.$supplier->id).'">'.$status.'</a>

                                </div>
                            </div>';

                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        return view('admin.pages.inventory.supplier.list');
    }

    public function create()
    {
        $this->data['state'] = State::all();
        $this->data['city'] = City::all();
        return view('admin.pages.inventory.supplier.add',['data' => $this->data]);
    }

    public function save(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'business_name' => 'required|string',
            'registration_number' => 'required|unique:organisations,registration_number',
            'pan' => 'required|string',
            'email' => 'required',
            'mobile' =>'required',
            'address' => 'required',
            'gstin' => 'required',
            'state_id' =>'required',
            'city_id' =>'required',
            'postcode' =>'required',
        ]);
        $data = $request->except(['gstin']);
        $data['created_by'] = auth()->user()->id;
        $data['country_id'] = 101;

        $supplier = recordSave(Supplier::class,$data,null,null);
        if($request->gstin !=null){
            $gstdata['gstin'] = $request->gstin;
            $gstdata['address'] = $request->address;
            $gstdata['state_id'] = $request->state_id;
            $gstdata['city_id'] = $request->city_id;
            $gstdata['country_id'] = 101;
            $gstdata['is_primary'] = 1;
            $supplier->gst()->create($gstdata);
        }

        return redirect()->back()->with(['success'=>'supplier has been added successfully.']);
    }

    public function edit($id)
    {
        $this->data['state'] = State::all();
        $this->data['city'] = City::all();
        $this->data['supplier'] = Supplier::where('id',$id)->with('state','city','gst','creator')->get()->first();
        return view('admin.pages.inventory.supplier.edit',['data' => $this->data]);
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'business_name' => 'required|string',
            'pan' => 'required|string',
            'email' => 'required',
            'mobile' =>'required',
            'address' => 'required',
            'gstin' => 'required',
            'state_id' =>'required',
            'city_id' =>'required',
            'postcode' =>'required',
        ]);
        $data = $request->except(['gstin']);
        $supplier = recordSave(supplier::class,$data,null,null);
        if($request->gstin !=null){
            $gst = Gst::where(['model_id'=>$supplier->id,'model_type' => Supplier::class])->get()->first();
            $gstdata['gstin'] = $request->gstin;

            $supplier->gst()->update($gstdata);
        }

        return redirect()->back()->with(['success'=>'supplier Has been updated successfully.']);
    }

    public function changeStatus($id)
    {
        $supplier = Supplier::find($id);
        $value = !$supplier->is_active;
        $supplier->update([
            'is_active' => (int) $value,
        ]);

        return redirect()->back()->with(['success'=>'supplier status change successfully.']);
    }
}

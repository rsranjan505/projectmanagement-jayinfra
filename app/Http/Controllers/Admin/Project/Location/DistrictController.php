<?php

namespace App\Http\Controllers\Admin\Project\Location;

use App\Http\Controllers\Controller;
use App\Models\District;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class DistrictController extends Controller
{
           /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $lists = District::where('is_active',1)->get();
        if ($request->ajax()) {
            $districts = District::limit(10)->latest();

            return DataTables::of($districts)
            ->addIndexColumn()
            ->setRowId(function ($district) {
                return 'row'.$district->id;
            })
            ->addColumn('State Name', function ($district) {
                return $district->state !=null ? $district->state->name :'';
            })
            ->addColumn('Code', function ($district) {
                return $district->code;
            })
            ->addColumn('District Name', function ($district) {
                return $district->name;
            })
            ->addColumn('Status', function ($district) {
                $status='';
                if($district->is_active ==1){
                    $status ='Active';
                }else{
                    $status= 'Deactive';
                }
                return $status;
            })

            ->addColumn('action', function($district){
                if($district->is_active ==1){
                    $status = 'Deactivate';
                }else{
                    $status = 'Activate';
                }
                return '<div class="dropdown">
                        <button class="btn btn-danger btn-sm dropdown-toggle" type="button" id="dropdownMenuSizeButton3" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuSizeButton3">
                        <a class="dropdown-item" onClick="editModel('.$district->id.')" href="#">Edit</a>
                        <a class="dropdown-item" href="'.url('district/change-status/'.$district->id).'">'.$status.'</a>

                        </div>
                    </div>';

            })
            ->rawColumns(['action'])
            ->make(true);
        }
        return view('admin.pages.project.location.district',['district' => $lists]);

    }

    public function save(Request $request)
    {
        if($request->id !=null){
            $request->validate([
                'name' => 'required|unique:product_categories,name,'.$request->id.',id',
            ]);
        }else{
            $request->validate([
                'name' => 'required|unique:product_categories,name',
            ]);
        }


        recordSave(District::class,$request->all(),null,null);
        if($request->id !=null){
            return redirect()->back()->with(['success'=>'Designation Has been updated successfully.']);
        }
        return redirect()->back()->with(['success'=>'Designation Has been created successfully.']);
    }

    public function edit($id)
    {
        $district = District::find($id);
        return ok($district);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $district =  District::find($id);
        return ok($district);
    }

    public function changeStatus($id)
    {
        $district = District::find($id);
        $value = !$district->is_active;
        $district->update([
            'is_active' => (int) $value,
        ]);

        return redirect()->back()->with(['success'=>'district status change successfully.']);
    }
}

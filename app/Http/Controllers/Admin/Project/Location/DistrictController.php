<?php

namespace App\Http\Controllers\Admin\Project\Location;

use App\Http\Controllers\Controller;
use App\Models\District;
use App\Models\State;
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
        $states = State::all();
        if ($request->ajax()) {
            $districts = District::all();

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
                    $status ='<span class="badge bg-success">Active</span>';
                }else{
                    $status= '<span class="badge bg-danger">Deactive</span>';
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
                        <a class="dropdown-item" href="'.url('project/location/districts/change-status/'.$district->id).'">'.$status.'</a>

                        </div>
                    </div>';

            })
            ->rawColumns(['action','Status'])
            ->make(true);
        }
        return view('admin.pages.project.location.district',['states' => $states]);

    }

    public function save(Request $request)
    {
        if($request->id !=null){
            $request->validate([
                'state_id' => 'required|numeric',
                'name' => 'required|unique:districts,name,'.$request->id.',id',
            ]);
        }else{
            $request->validate([
                'state_id' => 'required|numeric',
                'name' => 'required|unique:districts,name',
            ]);
        }
        $data = $request->all();
        $data['name'] = ucfirst($request->name);
        $data['code'] = ucfirst(substr( $request->name,0,2));

        recordSave(District::class,$data,null,null);
        if($request->id !=null){
            return redirect()->back()->with(['success'=>'District Has been updated successfully.']);
        }
        return redirect()->back()->with(['success'=>'District Has been created successfully.']);
    }

    public function edit($id)
    {
        $district = District::with('state')->find($id);
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

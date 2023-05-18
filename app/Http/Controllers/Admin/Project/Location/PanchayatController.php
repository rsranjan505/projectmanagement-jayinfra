<?php

namespace App\Http\Controllers\Admin\Project\Location;

use App\Http\Controllers\Controller;
use App\Models\Block;
use App\Models\Panchayat;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class PanchayatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $blocks = Block::all();
        if ($request->ajax()) {
            $panchayats = Panchayat::all();

            return DataTables::of($panchayats)
            ->addIndexColumn()
            ->setRowId(function ($panchayat) {
                return 'row'.$panchayat->id;
            })
            ->addColumn('District Name', function ($panchayat) {
                return $panchayat->block !=null ? $panchayat->block->district->name :'';
            })
            ->addColumn('Block Name', function ($panchayat) {
                return $panchayat->block !=null ? $panchayat->block->name :'';
            })
            ->addColumn('Code', function ($panchayat) {
                return $panchayat->code;
            })
            ->addColumn('Panchayat Name', function ($panchayat) {
                return $panchayat->name;
            })
            ->addColumn('Status', function ($panchayat) {
                $status='';
                if($panchayat->is_active ==1){
                    $status ='<span class="badge bg-success">Active</span>';
                }else{
                    $status= '<span class="badge bg-danger">Deactive</span>';
                }
                return $status;
            })

            ->addColumn('action', function($panchayat){
                if($panchayat->is_active ==1){
                    $status = 'Deactivate';
                }else{
                    $status = 'Activate';
                }
                return '<div class="dropdown">
                        <button class="btn btn-danger btn-sm dropdown-toggle" type="button" id="dropdownMenuSizeButton3" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuSizeButton3">
                        <a class="dropdown-item" onClick="editModel('.$panchayat->id.')" href="#">Edit</a>
                        <a class="dropdown-item" href="'.url('project/location/panchayats/change-status/'.$panchayat->id).'">'.$status.'</a>

                        </div>
                    </div>';

            })
            ->rawColumns(['action','Status'])
            ->make(true);
        }
        return view('admin.pages.project.location.panchayat',['blocks' => $blocks]);

    }

    public function save(Request $request)
    {
        if($request->id !=null){
            $request->validate([
                'block_id' => 'required|numeric',
                'name' => 'required|unique:panchayats,name,'.$request->id.',id',
            ]);
        }else{
            $request->validate([
                'block_id' => 'required|numeric',
                'name' => 'required|unique:panchayats,name',
            ]);
        }
        $data = $request->all();
        $data['name'] = ucfirst($request->name);
        $data['code'] = ucfirst(substr( $request->name,0,2));

        recordSave(Panchayat::class,$data,null,null);
        if($request->id !=null){
            return redirect()->back()->with(['success'=>'Panchayat Has been updated successfully.']);
        }
        return redirect()->back()->with(['success'=>'Panchayat Has been created successfully.']);
    }

    public function edit($id)
    {
        $panchayat = Panchayat::with('block')->find($id);
        return ok($panchayat);
    }

    public function changeStatus($id)
    {
        $panchayat = Panchayat::find($id);
        $value = !$panchayat->is_active;

        $panchayat->update([
            'is_active' => (int) $value,
        ]);

        return redirect()->back()->with(['success'=>'Panchayat status change successfully.']);
    }
}

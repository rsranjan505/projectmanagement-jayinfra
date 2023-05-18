<?php

namespace App\Http\Controllers\Admin\Project\Location;

use App\Http\Controllers\Controller;
use App\Models\Panchayat;
use App\Models\Village;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class VillageController extends Controller
{
        /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $panchayats = Panchayat::all();
        if ($request->ajax()) {
            $villages = Village::all();

            return DataTables::of($villages)
            ->addIndexColumn()
            ->setRowId(function ($village) {
                return 'row'.$village->id;
            })
            ->addColumn('District Name', function ($village) {
                return $village->panchayat !=null ? $village->panchayat->block->district->name :'';
            })
            ->addColumn('Block Name', function ($village) {
                return $village->panchayat !=null ? $village->panchayat->block->name :'';
            })
            ->addColumn('Panchayat Name', function ($village) {
                return $village->panchayat !=null ? $village->panchayat->name :'';
            })
            ->addColumn('Village Name', function ($village) {
                return $village->name;
            })
            ->addColumn('Status', function ($village) {
                $status='';
                if($village->is_active ==1){
                    $status ='Active';
                }else{
                    $status= 'Deactive';
                }
                return $status;
            })

            ->addColumn('action', function($village){
                if($village->is_active ==1){
                    $status = 'Deactivate';
                }else{
                    $status = 'Activate';
                }
                return '<div class="dropdown">
                        <button class="btn btn-danger btn-sm dropdown-toggle" type="button" id="dropdownMenuSizeButton3" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuSizeButton3">
                        <a class="dropdown-item" onClick="editModel('.$village->id.')" href="#">Edit</a>
                        <a class="dropdown-item" href="'.url('project/location/villages/change-status/'.$village->id).'">'.$status.'</a>

                        </div>
                    </div>';

            })
            ->rawColumns(['action','status'])
            ->make(true);
        }
        return view('admin.pages.project.location.village',['panchayats' => $panchayats]);

    }

    public function save(Request $request)
    {
        if($request->id !=null){
            $request->validate([
                'panchayat_id' => 'required|numeric',
                'name' => 'required|unique:villages,name,'.$request->id.',id',
            ]);
        }else{
            $request->validate([
                'panchayat_id' => 'required|numeric',
                'name' => 'required|unique:villages,name',
            ]);
        }
        $data = $request->all();
        $data['name'] = ucfirst($request->name);
        $data['code'] = ucfirst(substr( $request->name,0,2));

        recordSave(Village::class,$data,null,null);
        if($request->id !=null){
            return redirect()->back()->with(['success'=>'Village Has been updated successfully.']);
        }
        return redirect()->back()->with(['success'=>'Village Has been created successfully.']);
    }

    public function edit($id)
    {
        $village = Village::with('panchayat')->find($id);
        return ok($village);
    }

    public function changeStatus($id)
    {
        $village = Village::find($id);
        $value = !$village->is_active;

        $village->update([
            'is_active' => (int) $value,
        ]);

        return redirect()->back()->with(['success'=>'Village status change successfully.']);
    }
}

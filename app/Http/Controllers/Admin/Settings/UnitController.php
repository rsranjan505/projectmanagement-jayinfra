<?php

namespace App\Http\Controllers\Admin\Settings;

use App\Http\Controllers\Controller;
use App\Models\Unit;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class UnitController extends Controller
{
       /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $units = Unit::limit(10)->latest();

            return DataTables::of($units)
            ->addIndexColumn()
            ->setRowId(function ($unit) {
                return 'row'.$unit->id;
            })

            ->addColumn('Name', function ($unit) {
                return $unit->name;
            })
            ->addColumn('Short Name', function ($unit) {
                return $unit->sku;
            })
            ->addColumn('Status', function ($unit) {
                $status='';
                if($unit->is_active ==1){
                    $status ='Active';
                }else{
                    $status= 'Deactive';
                }
                return $status;
            })

            ->addColumn('action', function($unit){
                if($unit->is_active ==1){
                    $status = 'Deactivate';
                }else{
                    $status = 'Activate';
                }
                return '<div class="dropdown">
                        <button class="btn btn-danger btn-sm dropdown-toggle" type="button" id="dropdownMenuSizeButton3" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuSizeButton3">
                        <a class="dropdown-item" onClick="editModel('.$unit->id.')" href="#">Edit</a>
                        <a class="dropdown-item" href="'.url('units/change-status/'.$unit->id).'">'.$status.'</a>

                        </div>
                    </div>';

            })
            ->rawColumns(['action'])
            ->make(true);
        }
        return view('admin.pages.settings.units');

    }

    public function save(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:units,name',
        ]);

        recordSave(Unit::class,$request->all(),null,null);
        if($request->id !=null){
            return redirect()->back()->with(['success'=>'Unit Has been updated successfully.']);
        }
        return redirect()->back()->with(['success'=>'Unit Has been created successfully.']);
    }

    public function edit($id)
    {
        $unit = Unit::find($id);
        return ok($unit);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $unit =  Unit::find($id);
        return ok($unit);
    }

    public function changeStatus($id)
    {
        $unit = Unit::find($id);
        $value = !$unit->is_active;
        $unit->update([
            'is_active' => (int) $value,
        ]);

        return redirect()->back()->with(['success'=>'Unit status change successfully.']);
    }
}

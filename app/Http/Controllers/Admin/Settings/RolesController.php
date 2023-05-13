<?php

namespace App\Http\Controllers\Admin\Settings;

use App\Http\Controllers\Controller;
use App\Models\Role;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class RolesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $users = Role::limit(10)->latest();

            return DataTables::of($users)
            ->addIndexColumn()
            ->setRowId(function ($user) {
                return 'row'.$user->id;
            })

            ->addColumn('Name', function ($user) {
                return $user->name;
            })
            ->addColumn('Status', function ($user) {
                $status='';
                if($user->is_active ==1){
                    $status ='Active';
                }else{
                    $status= 'Deactive';
                }
                return $status;
            })

            ->addColumn('action', function($user){
                if($user->is_active ==1){
                    $status = 'Deactivate';
                }else{
                    $status = 'Activate';
                }
                return '<div class="dropdown">
                        <button class="btn btn-danger btn-sm dropdown-toggle" type="button" id="dropdownMenuSizeButton3" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuSizeButton3">
                        <a class="dropdown-item" onClick="editModel('.$user->id.')" href="#">Edit</a>
                        <a class="dropdown-item" href="'.url('designations/change-status/'.$user->id).'">'.$status.'</a>

                        </div>
                    </div>';

            })
            ->rawColumns(['action'])
            ->make(true);
        }
        return view('admin.pages.settings.roles.list');

    }

    public function save(Request $request)
    {
        if($request->id !=null){
            $request->validate([
                'name' => 'required|unique:roles,name,'.$request->id.',id',
            ]);
        }else{
            $request->validate([
                'name' => 'required|unique:roles,name',
            ]);
        }

        recordSave(Role::class,$request->all(),null,null);
        if($request->id !=null){
            return redirect()->back()->with(['success'=>'Role Has been updated successfully.']);
        }
        return redirect()->back()->with(['success'=>'Role Has been created successfully.']);
    }

    public function edit($id)
    {
        $designation = Role::find($id);
        return ok($designation);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $role =  Role::find($id);
        return ok($role);
    }

    public function changeStatus($id)
    {
        $role = Role::find($id);
        $value = !$role->is_active;
        $role->update([
            'is_active' => (int) $value,
        ]);

        return redirect()->back()->with(['success'=>'Role status change successfully.']);
    }
}

<?php

namespace App\Http\Controllers\Admin\Employee;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Department;
use App\Models\Designation;
use App\Models\Role;
use App\Models\State;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;

class EmployeeController extends Controller
{
    public $data=[];

    public function index(Request $request)
    {
        if ($request->ajax()) {

            if(auth()->user()->role->name == 'admin'){
                $users = User::with('image','state','city')->limit(10)->latest();
            }else{
                $users = User::where('id',auth()->user()->id)->with('image','state','city')->limit(10)->latest();
            }

            return DataTables::of($users)
                    ->addIndexColumn()
                    ->setRowId(function ($user) {
                        return 'row'.$user->id;
                    })

                    ->addColumn('Full Name', function ($user) {
                        return $user->name;
                    })

                    ->addColumn('Email', function ($user) {
                        return $user->email;
                    })
                    ->addColumn('Mobile', function ($user) {
                        return $user->mobile;
                    })
                    ->addColumn('Gender', function ($user) {
                        return $user->gender;
                    })
                    ->addColumn('User Type', function ($user) {
                        return $user->employee_type ;
                    })
                    ->addColumn('Address', function ($user) {
                        return $user->address;
                    })
                    ->addColumn('City', function ($user) {
                        return $user->city ? $user->city->name : '';
                    })
                    ->addColumn('State', function ($user) {
                        return $user->state ? $user->state->name : '';
                    })
                    ->addColumn('Pincode', function ($user) {
                        return $user->pincode;
                    })
                    ->addColumn('Created Date', function ($user) {
                        return $user->created_at;
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
                                <a class="dropdown-item" href="'.url('employee/edit/'.$user->id).'">Edit</a>
                                <a class="dropdown-item" href="'.url('employee/change-status/'.$user->id).'">'.$status.'</a>

                                </div>
                            </div>';

                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        return view('admin.pages.employee.list');
    }

    public function create()
    {
        $this->data['roles'] = Role::all();
        $this->data['departments'] = Department::all();
        $this->data['designations'] = Designation::all();
        $this->data['state'] = State::all();
        return view('admin.pages.employee.add',['data' => $this->data]);
    }

    public function save(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|unique:users,email',
            'mobile' =>'required',
            'address' => 'required',
            'state_id' =>'required',
            'city_id' =>'required',
            'postcode' =>'required',
            'password' => 'required',
            'confirm-password' => 'required|same:password',
        ]);

        $data = $request->except(['avatar','confirm-password']);
        $data['created_by'] = auth()->user()->id;
        $data['password'] = Hash::make($request->password);

        $user = recordSave(User::class,$data,null,null);
        if($request->avatar !=null){
            $image = fileUpload($request->avatar,$user,'local');
            $image['document_type']='avatar';
            $user->image()->create($image);
        }

        return redirect()->back()->with(['success'=>'Employee Has been created successfully.']);
    }

    public function edit($id)
    {
        $this->data['roles'] = Role::all();
        $this->data['departments'] = Department::all();
        $this->data['designations'] = Designation::all();
        $this->data['state'] = State::all();
        $this->data['city'] = City::all();
        $this->data['employee'] = User::find($id);
        return view('admin.pages.employee.edit',['data' => $this->data]);
    }

    public function changeStatus($id)
    {
        $user = User::find($id);
        $value = !$user->is_active;
        $user->update([
            'is_active' => (int) $value,
        ]);

        return redirect()->back()->with(['success'=>'Employee status change successfully.']);
    }
}

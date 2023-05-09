<?php

namespace App\Http\Controllers\Admin\Employee;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\Designation;
use App\Models\Role;
use App\Models\State;
use App\Models\User;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public $data=[];

    public function index()
    {
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
        $data = $request->all();
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|unique:users,email',
            'mobile' =>'required',
            'address' => 'required',
            'state_id' =>'required',
            'city_id' =>'required',
            'pincode' =>'required',
            'password' => 'required',
            'confirm-password' => 'required|same:password',
        ]);

        $data['created_by'] = auth()->user()->id;
        dd($data);
        $user = new User();
        $user->save($data);
        // $order = $this->recordSave(Order::class,$data,null,null);
        return view('admin.pages.employee.add',['data' => $this->data]);
    }

    public function edit($id)
    {
        $this->data['roles'] = Role::all();
        $this->data['departments'] = Department::all();
        $this->data['designations'] = Designation::all();
        $this->data['state'] = State::all();
        $this->data['employee'] = User::find($id);
        return view('admin.pages.employee.edit',['data' => $this->data]);
    }
}

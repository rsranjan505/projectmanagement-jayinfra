<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function index()
    {
        $relation = ['department','designation','role','state','city','image'];
        $user = User::where('id',auth()->user()->id)->with($relation)->first();

        return view('admin.pages.profile.view',['user'=>$user]);
    }

    public function create()
    {
        return view('admin.pages.employee.add');
    }

    public function edit($id)
    {
        return view('admin.pages.employee.edit');
    }

    public function changePassword(Request $request)
    {
        $user = User::find(auth()->user()->id);
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:5',
            'confirm-password' => 'required|same:new_password',
        ]);
        if($user->password != Hash::make($request->current_password)){
            return redirect()->back()->with(['warning'=>'Password not mathch with current password.']);
        }
        $user->update([
            'password' => Hash::make($request->new_password),
        ]);

        return redirect()->back()->with(['success'=>'Password change successfully.']);
    }

}

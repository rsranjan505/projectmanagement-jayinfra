<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        return view('admin.pages.employee.list');
    }

    public function create()
    {
        return view('admin.pages.employee.add');
    }

    public function edit($id)
    {
        return view('admin.pages.employee.edit');
    }
}

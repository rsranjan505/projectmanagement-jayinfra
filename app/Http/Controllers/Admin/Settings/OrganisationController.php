<?php

namespace App\Http\Controllers\Admin\Settings;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Organisation;
use App\Models\State;
use Illuminate\Http\Request;

class OrganisationController extends Controller
{
    public $data;
    public function index()
    {
        $relation = ['state','city','image','gst'];

        $this->data['state'] = State::all();
        $this->data['city'] = City::all();
        $this->data['org'] = Organisation::with($relation)->first();

        return view('admin.pages.settings.business_profile.view',['data'=>$this->data]);
    }

    public function save(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'display_name' => 'required|string',
            'short_name' => 'required|string',
            'registration_number' => 'required|string|unique:organisations,email',
            'pan' => 'required|string',
            'email' => 'required',
            'mobile' =>'required',
            'inventory_type' => 'required',
            'address' => 'required',
            'gstin' => 'required',
            'state_id' =>'required',
            'city_id' =>'required',
            'postcode' =>'required',
        ]);
        $data = $request->except(['avatar','gstin']);
        $data['created_by'] = auth()->user()->id;
        $data['country_id'] = 101;

        $company = recordSave(Organisation::class,$data,null,null);
        if($request->gstin !=null){
            $gstdata['gstin'] = $request->gstin;
            $gstdata['address'] = $request->address;
            $gstdata['state_id'] = $request->state_id;
            $gstdata['city_id'] = $request->city_id;
            $gstdata['country_id'] = 101;
            $gstdata['is_primary'] = 1;
            $company->gst()->create($gstdata);
        }
        if($request->avatar !=null){
            $image = fileUpload($request->avatar,$company,'local');
            $image['document_type']='avatar';
            $company->image()->create($image);
        }
        return redirect()->back()->with(['success'=>'Company data has been save successfully.']);
    }

    public function edit($id)
    {
        return view('admin.pages.employee.edit');
    }
}

<?php

namespace App\Http\Controllers\Admin\Project;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Client;
use App\Models\Gst;
use App\Models\State;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ClientController extends Controller
{
    public $data=[];

    public function index(Request $request)
    {
        if ($request->ajax()) {

            if(auth()->user()->role->name == 'admin'){
                $clients = Client::with('state','city','gst','creator')->latest();
            }else{
                $clients = Client::where('id',auth()->user()->id)->with('state','city','gst','creator')->latest();
            }

            return DataTables::of($clients)
                    ->addIndexColumn()
                    ->setRowId(function ($client) {
                        return 'row'.$client->id;
                    })
                    ->addColumn('Client Name', function ($client) {
                        return $client->name;
                    })
                    ->addColumn('Business Name', function ($client) {
                        return $client->business_name;
                    })

                    ->addColumn('Type', function ($client) {
                        return $client->type;
                    })

                    ->addColumn('Email', function ($client) {
                        return $client->email;
                    })
                    ->addColumn('Mobile', function ($client) {
                        return $client->mobile;
                    })
                    ->addColumn('Address', function ($client) {
                        return $client->address;
                    })
                    ->addColumn('City', function ($client) {
                        return $client->city ? $client->city->name : '';
                    })
                    ->addColumn('State', function ($client) {
                        return $client->state ? $client->state->name : '';
                    })
                    ->addColumn('Postcode', function ($client) {
                        return $client->postcode;
                    })
                    ->addColumn('Added By', function ($client) {
                        return $client->creator ? $client->creator->name : '';
                    })
                    ->addColumn('Created Date', function ($client) {
                        return $client->created_at->format('d-m-Y');
                    })
                    ->addColumn('Status', function ($client) {
                        $status='';
                        if($client->is_active ==1){
                            $status ='Active';
                        }else{
                            $status= 'Deactive';
                        }
                        return $status;
                    })

                    ->addColumn('action', function($client){
                        if($client->is_active ==1){
                            $status = 'Deactivate';
                        }else{
                            $status = 'Activate';
                        }
                        return '<div class="dropdown">
                                <button class="btn btn-danger btn-sm dropdown-toggle" type="button" id="dropdownMenuSizeButton3" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuSizeButton3">
                                <a class="dropdown-item" href="'.url('project/clients/edit/'.$client->id).'">Edit</a>
                                <a class="dropdown-item" href="'.url('project/clients/change-status/'.$client->id).'">'.$status.'</a>

                                </div>
                            </div>';

                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        return view('admin.pages.project.client.list');
    }

    public function create()
    {
        $this->data['state'] = State::all();
        $this->data['city'] = City::all();
        return view('admin.pages.project.client.add',['data' => $this->data]);
    }

    public function save(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'business_name' => 'required|unique:clients,business_name',
            'type' => 'required',
            'email' => 'required',
            'mobile' =>'required',
            'address' => 'required',
            'state_id' =>'required',
            'city_id' =>'required',
            'postcode' =>'required',
        ]);
        $data = $request->except(['gstin']);
        $data['created_by'] = auth()->user()->id;

        $client = recordSave(Client::class,$data,null,null);
        if($request->gstin !=null){
            $gstdata['gstin'] = $request->gstin;
            $gstdata['address'] = $request->address;
            $gstdata['state_id'] = $request->state_id;
            $gstdata['city_id'] = $request->city_id;
            $gstdata['country_id'] = 101;
            $gstdata['is_primary'] = 1;
            $client->gst()->create($gstdata);
        }

        return redirect()->back()->with(['success'=>'client has been added successfully.']);
    }

    public function edit($id)
    {
        $this->data['state'] = State::all();
        $this->data['city'] = City::all();
        $this->data['client'] = Client::where('id',$id)->with('state','city','gst','creator')->get()->first();
        return view('admin.pages.project.client.edit',['data' => $this->data]);
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'business_name' => 'required|unique:clients,business_name,'.$request->id.',id',
            'type' => 'required',
            'email' => 'required',
            'mobile' =>'required',
            'address' => 'required',
            'state_id' =>'required',
            'city_id' =>'required',
            'postcode' =>'required',
        ]);
        $data = $request->except(['gstin']);
        $client = recordSave(Client::class,$data,null,null);
        if($request->gstin !=null){
            $gst = Gst::where(['model_id'=>$client->id,'model_type' => Client::class])->get()->first();
            $gstdata['gstin'] = $request->gstin;

            $client->gst()->update($gstdata);
        }

        return redirect()->back()->with(['success'=>'client Has been updated successfully.']);
    }

    public function changeStatus($id)
    {
        $client = Client::find($id);
        $value = !$client->is_active;
        $client->update([
            'is_active' => (int) $value,
        ]);

        return redirect()->back()->with(['success'=>'client status change successfully.']);
    }
}

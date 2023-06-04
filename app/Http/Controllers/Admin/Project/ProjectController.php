<?php

namespace App\Http\Controllers\Admin\Project;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\Project;
use App\Models\ProjectStatus;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ProjectController extends Controller
{
    public $data=[];

    public function index(Request $request)
    {
        if ($request->ajax()) {

            $projects = Project::with('manager','client','status','creator')->latest();

            return DataTables::of($projects)
                    ->addIndexColumn()
                    ->setRowId(function ($project) {
                        return 'row'.$project->id;
                    })
                    ->addColumn('Project Name', function ($project) {
                        return $project->name;
                    })
                    ->addColumn('Short Desciption', function ($project) {
                        return $project->short_desc;
                    })
                    ->addColumn('Desciption', function ($project) {
                        return $project->long_desc;
                    })

                    ->addColumn('Project Manager', function ($project) {
                        return $project->manager ? $project->manager->name : '';
                    })

                    ->addColumn('Project Type', function ($project) {
                        return $project->project_type;
                    })
                    ->addColumn('Start Date', function ($project) {
                        return $project->start_date;
                    })
                    ->addColumn('Deadline', function ($project) {
                        return $project->deadline;
                    })
                    ->addColumn('Project Extimated Cost', function ($project) {
                        return $project->project_extimated_cost;
                    })
                    ->addColumn('Client Name', function ($project) {
                        return $project->client ? $project->client->name : '';
                    })
                    ->addColumn('Added By', function ($project) {
                        return $project->creator ? $project->creator->name : '';
                    })
                    ->addColumn('Created Date', function ($project) {
                        return $project->created_at->format('d-m-Y');
                    })
                    ->addColumn('Project Status', function ($project) {

                        return $project->status !=null ? $project->status->name :'';
                    })

                    ->addColumn('action', function($project){
                        if($project->is_active ==1){
                            $status = 'Deactivate';
                        }else{
                            $status = 'Activate';
                        }
                        return '<div class="dropdown">
                                <button class="btn btn-danger btn-sm dropdown-toggle" type="button" id="dropdownMenuSizeButton3" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuSizeButton3">
                                <a class="dropdown-item" href="'.url('project/view/'.$project->id).'">View</a>
                                <a class="dropdown-item" href="'.url('project/edit/'.$project->id).'">Edit</a>
                                <a class="dropdown-item" href="'.url('project/change-status/'.$project->id).'">'.$status.'</a>

                                </div>
                            </div>';

                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        return view('admin.pages.project.list');
    }

    public function create()
    {
        $this->data['clients'] = Client::all();
        $this->data['projectstatus'] = ProjectStatus::all();
        return view('admin.pages.project.add',['data' => $this->data]);
    }

    public function save(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:projects,name',
            'project_type' => 'required',
            'start_date' => 'required',
            'short_desc' => 'required',
            'project_extimated_cost' => 'required',
        ]);
        $data = $request->all();
        $data['created_by'] = auth()->user()->id;

        $project = recordSave(Project::class,$data,null,null);
        if($request->gstin !=null){
            $gstdata['gstin'] = $request->gstin;
            $gstdata['address'] = $request->address;
            $gstdata['state_id'] = $request->state_id;
            $gstdata['city_id'] = $request->city_id;
            $gstdata['country_id'] = 101;
            $gstdata['is_primary'] = 1;
            $project->gst()->create($gstdata);
        }

        return redirect()->back()->with(['success'=>'project has been added successfully.']);
    }

    public function edit($id)
    {
        $this->data['clients'] = Client::all();
        $this->data['projectstatus'] = ProjectStatus::all();
        $this->data['project'] = Project::where('id',$id)->with('manager','client','status','creator')->get()->first();
        return view('admin.pages.project.edit',['data' => $this->data]);
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:projects,name,'.$request->id.',id',
            'project_type' => 'required',
            'start_date' => 'required',
            'short_desc' => 'required',
            'project_extimated_cost' => 'required',
        ]);
        $data = $request->all();
        $project = recordSave(Project::class,$data,null,null);

        return redirect()->back()->with(['success'=>'project Has been updated successfully.']);
    }

    public function changeStatus($id)
    {
        $project = Project::find($id);
        $value = !$project->is_active;
        $project->update([
            'is_active' => (int) $value,
        ]);

        return redirect()->back()->with(['success'=>'project status change successfully.']);
    }
}

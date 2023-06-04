<?php

namespace App\Http\Controllers\Admin\Project;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\ProjectLocation;
use App\Models\ProjectPhase;
use App\Models\ProjectStatus;
use App\Models\State;
use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ProjectPhaseController extends Controller
{
    public $data=[];

    public function index(Request $request)
    {
        if ($request->ajax()) {

            $projectpahses = ProjectPhase::with('manager','project','status','creator')->latest();

            return DataTables::of($projectpahses)
                    ->addIndexColumn()
                    ->setRowId(function ($project) {
                        return 'row'.$project->id;
                    })
                    ->addColumn('Project Name', function ($phase) {
                        return $phase->project !=null ? $phase->project->name:'';
                    })
                    ->addColumn('Title', function ($phase) {
                        return $phase->name;
                    })
                    ->addColumn('Category', function ($phase) {
                        return $phase->category;
                    })
                    ->addColumn('Phase Manager', function ($phase) {
                        return $phase->manager ? $phase->manager->name : '';
                    })
                    ->addColumn('Description', function ($phase) {
                        return $phase->desciption;
                    })

                    ->addColumn('Start Date', function ($phase) {
                        return $phase->start_date;
                    })
                    ->addColumn('Deadline', function ($phase) {
                        return $phase->deadline;
                    })
                    ->addColumn('Phase Extimated Cost', function ($phase) {
                        return $phase->phase_extimated_cost;
                    })

                    ->addColumn('Added By', function ($phase) {
                        return $phase->creator ? $phase->creator->name : '';
                    })
                    ->addColumn('Created Date', function ($phase) {
                        return $phase->created_at->format('d-m-Y');
                    })
                    ->addColumn('Project Status', function ($phase) {

                        return $phase->status !=null ?  $phase->status->name :'';
                    })

                    ->addColumn('action', function($phase){
                        if($phase->is_active ==1){
                            $status = 'Deactivate';
                        }else{
                            $status = 'Activate';
                        }
                        return '<div class="dropdown">
                                <button class="btn btn-danger btn-sm dropdown-toggle" type="button" id="dropdownMenuSizeButton3" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuSizeButton3">
                                <a class="dropdown-item" href="'.url('project/phases/view/'.$phase->id).'">View location</a>
                                <a class="dropdown-item" href="'.url('project/phases/edit/'.$phase->id).'">Edit</a>
                                <a class="dropdown-item" href="'.url('project/phases/change-status/'.$phase->id).'">'.$status.'</a>

                                </div>
                            </div>';

                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        return view('admin.pages.project.phase.list');
    }

    public function create()
    {
        $this->data['projects'] = Project::all();
        $this->data['projectstatus'] = ProjectStatus::all();
        $this->data['states'] = State::all();
        $this->data['users'] = User::where('role_id','!=',1)->get();
        return view('admin.pages.project.phase.add',['data' => $this->data]);
    }

    public function save(Request $request)
    {

        $request->validate([
            'name' => 'required|unique:project_phases,name',
            'project_id' => 'required',
            'start_date' => 'required',
            'phase_extimated_cost' => 'required',
            'location.address' => 'required',
            'location.state_id' => 'required',
        ]);
        $data = $request->except(['location']);
        $data['created_by'] = auth()->user()->id;

        $projectphase = recordSave(ProjectPhase::class,$data,null,null);
        if($request->location !=null){
            $projectlocation = new ProjectLocation();
            $location=[];
            $location = $request->location;
            $location['project_id'] = $projectphase->project_id;
            $location['project_phase_id'] = $projectphase->id;
            $location['created_by'] = auth()->user()->id;
            $location['is_primary'] = (int) $request->location['is_primary'];

            $projectlocation->create($location);
        }

        return redirect()->back()->with(['success'=>'project phase has been added successfully.']);
    }

    public function edit($id)
    {
        $this->data['projects'] = Project::all();
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
}

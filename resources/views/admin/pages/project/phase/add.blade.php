@extends('admin.layouts.app')

@section('content')
@section('page_title', 'Jay Infra Projects | Project Phase')
@section('project_section', 'menu-open')
@section('project_phase_section', 'active')
@include('admin._partials.bredcum',['title'=>'Project Phase'] )

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    @include('admin.components.project.phase-nav-header' ,['activeTab' => 'add'])
                    <div class="card-body">
                        @if (count($errors) > 0)
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form id="add-phases-form"  action="{{ route('save-phases')}}" method="post"  enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">

                                <div class="row">
                                    <div class="col-12 col-sm-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Project Name*</label>
                                            <select class="form-control" id="project_id" name="project_id">
                                                <option value="">Select Project</option>
                                                @foreach ($data['projects'] as $project)
                                                    <option value="{{$project->id}}">{{$project->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Phase Title*</label>
                                            <input type="text" class="form-control" id="name" name="name" placeholder="Enter Phase Title">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 col-sm-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Phase Category*</label>
                                            <input type="text" class="form-control" id="category" name="category" placeholder="Enter Phase category">
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Phase Head*</label>
                                            <select class="form-control" id="staff_id" name="staff_id">
                                                <option value="">select</option>
                                                @foreach ($data['users'] as $staff)
                                                    <option value="{{$staff->id}}">{{$staff->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 col-sm-12">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Description*</label>
                                            <textarea type="text" class="form-control" rows="2" id="description" name="description" rows="2"  placeholder="Enter Short Description"></textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Start Date*</label>
                                            <input type="date" class="form-control" id="start_date" name="start_date"  placeholder="Enter Start Date">
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Project Deadline*</label>
                                            <input type="date" class="form-control" id="deadline" name="deadline" placeholder="Enter deadline">
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Project duration*</label>
                                            <input type="text" class="form-control" id="duration" name="duration" placeholder="Enter duration(example:-6 month, 1 year)">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 col-sm-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Phase Extimated Cost (&#8377;)*</label>
                                            <input type="number" class="form-control" id="phase_extimated_cost" name="phase_extimated_cost" placeholder="Enter phase Extimated Cost">
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Project Status*</label>
                                            <select class="form-control" id="project_status_id" name="project_status_id">
                                                <option value="">Select project status</option>
                                                @foreach ($data['projectstatus'] as $projectstatus)
                                                    <option value="{{$projectstatus->id}}">{{$projectstatus->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <h4>Project Location</h4>
                                <div class="row">
                                    <div class="col-12 col-sm-12">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Project Location Address*</label>
                                            <textarea type="text" class="form-control" rows="2" id="location_address" name="location[address]" rows="2"  placeholder="Enter Short Description"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 col-sm-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Select State </label>
                                            <select class="form-control" id="location_state_id" name="location[state_id]">
                                                <option value="">Select state</option>
                                                @foreach ($data['states'] as $state)
                                                    <option value="{{$state->id}}">{{$state->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">District*</label>
                                            <select class="form-control" id="location_district_id" name="location[district_id]">
                                                <option value="">Select state first</option>

                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 col-sm-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Block*</label>
                                            <select class="form-control" id="location_block_id" name="location[block_id]">
                                                <option value="">Select district first</option>

                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Panchayat*</label>
                                            <select class="form-control" id="location_panchayat_id" name="location[panchayat_id]">
                                                <option value="">Select block first</option>

                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 col-sm-12">
                                        <div class="form-group">
                                            <div class="icheck-success d-inline">
                                                <input type="checkbox" id="checkboxSuccess1" name="location[is_primary]">
                                                <label for="checkboxSuccess1">Is Primary Location
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-success">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


{{-- <script src="http://jqueryvalidation.org/files/dist/jquery.validate.min.js"></script>
<script src="http://jqueryvalidation.org/files/dist/additional-methods.min.js"></script> --}}
  <script src="{{ asset('admin/custom/custom.js')}}"></script>

  <script>

</script>
@endsection

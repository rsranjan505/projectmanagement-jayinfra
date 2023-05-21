@extends('admin.layouts.app')

@section('content')
@section('page_title', 'Jay Infra Projects | Project')
@section('project_section', 'menu-open')
@section('project_project_section', 'active')
@include('admin._partials.bredcum',['title'=>'Project'] )

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    @include('admin.components.project.project-nav-header' ,['activeTab' => 'add'])
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

                        <form id="add-project-form"  action="{{ route('save-project')}}" method="post"  enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">

                                <div class="row">
                                    <div class="col-12 col-sm-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Project Name*</label>
                                            <input type="text" class="form-control" id="name" name="name" placeholder="Enter project name">
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Project Type*</label>
                                            <select class="form-control" id="project_type" name="project_type">
                                                <option value="">select</option>
                                                <option value="internal">Internal Project</option>
                                                <option value="client-project">Client Project</option>
                                                <option value="government">Government (Nal jal)</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 col-sm-12">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Short Description*</label>
                                            <textarea type="text" class="form-control" rows="2" id="short_desc" name="short_desc" rows="2"  placeholder="Enter Short Description"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 col-sm-12">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1"> Long Description</label>
                                            <textarea type="text" class="form-control"  rows="6" id="long_desc" name="long_desc" rows="2"  placeholder="Enter Description"></textarea>
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
                                            <label for="exampleInputEmail1">Project Extimated Cost (&#8377;)*</label>
                                            <input type="number" class="form-control" id="project_extimated_cost" name="project_extimated_cost" placeholder="Enter Project Extimated Cost">
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

                                {{-- <div class="row">
                                    <div class="col-12 col-sm-12">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">GSTIN*</label>
                                            <input type="text" class="form-control" id="gstin" name="gstin"  placeholder="Enter GSTIN Number">
                                        </div>
                                    </div>
                                </div> --}}

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


<script src="http://jqueryvalidation.org/files/dist/jquery.validate.min.js"></script>
<script src="http://jqueryvalidation.org/files/dist/additional-methods.min.js"></script>
  <script src="{{ asset('admin/custom/custom.js')}}"></script>

  <script>

</script>
@endsection

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
                    @include('admin.components.project.project-nav-header' ,['activeTab' => 'list'])
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table " id="project-table">
                                <thead>
                                    <tr>
                                        <th>SL No</th>
                                        <th>Project Name</th>
                                        <th>Short Desciption</th>
                                        <th>Desciption</th>
                                        <th>Project Manager</th>
                                        <th>Project Type</th>
                                        <th>Start Date</th>
                                        <th>Deadline</th>
                                        <th>Project Extimated Cost</th>
                                        <th>Client Name</th>
                                        <th>Added By</th>
                                        <th>Created Date</th>
                                        <th>Project Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script src="{{ asset('admin/plugins/jquery-validation/jquery.validate.min.js')}}"></script>
<script src="{{ asset('admin/custom/custom.js')}}"></script>

@endsection

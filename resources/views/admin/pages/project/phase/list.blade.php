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
                    @include('admin.components.project.phase-nav-header' ,['activeTab' => 'list'])
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table " id="project-phase-table">
                                <thead>
                                    <tr>
                                        <th>SL No</th>
                                        <th>Project Name</th>
                                        <th>Title</th>
                                        <th>Category</th>
                                        <th>Phase Manager</th>
                                        <th>Description</th>
                                        <th>Start Date</th>
                                        <th>Deadline</th>
                                        <th>Phase Extimated Cost</th>
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

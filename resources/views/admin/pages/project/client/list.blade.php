@extends('admin.layouts.app')

@section('content')
@section('page_title', 'Jay Infra Projects | Client')
@section('project_section', 'menu-open')
@section('clients_section', 'active')
@include('admin._partials.bredcum',['title'=>'Client'] )

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    @include('admin.components.project.client-nav-header' ,['activeTab' => 'list'])
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table " id="clients-table">
                                <thead>
                                    <tr>
                                        <th>SL No</th>
                                        <th>Client Name</th>
                                        <th>Business Name</th>
                                        <th>Type</th>
                                        <th>Email</th>
                                        <th>Mobile</th>
                                        <th>Address</th>
                                        <th>City</th>
                                        <th>State</th>
                                        <th>Postcode</th>
                                        <th>Added By</th>
                                        <th>Created Date</th>
                                        <th>Status</th>
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

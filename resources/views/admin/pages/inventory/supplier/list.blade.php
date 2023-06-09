@extends('admin.layouts.app')

@section('content')
@section('page_title', 'Jay Infra Projects | Supplier')
@section('inventory_section', 'menu-open')
@section('suppliers_section', 'active')
@include('admin._partials.bredcum',['title'=>'Supplier'] )

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    @include('admin.components.inventory.supplier-nav-header' ,['activeTab' => 'list'])
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table " id="suppliers-table">
                                <thead>
                                    <tr>
                                        <th>SL No</th>
                                        <th>Contact Name</th>
                                        <th>Business Name</th>
                                        <th>Registration Number</th>
                                        <th>Pan</th>
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

<script src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
<script src="{{ asset('admin/plugins/datatables.net-bs4/dataTables.bootstrap4.js')}}"></script>
<script src="{{ asset('admin/plugins/jquery-validation/jquery.validate.min.js')}}"></script>
<script src="{{ asset('admin/custom/custom.js')}}"></script>

@endsection

@extends('admin.layouts.app')

@section('content')
@section('page_title', 'Jay Infra Projects | Products')
@section('inventory_section', 'menu-open')
@section('products_section', 'active')

@include('admin._partials.bredcum',['title'=>'Products'] )

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    @include('admin.components.inventory.product-nav-header' ,['activeTab' => 'list'])
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table " id="products-table">
                                <thead>
                                    <tr>
                                        <th>SL No</th>
                                        <th>Product Category</th>
                                        <th>Product Name</th>
                                        <th>Brand</th>
                                        <th>Model No</th>
                                        <th>Serial No</th>
                                        <th>Tax Rate</th>
                                        <th>Hsn Code</th>
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

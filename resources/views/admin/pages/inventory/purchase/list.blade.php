@extends('admin.layouts.app')

@section('content')
@section('page_title', 'Jay Infra Projects | Purchase')
@section('inventory_section', 'menu-open')
@section('purchase_section', 'active')

@include('admin._partials.bredcum',['title'=>'Purchase'] )

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    @include('admin.components.inventory.purchase-nav-header' ,['activeTab' => 'list'])
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table " id="purchase-table">
                                <thead>
                                    <tr>
                                        <th>SL No</th>
                                        <th>Supplier Name</th>
                                        <th>Invoice Number</th>
                                        <th>Invoice Date</th>
                                        <th>Payment Mode</th>
                                        <th>Sub Total</th>
                                        <th>Tax Amount</th>
                                        <th>Shipping Charge</th>
                                        <th>Invoice Amount</th>
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

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
                    @include('admin.components.inventory.purchase-nav-header' ,['activeTab' => 'add'])
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

                        <form id="add-purchase-form"  action="{{ route('save-purchases')}}" method="post"  enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12 col-sm-6">

                                    </div>
                                    <div class="col-12 col-sm-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Select Supplier*</label>
                                            <select class="form-control" id="supplier_id" name="supplier_id">
                                                <option value="">select</option>
                                                @foreach ($data['suppliers'] as $supplier)
                                                    <option value="{{$supplier->id}}">{{ $supplier->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 col-sm-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Invoice Number</label>
                                            <input type="text" class="form-control" id="invoice_number" value="{{ old('invoice_number') }}" name="invoice_number" placeholder="Enter invoice number">
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Invoice Date</label>
                                            <input type="date" class="form-control" id="invoice_date" value="{{ old('invoice_date') }}" name="invoice_date" placeholder="Enter invoice date">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 table-responsive">
                                      <table class="table table-striped">
                                        <thead>
                                        <tr>
                                          <th>SN</th>
                                          <th>Product</th>
                                          <th>Qty</th>
                                          <th>Unit</th>

                                          <th>Tax Rate</th>
                                          <th>Unit Price(&#8377;)</th>
                                          <th>Subtotal(&#8377;)</th>
                                          <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody id="item_row">
                                        {{-- <tr id="item_row"> --}}
                                          {{-- <td>1</td>
                                          <td>Call of Duty</td>
                                          <td>455-981-221</td>
                                          <td>El snort testosterone trophy driving gloves handsome</td>
                                          <td>$64.50</td> --}}
                                        {{-- </tr> --}}

                                        <tr>
                                          <td>#</td>
                                            <td>
                                                <select class="form-control" id="input_product_id" name="input_product_id">
                                                    <option>select</option>
                                                    @foreach ($data['products'] as $product)
                                                        <option value="{{$product->id}}">{{ $product->name}}</option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td>
                                                <input type="text" onchange="calculateValueByTextChange()" class="form-control" id="input_quantity" name="input_quantity" placeholder="Enter quantity"></td>
                                            <td>
                                                <select class="form-control" id="input_unit_id" name="input_unit_id">
                                                <option>select</option>
                                                    @foreach ($data['units'] as $unit)
                                                        <option value="{{$unit->id}}">{{ $unit->name}}</option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td>
                                                <select class="form-control" id="input_taxrate_id" name="input_taxrate_id">
                                                <option>select</option>
                                                    @foreach ($data['taxrates'] as $taxrate)
                                                        <option value="{{$taxrate->id}}">{{ $taxrate->name}}</option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td> <input type="text" class="form-control" onchange="calculateValueByTextChange()" id="input_unit_price" name="input_unit_price" placeholder="Enter unit price"></td>
                                            <td> <input type="text" class="form-control" id="input_total_price" name="input_total_price" readonly></td>
                                            <td><button id="addBtn" class="btn btn-success" type="button"> <i class="far fa-plus-square nav-icon"></i></button></ion-icon></td>
                                        </tr>
                                        </tbody>
                                      </table>
                                      <div id="product_error" class="alert alert-danger" style="display:none;">
                                    </div>
                                    </div>
                                    <!-- /.col -->
                                  </div>
                                <hr>
                                  <div class="row">
                                    <!-- accepted payments column -->
                                    <div class="col-6">
                                      <p class="lead">Payment Methods:</p>
                                        <div class="col-12 col-sm-6">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Select Payment method*</label>
                                                <select class="form-control" id="payment_mode" name="payment_mode">
                                                    <option value="">select</option>
                                                    <option value="cash" >Cash</option>
                                                    <option value="cheque" >Cheque</option>
                                                    <option value="online"  >Online</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-12">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Notes</label>
                                                <textarea type="text" class="form-control" rows="4" id="bill_note" name="bill_note"> {{ old('bill_note') }}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.col -->
                                    <div class="col-6">
                                      {{-- <p class="lead">Amount Due 2/22/2014</p> --}}

                                      <div class="table-responsive">
                                        <table class="table">
                                          <tr>
                                            <th style="width:50%">Subtotal (&#8377;):</th>
                                            <td><input type="text" class="form-control" onchange="billAmountFieldChange()" value="0.00" id="amount" name="amount"></td>
                                          </tr>
                                          <tr>
                                            <th>Tax (&#8377;):</th>
                                            <td><input type="text" class="form-control" onchange="billAmountFieldChange()" value="0.00" id="tax_amount" name="tax_amount"></td>
                                          </tr>
                                          <tr>
                                            <th>Shipping (&#8377;):</th>
                                            <td><input type="text" class="form-control" onchange="billAmountFieldChange()" value="0.00" id="shipping_charge" name="shipping_charge"></td>
                                          </tr>
                                          <tr>
                                            <th>Total (&#8377;):</th>
                                            <td><input type="text" class="form-control" value="0.00" id="invoice_amount" name="invoice_amount"></td>
                                          </tr>
                                        </table>
                                      </div>
                                    </div>
                                    <!-- /.col -->
                                  </div>
                            </div>

                            <div class="card-footer">
                              <button type="submit" class="btn btn-success">Submit</button>
                            </div>
                        </form>
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

<script>
    $(document).ready(function() {

        purchaseDatapopulate();

    });
  </script>
@endsection

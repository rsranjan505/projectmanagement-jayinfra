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
                    @include('admin.components.inventory.product-nav-header' ,['activeTab' => 'add'])
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

                        <form id="add-employee-form"  action="{{ route('save-products')}}" method="post"  enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12 col-sm-6">

                                    </div>
                                    <div class="col-12 col-sm-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Select Supplier*</label>
                                            <select class="form-control" id="supplier_id" name="supplier_id">
                                                <option>select</option>
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
                                            <input type="text" class="form-control" id="invoice_number" name="size" placeholder="Enter invoice number">
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Invoice Date</label>
                                            <input type="date" class="form-control" id="invoice_date" name="invoice_date" placeholder="Enter invoice date">
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
                                          <th>Unit Price(&#8377;)</th>
                                          <th>Subtotal(&#8377;)</th>
                                          <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr id="item_row">
                                          {{-- <td>1</td>
                                          <td>Call of Duty</td>
                                          <td>455-981-221</td>
                                          <td>El snort testosterone trophy driving gloves handsome</td>
                                          <td>$64.50</td> --}}
                                        </tr>

                                        <tr>
                                          <td>1</td>
                                            <td>
                                                <select class="form-control" id="supplier_id" name="supplier_id">
                                                    <option>select</option>
                                                    @foreach ($data['products'] as $product)
                                                        <option value="{{$product->id}}">{{ $product->name}}</option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td>
                                                <input type="text" class="form-control" id="qty" name="qty" placeholder="Enter invoice date"></td>
                                            <td>
                                                <select class="form-control" id="supplier_id" name="supplier_id">
                                                <option>select</option>
                                                    @foreach ($data['units'] as $unit)
                                                        <option value="{{$unit->id}}">{{ $unit->name}}</option>
                                                    @endforeach
                                                </select>
                                            </td>
                                          <td>$25.99</td>
                                        </tr>
                                        </tbody>
                                      </table>
                                    </div>
                                    <!-- /.col -->
                                  </div>
                                <hr>
                                  <div class="row">
                                    <!-- accepted payments column -->
                                    <div class="col-6">
                                      <p class="lead">Payment Methods:</p>
                                      {{-- <img src="../../dist/img/credit/visa.png" alt="Visa">
                                      <img src="../../dist/img/credit/mastercard.png" alt="Mastercard">
                                      <img src="../../dist/img/credit/american-express.png" alt="American Express">
                                      <img src="../../dist/img/credit/paypal2.png" alt="Paypal"> --}}

                                      {{-- <p class="text-muted well well-sm shadow-none" style="margin-top: 10px;">
                                        Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles, weebly ning heekya handango imeem
                                        plugg
                                        dopplr jibjab, movity jajah plickers sifteo edmodo ifttt zimbra.
                                      </p> --}}
                                    </div>
                                    <!-- /.col -->
                                    <div class="col-6">
                                      <p class="lead">Amount Due 2/22/2014</p>

                                      <div class="table-responsive">
                                        <table class="table">
                                          <tr>
                                            <th style="width:50%">Subtotal:</th>
                                            <td>$250.30</td>
                                          </tr>
                                          <tr>
                                            <th>Tax (9.3%)</th>
                                            <td>$10.34</td>
                                          </tr>
                                          <tr>
                                            <th>Shipping:</th>
                                            <td>$5.80</td>
                                          </tr>
                                          <tr>
                                            <th>Total:</th>
                                            <td>$265.24</td>
                                          </tr>
                                        </table>
                                      </div>
                                    </div>
                                    <!-- /.col -->
                                  </div>
                                {{-- <div class="row">
                                    <div class="col-12 col-sm-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Product Code </label>
                                            <input type="number" class="form-control" id="code" name="code" placeholder="Enter product code">
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Brand </label>
                                            <select class="form-control" id="brand_id" name="brand_id">
                                                <option>select</option>
                                                @foreach ($data['brand'] as $brand)
                                                    <option value="{{$brand->id}}">{{ $brand->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 col-sm-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Product Size</label>
                                            <input type="text" class="form-control" id="size" name="size" placeholder="Enter Product size">
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Product Colour</label>
                                            <input type="text" class="form-control" id="color" name="color" placeholder="Enter Product color">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-12 col-sm-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Model Number</label>
                                            <input type="text" class="form-control" id="model_no" name="model_no" placeholder="Enter model number">
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Serial Number</label>
                                            <input type="text" class="form-control" id="serial_number" name="serial_number" placeholder="Enter serial number">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-12 col-sm-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Tax Rate</label>
                                            <select class="form-control" id="tax_rate_id" name="tax_rate_id">
                                            <option  value="">select</option>
                                                @foreach ($data['tax_rate'] as $tax_rate)
                                                    <option value="{{$tax_rate->id}}">{{ $tax_rate->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Hsn Code*</label>
                                            <input type="text" class="form-control" id="hsn_code" name="hsn_code" placeholder="Enter Product hsn code">
                                        </div>
                                    </div>
                                </div> --}}

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

  <script src="{{ asset('admin/plugins/jquery-validation/jquery.validate.min.js')}}"></script>
  <script src="{{ asset('admin/custom/custom.js')}}"></script>

  <script>

</script>
@endsection

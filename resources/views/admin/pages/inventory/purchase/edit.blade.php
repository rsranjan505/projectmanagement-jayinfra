@extends('admin.layouts.app')

@section('content')
@section('page_title', 'Jay Infra Projects | Product')
@section('inventory_section', 'menu-open')
@section('products_section', 'active')
@include('admin._partials.bredcum',['title'=>'Product'] )

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    @include('admin.components.inventory.product-nav-header' ,['activeTab' => 'edit'])
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

                        @if (isset($data['product']) && $data['product'] !=null)
                        <form id="add-employee-form"  action="{{ route('update-products')}}" method="post"  enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" class="form-control" id="id" name="id" value="{{$data['product']->id}}">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12 col-sm-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Product Category*</label>
                                            <select class="form-control" id="product_category_id" name="product_category_id">
                                                <option>select</option>
                                                @foreach ($data['category'] as $category)
                                                    <option value="{{$category->id}}" {{$data['product']->product_category_id == $category->id ? 'selected' : ''}}>{{ $category->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Product Name*</label>
                                            <input type="text" class="form-control" id="name" name="name" value="{{$data['product']->name}}" placeholder="Enter product name">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 col-sm-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Product Code </label>
                                            <input type="number" class="form-control" id="code" name="code" value="{{$data['product']->code}}" placeholder="Enter product code">
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Brand </label>
                                            <select class="form-control" id="brand_id" name="brand_id">
                                                <option>select</option>
                                                @foreach ($data['brand'] as $brand)
                                                    <option value="{{$brand->id}}" {{$data['product']->brand_id == $brand->id ? 'selected' : ''}}>{{ $brand->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 col-sm-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Product Size</label>
                                            <input type="text" class="form-control" id="size" name="size" value="{{$data['product']->size}}" placeholder="Enter Product size">
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Product Colour</label>
                                            <input type="text" class="form-control" id="color" name="color" value="{{$data['product']->color}}" placeholder="Enter Product color">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-12 col-sm-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Model Number</label>
                                            <input type="text" class="form-control" id="model_no" name="model_no" value="{{$data['product']->model_no}}" placeholder="Enter model number">
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Serial Number</label>
                                            <input type="text" class="form-control" id="serial_number" name="serial_number" value="{{$data['product']->serial_number}}" placeholder="Enter serial number">
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
                                                    <option value="{{$tax_rate->id}}" {{$data['product']->tax_rate_id == $tax_rate->id ? 'selected' : ''}}>{{ $tax_rate->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Hsn Code*</label>
                                            <input type="text" class="form-control" id="hsn_code" name="hsn_code" value="{{$data['product']->hsn_code}}" placeholder="Enter Product hsn code">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 col-sm-12">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Description</label>
                                            <textarea type="text" class="form-control" rows="4" id="description" name="description" placeholder="Enter description">{{$data['product']->description}}</textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputFile">Upload Product Image</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="avatar" name="avatar">
                                            <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                        </div>
                                        <div class="input-group-append">
                                            <span class="input-group-text">Upload</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card-footer">
                              <button type="submit" class="btn btn-success">Submit</button>
                            </div>
                        </form>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="modal fade" id="add-employee">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Add Employee</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <p>One fine body&hellip;</p>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Save changes</button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>


  <script src="{{ asset('admin/plugins/jquery-validation/jquery.validate.min.js')}}"></script>
  <script src="{{ asset('admin/custom/custom.js')}}"></script>

  <script>

</script>
@endsection

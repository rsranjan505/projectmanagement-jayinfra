@extends('admin.layouts.app')

@section('content')
@section('page_title', 'JayInfra Projects | Supplier')
@section('inventory_section', 'menu-open')
@section('suppliers_section', 'active')
@include('admin._partials.bredcum',['title'=>'Supplier'] )

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    @include('admin.components.inventory.supplier-nav-header' ,['activeTab' => 'edit'])
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

                        @if (isset($data['supplier']) && $data['supplier'] !=null)
                        <form id="add-supplier-form"  action="{{ route('update-suppliers')}}" method="post"  enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" id="id" name="id" value="{{$data['supplier'] !=null ? $data['supplier']->id : ''}}">
                            <div class="card-body">

                                <div class="row">
                                    <div class="col-12 col-sm-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Contact Name*</label>
                                            <input type="text" class="form-control" id="name" name="name" value="{{$data['supplier'] !=null ? $data['supplier']->name : ''}}" placeholder="Enter Contact name">
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Business Name*</label>
                                            <input type="text" class="form-control" id="business_name" name="business_name" value="{{$data['supplier'] !=null ? $data['supplier']->business_name : ''}}" placeholder="Enter Business name">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 col-sm-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Registration Number*</label>
                                            <input type="text" class="form-control" id="registration_number" name="registration_number" value="{{$data['supplier'] !=null ? $data['supplier']->registration_number : ''}}" placeholder="Enter Registration Number">
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Pan Number*</label>
                                            <input type="text" class="form-control" id="pan" name="pan" value="{{$data['supplier'] !=null ? $data['supplier']->pan : ''}}" placeholder="Enter Short name">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 col-sm-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Mobile Numaber*</label>
                                            <input type="number" class="form-control" id="mobile" name="mobile" value="{{$data['supplier'] !=null ? $data['supplier']->mobile : ''}}" placeholder="Enter Mobile Numaber">
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Email address*</label>
                                            <input type="email" class="form-control" id="email" name="email" value="{{$data['supplier'] !=null ? $data['supplier']->email : ''}}" placeholder="Enter email">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-12 col-sm-12">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">GSTIN*</label>
                                            <input type="text" class="form-control" id="gstin" name="gstin" value="{{$data['supplier'] !=null ? ($data['supplier']->gst !=null ? $data['supplier']->gst->gstin : '') : ''}}" placeholder="Enter GSTIN Number">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 col-sm-12">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Address*</label>
                                            <input type="text" class="form-control" id="address" name="address"  value="{{$data['supplier'] !=null ? $data['supplier']->address : ''}}" placeholder="Enter address">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 col-sm-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">State*</label>
                                            <select class="form-control" id="state_id" name="state_id">
                                                <option>select</option>
                                                @foreach ($data['state'] as $state)
                                                    <option value="{{$state->id}}" {{$data['supplier'] !=null ? ($data['supplier']->state_id == $state->id ? 'selected' : '') : '' }}>{{ $state->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">City*</label>
                                            <select class="form-control" id="city_id" name="city_id">
                                                <option>select state first</option>
                                                @foreach ($data['city'] as $city)
                                                    <option value="{{$city->id}}" {{$data['supplier'] !=null ? ($data['supplier']->city_id == $city->id ? 'selected' : '') : '' }}>{{ $city->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 col-sm-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">postcode*</label>
                                            <input type="text" class="form-control" id="postcode" name="postcode" value="{{$data['supplier'] !=null ? $data['supplier']->postcode : ''}}" placeholder="Enter postcode">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-success">Update</button>
                            </div>
                        </form>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

  <script src="{{ asset('admin/plugins/jquery-validation/jquery.validate.min.js')}}"></script>
  {{-- <script src="{{ asset('admin/custom/custom.js')}}"></script> --}}

  <script>

</script>
@endsection

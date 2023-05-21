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
                    @include('admin.components.project.client-nav-header' ,['activeTab' => 'edit'])
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

                        @if (isset($data['client']) && $data['client'] !=null)
                        <form id="add-client-form"  action="{{ route('update-clients')}}" method="post"  enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" id="id" name="id" value="{{$data['client'] !=null ? $data['client']->id : ''}}">
                            <div class="card-body">

                                <div class="row">
                                    <div class="col-12 col-sm-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Client Name*</label>
                                            <input type="text" class="form-control" id="name" name="name" value="{{$data['client'] !=null ? $data['client']->name : ''}}" placeholder="Enter Client name">
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Business Name*</label>
                                            <input type="text" class="form-control" id="business_name" name="business_name" value="{{$data['client'] !=null ? $data['client']->business_name : ''}}" placeholder="Enter Business name">
                                        </div>
                                    </div>
                                </div>
                                {{-- <div class="row">
                                    <div class="col-12 col-sm-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Registration Number*</label>
                                            <input type="text" class="form-control" id="registration_number" name="registration_number" value="{{$data['client'] !=null ? $data['client']->registration_number : ''}}" placeholder="Enter Registration Number">
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Pan Number*</label>
                                            <input type="text" class="form-control" id="pan" name="pan" value="{{$data['client'] !=null ? $data['client']->pan : ''}}" placeholder="Enter Short name">
                                        </div>
                                    </div>
                                </div> --}}
                                <div class="row">
                                    <div class="col-12 col-sm-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Mobile Numaber*</label>
                                            <input type="number" class="form-control" id="mobile" name="mobile" value="{{$data['client'] !=null ? $data['client']->mobile : ''}}" placeholder="Enter Mobile Numaber">
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Email address*</label>
                                            <input type="email" class="form-control" id="email" name="email" value="{{$data['client'] !=null ? $data['client']->email : ''}}" placeholder="Enter email">
                                        </div>
                                    </div>
                                </div>

                                {{-- <div class="row">
                                    <div class="col-12 col-sm-12">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">GSTIN*</label>
                                            <input type="text" class="form-control" id="gstin" name="gstin" value="{{$data['client'] !=null ? ($data['client']->gst !=null ? $data['client']->gst->gstin : '') : ''}}" placeholder="Enter GSTIN Number">
                                        </div>
                                    </div>
                                </div> --}}
                                <div class="row">
                                    <div class="col-12 col-sm-12">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Address*</label>
                                            <input type="text" class="form-control" id="address" name="address"  value="{{$data['client'] !=null ? $data['client']->address : ''}}" placeholder="Enter address">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 col-sm-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Client Type*</label>
                                            <select class="form-control" id="type" name="type">
                                                <option value="">select</option>
                                                <option value="government" {{$data['client'] !=null ? ($data['client']->type == 'government' ? 'selected' : '') : '' }}>government</option>
                                                <option value="private" {{$data['client'] !=null ? ($data['client']->type == 'private' ? 'selected' : '') : '' }}>private</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">State*</label>
                                            <select class="form-control" id="state_id" name="state_id">
                                                <option>select</option>
                                                @foreach ($data['state'] as $state)
                                                    <option value="{{$state->id}}" {{$data['client'] !=null ? ($data['client']->state_id == $state->id ? 'selected' : '') : '' }}>{{ $state->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-12 col-sm-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">City*</label>
                                            <select class="form-control" id="city_id" name="city_id">
                                                <option value="">select state first</option>
                                                {{-- @foreach ($data['city'] as $city)
                                                    <option value="{{$city->id}}" {{$data['client'] !=null ? ($data['client']->city_id == $city->id ? 'selected' : '') : '' }}>{{ $city->name}}</option>
                                                @endforeach --}}
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">postcode*</label>
                                            <input type="text" class="form-control" id="postcode" name="postcode" value="{{$data['client'] !=null ? $data['client']->postcode : ''}}" placeholder="Enter postcode">
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

    <script src="http://jqueryvalidation.org/files/dist/jquery.validate.min.js"></script>
    <script src="http://jqueryvalidation.org/files/dist/additional-methods.min.js"></script>
    <script src="{{ asset('admin/custom/custom.js')}}"></script>

  <script>

</script>
@endsection

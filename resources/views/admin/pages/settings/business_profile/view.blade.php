@extends('admin.layouts.app')

@section('content')

@section('page_title', 'JayInfra Projects | Profile')
@section('setting_section', 'menu-open')
@section('business_profile_section', 'active')

@include('admin._partials.bredcum',['title'=>'Profile'] )

<section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-3">
          <!-- About Me Box -->
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">About Company</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div class="card-body box-profile">
                    <div class="text-center">
                          @if (isset($data['org']) && $data['org']->image !=null)
                              <img class="profile-user-img img-fluid img-circle"
                              src="{{$data['org']->image->url}}"
                              alt="User profile picture">
                          @else
                              <img class="profile-user-img img-fluid img-circle"
                              src="{{asset('admin/images/accounticon.png')}}"
                              alt="User profile picture">
                          @endif
                    </div>
                </div>

                @if (isset($data['org']) && $data['org'] !=null)
                    <div>
                        <strong><i class="fas fa-envelope mr-1"></i> Name</strong>
                        <p class="text-muted">
                          {{$data['org']->name}}
                        </p>
                        <hr>
                        <strong><i class="fas fa-envelope mr-1"></i> Display Name</strong>
                        <p class="text-muted">
                          {{$data['org']->display_name}}
                        </p>
                        <hr>
                        <strong><i class="fas fa-envelope mr-1"></i> Short Name</strong>
                        <p class="text-muted">
                          {{$data['org']->short_name}}
                        </p>
                        <hr>

                        <strong><i class="fas fa-envelope mr-1"></i> Pan Card</strong>
                        <p class="text-muted">
                          {{$data['org']->pan}}
                        </p>
                        <hr>

                        <strong><i class="fas fa-envelope mr-1"></i> Registration Number</strong>
                        <p class="text-muted">
                          {{$data['org']->registration_number}}
                        </p>
                        <hr>

                        <strong><i class="fas fa-envelope mr-1"></i> Email Address</strong>
                        <p class="text-muted">
                          {{$data['org']->email}}
                        </p>
                        <hr>

                        <strong><i class="fas fa-phone mr-1"></i> Mobile Number</strong>
                        <p class="text-muted">
                          {{$data['org']->mobile}}
                        </p>
                        <hr>

                        <strong><i class="fas fa-phone mr-1"></i> Business Type</strong>
                        <p class="text-muted">
                          {{$data['org']->type}}
                        </p>
                        <hr>

                        <strong><i class="fas fa-phone mr-1"></i> Inventory Type</strong>
                        <p class="text-muted">
                          {{$data['org']->inventory_type}}
                        </p>
                        <hr>

                        <strong><i class="fas fa-map-marker-alt mr-1"></i> Location</strong>

                        <p class="text-muted">{{$data['org']->address}}, {{$data['org']->state !=null ? $data['org']->state->name : ''}}, {{$data['org']->city !=null ? $data['org']->city->name : ''}} {{$data['org']->pincode}}</p>

                        <hr>
                    </div>

                @else
                <div class="text-center">
                    <p class="text-muted">Add Company details</p>
                </div>
                @endif

                <hr>

            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
        <div class="col-md-9">
          <div class="card">
            <div class="card-header p-2">
              <ul class="nav nav-pills">
                <li class="nav-item"><a class="nav-link active" href="#profile" data-toggle="tab">Profile</a></li>
              </ul>
            </div><!-- /.card-header -->
            <div class="card-body">
              <div class="tab-content">
                <div class="tab-pane active" id="profile">
                    @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form id="add-employee-form"  action="{{ route('save-organisation')}}" method="post"  enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" id="id" name="id" value="{{$data['org'] !=null ? $data['org']->id : ''}}">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 col-sm-12">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Bisuness Name*</label>
                                        <input type="text" class="form-control" id="name" name="name" value="{{$data['org'] !=null ? $data['org']->name : ''}}" placeholder="Enter Bisuness name">
                                    </div>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-12 col-sm-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Display Name*</label>
                                        <input type="text" class="form-control" id="display_name" name="display_name" value="{{$data['org'] !=null ? $data['org']->display_name : ''}}" placeholder="Enter Display name">
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Short Name*</label>
                                        <input type="text" class="form-control" id="short_name" name="short_name" value="{{$data['org'] !=null ? $data['org']->short_name : ''}}" placeholder="Enter Short name">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 col-sm-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Registration Number*</label>
                                        <input type="text" class="form-control" id="registration_number" name="registration_number" value="{{$data['org'] !=null ? $data['org']->registration_number : ''}}" placeholder="Enter Registration Number">
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Pan Number*</label>
                                        <input type="text" class="form-control" id="pan" name="pan" value="{{$data['org'] !=null ? $data['org']->pan : ''}}" placeholder="Enter Short name">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 col-sm-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Mobile Numaber*</label>
                                        <input type="number" class="form-control" id="mobile" name="mobile" value="{{$data['org'] !=null ? $data['org']->mobile : ''}}" placeholder="Enter Mobile Numaber">
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Email address*</label>
                                        <input type="email" class="form-control" id="email" name="email" value="{{$data['org'] !=null ? $data['org']->email : ''}}" placeholder="Enter email">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 col-sm-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Business Type*</label>
                                        <select class="form-control"  id="type" name="type">
                                            <option  value="">select</option>
                                            <option value="1" {{ $data['org'] !=null ?( $data['org']->type == 1 ? 'selected' : '') : '' }}>Individual</option>
                                            <option value="2" {{ $data['org'] !=null ? ($data['org']->type == 2 ? 'selected' : '') : '' }}>LLP</option>
                                            <option value="3" {{ $data['org'] !=null ? ($data['org']->type == 3 ? 'selected' : '') : '' }}>OPC</option>
                                            <option value="4" {{ $data['org'] !=null ? ($data['org']->type == 4 ? 'selected' : '') : '' }}>Propietorship</option>
                                            <option value="5" {{ $data['org'] !=null ? ($data['org']->type == 5 ? 'selected' : '') : '' }}>Partnership</option>
                                            <option value="6" {{ $data['org'] !=null ? ($data['org']->type == 6 ? 'selected' : '') : '' }}>Pvt. Ltd.</option>
                                            <option value="7" {{ $data['org'] !=null ?( $data['org']->type == 7 ? 'selected' : '') : '' }}>Ltd.</option>
                                            <option value="8" {{ $data['org'] !=null ? ($data['org']->type == 8 ? 'selected' : '') : '' }}>Other</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Inventory Type</label>
                                        <select class="form-control" id="inventory_type" name="inventory_type">
                                            <option  value="">select</option>
                                            <option value="service"  {{$data['org'] !=null ? ($data['org']->inventory_type == 'service' ? 'selected' : '') : '' }}>Service</option>
                                            <option value="product"  {{$data['org'] !=null ? ($data['org']->inventory_type == 'product' ? 'selected' : '') : '' }}>Product</option>
                                            <option value="both"  {{$data['org'] !=null ? ($data['org']->inventory_type == 'both' ? 'selected' : '') : '' }}>Both</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 col-sm-12">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">GSTIN*</label>
                                        <input type="text" class="form-control" id="gstin" name="gstin" value="{{$data['org'] !=null ? ($data['org']->gst !=null ? $data['org']->gst->gstin : '') : ''}}" placeholder="Enter GSTIN Number">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 col-sm-12">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Address*</label>
                                        <input type="text" class="form-control" id="address" name="address" value="{{$data['org'] !=null ? $data['org']->address : ''}}" placeholder="Enter address">
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
                                                <option value="{{$state->id}}" {{$data['org'] !=null ? ($data['org']->state_id == $state->id ? 'selected' : '') : '' }}>{{ $state->name}}</option>
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
                                                <option value="{{$city->id}}" {{$data['org'] !=null ? ($data['org']->city_id == $city->id ? 'selected' : '') : '' }}>{{ $city->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 col-sm-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">postcode*</label>
                                        <input type="text" class="form-control" id="postcode" name="postcode" value="{{$data['org'] !=null ? $data['org']->postcode : ''}}" placeholder="Enter postcode">
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <div class="form-group">
                                        <label for="exampleInputFile">Upload Logo</label>
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
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>
@endsection

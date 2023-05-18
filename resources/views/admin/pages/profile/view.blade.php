@extends('admin.layouts.app')

@section('content')

@section('page_title', 'Jay Infra Projects | Profile')
@section('profile_section', 'menu-open')

@include('admin._partials.bredcum',['title'=>'Profile'] )

<section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-3">

          <!-- Profile Image -->
          <div class="card card-primary card-outline">
            <div class="card-body box-profile">
              <div class="text-center">
                @if ($data['employee']->image !=null)
                    <img class="profile-user-img img-fluid img-circle"
                    src="{{$data['employee']->image->url}}"
                    alt="User profile picture">
                @else
                    <img class="profile-user-img img-fluid img-circle"
                     src="{{asset('admin/images/accounticon.png')}}"
                     alt="User profile picture">
                @endif

              </div>

              <h3 class="profile-username text-center">{{$data['employee']->name}}</h3>

              <p class="text-muted text-center">{{$data['employee']->designation !=null ?? $data['employee']->designation->name}}</p>

              <ul class="list-group list-group-unbordered mb-3">

                <li class="list-group-item">
                  <b>Employee Id</b> <a class="float-right">{{$data['employee']->employee_id}}</a>
                </li>
                <li class="list-group-item">
                  <b>Employee Type</b> <a class="float-right">{{$data['employee']->employee_type}}</a>
                </li>
                <li class="list-group-item">
                    <b>Gender</b> <a class="float-right">{{$data['employee']->gender}}</a>
                </li>
              </ul>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->

          <!-- About Me Box -->
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">About Me</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <strong><i class="fas fa-envelope mr-1"></i> Email Address</strong>
              <p class="text-muted">
                {{$data['employee']->email}}
              </p>

              <hr>
              <strong><i class="fas fa-phone mr-1"></i> Phone Number</strong>
              <p class="text-muted">
                {{$data['employee']->mobile}}
              </p>

              <hr>

              <strong><i class="fas fa-map-marker-alt mr-1"></i> Location</strong>

              <p class="text-muted">{{$data['employee']->address}}, {{$data['employee']->state !=null ? $data['employee']->state->name : ''}}, {{$data['employee']->city !=null ? $data['employee']->city->name : ''}} {{$data['employee']->postcode}}</p>

              <hr>

              <strong><i class="fa fa-id-badge mr-1"></i> Role</strong>

              <p class="text-muted">
                {{$data['employee']->role ? $data['employee']->role->name : ''}}
              </p>

              <hr>
              <strong><i class="fa fa-briefcase mr-1"></i> Department</strong>

              <p class="text-muted">
                {{$data['employee']->department !=null ? $data['employee']->department->name : ''}}
              </p>

              <hr>

              <strong><i class="fa fa-users mr-1" aria-hidden="true"></i> Team</strong>

              <p class="text-muted"> {{$data['employee']->team !=null ? $data['employee']->team->name : ''}}</p>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
        <div class="col-md-9">
            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                </ul>
                </div>
            @endif

          <div class="card">
            <div class="card-header p-2">
              <ul class="nav nav-pills">
                <li class="nav-item"><a class="nav-link active" href="#settings" data-toggle="tab">Settings</a></li>
                <li class="nav-item"><a class="nav-link" href="#edit" data-toggle="tab">Edit</a></li>
              </ul>
            </div><!-- /.card-header -->
            <div class="card-body">
              <div class="tab-content">

                <div class="active tab-pane" id="settings">
                  <form class="form-horizontal" method="post" action="{{route('change-password')}}">
                    @csrf
                    <div class="form-group row">
                      <label for="inputName" class="col-sm-3 col-form-label">Current Password</label>
                      <div class="col-sm-7">
                        <input type="password" class="form-control" id="current_password" name="current_password" placeholder="Current Password">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="inputEmail" class="col-sm-3 col-form-label">New Password</label>
                      <div class="col-sm-7">
                        <input type="password" class="form-control" id="new_password" name="new_password" placeholder="New Password">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="inputName2" class="col-sm-3 col-form-label">Confirm New Password</label>
                      <div class="col-sm-7">
                        <input type="password" class="form-control" id="confirm-password" name="confirm-password" placeholder="Confirm Password">
                      </div>
                    </div>

                    <div class="form-group row">
                      <div class="offset-sm-3 col-sm-7">
                        <button type="submit" class="btn btn-success">Update</button>
                      </div>
                    </div>
                  </form>
                </div>
                <div class="tab-pane" id="edit">

                        @if (isset($data['employee']) && $data['employee'] !=null)
                        <form id="add-employee-form"  action="{{ route('update-profile')}}" method="post"  enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" id="id" name="id" value="{{$data['employee']->id}}" >
                            <div class="card-body">
                              <div class="row">
                                  <div class="col-12 col-sm-6">
                                      <div class="form-group">
                                          <label for="exampleInputEmail1">Full Name*</label>
                                          <input type="text" class="form-control" id="name" name="name" value="{{$data['employee']->name}}" placeholder="Enter full name">
                                      </div>
                                  </div>
                                  <div class="col-12 col-sm-6">
                                      <div class="form-group">
                                          <label for="exampleInputEmail1">Email address*</label>
                                          <input type="email" class="form-control" id="email" name="email" value="{{$data['employee']->email}}" placeholder="Enter email">
                                      </div>
                                  </div>
                              </div>
                              <div class="row">
                                  <div class="col-12 col-sm-6">
                                      <div class="form-group">
                                          <label for="exampleInputEmail1">Mobile*</label>
                                          <input type="number" class="form-control" id="mobile" name="mobile" value="{{$data['employee']->mobile}}" placeholder="Enter mobile">
                                      </div>
                                  </div>
                                  <div class="col-12 col-sm-6">
                                      <div class="form-group">
                                          <label for="exampleInputEmail1">Gender*</label>
                                          <select class="form-control" id="gender" name="gender">
                                            <option value="M"  {{$data['employee']->gender == 'M' ? 'selected' : '' }}>Male</option>
                                            <option value="F"  {{$data['employee']->gender == 'F' ? 'selected' : '' }}>Female</option>
                                          </select>
                                      </div>
                                  </div>
                              </div>
                              <div class="row">
                                <div class="col-12 col-sm-12">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Address*</label>
                                        <input type="text" class="form-control" id="address" name="address" value="{{$data['employee']->address}}" placeholder="Enter address">
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
                                                    <option value="{{$state->id}}" {{$data['employee']->state_id == $state->id ? 'selected' : '' }}>{{ $state->name}}</option>
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
                                                    <option value="{{$city->id}}" {{$data['employee']->city_id == $city->id ? 'selected' : '' }}>{{ $city->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                  </div>
                              </div>
                              <div class="row">
                                  <div class="col-12 col-sm-6">
                                      <div class="form-group">
                                          <label for="exampleInputEmail1">Postcode*</label>
                                          <input type="text" class="form-control" id="postcode" name="postcode" value="{{$data['employee']->postcode}}" placeholder="Enter postcode">
                                      </div>
                                  </div>
                                  <div class="col-12 col-sm-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Roles</label>
                                            <select class="form-control" id="role_id" name="role_id">
                                              <option value="">select</option>
                                                @foreach ($data['roles'] as $role)
                                                    <option value="{{$role->id}}"  {{$data['employee']->role_id == $role->id ? 'selected' : '' }}>{{ $role->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                  </div>
                              </div>
                              <div class="row">
                                <div class="col-12 col-sm-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Department</label>
                                        <select class="form-control" id="department_id" name="department_id">
                                          <option  value="">select</option>
                                            @foreach ($data['departments'] as $department)
                                                <option value="{{$department->id}}"  {{$data['employee']->department_id == $department->id ? 'selected' : '' }}>{{ $department->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                </div>
                                <div class="col-12 col-sm-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Designation</label>
                                        <select class="form-control" id="designation_id" name="designation_id">
                                          <option  value="">select</option>
                                            @foreach ($data['designations'] as $designation)
                                                <option value="{{$designation->id}}" {{$data['employee']->designation_id == $designation->id ? 'selected' : '' }}>{{ $designation->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12 col-sm-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Employee Type*</label>
                                        <select class="form-control"  id="employee_type" name="employee_type">
                                            <option  value="">select</option>
                                            <option value="full time" {{$data['employee']->employee_type == 'full time' ? 'selected' : '' }}>full time</option>
                                            <option value="contract" {{$data['employee']->employee_type == 'contract' ? 'selected' : '' }}>contract</option>
                                            <option value="part time" {{$data['employee']->employee_type == 'part time' ? 'selected' : '' }}>part time</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Is Admin</label>
                                        <select class="form-control" id="is_admin" name="is_admin">
                                            <option value="1"  {{$data['employee']->is_admin == '1' ? 'selected' : '' }}>Yes</option>
                                            <option value="0"  {{$data['employee']->is_admin == '0' ? 'selected' : '' }}>No</option>
                                        </select>
                                    </div>
                                </div>
                            </div>


                            <div class="form-group">
                                <label for="exampleInputFile">Upload Image</label>
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
                              <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </form>
                        @endif
                </div>
                  <!-- /.tab-pane -->
                <!-- /.tab-pane -->
              </div>
              <!-- /.tab-content -->
            </div><!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </div><!-- /.container-fluid -->
  </section>
@endsection

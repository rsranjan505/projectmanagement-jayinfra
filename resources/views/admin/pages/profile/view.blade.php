@extends('admin.layouts.app')

@section('content')

@section('page_title', 'JayInfra Projects | Profile')
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
                @if ($user->image !=null)
                    <img class="profile-user-img img-fluid img-circle"
                    src="{{$user->image->url}}"
                    alt="User profile picture">
                @else
                    <img class="profile-user-img img-fluid img-circle"
                     src="{{asset('admin/images/accounticon.png')}}"
                     alt="User profile picture">
                @endif
                <a href="#"><i class="fa fa-pencil mr-1"></i> Edit</a>

              </div>

              <h3 class="profile-username text-center">{{$user->name}}</h3>

              <p class="text-muted text-center">{{$user->designation !=null ?? $user->designation->name}}</p>

              <ul class="list-group list-group-unbordered mb-3">

                <li class="list-group-item">
                  <b>Employee Id</b> <a class="float-right">{{$user->employee_id}}</a>
                </li>
                <li class="list-group-item">
                  <b>Employee Type</b> <a class="float-right">{{$user->employee_type}}</a>
                </li>
                <li class="list-group-item">
                    <b>Gender</b> <a class="float-right">{{$user->gender}}</a>
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
                {{$user->email}}
              </p>

              <hr>
              <strong><i class="fas fa-phone mr-1"></i> Phone Number</strong>
              <p class="text-muted">
                {{$user->mobile}}
              </p>

              <hr>

              <strong><i class="fas fa-map-marker-alt mr-1"></i> Location</strong>

              <p class="text-muted">{{$user->address}}, {{$user->state !=null ? $user->state->name : ''}}, {{$user->city !=null ? $user->city->name : ''}} {{$user->postcode}}</p>

              <hr>

              <strong><i class="fa fa-id-badge mr-1"></i> Role</strong>

              <p class="text-muted">
                {{$user->role ? $user->role->name : ''}}
              </p>

              <hr>
              <strong><i class="fa fa-briefcase mr-1"></i> Department</strong>

              <p class="text-muted">
                {{$user->department !=null ? $user->department->name : ''}}
              </p>

              <hr>

              <strong><i class="fa fa-users mr-1" aria-hidden="true"></i> Team</strong>

              <p class="text-muted"> {{$user->team !=null ? $user->team->name : ''}}</p>
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
                    <!-- The timeline -->
                    <div class="timeline timeline-inverse">


                    </div>
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

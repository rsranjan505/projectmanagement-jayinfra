@extends('admin.layouts.app')

@section('content')
@include('admin._partials.bredcum',['title'=>'Employee'] )

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header p-2">
                        <div class="row">
                            <ul class="nav nav-pills">
                                <li class="nav-item"><a class="nav-link active" href="#activity" data-toggle="tab">List</a></li>
                                <li class="nav-item"><a class="nav-link" href="#timeline" data-toggle="tab">View</a></li>
                                <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">Edit</a></li>
                            </ul>
                            <div class="input-group-append" style="margin-right: 0%; margin-left:auto;">
                                <button type="submit" class="btn btn-dark" data-toggle="modal" data-target="#add-employee">Add New Employee</button>
                            </div>
                        </div>
                    </div><!-- /.card-header -->
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
                        <form id="add-employee-form"  action="{{ route('save-user')}}" method="post">
                            @csrf
                            <div class="card-body">
                              <div class="row">
                                  <div class="col-12 col-sm-6">
                                      <div class="form-group">
                                          <label for="exampleInputEmail1">Full Name*</label>
                                          <input type="text" class="form-control" id="name" name="name" placeholder="Enter full name">
                                      </div>
                                  </div>
                                  <div class="col-12 col-sm-6">
                                      <div class="form-group">
                                          <label for="exampleInputEmail1">Email address*</label>
                                          <input type="email" class="form-control" id="email" name="email" placeholder="Enter email">
                                      </div>
                                  </div>
                              </div>
                              <div class="row">
                                  <div class="col-12 col-sm-6">
                                      <div class="form-group">
                                          <label for="exampleInputEmail1">Mobile*</label>
                                          <input type="number" class="form-control" id="mobile" name="mobile" placeholder="Enter mobile">
                                      </div>
                                  </div>
                                  <div class="col-12 col-sm-6">
                                      <div class="form-group">
                                          <label for="exampleInputEmail1">Address*</label>
                                          <input type="text" class="form-control" id="address" name="address" placeholder="Enter address">
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
                                                    <option value="{{$state->id}}">{{ $state->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                  </div>
                                  <div class="col-12 col-sm-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">City*</label>
                                            <select class="form-control" id="city_id" name="city_id">
                                            <option>select state first</option>
                                            </select>
                                        </div>
                                  </div>
                              </div>
                              <div class="row">
                                  <div class="col-12 col-sm-6">
                                      <div class="form-group">
                                          <label for="exampleInputEmail1">Pincode*</label>
                                          <input type="text" class="form-control" id="pincode" name="pincode" placeholder="Enter pincode">
                                      </div>
                                  </div>
                                  <div class="col-12 col-sm-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Roles</label>
                                            <select class="form-control" id="role_id" name="role_id">
                                              <option>select</option>
                                                @foreach ($data['roles'] as $role)
                                                    <option value="{{$role->id}}">{{ $role->name}}</option>
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
                                          <option>select</option>
                                            @foreach ($data['departments'] as $department)
                                                <option value="{{$department->id}}">{{ $department->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                </div>
                                <div class="col-12 col-sm-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Designation</label>
                                        <select class="form-control" id="designation_id" name="designation_id">
                                          <option>select</option>
                                            @foreach ($data['designations'] as $designation)
                                                <option value="{{$designation->id}}">{{ $designation->name}}</option>
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
                                            <option>select</option>
                                            <option value="full time">full time</option>
                                            <option value="contract">contract</option>
                                            <option value="part time">part time</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Is Active</label>
                                        <select class="form-control" id="is_active" name="is_active">
                                            <option>select</option>
                                            <option value="1">Active</option>
                                            <option value="0">In active</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12 col-sm-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Password*</label>
                                        <input type="password" class="form-control" id="password" name="password" placeholder="Enter password">
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Confirm Password*</label>
                                        <input type="password" class="form-control" id="confirm-password" name="confirm-password" placeholder="Enter confirm password">
                                    </div>
                                </div>
                            </div>


                            <div class="form-group">
                                <label for="exampleInputFile">Upload Image</label>
                                <div class="input-group">
                                    <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="exampleInputFile">
                                    <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                    </div>
                                    <div class="input-group-append">
                                    <span class="input-group-text">Upload</span>
                                    </div>
                                </div>
                            </div>

                            </div>

                            <div class="card-footer">
                              <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<button type="button" class="btn btn-success swalDefaultSuccess">
    Launch Success Toast
  </button>

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
  <script src="{{ asset('admin/plugins/jquery-validation/additional-methods.min.js')}}"></script>
  <script src="{{ asset('admin/custom/custom.js')}}"></script>

  <script>
    $('#state_id').on('change', function () {
        let state_id = this.value;
        $.ajax({
            url: "/city/"+state_id,
            type: "get",

            success: function (res) {
                console.log(res);
                let html = "";
                html += '<select id="city_id" type="text" name="city_id" search class="form-control">';
                res.data.forEach((val, key) => {
                    html += "<option value=" + val.id + ">" + val.name + "</option>";
                });
                html += '</select>';
                $("#city_id").html("");
                $("#city_id").html(html);
            },
        });
    });
</script>
@endsection

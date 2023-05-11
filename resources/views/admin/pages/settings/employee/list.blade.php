@extends('admin.layouts.app')

@section('content')
@section('page_title', 'JayInfra Projects | Employee')
@section('setting_section', 'menu-open')
@section('employee_section', 'active')

@include('admin._partials.bredcum',['title'=>'Employee'] )

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    @include('admin.components.employee-nav-header' ,['activeTab' => 'list'])
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table " id="user-table">
                                <thead>
                                    <tr>
                                        <th>SL No</th>
                                        <th>Full Name</th>
                                        <th>Email</th>
                                        <th>Mobile</th>
                                        <th>Gender</th>
                                        <th>User Type</th>
                                        <th>Address</th>
                                        <th>City</th>
                                        <th>State</th>
                                        <th>Pincode</th>
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

  {{-- <script src="{{ asset('admin/custom/custom.js')}}"></script> --}}

  <script type="text/javascript">
    $(function () {

      var table = $('#user-table').DataTable({
          processing: true,
          serverSide: true,
          ajax: "{{ route('user-list') }}",
          columns: [
            {
                data: "DT_RowIndex",
                name: "SL No",
                className: "text-center",
                orderable: false,
                searchable: false,
            },
              {data: 'Full Name', name: 'Full Name'},
              {data: 'Email', name: 'Email'},
              {data: 'Mobile', name: 'Mobile'},
              {data: 'Gender', name: 'Gender'},
              {data: 'User Type', name: 'User Type'},
              {data: 'Address', name: 'Address'},
              {data: 'City', name: 'City'},
              {data: 'State', name: 'State'},
              {data: 'Pincode', name: 'Pincode'},
              {data: 'Created Date', name: 'Created Date'},
              {data: 'Status', name: 'Status'},
              {data: 'action', name: 'action', orderable: false, searchable: false},
          ]
      });

    });
  </script>
@endsection

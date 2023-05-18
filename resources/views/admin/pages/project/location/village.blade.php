@extends('admin.layouts.app')

@section('content')
@section('page_title', 'Jay Infra Projects | Village')
@section('project_section', 'menu-open')
@section('project_location_section', 'menu-open')
@section('villages_section', 'active')
@include('admin._partials.bredcum',['title'=>'Village'] )

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    @include('admin.components.project.location.village-nav-header' ,['activeTab' => 'list'])
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table " id="village-table">
                                <thead>
                                    <tr>
                                        <th>SL No</th>
                                        <th>District Name</th>
                                        <th>Block Name</th>
                                        <th>Panchayat Name</th>
                                        <th>Village Name</th>
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

<div class="modal fade" id="add-village" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Add village</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body" >
            <form id="add-village-form"  action="{{ route('save-villages')}}" method="post"  enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Select panchayat</label>
                                <select class="form-control  @error('panchayat_id') is-invalid @enderror" id="panchayat_id" name="panchayat_id">
                                    <option value="">Select panchayat</option>
                                    @foreach ($panchayats as $panchayat)
                                        <option value="{{$panchayat->id}}">{{$panchayat->name}}</option>
                                    @endforeach

                                </select>
                            </div>
                            @error('panchayat_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Name*</label>
                                <input type="text" class="form-control  @error('name') is-invalid @enderror" id="name" name="name" placeholder="Enter name">
                            </div>
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        {{-- <div class="col-12">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Is Active</label>
                                <select class="form-control" id="is_active" name="is_active">
                                    <option value="1">Yes</option>
                                    <option value="0">No</option>
                                </select>
                            </div>
                        </div> --}}
                    </div>
                </div>
                <div class="card-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          {{-- <button type="button" class="btn btn-primary">Save changes</button> --}}
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<div class="modal fade" id="edit-village" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Add village</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form id="edit-village-form"  action="{{ route('save-villages')}}" method="post"  enctype="multipart/form-data">
                @csrf
                <div class="card-body" id="getvillage">

                </div>
                <div class="card-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
</div>

<script src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
<script src="{{ asset('admin/plugins/datatables.net-bs4/dataTables.bootstrap4.js')}}"></script>
<script src="{{ asset('admin/plugins/jquery-validation/jquery.validate.min.js')}}"></script>
<script src="{{ asset('admin/custom/custom.js')}}"></script>

<script>

     function editModel(id){
        var url = "villages/edit/" + id;
            var modelHtml = "";
            $("#edit-village").modal('show');

            $.ajax({
                url: url,
                type: "get",
                success: function (res) {

                    let html = '<div class="row"><input type="hidden" class="form-control" id="id" name="id" value="'+res.data.id+'"><div class="col-12"><div class="form-group"><label for="exampleInputEmail1">State Name*</label><select class="form-control" id="panchayat_id" name="panchayat_id"><option value="'+res.data.panchayat.id+'">'+res.data.panchayat.name+'</option></select></div></div><div class="col-12"><div class="form-group"><label for="exampleInputEmail1">Name*</label><input type="text" class="form-control" id="name" name="name" value="'+res.data.name+'"></div></div></div>';

                    $("#getvillage").html("");
                    $("#getvillage").html(html);
                },
            });

        }
</script>

@endsection

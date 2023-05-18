@extends('admin.layouts.app')

@section('content')
@section('page_title', 'Jay Infra Projects | TaxRate')
@section('setting_section', 'menu-open')
@section('products_settings_section', 'menu-open')
@section('taxrates_section', 'active')
@include('admin._partials.bredcum',['title'=>'TaxRate'] )

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    @include('admin.components.settings.taxrate-nav-header' ,['activeTab' => 'list'])
                    <div class="card-body">
                        <div class="table table-responsive">
                            <table class="table" id="taxrates-table">
                                <thead>
                                    <tr>
                                        <th>SL No</th>
                                        <th>Name</th>
                                        <th>Value</th>
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

<div class="modal fade" id="add-taxrates" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Add taxrates</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body" >
            <form id="add-taxrates-form"  action="{{ route('save-taxrates')}}" method="post"  enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Name*</label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="Enter name">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Value*</label>
                                <input type="text" class="form-control" id="sku" name="sku" placeholder="Enter short name">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Is Active</label>
                                <select class="form-control" id="is_active" name="is_active">
                                    <option value="1">Yes</option>
                                    <option value="0">No</option>
                                </select>
                            </div>
                        </div>
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

<div class="modal fade" id="edit-taxrates" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Add taxrates</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form id="edit-taxrates-form"  action="{{ route('save-taxrates')}}" method="post"  enctype="multipart/form-data">
                @csrf
                <div class="card-body" id="gettaxrates">

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
        var url = "taxrates/edit/" + id;
            var modelHtml = "";
            $("#edit-taxrates").modal('show');

            $.ajax({
                url: url,
                type: "get",
                success: function (res) {

                    let html = '<div class="row"><input type="hidden" class="form-control" id="id" name="id" value="'+res.data.id+'"><div class="col-12"><div class="form-group"><label for="exampleInputEmail1">Name*</label><input type="text" class="form-control" id="name" name="name" value="'+res.data.name+'"></div></div><div class="col-12"><div class="form-group"> <label for="exampleInputEmail1">Value*</label><input type="text" class="form-control" id="sku" name="sku" value="'+res.data.sku+'"></div></div><div class="col-12"><div class="form-group"><label for="exampleInputEmail1">Is Active</label> <select class="form-control" id="is_active" name="is_active"><option value="1">Yes</option><option value="0">No</option></select></div></div></div>';

                    $("#gettaxrates").html("");
                    $("#gettaxrates").html(html);
                },
            });

        }
</script>

@endsection

@extends('admin.layouts.app')

@section('content')
@section('page_title', 'Jay Infra Projects | Purchase Items')
@section('inventory_section', 'menu-open')
@section('purchase_section', 'active')

@include('admin._partials.bredcum',['title'=>'Purchase Items'] )

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    {{-- @include('admin.components.inventory.item-nav-header' ,['activeTab' => 'list']) --}}
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table " id="purchase-items-table">
                                <thead>
                                    <tr>
                                        <th>SL No</th>
                                        <th>Product Name</th>
                                        <th>Type</th>
                                        <th>Quantity</th>
                                        <th>Unit</th>
                                        <th>Tax Rate</th>
                                        <th>Unit Amount</th>
                                        <th>Total Amount</th>
                                        <th>Tax Amount</th>
                                        <th>Net Amount</th>
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

    <div class="modal fade" id="edit-items" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Edit purchase items</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <form id="edit-items-form"  action="{{ route('purchase-items-update')}}" method="post" >
                    @csrf
                    <div class="card-body" id="getItems">

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

</section>
    <script src="{{ asset('admin/plugins/jquery-validation/jquery.validate.min.js')}}"></script>
    <script src="{{ asset('admin/custom/custom.js')}}"></script>


    <script>

        itemlist("{{$productId}}");

        function editModel(id){

        var url = "../items-edit/" + id;
            var modelHtml = "";
            $("#edit-items").modal('show');

            $.ajax({
                url: url,
                type: "get",
                success: function (res) {
                    console.log(res.data);
                    let html = '<div class="row"><input type="hidden" class="form-control" id="id" name="id" value="'+res.data.id+'"><div class="col-12"><div class="form-group"><label for="exampleInputEmail1">Name*</label><input type="text" class="form-control" id="name" name="name" value="'+res.data.name+'"></div></div><div class="col-12"><div class="form-group"><label for="exampleInputEmail1">Is Active</label> <select class="form-control" id="is_active" name="is_active"><option value="1">Yes</option><option value="0">No</option></select></div></div></div>';

                    $("#getItems").html("");
                    $("#getItems").html(html);
                },
            });

        }

    </script>

@endsection

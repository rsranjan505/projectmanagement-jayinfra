@extends('admin.layouts.app')

@section('content')
@section('page_title', 'Jay Infra Projects | Expense')
@section('expenses_section', 'menu-open')
@section('expenses_sub_section', 'active')
@include('admin._partials.bredcum',['title'=>'Expense'] )

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    @include('admin.components.expense-nav-header' ,['activeTab' => 'list'])
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table " id="expense-table">
                                <thead>
                                    <tr>
                                        <th>SL No</th>
                                        <th>Expense Type</th>
                                        <th>Status</th>

                                        <th>Amount</th>
                                        <th>Description</th>

                                        <th>Added By</th>
                                        <th>Created Date</th>

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

<div class="modal fade" id="status-update-expense" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Approval/Rejection</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            {{-- <form id="edit-category-form"  action="{{ route('update-expenses')}}" method="post"  enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <input type="text" class="form-control" id="id" name="id" value="'+id+'">
                    <div class="row">
                        <div class="col-12 col-sm-12">
                            <div class="form-group">
                                <select class="form-control" id="status" name="status">
                                    <option value="">Select Type</option>
                                    <option value="approved">Approved</option>
                                    <option value="reject">Reject</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-12 col-sm-12 reason" style="display:none">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Reason*</label>
                                <textarea type="text" class="form-control" rows="3" id="reason" name="reason" placeholder="Enter reason"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form> --}}
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
</div>

<div class="modal fade" id="expense-view" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Expense</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">

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

    function updateStatus(id){
        // var url = "/expenses/change-status/" + id;

            $('.modal-body').html(' <form id="edit-expense-form"  action="{{ route('expenses-status-change')}}" method="post">@csrf<div class="card-body"><input type="hidden" class="form-control" id="id" name="id" value="'+id+'"> <div class="row"><div class="col-12 col-sm-12"><div class="form-group"> <select class="form-control" id="status" name="status" onchange="statusChange()"><option value="">Select Type</option><option value="approved">Approved</option><option value="reject">Reject</option></select></div></div> <div class="col-12 col-sm-12 reason" style="display:none"><div class="form-group"><label for="exampleInputEmail1">Reason*</label><textarea type="text" class="form-control" rows="3" id="cancel_reason" name="cancel_reason" placeholder="Enter reason"></textarea></div></div></div></div><div class="card-footer"><button type="submit" class="btn btn-primary">Submit</button></div></form>');

            $("#status-update-expense").modal('show');

    }

    function statusChange(){

        let status = $('#status').val();
        if(status == 'reject'){
            $('.reason').attr('style','display:solid;');
        }else{
            $('.reason').attr('style','display:none;');
        }
    }

    function expenseView(id){

    var url = "/expenses/show/" + id;

        $.ajax({
            url: url,
            type: "get",
            success: function (res) {
                console.log(res.data);
                var check = 'No Check';
                var cancel_reason = '';
                var date = '';
                if(res.data.checked_by != null){
                    check = res.data.checkedby.name;
                    date =  res.data.date;
                }
                if(res.data.cancel_reason != null){
                    cancel_reason = res.data.checkedby.name;
                }


                $('.modal-body').html(' <form id="edit-expense-form" method="post">@csrf<div class="card-body"><input type="hidden" class="form-control" id="id" name="id" value="'+id+'"> <div class="row"><div class="col-12 col-sm-6"><div class="form-group"><label for="exampleInputEmail1">Checked By</label> <select class="form-control" id="checked_by" name="checked_by" readonly><option  value="'+res.data.checked_by+'">'+check+'</option></select></div></div><div class="col-6"><div class="form-group"><label for="exampleInputEmail1">Checked Date*</label><input type="text" class="form-control" id="date" name="date" value="'+date+'" readonly></div></div></div> <div class="row"><div class="col-12 col-sm-12"><div class="form-group"><label for="exampleInputEmail1">Expense Type*</label> <select class="form-control" id="expanse_type_id" name="expanse_type_id" readonly><option  value="'+res.data.expanse_type_id+'">'+res.data.expanse_type.name+'</option></select></div></div><div class="col-12 col-sm-12"><div class="form-group"><label for="exampleInputEmail1">Expense Status*</label> <select class="form-control" id="status" name="status" readonly><option  value="'+res.data.status+'">'+res.data.status+'</option></select></div></div> <div class="col-12"><div class="form-group"><label for="exampleInputEmail1">Amount*</label><input type="text" class="form-control" id="amount" name="amount" value="'+res.data.amount+'" readonly></div></div><div class="col-12 col-sm-12 reason"><div class="form-group"><label for="exampleInputEmail1">Reason*</label><textarea type="text" class="form-control" rows="3" id="cancel_reason" name="cancel_reason" readonly placeholder="Enter reason">'+cancel_reason+'</textarea></div></div></div></div></form>');

                $("#expense-view").modal('show');

            },
        });

    }

</script>

@endsection

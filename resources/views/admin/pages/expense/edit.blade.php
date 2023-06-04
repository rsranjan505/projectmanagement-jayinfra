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
                    @include('admin.components.expense-nav-header' ,['activeTab' => 'edit'])
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

                        @if (isset($data['expense']) && $data['expense'] !=null)
                        <form id="edit-expense-form"  action="{{ route('update-expenses')}}" method="post"  enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <input type="hidden" class="custom-file-input" id="id" name="id" value="{{$data['expense']->id}}">
                                <div class="row">
                                    <div class="col-12 col-sm-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Expense Type*</label>
                                            <select class="form-control" id="expanse_type_id" name="expanse_type_id">
                                                <option>Select Type</option>
                                                @foreach ($data['expenseTypes'] as $type)
                                                    <option value="{{$type->id}}" {{ $data['expense']->expanse_type_id== $type->id ? 'selected' : '' }}>{{ $type->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Amount(&#8377;)*</label>
                                            <input type="text" class="form-control"  value="{{$data['expense']->amount}}" id="amount" name="amount" placeholder="Enter amount (&#8377;)">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-12 col-sm-12">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Description*</label>
                                            <textarea type="text" class="form-control" rows="4" id="description" name="description" placeholder="Enter description">{{$data['expense']->description}}</textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputFile">Upload receipt</label>
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
                              <button type="submit" class="btn btn-success">Submit</button>
                            </div>
                        </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>



  <script src="{{ asset('admin/plugins/jquery-validation/jquery.validate.min.js')}}"></script>
  <script src="{{ asset('admin/custom/custom.js')}}"></script>


@endsection

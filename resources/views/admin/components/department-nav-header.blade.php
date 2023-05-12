<div class="card-header p-2">
    <div class="row">
        <ul class="nav nav-pills">
            <li class="nav-item"><a class="nav-link {{ $activeTab == 'list' ? 'active' :'' }} " href="{{ route('departments-list')}}" >List</a></li>
            {{-- <li class="nav-item"><a class="nav-link {{  $activeTab == 'add' ? 'active' :'' }}" href="{{ route('create-user')}}" >Add</a></li> --}}
            @if (  $activeTab == 'edit')
                <li class="nav-item"><a class="nav-link {{  $activeTab == 'edit' ? 'active' :'' }}" href="{{ route('departments-list')}}"> Edit</a></li>
            @endif

        </ul>

        @if (Request::is('departments'))
            <div class="input-group-append" style="margin-right: 0%; margin-left:auto;">
                <button type="submit" class="btn btn-dark" data-toggle="modal" data-target="#add-departments">Add New department</button>
            </div>
        @endif

    </div>
</div><!-- /.card-header -->

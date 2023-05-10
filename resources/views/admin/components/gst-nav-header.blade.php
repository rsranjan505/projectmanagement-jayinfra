<div class="card-header p-2">
    <div class="row">
        <ul class="nav nav-pills">
            <li class="nav-item"><a class="nav-link {{ $activeTab == 'list' ? 'active' :'' }} " href="{{ route('user-list')}}" >List</a></li>
            <li class="nav-item"><a class="nav-link {{  $activeTab == 'add' ? 'active' :'' }}" href="{{ route('create-user')}}" >Add</a></li>
            @if (  $activeTab == 'edit')
                <li class="nav-item"><a class="nav-link {{  $activeTab == 'edit' ? 'active' :'' }}" href="{{ route('user-list')}}"> Edit</a></li>
            @endif

        </ul>

        @if (Request::is('gsts'))
            <div class="input-group-append" style="margin-right: 0%; margin-left:auto;">
                <button type="submit" class="btn btn-dark" data-toggle="modal" data-target="#add-employee">Add New Employee</button>
            </div>
        @endif

    </div>
</div><!-- /.card-header -->

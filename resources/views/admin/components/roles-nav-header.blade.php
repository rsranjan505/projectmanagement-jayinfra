<div class="card-header p-2">
    <div class="row">
        <ul class="nav nav-pills">
            <li class="nav-item"><a class="nav-link {{ $activeTab == 'list' ? 'active' :'' }} " href="{{ route('roles-list')}}" >List</a></li>
            {{-- <li class="nav-item"><a class="nav-link {{  $activeTab == 'add' ? 'active' :'' }}" href="{{ route('create-roles')}}" >Add</a></li> --}}


        </ul>

        @if (Request::is('roles'))
            <div class="input-group-append" style="margin-right: 0%; margin-left:auto;">
                <button type="submit" class="btn btn-dark" data-toggle="modal" data-target="#add-roles">Add New roles</button>
            </div>
        @endif

    </div>
</div><!-- /.card-header -->

<div class="card-header p-2">
    <div class="row">
        <ul class="nav nav-pills">
            <li class="nav-item"><a class="nav-link {{ $activeTab == 'list' ? 'active' :'' }} " href="{{ route('expenses-list')}}" >List</a></li>
            <li class="nav-item"><a class="nav-link {{  $activeTab == 'add' ? 'active' :'' }}" href="{{ route('create-expenses')}}" >Add</a></li>
            @if (  $activeTab == 'edit')
                <li class="nav-item"><a class="nav-link {{  $activeTab == 'edit' ? 'active' :'' }}" href="{{ route('edit-expenses')}}"> Edit</a></li>
            @endif

        </ul>

    </div>
</div><!-- /.card-header -->

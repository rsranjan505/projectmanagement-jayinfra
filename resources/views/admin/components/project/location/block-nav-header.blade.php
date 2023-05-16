<div class="card-header p-2">
    <div class="row">
        <ul class="nav nav-pills">
            <li class="nav-item"><a class="nav-link {{ $activeTab == 'list' ? 'active' :'' }} " href="{{ route('blocks-list')}}" >List</a></li>
        </ul>

        @if (Request::is('project/location/blocks'))
            <div class="input-group-append" style="margin-right: 0%; margin-left:auto;">
                <button type="submit" class="btn btn-dark" data-toggle="modal" data-target="#add-block">Add New block</button>
            </div>
        @endif
    </div>
</div>

<div class="card-header p-2">
    <div class="row">
        <ul class="nav nav-pills">
            <li class="nav-item"><a class="nav-link {{ $activeTab == 'list' ? 'active' :'' }} " href="{{ route('units-list')}}" >List</a></li>
        </ul>

        @if (Request::is('settings/units'))
            <div class="input-group-append" style="margin-right: 0%; margin-left:auto;">
                <button type="submit" class="btn btn-dark" data-toggle="modal" data-target="#add-units">Add New units</button>
            </div>
        @endif

    </div>
</div>

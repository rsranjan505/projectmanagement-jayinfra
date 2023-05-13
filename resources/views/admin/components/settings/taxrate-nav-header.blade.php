<div class="card-header p-2">
    <div class="row">
        <ul class="nav nav-pills">
            <li class="nav-item"><a class="nav-link {{ $activeTab == 'list' ? 'active' :'' }} " href="{{ route('taxrates-list')}}" >List</a></li>
        </ul>

        @if (Request::is('settings/taxrates'))
            <div class="input-group-append" style="margin-right: 0%; margin-left:auto;">
                <button type="submit" class="btn btn-dark" data-toggle="modal" data-target="#add-taxrates">Add New taxrates</button>
            </div>
        @endif

    </div>
</div>

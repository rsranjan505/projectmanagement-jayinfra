<div class="card-header p-2">
    <div class="row">
        <ul class="nav nav-pills">
            <li class="nav-item"><a class="nav-link {{ $activeTab == 'list' ? 'active' :'' }} " href="{{ route('panchayats-list')}}" >List</a></li>
        </ul>

        @if (Request::is('project/location/panchayats'))
            <div class="input-group-append" style="margin-right: 0%; margin-left:auto;">
                <button type="submit" class="btn btn-dark" data-toggle="modal" data-target="#add-panchayat">Add New panchayat</button>
            </div>
        @endif
    </div>
</div>

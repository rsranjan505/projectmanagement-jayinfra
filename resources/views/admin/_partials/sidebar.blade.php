<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="{{ route('dashboard') }}" class="brand-link">
        <img src="{{ asset('admin/images/logo.png') }}"
             alt="Jay Infra"
             class="brand-image img-circle elevation-3">
        <span class="brand-text font-weight-light">Jay Infra</span>
    </a>

    <div class="sidebar">
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                @include('admin._partials.menu')
            </ul>
        </nav>
    </div>

</aside>

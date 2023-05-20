<!-- need to remove -->
<li class="nav-item">
    <a href="{{ route('dashboard') }}" class="nav-link {{ Request::is('dashboard') ? 'active' : '' }}">
        <i class="nav-icon fas fa-home"></i>
        <p>Dashboard</p>
    </a>
</li>
<li class="nav-item @yield('profile_section')">
    <a href="{{ route('profile-view')}}" class="nav-link">
      <i class="nav-icon fa fa-user"></i>
      <p>
        Profile
      </p>
    </a>
</li>
    <li class="nav-item @yield('inventory_section')">
        <a href="#" class="nav-link">
        <i class="nav-icon fas fa-th"></i>
        <p>
            Inventory
            <i class="right fas fa-angle-left"></i>
        </p>
        </a>
        <ul class="nav nav-treeview">
            <li class="nav-item">
                <a href="{{ route('category-list')}}" class="nav-link @yield('category_section')">
                <i class="far fa-circle nav-icon"></i>
                <p>Category</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('products-list')}}" class="nav-link @yield('products_section')">
                <i class="far fa-circle nav-icon"></i>
                <p>Material</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('suppliers-list')}}" class="nav-link @yield('suppliers_section')">
                <i class="far fa-circle nav-icon"></i>
                <p>Suppliers</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('purchases-list')}}" class="nav-link @yield('purchase_section')">
                <i class="far fa-circle nav-icon"></i>
                <p>Purchase</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="pages/charts/inline.html" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Sell</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('stock-list')}}" class="nav-link @yield('stock_section')">
                <i class="far fa-circle nav-icon"></i>
                <p>Stocks</p>
                </a>
            </li>
        </ul>
    </li>

<li class="nav-item @yield('project_section')">
    <a href="#" class="nav-link">
      <i class="nav-icon fas fa-tree"></i>
      <p>
        Project
        <i class="right fas fa-angle-left"></i>
      </p>
    </a>
    <ul class="nav nav-treeview">
      <li class="nav-item">
        <a href="pages/charts/chartjs.html" class="nav-link">
          <i class="far fa-circle nav-icon"></i>
          <p>Clients</p>
        </a>
      </li>
      <li class="nav-item">
        <a href="pages/charts/flot.html" class="nav-link">
          <i class="far fa-circle nav-icon"></i>
          <p>Projects</p>
        </a>
      </li>
      <li class="nav-item">
        <a href="pages/charts/inline.html" class="nav-link">
          <i class="far fa-circle nav-icon"></i>
          <p>Projects Phases</p>
        </a>
      </li>
      <li class="nav-item">
        <a href="pages/charts/uplot.html" class="nav-link">
          <i class="far fa-circle nav-icon"></i>
          <p>Projects Scheme</p>
        </a>
      </li>
      <li class="nav-item  @yield('project_location_section')">
        <a href="#" class="nav-link">
        <i class="nav-icon fa fa-book"></i>
        <p>
            Project Location
            <i class="right fas fa-angle-left"></i>
        </p>
        </a>
        <ul class="nav nav-treeview">
            <li class="nav-item">
                <a href="{{ route('districts-list')}}" class="nav-link @yield('districts_section')">
                <i class="far fa-circle nav-icon"></i>
                <p>
                    Districts
                </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('blocks-list')}}" class="nav-link @yield('blocks_section')">
                <i class="far fa-circle nav-icon"></i>
                <p>
                    Blocks
                </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('panchayats-list')}}" class="nav-link @yield('panchayats_section')">
                <i class="far fa-circle nav-icon"></i>
                <p>
                    Panchayats
                </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('villages-list')}}" class="nav-link @yield('villages_section')">
                <i class="far fa-circle nav-icon"></i>
                <p>
                    Villages
                </p>
                </a>
            </li>
        </ul>
       </li>
    </ul>
</li>

    <li class="nav-item">
        <a href="#" class="nav-link">
        <i class="nav-icon fa fa-book"></i>
        <p>
            Expense
            <i class="right fas fa-angle-left"></i>
        </p>
        </a>
        <ul class="nav nav-treeview">
        <li class="nav-item">
            <a href="pages/charts/chartjs.html" class="nav-link">
            <i class="far fa-circle nav-icon"></i>
            <p>Expenses</p>
            </a>
        </li>
        </ul>
    </li>


    <li class="nav-item @yield('setting_section')">
        <a href="#" class="nav-link">
          <i class="nav-icon fa fa-book"></i>
          <p>
            Settings
            <i class="right fas fa-angle-left"></i>
          </p>
        </a>
        <ul class="nav nav-treeview">
            <li class="nav-item">
                <a href="{{ route('organisation-view')}}" class="nav-link @yield('business_profile_section')">
                  <i class="far fa-user nav-icon"></i>
                  <p>Business Profile</p>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('user-list')}}" class="nav-link @yield('employee_section')">
                <i class="far fa-circle nav-icon"></i>
                <p>
                    Employee
                </p>
                </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('departments-list')}}" class="nav-link @yield('departments_section')">
              <i class="far fa-circle nav-icon"></i>
              <p>
                Departments
              </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('designations-list')}}" class="nav-link @yield('designations_section')">
              <i class="far fa-circle nav-icon"></i>
              <p>
                Designations
              </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('roles-list')}}" class="nav-link @yield('roles_section')">
              <i class="far fa-circle nav-icon"></i>
              <p>
                Roles
              </p>
              </a>
            </li>
            <li class="nav-item  @yield('products_settings_section')">
                <a href="#" class="nav-link">
                <i class="nav-icon fa fa-book"></i>
                <p>
                    Products Settings
                    <i class="right fas fa-angle-left"></i>
                </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{ route('brands-list')}}" class="nav-link @yield('brands_section')">
                        <i class="far fa-circle nav-icon"></i>
                        <p>
                            Brand
                        </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('taxrates-list')}}" class="nav-link @yield('taxrates_section')">
                        <i class="far fa-circle nav-icon"></i>
                        <p>
                            Tax Rate
                        </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('units-list')}}" class="nav-link @yield('units_section')">
                        <i class="far fa-circle nav-icon"></i>
                        <p>
                            Units
                        </p>
                        </a>
                    </li>
                </ul>
            </li>

        </ul>
    </li>




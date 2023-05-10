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
<li class="nav-item">
    <a href="#" class="nav-link">
      <i class="nav-icon fas fa-th"></i>
      <p>
        Inventory
        <i class="right fas fa-angle-left"></i>
      </p>
    </a>
    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a href="pages/charts/chartjs.html" class="nav-link">
              <i class="far fa-circle nav-icon"></i>
              <p>Category</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="pages/charts/chartjs.html" class="nav-link">
            <i class="far fa-circle nav-icon"></i>
            <p>Material</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="pages/charts/flot.html" class="nav-link">
            <i class="far fa-circle nav-icon"></i>
            <p>Suppliers</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="pages/charts/flot.html" class="nav-link">
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
            <a href="pages/charts/uplot.html" class="nav-link">
            <i class="far fa-circle nav-icon"></i>
            <p>Stocks</p>
            </a>
        </li>
    </ul>
</li>
<li class="nav-item">
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
    </ul>
</li>
<li class="nav-item @yield('employee_section')">
    <a href="#" class="nav-link ">
      <i class="nav-icon fas fa-table"></i>
      <p>
        Employee
        <i class="right fas fa-angle-left"></i>
      </p>
    </a>
    <ul class="nav nav-treeview">
      <li class="nav-item">
        <a href="{{ route('user-list')}}" class="nav-link @yield('employee_list_section')">
          <i class="far fa-circle nav-icon"></i>
          <p>List</p>
        </a>
      </li>
      <li class="nav-item">
        <a href="{{ route('create-user')}}" class="nav-link @yield('employee_add_section')">
          <i class="far fa-circle nav-icon"></i>
          <p>Add</p>
        </a>
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


    <li class="nav-item">
        <a href="#" class="nav-link">
          <i class="nav-icon fa fa-book"></i>
          <p>
            Settings
            <i class="right fas fa-angle-left"></i>
          </p>
        </a>
        <ul class="nav nav-treeview">
            <li class="nav-item">
                <a href="pages/charts/inline.html" class="nav-link">
                  <i class="far fa-user nav-icon"></i>
                  <p>Profile</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="pages/charts/inline.html" class="nav-link">
                  <i class="far fa-user nav-icon"></i>
                  <p>Business Profile</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="pages/charts/inline.html" class="nav-link">
                  <i class="far fa-user nav-icon"></i>
                  <p>GSTIN</p>
                </a>
            </li>

          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="far fa-circle nav-icon"></i>
              <p>
                Employee
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-dot-circle nav-icon"></i>
                  <p>View</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="far fa-circle nav-icon"></i>
              <p>
                Departments
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-dot-circle nav-icon"></i>
                  <p>View</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="far fa-circle nav-icon"></i>
              <p>
                Designations
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-dot-circle nav-icon"></i>
                  <p>View</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="far fa-circle nav-icon"></i>
              <p>
                Roles
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-dot-circle nav-icon"></i>
                  <p>View</p>
                </a>
              </li>
            </ul>
          </li>
        </ul>
    </li>




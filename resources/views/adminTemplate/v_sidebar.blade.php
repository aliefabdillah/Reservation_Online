<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="" class="brand-link">
      <img src="{{ asset('template') }}/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Restoran XXX</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{ asset('template') }}/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          @if(\Session::has('nama'))
            @if(\Session::get('nama') == '')
              <a href="#" class="d-block">Admin</a>
            @else
              <a href="#" class="d-block">{{ Session::get('nama') }}</a>
            @endif
          @endif
          
        </div>
      </div>

      <!-- SidebarSearch Form -->
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-item">
            <li class="nav-item">
              <a href="{{ route('showOrder') }}" class="nav-link">
                <i class="nav-icon fas fa-clipboard"></i>
                <p>
                  Order
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('showTmptDuduk') }}" class="nav-link">
                <i class="nav-icon fas fa-chair"></i>
                <p>
                  Tempat Duduk
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('showMakanan') }}" class="nav-link">
                <i class="fas fa-utensils nav-icon"></i>
                <p>Makanan</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('showMinuman') }}" class="nav-link">
                <i class="fas fa-cocktail nav-icon"></i>
                <p>Minuman</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('adminLogout') }}" class="nav-link">
                <i class="nav-icon fas fa-sign-out-alt"></i>
                <p>
                  Log Out
                </p>
              </a>
            </li>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
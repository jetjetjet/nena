<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="{{ url('/') }}" class="brand-link">
    <img src="{{ url('/') }}/dist/img/AdminLTELogo.png" alt="Sentimen Analisis" class="brand-image img-circle elevation-3" style="opacity: .8">
    <span class="brand-text font-weight-light">Sentimen Analisis</span>
  </a>
  <!-- Sidebar -->
  <div class="sidebar">
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <!-- <img src="{{ url('/') }}/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image"> -->
      </div>
       <div class="info">
        <a href="#" class="d-block">Selamat Datang,</a>
        <a href="#" class="d-block"> {{ session('name') }}</a>
      </div>
    </div>
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <li class="nav-item">
          <a href="{{ url('/') }}" class="nav-link">
            <i class="nav-icon fas fa-tachometer-alt"></i><p> Beranda </p>
          </a>
        </li>
        <li class="nav-header">Master</li>
        <li class="nav-item">
          <a href="{{ url('/analytic') }}" class="nav-link">
            <i class="nav-icon fas fa-chart-bar"></i><p> Sentimen </p>
          </a>
        </li>
        @if(session('role') == 'admin')
        <li class="nav-item">
          <a href="{{ url('/tarik-data') }}" class="nav-link">
            <i class="nav-icon fas fa-download"></i><p> Tarik Data </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ url('/user') }}" class="nav-link">
            <i class="nav-icon fas fa-users"></i><p> User </p>
          </a>
        </li>
        @endif
        <li class="nav-item">
          <a href="{{ url('/export/index') }}" class="nav-link">
            <i class="nav-icon fas fa-upload"></i><p> Ekspor Data </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ url('/logout') }}" class="nav-link">
            <i class="nav-icon fa fa-sign-out-alt"></i><p> Logout </p>
          </a>
        </li>
      </ul>
    </nav>
  </div>
</aside>
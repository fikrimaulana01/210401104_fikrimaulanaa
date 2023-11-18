<!-- Sidebar -->
    <ul class="navbar-nav  sidebar sidebar-light accordion" id="accordionSidebar" >
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('dashboard') }}">
        <div class="sidebar-brand-icon">
          <img src="{{ asset('RuangAdmin') }}/img/boy.png">
        </div>
        <div class="sidebar-brand-text mx-3">Fikri Maulana</div>
      </a>
      <hr class="sidebar-divider my-0">
      <li class="nav-item @yield('li-dashboard')">
        <a class="nav-link" href="{{ route('dashboard') }}">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Dashboard</span></a>
      </li>
      <hr class="sidebar-divider">
      <div class="sidebar-heading">
        Menu
      </div>
      <li class="nav-item @yield('li-article')">
        <a class="nav-link" href="{{ route('article') }}">
          <i class="fas fa-fw fa-newspaper"></i>
          <span>Article</span>
        </a>
      </li>
      <li class="nav-item @yield('li-author')">
        <a class="nav-link" href="{{ route('list-author') }}">
          <i class="fas fa-fw fa-user"></i>
          <span>Author</span>
        </a>
      </li>
      <li class="nav-item @yield('li-categories')">
        <a class="nav-link" href="{{ route('list-categories') }}">
          <i class="fas fa-fw fa-tag"></i>
          <span>Categories</span>
        </a>
      </li>
    </ul>
    <!-- Sidebar -->
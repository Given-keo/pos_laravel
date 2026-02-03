 <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="/dashboard" class="brand-link d-flex justify-content-center">
      <span class="brand-text font-weight-light">{{ env("APP_NAME") }}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

          @foreach ($routes as $route)
            @if (!$route["is_dropdown"])
              <li class="nav-item">
                <a href="{{ route($route["route_name"]) }}" class="nav-link {{ request()->routeIs($route["route_active"]) ? "active" : "" }}">
                  <i class="nav-icon {{ $route["icon"] }}"></i>
                  <p>
                    {{ $route["label"] }}
                  </p>
                </a>
              </li>
            @else
              <li class="nav-item {{ request()->routeIs($route["route_active"]) ? "menu-open" : "" }}">
                <a href="#" class="nav-link">
                  <i class="nav-icon {{ $route["icon"] }}"></i>
                  <p>
                    {{ $route["label"] }}
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  @foreach ($route["dropdown"] as $item)
                    <li class="nav-item">
                        <a href="{{ route($item["route_name"]) }}" class="nav-link {{ request()->routeIs($item["route_active"]) ? "active" : "" }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>{{ $item["label"] }}</p>
                        </a>
                    </li>
                  @endforeach
                </ul>
              </li>
            @endif
          @endforeach
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
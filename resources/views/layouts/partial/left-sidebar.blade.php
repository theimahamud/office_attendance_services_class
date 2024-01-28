<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('dashboard') }}" class="brand-link text-decoration-none">
        {{--        @if(\App\Models\Setting::get('site_logo'))--}}
        {{--            <img src="{{asset('/uploads/settings/'.\App\Models\Setting::get('site_logo'))}}" width="90px" alt="">--}}
        {{--        @else--}}
        <img src="{{asset('assets/admin/logo/logo.svg')}}" width="90px" alt="">
        {{--        @endif--}}
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset('assets/admin/dist/img/profile.png') }}" class="img-circle elevation-2" alt="profile">
            </div>
            <div class="info">
                <a href="{{ route('dashboard') }}" class="d-block">{{ $currentUser->name }}</a>
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

                {{-- users section start --}}
                @php
                    $current_route = Illuminate\Support\Facades\Route::currentRouteName();
                    $routes = ['users.index', 'users.create'];
                @endphp

                <li class="nav-item {{ in_array($current_route, $routes) ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ in_array($current_route, $routes) ? 'active' : '' }}">
                        <i class="nav-icon fas fa-user"></i>
                        <p>
                            Users
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        @foreach(['users.index' => 'User List', 'users.create' => 'User Create'] as $route => $label)
                            <li class="nav-item">
                                <a href="{{ route($route) }}" class="nav-link {{ $current_route == $route ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>{{ $label }}</p>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </li>
                {{-- users section end --}}

                <li class="nav-item">
                    <a href="{{ route('departments.index') }}" class="nav-link">
                        <i class="nav-icon ion ion-ios-briefcase"></i>
                        <p>
                            Department
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('designations.index') }}" class="nav-link">
                        <i class="nav-icon ion ion-ios-briefcase"></i>
                        <p>
                            Designation
                        </p>
                    </a>
                </li>
{{--                holiday start section--}}

                @php
                    $current_route = Illuminate\Support\Facades\Route::currentRouteName();
                    $routes = ['holiday.index', 'holiday.create'];
                @endphp

                <li class="nav-item {{ in_array($current_route, $routes) ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ in_array($current_route, $routes) ? 'active' : '' }}">
                        <i class="nav-icon fas fa-snowflake"></i>
                        <p>
                            Holiday
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        @foreach(['holiday.index' => 'Holiday List', 'holiday.create' => 'Holiday Create'] as $route => $label)
                            <li class="nav-item">
                                <a href="{{ route($route) }}" class="nav-link {{ $current_route == $route ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>{{ $label }}</p>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </li>
                {{-- holiday section end --}}
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-cogs"></i>
                        <p>
                            Settings
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>

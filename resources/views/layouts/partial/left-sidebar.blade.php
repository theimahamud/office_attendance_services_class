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
                @if($currentUser->getFirstMediaUrl())
                    <img src="{{ $currentUser->getFirstMediaUrl() }}" class="img-circle elevation-2"
                         alt="profile">
                @else
                    <img src="{{ asset('assets/admin/dist/img/profile.png') }}" class="img-circle elevation-2"
                         alt="profile">
                @endif
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
                @if(auth()->user()->isAdmin())
                    {{-- users section start --}}
                    @php
                        $current_route = Illuminate\Support\Facades\Route::currentRouteName();
                        $routes = ['users.index', 'users.create'];
                    @endphp

                    <li class="nav-item {{ in_array($current_route, $routes) ? 'menu-open' : '' }}">
                        <a href="javascript:void(0)"
                           class="nav-link {{ in_array($current_route, $routes) ? 'active' : '' }}">
                            <i class="nav-icon fas fa-user"></i>
                            <p>
                                Users
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @foreach(['users.index' => 'User List', 'users.create' => 'User Create'] as $route => $label)
                                <li class="nav-item">
                                    <a href="{{ route($route) }}"
                                       class="nav-link {{ $current_route == $route ? 'active' : '' }}">
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
                                <i class="right fas fa-angle-right"></i>
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('designations.index') }}" class="nav-link">
                            <i class="nav-icon ion ion-ios-briefcase"></i>
                            <p>
                                Designation
                                <i class="right fas fa-angle-right"></i>
                            </p>
                        </a>
                    </li>
                    {{--                holiday start section--}}
                    @php
                        $current_route = Illuminate\Support\Facades\Route::currentRouteName();
                        $routes = ['holiday.index', 'holiday.create'];
                    @endphp

                    <li class="nav-item {{ in_array($current_route, $routes) ? 'menu-open' : '' }}">
                        <a href="javascript:void(0)"
                           class="nav-link {{ in_array($current_route, $routes) ? 'active' : '' }}">
                            <i class="nav-icon fas fa-snowflake"></i>
                            <p>
                                Holiday Notice
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @foreach(['holiday.index' => 'Notice List', 'holiday.create' => 'Notice Create'] as $route => $label)
                                <li class="nav-item">
                                    <a href="{{ route($route) }}"
                                       class="nav-link {{ $current_route == $route ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>{{ $label }}</p>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </li>
                    {{-- holiday section end --}}

                    {{-- leave policy start section--}}
                    @php
                        $current_route = Illuminate\Support\Facades\Route::currentRouteName();
                        $routes = ['leave-policy.index', 'leave-policy.create'];
                    @endphp

                    <li class="nav-item {{ in_array($current_route, $routes) ? 'menu-open' : '' }}">
                        <a href="javascript:void(0)"
                           class="nav-link {{ in_array($current_route, $routes) ? 'active' : '' }}">
                            <i class="nav-icon fas fa-calendar-alt"></i>
                            <p>
                                Leave Policy
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @foreach(['leave-policy.index' => 'Leave policy List', 'leave-policy.create' => 'Leave policy Create'] as $route => $label)
                                <li class="nav-item">
                                    <a href="{{ route($route) }}"
                                       class="nav-link {{ $current_route == $route ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>{{ $label }}</p>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </li>
                    {{-- leave policy section end --}}


                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-cogs"></i>
                            <p>
                                Settings
                                <i class="right fas fa-angle-right"></i>
                            </p>
                        </a>
                    </li>
                @endif

                {{-- leave request start section--}}
                @php
                    $current_route = Illuminate\Support\Facades\Route::currentRouteName();
                    $routes = ['leave-request.index', 'leave-request.create','my-leave-request','yearly-leave'];
                @endphp

                <li class="nav-item {{ in_array($current_route, $routes) ? 'menu-open' : '' }}">
                    <a href="javascript:void(0)"
                       class="nav-link {{ in_array($current_route, $routes) ? 'active' : '' }}">
                        <i class="nav-icon fas fa-clock"></i>
                        <p>
                            Leave Request
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        @foreach([
                                auth()->user()->isAdmin() ? 'leave-request.index' : 'my-leave-request' => auth()->user()->isAdmin() ? 'Leave Request List' : 'My Leave Request',
                                'leave-request.create' => 'Leave Request Create'] as $route => $label)
                            <li class="nav-item">
                                <a href="{{ route($route) }}"
                                   class="nav-link {{ $current_route == $route ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>{{ $label }}</p>
                                </a>
                            </li>
                        @endforeach
                        @if(auth()->user()->role === \App\Constants\Role::USER)
                            <li class="nav-item">
                                <a href="{{ route('yearly-leave') }}" class="nav-link {{ $current_route == "yearly-leave" ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>
                                       Yearly Leave
                                    </p>
                                </a>
                            </li>
                        @endif

                    </ul>
                </li>
                {{-- leave request section end --}}


                {{-- attendance start section--}}
                @php
                    $current_route = Illuminate\Support\Facades\Route::currentRouteName();
                    $routes = ['all-attendance', 'my-attendance'];
                @endphp

                <li class="nav-item {{ in_array($current_route, $routes) ? 'menu-open' : '' }}">
                    <a href="javascript:void(0)"
                       class="nav-link {{ in_array($current_route, $routes) ? 'active' : '' }}">
                        <i class="nav-icon fas fa-calendar-check"></i>
                        <p>
                            Attendance
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        @foreach([
                                auth()->user()->isAdmin() ? 'all-attendance' : 'my-attendance' => auth()->user()->isAdmin() ? 'All Attendance' : 'My Attendance'] as $route => $label)
                            <li class="nav-item">
                                <a href="{{ route($route) }}"
                                   class="nav-link {{ $current_route == $route ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>{{ $label }}</p>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </li>

                <li class="nav-item">
                    <a href="{{ route('see-all-notification') }}" class="nav-link">
                        <i class="nav-icon fas fa-envelope"></i>
                        <p>
                            Notifications
                            <i class="right fas fa-angle-right"></i>
                        </p>
                    </a>
                </li>
                {{-- attendance section end --}}
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>

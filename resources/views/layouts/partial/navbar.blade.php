<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="{{ route('dashboard') }}" class="nav-link">Home</a>
        </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <!-- Navbar Search -->
{{--        <li class="nav-item">--}}
{{--            <a class="nav-link" data-widget="navbar-search" href="#" role="button">--}}
{{--                <i class="fas fa-search"></i>--}}
{{--            </a>--}}
{{--            <div class="navbar-search-block">--}}
{{--                <form class="form-inline">--}}
{{--                    <div class="input-group input-group-sm">--}}
{{--                        <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">--}}
{{--                        <div class="input-group-append">--}}
{{--                            <button class="btn btn-navbar" type="submit">--}}
{{--                                <i class="fas fa-search"></i>--}}
{{--                            </button>--}}
{{--                            <button class="btn btn-navbar" type="button" data-widget="navbar-search">--}}
{{--                                <i class="fas fa-times"></i>--}}
{{--                            </button>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </form>--}}
{{--            </div>--}}
{{--        </li>--}}
        <!-- Notifications Dropdown Menu -->
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <i class="far fa-bell"></i>
                <span class="badge badge-info navbar-badge">{{ $unreadNotifications->count() }}</span>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <span class="dropdown-item dropdown-header">{{ $unreadNotifications->count() }} Notifications</span>
                <div class="dropdown-divider"></div>
                @foreach($unreadNotifications->take(5) as $notify)
                    <a href="{{ isset($notify->data['link']) ? $notify->data['link'] : '#' }}" class="dropdown-item">
                        <i class="fas fa-envelope mr-2"></i>
                        @if(isset($notify->data['message']) && $notify->data['message'] === 'leave_request_send')
                            Leave Request from {{ $notify->data['name'] ?? '' }}
                        @elseif(isset($notify->data['message']) && $notify->data['message'] === 'notice_for_all')
                            Notice for all
                        @endif
                        <span class="float-right text-muted text-sm">{{ isset($notify->created_at) ? $notify->created_at->diffForHumans() : '' }}</span>
                    </a>
                    <div class="dropdown-divider"></div>
                @endforeach
                <a href="{{ route('see-all-notification') }}" class="dropdown-item dropdown-footer">See All Notifications</a>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                <i class="fas fa-expand-arrows-alt"></i>
            </a>
        </li>
        <!-- Bright Icon for Dark and White Screens -->
        <li class="nav-item">
            <a id="brightness-toggle" class="nav-link" href="javascript:void(0)" role="button">
                <i class="fas fa-sun"></i>
            </a>
        </li>

        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="javascript:void(0)">
                @if($currentUser->getFirstMediaUrl())
                    <div class="profile_img">
                        <img src="{{ $currentUser->getFirstMediaUrl() }}"  alt="">
                    </div>
                @else
                    <div class="profile_img">
                        <img src="{{ asset('assets/admin/dist/img/profile.png') }}"  alt="">
                    </div>
                @endif

            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right p-3">
                <a href="{{ route('profile.view') }}" class="dropdown-item">
                    <i class="fas fa-user-circle mr-2"></i> Profile
                </a>
                <a href="{{ route('profile.edit') }}" class="dropdown-item">
                    <i class="fas fa-lock mr-2"></i> Change Password
                </a>
                <a href="javascript:void(0)" onclick="document.getElementById('logout-form').submit();" class=" btn btn-danger btn-block mt-2">
                    <i class="fas fa-sign-out-alt mr-2"></i> Logout
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="post" style="display: none;">
                    @csrf
                </form>
            </div>
        </li>

    </ul>
</nav>
<!-- /.navbar -->

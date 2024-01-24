<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard</title>
    @include('layouts.assets.style')
</head>
<body class="hold-transition dark-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
<div class="wrapper">

    @include('layouts.partial.navbar')


    @include('layouts.partial.left-sidebar')

    @yield('content')

    @include('layouts.partial.right-sidebar')

    @include('layouts.partial.footer')

</div>
<!-- ./wrapper -->
@include('layouts.assets.script')
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard</title>
    @include('layouts.assets.style')
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

    @include('layouts.partial.navbar')


    @include('layouts.partial.left-sidebar')

    @yield('content')

    @include('layouts.partial.right-sidebar')

    @include('layouts.partial.footer')

</div>
@include('layouts.alert')
<!-- ./wrapper -->
@include('layouts.assets.script')
@yield('script')
</body>
</html>

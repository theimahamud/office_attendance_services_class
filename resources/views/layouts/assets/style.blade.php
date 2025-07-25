{{--title icon --}}
@php
    $logo = App\Models\Settings::where('key', 'logo')->first();
   $logoUrl = $logo ? $logo->getFirstMediaUrl('company_logo') : null;
@endphp
@if($logoUrl)
    <link rel="icon" href="{{ asset($logoUrl) }}" type="logo">
@else
    <link rel="icon" href="{{ asset('assets/admin/logo/logo.svg') }}" type="logo">
@endif

<!-- Google Font: Source Sans Pro -->
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
<!-- Font Awesome -->
<link rel="stylesheet" href="{{ asset('assets/admin/plugins/fontawesome-free/css/all.min.css') }}">
<!-- iCheck -->
<link rel="stylesheet" href="{{ asset('assets/admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
<!-- Select2 -->
<link rel="stylesheet" href="{{ asset('assets/admin/plugins/select2/css/select2.min.css') }}">
{{--tom select--}}
<link href="https://cdn.jsdelivr.net/npm/tom-select@2.3.1/dist/css/tom-select.css" rel="stylesheet">
{{--datatables--}}
<link rel="stylesheet" href="//cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
<!-- SweetAlert2 -->
<link rel="stylesheet" href="{{ asset('assets/admin/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}">
<!-- Toastify -->
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
{{--date picker ui--}}
<link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
<!-- overlayScrollbars -->
<link rel="stylesheet" href="{{ asset('assets/admin/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
<!-- Ionicons -->
<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.css" />


<!-- Tempusdominus Bootstrap 4 -->
{{--<link rel="stylesheet" href="{{ asset('assets/admin/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">--}}
<!-- JQVMap -->
{{--<link rel="stylesheet" href="{{ asset('assets/admin/plugins/jqvmap/jqvmap.min.css') }}">--}}
{{--<link rel="stylesheet" href="{{ asset('assets/admin/plugins/daterangepicker/daterangepicker.css') }}">--}}
<!-- Daterange picker -->
{{--<link rel="stylesheet" href="{{ asset('assets/admin/plugins/daterangepicker/daterangepicker.css') }}">--}}
<!-- summernote -->
{{--<link rel="stylesheet" href="{{ asset('assets/admin/plugins/summernote/summernote-bs4.min.css') }}">--}}

<!-- Theme style -->
<link rel="stylesheet" href="{{ asset('assets/admin/dist/css/adminlte.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/admin/responsive.css') }}">
<link rel="stylesheet" href="{{ asset('assets/admin/custom.css') }}">

@yield('style')

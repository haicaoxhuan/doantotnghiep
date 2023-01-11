<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>AdminLTE 3 | Fixed Navbar Layout</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('assets/admin/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('assets/admin/dist/css/adminlte.min.css') }}">
    {{-- <link rel="stylesheet" href="{{asset('assets/css/vendor/bootstrap.min.css') }}" > --}}
    <link rel="stylesheet" href="http://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css">
    <link rel="stylesheet" href="{{ asset('assets/admin/plugins/toastr/toastr.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/admin/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/admin/dist/css/show.css') }}">
    @yield('addcssadmin')
</head>

<body class="hold-transition sidebar-mini layout-navbar-fixed">
    <!-- Site wrapper -->
    <div class="wrapper">

        @include('admin.layout.header')

        @include('admin.layout.sidebar')

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            @yield('bodyadmin')
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        @include('admin.layout.footer')

    </div>
    <!-- ./wrapper -->

    <!-- jQuery -->
    <script src="{{ asset('assets/admin/plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('assets/admin/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('assets/admin/dist/js/adminlte.min.js') }}"></script>
    <!-- AdminLTE for demo purposes -->

    <script src="{{asset('assets/js/vendor/bootstrap.min.js')}}"></script>
    <script src="http://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>
    <script src="{{ asset('assets/admin/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
    <script src="{{ asset('assets/admin/plugins/toastr/toastr.min.js') }}"></script>
    <script src="{{asset('assets/admin/plugins/jquery-validation/jquery.validate.min.js')}}"></script>
    
    <script src="{{ asset('assets/admin/dist/js/deleteRecord.js') }}"></script>
    <script type="module">
        // Show alert
        @if(session('status_succeed'))
            toastr.success('{{session('status_succeed')}}', {timeOut: 5000})
        @elseif(session('status_failed'))
            toastr.error('{{session('status_failed')}}', {timeOut: 5000})
        @endif
    </script>
    @yield('addjsadmin')
</body>

</html>

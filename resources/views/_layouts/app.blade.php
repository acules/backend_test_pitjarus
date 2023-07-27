<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  @include('_layouts/meta')
  <title>{{config('app.name')}}</title>
  @include('_layouts/css')
  <link rel="shortcut icon" href="{{ asset('assets/favicon.png') }}" />
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<!-- Dark Mode <body class="hold-transition dark-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed"> -->
  <body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed">
<div class="wrapper">

  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__wobble" src="{{ asset('assets/dist/img/AdminLTELogo.png') }}" alt="AdminLTELogo" height="60" width="60">
  </div>

  <!-- Navbar -->
  @include('_layouts/navbarheader')
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  @include('_layouts/navbar')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    @include('_layouts/title')
    <!-- /.content-header -->

    <!-- Main content -->
    @yield('content')
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->

  <!-- Main Footer -->
  <!-- @include('_layouts/footer') -->
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->
@include('_layouts/js')
@include('sweetalert::alert')
</body>
</html>

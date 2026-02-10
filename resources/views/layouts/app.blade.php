
<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>{{ env("APP_NAME") }}</title>

  <link rel="icon" type="image/png" href="{{ asset("adminlte") }}/dist/img/brand.png">

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="{{ asset("adminlte") }}/plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset("adminlte") }}/dist/css/adminlte.min.css">

  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

  <!-- DataTables -->
  <link rel="stylesheet" href="{{ asset("adminlte") }}/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="{{ asset("adminlte") }}/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="{{ asset("adminlte") }}/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <style>
      .main-sidebar {
      background-color: #ffffff !important;
      }

      .brand-link {
      border-bottom: 1px solid #dee2e6;
      }


      .nav-sidebar .nav-link {
      color: #495057 !important;
      }


      .nav-sidebar .nav-link:hover {
      background-color: #f1f3f5 !important;
      color: #212529 !important;
      }


      .nav-sidebar > .nav-item > .nav-link.active {
      background-color: #e9ecef !important;
      color: #212529 !important;
      }

      .nav-treeview {
      padding-left: 0;
      }

      .nav-treeview > .nav-item > .nav-link {
      background-color: transparent !important;
      color: #6c757d !important;
      padding-left: 2.5rem;
      font-size: 0.95rem;
      }

      .nav-treeview > .nav-item > .nav-link:hover {
      background-color: #f1f3f5 !important;
      color: #212529 !important;
      }

      .nav-treeview > .nav-item > .nav-link.active {
      background-color: #e9ecef !important;
      color: #212529 !important;
      }

      .nav-sidebar .nav-icon,
      .nav-treeview .nav-icon {
      color: inherit !important;
      }

      .nav-item.menu-open > .nav-link {
      background-color: transparent !important;
      color: #212529 !important;
      }

      .breadcrumb-item a {
      color: #000000 !important;
      }

      .breadcrumb-item a:hover {
      color: #000000 !important;
      text-decoration: underline;
      }

      .nav-link {
      transition: background-color 0.15s ease, color 0.15s ease;
      }

      .nav-link:focus {
      box-shadow: none !important;
      }

      

  </style>

  @vite("resources/js/app.js")
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
@include('sweetalert::alert')
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="/dashboard" class="nav-link">Home</a>
      </li>
    </ul>

    <ul class="navbar-nav ml-auto">
        <li>
          <div class="dropdown">
            <button class="btn dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">
              <strong class="text-capitalize">{{ auth()->user()->name }}</strong>
            </button>
            <div class="dropdown-menu">
              <a class="dropdown-item" href="#">
                <form action="{{ route("logout") }}" method="post">
                  @csrf
                  <button type="submit" class="btn btn-sm fw-bold">Logout</button>
                </form>
              </a>
            </div>
          </div>
        </li>
        {{-- <li>
           
        </li> --}}
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <x-admin.aside/>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">@yield("content_title")</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
              <li class="breadcrumb-item active">@yield("content_title")</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        @yield("content")
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Main Footer -->
  <footer class="main-footer">
    <!-- To the right -->
    <div class="float-right d-none d-sm-inline">
      Anything you want
    </div>
    <!-- Default to the left -->
    <strong>{{ env("APP_NAME") }} &copy; .</strong> All rights reserved.
  </footer>
</div>
<!-- ./wrapper -->



<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="{{ asset("adminlte") }}/plugins/jquery/jquery.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2-bootstrap-theme/0.1.0-beta.10/select2-bootstrap.min.css" integrity="sha512-kq3FES+RuuGoBW3a9R2ELYKRywUEQv0wvPTItv3DSGqjpbNtGWVdvT8qwdKkqvPzT93jp8tSF4+oN4IeTEIlQA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset("adminlte") }}/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="{{ asset("adminlte") }}/dist/js/adminlte.min.js"></script>
<!-- DataTables  & Plugins -->
<script src="{{ asset("adminlte") }}/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="{{ asset("adminlte") }}/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="{{ asset("adminlte") }}/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="{{ asset("adminlte") }}/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="{{ asset("adminlte") }}/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="{{ asset("adminlte") }}/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="{{ asset("adminlte") }}/plugins/jszip/jszip.min.js"></script>
<script src="{{ asset("adminlte") }}/plugins/pdfmake/pdfmake.min.js"></script>
<script src="{{ asset("adminlte") }}/plugins/pdfmake/vfs_fonts.js"></script>
<script src="{{ asset("adminlte") }}/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="{{ asset("adminlte") }}/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="{{ asset("adminlte") }}/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": true, "autoWidth": false,
      // "buttons": ["excel", "pdf"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": true,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>

@stack("script")
</body>
</html>

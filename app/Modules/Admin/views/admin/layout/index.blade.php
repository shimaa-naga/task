<!DOCTYPE html>
<html>
@include('admin.includes.style')
<body class="hold-transition skin-blue sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">

@include('admin.layout.header')
<!-- =============================================== -->
    <!-- Left side column. contains the sidebar -->
@include('admin.layout.sidebar')
<!-- =============================================== -->
    <!-- Content Wrapper. Contains page content -->
    @yield('content')
    <!-- /.content-wrapper -->
    @include('admin.layout.footer')
</div>
<!-- ./wrapper -->
@include('admin.includes.script')
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $title ?? 'Dashboard' ?></title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="public/plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="public/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="public/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- JQVMap -->
    <link rel="stylesheet" href="public/plugins/jqvmap/jqvmap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="public/dist/css/adminlte.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="public/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="public/plugins/daterangepicker/daterangepicker.css">
    <!-- summernote -->
    <link rel="stylesheet" href="public/plugins/summernote/summernote-bs4.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="public/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="public/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="public/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">

    <script src="public/plugins/jquery/jquery.min.js"></script>
    <script src="public/plugins/jquery-ui/jquery-ui.min.js"></script>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

    <!-- Navbar -->
    <?php include __DIR__ . '/navbar.php'; ?>

    <!-- Sidebar -->
    <?php include __DIR__ . '/sidebar.php'; ?>

    <!-- Content Wrapper -->
    <div class="content-wrapper">
        <?php 
        // diset dari controller: $view = "dashboard";
        if (isset($view)) {
            include __DIR__ . '/../pages/' . $view . '.php';
        }
        ?>
    </div>

    <!-- Footer -->
    <?php include __DIR__ . '/footer.php'; ?>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark"></aside>
</div>
<!-- ./wrapper -->

<!-- Scripts -->

<script>$.widget.bridge('uibutton', $.ui.button)</script>
<script src="public/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="public/plugins/sparklines/sparkline.js"></script>
<script src="public/plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="public/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<script src="public/plugins/jquery-knob/jquery.knob.min.js"></script>
<script src="public/plugins/moment/moment.min.js"></script>
<script src="public/plugins/daterangepicker/daterangepicker.js"></script>
<script src="public/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<script src="public/plugins/summernote/summernote-bs4.min.js"></script>
<script src="public/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<script src="public/dist/js/adminlte.js"></script>
<script src="public/dist/js/pages/dashboard.js"></script>

<!-- DataTables -->
<script src="public/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="public/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="public/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="public/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="public/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="public/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="public/plugins/jszip/jszip.min.js"></script>
<script src="public/plugins/pdfmake/pdfmake.min.js"></script>
<script src="public/plugins/pdfmake/vfs_fonts.js"></script>
<script src="public/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="public/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="public/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>

<script>
$(function () {
    $('.myTable').DataTable({
        paging: true,
        lengthChange: false,
        searching: false,
        ordering: true,
        info: true,
        autoWidth: false,
        responsive: true,
    });
});
</script>

</body>
</html>

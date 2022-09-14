<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $_ENV['APP_NAME']; ?></title>
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" />
    <link rel="stylesheet"
        href="<?= base_url('assets') ?>/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <link rel="stylesheet" href="<?= base_url('assets') ?>/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="<?= base_url('assets') ?>/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="<?= base_url('assets') ?>/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <link rel="stylesheet" href="<?= base_url('assets') ?>/plugins/daterangepicker/daterangepicker.css">
    <link rel="stylesheet" href="<?= base_url('assets') ?>/plugins/summernote/summernote-bs4.min.css">
    <link rel="stylesheet" href="<?= base_url('assets') ?>/plugins/bootstrap-table/bootstrap-table.min.css">
    <link rel="stylesheet" href="<?= base_url('assets/css/sweetalert2-dark.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/plugins/datatables/DataTables-1.11.3/css/dataTables.bootstrap5.min.css') ;?>">
    <link rel="stylesheet"  href="<?= base_url('assets/plugins/datatables/Responsive-2.2.9/css/responsive.bootstrap5.min.css') ;?>">
    <link rel="stylesheet" href="<?= base_url('assets/plugins/datatables/StateRestore-1.1.1/css/stateRestore.bootstrap5.min.css') ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <script>
        SITE_URL = '<?= base_url() ?>';
    </script>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        <?= $this->include('template/navbar.php'); ?>
        <?= $this->include('template/main_sidebar'); ?>
        <div class="content-wrapper">
            <?= $this->include('template/bradcump'); ?>
            <?= $this->renderSection('main'); ?>
        </div>

        <?= $this->include('template/control_sidebar'); ?>
        <?= $this->include('template/footer'); ?>

    </div>
    <script src="<?= base_url('assets') ?>/plugins/jquery/jquery.min.js"></script>
    <script src="<?= base_url('assets') ?>/plugins/jquery-ui/jquery-ui.min.js"></script>
    <script>
        $.widget.bridge('uibutton', $.ui.button)
    </script>
    <script src="<?= base_url('assets/js/bootstrap.bundle.min.js') ?>"></script>
    <script src="<?= base_url('assets') ?>/plugins/chart.js/Chart.min.js"></script>
    <script src="<?= base_url('assets') ?>/plugins/moment/moment.min.js"></script>
    <script src="<?= base_url('assets') ?>/plugins/daterangepicker/daterangepicker.js"></script>
    <script src="<?= base_url('assets') ?>/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js">
    </script>
    <script src="<?= base_url('assets') ?>/plugins/summernote/summernote-bs4.min.js"></script>
    <script src="<?= base_url('assets') ?>/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
    <script src="<?= base_url('assets') ?>/plugins/bootstrap-table/bootstrap-table.min.js"></script>
    <script src="<?= base_url('assets') ?>/dist/js/adminlte.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <!-- <script src="<?= base_url('assets/js/bootstrap4-toggle.min.js') ?>"></script>
    <script src="<?= base_url('assets/js/sweetalert2.all.min.js') ?>"></script>
    <script src="<?= base_url('assets/js/jquery.validate.min.js') ?>"></script> -->
   
    <!-- <script src="<?= base_url("assets/plugins/datatables/DataTables-1.11.3/js/jquery.dataTables.min.js") ;?>" type="text/javascript"></script>
    <script src="<?= base_url("assets/plugins/datatables/DataTables-1.11.3/js/dataTables.bootstrap5.min.js") ;?>" type="text/javascript"></script>
    <script src="<?= base_url("assets/plugins/datatables/Buttons-2.0.1/js/dataTables.buttons.min.js") ;?>" type="text/javascript"></script>
    <script src="<?= base_url("assets/plugins/datatables/JSZip-2.5.0/jszip.min.js") ;?>" type="text/javascript"></script>					
    <script src="<?= base_url("assets/plugins/datatables/Buttons-2.0.1/js/buttons.print.min.js") ;?>" type="text/javascript"></script>
    <script src="<?= base_url("assets/plugins/datatables/Buttons-2.0.1/js/buttons.html5.min.js") ;?>" type="text/javascript"></script>
    <script src="<?= base_url("assets/plugins/datatables/Responsive-2.2.9/js/dataTables.responsive.min.js") ;?>" type="text/javascript"></script>
    <script src="<?= base_url("assets/plugins/datatables/Responsive-2.2.9/js/responsive.bootstrap5.min.js") ;?>" type="text/javascript"></script> -->
    
    <?= $this->renderSection('pageScript'); ?>

</body>

</html>
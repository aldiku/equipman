<!DOCTYPE html>
<html lang="ID-id">

<head>

    <!-- meta -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="ClueHost - Creative Hosting Multipage html5 Template">
    <meta name="keywords" content="Apps, Software, technology, landing page, business, responsive, multipage, corporate, clean">
    <meta name="author" content="Coderspoint">

    <!-- Site title -->
    <title>PAPUAHOSTER</title>

    <!-- favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.png">


    <!-- Plugin Css -->
    <link href="<?= base_url('assets'); ?>/config/css/plugin.css" rel="stylesheet">

    <!-- Site css -->
    <link href="<?= base_url('assets'); ?>/config/css/style.css" rel="stylesheet">


</head>

<body>

    <!-- Preloader starts-->
    <div id="preloader"></div>
    <!-- Preloader ends -->


    <?= $this->include('pages/config/navbar'); ?>
    <?= $this->renderSection('main'); ?>
    <?= $this->include('pages/config/footer'); ?>




    <!-- Latest jQuery -->
    <script src="<?= base_url('assets'); ?>/config/js/jquery.min.js"></script>

    <!-- Plugin js -->
    <script src="<?= base_url('assets'); ?>/config/js/plugin.js"></script>


    <!-- Main js-->
    <script src="<?= base_url('assets'); ?>/config/js/main_script.js"></script>


</body>

</html>
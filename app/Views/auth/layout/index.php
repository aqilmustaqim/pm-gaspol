<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Pipeline Project Management Bootstrap Theme</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="A project management Bootstrap theme by Medium Rare">
    <link href="<?= base_url(); ?>/assets/img/favicon.ico" rel="icon" type="image/x-icon">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Gothic+A1" rel="stylesheet">
    <link href="<?= base_url(); ?>/assets/css/theme.css" rel="stylesheet" type="text/css" media="all" />
</head>

<body>
    <div class="main-container fullscreen">
        <?= $this->renderSection('content'); ?>
    </div>

    <!-- Required vendor scripts (Do not remove) -->
    <script type="text/javascript" src="<?= base_url(); ?>/assets/js/jquery.min.js"></script>
    <script type="text/javascript" src="<?= base_url(); ?>/assets/js/popper.min.js"></script>
    <script type="text/javascript" src="<?= base_url(); ?>/assets/js/bootstrap.js"></script>

    <!-- Optional Vendor Scripts (Remove the plugin script here and comment initializer script out of index.js if site does not use that feature) -->

    <!-- Autosize - resizes textarea inputs as user types -->
    <script type="text/javascript" src="<?= base_url(); ?>/assets/js/autosize.min.js"></script>
    <!-- Flatpickr (calendar/date/time picker UI) -->
    <script type="text/javascript" src="<?= base_url(); ?>/assets/js/flatpickr.min.js"></script>
    <!-- Prism - displays formatted code boxes -->
    <script type="text/javascript" src="<?= base_url(); ?>/assets/js/prism.js"></script>
    <!-- Shopify Draggable - drag, drop and sort items on page -->
    <script type="text/javascript" src="<?= base_url(); ?>/assets/js/draggable.bundle.legacy.js"></script>
    <script type="text/javascript" src="<?= base_url(); ?>/assets/js/swap-animation.js"></script>
    <!-- Dropzone - drag and drop files onto the page for uploading -->
    <script type="text/javascript" src="<?= base_url(); ?>/assets/js/dropzone.min.js"></script>
    <!-- List.js - filter list elements -->
    <script type="text/javascript" src="<?= base_url(); ?>/assets/js/list.min.js"></script>

    <!-- Required theme scripts (Do not remove) -->
    <script type="text/javascript" src="<?= base_url(); ?>/assets/js/theme.js"></script>

</body>

</html>
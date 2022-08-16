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

    <div class="layout layout-nav-side">
        <div class="navbar navbar-expand-lg bg-dark navbar-dark sticky-top">

            <a class="navbar-brand" href="index.html">
                <img alt="Pipeline" src="assets/img/logo.svg" />
            </a>
            <div class="d-flex align-items-center">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-collapse" aria-controls="navbar-collapse" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

            </div>
            <div class="collapse navbar-collapse flex-column" id="navbar-collapse">
                <ul class="navbar-nav d-lg-block">

                    <li class="nav-item">

                        <a class="nav-link" href="index.html">Overview</a>

                    </li>

                    <li class="nav-item">

                        <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-2" aria-controls="submenu-2">Pages</a>
                        <div id="submenu-2" class="collapse">
                            <ul class="nav nav-small flex-column">

                                <li class="nav-item">
                                    <a class="nav-link" href="pages-app.html">App Pages</a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link" href="pages-utility.html">Utility Pages</a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link" href="pages-layouts.html">Layouts</a>
                                </li>

                            </ul>
                        </div>

                    </li>

                    <li class="nav-item">

                        <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-3" aria-controls="submenu-3">Components</a>
                        <div id="submenu-3" class="collapse">
                            <ul class="nav nav-small flex-column">

                                <li class="nav-item">
                                    <a class="nav-link" href="components-bootstrap.html">Bootstrap</a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link" href="components-pipeline.html">Pipeline</a>
                                </li>

                            </ul>
                        </div>

                    </li>

                    <li class="nav-item">

                        <a class="nav-link" href="documentation/index.html">Documentation</a>

                    </li>

                    <li class="nav-item">

                        <a class="nav-link" href="documentation/changelog.html">Changelog</a>

                    </li>

                </ul>
                <hr>
                <div class="d-none d-lg-block w-100">
                    <span class="text-small text-muted">Quick Links</span>
                    <ul class="nav nav-small flex-column mt-2">
                        <li class="nav-item">
                            <a href="nav-side-team.html" class="nav-link">Team Overview</a>
                        </li>
                        <li class="nav-item">
                            <a href="nav-side-project.html" class="nav-link">Project</a>
                        </li>
                        <li class="nav-item">
                            <a href="nav-side-task.html" class="nav-link">Single Task</a>
                        </li>
                        <li class="nav-item">
                            <a href="nav-side-kanban-board.html" class="nav-link">Kanban Board</a>
                        </li>
                    </ul>
                    <hr>
                </div>
                <div>
                    <form>
                        <div class="input-group input-group-dark input-group-round">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="material-icons">search</i>
                                </span>
                            </div>
                            <input type="search" class="form-control form-control-dark" placeholder="Search" aria-label="Search app">
                        </div>
                    </form>

                </div>
            </div>


        </div>
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
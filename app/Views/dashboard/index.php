<?= $this->extend('layouts/index'); ?>
<?= $this->section('content'); ?>
<div class="main-container">

    <div class="navbar bg-white breadcrumb-bar">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Dashboard</a>
                </li>

            </ol>
        </nav>

        <div class="dropdown">
            <a href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <img alt="Image" src="assets/img/avatar-male-4.jpg" class="avatar" />
            </a>
            <div class="dropdown-menu dropdown-menu-right">

                <a href="nav-side-user.html" class="dropdown-item">Profile</a>
                <a href="utility-account-settings.html" class="dropdown-item">Account Settings</a>
                <a href="<?= base_url(); ?>/auth/logout" class="dropdown-item">Log Out</a>

            </div>
        </div>


    </div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-11 col-xl-10">
                <div class="page-header">
                    <h1>Welcome Dashboard <?= session()->get('nama'); ?> &#x2615;</h1>
                    <p class="lead">A small web studio crafting lovely template products.</p>
                </div>
                <hr>



            </div>
        </div>
    </div>

</div>
<?= $this->endSection(); ?>
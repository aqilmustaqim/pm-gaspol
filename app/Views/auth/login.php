<?= $this->extend('auth/layout/index'); ?>
<?= $this->section('content'); ?>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-xl-5 col-lg-6 col-md-7">

            <div class="text-center">
                <h1 class="h2">PM Gaspol &#x1f44b;</h1>
                <p class="lead">Log in to your account to continue</p>
                <?php if (session()->getFlashdata('login')) { ?>
                    <div class="alert alert-danger solid alert-dismissible fade show">
                        <svg viewBox="0 0 24 24" width="24 " height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="mr-2">
                            <polygon points="7.86 2 16.14 2 22 7.86 22 16.14 16.14 22 7.86 22 2 16.14 2 7.86 7.86 2"></polygon>
                            <line x1="15" y1="9" x2="9" y2="15"></line>
                            <line x1="9" y1="9" x2="15" y2="15"></line>
                        </svg>
                        <strong>Error!</strong> <?= session()->getFlashdata('login'); ?> <button type="button" class="close h-100" data-dismiss="alert" aria-label="Close"><span><i class="mdi mdi-close"></i></span>
                        </button>
                    </div>
                <?php } ?>
                <?php if (session()->getFlashdata('register')) { ?>
                    <div class="alert alert-success solid alert-dismissible fade show">
                        <strong>Success!</strong> <?= session()->getFlashdata('register'); ?> <button type="button" class="close h-100" data-dismiss="alert" aria-label="Close"><span><i class="mdi mdi-close"></i></span>
                        </button>
                    </div>
                <?php } ?>

                <form action="<?= base_url(); ?>/auth/loginSave" method="post">

                    <div class="form-group">
                        <input class="form-control <?= ($validation->hasError('email') ? 'is-invalid' : ''); ?>" type="email" placeholder="Email Address" name="email" />
                        <div class="invalid-feedback text-left">
                            <?= $validation->getError('email'); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <input class="form-control <?= ($validation->hasError('password') ? 'is-invalid' : ''); ?>" type="password" placeholder="Password" name="password" />
                        <div class="invalid-feedback text-left">
                            <?= $validation->getError('password'); ?>
                        </div>
                        <div class="text-right">
                            <small><a href="#">Forgot password?</a>
                            </small>
                        </div>
                    </div>
                    <button class="btn btn-lg btn-block btn-primary" role="button" type="submit">
                        Log in
                    </button>
                    <small>Don't have an account yet? <a href="<?= base_url(); ?>/auth/register">Create one</a>
                    </small>
                </form>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>
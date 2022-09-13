<?= $this->extend('auth/layout/index'); ?>
<?= $this->section('content'); ?>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-xl-5 col-lg-6 col-md-7">
            <div class="text-center">
                <h1 class="h2">Create account PM Gaspol</h1>
                <p class="lead">Start doing things for free, in an instant</p>
                <hr>
                <form action="<?= base_url(); ?>/auth/registerSave" method="post">
                    <div class="form-group">
                        <input class="form-control <?= ($validation->hasError('nama') ? 'is-invalid' : ''); ?>" type="nama" placeholder="Name" name="nama" />
                        <div class="invalid-feedback text-left">
                            <?= $validation->getError('nama'); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <input class="form-control <?= ($validation->hasError('email') ? 'is-invalid' : ''); ?>" type="email" placeholder="Email Address" name="email" />
                        <div class="invalid-feedback text-left">
                            <?= $validation->getError('email'); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <input class="form-control <?= ($validation->hasError('password') ? 'is-invalid' : ''); ?>" type="password" placeholder="Password" name="password" />
                        <div class="text-left">
                            <small>Your password should be at least 8 characters</small>
                        </div>
                        <div class="invalid-feedback text-left">
                            <?= $validation->getError('password'); ?>
                        </div>
                    </div>
                    <button class="btn btn-lg btn-block btn-primary" role="button" type="submit">
                        Create account
                    </button>
                    <small>Already have an account ? <a href="<?= base_url(); ?>">Login</a>
                    </small>
                </form>
            </div>
        </div>
    </div>
</div>


<?= $this->endSection(); ?>
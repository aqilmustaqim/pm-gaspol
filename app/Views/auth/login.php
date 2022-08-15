<?= $this->extend('auth/layout/index'); ?>
<?= $this->section('content'); ?>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-xl-5 col-lg-6 col-md-7">
            <div class="text-center">
                <h1 class="h2">PM Gaspol &#x1f44b;</h1>
                <p class="lead">Log in to your account to continue</p>
                <form action="<?= base_url(); ?>/auth/loginSave">
                    <div class="form-group">
                        <input class="form-control" type="email" placeholder="Email Address" name="login-email" />
                    </div>
                    <div class="form-group">
                        <input class="form-control" type="password" placeholder="Password" name="login-password" />
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
<?= $this->extend('layouts/index'); ?>
<?= $this->section('content'); ?>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-11 col-xl-10">
            <div class="page-header">
                <h1>Welcome Dashboard <?= session()->get('nama'); ?> &#x2615;</h1>
                <p class="lead">A small web studio crafting lovely template products.</p>
            </div>

        </div>
        <hr>
        <div style="width: 400px;">
            <canvas id="myChart"></canvas>
        </div>

    </div>
</div>


<?= $this->endSection(); ?>
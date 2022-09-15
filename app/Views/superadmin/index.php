<?= $this->extend('layouts/index'); ?>
<?= $this->section('content'); ?>

<?php
$totalteam = "";
$idTeam = "";

foreach ($team as $t) {
    $team = $t['team'];
    $idteam = $t['id_team'];
    $totalteam .= "'$team'" . ",";
    $idTeam .= $idteam;
}



?>
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
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const data = {
        labels: [<?= $totalteam; ?>],
        datasets: [{
            label: 'My First Dataset',
            data: [300, 50, 100, 40],
            backgroundColor: [
                'rgb(255, 99, 132)',
                'rgb(54, 162, 235)',
                'rgb(255, 205, 86)',
                'rgb(46,139,87)',
            ],
            hoverOffset: 4
        }]
    };
    const config = {
        type: 'doughnut',
        data: data
    };
</script>


<script>
    const myChart = new Chart(
        document.getElementById('myChart'),
        config
    );
</script>
<?= $this->endSection(); ?>
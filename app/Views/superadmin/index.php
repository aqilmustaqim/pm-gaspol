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

$jumlahProjectTeam = "";

foreach ($jumlahProject as $jp) {
    $jumlah = $jp['jumlah_project'];

    $jumlahProjectTeam .= "'$jumlah'" . ",";
}



?>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-11 col-xl-10">
            <div class="page-header">
                <h1>Welcome Dashboard <?= session()->get('nama'); ?> &#x2615;</h1>
                <p class="lead">Summary your active projects in all teams <b>Gaspol yah om </b>.</p>
            </div>


        </div>
        <hr>
        <div class="row">
            <div class="col-md-4">
                <div style="width: 300px;">
                    <canvas id="myChart"></canvas>
                </div>
            </div>
            <div class="col-md-8" style="padding-left: 70px;">
                <div class="card">
                    <div class="card-body">
                        <div class="table">
                            <table id="example" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Nama Project</th>
                                        <th>Status</th>
                                        <th>Team</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($teamproject as $tp) : ?>
                                        <tr>
                                            <td><?= $tp['nama_project']; ?></td>
                                            <td>
                                                <?php
                                                if ($tp['status_project'] == 1) {
                                                    echo '<span class="badge badge-pill badge-warning font-size-12"> On Progress </span>';
                                                } else if ($tp['status_project'] == 2) {
                                                    echo '<span class="badge badge-pill badge-warning font-size-12"> Complete </span>';
                                                } else if ($tp['status_project'] == 0) {
                                                    echo '<span class="badge badge-pill badge-warning font-size-12"> Not Started </span>';
                                                }
                                                ?>
                                            </td>
                                            <td>
                                                <button class="badge badge-dark"><?= $tp['team']; ?></button>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>

                            </table>
                        </div>
                    </div>

                </div>
            </div>
        </div>

    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const data = {
        labels: [<?= $totalteam; ?>],
        datasets: [{
            label: 'Jumlah Project',
            data: [<?= $jumlahProjectTeam; ?>],
            backgroundColor: [
                'rgb(255, 99, 132)',
                'rgb(54, 162, 235)',
                'rgb(255, 205, 86)',
                'rgb(46,139,87)',
                'rgb(106,90,205)',
                'rgb(0,0,128)'
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
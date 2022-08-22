<?= $this->extend('layouts/index'); ?>
<?= $this->section('content'); ?>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-11 col-xl-10">
            <div class="page-header">
                <h1>List Member </h1>
                <button class="btn btn-danger btn-sm">Member Request : 2</button>
                <p class="lead"></p>

            </div>
            <hr style="border: solid 0.5px black;">
        </div>
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Team</th>
                                <th>Position</th>
                                <th>Role</th>
                                <th>Bergabung</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($users as $u) : ?>
                                <tr>
                                    <td><?= $u['nama']; ?></td>
                                    <td><?= $u['email']; ?></td>
                                    <td>Dewabiz</td>
                                    <td>Web Developer</td>
                                    <td>
                                        <?php
                                        if ($u['role_id'] == 1) {
                                            echo '<span class="badge badge-pill badge-primary font-size-12"> Super Admin </span>';
                                        } else if ($u['role_id'] == 2) {
                                            echo '<span class="badge badge-pill badge-danger font-size-12"> Kasir </span>';
                                        } else if ($u['role_id'] == 3) {
                                            echo '<span class="badge badge-pill badge-danger font-size-12"> Member </span>';
                                        }
                                        ?>
                                    </td>
                                    <td><?= date('d-M-Y', strtotime($u['created_at'])); ?></td>
                                    <td>

                                        <a href="<?= base_url(); ?>/users/hapusData/<?= $u['id']; ?>" class="badge badge-danger tombol-hapus"><i class="fa fas fa-trash"></i></i></a>
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


<?= $this->endSection(); ?>
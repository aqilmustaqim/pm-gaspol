<?= $this->extend('Layouts/index'); ?>
<?= $this->section('content'); ?>

<div class="container">
    <div class="member" data-member="<?= session()->getFlashdata('member'); ?>"></div>
    <div class="col-lg-11 col-xl-10">
        <div class="page-header">
            <h1>List Position </h1>
            <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#memberRequest">Add Position</button>
            <p class="lead"></p>

        </div>

    </div>
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table id="example" class="table table-hover table-striped" style="width:100%">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Position</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $nomor = 1; ?>
                        <?php foreach ($position as $p) : ?>
                            <tr>
                                <td><?= $nomor++; ?></td>
                                <td>
                                    <button class="badge badge-black"><?= $p['posisi']; ?></button>
                                </td>
                                <td>
                                    <a href="<?= base_url(); ?>/member/updatePosition/<?= $p['id']; ?>" class="badge badge-info" data-toggle="modal" data-target="#UbahDataMember<?= $p['id']; ?>"><i class="fa fas fa-edit"></i></a>
                                    <a href="<?= base_url(); ?>/member/deletePosition/<?= $p['id']; ?>" class="badge badge-danger tombol-hapus"><i class="fa fas fa-trash"></i></a>
                                </td>
                            </tr>

                        <?php endforeach; ?>
                    </tbody>

                </table>
            </div>
        </div>

    </div>


</div>

<?= $this->endSection(); ?>
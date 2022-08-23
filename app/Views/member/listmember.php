<?= $this->extend('layouts/index'); ?>
<?= $this->section('content'); ?>

<div class="container">
    <div class="member" data-member="<?= session()->getFlashdata('member'); ?>"></div>
    <div class="col-lg-11 col-xl-10">
        <div class="page-header">
            <h1>List Member </h1>
            <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#memberRequest">Member Request : <?= $approve; ?></button>
            <p class="lead"></p>

        </div>

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
                                <td>DewaBiz</td>
                                <td>
                                    <button class="badge badge-dark"><?= $u['posisi']; ?></button>
                                </td>
                                <td>
                                    <?php
                                    if ($u['role_id'] == 1) {
                                        echo '<span class="badge badge-pill badge-primary font-size-12"> Super Admin </span>';
                                    } else if ($u['role_id'] == 2) {
                                        echo '<span class="badge badge-pill badge-danger font-size-12"> Leader </span>';
                                    } else if ($u['role_id'] == 3) {
                                        echo '<span class="badge badge-pill badge-danger font-size-12"> Member </span>';
                                    }
                                    ?>
                                </td>
                                <td><?= date('d-m-y', strtotime($u['created_at'])); ?></td>
                                <td>

                                    <a href="<?= base_url(); ?>/users/updateMember/<?= $u['id']; ?>" class="badge badge-info" data-toggle="modal" data-target="#UbahDataMember<?= $u['id']; ?>"><i class="fa fas fa-edit"></i></a>
                                    <a href="<?= base_url(); ?>/users/deleteMember/<?= $u['id']; ?>" class="badge badge-danger tombol-hapus"><i class="fa fas fa-trash"></i></a>
                                </td>
                            </tr>

                        <?php endforeach; ?>
                    </tbody>

                </table>
            </div>
        </div>

    </div>


</div>

<?php foreach ($users as $u) : ?>
    <div class="modal fade" id="UbahDataMember<?= $u['id']; ?>">
        <div class="modal-dialog" role="document">
            <form action="<?= base_url(); ?>/member/updateMember/<?= $u['id']; ?>" method="post">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Data Member</h5>
                        <button type="button" class="close btn btn-round" data-dismiss="modal" aria-label="Close">
                            <i class="material-icons">close</i>
                        </button>
                    </div>
                    <!--end of modal head-->
                    <div class="modal-body">
                        <div>
                            <div class="input-group-12">
                                <div class="form-group">
                                    <label for="exampleFormControlSelect1">Role Member</label>
                                    <select class="form-control" id="exampleFormControlSelect1" name="role">
                                        <option value="<?= $u['role_id']; ?>" selected><?= $u['role']; ?></option>
                                        <?php foreach ($role as $r) : ?>
                                            <option value="<?= $r['id']; ?>"><?= $r['role']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>

                        </div>
                    </div>
                    <!--end of modal body-->
                    <div class="modal-footer">
                        <button role="button" class="btn btn-primary" type="submit">
                            Update
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
<?php endforeach; ?>

<div class="modal fade" id="memberRequest">
    <div class="modal-dialog" role="document">

        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Request Member</h5>
                <button type="button" class="close btn btn-round" data-dismiss="modal" aria-label="Close">
                    <i class="material-icons">close</i>
                </button>
            </div>
            <!--end of modal head-->
            <div class="modal-body">
                <div>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">Nama</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($approvelist as $al) : ?>
                                    <tr>
                                        <td><?= $al['nama']; ?></td>
                                        <td><?= $al['email']; ?></td>
                                        <td>
                                            <a href="<?= base_url(); ?>/member/approveMember/<?= $al['id']; ?>" class="badge badge-primary tombol-approve" data-toggle="tooltip" data-placement="top" title="Approve User"><i class="fa fas fa-user-check"></i></a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!--end of modal body-->

        </div>

    </div>
</div>


<?= $this->endSection(); ?>
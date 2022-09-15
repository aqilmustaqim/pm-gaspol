<?= $this->extend('layouts/index'); ?>
<?= $this->section('content'); ?>

<div class="container">
    <div class="team" data-team="<?= session()->getFlashdata('team'); ?>"></div>
    <div class="row justify-content-center">
        <div class="col-lg-11 col-xl-10">
            <div class="page-header">
                <h1><?= $detailTeam['team']; ?> &#x2615;</h1>
                <p class="lead"><?= $detailTeam['deskripsi_team']; ?>.</p>
                <div class="d-flex align-items-center">
                    <ul class="avatars">

                        <?php foreach ($fotoMemberTeam as $fmt) : ?>
                            <li>
                                <a href="#" data-toggle="tooltip" data-placement="top" title="<?= $fmt['nama']; ?>">
                                    <img alt="<?= $fmt['nama']; ?>" class="avatar" src="<?= base_url(); ?>/assets/img/<?= $fmt['foto']; ?>" />
                                </a>
                            </li>


                        <?php endforeach; ?>


                    </ul>

                </div>
            </div>
            <hr>
            <ul class="nav nav-tabs nav-fill" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" href="#projects" role="tab" aria-controls="projects" aria-selected="true">Projects</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#members" role="tab" aria-controls="members" aria-selected="false">Members</a>
                </li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane fade show active" id="projects" role="tabpanel" data-filter-list="content-list-body">
                    <div class="content-list">
                        <div class="row content-list-head">
                            <div class="col-auto">
                                <h3>Projects</h3>
                                <?php if (session()->get('role_id') == 1) : ?>
                                    <button class="btn btn-round" data-toggle="modal" data-target="#project-add-modal">
                                        <i class="material-icons">add</i>
                                    </button>
                                <?php endif; ?>
                            </div>
                            <form class="col-md-auto">
                                <div class="input-group input-group-round">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="material-icons">filter_list</i>
                                        </span>
                                    </div>
                                    <input type="search" class="form-control filter-list-input" placeholder="Filter projects" aria-label="Filter Projects">
                                </div>
                            </form>
                        </div>
                        <!--end of content list head-->
                        <div class="content-list-body row">
                            <?php if (session()->get('role_id') == 1) { ?>
                                <?php foreach ($project as $p) : ?>
                                    <div class="col-lg-6">
                                        <div class="card card-project">

                                            <div class="progress">
                                                <div class="progress-bar bg-danger" role="progressbar" style="width: 60%" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>

                                            <div class="card-body">
                                                <div class="dropdown card-options">
                                                    <button class="btn-options" type="button" id="project-dropdown-button-1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <i class="material-icons">more_vert</i>
                                                    </button>

                                                    <div class="dropdown-menu dropdown-menu-right">

                                                        <button class="dropdown-item" data-toggle="modal" data-target="#member-add-project<?= $p['id']; ?>">Add Member</button>
                                                        <button class="dropdown-item text-info" data-toggle="modal" data-target="#project-edit-modal<?= $p['id']; ?>">Edit Project</button>
                                                        <a class="dropdown-item text-danger tombol-hapus" href="<?= base_url(); ?>/project/deleteProject/<?= $p['id']; ?>">Delete Project</a>
                                                    </div>

                                                </div>
                                                <div class="card-title">
                                                    <a href="<?= base_url(); ?>/project/detailProject/<?= $p['id']; ?>">
                                                        <h5 data-filter-by="text"><?= $p['nama_project']; ?></h5>
                                                    </a>
                                                </div>
                                                <ul class="avatars">
                                                    <?php foreach (detailFotoProject($p['id']) as $dfp) : ?>
                                                        <li>
                                                            <a href="#" data-toggle="tooltip" title="<?= $dfp['nama']; ?>">
                                                                <img alt="<?= $dfp['nama']; ?>" class="avatar" src="<?= base_url(); ?>/assets/img/<?= $dfp['foto']; ?>" data-filter-by="alt" />
                                                            </a>
                                                        </li>
                                                    <?php endforeach; ?>

                                                </ul>
                                                <div class="card-meta d-flex justify-content-between">
                                                    <div class="d-flex align-items-center">
                                                        <i class="material-icons mr-1">playlist_add_check</i>
                                                        <span class="text-small">6/10</span>
                                                    </div>
                                                    <span class="text-small" data-filter-by="text">
                                                        <?php
                                                        $tanggal = new DateTime(date('Y-m-d'));
                                                        $batas = new DateTime($p['batas_waktu']);
                                                        $duedate = $batas->diff($tanggal);

                                                        ?>
                                                        Due <?= $duedate->d; ?> days
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            <?php } else { ?>
                                <?php foreach ($projectUsers as $pu) : ?>
                                    <div class="col-lg-6">
                                        <div class="card card-project">

                                            <div class="progress">
                                                <div class="progress-bar bg-danger" role="progressbar" style="width: 60%" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>

                                            <div class="card-body">
                                                <div class="dropdown card-options">
                                                    <button class="btn-options" type="button" id="project-dropdown-button-1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <i class="material-icons">more_vert</i>
                                                    </button>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <a class="dropdown-item" href="#">Edit</a>

                                                    </div>
                                                </div>
                                                <div class="card-title">
                                                    <a href="<?= base_url(); ?>/project/detailProject/<?= $pu['id_project']; ?>">
                                                        <h5 data-filter-by="text"><?= $pu['nama_project']; ?></h5>
                                                    </a>
                                                </div>
                                                <ul class="avatars">
                                                    <?php foreach (detailFotoProject($pu['id_project']) as $dfp) : ?>
                                                        <li>
                                                            <a href="#" data-toggle="tooltip" title="<?= $dfp['nama']; ?>">
                                                                <img alt="<?= $dfp['nama']; ?>" class="avatar" src="<?= base_url(); ?>/assets/img/<?= $dfp['foto']; ?>" data-filter-by="alt" />
                                                            </a>
                                                        </li>
                                                    <?php endforeach; ?>

                                                </ul>
                                                <div class="card-meta d-flex justify-content-between">
                                                    <div class="d-flex align-items-center">
                                                        <i class="material-icons mr-1">playlist_add_check</i>
                                                        <span class="text-small">6/10</span>
                                                    </div>
                                                    <span class="text-small" data-filter-by="text">
                                                        <?php
                                                        $tanggal = new DateTime($pu['tanggal_mulai']);
                                                        $batas = new DateTime($pu['batas_waktu']);
                                                        $duedate = $batas->diff($tanggal);

                                                        ?>
                                                        Due <?= $duedate->d; ?> days
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            <?php } ?>
                        </div>
                        <!--end of content list body-->
                    </div>
                    <!--end of content list-->
                </div>
                <!--end of tab-->
                <div class="tab-pane fade" id="members" role="tabpanel" data-filter-list="content-list-body">
                    <div class="content-list">
                        <div class="row content-list-head">
                            <div class="col-auto">
                                <h3>Members</h3>

                            </div>
                            <form class="col-md-auto">
                                <div class="input-group input-group-round">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="material-icons">filter_list</i>
                                        </span>
                                    </div>
                                    <input type="search" class="form-control filter-list-input" placeholder="Filter members" aria-label="Filter Members">
                                </div>
                            </form>
                        </div>
                        <!--end of content list head-->
                        <div class="content-list-body row">

                            <?php foreach ($fotoMemberTeam as $fmt) : ?>
                                <div class="col-6">
                                    <a class="media media-member" href="#">
                                        <img alt="<?= $fmt['nama']; ?>" src="<?= base_url(); ?>/assets/img/<?= $fmt['foto']; ?>" class="avatar avatar-lg" />
                                        <div class="media-body">
                                            <h6 class="mb-0" data-filter-by="text"><?= $fmt['nama']; ?></h6>
                                            <span data-filter-by="text" class="text-body"><?= $fmt['role']; ?></span>
                                        </div>
                                    </a>
                                </div>
                            <?php endforeach; ?>

                        </div>
                    </div>
                    <!--end of content list-->
                </div>
            </div>

            <div class="modal fade" id="project-add-modal" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">New Project</h5>
                            <button type="button" class="close btn btn-round" data-dismiss="modal" aria-label="Close">
                                <i class="material-icons">close</i>
                            </button>
                        </div>
                        <!--end of modal head-->
                        <ul class="nav nav-tabs nav-fill" role="tablist">

                        </ul>
                        <div class="modal-body">
                            <div class="tab-content">
                                <div class="tab-pane fade show active" id="project-add-details" role="tabpanel">
                                    <h6>General Details</h6>
                                    <div class="form-group row align-items-center">
                                        <label class="col-3">Name</label>
                                        <input class="form-control col" type="text" placeholder="Project name" id="namaProject" name="namaProject" />
                                        <input type="hidden" id="idTeam" value="<?= $idTeam; ?>">
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-3">Description</label>
                                        <textarea class="form-control col" rows="3" placeholder="Project description" id="deskripsiProject" name="deskripsiProject"></textarea>
                                    </div>
                                    <hr>
                                    <h6>Timeline</h6>
                                    <div class="form-group row align-items-center">
                                        <label class="col-3">Start Date</label>
                                        <input class="form-control col" type="text" name="project-start" id="tanggalMulai" placeholder="Select a date" data-flatpickr data-default-date="<?= date("Y-m-d"); ?>" data-alt-input="true" />
                                    </div>
                                    <div class="form-group row align-items-center">
                                        <label class="col-3">Due Date</label>
                                        <input class="form-control col" type="text" name="project-due" id="batasWaktu" placeholder="Select a date" data-flatpickr data-default-date="<?= date("Y-m-d"); ?>" data-alt-input="true" />
                                    </div>
                                    <div class="alert alert-warning text-small" role="alert">
                                        <span>You can change due dates at any time.</span>
                                    </div>
                                    <hr>

                                </div>

                            </div>
                        </div>
                        <!--end of modal body-->
                        <div class="modal-footer">
                            <button role="button" class="btn btn-primary tombol-add-project" type="submit">
                                Create Project
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <?php foreach ($project as $p) : ?>
                <div class="modal fade" id="project-edit-modal<?= $p['id']; ?>" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Edit Project <button class="badge badge-dark"><?= $p['nama_project']; ?></button></h5>
                                <button type="button" class="close btn btn-round" data-dismiss="modal" aria-label="Close">
                                    <i class="material-icons">close</i>
                                </button>
                            </div>
                            <!--end of modal head-->
                            <ul class="nav nav-tabs nav-fill" role="tablist">

                            </ul>
                            <div class="modal-body">
                                <div class="tab-content">
                                    <div class="tab-pane fade show active" id="project-add-details" role="tabpanel">
                                        <h6>General Details</h6>
                                        <div class="form-group row align-items-center">
                                            <label class="col-3">Name</label>
                                            <input class="form-control col" type="text" placeholder="Project name" id="editNamaProject" name="namaProject" value="<?= $p['nama_project']; ?>" />
                                            <input type="hidden" id="idTeam" value="<?= $idTeam; ?>">
                                            <input type="hidden" id="id" value="<?= $p['id']; ?>">
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-3">Description</label>
                                            <textarea class="form-control col" rows="3" placeholder="Project description" id="editDeskripsiProject" name="deskripsiProject"><?= $p['deskripsi_project']; ?></textarea>
                                        </div>
                                        <hr>
                                        <h6>Timeline</h6>
                                        <div class="form-group row align-items-center">
                                            <label class="col-3">Start Date</label>
                                            <input class="form-control col" type="text" name="project-start" id="editTanggalMulai" placeholder="Select a date" data-flatpickr data-default-date="<?= $p['tanggal_mulai'] ?>" data-alt-input="true" />
                                        </div>
                                        <div class="form-group row align-items-center">
                                            <label class="col-3">Due Date</label>
                                            <input class="form-control col" type="text" name="project-due" id="editBatasWaktu" placeholder="Select a date" data-flatpickr data-default-date="<?= $p['batas_waktu'] ?>" data-alt-input="true" />
                                        </div>
                                        <div class="alert alert-warning text-small" role="alert">
                                            <span>You can change due dates at any time.</span>
                                        </div>
                                        <hr>

                                    </div>

                                </div>
                            </div>
                            <!--end of modal body-->
                            <div class="modal-footer">
                                <button role="button" class="btn btn-primary tombol-edit-project" type="submit">
                                    Edit Project
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>

        </div>
    </div>
</div>

<?php foreach ($project as $p) : ?>
    <form class="modal fade" id="member-add-project<?= $p['id']; ?>" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Member <button class="badge badge-dark"><?= $p['nama_project']; ?></button></h5>
                    <button type="button" class="close btn btn-round" data-dismiss="modal" aria-label="Close">
                        <i class="material-icons">close</i>
                    </button>
                </div>
                <!--end of modal head-->

                <div class="modal-body">
                    <div class="tab-content">

                        <div class="tab-pane fade show active" id="team-add-members" role="tabpanel">
                            <div class="users-manage" data-filter-list="form-group-users">
                                <div class="mb-3">
                                    <ul class="avatars text-center">

                                        <?php foreach (detailFotoProject($p['id']) as $fp) : ?>
                                            <li>
                                                <img alt="<?= $fp['nama']; ?>" src="<?= base_url(); ?>/assets/img/<?= $fp['foto']; ?>" class="avatar" data-toggle="tooltip" data-title="<?= $fp['nama']; ?>" />
                                            </li>
                                        <?php endforeach; ?>


                                    </ul>
                                </div>
                                <div class="input-group input-group-round">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="material-icons">filter_list</i>
                                        </span>
                                    </div>
                                    <input type="search" class="form-control filter-list-input" placeholder="Filter members" aria-label="Filter Members">
                                </div>

                                <div class="form-group-users">
                                    <?php foreach ($datausers as $u) : ?>
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input checkbox-member-project" id="user-manage-<?= $p['id']; ?><?= $u['id']; ?>" data-project="<?= $p['id']; ?>" data-user="<?= $u['id']; ?>" <?= check_member_project($p['id'], $u['id']); ?>>
                                            <label class="custom-control-label" for="user-manage-<?= $p['id']; ?><?= $u['id']; ?>">
                                                <span class="d-flex align-items-center">
                                                    <img alt="<?= $u['nama']; ?>" src="<?= base_url(); ?>/assets/img/<?= $u['foto']; ?>" class="avatar mr-2" />
                                                    <span class="h6 mb-0" data-filter-by="text"><?= $u['nama']; ?></span>
                                                </span>
                                            </label>
                                        </div>
                                    <?php endforeach; ?>

                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <!--end of modal body-->
                <div class="modal-footer">
                    <a href="<?= base_url('team/detailTeam'); ?>/<?= $p['id_team']; ?>" role="button" class="btn btn-primary">
                        Done
                    </a>
                </div>
            </div>
        </div>
    </form>
<?php endforeach; ?>

<?= $this->endSection(); ?>
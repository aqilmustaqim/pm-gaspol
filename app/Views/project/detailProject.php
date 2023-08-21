<?= $this->extend('layouts/index'); ?>
<?= $this->section('content'); ?>
<div class="container">
    <div class="project" data-project="<?= session()->getFlashdata('project'); ?>"></div>
    <div class="row justify-content-center">
        <div class="col-lg-11 col-xl-10">
            <div class="page-header">
                <h1><?= $project['nama_project']; ?></h1>
                <p class="lead"><?= $project['deskripsi_project']; ?></p>
                <div class="d-flex align-items-center">
                    <ul class="avatars">
                        <?php foreach (detailFotoProject($project['id']) as $dfp) : ?>
                            <li>
                                <a href="#" data-toggle="tooltip" data-placement="top" title="<?= $dfp['nama']; ?>">
                                    <img alt="<?= $dfp['nama']; ?>" class="avatar" src="<?= base_url(); ?>/assets/img/<?= $dfp['foto']; ?>" />
                                </a>
                            </li>
                        <?php endforeach; ?>

                    </ul>
                </div>
                <div>
                    <?php
                    $taskSelesai = passedTaskProject($project['id']);
                    $totalTask = totalTaskProject($project['id'])['id'];

                    if ($totalTask > 0) {
                        $persentaseProgress = ($taskSelesai / $totalTask) * 100;
                    } else {
                        $persentaseProgress = 0; // Atau nilai lain yang sesuai jika $totalTask adalah nol
                    }
                    $progressWarna = ($taskSelesai === 0) ? 'bg-danger' : 'bg-success';
                    ?>
                    <div class="progress">
                        <div class="progress-bar <?= $progressWarna; ?>" style="width:<?= $persentaseProgress; ?>%;"></div>
                    </div>
                    <div class="d-flex justify-content-between text-small">
                        <div class="d-flex align-items-center">
                            <i class="material-icons">playlist_add_check</i>
                            <span><?= passedTaskProject($project['id']); ?>/<?= totalTaskProject($project['id'])['id']; ?></span>
                        </div>

                        <span>
                            <?= hitungSelisihBatasWaktu($project['batas_waktu']); ?>
                        </span>
                    </div>
                </div>
            </div>
            <ul class="nav nav-tabs nav-fill" role="tablist">


            </ul>
            <div class="tab-content">
                <div class="tab-pane fade show active" id="tasks" role="tabpanel" data-filter-list="card-list-body">
                    <div class="row content-list-head">
                        <div class="col-auto">
                            <h3>Tasks</h3>
                            <?php if (session()->get('role_id') == 3) { ?>
                            <?php } else { ?>
                                <button class="btn btn-round" data-toggle="modal" data-target="#task-add-modal">
                                    <i class="material-icons">add</i>
                                </button>
                            <?php } ?>
                        </div>
                        <form class="col-md-auto">
                            <div class="input-group input-group-round">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="material-icons">filter_list</i>
                                    </span>
                                </div>
                                <input type="search" class="form-control filter-list-input" placeholder="Filter tasks" aria-label="Filter Tasks">
                            </div>
                        </form>
                    </div>
                    <!--end of content list head-->
                    <div class="content-list-body">
                        <div class="card-list">
                            <div class="card-list-head">
                                <h6>Evaluation</h6>
                                <div class="dropdown">
                                    <button class="btn-options" type="button" id="cardlist-dropdown-button-1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="material-icons">more_vert</i>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a class="dropdown-item" href="#">Rename</a>
                                        <a class="dropdown-item text-danger" href="#">Archive</a>
                                    </div>
                                </div>
                            </div>
                            <div class="card-list-body">

                                <?php if (session()->get('role_id') == 3) { ?>

                                    <!-- CARD TASK UNTUK MEMBER -->
                                    <?php foreach ($taskmember as $tm) : ?>
                                        <div class="card card-task">
                                            <div class="progress">
                                                <div class="progress-bar bg-danger" role="progressbar" style="width: 75%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                            <div class="card-body">
                                                <div class="card-title">
                                                    <a href="<?= base_url(); ?>/task/detailTask/<?= $tm['id_task']; ?>">
                                                        <h6 data-filter-by="text"><?= $tm['nama_task']; ?></h6>
                                                    </a>

                                                    <span class="text-small"><?= hitungSelisihBatasWaktu($tm['batas_task']); ?></span>

                                                </div>
                                                <div class="card-meta">
                                                    <ul class="avatars">
                                                        <?php foreach (detailFotoTask($tm['id_task']) as $dft) : ?>
                                                            <li>
                                                                <a href="#" data-toggle="tooltip" title="<?= $dft['nama']; ?>">
                                                                    <img alt="<?= $dft['nama']; ?>" class="avatar" src="<?= base_url(); ?>/assets/img/<?= $dft['foto']; ?>" />
                                                                </a>
                                                            </li>
                                                        <?php endforeach; ?>



                                                    </ul>
                                                    <div class="d-flex align-items-center">
                                                        <i class="material-icons">playlist_add_check</i>
                                                        <span><?= passedListTask($tm['id_task']); ?>/<?= totalListTask($tm['id_task'])['id']; ?></span>
                                                    </div>
                                                    <div class="dropdown card-options">
                                                        <button class="btn-options" type="button" id="task-dropdown-button-1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            <i class="material-icons">more_vert</i>
                                                        </button>
                                                        <div class="dropdown-menu dropdown-menu-right">

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>

                                <?php } else { ?>
                                    <?php foreach ($task as $t) : ?>
                                        <div class="card card-task">
                                            <?php
                                            $taskSelesai = passedListTask($t['id']);
                                            $totalTask = totalListTask($t['id'])['id'];

                                            if ($totalTask > 0) {
                                                $persentaseProgressTask = ($taskSelesai / $totalTask) * 100;
                                            } else {
                                                $persentaseProgressTask = 0; // Atau nilai lain yang sesuai jika $totalTask adalah nol
                                            }
                                            $progressWarnaTask = ($taskSelesai === 0) ? 'bg-danger' : 'bg-success';


                                            ?>
                                            <div class="progress">
                                                <div class="progress-bar <?= $progressWarnaTask; ?>" role="progressbar" style="width: <?= $persentaseProgressTask; ?>%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                            <div class="card-body">
                                                <div class="card-title">
                                                    <a href="<?= base_url(); ?>/task/detailTask/<?= $t['id']; ?>">
                                                        <h6 data-filter-by="text"><?= $t['nama_task']; ?></h6>
                                                    </a>

                                                    <span class="text-small"><?= hitungSelisihBatasWaktu($t['batas_task']); ?></span>
                                                </div>
                                                <div class="card-meta">
                                                    <ul class="avatars">
                                                        <?php foreach (detailFotoTask($t['id']) as $dft) : ?>
                                                            <li>
                                                                <a href="#" data-toggle="tooltip" title="<?= $dft['nama']; ?>">
                                                                    <img alt="<?= $dft['nama']; ?>" class="avatar" src="<?= base_url(); ?>/assets/img/<?= $dft['foto']; ?>" />
                                                                </a>
                                                            </li>
                                                        <?php endforeach; ?>



                                                    </ul>
                                                    <div class="d-flex align-items-center">
                                                        <i class="material-icons">playlist_add_check</i>
                                                        <span><?= passedListTask($t['id']); ?>/<?= totalListTask($t['id'])['id']; ?></span>
                                                    </div>
                                                    <div class="dropdown card-options">
                                                        <button class="btn-options" type="button" id="task-dropdown-button-1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            <i class="material-icons">more_vert</i>
                                                        </button>
                                                        <div class="dropdown-menu dropdown-menu-right">
                                                            <?php if (session()->get('role_id') == 3) { ?>

                                                            <?php } else { ?>
                                                                <button class="dropdown-item" data-toggle="modal" data-target="#member-add-task<?= $t['id']; ?>">Add Member</button>
                                                            <?php } ?>
                                                            <div class="dropdown-divider"></div>
                                                            <a class="dropdown-item text-danger" href="#">Archive</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                <?php } ?>
                            </div>
                        </div>

                        <!--end of content list body-->
                    </div>
                    <!--end of content list-->
                </div>
                <!--end of tab-->


            </div>


            <div class="modal fade" id="task-add-modal" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">New Task</h5>
                            <button type="button" class="close btn btn-round" data-dismiss="modal" aria-label="Close">
                                <i class="material-icons">close</i>
                            </button>
                        </div>
                        <!--end of modal head-->
                        <ul class="nav nav-tabs nav-fill" role="tablist">

                        </ul>
                        <div class="modal-body">
                            <div class="tab-content">
                                <div class="tab-pane fade show active" id="task-add-details" role="tabpanel">
                                    <h6>General Details</h6>
                                    <div class="form-group row align-items-center">
                                        <label class="col-3">Name</label>
                                        <input class="form-control col" type="text" id="namaTask" placeholder="Task name" name="task-name" />
                                        <input type="hidden" id="idProject" value="<?= $project['id']; ?>">
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-3">Description</label>
                                        <textarea class="form-control col" rows="3" id="deskripsiTask" placeholder="Task description" name="task-description"></textarea>
                                    </div>
                                    <hr>
                                    <h6>Timeline</h6>
                                    <div class="form-group row align-items-center">
                                        <label class="col-3">Start Date</label>
                                        <input class="form-control col" type="text" id="tanggalTask" name="task-start" placeholder="Select a date" data-flatpickr data-default-date="<?= date('Y-m-d'); ?>" data-alt-input="true" />
                                    </div>
                                    <div class="form-group row align-items-center">
                                        <label class="col-3">Due Date</label>
                                        <input class="form-control col" type="text" id="batasTask" name="task-due" placeholder="Select a date" data-flatpickr data-default-date="<?= date('Y-m-d'); ?>" data-alt-input="true" />

                                    </div>
                                    <div class="alert alert-warning text-small" role="alert">
                                        <span>You can change due dates at any time.</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--end of modal body-->
                        <div class="modal-footer">
                            <button role="button" class="btn btn-primary tombol-add-task" type="submit">
                                Create Task
                            </button>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<?php foreach ($task as $t) : ?>
    <form class="modal fade" id="member-add-task<?= $t['id']; ?>" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Member <button class="badge badge-dark"><?= $t['nama_task']; ?></button></h5>
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

                                        <?php foreach (detailFotoTask($t['id']) as $ft) : ?>
                                            <li>
                                                <img alt="<?= $ft['nama']; ?>" src="<?= base_url(); ?>/assets/img/<?= $ft['foto']; ?>" class="avatar" data-toggle="tooltip" data-title="<?= $ft['nama']; ?>" />
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
                                            <input type="checkbox" class="custom-control-input checkbox-member-task" id="user-manage-<?= $t['id']; ?><?= $u['id']; ?>" data-task="<?= $t['id']; ?>" data-user="<?= $u['id']; ?>" <?= check_member_task($t['id'], $u['id']); ?>>
                                            <label class="custom-control-label" for="user-manage-<?= $t['id']; ?><?= $u['id']; ?>">
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
                    <a href="<?= base_url('project/detailProject'); ?>/<?= $t['id_project']; ?>" role="button" class="btn btn-primary">
                        Done
                    </a>
                </div>
            </div>
        </div>
    </form>
<?php endforeach; ?>

<?= $this->endSection(); ?>
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
                    <div class="progress">
                        <div class="progress-bar bg-success" style="width:25%;"></div>
                    </div>
                    <div class="d-flex justify-content-between text-small">
                        <div class="d-flex align-items-center">
                            <i class="material-icons">playlist_add_check</i>
                            <span>3/12</span>
                        </div>
                        <?php
                        $tanggal = new DateTime($project['tanggal_mulai']);
                        $batas = new DateTime($project['batas_waktu']);
                        $duedate = $batas->diff($tanggal);

                        ?>
                        <span>Due <?= $duedate->d; ?> days</span>
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
                            <button class="btn btn-round" data-toggle="modal" data-target="#task-add-modal">
                                <i class="material-icons">add</i>
                            </button>
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

                                <div class="card card-task">
                                    <div class="progress">
                                        <div class="progress-bar bg-danger" role="progressbar" style="width: 75%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <div class="card-body">
                                        <div class="card-title">
                                            <a href="#">
                                                <h6 data-filter-by="text">Client objective meeting</h6>
                                            </a>
                                            <span class="text-small">Today</span>
                                        </div>
                                        <div class="card-meta">
                                            <ul class="avatars">

                                                <li>
                                                    <a href="#" data-toggle="tooltip" title="Sally">
                                                        <img alt="Sally Harper" class="avatar" src="<?= base_url(); ?>/assets/img/avatar-female-3.jpg" />
                                                    </a>
                                                </li>



                                            </ul>
                                            <div class="d-flex align-items-center">
                                                <i class="material-icons">playlist_add_check</i>
                                                <span>3/4</span>
                                            </div>
                                            <div class="dropdown card-options">
                                                <button class="btn-options" type="button" id="task-dropdown-button-1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="material-icons">more_vert</i>
                                                </button>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <a class="dropdown-item" href="#">Mark as done</a>
                                                    <div class="dropdown-divider"></div>
                                                    <a class="dropdown-item text-danger" href="#">Archive</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="card card-task">
                                    <div class="progress">
                                        <div class="progress-bar bg-warning" role="progressbar" style="width: 20%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <div class="card-body">
                                        <div class="card-title">
                                            <a href="#">
                                                <h6 data-filter-by="text">Target market trend analysis</h6>
                                            </a>
                                            <span class="text-small">5 days</span>
                                        </div>
                                        <div class="card-meta">
                                            <ul class="avatars">

                                                <li>
                                                    <a href="#" data-toggle="tooltip" title="Peggy">
                                                        <img alt="Peggy Brown" class="avatar" src="<?= base_url(); ?>/assets/img/avatar-female-2.jpg" />
                                                    </a>
                                                </li>


                                            </ul>
                                            <div class="d-flex align-items-center">
                                                <i class="material-icons">playlist_add_check</i>
                                                <span>2/10</span>
                                            </div>
                                            <div class="dropdown card-options">
                                                <button class="btn-options" type="button" id="task-dropdown-button-2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="material-icons">more_vert</i>
                                                </button>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <a class="dropdown-item" href="#">Mark as done</a>
                                                    <div class="dropdown-divider"></div>
                                                    <a class="dropdown-item text-danger" href="#">Archive</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="card card-task">
                                    <div class="progress">
                                        <div class="progress-bar bg-success" role="progressbar" style="width: 0%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <div class="card-body">
                                        <div class="card-title">
                                            <a href="#">
                                                <h6 data-filter-by="text">Assemble Outcomes Report for client</h6>
                                            </a>
                                            <span class="text-small">7 days</span>
                                        </div>
                                        <div class="card-meta">
                                            <ul class="avatars">

                                                <li>
                                                    <a href="#" data-toggle="tooltip" title="Marcus">
                                                        <img alt="Marcus Simmons" class="avatar" src="<?= base_url(); ?>/assets/img/avatar-male-1.jpg" />
                                                    </a>
                                                </li>



                                            </ul>
                                            <div class="d-flex align-items-center">
                                                <i class="material-icons">playlist_add_check</i>
                                                <span>0/6</span>
                                            </div>
                                            <div class="dropdown card-options">
                                                <button class="btn-options" type="button" id="task-dropdown-button-3" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="material-icons">more_vert</i>
                                                </button>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <a class="dropdown-item" href="#">Mark as done</a>
                                                    <div class="dropdown-divider"></div>
                                                    <a class="dropdown-item text-danger" href="#">Archive</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

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

<?= $this->endSection(); ?>
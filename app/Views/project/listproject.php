<?= $this->extend('layouts/index'); ?>
<?= $this->section('content'); ?>

<div class="container">
    <div class="team" data-team="<?= session()->getFlashdata('team'); ?>"></div>
    <div class="row justify-content-center">
        <div class="col-lg-11 col-xl-10">
            <div class="page-header">
                <h1>List All Project &#x2615;</h1>

                <div class="d-flex align-items-center">
                    <ul class="avatars">

                        <?php foreach ($fotoMemberProject as $fmp) : ?>
                            <li>
                                <a href="#" data-toggle="tooltip" data-placement="top" title="<?= $fmp['nama']; ?>">
                                    <img alt="<?= $fmp['nama']; ?>" class="avatar" src="<?= base_url(); ?>/assets/img/<?= $fmp['foto']; ?>" />
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

            </ul>
            <div class="tab-content">
                <div class="tab-pane fade show active" id="projects" role="tabpanel" data-filter-list="content-list-body">
                    <div class="content-list">
                        <div class="row content-list-head">
                            <div class="col-auto">
                                <h3>Projects</h3>
                                <button class="btn btn-round" data-toggle="modal" data-target="#project-add-modal">
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
                                    <input type="search" class="form-control filter-list-input" placeholder="Filter projects" aria-label="Filter Projects">
                                </div>
                            </form>
                        </div>
                        <!--end of content list head-->
                        <div class="content-list-body row">
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
                        </div>
                        <!--end of content list body-->
                    </div>
                    <!--end of content list-->
                </div>
                <!--end of tab-->

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

                                    </div>
                                    <div class="form-group row">
                                        <label class="col-3">Description</label>
                                        <textarea class="form-control col" rows="3" placeholder="Project description" id="deskripsiProject" name="deskripsiProject"></textarea>
                                    </div>
                                    <label for="category" class="form-label">Pilih Team</label>
                                    <select class="form-control col" rows="3" name="idTeam" id="idTeam" required>
                                        <?php foreach ($team as $t) : ?>
                                            <option value="<?= $t['id']; ?>"><?= $t['team']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
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

        </div>
    </div>
</div>

<?= $this->endSection(); ?>
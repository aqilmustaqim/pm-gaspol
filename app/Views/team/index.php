<?= $this->extend('layouts/index'); ?>
<?= $this->section('content'); ?>
<div class="container">
    <div class="team" data-team="<?= session()->getFlashdata('team'); ?>"></div>
    <div class="row justify-content-center">
        <div class="col-lg-11 col-xl-10">
            <div class="page-header mb-4">
                <div class="media">
                    <img alt="Image" src="<?= base_url(); ?>/assets/img/<?= session()->get('foto'); ?>" class="avatar avatar-lg mt-1" />
                    <div class="media-body ml-3">
                        <h1 class="mb-0"><?= session()->get('nama'); ?></h1>
                        <p class="lead"><?= $userposition['posisi']; ?></p>
                    </div>
                </div>
            </div>
            <hr>
            <?php if (session()->get('role_id') != 1) { ?>
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="teams" role="tabpanel" data-filter-list="content-list-body">
                        <div class="row content-list-head">
                            <div class="col-auto">
                                <h3>Teams</h3>

                            </div>
                            <form class="col-md-auto">
                                <div class="input-group input-group-round">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="material-icons">filter_list</i>
                                        </span>
                                    </div>
                                    <input type="search" class="form-control filter-list-input" placeholder="Filter teams" aria-label="Filter teams">
                                </div>
                            </form>
                        </div>
                        <!--end of content list head-->
                        <div class="content-list-body row">

                            <!-- Content Teamnya Disini -->
                            <?php foreach ($datateamuser as $dtu) : ?>
                                <div class="col-md-6">
                                    <div class="card card-team">
                                        <div class="card-body">
                                            <div class="dropdown card-options">
                                                <button class="btn-options" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="material-icons">more_vert</i>
                                                </button>
                                                <div class="dropdown-menu dropdown-menu-right">

                                                    <a class="dropdown-item text-danger tombol-leave-team" href="<?= base_url(); ?>/team/leaveTeam/<?= $dtu['id_team']; ?>">Leave Team</a>
                                                </div>
                                            </div>

                                            <div class="card-title">
                                                <a href="#">
                                                    <h5 data-filter-by="text"><?= $dtu['team']; ?></h5>
                                                </a>
                                                <span>4 Projects, <?= jumlahMemberTeam($dtu['id_team'])['id']; ?> Members</span>
                                            </div>
                                            <ul class="avatars">

                                                <?php foreach (detailFotoTeam($dtu['id_team']) as $d) : ?>
                                                    <li>
                                                        <a href="#" data-toggle="tooltip" title="<?= $d['nama']; ?>">
                                                            <img alt="<?= $d['nama']; ?>" class="avatar" src="<?= base_url(); ?>/assets/img/<?= $d['foto']; ?>" />
                                                        </a>
                                                    </li>


                                                <?php endforeach; ?>

                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>

                        </div>
                        <!--end of content-list-body-->
                    </div>
                    <!--end of tab-->
                </div>
            <?php } else { ?>

                <div class="tab-content">
                    <div class="tab-pane fade show active" id="teams" role="tabpanel" data-filter-list="content-list-body">
                        <div class="row content-list-head">
                            <div class="col-auto">
                                <h3>Teams</h3>
                                <button class="btn btn-round" data-toggle="modal" data-target="#team-add-modal">
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
                                    <input type="search" class="form-control filter-list-input" placeholder="Filter teams" aria-label="Filter teams">
                                </div>
                            </form>
                        </div>
                        <!--end of content list head-->
                        <div class="content-list-body row">

                            <!-- Content Teamnya Disini -->
                            <?php foreach ($datateam as $dt) : ?>
                                <div class="col-md-6">
                                    <div class="card card-team">
                                        <div class="card-body">
                                            <div class="dropdown card-options">
                                                <button class="btn-options" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="material-icons">more_vert</i>
                                                </button>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <button class="dropdown-item" data-toggle="modal" data-target="#member-add-modal<?= $dt['id']; ?>">Manage</button>
                                                    <div class="dropdown-divider"></div>
                                                    <a class="dropdown-item text-danger tombol-hapus" href="<?= base_url(); ?>/team/deleteTeam/<?= $dt['id']; ?>">Delete Team</a>
                                                </div>
                                            </div>

                                            <div class="card-title">
                                                <a href="#">
                                                    <h5 data-filter-by="text"><?= $dt['team']; ?></h5>
                                                </a>
                                                <span>4 Projects, <?= jumlahMemberTeam($dt['id'])['id']; ?> Members</span>
                                            </div>
                                            <ul class="avatars">

                                                <?php foreach (detailFotoTeam($dt['id']) as $d) : ?>
                                                    <li>
                                                        <a href="#" data-toggle="tooltip" title="<?= $d['nama']; ?>">
                                                            <img alt="<?= $d['nama']; ?>" class="avatar" src="<?= base_url(); ?>/assets/img/<?= $d['foto']; ?>" />
                                                        </a>
                                                    </li>


                                                <?php endforeach; ?>

                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>

                        </div>
                        <!--end of content-list-body-->
                    </div>
                    <!--end of tab-->
                </div>

                <!-- Modal Add Team -->
                <div class="modal fade" id="team-add-modal" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">New Team</h5>
                                <button type="button" class="close btn btn-round" data-dismiss="modal" aria-label="Close">
                                    <i class="material-icons">close</i>
                                </button>
                            </div>
                            <!--end of modal head-->

                            <div class="modal-body">
                                <div class="tab-content">
                                    <div class="tab-pane fade show active" id="team-add-details" role="tabpanel">
                                        <h6>Team Details</h6>
                                        <div class="form-group row align-items-center">
                                            <label class="col-3">Name</label>
                                            <input class="form-control col" type="text" placeholder="Team name" name="team-name" id="namateam" />
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-3">Description</label>
                                            <textarea class="form-control col" rows="3" placeholder="Team description" name="team-description" id="deskripsiteam"></textarea>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <!--end of modal body-->
                            <div class="modal-footer">
                                <button role="button" class="btn btn-primary btn-team" type="submit">
                                    Done
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Modal Add Team -->

                <!-- Modal Add Member -->
                <?php foreach ($datateam as $dt) : ?>
                    <form class="modal fade" id="member-add-modal<?= $dt['id']; ?>" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Add Member <button class="badge badge-dark"><?= $dt['team']; ?></button></h5>
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

                                                        <?php foreach (detailFotoTeam($dt['id']) as $dft) : ?>
                                                            <li>
                                                                <img alt="<?= $dft['nama']; ?>" src="<?= base_url(); ?>/assets/img/<?= $dft['foto']; ?>" class="avatar" data-toggle="tooltip" data-title="<?= $dft['nama']; ?>" />
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
                                                            <input type="checkbox" class="custom-control-input checkbox-member" id="user-manage-<?= $dt['id']; ?><?= $u['id']; ?>" data-team="<?= $dt['id']; ?>" data-user="<?= $u['id']; ?>" <?= check_member($dt['id'], $u['id']); ?>>
                                                            <label class="custom-control-label" for="user-manage-<?= $dt['id']; ?><?= $u['id']; ?>">
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
                                    <a href="<?= base_url('team'); ?>" role="button" class="btn btn-primary">
                                        Done
                                    </a>
                                </div>
                            </div>
                        </div>
                    </form>
                <?php endforeach; ?>
                <!-- End Modal Add Member -->

            <?php } ?>
        </div>
    </div>
</div>


<?= $this->endSection(); ?>
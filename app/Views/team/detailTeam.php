<?= $this->extend('layouts/index'); ?>
<?= $this->section('content'); ?>

<div class="container">
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
                    <button class="btn btn-round flex-shrink-0" data-toggle="modal" data-target="#user-invite-modal">
                        <i class="material-icons">add</i>
                    </button>
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
                                                    <a class="dropdown-item" href="#">Edit</a>
                                                    <button class="dropdown-item" data-toggle="modal" data-target="#member-add-project<?= $p['id']; ?>">Add Member</button>
                                                </div>
                                            </div>
                                            <div class="card-title">
                                                <a href="#">
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
                                                <span class="text-small" data-filter-by="text">Due 4 days</span>
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
                <div class="tab-pane fade" id="members" role="tabpanel" data-filter-list="content-list-body">
                    <div class="content-list">
                        <div class="row content-list-head">
                            <div class="col-auto">
                                <h3>Members</h3>
                                <button class="btn btn-round" data-toggle="modal" data-target="#user-invite-modal">
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
                                    <input type="search" class="form-control filter-list-input" placeholder="Filter members" aria-label="Filter Members">
                                </div>
                            </form>
                        </div>
                        <!--end of content list head-->
                        <div class="content-list-body row">

                            <div class="col-6">
                                <a class="media media-member" href="#">
                                    <img alt="Claire Connors" src="assets/img/avatar-female-1.jpg" class="avatar avatar-lg" />
                                    <div class="media-body">
                                        <h6 class="mb-0" data-filter-by="text">Claire Connors</h6>
                                        <span data-filter-by="text" class="text-body">Administrator</span>
                                    </div>
                                </a>
                            </div>

                            <div class="col-6">
                                <a class="media media-member" href="#">
                                    <img alt="Marcus Simmons" src="assets/img/avatar-male-1.jpg" class="avatar avatar-lg" />
                                    <div class="media-body">
                                        <h6 class="mb-0" data-filter-by="text">Marcus Simmons</h6>
                                        <span data-filter-by="text" class="text-body">Administrator</span>
                                    </div>
                                </a>
                            </div>

                            <div class="col-6">
                                <a class="media media-member" href="#">
                                    <img alt="Peggy Brown" src="assets/img/avatar-female-2.jpg" class="avatar avatar-lg" />
                                    <div class="media-body">
                                        <h6 class="mb-0" data-filter-by="text">Peggy Brown</h6>
                                        <span data-filter-by="text" class="text-body">Project Manager</span>
                                    </div>
                                </a>
                            </div>

                            <div class="col-6">
                                <a class="media media-member" href="#">
                                    <img alt="Harry Xai" src="assets/img/avatar-male-2.jpg" class="avatar avatar-lg" />
                                    <div class="media-body">
                                        <h6 class="mb-0" data-filter-by="text">Harry Xai</h6>
                                        <span data-filter-by="text" class="text-body">Project Manager</span>
                                    </div>
                                </a>
                            </div>

                            <div class="col-6">
                                <a class="media media-member" href="#">
                                    <img alt="Sally Harper" src="assets/img/avatar-female-3.jpg" class="avatar avatar-lg" />
                                    <div class="media-body">
                                        <h6 class="mb-0" data-filter-by="text">Sally Harper</h6>
                                        <span data-filter-by="text" class="text-body">Developer</span>
                                    </div>
                                </a>
                            </div>

                            <div class="col-6">
                                <a class="media media-member" href="#">
                                    <img alt="Ravi Singh" src="assets/img/avatar-male-3.jpg" class="avatar avatar-lg" />
                                    <div class="media-body">
                                        <h6 class="mb-0" data-filter-by="text">Ravi Singh</h6>
                                        <span data-filter-by="text" class="text-body">Developer</span>
                                    </div>
                                </a>
                            </div>

                            <div class="col-6">
                                <a class="media media-member" href="#">
                                    <img alt="Kristina Van Der Stroem" src="assets/img/avatar-female-4.jpg" class="avatar avatar-lg" />
                                    <div class="media-body">
                                        <h6 class="mb-0" data-filter-by="text">Kristina Van Der Stroem</h6>
                                        <span data-filter-by="text" class="text-body">Developer</span>
                                    </div>
                                </a>
                            </div>

                            <div class="col-6">
                                <a class="media media-member" href="#">
                                    <img alt="David Whittaker" src="assets/img/avatar-male-4.jpg" class="avatar avatar-lg" />
                                    <div class="media-body">
                                        <h6 class="mb-0" data-filter-by="text">David Whittaker</h6>
                                        <span data-filter-by="text" class="text-body">Designer</span>
                                    </div>
                                </a>
                            </div>

                            <div class="col-6">
                                <a class="media media-member" href="#">
                                    <img alt="Kerri-Anne Banks" src="assets/img/avatar-female-5.jpg" class="avatar avatar-lg" />
                                    <div class="media-body">
                                        <h6 class="mb-0" data-filter-by="text">Kerri-Anne Banks</h6>
                                        <span data-filter-by="text" class="text-body">Marketing</span>
                                    </div>
                                </a>
                            </div>

                            <div class="col-6">
                                <a class="media media-member" href="#">
                                    <img alt="Masimba Sibanda" src="assets/img/avatar-male-5.jpg" class="avatar avatar-lg" />
                                    <div class="media-body">
                                        <h6 class="mb-0" data-filter-by="text">Masimba Sibanda</h6>
                                        <span data-filter-by="text" class="text-body">Designer</span>
                                    </div>
                                </a>
                            </div>

                            <div class="col-6">
                                <a class="media media-member" href="#">
                                    <img alt="Krishna Bajaj" src="assets/img/avatar-female-6.jpg" class="avatar avatar-lg" />
                                    <div class="media-body">
                                        <h6 class="mb-0" data-filter-by="text">Krishna Bajaj</h6>
                                        <span data-filter-by="text" class="text-body">Marketing</span>
                                    </div>
                                </a>
                            </div>

                            <div class="col-6">
                                <a class="media media-member" href="#">
                                    <img alt="Kenny Tran" src="assets/img/avatar-male-6.jpg" class="avatar avatar-lg" />
                                    <div class="media-body">
                                        <h6 class="mb-0" data-filter-by="text">Kenny Tran</h6>
                                        <span data-filter-by="text" class="text-body">Contributor</span>
                                    </div>
                                </a>
                            </div>

                        </div>
                    </div>
                    <!--end of content list-->
                </div>
            </div>
            <form class="modal fade" id="user-invite-modal" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Invite Users</h5>
                            <button type="button" class="close btn btn-round" data-dismiss="modal" aria-label="Close">
                                <i class="material-icons">close</i>
                            </button>
                        </div>
                        <!--end of modal head-->
                        <div class="modal-body">
                            <p>Send an invite link via email to add members to this team</p>
                            <div>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="material-icons">email</i>
                                        </span>
                                    </div>
                                    <input type="email" class="form-control" placeholder="Recipient email address" aria-label="Recipient email address">
                                </div>
                                <div class="text-right text-small mt-2">
                                    <a href="#" role="button">Add another recipient</a>
                                </div>
                            </div>
                        </div>
                        <!--end of modal body-->
                        <div class="modal-footer">
                            <button role="button" class="btn btn-primary" type="submit">
                                Invite users
                            </button>
                        </div>
                    </div>
                </div>
            </form>
            <form class="modal fade" id="team-manage-modal" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Manage Team</h5>
                            <button type="button" class="close btn btn-round" data-dismiss="modal" aria-label="Close">
                                <i class="material-icons">close</i>
                            </button>
                        </div>
                        <!--end of modal head-->
                        <ul class="nav nav-tabs nav-fill" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="team-manage-details-tab" data-toggle="tab" href="#team-manage-details" role="tab" aria-controls="team-manage-details" aria-selected="true">Details</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="team-manage-members-tab" data-toggle="tab" href="#team-manage-members" role="tab" aria-controls="team-manage-members" aria-selected="false">Members</a>
                            </li>
                        </ul>
                        <div class="modal-body">
                            <div class="tab-content">
                                <div class="tab-pane fade show active" id="team-manage-details" role="tabpanel">
                                    <h6>Team Details</h6>
                                    <div class="form-group row align-items-center">
                                        <label class="col-3">Name</label>
                                        <input class="form-control col" type="text" placeholder="Team name" name="team-name" value="Medium Rare" />
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-3">Description</label>
                                        <textarea class="form-control col" rows="3" placeholder="Team description" name="team-description">A small web studio crafting lovely template products.</textarea>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="team-manage-members" role="tabpanel">
                                    <div class="users-manage" data-filter-list="form-group-users">
                                        <div class="mb-3">
                                            <ul class="avatars text-center">

                                                <li>
                                                    <img alt="Claire Connors" src="assets/img/avatar-female-1.jpg" class="avatar" data-toggle="tooltip" data-title="Claire Connors" />
                                                </li>

                                                <li>
                                                    <img alt="Marcus Simmons" src="assets/img/avatar-male-1.jpg" class="avatar" data-toggle="tooltip" data-title="Marcus Simmons" />
                                                </li>

                                                <li>
                                                    <img alt="Peggy Brown" src="assets/img/avatar-female-2.jpg" class="avatar" data-toggle="tooltip" data-title="Peggy Brown" />
                                                </li>

                                                <li>
                                                    <img alt="Harry Xai" src="assets/img/avatar-male-2.jpg" class="avatar" data-toggle="tooltip" data-title="Harry Xai" />
                                                </li>

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

                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="user-manage-1" checked>
                                                <label class="custom-control-label" for="user-manage-1">
                                                    <span class="d-flex align-items-center">
                                                        <img alt="Claire Connors" src="assets/img/avatar-female-1.jpg" class="avatar mr-2" />
                                                        <span class="h6 mb-0" data-filter-by="text">Claire Connors</span>
                                                    </span>
                                                </label>
                                            </div>

                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="user-manage-2" checked>
                                                <label class="custom-control-label" for="user-manage-2">
                                                    <span class="d-flex align-items-center">
                                                        <img alt="Marcus Simmons" src="assets/img/avatar-male-1.jpg" class="avatar mr-2" />
                                                        <span class="h6 mb-0" data-filter-by="text">Marcus Simmons</span>
                                                    </span>
                                                </label>
                                            </div>

                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="user-manage-3" checked>
                                                <label class="custom-control-label" for="user-manage-3">
                                                    <span class="d-flex align-items-center">
                                                        <img alt="Peggy Brown" src="assets/img/avatar-female-2.jpg" class="avatar mr-2" />
                                                        <span class="h6 mb-0" data-filter-by="text">Peggy Brown</span>
                                                    </span>
                                                </label>
                                            </div>

                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="user-manage-4" checked>
                                                <label class="custom-control-label" for="user-manage-4">
                                                    <span class="d-flex align-items-center">
                                                        <img alt="Harry Xai" src="assets/img/avatar-male-2.jpg" class="avatar mr-2" />
                                                        <span class="h6 mb-0" data-filter-by="text">Harry Xai</span>
                                                    </span>
                                                </label>
                                            </div>

                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="user-manage-5">
                                                <label class="custom-control-label" for="user-manage-5">
                                                    <span class="d-flex align-items-center">
                                                        <img alt="Sally Harper" src="assets/img/avatar-female-3.jpg" class="avatar mr-2" />
                                                        <span class="h6 mb-0" data-filter-by="text">Sally Harper</span>
                                                    </span>
                                                </label>
                                            </div>

                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="user-manage-6">
                                                <label class="custom-control-label" for="user-manage-6">
                                                    <span class="d-flex align-items-center">
                                                        <img alt="Ravi Singh" src="assets/img/avatar-male-3.jpg" class="avatar mr-2" />
                                                        <span class="h6 mb-0" data-filter-by="text">Ravi Singh</span>
                                                    </span>
                                                </label>
                                            </div>

                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="user-manage-7">
                                                <label class="custom-control-label" for="user-manage-7">
                                                    <span class="d-flex align-items-center">
                                                        <img alt="Kristina Van Der Stroem" src="assets/img/avatar-female-4.jpg" class="avatar mr-2" />
                                                        <span class="h6 mb-0" data-filter-by="text">Kristina Van Der Stroem</span>
                                                    </span>
                                                </label>
                                            </div>

                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="user-manage-8">
                                                <label class="custom-control-label" for="user-manage-8">
                                                    <span class="d-flex align-items-center">
                                                        <img alt="David Whittaker" src="assets/img/avatar-male-4.jpg" class="avatar mr-2" />
                                                        <span class="h6 mb-0" data-filter-by="text">David Whittaker</span>
                                                    </span>
                                                </label>
                                            </div>

                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="user-manage-9">
                                                <label class="custom-control-label" for="user-manage-9">
                                                    <span class="d-flex align-items-center">
                                                        <img alt="Kerri-Anne Banks" src="assets/img/avatar-female-5.jpg" class="avatar mr-2" />
                                                        <span class="h6 mb-0" data-filter-by="text">Kerri-Anne Banks</span>
                                                    </span>
                                                </label>
                                            </div>

                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="user-manage-10">
                                                <label class="custom-control-label" for="user-manage-10">
                                                    <span class="d-flex align-items-center">
                                                        <img alt="Masimba Sibanda" src="assets/img/avatar-male-5.jpg" class="avatar mr-2" />
                                                        <span class="h6 mb-0" data-filter-by="text">Masimba Sibanda</span>
                                                    </span>
                                                </label>
                                            </div>

                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="user-manage-11">
                                                <label class="custom-control-label" for="user-manage-11">
                                                    <span class="d-flex align-items-center">
                                                        <img alt="Krishna Bajaj" src="assets/img/avatar-female-6.jpg" class="avatar mr-2" />
                                                        <span class="h6 mb-0" data-filter-by="text">Krishna Bajaj</span>
                                                    </span>
                                                </label>
                                            </div>

                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="user-manage-12">
                                                <label class="custom-control-label" for="user-manage-12">
                                                    <span class="d-flex align-items-center">
                                                        <img alt="Kenny Tran" src="assets/img/avatar-male-6.jpg" class="avatar mr-2" />
                                                        <span class="h6 mb-0" data-filter-by="text">Kenny Tran</span>
                                                    </span>
                                                </label>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--end of modal body-->
                        <div class="modal-footer">
                            <button role="button" class="btn btn-primary" type="submit">
                                Done
                            </button>
                        </div>
                    </div>
                </div>
            </form>
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
                    <a href="<?= base_url('detailTeam'); ?>/<?= $p['id']; ?>" role="button" class="btn btn-primary">
                        Done
                    </a>
                </div>
            </div>
        </div>
    </form>
<?php endforeach; ?>

<?= $this->endSection(); ?>
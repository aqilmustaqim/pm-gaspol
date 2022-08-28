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
                        <a class="dropdown-item text-danger" href="#">Leave Team</a>
                    </div>
                </div>
                <div class="card-title">
                    <a href="#">
                        <h5 data-filter-by="text"><?= $dt['team']; ?></h5>
                    </a>
                    <span>4 Projects, 6 Members</span>
                </div>
                <ul class="avatars">

                    <li>
                        <a href="#" data-toggle="tooltip" title="Kenny">
                            <img alt="Kenny Tran" class="avatar" src="assets/img/avatar-male-6.jpg" />
                        </a>
                    </li>

                    <li>
                        <a href="#" data-toggle="tooltip" title="David">
                            <img alt="David Whittaker" class="avatar" src="assets/img/avatar-male-4.jpg" />
                        </a>
                    </li>

                    <li>
                        <a href="#" data-toggle="tooltip" title="Sally">
                            <img alt="Sally Harper" class="avatar" src="assets/img/avatar-female-3.jpg" />
                        </a>
                    </li>

                    <li>
                        <a href="#" data-toggle="tooltip" title="Kristina">
                            <img alt="Kristina Van Der Stroem" class="avatar" src="assets/img/avatar-female-4.jpg" />
                        </a>
                    </li>

                    <li>
                        <a href="#" data-toggle="tooltip" title="Claire">
                            <img alt="Claire Connors" class="avatar" src="assets/img/avatar-female-1.jpg" />
                        </a>
                    </li>

                    <li>
                        <a href="#" data-toggle="tooltip" title="Marcus">
                            <img alt="Marcus Simmons" class="avatar" src="assets/img/avatar-male-1.jpg" />
                        </a>
                    </li>

                </ul>
            </div>
        </div>
    </div>
<?php endforeach; ?>

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
            <!--end of modal body-->
            <div class="modal-footer">
                <button role="button" class="btn btn-primary btn-team" type="submit">
                    Done
                </button>
            </div>
        </div>
    </div>
</div>
<!-- End Add Team Modal -->

<!-- Modal Add Member -->
<?php foreach ($datateam as $dt) : ?>
    <div class="modal fade" id="member-add-modal<?= $dt['id']; ?>" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">New Team</h5>
                    <button type="button" class="close btn btn-round" data-dismiss="modal" aria-label="Close">
                        <i class="material-icons">close</i>
                    </button>
                </div>
                <!--end of modal head-->
                <ul class="nav nav-tabs nav-fill" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="team-add-details-tab" data-toggle="tab" href="#team-add-details" role="tab" aria-controls="team-add-details" aria-selected="true">Details</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="team-add-members-tab" data-toggle="tab" href="#team-add-members" role="tab" aria-controls="team-add-members" aria-selected="false">Members</a>
                    </li>
                </ul>
                <div class="modal-body">
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="team-add-details" role="tabpanel">
                            <h6>Team Details</h6>
                            <div class="form-group row align-items-center">
                                <label class="col-3">Name</label>
                                <input class="form-control col" type="text" placeholder="Team name" name="team-name" />
                            </div>
                            <div class="form-group row">
                                <label class="col-3">Description</label>
                                <textarea class="form-control col" rows="3" placeholder="Team description" name="team-description"></textarea>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="team-add-members" role="tabpanel">
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
    </div>
<?php endforeach; ?>
<!-- End Modal Add Member -->

<!-- Modal Member -->
<form class="modal fade" id="team-add-modal" tabindex="-1" aria-hidden="true">
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

                    <div class="tab-pane fade show active" id="team-add-members" role="tabpanel">
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
<?= $this->extend('layouts/index'); ?>
<?= $this->section('content'); ?>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-11 col-xl-10">
            <div class="page-header">
                <h1><?= $task['nama_task']; ?></h1>
                <p class="lead"><?= $task['deskripsi_task']; ?></p>
                <div class="d-flex align-items-center">
                    <ul class="avatars">
                        <!-- Member Member Yang Masuk Ke Dalam Task -->
                        <?php foreach ($membertask as $mt) : ?>
                            <li>
                                <a href="#" data-toggle="tooltip" data-placement="top" title="<?= $mt['nama']; ?>">
                                    <img alt="<?= $mt['nama']; ?>" class="avatar" src="<?= base_url(); ?>/assets/img/<?= $mt['foto']; ?>" />
                                </a>
                            </li>
                        <?php endforeach; ?>



                    </ul>
                    <button class="btn btn-round flex-shrink-0" data-toggle="modal" data-target="#user-manage-modal">
                        <i class="material-icons">add</i>
                    </button>
                </div>
                <div>
                    <div class="progress">
                        <div class="progress-bar bg-success" style="width:42%;"></div>
                    </div>
                    <div class="d-flex justify-content-between text-small">
                        <div class="d-flex align-items-center">
                            <i class="material-icons">playlist_add_check</i>
                            <span>3/7</span>
                        </div>
                        <span>Due 14 days</span>
                    </div>
                </div>
            </div>
            <ul class="nav nav-tabs nav-fill" role="tablist">

            </ul>
            <div class="tab-content">
                <div class="tab-pane fade show active" id="task" role="tabpanel">
                    <div class="content-list" data-filter-list="checklist">
                        <div class="row content-list-head">
                            <div class="col-auto">
                                <h3>Checklist</h3>
                                <button class="btn btn-round" data-toggle="tooltip" data-title="New item">
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
                                    <input type="search" class="form-control filter-list-input" placeholder="Filter checklist" aria-label="Filter checklist">
                                </div>
                            </form>
                        </div>
                        <!--end of content list head-->
                        <div class="content-list-body">
                            <form class="checklist">

                                <div class="row">
                                    <div class="form-group col">
                                        <span class="checklist-reorder">
                                            <i class="material-icons">reorder</i>
                                        </span>
                                        <div class="custom-control custom-checkbox col">
                                            <input type="checkbox" class="custom-control-input" id="checklist-item-1" checked>
                                            <label class="custom-control-label" for="checklist-item-1"></label>
                                            <div>
                                                <input type="text" placeholder="Checklist item" value="Create boards in Matboard" data-filter-by="value" />
                                                <div class="checklist-strikethrough"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--end of form group-->
                                </div>

                                <div class="row">
                                    <div class="form-group col">
                                        <span class="checklist-reorder">
                                            <i class="material-icons">reorder</i>
                                        </span>
                                        <div class="custom-control custom-checkbox col">
                                            <input type="checkbox" class="custom-control-input" id="checklist-item-2" checked>
                                            <label class="custom-control-label" for="checklist-item-2"></label>
                                            <div>
                                                <input type="text" placeholder="Checklist item" value="Invite team to boards" data-filter-by="value" />
                                                <div class="checklist-strikethrough"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--end of form group-->
                                </div>

                                <div class="row">
                                    <div class="form-group col">
                                        <span class="checklist-reorder">
                                            <i class="material-icons">reorder</i>
                                        </span>
                                        <div class="custom-control custom-checkbox col">
                                            <input type="checkbox" class="custom-control-input" id="checklist-item-3" checked>
                                            <label class="custom-control-label" for="checklist-item-3"></label>
                                            <div>
                                                <input type="text" placeholder="Checklist item" value="Identify three distinct aesthetic styles for boards" data-filter-by="value" />
                                                <div class="checklist-strikethrough"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--end of form group-->
                                </div>

                                <div class="row">
                                    <div class="form-group col">
                                        <span class="checklist-reorder">
                                            <i class="material-icons">reorder</i>
                                        </span>
                                        <div class="custom-control custom-checkbox col">
                                            <input type="checkbox" class="custom-control-input" id="checklist-item-4">
                                            <label class="custom-control-label" for="checklist-item-4"></label>
                                            <div>
                                                <input type="text" placeholder="Checklist item" value="Add aesthetic style descriptions as notes" data-filter-by="value" />
                                                <div class="checklist-strikethrough"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--end of form group-->
                                </div>

                                <div class="row">
                                    <div class="form-group col">
                                        <span class="checklist-reorder">
                                            <i class="material-icons">reorder</i>
                                        </span>
                                        <div class="custom-control custom-checkbox col">
                                            <input type="checkbox" class="custom-control-input" id="checklist-item-5">
                                            <label class="custom-control-label" for="checklist-item-5"></label>
                                            <div>
                                                <input type="text" placeholder="Checklist item" value="Assemble boards using inspiration from Dribbble, Land Book, Nicely Done etc." data-filter-by="value" />
                                                <div class="checklist-strikethrough"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--end of form group-->
                                </div>

                                <div class="row">
                                    <div class="form-group col">
                                        <span class="checklist-reorder">
                                            <i class="material-icons">reorder</i>
                                        </span>
                                        <div class="custom-control custom-checkbox col">
                                            <input type="checkbox" class="custom-control-input" id="checklist-item-6">
                                            <label class="custom-control-label" for="checklist-item-6"></label>
                                            <div>
                                                <input type="text" placeholder="Checklist item" value="Gather feedback from project team" data-filter-by="value" />
                                                <div class="checklist-strikethrough"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--end of form group-->
                                </div>

                                <div class="row">
                                    <div class="form-group col">
                                        <span class="checklist-reorder">
                                            <i class="material-icons">reorder</i>
                                        </span>
                                        <div class="custom-control custom-checkbox col">
                                            <input type="checkbox" class="custom-control-input" id="checklist-item-7">
                                            <label class="custom-control-label" for="checklist-item-7"></label>
                                            <div>
                                                <input type="text" placeholder="Checklist item" value="Invite clients to board before next concept meeting" data-filter-by="value" />
                                                <div class="checklist-strikethrough"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--end of form group-->
                                </div>

                            </form>
                            <div class="drop-to-delete">
                                <div class="drag-to-delete-title">
                                    <i class="material-icons">delete</i>
                                </div>
                            </div>
                        </div>
                        <!--end of content list body-->
                    </div>
                    <!--end of content list-->

                </div>
                <!--end of tab-->

            </div>

        </div>
    </div>
</div>


<?= $this->endSection(); ?>
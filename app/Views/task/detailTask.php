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
                                <?php if (session()->get('role_id') == 3) { ?>

                                <?php } else { ?>
                                    <button class="btn btn-round" data-toggle="modal" data-target="#list-add-modal">
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
                                    <input type="search" class="form-control filter-list-input" placeholder="Filter checklist" aria-label="Filter checklist">
                                </div>
                            </form>
                        </div>
                        <!--end of content list head-->
                        <div class="content-list-body">
                            <form class="checklist">
                                <?php foreach ($list as $l) : ?>
                                    <div class="row">
                                        <div class="form-group col">
                                            <span class="checklist-reorder">
                                                <i class="material-icons">reorder</i>
                                            </span>
                                            <div class="custom-control custom-checkbox col">
                                                <input type="checkbox" class="custom-control-input checkbox-list" id="checklist-item-<?= $l['id']; ?>" data-list="<?= $l['id']; ?>" <?= check_list($l['id']); ?>>
                                                <label class="custom-control-label" for="checklist-item-<?= $l['id']; ?>"></label>
                                                <div>
                                                    <input type="text" placeholder="Checklist item" value="<?= $l['list']; ?>" data-filter-by="value" />
                                                    <div class="checklist-strikethrough"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <!--end of form group-->
                                    </div>
                                <?php endforeach; ?>



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

<!-- List Add Modal -->
<div class="modal fade" id="list-add-modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">New Checklist</h5>
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
                            <input class="form-control col" type="text" placeholder="Checklist name" id="namaList" name="namaList" />
                            <input type="hidden" id="idTask" value="<?= $task['id']; ?>">
                        </div>

                    </div>

                </div>
            </div>
            <!--end of modal body-->
            <div class="modal-footer">
                <button role="button" class="btn btn-primary tombol-add-list" type="submit">
                    Create List
                </button>
            </div>
        </div>
    </div>
</div>


<?= $this->endSection(); ?>
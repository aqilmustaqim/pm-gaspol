<?= $this->extend('/layouts/index'); ?>
<?= $this->section('content'); ?>
<div class="container">
    <div class="profile" data-profile="<?= session()->getFlashdata('profile'); ?>"></div>
    <div class="row justify-content-center mt-5">
        <div class="col-lg-3 mb-3">
            <ul class="nav nav-tabs flex-lg-column" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="true">Your Profile</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="password-tab" data-toggle="tab" href="#password" role="tab" aria-controls="password" aria-selected="false">Password</a>
                </li>


            </ul>
        </div>
        <div class="col-xl-8 col-lg-9">
            <div class="card">
                <div class="card-body">
                    <div class="tab-content">
                        <div class="tab-pane fade show active" role="tabpanel" id="profile">
                            <form action="<?= base_url(); ?>/auth/editProfile" method="post" enctype="multipart/form-data">
                                <div class="media mb-4">
                                    <img alt="Image" src="<?= base_url(); ?>/assets/img/<?= $user['foto']; ?>" class="avatar avatar-lg" />
                                    <div class="media-body ml-3">
                                        <div class="custom-file custom-file-naked d-block mb-1">

                                            <label class="custom-file-label position-relative" for="avatar-file">
                                                <span class="btn btn-primary">
                                                    Upload avatar
                                                </span>
                                            </label>
                                            <input type="file" class="form-control" id="foto" name="foto" id="avatar-file">
                                            <input type="hidden" value="<?= $user['foto']; ?>" id="fotoLama" name="fotoLama">
                                        </div>
                                        <small>For best results, use an image at least 256px by 256px in either .jpg or .png format</small>
                                    </div>
                                </div>
                                <!--end of avatar-->

                                <div class="form-group row align-items-center">
                                    <label class="col-3">Full Name</label>
                                    <div class="col">
                                        <input type="text" placeholder="Full name" name="nama" id="nama" value="<?= $user['nama']; ?>" name="profile-first-name" class="form-control" required />
                                    </div>
                                </div>

                                <div class="form-group row align-items-center">
                                    <label class="col-3">Email</label>
                                    <div class="col">
                                        <input type="email" placeholder="Enter your email address" name="email" id="email" name="profile-email" class="form-control" value="<?= $user['email']; ?>" readonly required />
                                    </div>
                                </div>

                                <div class="d-flex justify-content-end">
                                    <button type="submit" class="btn btn-primary tombol-save-profile">Save</button>
                                </div>
                            </form>
                        </div>
                        <div class="tab-pane fade" role="tabpanel" id="password">

                            <div class="form-group row align-items-center">
                                <label class="col-3">Current Password</label>
                                <div class="col">
                                    <input type="password" placeholder="Enter your current password" name="passwordlama" id="passwordlama" class="form-control" />
                                </div>
                            </div>
                            <div class="form-group row align-items-center">
                                <label class="col-3">New Password</label>
                                <div class="col">
                                    <input type="password" placeholder="Enter a new password" name="passwordbaru" id="passwordbaru" class="form-control" />
                                    <small>Password must be at least 8 characters long</small>
                                </div>
                            </div>
                            <div class="form-group row align-items-center">
                                <label class="col-3">Confirm Password</label>
                                <div class="col">
                                    <input type="password" placeholder="Confirm your new password" name="passwordkonfirmasi" id="passwordkonfirmasi" class="form-control" />
                                </div>
                            </div>
                            <div class="d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary btn-change-password">Change Password</button>
                            </div>


                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<?= $this->endSection(); ?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title><?= $title; ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="A project management Bootstrap theme by Medium Rare">
    <link href="<?= base_url(); ?>/assets/img/favicon.ico" rel="icon" type="image/x-icon">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Gothic+A1" rel="stylesheet">
    <link href="<?= base_url(); ?>/assets/css/theme.css" rel="stylesheet" type="text/css" media="all" />

    <!-- DataTable -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap4.min.css">
</head>

<body>

    <div class="layout layout-nav-side">
        <div class="navbar navbar-expand-lg bg-dark navbar-dark sticky-top">

            <a class="navbar-brand" href="<?= base_url(); ?>">
                <img alt="Pipeline" style="width: 200px;" src="<?= base_url(); ?>/assets/img/logo/logogaspol.png" />
            </a>
            <div class="d-flex align-items-center">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-collapse" aria-controls="navbar-collapse" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

            </div>
            <div class="collapse navbar-collapse flex-column" id="navbar-collapse">
                <div>
                    <form>
                        <div class="input-group input-group-dark input-group-round mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="material-icons">search</i>
                                </span>
                            </div>
                            <input type="search" class="form-control form-control-dark" placeholder="Search" aria-label="Search app">
                        </div>
                    </form>

                </div>
                <ul class="navbar-nav d-lg-block">

                    <li class="nav-item">

                        <a class="nav-link" href="<?= base_url(); ?>/<?= (session()->get('role_id') == 1 ? 'superadmin' : 'dashboard'); ?>">Overview</a>

                    </li>
                    <?php if (session()->get('role_id') == 1) : ?>
                        <li class="nav-item">

                            <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-3" aria-controls="submenu-3">Projects</a>
                            <div id="submenu-3" class="collapse">
                                <ul class="nav nav-small flex-column">

                                    <li class="nav-item">
                                        <a class="nav-link" href="components-bootstrap.html">List Project</a>
                                    </li>

                                    <li class="nav-item">
                                        <a class="nav-link" href="components-pipeline.html">Add Project</a>
                                    </li>

                                </ul>
                            </div>

                        </li>
                    <?php endif; ?>


                    <li class="nav-item">

                        <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-2" aria-controls="submenu-2">Team</a>
                        <div id="submenu-2" class="collapse">
                            <ul class="nav nav-small flex-column">

                                <li class="nav-item">
                                    <a class="nav-link" href="<?= base_url(); ?>/team">List Team</a>
                                </li>




                            </ul>
                        </div>

                    </li>

                    <?php if (session()->get('role_id') == 1) : ?>
                        <li class="nav-item">

                            <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-4" aria-controls="submenu-4">Member</a>
                            <div id="submenu-4" class="collapse">
                                <ul class="nav nav-small flex-column">

                                    <li class="nav-item">
                                        <a class="nav-link" href="<?= base_url(); ?>/member">List Member</a>
                                    </li>


                                </ul>
                            </div>

                        </li>
                    <?php endif; ?>


                </ul>
                <hr>
                <span>Project Management Pasukan Langit ❤</span>

            </div>


        </div>
        <div class="main-container">
            <div class="navbar bg-white breadcrumb-bar">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html"><?= $bread; ?></a>
                        </li>

                    </ol>
                </nav>

                <div class="dropdown">
                    <a href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <img alt="Image" src="<?= base_url(); ?>/assets/img/<?= session()->get('foto'); ?>" class="avatar" />
                    </a>
                    <div class="dropdown-menu dropdown-menu-right">

                        <a href="<?= base_url(); ?>/auth/settings" class="dropdown-item">Account Settings</a>
                        <a href="<?= base_url(); ?>/auth/logout" class="dropdown-item">Log Out</a>

                    </div>
                </div>


            </div>
            <?= $this->renderSection('content'); ?>
        </div>

    </div>

    <!-- Required vendor scripts (Do not remove) -->
    <script type="text/javascript" src="<?= base_url(); ?>/assets/js/jquery.min.js"></script>
    <script type="text/javascript" src="<?= base_url(); ?>/assets/js/popper.min.js"></script>
    <script type="text/javascript" src="<?= base_url(); ?>/assets/js/bootstrap.js"></script>

    <!-- Optional Vendor Scripts (Remove the plugin script here and comment initializer script out of index.js if site does not use that feature) -->

    <!-- Autosize - resizes textarea inputs as user types -->
    <script type="text/javascript" src="<?= base_url(); ?>/assets/js/autosize.min.js"></script>
    <!-- Flatpickr (calendar/date/time picker UI) -->
    <script type="text/javascript" src="<?= base_url(); ?>/assets/js/flatpickr.min.js"></script>
    <!-- Prism - displays formatted code boxes -->
    <script type="text/javascript" src="<?= base_url(); ?>/assets/js/prism.js"></script>
    <!-- Shopify Draggable - drag, drop and sort items on page -->
    <script type="text/javascript" src="<?= base_url(); ?>/assets/js/draggable.bundle.legacy.js"></script>
    <script type="text/javascript" src="<?= base_url(); ?>/assets/js/swap-animation.js"></script>
    <!-- Dropzone - drag and drop files onto the page for uploading -->
    <script type="text/javascript" src="<?= base_url(); ?>/assets/js/dropzone.min.js"></script>
    <!-- List.js - filter list elements -->
    <script type="text/javascript" src="<?= base_url(); ?>/assets/js/list.min.js"></script>

    <!-- Required theme scripts (Do not remove) -->
    <script type="text/javascript" src="<?= base_url(); ?>/assets/js/theme.js"></script>

    <!-- SweetAlert2 -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- DataTable -->
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap4.min.js"></script>
    <script src="<?= base_url(); ?>/assets/js/myscript.js"></script>

    <!-- Font Awesome -->
    <script defer src="https://use.fontawesome.com/releases/v5.15.4/js/all.js" integrity="sha384-rOA1PnstxnOBLzCLMcre8ybwbTmemjzdNlILg8O7z1lUkLXozs4DHonlDtnE7fpc" crossorigin="anonymous"></script>

    <script>
        // Fungsi Add Team
        $('.btn-team').on('click', function() {
            //Ambil Inputan
            let namateam = $('#namateam').val();
            let deskripsiteam = $('#deskripsiteam').val();

            if (namateam == '') {
                Swal.fire({
                    title: 'Data Team ',
                    text: 'Nama Team Tidak Boleh Kosong !',
                    icon: 'error'
                })
            } else if (deskripsiteam == '') {
                Swal.fire({
                    title: 'Data Team ',
                    text: 'Deskripsi Team Tidak Boleh Kosong !',
                    icon: 'error'
                })
            } else {

                //Jalankan Ajax
                $.ajax({
                    method: "POST",
                    url: "<?= base_url(); ?>/team/addTeam",
                    data: {
                        namateam: namateam,
                        deskripsiteam: deskripsiteam
                    },
                    success: function(data) {
                        if (data == "berhasil") {
                            Swal.fire({
                                title: 'Data Team',
                                text: 'Berhasil Add Team !',
                                icon: 'success'
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    window.location.href = "<?= base_url(); ?>/team";
                                }
                            })
                        }

                    }
                });

            }

        });

        // Fungsi Change Password
        $('.btn-change-password').on('click', function() {
            let passwordlama = $('#passwordlama').val();
            let passwordbaru = $('#passwordbaru').val();
            let passwordkonfirmasi = $('#passwordkonfirmasi').val();

            if (passwordlama == '') {
                Swal.fire({
                    title: 'Change Password ',
                    text: 'Password Lama Tidak Boleh Kosong !',
                    icon: 'error'
                });
            } else if (passwordbaru.length < 8) {
                Swal.fire({
                    title: 'Change Password ',
                    text: 'Password Minimal 8 Karakter !',
                    icon: 'error'
                });
            } else if (passwordbaru == '') {
                Swal.fire({
                    title: 'Change Password ',
                    text: 'Password Baru Tidak Boleh Kosong !',
                    icon: 'error'
                });
            } else if (passwordkonfirmasi != passwordbaru) {
                Swal.fire({
                    title: 'Change Password ',
                    text: 'Password Konfirmasi Harus Match Dengan Password !',
                    icon: 'error'
                });
            } else {
                $.ajax({
                    method: "POST",
                    url: "<?= base_url(); ?>/auth/changePassword",
                    data: {
                        passwordlama: passwordlama,
                        passwordbaru: passwordbaru,
                        passwordkonfirmasi: passwordkonfirmasi
                    },
                    success: function(data) {
                        if (data == "passwordsalah") {
                            Swal.fire({
                                title: 'Change Password',
                                text: 'Password Lama Salah !',
                                icon: 'error'
                            })
                        } else if (data == "berhasil") {
                            Swal.fire({
                                title: 'Change Password',
                                text: 'Berhasil Di Ubah Silahkan Login Ulang !',
                                icon: 'success'
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    window.location.href = "<?= base_url(); ?>/auth/logout";
                                }
                            })
                        }

                    }
                });
            }
        });

        //Fungsi Checkbox Member Team
        $('.checkbox-member').on('click', function() {
            const idTeam = $(this).data('team');
            const idUser = $(this).data('user');

            $.ajax({
                method: "POST",
                url: "<?= base_url(); ?>/team/addMemberTeam",
                data: {
                    idTeam: idTeam,
                    idUser: idUser
                },
                success: function(data) {
                    if (data == "berhasil") {
                        Swal.fire({
                            title: 'Add Member',
                            text: 'Berhasil !',
                            icon: 'success'
                        })
                    } else if (data == "hapus") {
                        Swal.fire({
                            title: 'Add Member',
                            text: 'Di Hapus !',
                            icon: 'error'
                        })
                    }

                }
            });
        });

        //Fungsi Checkbox Member Project
        $('.checkbox-member-project').on('click', function() {
            const idProject = $(this).data('project');
            const idUser = $(this).data('user');

            $.ajax({
                method: "POST",
                url: "<?= base_url(); ?>/project/addMemberProject",
                data: {
                    idProject: idProject,
                    idUser: idUser
                },
                success: function(data) {
                    if (data == "berhasil") {
                        Swal.fire({
                            title: 'Add Member Project',
                            text: 'Berhasil !',
                            icon: 'success'
                        })
                    } else if (data == "hapus") {
                        Swal.fire({
                            title: 'Add Member Project',
                            text: 'Di Hapus !',
                            icon: 'error'
                        })
                    }

                }
            });
        });

        //Fungsi Add Project
        $('.tombol-add-project').on('click', function() {
            //Tangkap Semua Inputan
            let namaProject = $('#namaProject').val();
            let deskripsiProject = $('#deskripsiProject').val();
            let tanggalMulai = $('#tanggalMulai').val();
            let batasWaktu = $('#batasWaktu').val();
            let idTeam = $('#idTeam').val();

            //Cek Biar Jangan Kosong
            if (namaProject == '') {
                Swal.fire({
                    title: 'Project',
                    text: 'Nama Project Tidak Boleh Kosong !',
                    icon: 'error'
                });
            } else if (deskripsiProject == '') {
                Swal.fire({
                    title: 'Project',
                    text: 'Deskripsi Project Tidak Boleh Kosong !',
                    icon: 'error'
                });
            } else if (tanggalMulai == '') {
                Swal.fire({
                    title: 'Project ',
                    text: 'Tanggal Project Tidak Boleh Kosong !',
                    icon: 'error'
                });
            } else if (batasWaktu == '') {
                Swal.fire({
                    title: 'Project ',
                    text: 'Batas Project Tidak Boleh Kosong !',
                    icon: 'error'
                });
            } else {

                //Kalau Ada Isinya Semua Tampilin Ajax
                $.ajax({
                    method: "POST",
                    url: "<?= base_url(); ?>/project/addProject",
                    data: {
                        namaProject: namaProject,
                        deskripsiProject: deskripsiProject,
                        tanggalMulai: tanggalMulai,
                        batasWaktu: batasWaktu,
                        idTeam: idTeam
                    },
                    success: function(data) {
                        if (data == "berhasil") {
                            Swal.fire({
                                title: 'Add Project',
                                text: 'Berhasil Di Add !',
                                icon: 'success'
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    window.location.href = "<?= base_url(); ?>/team/detailTeam/" + idTeam;
                                }
                            })
                        }

                    }
                });


            }
        });

        //Fungsi Edit Project
        $('.tombol-edit-project').on('click', function() {
            //Tangkap Semua Inputan
            let id = $('#id').val();
            let namaProject = $('#editNamaProject').val();
            let deskripsiProject = $('#editDeskripsiProject').val();
            let tanggalMulai = $('#editTanggalMulai').val();
            let batasWaktu = $('#editBatasWaktu').val();
            let idTeam = $('#idTeam').val();

            //Cek Biar Jangan Kosong
            if (namaProject == '') {
                Swal.fire({
                    title: 'Project',
                    text: 'Nama Project Tidak Boleh Kosong !',
                    icon: 'error'
                });
            } else if (deskripsiProject == '') {
                Swal.fire({
                    title: 'Project',
                    text: 'Deskripsi Project Tidak Boleh Kosong !',
                    icon: 'error'
                });
            } else if (tanggalMulai == '') {
                Swal.fire({
                    title: 'Project ',
                    text: 'Tanggal Project Tidak Boleh Kosong !',
                    icon: 'error'
                });
            } else if (batasWaktu == '') {
                Swal.fire({
                    title: 'Project ',
                    text: 'Batas Project Tidak Boleh Kosong !',
                    icon: 'error'
                });
            } else {

                //Kalau Ada Isinya Semua Tampilin Ajax
                $.ajax({
                    method: "POST",
                    url: "<?= base_url(); ?>/project/editProject",
                    data: {
                        namaProject: namaProject,
                        deskripsiProject: deskripsiProject,
                        tanggalMulai: tanggalMulai,
                        batasWaktu: batasWaktu,
                        idTeam: idTeam,
                        id: id
                    },
                    success: function(data) {
                        if (data == "berhasil") {
                            Swal.fire({
                                title: 'Edit Project',
                                text: 'Berhasil Di Edit !',
                                icon: 'success'
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    window.location.href = "<?= base_url(); ?>/team/detailTeam/" + idTeam;
                                }
                            })
                        }

                    }
                });


            }
        });
    </script>
</body>

</html>
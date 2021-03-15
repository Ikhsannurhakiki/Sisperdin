<!DOCTYPE html>
<html lang="en">
<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("location:../layout/login.php");
}

function http_request($url)
{
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $output = curl_exec($ch);
    curl_close($ch);
    return $output;
}
$id = $_SESSION['id'];
$user = http_request("http://localhost/SisPerDin/api/apiuser.php?f=bacauser&id=" . $id);
$user = json_decode($user, TRUE);

foreach ($user as $user) {
    $status = $user['status'];
    $namafotorandom = $user['namafotorandom'];
}
?>

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Custom fonts for this template-->
    <link href="http://localhost/SisPerDin/assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="http://localhost/SisPerDin/assets/css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="../index.php">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-sticky-note"></i>
                </div>
                <div class="sidebar-brand-text mx-3">SisPerDin</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="../index.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Interface
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapse1" aria-expanded="true" aria-controls="collapse1">
                    <i class="fas fa-fw fa-user"></i>
                    <span>Pegawai</span>
                </a>
                <div id="collapse1" class="collapse" aria-labelledby="heading1" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="../layout/anggota.php">Data Pegawai</a>
                        <a class="collapse-item" href="../layout/tambahdatapegawai.php">Tambah Pegawai</a>
                    </div>
                </div>
            </li>

            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapse5" aria-expanded="true" aria-controls="collaps5">
                    <i class="fas fa-fw fa-newspaper"></i>
                    <span>SPT</span>
                </a>
                <div id="collapse5" class="collapse" aria-labelledby="heading5" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="../layout/tampilspt.php">Data SPT</a>
                        <a class="collapse-item" href="../layout/tambahspt.php">Tambah SPT</a>
                    </div>
                </div>
            </li>
            <?php if ($status == "Super Admin") { ?>
                <li class="nav-item">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapse3" aria-expanded="true" aria-controls="collapse3">
                        <i class="fas fa-fw fa-newspaper"></i>
                        <span>Data Master</span>
                    </a>
                    <div id="collapse3" class="collapse" aria-labelledby="heading3" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <a class="collapse-item" href="../layout/dmjabatan.php">Jabatan</a>
                            <a class="collapse-item" href="../layout/dmgolongan.php">Golongan</a>
                            <a class="collapse-item" href="../layout/dmttdspt.php">Penandatangan SPT</a>
                            <a class="collapse-item" href="../layout/dmttdsppd.php">Penandatangan SPPD</a>
                            <a class="collapse-item" href="../layout/dmttdkomitmen.php">Pembuat Komitmen</a>
                        </div>
                    </div>
                </li>

                <li class="nav-item">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapse4" aria-expanded="true" aria-controls="collapse4">
                        <i class="fas fa-fw fa-user-cog"></i>
                        <span>Super admin</span>
                    </a>
                    <div id="collapse4" class="collapse" aria-labelledby="heading4" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <a class="collapse-item" href="../layout/tambahuser.php">Tambah Admin</a>
                        </div>
                    </div>
                </li>
            <?php
            }
            ?>
            <!-- Divider -->
            <hr class="sidebar-divider">
        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-1">
                        <div class="d-sm-flex align-items-center justify-content-between mb-1">
                            <h1 class="h4 mb-0 text-gray-800">Sistem Informasi Perjalanan Dinas
                        </div>
                    </ul>

                    <ul class="navbar-nav ml-auto">

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-400"> <?= $_SESSION['username'] ?></span>
                                <img class="img-profile rounded-circle" src=" ../assets/img/fotouser/<?= $namafotorandom ?>">
                            </a> <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="../assets/img/fotouser/<?= $namafotorandom ?>">
                                    <center>
                                        <img class="img-profile rounded-circle" width="40%" src=" ../assets/img/fotouser/<?= $namafotorandom ?>">
                                    </center>
                                </a>
                                <br>
                                <a class="dropdown-item" href="../layout/profiluser.php">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="../api/apilogin.php?f=logout">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->


                <!-- Bootstrap core JavaScript-->
                <script src="http://localhost/SisPerDin/assets/vendor/jquery/jquery.min.js"></script>
                <script src="http://localhost/SisPerDin/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

                <!-- Core plugin JavaScript-->
                <script src="http://localhost/SisPerDin/assets/vendor/jquery-easing/jquery.easing.min.js"></script>

                <!-- Custom scripts for all pages-->
                <script src="http://localhost/SisPerDin/assets/js/sb-admin-2.min.js"></script>

</body>
<!DOCTYPE html>
<html lang="en">

<?php
require("topdansidebar.php");
if (!isset($_SESSION)) {
    header("location:../layout/login.php");
}
if ($_SESSION['status'] != "Super Admin") {
    echo "<script>window . history . go(-1)</script>";
}

?>


<head>

    <title>SisPerDin | Tambah Data Admin</title>
    <!-- Custom fonts for this template -->
    <link href="http://localhost/SisPerDin/assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="http://localhost/SisPerDin/assets/css/sb-admin-2.min.css" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="http://localhost/SisPerDin/assets/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->


        <div class="row mx-auto">
            <div class="col-lg-8 mx-auto px-auto">

                <!-- Circle Buttons -->
                <div class="card shadow mb-4 ">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Form Tambah Data Admin</h6>
                    </div>

                    <div class="card-body col-lg-12 mx-auto">
                        <form class="mx-auto px-auto" action="../api/apiuser.php?f=tambahuser" method="post" id="tambahpegawai" enctype="multipart/form-data">
                            <div class="input-group mb-3 ">
                                <div class="input-group-prepend">
                                    <div class="col-lg-12">
                                        <label class="mx-auto">Username</label>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <input type="text" class="form-control" id="username" name="username" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" placeholder="Inputkan username">
                                </div>
                            </div>
                            <div class="input-group mb-3 ">
                                <div class="input-group-prepend">
                                    <div class="col-lg-12">
                                        <label>Alamat</label>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <input type="text" class="form-control" id="alamat" name="alamat" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" placeholder="Inputkan alamat">
                                </div>
                            </div>
                            <div class="input-group mb-3 ">
                                <div class="input-group-prepend">
                                    <div class="col-lg-12">
                                        <label>nohp</label>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <input type="text" class="form-control" id="nohp" name="nohp" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" placeholder="Inputkan nohp">
                                </div>
                            </div>
                            <div class="input-group mb-3 ">
                                <div class="input-group-prepend">
                                    <div class="col-lg-12 ">
                                        <label>Level admin</label>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <select id="lvladmin" name="lvladmin" class="form-control">
                                        <option class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">Pilih Level</option>
                                        <option class="form-control" id="lvladmin" name="lvladmin" value="Super Admin" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">Super Admin</option>
                                        <option class="form-control" id="lvladmin" name="lvladmin" value="Admin" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">Admin</option>
                                    </select>
                                </div>
                            </div>
                            <div class="input-group mb-3 ">
                                <div class="input-group-prepend">
                                    <div class="col-lg-12">
                                        <label>Password</label>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <input type="password" class="form-control" id="password" name="password" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
                                </div>
                            </div>
                            <div class="input-group mb-3 ">
                                <div class="input-group-prepend">
                                    <div class="col-lg-12">
                                        <label>Konfirmasi password</label>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <input type="password" class="form-control" id="konfirmpassword" name="konfirmpassword" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
                                </div>
                            </div>
                            <div class="input-group mb-3 ">
                                <div class="input-group-prepend">
                                    <div class="col-lg-12">
                                        <label>Foto</label>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <input type="file" id="foto" name="foto" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
                                </div>
                            </div>
                            <hr>
                            <div style="text-align: center;">
                                <button type="submit" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm"><i class="fas fa-memory"></i> Simpan</button>
                            </div>
                            <hr>
                        </form>
                        <br><br>

                    </div>
                </div>
            </div>
        </div>
    </div>


    <?php
    require("footer.php");
    ?>
    <?php
    if (isset($_GET['pesan'])) {
        if ($_GET['pesan'] == "gagalisset") { ?>
            <script>
                alert("Form tidak boleh kosong");
            </script><?php
                    }
                }
                        ?>



</body>

</html>
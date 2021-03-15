<!DOCTYPE html>
<html lang="en">

<?php
require("topdansidebar.php");
if (!isset($_SESSION)) {
    header("location:../layout/login.php");
}
$jabatan = http_request("http://localhost/SisPerDin/api/apidatamaster.php?f=tampiljabatan");
$jabatan = json_decode($jabatan, TRUE);
$golongan = http_request("http://localhost/SisPerDin/api/apidatamaster.php?f=tampilgolongan");
$golongan = json_decode($golongan, TRUE);

?>


<head>

    <title>SisPerDin | Tambah Data Pegawai</title>
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
        <div class="card shadow ">
            <h5 class="h6 m-3 font-weight-bold text-info"><i class="fas fa-home"></i> / Tampil SPT / Detail SPT / Kwitansi / Form kwitansi</h5>
        </div>
        <br>
        <!-- Circle Buttons -->
        <div class="card shadow mb-4 ">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Form Kwitansi</h6>
            </div>
            <div class="card-body col-lg-12 mx-auto">
                <form class="mx-auto px-auto" action="../api/apispt.php?f=tambahdatakwitansi&nospt=<?= $_GET['nospt'] ?>" method="post" id="tambahdatakwitansi" enctype="multipart/form-data">
                    <table align="center">
                        <tr>
                            <td>
                                <div class="input-group mb-3 ">
                                    <div class="input-group-prepend">
                                        <div class="col-lg-12">
                                            <label class="mx-auto">Peruntukkan Dana <i style="color: red;">*</i></label>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <input type="text" class="form-control" id="untukdana" name="untukdana" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" placeholder="Transportasi">
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="input-group mb-3 ">
                                    <div class="input-group-prepend">
                                        <div class="col-lg-12">
                                            <label>Jumlah Dana <i style="color: red;">*</i></label>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <input type="number" class="form-control" id="dana" name="dana" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" placeholder="800000">
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="input-group mb-3 ">
                                    <div class="input-group-prepend">
                                        <div class="col-lg-12">
                                            <label>Keterangan tambahan <i style="color: red;">(opsional)</i></label>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <input type="text" class="form-control" id="ket" name="ket" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" placeholder="Untuk 4 orang">
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2" align="center"> <button type="submit" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm"><i class="fas fa-memory"></i> Simpan</button>
                                <a href="../layout/tampilkwitansi.php?nospt=<?= $_GET['nospt'] ?>" class="d-none d-sm-inline-block btn btn-sm btn-danger shadow-sm" onclick="history.go(-1)"><i class="fas fa-backward"></i> Kembali</button>
                            </td>
                        </tr>
                    </table>
                </form>
                <br><br>
                <i style="color: red;">* (Wajib diisi)</i>
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
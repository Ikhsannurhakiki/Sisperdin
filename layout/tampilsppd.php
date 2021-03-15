<!DOCTYPE html>
<html lang="en">

<?php
require("topdansidebar.php");
if (!isset($_SESSION)) {
    header("location:../layout/login.php");
}
$datasppd = http_request("http://localhost/SisPerDin/api/apispt.php?f=bacasppdperspt&nospt=" . $_GET['nospt']);
$datasppd = json_decode($datasppd, TRUE);

?>

<head>

    <title>SisPerDin | Data Pegawai</title>
    <!-- Custom fonts for this template -->
    <link href="http://localhost/SisPerDin/assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="http://localhost/SisPerDin/assets/css/sb-admin-2.min.css" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="http://localhost/SisPerDin/assets/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

</head>

<div id="page-top">

    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->

        <div class="card shadow mb-4">
            <div class="d-sm-flex align-items-center justify-content-between mt-4 ml-4 mr-4">
                <h1 class="h5 mb-0 text-gray-800"><b>Data SPPD</b></h1>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Tanggal Input</th>
                                <th>No SPPD</th>
                                <th>Pelaksana/pngikut</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($datasppd as $datasppd) {
                            ?>
                                <tr>
                                    <td><?= $datasppd["tglinput"] ?></td>
                                    <td><?= $datasppd["nosppd"] ?></td>
                                    <td><?= $datasppd["nama"] ?></td>
                                    <td align="center"> <a href="../api/percetakan.php?c=cetaksppd&nosppd= <?= $datasppd["nosppd"] ?> &nospt=<?= $_GET['nospt'] ?>" target="_blank" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download"></i> Cetak SPPD</a>
                                        <a href="../layout/buatkwitansi.php?nospt=<?= $_GET['nospt'] ?>" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"> <i class="fas fa-fw fa-newspaper"></i>Kwitansi</a></td>

                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function hapusdata(nip, foto) {
        var konfirm = confirm("apakan yakin ingin hapus data?");
        if (konfirm) {
            window.location = "http://localhost/SisPerDin/api/apipegawai.php?f=hapuspegawai&nip=" + nip + "&foto=" + foto;
        }
    }

    function tambahdatalagi() {
        var konfirm = confirm("Data berhasil disimpan, Apakah anda ingin menambah data lagi?");
        if (konfirm) {
            window.location = "http://localhost/SisPerDin/layout/tambahdatapegawai.php";
        }
    }
</script>



<!-- Page level plugins -->
<script src="http://localhost/SisPerDin/assets/vendor/datatables/jquery.dataTables.min.js"></script>
<script src="http://localhost/SisPerDin/assets/vendor/datatables/dataTables.bootstrap4.min.js"></script>

<!-- Page level custom scripts -->
<script src="http://localhost/SisPerDin/assets/js/demo/datatables-demo.js"></script>

<?php
require("footer.php");
?>

</body>



</html>
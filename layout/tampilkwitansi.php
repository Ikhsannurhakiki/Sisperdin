<!DOCTYPE html>
<html lang="en">

<?php
require("topdansidebar.php");
if (!isset($_SESSION)) {
    header("location:../layout/login.php");
}
$kwitansi = http_request("http://localhost/SisPerDin/api/apispt.php?f=bacakwitansi&nospt=" . $_GET['nospt']);
$kwitansi = json_decode($kwitansi, TRUE);

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

        <div class="card shadow ">
            <h5 class="h6 m-3 font-weight-bold text-info"><i class="fas fa-home"></i> / Tampil SPT / Detail SPT / Kwitansi</h5>
        </div>
        <br>
        <div class="card shadow mb-4">
            <div class="d-sm-flex align-items-center justify-content-between mt-4 ml-4 mr-4">
                <h1 class="h5 mb-0 text-gray-800"><b>Kwitansi</b></h1>
            </div>
            <div class="d-sm-flex align-items-center mt-4">
                <A href="../layout/detailspt.php?nospt=<?= $_GET['nospt'] ?>" class="d-none d-sm-inline-block btn btn-sm btn-danger shadow-sm ml-4" onclick="history.go(-1)"><i class="fas fa-backward"></i> Kembali</button>
                    <a href="../layout/formkwitansi.php?nospt=<?= $_GET['nospt'] ?>" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm ml-4"><i class="fas fa-plus"></i> Tambah Data</a>
                    <a href="../api/percetakan.php?f=cetakkwitansi&nospt=<?= $_GET['nospt'] ?>" target="_blank" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm ml-4"><i class="fas fa-download"></i> Cetak Kwitansi</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Peruntukkan Dana</th>
                                <th>Dana</th>
                                <th>Keterangan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 0;

                            foreach ($kwitansi as $kwitansi) {
                                $no = $no + 1;

                            ?>
                                <tr>
                                    <td><?= $no ?></td>
                                    <td><?= $kwitansi["peruntukkandana"] ?></td>
                                    <td><?= 'Rp ' . $kwitansi["dana"] ?></td>
                                    <td><?= $kwitansi["ket"] ?></td>
                                    <td align="center">
                                        <a href="#!" class="btn btn-danger" onclick="hapusdatakwitansi(<?= $kwitansi['id'] ?>,<?= $_GET['nospt'] ?>)"><i class=" fas fa-trash text-white-50"></i></a>

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
    function hapusdatakwitansi(id, nospt) {
        var konfirm = confirm("apakan yakin ingin hapus data?");
        if (konfirm) {
            window.location = "http://localhost/SisPerDin/api/apispt.php?f=hapusdatakwitansi&id=" + id + "&nospt=" + nospt;
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
<!DOCTYPE html>
<html lang="en">

<?php
require("topdansidebar.php");
if (!isset($_SESSION)) {
    header("location:../layout/login.php");
}
$data = http_request("http://localhost/SisPerDin/api/apispt.php?f=bacaspt");
$data = json_decode($data, TRUE);
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

        <div class="card shadow ">
            <h5 class="h6 m-3 font-weight-bold text-info"><i class="fas fa-home"></i> / Data Surat Perintah Tugas</h5>
        </div><br>
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-sm-flex align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Data Surat Perintah Tugas</h6>
            </div>
            <form class="mx-auto px-auto" action="../api/percetakan.php?f=cetakdataspt" method="post" id="formcetakspt" enctype="multipart/form-data">
                <table width=80% class="mx-auto my-4" cellpadding=3 style="color: black;">
                    <tr>
                        <td>
                            <label class="mx-auto">Dari</label>
                            <input type="date" class="form-control" id="awal" name="awal" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
                        </td>
                        <td>
                            <label class="mx-auto">Sampai</label>
                            <input type="date" class="form-control" id="akhir" name="akhir" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
                        </td>
                        <td>
                            <br>
                            <button type="submit" target="_blank" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i></i> Cetak</button>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <label style="color: red;" class="mx-auto">*Kosongkan kedua form diatas untuk cetak data dari awal</label>
                        </td>
                    </tr>
                </table>
                <div class="card-body" style="color: black;">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" style="color: black;">
                            <thead>
                                <tr>
                                    <th>Tanggal Input</th>
                                    <th>No SPT</th>
                                    <th>Tanggal Berangkat</th>
                                    <th>Tanggal Kembali</th>
                                    <th>Kota Tujuan</th>
                                    <th>Tujuan</th>
                                    <th>Pelaksana/Pengikut</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($data as $data) {
                                ?>
                                    <tr>
                                        <td><?= $data["tglinput"] ?></td>
                                        <td><?= $data["nospt"] ?></td>
                                        <td><?= $data["tglberangkat"] ?></td>
                                        <td><?= $data["tglkembali"] ?></td>
                                        <td><?= $data["kotatujuan"] ?></td>
                                        <td><?= $data["maksudtujuan"] ?></td>
                                        <td> <?php $pelaksana = http_request("http://localhost/SisPerDin/api/apispt.php?f=bacapelaksana&nospt='" . $data["nospt"] . "'");
                                                $pelaksana = json_decode($pelaksana, TRUE);
                                                $no = 0;
                                                foreach ($pelaksana as $pelaksana) {
                                                    $no++;
                                                    echo $no . '. ' . $pelaksana['nama'] . '<br>';
                                                }

                                                $pengikut = http_request("http://localhost/SisPerDin/api/apispt.php?f=bacapengikut&nospt='" . $data["nospt"] . "'");
                                                $pengikut = json_decode($pengikut, TRUE);

                                                foreach ($pengikut as $pengikut) {
                                                    $no++;
                                                    echo $no . '. ' . $pengikut['nama'] . '<br>';
                                                }  ?>
                                        </td>
                                        <td align="center" width="15%"><a href="http://localhost/SisPerDin/layout/detailspt.php?nospt='<?= $data["nospt"] ?>'" class="btn btn-primary"><i class="fas fa-arrow-alt-circle-right text-white-50"></i></a>
                                            <a href="#!" class="btn btn-danger" onclick="hapusdata('.<?= $data['nospt'] ?>.')"><i class=" fas fa-trash text-white-50"></i></a>
                                        </td>
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
    function hapusdata(nospt) {
        var konfirm = confirm("Apakah anda yakin ingin hapus data? (Semua data yang berkaitan akan dihapus termasuk arsip dokumen)");
        if (konfirm) {
            window.location = "http://localhost/SisPerDin/api/apispt.php?f=hapusspt&nospt=" + nospt;
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
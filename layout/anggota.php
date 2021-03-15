<!DOCTYPE html>
<html lang="en">

<?php
require("topdansidebar.php");
if (!isset($_SESSION)) {
    header("location:../layout/login.php");
}
if (isset($_GET['arsip'])) {
    $data = http_request("http://localhost/SisPerDin/api/apipegawai.php?f=bacapegawaiarsip");
    $data = json_decode($data, TRUE);
} else {
    $data = http_request("http://localhost/SisPerDin/api/apipegawai.php?f=bacapegawaitidakarsip");
    $data = json_decode($data, TRUE);
}
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
            <h5 class="h6 m-3 font-weight-bold text-info"><i class="fas fa-home"></i> / Data Pegawai</h5>
        </div><br>
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-sm-flex align-items-center justify-content-between">
                <?php
                if (isset($_GET['arsip'])) { ?>
                    <h6 class="m-0 font-weight-bold text-primary">Data Pegawai (Arsip)</h6>
                <?php } else { ?>
                    <h6 class="m-0 font-weight-bold text-primary">Data Pegawai</h6>
                <?php } ?>


                <?php
                if (isset($_GET['arsip'])) { ?>
                    <a href="../api/percetakan.php?arsip=ya&f=cetakdatapegawai" target="_blank" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Cetak Arsip</a>
                    <a href="../layout/anggota.php" title="Lihat Data Pegawai" class="btn btn-info"><i class="fas fa-newspaper text-white-50">Lihat Data Pegawai</i></a>
                <?php } else { ?>
                    <a href="../api/percetakan.php?arsip=tidak&f=cetakdatapegawai" target="_blank" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Cetak</a>
                    <a href="../layout/anggota.php?arsip" title="Lihat Arsip Pegawai" class="btn btn-secondary"><i class="fas fa-newspaper text-white-50"> Lihat Arsip Pegawai</i></a>
                <?php } ?>
            </div>

            <div class="card-body" style="color: black;">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" style="color: black;">
                        <thead>
                            <tr>
                                <th>NIP</th>
                                <th>Nama</th>
                                <th>Jabatan</th>
                                <th>Golongan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($data as $data) {
                            ?>
                                <tr>
                                    <td><?= $data["nip"] ?></td>
                                    <td><?= $data["nama"] ?></td>
                                    <td><?= $data["namajabatan"] ?></td>
                                    <td><?= $data["namapangkat"] ?> (<?= $data["golongan"] . "/" . $data["ruang"] ?>)</td>
                                    <td align="center" width="20%"><a href="http://localhost/SisPerDin/layout/detailpegawai.php?nip=<?= $data["nip"] ?>" title="Detail" class="btn btn-primary"><i class="fas fa-arrow-alt-circle-right text-white-50"></i></a>
                                        <a href="../layout/editdatapegawai.php?nip=<?= $data["nip"] ?>" title="Edit" class="btn btn-warning" type="button" data-dismiss="modal"><i class="fas fa-pen text-white-50"></i></a>
                                        <a href="#!" class="btn btn-danger" title="Hapus" onclick="hapusdata('.<?= $data['nip'] ?>.','.<?= $data['foto'] ?>.')"><i class=" fas fa-trash text-white-50"></i></a>
                                        <?php if ($_SESSION['status'] == "Super Admin") {
                                            if ($data['statusarsippegawai'] == 'tidak') { ?>
                                                <a href="../api/apipegawai.php?nip=<?= $data['nip'] ?>&f=arsippegawai&arsipkan=ya" title="Arsipkan" class="btn btn-info"><i class="fas fa-newspaper text-white-50"></i></a>
                                            <?php } else { ?>
                                                <a href="../api/apipegawai.php?nip=<?= $data['nip'] ?>&f=arsippegawai&arsipkan=tidak" title="Kembalikan" class="btn btn-secondary"><i class="fas fa-newspaper text-white-50"></i></a>
                                        <?php }
                                        } ?>
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
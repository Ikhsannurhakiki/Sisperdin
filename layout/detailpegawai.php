<!DOCTYPE html>
<html lang="en">

<?php
require("topdansidebar.php");
if (!isset($_SESSION)) {
    header("location:../layout/login.php");
}

$data = http_request("http://localhost/SisPerDin/api/apipegawai.php?f=caripegawai&nip=" . $_GET["nip"]);
$data = json_decode($data, TRUE);

?>

<head>

    <title>SisPerDin | Detail Pegawai</title>
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
            <h5 class="h6 m-3 font-weight-bold text-info"><i class="fas fa-home"></i> / Detail Pegawai</h5>
        </div><br>
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Detail Pegawai</h6>
            </div>
            <br>
            <div class="card-body mx-auto my-auto">
                <table cellpadding="3" style="color: black;">

                    <tbody>
                        <?php foreach ($data as $data) {
                        ?>
                            <tr>
                                <td rowspan="8" width="50%" align="center">
                                    <a href="../assets/img/pasfoto/<?= $data['foto'] ?>">
                                        <img src="../assets/img/pasfoto/<?= $data['foto'] ?>" width="50%"></a></td>
                                <td>Nama</td>
                                <td>|</td>
                                <td><?= $data["nama"] ?></td>
                            </tr>
                            <tr>
                                <td>NIP</td>
                                <td>|</td>
                                <td><?= $data["nip"] ?></td>
                            </tr>
                            <tr>
                                <td>Alamat</td>
                                <td>|</td>
                                <td><?= $data["alamat"] ?></td>
                            </tr>
                            <tr>
                                <td>No Handphone</td>
                                <td>|</td>
                                <td><?= $data["nohp"] ?></td>
                            </tr>
                            <tr>
                                <td>Tempat Lahir</td>
                                <td>|</td>
                                <td><?= $data["tempatlahir"] ?></td>
                            </tr>
                            <tr>
                                <td>Tanggal Lahir</td>
                                <td>|</td>
                                <td><?= $data["tanggallahir"] ?></td>
                            </tr>
                            <tr>
                                <td>Golongan</td>
                                <td>|</td>
                                <td><?= $data["namapangkat"] ?> (<?= $data["golongan"] . "/" . $data["ruang"] ?>)</td>
                            </tr>
                            <tr>
                                <td>Jabatan</td>
                                <td>|</td>
                                <td><?= $data["namajabatan"] ?></td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>

                </table>
            </div>
            <div class="card-header py-3 mx-auto">
                <button class="d-none d-sm-inline-block btn btn-sm btn-danger shadow-sm" onclick="history.go(-1)"><i class="fas fa-backward"></i> Kembali</button>
                <a href="../layout/editdatapegawai.php?nip=<?= $data["nip"] ?>" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"> <i class="fas fa-fw fa-user-cog"></i> Edit Pegawai</a></td>
            </div>
        </div>
    </div>
</div>

<?php
require("footer.php");
?>

</body>



</html>
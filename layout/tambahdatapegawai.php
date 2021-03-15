<!DOCTYPE html>
<html lang="en">

<?php
require("topdansidebar.php");
?>
<?php

$jabatan = http_request("http://localhost/SisPerDin/api/apidatamaster.php?f=tampiljabatantidakdiarsipkan");
$jabatan = json_decode($jabatan, TRUE);
$golongan = http_request("http://localhost/SisPerDin/api/apidatamaster.php?f=tampilgolongantidakdiarsipkan");
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
    <style>
        input[type] {
            color: black;
        }
    </style>

</head>

<body id="page-top">

    <!-- Begin Page Content -->
    <div class="container-fluid">
        <div class="row mx-auto">
            <div class="col-lg-12 mx-auto px-auto">

                <div class="card shadow ">
                    <h5 class="h6 m-3 font-weight-bold text-info"><i class="fas fa-home"></i> / Tambah Data Pegawai</h5>
                </div><br>

                <div class="card shadow mb-4 ">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Form Tambah Data Pegawai</h6>
                    </div>

                    <div class="card-body col-lg-12 mx-auto">
                        <form class="mx-auto px-auto" style="color: black;" action="../api/apipegawai.php?f=tambahpegawai" method="post" id="tambahpegawai" enctype="multipart/form-data">
                            <table align="center">
                                <tr>
                                    <td>
                                        <div class="input-group mb-3 ">
                                            <div class="input-group-prepend">
                                                <div class="col-lg-12">
                                                    <label class="mx-auto">NIP</label>
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <input type="text" class="form-control" id="nip" name="nip" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" placeholder="Inputkan NIP">
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="input-group mb-3 ">
                                            <div class="input-group-prepend">
                                                <div class="col-lg-12">
                                                    <label>Nama</label>
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <input type="text" class="form-control" id="nama" name="nama" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" placeholder="Inputkan Nama">
                                            </div>
                                        </div>
                                    </td>
                                    <td>
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
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="input-group mb-3 ">
                                            <div class="input-group-prepend">
                                                <div class="col-lg-12">
                                                    <label>Tempat Lahir</label>
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <input type="text" class="form-control" id="tempatlahir" name="tempatlahir" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="input-group mb-3 ">
                                            <div class="input-group-prepend">
                                                <div class="col-lg-12">
                                                    <label>Tanggal Lahir</label>
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <input type="date" class="form-control" id="tgllahir" name="tgllahir" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="input-group mb-3 ">
                                            <div class="input-group-prepend">
                                                <div class="col-lg-12">
                                                    <label>No Handphone</label>
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <input type="number" class="form-control" id="nohp" name="nohp" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="input-group mb-3 ">
                                            <div class="input-group-prepend">
                                                <div class="col-lg-12">
                                                    <label>Alamat</label>
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <input type="text" class="form-control" id="alamat" name="alamat" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="input-group mb-3 ">
                                            <div class="input-group-prepend">
                                                <div class="col-lg-12 ">
                                                    <label>Pangkat</label>
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <select id="pangkat" style="color: black;" name="pangkat" class="form-control">
                                                    <option class="form-control" id="pangkat" name="pangkat" value="" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">Pilih Golongan</option>
                                                    <?php foreach ($golongan as $golongan) {
                                                    ?>
                                                        <option class="form-control" id="pangkat" name="pangkat" value="<?= $golongan["idgolongan"] ?>" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default"><?= $golongan["namapangkat"] . " (" . $golongan["golongan"] . "/" . $golongan["ruang"] . ")"  ?></option>
                                                    <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="input-group mb-3 ">
                                            <div class="input-group-prepend">
                                                <div class="col-lg-12 ">
                                                    <label>Jabatan</label>
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <select id="jabatan" class="form-control" role="menu" style="overflow-y:auto; max-height:80vh" name="jabatan">
                                                    <option class=" form-control" id="jabatan" name="jabatan" value="" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">Pilih Jabatan</option>
                                                    <?php foreach ($jabatan as $jabatan) {
                                                    ?>
                                                        <option class="form-control" id="jabatan" name="jabatan" value="<?= $jabatan["idjabatan"] ?>" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default"><?= $jabatan["namajabatan"] ?></option>
                                                    <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                    </td>
                                    <td align="center">
                                        <hr>
                                        <button type="submit" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm"><i class="fas fa-memory"></i> Simpan</button>
                                        <hr>
                                    </td>
                                </tr>
                            </table>
                        </form>
                        <br><br>
                        <button class=" d-none d-sm-inline-block btn btn-sm btn-danger shadow-sm" onclick="history.go(-1)"><i class="fas fa-backward"></i> Kembali</button>
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
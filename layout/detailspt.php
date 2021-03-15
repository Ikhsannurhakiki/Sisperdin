<!DOCTYPE html>
<html lang="en">

<?php
require("topdansidebar.php");
if (!isset($_SESSION)) {
    header("location:../layout/login.php");
}
$spt = http_request("http://localhost/SisPerDin/api/apispt.php?f=bacasptpernospt&nospt=" . $_GET['nospt']);
$spt = json_decode($spt, TRUE);
$pelaksana = http_request("http://localhost/SisPerDin/api/apispt.php?f=bacapelaksana&nospt=" . $_GET['nospt']);
$pelaksana = json_decode($pelaksana, TRUE);
$pengikut = http_request("http://localhost/SisPerDin/api/apispt.php?f=bacapengikut&nospt=" . $_GET["nospt"]);
$pengikut = json_decode($pengikut, TRUE);
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
            <h5 class="h6 m-3 font-weight-bold text-info"><i class="fas fa-home"></i> / Tampil SPT / Detail SPT </h5>
        </div>
        <br>
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Detail SPT</h6>
            </div>
            <div class="card-body mx-auto my-auto">
                <table cellpadding="15" border="3" width="1000px" style="color: black;">
                    <tbody>
                        <?php foreach ($spt as $spt) {
                            $nospt = $spt["nospt"];
                            $tglinput = $spt["tglinput"];
                            $tglberangkat = $spt["tglberangkat"];
                            $tglkembali = $spt["tglkembali"];
                            $kotatujuan = $spt["kotatujuan"];
                            $maksudtujuan = $spt["maksudtujuan"];
                            $namattd = $spt["nama"];
                            $nipttd = $spt["nip"];
                            $ket = $spt["ket"];
                            $namaaslidokumen = $spt["namaaslidokumen"];
                            $namaarsipdokumen = $spt["namaarsipdokumen"];
                            $namaaslilaporan = $spt["namaaslilaporan"];
                            $namaarsiplaporan = $spt["namaarsiplaporan"];
                        }
                        ?>
                        <tr>
                            <td>No SPT</td>
                            <td><?= $nospt ?></td>
                        </tr>
                        <tr>
                            <td>Tanggal Input</td>
                            <td><?= $tglinput ?></td>
                        </tr>
                        <tr>
                            <td>Tanggal Berangkat</td>
                            <td><?= $tglberangkat ?></td>
                        </tr>
                        <tr>
                            <td>Tanggal Kembali</td>
                            <td><?= $tglkembali ?></td>
                        </tr>
                        <tr>
                            <td>Kota Tujuan</td>
                            <td><?= $kotatujuan ?></td>
                        </tr>
                        <tr>
                            <td>Tujuan</td>
                            <td><?= $maksudtujuan ?></td>
                        </tr>
                        <tr>
                            <td>Penandatangan SPT</td>
                            <td>
                                <a href="http://localhost/SisPerDin/layout/detailpegawai.php?nip=<?= $nipttd ?>">
                                    <?= $namattd ?></a></td>
                        </tr>
                        <tr>
                            <td>Pelaksana / pengikut</td>
                            <td>
                                <?php
                                $no = 0;
                                foreach ($pelaksana as $pelaksana) {
                                    $no++;
                                ?>
                                    <a href="http://localhost/SisPerDin/layout/detailpegawai.php?nip=<?= $pelaksana["nip"] ?>">
                                        <?= $no . '. ' . $pelaksana["nama"] ?></a><br>
                                <?php
                                }

                                foreach ($pengikut as $pengikut) {
                                    $no++;
                                ?>
                                    <a href="http://localhost/SisPerDin/layout/detailpegawai.php?nip=<?= $pengikut["nip"] ?>">
                                        <?= $no . '. ' . $pengikut['nama'] ?> </a><br>
                                <?php
                                }  ?>

                            </td>
                        </tr>
                        <tr>
                            <td>Keterangan</td>
                            <td><?= $ket ?></td>
                        </tr>
                        <tr>
                            <td colspan="2" align="center" style="background-color: darkgrey;">
                                <a href="../api/percetakan.php?f=cetakspt&nospt='<?= $nospt ?>'" target="_blank" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download"></i> Cetak SPT</a>
                                <a href="../api/percetakan.php?f=cetaksppd&nospt='<?= $nospt ?>'" target="_blank" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download"></i> Cetak SPPD</a>
                                <a href="../layout/tampilkwitansi.php?nospt='<?= $nospt ?>'" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"> <i class="fas fa-fw fa-newspaper"></i>Kwitansi</a></td>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Arsip dokumen</h6>
            </div>
            <div class="card-body mx-auto my-auto">
                <table cellpadding="15" border="3" width="1000px" style="color: black;">
                    <tbody>
                        <tr>
                            <td>Arsip dokumen yang sudah ditandatangani</td>
                            <td><a href="../assets/doc/arsipdokumen/<?= $namaarsipdokumen ?>" target="_blank"><?= $namaaslidokumen ?></a>
                                <form class=" mx-auto px-auto" style="color: black;" action="../api/apispt.php?f=simpanarsipdokumen&nospt=<?= $_GET['nospt'] ?>" method="post" id="tambahpegawai" enctype="multipart/form-data">
                                    <input type="file" id="arsipdokumen" name="arsipdokumen" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
                                    <button type="submit" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm"><i class="fas fa-memory"></i> Simpan</button>
                                </form>
                            </td>
                        </tr>
                        <tr>
                            <td>Arsip dokumen laporan perjalanan dinas</td>
                            <td><a href="../assets/doc/arsiplaporan/<?= $namaarsiplaporan ?>" target="_blank"><?= $namaaslilaporan ?></a>
                                <form class=" mx-auto px-auto" style="color: black;" action="../api/apispt.php?f=simpanarsiplaporan&nospt=<?= $_GET['nospt'] ?>" method="post" id="tambahpegawai" enctype="multipart/form-data">
                                    <input type="file" id="arsiplaporan" name="arsiplaporan" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
                                    <button type="submit" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm"><i class="fas fa-memory"></i> Simpan</button>
                                </form>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <br><br>
                <a href="../layout/tampilspt.php" class="d-none d-sm-inline-block btn btn-sm btn-danger shadow-sm"><i class="fas fa-backward"></i> Kembali</a>
            </div>
        </div>
    </div>
</div>

<?php
require("footer.php");
?>

</body>



</html>
<!DOCTYPE html>
<html lang="en">

<?php
require("topdansidebar.php");
if (!isset($_SESSION)) {
    header("location:../layout/login.php");
}
$data = http_request("http://localhost/SisPerDin/api/apispt.php?f=bacaspt");
$data = json_decode($data, TRUE);
$nospt = http_request("http://localhost/SisPerDin/api/apispt.php?f=ceknospt");
$nospt = json_decode($nospt, TRUE);
$pegawai = http_request("http://localhost/SisPerDin/api/apipegawai.php?f=bacapegawaitidakarsip");
$pegawai = json_decode($pegawai, TRUE);
$pegawai2 = http_request("http://localhost/SisPerDin/api/apipegawai.php?f=bacapegawaitidakarsip");
$pegawai2 = json_decode($pegawai2, TRUE);
$pjbtspt = http_request("http://localhost/SisPerDin/api/apidatamaster.php?f=bacapejabatspttidakarsip");
$pjbtspt = json_decode($pjbtspt, TRUE);
$ttdsppd = http_request("http://localhost/SisPerDin/api/apidatamaster.php?f=bacapejabatsppdtidakarsip");
$ttdsppd = json_decode($ttdsppd, TRUE);
$komit = http_request("http://localhost/SisPerDin/api/apidatamaster.php?f=bacapejabatkomittidakarsip");
$komit = json_decode($komit, TRUE);
?>


<head>

    <title>SisPerDin | Tambah Data SPT</title>
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

        <!-- Page Heading -->
        <!-- <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h5 mb-0 text-gray-800"><b>Tambah Data SPT</b></h1>
        </div> -->

        <div class="row mx-auto">
            <div class="col-lg-12 mx-auto px-auto">

                <!-- Circle Buttons -->
                <div class="card shadow mb-4 ">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Form Tambah SPT</h6>
                    </div>

                    <div class="card-body col-lg-12 mx-auto">
                        <form class="mx-auto px-auto" action="../api/apispt.php?f=tambahspt" method="post" id="tambahspt">
                            <table align="center" style="color: black;">
                                <tr>
                                    <td width="33%">
                                        <div class="input-group mb-3 ">
                                            <div class="input-group-prepend">
                                                <div class="col-lg-12">
                                                    <label class="mx-auto">No SPT</label>
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <?php $hasilnospt = nosurat($nospt) ?>
                                                <input type="text" class="form-control" value="<?= $hasilnospt ?>" id="nospt" name="nospt" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" readonly="true">
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="input-group mb-3 ">
                                            <div class="input-group-prepend">
                                                <div class="col-lg-12">
                                                    <label class="mx-auto">Pilih Pelaksana</label>
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <select id="pelaksana" style="color: black;" name="nippelaksana" class="form-control">
                                                    <option class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">Pilih Pelaksana</option>
                                                    <?php foreach ($pegawai as $pegawai) {
                                                    ?>
                                                        <option class="form-control" style="color: black;" value="<?= $pegawai["nip"] ?>" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default"><?= $pegawai["nama"] . " - " . $pegawai["nip"] ?></option>
                                                    <?php } ?>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="input-group mb-3 ">
                                            <div class="input-group-prepend">
                                                <div class="col-lg-12">
                                                    <label>Tanggal berangkat</label>
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <input type="date" class="form-control" id="tglberangkat" name="tglberangkat" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
                                            </div>
                                        </div>
                                    </td>
                                    <td rowspan="3">
                                        <label class="mx-auto">Pilih Pengikut <i style="color: red;">*(opsional)</i></label>
                                        <select multiple style="color: black;" id="nippengikut" name="nippengikut[]" class="form-control">
                                            <?php foreach ($pegawai2 as $pegawai) { ?>
                                                <option class="form-control" style="color: black;" value="<?= $pegawai["nip"] ?>" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default"><?= $pegawai["nama"] . " - " . $pegawai["nip"] ?></option>
                                            <?php }
                                            ?>
                                        </select>
                                        <label class="mx-auto"><i style="color: red;">*(ctrl+click) untuk pilihan lebih dari satu</i></label>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="input-group mb-3 ">
                                            <div class="input-group-prepend">
                                                <div class="col-lg-12">
                                                    <label>Tanggal kembali</label>
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <input type="date" class="form-control" id="tglkembali" name="tglkembali" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="input-group mb-3 ">
                                            <div class="input-group-prepend">
                                                <div class="col-lg-12 ">
                                                    <label>Lama perjalanan</label>
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <input type="number" class="form-control" id="lamaperjalanan" name="lamaperjalanan" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" placeholder="Inputkan lama perjalanan">
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>

                                </tr>
                                <tr>
                                    <td width="33%">
                                        <div class="input-group mb-3 ">
                                            <div class="input-group-prepend">
                                                <div class="col-lg-12">
                                                    <label class="mx-auto">Kota tujuan</label>
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <input type="text" class="form-control" id="kotatujuan" name="kotatujuan" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" placeholder="Inputkan kota tujuan">
                                            </div>
                                        </div>
                                    </td>
                                    <td width="33%">
                                        <div class="input-group mb-3 ">
                                            <div class="input-group-prepend">
                                                <div class="col-lg-12">
                                                    <label class="mx-auto">Pejabat TTD SPT</label>
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <select id="ttdspt" style="color:black;" name="ttdspt" class="form-control">
                                                    <option class="form-control" value="">Pilih penandatangan SPT</option>
                                                    <?php foreach ($pjbtspt as $pjbtspt) {
                                                    ?>
                                                        <option class="form-control" style="color: black;" id="ttdspt" name="ttdspt" value="<?= $pjbtspt['id'] ?>"><?= $pjbtspt['nama'] . " - " . $pjbtspt['nip'] ?></option>
                                                    <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td rowspan=" 2">
                                        <div class="input-group mb-3 ">
                                            <div class="input-group-prepend">
                                                <div class="col-lg-12 ">
                                                    <label>Maksud / tujuan perjalanan</label>
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <textarea rows="5" class="form-control" style="color: black;" id="maksud" name="maksud" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default"></textarea>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="input-group mb-3 ">
                                            <div class="input-group-prepend">
                                                <div class="col-lg-12">
                                                    <label class="mx-auto">Pejabat TTD SPPD</label>
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <select id="ttdsppd" name="ttdsppd" style="color: black;" class="form-control">
                                                    <option class="form-control" value="">Pilih penandatangan SPPD</option>
                                                    <?php foreach ($ttdsppd as $ttdsppd) {
                                                    ?>
                                                        <option class="form-control" style="color: black;" id="ttdsppd" name="ttdsppd" value="<?= $ttdsppd["id"] ?>" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default"><?= $ttdsppd["nama"] . " - " . $ttdsppd["nip"] ?></option>
                                                    <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="input-group mb-3 ">
                                            <div class="input-group-prepend">
                                                <div class="col-lg-12">
                                                    <label class="mx-auto">Pejabat Pembuat Komitmen</label>
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <select id="komit" name="komit" style="color: black;" class="form-control">
                                                    <option class="form-control" value="">Pilih pembuat komitmen</option>
                                                    <?php foreach ($komit as $komit) {
                                                    ?>
                                                        <option class="form-control" style="color: black;" id="komit" name="komit" value="<?= $komit["id"] ?>" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default"><?= $komit["nama"] . " - " . $komit["nip"] ?></option>
                                                    <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                        <div class="input-group mb-3 ">
                                            <div class="input-group-prepend">
                                                <div class="col-lg-12">
                                                    <label class="mx-auto">Keterangan tambahan <i style="color: red;">*(opsional)</i></label>
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <textarea rows="4" class="form-control" style="color: black;" id="ket" name="ket" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default"></textarea>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="3">
                                        <hr>
                                        <div class="col-lg-1 mx-auto ">
                                            <button type="submit" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm">Simpan</button>
                                        </div>
                                        <hr>
                                    </td>
                                </tr>
                            </table>

                        </form>

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

    <!-- Page level plugins -->
    <script src="http://localhost/SisPerDin/assets/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="http://localhost/SisPerDin/assets/vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="http://localhost/SisPerDin/assets/js/demo/datatables-demo.js"></script>

    <?php
    function nosurat($nospt)
    {
        $tahun = date('y');
        $bulan = bulanromawi();
        $nomor = "/SPT/" . $bulan . "/" . $tahun;
        foreach ($nospt as $nospt) {
            $nospt = $nospt['maksnospt'];
        }
        $nospt = floatval($nospt)  + 1;
        $kode = sprintf("%03s", $nospt);
        $hasil = $kode . $nomor;
        return $hasil;
    }

    function bulanromawi()
    {
        $bulan = date('n');
        switch ($bulan) {
            case 1:
                return "I";
                break;
            case 2:
                return "II";
                break;
            case 3:
                return "III";
                break;
            case 4:
                return "IV";
                break;
            case 5:
                return "V";
                break;
            case 6:
                return "VI";
                break;
            case 7:
                return "VII";
                break;
            case 8:
                return "VIII";
                break;
            case 9:
                return "IX";
                break;
            case 10:
                return "X";
                break;
            case 11:
                return "XI";
                break;
            case 12:
                return "XII";
                break;
        }
    }
    ?>



</body>

</html>
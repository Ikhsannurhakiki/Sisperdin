<!DOCTYPE html>
<html lang="en">

<?php
require("topdansidebar.php");
if (!isset($_SESSION)) {
    header("location:../layout/login.php");
}
$data = http_request("http://localhost/SisPerDin/api/apidatamaster.php?f=tampiljabatan");
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
            <h5 class="h6 m-3 font-weight-bold text-info"><i class="fas fa-home"></i> / Data Master Jabatan</h5>
        </div><br>
        <div class="card shadow mb-4 ">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Form Tambah Data Master Jabatan</h6>
            </div>
            <div class="card-body col-lg-12 mx-auto">
                <form class="mx-auto px-auto" action="../api/apidatamaster.php?f=tambahjabatan" method="post" id="tambahpegawai" enctype="multipart/form-data">
                    <div class="input-group mb-3 ">
                        <div class="input-group-prepend">
                            <div class="col-lg-12">
                                <label>Jabatan</label>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <input type="text" class="form-control" id="jabatan" name="jabatan" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
                        </div>
                    </div>
                    <hr>
                    <div style="text-align: center;">
                        <button type="submit" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm"><i class="fas fa-memory"></i> Simpan</button>
                    </div>
                    <hr>
                </form>
            </div>
        </div>
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Data Master Jabatan</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Jabatan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 0;
                            foreach ($data as $data) {

                            ?>
                                <tr>
                                    <td><?php $no++;
                                        echo $no ?></td>
                                    <td><?= $data["namajabatan"] ?></td>
                                    <td align="center" width="30%">
                                        <a href="#!" class="btn btn-danger" onclick="hapusdata(<?= $data['idjabatan'] ?>)"><i class="fas fa-trash text-white-50"> Hapus</i></a>
                                        <?php if ($data['statusarsip'] == 'tidak') { ?>
                                            <a href="../api/apidatamaster.php?id=<?= $data['idjabatan'] ?>&f=arsipjabatan&arsipkan=ya" class="btn btn-info"><i class="fas fa-newspaper text-white-50"> Arsipkan</i></a>
                                        <?php } else { ?>
                                            <a href="../api/apidatamaster.php?id=<?= $data['idjabatan'] ?>&f=arsipjabatan&arsipkan=tidak" class="btn btn-secondary"><i class="fas fa-newspaper text-white-50"> Kembalikan</i></a>
                                        <?php } ?>
                                    </td>
                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
                <button class=" d-none d-sm-inline-block btn btn-sm btn-danger shadow-sm" onclick="history.go(-1)"><i class="fas fa-backward"></i> Kembali</button>
            </div>
        </div>
    </div>
</div>

<script>
    function hapusdata(id) {
        var konfirm = confirm("apakan yakin ingin hapus data?");
        if (konfirm) {
            window.location = "http://localhost/SisPerDin/api/apidatamaster.php?id=" + id + "&f=hapusjabatan";
        }
    }
</script>

<!-- Page level plugins -->
<script src="http://localhost/SisPerDin/assets/vendor/datatables/jquery.dataTables.min.js"></script>
<script src="http://localhost/SisPerDin/assets/vendor/datatables/dataTables.bootstrap4.min.js"></script>

<!-- Page level custom scripts -->
<script src="http://localhost/SisPerDin/assets/js/demo/datatables-demo.js"></script>



</body>
<?php
require("footer.php");
?>


</html>
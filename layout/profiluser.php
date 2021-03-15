<!DOCTYPE html>
<html lang="en">

<?php
require("topdansidebar.php");
$id = $_SESSION['id'];
$user = http_request("http://localhost/SisPerDin/api/apiuser.php?f=bacauser&id=" . $id);
$user = json_decode($user, TRUE);

foreach ($user as $user) {
    $username = $user['username'];
    $alamat = $user['alamat'];
    $nohp = $user['nohp'];
    $status = $user['status'];
    $namafotorandom = $user['namafotorandom'];
    $namafotoasli = $user['namafotoasli'];
}

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
            <h5 class="h6 m-3 font-weight-bold text-info"><i class="fas fa-home"></i> / Detail User</h5>
        </div><br>
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Detail User</h6>
            </div>
            <br>
            <div class="card-body mx-auto my-auto text-white">
                <table cellpadding="3" style="color: black;">

                    <tbody>
                        <tr>
                            <td rowspan="4" width="50%">
                                <a href="../assets/img/fotouser/<?= $namafotorandom ?>">
                                    <img src="../assets/img/fotouser/<?= $namafotorandom ?>" width="50%"></a></td>
                            <td>Username</td>
                            <td>|</td>
                            <td><?= $username ?></td>
                        </tr>
                        <tr>
                            <td>Alamat</td>
                            <td>|</td>
                            <td><?= $alamat ?></td>
                        </tr>
                        <tr>
                            <td>No Handphone</td>
                            <td>|</td>
                            <td><?= $nohp ?></td>
                        </tr>
                        <tr>
                            <td>Status</td>
                            <td>|</td>
                            <td><?= $status ?></td>
                        </tr>
                    </tbody>

                </table>
            </div>
            <div class="card-header py-3 mx-auto">
                <button class="d-none d-sm-inline-block btn btn-sm btn-danger shadow-sm" onclick="history.go(-1)"><i class="fas fa-backward"></i> Kembali</button>
                <a href="../layout/edituser.php" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"> <i class="fas fa-fw fa-user-cog"></i> Edit user</a></td>
            </div>
        </div>
    </div>
</div>

<?php
require("footer.php");
?>

</body>



</html>
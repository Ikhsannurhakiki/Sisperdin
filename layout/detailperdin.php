<!DOCTYPE html>
<html lang="en">

<?php
require("topdansidebar.php");
if (!isset($_SESSION)) {
    header("location:../layout/login.php");
}

$data = http_request("http://localhost/SisPerDin/api/readdatapegawai.php");
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

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Detail Perjalanan Dinas</h1>
            <a href="../api/cetakdaftarpegawai.php" target="_blank" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Cetak</a>
        </div>

</html>
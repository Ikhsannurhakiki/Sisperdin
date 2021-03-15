<?php
if (isset($_GET['f'])) {
    if (function_exists($_GET['f'])) {
        $_GET['f']();
    }
}

function jmlhpegawaitidakarsip()
{
    //perintah lakukan koneksi ke database
    require_once("../config/koneksi.php");

    //membuat data dalam bentuk array
    $myArray = array();

    //query untuk menampilkan data secara keseluruhan
    $sql = "SELECT COUNT(nama) AS jmlhpegawai FROM datapegawai WHERE statusarsippegawai = 'tidak'";
    if ($result = mysqli_query($konek, $sql)) {
        while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
            $myArray[] = $row;
        }
        echo json_encode($myArray);
    }
    mysqli_close($konek);
}

function jmlhpegawaiarsip()
{
    //perintah lakukan koneksi ke database
    require_once("../config/koneksi.php");

    //membuat data dalam bentuk array
    $myArray = array();

    //query untuk menampilkan data secara keseluruhan
    $sql = "SELECT COUNT(nama) AS jmlhpegawai FROM datapegawai WHERE statusarsippegawai = 'ya'";
    if ($result = mysqli_query($konek, $sql)) {
        while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
            $myArray[] = $row;
        }
        echo json_encode($myArray);
    }
    mysqli_close($konek);
}

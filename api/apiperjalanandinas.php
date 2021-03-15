

<?php
if (isset($_GET['f'])) {
    if (function_exists($_GET['f'])) {
        $_GET['f']();
    }
}

function tampilperjalanan()
{
    //perintah lakukan koneksi ke database
    require_once("../config/koneksi.php");

    //membuat data dalam bentuk array
    $myArray = array();

    //query untuk menampilkan data secara keseluruhan
    $sql = "SELECT * FROM dataperjalanandinas,datapegawai WHERE dataperjalanandinas.nip = datapegawai.nip";
    if ($result = mysqli_query($konek, $sql)) {
        while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
            $myArray[] = $row;
        }
        echo json_encode($myArray);
    }
    mysqli_close($konek);
}

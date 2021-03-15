<?php
if (isset($_GET['f'])) {
    if (function_exists($_GET['f'])) {
        $_GET['f']();
    }
}



/* ************ FUNGSI BACA DATA PEGAWAI ************  */
function bacapegawai()
{
    require_once("../config/koneksi.php");

    //membuat data dalam bentuk array
    $myArray = array();

    //query untuk menampilkan data secara keseluruhan
    $sql = "SELECT * FROM datapegawai,dmgolongan,dmjabatan WHERE datapegawai.jabatan = dmjabatan.idjabatan AND datapegawai.golongan = dmgolongan.idgolongan ORDER BY datapegawai.jabatan, datapegawai.golongan, datapegawai.tanggallahir";
    if ($result = mysqli_query($konek, $sql)) {
        while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
            $myArray[] = $row;
        }
        echo json_encode($myArray);
    }
    mysqli_close($konek);
}

function bacapegawaitidakarsip()
{
    require_once("../config/koneksi.php");

    //membuat data dalam bentuk array
    $myArray = array();

    //query untuk menampilkan data secara keseluruhan
    $sql = "SELECT * FROM datapegawai,dmgolongan,dmjabatan WHERE datapegawai.jabatan = 
    dmjabatan.idjabatan AND datapegawai.golongan = dmgolongan.idgolongan 
    AND statusarsippegawai='tidak'
    ORDER BY datapegawai.jabatan, datapegawai.golongan, datapegawai.tanggallahir";
    if ($result = mysqli_query($konek, $sql)) {
        while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
            $myArray[] = $row;
        }
        echo json_encode($myArray);
    }
    mysqli_close($konek);
}

function bacapegawaiarsip()
{
    require_once("../config/koneksi.php");

    //membuat data dalam bentuk array
    $myArray = array();

    //query untuk menampilkan data secara keseluruhan
    $sql = "SELECT * FROM datapegawai,dmgolongan,dmjabatan WHERE datapegawai.jabatan = 
    dmjabatan.idjabatan AND datapegawai.golongan = dmgolongan.idgolongan 
    AND statusarsippegawai='ya'
    ORDER BY datapegawai.jabatan, datapegawai.golongan, datapegawai.tanggallahir";
    if ($result = mysqli_query($konek, $sql)) {
        while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
            $myArray[] = $row;
        }
        echo json_encode($myArray);
    }
    mysqli_close($konek);
}

function bacapegawai2()
{
    require_once("../config/koneksi.php");

    //membuat data dalam bentuk array
    $myArray = array();

    //query untuk menampilkan data secara keseluruhan
    $sql = "SELECT * FROM datapegawai,dmgolongan,dmjabatan WHERE datapegawai.jabatan = dmjabatan.idjabatan AND datapegawai.golongan = dmgolongan.idgolongan ORDER BY nama ASC";
    if ($result = mysqli_query($konek, $sql)) {
        while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
            $myArray[] = $row;
        }
        echo json_encode($myArray);
    }
    mysqli_close($konek);
}


/* ************ FUNGSI TAMBAH DATA PEGAWAI ************  */
function tambahpegawai()
{
    if (
        !empty($_POST['nip']) && !empty($_POST['nama']) && !empty($_POST['tempatlahir']) && !empty($_POST['tgllahir'])
        && !empty($_POST['nohp']) && !empty($_POST['alamat']) && !empty($_POST['pangkat']) && !empty($_POST['jabatan'])
    ) {
        $nip = filter_input(INPUT_POST, 'nip', FILTER_SANITIZE_STRING);
        $nama = filter_input(INPUT_POST, 'nama', FILTER_SANITIZE_STRING);
        $tempatlahir = filter_input(INPUT_POST, 'tempatlahir', FILTER_SANITIZE_STRING);
        $tgllahir = $_POST['tgllahir'];
        $nohp = filter_input(INPUT_POST, 'nohp', FILTER_SANITIZE_STRING);
        $alamat = filter_input(INPUT_POST, 'alamat', FILTER_SANITIZE_STRING);
        $pangkat = filter_input(INPUT_POST, 'pangkat', FILTER_SANITIZE_STRING);
        $jabatan = filter_input(INPUT_POST, 'jabatan', FILTER_SANITIZE_STRING);
        $namaaslifoto = $_FILES['foto']['name'];
        $foto = upload();

        require_once('../config/koneksi.php');

        $querysimpan = "INSERT INTO datapegawai (nip, nama, alamat, nohp, tempatlahir, tanggallahir, golongan, jabatan, foto, namaaslifoto)  VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $konek->prepare($querysimpan);
        $stmt->bind_param("ssssssssss", $nip, $nama, $alamat, $nohp, $tempatlahir, $tgllahir, $pangkat, $jabatan, $foto, $namaaslifoto);
        if ($foto) {
            $saved = $stmt->execute();
        } else {
            $saved = false;
        }
        if ($saved) {
            $pesan = "Data berhasil disimpan";
            echo "<script>
            alert('" . $pesan . "')
            window.location.replace('../layout/anggota.php')
            </script>";
        } else {
            $pesan = "Data gagal disimpan";
        }
    } else {
        $pesan = "Mohon isi semua form yang ada";
    }
    echo "<script>
    alert('" . $pesan . "')
    window.location.replace('../layout/tambahdatapegawai.php')
    </script>";
}



/* ************ FUNGSI CARI PEGAWAI ********** */
function caripegawai()
{
    if (
        isset($_GET['nip'])
    ) {
        $nip = $_GET['nip'];
        //perintah lakukan koneksi ke database
        require_once("../config/koneksi.php");

        //membuat data dalam bentuk array
        $myArray = array();

        //query untuk menampilkan data secara keseluruhan
        $sql = "SELECT * FROM datapegawai,dmgolongan,dmjabatan WHERE datapegawai.jabatan = dmjabatan.idjabatan AND datapegawai.golongan = dmgolongan.idgolongan AND datapegawai.nip = '$nip' ";
        if ($result = mysqli_query($konek, $sql)) {
            while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
                $myArray[] = $row;
            }
            echo json_encode($myArray);
        }
        mysqli_close($konek);
    } else {
        echo "<script>
        alert('NIP tidak diketahui')
        window.location.replace('../layout/anggota.php')
        </script>";
    }
}



/* ****************** FUNGSI EDIT PEGAWAI ************* */
function editpegawai()
{
    $nip = filter_input(INPUT_POST, 'nip', FILTER_SANITIZE_STRING);

    if (
        !empty($_POST['nip']) && !empty($_POST['nama']) && !empty($_POST['tempatlahir']) && !empty($_POST['tgllahir'])
        && !empty($_POST['nohp']) && !empty($_POST['alamat']) && !empty($_POST['pangkat']) && !empty($_POST['jabatan'])
        && !empty($_GET['nmfotolama'])
    ) {

        $nama = filter_input(INPUT_POST, 'nama', FILTER_SANITIZE_STRING);
        $tempatlahir = filter_input(INPUT_POST, 'tempatlahir', FILTER_SANITIZE_STRING);
        $tgllahir = $_POST['tgllahir'];
        $nohp = filter_input(INPUT_POST, 'nohp', FILTER_SANITIZE_STRING);
        $alamat = filter_input(INPUT_POST, 'alamat', FILTER_SANITIZE_STRING);
        $pangkat = filter_input(INPUT_POST, 'pangkat', FILTER_SANITIZE_STRING);
        $jabatan = filter_input(INPUT_POST, 'jabatan', FILTER_SANITIZE_STRING);
        $namafotolama = $_GET['nmfotolama'];

        if (file_exists($_FILES['foto']['tmp_name'])) {
            $foto = upload();
            $namaaslifoto = $_FILES['foto']['name'];
        } else {
            $foto = null;
        }

        require_once('../config/koneksi.php');
        if (is_null($foto)) {
            // return false;
            $queryupdate = "UPDATE datapegawai SET nip = ?, nama = ?, alamat = ?, nohp = ?, 
            tempatlahir = ?, tanggallahir = ?, golongan = ?, jabatan = ?  
            WHERE nip = ?";
            $stmt = $konek->prepare($queryupdate);
            $stmt->bind_param(
                "sssssssss",
                $nip,
                $nama,
                $alamat,
                $nohp,
                $tempatlahir,
                $tgllahir,
                $pangkat,
                $jabatan,
                $nip
            );
        } elseif ($foto) {
            $queryupdate = "UPDATE datapegawai SET nip = ?, nama = ?, alamat = ?, nohp = ?, 
            tempatlahir = ?, tanggallahir = ?, golongan = ?, jabatan = ?, foto = ?, namaaslifoto = ?  
            WHERE nip = ?";
            $stmt = $konek->prepare($queryupdate);
            $stmt->bind_param(
                "sssssssssss",
                $nip,
                $nama,
                $alamat,
                $nohp,
                $tempatlahir,
                $tgllahir,
                $pangkat,
                $jabatan,
                $foto,
                $namaaslifoto,
                $nip
            );
            unlink("../assets/img/pasfoto/$namafotolama");
        }
        if (is_null($foto) || $foto) {
            $saved = $stmt->execute();
        } else {
            $saved = false;
        }
        if ($saved) {
            $pesan = "Data berhasil diperbaharui";
        } else {
            $pesan = "Data gagal diperbaharui";
        }
    } else {
        $pesan = "Mohon untuk mengisi semua form yang ada";
    }
    $nip = "'" . $nip . "'";
    echo "<script>
    alert('" . $pesan . "')
    window.location.replace('../layout/detailpegawai.php?nip=' + $nip )
    </script>";
}


/* ************** FUNGSI HAPUS DATA PEGAWAI ************ */
function hapuspegawai()
{
    if (
        !empty($_GET['nip']) && !empty($_GET['foto'])
    ) {
        $nip = $_GET['nip'];
        $foto = $_GET['foto'];
        $foto = substr($foto, 1, -1);
        $nip = substr($nip, 1, -1);

        require_once("../config/koneksi.php");

        $sql = $konek->prepare("DELETE FROM datapegawai WHERE nip=?"); //siap-siap dalam melakukan penghapusan
        $sql->bind_param('s',  $nip);

        $sql->execute(); //eksekusi perintah query
        if ($sql) {
            $query = "SELECT * FROM datapegawai where nip = '$nip'";
            $hasil = mysqli_query($konek, $query);
            $hasilcek = mysqli_num_rows($hasil);
            if ($hasilcek > 0) {
                $pesan = "Data tidak bisa dihapus karena sudah terkait dengan data lain (disarankan untuk diarsipkan)";
            } else {
                // unlink("../assets/img/pasfoto/$foto");
                $pesan = "Data berhasil dihapus";
            }
        } else {
            $pesan = "Data gagal dihapus";
        }
    } else {
        $pesan = "Data tidak diketahui";
    }
    echo "<script>
    alert('" . $pesan . "')
    window.location.replace('../layout/anggota.php?')
    </script>";
}



/* ************** FUNGSI UPLOAD ***************** */
function upload()
{
    $namaFile = $_FILES['foto']['name'];
    $ukuranFile = $_FILES['foto']['size'];
    $errorFile = $_FILES['foto']['error'];
    $tmp = $_FILES['foto']['tmp_name'];

    /* cek isset foto */
    if ($errorFile === 4) {
        echo "<script>
        alert('Mohon untuk pilih foto terlebih dahulu');
        </script>";
        return false;
    }

    /* cek is foto */
    $ekstensibenar = ['jpg', 'jpeg', 'png'];
    $ekstensifoto = explode('.', $namaFile);
    $ekstensifoto = strtolower(end($ekstensifoto));

    /* cek jenis file */
    if (!in_array($ekstensifoto, $ekstensibenar)) {
        echo "<script>
        alert('Yang anda upload harus berupa foto (ekstensi = .jpg | .jpeg | .png)');
        </script>";
        return false;
    }

    /* cek ukuran file */
    if ($ukuranFile > 1000000) {
        echo "<script>
        alert('Ukuran foto terlalu besar (Maks 1 MB)');
        </script>";
        return false;
    }

    /* membuat nama file random */
    $namabaru = uniqid();
    $namabaru .= '.';
    $namabaru .= $ekstensifoto;
    move_uploaded_file($tmp, '../assets/img/pasfoto/' . $namabaru);
    return $namabaru;
}

function arsippegawai()
{
    if ($_GET['arsipkan'] == 'ya') {
        $arsip = 'ya';
        $status = 'diarsipkan';
        $redirect = "../layout/anggota.php?arsip";
    } else {
        $arsip = 'tidak';
        $status = 'dikembalikan';
        $redirect = "../layout/anggota.php";
    }
    require_once('../config/koneksi.php');
    $nip = $_GET['nip'];
    $query = "UPDATE datapegawai SET statusarsippegawai = ? WHERE nip = ?";
    $stmt = $konek->prepare($query);
    // $stmt->bind_param("si", $arsip, $id);
    $stmt->bind_param("si", $arsip, $nip);
    $saved = $stmt->execute();

    if ($saved) {
        $pesan = "Data berhasil " . $status;
    } else {
        $pesan = "Data gagal " . $status;
    }

    echo "<script>
    alert('" . $pesan . "')
    window.location.replace('" . $redirect . "')
    </script>";
}

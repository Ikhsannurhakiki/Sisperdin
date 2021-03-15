<?php

if (isset($_GET['f'])) {
    if (function_exists($_GET['f'])) {
        $_GET['f']();
    }
}

function tambahuser()
{
    if (
        !empty($_POST['username']) && !empty($_POST['alamat']) && !empty($_POST['nohp'])
        && !empty($_POST['password']) && !empty($_POST['konfirmpassword'])
        && !empty($_POST['lvladmin'])
    ) {
        if ($_POST['password'] == $_POST['konfirmpassword']) {
            $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
            $alamat = filter_input(INPUT_POST, 'alamat', FILTER_SANITIZE_STRING);
            $nohp = filter_input(INPUT_POST, 'nohp', FILTER_SANITIZE_STRING);
            $enkrippassword = password_hash($_POST["password"], PASSWORD_DEFAULT);
            $level = $_POST['lvladmin'];
            $namaaslifoto = $_FILES['foto']['name'];
            $foto = upload();

            require_once('../config/koneksi.php');

            $querysimpan = "INSERT INTO user (username, password, alamat, nohp, namafotoasli, namafotorandom, status)  VALUES (?, ?, ?, ?, ?, ?, ?)";
            $stmt = $konek->prepare($querysimpan);
            $stmt->bind_param("sssssss", $username, $enkrippassword, $alamat, $nohp, $namaaslifoto, $foto, $level);
            if ($foto) {
                $saved = $stmt->execute();
            } else {
                $saved = false;
            }
            if ($saved) {
                $pesan = "Data berhasil disimpan";
            } else {
                $pesan = "Data gagal disimpan";
            }
        } else {
            $pesan = "Konfirmasi password salah";
        }
    } else {
        $pesan = "Mohon isi semua form yang ada";
    }
    echo "<script>
        alert('" . $pesan . "')
        window.location.replace('../layout/tambahuser.php')
        </script>";
}

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
    move_uploaded_file($tmp, '../assets/img/fotouser/' . $namabaru);
    return $namabaru;
}

function bacauser()
{
    require_once("../config/koneksi.php");
    $myArray = array();
    $sql = "SELECT * FROM user WHERE id = " . $_GET['id'];;
    if ($result = mysqli_query($konek, $sql)) {
        while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
            $myArray[] = $row;
        }
        echo json_encode($myArray);
    }
    mysqli_close($konek);
}

function editdatauser()
{
    if (
        !empty($_POST['id']) && !empty($_POST['username']) && !empty($_POST['alamat']) && !empty($_POST['nohp'])
    ) {
        $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
        $alamat = filter_input(INPUT_POST, 'alamat', FILTER_SANITIZE_STRING);
        $nohp = filter_input(INPUT_POST, 'nohp', FILTER_SANITIZE_STRING);
        $id = $_POST['id'];
        require_once('../config/koneksi.php');
        if (file_exists($_FILES['foto']['tmp_name'])) {
            $namaaslifoto = $_FILES['foto']['name'];
            $foto = upload();
        } else {
            $foto = null;
        }

        if (is_null($foto)) {
            $querysimpan = "UPDATE user SET username = ?, alamat = ?, 
            nohp = ? WHERE id = ?";
            $stmt = $konek->prepare($querysimpan);
            $stmt->bind_param("sssi", $username, $alamat, $nohp, $id);
        } elseif ($foto) {
            $querysimpan = "UPDATE user SET username = ?, alamat = ?, 
            nohp = ?, namafotoasli = ?, namafotorandom = ? WHERE id = ?";
            $stmt = $konek->prepare($querysimpan);
            $stmt->bind_param("sssssi", $username, $alamat, $nohp, $namaaslifoto, $foto, $id);
            unlink("../assets/img/fotouser/" . $_GET['namafotolama']);
        }

        if (is_null($foto) || $foto) {
            $saved = $stmt->execute();
        } else {
            $saved = false;
        }

        if ($saved) {
            $pesan = "Data berhasil disimpan";
        } else {
            $pesan = "Data gagal disimpan";
        }
    } else {
        $pesan = "Mohon isi semua form yang ada";
    }
    echo "<script>
        alert('" . $pesan . "')
        window.location.replace('../layout/edituser.php')
        </script>";
}

function gantipassworduser()
{
    if (
        !empty($_POST['passwordlama']) && !empty($_POST['passwordbaru']) && !empty($_POST['konfirmpassword'])
    ) {
        $passwordlama = $_POST['passwordlama'];
        $passwordasli = $_POST['passwordasli'];
        $passwordbaru = $_POST['passwordbaru'];
        $konfirmpassword = $_POST['konfirmpassword'];
        $id = $_POST['id'];
        require_once('../config/koneksi.php');
        if (password_verify($passwordlama, $passwordasli) == true) {
            if ($passwordbaru == $konfirmpassword) {
                $querysimpan = "UPDATE user SET password = ? WHERE id = ?";
                $enkrippassword = password_hash($passwordbaru, PASSWORD_DEFAULT);
                $stmt = $konek->prepare($querysimpan);
                $stmt->bind_param("si", $enkrippassword, $id);
                $saved = $stmt->execute();
                if ($saved) {
                    $pesan = "Password berhasil diperbaharui";
                    echo "<script>
                    alert('" . $pesan . "')
                    window.location.replace('../api/apilogin.php?f=logout')
                    </script>";
                } else {
                    $pesan = "Password gagal diperbaharui";
                }
            } else {
                $pesan = "Password baru tidak sesuai dengan konfirmasi password";
            }
        } else {
            $pesan = "Pasword lama anda salah";
        }
    } else {
        $pesan = "Mohon isi semua form yang ada";
    }
    echo "<script>
    alert('" . $pesan . "')
    window.location.replace('../layout/edituser.php')
    </script>";
}

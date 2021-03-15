<?php

if (isset($_GET['f'])) {
    if (function_exists($_GET['f'])) {
        $_GET['f']();
    }
}

function login()
{
    require_once('../config/koneksi.php');


    if (!empty($_POST['username']) && !empty($_POST['password'])) {
        $usernamedritxtfield = filter_input(INPUT_POST, 'username', FILTER_DEFAULT);
        $userpassword = mysqli_real_escape_string($konek, $_POST['password']);
        $querycek = "SELECT * FROM user where username = '$usernamedritxtfield'";
        $hasil = mysqli_query($konek, $querycek);
        list(
            $id, $username, $password, $alamat, $nohp, $namafotoasli, $namafotorandom,
            $status
        ) = mysqli_fetch_array($hasil);
        $user = mysqli_num_rows($hasil);

        if ($user > 0) {
            if (password_verify($userpassword, $password) == true) {
                session_start();
                $_SESSION['username'] = $username;
                $_SESSION['id'] = $id;
                $_SESSION['status'] = $status;
                $pesan = "Selamat Datang " . $username;
            } else
                $pesan = "Password yang anda inputkan salah";
        } else {
            $pesan = "User dengan nama " . $usernamedritxtfield . " tidak terdaftar";
        }
    } else {
        $pesan = "Mohon isi semua halaman teks yang ada";
    }
    echo "<script>
    alert('" . $pesan . "')
    window.location.replace('../index.php')
    </script>";
}

function logout()
{
    session_start();
    unset($_SESSION['username']);
    session_unset();
    session_destroy();
    header("location:../layout/login.php");
}

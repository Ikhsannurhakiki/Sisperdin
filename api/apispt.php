<?php
if (isset($_GET['f'])) {
    if (function_exists($_GET['f'])) {
        $_GET['f']();
    }
}

function bacakwitansi()
{
    require_once("../config/koneksi.php");
    $nospt = $_GET['nospt'];
    //membuat data dalam bentuk array
    $myArray = array();

    //query untuk menampilkan data secara keseluruhan
    $sql = "SELECT * FROM datakwitansi WHERE nospt = $nospt";
    if ($result = mysqli_query($konek, $sql)) {
        while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
            $myArray[] = $row;
        }
        echo json_encode($myArray);
    }
    mysqli_close($konek);
}

function bacatotalbiaya()
{
    require_once("../config/koneksi.php");
    $nospt = $_GET['nospt'];
    //membuat data dalam bentuk array
    $myArray = array();

    //query untuk menampilkan data secara keseluruhan
    $sql = "SELECT sum(dana) AS biaya FROM datakwitansi WHERE nospt = $nospt";
    if ($result = mysqli_query($konek, $sql)) {
        while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
            $myArray[] = $row;
        }
        echo json_encode($myArray);
    }
    mysqli_close($konek);
}


function tambahspt()
{
    if (
        !empty($_POST['nospt']) && !empty($_POST['tglberangkat']) && !empty($_POST['tglkembali'])
        && !empty($_POST['lamaperjalanan']) && !empty($_POST['kotatujuan']) && !empty($_POST['ttdspt']) && !empty($_POST['maksud'])
        && !empty($_POST['ttdsppd']) && !empty($_POST['komit']) && isset($_POST['nippelaksana'])
    ) {

        $nospt = filter_input(INPUT_POST, 'nospt', FILTER_SANITIZE_STRING);
        $tglberangkat = $_POST['tglberangkat'];
        $tglkembali = $_POST['tglkembali'];
        $nippelaksana = filter_input(INPUT_POST, 'nippelaksana', FILTER_SANITIZE_STRING);
        $lamaperjalanan = filter_input(INPUT_POST, 'lamaperjalanan', FILTER_SANITIZE_STRING);
        $kotatujuan = filter_input(INPUT_POST, 'kotatujuan', FILTER_SANITIZE_STRING);
        $ttdspt = filter_input(INPUT_POST, 'ttdspt', FILTER_SANITIZE_STRING);
        $maksud = filter_input(INPUT_POST, 'maksud', FILTER_SANITIZE_STRING);
        $ttdsppd = filter_input(INPUT_POST, 'ttdsppd', FILTER_SANITIZE_STRING);
        $komit = filter_input(INPUT_POST, 'komit', FILTER_SANITIZE_STRING);
        $ket = filter_input(INPUT_POST, 'ket', FILTER_SANITIZE_STRING);
        $tgl = date("Y/m/d h:i:s', time()");

        require_once('../config/koneksi.php');

        $querysimpan = "INSERT INTO dataspt (nospt, tglberangkat, tglkembali, lamaperjalanan,
        kotatujuan, maksudtujuan, ket, tglinput, ttdspt, ttdsppd, ttdkomitmen)  VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $konek->prepare($querysimpan);
        $stmt->bind_param(
            "sssssssssss",
            $nospt,
            $tglberangkat,
            $tglkembali,
            $lamaperjalanan,
            $kotatujuan,
            $maksud,
            $ket,
            $tgl,
            $ttdspt,
            $ttdsppd,
            $komit
        );

        $berhasil = $stmt->execute();

        if (empty($_POST['nippengikut'])) {
            $tambah =  tambahsppdtanpapengikut($konek, $nospt, $nippelaksana, $ttdsppd);
        } else {
            $nippengikut = $_POST['nippengikut'];
            $tambah =  tambahsppd($konek, $nospt, $nippelaksana, $nippengikut, $ttdsppd);
        }

        if ($berhasil && $tambah) {
            $pesan = "Data berhasil ditambahkan";
        } else {
            $pesan = "Data gagal ditambahkan";
        }
    } else {
        $pesan = "Mohon isi form setidaknya yang wajib diisi";
    }
    echo "<script>
    alert('" . $pesan . "')
    window.location.replace('../layout/tampilspt.php')
    </script>";
}

function tambahsppd($konek, $nospt, $nippelaksana, $nippengikut, $ttdsppd)
{
    /* Simpan data pelaksana */
    $nosppd = nosuratsppd($konek);
    $tgl = date("Y/m/d h:i:s', time()");
    echo "<script>alert($nosppd)</script>";
    $querysimpan = "INSERT INTO datasppd (nosppd, nospt, nip, ttdsppd, tglinput)
    VALUES (?, ?, ?, ?, ?)";
    $stmt = $konek->prepare($querysimpan);
    $stmt->bind_param(
        "sssss",
        $nosppd,
        $nospt,
        $nippelaksana,
        $ttdsppd,
        $tgl
    );
    $saved1 = $stmt->execute();

    /* ========================= */

    /* Simpan data pengikut */

    foreach ($nippengikut as $nippengikut) {
        $querysimpan = "INSERT INTO datasppdpengikut ( nosppd, nospt, nip)
        VALUES ( ?, ?, ?)";
        $stmt = $konek->prepare($querysimpan);
        $stmt->bind_param(
            "sss",
            $nosppd,
            $nospt,
            $nippengikut,
        );
        $saved2 = $stmt->execute();
    }
    if ($saved1 && $saved2) {
        return true;
    } elseif (!$saved1 && $saved2) {
        return false;
    } elseif (!$saved2 && $saved1) {
        return false;
    } else {
        return false;
    }
}


function tambahsppdtanpapengikut($konek, $nospt, $nippelaksana, $ttdsppd)
{
    /* Simpan data pelaksana */
    $nosppd = nosuratsppd($konek);
    $tgl = date("Y/m/d h:i:s', time()");
    echo "<script>alert($nosppd)</script>";
    $querysimpan = "INSERT INTO datasppd (nosppd, nospt, nip, ttdsppd, tglinput)
    VALUES (?, ?, ?, ?, ?)";
    $stmt = $konek->prepare($querysimpan);
    $stmt->bind_param(
        "sssss",
        $nosppd,
        $nospt,
        $nippelaksana,
        $ttdsppd,
        $tgl
    );
    $saved1 = $stmt->execute();

    if ($saved1) {
        return true;
    } else {
        return false;
    }
}



function bacapelaksana()
{
    $nospt = $_GET['nospt'];

    require_once("../config/koneksi.php");

    //membuat data dalam bentuk array
    $myArray = array();

    //query untuk menampilkan data secara keseluruhan
    $sql = "SELECT * FROM datasppd, datapegawai, dmgolongan,dmjabatan WHERE datasppd.nip = datapegawai.nip
    AND datapegawai.`golongan`=dmgolongan.idgolongan AND datapegawai.jabatan= dmjabatan.idjabatan AND   
    nospt=$nospt ORDER BY datapegawai.jabatan";
    if ($result = mysqli_query($konek, $sql)) {
        while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
            $myArray[] = $row;
        }
        echo json_encode($myArray);
    }
    mysqli_close($konek);
}

function bacapengikut()
{
    $nospt = $_GET['nospt'];

    require_once("../config/koneksi.php");

    //membuat data dalam bentuk array
    $myArray = array();

    //query untuk menampilkan data secara keseluruhan
    $sql = "SELECT * FROM datasppdpengikut, datapegawai, dmgolongan,dmjabatan WHERE datasppdpengikut.nip = datapegawai.nip
    AND datapegawai.`golongan`=dmgolongan.idgolongan AND datapegawai.jabatan= dmjabatan.idjabatan AND   
    nospt=$nospt ORDER BY datapegawai.jabatan";
    if ($result = mysqli_query($konek, $sql)) {
        while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
            $myArray[] = $row;
        }
        echo json_encode($myArray);
    }
    mysqli_close($konek);
}

function bacaspt()
{
    require_once("../config/koneksi.php");

    //membuat data dalam bentuk array
    $myArray = array();

    //query untuk menampilkan data secara keseluruhan
    $sql = "SELECT * FROM dataspt ORDER BY tglinput DESC";
    if ($result = mysqli_query($konek, $sql)) {
        while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
            $myArray[] = $row;
        }
        echo json_encode($myArray);
    }
    mysqli_close($konek);
}

function bacasptberdasarkantanggal()
{
    $awal = $_GET['awal'];
    $akhir = $_GET['akhir'];
    require_once("../config/koneksi.php");

    //membuat data dalam bentuk array
    $myArray = array();

    //query untuk menampilkan data secara keseluruhan
    $sql = "SELECT * FROM dataspt WHERE tglberangkat BETWEEN '$awal' AND '$akhir' ORDER BY tglinput DESC";
    if ($result = mysqli_query($konek, $sql)) {
        while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
            $myArray[] = $row;
        }
        echo json_encode($myArray);
    }
    mysqli_close($konek);
}

function bacasptpernospt()
{
    require_once("../config/koneksi.php");
    $nospt = $_GET['nospt'];
    //membuat data dalam bentuk array
    $myArray = array();

    //query untuk menampilkan data secara keseluruhan
    $sql = "SELECT nospt, nama, namajabatan, namapangkat, dmgolongan.golongan, ruang, dmpejabatttdspt.nip AS nip , alamat,
    tglberangkat, tglkembali,lamaperjalanan, maksudtujuan, kotatujuan, tglinput, ket, namaaslidokumen,
    namaarsipdokumen, namaaslilaporan, namaarsiplaporan FROM dataspt,datapegawai, dmpejabatttdspt, dmpejabatttdsppd,
    dmjabatan, dmgolongan, dmpejabatttdkomitmen WHERE ttdspt = dmpejabatttdspt.id AND 
    dmpejabatttdspt.nip=datapegawai.nip AND ttdsppd = dmpejabatttdsppd.id 
    AND jabatan =dmjabatan.idjabatan AND datapegawai.golongan = dmgolongan.idgolongan AND nospt=$nospt";
    if ($result = mysqli_query($konek, $sql)) {
        while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
            $myArray[] = $row;
        }
        echo json_encode($myArray);
    }
    mysqli_close($konek);
}

function bacasptpernospt3()
{
    $nospt = $_GET['nospt'];
    require_once("../config/koneksi.php");

    //membuat data dalam bentuk array
    $myArray = array();

    //query untuk menampilkan data secara keseluruhan
    $sql = "SELECT * FROM dataspt,datapegawai , dmpejabatttdspt, dmpejabatttdsppd,
    dmjabatan, dmpejabatttdkomitmen WHERE ttdspt = dmpejabatttdspt.id AND 
    dmpejabatttdspt.nip=datapegawai.nip AND ttdsppd = dmpejabatttdsppd.id 
    AND jabatan =dmjabatan.idjabatan AND nospt=$nospt";
    if ($result = mysqli_query($konek, $sql)) {
        while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
            $myArray[] = $row;
        }
        echo json_encode($myArray);
    }
    mysqli_close($konek);
}


function bacasptpernospt2()
{
    require_once("../config/koneksi.php");
    $nospt = $_GET['nospt'];
    //membuat data dalam bentuk array
    $myArray = array();

    //query untuk menampilkan data secara keseluruhan
    $sql = "SELECT * FROM dataspt,datapegawai, dmpejabatttdkomitmen,
    dmgolongan,dmjabatan WHERE DATAPEGAWAI.golongan = dmgolongan.idgolongan
    AND jabatan = dmjabatan.idjabatan AND ttdkomitmen = dmpejabatttdkomitmen.id AND 
    dmpejabatttdkomitmen.nip=datapegawai.nip AND nospt=$nospt";
    if ($result = mysqli_query($konek, $sql)) {
        while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
            $myArray[] = $row;
        }
        echo json_encode($myArray);
    }
    mysqli_close($konek);
}


function ceknospt()
{
    require_once("../config/koneksi.php");
    $bulan = date('n');
    //membuat data dalam bentuk array
    $myArray = array();

    //query untuk menampilkan data secara keseluruhan
    $sql = "SELECT max(nospt) AS maksnospt FROM dataspt WHERE month(tglinput)='$bulan'";
    if ($result = mysqli_query($konek, $sql)) {
        while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
            $myArray[] = $row;
        }
        echo json_encode($myArray);
    }
    mysqli_close($konek);
}


function nosuratsppd($konek)
{

    $bulan = date('n');
    //membuat data dalam bentuk array
    $cek = array();

    //query untuk menampilkan data secara keseluruhan
    $sql = "SELECT max(nosppd) AS maksnosppd FROM datasppd WHERE month(tglinput)='$bulan'";
    if ($result = mysqli_query($konek, $sql)) {
        while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
            $cek[] = $row;
        }
    }

    $tahun = date('y');
    $bulan = bulanromawi();
    $nomor = "/SPPD/" . $bulan . "/" . $tahun;
    foreach ($cek as $cek) {
        $nosppd = $cek['maksnosppd'];
    }
    $nosppd = floatval($nosppd)  + 1;
    $kode = sprintf("%03s", $nosppd);
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

function hapusspt()
{
    if (
        isset($_GET['nospt'])
    ) {
        $nospt = $_GET['nospt'];
        $nospt = substr($nospt, 1, -1);
        //perintah lakukan koneksi ke database
        require_once("../config/koneksi.php");

        /* Hapus data sppdpengikut */
        $sql = $konek->prepare("DELETE FROM datasppdpengikut WHERE nospt=?"); //siap-siap dalam melakukan penghapusan
        $sql->bind_param('s', $nospt);
        $sql->execute();
        /* ============== Selesai ============= */

        /* Hapus data sppdpelaksana */
        $sql = $konek->prepare("DELETE FROM datasppd WHERE nospt=?"); //siap-siap dalam melakukan penghapusan
        $sql->bind_param('s', $nospt);
        $sql->execute();
        /* ============== Selesai ============= */

        /* Hapus data Kwitansi */
        $sql = $konek->prepare("DELETE FROM datakwitansi WHERE nospt=?"); //siap-siap dalam melakukan penghapusan
        $sql->bind_param('s', $nospt);
        $sql->execute();
        /* ============== Selesai ============= */

        /* Hapus file arsip dokumen */
        /*cek nama dokumen yang diarsipkan*/
        $sql = "SELECT namaarsipdokumen, namaarsiplaporan FROM dataspt WHERE nospt='$nospt'";
        if ($result = mysqli_query($konek, $sql)) {
            while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
                $nama[] = $row;
            }
            $namaarsipdokumen = $nama[0]['namaarsipdokumen'];
            $namaarsiplaporan = $nama[0]['namaarsiplaporan'];
        }

        /* Hapus file arsip dokumen */
        if (isset($namaarsipdokumen)) {
            unlink("../assets/doc/arsipdokumen/" . $namaarsipdokumen);
        }
        /* Hapus file arsip laporan */
        if (isset($namaarsiplaporan)) {
            unlink("../assets/doc/arsiplaporan/" . $namaarsiplaporan);
        }
        /* ============== Selesai ============= */


        /* Hapus data spt berdasarkan nospt */
        $sql = $konek->prepare("DELETE FROM dataspt WHERE nospt=?"); //siap-siap dalam melakukan penghapusan
        $sql->bind_param('s', $nospt);
        $sql->execute();
        /* ============== Selesai ============= */

        mysqli_close($konek);

        if ($sql) {
            $pesan = "Data berhasil dihapus";
        } else {
            $pesan = "Data gagal dihapus";
        }
    } else {
        $pesan = "No SPT tidak diketahui";
    }
    echo "<script>
    alert('" . $pesan . "')
    window.location.replace('../layout/tampilspt.php')
    </script>";
}

function bacasppdperspt()
{
    require_once("../config/koneksi.php");

    //membuat data dalam bentuk array
    $myArray = array();
    $nospt = $_GET['nospt'];
    //query untuk menampilkan data secara keseluruhan
    $sql = "SELECT * FROM datasppd, dataspt, datapegawai, dmpejabatttdsppd, dmjabatan WHERE 
    datasppd.nospt = dataspt.nospt AND datasppd.ttdsppd = dmpejabatttdsppd.id 
    AND dmpejabatttdsppd.nip = datapegawai.nip AND datapegawai.jabatan=dmjabatan.idjabatan AND
    datasppd.nospt = $nospt";

    if ($result = mysqli_query($konek, $sql)) {
        while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
            $myArray[] = $row;
        }
        echo json_encode($myArray);
    }
    mysqli_close($konek);
}

function bacasppdperspt2()
{
    require_once("../config/koneksi.php");

    //membuat data dalam bentuk array
    $myArray = array();
    $nospt = $_GET['nospt'];
    //query untuk menampilkan data secara keseluruhan
    $sql = "SELECT nosppd,nama,datasppd.nip,datasppd.nospt,datasppd.nip,dmgolongan.`namapangkat`,dmgolongan.golongan,ruang,namajabatan FROM datasppd, dmgolongan,dataspt,dmjabatan, datapegawai, dmpejabatttdsppd WHERE 
    datasppd.nospt = dataspt.nospt AND datasppd.nip = datapegawai.nip 
    AND datasppd.`ttdsppd` = dmpejabatttdsppd.`id`  AND datapegawai.`jabatan`=dmjabatan.`idjabatan`
    and dmgolongan.`idgolongan` = datapegawai.golongan AND
     datasppd.nospt= $nospt";

    if ($result = mysqli_query($konek, $sql)) {
        while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
            $myArray[] = $row;
        }
        echo json_encode($myArray);
    }
    mysqli_close($konek);
}

function tambahdatakwitansi()
{
    $nospt = substr($_GET['nospt'], 1, -1);
    if (!empty($_POST['untukdana']) && !empty($_POST['dana']) && isset($_GET['nospt'])) {
        require_once("../config/koneksi.php");
        $untukdana = $_POST['untukdana'];
        $jumlahdana = $_POST['dana'];
        $nospt = substr($_GET['nospt'], 1, -1);
        if (empty($_POST['ket'])) {
            $querysimpan = "INSERT INTO datakwitansi (nospt, peruntukkandana, dana)
            VALUES (?, ?, ?)";
            $stmt = $konek->prepare($querysimpan);
            $stmt->bind_param(
                "sss",
                $nospt,
                $untukdana,
                $jumlahdana,
            );
        } else {
            $ket = $_POST['ket'];
            $querysimpan = "INSERT INTO datakwitansi (nospt, peruntukkandana, dana, ket)
            VALUES (?, ?, ?, ?)";
            $stmt = $konek->prepare($querysimpan);
            $stmt->bind_param(
                "ssss",
                $nospt,
                $untukdana,
                $jumlahdana,
                $ket
            );
        }
        $simpan = $stmt->execute();
        if ($simpan) {
            $pesan = "Data berhasil ditambahkan";
        } else {
            $pesan = "Data gagal ditambahkan";
        }
    } else {
        $pesan = "Mohon isi semua form yang wajib diisi";
    }
    $nospt = "%27" . $nospt . "%27";
    echo "<script>
    alert('" . $pesan . "')
    window.location.replace('../layout/tampilkwitansi.php?nospt=" . $nospt . "')
    </script>";
}

function hapusdatakwitansi()
{
    if (
        isset($_GET['id']) &&  isset($_GET['nospt'])
    ) {
        $id = $_GET['id'];
        $nospt = $_GET['nospt'];
        echo $id;
        echo $nospt;
        //perintah lakukan koneksi ke database
        require_once("../config/koneksi.php");
        //cek jumlah data pengikut
        $sql = "DELETE FROM datakwitansi WHERE id=?"; //siap-siap dalam melakukan penghapusan
        $stmt = $konek->prepare($sql);
        $stmt->bind_param("s", $id);
        $hapus = $stmt->execute();
        if ($hapus) {
            $pesan = "Data berhasil dihapus";
        } else {
            $pesan = "Data gagal dihapus";
        }
    } else {
        $pesan = "No SPT tidak diketahui";
    }
    $nospt = "%27" . $nospt . "%27";
    echo "<script>
    alert('" . $pesan . "')
    window.location.replace('../layout/tampilkwitansi.php?nospt=" . $nospt . "')
    </script>";
}

function simpanarsipdokumen()
{
    $nospt = explode("'", $_GET['nospt']);
    $namaaslidokumen = $_FILES['arsipdokumen']['name'];
    $namaarsipdokumen = uploaddokumen();
    $nospt =  $nospt[1];
    require_once("../config/koneksi.php");
    $sql = "SELECT namaarsipdokumen FROM dataspt WHERE nospt='$nospt'";
    if ($result = mysqli_query($konek, $sql)) {
        while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
            $nama[] = $row;
        }
        $namaarsipdokumenlama = $nama[0]['namaarsipdokumen'];
    }
    $querysimpan = "UPDATE dataspt SET namaaslidokumen = ?,
        namaarsipdokumen = ? WHERE nospt = ?";
    $stmt = $konek->prepare($querysimpan);
    $stmt->bind_param("sss", $namaaslidokumen, $namaarsipdokumen, $nospt);
    if ($namaarsipdokumen) {
        $saved = $stmt->execute();


        /* Hapus file arsip dokumen */
        if (isset($namaarsipdokumenlama)) {
            unlink("../assets/doc/arsipdokumen/" . $namaarsipdokumenlama);
        }
    } else {
        $saved = false;
    }
    if ($saved) {
        $pesan = "Dokumen berhasil disimpan";
    } else {
        $pesan = "Dokumen gagal disimpan";
    }
    $nospt = "%27" . $nospt . "%27";
    echo "<script>
    alert('" . $pesan . "')
    window.location.replace('../layout/detailspt.php?nospt=" . $nospt . "')
    </script>";
}

function uploaddokumen()
{
    $namaFile = $_FILES['arsipdokumen']['name'];
    $ukuranFile = $_FILES['arsipdokumen']['size'];
    $errorFile = $_FILES['arsipdokumen']['error'];
    $tmp = $_FILES['arsipdokumen']['tmp_name'];

    /* cek isset foto */
    if ($errorFile === 4) {
        echo "<script>
        alert('Mohon untuk pilih file dokumen terlebih dahulu');
        </script>";
        return false;
    }

    /* cek is foto */
    $ekstensibenar = ['doc', 'pdf', 'docx'];
    $ekstensidokumen = explode('.', $namaFile);
    $ekstensidokumen = strtolower(end($ekstensidokumen));

    /* cek jenis file */
    if (!in_array($ekstensidokumen, $ekstensibenar)) {
        echo "<script>
        alert('Yang anda upload harus berupa file (ekstensi = .doc | .pdf)');
        </script>";
        return false;
    }

    /* cek ukuran file */
    if ($ukuranFile > 1000000) {
        echo "<script>
        alert('Ukuran file terlalu besar (Maks 1 MB)');
        </script>";
        return false;
    }

    /* membuat nama file random */
    $namabaru = uniqid();
    $namabaru .= '.';
    $namabaru .= $ekstensidokumen;
    move_uploaded_file($tmp, '../assets/doc/arsipdokumen/' . $namabaru);
    return $namabaru;
}

function simpanarsiplaporan()
{
    $nospt = explode("'", $_GET['nospt']);
    $namaaslilaporan = $_FILES['arsiplaporan']['name'];
    $namaarsiplaporan = uploadlaporan();
    $nospt =  $nospt[1];
    require_once("../config/koneksi.php");

    $sql = "SELECT namaarsiplaporan FROM dataspt WHERE nospt='$nospt'";
    if ($result = mysqli_query($konek, $sql)) {
        while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
            $nama[] = $row;
        }
        $namaarsiplaporanlama = $nama[0]['namaarsiplaporan'];
    }

    $querysimpan = "UPDATE dataspt SET namaaslilaporan = ?,
        namaarsiplaporan = ? WHERE nospt = ?";
    $stmt = $konek->prepare($querysimpan);
    $stmt->bind_param("sss", $namaaslilaporan, $namaarsiplaporan, $nospt);
    if ($namaarsiplaporan) {
        $saved = $stmt->execute();
    } else {
        $saved = false;
    }
    if ($saved) {
        $pesan = "Dokumen berhasil disimpan";
        /* Hapus file arsip dokumen */
        if (isset($namaarsiplaporanlama)) {
            unlink("../assets/doc/arsiplaporan/" . $namaarsiplaporanlama);
        }
    } else {
        $pesan = "Dokumen gagal disimpan";
    }
    $nospt = "%27" . $nospt . "%27";
    echo "<script>
    alert('" . $pesan . "')
    window.location.replace('../layout/detailspt.php?nospt=" . $nospt . "')
    </script>";
}

function uploadlaporan()
{
    $namaFile = $_FILES['arsiplaporan']['name'];
    $ukuranFile = $_FILES['arsiplaporan']['size'];
    $errorFile = $_FILES['arsiplaporan']['error'];
    $tmp = $_FILES['arsiplaporan']['tmp_name'];

    /* cek isset foto */
    if ($errorFile === 4) {
        echo "<script>
        alert('Mohon untuk pilih file dokumen terlebih dahulu');
        </script>";
        return false;
    }

    /* cek is foto */
    $ekstensibenar = ['doc', 'pdf', 'docx'];
    $ekstensilaporan = explode('.', $namaFile);
    $ekstensilaporan = strtolower(end($ekstensilaporan));

    /* cek jenis file */
    if (!in_array($ekstensilaporan, $ekstensibenar)) {
        echo "<script>
        alert('Yang anda upload harus berupa file (ekstensi = .doc | .pdf)');
        </script>";
        return false;
    }

    /* cek ukuran file */
    if ($ukuranFile > 1000000) {
        echo "<script>
        alert('Ukuran file terlalu besar (Maks 1 MB)');
        </script>";
        return false;
    }
    /* membuat nama file random */
    $namabaru = uniqid();
    $namabaru .= '.';
    $namabaru .= $ekstensilaporan;
    move_uploaded_file($tmp, '../assets/doc/arsiplaporan/' . $namabaru);
    return $namabaru;
}

function cekkasubbagkeuangan()
{
    require_once("../config/koneksi.php");
    //membuat data dalam bentuk array
    $myArray = array();

    //query untuk menampilkan data secara keseluruhan
    $sql = "SELECT * FROM datapegawai,dmjabatan WHERE jabatan=idjabatan AND namajabatan = 'Kepala Sub Bagian Program dan Keuangan'";
    if ($result = mysqli_query($konek, $sql)) {
        while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
            $myArray[] = $row;
        }
        echo json_encode($myArray);
    }
    mysqli_close($konek);
}

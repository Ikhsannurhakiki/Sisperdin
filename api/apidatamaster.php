

<?php
if (isset($_GET['f'])) {
    if (function_exists($_GET['f'])) {
        $_GET['f']();
    }
}

function tampiljabatan()
{
    //perintah lakukan koneksi ke database
    require_once("../config/koneksi.php");

    //membuat data dalam bentuk array
    $myArray = array();

    //query untuk menampilkan data secara keseluruhan
    $sql = "SELECT * FROM dmjabatan ORDER BY idjabatan ";
    if ($result = mysqli_query($konek, $sql)) {
        while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
            $myArray[] = $row;
        }
        echo json_encode($myArray);
    }
    mysqli_close($konek);
}

function tampiljabatantidakdiarsipkan()
{
    //perintah lakukan koneksi ke database
    require_once("../config/koneksi.php");

    //membuat data dalam bentuk array
    $myArray = array();

    //query untuk menampilkan data secara keseluruhan
    $sql = "SELECT * FROM dmjabatan WHERE statusarsip='tidak' ORDER BY idjabatan ";
    if ($result = mysqli_query($konek, $sql)) {
        while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
            $myArray[] = $row;
        }
        echo json_encode($myArray);
    }
    mysqli_close($konek);
}


function tampilgolongan()
{
    //perintah lakukan koneksi ke database
    require_once("../config/koneksi.php");

    //membuat data dalam bentuk array
    $myArray = array();

    //query untuk menampilkan data secara keseluruhan
    $sql = "SELECT * FROM dmgolongan ORDER BY idgolongan ";
    if ($result = mysqli_query($konek, $sql)) {
        while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
            $myArray[] = $row;
        }
        echo json_encode($myArray);
    }
    mysqli_close($konek);
}
function tampilgolongantidakdiarsipkan()
{
    //perintah lakukan koneksi ke database
    require_once("../config/koneksi.php");

    //membuat data dalam bentuk array
    $myArray = array();

    //query untuk menampilkan data secara keseluruhan
    $sql = "SELECT * FROM dmgolongan WHERE statusarsip='tidak' ORDER BY golongan, ruang ASC";
    if ($result = mysqli_query($konek, $sql)) {
        while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
            $myArray[] = $row;
        }
        echo json_encode($myArray);
    }
    mysqli_close($konek);
}

function bacapejabatspt()
{
    //perintah lakukan koneksi ke database
    require_once("../config/koneksi.php");

    //membuat data dalam bentuk array
    $myArray = array();

    //query untuk menampilkan data secara keseluruhan
    $sql = "SELECT * FROM dmpejabatttdspt, datapegawai WHERE datapegawai.nip = dmpejabatttdspt.nip ORDER BY jabatan  ";
    if ($result = mysqli_query($konek, $sql)) {
        while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
            $myArray[] = $row;
        }
        echo json_encode($myArray);
    }
    mysqli_close($konek);
}

function bacapejabatspttidakarsip()
{
    //perintah lakukan koneksi ke database
    require_once("../config/koneksi.php");

    //membuat data dalam bentuk array
    $myArray = array();

    //query untuk menampilkan data secara keseluruhan
    $sql = "SELECT * FROM dmpejabatttdspt, datapegawai WHERE datapegawai.nip = dmpejabatttdspt.nip AND statusarsip='tidak' ORDER BY jabatan  ";
    if ($result = mysqli_query($konek, $sql)) {
        while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
            $myArray[] = $row;
        }
        echo json_encode($myArray);
    }
    mysqli_close($konek);
}

function bacapejabatsppd()
{
    //perintah lakukan koneksi ke database
    require_once("../config/koneksi.php");

    //membuat data dalam bentuk array
    $myArray = array();

    //query untuk menampilkan data secara keseluruhan
    $sql = "SELECT * FROM dmpejabatttdsppd, datapegawai WHERE datapegawai.nip = dmpejabatttdsppd.nip ORDER BY jabatan  ";
    if ($result = mysqli_query($konek, $sql)) {
        while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
            $myArray[] = $row;
        }
        echo json_encode($myArray);
    }
    mysqli_close($konek);
}

function bacapejabatsppdtidakarsip()
{
    //perintah lakukan koneksi ke database
    require_once("../config/koneksi.php");

    //membuat data dalam bentuk array
    $myArray = array();

    //query untuk menampilkan data secara keseluruhan
    $sql = "SELECT * FROM dmpejabatttdsppd, datapegawai WHERE datapegawai.nip = dmpejabatttdsppd.nip AND statusarsip='tidak' ORDER BY jabatan  ";
    if ($result = mysqli_query($konek, $sql)) {
        while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
            $myArray[] = $row;
        }
        echo json_encode($myArray);
    }
    mysqli_close($konek);
}

function bacapejabatkomit()
{
    //perintah lakukan koneksi ke database
    require_once("../config/koneksi.php");

    //membuat data dalam bentuk array
    $myArray = array();

    //query untuk menampilkan data secara keseluruhan
    $sql = "SELECT * FROM dmpejabatttdkomitmen, datapegawai WHERE datapegawai.nip = dmpejabatttdkomitmen.nip ORDER BY jabatan  ";
    if ($result = mysqli_query($konek, $sql)) {
        while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
            $myArray[] = $row;
        }
        echo json_encode($myArray);
    }
    mysqli_close($konek);
}

function bacapejabatkomittidakarsip()
{
    //perintah lakukan koneksi ke database
    require_once("../config/koneksi.php");

    //membuat data dalam bentuk array
    $myArray = array();

    //query untuk menampilkan data secara keseluruhan
    $sql = "SELECT * FROM dmpejabatttdkomitmen, datapegawai WHERE datapegawai.nip = dmpejabatttdkomitmen.nip AND statusarsip='tidak' ORDER BY jabatan  ";
    if ($result = mysqli_query($konek, $sql)) {
        while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
            $myArray[] = $row;
        }
        echo json_encode($myArray);
    }
    mysqli_close($konek);
}


function tambahgolongan()
{
    if (
        !empty($_POST['pangkat']) && !empty($_POST['golongan']) && !empty($_POST['ruang'])
    ) {
        $pangkat = filter_input(INPUT_POST, 'pangkat', FILTER_SANITIZE_STRING);
        $golongan = filter_input(INPUT_POST, 'golongan', FILTER_SANITIZE_STRING);
        $ruang = filter_input(INPUT_POST, 'ruang', FILTER_SANITIZE_STRING);
        require_once('../config/koneksi.php');

        $querysimpan = "INSERT INTO dmgolongan (namapangkat, golongan, ruang)  VALUES (?, ?, ?)";
        $stmt = $konek->prepare($querysimpan);
        $stmt->bind_param("sss", $pangkat, $golongan, $ruang);
        $saved = $stmt->execute();

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
            window.location.replace('../layout/dmgolongan.php')
            </script>";
}

function arsipgolongan()
{
    if ($_GET['arsipkan'] == 'ya') {
        $arsip = 'ya';
        $status = 'diarsipkan';
    } else {
        $arsip = 'tidak';
        $status = 'dikembalikan';
    }
    require_once('../config/koneksi.php');
    $id = $_GET['id'];
    $query = "UPDATE dmgolongan SET statusarsip = ? WHERE idgolongan = ?";
    $stmt = $konek->prepare($query);
    // $stmt->bind_param("si", $arsip, $id);
    $stmt->bind_param("si", $arsip, $id);
    $saved = $stmt->execute();

    if ($saved) {
        $pesan = "Data berhasil " . $status;
    } else {
        $pesan = "Data gagal " . $status;
    }

    echo "<script>
    alert('" . $pesan . "')
    window.location.replace('../layout/dmgolongan.php')
    </script>";
}

function hapusgolongan()
{
    if (
        !empty($_GET['id'])
    ) {
        $id = $_GET['id'];
        require_once("../config/koneksi.php");

        $query = $konek->prepare("DELETE FROM dmgolongan WHERE idgolongan=?");
        $query->bind_param('i', $id);
        $query->execute(); //eksekusi perintah query
        if ($query) {
            $query = "SELECT * FROM dmgolongan where idgolongan = '$id'";
            $hasil = mysqli_query($konek, $query);
            $hasilcek = mysqli_num_rows($hasil);
            if ($hasilcek > 0) {
                $pesan = "Data tidak bisa dihapus karena sudah terkait dengan data lain (disarankan untuk diarsipkan)";
            } else {
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
        window.location.replace('../layout/dmgolongan.php')
        </script>";
}

function arsipjabatan()
{
    if ($_GET['arsipkan'] == 'ya') {
        $arsip = 'ya';
        $status = 'diarsipkan';
    } else {
        $arsip = 'tidak';
        $status = 'dikembalikan';
    }
    require_once('../config/koneksi.php');
    $id = $_GET['id'];
    $query = "UPDATE dmjabatan SET statusarsip = ? WHERE idjabatan = ?";
    $stmt = $konek->prepare($query);
    // $stmt->bind_param("si", $arsip, $id);
    $stmt->bind_param("si", $arsip, $id);
    $saved = $stmt->execute();

    if ($saved) {
        $pesan = "Data berhasil " . $status;
    } else {
        $pesan = "Data gagal " . $status;
    }

    echo "<script>
    alert('" . $pesan . "')
    window.location.replace('../layout/dmjabatan.php')
    </script>";
}

function tambahjabatan()
{
    if (
        !empty($_POST['jabatan'])
    ) {
        $jabatan = filter_input(INPUT_POST, 'jabatan', FILTER_SANITIZE_STRING);
        require_once('../config/koneksi.php');

        $query = "INSERT INTO dmjabatan (namajabatan)  VALUES (?)";
        $stmt = $konek->prepare($query);
        $stmt->bind_param("s", $jabatan);
        $saved = $stmt->execute();

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
        window.location.replace('../layout/dmjabatan.php')
        </script>";
}

function hapusjabatan()
{
    if (
        !empty($_GET['id'])
    ) {
        $id = $_GET['id'];
        require_once("../config/koneksi.php");

        $query = $konek->prepare("DELETE FROM dmjabatan WHERE idjabatan=?");
        $query->bind_param('i', $id);
        $query->execute(); //eksekusi perintah query
        if ($query) {
            $query = "SELECT * FROM dmjabatan where idjabatan = '$id'";
            $hasil = mysqli_query($konek, $query);
            $hasilcek = mysqli_num_rows($hasil);
            if ($hasilcek > 0) {
                $pesan = "Data tidak bisa dihapus karena sudah terkait dengan data lain (disarankan untuk diarsipkan)";
            } else {
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
        window.location.replace('../layout/dmjabatan.php')
        </script>";
}

function tambahttdspt()
{
    if (
        !empty($_POST['ttdspt'])
    ) {
        $nip = $_POST['ttdspt'];
        require_once('../config/koneksi.php');

        $query = "INSERT INTO dmpejabatttdspt (nip)  VALUES (?)";
        $stmt = $konek->prepare($query);
        $stmt->bind_param("i", $nip);
        $saved = $stmt->execute();

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
        window.location.replace('../layout/dmttdspt.php')
        </script>";
}

function bacapegawaiygtidakdmttdspt()
{
    require_once("../config/koneksi.php");

    //membuat data dalam bentuk array
    $myArray = array();

    //query untuk menampilkan data secara keseluruhan
    $sql = "SELECT * FROM datapegawai WHERE NOT EXISTS ( SELECT * FROM dmpejabatttdspt
    WHERE datapegawai.nip = dmpejabatttdspt.nip)";
    if ($result = mysqli_query($konek, $sql)) {
        while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
            $myArray[] = $row;
        }
        echo json_encode($myArray);
    }
    mysqli_close($konek);
}

function hapusttdspt()
{
    if (
        !empty($_GET['id'])
    ) {
        $id = $_GET['id'];
        require_once("../config/koneksi.php");

        $query = $konek->prepare("DELETE FROM dmpejabatttdspt WHERE id=?");
        $query->bind_param('i', $id);
        $query->execute(); //eksekusi perintah query
        if ($query) {
            $query = "SELECT * FROM dmpejabatttdspt where id = '$id'";
            $hasil = mysqli_query($konek, $query);
            $hasilcek = mysqli_num_rows($hasil);
            if ($hasilcek > 0) {
                $pesan = "Data tidak bisa dihapus karena sudah terkait dengan data lain (disarankan untuk diarsipkan)";
            } else {
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
        window.location.replace('../layout/dmttdspt.php')
        </script>";
}

function tambahttdsppd()
{
    if (
        !empty($_POST['ttdsppd'])
    ) {
        $nip = $_POST['ttdsppd'];
        require_once('../config/koneksi.php');

        $query = "INSERT INTO dmpejabatttdsppd (nip)  VALUES (?)";
        $stmt = $konek->prepare($query);
        $stmt->bind_param("i", $nip);
        $saved = $stmt->execute();

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
        window.location.replace('../layout/dmttdspt.php')
        </script>";
}

function bacapegawaiygtidakdmttdsppd()
{
    require_once("../config/koneksi.php");

    //membuat data dalam bentuk array
    $myArray = array();

    //query untuk menampilkan data secara keseluruhan
    $sql = "SELECT * FROM datapegawai WHERE NOT EXISTS ( SELECT * FROM dmpejabatttdsppd
    WHERE datapegawai.nip = dmpejabatttdsppd.nip)";
    if ($result = mysqli_query($konek, $sql)) {
        while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
            $myArray[] = $row;
        }
        echo json_encode($myArray);
    }
    mysqli_close($konek);
}

function hapusttdsppd()
{
    if (
        !empty($_GET['id'])
    ) {
        $id = $_GET['id'];
        require_once("../config/koneksi.php");

        $query = $konek->prepare("DELETE FROM dmpejabatttdsppd WHERE id=?");
        $query->bind_param('i', $id);
        $query->execute(); //eksekusi perintah query
        if ($query) {
            $query = "SELECT * FROM dmpejabatttdsppd where id = '$id'";
            $hasil = mysqli_query($konek, $query);
            $hasilcek = mysqli_num_rows($hasil);
            if ($hasilcek > 0) {
                $pesan = "Data tidak bisa dihapus karena sudah terkait dengan data lain (disarankan untuk diarsipkan)";
            } else {
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
        window.location.replace('../layout/dmttdspt.php')
        </script>";
}

function arsipttdspt()
{
    if ($_GET['arsipkan'] == 'ya') {
        $arsip = 'ya';
        $status = 'diarsipkan';
    } else {
        $arsip = 'tidak';
        $status = 'dikembalikan';
    }
    require_once('../config/koneksi.php');
    $id = $_GET['id'];
    $query = "UPDATE dmpejabatttdspt SET statusarsip = ? WHERE id = ?";
    $stmt = $konek->prepare($query);
    // $stmt->bind_param("si", $arsip, $id);
    $stmt->bind_param("si", $arsip, $id);
    $saved = $stmt->execute();

    if ($saved) {
        $pesan = "Data berhasil " . $status;
    } else {
        $pesan = "Data gagal " . $status;
    }

    echo "<script>
    alert('" . $pesan . "')
    window.location.replace('../layout/dmttdspt.php')
    </script>";
}

function arsipttdsppd()
{
    if ($_GET['arsipkan'] == 'ya') {
        $arsip = 'ya';
        $status = 'diarsipkan';
    } else {
        $arsip = 'tidak';
        $status = 'dikembalikan';
    }
    require_once('../config/koneksi.php');
    $id = $_GET['id'];
    $query = "UPDATE dmpejabatttdsppd SET statusarsip = ? WHERE id = ?";
    $stmt = $konek->prepare($query);
    // $stmt->bind_param("si", $arsip, $id);
    $stmt->bind_param("si", $arsip, $id);
    $saved = $stmt->execute();

    if ($saved) {
        $pesan = "Data berhasil " . $status;
    } else {
        $pesan = "Data gagal " . $status;
    }

    echo "<script>
    alert('" . $pesan . "')
    window.location.replace('../layout/dmttdsppd.php')
    </script>";
}

function tambahttdkomitmen()
{
    if (
        !empty($_POST['ttdkomitmen'])
    ) {
        $nip = $_POST['ttdkomitmen'];
        require_once('../config/koneksi.php');

        $query = "INSERT INTO dmpejabatttdkomitmen (nip)  VALUES (?)";
        $stmt = $konek->prepare($query);
        $stmt->bind_param("i", $nip);
        $saved = $stmt->execute();

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
        window.location.replace('../layout/dmttdkomitmen.php')
        </script>";
}

function bacapegawaiygtidakdmttdkomitmen()
{
    require_once("../config/koneksi.php");

    //membuat data dalam bentuk array
    $myArray = array();

    //query untuk menampilkan data secara keseluruhan
    $sql = "SELECT * FROM datapegawai WHERE NOT EXISTS ( SELECT * FROM dmpejabatttdkomitmen
    WHERE datapegawai.nip = dmpejabatttdkomitmen.nip)";
    if ($result = mysqli_query($konek, $sql)) {
        while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
            $myArray[] = $row;
        }
        echo json_encode($myArray);
    }
    mysqli_close($konek);
}

function hapusttdkomitmen()
{
    if (
        !empty($_GET['id'])
    ) {
        $id = $_GET['id'];
        require_once("../config/koneksi.php");

        $query = $konek->prepare("DELETE FROM dmpejabatttdkomitmen WHERE id=?");
        $query->bind_param('i', $id);
        $query->execute(); //eksekusi perintah query
        if ($query) {
            $query = "SELECT * FROM dmpejabatttdkomitmen where id = '$id'";
            $hasil = mysqli_query($konek, $query);
            $hasilcek = mysqli_num_rows($hasil);
            if ($hasilcek > 0) {
                $pesan = "Data tidak bisa dihapus karena sudah terkait dengan data lain (disarankan untuk diarsipkan)";
            } else {
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
        window.location.replace('../layout/dmttdkomitmen.php')
        </script>";
}

function arsipttdkomitmen()
{
    if ($_GET['arsipkan'] == 'ya') {
        $arsip = 'ya';
        $status = 'diarsipkan';
    } else {
        $arsip = 'tidak';
        $status = 'dikembalikan';
    }
    require_once('../config/koneksi.php');
    $id = $_GET['id'];
    $query = "UPDATE dmpejabatttdkomitmen SET statusarsip = ? WHERE id = ?";
    $stmt = $konek->prepare($query);
    // $stmt->bind_param("si", $arsip, $id);
    $stmt->bind_param("si", $arsip, $id);
    $saved = $stmt->execute();

    if ($saved) {
        $pesan = "Data berhasil " . $status;
    } else {
        $pesan = "Data gagal " . $status;
    }

    echo "<script>
    alert('" . $pesan . "')
    window.location.replace('../layout/dmttdkomitmen.php')
    </script>";
}

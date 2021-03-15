<?php

use Mpdf\Mpdf;
use Mpdf\Tag\PageBreak;

function http_request($url)
{
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $output = curl_exec($ch);
    curl_close($ch);
    return $output;
}

if (isset($_GET['f'])) {
    if (function_exists($_GET['f'])) {
        $_GET['f']();
    }
}


function cetakdatapegawai()
{

    if ($_GET['arsip'] == 'ya') {
        $data = http_request("http://localhost/SisPerDin/api/apipegawai.php?f=bacapegawaiarsip");
        $data = json_decode($data, TRUE);
    } else {
        $data = http_request("http://localhost/SisPerDin/api/apipegawai.php?f=bacapegawaitidakarsip");
        $data = json_decode($data, TRUE);
    }

    require_once "../vendor/autoload.php";
    $mpdf = new \Mpdf\Mpdf(['orientation' => 'L']);

    $html = '<!DOCTYPE html>
<html lang="en">

<head>
    <style>
        body{
            font-size : 12;
            font-family: timesnewroman;
        }
        .judul{
            font-size : 20px;
            font-family: serif;
            text-align: center;
        }
        .judul2{
            font-size : 15px;
            font-family: serif;
            text-align: center;
        }
        img{
         width: 8%;
         height: 10%;
        }
        html{
            font-family: serif;
        }
        .center{
            margin-left: auto;
            margin-right: auto;
        }
        td{
            paddinng: 10px;
        }
        hr{
            height: 5px;
            color: black;
        }

    </style>
</head>
<body>

<table class="center" cellpadding="5" cellspacing="5">
    <tr>
        <td width="25%">
            <div class="logo"><img src="../assets/img/Lambang_Kab_Indragiri_Hulu.png"></div>
        </td>
        <td align="center">
            <div class="judul">PEMERINTAH KABUPATEN INDRAGIRI HULU</div>
            <div class="judul">DINAS PEMBERDAYAAN MASYARAKAT DAN DESA</div>
            <div class="judul2">Jl. Indragiri No. 05 Pematang Reba-Rengat Barat</div>
            <div class="judul2">Telp: 0769-341745 Fax: 341702</div>
        </td>
    </tr>
</table>
<hr />
<br><br>
<div class="judul2"><b>Data Pegawai</b></div>
<br><br>
<table border=1 cellpadding=10 cellspacing=0 class="center" width=90%>
    <thead>
        <tr>
            <th>NIP</th>
            <th>Nama</th>
            <th>Jabatan</th>
            <th>Tempat Lahir</th>
            <th>Tanggal Lahir</th>
            <th>Alamat</th>
            <th>Golongan</th>
            </tr>
    </thead>
    <tbody>';
    foreach ($data as $data) {

        $html .= '<tr>
            <td>' . $data['nip'] . '</td>
            <td>' . $data['nama'] . '</td>
            <td>' . $data['namajabatan'] . '</td>
            <td>' . $data['tempatlahir'] . '</td>
            <td>' . $data['tanggallahir'] . '</td>
            <td>' . $data['alamat'] . '</td>
            <td>' . $data["namapangkat"]  . " (" .  $data["golongan"] . "/" . $data["ruang"] . ")" . '</td>
        </tr>';
    }

    $html .= '</tbody>
        </table>
    </body>
    ';

    $mpdf->WriteHTML($html);
    $mpdf->Output('data-pegawai.pdf', \Mpdf\Output\Destination::INLINE);
}


function cetakspt()
{

    $data = http_request("http://localhost/SisPerDin/api/apispt.php?f=bacasptpernospt&nospt=" . $_GET['nospt']);
    $data = json_decode($data, TRUE);
    $data2 = http_request("http://localhost/SisPerDin/api/apispt.php?f=bacapelaksana&nospt=" . $_GET['nospt']);
    $data2 = json_decode($data2, TRUE);
    $data3 = http_request("http://localhost/SisPerDin/api/apispt.php?f=bacapengikut&nospt=" . $_GET["nospt"]);
    $data3 = json_decode($data3, TRUE);

    require_once "../vendor/autoload.php";
    $mpdf = new \Mpdf\Mpdf(['orientation' => 'P']);

    foreach ($data as $data) {
        $nospt = $data['nospt'];
        $nama = $data['nama'];
        $namajabatan = $data['namajabatan'];
        $nip = $data['nip'];
        $alamat = $data['alamat'];
        $lamaperjalanan = $data['lamaperjalanan'];
    }

    $html = '<!DOCTYPE html>
<html lang="en">

<head>
    <style>
        body{
            font-size : 12;
            font-family: timesnewroman;
        }
        .judul{
            font-size : 20px;
            font-family: serif;
            text-align: center;
        }
        .judul2{
            font-size : 15px;
            font-family: serif;
            text-align: center;
        }
        img{
         width: 8%;
         height: 10%;
        }
        html{
            font-family: serif;
        }
        .center{
            margin-left: auto;
            margin-right: auto;
        }
        td{
            paddinng: 10px;
        }
        hr{
            height: 5px;
            color: black;
        }

        .logo{
            width: 100px;
        }
    </style>
</head>
<body>

<table class="center" cellpadding="5" cellspacing="5">
    <tr>
        <td width="15%">
            <div class="logo"><img src="../assets/img/Lambang_Kab_Indragiri_Hulu.png" style="width: 75px; height: 90px"></div>
        </td>
        <td align="center">
            <div class="judul">PEMERINTAH KABUPATEN INDRAGIRI HULU</div>
            <div class="judul">DINAS PEMBERDAYAAN MASYARAKAT DAN DESA</div>
            <div class="judul2">Jl. Indragiri No. 05 Pematang Reba-Rengat Barat</div>
            <div class="judul2">Telp: 0769-341745 Fax: 341702</div>
        </td>
    </tr>
</table>
<hr />
<br><br>
<div class="judul2"><b><u>SURAT PERINTAH TUGAS</u></b></div>
<div class="judul2"><b>Nomor : ' . $nospt . '</b></div>
<br>

    Yang bertanda tangan di bawah ini: <br><br>
    <table style="padding-left: 50px;">
    <tr>
        <td width="150px">Nama</td>
        <td>:</td>
        <td>' . $nama . '</td>
    </tr>
    <tr>
        <td width="150px">Jabatan</td>
        <td>:</td>
        <td>' . $namajabatan . '</td>
    </tr>
    <tr>
        <td width="150px">NIP</td>
        <td>:</td>
        <td>' . $nip . '</td>
    </tr>
    <tr>
        <td width="150px">Alamat</td>
        <td>:</td>
        <td>' . $alamat . '</td>
    </tr>
    </table> <br>
    
    <div class="judul2"><b>MEMERINTAHKAN</b></div>
    <br>
    <table width="100%" cellpadding="3" border="1" cellspacing="0">
    <tr style="background-color: darkgrey;">>
        <th>No</th>
        <th>Nama</th>
        <th>NIP</th>
        <th>Golongan</th>
        <th>Jabatan</th>
    </tr>';
    $no = 0;
    foreach ($data2 as $data2) {
        $no = $no + 1;
        $html .= ' <tr>
        <td>' . $no . '</td>
        <td>' . $data2['nama'] . '</td>
        <td>' . $data2['nip'] . '</td>
        <td>' . $data2['namapangkat'] . ' ' . $data2['golongan'] . '/' . $data2['ruang'] . '</td>
        <td>' . $data2['namajabatan'] . '</td>
    </tr>';
    }
    foreach ($data3 as $data3) {
        $no = $no + 1;
        $html .= ' <tr>
        <td>' . $no . '</td>
        <td>' . $data3['nama'] . '</td>
        <td>' . $data3['nip'] . '</td>
        <td>' . $data3['namapangkat'] . ' ' . $data3['golongan'] . '/' . $data3['ruang'] . '</td>
        <td>' . $data3['namajabatan'] . '</td>
    </tr>';
    }
    $html .= '</table> <br>
    <table cellpadding="3" style="padding-left: 50px;">
    <tr>
        <td width="150px">Dalam rangka</td>
        <td>:</td>
        <td>' . $data['maksudtujuan'] . '</td>
    </tr>
    <tr>
        <td width="150px">Lama/Tanggal</td>
        <td>:</td>
        <td>';
    $brngkt = strtotime($data['tglberangkat']);
    $kmbl = strtotime($data['tglkembali']);
    $tanggalberangkat = date("d-m-20y", $brngkt);
    $tanggalkembali = date("d-m-20y", $kmbl);
    if ($tanggalberangkat == $tanggalkembali) {
        $html .= '1 Hari/' . $tanggalberangkat . '</td>';
    } else {
        $html .= $lamaperjalanan . ' Hari/' . $tanggalberangkat . ' sampai dengan ' . $tanggalkembali . '</td>';
    }
    $html .= '</tr>
    <tr>
        <td width="150px">Tempat</td>
        <td>:</td>
        <td>' . $data['kotatujuan'] . '</td>
    </tr>
    </table>
    <p>Demikianlah Surat Perintah Tugas ini dibuat untuk dapat digunakan dan dilaksanakan sebaik-baiknya.</p>
    <br>
    <table style="padding-left: 400px; text-align:center;">
    <tr>
        <td>Pematang Reba,';
    $bulan = cekbulan();
    $html .= ' ' . date("d") . ' ' . $bulan . ' ' . date("Y") . ' </td>
        </tr>
        <tr>
            <td>' . $namajabatan . ' Dinas PMD' . '</td>
        </tr>
        <tr>
            <td>Kabupaten Indragiri Hulu<br><br><br><br><br><br></td>
        </tr>
        <tr>
            <td><u>' .  $nama . '</u></td>
        </tr>
        <tr>
            <td>NIP:' .  $nip . '</u></td>
        </tr>
        </table>';

    $mpdf->WriteHTML($html);
    $mpdf->Output("Surat Perintah Tugas.pdf", \Mpdf\Output\Destination::INLINE);
}

function cetaksppd()
{

    $data = http_request("http://localhost/SisPerDin/api/apispt.php?f=bacasptpernospt2&nospt=" . $_GET['nospt']);
    $data = json_decode($data, TRUE);
    $data2 = http_request("http://localhost/SisPerDin/api/apispt.php?f=bacapelaksana&nospt=" . $_GET['nospt']);
    $data2 = json_decode($data2, TRUE);
    $pengikut = http_request("http://localhost/SisPerDin/api/apispt.php?f=bacapengikut&nospt=" . $_GET["nospt"]);
    $pengikut = json_decode($pengikut, TRUE);
    $sppd = http_request("http://localhost/SisPerDin/api/apispt.php?f=bacasppdperspt&nospt=" . $_GET["nospt"]);
    $sppd = json_decode($sppd, TRUE);


    require_once "../vendor/autoload.php";
    $mpdf = new \Mpdf\Mpdf(['orientation' => 'P']);

    foreach ($data as $data) {
        $namakomit = $data['nama'];
        $nipkomit = $data['nip'];
        $brngkt = strtotime($data['tglberangkat']);
        $kmbl = strtotime($data['tglkembali']);
        $tglberangkat = date("d-m-20y", $brngkt);
        $tglkembali = date("d-m-20y", $kmbl);
        $maksud = $data['maksudtujuan'];
        $kota = $data['kotatujuan'];
        $golongankomit = $data['namapangkat'] . ' ' . $data['golongan'] . '/' . $data['ruang'];
        $jabatankomit = $data['namajabatan'];
        $ket = $data['ket'];
        $lama = $data['lamaperjalanan'];
    }

    foreach ($data2 as $data2) {
        $namapelaksana = $data2['nama'];
        $golonganpelaksana = $data2['namapangkat'] . ' ' . $data2['golongan'] . '/' . $data2['ruang'];
        $jabatanpelaksana = $data2['namajabatan'];
    }


    foreach ($sppd as $sppd) {
        $nosppd = $sppd['nosppd'];
        $nipttdsppd = $sppd['nip'];
        $namattdsppd = $sppd['nama'];
        $namajabatanttdsppd = $sppd['namajabatan'];
    }

    $html = '<!DOCTYPE html>
<html lang="en">

<head>
    <style>
        body{
            font-size : 12;
            font-family: timesnewroman;
        }
        .judul{
            font-size : 20px;
            font-family: serif;
            text-align: center;
        }
        .judul2{
            font-size : 15px;
            font-family: serif;
            text-align: center;
        }
        img{
         width: 8%;
         height: 10%;
        }
        html{
            font-family: serif;
        }
        .center{
            margin-left: auto;
            margin-right: auto;
        }
        td{
            paddinng: 10px;
        }
        hr{
            height: 5px;
            color: black;
        }

        .logo{
            width: 100px;
        }

        .tabelhal2{
            border: 1px solid;
            th,td{
            border-collapse: collapse;   
            }
        }
    </style>
</head>
<body>

<table class="center" cellpadding="5" cellspacing="5">
    <tr>
        <td width="15%">
            <div class="logo"><img src="../assets/img/Lambang_Kab_Indragiri_Hulu.png" style="width: 75px; height: 90px"></div>
        </td>
        <td align="center">
            <div class="judul">PEMERINTAH KABUPATEN INDRAGIRI HULU</div>
            <div class="judul">DINAS PEMBERDAYAAN MASYARAKAT DAN DESA</div>
            <div class="judul2">Jl. Indragiri No. 05 Pematang Reba-Rengat Barat</div>
            <div class="judul2">Telp: 0769-341745 Fax: 341702</div>
        </td>
    </tr>
</table>
<hr /><br><br>
    <table style="padding-left: 400px">
    <tr>
        <td width="100px">Lampiran ke</td>
        <td>:</td>        
    </tr>
    <tr>
        <td width="100px">Nomor</td>
        <td>:</td>        
        <td>' . $nosppd . '</td>
    </tr>
    </table><br><br>
    <div class="judul2"><b><u>SURAT PERJALANAN DINAS</u></b></div>
    <br><br>
    <table border="1" width="100%" cellspacing="0" cellpadding="10">
    <tr>
        <td>1.</td>
        <td>Pejabat Pembuat Komitmen</td>
        <td>' . $namakomit . '</td>
    </tr>
    <tr>
        <td>2.</td>
        <td>Nama pegawai yang melaksanakan perjalanan dinas</td>
        <td>' . $namapelaksana . '</td>
    </tr>
    <tr>
        <td>3.</td>
        <td>a. Pangkat dan golongan <br> 
        b. Jabatan</td>
        <td>' . $golonganpelaksana . '<br>
        ' . $jabatanpelaksana . '</td>
    </tr>
    <tr>
        <td>4.</td>
        <td>Maksud perjalanan dinas</td>
        <td>' . $maksud . '</td>
    </tr>
    <tr>
        <td>5.</td>
        <td>Tempat tujuan</td>
        <td>' . $kota . '</td>
    </tr>
    <tr>
        <td>6.</td>
        <td>a. Lama <br>
        b. Tanggal berangkat <br>
        c. Tanggal Kembali</td>
        <td>' . $lama . ' Hari<br>'
        . $tglberangkat . '<br>
        ' . $tglkembali . '</td>
    </tr>
    <tr>
        <td>7.</td>
        <td>Pengikut</td>
        <td>';
    $no = 0;
    foreach ($pengikut as $pengikut) {
        $no = $no + 1;
        $html .= $no . ') ' . $pengikut['nama'] . '<br>';
    }
    $html .= '</td></tr>
    <tr>
        <td>8.</td>
        <td>Keterangan</td>
        <td>' . $ket . '</td>
</tr>
</table><br><br>
<table style="padding-left: 400px; text-align:center;">
<tr>
    <td>Pematang Reba,';
    $bulan = cekbulan();
    $html .= ' ' . date("d") . ' ' . $bulan . ' ' . date("Y") . ' </td>
    </tr>
    <tr>
        <td>' . $namajabatanttdsppd . ' Dinas PMD' . '</td>
    </tr>
    <tr>
        <td>Kabupaten Indragiri Hulu<br><br><br><br><br><br></td>
    </tr>
    <tr>
        <td><u>' .  $namattdsppd . '</u></td>
    </tr>
    <tr>
        <td>NIP:' .  $nipttdsppd . '</u></td>
    </tr>
    </table>
    <PageBreak>

<table class="tabelhal2" width="100%" cellspacing="0" cellpadding="10">
   <tr>
        <td width=50% height="100px" class="tabelhal2"></td>
        <td class="tabelhal2">
            Berangkat Dari : Pematang Reba<br>
            Ke : ' . $kota . '<br>
            Pada tanggal : ' . $tglberangkat . '<br>

                <table style="padding-left: 100px; text-align:center;">
                <tr>
                    <td>Pejabat pembuat komitmen<br><br><br><br>
                        <u>' .  $namakomit . '</u><br>
                        NIP:' .  $nipkomit . '</u>
                    </td>
                </tr>
                </table>
        </td>
   </tr>
   <tr>
        <td class="tabelhal2" style="vertical-align: text-top;">
        Tiba di : ' . $kota . '<br>
        Pada tanggal : <br>
        Kepala : 
        </td>
        <td class="tabelhal2" height="150px" style="vertical-align: text-top;">
            Berangkat Dari : Pematang Reba<br>
            Ke : ' . $kota . '<br>
            Pada tanggal : ' . $tglberangkat . '<br>
            Kepala : 
        </td>
   </tr>
   <tr>
        <td class="tabelhal2" style="vertical-align: text-top;">
        Tiba di : <br>
        Pada tanggal : <br>
        Kepala : 
        </td>
        <td class="tabelhal2" height="150px" style="vertical-align: text-top;">
            Berangkat Dari : <br>
            Ke : <br>
            Pada tanggal : <br>
            Kepala : 
        </td>
   </tr>
   <tr>
        <td class="tabelhal2" style="vertical-align: text-top;">
        Tiba di : <br>
        Pada tanggal : <br>
        Kepala : 
        </td>
        <td class="tabelhal2" height="150px" style="vertical-align: text-top;">
            Berangkat Dari : <br>
            Ke : <br>
            Pada tanggal : <br>
            Kepala : 
        </td>
   </tr>
   <tr>
        <td class="tabelhal2" style="vertical-align: text-top;">
        Tiba di : <br>
        Pada tanggal : <br>
        Kepala : 
        </td>
        <td class="tabelhal2" height="150px" style="vertical-align: text-top;">
            Berangkat Dari : <br>
            Ke : <br>
            Pada tanggal : <br>
            Kepala : 
        </td>
   </tr>
   <tr>
   <td class="tabelhal2" style="vertical-align: text-top;">
   Tiba di : Pematang Reba<br>
   Pada tanggal : <br><br><br>
   <table style="padding-left: 100px; text-align:center;">
   <tr>
       <td>Pejabat pembuat komitmen<br><br><br><br>
           <u>' .  $data['nama'] . '</u><br>
           NIP:' .  $data['nip'] . '</u>
       </td>
   </tr>
   </table>
   </td>
   <td class="tabelhal2" height="150px" style="vertical-align: text-top;">
      Telah diperiksa dengan keterangan bahwa perjalanan tersebut diatas
      benar dilakukan atas perintah dan semata-mata untuk kepentingan jabatan
      dalam waktu yang sesingkat-singkatnya.
      <table style="padding-left: 100px; text-align:center;">
      <tr>
          <td>Pejabat pembuat komitmen<br><br><br><br>
              <u>' .  $data['nama'] . '</u><br>
              NIP:' .  $data['nip'] . '</u>
          </td>
      </tr>
      </table>
   </td>
</tr>
</table><br><br>';


    $mpdf->WriteHTML($html);
    $mpdf->Output('Surat Perjalanan Dinas.pdf', \Mpdf\Output\Destination::INLINE);
}

function cetakdataspt()
{

    if (empty($_POST['awal']) || empty($_POST['akhir'])) {
        $data = http_request("http://localhost/SisPerDin/api/apispt.php?f=bacaspt");
        $data = json_decode($data, TRUE);
    } else {
        $awal = $_POST['awal'];
        $akhir = $_POST['akhir'];
        $data = http_request("http://localhost/SisPerDin/api/apispt.php?f=bacasptberdasarkantanggal&awal=$awal&akhir=$akhir");
        $data = json_decode($data, TRUE);
    }

    $pengikut = http_request("http://localhost/SisPerDin/api/apispt.php?f=bacapengikut&nospt=" . $_GET["nospt"]);
    $pengikut = json_decode($pengikut, TRUE);


    require_once "../vendor/autoload.php";
    $mpdf = new \Mpdf\Mpdf(['orientation' => 'L']);

    $html = '<!DOCTYPE html>
<html lang="en">

<head>
    <style>
        body{
            font-size : 12;
            font-family: timesnewroman;
        }
        .judul{
            font-size : 20px;
            font-family: serif;
            text-align: center;
        }
        .judul2{
            font-size : 15px;
            font-family: serif;
            text-align: center;
        }
        img{
         width: 8%;
         height: 10%;
        }
        html{
            font-family: serif;
        }
        .center{
            margin-left: auto;
            margin-right: auto;
        }
        td{
            paddinng: 10px;
        }
        hr{
            height: 5px;
            color: black;
        }
        .logo{
            width: 100px;
        }
    </style>
</head>
<body>

<table class="center" cellpadding="5" cellspacing="5">
    <tr>
        <td width="25%">
            <div class="logo"><img src="../assets/img/Lambang_Kab_Indragiri_Hulu.png"></div>
        </td>
        <td align="center">
            <div class="judul">PEMERINTAH KABUPATEN INDRAGIRI HULU</div>
            <div class="judul">DINAS PEMBERDAYAAN MASYARAKAT DAN DESA</div>
            <div class="judul2">Jl. Indragiri No. 05 Pematang Reba-Rengat Barat</div>
            <div class="judul2">Telp: 0769-341745 Fax: 341702</div>
        </td>
    </tr>
</table>
<hr />
<br><br>
<div class="judul2"><b>Data SPT</b>';
    if (isset($awal) && isset($akhir)) {
        $html .= ' (' . $awal . ' sampai ' . $akhir . ')';
    }
    $html .= '</div>
<br><br>
<table border=1 cellpadding=10 cellspacing=0 class="center" width=90%>
    <thead>
        <tr>
            <th>No SPT</th>
            <th>Nama Pelaksana</th>
            <th>Kota Tujuan</th>
            <th>Tanggal Berangkat</th>
            <th>Tanggal Kembali</th>
            <th>Total Dana</th>
            <th>Tujuan</th>
            </tr>
    </thead>
    <tbody>';
    $jmlhspt = 0;
    $jmlhbiaya = 0;
    foreach ($data as $data) {
        $jmlhspt = $jmlhspt + 1;
        $html .= '<tr>
            <td>' . $data['nospt'] . '</td>';
        $pelaksana = http_request("http://localhost/SisPerDin/api/apispt.php?f=bacapelaksana&nospt='" . $data['nospt'] . "'");
        $pelaksana = json_decode($pelaksana, TRUE);
        foreach ($pelaksana as $pelaksana) {
            $html .= '<td>' . $pelaksana['nama'] . '</td>';
        }
        $html .= '<td>' . $data['kotatujuan'] . '</td>
        <td>' . $data['tglberangkat'] . '</td>
        <td>' . $data['tglkembali'] . '</td>';
        $biaya = http_request("http://localhost/SisPerDin/api/apispt.php?f=bacatotalbiaya&nospt='" . $data['nospt'] . "'");
        $biaya = json_decode($biaya, TRUE);
        foreach ($biaya as $biaya) {
            $jmlhbiaya = $jmlhbiaya + $biaya['biaya'];
            $html .= '<td> Rp. ' . $biaya['biaya'] . '</td>';
        }
        $html .= '<td>' . $data['maksudtujuan'] . '</td>
        </tr>';
    }

    $html .= '</tbody>
        </table>
        <br>
        Keterangan <br>
        Jumlah SPT  : ' . $jmlhspt . '<br>
        Total Dana     : Rp. ' . $jmlhbiaya . '
    </body>
    ';

    $mpdf->WriteHTML($html);
    $mpdf->Output('data-pegawai.pdf', \Mpdf\Output\Destination::INLINE);
}

function cetakkwitansi()
{
    $nospt = $_GET['nospt'];
    $nospt = substr($nospt, 1, -1);
    $data = http_request("http://localhost/SisPerDin/api/apispt.php?f=bacasptpernospt2&nospt=" . $_GET['nospt']);
    $data = json_decode($data, TRUE);
    $kwitansi = http_request("http://localhost/SisPerDin/api/apispt.php?f=bacakwitansi&nospt=%27" . $nospt . "%27");
    $kwitansi = json_decode($kwitansi, TRUE);
    $sppd = http_request("http://localhost/SisPerDin/api/apispt.php?f=bacasppdperspt2&nospt=%27" . $nospt . "%27");
    $sppd = json_decode($sppd, TRUE);
    $spt = http_request("http://localhost/SisPerDin/api/apispt.php?f=bacasptpernospt&nospt=%27" . $nospt . "%27");
    $spt = json_decode($spt, TRUE);
    $cekkasubbag = http_request("http://localhost/SisPerDin/api/apispt.php?f=cekkasubbagkeuangan");
    $cekkasubbag = json_decode($cekkasubbag, TRUE);
    foreach ($sppd as $sppd) {
        $nosppd = $sppd['nosppd'];
        $namapelaksana = $sppd['nama'];
        $nippelaksana = $sppd['nip'];
        $pangkatpelaksana = $sppd['namapangkat'] . '/' . 'Golongan ' . $sppd['golongan'] . $sppd['ruang'];
        $namajabatanpelaksana = $sppd['namajabatan'];
    }
    foreach ($spt as $spt) {
        $kotatujuan = $spt['kotatujuan'];
    }
    foreach ($cekkasubbag as $cekkasubbag) {
        $namakasubbag = $cekkasubbag['nama'];
        $nipkasubbag = $cekkasubbag['nip'];
    }
    foreach ($data as $data) {
        $namakomit = $data['nama'];
        $nippembuatkomit = $data['nip'];
    }

    require_once "../vendor/autoload.php";
    $mpdf = new \Mpdf\Mpdf(['orientation' => 'P']);

    $html = '<!DOCTYPE html>
<html lang="en">

<head>
    <style>
        body{
            font-size : 12;
            font-family: timesnewroman;
        }
        .judul{
            font-size : 20px;
            font-family: serif;
            text-align: center;
        }
        .judul2{
            font-size : 15px;
            font-family: serif;
            text-align: center;
        }
        img{
         width: 12%;
         height: 15%;
        }
        html{
            font-family: serif;
        }
        .center{
            margin-left: auto;
            margin-right: auto;
        }
        td{
            padding: 5px;
        }
        hr{
            height: 5px;
            color: black;
        }
        .logo{
            width: 100px;
        }
    </style>
</head>
<body>

<table class="center" cellpadding="5" cellspacing="5">
    <tr>
        <td width="15%">
            <div class="logo"><img src="../assets/img/Lambang_Kab_Indragiri_Hulu.png"></div>
        </td>
        <td align="center">
            <div class="judul">PEMERINTAH KABUPATEN INDRAGIRI HULU</div>
            <div class="judul">DINAS PEMBERDAYAAN MASYARAKAT DAN DESA</div>
            <div class="judul2">Jl. Indragiri No. 05 Pematang Reba-Rengat Barat</div>
            <div class="judul2">Telp: 0769-341745 Fax: 341702</div>
        </td>
    </tr>
</table>
<hr />
<br><br>
<div class="judul2"><b><u>RINCIAN DANA</u></b></div>
<br><br>
<table class="center" width=90%>
<tr>
    <td>No SPT</td>
    <td>: ' . $nospt . '</td>
</tr>
<tr>
    <td>No SPPD</td>
    <td>: ' . $nosppd . '</td>
</tr>
<tr>
    <td>NIP</td>
    <td>: ' . $nippelaksana . '</td>
</tr>
<tr>
    <td>Nama</td>
    <td>: ' . $namapelaksana . '</td>
</tr>
<tr>
    <td>Pangkat/Golongan</td>
    <td>: ' . $pangkatpelaksana . '</td>
</tr>
<tr>
    <td>Jabatan</td>
    <td>: ' . $namajabatanpelaksana . '</td>
</tr>
<tr>
    <td>Kota Tujuan</td>
    <td>: ' . $kotatujuan . '</td>
</tr>
</table>
<br><br>
<table border=1 cellpadding=10 cellspacing=0 class="center" width=90%>
    <thead>
        <tr>
            <th>No</th>
            <th>Peruntukkan Dana</th>
            <th>Dana</th>
            <th>Keterangan</th>
        </tr>
    </thead>
    <tbody>';
    $no = 0;
    $totaldana = 0;
    foreach ($kwitansi as $kwitansi) {
        $no = $no + 1;
        $html .= '<tr>
        <td align="center" width=7%>' . $no . '</td>
        <td>' . $kwitansi['peruntukkandana'] . '</td>
        <td align="right">Rp. ' . $kwitansi['dana'] . '</td>
        <td>' . $kwitansi['ket'] . '</td>
        </tr>';
        $totaldana = $totaldana + $kwitansi['dana'];
    }
    $html .= '<tr>
        <td></td>
        <td><b>TOTAL</b></td>
        <td align="right"><b>Rp. ' . $totaldana . '</b></td>
        <td></td>
    </tbody>
        </table>
        <br><br>
        <table class="tabelhal2" width="100%" cellspacing="0" cellpadding="10">
            <tr>
                    <td align="center">Mengetahui/Menyetujui <br>
                        Pejabat Pembuat Komitmen<br><br><br><br><br><br>
                        <u>' .  $namakomit . '</u><br>
                        NIP:' .  $nippembuatkomit . '</u>
                    </td>
                    <td align="center">Pematang Reba,';
    $bulan = cekbulan();
    $html .= ' ' . date("d") . ' ' . $bulan . ' ' . date("Y") . ' <br>

              Yang melakukan perjalanan dinas<br><br><br><br><br><br>
                        <u>' .  $namapelaksana . '</u><br>
                        NIP:' .  $nippelaksana . '</u>
        </td>
   </tr>
   </table>
    <PageBreak>

            
<table class="center" cellpadding="5" cellspacing="5">
<tr>
    <td width="25%">
        <div class="logo"><img src="../assets/img/Lambang_Kab_Indragiri_Hulu.png"></div>
    </td>
    <td align="center">
        <div class="judul">PEMERINTAH KABUPATEN INDRAGIRI HULU</div>
        <div class="judul">DINAS PEMBERDAYAAN MASYARAKAT DAN DESA</div>
        <div class="judul2">Jl. Indragiri No. 05 Pematang Reba-Rengat Barat</div>
        <div class="judul2">Telp: 0769-341745 Fax: 341702</div>
    </td>
</tr>
</table>
<hr />
<br><br>
<div class="judul2"><b><u>KWITANSI</u></b></div>
<br><br>
<table class="center" width=90%>
<tr>
<td width=50%>Sudah diterima dari</td>
<td>: ' . $namakasubbag . '</td>
</tr>
<tr>
<td>Uang Sebesar</td>
<td>: Rp. ' . $totaldana . '</td>
</tr>
<tr>
<td><br>Untuk pembayaran berdasarkan SPPD <br> Nomor Surat Perintah Perjalanan Dinas </td>
<td><br><br>: ' . $nosppd . '</td>
</tr>
<tr>
<td>Nomor Surat Perintah Tugas</td>
<td>: ' . $nospt . '</td>
</tr>
<tr>
<td>Untuk perjalanan dinas ke</td>
<td>: ' . $kotatujuan . '</td>
</tr>
</table>
<br><br>

<table class="tabelhal2" width="100%" cellspacing="0" cellpadding="10">
<tr>
        <td align="center">Lunas di bayar <br>
            Kepala Sub Bagian Program dan Keuangan<br><br><br><br><br><br>
            <u>' .  $namakasubbag . '</u><br>
            NIP:' .  $nipkasubbag . '</u>
        </td>
        <td align="center">Setuju di bayar <br>
            Pejabat Pembuat Komitmen<br><br><br><br><br><br>
            <u>' .  $namakomit . '</u><br>
            NIP:' .  $nippembuatkomit . '</u>
        </td>
        <td align="center">Pematang Reba,';
    $bulan = cekbulan();
    $html .= ' ' . date("d") . ' ' . $bulan . ' ' . date("Y") . ' <br>

  Yang menerima<br><br><br><br><br><br>
            <u>' .  $namapelaksana . '</u><br>
            NIP:' .  $nippelaksana . '</u>
</td>
</tr>
</table>
';



    $mpdf->WriteHTML($html);
    $mpdf->Output('kwitansi.pdf', \Mpdf\Output\Destination::INLINE);
}



function cekbulan()
{
    $bulan = date('n');
    switch ($bulan) {
        case 1:
            return "Januari";
            break;
        case 2:
            return "Februari";
            break;
        case 3:
            return "Maret";
            break;
        case 4:
            return "April";
            break;
        case 5:
            return "Mei";
            break;
        case 6:
            return "Juni";
            break;
        case 7:
            return "Juli";
            break;
        case 8:
            return "Agustus";
            break;
        case 9:
            return "September";
            break;
        case 10:
            return "Oktober";
            break;
        case 11:
            return "November";
            break;
        case 12:
            return "Desember";
            break;
    }
}

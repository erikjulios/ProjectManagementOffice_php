<?php
include "proses/koneksi.php";

session_start();
$username = $_SESSION['name'];

$kode_intermediate = $_POST['kode_intermediate'];
$kode_activity = $_POST['kode_activity'];
$activity = $_POST['activity'];
$pic = $_POST['pic'];
if (isset($_POST['support'])) {
    $support = $_POST['support'];
}
if (isset($_POST['support1'])) {
    $support = implode(',',$_POST['support1']);
}
$lokasi = $_POST['lokasi'];
$uom = $_POST['uom'];
$target = $_POST['target'];
$kode_fgd = $_POST['kode_fgd'];
$estimasi_cost = $_POST['estimate_cost'];
$start = $_POST['start'];
$end = $_POST['end'];
$duration = $_POST['duration'];
$jan = $_POST['jan'];
$feb = $_POST['feb'];
$mar = $_POST['mar'];
$apr = $_POST['apr'];
$mei = $_POST['mei'];
$jun = $_POST['jun'];
$jul = $_POST['jul'];
$aug = $_POST['aug'];
$sep = $_POST['sep'];
$okt = $_POST['okt'];
$nov = $_POST['nov'];
$des = $_POST['des'];
$sql = "UPDATE db_target_activity SET tanggal_modified=NOW(), user_modified='$username', 
        kode_intermediate='$kode_intermediate', kode_activity='$kode_activity', activity='$activity',
        pic='$pic',supported_by='$support', lokasi='$lokasi', uom='$uom', target='$target', 
        kode_fgd='$kode_fgd', estimasi_cost='$estimasi_cost', start='$start', end='$end', 
        duration='$duration', target_jan='$jan', target_feb='$feb', target_mar='$mar', 
        target_apr='$apr', target_mei='$mei', target_jun='$jun', target_jul='$jul', target_aug='$aug', 
        target_sep='$sep', target_okt='$okt', target_nov='$nov', target_des='$des'  WHERE kode_activity='$kode_activity'";
if (mysqli_query($db, $sql)) {
    echo "<script>alert('Data berhasil diedit.');</script>";
    echo "<meta http-equiv='refresh' content='0;url=addProject.php'/>";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}


?>
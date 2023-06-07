<?php
include "proses/koneksi.php";
// var_dump('ok');
session_start();
$username = $_SESSION['name'];

$kode_endresult = $_POST['kode_endresult'];
$end_result = $_POST['end_result'];
$uom = $_POST['uom'];
$kode_fgd = $_POST['kode_fgd'];
$estimate_cost = $_POST['estimate_cost'];
$start = $_POST['start'];
$end = $_POST['end'];
$duration = $_POST['duration'];
$asis = $_POST['asis'];
$tube = $_POST['tube'];
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

// $sql = "UPDATE db_target_end_result SET tanggal_modified=NOW(), user_modified='$username', 
//         end_result='$end_result', uom='$uom', estimate_cost='$estimate_cost',
//         start='$start', end='$end', duration='$duration', asis='$asis', tube='$tube'WHERE kode_endresult='$kode_endresult'";
$sql = "UPDATE db_target_end_result SET tanggal_modified=NOW(), user_modified='$username', 
end_result='$end_result', uom='$uom', kode_fgd='$kode_fgd', estimate_cost='$estimate_cost',
start='$start', end='$end', duration='$duration', asis='$asis', tube='$tube', target_jan='$jan',
target_feb='$feb', target_mar='$mar', target_apr='$apr', target_mei='$mei', target_jun='$jun', target_jul='$jul', target_aug='$aug', target_sep='$sep',
target_okt='$okt', target_nov='$nov', target_des='$des' WHERE kode_endresult='$kode_endresult'";


if (mysqli_query($db, $sql)) {
    echo "<script>alert('Data berhasil diedit.');</script>";
    echo "<meta http-equiv='refresh' content='0;url=addProject.php'/>";
    
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($db);
}

?>
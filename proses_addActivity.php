<?php
include "proses/koneksi.php";

session_start();
$username = $_SESSION['name'];
// Cek apakah form telah disubmit
if($_SERVER['REQUEST_METHOD'] == "POST") {
    
    $random_number = mt_rand(100000, 999999);
    
    $query = "SELECT no_transaksi FROM db_target_activity WHERE no_transaksi = '$random_number'";
    $result = mysqli_query($db, $query);
    
    // Jika nomor acak sudah ada, generate nomor acak baru sampai nomor acak yang unik ditemukan
    while (mysqli_num_rows($result) > 0) {
        $random_number = mt_rand(100000, 999999);
        $query = "SELECT no_transaksi FROM db_target_activity WHERE no_transaksi = '$random_number'";
        $result = mysqli_query($db, $query);
    }
    
    // Gunakan nomor acak yang unik sebagai primary key
    $no_transaksi = $random_number;

$kode_intermediate = $_POST['kode_intermediate'];
$kode_fgd = $_POST['kode_fgd'];
$activity = $_POST['activity'];
$pic = $_POST['pic'];
$support = implode(",", $_POST['support']);
// $support = $_POST['support'];
$lokasi = $_POST['lokasi'];
$uom = $_POST['uom'];
$target = $_POST['target'];
$estimate_cost = $_POST['estimate_cost'];
$start = $_POST['start'];
$end = $_POST['end'];
$duration = $_POST['duration'];
$status = "input";
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

// Looping untuk setiap data yang diterima
for($i=0; $i<count($activity); $i++) {

    // Query SQL untuk insert data
    $query = "INSERT INTO db_target_activity (kode_intermediate, no_transaksi, tanggal_create, kode_fgd, activity, pic, supported_by, lokasi,  uom, target, estimasi_cost, start, end, duration, target_jan, target_feb, target_mar, target_apr, target_mei, target_jun, target_jul, target_aug, target_sep, target_okt, target_nov, target_des, status, user_create) 
              VALUES ('".$kode_intermediate."','".$no_transaksi."', NOW(), '".$kode_fgd."','".$activity[$i]."', '".$pic[$i]."', '".$support."', '".$lokasi[$i]."', '".$uom[$i]."', '".$target[$i]."', '".$estimate_cost[$i]."', '".$start[$i]."', '".$end[$i]."', '".$duration[$i]."', '".$jan[$i]."', '".$feb[$i]."', '".$mar[$i]."', '".$apr[$i]."', '".$mei[$i]."', '".$jun[$i]."', '".$jul[$i]."', '".$aug[$i]."', '".$sep[$i]."', '".$okt[$i]."', '".$nov[$i]."', '".$des[$i]."','".$status."','".$username."')";

    // Jalankan query
    $result = mysqli_query($db, $query);

    // Cek jika query gagal
    if(!$result) {
        die("Query error: ".mysqli_error($db));
    }
}

// Redirect ke halaman sukses
echo "<script>alert('Data berhasil ditambahkan.');</script>";
echo "<meta http-equiv='refresh' content='0;url=addProject.php'/>";
exit;
}
?>






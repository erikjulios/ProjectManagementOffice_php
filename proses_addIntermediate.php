<?php
include "proses/koneksi.php";
session_start();
$username = $_SESSION['name'];

if($_SERVER['REQUEST_METHOD'] == "POST") {
   
    $random_number = mt_rand(100000, 999999);
    
    $query = "SELECT no_transaksi FROM db_target_intermediate WHERE no_transaksi = '$random_number'";
    $result = mysqli_query($db, $query);
    
    while (mysqli_num_rows($result) > 0) {
        $random_number = mt_rand(100000, 999999);
        $query = "SELECT no_transaksi FROM db_target_intermediate WHERE no_transaksi = '$random_number'";
        $result = mysqli_query($db, $query);
    }
    
    // Gunakan nomor acak yang unik sebagai primary key
    $no_transaksi = $random_number;

    $kode_endresult = $_POST['kode_endresult'];
    $intermediate = $_POST['intermediate'];
    $uom = $_POST['uom'];
    $kode_fgd = $_POST['kode_fgd'];
    $estimate_cost = $_POST['estimate_cost'];
    $start = $_POST['start'];
    $end = $_POST['end'];
    $duration = $_POST['duration'];
    $asis = $_POST['asis'];
    $tube = $_POST['tube'];
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


    for($i=0; $i<count($intermediate); $i++) {

        $query = "INSERT INTO db_target_intermediate (kode_endresult, no_transaksi, tanggal_create, kode_fgd, intermediate, uom, estimate_cost, start, end, duration, asis, tube, target_jan, target_feb, target_mar, target_apr, target_mei, target_jun, target_jul, target_aug, target_sep, target_okt, target_nov, target_des, status, user_create)
                VALUES ('".$kode_endresult."','".$no_transaksi."', NOW(),'".$kode_fgd."','".$intermediate[$i]."', '".$uom[$i]."', '".$estimate_cost[$i]."', '".$start[$i]."', '".$end[$i]."', '".$duration[$i]."', '".$asis[$i]."', '".$tube[$i]."', '".$jan[$i]."', '".$feb[$i]."', '".$mar[$i]."', '".$apr[$i]."', '".$mei[$i]."', '".$jun[$i]."', '".$jul[$i]."', '".$aug[$i]."', '".$sep[$i]."', '".$okt[$i]."', '".$nov[$i]."', '".$des[$i]."','".$status."','".$username."')";

        $result = mysqli_query($db, $query);
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

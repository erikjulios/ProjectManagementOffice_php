<?php
    // Panggil file koneksi
    include "proses/koneksi.php";
    session_start();
    $username = $_SESSION['name'];
    // Cek apakah form telah disubmit
    if($_SERVER['REQUEST_METHOD'] == "POST") {

$random_number = mt_rand(100000, 999999);

// Cek apakah nomor acak sudah ada di database
$query = "SELECT no_transaksi FROM db_target_end_result WHERE no_transaksi = '$random_number'";
$result = mysqli_query($db, $query);

// Jika nomor acak sudah ada, generate nomor acak baru sampai nomor acak yang unik ditemukan
while (mysqli_num_rows($result) > 0) {
    $random_number = mt_rand(100000, 999999);
    $query = "SELECT no_transaksi FROM db_target_end_result WHERE no_transaksi = '$random_number'";
    $result = mysqli_query($db, $query);
}

$no_transaksi = $random_number;


        // Ambil data dari form
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
        $status = "input";

        // Looping untuk setiap data yang diterima
        for($i=0; $i<count($end_result); $i++) {

            // Query SQL untuk insert data
            $query = "INSERT INTO db_target_end_result (no_transaksi, tanggal_create, end_result, uom, kode_fgd, estimate_cost, start, end, duration, asis, tube, target_jan, target_feb, target_mar, target_apr, target_mei, target_jun, target_jul, target_aug, target_sep, target_okt, target_nov, target_des, status, user_create) 
                      VALUES ('".$no_transaksi."',NOW(),'".$end_result[$i]."', '".$uom[$i]."', '".$kode_fgd."', '".$estimate_cost[$i]."', '".$start[$i]."', '".$end[$i]."', '".$duration[$i]."', '".$asis[$i]."', '".$tube[$i]."', '".$jan[$i]."', '".$feb[$i]."', '".$mar[$i]."', '".$apr[$i]."', '".$mei[$i]."', '".$jun[$i]."', '".$jul[$i]."', '".$aug[$i]."', '".$sep[$i]."', '".$okt[$i]."', '".$nov[$i]."', '".$des[$i]."', '".$status."', '".$username."')";

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

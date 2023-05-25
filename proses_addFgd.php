<?php
    include "proses/koneksi.php";
    session_start();

    $random_number = mt_rand(100000, 999999);
    $query = "SELECT no_transaksi FROM db_fgd WHERE no_transaksi = '$random_number'";
    $result = mysqli_query($db, $query);

    while (mysqli_num_rows($result) > 0) {
        $random_number = mt_rand(100000, 999999);
        $query = "SELECT no_transaksi FROM db_fgd WHERE no_transaksi = '$random_number'";
        $result = mysqli_query($db, $query);
    }

    // Gunakan nomor acak yang unik sebagai primary key
    $no_transaksi = $random_number;
    $username = $_SESSION['name'];
    $tahun_fgd = $_POST['tahun_fgd'];
    $nama_fgd = $_POST['nama_fgd'];
    $pic = $_POST['pic'];
    // $team = $_POST['team'];
    $options_value = implode(",", $_POST['options']);

       
$sql = "SELECT kode_fgd FROM db_fgd";
$query2 = mysqli_query($db, $sql);

// Get last counter value database
$last_counter = 0;
if ($query2->num_rows > 0) {
    while ($data2 = mysqli_fetch_array($query2)) {
        $existing_code = $data2['kode_fgd'];
        $existing_counter = intval(substr($existing_code, -3));
        if ($existing_counter > $last_counter) {
            $last_counter = $existing_counter;
        }
    }
}
$sql = "SELECT kode_fgd FROM db_fgd ORDER BY kode_fgd DESC LIMIT 1";
$query = mysqli_query($db, $sql);
if ($query->num_rows > 0) {
    $last_code = mysqli_fetch_assoc($query)['kode_fgd'];
} else {
    $last_code = '';
}


$current_year = date('Y');

// tahun terakhir yang digunakan di database
$last_year = substr($last_code, 8, 4); 
if ($current_year != $last_year) {
    $counter = 1; // reset 
}


$counter = $last_counter + 1;

// Format the counter with leading zeros
$counter_str = str_pad($counter, 3, "0", STR_PAD_LEFT);
$kode_fgd = "Bumitama" . date('Y') . $counter_str;

    $query = "INSERT INTO db_fgd(kode_fgd, no_transaksi, tanggal_create, tahun_fgd, nama_fgd, pic, team, user_create) 
                VALUES ('".$kode_fgd."', '".$no_transaksi."', NOW(),'".$tahun_fgd."', '".$nama_fgd."', '".$pic."', '".$options_value."',NOW())";

    $result = mysqli_query($db, $query);

    if(!$result) {
        die("Query error: ".mysqli_error($db));
    }
    else{
        echo "<script>alert('Data berhasil ditambahkan.');</script>";
        echo "<meta http-equiv='refresh' content='0;url=addFgd.php'/>";
    }
    

?>

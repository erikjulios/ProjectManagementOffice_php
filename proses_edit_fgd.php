<?php
include "proses/koneksi.php";

session_start();
$username = $_SESSION['name'];

$kode_fgd = $_POST['kode_fgd'];
$tahun_fgd = $_POST['tahun_fgd'];
$nama_fgd = $_POST['nama_fgd'];
$pic = $_POST['pic'];
$team = $_POST['team'];

$sql = "UPDATE db_fgd SET user_modified='$username', tahun_fgd='$tahun_fgd', nama_fgd='$nama_fgd', pic='$pic', team='$team' WHERE kode_fgd='$kode_fgd'";

if (mysqli_query($db, $sql)) {
    echo "<script>alert('Data berhasil diedit.');</script>";
    echo "<meta http-equiv='refresh' content='0;url=addFgd.php'/>";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

?>
<?php
include "proses/koneksi.php";

session_start();
$username = $_SESSION['name'];

$userid = $_POST['userid'];
$nama = $_POST['nama'];
$email = $_POST['email'];
$departement = $_POST['departement'];
$jabatan = $_POST['jabatan'];
$otoritas = $_POST['otoritas'];
$status = $_POST['status'];

$sql = "UPDATE db_user SET user_modified='$username', username='$nama', departement='$departement', jabatan='$jabatan', otoritas='$otoritas', status='$status', email='$email' WHERE userid='$userid'";

if (mysqli_query($db, $sql)) {
    echo "<script>alert('Data berhasil diedit.');</script>";
    echo "<meta http-equiv='refresh' content='0;url=addTeam.php'/>";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

?>
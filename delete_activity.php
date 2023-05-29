<?php
if (isset($_GET['kode_activity'])) {
include "proses/koneksi.php";

$kode_activity = $_GET['kode_activity'];

$sql = "DELETE FROM db_target_activity WHERE kode_activity=$kode_activity" ;
$query = mysqli_query($db, $sql);
if ($query) {
    echo "<script>alert('Data dihapus');</script>";
    echo "<meta http-equiv='refresh' content='0;url=addproject.php'/>";
}
}
else{
    echo "<meta http-equiv='refresh' content='0;url=addproject.php'/>";
}
?>
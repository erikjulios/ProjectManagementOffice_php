<?php
if (isset($_GET['kode_intermediate'])) {
include "proses/koneksi.php";

$kode_intermediate = $_GET['kode_intermediate'];

$sql = "DELETE FROM db_target_intermediate WHERE kode_intermediate=$kode_intermediate" ;
$query = mysqli_query($db, $sql);
if ($query) {
    echo "<script>alert('Data dihapus');</script>";
    echo "<meta http-equiv='refresh' content='0;url=addproject.php'/>";
}
}
else{
    // echo "<meta http-equiv='refresh' content='0;url=addproject.php'/>";
    echo "<script>window.location.href = 'addproject.php';</script>";
}
?>
<?php
if (isset($_GET['kode_endresult'])) {
include "proses/koneksi.php";

$kode_endresult = $_GET['kode_endresult'];

$sql = "DELETE FROM db_target_end_result WHERE kode_endresult=$kode_endresult" ;
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
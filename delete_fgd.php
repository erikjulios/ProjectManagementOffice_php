<?php
if (isset($_GET['kode_fgd'])) {
include "proses/koneksi.php";

$kode_fgd = $_GET['kode_fgd'];

$sql = "DELETE FROM db_fgd WHERE kode_fgd ='$kode_fgd'" ;
$query = mysqli_query($db, $sql);
if ($query) {
    echo "<script>alert('Data dihapus');</script>";
    echo "<meta http-equiv='refresh' content='0;url=addFgd.php'/>";
}
else{
    echo "Query error: " . $db->error;
}
}
else{
    echo "<meta http-equiv='refresh' content='0;url=addFgd.php'/>";
}
?>
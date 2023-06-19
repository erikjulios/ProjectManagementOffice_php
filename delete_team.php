<?php
if (isset($_GET['userid'])) {
include "proses/koneksi.php";

$userid = $_GET['userid'];

$sql = "DELETE FROM db_user WHERE userid=$userid" ;
$query = mysqli_query($db, $sql);
if ($query) {
    echo "<script>alert('Data dihapus');</script>";
    echo "<meta http-equiv='refresh' content='0;url=addTeam.php'/>";
}
}
else{
    echo "<meta http-equiv='refresh' content='0;url=addTeam.php'/>";
}
?>
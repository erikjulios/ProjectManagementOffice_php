<?php
include "proses/koneksi.php";
$id = $_GET['id'];
if ($id == "undefined") {
    echo "null";
}
else{
$query = "SELECT nama_fgd FROM db_fgd WHERE kode_fgd = '$id'";
$result = mysqli_query($db, $query);
if ($result) {
    $data = mysqli_fetch_assoc($result);
    //setelah pilih data namun pilih ke -- pillih fgd lagi --
    if ($data == null) {
    }
    else{
        echo $data['nama_fgd'];

    }
}
}
?>

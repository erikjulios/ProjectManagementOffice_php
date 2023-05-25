<?php
    include "proses/koneksi.php";
    session_start();
    $username = $_SESSION['name'];
    $nama = $_POST['nama'];
    $departement = $_POST['departement'];
    $jabatan = $_POST['jabatan'];
    $otoritas = $_POST['otoritas'];
    $status = $_POST['status'];
    $email = $_POST['email'];

    $query = "INSERT INTO db_user(tanggal_create, username, password, departement, jabatan, otoritas, status, email, user_create) 
                VALUES (NOW(),'".$nama."', '".$password."', '".$departement."', '".$jabatan."', '".$otoritas."', '".$status."', '".$email."', '".$username."')";

    $result = mysqli_query($db, $query);

    if(!$result) {
        die("Query error: ".mysqli_error($db));
    }
    else{
        echo "<script>alert('Data berhasil ditambahkan.');</script>";
        echo "<meta http-equiv='refresh' content='0;url=addTeam.php'/>";
    }
    

?>

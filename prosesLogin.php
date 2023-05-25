<?php
include "proses/koneksi.php";
session_start();

if ( !isset($_POST['username'], $_POST['password']) ) {

	exit('Akses ditolak');
}
 if ($stmt = $db->prepare('SELECT username,password FROM db_user WHERE username = ?')) {
	$stmt->bind_param('s', $_POST['username']);
	$stmt->execute();
	$stmt->store_result();


	if ($stmt->num_rows > 0) {
	$stmt->bind_result($username, $password);
	$stmt->fetch();

		// if (password_verify($_POST['password'], $password)) {
		if ($_POST['password'] === $password) {
			session_regenerate_id();
			$_SESSION['loggedin'] = TRUE;
			$_SESSION['name'] = $_POST['username'];
			
			echo "<script>alert('Sukses Login'); </script>";
			echo "<meta http-equiv='refresh' content='0;url=index.php'/>";

		} else {
		// Incorrect password
			echo "<script>alert('Incorrect username and/or password!'); </script>";
			echo "<meta http-equiv='refresh' content='0;url=login.php'/>";
			
		}
	} else {
		// Incorrect username
		echo "<script>alert('Incorrect username and/or password!');</script>";
		echo "<meta http-equiv='refresh' content='0;url=login.php'/>";
	}
		$stmt->close();
}else{
	echo "Error message: " . $db->error;

}
?>
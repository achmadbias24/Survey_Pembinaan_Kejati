<?php
include 'koneksi.php';
$username = $_POST['username'];
$password = $_POST['password'];
$query = "SELECT * FROM ADMIN WHERE USERNAME = '$username' and PASSWORD = '$password'";
$result = mysqli_query($koneksi, $query);
if(!$result){
    die("Query error:".mysqli_errno($koneksi)." - ".mysqli_error($koneksi));
}

$data=mysqli_fetch_array($result);
if ($data){
	//inisialisasi session
	session_start();
	$_SESSION['username'] = $data['USERNAME'];
	$_SESSION['bid'] = '1';
	header("location:harian.php");
}
else
{
	echo "<script>
			alert('Maaf, Login GAGAL, pastikan username dan password anda Benar..!');
			document.location='admin.php';
		  </script>";
}
?>
<?php

//panggil koneksi database
include "koneksi.php";


$date=date('Y-m-d');
//ambil nilai keterangan
$keterangan = $_GET['ket'];
$bidang=$_GET['bidang'];
$komentar=$_GET['komentar'];

//uji jika keterangan tidak kosong
if(isset($keterangan)){
	//uji jika keterangan = simpan
	if($keterangan == "sangat_puas")
	{
		//query masukkan tanggapan sangat puas
		$query = "INSERT INTO survey values ('','$bidang','$date','SANGAT PUAS','$komentar')";
	}
	elseif($keterangan == "puas")
	{
		
		//query masukkan tanggapan puas
		$query = "INSERT INTO survey values ('','$bidang','$date','PUAS','$komentar')";
	}
	elseif($keterangan == "kurang_puas")
	{
		//query masukkan tanggapan kurang puas
		$query = "INSERT INTO survey values ('','$bidang','$date','KURANG PUAS','$komentar')";
	}

	//update data sesuai query
	mysqli_query($koneksi, $query);
	echo '<html>
	<head> 
	<link rel="stylesheet" href="assets\bootstrap-4.0.0\dist\css\bootstrap.min.css">
	<script src="assets/bootsstrap-4.0.0\dist\js\bootstrap.min.js"></script>
	<script src="assets/js/jquery.js"></script>
	</head>
	<body>
		<div class = "alert alert-success" role = "alert">
		<strong>Terima kasih, anda berhasil memberikan penilaian</strong>
		</div>
		<script>
			window.setTimeout(function(){
				$(".alert").fadeTo(500,0).slideUp(500, function(){
					$(this).remove();
				});
			},500);
			setTimeout(
			function(){
				window.location = "index.php"
			},1000);
		</script>
	</body>
	</html>
	';
}
?>
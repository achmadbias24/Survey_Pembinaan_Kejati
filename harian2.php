<!doctype html>
<html lang="en">

<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="assets\bootstrap-4.0.0\dist\css\bootstrap.min.css">
	<script src="assets/js/jquery.js"></script>
	<script src="assets/js/popper.min.js"></script>
	<script src="assets/js/Chart.js"></script>
	<script src="assets/datepicker/js/bootstrap-datepicker.js"></script>
	<link rel="stylesheet" href="assets/datepicker/css/datepicker.css">
	<title>HASIL SURVEY KEPUASAN PELAYANAN</title>
</head>

<body>
	<?php
    session_start();
    if(empty($_SESSION['username'])){
    	echo "<script>alert('Maaf, Anda harus login terlebih dahulu untuk mengakses halaman ini!');
    	document.location='admin.php';</script>"; 	
    }

    include 'koneksi.php';
    
    if(isset($_GET['bid'])){
    	$bid = $_GET['bid'];
    	$bulan=$_GET['bulan'];
    	$tahun=$_GET['tahun'];
    }else{
    	$bid='1';
    	$bulan = date("m");
    	$tahun = date("Y");
    }
    ?>
		<!-- header -->
		<nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #654321;padding: 0%">
			<a href="harian.php"><img src="img/banner.png" style="width: 110%"></a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"> <span class="navbar-toggler-icon"></span> </button>
			<div class="collapse navbar-collapse" id="navbarSupportedContent">
				<ul class="navbar-nav mr-auto">
					<li class="nav-item dropdown"> <a class="nav-link dropdown-toggle active" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
	          Rekap Hasil Survey Kepuasan Layanan
	        </a>
						<div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink"> <a class="dropdown-item" href="harian.php">Harian</a> <a class="dropdown-item" href="bulanan.php">Bulanan</a> <a class="dropdown-item" href="tahunan.php">Tahunan</a> </div>
					</li>
					<li class="nav-item dropdown"> <a class="nav-link dropdown-toggle active" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
	          Hasil Survey Kepuasan Layanan Tiap Bidang
	        </a>
						<div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink"> <a class="dropdown-item" href="harian2.php">Harian</a> <a class="dropdown-item" href="bulanan2.php">Bulanan</a> <a class="dropdown-item" href="tahunan2.php">Tahunan</a> </div>
					</li>
				</ul> <a href="logout.php" class="btn btn-danger" style="margin-right: 20px">Logout</a> </div>
		</nav>
		<!--card-->
		<div class="card mt-4" style="margin-left: 50px; margin-right: 50px;">
			<div class="card-header bg-primary text-center text-white">
				<!--dropdown-->Hasil Survey Harian 
			</div>
			<div class="card-body">
				<div class="container">
					<form class="form-inline" method="GET" action="harian2.php">
						<label class="my-1 mr-2" for="bid">Pilih Bidang</label>
						<select class="custom-select my-1 mr-sm-2" id="bid" name="bid">
							<option selected></option>
							<option value="1">ASISTEN PEMBINAAN</option>
							<option value="2">KEPEGAWAIAN</option>
							<option value="3">KEUANGAN</option>
							<option value="4">UMUM</option>
							<option value="5">DASKRIMTI DAN PERPUSTAKAAN</option>
							<option value="6">PERENCANAAN</option>
						</select>
						<label class="my-1 mr-2" for="bulan">Pilih Bulan</label>
						<select class="custom-select my-1 mr-sm-2" id="bulan" name="bulan">
							<option selected></option>
							<option value="01">JANUARI</option>
							<option value="02">FEBRUARI</option>
							<option value="03">MARET</option>
							<option value="04">APRIL</option>
							<option value="05">MEI</option>
							<option value="06">JUNI</option>
							<option value="07">JULI</option>
							<option value="08">AGUSTUS</option>
							<option value="09">SEPTEMBER</option>
							<option value="10">OKTOBER</option>
							<option value="11">NOVEMBER</option>
							<option value="12">DESEMBER</option>
						</select>
						<label class="my-1 mr-2" for="tahun">Pilih Tahun</label>
						<select class="custom-select my-1 mr-sm-2" id="tahun" name="tahun">
							<option selected></option>
							<option value="2021">2021</option>
							<option value="2022">2022</option>
							<option value="2023">2023</option>
							<option value="2024">2024</option>
							<option value="2025">2025</option>
						</select>
						<button type="submit" class="btn btn-success my-1">Oke</button>
					</form>
					<!-- grafik -->
					<div class="card">
						<div class="card-body">
							<h5 class="card-title text-center">
                	<?php 
			    		if ($bid=='1') {
			    			echo "ASISTEN PEMBINAAN";
			    		}elseif ($bid=='2') {
			    			echo "BAGIAN KEPEGAWAIAN";
			    		}elseif ($bid=='3') {
			    			echo "BAGIAN KEUANGAN";
			    		}elseif ($bid=='4') {
			    			echo "BIDANG UMUM";
			    		}elseif ($bid=='5') {
			    			echo "BIDANG DASKRIMTI DAN PERPUSTAKAAN";
			    		}elseif ($bid=='6') {
			    			echo "BIDANG PERENCANAAN";
			    		}
			    	?>
                </h5>
							<canvas id="harian2Chart"></canvas>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="card mt-3" style="margin-left: 50px; margin-right: 50px;">
			<div class="card-header bg-primary text-center text-white"> Komentar </div>
			<div class="card-body">
				<table class="table table-borderd table-hovered table-striped">
			    	<tr>
			    		<th>No</th>
			    		<th>Tanggal</th>
			    		<th>Komentar</th>
			    	</tr>
			    	<?php
			    		$tampil = mysqli_query($koneksi, "SELECT TANGGAL_SURVEY,KOMENTAR from survey WHERE ID_DIVISI='$bid' AND KOMENTAR != ''");
			    		$no = 1;
			    		while($data = mysqli_fetch_array($tampil)) :

			    	?>
			    	<tr>
			    		<td><?=$no++?></td>
			    		<td><?=$data['TANGGAL_SURVEY']?></td>
			    		<td><?=$data['KOMENTAR']?></td>
			    	</tr>
    				<?php endwhile; ?>
    			</table>
			</div>
		</div>

		<footer class="text-center text-white mt-3 bt-2 pb-2 pt-2" style="background-color: #654321;"> Kejaksaan Tinggi Jawa Timur 2021 </footer>

		<script>
		var harian2 = document.getElementById('harian2Chart').getContext('2d');
		var myChart = new Chart(harian2, {
			type: 'bar',
			data: {
				labels: ['1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12', '13', '14', '15', '16', '17', '18', '19', '20', '21', '22', '23', '24', '25', '26', '27', '28', '29', '30', '31', ],
				datasets: [{
					label: "Sangat Puas",
					backgroundColor: 'rgba(0, 122, 255, 0.7)',
					data: [<?php 
					$jumlah_tanggapan = mysqli_query($koneksi,"SELECT * FROM survey where ID_DIVISI = '$bid' and day(TANGGAL_SURVEY) = '01' and month(TANGGAL_SURVEY)='$bulan' and year(TANGGAL_SURVEY)='$tahun' and TANGGAPAN = 'SANGAT PUAS'");
					echo mysqli_num_rows($jumlah_tanggapan);
					?>, <?php 
					$jumlah_tanggapan = mysqli_query($koneksi,"SELECT * FROM survey where ID_DIVISI = '$bid' and day(TANGGAL_SURVEY) = '02' and month(TANGGAL_SURVEY)='$bulan' and year(TANGGAL_SURVEY)='$tahun' and TANGGAPAN = 'SANGAT PUAS'");
					echo mysqli_num_rows($jumlah_tanggapan);
					?>, <?php 
					$jumlah_tanggapan = mysqli_query($koneksi,"SELECT * FROM survey where ID_DIVISI = '$bid' and day(TANGGAL_SURVEY) = '03' and month(TANGGAL_SURVEY)='$bulan' and year(TANGGAL_SURVEY)='$tahun' and TANGGAPAN = 'SANGAT PUAS'");
					echo mysqli_num_rows($jumlah_tanggapan);
					?>, <?php 
					$jumlah_tanggapan = mysqli_query($koneksi,"SELECT * FROM survey where ID_DIVISI = '$bid' and day(TANGGAL_SURVEY) = '04' and month(TANGGAL_SURVEY)='$bulan' and year(TANGGAL_SURVEY)='$tahun' and TANGGAPAN = 'SANGAT PUAS'");
					echo mysqli_num_rows($jumlah_tanggapan);
					?>, <?php 
					$jumlah_tanggapan = mysqli_query($koneksi,"SELECT * FROM survey where ID_DIVISI = '$bid' and day(TANGGAL_SURVEY) = '05' and month(TANGGAL_SURVEY)='$bulan' and year(TANGGAL_SURVEY)='$tahun' and TANGGAPAN = 'SANGAT PUAS'");
					echo mysqli_num_rows($jumlah_tanggapan);
					?>, <?php 
					$jumlah_tanggapan = mysqli_query($koneksi,"SELECT * FROM survey where ID_DIVISI = '$bid' and day(TANGGAL_SURVEY) = '06' and month(TANGGAL_SURVEY)='$bulan' and year(TANGGAL_SURVEY)='$tahun' and TANGGAPAN = 'SANGAT PUAS'");
					echo mysqli_num_rows($jumlah_tanggapan);
					?>, <?php 
					$jumlah_tanggapan = mysqli_query($koneksi,"SELECT * FROM survey where ID_DIVISI = '$bid' and day(TANGGAL_SURVEY) = '07' and month(TANGGAL_SURVEY)='$bulan' and year(TANGGAL_SURVEY)='$tahun' and TANGGAPAN = 'SANGAT PUAS'");
					echo mysqli_num_rows($jumlah_tanggapan);
					?>, <?php 
					$jumlah_tanggapan = mysqli_query($koneksi,"SELECT * FROM survey where ID_DIVISI = '$bid' and day(TANGGAL_SURVEY) = '08' and month(TANGGAL_SURVEY)='$bulan' and year(TANGGAL_SURVEY)='$tahun' and TANGGAPAN = 'SANGAT PUAS'");
					echo mysqli_num_rows($jumlah_tanggapan);
					?>, <?php 
					$jumlah_tanggapan = mysqli_query($koneksi,"SELECT * FROM survey where ID_DIVISI = '$bid' and day(TANGGAL_SURVEY) = '09' and month(TANGGAL_SURVEY)='$bulan' and year(TANGGAL_SURVEY)='$tahun' and TANGGAPAN = 'SANGAT PUAS'");
					echo mysqli_num_rows($jumlah_tanggapan);
					?>, <?php 
					$jumlah_tanggapan = mysqli_query($koneksi,"SELECT * FROM survey where ID_DIVISI = '$bid' and day(TANGGAL_SURVEY) = '10' and month(TANGGAL_SURVEY)='$bulan' and year(TANGGAL_SURVEY)='$tahun' and TANGGAPAN = 'SANGAT PUAS'");
					echo mysqli_num_rows($jumlah_tanggapan);
					?>, <?php 
					$jumlah_tanggapan = mysqli_query($koneksi,"SELECT * FROM survey where ID_DIVISI = '$bid' and day(TANGGAL_SURVEY) = '11' and month(TANGGAL_SURVEY)='$bulan' and year(TANGGAL_SURVEY)='$tahun' and TANGGAPAN = 'SANGAT PUAS'");
					echo mysqli_num_rows($jumlah_tanggapan);
					?>, <?php 
					$jumlah_tanggapan = mysqli_query($koneksi,"SELECT * FROM survey where ID_DIVISI = '$bid' and day(TANGGAL_SURVEY) = '12' and month(TANGGAL_SURVEY)='$bulan' and year(TANGGAL_SURVEY)='$tahun' and TANGGAPAN = 'SANGAT PUAS'");
					echo mysqli_num_rows($jumlah_tanggapan);
					?>, <?php 
					$jumlah_tanggapan = mysqli_query($koneksi,"SELECT * FROM survey where ID_DIVISI = '$bid' and day(TANGGAL_SURVEY) = '13' and month(TANGGAL_SURVEY)='$bulan' and year(TANGGAL_SURVEY)='$tahun' and TANGGAPAN = 'SANGAT PUAS'");
					echo mysqli_num_rows($jumlah_tanggapan);
					?>, <?php 
					$jumlah_tanggapan = mysqli_query($koneksi,"SELECT * FROM survey where ID_DIVISI = '$bid' and day(TANGGAL_SURVEY) = '14' and month(TANGGAL_SURVEY)='$bulan' and year(TANGGAL_SURVEY)='$tahun' and TANGGAPAN = 'SANGAT PUAS'");
					echo mysqli_num_rows($jumlah_tanggapan);
					?>, <?php 
					$jumlah_tanggapan = mysqli_query($koneksi,"SELECT * FROM survey where ID_DIVISI = '$bid' and day(TANGGAL_SURVEY) = '15' and month(TANGGAL_SURVEY)='$bulan' and year(TANGGAL_SURVEY)='$tahun' and TANGGAPAN = 'SANGAT PUAS'");
					echo mysqli_num_rows($jumlah_tanggapan);
					?>, <?php 
					$jumlah_tanggapan = mysqli_query($koneksi,"SELECT * FROM survey where ID_DIVISI = '$bid' and day(TANGGAL_SURVEY) = '16' and month(TANGGAL_SURVEY)='$bulan' and year(TANGGAL_SURVEY)='$tahun' and TANGGAPAN = 'SANGAT PUAS'");
					echo mysqli_num_rows($jumlah_tanggapan);
					?>, <?php 
					$jumlah_tanggapan = mysqli_query($koneksi,"SELECT * FROM survey where ID_DIVISI = '$bid' and day(TANGGAL_SURVEY) = '17' and month(TANGGAL_SURVEY)='$bulan' and year(TANGGAL_SURVEY)='$tahun' and TANGGAPAN = 'SANGAT PUAS'");
					echo mysqli_num_rows($jumlah_tanggapan);
					?>, <?php 
					$jumlah_tanggapan = mysqli_query($koneksi,"SELECT * FROM survey where ID_DIVISI = '$bid' and day(TANGGAL_SURVEY) = '18' and month(TANGGAL_SURVEY)='$bulan' and year(TANGGAL_SURVEY)='$tahun' and TANGGAPAN = 'SANGAT PUAS'");
					echo mysqli_num_rows($jumlah_tanggapan);
					?>, <?php 
					$jumlah_tanggapan = mysqli_query($koneksi,"SELECT * FROM survey where ID_DIVISI = '$bid' and day(TANGGAL_SURVEY) = '19' and month(TANGGAL_SURVEY)='$bulan' and year(TANGGAL_SURVEY)='$tahun' and TANGGAPAN = 'SANGAT PUAS'");
					echo mysqli_num_rows($jumlah_tanggapan);
					?>, <?php 
					$jumlah_tanggapan = mysqli_query($koneksi,"SELECT * FROM survey where ID_DIVISI = '$bid' and day(TANGGAL_SURVEY) = '20' and month(TANGGAL_SURVEY)='$bulan' and year(TANGGAL_SURVEY)='$tahun' and TANGGAPAN = 'SANGAT PUAS'");
					echo mysqli_num_rows($jumlah_tanggapan);
					?>, <?php 
					$jumlah_tanggapan = mysqli_query($koneksi,"SELECT * FROM survey where ID_DIVISI = '$bid' and day(TANGGAL_SURVEY) = '21' and month(TANGGAL_SURVEY)='$bulan' and year(TANGGAL_SURVEY)='$tahun' and TANGGAPAN = 'SANGAT PUAS'");
					echo mysqli_num_rows($jumlah_tanggapan);
					?>, <?php 
					$jumlah_tanggapan = mysqli_query($koneksi,"SELECT * FROM survey where ID_DIVISI = '$bid' and day(TANGGAL_SURVEY) = '22' and month(TANGGAL_SURVEY)='$bulan' and year(TANGGAL_SURVEY)='$tahun' and TANGGAPAN = 'SANGAT PUAS'");
					echo mysqli_num_rows($jumlah_tanggapan);
					?>, <?php 
					$jumlah_tanggapan = mysqli_query($koneksi,"SELECT * FROM survey where ID_DIVISI = '$bid' and day(TANGGAL_SURVEY) = '23' and month(TANGGAL_SURVEY)='$bulan' and year(TANGGAL_SURVEY)='$tahun' and TANGGAPAN = 'SANGAT PUAS'");
					echo mysqli_num_rows($jumlah_tanggapan);
					?>, <?php 
					$jumlah_tanggapan = mysqli_query($koneksi,"SELECT * FROM survey where ID_DIVISI = '$bid' and day(TANGGAL_SURVEY) = '24' and month(TANGGAL_SURVEY)='$bulan' and year(TANGGAL_SURVEY)='$tahun' and TANGGAPAN = 'SANGAT PUAS'");
					echo mysqli_num_rows($jumlah_tanggapan);
					?>, <?php 
					$jumlah_tanggapan = mysqli_query($koneksi,"SELECT * FROM survey where ID_DIVISI = '$bid' and day(TANGGAL_SURVEY) = '25' and month(TANGGAL_SURVEY)='$bulan' and year(TANGGAL_SURVEY)='$tahun' and TANGGAPAN = 'SANGAT PUAS'");
					echo mysqli_num_rows($jumlah_tanggapan);
					?>, <?php 
					$jumlah_tanggapan = mysqli_query($koneksi,"SELECT * FROM survey where ID_DIVISI = '$bid' and day(TANGGAL_SURVEY) = '26' and month(TANGGAL_SURVEY)='$bulan' and year(TANGGAL_SURVEY)='$tahun' and TANGGAPAN = 'SANGAT PUAS'");
					echo mysqli_num_rows($jumlah_tanggapan);
					?>, <?php 
					$jumlah_tanggapan = mysqli_query($koneksi,"SELECT * FROM survey where ID_DIVISI = '$bid' and day(TANGGAL_SURVEY) = '27' and month(TANGGAL_SURVEY)='$bulan' and year(TANGGAL_SURVEY)='$tahun' and TANGGAPAN = 'SANGAT PUAS'");
					echo mysqli_num_rows($jumlah_tanggapan);
					?>, <?php 
					$jumlah_tanggapan = mysqli_query($koneksi,"SELECT * FROM survey where ID_DIVISI = '$bid' and day(TANGGAL_SURVEY) = '28' and month(TANGGAL_SURVEY)='$bulan' and year(TANGGAL_SURVEY)='$tahun' and TANGGAPAN = 'SANGAT PUAS'");
					echo mysqli_num_rows($jumlah_tanggapan);
					?>, <?php 
					$jumlah_tanggapan = mysqli_query($koneksi,"SELECT * FROM survey where ID_DIVISI = '$bid' and day(TANGGAL_SURVEY) = '29' and month(TANGGAL_SURVEY)='$bulan' and year(TANGGAL_SURVEY)='$tahun' and TANGGAPAN = 'SANGAT PUAS'");
					echo mysqli_num_rows($jumlah_tanggapan);
					?>, <?php 
					$jumlah_tanggapan = mysqli_query($koneksi,"SELECT * FROM survey where ID_DIVISI = '$bid' and day(TANGGAL_SURVEY) = '30' and month(TANGGAL_SURVEY)='$bulan' and year(TANGGAL_SURVEY)='$tahun' and TANGGAPAN = 'SANGAT PUAS'");
					echo mysqli_num_rows($jumlah_tanggapan);
					?>, <?php 
					$jumlah_tanggapan = mysqli_query($koneksi,"SELECT * FROM survey where ID_DIVISI = '$bid' and day(TANGGAL_SURVEY) = '31' and month(TANGGAL_SURVEY)='$bulan' and year(TANGGAL_SURVEY)='$tahun' and TANGGAPAN = 'SANGAT PUAS'");
					echo mysqli_num_rows($jumlah_tanggapan);
					?>],
				}, {
					label: "Puas",
					backgroundColor: 'rgba(39, 168, 68, 0.7)',
					data: [<?php 
					$jumlah_tanggapan = mysqli_query($koneksi,"SELECT * FROM survey where ID_DIVISI = '$bid' and day(TANGGAL_SURVEY) = '01' and month(TANGGAL_SURVEY)='$bulan' and year(TANGGAL_SURVEY)='$tahun' and TANGGAPAN = 'PUAS'");
					echo mysqli_num_rows($jumlah_tanggapan);
					?>, <?php 
					$jumlah_tanggapan = mysqli_query($koneksi,"SELECT * FROM survey where ID_DIVISI = '$bid' and day(TANGGAL_SURVEY) = '02' and month(TANGGAL_SURVEY)='$bulan' and year(TANGGAL_SURVEY)='$tahun' and TANGGAPAN = 'PUAS'");
					echo mysqli_num_rows($jumlah_tanggapan);
					?>, <?php 
					$jumlah_tanggapan = mysqli_query($koneksi,"SELECT * FROM survey where ID_DIVISI = '$bid' and day(TANGGAL_SURVEY) = '03' and month(TANGGAL_SURVEY)='$bulan' and year(TANGGAL_SURVEY)='$tahun' and TANGGAPAN = 'PUAS'");
					echo mysqli_num_rows($jumlah_tanggapan);
					?>, <?php 
					$jumlah_tanggapan = mysqli_query($koneksi,"SELECT * FROM survey where ID_DIVISI = '$bid' and day(TANGGAL_SURVEY) = '04' and month(TANGGAL_SURVEY)='$bulan' and year(TANGGAL_SURVEY)='$tahun' and TANGGAPAN = 'PUAS'");
					echo mysqli_num_rows($jumlah_tanggapan);
					?>, <?php 
					$jumlah_tanggapan = mysqli_query($koneksi,"SELECT * FROM survey where ID_DIVISI = '$bid' and day(TANGGAL_SURVEY) = '05' and month(TANGGAL_SURVEY)='$bulan' and year(TANGGAL_SURVEY)='$tahun' and TANGGAPAN = 'PUAS'");
					echo mysqli_num_rows($jumlah_tanggapan);
					?>, <?php 
					$jumlah_tanggapan = mysqli_query($koneksi,"SELECT * FROM survey where ID_DIVISI = '$bid' and day(TANGGAL_SURVEY) = '06' and month(TANGGAL_SURVEY)='$bulan' and year(TANGGAL_SURVEY)='$tahun' and TANGGAPAN = 'PUAS'");
					echo mysqli_num_rows($jumlah_tanggapan);
					?>, <?php 
					$jumlah_tanggapan = mysqli_query($koneksi,"SELECT * FROM survey where ID_DIVISI = '$bid' and day(TANGGAL_SURVEY) = '07' and month(TANGGAL_SURVEY)='$bulan' and year(TANGGAL_SURVEY)='$tahun' and TANGGAPAN = 'PUAS'");
					echo mysqli_num_rows($jumlah_tanggapan);
					?>, <?php 
					$jumlah_tanggapan = mysqli_query($koneksi,"SELECT * FROM survey where ID_DIVISI = '$bid' and day(TANGGAL_SURVEY) = '08' and month(TANGGAL_SURVEY)='$bulan' and year(TANGGAL_SURVEY)='$tahun' and TANGGAPAN = 'PUAS'");
					echo mysqli_num_rows($jumlah_tanggapan);
					?>, <?php 
					$jumlah_tanggapan = mysqli_query($koneksi,"SELECT * FROM survey where ID_DIVISI = '$bid' and day(TANGGAL_SURVEY) = '09' and month(TANGGAL_SURVEY)='$bulan' and year(TANGGAL_SURVEY)='$tahun' and TANGGAPAN = 'PUAS'");
					echo mysqli_num_rows($jumlah_tanggapan);
					?>, <?php 
					$jumlah_tanggapan = mysqli_query($koneksi,"SELECT * FROM survey where ID_DIVISI = '$bid' and day(TANGGAL_SURVEY) = '10' and month(TANGGAL_SURVEY)='$bulan' and year(TANGGAL_SURVEY)='$tahun' and TANGGAPAN = 'PUAS'");
					echo mysqli_num_rows($jumlah_tanggapan);
					?>, <?php 
					$jumlah_tanggapan = mysqli_query($koneksi,"SELECT * FROM survey where ID_DIVISI = '$bid' and day(TANGGAL_SURVEY) = '11' and month(TANGGAL_SURVEY)='$bulan' and year(TANGGAL_SURVEY)='$tahun' and TANGGAPAN = 'PUAS'");
					echo mysqli_num_rows($jumlah_tanggapan);
					?>, <?php 
					$jumlah_tanggapan = mysqli_query($koneksi,"SELECT * FROM survey where ID_DIVISI = '$bid' and day(TANGGAL_SURVEY) = '12' and month(TANGGAL_SURVEY)='$bulan' and year(TANGGAL_SURVEY)='$tahun' and TANGGAPAN = 'PUAS'");
					echo mysqli_num_rows($jumlah_tanggapan);
					?>, <?php 
					$jumlah_tanggapan = mysqli_query($koneksi,"SELECT * FROM survey where ID_DIVISI = '$bid' and day(TANGGAL_SURVEY) = '13' and month(TANGGAL_SURVEY)='$bulan' and year(TANGGAL_SURVEY)='$tahun' and TANGGAPAN = 'PUAS'");
					echo mysqli_num_rows($jumlah_tanggapan);
					?>, <?php 
					$jumlah_tanggapan = mysqli_query($koneksi,"SELECT * FROM survey where ID_DIVISI = '$bid' and day(TANGGAL_SURVEY) = '14' and month(TANGGAL_SURVEY)='$bulan' and year(TANGGAL_SURVEY)='$tahun' and TANGGAPAN = 'PUAS'");
					echo mysqli_num_rows($jumlah_tanggapan);
					?>, <?php 
					$jumlah_tanggapan = mysqli_query($koneksi,"SELECT * FROM survey where ID_DIVISI = '$bid' and day(TANGGAL_SURVEY) = '15' and month(TANGGAL_SURVEY)='$bulan' and year(TANGGAL_SURVEY)='$tahun' and TANGGAPAN = 'PUAS'");
					echo mysqli_num_rows($jumlah_tanggapan);
					?>, <?php 
					$jumlah_tanggapan = mysqli_query($koneksi,"SELECT * FROM survey where ID_DIVISI = '$bid' and day(TANGGAL_SURVEY) = '16' and month(TANGGAL_SURVEY)='$bulan' and year(TANGGAL_SURVEY)='$tahun' and TANGGAPAN = 'PUAS'");
					echo mysqli_num_rows($jumlah_tanggapan);
					?>, <?php 
					$jumlah_tanggapan = mysqli_query($koneksi,"SELECT * FROM survey where ID_DIVISI = '$bid' and day(TANGGAL_SURVEY) = '17' and month(TANGGAL_SURVEY)='$bulan' and year(TANGGAL_SURVEY)='$tahun' and TANGGAPAN = 'PUAS'");
					echo mysqli_num_rows($jumlah_tanggapan);
					?>, <?php 
					$jumlah_tanggapan = mysqli_query($koneksi,"SELECT * FROM survey where ID_DIVISI = '$bid' and day(TANGGAL_SURVEY) = '18' and month(TANGGAL_SURVEY)='$bulan' and year(TANGGAL_SURVEY)='$tahun' and TANGGAPAN = 'PUAS'");
					echo mysqli_num_rows($jumlah_tanggapan);
					?>, <?php 
					$jumlah_tanggapan = mysqli_query($koneksi,"SELECT * FROM survey where ID_DIVISI = '$bid' and day(TANGGAL_SURVEY) = '19' and month(TANGGAL_SURVEY)='$bulan' and year(TANGGAL_SURVEY)='$tahun' and TANGGAPAN = 'PUAS'");
					echo mysqli_num_rows($jumlah_tanggapan);
					?>, <?php 
					$jumlah_tanggapan = mysqli_query($koneksi,"SELECT * FROM survey where ID_DIVISI = '$bid' and day(TANGGAL_SURVEY) = '20' and month(TANGGAL_SURVEY)='$bulan' and year(TANGGAL_SURVEY)='$tahun' and TANGGAPAN = 'PUAS'");
					echo mysqli_num_rows($jumlah_tanggapan);
					?>, <?php 
					$jumlah_tanggapan = mysqli_query($koneksi,"SELECT * FROM survey where ID_DIVISI = '$bid' and day(TANGGAL_SURVEY) = '21' and month(TANGGAL_SURVEY)='$bulan' and year(TANGGAL_SURVEY)='$tahun' and TANGGAPAN = 'PUAS'");
					echo mysqli_num_rows($jumlah_tanggapan);
					?>, <?php 
					$jumlah_tanggapan = mysqli_query($koneksi,"SELECT * FROM survey where ID_DIVISI = '$bid' and day(TANGGAL_SURVEY) = '22' and month(TANGGAL_SURVEY)='$bulan' and year(TANGGAL_SURVEY)='$tahun' and TANGGAPAN = 'PUAS'");
					echo mysqli_num_rows($jumlah_tanggapan);
					?>, <?php 
					$jumlah_tanggapan = mysqli_query($koneksi,"SELECT * FROM survey where ID_DIVISI = '$bid' and day(TANGGAL_SURVEY) = '23' and month(TANGGAL_SURVEY)='$bulan' and year(TANGGAL_SURVEY)='$tahun' and TANGGAPAN = 'PUAS'");
					echo mysqli_num_rows($jumlah_tanggapan);
					?>, <?php 
					$jumlah_tanggapan = mysqli_query($koneksi,"SELECT * FROM survey where ID_DIVISI = '$bid' and day(TANGGAL_SURVEY) = '24' and month(TANGGAL_SURVEY)='$bulan' and year(TANGGAL_SURVEY)='$tahun' and TANGGAPAN = 'PUAS'");
					echo mysqli_num_rows($jumlah_tanggapan);
					?>, <?php 
					$jumlah_tanggapan = mysqli_query($koneksi,"SELECT * FROM survey where ID_DIVISI = '$bid' and day(TANGGAL_SURVEY) = '25' and month(TANGGAL_SURVEY)='$bulan' and year(TANGGAL_SURVEY)='$tahun' and TANGGAPAN = 'PUAS'");
					echo mysqli_num_rows($jumlah_tanggapan);
					?>, <?php 
					$jumlah_tanggapan = mysqli_query($koneksi,"SELECT * FROM survey where ID_DIVISI = '$bid' and day(TANGGAL_SURVEY) = '26' and month(TANGGAL_SURVEY)='$bulan' and year(TANGGAL_SURVEY)='$tahun' and TANGGAPAN = 'PUAS'");
					echo mysqli_num_rows($jumlah_tanggapan);
					?>, <?php 
					$jumlah_tanggapan = mysqli_query($koneksi,"SELECT * FROM survey where ID_DIVISI = '$bid' and day(TANGGAL_SURVEY) = '27' and month(TANGGAL_SURVEY)='$bulan' and year(TANGGAL_SURVEY)='$tahun' and TANGGAPAN = 'PUAS'");
					echo mysqli_num_rows($jumlah_tanggapan);
					?>, <?php 
					$jumlah_tanggapan = mysqli_query($koneksi,"SELECT * FROM survey where ID_DIVISI = '$bid' and day(TANGGAL_SURVEY) = '28' and month(TANGGAL_SURVEY)='$bulan' and year(TANGGAL_SURVEY)='$tahun' and TANGGAPAN = 'PUAS'");
					echo mysqli_num_rows($jumlah_tanggapan);
					?>, <?php 
					$jumlah_tanggapan = mysqli_query($koneksi,"SELECT * FROM survey where ID_DIVISI = '$bid' and day(TANGGAL_SURVEY) = '29' and month(TANGGAL_SURVEY)='$bulan' and year(TANGGAL_SURVEY)='$tahun' and TANGGAPAN = 'PUAS'");
					echo mysqli_num_rows($jumlah_tanggapan);
					?>, <?php 
					$jumlah_tanggapan = mysqli_query($koneksi,"SELECT * FROM survey where ID_DIVISI = '$bid' and day(TANGGAL_SURVEY) = '30' and month(TANGGAL_SURVEY)='$bulan' and year(TANGGAL_SURVEY)='$tahun' and TANGGAPAN = 'PUAS'");
					echo mysqli_num_rows($jumlah_tanggapan);
					?>, <?php 
					$jumlah_tanggapan = mysqli_query($koneksi,"SELECT * FROM survey where ID_DIVISI = '$bid' and day(TANGGAL_SURVEY) = '31' and month(TANGGAL_SURVEY)='$bulan' and year(TANGGAL_SURVEY)='$tahun' and TANGGAPAN = 'PUAS'");
					echo mysqli_num_rows($jumlah_tanggapan);
					?>],
				}, {
					label: "Kurang Puas",
					backgroundColor: 'rgba(220, 53, 70, 0.7)',
					data: [<?php 
					$jumlah_tanggapan = mysqli_query($koneksi,"SELECT * FROM survey where ID_DIVISI = '$bid' and day(TANGGAL_SURVEY) = '01' and month(TANGGAL_SURVEY)='$bulan' and year(TANGGAL_SURVEY)='$tahun' and TANGGAPAN = 'KURANG PUAS'");
					echo mysqli_num_rows($jumlah_tanggapan);
					?>, <?php 
					$jumlah_tanggapan = mysqli_query($koneksi,"SELECT * FROM survey where ID_DIVISI = '$bid' and day(TANGGAL_SURVEY) = '02' and month(TANGGAL_SURVEY)='$bulan' and year(TANGGAL_SURVEY)='$tahun' and TANGGAPAN = 'KURANG PUAS'");
					echo mysqli_num_rows($jumlah_tanggapan);
					?>, <?php 
					$jumlah_tanggapan = mysqli_query($koneksi,"SELECT * FROM survey where ID_DIVISI = '$bid' and day(TANGGAL_SURVEY) = '03' and month(TANGGAL_SURVEY)='$bulan' and year(TANGGAL_SURVEY)='$tahun' and TANGGAPAN = 'KURANG PUAS'");
					echo mysqli_num_rows($jumlah_tanggapan);
					?>, <?php 
					$jumlah_tanggapan = mysqli_query($koneksi,"SELECT * FROM survey where ID_DIVISI = '$bid' and day(TANGGAL_SURVEY) = '04' and month(TANGGAL_SURVEY)='$bulan' and year(TANGGAL_SURVEY)='$tahun' and TANGGAPAN = 'KURANG PUAS'");
					echo mysqli_num_rows($jumlah_tanggapan);
					?>, <?php 
					$jumlah_tanggapan = mysqli_query($koneksi,"SELECT * FROM survey where ID_DIVISI = '$bid' and day(TANGGAL_SURVEY) = '05' and month(TANGGAL_SURVEY)='$bulan' and year(TANGGAL_SURVEY)='$tahun' and TANGGAPAN = 'KURANG PUAS'");
					echo mysqli_num_rows($jumlah_tanggapan);
					?>, <?php 
					$jumlah_tanggapan = mysqli_query($koneksi,"SELECT * FROM survey where ID_DIVISI = '$bid' and day(TANGGAL_SURVEY) = '06' and month(TANGGAL_SURVEY)='$bulan' and year(TANGGAL_SURVEY)='$tahun' and TANGGAPAN = 'KURANG PUAS'");
					echo mysqli_num_rows($jumlah_tanggapan);
					?>, <?php 
					$jumlah_tanggapan = mysqli_query($koneksi,"SELECT * FROM survey where ID_DIVISI = '$bid' and day(TANGGAL_SURVEY) = '07' and month(TANGGAL_SURVEY)='$bulan' and year(TANGGAL_SURVEY)='$tahun' and TANGGAPAN = 'KURANG PUAS'");
					echo mysqli_num_rows($jumlah_tanggapan);
					?>, <?php 
					$jumlah_tanggapan = mysqli_query($koneksi,"SELECT * FROM survey where ID_DIVISI = '$bid' and day(TANGGAL_SURVEY) = '08' and month(TANGGAL_SURVEY)='$bulan' and year(TANGGAL_SURVEY)='$tahun' and TANGGAPAN = 'KURANG PUAS'");
					echo mysqli_num_rows($jumlah_tanggapan);
					?>, <?php 
					$jumlah_tanggapan = mysqli_query($koneksi,"SELECT * FROM survey where ID_DIVISI = '$bid' and day(TANGGAL_SURVEY) = '09' and month(TANGGAL_SURVEY)='$bulan' and year(TANGGAL_SURVEY)='$tahun' and TANGGAPAN = 'KURANG PUAS'");
					echo mysqli_num_rows($jumlah_tanggapan);
					?>, <?php 
					$jumlah_tanggapan = mysqli_query($koneksi,"SELECT * FROM survey where ID_DIVISI = '$bid' and day(TANGGAL_SURVEY) = '10' and month(TANGGAL_SURVEY)='$bulan' and year(TANGGAL_SURVEY)='$tahun' and TANGGAPAN = 'KURANG PUAS'");
					echo mysqli_num_rows($jumlah_tanggapan);
					?>, <?php 
					$jumlah_tanggapan = mysqli_query($koneksi,"SELECT * FROM survey where ID_DIVISI = '$bid' and day(TANGGAL_SURVEY) = '11' and month(TANGGAL_SURVEY)='$bulan' and year(TANGGAL_SURVEY)='$tahun' and TANGGAPAN = 'KURANG PUAS'");
					echo mysqli_num_rows($jumlah_tanggapan);
					?>, <?php 
					$jumlah_tanggapan = mysqli_query($koneksi,"SELECT * FROM survey where ID_DIVISI = '$bid' and day(TANGGAL_SURVEY) = '12' and month(TANGGAL_SURVEY)='$bulan' and year(TANGGAL_SURVEY)='$tahun' and TANGGAPAN = 'KURANG PUAS'");
					echo mysqli_num_rows($jumlah_tanggapan);
					?>, <?php 
					$jumlah_tanggapan = mysqli_query($koneksi,"SELECT * FROM survey where ID_DIVISI = '$bid' and day(TANGGAL_SURVEY) = '13' and month(TANGGAL_SURVEY)='$bulan' and year(TANGGAL_SURVEY)='$tahun' and TANGGAPAN = 'KURANG PUAS'");
					echo mysqli_num_rows($jumlah_tanggapan);
					?>, <?php 
					$jumlah_tanggapan = mysqli_query($koneksi,"SELECT * FROM survey where ID_DIVISI = '$bid' and day(TANGGAL_SURVEY) = '14' and month(TANGGAL_SURVEY)='$bulan' and year(TANGGAL_SURVEY)='$tahun' and TANGGAPAN = 'KURANG PUAS'");
					echo mysqli_num_rows($jumlah_tanggapan);
					?>, <?php 
					$jumlah_tanggapan = mysqli_query($koneksi,"SELECT * FROM survey where ID_DIVISI = '$bid' and day(TANGGAL_SURVEY) = '15' and month(TANGGAL_SURVEY)='$bulan' and year(TANGGAL_SURVEY)='$tahun' and TANGGAPAN = 'KURANG PUAS'");
					echo mysqli_num_rows($jumlah_tanggapan);
					?>, <?php 
					$jumlah_tanggapan = mysqli_query($koneksi,"SELECT * FROM survey where ID_DIVISI = '$bid' and day(TANGGAL_SURVEY) = '16' and month(TANGGAL_SURVEY)='$bulan' and year(TANGGAL_SURVEY)='$tahun' and TANGGAPAN = 'KURANG PUAS'");
					echo mysqli_num_rows($jumlah_tanggapan);
					?>, <?php 
					$jumlah_tanggapan = mysqli_query($koneksi,"SELECT * FROM survey where ID_DIVISI = '$bid' and day(TANGGAL_SURVEY) = '17' and month(TANGGAL_SURVEY)='$bulan' and year(TANGGAL_SURVEY)='$tahun' and TANGGAPAN = 'KURANG PUAS'");
					echo mysqli_num_rows($jumlah_tanggapan);
					?>, <?php 
					$jumlah_tanggapan = mysqli_query($koneksi,"SELECT * FROM survey where ID_DIVISI = '$bid' and day(TANGGAL_SURVEY) = '18' and month(TANGGAL_SURVEY)='$bulan' and year(TANGGAL_SURVEY)='$tahun' and TANGGAPAN = 'KURANG PUAS'");
					echo mysqli_num_rows($jumlah_tanggapan);
					?>, <?php 
					$jumlah_tanggapan = mysqli_query($koneksi,"SELECT * FROM survey where ID_DIVISI = '$bid' and day(TANGGAL_SURVEY) = '19' and month(TANGGAL_SURVEY)='$bulan' and year(TANGGAL_SURVEY)='$tahun' and TANGGAPAN = 'KURANG PUAS'");
					echo mysqli_num_rows($jumlah_tanggapan);
					?>, <?php 
					$jumlah_tanggapan = mysqli_query($koneksi,"SELECT * FROM survey where ID_DIVISI = '$bid' and day(TANGGAL_SURVEY) = '20' and month(TANGGAL_SURVEY)='$bulan' and year(TANGGAL_SURVEY)='$tahun' and TANGGAPAN = 'KURANG PUAS'");
					echo mysqli_num_rows($jumlah_tanggapan);
					?>, <?php 
					$jumlah_tanggapan = mysqli_query($koneksi,"SELECT * FROM survey where ID_DIVISI = '$bid' and day(TANGGAL_SURVEY) = '21' and month(TANGGAL_SURVEY)='$bulan' and year(TANGGAL_SURVEY)='$tahun' and TANGGAPAN = 'KURANG PUAS'");
					echo mysqli_num_rows($jumlah_tanggapan);
					?>, <?php 
					$jumlah_tanggapan = mysqli_query($koneksi,"SELECT * FROM survey where ID_DIVISI = '$bid' and day(TANGGAL_SURVEY) = '22' and month(TANGGAL_SURVEY)='$bulan' and year(TANGGAL_SURVEY)='$tahun' and TANGGAPAN = 'KURANG PUAS'");
					echo mysqli_num_rows($jumlah_tanggapan);
					?>, <?php 
					$jumlah_tanggapan = mysqli_query($koneksi,"SELECT * FROM survey where ID_DIVISI = '$bid' and day(TANGGAL_SURVEY) = '23' and month(TANGGAL_SURVEY)='$bulan' and year(TANGGAL_SURVEY)='$tahun' and TANGGAPAN = 'KURANG PUAS'");
					echo mysqli_num_rows($jumlah_tanggapan);
					?>, <?php 
					$jumlah_tanggapan = mysqli_query($koneksi,"SELECT * FROM survey where ID_DIVISI = '$bid' and day(TANGGAL_SURVEY) = '24' and month(TANGGAL_SURVEY)='$bulan' and year(TANGGAL_SURVEY)='$tahun' and TANGGAPAN = 'KURANG PUAS'");
					echo mysqli_num_rows($jumlah_tanggapan);
					?>, <?php 
					$jumlah_tanggapan = mysqli_query($koneksi,"SELECT * FROM survey where ID_DIVISI = '$bid' and day(TANGGAL_SURVEY) = '25' and month(TANGGAL_SURVEY)='$bulan' and year(TANGGAL_SURVEY)='$tahun' and TANGGAPAN = 'KURANG PUAS'");
					echo mysqli_num_rows($jumlah_tanggapan);
					?>, <?php 
					$jumlah_tanggapan = mysqli_query($koneksi,"SELECT * FROM survey where ID_DIVISI = '$bid' and day(TANGGAL_SURVEY) = '26' and month(TANGGAL_SURVEY)='$bulan' and year(TANGGAL_SURVEY)='$tahun' and TANGGAPAN = 'KURANG PUAS'");
					echo mysqli_num_rows($jumlah_tanggapan);
					?>, <?php 
					$jumlah_tanggapan = mysqli_query($koneksi,"SELECT * FROM survey where ID_DIVISI = '$bid' and day(TANGGAL_SURVEY) = '27' and month(TANGGAL_SURVEY)='$bulan' and year(TANGGAL_SURVEY)='$tahun' and TANGGAPAN = 'KURANG PUAS'");
					echo mysqli_num_rows($jumlah_tanggapan);
					?>, <?php 
					$jumlah_tanggapan = mysqli_query($koneksi,"SELECT * FROM survey where ID_DIVISI = '$bid' and day(TANGGAL_SURVEY) = '28' and month(TANGGAL_SURVEY)='$bulan' and year(TANGGAL_SURVEY)='$tahun' and TANGGAPAN = 'KURANG PUAS'");
					echo mysqli_num_rows($jumlah_tanggapan);
					?>, <?php 
					$jumlah_tanggapan = mysqli_query($koneksi,"SELECT * FROM survey where ID_DIVISI = '$bid' and day(TANGGAL_SURVEY) = '29' and month(TANGGAL_SURVEY)='$bulan' and year(TANGGAL_SURVEY)='$tahun' and TANGGAPAN = 'KURANG PUAS'");
					echo mysqli_num_rows($jumlah_tanggapan);
					?>, <?php 
					$jumlah_tanggapan = mysqli_query($koneksi,"SELECT * FROM survey where ID_DIVISI = '$bid' and day(TANGGAL_SURVEY) = '30' and month(TANGGAL_SURVEY)='$bulan' and year(TANGGAL_SURVEY)='$tahun' and TANGGAPAN = 'KURANG PUAS'");
					echo mysqli_num_rows($jumlah_tanggapan);
					?>, <?php 
					$jumlah_tanggapan = mysqli_query($koneksi,"SELECT * FROM survey where ID_DIVISI = '$bid' and day(TANGGAL_SURVEY) = '31' and month(TANGGAL_SURVEY)='$bulan' and year(TANGGAL_SURVEY)='$tahun' and TANGGAPAN = 'KURANG PUAS'");
					echo mysqli_num_rows($jumlah_tanggapan);
					?>],
				}]
			},
			options: {
				scales: {
					y: {
						beginAtZero: true
					}
				}
			}
		});
		</script>
		<script src="assets/js/bootstrap.min.js"></script>
</body>

</html>
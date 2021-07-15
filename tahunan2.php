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
    }else{
    	$bid='1';
    }
    ?>
	  <!-- header -->
    <nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #654321;padding: 0%">
	  <a href="harian.php"><img src="img/banner.png" style="width: 110%"></a>
	  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
	    <span class="navbar-toggler-icon"></span>
	  </button>

	  <div class="collapse navbar-collapse" id="navbarSupportedContent">
	    <ul class="navbar-nav mr-auto">
	      <li class="nav-item dropdown">
	        <a class="nav-link dropdown-toggle active" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
	          Rekap Hasil Survey Kepuasan Layanan
	        </a>
	        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
	          <a class="dropdown-item" href="harian.php">Harian</a>
	          <a class="dropdown-item" href="bulanan.php">Bulanan</a>
	          <a class="dropdown-item" href="tahunan.php">Tahunan</a>
	        </div>
	      </li>
	      <li class="nav-item dropdown">
	        <a class="nav-link dropdown-toggle active" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
	          Hasil Survey Kepuasan Layanan Tiap Bidang
	        </a>
	        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
	          <a class="dropdown-item" href="harian2.php">Harian</a>
	          <a class="dropdown-item" href="bulanan2.php">Bulanan</a>
	          <a class="dropdown-item" href="tahunan2.php">Tahunan</a>
	        </div>
	      </li>
	    </ul>
	    <a href="logout.php" class = "btn btn-danger" style="margin-right: 20px">Logout</a>
	  </div>
	</nav>

    <!--card-->
    <div class="card mt-4" style="margin-left: 50px; margin-right: 50px;">
	  <div class="card-header bg-primary text-center text-white">
	   	<!--dropdown-->
     	Hasil Survey Tahunan
	  </div>
	  <div class="card-body">
	    <div class = "container">
		    <form class="form-inline" method="GET" action="">
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
			  <button type="submit" class="btn btn-success my-1">Oke</button>
			</form>
        
          	<!-- grafik -->
            <div class = "card">
              <div class = "card-body">
                <h5 class = "card-title text-center">
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
                <canvas id="tahunan2Chart"></canvas>
              </div>
            </div>
          
	  </div>
	</div>
</div>
    
    
	 <footer class="text-center text-white mt-3 bt-2 pb-2 pt-2" style="background-color: #654321;">
	 	Kejaksaan Tinggi Jawa Timur 2021
	 </footer>


	<script>
	var tahunan2 = document.getElementById('tahunan2Chart').getContext('2d');
	var myChart = new Chart(tahunan2, {
	    type: 'bar',
	    data: {
	        labels: ['2021','2022','2023','2024','2025'],
	        datasets: [{
	            label: "Sangat Puas",
	            backgroundColor: 'rgba(0, 122, 255, 0.7)',
	            data: [
	            	<?php 
					$jumlah_tanggapan = mysqli_query($koneksi,"SELECT * FROM survey where ID_DIVISI = '$bid' and year(TANGGAL_SURVEY) = '2021' and TANGGAPAN = 'SANGAT PUAS'");
					echo mysqli_num_rows($jumlah_tanggapan);
					?>,
					<?php 
					$jumlah_tanggapan = mysqli_query($koneksi,"SELECT * FROM survey where ID_DIVISI = '$bid' and year(TANGGAL_SURVEY) = '2022' and TANGGAPAN = 'SANGAT PUAS'");
					echo mysqli_num_rows($jumlah_tanggapan);
					?>,
					<?php 
					$jumlah_tanggapan = mysqli_query($koneksi,"SELECT * FROM survey where ID_DIVISI = '$bid' and year(TANGGAL_SURVEY) = '2023' and TANGGAPAN = 'SANGAT PUAS'");
					echo mysqli_num_rows($jumlah_tanggapan);
					?>,
					<?php 
					$jumlah_tanggapan = mysqli_query($koneksi,"SELECT * FROM survey where ID_DIVISI = '$bid' and year(TANGGAL_SURVEY) = '2024' and TANGGAPAN = 'SANGAT PUAS'");
					echo mysqli_num_rows($jumlah_tanggapan);
					?>,
					<?php 
					$jumlah_tanggapan = mysqli_query($koneksi,"SELECT * FROM survey where ID_DIVISI = '$bid' and year(TANGGAL_SURVEY) = '2025' and TANGGAPAN = 'SANGAT PUAS'");
					echo mysqli_num_rows($jumlah_tanggapan);
					?>
	            ],

	        },{
	            label: "Puas",
	            backgroundColor: 'rgba(39, 168, 68, 0.7)',
	            data: [
	            	<?php 
					$jumlah_tanggapan = mysqli_query($koneksi,"SELECT * FROM survey where ID_DIVISI = '$bid' and year(TANGGAL_SURVEY) = '2021' and TANGGAPAN = 'PUAS'");
					echo mysqli_num_rows($jumlah_tanggapan);
					?>,
					<?php 
					$jumlah_tanggapan = mysqli_query($koneksi,"SELECT * FROM survey where ID_DIVISI = '$bid' and year(TANGGAL_SURVEY) = '2022' and TANGGAPAN = 'PUAS'");
					echo mysqli_num_rows($jumlah_tanggapan);
					?>,
					<?php 
					$jumlah_tanggapan = mysqli_query($koneksi,"SELECT * FROM survey where ID_DIVISI = '$bid' and year(TANGGAL_SURVEY) = '2023' and TANGGAPAN = 'PUAS'");
					echo mysqli_num_rows($jumlah_tanggapan);
					?>,
					<?php 
					$jumlah_tanggapan = mysqli_query($koneksi,"SELECT * FROM survey where ID_DIVISI = '$bid' and year(TANGGAL_SURVEY) = '2024' and TANGGAPAN = 'PUAS'");
					echo mysqli_num_rows($jumlah_tanggapan);
					?>,
					<?php 
					$jumlah_tanggapan = mysqli_query($koneksi,"SELECT * FROM survey where ID_DIVISI = '$bid' and year(TANGGAL_SURVEY) = '2025' and TANGGAPAN = 'PUAS'");
					echo mysqli_num_rows($jumlah_tanggapan);
					?>
	            ],
	        },{
	            label: "Kurang Puas",
	            backgroundColor: 'rgba(220, 53, 70, 0.7)',
	            data: [
	            	<?php 
					$jumlah_tanggapan = mysqli_query($koneksi,"SELECT * FROM survey where ID_DIVISI = '$bid' and year(TANGGAL_SURVEY) = '2021' and TANGGAPAN = 'KURANG PUAS'");
					echo mysqli_num_rows($jumlah_tanggapan);
					?>,
					<?php 
					$jumlah_tanggapan = mysqli_query($koneksi,"SELECT * FROM survey where ID_DIVISI = '$bid' and year(TANGGAL_SURVEY) = '2022' and TANGGAPAN = 'KURANG PUAS'");
					echo mysqli_num_rows($jumlah_tanggapan);
					?>,
					<?php 
					$jumlah_tanggapan = mysqli_query($koneksi,"SELECT * FROM survey where ID_DIVISI = '$bid' and year(TANGGAL_SURVEY) = '2023' and TANGGAPAN = 'KURANG PUAS'");
					echo mysqli_num_rows($jumlah_tanggapan);
					?>,
					<?php 
					$jumlah_tanggapan = mysqli_query($koneksi,"SELECT * FROM survey where ID_DIVISI = '$bid' and year(TANGGAL_SURVEY) = '2024' and TANGGAPAN = 'KURANG PUAS'");
					echo mysqli_num_rows($jumlah_tanggapan);
					?>,
					<?php 
					$jumlah_tanggapan = mysqli_query($koneksi,"SELECT * FROM survey where ID_DIVISI = '$bid' and year(TANGGAL_SURVEY) = '2025' and TANGGAPAN = 'KURANG PUAS'");
					echo mysqli_num_rows($jumlah_tanggapan);
					?>
	            ],
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

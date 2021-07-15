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
    
    if(isset($_GET['bulan'])){
    	$bulan = $_GET['bulan'];
    	$tahun = $_GET['tahun'];
    }else{
    	$bulan = date("m");
    	$tahun = date("Y");
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
     	Rekap Hasil Bulanan
	  </div>
	  <div class="card-body">
	    <div class = "container">
		    <form class="form-inline" method="GET" action="">
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
        <div class = "row">
          <div class = "col-md-4 mt-5">
          	<!-- grafik -->
            <div class = "card">
              <div class = "card-body">
                <h5 class = "card-title">Asisten Pembinaan</h5>
                <canvas id="asbinChart"></canvas>
              </div>
            </div>
          </div>
          <div class = "col-md-4 mt-5">
            <div class = "card">
                <div class = "card-body">
                  <h5 class = "card-title">Kepegawaian</h5>
                  <canvas id="kepegawaianChart"></canvas>
                </div>
              </div>
          </div>
          <div class = "col-md-4 mt-5">
            <div class = "card">
              <div class = "card-body">
                <h5 class = "card-title">Keuangan</h5>
                <canvas id="keuanganChart"></canvas>
              </div>
            </div>
          </div>
          <div class = "col-md-4 mt-3">
            <div class = "card">
              <div class = "card-body">
                <h5 class = "card-title">Umum</h5>
                <canvas id="umumChart"></canvas>
              </div>
            </div>
          </div>
          <div class = "col-md-4 mt-3">
            <div class = "card">
                <div class = "card-body">
                  <h5 class = "card-title">Daskrimti dan Perpustakaan</h5>
                  <canvas id="daskrimtiChart"></canvas>
                </div>
              </div>
          </div>
          <div class = "col-md-4 mt-3">
            <div class = "card">
              <div class = "card-body">
                <h5 class = "card-title">Perencanaan</h5>
                <canvas id="perencanaanChart"></canvas>
              </div>
            </div>
          </div>
        </div>
    </div>
	  </div>
	</div>
    
    
	 <footer class="text-center text-white mt-3 bt-2 pb-2 pt-2" style="background-color: #654321;">
	 	Kejaksaan Tinggi Jawa Timur 2021
	 </footer>

    <script>
		var asbin = document.getElementById("asbinChart").getContext('2d');
	    var kepegawaian = document.getElementById("kepegawaianChart").getContext('2d');
	    var keuangan = document.getElementById("keuanganChart").getContext('2d');
	    var umum = document.getElementById("umumChart").getContext('2d');
	    var daskrimti = document.getElementById("daskrimtiChart").getContext('2d');
	    var perencanaan = document.getElementById("perencanaanChart").getContext('2d');

    var mChart = new Chart(asbin, {
			type: 'bar',
			data: {
				labels: ["Sangat Puas","Puas","Tidak Puas"],
				datasets: [{
					label: '',
					data: [
            <?php 
					$jumlah_tanggapan = mysqli_query($koneksi,"SELECT * FROM survey where ID_DIVISI = '1' and month(TANGGAL_SURVEY) = '$bulan' and year(TANGGAL_SURVEY) = '$tahun' and TANGGAPAN = 'SANGAT PUAS'");
					echo mysqli_num_rows($jumlah_tanggapan);
					?>,
          <?php 
					$jumlah_tanggapan = mysqli_query($koneksi,"SELECT * FROM survey where ID_DIVISI = '1' and month(TANGGAL_SURVEY) = '$bulan' and year(TANGGAL_SURVEY) = '$tahun' and TANGGAPAN = 'PUAS'");
					echo mysqli_num_rows($jumlah_tanggapan);
					?>,
          <?php 
					$jumlah_tanggapan = mysqli_query($koneksi,"SELECT * FROM survey where ID_DIVISI = '1' and month(TANGGAL_SURVEY) = '$bulan' and year(TANGGAL_SURVEY) = '$tahun' and TANGGAPAN = 'KURANG PUAS'");
					echo mysqli_num_rows($jumlah_tanggapan);
					?>
					],
					backgroundColor: [
					'rgba(0, 122, 255, 0.7)',
					'rgba(39, 168, 68, 0.7)',
					'rgba(220, 53, 70, 0.7)'
					],
					borderColor: [
					'rgba(0, 122, 255, 1)',
					'rgba(39, 168, 68, 1)',
					'rgba(220, 53, 70, 1)'
					],
					borderWidth: 1
				}]
			},
			options: {
				scales: {
					yAxes: [{
						ticks: {
							beginAtZero:true
						}
					}]
				}
			}
		});
    var mChart = new Chart(kepegawaian, {
			type: 'bar',
			data: {
				labels: ["Sangat Puas","Puas","Tidak Puas"],
				datasets: [{
					label: '',
					data: [
            <?php 
					$jumlah_tanggapan = mysqli_query($koneksi,"SELECT * FROM survey where ID_DIVISI = '2' and month(TANGGAL_SURVEY) = '$bulan' and year(TANGGAL_SURVEY) = '$tahun' and TANGGAPAN = 'SANGAT PUAS'");
					echo mysqli_num_rows($jumlah_tanggapan);
					?>,
          <?php 
					$jumlah_tanggapan = mysqli_query($koneksi,"SELECT * FROM survey where ID_DIVISI = '2' and month(TANGGAL_SURVEY) = '$bulan' and year(TANGGAL_SURVEY) = '$tahun' and TANGGAPAN = 'PUAS'");
					echo mysqli_num_rows($jumlah_tanggapan);
					?>,
          <?php 
					$jumlah_tanggapan = mysqli_query($koneksi,"SELECT * FROM survey where ID_DIVISI = '2' and month(TANGGAL_SURVEY) = '$bulan' and year(TANGGAL_SURVEY) = '$tahun' and TANGGAPAN = 'KURANG PUAS'");
					echo mysqli_num_rows($jumlah_tanggapan);
					?>
					],
					backgroundColor: [
					'rgba(0, 122, 255, 0.7)',
					'rgba(39, 168, 68, 0.7)',
					'rgba(220, 53, 70, 0.7)'
					],
					borderColor: [
					'rgba(0, 122, 255, 1)',
					'rgba(39, 168, 68, 1)',
					'rgba(220, 53, 70, 1)'
					],
					borderWidth: 1
				}]
			},
			options: {
				scales: {
					yAxes: [{
						ticks: {
							beginAtZero:true
						}
					}]
				}
			}
		});
    var mChart = new Chart(keuangan, {
			type: 'bar',
			data: {
				labels: ["Sangat Puas","Puas","Tidak Puas"],
				datasets: [{
					label: '',
					data: [
            <?php 
					$jumlah_tanggapan = mysqli_query($koneksi,"SELECT * FROM survey where ID_DIVISI = '3' and month(TANGGAL_SURVEY) = '$bulan' and year(TANGGAL_SURVEY) = '$tahun' and TANGGAPAN = 'SANGAT PUAS'");
					echo mysqli_num_rows($jumlah_tanggapan);
					?>,
          <?php 
					$jumlah_tanggapan = mysqli_query($koneksi,"SELECT * FROM survey where ID_DIVISI = '3' and month(TANGGAL_SURVEY) = '$bulan' and year(TANGGAL_SURVEY) = '$tahun' and TANGGAPAN = 'PUAS'");
					echo mysqli_num_rows($jumlah_tanggapan);
					?>,
          <?php 
					$jumlah_tanggapan = mysqli_query($koneksi,"SELECT * FROM survey where ID_DIVISI = '3' and month(TANGGAL_SURVEY) = '$bulan' and year(TANGGAL_SURVEY) = '$tahun' and TANGGAPAN = 'KURANG PUAS'");
					echo mysqli_num_rows($jumlah_tanggapan);
					?>
					],
					backgroundColor: [
					'rgba(0, 122, 255, 0.7)',
					'rgba(39, 168, 68, 0.7)',
					'rgba(220, 53, 70, 0.7)'
					],
					borderColor: [
					'rgba(0, 122, 255, 1)',
					'rgba(39, 168, 68, 1)',
					'rgba(220, 53, 70, 1)'
					],
					borderWidth: 1
				}]
			},
			options: {
				scales: {
					yAxes: [{
						ticks: {
							beginAtZero:true
						}
					}]
				}
			}
		});
    var mChart = new Chart(umum, {
			type: 'bar',
			data: {
				labels: ["Sangat Puas","Puas","Tidak Puas"],
				datasets: [{
					label: '',
					data: [
            <?php 
					$jumlah_tanggapan = mysqli_query($koneksi,"SELECT * FROM survey where ID_DIVISI = '4' and month(TANGGAL_SURVEY) = '$bulan' and year(TANGGAL_SURVEY) = '$tahun' and TANGGAPAN = 'SANGAT PUAS'");
					echo mysqli_num_rows($jumlah_tanggapan);
					?>,
          <?php 
					$jumlah_tanggapan = mysqli_query($koneksi,"SELECT * FROM survey where ID_DIVISI = '4' and month(TANGGAL_SURVEY) = '$bulan' and year(TANGGAL_SURVEY) = '$tahun' and TANGGAPAN = 'PUAS'");
					echo mysqli_num_rows($jumlah_tanggapan);
					?>,
          <?php 
					$jumlah_tanggapan = mysqli_query($koneksi,"SELECT * FROM survey where ID_DIVISI = '4' and month(TANGGAL_SURVEY) = '$bulan' and year(TANGGAL_SURVEY) = '$tahun' and TANGGAPAN = 'KURANG PUAS'");
					echo mysqli_num_rows($jumlah_tanggapan);
					?>
					],
					backgroundColor: [
					'rgba(0, 122, 255, 0.7)',
					'rgba(39, 168, 68, 0.7)',
					'rgba(220, 53, 70, 0.7)'
					],
					borderColor: [
					'rgba(0, 122, 255, 1)',
					'rgba(39, 168, 68, 1)',
					'rgba(220, 53, 70, 1)'
					],
					borderWidth: 1
				}]
			},
			options: {
				scales: {
					yAxes: [{
						ticks: {
							beginAtZero:true
						}
					}]
				}
			}
		});
    var mChart = new Chart(daskrimti, {
			type: 'bar',
			data: {
				labels: ["Sangat Puas","Puas","Tidak Puas"],
				datasets: [{
					label: '',
					data: [
            <?php 
					$jumlah_tanggapan = mysqli_query($koneksi,"SELECT * FROM survey where ID_DIVISI = '5' and month(TANGGAL_SURVEY) = '$bulan' and year(TANGGAL_SURVEY) = '$tahun' and TANGGAPAN = 'SANGAT PUAS'");
					echo mysqli_num_rows($jumlah_tanggapan);
					?>,
          <?php 
					$jumlah_tanggapan = mysqli_query($koneksi,"SELECT * FROM survey where ID_DIVISI = '5' and month(TANGGAL_SURVEY) = '$bulan' and year(TANGGAL_SURVEY) = '$tahun' and TANGGAPAN = 'PUAS'");
					echo mysqli_num_rows($jumlah_tanggapan);
					?>,
          <?php 
					$jumlah_tanggapan = mysqli_query($koneksi,"SELECT * FROM survey where ID_DIVISI = '5' and month(TANGGAL_SURVEY) = '$bulan' and year(TANGGAL_SURVEY) = '$tahun' and TANGGAPAN = 'KURANG PUAS'");
					echo mysqli_num_rows($jumlah_tanggapan);
					?>
					],
					backgroundColor: [
					'rgba(0, 122, 255, 0.7)',
					'rgba(39, 168, 68, 0.7)',
					'rgba(220, 53, 70, 0.7)'
					],
					borderColor: [
					'rgba(0, 122, 255, 1)',
					'rgba(39, 168, 68, 1)',
					'rgba(220, 53, 70, 1)'
					],
					borderWidth: 1
				}]
			},
			options: {
				scales: {
					yAxes: [{
						ticks: {
							beginAtZero:true
						}
					}]
				}
			}
		});
    var mChart = new Chart(perencanaan, {
			type: 'bar',
			data: {
				labels: ["Sangat Puas","Puas","Tidak Puas"],
				datasets: [{
					label: '',
					data: [
            <?php 
					$jumlah_tanggapan = mysqli_query($koneksi,"SELECT * FROM survey where ID_DIVISI = '6' and month(TANGGAL_SURVEY) = '$bulan' and year(TANGGAL_SURVEY) = '$tahun' and TANGGAPAN = 'SANGAT PUAS'");
					echo mysqli_num_rows($jumlah_tanggapan);
					?>,
          <?php 
					$jumlah_tanggapan = mysqli_query($koneksi,"SELECT * FROM survey where ID_DIVISI = '6' and month(TANGGAL_SURVEY) = '$bulan' and year(TANGGAL_SURVEY) = '$tahun' and TANGGAPAN = 'PUAS'");
					echo mysqli_num_rows($jumlah_tanggapan);
					?>,
          <?php 
					$jumlah_tanggapan = mysqli_query($koneksi,"SELECT * FROM survey where ID_DIVISI = '6' and month(TANGGAL_SURVEY) = '$bulan' and year(TANGGAL_SURVEY) = '$tahun' and TANGGAPAN = 'KURANG PUAS'");
					echo mysqli_num_rows($jumlah_tanggapan);
					?>
					],
					backgroundColor: [
					'rgba(0, 122, 255, 0.7)',
					'rgba(39, 168, 68, 0.7)',
					'rgba(220, 53, 70, 0.7)'
					],
					borderColor: [
					'rgba(0, 122, 255, 1)',
					'rgba(39, 168, 68, 1)',
					'rgba(220, 53, 70, 1)'
					],
					borderWidth: 1
				}]
			},
			options: {
				scales: {
					yAxes: [{
						ticks: {
							beginAtZero:true
						}
					}]
				}
			}
		});	
	</script>
    <script src="assets/js/bootstrap.min.js"></script>
    
  </body>
</html>

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
    

    if(isset($_GET['date'])){
      $date = $_GET['date'];
    }else{
      $date = date("Y-m-d");
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
	          Hasil Survey Kepuasan Layanan Tiap Divisi
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
     	Rekap Hasil Harian
	  </div>
	  <div class="card-body">
	    <div class = "container">
		    <form class="form-inline">
			  <div class="form-group mb-2">
			    <label for="tgl" class="sr-only">label_tanggal</label>
			    <input type="text" readonly class="form-control-plaintext" id="tgl" value="Masukkan Tanggal">
			  </div>
			  <div class="form-group mx-sm-3 mb-2">
			    <label for="Tanggal" class="sr-only">tanggal</label>
			    <input type="text"  name="date" class="form-control datepicker" placeholder="Tanggal">
			  </div>
			  <button type="submit" class="btn btn-success mb-2">Oke</button>
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

   <script type="text/javascript">
        $(function(){
            $(".datepicker").datepicker({
                format: 'yyyy-mm-dd',
                autoclose: true,
                todayHighlight: true,
            });
        });
    </script>
    <script>
		var asbin = document.getElementById("asbinChart").getContext('2d');
	    var kepegawaian = document.getElementById("kepegawaianChart").getContext('2d');
	    var keuangan = document.getElementById("keuanganChart").getContext('2d');
	    var umum = document.getElementById("umumChart").getContext('2d');
	    var daskrimti = document.getElementById("daskrimtiChart").getContext('2d');
	    var perencanaan = document.getElementById("perencanaanChart").getContext('2d');
		var dChart = new Chart(asbin, {
			type: 'bar',
			data: {
				labels: ["Sangat Puas","Puas","Tidak Puas"],
				datasets: [{
					label: '',
					data: [
          <?php 
					$jumlah_tanggapan = mysqli_query($koneksi,"SELECT * FROM survey where ID_DIVISI = '1' and TANGGAL_SURVEY = '$date'  and TANGGAPAN = 'SANGAT PUAS'");
					echo mysqli_num_rows($jumlah_tanggapan);
					?>,
          <?php 
					$jumlah_tanggapan = mysqli_query($koneksi,"SELECT * FROM survey where ID_DIVISI = '1' and TANGGAL_SURVEY = '$date'  and TANGGAPAN = 'PUAS'");
					echo mysqli_num_rows($jumlah_tanggapan);
					?>,
          <?php 
					$jumlah_tanggapan = mysqli_query($koneksi,"SELECT * FROM survey where ID_DIVISI = '1' and TANGGAL_SURVEY = '$date' and TANGGAPAN = 'KURANG PUAS'");
					echo mysqli_num_rows($jumlah_tanggapan);
					?>
					],
					backgroundColor: [
					'rgba(0, 122, 255, 0.7)',
					'rgba(39, 168, 68, 0.7)',
					'rgba(220, 53, 70, 0.7)'
					],
					borderColor: [
					'rgba(0, 122, 255,1)',
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
    var dChart = new Chart(kepegawaian, {
			type: 'bar',
			data: {
				labels: ["Sangat Puas","Puas","Tidak Puas"],
				datasets: [{
					label: '',
					data: [
          <?php 
					$jumlah_tanggapan = mysqli_query($koneksi,"SELECT * FROM survey where ID_DIVISI = '2' and TANGGAL_SURVEY = '$date'  and TANGGAPAN = 'SANGAT PUAS'");
					echo mysqli_num_rows($jumlah_tanggapan);
					?>,
          <?php 
					$jumlah_tanggapan = mysqli_query($koneksi,"SELECT * FROM survey where ID_DIVISI = '2' and TANGGAL_SURVEY = '$date'  and TANGGAPAN = 'PUAS'");
					echo mysqli_num_rows($jumlah_tanggapan);
					?>,
          <?php 
					$jumlah_tanggapan = mysqli_query($koneksi,"SELECT * FROM survey where ID_DIVISI = '2' and TANGGAL_SURVEY = '$date' and TANGGAPAN = 'KURANG PUAS'");
					echo mysqli_num_rows($jumlah_tanggapan);
					?>
					],
					backgroundColor: [
					'rgba(0, 122, 255, 0.7)',
					'rgba(39, 168, 68, 0.7)',
					'rgba(220, 53, 70, 0.7)'
					],
					borderColor: [
					'rgba(0, 122, 255,1)',
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
    var dChart = new Chart(keuangan, {
			type: 'bar',
			data: {
				labels: ["Sangat Puas","Puas","Tidak Puas"],
				datasets: [{
					label: '',
					data: [
          <?php 
					$jumlah_tanggapan = mysqli_query($koneksi,"SELECT * FROM survey where ID_DIVISI = '3' and TANGGAL_SURVEY = '$date'  and TANGGAPAN = 'SANGAT PUAS'");
					echo mysqli_num_rows($jumlah_tanggapan);
					?>,
          <?php 
					$jumlah_tanggapan = mysqli_query($koneksi,"SELECT * FROM survey where ID_DIVISI = '3' and TANGGAL_SURVEY = '$date'  and TANGGAPAN = 'PUAS'");
					echo mysqli_num_rows($jumlah_tanggapan);
					?>,
          <?php 
					$jumlah_tanggapan = mysqli_query($koneksi,"SELECT * FROM survey where ID_DIVISI = '3' and TANGGAL_SURVEY = '$date' and TANGGAPAN = 'KURANG PUAS'");
					echo mysqli_num_rows($jumlah_tanggapan);
					?>
					],
					backgroundColor: [
					'rgba(0, 122, 255, 0.7)',
					'rgba(39, 168, 68, 0.7)',
					'rgba(220, 53, 70, 0.7)'
					],
					borderColor: [
					'rgba(0, 122, 255,1)',
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
    var dChart = new Chart(umum, {
			type: 'bar',
			data: {
				labels: ["Sangat Puas","Puas","Tidak Puas"],
				datasets: [{
					label: '',
					data: [
          <?php 
					$jumlah_tanggapan = mysqli_query($koneksi,"SELECT * FROM survey where ID_DIVISI = '4' and TANGGAL_SURVEY = '$date'  and TANGGAPAN = 'SANGAT PUAS'");
					echo mysqli_num_rows($jumlah_tanggapan);
					?>,
          <?php 
					$jumlah_tanggapan = mysqli_query($koneksi,"SELECT * FROM survey where ID_DIVISI = '4' and TANGGAL_SURVEY = '$date'  and TANGGAPAN = 'PUAS'");
					echo mysqli_num_rows($jumlah_tanggapan);
					?>,
          <?php 
					$jumlah_tanggapan = mysqli_query($koneksi,"SELECT * FROM survey where ID_DIVISI = '4' and TANGGAL_SURVEY = '$date' and TANGGAPAN = 'KURANG PUAS'");
					echo mysqli_num_rows($jumlah_tanggapan);
					?>
					],
					backgroundColor: [
					'rgba(0, 122, 255, 0.7)',
					'rgba(39, 168, 68, 0.7)',
					'rgba(220, 53, 70, 0.7)'
					],
					borderColor: [
					'rgba(0, 122, 255,1)',
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
    var dChart = new Chart(daskrimti, {
			type: 'bar',
			data: {
				labels: ["Sangat Puas","Puas","Tidak Puas"],
				datasets: [{
					label: '',
					data: [
          <?php 
					$jumlah_tanggapan = mysqli_query($koneksi,"SELECT * FROM survey where ID_DIVISI = '5' and TANGGAL_SURVEY = '$date'  and TANGGAPAN = 'SANGAT PUAS'");
					echo mysqli_num_rows($jumlah_tanggapan);
					?>,
          <?php 
					$jumlah_tanggapan = mysqli_query($koneksi,"SELECT * FROM survey where ID_DIVISI = '5' and TANGGAL_SURVEY = '$date'  and TANGGAPAN = 'PUAS'");
					echo mysqli_num_rows($jumlah_tanggapan);
					?>,
          <?php 
					$jumlah_tanggapan = mysqli_query($koneksi,"SELECT * FROM survey where ID_DIVISI = '5' and TANGGAL_SURVEY = '$date' and TANGGAPAN = 'KURANG PUAS'");
					echo mysqli_num_rows($jumlah_tanggapan);
					?>
					],
					backgroundColor: [
					'rgba(0, 122, 255, 0.7)',
					'rgba(39, 168, 68, 0.7)',
					'rgba(220, 53, 70, 0.7)'
					],
					borderColor: [
					'rgba(0, 122, 255,1)',
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
    var dChart = new Chart(perencanaan, {
			type: 'bar',
			data: {
				labels: ["Sangat Puas","Puas","Tidak Puas"],
				datasets: [{
					label: '',
					data: [
          <?php 
					$jumlah_tanggapan = mysqli_query($koneksi,"SELECT * FROM survey where ID_DIVISI = '6' and TANGGAL_SURVEY = '$date'  and TANGGAPAN = 'SANGAT PUAS'");
					echo mysqli_num_rows($jumlah_tanggapan);
					?>,
          <?php 
					$jumlah_tanggapan = mysqli_query($koneksi,"SELECT * FROM survey where ID_DIVISI = '6' and TANGGAL_SURVEY = '$date'  and TANGGAPAN = 'PUAS'");
					echo mysqli_num_rows($jumlah_tanggapan);
					?>,
          <?php 
					$jumlah_tanggapan = mysqli_query($koneksi,"SELECT * FROM survey where ID_DIVISI = '6' and TANGGAL_SURVEY = '$date' and TANGGAPAN = 'KURANG PUAS'");
					echo mysqli_num_rows($jumlah_tanggapan);
					?>
					],
					backgroundColor: [
					'rgba(0, 122, 255, 0.7)',
					'rgba(39, 168, 68, 0.7)',
					'rgba(220, 53, 70, 0.7)'
					],
					borderColor: [
					'rgba(0, 122, 255,1)',
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

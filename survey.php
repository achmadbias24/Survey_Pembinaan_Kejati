<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="assets\bootstrap-4.0.0\dist\css\bootstrap.min.css">
  <title>SURVEY KEPUASAN PELAYANAN</title>
</head>

<body>
  <style type="text/css">
  .box {
    padding: 30px 40px;
    border-radius: 5px;
  }
  </style>
  <!-- Image and text -->
  <nav class="navbar" style="background-color: #654321; padding: 0px;">
    <a href="index.php"> <img src="img/banner.png" style="width: 110%"> </a>
  </nav>
  <?php
    //panggil koneksi database
    include "koneksi.php";
    $bidang = $_GET['bid'];
    $ket="";
  ?>
    <div class="container">
      <div class="jumbotron jumbotron-fluid text-center mt-4">
        <div class="container">
          <h1 class="display-4 ">Survey Kepuasan Pelayanan Bidang Pembinaan</h1>
          <p class="lead">Isilah survey kepuasan ini sesuai yang Anda rasakan</p>
        </div>
      </div>
      <form>
        <div class="row text-center">
          <div class="col-md-4">
            <a onclick="pilih('sangat_puas')">
              <div class="kotak bg-primary box text-white" id="sangat_puas">
                <div class="row">
                  <div class="col-md-6 mt-2">
                    <h2>SANGAT</h2>
                    <h2>PUAS</h2> </div>
                  <div class="col-md-4"> <img src="img/sangat_puas.png" style="width: 100px;"> </div>
                </div>
              </div>
            </a>
          </div>
          <div class="col-md-4">
            <a onclick="pilih('puas')">
              <div class="kotak bg-success box text-white" id="puas">
                <div class="row">
                  <div class="col-md-6 mt-4">
                    <h2>PUAS</h2> </div>
                  <div class="col-md-4"> <img src="img/puas.png" style="width: 100px;"> </div>
                </div>
              </div>
            </a>
          </div>
          <div class="col-md-4">
            <a onclick="pilih('kurang_puas')">
              <div class="kotak bg-danger box text-white" id="kurang_puas">
                <div class="row">
                  <div class="col-md-6 mt-2">
                    <h2>KURANG</h2>
                    <h2>PUAS</h2> </div>
                  <div class="col-md-4"> <img src="img/kurang.png" style="width: 100px;"> </div>
                </div>
              </div>
            </a>
          </div>
        </div>
        <div class="form-group mt-3">
          <label for="nama">Berikan Komentar Anda</label>
          <input type="text" class="form-control" id="komentar" name="komentar" placeholder="Isikan Komentar Anda"> </div>
        <div class="row">
          <div class="col-md-12"> 
            <button class="btn btn-success btn-xl btn-block" id="tombol">SUBMIT</button>
          </div>
        </div>
      </form>
      <!-- Akhir Row -->
    </div>
    </div>
    <!-- Akhir Container -->
    <footer class="text-center text-white mt-3 bt-2 pb-2 pt-2" style="background-color: #654321;"> Kejaksaan Tinggi Jawa Timur 2021 </footer>
    <script type="text/javascript">
    var keterangan = ''
    document.querySelector('#tombol').addEventListener('click', test1)

    function getParameterByName(name, url = window.location.href) {
      name = name.replace(/[\[\]]/g, '\\$&');
      var regex = new RegExp('[?&]' + name + '(=([^&#]*)|&|#|$)'),
          results = regex.exec(url);
      if (!results) return null;
      if (!results[2]) return '';
      return decodeURIComponent(results[2].replace(/\+/g, ' '));
    }
    function test1(e) {
      e.preventDefault()
      var bidang= getParameterByName('bid');

      if (keterangan) {
        var isi_komentar=document.querySelector('#komentar').value
        var xmlhttp = false;
        try {
         xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
        } catch (e) {
         try {
          xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
         } catch (E) {
          xmlhttp = false;
         }
        }
        if (!xmlhttp && typeof XMLHttpRequest != 'undefined') {
         xmlhttp = new XMLHttpRequest();
        }
        xmlhttp.open("GET","simpan.php?ket=" + keterangan + "&komentar=" + isi_komentar + "&bidang=" + bidang);   // ini untuk di pass ke script php nya
        xmlhttp.onreadystatechange = function() {
          if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {   
            var Result= xmlhttp.responseText;
            document.body.innerHTML=Result
            setTimeout(function() {
              window.location='index.php'
            }, 1000);  
          }
        }
        xmlhttp.send(null);

      }else{
        window.alert('Pilih tingkat kepuasan Anda!')
      }
      console.log(keterangan)
    }

    function pilih(ket) {
      keterangan = ket
      var kotak = document.querySelectorAll('.kotak')
      for (var i = 0; i < kotak.length; i++) {
        kotak[i].style.outline = "none"
      }
      document.querySelector('#' + ket).style.outline = 'thick solid orange'
    }
    </script>
</body>

</html>
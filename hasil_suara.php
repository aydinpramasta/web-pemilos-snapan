<?php
require_once __DIR__ . "/koneksi.php";

session_start();

if ( !isset($_SESSION["login"]) ) {
  header("location:index.php");
  exit;
}
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Hasil Suara OSIS & MPK</title>
  <!-- Chart JS -->
  <script type="text/javascript" src="assets/chart/chart.js"></script>

  <!-- Style -->
  <link rel="stylesheet" href="styles.css">

  <!-- GOOGLE FONTS-->
  <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />

  <!-- Favicon -->
  <link rel="apple-touch-icon" sizes="180x180" href="assets/favicon/apple-touch-icon.png">
  <link rel="icon" type="image/png" sizes="32x32" href="assets/favicon/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="16x16" href="assets/favicon/favicon-16x16.png">
  <link rel="manifest" href="assets/favicon/site.webmanifest">

  <style type="text/css">
   body {
     background-color: #EEEEEE;
     color: #222831;
     margin: 0 20px;
   }

   .admin {
     margin: 40px 0;
   }

   .admin span {
     color: #FFD369;
   }

   section {
     margin: 80px 0;
   }
</style>
</head>
<body>

  <h2 class="admin">Selamat Datang <span>Admin</span></h2>

  <a href="status.php">
    <button class="btn btn-info">Lihat Status DPT</button>
  </a>

  <section class="hasil">
    <div id="page-wrapper" >
      <div id="page-inner">
        <div class="row">
          <div class="col-lg-12">
            <h2><i class="fa fa-chart"> Hasil Suara Pemilihan Ketua Osis</i></h2>   
          </div>
        </div>              
        <!-- /. ROW  -->

        <div style="max-width: 100%; height: auto;">
          <canvas id="osisChart" width="400" height="100"></canvas>

          <script>
            var ctx = document.getElementById("osisChart").getContext('2d');
            var osisChart = new Chart(ctx, {
              type: 'bar',
              data: {
                labels: ["PASLON 1", "PASLON 2", "PASLON 3"],
                datasets: [{
                  label: 'Jumlah Suara',
                  data: [
                  <?php 
                  $paslon1 = mysqli_query($koneksi,"select * from tbl_paslon where nomor_paslon='1'");
                  echo mysqli_num_rows($paslon1);
                  ?>, 
                  <?php 
                  $paslon2 = mysqli_query($koneksi,"select * from tbl_paslon where nomor_paslon='2'");
                  echo mysqli_num_rows($paslon2);
                  ?>, 
                  <?php 
                  $paslon3 = mysqli_query($koneksi,"select * from tbl_paslon where nomor_paslon='3'");
                  echo mysqli_num_rows($paslon3);
                  ?>
                  ],
                  backgroundColor: [
                  'rgba(255, 99, 132, 0.2)',
                  'rgba(54, 162, 235, 0.2)',
                  'rgba(255, 206, 86, 0.2)',
                  'rgba(75, 192, 192, 0.2)'
                  ],
                  borderColor: [
                  'rgba(255,99,132,1)',
                  'rgba(54, 162, 235, 1)',
                  'rgba(255, 206, 86, 1)',
                  'rgba(75, 192, 192, 1)'
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
        </div>
        <div class="row">
          <div class="col-lg-12">
            <h2><i class="fa fa-chart"> Hasil Suara Pemilihan Ketua MPK dan Wakil Ketua MPK</i></h2>   
          </div>
        </div>              
        <!-- /. ROW  -->

        <div style="max-width: 100%; height: auto;">
          <canvas id="mpkChart" width="400" height="100"></canvas>

          <script>
            var ctx = document.getElementById("mpkChart").getContext('2d');
            var mpkChart = new Chart(ctx, {
              type: 'bar',
              data: {
                labels: ["PASLON 1", "PASLON 2"],
                datasets: [{
                  label: 'Jumlah Suara',
                  data: [
                  <?php 
                  $paslon1 = mysqli_query($koneksi,"select * from tbl_mpk where nomor_paslon='1'");
                  echo mysqli_num_rows($paslon1);
                  ?>, 
                  <?php 
                  $paslon2 = mysqli_query($koneksi,"select * from tbl_mpk where nomor_paslon='2'");
                  echo mysqli_num_rows($paslon2);
                  ?>
                  ],
                  backgroundColor: [
                  'rgba(255, 99, 132, 0.2)',
                  'rgba(54, 162, 235, 0.2)',
                  'rgba(255, 206, 86, 0.2)',
                  'rgba(75, 192, 192, 0.2)'
                  ],
                  borderColor: [
                  'rgba(255,99,132,1)',
                  'rgba(54, 162, 235, 1)',
                  'rgba(255, 206, 86, 1)',
                  'rgba(75, 192, 192, 1)'
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
        </div>
      </div>
      <!-- /. ROW  --> 
    </div>
    <!-- /. PAGE INNER  -->
    </div>
    <!-- /. PAGE WRAPPER  -->
    </div>
  </section>
  

<!-- /. WRAPPER  -->
<!-- Bootstrap core JS-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>


</body>
</html>

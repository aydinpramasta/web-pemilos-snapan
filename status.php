<?php
require_once __DIR__ . "/koneksi.php";

session_start();

if ( !isset($_SESSION["login"]) ) {
  header("location:index.php");
  exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Status DPT</title>

    <!-- Style -->
  <link rel="stylesheet" href="styles.css">

  <!-- Favicon -->
  <link rel="apple-touch-icon" sizes="180x180" href="assets/favicon/apple-touch-icon.png">
  <link rel="icon" type="image/png" sizes="32x32" href="assets/favicon/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="16x16" href="assets/favicon/favicon-16x16.png">
  <link rel="manifest" href="assets/favicon/site.webmanifest">

  <style>
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

    <a href="hasil_suara.php">
        <button class="btn btn-info">Kembali</button>
    </a>

    <section class="data">
    <div class="row">
      <div class="col-lg-5 me-5">
        <h3>Data DPT Belum Memilih</h3>  
        <div class="table-responsive">
          <table class="table table-striped table-bordered table-hover">
            <tr>
              <th>NIS</th>
              <th>Nama</th>
              <th>Kelas</th>
              <th>Status</th>
            </tr>
            <?php
              $data_dpt = mysqli_query($koneksi,"SELECT tbl_dpt.nis, tbl_dpt.nama_mhs, tbl_akses.kode_akses AS kelas, tbl_dpt.status FROM tbl_dpt JOIN tbl_akses ON  tbl_dpt.nis = tbl_akses.nis WHERE status='Belum memilih'");
              while($d = mysqli_fetch_array($data_dpt)){
            ?>
            <tr>
              <td><?= $d['nis']; ?></td>
              <td style="text-transform: capitalize;"><?= $d['nama_mhs']; ?></td>
              <td><?= $d['kelas']; ?></td>
              <td><mark style="background-color: yellow;"><b><?= $d['status']; ?></b></mark></td>
            </tr>
            <?php } ?>
          </table>
        </div>
      </div>                  


      <div class="col-lg-6">
        <div class="row">
          <div class="col-lg-12">
            <h3>Data DPT Sudah Memilih</h3>
              <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover">
                  <tr>
                    <th>NIS</th>
                    <th>Nama</th>
                    <th>Kelas</th>
                    <th>Status</th>
                    <th>OSIS</th>
                    <th>MPK</th>
                  </tr>
                  <?php
                    $data_dpt = mysqli_query($koneksi,"SELECT tbl_dpt.nis, tbl_dpt.nama_mhs, tbl_akses.kode_akses AS kelas, tbl_dpt.status, tbl_paslon.nomor_paslon AS osis, tbl_mpk.nomor_paslon AS mpk FROM tbl_dpt JOIN tbl_akses ON tbl_dpt.nis = tbl_akses.nis JOIN tbl_paslon ON tbl_paslon.kode_akses = tbl_akses.kode_akses JOIN tbl_mpk ON tbl_mpk.kode_akses = tbl_akses.kode_akses WHERE status='(Sudah memilih)' order by tbl_dpt.nis ASC");
                    while($d = mysqli_fetch_assoc($data_dpt)){
                  ?>
                  <tr>
                    <td><?= $d['nis']; ?></td>
                    <td><?= $d['nama_mhs']; ?></td>
                    <td><?= $d['kelas']; ?></td>
                    <td><mark style="background-color: #00cc00; color: white;"><b><?= $d['status']; ?></b></mark></td>
                    <td><?= $d['osis']; ?></td>
                    <td><?= $d['mpk']; ?></td>
                  </tr>
                  <?php } ?>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
  </section>
</body>
</html>
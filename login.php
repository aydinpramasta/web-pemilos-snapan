<?php
require_once __DIR__ . "/koneksi.php";

session_start();

if(isset($_POST['login'])){

   $nis = mysqli_real_escape_string($koneksi, $_POST['nis']);
	$kode_akses = mysqli_real_escape_string($koneksi, $_POST['kode_akses']);

	$data_akses = mysqli_query($koneksi, "SELECT * FROM tbl_akses WHERE nis='$nis' AND kode_akses='$kode_akses'");
	$r = mysqli_fetch_assoc($data_akses);
	$nis = $r['nis'];
	$kode_akses = $r['kode_akses'];
	$nama_mhs = $r['nama_mhs'];
	$level = $r['level'];
	if( mysqli_num_rows($data_akses) === 1 ){
		$_SESSION["login"] = true;
		$_SESSION['nis'] = $nis;
		$_SESSION['nama_mhs'] = $nama_mhs;
		$_SESSION['kode_akses'] = $kode_akses;
		$_SESSION['level'] = $level;
		header('location:osis/');
	}
   $error = true;
}
?>

<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="UTF-8" />
      <meta http-equiv="X-UA-Compatible" content="IE=edge" />
      <meta
         name="viewport"
         content="width=device-width, initial-scale=1, shrink-to-fit=no"
      />
      <title>Login</title>
      
      <!-- Style -->
      <link href="styles.css" rel="stylesheet" />

      <!-- Favicon -->
      <link rel="apple-touch-icon" sizes="180x180" href="assets/favicon/apple-touch-icon.png">
      <link rel="icon" type="image/png" sizes="32x32" href="assets/favicon/favicon-32x32.png">
      <link rel="icon" type="image/png" sizes="16x16" href="assets/favicon/favicon-16x16.png">
      <link rel="manifest" href="assets/favicon/site.webmanifest">

      <style>
         .header {
            height: 30vw;
            max-height: 160px;
            border-top-left-radius: 16px;
            border-top-right-radius: 16px;
            background: url(assets/background-2.png) no-repeat;
            background-size: 100% 100%;
            background-size: cover;
         }

         .card {
            border-radius: 16px !important;
            /* Also can take single values to make all sides the same, or 2 values (vert/horz), or 3 values (top/horz/bottom). */
         }

         body {
            background: url(assets/background_1_S.png) no-repeat fixed;
            background-size: 100% 100%;
            background-size: cover;
            background-position: top;
         }
         @media screen and (min-width: 768px) {
            body {
               background: url(assets/background_1.png) no-repeat fixed;
               background-size: 100% 100%;
               background-size: cover;
               background-position: top;
            }
         }
      </style>
   </head>
   <body class="d-flex">
      <div class="container-fluid custom-container-fluid d-md-flex p-0">
         <div class="container align-self-center mt-3 mt-md-0 p-0 px-3 px-md-0">
            <div
               class="
                  card
                  o-hidden
                  border-0
                  shadow-lg
                  col-lg-6 col-md-7 col-sm-9 col-12
                  m-auto
               "
            >
            
               <div class="header px-2 px-sm-3 py-3 p-0 d-flex">
                  <h1
                     class="
                        display-1
                        fw-bold
                        align-self-end
                        custom-heading-primarycolor
                        m-0
                        mx-1
                     "
                  >
                     Masuk
                  </h1>
               </div>

               <form class="user user-login mt-3 px-2 px-sm-3 pb-5" action="" method="post">
               <?php if (isset($error)) : ?>
                  <div class="alert alert-danger" role="alert">
                   Login gagal, Periksa kembali Username dan Kata Sandi!
                  </div>
               <?php endif; ?>
                  <div class="form-group">
                     <label
                        for="nis"
                        class="
                           form-label
                           display-6
                           fw-medium
                           mx-1
                           custom-textfield-label
                        "
                        >Username</label
                     >
                     <input
                        type="text"
                        class="
                           form-control
                           custom-textfield
                           form-control-user
                           display-6
                           py-1
                           px-2
                        "
						name="nis"
                        placeholder="Masukan username ..."
						autocomplete="off"
						required="required"
                     />
                  </div>
                  <div class="form-group mt-2">
                     <label
                        for="kode_akses"
                        class="
                           form-label
                           display-6
                           fw-medium
                           mx-1
                           custom-textfield-label
                        "
                        >Kata Sandi</label
                     >
                     <input
                        type="password"
                        class="
                           form-control
                           custom-textfield
                           form-control-user
                           display-6
                           py-1
                           px-2
                        "
                        id="password"
                        name="kode_akses"
                        placeholder="Masukan kata sandi ..."
						autocomplete="off"
						required="required"
                     />
                  </div>
                  <div class="d-grid gap-2">
                     <button class="btn btn-primary mt-3 py-2" name="login" id="login">
                        Masuk Sekarang
                     </button>
                  </div>
               </form>
            </div>
         </div>
      </div>

      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
      <!-- Core theme JS-->
      <script src="js/scripts.js"></script>
      <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
      <!-- * *                               SB Forms JS                               * *-->
      <!-- * * Activate your form at https://startbootstrap.com/solution/contact-forms * *-->
      <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
      <script src="https://cdn.startbootstrap.com/sb-forms-latest.js"></script>
   </body>
</html>

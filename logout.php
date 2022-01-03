<?php
require_once __DIR__ . "/koneksi.php";

session_start();

if ( !isset($_SESSION["login"]) ) {
  header("location:login.php");
  exit;
}

$nis = $_SESSION['nis'];
$kode_akses= $_SESSION['kode_akses'];

$cekosis = mysqli_num_rows(mysqli_query($koneksi,"SELECT * FROM tbl_paslon WHERE kode_akses='$kode_akses'"));
$cekmpk = mysqli_num_rows(mysqli_query($koneksi,"SELECT * FROM tbl_mpk WHERE kode_akses='$kode_akses'"));

if ($cekosis === 0 || $cekmpk === 0) {
   header("location: osis/");
   exit;
}

   if(isset($_POST['logout'])) {
      session_start();
      session_unset();
      session_destroy();
      header('location:index.html');
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
      <title>Logout</title>
      
      <!-- Style -->
      <link href="styles.css" rel="stylesheet" />

      <!-- Favicon -->
      <link rel="apple-touch-icon" sizes="180x180" href="assets/favicon/apple-touch-icon.png">
      <link rel="icon" type="image/png" sizes="32x32" href="assets/favicon/favicon-32x32.png">
      <link rel="icon" type="image/png" sizes="16x16" href="assets/favicon/favicon-16x16.png">
      <link rel="manifest" href="assets/favicon/site.webmanifest">

      <style>
         .content {
            max-width: 500px;
         }

         .contain {
            height: 100vh;
         }

         .footer {
            position: fixed;
            bottom: 0px;
            width: 100%;
            left: 0;
            right: 0;
         }

         .btn-footer {
            max-width: 500px;
         }

         @media (min-width: 576px) {
            .btn-footer {
               width: 100vw;
            }
         }
      </style>
   </head>
   <body>
      <header class="masthead d-flex justify-content-center">
         <div class="container-fluid position-absolute p-0">
            <div class="row m-0 align-items-center">
               <div class="col-lg-5"></div>
               <div class="col-lg-7 order-first order-lg-last p-0">
                  <div class="masthead-device-mockup">
                     <img
                        class="img d-lg-none custom-photo-size"
                        src="assets/Grafis_8_S.svg"
                        alt="..."
                     />
                     <img
                        class="img-fluid float-end d-none d-lg-block"
                        src="assets/Grafis_8_L.svg"
                        alt="..."
                     />
                  </div>
               </div>
            </div>
         </div>
      </header>
      <section>
         <div
            class="
               container
               position-relative
               p-0
               contain
               d-flex
               justify-content-center
            "
         >
            <div class="p-0 my-sm-auto px-3 mt-5 mt-sm-auto">
               <div class="content p-0 mb-lg-5">
                  <div id="title">
                     <h1 class="display-0 custom-heading-primarycolor">1</h1>
                     <h1 class="display-0 custom-heading-primarycolor">dari</h1>
                     <h1 class="display-0 custom-heading-primarycolor">1000</h1>
                  </div>
                  <div class="mt-3">
                     <p class="lead">
                        Satu suara yang telah kalian berikan akan sangat
                        mempengaruhi hasil pemilihan Ketua OSIS dan Pasangan Calon Wakil & Ketua
                        MPK SMK Negeri 8 Semarang nanti.
                     </p>
                     <p class="lead">
                        Terima kasih telah berkontribusi untuk membangun masa depan SMK Negeri 8 Semarang bersama dengan pemimpin terbaik hasil demokrasi kita bersama.
                     </p>
                     <p class="lead">Seribu perbedaan harus tetap menjadi <br/> satu suara !</p>
                  </div>
                  <div
                     class="d-sm-flex justify-content-center footer py-2 px-3"
                  >
                     <form action="" method="post">
                        <div class="d-grid footer-button align-self-center gap-2">
                           <button
                              id="choose"
                              class="btn btn-primary py-2 btn-footer"
                              data-bs-toggle="modal"
                              data-bs-target="#modal"
                              name="logout"
                           >
                              Keluar
                           </button>
                        </div>
                     </form>
                  </div>
               </div>
            </div>
         </div>
      </section>
   </body>
</html>

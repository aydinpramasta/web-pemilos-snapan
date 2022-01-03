<?php
require_once __DIR__ . "/../koneksi.php";

error_reporting(0);

session_start();

if ( !isset($_SESSION["login"]) ) {
  header("location: ../login.php");
  exit;
}

date_default_timezone_set('Asia/jakarta');
$waktu = date('H:i:sa');
$nis = $_SESSION['nis'];
$kode_akses= $_SESSION['kode_akses'];
$nomor_paslon =$_POST['nomor_paslon'];

$cekosis = mysqli_num_rows(mysqli_query($koneksi,"SELECT * FROM tbl_paslon WHERE kode_akses='$kode_akses'"));
$cekmpk = mysqli_num_rows(mysqli_query($koneksi,"SELECT * FROM tbl_mpk WHERE kode_akses='$kode_akses'"));

if ($cekosis > 0 && $cekmpk > 0) {
   header("location: ../logout.php");
   exit;
}

if ($cekosis > 0 && $cekmpk === 0) {
   header("location: ../mpk/");
   exit;
}

if(isset($_POST['simpan'])) {

    if ($cekosis > 0 ){
   echo"<script>window.alert('Anda tidak bisa melakukan voting lagi')
   window.location='../index.html'</script>";
        } else {
          mysqli_query($koneksi, "UPDATE tbl_dpt SET status='(Sudah Memilih)', waktu='$waktu' WHERE nis='$nis'");
          mysqli_query($koneksi,"INSERT INTO tbl_paslon(kode_akses, nomor_paslon)
            VALUES ('$kode_akses','$nomor_paslon')");

          echo"
          <script src='https://code.jquery.com/jquery-3.5.1.min.js'></script>
          <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
          <script>
          $( document ).ready(function() {
            Swal.fire({
               icon: 'success',
               title: '<h4 class=\"display-3 fw-bold\">' + 'Lanjut Ke Pemilihan MPK' + '</h4>',
              iconColor: '#08387f',
              buttonsStyling: false,
              customClass: { 
                 popup: 'swal2-border-radius my-3',
                 confirmButton: 'btn btn-primary  py-2 px-5'
             }
             }).then(function() {
               window.location='../mpk/';
           })
          })
         </script>";
        }
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
      <title>Pemilihan Ketua OSIS SMKN 8 Semarang</title>
      
      <!-- Style -->
      <link href="../styles.css" rel="stylesheet" />

      <!-- Favicon -->
      <link rel="apple-touch-icon" sizes="180x180" href="../assets/favicon/apple-touch-icon.png">
      <link rel="icon" type="image/png" sizes="32x32" href="../assets/favicon/favicon-32x32.png">
      <link rel="icon" type="image/png" sizes="16x16" href="../assets/favicon/favicon-16x16.png">
      <link rel="manifest" href="../assets/favicon/site.webmanifest">

      <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

     
      <style>
         .par > div {
            flex: 1;
         }
         .header {
            background: url(../assets/background_3_S.png) no-repeat;
            background-size: 100% 100%;
            background-size: cover;
            border-end-end-radius: 6rem;
            border-end-start-radius: 0rem;
            height: 17.5vh !important;
            min-height: 150px;
         }

         @media screen and (min-width: 768px) {
            .header {
               background: url(../assets/background_3.png) no-repeat;
               background-size: 100% 100%;
               background-size: cover;
            }
         }

         .img-paslon {
            object-fit: cover;
            aspect-ratio: 1 /1;
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

         @media (min-width: 768px) {
            .btn-footer {
               width: 100vw;
            }
         }
      </style>
   </head>
   <body>
      <form action="" method="post">
      <div class="container-fluid header">
         <div class="container px-3" style="height: 100%">
            <div class="row d-flex" style="height: 100%">
               <div class="col-7 col-lg-5 d-flex p-0">
                  <div class="align-self-center">
                     <h2 class="display-4 fw-medium ps-2">
                        Pemilihan Ketua
                     </h2>
                     <div class="d-flex ps-2">
                        <div class="p-0 align-self-center">
                           <img
                              class="img-fluid custom-devider-vertical mb-1"
                              src="../assets/Devider_vertical_1.svg"
                              max-width="10px"
                           />
                        </div>
                        <h1
                           class="
                              display-1
                              fw-bold
                              custom-heading-primarycolor
                              ps-2
                           "
                        >
                           OSIS
                        </h1>
                     </div>
                  </div>
               </div>
               <div
                  class="col-5 col-lg-7 pt-5 p-0 d-flex justify-content-end"
                  style="height: 100%"
               >
                  <img
                     class="img-fluid custom-grafis-7"
                     src="../assets/grafis_7.svg"
                  />
               </div>
            </div>
         </div>
      </div>
            <div class="container mt-3 px-3  pb-7">
               <div id="input" class="row gap-2 justify-content-lg-around">
                  <?php
                        $data_paslon = mysqli_query($koneksi,"SELECT * FROM data_paslon");
                        while($d = mysqli_fetch_array($data_paslon)){
                  ?>
                  <div class="col-lg p-0">
                     <label class="card">
                        <input class="radio" type="radio" required="required" name="nomor_paslon" value="<?= $d['no_urut']; ?>" />
                        <span class="row p-2 m-0 gap-2 plan-details">
                           <div class="col p-0">
                              <img
                                 class="img-fluid img-paslon"
                                 style="height: 100%; border-radius: 16px"
                                 src="<?= "foto/" . $d["gambar"] ?>"
                              />
                           </div>
                           <div
                              class="
                                 col-7
                                 p-0
                                 flex-sm-grow-1 flex-lg-grow-0
                                 align-self-center
                              "
                           >
                              <h6 class="display-6 fw-bold mt-1">Caketos <?= $d['no_urut']; ?></h6>
                              <h4 class="display-4 max-line fw-medium mt-1">
                                 <?= $d['nm_paslon_ketua']; ?>
                              </h4>
                              <p class="lead-2 max-line">
                                 <?= $d['slogan']; ?>
                              </p>
                           </div>
                        </span>
                     </label>
                  </div>
                  <?php } ?>
               </div>
            </div>

            <div
               class="container d-md-flex justify-content-center footer py-2 px-3"
               style="background-color: white"
            >
               <div class="d-grid footer-button align-self-center gap-2">
                  <button
                     id="choose"
                     class="btn btn-primary py-2 btn-footer"
                     type="button"
                     data-bs-toggle="modal"
                     data-bs-target="#modal"
                     value="Pilih Paslon"
                     disabled
                  >
                     Pilih Caketos <?= $d['no_urut']; ?>
                  </button>
               </div>
            </div>
         

            <div
         id="modal"
         class="modal fade"
         aria-labelledby="modal-title"
         aria-hidden="true"
         tabindex="-1"
      >
         <div class="modal-dialog modal-dialog-centered mx-3 mx-sm-auto">
            <div class="modal-content px-2 py-3 m-0">
               <div class="modal-header px-0 d-flex justify-content-center">
                  <h5 class="modal-title display-4 fw-bold text-center">
                     Konfirmasi
                  </h5>
               </div>
               <div class="modal-body p-0 m-0 mt-1">
                  <p class="modal-body-text lead text-center m-0">
                     Kamu hanya dapat memilih sekali. Jika kamu melanjutkan ini,
                     pilihan kamu tidak bisa diganti.
                  </p>
               </div>
               <div
                  class="
                     modal-footer
                     px-0
                     m-0
                     p-0
                     mt-3
                     d-flex
                     justify-content-center
                     gap-2
                  "
               >
                  <button
                     type="button"
                     class="btn btn-secondary py-2 px-2"
                     data-bs-dismiss="modal"
                  >
                     Batalkan
                  </button>
                  <button type="submit" name="simpan" class="btn btn-primary py-2 px-5">
                     Yakin Pilih
                  </button>
               </div>
            </div>
         </div>
      </div>
      </form>
      
      <script
         src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"
         integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB"
         crossorigin="anonymous"
      ></script>
      <script
         src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"
         integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13"
         crossorigin="anonymous"
      ></script>
      <script>
         let result;

         var myModal = new bootstrap.Modal(document.getElementById("modal"));
         myModal.handleUpdate();

         var exampleModal = document.getElementById("modal");
         exampleModal.addEventListener("show.bs.modal", function (event) {
            // Button that triggered the modal
            var button = event.relatedTarget;
            // Extract info from data-bs-* attributes
            var recipient = result;
            // If necessary, you could initiate an AJAX request here
            // and then do the updating in a callback.
            //
            // Update the modal's content.
            var modalTitle = exampleModal.querySelector(".modal-title");
            var modalBodyInput =
               exampleModal.querySelector(".modal-body input");

            modalTitle.textContent = "Yakin Ingin Memilih " + recipient + " ?";
            modalBodyInput.value = recipient;
         });

         var $radio = $("input:radio");
         $radio.change(function () {
            if ($radio.filter(":checked").length > 0) {
               $("#choose").removeAttr("disabled");
               if ($radio.filter(":checked").val() == 1) {
                  result = "Caketos 1";
               } else if ($radio.filter(":checked").val() == 2) {
                  result = "Caketos 2";
               } else if ($radio.filter(":checked").val() == 3) {
                  result = "Caketos 3";
               }
               document.querySelector("#choose").textContent =
                  "Pilih " + result;
            } else {
               $("#choose").attr("disabled", "disabled");
            }
         });
      </script>
   </body>
</html>

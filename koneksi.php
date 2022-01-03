<?php 
// hide error message
// error_reporting(0);

$koneksi = mysqli_connect("localhost","root","","pemilos");

if (mysqli_connect_error()){
	echo "koneksi database gagal " . mysqli_connect_error();
}

?>

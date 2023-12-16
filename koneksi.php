<?php
$koneksi = mysqli_connect("localhost","root","","project3_brian");

if (!$koneksi) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}

?>
<?php
// koneksi.php

$host     = "localhost";
$username = "root";
$password = "";
$database = "db_uas_pbo_ti1c_qonitahilyatulfirdausa"; // <-- Ganti dengan nama DB ujianmu

$koneksi = mysqli_connect($host, $username, $password, $database);

// Validasi koneksi untuk memastikan tidak ada error
if (!$koneksi) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}
?>

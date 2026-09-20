<?php
// Konfigurasi Database
$host     = "localhost";
$user     = "root";
$password = "";
$database = "db_ujikom";

// Membuat koneksi ke database MySQL
$conn = mysqli_connect($host, $user, $password, $database);

// Cek status koneksi
if (!$conn) {
    die("Koneksi ke database gagal: " . mysqli_connect_error());
}
?>

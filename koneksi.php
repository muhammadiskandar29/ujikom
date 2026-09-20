<?php
// Koneksi database MySQL
$conn = mysqli_connect("localhost", "root", "", "db_ujikom");

// Cek koneksi
if (!$conn) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}
?>

<?php
include 'koneksi.php';

$nisn = $_GET['nisn'];
mysqli_query($conn, "DELETE FROM tb_siswa WHERE nisn='$nisn'");
header("Location: siswa.php");
?>

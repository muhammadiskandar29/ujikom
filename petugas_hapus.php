<?php
include 'koneksi.php';

$id = $_GET['id'];
mysqli_query($conn, "DELETE FROM tb_petugas WHERE id_petugas='$id'");
header("Location: petugas.php");
?>

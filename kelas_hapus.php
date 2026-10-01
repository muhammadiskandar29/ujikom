<?php
include 'koneksi.php';

$id = $_GET['id'];
mysqli_query($conn, "DELETE FROM tb_kelas WHERE id_kelas='$id'");
header("Location: kelas.php");
?>

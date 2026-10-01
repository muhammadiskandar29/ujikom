<?php
include 'koneksi.php';

$id = $_GET['id'];
mysqli_query($conn, "DELETE FROM tb_spp WHERE id_spp='$id'");
header("Location: spp.php");
?>

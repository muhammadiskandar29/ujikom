<?php
include 'koneksi.php';

$id = $_GET['id'];
mysqli_query($conn, "DELETE FROM tb_pembayaran WHERE id_pembayaran='$id'");
header("Location: pembayaran.php");
?>

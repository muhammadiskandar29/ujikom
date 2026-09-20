<?php
include 'koneksi.php';
$id = (int)$_GET['id'];
mysqli_query($conn, "DELETE FROM anggota WHERE id='$id'");
header("Location: index.php");
?>

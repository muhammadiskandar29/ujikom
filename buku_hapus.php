<?php
include 'koneksi.php';
$id = (int)$_GET['id'];
mysqli_query($conn, "UPDATE buku SET is_delete=1 WHERE id='$id'");
header("Location: buku.php");
?>

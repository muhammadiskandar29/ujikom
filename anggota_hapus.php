<?php
include 'koneksi.php';
$id = (int)$_GET['id'];
mysqli_query($conn, "UPDATE anggota SET is_delete=1 WHERE id='$id'");
header("Location: index.php");
?>

<?php
session_start();
include 'koneksi.php';

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$updated_by = $_SESSION['user']['nama'];

// Soft Delete Buku
$query = "UPDATE buku SET is_delete = 1, updated_by = '$updated_by', updated_at = NOW() WHERE id = '$id'";
mysqli_query($conn, $query);

echo "<script>alert('Buku berhasil dihapus (Soft Delete)!'); window.location='buku.php';</script>";
?>

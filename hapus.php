<?php
session_start();
include 'koneksi.php';

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$updated_by = $_SESSION['user']['nama'];

// Soft Delete (hanya ubah is_delete menjadi 1)
$query = "UPDATE siswa SET is_delete = 1, updated_by = '$updated_by', updated_at = NOW() WHERE id = '$id'";
mysqli_query($conn, $query);

// Jika menghapus akun sendiri, logout otomatis
if ($_SESSION['user']['id'] == $id) {
    session_destroy();
    header("Location: login.php");
    exit();
}

echo "<script>alert('Data berhasil dihapus (Soft Delete)!'); window.location='index.php';</script>";
?>

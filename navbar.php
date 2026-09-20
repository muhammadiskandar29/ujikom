<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Perpustakaan</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body class="p-4">

<nav class="navbar navbar-expand-lg navbar-dark bg-primary mb-4 p-3 rounded">
    <div class="container-fluid">
        <a class="navbar-brand" href="index.php">Perpustakaan</a>
        <div class="navbar-nav me-auto">
            <a class="nav-link" href="index.php">Data Anggota</a>
            <a class="nav-link" href="buku.php">Data Buku</a>
            <a class="nav-link" href="peminjaman.php">Peminjaman</a>
        </div>
        <div class="text-white">
            Halo, <?php echo $_SESSION['user']['nama']; ?> | 
            <a href="logout.php" class="text-white" onclick="return confirm('Yakin ingin logout?')">Logout</a>
        </div>
    </div>
</nav>

<div class="container-fluid">

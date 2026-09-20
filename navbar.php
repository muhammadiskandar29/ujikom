<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Cek apakah user sudah login
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}
$current_page = basename($_SERVER['PHP_SELF']);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Perpustakaan</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<!-- Navbar Sederhana -->
<nav class="navbar navbar-expand-lg navbar-dark bg-primary mb-4 shadow-sm">
    <div class="container">
        <a class="navbar-brand fw-bold" href="index.php">Perpustakaan</a>
        <div class="navbar-nav me-auto">
            <a class="nav-link <?= in_array($current_page, ['index.php', 'anggota_tambah.php', 'anggota_edit.php']) ? 'active fw-bold' : ''; ?>" href="index.php">Data Anggota</a>
            <a class="nav-link <?= in_array($current_page, ['buku.php', 'buku_tambah.php', 'buku_edit.php']) ? 'active fw-bold' : ''; ?>" href="buku.php">Data Buku</a>
            <a class="nav-link <?= in_array($current_page, ['peminjaman.php', 'pinjam_tambah.php']) ? 'active fw-bold' : ''; ?>" href="peminjaman.php">Transaksi Peminjaman</a>
        </div>
        <div class="d-flex align-items-center text-white gap-3">
            <span>Halo, <b><?= htmlspecialchars($_SESSION['user']['nama']); ?></b></span>
            <a href="logout.php" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin logout?')">Logout</a>
        </div>
    </div>
</nav>

<div class="container pb-5">

<?php
if (session_status() === PHP_SESSION_NONE) session_start();
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Sistem Perpustakaan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<nav class="navbar navbar-expand-lg navbar-dark bg-primary mb-4 shadow-sm">
    <div class="container">
        <a class="navbar-brand fw-bold" href="index.php">Perpustakaan</a>
        <div class="navbar-nav me-auto">
            <a class="nav-link" href="index.php">Data Anggota</a>
            <a class="nav-link" href="buku.php">Data Buku</a>
            <a class="nav-link" href="peminjaman.php">Peminjaman Buku</a>
        </div>
        <div class="text-white d-flex align-items-center gap-3">
            <span>Halo, <b><?= $_SESSION['user']['nama']; ?></b></span>
            <a href="logout.php" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin logout?')">Logout</a>
        </div>
    </div>
</nav>

<div class="container pb-5">

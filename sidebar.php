<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}
$current_page = basename($_SERVER['PHP_SELF']);
$nama_petugas = $_SESSION['user']['nama_petugas'] ?? $_SESSION['user']['nama'] ?? 'Petugas';
$level_user   = $_SESSION['user']['level'] ?? 'Admin';
?>
<!DOCTYPE html>
<html>
<head>
    <title>Aplikasi Pembayaran SPP</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <style>
        body { min-height: 100vh; }
        .sidebar { width: 230px; min-height: 100vh; background-color: #f8f9fa; border-right: 1px solid #dee2e6; }
        .sidebar .nav-link { color: #333; padding: 8px 12px; margin-bottom: 3px; font-size: 15px; }
        .sidebar .nav-link:hover { background-color: #e9ecef; }
        .sidebar .nav-link.active { background-color: #0d6efd; color: white !important; }
    </style>
</head>
<body>

<div class="d-flex">
    <div class="sidebar p-3 d-flex flex-column flex-shrink-0">
        <h5 class="fw-bold mb-3 border-bottom pb-2">SPP Sekolah</h5>
        
        <div class="small text-muted mb-3">
            Halo, <strong><?= $nama_petugas; ?></strong><br>
            <span class="badge bg-primary"><?= ucfirst($level_user); ?></span>
        </div>

        <ul class="nav nav-pills flex-column mb-auto">
            <li class="nav-item">
                <a href="index.php" class="nav-link <?= $current_page == 'index.php' ? 'active' : '' ?>">Dashboard</a>
            </li>
            <li>
                <a href="spp.php" class="nav-link <?= strpos($current_page, 'spp') !== false ? 'active' : '' ?>">Data SPP</a>
            </li>
            <li>
                <a href="kelas.php" class="nav-link <?= strpos($current_page, 'kelas') !== false ? 'active' : '' ?>">Data Kelas</a>
            </li>
            <li>
                <a href="siswa.php" class="nav-link <?= strpos($current_page, 'siswa') !== false ? 'active' : '' ?>">Data Siswa</a>
            </li>
            <li>
                <a href="petugas.php" class="nav-link <?= strpos($current_page, 'petugas') !== false ? 'active' : '' ?>">Data Petugas</a>
            </li>
            <li class="nav-item mt-2 pt-2 border-top">
                <span class="text-muted small px-3 fw-bold">TRANSAKSI</span>
            </li>
            <li>
                <a href="pembayaran.php" class="nav-link <?= in_array($current_page, ['pembayaran.php', 'pembayaran_tambah.php', 'pembayaran_detail.php']) ? 'active' : '' ?>">Transaksi Pembayaran</a>
            </li>
            <li>
                <a href="cek_pembayaran.php" class="nav-link <?= $current_page == 'cek_pembayaran.php' ? 'active' : '' ?>">Cek Pembayaran</a>
            </li>
        </ul>
        
        <hr>
        <a href="logout.php" class="btn btn-outline-danger btn-sm w-100" onclick="return confirm('Yakin ingin logout?')">Logout</a>
    </div>

    <div class="flex-grow-1 p-4" style="min-width: 0;">

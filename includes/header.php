<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Proteksi Halaman: Jika belum login, redirect ke login.php
if (!isset($_SESSION['user'])) {
    header("Location: login.php?pesan=belum_login");
    exit();
}

$current_user = $_SESSION['user'];
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($page_title) ? htmlspecialchars($page_title) . ' - SIM Siswa' : 'SIM Siswa - PHP Native'; ?></title>
    
    <!-- Google Fonts (Poppins) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f4f6f9;
            color: #333;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }
        .navbar-brand {
            font-weight: 700;
            letter-spacing: 0.5px;
        }
        .main-content {
            flex: 1 0 auto;
        }
        .card {
            border: none;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
        }
        .card-header {
            border-top-left-radius: 12px !important;
            border-top-right-radius: 12px !important;
        }
        .btn {
            border-radius: 8px;
            font-weight: 500;
        }
        .form-control, .form-select {
            border-radius: 8px;
            padding: 0.6rem 0.9rem;
        }
        .form-control:focus, .form-select:focus {
            box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.15);
        }
        .table th {
            font-weight: 600;
            background-color: #f8fafc;
        }
        footer {
            flex-shrink: 0;
        }
        .user-badge {
            background-color: rgba(255, 255, 255, 0.15);
            border-radius: 50px;
            padding: 0.35rem 0.85rem;
            color: #fff;
            font-size: 0.9rem;
        }
    </style>
</head>
<body>

    <!-- Navbar Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm mb-4">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center gap-2" href="index.php">
                <i class="bi bi-mortarboard-fill fs-4"></i>
                <span>SIM Siswa</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link <?= (basename($_SERVER['PHP_SELF']) == 'index.php') ? 'active' : ''; ?>" href="index.php">
                            <i class="bi bi-people me-1"></i> Data Siswa
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= (basename($_SERVER['PHP_SELF']) == 'tambah.php') ? 'active' : ''; ?>" href="tambah.php">
                            <i class="bi bi-plus-circle me-1"></i> Tambah Siswa
                        </a>
                    </li>
                </ul>
                
                <!-- Info User yang Sedang Login & Logout -->
                <div class="d-flex align-items-center gap-2 mt-3 mt-lg-0">
                    <div class="user-badge d-flex align-items-center gap-2">
                        <i class="bi bi-person-circle fs-5"></i>
                        <span><?= htmlspecialchars($current_user['nama']); ?></span>
                    </div>
                    <a href="logout.php" class="btn btn-sm btn-outline-light d-flex align-items-center gap-1" onclick="return confirm('Apakah Anda yakin ingin keluar?');">
                        <i class="bi bi-box-arrow-right"></i> Logout
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Container -->
    <main class="container main-content mb-5">

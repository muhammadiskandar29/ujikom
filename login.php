<?php
session_start();

// Jika sudah login, redirect langsung ke index.php
if (isset($_SESSION['user'])) {
    header("Location: index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - SIM Siswa</title>

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
            background: linear-gradient(135deg, #0d6efd 0%, #003e9c 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }
        .card-login {
            border: none;
            border-radius: 16px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.2);
            overflow: hidden;
            width: 100%;
            max-width: 440px;
        }
        .btn-primary {
            border-radius: 10px;
            padding: 0.7rem;
            font-weight: 600;
        }
        .form-control {
            border-radius: 10px;
            padding: 0.7rem 1rem;
        }
    </style>
</head>
<body>

    <div class="card card-login bg-white">
        <div class="card-body p-4 p-md-5">
            <div class="text-center mb-4">
                <div class="bg-primary text-white d-inline-flex p-3 rounded-circle mb-3 shadow-sm">
                    <i class="bi bi-mortarboard-fill fs-1"></i>
                </div>
                <h3 class="fw-bold text-dark mb-1">SIM Siswa</h3>
                <p class="text-muted small">Silakan login menggunakan Nama Siswa</p>
            </div>

            <!-- Notifikasi Pesan -->
            <?php if (isset($_GET['pesan'])): ?>
                <?php if ($_GET['pesan'] == 'gagal'): ?>
                    <div class="alert alert-danger alert-dismissible fade show small" role="alert">
                        <i class="bi bi-exclamation-circle-fill me-1"></i> <strong>Login Gagal:</strong> Nama siswa atau password tidak cocok!
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php elseif ($_GET['pesan'] == 'logout'): ?>
                    <div class="alert alert-info alert-dismissible fade show small" role="alert">
                        <i class="bi bi-info-circle-fill me-1"></i> Anda telah berhasil keluar sistem.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php elseif ($_GET['pesan'] == 'belum_login'): ?>
                    <div class="alert alert-warning alert-dismissible fade show small" role="alert">
                        <i class="bi bi-shield-lock-fill me-1"></i> Silakan login terlebih dahulu untuk mengakses sistem.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php endif; ?>
            <?php endif; ?>

            <form action="proses_login.php" method="POST">
                <div class="mb-3">
                    <label for="nama" class="form-label fw-semibold text-secondary small">Nama Siswa</label>
                    <div class="input-group">
                        <span class="input-group-text bg-light text-muted"><i class="bi bi-person"></i></span>
                        <input type="text" class="form-control" id="nama" name="nama" placeholder="Contoh: Ahmad Pratama" required autofocus>
                    </div>
                </div>

                <div class="mb-4">
                    <label for="password" class="form-label fw-semibold text-secondary small">Password</label>
                    <div class="input-group">
                        <span class="input-group-text bg-light text-muted"><i class="bi bi-lock"></i></span>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Masukkan password" required>
                    </div>
                </div>

                <button type="submit" name="login" class="btn btn-primary w-100 mb-3 shadow-sm">
                    <i class="bi bi-box-arrow-in-right me-1"></i> Masuk Sekarang
                </button>
            </form>

            <div class="alert alert-light border small text-muted mb-0">
                <i class="bi bi-lightbulb text-warning me-1"></i> <strong>Akun Percobaan:</strong><br>
                Nama: <code>Ahmad Pratama</code><br>
                Password: <code>123456</code>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
session_start();
include 'koneksi.php';

// Jika sudah login, langsung ke index
if (isset($_SESSION['user'])) {
    header("Location: index.php");
    exit();
}

$pesan = "";

// Proses login jika tombol submit diklik
if (isset($_POST['login'])) {
    $nama     = mysqli_real_escape_string($conn, trim($_POST['nama']));
    $password = trim($_POST['password']);

    // Cari siswa aktif berdasarkan nama
    $query = mysqli_query($conn, "SELECT * FROM siswa WHERE nama = '$nama' AND is_delete = 0 LIMIT 1");

    if (mysqli_num_rows($query) === 1) {
        $user = mysqli_fetch_assoc($query);
        
        // Cek password (bisa hash ataupun teks biasa)
        if (password_verify($password, $user['password']) || $password === $user['password']) {
            $_SESSION['user'] = $user;
            header("Location: index.php");
            exit();
        }
    }
    $pesan = "Nama siswa atau password salah!";
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login - SIM Perpus</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light d-flex align-items-center justify-content-center" style="min-height: 100vh;">

<div class="card shadow-sm p-4" style="width: 100%; max-width: 400px;">
    <h4 class="text-center mb-3 fw-bold text-primary">Login Siswa</h4>

    <?php if (!empty($pesan)): ?>
        <div class="alert alert-danger py-2"><?= $pesan; ?></div>
    <?php endif; ?>

    <form method="POST">
        <div class="mb-3">
            <label class="form-label">Nama Siswa</label>
            <input type="text" name="nama" class="form-control" placeholder="Contoh: Ahmad Pratama" required autofocus>
        </div>
        <div class="mb-3">
            <label class="form-label">Password</label>
            <input type="password" name="password" class="form-control" placeholder="Masukkan password" required>
        </div>
        <button type="submit" name="login" class="btn btn-primary w-100">Masuk</button>
    </form>

    <div class="alert alert-info mt-3 py-2 small mb-0">
        Akun Dummy:<br>
        Nama: <b>Ahmad Pratama</b> | Password: <b>123456</b>
    </div>
</div>

</body>
</html>

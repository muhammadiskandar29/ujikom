<?php
session_start();
include 'koneksi.php';

// cek jika tombol login diklik
if (isset($_POST['login'])) {
    $username = $_POST['username'];
    // encrypt password pakai md5 biar cocok sama database
    $password = md5($_POST['password']);

    // cari user yang username dan passwordnya cocok
    $query = mysqli_query($conn, "SELECT * FROM tb_petugas WHERE username='$username' AND password='$password'");
    $cek = mysqli_num_rows($query);

    // kalau data ditemukan, simpan sesi dan masuk ke dashboard
    if ($cek > 0) {
        $data = mysqli_fetch_array($query);
        $_SESSION['user'] = $data;
        header("Location: index.php");
    } else {
        echo "<script>alert('Username atau password salah!');</script>";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Login - Pembayaran SPP</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <script src="assets/js/bootstrap.bundle.min.js"></script>
</head>
<body class="p-5 bg-light">

<div class="container" style="width: 360px; margin-top: 60px;">
    <div class="card p-4 shadow-sm">
        <h4 class="text-center mb-3">Login SPP</h4>
    <form method="POST">
        <div class="mb-3">
            <label>Username</label>
            <input type="text" name="username" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Password</label>
            <input type="password" name="password" class="form-control" required>
        </div>
        <button type="submit" name="login" class="btn btn-primary w-100">Login</button>
    </form>
    </div>
</div>

</body>
</html>

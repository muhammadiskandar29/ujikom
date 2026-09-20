<?php
session_start();
include 'koneksi.php';

if (isset($_SESSION['user'])) {
    header("Location: index.php");
    exit();
}

$pesan = "";
if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = md5($_POST['password']); // Hashing MD5 sederhana & mudah diingat

    $query = mysqli_query($conn, "SELECT * FROM user WHERE username='$username' AND password='$password'");
    if (mysqli_num_rows($query) > 0) {
        $_SESSION['user'] = mysqli_fetch_assoc($query);
        header("Location: index.php");
        exit();
    } else {
        $pesan = "Username atau password salah!";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Login - Perpus</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light d-flex align-items-center justify-content-center" style="height: 100vh;">

<div class="card p-4 shadow-sm" style="width: 350px;">
    <h4 class="text-center mb-3">Login Admin</h4>

    <?php if ($pesan): ?>
        <div class="alert alert-danger py-2"><?= $pesan; ?></div>
    <?php endif; ?>

    <form method="POST">
        <div class="mb-3">
            <label>Username</label>
            <input type="text" name="username" class="form-control" required autofocus>
        </div>
        <div class="mb-3">
            <label>Password</label>
            <input type="password" name="password" class="form-control" required>
        </div>
        <button type="submit" name="login" class="btn btn-primary w-100">Masuk</button>
    </form>

    <div class="text-muted small text-center mt-3">
        User: <b>admin</b> | Pass: <b>admin</b>
    </div>
</div>

</body>
</html>

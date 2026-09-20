<?php
session_start();
require_once 'config/database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' || isset($_POST['login'])) {
    $nama     = mysqli_real_escape_string($conn, trim($_POST['nama'] ?? ''));
    $password = trim($_POST['password'] ?? '');

    if (empty($nama) || empty($password)) {
        header("Location: login.php?pesan=gagal");
        exit();
    }

    // Ambil data siswa berdasarkan nama yang statusnya aktif (is_delete = 0)
    $query = "SELECT * FROM siswa WHERE nama = '$nama' AND is_delete = 0 LIMIT 1";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) === 1) {
        $user = mysqli_fetch_assoc($result);

        // Verifikasi password (mendukung password_hash & fallback plaintext)
        $is_password_valid = password_verify($password, $user['password']) || ($password === $user['password']);

        if ($is_password_valid) {
            // Set session user
            $_SESSION['user'] = [
                'id'            => $user['id'],
                'nis'           => $user['nis'],
                'nama'          => $user['nama'],
                'jurusan'       => $user['jurusan']
            ];

            header("Location: index.php");
            exit();
        }
    }

    // Jika user tidak ditemukan atau password salah
    header("Location: login.php?pesan=gagal");
    exit();
} else {
    header("Location: login.php");
    exit();
}
?>

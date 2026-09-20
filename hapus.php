<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once 'config/database.php';

// Pastikan user sudah login
if (!isset($_SESSION['user'])) {
    header("Location: login.php?pesan=belum_login");
    exit();
}

// Pastikan parameter id tersedia
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id = mysqli_real_escape_string($conn, $_GET['id']);
    $updated_by = $_SESSION['user']['nama'] ?? 'System';

    // Eksekusi SOFT DELETE: ubah status is_delete menjadi 1 dan catat updated_by & updated_at
    $query = "UPDATE siswa SET 
                is_delete = 1, 
                updated_by = '$updated_by', 
                updated_at = NOW() 
              WHERE id = '$id'";

    if (mysqli_query($conn, $query)) {
        // Jika user menghapus akunnya sendiri, otomatis logout
        if ($_SESSION['user']['id'] == $id) {
            session_unset();
            session_destroy();
            header("Location: login.php?pesan=logout");
            exit();
        }

        header("Location: index.php?pesan=hapus_sukses");
        exit();
    } else {
        header("Location: index.php?pesan=gagal");
        exit();
    }
} else {
    header("Location: index.php");
    exit();
}
?>

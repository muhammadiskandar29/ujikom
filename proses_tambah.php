<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once 'config/database.php';

// Pastikan form dikirim melalui metode POST
if ($_SERVER['REQUEST_METHOD'] === 'POST' || isset($_POST['submit'])) {
    $nis           = mysqli_real_escape_string($conn, trim($_POST['nis'] ?? ''));
    $nama          = mysqli_real_escape_string($conn, trim($_POST['nama'] ?? ''));
    $raw_password  = trim($_POST['password'] ?? '');
    $jenis_kelamin = mysqli_real_escape_string($conn, trim($_POST['jenis_kelamin'] ?? ''));
    $jurusan       = mysqli_real_escape_string($conn, trim($_POST['jurusan'] ?? ''));
    $alamat        = mysqli_real_escape_string($conn, trim($_POST['alamat'] ?? ''));

    // Siapkan created_by dari user yang sedang login
    $created_by    = $_SESSION['user']['nama'] ?? 'System';

    // Password default jika dikosongkan adalah 123456
    if (empty($raw_password)) {
        $raw_password = '123456';
    }
    $password_hashed = password_hash($raw_password, PASSWORD_DEFAULT);

    // Validasi sederhana: Field wajib tidak boleh kosong
    if (empty($nis) || empty($nama) || empty($jenis_kelamin) || empty($jurusan)) {
        header("Location: tambah.php?pesan=gagal");
        exit();
    }

    // Cek apakah NIS sudah pernah digunakan sebelumnya
    $check_nis = mysqli_query($conn, "SELECT id FROM siswa WHERE nis = '$nis'");
    if (mysqli_num_rows($check_nis) > 0) {
        echo "<script>
            alert('Gagal: NIS sudah terdaftar di sistem! Silakan gunakan NIS yang lain.');
            window.location.href = 'tambah.php';
        </script>";
        exit();
    }

    // Query simpan data ke database dengan audit trail (created_by) dan password
    $query = "INSERT INTO siswa (nis, nama, password, jenis_kelamin, jurusan, alamat, is_delete, created_by) 
              VALUES ('$nis', '$nama', '$password_hashed', '$jenis_kelamin', '$jurusan', '$alamat', 0, '$created_by')";

    if (mysqli_query($conn, $query)) {
        header("Location: index.php?pesan=tambah_sukses");
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

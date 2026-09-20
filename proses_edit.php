<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once 'config/database.php';

// Pastikan form dikirim melalui metode POST
if ($_SERVER['REQUEST_METHOD'] === 'POST' || isset($_POST['update'])) {
    $id            = mysqli_real_escape_string($conn, trim($_POST['id'] ?? ''));
    $nis           = mysqli_real_escape_string($conn, trim($_POST['nis'] ?? ''));
    $nama          = mysqli_real_escape_string($conn, trim($_POST['nama'] ?? ''));
    $raw_password  = trim($_POST['password'] ?? '');
    $jenis_kelamin = mysqli_real_escape_string($conn, trim($_POST['jenis_kelamin'] ?? ''));
    $jurusan       = mysqli_real_escape_string($conn, trim($_POST['jurusan'] ?? ''));
    $alamat        = mysqli_real_escape_string($conn, trim($_POST['alamat'] ?? ''));

    // Pengguna yang melakukan update (Audit Trail)
    $updated_by    = $_SESSION['user']['nama'] ?? 'System';

    // Validasi data kosong
    if (empty($id) || empty($nis) || empty($nama) || empty($jenis_kelamin) || empty($jurusan)) {
        header("Location: edit.php?id=$id&pesan=gagal");
        exit();
    }

    // Cek apakah NIS sudah dipakai oleh siswa LAIN
    $check_nis = mysqli_query($conn, "SELECT id FROM siswa WHERE nis = '$nis' AND id != '$id'");
    if (mysqli_num_rows($check_nis) > 0) {
        echo "<script>
            alert('Gagal: NIS sudah digunakan oleh siswa lain!');
            window.location.href = 'edit.php?id=$id';
        </script>";
        exit();
    }

    // Bangun query update (dengan atau tanpa perubahan password)
    if (!empty($raw_password)) {
        $password_hashed = password_hash($raw_password, PASSWORD_DEFAULT);
        $query = "UPDATE siswa SET 
                    nis = '$nis', 
                    nama = '$nama', 
                    password = '$password_hashed',
                    jenis_kelamin = '$jenis_kelamin', 
                    jurusan = '$jurusan', 
                    alamat = '$alamat',
                    updated_by = '$updated_by',
                    updated_at = NOW()
                  WHERE id = '$id'";
    } else {
        $query = "UPDATE siswa SET 
                    nis = '$nis', 
                    nama = '$nama', 
                    jenis_kelamin = '$jenis_kelamin', 
                    jurusan = '$jurusan', 
                    alamat = '$alamat',
                    updated_by = '$updated_by',
                    updated_at = NOW()
                  WHERE id = '$id'";
    }

    if (mysqli_query($conn, $query)) {
        // Jika user yang sedang login memperbarui namanya sendiri, update sessionnya
        if (isset($_SESSION['user']) && $_SESSION['user']['id'] == $id) {
            $_SESSION['user']['nama'] = $nama;
            $_SESSION['user']['nis']  = $nis;
            $_SESSION['user']['jurusan'] = $jurusan;
        }

        header("Location: index.php?pesan=edit_sukses");
        exit();
    } else {
        header("Location: index.php?pesan=gagal");
        exit();
    }
} else {
    // Jika diakses langsung tanpa POST
    header("Location: index.php");
    exit();
}
?>

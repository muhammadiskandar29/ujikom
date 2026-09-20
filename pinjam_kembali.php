<?php
session_start();
include 'koneksi.php';

// Pastikan user sudah login
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$updated_by = $_SESSION['user']['nama'];

// Ambil data peminjaman yang masih berstatus Dipinjam
$query = mysqli_query($conn, "SELECT * FROM peminjaman WHERE id = '$id' AND status = 'Dipinjam' AND is_delete = 0");

if (mysqli_num_rows($query) === 1) {
    $data = mysqli_fetch_assoc($query);
    $id_buku         = $data['id_buku'];
    $jatuh_tempo     = $data['jatuh_tempo'];
    $tanggal_kembali = date('Y-m-d');

    // Hitung denda jika tanggal kembali melewati batas jatuh tempo (3 hari)
    $terlambat = 0;
    $denda     = 0;

    if ($tanggal_kembali > $jatuh_tempo) {
        $tgl_tempo = new DateTime($jatuh_tempo);
        $tgl_kmbli = new DateTime($tanggal_kembali);
        $selisih   = $tgl_tempo->diff($tgl_kmbli)->days;
        $terlambat = $selisih;
        $denda     = $terlambat * 500; // Denda Rp 500 per hari terlambat
    }

    // 1. Tambah kembali stok buku
    mysqli_query($conn, "UPDATE buku SET stok = stok + 1 WHERE id = '$id_buku'");

    // 2. Update status transaksi peminjaman
    $update = "UPDATE peminjaman SET 
                tanggal_kembali = '$tanggal_kembali', 
                status = 'Dikembalikan', 
                terlambat = '$terlambat', 
                denda = '$denda', 
                updated_by = '$updated_by', 
                updated_at = NOW() 
               WHERE id = '$id'";
    
    if (mysqli_query($conn, $update)) {
        if ($denda > 0) {
            $pesan_alert = "Buku berhasil dikembalikan! Terlambat $terlambat hari. Total denda: Rp " . number_format($denda, 0, ',', '.');
        } else {
            $pesan_alert = "Buku berhasil dikembalikan tepat waktu! Denda: Rp 0.";
        }
        echo "<script>alert('$pesan_alert'); window.location='peminjaman.php';</script>";
        exit();
    }
}

header("Location: peminjaman.php");
exit();
?>

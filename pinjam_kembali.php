<?php
include 'koneksi.php';

$id = $_GET['id'];
$query = mysqli_query($conn, "SELECT * FROM peminjaman WHERE id='$id'");
$data = mysqli_fetch_array($query);

$tgl_kembali = date('Y-m-d');
$id_buku     = $data['id_buku'];

// Hitung selisih hari keterlambatan
$selisih = (strtotime($tgl_kembali) - strtotime($data['jatuh_tempo'])) / 86400;

if ($selisih > 0) {
    $denda = $selisih * 500;
} else {
    $denda = 0;
}

// Tambah stok buku kembali
mysqli_query($conn, "UPDATE buku SET stok = stok + 1 WHERE id='$id_buku'");

// Update data peminjaman
$sql = "UPDATE peminjaman SET 
            tanggal_kembali='$tgl_kembali', 
            status='Dikembalikan', 
            denda='$denda' 
        WHERE id='$id'";
mysqli_query($conn, $sql);

header("Location: peminjaman.php");
?>

<?php
include 'koneksi.php';

$id = (int)$_GET['id'];
$query = mysqli_query($conn, "SELECT * FROM peminjaman WHERE id='$id' AND status='Dipinjam'");
$data = mysqli_fetch_assoc($query);

if ($data) {
    $tgl_kembali = date('Y-m-d');
    
    $selisih = (strtotime($tgl_kembali) - strtotime($data['jatuh_tempo'])) / 86400;
    $denda = ($selisih > 0) ? $selisih * 500 : 0;

    mysqli_query($conn, "UPDATE buku SET stok = stok + 1 WHERE id='{$data['id_buku']}'");

    mysqli_query($conn, "UPDATE peminjaman SET 
                            tanggal_kembali='$tgl_kembali', 
                            status='Dikembalikan', 
                            denda='$denda' 
                         WHERE id='$id'");
}

header("Location: peminjaman.php");
?>

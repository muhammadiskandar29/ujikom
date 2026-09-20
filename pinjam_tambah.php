<?php
include 'koneksi.php';
include 'navbar.php';

$pesan = "";

// Proses Transaksi Pinjam
if (isset($_POST['pinjam'])) {
    $id_anggota     = (int)$_POST['id_anggota'];
    $id_buku        = (int)$_POST['id_buku'];
    $tanggal_pinjam = $_POST['tanggal_pinjam'];
    $created_by     = $_SESSION['user']['nama'];

    // Hitung jatuh tempo (tanggal pinjam + 3 hari)
    $jatuh_tempo    = date('Y-m-d', strtotime($tanggal_pinjam . ' + 3 days'));

    // Cek ketersediaan stok buku
    $cek_buku = mysqli_query($conn, "SELECT stok FROM buku WHERE id = '$id_buku' AND is_delete = 0");
    $buku = mysqli_fetch_assoc($cek_buku);

    if ($buku && $buku['stok'] > 0) {
        // Kurangi stok buku sebanyak 1
        mysqli_query($conn, "UPDATE buku SET stok = stok - 1 WHERE id = '$id_buku'");

        // Simpan data transaksi peminjaman
        $query = "INSERT INTO peminjaman (id_anggota, id_buku, tanggal_pinjam, jatuh_tempo, status, is_delete, created_by) 
                  VALUES ('$id_anggota', '$id_buku', '$tanggal_pinjam', '$jatuh_tempo', 'Dipinjam', 0, '$created_by')";
        
        if (mysqli_query($conn, $query)) {
            echo "<script>alert('Peminjaman buku berhasil dicatat! Batas pengembalian: $jatuh_tempo'); window.location='peminjaman.php';</script>";
            exit();
        } else {
            $pesan = "Gagal memproses peminjaman!";
        }
    } else {
        $pesan = "Stok buku ini sedang habis!";
    }
}

// Ambil data anggota aktif
$q_anggota = mysqli_query($conn, "SELECT id, nomor_anggota, nama FROM anggota WHERE is_delete = 0 ORDER BY nama ASC");

// Ambil data buku dengan stok > 0
$q_buku = mysqli_query($conn, "SELECT id, kode_buku, judul, stok FROM buku WHERE is_delete = 0 AND stok > 0 ORDER BY judul ASC");
?>

<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card shadow-sm p-4">
            <h4 class="mb-3">Tambah Transaksi Peminjaman</h4>

            <?php if (!empty($pesan)): ?>
                <div class="alert alert-danger py-2"><?= $pesan; ?></div>
            <?php endif; ?>

            <div class="alert alert-info py-2 small mb-3">
                <i class="bi bi-info-circle me-1"></i>
                Batas waktu pinjam: <b>3 Hari</b>.<br>
                Keterlambatan pengembalian dikenakan denda <b>Rp 500 / hari</b>.
            </div>

            <form method="POST">
                <!-- Pilih Anggota -->
                <div class="mb-3">
                    <label class="form-label">Pilih Anggota</label>
                    <select name="id_anggota" class="form-select" required>
                        <option value="" disabled selected>-- Pilih Anggota --</option>
                        <?php while ($a = mysqli_fetch_assoc($q_anggota)): ?>
                            <option value="<?= $a['id']; ?>"><?= $a['nomor_anggota']; ?> - <?= $a['nama']; ?></option>
                        <?php endwhile; ?>
                    </select>
                </div>

                <!-- Pilih Buku -->
                <div class="mb-3">
                    <label class="form-label">Pilih Buku</label>
                    <select name="id_buku" class="form-select" required>
                        <option value="" disabled selected>-- Pilih Buku (Tersedia) --</option>
                        <?php while ($b = mysqli_fetch_assoc($q_buku)): ?>
                            <option value="<?= $b['id']; ?>"><?= $b['kode_buku']; ?> - <?= $b['judul']; ?> (Sisa Stok: <?= $b['stok']; ?>)</option>
                        <?php endwhile; ?>
                    </select>
                </div>

                <!-- Tanggal Pinjam -->
                <div class="mb-4">
                    <label class="form-label">Tanggal Pinjam</label>
                    <input type="date" name="tanggal_pinjam" class="form-control" value="<?= date('Y-m-d'); ?>" required>
                </div>

                <button type="submit" name="pinjam" class="btn btn-primary">Proses Pinjam</button>
                <a href="peminjaman.php" class="btn btn-secondary">Kembali</a>
            </form>
        </div>
    </div>
</div>

</div>
</body>
</html>

<?php
include 'koneksi.php';
include 'navbar.php';

if (isset($_POST['pinjam'])) {
    $id_anggota     = $_POST['id_anggota'];
    $id_buku        = $_POST['id_buku'];
    $tanggal_pinjam = $_POST['tanggal_pinjam'];

    $jatuh_tempo    = date('Y-m-d', strtotime($tanggal_pinjam . ' + 3 days'));

    mysqli_query($conn, "UPDATE buku SET stok = stok - 1 WHERE id='$id_buku'");

    $sql = "INSERT INTO peminjaman (id_anggota, id_buku, tanggal_pinjam, jatuh_tempo, status) 
            VALUES ('$id_anggota', '$id_buku', '$tanggal_pinjam', '$jatuh_tempo', 'Dipinjam')";
    mysqli_query($conn, $sql);

    header("Location: peminjaman.php");
    exit();
}

$q_anggota = mysqli_query($conn, "SELECT * FROM anggota ORDER BY nama ASC");
$q_buku    = mysqli_query($conn, "SELECT * FROM buku WHERE stok > 0 ORDER BY judul ASC");
?>

<div class="card p-4 shadow-sm mx-auto" style="max-width: 500px;">
    <h4 class="mb-3">Tambah Peminjaman Buku</h4>
    <form method="POST">
        <div class="mb-3">
            <label>Pilih Anggota</label>
            <select name="id_anggota" class="form-select" required>
                <option value="">-- Pilih Anggota --</option>
                <?php while ($a = mysqli_fetch_assoc($q_anggota)): ?>
                    <option value="<?= $a['id']; ?>"><?= $a['nomor_anggota']; ?> - <?= $a['nama']; ?></option>
                <?php endwhile; ?>
            </select>
        </div>
        <div class="mb-3">
            <label>Pilih Buku</label>
            <select name="id_buku" class="form-select" required>
                <option value="">-- Pilih Buku --</option>
                <?php while ($b = mysqli_fetch_assoc($q_buku)): ?>
                    <option value="<?= $b['id']; ?>"><?= $b['judul']; ?> (Stok: <?= $b['stok']; ?>)</option>
                <?php endwhile; ?>
            </select>
        </div>
        <div class="mb-3">
            <label>Tanggal Pinjam</label>
            <input type="date" name="tanggal_pinjam" class="form-control" value="<?= date('Y-m-d'); ?>" required>
            <small class="text-muted">Batas pengembalian otomatis +3 hari.</small>
        </div>
        <button type="submit" name="pinjam" class="btn btn-primary">Proses Pinjam</button>
        <a href="peminjaman.php" class="btn btn-secondary">Kembali</a>
    </form>
</div>

</div>
</body>
</html>

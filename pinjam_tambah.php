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

$query_anggota = mysqli_query($conn, "SELECT * FROM anggota ORDER BY nama ASC");
$query_buku    = mysqli_query($conn, "SELECT * FROM buku WHERE stok > 0 ORDER BY judul ASC");
?>

<div class="card p-4 shadow-sm mx-auto" style="max-width: 500px;">
    <h4 class="mb-3">Tambah Peminjaman Buku</h4>
    <form method="POST">
        <div class="mb-3">
            <label>Pilih Anggota</label>
            <select name="id_anggota" class="form-select" required>
                <option value="">-- Pilih Anggota --</option>
                <?php while ($data_anggota = mysqli_fetch_array($query_anggota)) { ?>
                    <option value="<?php echo $data_anggota['id']; ?>"><?php echo $data_anggota['nomor_anggota']; ?> - <?php echo $data_anggota['nama']; ?></option>
                <?php } ?>
            </select>
        </div>
        <div class="mb-3">
            <label>Pilih Buku</label>
            <select name="id_buku" class="form-select" required>
                <option value="">-- Pilih Buku --</option>
                <?php while ($data_buku = mysqli_fetch_array($query_buku)) { ?>
                    <option value="<?php echo $data_buku['id']; ?>"><?php echo $data_buku['judul']; ?> (Stok: <?php echo $data_buku['stok']; ?>)</option>
                <?php } ?>
            </select>
        </div>
        <div class="mb-3">
            <label>Tanggal Pinjam</label>
            <input type="date" name="tanggal_pinjam" class="form-control" value="<?php echo date('Y-m-d'); ?>" required>
            <small class="text-muted">Batas pengembalian otomatis +3 hari.</small>
        </div>
        <button type="submit" name="pinjam" class="btn btn-primary">Proses Pinjam</button>
        <a href="peminjaman.php" class="btn btn-secondary">Kembali</a>
    </form>
</div>

</div>
</body>
</html>

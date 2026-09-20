<?php
include 'koneksi.php';
include 'navbar.php';

if (isset($_POST['pinjam'])) {
    $id_anggota     = $_POST['id_anggota'];
    $id_buku        = $_POST['id_buku'];
    $tanggal_pinjam = $_POST['tanggal_pinjam'];

    // Batas pengembalian 3 hari
    $jatuh_tempo = date('Y-m-d', strtotime($tanggal_pinjam . ' + 3 days'));

    // Kurangi stok buku
    mysqli_query($conn, "UPDATE buku SET stok = stok - 1 WHERE id='$id_buku'");

    // Simpan peminjaman
    $sql = "INSERT INTO peminjaman (id_anggota, id_buku, tanggal_pinjam, jatuh_tempo, status, denda) 
            VALUES ('$id_anggota', '$id_buku', '$tanggal_pinjam', '$jatuh_tempo', 'Dipinjam', '0')";
    mysqli_query($conn, $sql);

    header("Location: peminjaman.php");
}
?>

<h3>Tambah Peminjaman</h3>
<form method="POST">
    <div class="mb-3">
        <label>Anggota</label>
        <select name="id_anggota" class="form-control" required>
            <option value="">-- Pilih Anggota --</option>
            <?php
            $query_anggota = mysqli_query($conn, "SELECT * FROM anggota");
            while ($data_anggota = mysqli_fetch_array($query_anggota)) {
            ?>
                <option value="<?php echo $data_anggota['id']; ?>"><?php echo $data_anggota['nama']; ?></option>
            <?php } ?>
        </select>
    </div>
    <div class="mb-3">
        <label>Buku</label>
        <select name="id_buku" class="form-control" required>
            <option value="">-- Pilih Buku --</option>
            <?php
            $query_buku = mysqli_query($conn, "SELECT * FROM buku WHERE stok > 0");
            while ($data_buku = mysqli_fetch_array($query_buku)) {
            ?>
                <option value="<?php echo $data_buku['id']; ?>"><?php echo $data_buku['judul']; ?> (Stok: <?php echo $data_buku['stok']; ?>)</option>
            <?php } ?>
        </select>
    </div>
    <div class="mb-3">
        <label>Tanggal Pinjam</label>
        <input type="date" name="tanggal_pinjam" class="form-control" value="<?php echo date('Y-m-d'); ?>" required>
    </div>
    <button type="submit" name="pinjam" class="btn btn-primary">Pinjam</button>
    <a href="peminjaman.php" class="btn btn-secondary">Kembali</a>
</form>

</div>
</body>
</html>

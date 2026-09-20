<?php
include 'koneksi.php';
include 'navbar.php';

$cari = isset($_GET['cari']) ? $_GET['cari'] : '';
if ($cari != '') {
    $query = mysqli_query($conn, "SELECT * FROM buku WHERE is_delete=0 AND (judul LIKE '%$cari%' OR kode_buku LIKE '%$cari%') ORDER BY id DESC");
} else {
    $query = mysqli_query($conn, "SELECT * FROM buku WHERE is_delete=0 ORDER BY id DESC");
}
?>

<div class="d-flex justify-content-between align-items-center mb-3">
    <h4 class="mb-0">Data Buku</h4>
    <a href="buku_tambah.php" class="btn btn-primary">+ Tambah Buku</a>
</div>

<form method="GET" class="row g-2 mb-3">
    <div class="col-auto">
        <input type="text" name="cari" class="form-control" placeholder="Cari judul/kode..." value="<?= $cari; ?>">
    </div>
    <div class="col-auto">
        <button type="submit" class="btn btn-secondary">Cari</button>
        <?php if ($cari != ''): ?>
            <a href="buku.php" class="btn btn-outline-secondary">Reset</a>
        <?php endif; ?>
    </div>
</form>

<div class="card shadow-sm">
    <table class="table table-bordered table-striped mb-0">
        <thead class="table-dark">
            <tr>
                <th>No</th>
                <th>Kode Buku</th>
                <th>Judul Buku</th>
                <th>Pengarang</th>
                <th>Stok</th>
                <th width="140">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php if (mysqli_num_rows($query) > 0): ?>
                <?php $no = 1; while ($row = mysqli_fetch_assoc($query)): ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td><?= $row['kode_buku']; ?></td>
                        <td><b><?= $row['judul']; ?></b></td>
                        <td><?= $row['pengarang']; ?></td>
                        <td><span class="badge bg-success"><?= $row['stok']; ?></span></td>
                        <td>
                            <a href="buku_edit.php?id=<?= $row['id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                            <a href="buku_hapus.php?id=<?= $row['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Hapus buku ini?')">Hapus</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="6" class="text-center py-3">Tidak ada data buku.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

</div>
</body>
</html>

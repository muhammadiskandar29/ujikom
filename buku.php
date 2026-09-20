<?php
include 'koneksi.php';
include 'navbar.php';

// Fitur Cari Buku
$cari = isset($_GET['cari']) ? mysqli_real_escape_string($conn, $_GET['cari']) : '';
if ($cari != '') {
    $query = "SELECT * FROM buku WHERE is_delete = 0 AND (judul LIKE '%$cari%' OR kode_buku LIKE '%$cari%' OR pengarang LIKE '%$cari%') ORDER BY id DESC";
} else {
    $query = "SELECT * FROM buku WHERE is_delete = 0 ORDER BY id DESC";
}
$result = mysqli_query($conn, $query);
?>

<div class="d-flex justify-content-between align-items-center mb-3">
    <h4 class="mb-0">Data Buku</h4>
    <a href="buku_tambah.php" class="btn btn-primary">+ Tambah Buku</a>
</div>

<!-- Form Cari -->
<form method="GET" class="row g-2 mb-3">
    <div class="col-auto">
        <input type="text" name="cari" class="form-control" placeholder="Cari judul / kode..." value="<?= htmlspecialchars($cari); ?>">
    </div>
    <div class="col-auto">
        <button type="submit" class="btn btn-secondary">Cari</button>
        <?php if ($cari != ''): ?>
            <a href="buku.php" class="btn btn-outline-secondary">Reset</a>
        <?php endif; ?>
    </div>
</form>

<!-- Tabel Data Buku -->
<div class="card shadow-sm">
    <div class="table-responsive">
        <table class="table table-bordered table-striped mb-0">
            <thead class="table-dark">
                <tr>
                    <th>No</th>
                    <th>Kode Buku</th>
                    <th>Judul Buku</th>
                    <th>Pengarang</th>
                    <th>Penerbit</th>
                    <th>Tahun</th>
                    <th>Stok</th>
                    <th>Dibuat Oleh</th>
                    <th width="140">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if (mysqli_num_rows($result) > 0): ?>
                    <?php $no = 1; while ($row = mysqli_fetch_assoc($result)): ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><span class="badge bg-secondary"><?= $row['kode_buku']; ?></span></td>
                            <td><b><?= $row['judul']; ?></b></td>
                            <td><?= $row['pengarang']; ?></td>
                            <td><?= $row['penerbit']; ?></td>
                            <td><?= $row['tahun_terbit']; ?></td>
                            <td><span class="badge bg-success"><?= $row['stok']; ?></span></td>
                            <td><small><?= $row['created_by']; ?> (<?= $row['created_at']; ?>)</small></td>
                            <td>
                                <a href="buku_edit.php?id=<?= $row['id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                                <a href="buku_hapus.php?id=<?= $row['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus buku ini?')">Hapus</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="9" class="text-center py-3">Tidak ada data buku.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

</div>
</body>
</html>

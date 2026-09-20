<?php
include 'koneksi.php';
include 'navbar.php';

// Fitur Cari
$cari = isset($_GET['cari']) ? mysqli_real_escape_string($conn, $_GET['cari']) : '';
if ($cari != '') {
    $query = "SELECT * FROM siswa WHERE is_delete = 0 AND (nama LIKE '%$cari%' OR nis LIKE '%$cari%' OR jurusan LIKE '%$cari%') ORDER BY id DESC";
} else {
    $query = "SELECT * FROM siswa WHERE is_delete = 0 ORDER BY id DESC";
}
$result = mysqli_query($conn, $query);
?>

<div class="d-flex justify-content-between align-items-center mb-3">
    <h4 class="mb-0">Data Siswa</h4>
    <a href="tambah.php" class="btn btn-primary">+ Tambah Siswa</a>
</div>

<!-- Form Cari -->
<form method="GET" class="row g-2 mb-3">
    <div class="col-auto">
        <input type="text" name="cari" class="form-control" placeholder="Cari nama / NIS..." value="<?= htmlspecialchars($cari); ?>">
    </div>
    <div class="col-auto">
        <button type="submit" class="btn btn-secondary">Cari</button>
        <?php if ($cari != ''): ?>
            <a href="index.php" class="btn btn-outline-secondary">Reset</a>
        <?php endif; ?>
    </div>
</form>

<!-- Tabel Data Siswa -->
<div class="card shadow-sm">
    <div class="table-responsive">
        <table class="table table-bordered table-striped mb-0">
            <thead class="table-dark">
                <tr>
                    <th>No</th>
                    <th>NIS</th>
                    <th>Nama</th>
                    <th>L/P</th>
                    <th>Jurusan</th>
                    <th>Alamat</th>
                    <th>Dibuat Oleh</th>
                    <th width="140">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if (mysqli_num_rows($result) > 0): ?>
                    <?php $no = 1; while ($row = mysqli_fetch_assoc($result)): ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= $row['nis']; ?></td>
                            <td><b><?= $row['nama']; ?></b></td>
                            <td><?= $row['jenis_kelamin']; ?></td>
                            <td><?= $row['jurusan']; ?></td>
                            <td><?= $row['alamat']; ?></td>
                            <td><small><?= $row['created_by']; ?> (<?= $row['created_at']; ?>)</small></td>
                            <td>
                                <a href="edit.php?id=<?= $row['id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                                <a href="hapus.php?id=<?= $row['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus data ini?')">Hapus</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="8" class="text-center py-3">Tidak ada data siswa.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

</div>
</body>
</html>

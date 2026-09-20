<?php
include 'koneksi.php';
include 'navbar.php';

$cari = isset($_GET['cari']) ? $_GET['cari'] : '';
if ($cari != '') {
    $query = mysqli_query($conn, "SELECT * FROM anggota WHERE nama LIKE '%$cari%' OR nomor_anggota LIKE '%$cari%' ORDER BY id DESC");
} else {
    $query = mysqli_query($conn, "SELECT * FROM anggota ORDER BY id DESC");
}
?>

<div class="d-flex justify-content-between align-items-center mb-3">
    <h4 class="mb-0">Data Anggota</h4>
    <a href="anggota_tambah.php" class="btn btn-primary">+ Tambah Anggota</a>
</div>

<form method="GET" class="row g-2 mb-3">
    <div class="col-auto">
        <input type="text" name="cari" class="form-control" placeholder="Cari nama/nomor..." value="<?= $cari; ?>">
    </div>
    <div class="col-auto">
        <button type="submit" class="btn btn-secondary">Cari</button>
        <?php if ($cari != ''): ?>
            <a href="index.php" class="btn btn-outline-secondary">Reset</a>
        <?php endif; ?>
    </div>
</form>

<div class="card shadow-sm">
    <table class="table table-bordered table-striped mb-0">
        <thead class="table-dark">
            <tr>
                <th>No</th>
                <th>No. Anggota</th>
                <th>Nama Anggota</th>
                <th>Jenis Kelamin</th>
                <th>Tipe</th>
                <th>Alamat</th>
                <th width="140">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php if (mysqli_num_rows($query) > 0): ?>
                <?php $no = 1; while ($row = mysqli_fetch_assoc($query)): ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td><?= $row['nomor_anggota']; ?></td>
                        <td><b><?= $row['nama']; ?></b></td>
                        <td><?= $row['jenis_kelamin']; ?></td>
                        <td>
                            <span class="badge <?= ($row['tipe_anggota'] == 'Admin') ? 'bg-danger' : 'bg-primary'; ?>">
                                <?= $row['tipe_anggota']; ?>
                            </span>
                        </td>
                        <td><?= $row['alamat']; ?></td>
                        <td>
                            <a href="anggota_edit.php?id=<?= $row['id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                            <a href="anggota_hapus.php?id=<?= $row['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Hapus anggota ini?')">Hapus</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="7" class="text-center py-3">Tidak ada data anggota.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

</div>
</body>
</html>

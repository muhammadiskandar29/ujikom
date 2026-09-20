<?php
require_once 'config/database.php';

$page_title = "Data Siswa";
require_once 'includes/header.php';

// Logika Pencarian Data (Hanya data dengan is_delete = 0)
$keyword = "";
if (isset($_GET['cari']) && !empty(trim($_GET['cari']))) {
    $keyword = mysqli_real_escape_string($conn, trim($_GET['cari']));
    $query = "SELECT * FROM siswa 
              WHERE is_delete = 0 AND (nis LIKE '%$keyword%' OR nama LIKE '%$keyword%' OR jurusan LIKE '%$keyword%') 
              ORDER BY id DESC";
} else {
    $query = "SELECT * FROM siswa WHERE is_delete = 0 ORDER BY id DESC";
}
$result = mysqli_query($conn, $query);
?>

<div class="row mb-3 align-items-center">
    <div class="col-md-6 mb-2 mb-md-0">
        <h3 class="fw-bold text-primary mb-1">
            <i class="bi bi-people-fill me-2"></i>Daftar Siswa Aktif
        </h3>
        <p class="text-muted mb-0">Selamat datang, <strong><?= htmlspecialchars($current_user['nama']); ?></strong>!</p>
    </div>
    <div class="col-md-6 text-md-end">
        <a href="tambah.php" class="btn btn-primary shadow-sm">
            <i class="bi bi-plus-lg me-1"></i> Tambah Siswa Baru
        </a>
    </div>
</div>

<!-- Alert Notifikasi Feedback Pengguna -->
<?php if (isset($_GET['pesan'])): ?>
    <?php if ($_GET['pesan'] == 'tambah_sukses'): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i><strong>Berhasil!</strong> Data siswa baru telah ditambahkan.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php elseif ($_GET['pesan'] == 'edit_sukses'): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i><strong>Berhasil!</strong> Data siswa berhasil diperbarui.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php elseif ($_GET['pesan'] == 'hapus_sukses'): ?>
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <i class="bi bi-trash-fill me-2"></i><strong>Berhasil!</strong> Data siswa berhasil dihapus (Soft Delete).
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php elseif ($_GET['pesan'] == 'gagal'): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="bi bi-exclamation-triangle-fill me-2"></i><strong>Gagal!</strong> Terjadi kesalahan saat memproses data.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>
<?php endif; ?>

<!-- Card Konten & Tabel -->
<div class="card shadow-sm">
    <div class="card-header bg-white py-3">
        <form action="index.php" method="GET" class="row g-2 align-items-center">
            <div class="col-md-6 col-lg-5">
                <div class="input-group">
                    <span class="input-group-text bg-light text-secondary"><i class="bi bi-search"></i></span>
                    <input type="text" name="cari" class="form-control" placeholder="Cari NIS, Nama, atau Jurusan..." value="<?= htmlspecialchars($keyword); ?>">
                    <button class="btn btn-primary" type="submit">Cari</button>
                    <?php if (!empty($keyword)): ?>
                        <a href="index.php" class="btn btn-outline-secondary" title="Reset Pencarian">
                            <i class="bi bi-arrow-clockwise"></i> Reset
                        </a>
                    <?php endif; ?>
                </div>
            </div>
            <div class="col-md-6 col-lg-7 text-md-end text-muted small">
                <?php
                $total_data = mysqli_num_rows($result);
                echo "Total Data Aktif: <strong>$total_data</strong> siswa";
                if (!empty($keyword)) {
                    echo " (difilter dari: '<em>" . htmlspecialchars($keyword) . "</em>')";
                }
                ?>
            </div>
        </form>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover table-striped align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="text-center" style="width: 50px;">No</th>
                        <th style="width: 110px;">NIS</th>
                        <th>Nama Siswa</th>
                        <th style="width: 130px;">L / P</th>
                        <th style="width: 190px;">Jurusan</th>
                        <th>Riwayat Audit</th>
                        <th class="text-center" style="width: 150px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (mysqli_num_rows($result) > 0): ?>
                        <?php 
                        $no = 1;
                        while ($row = mysqli_fetch_assoc($result)): 
                        ?>
                            <tr>
                                <td class="text-center"><?= $no++; ?></td>
                                <td><span class="badge bg-secondary-subtle text-secondary-emphasis font-monospace"><?= htmlspecialchars($row['nis']); ?></span></td>
                                <td>
                                    <div class="fw-semibold text-dark"><?= htmlspecialchars($row['nama']); ?></div>
                                    <div class="text-muted small"><?= htmlspecialchars($row['alamat'] ?? '-'); ?></div>
                                </td>
                                <td>
                                    <?php if ($row['jenis_kelamin'] == 'Laki-laki'): ?>
                                        <span class="badge text-bg-primary"><i class="bi bi-gender-male me-1"></i>Laki-laki</span>
                                    <?php else: ?>
                                        <span class="badge text-bg-danger"><i class="bi bi-gender-female me-1"></i>Perempuan</span>
                                    <?php endif; ?>
                                </td>
                                <td><span class="badge bg-info-subtle text-info-emphasis"><?= htmlspecialchars($row['jurusan']); ?></span></td>
                                <td>
                                    <div class="small text-muted">
                                        <i class="bi bi-person-plus text-primary me-1"></i>Dibuat: <strong><?= htmlspecialchars($row['created_by'] ?? 'System'); ?></strong>
                                        <br>
                                        <span class="text-secondary" style="font-size: 0.75rem;"><?= $row['created_at']; ?></span>
                                    </div>
                                    <?php if (!empty($row['updated_by'])): ?>
                                        <div class="small text-muted mt-1">
                                            <i class="bi bi-pencil text-warning me-1"></i>Diubah: <strong><?= htmlspecialchars($row['updated_by']); ?></strong>
                                        </div>
                                    <?php endif; ?>
                                </td>
                                <td class="text-center">
                                    <div class="btn-group btn-group-sm" role="group">
                                        <a href="edit.php?id=<?= $row['id']; ?>" class="btn btn-outline-warning" title="Edit Data">
                                            <i class="bi bi-pencil-square"></i> Edit
                                        </a>
                                        <a href="hapus.php?id=<?= $row['id']; ?>" class="btn btn-outline-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus data siswa <?= htmlspecialchars($row['nama']); ?>? (Soft delete)');" title="Hapus Data">
                                            <i class="bi bi-trash"></i> Hapus
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="7" class="text-center py-5 text-muted">
                                <i class="bi bi-inbox fs-1 d-block mb-2 text-secondary"></i>
                                Tidak ada data siswa aktif yang ditemukan.
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php require_once 'includes/footer.php'; ?>

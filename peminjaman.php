<?php
include 'koneksi.php';
include 'navbar.php';

// Fitur Pencarian Transaksi
$cari = isset($_GET['cari']) ? mysqli_real_escape_string($conn, $_GET['cari']) : '';
$where_cari = "";
if ($cari != '') {
    $where_cari = "AND (a.nama LIKE '%$cari%' OR b.judul LIKE '%$cari%' OR a.nomor_anggota LIKE '%$cari%')";
}

$query = "SELECT p.*, a.nama AS nama_anggota, a.nomor_anggota, b.judul AS judul_buku, b.kode_buku 
          FROM peminjaman p
          JOIN anggota a ON p.id_anggota = a.id
          JOIN buku b ON p.id_buku = b.id
          WHERE p.is_delete = 0 $where_cari
          ORDER BY p.id DESC";
$result = mysqli_query($conn, $query);

$hari_ini = date('Y-m-d');
?>

<div class="d-flex justify-content-between align-items-center mb-3">
    <div>
        <h4 class="mb-0">Transaksi Peminjaman & Pengembalian</h4>
        <small class="text-muted">Maksimal pinjam 3 hari. Terlambat dikenakan denda Rp 500 / hari.</small>
    </div>
    <a href="pinjam_tambah.php" class="btn btn-primary">+ Pinjam Buku</a>
</div>

<!-- Form Cari -->
<form method="GET" class="row g-2 mb-3">
    <div class="col-auto">
        <input type="text" name="cari" class="form-control" placeholder="Cari peminjam / judul buku..." value="<?= htmlspecialchars($cari); ?>">
    </div>
    <div class="col-auto">
        <button type="submit" class="btn btn-secondary">Cari</button>
        <?php if ($cari != ''): ?>
            <a href="peminjaman.php" class="btn btn-outline-secondary">Reset</a>
        <?php endif; ?>
    </div>
</form>

<!-- Tabel Transaksi -->
<div class="card shadow-sm">
    <div class="table-responsive">
        <table class="table table-bordered table-striped align-middle mb-0">
            <thead class="table-dark">
                <tr>
                    <th>No</th>
                    <th>Peminjam</th>
                    <th>Buku</th>
                    <th>Tgl Pinjam</th>
                    <th>Jatuh Tempo</th>
                    <th>Tgl Kembali</th>
                    <th>Status</th>
                    <th>Denda (Rp 500/hr)</th>
                    <th width="130">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if (mysqli_num_rows($result) > 0): ?>
                    <?php $no = 1; while ($row = mysqli_fetch_assoc($result)): ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td>
                                <b><?= $row['nama_anggota']; ?></b><br>
                                <small class="text-muted"><?= $row['nomor_anggota']; ?></small>
                            </td>
                            <td>
                                <b><?= $row['judul_buku']; ?></b><br>
                                <span class="badge bg-secondary"><?= $row['kode_buku']; ?></span>
                            </td>
                            <td><?= $row['tanggal_pinjam']; ?></td>
                            <td>
                                <span class="text-danger fw-semibold"><?= $row['jatuh_tempo']; ?></span>
                            </td>
                            <td><?= $row['tanggal_kembali'] ? $row['tanggal_kembali'] : '-'; ?></td>
                            <td>
                                <?php if ($row['status'] == 'Dipinjam'): ?>
                                    <span class="badge bg-warning text-dark">Dipinjam</span>
                                <?php else: ?>
                                    <span class="badge bg-success">Dikembalikan</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php 
                                if ($row['status'] == 'Dikembalikan') {
                                    if ($row['denda'] > 0) {
                                        echo "<span class='text-danger fw-bold'>Rp " . number_format($row['denda'], 0, ',', '.') . "</span><br>";
                                        echo "<small class='text-muted'>(" . $row['terlambat'] . " hari telat)</small>";
                                    } else {
                                        echo "<span class='text-success'>Rp 0 (Tepat Waktu)</span>";
                                    }
                                } else {
                                    // Hitung estimasi denda jika saat ini sudah melewati jatuh tempo
                                    if ($hari_ini > $row['jatuh_tempo']) {
                                        $tgl1 = new DateTime($row['jatuh_tempo']);
                                        $tgl2 = new DateTime($hari_ini);
                                        $hari_telat = $tgl1->diff($tgl2)->days;
                                        $estimasi_denda = $hari_telat * 500;
                                        echo "<span class='text-danger small'>Telat $hari_telat hari<br><b>Est: Rp " . number_format($estimasi_denda, 0, ',', '.') . "</b></span>";
                                    } else {
                                        echo "<span class='text-muted small'>Masa Pinjam</span>";
                                    }
                                }
                                ?>
                            </td>
                            <td>
                                <?php if ($row['status'] == 'Dipinjam'): ?>
                                    <a href="pinjam_kembali.php?id=<?= $row['id']; ?>" class="btn btn-success btn-sm w-100" onclick="return confirm('Proses pengembalian buku ini?')">
                                        Kembalikan
                                    </a>
                                <?php else: ?>
                                    <span class="text-muted small"><i class="bi bi-check-all"></i> Selesai</span>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="9" class="text-center py-3">Belum ada transaksi peminjaman.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

</div>
</body>
</html>

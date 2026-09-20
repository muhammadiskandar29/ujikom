<?php
include 'koneksi.php';
include 'navbar.php';

$query = mysqli_query($conn, "SELECT p.*, a.nama AS nama_anggota, b.judul AS judul_buku 
                              FROM peminjaman p
                              JOIN anggota a ON p.id_anggota = a.id
                              JOIN buku b ON p.id_buku = b.id
                              WHERE p.is_delete=0 
                              ORDER BY p.id DESC");
?>

<div class="d-flex justify-content-between align-items-center mb-3">
    <div>
        <h4 class="mb-0">Transaksi Peminjaman</h4>
        <small class="text-muted">Batas pinjam 3 hari. Lewat 3 hari denda Rp 500 / hari.</small>
    </div>
    <a href="pinjam_tambah.php" class="btn btn-primary">+ Pinjam Buku</a>
</div>

<div class="card shadow-sm">
    <table class="table table-bordered table-striped mb-0">
        <thead class="table-dark">
            <tr>
                <th>No</th>
                <th>Peminjam</th>
                <th>Buku</th>
                <th>Tgl Pinjam</th>
                <th>Jatuh Tempo</th>
                <th>Tgl Kembali</th>
                <th>Status</th>
                <th>Denda</th>
                <th width="120">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php if (mysqli_num_rows($query) > 0): ?>
                <?php $no = 1; while ($row = mysqli_fetch_assoc($query)): ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td><b><?= $row['nama_anggota']; ?></b></td>
                        <td><?= $row['judul_buku']; ?></td>
                        <td><?= $row['tanggal_pinjam']; ?></td>
                        <td><span class="text-danger fw-bold"><?= $row['jatuh_tempo']; ?></span></td>
                        <td><?= $row['tanggal_kembali'] ? $row['tanggal_kembali'] : '-'; ?></td>
                        <td>
                            <span class="badge <?= ($row['status'] == 'Dipinjam') ? 'bg-warning text-dark' : 'bg-success'; ?>">
                                <?= $row['status']; ?>
                            </span>
                        </td>
                        <td>
                            <?php if ($row['denda'] > 0): ?>
                                <span class="text-danger fw-bold">Rp <?= number_format($row['denda'], 0, ',', '.'); ?></span>
                            <?php else: ?>
                                <span>Rp 0</span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <?php if ($row['status'] == 'Dipinjam'): ?>
                                <a href="pinjam_kembali.php?id=<?= $row['id']; ?>" class="btn btn-success btn-sm w-100" onclick="return confirm('Kembalikan buku ini?')">Kembalikan</a>
                            <?php else: ?>
                                <span class="text-muted small">Selesai</span>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="9" class="text-center py-3">Belum ada transaksi.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

</div>
</body>
</html>

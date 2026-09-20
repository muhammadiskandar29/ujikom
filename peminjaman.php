<?php
include 'koneksi.php';
include 'navbar.php';

$query = mysqli_query($conn, "SELECT p.*, a.nama AS nama_anggota, b.judul AS judul_buku 
                              FROM peminjaman p
                              JOIN anggota a ON p.id_anggota = a.id
                              JOIN buku b ON p.id_buku = b.id
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
            <?php
            $cek_data = mysqli_num_rows($query);
            if ($cek_data > 0) {
                $no = 1;
                while ($data = mysqli_fetch_array($query)) {
            ?>
                    <tr>
                        <td><?php echo $no++; ?></td>
                        <td><b><?php echo $data['nama_anggota']; ?></b></td>
                        <td><?php echo $data['judul_buku']; ?></td>
                        <td><?php echo $data['tanggal_pinjam']; ?></td>
                        <td><span class="text-danger fw-bold"><?php echo $data['jatuh_tempo']; ?></span></td>
                        <td>
                            <?php
                            if ($data['tanggal_kembali'] != "") {
                                echo $data['tanggal_kembali'];
                            } else {
                                echo "-";
                            }
                            ?>
                        </td>
                        <td>
                            <?php if ($data['status'] == 'Dipinjam') { ?>
                                <span class="badge bg-warning text-dark"><?php echo $data['status']; ?></span>
                            <?php } else { ?>
                                <span class="badge bg-success"><?php echo $data['status']; ?></span>
                            <?php } ?>
                        </td>
                        <td>
                            <?php if ($data['denda'] > 0) { ?>
                                <span class="text-danger fw-bold">Rp <?php echo number_format($data['denda'], 0, ',', '.'); ?></span>
                            <?php } else { ?>
                                <span>Rp 0</span>
                            <?php } ?>
                        </td>
                        <td>
                            <?php if ($data['status'] == 'Dipinjam') { ?>
                                <a href="pinjam_kembali.php?id=<?php echo $data['id']; ?>" class="btn btn-success btn-sm w-100" onclick="return confirm('Kembalikan buku ini?')">Kembalikan</a>
                            <?php } else { ?>
                                <span class="text-muted small">Selesai</span>
                            <?php } ?>
                        </td>
                    </tr>
            <?php
                }
            } else {
            ?>
                <tr>
                    <td colspan="9" class="text-center py-3">Belum ada transaksi.</td>
                </tr>
            <?php
            }
            ?>
        </tbody>
    </table>
</div>

</div>
</body>
</html>

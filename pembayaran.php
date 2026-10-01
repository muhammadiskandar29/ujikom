<?php
include 'koneksi.php';
include 'sidebar.php';
?>

<div class="d-flex justify-content-between align-items-center mb-3">
    <h3>Detail Pembayaran</h3>
    <a href="pembayaran_tambah.php" class="btn btn-primary btn-sm">+ Transaksi Pembayaran</a>
</div>

<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th width="40">No</th>
            <th>ID Bayar</th>
            <th>NISN</th>
            <th>Tgl Bayar</th>
            <th>Batas Bayar</th>
            <th>Jml Bulan</th>
            <th>ID SPP</th>
            <th>Nominal</th>
            <th>Jumlah Bayar</th>
            <th>Kembalian</th>
            <th>Status</th>
            <th width="140">Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $no = 1;
        $query = mysqli_query($conn, "SELECT * FROM tb_pembayaran ORDER BY tgl_bayar DESC");
        while ($d = mysqli_fetch_array($query)) {
        ?>
        <tr>
            <td><?= $no++; ?></td>
            <td><?= $d['id_pembayaran']; ?></td>
            <td><?= $d['nisn']; ?></td>
            <td><?= $d['tgl_bayar']; ?></td>
            <td><?= $d['batas_pembayaran'] ? $d['batas_pembayaran'] : '-'; ?></td>
            <td><?= $d['jumlah_bulan']; ?></td>
            <td><?= $d['id_spp']; ?></td>
            <td>Rp <?= number_format($d['nominal_bayar'], 0, ',', '.'); ?></td>
            <td>Rp <?= number_format($d['jumlah_bayar'], 0, ',', '.'); ?></td>
            <td>Rp <?= number_format($d['kembalian'], 0, ',', '.'); ?></td>
            <td><span class="badge bg-success"><?= $d['status']; ?></span></td>
            <td>
                <a href="pembayaran_detail.php?id=<?= $d['id_pembayaran']; ?>" class="btn btn-info btn-sm text-white">View</a>
                <a href="pembayaran_hapus.php?id=<?= $d['id_pembayaran']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Hapus transaksi ini?')">Hapus</a>
            </td>
        </tr>
        <?php } ?>
    </tbody>
</table>

    </div>
</div>
</body>
</html>

<?php
include 'koneksi.php';
include 'sidebar.php';
?>

<div class="d-flex justify-content-between align-items-center mb-3">
    <h3>Cek Pembayaran</h3>
</div>

<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th width="40">No</th>
            <th>NISN</th>
            <th>Nama Siswa</th>
            <th>No Telepon</th>
            <th>Tgl Terakhir Bayar</th>
            <th>Tgl Sekarang</th>
            <th>Jumlah Bulan</th>
            <th>Status Pembayaran</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $no = 1;
        $query = mysqli_query($conn, "SELECT * FROM cek_pembayaran ORDER BY nisn ASC");
        while ($d = mysqli_fetch_array($query)) {
        ?>
        <tr>
            <td><?= $no++; ?></td>
            <td><?= $d['nisn']; ?></td>
            <td><?= $d['nama']; ?></td>
            <td><?= $d['no_tlp']; ?></td>
            <td><?= $d['tgl_terakhir_bayar'] ? $d['tgl_terakhir_bayar'] : '-'; ?></td>
            <td><?= $d['tgl_sekarang']; ?></td>
            <td><?= $d['jumlah_bulan']; ?> Bulan</td>
            <td>
                <?php if ($d['status_pembayaran'] == 'sudah lunas'): ?>
                    <span class="badge bg-success">Sudah Lunas</span>
                <?php else: ?>
                    <span class="badge bg-danger">Belum Lunas</span>
                <?php endif; ?>
            </td>
        </tr>
        <?php } ?>
    </tbody>
</table>

    </div>
</div>
</body>
</html>

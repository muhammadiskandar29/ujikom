<?php
include 'koneksi.php';
include 'sidebar.php';

// ambil id pembayaran dari parameter URL
$id = $_GET['id'];

// query data transaksi pembayaran beserta nama siswa
$d = mysqli_fetch_array(mysqli_query($conn, "SELECT p.*, s.nama, s.nama_kelas 
                                             FROM tb_pembayaran p 
                                             LEFT JOIN tb_siswa s ON p.nisn = s.nisn 
                                             WHERE p.id_pembayaran='$id'"));
?>

<div class="d-flex justify-content-between align-items-center mb-3">
    <h3>Detail Transaksi Pembayaran</h3>
    <div>
        <button onclick="window.print()" class="btn btn-success btn-sm">Cetak Bukti</button>
        <a href="pembayaran.php" class="btn btn-secondary btn-sm">Kembali</a>
    </div>
</div>

<div class="card p-4 border" style="max-width: 600px;">
    <h5 class="border-bottom pb-2 mb-3 text-primary">Bukti Pembayaran SPP (Kuitansi)</h5>
    
    <table class="table table-borderless mb-0">
        <tr>
            <th width="180">ID Pembayaran</th>
            <td>: <strong><?= $d['id_pembayaran']; ?></strong></td>
        </tr>
        <tr>
            <th>Tanggal Bayar</th>
            <td>: <?= $d['tgl_bayar']; ?></td>
        </tr>
        <tr>
            <th>NISN / Siswa</th>
            <td>: <?= $d['nisn']; ?> - <?= $d['nama'] ?? 'Siswa'; ?></td>
        </tr>
        <tr>
            <th>Kelas</th>
            <td>: <?= $d['nama_kelas'] ?? '-'; ?></td>
        </tr>
        <tr>
            <th>Tarif SPP</th>
            <td>: <?= $d['id_spp']; ?> (<?= $d['jumlah_bulan']; ?> Bulan)</td>
        </tr>
        <tr>
            <th>Nominal Tagihan</th>
            <td>: Rp <?= number_format($d['nominal_bayar'], 0, ',', '.'); ?></td>
        </tr>
        <tr>
            <th>Jumlah Uang Dibayar</th>
            <td>: Rp <?= number_format($d['jumlah_bayar'], 0, ',', '.'); ?></td>
        </tr>
        <tr>
            <th>Kembalian</th>
            <td>: Rp <?= number_format($d['kembalian'], 0, ',', '.'); ?></td>
        </tr>
        <tr>
            <th>Status Pembayaran</th>
            <td>: <span class="badge bg-success"><?= ucfirst($d['status']); ?></span></td>
        </tr>
    </table>
</div>

    </div>
</div>
</body>
</html>

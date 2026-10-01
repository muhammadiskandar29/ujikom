<?php
include 'koneksi.php';
include 'sidebar.php';

$nisn = $_GET['nisn'];
$d = mysqli_fetch_array(mysqli_query($conn, "SELECT s.*, c.status_pembayaran, c.tgl_terakhir_bayar, sp.nominal 
                                             FROM tb_siswa s 
                                             LEFT JOIN cek_pembayaran c ON s.nisn = c.nisn 
                                             LEFT JOIN tb_spp sp ON s.id_spp = sp.id_spp 
                                             WHERE s.nisn='$nisn'"));
?>

<div class="d-flex justify-content-between align-items-center mb-3">
    <h3>Detail Data Siswa</h3>
    <div>
        <a href="siswa_edit.php?nisn=<?= $d['nisn']; ?>" class="btn btn-warning btn-sm">Edit Siswa</a>
        <a href="siswa.php" class="btn btn-secondary btn-sm">Kembali</a>
    </div>
</div>

<div class="card p-4 border" style="max-width: 600px;">
    <h5 class="border-bottom pb-2 mb-3 text-primary">Informasi Lengkap Siswa</h5>
    
    <table class="table table-borderless mb-0">
        <tr>
            <th width="180">NISN</th>
            <td>: <strong><?= $d['nisn']; ?></strong></td>
        </tr>
        <tr>
            <th>NIS</th>
            <td>: <?= $d['nis']; ?></td>
        </tr>
        <tr>
            <th>Nama Lengkap</th>
            <td>: <?= $d['nama']; ?></td>
        </tr>
        <tr>
            <th>Kelas</th>
            <td>: <?= $d['nama_kelas']; ?> (<?= $d['id_kelas']; ?>)</td>
        </tr>
        <tr>
            <th>No. Telepon</th>
            <td>: <?= $d['no_tlp']; ?></td>
        </tr>
        <tr>
            <th>Alamat</th>
            <td>: <?= $d['alamat']; ?></td>
        </tr>
        <tr>
            <th>Tarif SPP</th>
            <td>: <?= $d['id_spp']; ?> (Rp <?= number_format($d['nominal'] ?? 0, 0, ',', '.'); ?>)</td>
        </tr>
        <tr>
            <th>Status SPP</th>
            <td>: 
                <?php if (($d['status_pembayaran'] ?? '') == 'sudah lunas'): ?>
                    <span class="badge bg-success">Sudah Lunas</span>
                <?php else: ?>
                    <span class="badge bg-danger">Belum Lunas</span>
                <?php endif; ?>
            </td>
        </tr>
        <tr>
            <th>Tgl Terakhir Bayar</th>
            <td>: <?= $d['tgl_terakhir_bayar'] ? $d['tgl_terakhir_bayar'] : 'Belum pernah bayar'; ?></td>
        </tr>
    </table>
</div>

    </div>
</div>
</body>
</html>

<?php
include 'koneksi.php';
include 'sidebar.php';

$id = $_GET['id'];
$d = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM tb_spp WHERE id_spp='$id'"));
$siswa_spp = mysqli_query($conn, "SELECT * FROM tb_siswa WHERE id_spp='$id' ORDER BY nama ASC");
$total_siswa_spp = mysqli_num_rows($siswa_spp);
?>

<div class="d-flex justify-content-between align-items-center mb-3">
    <h3>Detail Tarif SPP</h3>
    <div>
        <a href="spp_edit.php?id=<?= $d['id_spp']; ?>" class="btn btn-warning btn-sm">Edit SPP</a>
        <a href="spp.php" class="btn btn-secondary btn-sm">Kembali</a>
    </div>
</div>

<div class="card p-4 border mb-4" style="max-width: 600px;">
    <h5 class="border-bottom pb-2 mb-3 text-primary">Informasi Tarif SPP</h5>
    
    <table class="table table-borderless mb-0">
        <tr>
            <th width="180">ID SPP</th>
            <td>: <strong><?= $d['id_spp']; ?></strong></td>
        </tr>
        <tr>
            <th>Tahun Ajaran</th>
            <td>: <?= $d['tahun']; ?></td>
        </tr>
        <tr>
            <th>Nominal Tagihan</th>
            <td>: <strong>Rp <?= number_format($d['nominal'], 0, ',', '.'); ?></strong></td>
        </tr>
        <tr>
            <th>Jumlah Siswa Terdaftar</th>
            <td>: <span class="badge bg-primary"><?= $total_siswa_spp; ?> Siswa</span></td>
        </tr>
    </table>
</div>

<h5>Daftar Siswa dengan Tarif SPP <?= $d['id_spp']; ?></h5>
<table class="table table-bordered table-striped mt-2">
    <thead>
        <tr>
            <th width="40">No</th>
            <th>NISN</th>
            <th>Nama Siswa</th>
            <th>Kelas</th>
            <th>No Telepon</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $no = 1;
        if ($total_siswa_spp > 0) {
            while ($s = mysqli_fetch_array($siswa_spp)) {
        ?>
        <tr>
            <td><?= $no++; ?></td>
            <td><?= $s['nisn']; ?></td>
            <td><?= $s['nama']; ?></td>
            <td><?= $s['nama_kelas']; ?></td>
            <td><?= $s['no_tlp']; ?></td>
        </tr>
        <?php 
            }
        } else {
            echo "<tr><td colspan='5' class='text-center text-muted'>Belum ada siswa yang menggunakan tarif SPP ini.</td></tr>";
        }
        ?>
    </tbody>
</table>

    </div>
</div>
</body>
</html>

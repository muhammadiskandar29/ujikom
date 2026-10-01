<?php
include 'koneksi.php';
include 'sidebar.php';

// hitung data rekapitulasi untuk kartu statistik dashboard
$total_siswa = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM tb_siswa"));
$total_bayar = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM tb_pembayaran"));
$siswa_lunas = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM cek_pembayaran WHERE status_pembayaran = 'sudah lunas'"));
$siswa_belum = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM cek_pembayaran WHERE status_pembayaran = 'belum lunas'"));
?>

<div class="mb-4">
    <h3>Dashboard</h3>
    <p class="text-muted">Selamat datang, <strong><?= $nama_petugas; ?></strong> (<?= ucfirst($level_user); ?>) di Aplikasi Pembayaran SPP Sekolah.</p>
</div>

<div class="row g-3 mb-4">
    <div class="col-md-3">
        <div class="card p-3 border">
            <h6 class="text-muted">Total Siswa</h6>
            <h3 class="mb-0 text-primary"><?= $total_siswa; ?></h3>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card p-3 border">
            <h6 class="text-muted">Total Transaksi</h6>
            <h3 class="mb-0 text-success"><?= $total_bayar; ?></h3>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card p-3 border">
            <h6 class="text-muted">Siswa Lunas</h6>
            <h3 class="mb-0 text-info"><?= $siswa_lunas; ?></h3>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card p-3 border">
            <h6 class="text-muted">Belum Lunas</h6>
            <h3 class="mb-0 text-danger"><?= $siswa_belum; ?></h3>
        </div>
    </div>
</div>

<h5>Daftar Siswa Terbaru</h5>
<table class="table table-bordered table-striped mt-2">
    <thead>
        <tr>
            <th>No</th>
            <th>NISN</th>
            <th>Nama Siswa</th>
            <th>Kelas</th>
            <th>Tarif SPP</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $no = 1;
        $query = mysqli_query($conn, "SELECT * FROM tb_siswa ORDER BY nisn ASC LIMIT 5");
        while ($d = mysqli_fetch_array($query)) {
        ?>
        <tr>
            <td><?= $no++; ?></td>
            <td><?= $d['nisn']; ?></td>
            <td><?= $d['nama']; ?></td>
            <td><?= $d['nama_kelas']; ?></td>
            <td><?= $d['id_spp']; ?></td>
        </tr>
        <?php } ?>
    </tbody>
</table>

    </div>
</div>
</body>
</html>

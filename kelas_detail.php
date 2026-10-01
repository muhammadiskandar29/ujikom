<?php
include 'koneksi.php';
include 'sidebar.php';

$id = $_GET['id'];
$d = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM tb_kelas WHERE id_kelas='$id'"));
$siswa_kelas = mysqli_query($conn, "SELECT * FROM tb_siswa WHERE id_kelas='$id' ORDER BY nama ASC");
$total_siswa_kelas = mysqli_num_rows($siswa_kelas);
?>

<div class="d-flex justify-content-between align-items-center mb-3">
    <h3>Detail Data Kelas</h3>
    <div>
        <a href="kelas_edit.php?id=<?= $d['id_kelas']; ?>" class="btn btn-warning btn-sm">Edit Kelas</a>
        <a href="kelas.php" class="btn btn-secondary btn-sm">Kembali</a>
    </div>
</div>

<div class="card p-4 border mb-4" style="max-width: 600px;">
    <h5 class="border-bottom pb-2 mb-3 text-primary">Informasi Kelas</h5>
    
    <table class="table table-borderless mb-0">
        <tr>
            <th width="180">ID Kelas</th>
            <td>: <strong><?= $d['id_kelas']; ?></strong></td>
        </tr>
        <tr>
            <th>Nama Kelas</th>
            <td>: <?= $d['nama_kelas']; ?></td>
        </tr>
        <tr>
            <th>Kompetensi Keahlian</th>
            <td>: <?= $d['komp_keahlian']; ?></td>
        </tr>
        <tr>
            <th>Total Siswa di Kelas</th>
            <td>: <span class="badge bg-primary"><?= $total_siswa_kelas; ?> Siswa</span></td>
        </tr>
    </table>
</div>

<h5>Daftar Siswa di Kelas <?= $d['nama_kelas']; ?></h5>
<table class="table table-bordered table-striped mt-2">
    <thead>
        <tr>
            <th width="40">No</th>
            <th>NISN</th>
            <th>NIS</th>
            <th>Nama Siswa</th>
            <th>No Telepon</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $no = 1;
        if ($total_siswa_kelas > 0) {
            while ($s = mysqli_fetch_array($siswa_kelas)) {
        ?>
        <tr>
            <td><?= $no++; ?></td>
            <td><?= $s['nisn']; ?></td>
            <td><?= $s['nis']; ?></td>
            <td><?= $s['nama']; ?></td>
            <td><?= $s['no_tlp']; ?></td>
        </tr>
        <?php 
            }
        } else {
            echo "<tr><td colspan='5' class='text-center text-muted'>Belum ada siswa di kelas ini.</td></tr>";
        }
        ?>
    </tbody>
</table>

    </div>
</div>
</body>
</html>

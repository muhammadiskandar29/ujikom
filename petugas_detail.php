<?php
include 'koneksi.php';
include 'sidebar.php';

$id = $_GET['id'];
$d = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM tb_petugas WHERE id_petugas='$id'"));
?>

<div class="d-flex justify-content-between align-items-center mb-3">
    <h3>Detail Data Petugas</h3>
    <div>
        <a href="petugas_edit.php?id=<?= $d['id_petugas']; ?>" class="btn btn-warning btn-sm">Edit Petugas</a>
        <a href="petugas.php" class="btn btn-secondary btn-sm">Kembali</a>
    </div>
</div>

<div class="card p-4 border" style="max-width: 550px;">
    <h5 class="border-bottom pb-2 mb-3 text-primary">Informasi Akun Petugas</h5>
    
    <table class="table table-borderless mb-0">
        <tr>
            <th width="160">ID Petugas</th>
            <td>: <strong><?= $d['id_petugas']; ?></strong></td>
        </tr>
        <tr>
            <th>Username</th>
            <td>: <?= $d['username']; ?></td>
        </tr>
        <tr>
            <th>Nama Lengkap</th>
            <td>: <?= $d['nama_petugas']; ?></td>
        </tr>
        <tr>
            <th>Level Hak Akses</th>
            <td>: <span class="badge bg-primary"><?= ucfirst($d['level']); ?></span></td>
        </tr>
        <tr>
            <th>Status Enkripsi</th>
            <td>: <span class="badge bg-secondary">MD5 Encrypted</span></td>
        </tr>
    </table>
</div>

    </div>
</div>
</body>
</html>

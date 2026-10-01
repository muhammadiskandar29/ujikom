<?php
include 'koneksi.php';
include 'sidebar.php';
?>

<div class="d-flex justify-content-between align-items-center mb-3">
    <h3>Data Petugas</h3>
    <a href="petugas_tambah.php" class="btn btn-primary btn-sm">+ Tambah Petugas</a>
</div>

<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th width="40">No</th>
            <th>ID Petugas</th>
            <th>Username</th>
            <th>Nama Petugas</th>
            <th>Level</th>
            <th width="140">Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $no = 1;
        $query = mysqli_query($conn, "SELECT * FROM tb_petugas ORDER BY id_petugas ASC");
        while ($d = mysqli_fetch_array($query)) {
        ?>
        <tr>
            <td><?= $no++; ?></td>
            <td><?= $d['id_petugas']; ?></td>
            <td><?= $d['username']; ?></td>
            <td><?= $d['nama_petugas']; ?></td>
            <td><span class="badge bg-secondary"><?= ucfirst($d['level']); ?></span></td>
            <td>
                <a href="petugas_detail.php?id=<?= $d['id_petugas']; ?>" class="btn btn-info btn-sm text-white">View</a>
                <a href="petugas_edit.php?id=<?= $d['id_petugas']; ?>" class="btn btn-warning btn-sm">Edit</a>
                <a href="petugas_hapus.php?id=<?= $d['id_petugas']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Hapus petugas ini?')">Hapus</a>
            </td>
        </tr>
        <?php } ?>
    </tbody>
</table>

    </div>
</div>
</body>
</html>

<?php
include 'koneksi.php';
include 'sidebar.php';
?>

<div class="d-flex justify-content-between align-items-center mb-3">
    <h3>Data Kelas</h3>
    <a href="kelas_tambah.php" class="btn btn-primary btn-sm">+ Tambah Kelas</a>
</div>

<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th width="40">No</th>
            <th>ID Kelas</th>
            <th>Nama Kelas</th>
            <th>Kompetensi Keahlian</th>
            <th width="140">Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $no = 1;
        $query = mysqli_query($conn, "SELECT * FROM tb_kelas ORDER BY id_kelas ASC");
        while ($d = mysqli_fetch_array($query)) {
        ?>
        <tr>
            <td><?= $no++; ?></td>
            <td><?= $d['id_kelas']; ?></td>
            <td><?= $d['nama_kelas']; ?></td>
            <td><?= $d['komp_keahlian']; ?></td>
            <td>
                <a href="kelas_detail.php?id=<?= $d['id_kelas']; ?>" class="btn btn-info btn-sm text-white">View</a>
                <a href="kelas_edit.php?id=<?= $d['id_kelas']; ?>" class="btn btn-warning btn-sm">Edit</a>
                <a href="kelas_hapus.php?id=<?= $d['id_kelas']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Hapus kelas ini?')">Hapus</a>
            </td>
        </tr>
        <?php } ?>
    </tbody>
</table>

    </div>
</div>
</body>
</html>

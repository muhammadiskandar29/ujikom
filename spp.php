<?php
include 'koneksi.php';
include 'sidebar.php';
?>

<div class="d-flex justify-content-between align-items-center mb-3">
    <h3>Data SPP</h3>
    <a href="spp_tambah.php" class="btn btn-primary btn-sm">+ Tambah SPP</a>
</div>

<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th width="50">No</th>
            <th>ID SPP</th>
            <th>Tahun</th>
            <th>Nominal</th>
            <th width="140">Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $no = 1;
        $query = mysqli_query($conn, "SELECT * FROM tb_spp ORDER BY id_spp ASC");
        while ($d = mysqli_fetch_array($query)) {
        ?>
        <tr>
            <td><?= $no++; ?></td>
            <td><?= $d['id_spp']; ?></td>
            <td><?= $d['tahun']; ?></td>
            <td>Rp <?= number_format((float)$d['nominal'], 0, ',', '.'); ?></td>
            <td>
                <a href="spp_detail.php?id=<?= $d['id_spp']; ?>" class="btn btn-info btn-sm text-white">View</a>
                <a href="spp_edit.php?id=<?= $d['id_spp']; ?>" class="btn btn-warning btn-sm">Edit</a>
                <a href="spp_hapus.php?id=<?= $d['id_spp']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Hapus SPP ini?')">Hapus</a>
            </td>
        </tr>
        <?php } ?>
    </tbody>
</table>

    </div>
</div>
</body>
</html>

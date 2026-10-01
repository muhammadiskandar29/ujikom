<?php
include 'koneksi.php';
include 'sidebar.php';
?>

<div class="d-flex justify-content-between align-items-center mb-3">
    <h3>Data Siswa</h3>
    <a href="siswa_tambah.php" class="btn btn-primary btn-sm">+ Tambah Siswa</a>
</div>

<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th width="40">No</th>
            <th>NISN</th>
            <th>NIS</th>
            <th>Nama</th>
            <th>Kelas</th>
            <th>Alamat</th>
            <th>No Telepon</th>
            <th>ID SPP</th>
            <th width="140">Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $no = 1;
        $query = mysqli_query($conn, "SELECT * FROM tb_siswa ORDER BY nisn ASC");
        while ($d = mysqli_fetch_array($query)) {
        ?>
        <tr>
            <td><?= $no++; ?></td>
            <td><?= $d['nisn']; ?></td>
            <td><?= $d['nis']; ?></td>
            <td><?= $d['nama']; ?></td>
            <td><?= $d['nama_kelas']; ?></td>
            <td><?= $d['alamat']; ?></td>
            <td><?= $d['no_tlp']; ?></td>
            <td><?= $d['id_spp']; ?></td>
            <td>
                <a href="siswa_detail.php?nisn=<?= $d['nisn']; ?>" class="btn btn-info btn-sm text-white">View</a>
                <a href="siswa_edit.php?nisn=<?= $d['nisn']; ?>" class="btn btn-warning btn-sm">Edit</a>
                <a href="siswa_hapus.php?nisn=<?= $d['nisn']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Hapus siswa ini?')">Hapus</a>
            </td>
        </tr>
        <?php } ?>
    </tbody>
</table>

    </div>
</div>
</body>
</html>

<?php
include 'koneksi.php';
include 'navbar.php';
?>

<h3>Data Anggota</h3>
<a href="anggota_tambah.php" class="btn btn-primary btn-sm mb-3">+ Tambah Anggota</a>

<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>No</th>
            <th>No Anggota</th>
            <th>Nama</th>
            <th>Jenis Kelamin</th>
            <th>Tipe</th>
            <th>Alamat</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $no = 1;
        $query = mysqli_query($conn, "SELECT * FROM anggota");
        while ($data = mysqli_fetch_array($query)) {
        ?>
        <tr>
            <td><?php echo $no++; ?></td>
            <td><?php echo $data['nomor_anggota']; ?></td>
            <td><?php echo $data['nama']; ?></td>
            <td><?php echo $data['jenis_kelamin']; ?></td>
            <td><?php echo $data['tipe_anggota']; ?></td>
            <td><?php echo $data['alamat']; ?></td>
            <td>
                <a href="anggota_edit.php?id=<?php echo $data['id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                <a href="anggota_hapus.php?id=<?php echo $data['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus data?')">Hapus</a>
            </td>
        </tr>
        <?php } ?>
    </tbody>
</table>

</div>
</body>
</html>

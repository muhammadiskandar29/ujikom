<?php
include 'koneksi.php';
include 'navbar.php';

if (isset($_GET['cari'])) {
    $cari = $_GET['cari'];
} else {
    $cari = "";
}

if ($cari != "") {
    $query = mysqli_query($conn, "SELECT * FROM anggota WHERE nama LIKE '%$cari%' OR nomor_anggota LIKE '%$cari%' ORDER BY id DESC");
} else {
    $query = mysqli_query($conn, "SELECT * FROM anggota ORDER BY id DESC");
}
?>

<div class="d-flex justify-content-between align-items-center mb-3">
    <h4 class="mb-0">Data Anggota</h4>
    <a href="anggota_tambah.php" class="btn btn-primary">+ Tambah Anggota</a>
</div>

<form method="GET" class="row g-2 mb-3">
    <div class="col-auto">
        <input type="text" name="cari" class="form-control" placeholder="Cari nama/nomor..." value="<?php echo $cari; ?>">
    </div>
    <div class="col-auto">
        <button type="submit" class="btn btn-secondary">Cari</button>
        <?php if ($cari != "") { ?>
            <a href="index.php" class="btn btn-outline-secondary">Reset</a>
        <?php } ?>
    </div>
</form>

<div class="card shadow-sm">
    <table class="table table-bordered table-striped mb-0">
        <thead class="table-dark">
            <tr>
                <th>No</th>
                <th>No. Anggota</th>
                <th>Nama Anggota</th>
                <th>Jenis Kelamin</th>
                <th>Tipe</th>
                <th>Alamat</th>
                <th width="140">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $cek_data = mysqli_num_rows($query);
            if ($cek_data > 0) {
                $no = 1;
                while ($data = mysqli_fetch_array($query)) {
            ?>
                    <tr>
                        <td><?php echo $no++; ?></td>
                        <td><?php echo $data['nomor_anggota']; ?></td>
                        <td><b><?php echo $data['nama']; ?></b></td>
                        <td><?php echo $data['jenis_kelamin']; ?></td>
                        <td>
                            <?php if ($data['tipe_anggota'] == 'Admin') { ?>
                                <span class="badge bg-danger"><?php echo $data['tipe_anggota']; ?></span>
                            <?php } else { ?>
                                <span class="badge bg-primary"><?php echo $data['tipe_anggota']; ?></span>
                            <?php } ?>
                        </td>
                        <td><?php echo $data['alamat']; ?></td>
                        <td>
                            <a href="anggota_edit.php?id=<?php echo $data['id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                            <a href="anggota_hapus.php?id=<?php echo $data['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Hapus anggota ini?')">Hapus</a>
                        </td>
                    </tr>
            <?php
                }
            } else {
            ?>
                <tr>
                    <td colspan="7" class="text-center py-3">Tidak ada data anggota.</td>
                </tr>
            <?php
            }
            ?>
        </tbody>
    </table>
</div>

</div>
</body>
</html>

<?php
include 'koneksi.php';
include 'navbar.php';

if (isset($_GET['cari'])) {
    $cari = $_GET['cari'];
} else {
    $cari = "";
}

if ($cari != "") {
    $query = mysqli_query($conn, "SELECT * FROM buku WHERE judul LIKE '%$cari%' OR kode_buku LIKE '%$cari%' ORDER BY id DESC");
} else {
    $query = mysqli_query($conn, "SELECT * FROM buku ORDER BY id DESC");
}
?>

<div class="d-flex justify-content-between align-items-center mb-3">
    <h4 class="mb-0">Data Buku</h4>
    <a href="buku_tambah.php" class="btn btn-primary">+ Tambah Buku</a>
</div>

<form method="GET" class="row g-2 mb-3">
    <div class="col-auto">
        <input type="text" name="cari" class="form-control" placeholder="Cari judul/kode..." value="<?php echo $cari; ?>">
    </div>
    <div class="col-auto">
        <button type="submit" class="btn btn-secondary">Cari</button>
        <?php if ($cari != "") { ?>
            <a href="buku.php" class="btn btn-outline-secondary">Reset</a>
        <?php } ?>
    </div>
</form>

<div class="card shadow-sm">
    <table class="table table-bordered table-striped mb-0">
        <thead class="table-dark">
            <tr>
                <th>No</th>
                <th>Kode Buku</th>
                <th>Judul Buku</th>
                <th>Pengarang</th>
                <th>Stok</th>
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
                        <td><?php echo $data['kode_buku']; ?></td>
                        <td><b><?php echo $data['judul']; ?></b></td>
                        <td><?php echo $data['pengarang']; ?></td>
                        <td><span class="badge bg-success"><?php echo $data['stok']; ?></span></td>
                        <td>
                            <a href="buku_edit.php?id=<?php echo $data['id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                            <a href="buku_hapus.php?id=<?php echo $data['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Hapus buku ini?')">Hapus</a>
                        </td>
                    </tr>
            <?php
                }
            } else {
            ?>
                <tr>
                    <td colspan="6" class="text-center py-3">Tidak ada data buku.</td>
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

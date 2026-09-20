<?php
include 'koneksi.php';
include 'navbar.php';

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$query = mysqli_query($conn, "SELECT * FROM buku WHERE id = '$id' AND is_delete = 0");
if (mysqli_num_rows($query) === 0) {
    header("Location: buku.php");
    exit();
}
$buku = mysqli_fetch_assoc($query);
$pesan = "";

// Proses Update Buku
if (isset($_POST['update'])) {
    $kode_buku    = mysqli_real_escape_string($conn, trim($_POST['kode_buku']));
    $judul        = mysqli_real_escape_string($conn, trim($_POST['judul']));
    $pengarang    = mysqli_real_escape_string($conn, trim($_POST['pengarang']));
    $penerbit     = mysqli_real_escape_string($conn, trim($_POST['penerbit']));
    $tahun_terbit = (int)$_POST['tahun_terbit'];
    $kategori     = mysqli_real_escape_string($conn, trim($_POST['kategori']));
    $stok         = (int)$_POST['stok'];
    $updated_by   = $_SESSION['user']['nama'];

    $update_query = "UPDATE buku SET 
                        kode_buku = '$kode_buku', 
                        judul = '$judul', 
                        pengarang = '$pengarang', 
                        penerbit = '$penerbit', 
                        tahun_terbit = '$tahun_terbit', 
                        kategori = '$kategori', 
                        stok = '$stok', 
                        updated_by = '$updated_by', 
                        updated_at = NOW() 
                     WHERE id = '$id'";

    if (mysqli_query($conn, $update_query)) {
        echo "<script>alert('Buku berhasil diperbarui!'); window.location='buku.php';</script>";
        exit();
    } else {
        $pesan = "Gagal memperbarui data buku!";
    }
}
?>

<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card shadow-sm p-4">
            <h4 class="mb-3">Edit Data Buku</h4>

            <?php if (!empty($pesan)): ?>
                <div class="alert alert-danger py-2"><?= $pesan; ?></div>
            <?php endif; ?>

            <form method="POST">
                <div class="mb-3">
                    <label class="form-label">Kode Buku</label>
                    <input type="text" name="kode_buku" class="form-control" value="<?= $buku['kode_buku']; ?>" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Judul Buku</label>
                    <input type="text" name="judul" class="form-control" value="<?= $buku['judul']; ?>" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Pengarang</label>
                    <input type="text" name="pengarang" class="form-control" value="<?= $buku['pengarang']; ?>" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Penerbit</label>
                    <input type="text" name="penerbit" class="form-control" value="<?= $buku['penerbit']; ?>" required>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Tahun Terbit</label>
                        <input type="number" name="tahun_terbit" class="form-control" value="<?= $buku['tahun_terbit']; ?>" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Stok</label>
                        <input type="number" name="stok" class="form-control" min="0" value="<?= $buku['stok']; ?>" required>
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label">Kategori</label>
                    <input type="text" name="kategori" class="form-control" value="<?= $buku['kategori']; ?>" required>
                </div>
                <button type="submit" name="update" class="btn btn-warning">Update</button>
                <a href="buku.php" class="btn btn-secondary">Kembali</a>
            </form>
        </div>
    </div>
</div>

</div>
</body>
</html>

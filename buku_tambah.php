<?php
include 'koneksi.php';
include 'navbar.php';

$pesan = "";

// Proses Tambah Buku
if (isset($_POST['simpan'])) {
    $kode_buku    = mysqli_real_escape_string($conn, trim($_POST['kode_buku']));
    $judul        = mysqli_real_escape_string($conn, trim($_POST['judul']));
    $pengarang    = mysqli_real_escape_string($conn, trim($_POST['pengarang']));
    $penerbit     = mysqli_real_escape_string($conn, trim($_POST['penerbit']));
    $tahun_terbit = (int)$_POST['tahun_terbit'];
    $kategori     = mysqli_real_escape_string($conn, trim($_POST['kategori']));
    $stok         = (int)$_POST['stok'];
    $created_by   = $_SESSION['user']['nama'];

    // Cek duplikasi kode buku
    $cek = mysqli_query($conn, "SELECT id FROM buku WHERE kode_buku = '$kode_buku'");
    if (mysqli_num_rows($cek) > 0) {
        $pesan = "Kode Buku sudah terdaftar!";
    } else {
        $query = "INSERT INTO buku (kode_buku, judul, pengarang, penerbit, tahun_terbit, kategori, stok, is_delete, created_by)
                  VALUES ('$kode_buku', '$judul', '$pengarang', '$penerbit', '$tahun_terbit', '$kategori', '$stok', 0, '$created_by')";
        if (mysqli_query($conn, $query)) {
            echo "<script>alert('Buku berhasil disimpan!'); window.location='buku.php';</script>";
            exit();
        } else {
            $pesan = "Gagal menyimpan data buku!";
        }
    }
}
?>

<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card shadow-sm p-4">
            <h4 class="mb-3">Tambah Buku Baru</h4>

            <?php if (!empty($pesan)): ?>
                <div class="alert alert-danger py-2"><?= $pesan; ?></div>
            <?php endif; ?>

            <form method="POST">
                <div class="mb-3">
                    <label class="form-label">Kode Buku</label>
                    <input type="text" name="kode_buku" class="form-control" placeholder="Contoh: BK-005" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Judul Buku</label>
                    <input type="text" name="judul" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Pengarang</label>
                    <input type="text" name="pengarang" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Penerbit</label>
                    <input type="text" name="penerbit" class="form-control" required>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Tahun Terbit</label>
                        <input type="number" name="tahun_terbit" class="form-control" value="<?= date('Y'); ?>" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Stok</label>
                        <input type="number" name="stok" class="form-control" min="0" value="1" required>
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label">Kategori</label>
                    <input type="text" name="kategori" class="form-control" placeholder="Teknologi / Fiksi / Umum" required>
                </div>
                <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
                <a href="buku.php" class="btn btn-secondary">Kembali</a>
            </form>
        </div>
    </div>
</div>

</div>
</body>
</html>

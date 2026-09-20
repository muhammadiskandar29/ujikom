<?php
include 'koneksi.php';
include 'navbar.php';

if (isset($_POST['simpan'])) {
    $kode_buku = $_POST['kode_buku'];
    $judul     = $_POST['judul'];
    $pengarang = $_POST['pengarang'];
    $stok      = $_POST['stok'];

    $sql = "INSERT INTO buku (kode_buku, judul, pengarang, stok) 
            VALUES ('$kode_buku', '$judul', '$pengarang', '$stok')";
    $query = mysqli_query($conn, $sql);

    if ($query) {
        header("Location: buku.php");
    } else {
        echo "<script>alert('Gagal simpan data!');</script>";
    }
}
?>

<h3>Tambah Buku</h3>
<form method="POST">
    <div class="mb-3">
        <label>Kode Buku</label>
        <input type="text" name="kode_buku" class="form-control" required>
    </div>
    <div class="mb-3">
        <label>Judul Buku</label>
        <input type="text" name="judul" class="form-control" required>
    </div>
    <div class="mb-3">
        <label>Pengarang</label>
        <input type="text" name="pengarang" class="form-control" required>
    </div>
    <div class="mb-3">
        <label>Stok</label>
        <input type="number" name="stok" class="form-control" required>
    </div>
    <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
    <a href="buku.php" class="btn btn-secondary">Kembali</a>
</form>

</div>
</body>
</html>

<?php
include 'koneksi.php';
include 'navbar.php';

$id = $_GET['id'];
$query = mysqli_query($conn, "SELECT * FROM buku WHERE id='$id'");
$data = mysqli_fetch_array($query);

if (isset($_POST['update'])) {
    $kode_buku = $_POST['kode_buku'];
    $judul     = $_POST['judul'];
    $pengarang = $_POST['pengarang'];
    $stok      = $_POST['stok'];

    $sql = "UPDATE buku SET 
                kode_buku='$kode_buku', 
                judul='$judul', 
                pengarang='$pengarang', 
                stok='$stok' 
            WHERE id='$id'";
    $update = mysqli_query($conn, $sql);

    if ($update) {
        header("Location: buku.php");
    } else {
        echo "<script>alert('Gagal update data!');</script>";
    }
}
?>

<h3>Edit Buku</h3>
<form method="POST">
    <div class="mb-3">
        <label>Kode Buku</label>
        <input type="text" name="kode_buku" class="form-control" value="<?php echo $data['kode_buku']; ?>" required>
    </div>
    <div class="mb-3">
        <label>Judul Buku</label>
        <input type="text" name="judul" class="form-control" value="<?php echo $data['judul']; ?>" required>
    </div>
    <div class="mb-3">
        <label>Pengarang</label>
        <input type="text" name="pengarang" class="form-control" value="<?php echo $data['pengarang']; ?>" required>
    </div>
    <div class="mb-3">
        <label>Stok</label>
        <input type="number" name="stok" class="form-control" value="<?php echo $data['stok']; ?>" required>
    </div>
    <button type="submit" name="update" class="btn btn-warning">Update</button>
    <a href="buku.php" class="btn btn-secondary">Kembali</a>
</form>

</div>
</body>
</html>

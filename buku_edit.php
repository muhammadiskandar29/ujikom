<?php
include 'koneksi.php';
include 'navbar.php';

$id = (int)$_GET['id'];
$query = mysqli_query($conn, "SELECT * FROM buku WHERE id='$id' AND is_delete=0");
$buku = mysqli_fetch_assoc($query);

if (isset($_POST['update'])) {
    $kode_buku = $_POST['kode_buku'];
    $judul     = $_POST['judul'];
    $pengarang = $_POST['pengarang'];
    $stok      = (int)$_POST['stok'];

    $sql = "UPDATE buku SET 
                kode_buku='$kode_buku', 
                judul='$judul', 
                pengarang='$pengarang', 
                stok='$stok' 
            WHERE id='$id'";
    
    if (mysqli_query($conn, $sql)) {
        header("Location: buku.php");
        exit();
    } else {
        echo "<script>alert('Gagal update data!');</script>";
    }
}
?>

<div class="card p-4 shadow-sm mx-auto" style="max-width: 500px;">
    <h4 class="mb-3">Edit Data Buku</h4>
    <form method="POST">
        <div class="mb-3">
            <label>Kode Buku</label>
            <input type="text" name="kode_buku" class="form-control" value="<?= $buku['kode_buku']; ?>" required>
        </div>
        <div class="mb-3">
            <label>Judul Buku</label>
            <input type="text" name="judul" class="form-control" value="<?= $buku['judul']; ?>" required>
        </div>
        <div class="mb-3">
            <label>Pengarang</label>
            <input type="text" name="pengarang" class="form-control" value="<?= $buku['pengarang']; ?>" required>
        </div>
        <div class="mb-3">
            <label>Stok</label>
            <input type="number" name="stok" class="form-control" min="0" value="<?= $buku['stok']; ?>" required>
        </div>
        <button type="submit" name="update" class="btn btn-warning">Update</button>
        <a href="buku.php" class="btn btn-secondary">Kembali</a>
    </form>
</div>

</div>
</body>
</html>

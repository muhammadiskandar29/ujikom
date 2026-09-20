<?php
include 'koneksi.php';
include 'navbar.php';

$id = (int)$_GET['id'];
$query = mysqli_query($conn, "SELECT * FROM anggota WHERE id='$id' AND is_delete=0");
$anggota = mysqli_fetch_assoc($query);

if (isset($_POST['update'])) {
    $nomor_anggota = $_POST['nomor_anggota'];
    $nama          = $_POST['nama'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $tipe_anggota  = $_POST['tipe_anggota'];
    $alamat        = $_POST['alamat'];

    $sql = "UPDATE anggota SET 
                nomor_anggota='$nomor_anggota', 
                nama='$nama', 
                jenis_kelamin='$jenis_kelamin', 
                tipe_anggota='$tipe_anggota', 
                alamat='$alamat' 
            WHERE id='$id'";
    
    if (mysqli_query($conn, $sql)) {
        header("Location: index.php");
        exit();
    } else {
        echo "<script>alert('Gagal update data!');</script>";
    }
}
?>

<div class="card p-4 shadow-sm mx-auto" style="max-width: 500px;">
    <h4 class="mb-3">Edit Anggota</h4>
    <form method="POST">
        <div class="mb-3">
            <label>Nomor Anggota</label>
            <input type="text" name="nomor_anggota" class="form-control" value="<?= $anggota['nomor_anggota']; ?>" required>
        </div>
        <div class="mb-3">
            <label>Nama Anggota</label>
            <input type="text" name="nama" class="form-control" value="<?= $anggota['nama']; ?>" required>
        </div>
        <div class="mb-3">
            <label>Jenis Kelamin</label>
            <select name="jenis_kelamin" class="form-select" required>
                <option value="Laki-laki" <?= ($anggota['jenis_kelamin'] == 'Laki-laki') ? 'selected' : ''; ?>>Laki-laki</option>
                <option value="Perempuan" <?= ($anggota['jenis_kelamin'] == 'Perempuan') ? 'selected' : ''; ?>>Perempuan</option>
            </select>
        </div>
        <div class="mb-3">
            <label>Tipe Anggota</label>
            <select name="tipe_anggota" class="form-select" required>
                <option value="Staff" <?= ($anggota['tipe_anggota'] == 'Staff') ? 'selected' : ''; ?>>Staff</option>
                <option value="Admin" <?= ($anggota['tipe_anggota'] == 'Admin') ? 'selected' : ''; ?>>Admin</option>
            </select>
        </div>
        <div class="mb-3">
            <label>Alamat</label>
            <textarea name="alamat" class="form-control" rows="2"><?= $anggota['alamat']; ?></textarea>
        </div>
        <button type="submit" name="update" class="btn btn-warning">Update</button>
        <a href="index.php" class="btn btn-secondary">Kembali</a>
    </form>
</div>

</div>
</body>
</html>

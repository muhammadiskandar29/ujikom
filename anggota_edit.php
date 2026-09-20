<?php
include 'koneksi.php';
include 'navbar.php';

$id = $_GET['id'];
$query = mysqli_query($conn, "SELECT * FROM anggota WHERE id='$id'");
$data = mysqli_fetch_array($query);

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
            <input type="text" name="nomor_anggota" class="form-control" value="<?php echo $data['nomor_anggota']; ?>" required>
        </div>
        <div class="mb-3">
            <label>Nama Anggota</label>
            <input type="text" name="nama" class="form-control" value="<?php echo $data['nama']; ?>" required>
        </div>
        <div class="mb-3">
            <label>Jenis Kelamin</label>
            <select name="jenis_kelamin" class="form-select" required>
                <option value="Laki-laki" <?php if ($data['jenis_kelamin'] == 'Laki-laki') { echo "selected"; } ?>>Laki-laki</option>
                <option value="Perempuan" <?php if ($data['jenis_kelamin'] == 'Perempuan') { echo "selected"; } ?>>Perempuan</option>
            </select>
        </div>
        <div class="mb-3">
            <label>Tipe Anggota</label>
            <select name="tipe_anggota" class="form-select" required>
                <option value="Staff" <?php if ($data['tipe_anggota'] == 'Staff') { echo "selected"; } ?>>Staff</option>
                <option value="Admin" <?php if ($data['tipe_anggota'] == 'Admin') { echo "selected"; } ?>>Admin</option>
            </select>
        </div>
        <div class="mb-3">
            <label>Alamat</label>
            <textarea name="alamat" class="form-control" rows="2"><?php echo $data['alamat']; ?></textarea>
        </div>
        <button type="submit" name="update" class="btn btn-warning">Update</button>
        <a href="index.php" class="btn btn-secondary">Kembali</a>
    </form>
</div>

</div>
</body>
</html>

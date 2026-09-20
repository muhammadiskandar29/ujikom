<?php
include 'koneksi.php';
include 'navbar.php';

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$query = mysqli_query($conn, "SELECT * FROM anggota WHERE id = '$id' AND is_delete = 0");
if (mysqli_num_rows($query) === 0) {
    header("Location: index.php");
    exit();
}
$anggota = mysqli_fetch_assoc($query);
$pesan = "";

// Proses Update Anggota
if (isset($_POST['update'])) {
    $nomor_anggota = mysqli_real_escape_string($conn, trim($_POST['nomor_anggota']));
    $nama          = mysqli_real_escape_string($conn, trim($_POST['nama']));
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $tipe_anggota  = $_POST['tipe_anggota'];
    $alamat        = mysqli_real_escape_string($conn, trim($_POST['alamat']));
    $updated_by    = $_SESSION['user']['nama'];

    // Cek duplikasi nomor anggota lain
    $cek = mysqli_query($conn, "SELECT id FROM anggota WHERE nomor_anggota = '$nomor_anggota' AND id != '$id'");
    if (mysqli_num_rows($cek) > 0) {
        $pesan = "Nomor Anggota sudah digunakan oleh anggota lain!";
    } else {
        $sql_pass = "";
        if (!empty($_POST['password'])) {
            $pass_hash = password_hash($_POST['password'], PASSWORD_DEFAULT);
            $sql_pass = ", password = '$pass_hash'";
        }

        $update_query = "UPDATE anggota SET 
                            nomor_anggota = '$nomor_anggota', 
                            nama = '$nama', 
                            jenis_kelamin = '$jenis_kelamin', 
                            tipe_anggota = '$tipe_anggota', 
                            alamat = '$alamat',
                            updated_by = '$updated_by',
                            updated_at = NOW()
                            $sql_pass
                         WHERE id = '$id'";

        if (mysqli_query($conn, $update_query)) {
            if ($_SESSION['user']['id'] == $id) {
                $_SESSION['user']['nama'] = $nama;
            }
            echo "<script>alert('Data anggota berhasil diubah!'); window.location='index.php';</script>";
            exit();
        } else {
            $pesan = "Gagal mengubah data anggota!";
        }
    }
}
?>

<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card shadow-sm p-4">
            <h4 class="mb-3">Edit Data Anggota</h4>

            <?php if (!empty($pesan)): ?>
                <div class="alert alert-danger py-2"><?= $pesan; ?></div>
            <?php endif; ?>

            <form method="POST">
                <div class="mb-3">
                    <label class="form-label">Nomor Anggota</label>
                    <input type="text" name="nomor_anggota" class="form-control" value="<?= $anggota['nomor_anggota']; ?>" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Nama Lengkap</label>
                    <input type="text" name="nama" class="form-control" value="<?= $anggota['nama']; ?>" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Ganti Password (Opsional)</label>
                    <input type="password" name="password" class="form-control" placeholder="Kosongkan jika tidak diganti">
                </div>
                <div class="mb-3">
                    <label class="form-label d-block">Jenis Kelamin</label>
                    <input type="radio" name="jenis_kelamin" value="Laki-laki" <?= ($anggota['jenis_kelamin'] == 'Laki-laki') ? 'checked' : ''; ?>> Laki-laki &nbsp;
                    <input type="radio" name="jenis_kelamin" value="Perempuan" <?= ($anggota['jenis_kelamin'] == 'Perempuan') ? 'checked' : ''; ?>> Perempuan
                </div>
                <div class="mb-3">
                    <label class="form-label">Tipe Anggota</label>
                    <select name="tipe_anggota" class="form-select" required>
                        <option value="Staff" <?= ($anggota['tipe_anggota'] == 'Staff') ? 'selected' : ''; ?>>Staff</option>
                        <option value="Admin" <?= ($anggota['tipe_anggota'] == 'Admin') ? 'selected' : ''; ?>>Admin</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label">Alamat</label>
                    <textarea name="alamat" class="form-control" rows="2"><?= $anggota['alamat']; ?></textarea>
                </div>
                <button type="submit" name="update" class="btn btn-warning">Update</button>
                <a href="index.php" class="btn btn-secondary">Kembali</a>
            </form>
        </div>
    </div>
</div>

</div>
</body>
</html>

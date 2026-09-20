<?php
include 'koneksi.php';
include 'navbar.php';

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$query = mysqli_query($conn, "SELECT * FROM siswa WHERE id = '$id' AND is_delete = 0");
if (mysqli_num_rows($query) === 0) {
    header("Location: index.php");
    exit();
}
$siswa = mysqli_fetch_assoc($query);
$pesan = "";

// Proses Update Data
if (isset($_POST['update'])) {
    $nis           = mysqli_real_escape_string($conn, trim($_POST['nis']));
    $nama          = mysqli_real_escape_string($conn, trim($_POST['nama']));
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $jurusan       = $_POST['jurusan'];
    $alamat        = mysqli_real_escape_string($conn, trim($_POST['alamat']));
    $updated_by    = $_SESSION['user']['nama'];

    // Cek password jika diubah
    $sql_pass = "";
    if (!empty($_POST['password'])) {
        $pass_hash = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $sql_pass = ", password = '$pass_hash'";
    }

    $update_query = "UPDATE siswa SET 
                        nis = '$nis', 
                        nama = '$nama', 
                        jenis_kelamin = '$jenis_kelamin', 
                        jurusan = '$jurusan', 
                        alamat = '$alamat',
                        updated_by = '$updated_by',
                        updated_at = NOW()
                        $sql_pass
                     WHERE id = '$id'";

    if (mysqli_query($conn, $update_query)) {
        if ($_SESSION['user']['id'] == $id) {
            $_SESSION['user']['nama'] = $nama;
        }
        echo "<script>alert('Data berhasil diubah!'); window.location='index.php';</script>";
        exit();
    } else {
        $pesan = "Gagal mengubah data!";
    }
}
?>

<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card shadow-sm p-4">
            <h4 class="mb-3">Edit Siswa</h4>

            <?php if (!empty($pesan)): ?>
                <div class="alert alert-danger py-2"><?= $pesan; ?></div>
            <?php endif; ?>

            <form method="POST">
                <div class="mb-3">
                    <label class="form-label">NIS</label>
                    <input type="text" name="nis" class="form-control" value="<?= $siswa['nis']; ?>" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Nama Lengkap</label>
                    <input type="text" name="nama" class="form-control" value="<?= $siswa['nama']; ?>" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Ganti Password (Opsional)</label>
                    <input type="password" name="password" class="form-control" placeholder="Kosongkan jika tidak diganti">
                </div>
                <div class="mb-3">
                    <label class="form-label d-block">Jenis Kelamin</label>
                    <input type="radio" name="jenis_kelamin" value="Laki-laki" <?= ($siswa['jenis_kelamin'] == 'Laki-laki') ? 'checked' : ''; ?>> Laki-laki &nbsp;
                    <input type="radio" name="jenis_kelamin" value="Perempuan" <?= ($siswa['jenis_kelamin'] == 'Perempuan') ? 'checked' : ''; ?>> Perempuan
                </div>
                <div class="mb-3">
                    <label class="form-label">Jurusan</label>
                    <select name="jurusan" class="form-select" required>
                        <option value="Rekayasa Perangkat Lunak" <?= ($siswa['jurusan'] == 'Rekayasa Perangkat Lunak') ? 'selected' : ''; ?>>Rekayasa Perangkat Lunak (RPL)</option>
                        <option value="Teknik Komputer & Jaringan" <?= ($siswa['jurusan'] == 'Teknik Komputer & Jaringan') ? 'selected' : ''; ?>>Teknik Komputer & Jaringan (TKJ)</option>
                        <option value="Multimedia" <?= ($siswa['jurusan'] == 'Multimedia') ? 'selected' : ''; ?>>Multimedia (MM)</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label">Alamat</label>
                    <textarea name="alamat" class="form-control" rows="2"><?= $siswa['alamat']; ?></textarea>
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

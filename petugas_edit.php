<?php
include 'koneksi.php';
include 'sidebar.php';

$id = $_GET['id'];
$d = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM tb_petugas WHERE id_petugas='$id'"));

// update data petugas
if (isset($_POST['update'])) {
    extract($_POST);
    
    // jika password diisi, update password baru dengan md5
    if (!empty($password)) {
        $pass = md5($password);
        mysqli_query($conn, "UPDATE tb_petugas SET password='$pass', nama_petugas='$nama_petugas', level='$level' WHERE id_petugas='$id'");
    } else {
        mysqli_query($conn, "UPDATE tb_petugas SET nama_petugas='$nama_petugas', level='$level' WHERE id_petugas='$id'");
    }
    header("Location: petugas.php");
}
?>

<h3>Edit Data Petugas</h3>
<form method="POST" style="max-width: 500px;">
    <div class="mb-2"><label>ID Petugas</label><input type="text" name="id_petugas" class="form-control" value="<?= $d['id_petugas']; ?>" readonly></div>
    <div class="mb-2"><label>Username</label><input type="text" name="username" class="form-control" value="<?= $d['username']; ?>" readonly></div>
    <div class="mb-2"><label>Password (Kosongkan jika tidak diubah)</label><input type="password" name="password" class="form-control" placeholder="Password baru"></div>
    <div class="mb-2"><label>Nama Petugas</label><input type="text" name="nama_petugas" class="form-control" value="<?= $d['nama_petugas']; ?>" required></div>
    <div class="mb-2">
        <label>Level Akses</label>
        <select name="level" class="form-control" required>
            <option value="petugas" <?= $d['level'] == 'petugas' ? 'selected' : ''; ?>>Petugas</option>
            <option value="admin" <?= $d['level'] == 'admin' ? 'selected' : ''; ?>>Administrator</option>
            <option value="siswa" <?= $d['level'] == 'siswa' ? 'selected' : ''; ?>>Siswa</option>
        </select>
    </div>
    <button type="submit" name="update" class="btn btn-warning mt-2">Update</button>
    <a href="petugas.php" class="btn btn-secondary mt-2">Kembali</a>
</form>

    </div>
</div>
</body>
</html>

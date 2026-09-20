<?php
include 'koneksi.php';
include 'navbar.php';

$pesan = "";

// Proses Simpan Data
if (isset($_POST['simpan'])) {
    $nis           = mysqli_real_escape_string($conn, trim($_POST['nis']));
    $nama          = mysqli_real_escape_string($conn, trim($_POST['nama']));
    $password      = !empty($_POST['password']) ? password_hash($_POST['password'], PASSWORD_DEFAULT) : password_hash('123456', PASSWORD_DEFAULT);
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $jurusan       = $_POST['jurusan'];
    $alamat        = mysqli_real_escape_string($conn, trim($_POST['alamat']));
    $created_by    = $_SESSION['user']['nama'];

    // Cek duplikasi NIS
    $cek = mysqli_query($conn, "SELECT id FROM siswa WHERE nis = '$nis'");
    if (mysqli_num_rows($cek) > 0) {
        $pesan = "NIS sudah terdaftar!";
    } else {
        $query = "INSERT INTO siswa (nis, nama, password, jenis_kelamin, jurusan, alamat, is_delete, created_by) 
                  VALUES ('$nis', '$nama', '$password', '$jenis_kelamin', '$jurusan', '$alamat', 0, '$created_by')";
        if (mysqli_query($conn, $query)) {
            echo "<script>alert('Data berhasil disimpan!'); window.location='index.php';</script>";
            exit();
        } else {
            $pesan = "Gagal menyimpan data!";
        }
    }
}
?>

<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card shadow-sm p-4">
            <h4 class="mb-3">Tambah Siswa</h4>

            <?php if (!empty($pesan)): ?>
                <div class="alert alert-danger py-2"><?= $pesan; ?></div>
            <?php endif; ?>

            <form method="POST">
                <div class="mb-3">
                    <label class="form-label">NIS</label>
                    <input type="text" name="nis" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Nama Lengkap (User Login)</label>
                    <input type="text" name="nama" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Password (Default: 123456)</label>
                    <input type="password" name="password" class="form-control" placeholder="Kosongkan jika default 123456">
                </div>
                <div class="mb-3">
                    <label class="form-label d-block">Jenis Kelamin</label>
                    <input type="radio" name="jenis_kelamin" value="Laki-laki" checked> Laki-laki &nbsp;
                    <input type="radio" name="jenis_kelamin" value="Perempuan"> Perempuan
                </div>
                <div class="mb-3">
                    <label class="form-label">Jurusan</label>
                    <select name="jurusan" class="form-select" required>
                        <option value="Rekayasa Perangkat Lunak">Rekayasa Perangkat Lunak (RPL)</option>
                        <option value="Teknik Komputer & Jaringan">Teknik Komputer & Jaringan (TKJ)</option>
                        <option value="Multimedia">Multimedia (MM)</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label">Alamat</label>
                    <textarea name="alamat" class="form-control" rows="2"></textarea>
                </div>
                <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
                <a href="index.php" class="btn btn-secondary">Kembali</a>
            </form>
        </div>
    </div>
</div>

</div>
</body>
</html>

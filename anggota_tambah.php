<?php
include 'koneksi.php';
include 'navbar.php';

$pesan = "";

// Proses Tambah Anggota
if (isset($_POST['simpan'])) {
    $nomor_anggota = mysqli_real_escape_string($conn, trim($_POST['nomor_anggota']));
    $nama          = mysqli_real_escape_string($conn, trim($_POST['nama']));
    $password      = !empty($_POST['password']) ? password_hash($_POST['password'], PASSWORD_DEFAULT) : password_hash('123456', PASSWORD_DEFAULT);
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $tipe_anggota  = $_POST['tipe_anggota'];
    $alamat        = mysqli_real_escape_string($conn, trim($_POST['alamat']));
    $created_by    = $_SESSION['user']['nama'];

    // Cek duplikasi nomor anggota
    $cek = mysqli_query($conn, "SELECT id FROM anggota WHERE nomor_anggota = '$nomor_anggota'");
    if (mysqli_num_rows($cek) > 0) {
        $pesan = "Nomor Anggota sudah terdaftar!";
    } else {
        $query = "INSERT INTO anggota (nomor_anggota, nama, password, jenis_kelamin, tipe_anggota, alamat, is_delete, created_by) 
                  VALUES ('$nomor_anggota', '$nama', '$password', '$jenis_kelamin', '$tipe_anggota', '$alamat', 0, '$created_by')";
        if (mysqli_query($conn, $query)) {
            echo "<script>alert('Anggota berhasil ditambahkan!'); window.location='index.php';</script>";
            exit();
        } else {
            $pesan = "Gagal menyimpan data anggota!";
        }
    }
}
?>

<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card shadow-sm p-4">
            <h4 class="mb-3">Tambah Anggota Baru</h4>

            <?php if (!empty($pesan)): ?>
                <div class="alert alert-danger py-2"><?= $pesan; ?></div>
            <?php endif; ?>

            <form method="POST">
                <div class="mb-3">
                    <label class="form-label">Nomor Anggota</label>
                    <input type="text" name="nomor_anggota" class="form-control" placeholder="Contoh: ANG-004" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Nama Lengkap (User Login)</label>
                    <input type="text" name="nama" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Password Akun (Default: 123456)</label>
                    <input type="password" name="password" class="form-control" placeholder="Kosongkan jika ingin default 123456">
                </div>
                <div class="mb-3">
                    <label class="form-label d-block">Jenis Kelamin</label>
                    <input type="radio" name="jenis_kelamin" value="Laki-laki" checked> Laki-laki &nbsp;
                    <input type="radio" name="jenis_kelamin" value="Perempuan"> Perempuan
                </div>
                <div class="mb-3">
                    <label class="form-label">Tipe Anggota</label>
                    <select name="tipe_anggota" class="form-select" required>
                        <option value="Staff" selected>Staff</option>
                        <option value="Admin">Admin</option>
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

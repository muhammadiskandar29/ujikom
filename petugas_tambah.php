<?php
include 'koneksi.php';
include 'sidebar.php';

// simpan data petugas baru
if (isset($_POST['simpan'])) {
    extract($_POST);
    
    // validasi cek apakah ID Petugas atau Username sudah terdaftar
    $cek = mysqli_query($conn, "SELECT * FROM tb_petugas WHERE id_petugas='$id_petugas' OR username='$username'");
    if (mysqli_num_rows($cek) > 0) {
        echo "<script>
                alert('Gagal! ID Petugas ($id_petugas) atau Username ($username) sudah digunakan.');
                window.location.href = 'petugas_tambah.php';
              </script>";
    } else {
        $pass = md5($password);
        $simpan = mysqli_query($conn, "INSERT INTO tb_petugas VALUES ('$id_petugas', '$username', '$pass', '$nama_petugas', '$level')");
        if ($simpan) {
            echo "<script>
                    alert('Data Petugas berhasil disimpan!');
                    window.location.href = 'petugas.php';
                  </script>";
        }
    }
}
?>

<h3>Tambah Data Petugas</h3>
<form method="POST" style="max-width: 500px;">
    <div class="mb-2"><label>ID Petugas</label><input type="text" name="id_petugas" class="form-control" required placeholder="Contoh: PTG06"></div>
    <div class="mb-2"><label>Username</label><input type="text" name="username" class="form-control" required placeholder="Username login"></div>
    <div class="mb-2"><label>Password</label><input type="password" name="password" class="form-control" required placeholder="Password"></div>
    <div class="mb-2"><label>Nama Petugas</label><input type="text" name="nama_petugas" class="form-control" required placeholder="Nama lengkap"></div>
    <div class="mb-2">
        <label>Level Akses</label>
        <select name="level" class="form-control" required>
            <option value="petugas">Petugas</option>
            <option value="admin">Administrator</option>
            <option value="siswa">Siswa</option>
        </select>
    </div>
    <button type="submit" name="simpan" class="btn btn-success mt-2">Simpan</button>
    <a href="petugas.php" class="btn btn-secondary mt-2">Kembali</a>
</form>

    </div>
</div>
</body>
</html>

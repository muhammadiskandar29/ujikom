<?php
include 'koneksi.php';
include 'sidebar.php';

// simpan data kelas baru
if (isset($_POST['simpan'])) {
    extract($_POST);
    
    // validasi cek apakah ID Kelas atau Nama Kelas sudah terdaftar
    $cek = mysqli_query($conn, "SELECT * FROM tb_kelas WHERE id_kelas='$id_kelas' OR nama_kelas='$nama_kelas'");
    if (mysqli_num_rows($cek) > 0) {
        echo "<script>
                alert('Gagal! ID Kelas ($id_kelas) atau Nama Kelas ($nama_kelas) sudah terdaftar di sistem.');
                window.location.href = 'kelas_tambah.php';
              </script>";
    } else {
        $simpan = mysqli_query($conn, "INSERT INTO tb_kelas VALUES ('$id_kelas', '$nama_kelas', '$komp_keahlian')");
        if ($simpan) {
            echo "<script>
                    alert('Data Kelas berhasil disimpan!');
                    window.location.href = 'kelas.php';
                  </script>";
        }
    }
}
?>

<h3>Tambah Data Kelas</h3>
<form method="POST" style="max-width: 500px;">
    <div class="mb-2"><label>ID Kelas</label><input type="text" name="id_kelas" class="form-control" required placeholder="Contoh: KLS06"></div>
    <div class="mb-2"><label>Nama Kelas</label><input type="text" name="nama_kelas" class="form-control" required placeholder="Contoh: X RPL 2"></div>
    <div class="mb-2"><label>Kompetensi Keahlian</label><input type="text" name="komp_keahlian" class="form-control" required placeholder="Contoh: Rekayasa Perangkat Lunak"></div>
    <button type="submit" name="simpan" class="btn btn-success mt-2">Simpan</button>
    <a href="kelas.php" class="btn btn-secondary mt-2">Kembali</a>
</form>

    </div>
</div>
</body>
</html>

<?php
include 'koneksi.php';
include 'sidebar.php';

// simpan data kelas baru
if (isset($_POST['simpan'])) {
    extract($_POST);
    mysqli_query($conn, "INSERT INTO tb_kelas VALUES ('$id_kelas', '$nama_kelas', '$komp_keahlian')");
    header("Location: kelas.php");
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

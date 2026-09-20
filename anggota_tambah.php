<?php
include 'koneksi.php';
include 'navbar.php';

if (isset($_POST['simpan'])) {
    $nomor_anggota = $_POST['nomor_anggota'];
    $nama          = $_POST['nama'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $tipe_anggota  = $_POST['tipe_anggota'];
    $alamat        = $_POST['alamat'];

    $sql = "INSERT INTO anggota (nomor_anggota, nama, jenis_kelamin, tipe_anggota, alamat) 
            VALUES ('$nomor_anggota', '$nama', '$jenis_kelamin', '$tipe_anggota', '$alamat')";
    $query = mysqli_query($conn, $sql);

    if ($query) {
        header("Location: index.php");
    } else {
        echo "<script>alert('Gagal simpan data!');</script>";
    }
}
?>

<h3>Tambah Anggota</h3>
<form method="POST">
    <div class="mb-3">
        <label>Nomor Anggota</label>
        <input type="text" name="nomor_anggota" class="form-control" required>
    </div>
    <div class="mb-3">
        <label>Nama</label>
        <input type="text" name="nama" class="form-control" required>
    </div>
    <div class="mb-3">
        <label>Jenis Kelamin</label>
        <select name="jenis_kelamin" class="form-control" required>
            <option value="Laki-laki">Laki-laki</option>
            <option value="Perempuan">Perempuan</option>
        </select>
    </div>
    <div class="mb-3">
        <label>Tipe Anggota</label>
        <select name="tipe_anggota" class="form-control" required>
            <option value="Staff">Staff</option>
            <option value="Admin">Admin</option>
        </select>
    </div>
    <div class="mb-3">
        <label>Alamat</label>
        <textarea name="alamat" class="form-control" required></textarea>
    </div>
    <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
    <a href="index.php" class="btn btn-secondary">Kembali</a>
</form>

</div>
</body>
</html>

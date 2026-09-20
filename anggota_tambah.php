<?php
include 'koneksi.php';
include 'navbar.php';

if (isset($_POST['simpan'])) {
    $nomor_anggota = $_POST['nomor_anggota'];
    $nama          = $_POST['nama'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $tipe_anggota  = $_POST['tipe_anggota'];
    $alamat        = $_POST['alamat'];

    $sql = "INSERT INTO anggota (nomor_anggota, nama, jenis_kelamin, tipe_anggota, alamat, is_delete) 
            VALUES ('$nomor_anggota', '$nama', '$jenis_kelamin', '$tipe_anggota', '$alamat', 0)";
    
    if (mysqli_query($conn, $sql)) {
        header("Location: index.php");
        exit();
    } else {
        echo "<script>alert('Gagal simpan! Nomor anggota mungkin sudah ada.');</script>";
    }
}
?>

<div class="card p-4 shadow-sm mx-auto" style="max-width: 500px;">
    <h4 class="mb-3">Tambah Anggota</h4>
    <form method="POST">
        <div class="mb-3">
            <label>Nomor Anggota</label>
            <input type="text" name="nomor_anggota" class="form-control" placeholder="Contoh: ANG-004" required>
        </div>
        <div class="mb-3">
            <label>Nama Anggota</label>
            <input type="text" name="nama" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Jenis Kelamin</label>
            <select name="jenis_kelamin" class="form-select" required>
                <option value="Laki-laki">Laki-laki</option>
                <option value="Perempuan">Perempuan</option>
            </select>
        </div>
        <div class="mb-3">
            <label>Tipe Anggota</label>
            <select name="tipe_anggota" class="form-select" required>
                <option value="Staff">Staff</option>
                <option value="Admin">Admin</option>
            </select>
        </div>
        <div class="mb-3">
            <label>Alamat</label>
            <textarea name="alamat" class="form-control" rows="2"></textarea>
        </div>
        <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
        <a href="index.php" class="btn btn-secondary">Kembali</a>
    </form>
</div>

</div>
</body>
</html>

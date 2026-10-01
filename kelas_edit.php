<?php
include 'koneksi.php';
include 'sidebar.php';

$id = $_GET['id'];
$d = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM tb_kelas WHERE id_kelas='$id'"));

// update data kelas
if (isset($_POST['update'])) {
    extract($_POST);
    mysqli_query($conn, "UPDATE tb_kelas SET nama_kelas='$nama_kelas', komp_keahlian='$komp_keahlian' WHERE id_kelas='$id'");
    header("Location: kelas.php");
}
?>

<h3>Edit Data Kelas</h3>
<form method="POST" style="max-width: 500px;">
    <div class="mb-2"><label>ID Kelas</label><input type="text" name="id_kelas" class="form-control" value="<?= $d['id_kelas']; ?>" readonly></div>
    <div class="mb-2"><label>Nama Kelas</label><input type="text" name="nama_kelas" class="form-control" value="<?= $d['nama_kelas']; ?>" required></div>
    <div class="mb-2"><label>Kompetensi Keahlian</label><input type="text" name="komp_keahlian" class="form-control" value="<?= $d['komp_keahlian']; ?>" required></div>
    <button type="submit" name="update" class="btn btn-warning mt-2">Update</button>
    <a href="kelas.php" class="btn btn-secondary mt-2">Kembali</a>
</form>

    </div>
</div>
</body>
</html>

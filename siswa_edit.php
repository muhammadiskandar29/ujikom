<?php
include 'koneksi.php';
include 'sidebar.php';

$nisn = $_GET['nisn'];
$data = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM tb_siswa WHERE nisn='$nisn'"));

if (isset($_POST['update'])) {
    extract($_POST);
    $k = mysqli_fetch_array(mysqli_query($conn, "SELECT nama_kelas FROM tb_kelas WHERE id_kelas='$id_kelas'"));
    $nama_kelas = $k['nama_kelas'];
    
    mysqli_query($conn, "UPDATE tb_siswa SET nis='$nis', nama='$nama', id_kelas='$id_kelas', nama_kelas='$nama_kelas', alamat='$alamat', no_tlp='$no_tlp', id_spp='$id_spp' WHERE nisn='$nisn'");
    mysqli_query($conn, "UPDATE cek_pembayaran SET nama='$nama', no_tlp='$no_tlp' WHERE nisn='$nisn'");
    header("Location: siswa.php");
}
?>

<h3>Edit Siswa</h3>
<form method="POST" style="max-width: 500px;">
    <div class="mb-2"><label>NISN</label><input type="text" name="nisn" class="form-control" value="<?= $data['nisn']; ?>" readonly></div>
    <div class="mb-2"><label>NIS</label><input type="text" name="nis" class="form-control" value="<?= $data['nis']; ?>" required></div>
    <div class="mb-2"><label>Nama Siswa</label><input type="text" name="nama" class="form-control" value="<?= $data['nama']; ?>" required></div>
    <div class="mb-2">
        <label>Kelas</label>
        <select name="id_kelas" class="form-control" required>
            <?php
            $qk = mysqli_query($conn, "SELECT * FROM tb_kelas");
            while ($k = mysqli_fetch_array($qk)) {
                $sel = $k['id_kelas'] == $data['id_kelas'] ? 'selected' : '';
                echo "<option value='$k[id_kelas]' $sel>$k[nama_kelas]</option>";
            }
            ?>
        </select>
    </div>
    <div class="mb-2">
        <label>Tarif SPP</label>
        <select name="id_spp" class="form-control" required>
            <?php
            $qs = mysqli_query($conn, "SELECT * FROM tb_spp");
            while ($s = mysqli_fetch_array($qs)) {
                $sel = $s['id_spp'] == $data['id_spp'] ? 'selected' : '';
                echo "<option value='$s[id_spp]' $sel>$s[id_spp] - Tahun $s[tahun]</option>";
            }
            ?>
        </select>
    </div>
    <div class="mb-2"><label>No Telepon</label><input type="text" name="no_tlp" class="form-control" value="<?= $data['no_tlp']; ?>" required></div>
    <div class="mb-2"><label>Alamat</label><textarea name="alamat" class="form-control" rows="2" required><?= $data['alamat']; ?></textarea></div>
    <button type="submit" name="update" class="btn btn-warning mt-2">Update</button>
    <a href="siswa.php" class="btn btn-secondary mt-2">Kembali</a>
</form>

    </div>
</div>
</body>
</html>

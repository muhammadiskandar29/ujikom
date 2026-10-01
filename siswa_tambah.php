<?php
include 'koneksi.php';
include 'sidebar.php';

// simpan data siswa baru
if (isset($_POST['simpan'])) {
    extract($_POST);
    
    // ambil nama kelas berdasarkan id kelas yang dipilih
    $k = mysqli_fetch_array(mysqli_query($conn, "SELECT nama_kelas FROM tb_kelas WHERE id_kelas='$id_kelas'"));
    $nama_kelas = $k['nama_kelas'];
    
    // simpan data ke tabel siswa
    mysqli_query($conn, "INSERT INTO tb_siswa VALUES ('$nisn', '$nis', '$nama', '$id_kelas', '$nama_kelas', '$alamat', '$no_tlp', '$id_spp')");
    
    // inisialisasi status tagihan pertama di cek_pembayaran jadi belum lunas
    mysqli_query($conn, "INSERT INTO cek_pembayaran VALUES ('$nisn', NULL, '" . date('Y-m-d') . "', 'belum lunas', '0', '$nama', '$no_tlp')");
    
    header("Location: siswa.php");
}
?>

<h3>Tambah Siswa</h3>
<form method="POST" style="max-width: 500px;">
    <div class="mb-2"><label>NISN</label><input type="text" name="nisn" class="form-control" maxlength="10" required></div>
    <div class="mb-2"><label>NIS</label><input type="text" name="nis" class="form-control" maxlength="8" required></div>
    <div class="mb-2"><label>Nama Siswa</label><input type="text" name="nama" class="form-control" required></div>
    <div class="mb-2">
        <label>Kelas</label>
        <select name="id_kelas" class="form-control" required>
            <option value="">-- Pilih Kelas --</option>
            <?php
            // looping daftar kelas untuk pilihan
            $qk = mysqli_query($conn, "SELECT * FROM tb_kelas");
            while ($k = mysqli_fetch_array($qk)) {
                echo "<option value='$k[id_kelas]'>$k[nama_kelas] ($k[komp_keahlian])</option>";
            }
            ?>
        </select>
    </div>
    <div class="mb-2">
        <label>Tarif SPP</label>
        <select name="id_spp" class="form-control" required>
            <option value="">-- Pilih SPP --</option>
            <?php
            // looping daftar tarif spp
            $qs = mysqli_query($conn, "SELECT * FROM tb_spp");
            while ($s = mysqli_fetch_array($qs)) {
                echo "<option value='$s[id_spp]'>$s[id_spp] - Tahun $s[tahun] (Rp $s[nominal])</option>";
            }
            ?>
        </select>
    </div>
    <div class="mb-2"><label>No Telepon</label><input type="text" name="no_tlp" class="form-control" required></div>
    <div class="mb-2"><label>Alamat</label><textarea name="alamat" class="form-control" rows="2" required></textarea></div>
    <button type="submit" name="simpan" class="btn btn-primary mt-2">Simpan</button>
    <a href="siswa.php" class="btn btn-secondary mt-2">Kembali</a>
</form>

    </div>
</div>
</body>
</html>

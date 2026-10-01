<?php
include 'koneksi.php';
include 'sidebar.php';

// simpan transaksi pembayaran
if (isset($_POST['bayar'])) {
    extract($_POST);
    
    // validasi cek apakah ID Pembayaran sudah terdaftar
    $cek = mysqli_query($conn, "SELECT * FROM tb_pembayaran WHERE id_pembayaran='$id_pembayaran'");
    if (mysqli_num_rows($cek) > 0) {
        echo "<script>
                alert('Gagal! ID Pembayaran $id_pembayaran sudah pernah digunakan.');
                window.location.href = 'pembayaran_tambah.php';
              </script>";
    } else {
        $kembalian = $jumlah_bayar - $nominal_bayar;
        $d = mysqli_fetch_array(mysqli_query($conn, "SELECT id_spp FROM tb_siswa WHERE nisn='$nisn'"));
        
        $simpan = mysqli_query($conn, "INSERT INTO tb_pembayaran VALUES ('$id_pembayaran', '$nisn', '$tgl_bayar', '$tgl_bayar', '$batas_pembayaran', '$jumlah_bulan', '$d[id_spp]', '$nominal_bayar', '$jumlah_bayar', '$kembalian', 'sudah lunas')");
        mysqli_query($conn, "UPDATE cek_pembayaran SET tgl_terakhir_bayar='$tgl_bayar', tgl_sekarang='$tgl_bayar', status_pembayaran='sudah lunas', jumlah_bulan='$jumlah_bulan' WHERE nisn='$nisn'");
        
        if ($simpan) {
            echo "<script>
                    alert('Transaksi pembayaran berhasil disimpan!');
                    window.location.href = 'pembayaran.php';
                  </script>";
        }
    }
}
?>

<h3>Transaksi Pembayaran SPP</h3>
<form method="POST" style="max-width: 500px;">
    <div class="mb-2"><label>ID Pembayaran</label><input type="text" name="id_pembayaran" class="form-control" required placeholder="Contoh: BYR003"></div>
    <div class="mb-2">
        <label>Pilih Siswa</label>
        <select name="nisn" class="form-control" required>
            <option value="">-- Pilih Siswa --</option>
            <?php
            $q = mysqli_query($conn, "SELECT * FROM tb_siswa");
            while ($s = mysqli_fetch_array($q)) {
                echo "<option value='$s[nisn]'>$s[nisn] - $s[nama]</option>";
            }
            ?>
        </select>
    </div>
    <div class="mb-2"><label>Tanggal Bayar</label><input type="date" name="tgl_bayar" class="form-control" value="<?= date('Y-m-d'); ?>" required></div>
    <div class="mb-2"><label>Batas Pembayaran</label><input type="date" name="batas_pembayaran" class="form-control" value="<?= date('Y-m-15'); ?>" required></div>
    <div class="mb-2"><label>Jumlah Bulan</label><input type="number" name="jumlah_bulan" class="form-control" value="1" required></div>
    <div class="mb-2"><label>Nominal Tagihan</label><input type="number" name="nominal_bayar" class="form-control" required placeholder="Contoh: 450000"></div>
    <div class="mb-2"><label>Jumlah Bayar</label><input type="number" name="jumlah_bayar" class="form-control" required placeholder="Contoh: 500000"></div>
    <button type="submit" name="bayar" class="btn btn-success mt-2">Bayar</button>
    <a href="pembayaran.php" class="btn btn-secondary mt-2">Kembali</a>
</form>

    </div>
</div>
</body>
</html>

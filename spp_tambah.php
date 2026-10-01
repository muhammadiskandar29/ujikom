<?php
include 'koneksi.php';
include 'sidebar.php';

if (isset($_POST['simpan'])) {
    extract($_POST);
    
    // validasi cek apakah ID SPP sudah terdaftar
    $cek = mysqli_query($conn, "SELECT * FROM tb_spp WHERE id_spp='$id_spp'");
    if (mysqli_num_rows($cek) > 0) {
        echo "<script>
                alert('Gagal! ID SPP $id_spp sudah terdaftar di sistem.');
                window.location.href = 'spp_tambah.php';
              </script>";
    } else {
        $simpan = mysqli_query($conn, "INSERT INTO tb_spp VALUES ('$id_spp', '$tahun', '$nominal')");
        if ($simpan) {
            echo "<script>
                    alert('Data SPP berhasil disimpan!');
                    window.location.href = 'spp.php';
                  </script>";
        }
    }
}
?>

<h3>Tambah SPP</h3>
<form method="POST" style="max-width: 450px;">
    <div class="mb-2"><label>ID SPP</label><input type="text" name="id_spp" class="form-control" required placeholder="Contoh: SPP06"></div>
    <div class="mb-2"><label>Tahun</label><input type="number" name="tahun" class="form-control" required placeholder="Contoh: 2026"></div>
    <div class="mb-2"><label>Nominal</label><input type="number" name="nominal" class="form-control" required placeholder="Contoh: 450000"></div>
    <button type="submit" name="simpan" class="btn btn-primary mt-2">Simpan</button>
    <a href="spp.php" class="btn btn-secondary mt-2">Kembali</a>
</form>

    </div>
</div>
</body>
</html>

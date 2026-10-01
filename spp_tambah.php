<?php
include 'koneksi.php';
include 'sidebar.php';

if (isset($_POST['simpan'])) {
    extract($_POST);
    mysqli_query($conn, "INSERT INTO tb_spp VALUES ('$id_spp', '$tahun', '$nominal')");
    header("Location: spp.php");
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

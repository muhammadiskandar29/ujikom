<?php
include 'koneksi.php';
include 'sidebar.php';

$id = $_GET['id'];
$data = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM tb_spp WHERE id_spp='$id'"));

if (isset($_POST['update'])) {
    extract($_POST);
    mysqli_query($conn, "UPDATE tb_spp SET tahun='$tahun', nominal='$nominal' WHERE id_spp='$id'");
    header("Location: spp.php");
}
?>

<h3>Edit SPP</h3>
<form method="POST" style="max-width: 450px;">
    <div class="mb-2"><label>ID SPP</label><input type="text" name="id_spp" class="form-control" value="<?= $data['id_spp']; ?>" readonly></div>
    <div class="mb-2"><label>Tahun</label><input type="number" name="tahun" class="form-control" value="<?= $data['tahun']; ?>" required></div>
    <div class="mb-2"><label>Nominal</label><input type="number" name="nominal" class="form-control" value="<?= $data['nominal']; ?>" required></div>
    <button type="submit" name="update" class="btn btn-warning mt-2">Update</button>
    <a href="spp.php" class="btn btn-secondary mt-2">Kembali</a>
</form>

    </div>
</div>
</body>
</html>

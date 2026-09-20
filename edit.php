<?php
require_once 'config/database.php';

// Pastikan parameter ID ada dan valid
if (!isset($_GET['id']) || empty($_GET['id'])) {
    header("Location: index.php");
    exit();
}

$id = mysqli_real_escape_string($conn, $_GET['id']);
$query = "SELECT * FROM siswa WHERE id = '$id' AND is_delete = 0 LIMIT 1";
$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) === 0) {
    header("Location: index.php");
    exit();
}

$siswa = mysqli_fetch_assoc($result);

$page_title = "Edit Siswa: " . htmlspecialchars($siswa['nama']);
require_once 'includes/header.php';
?>

<div class="row justify-content-center">
    <div class="col-lg-8">
        <!-- Tombol Kembali -->
        <div class="mb-3">
            <a href="index.php" class="btn btn-outline-secondary btn-sm">
                <i class="bi bi-arrow-left me-1"></i> Kembali ke Daftar Siswa
            </a>
        </div>

        <div class="card shadow-sm">
            <div class="card-header bg-warning text-dark py-3">
                <h5 class="card-title mb-0 fw-bold">
                    <i class="bi bi-pencil-square me-2"></i>Form Edit Data Siswa
                </h5>
            </div>
            <div class="card-body p-4">
                <form action="proses_edit.php" method="POST">
                    <!-- Hidden ID Siswa -->
                    <input type="hidden" name="id" value="<?= $siswa['id']; ?>">

                    <!-- NIS -->
                    <div class="mb-3">
                        <label for="nis" class="form-label fw-semibold">NIS (Nomor Induk Siswa) <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="nis" name="nis" value="<?= htmlspecialchars($siswa['nis']); ?>" required>
                    </div>

                    <!-- Nama Lengkap -->
                    <div class="mb-3">
                        <label for="nama" class="form-label fw-semibold">Nama Lengkap (User Login) <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="nama" name="nama" value="<?= htmlspecialchars($siswa['nama']); ?>" required>
                    </div>

                    <!-- Ganti Password -->
                    <div class="mb-3">
                        <label for="password" class="form-label fw-semibold">Ganti Password (Opsional)</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Kosongkan jika tidak ingin mengubah password">
                        <div class="form-text text-muted">Biarkan kosong jika tetap menggunakan password lama.</div>
                    </div>

                    <!-- Jenis Kelamin -->
                    <div class="mb-3">
                        <label class="form-label fw-semibold d-block">Jenis Kelamin <span class="text-danger">*</span></label>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="jenis_kelamin" id="jk_l" value="Laki-laki" <?= ($siswa['jenis_kelamin'] == 'Laki-laki') ? 'checked' : ''; ?> required>
                            <label class="form-check-label" for="jk_l">
                                <i class="bi bi-gender-male text-primary"></i> Laki-laki
                            </label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="jenis_kelamin" id="jk_p" value="Perempuan" <?= ($siswa['jenis_kelamin'] == 'Perempuan') ? 'checked' : ''; ?> required>
                            <label class="form-check-label" for="jk_p">
                                <i class="bi bi-gender-female text-danger"></i> Perempuan
                            </label>
                        </div>
                    </div>

                    <!-- Jurusan -->
                    <div class="mb-3">
                        <label for="jurusan" class="form-label fw-semibold">Kompetensi Keahlian / Jurusan <span class="text-danger">*</span></label>
                        <select class="form-select" id="jurusan" name="jurusan" required>
                            <option value="" disabled>-- Pilih Jurusan --</option>
                            <?php
                            $jurusan_options = [
                                "Rekayasa Perangkat Lunak" => "Rekayasa Perangkat Lunak (RPL)",
                                "Teknik Komputer & Jaringan" => "Teknik Komputer & Jaringan (TKJ)",
                                "Multimedia" => "Multimedia (MM) / DKV",
                                "Akuntansi & Keuangan" => "Akuntansi & Keuangan (AKL)",
                                "Otomatisasi & Tata Kelola Perkantoran" => "Otomatisasi Perkantoran (OTKP)"
                            ];
                            foreach ($jurusan_options as $key => $label) {
                                $selected = ($siswa['jurusan'] == $key) ? 'selected' : '';
                                echo "<option value=\"$key\" $selected>$label</option>";
                            }
                            ?>
                        </select>
                    </div>

                    <!-- Alamat -->
                    <div class="mb-4">
                        <label for="alamat" class="form-label fw-semibold">Alamat</label>
                        <textarea class="form-control" id="alamat" name="alamat" rows="3"><?= htmlspecialchars($siswa['alamat'] ?? ''); ?></textarea>
                    </div>

                    <!-- Tombol Aksi -->
                    <div class="d-flex justify-content-end gap-2">
                        <a href="index.php" class="btn btn-secondary">Batal</a>
                        <button type="submit" name="update" class="btn btn-warning fw-semibold px-4">
                            <i class="bi bi-check2-circle me-1"></i> Perbarui Data
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php require_once 'includes/footer.php'; ?>

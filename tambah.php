<?php
$page_title = "Tambah Siswa Baru";
require_once 'includes/header.php';
?>

<div class="row justify-content-center">
    <div class="col-lg-8">
        <!-- Breadcrumb / Tombol Kembali -->
        <div class="mb-3">
            <a href="index.php" class="btn btn-outline-secondary btn-sm">
                <i class="bi bi-arrow-left me-1"></i> Kembali ke Daftar Siswa
            </a>
        </div>

        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white py-3">
                <h5 class="card-title mb-0">
                    <i class="bi bi-person-plus-fill me-2"></i>Form Tambah Data Siswa
                </h5>
            </div>
            <div class="card-body p-4">
                <form action="proses_tambah.php" method="POST">
                    <!-- NIS -->
                    <div class="mb-3">
                        <label for="nis" class="form-label fw-semibold">NIS (Nomor Induk Siswa) <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="nis" name="nis" placeholder="Contoh: 1004" required autofocus>
                        <div class="form-text">Pastikan nomor induk siswa unik dan belum terdaftar.</div>
                    </div>

                    <!-- Nama Lengkap -->
                    <div class="mb-3">
                        <label for="nama" class="form-label fw-semibold">Nama Lengkap (User Login) <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="nama" name="nama" placeholder="Masukkan nama lengkap siswa" required>
                        <div class="form-text">Nama ini juga akan digunakan sebagai username saat login.</div>
                    </div>

                    <!-- Password Akun -->
                    <div class="mb-3">
                        <label for="password" class="form-label fw-semibold">Password Akun</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Default: 123456 (kosongkan jika ingin default)">
                        <div class="form-text text-muted">Jika dikosongkan, password otomatis menjadi <code>123456</code>.</div>
                    </div>

                    <!-- Jenis Kelamin -->
                    <div class="mb-3">
                        <label class="form-label fw-semibold d-block">Jenis Kelamin <span class="text-danger">*</span></label>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="jenis_kelamin" id="jk_l" value="Laki-laki" required>
                            <label class="form-check-label" for="jk_l">
                                <i class="bi bi-gender-male text-primary"></i> Laki-laki
                            </label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="jenis_kelamin" id="jk_p" value="Perempuan" required>
                            <label class="form-check-label" for="jk_p">
                                <i class="bi bi-gender-female text-danger"></i> Perempuan
                            </label>
                        </div>
                    </div>

                    <!-- Jurusan -->
                    <div class="mb-3">
                        <label for="jurusan" class="form-label fw-semibold">Kompetensi Keahlian / Jurusan <span class="text-danger">*</span></label>
                        <select class="form-select" id="jurusan" name="jurusan" required>
                            <option value="" disabled selected>-- Pilih Jurusan --</option>
                            <option value="Rekayasa Perangkat Lunak">Rekayasa Perangkat Lunak (RPL)</option>
                            <option value="Teknik Komputer & Jaringan">Teknik Komputer & Jaringan (TKJ)</option>
                            <option value="Multimedia">Multimedia (MM) / DKV</option>
                            <option value="Akuntansi & Keuangan">Akuntansi & Keuangan (AKL)</option>
                            <option value="Otomatisasi & Tata Kelola Perkantoran">Otomatisasi Perkantoran (OTKP)</option>
                        </select>
                    </div>

                    <!-- Alamat -->
                    <div class="mb-4">
                        <label for="alamat" class="form-label fw-semibold">Alamat</label>
                        <textarea class="form-control" id="alamat" name="alamat" rows="3" placeholder="Masukkan alamat domisili siswa..."></textarea>
                    </div>

                    <!-- Tombol Aksi -->
                    <div class="d-flex justify-content-end gap-2">
                        <a href="index.php" class="btn btn-secondary">Batal</a>
                        <button type="submit" name="submit" class="btn btn-primary px-4">
                            <i class="bi bi-save me-1"></i> Simpan Data
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php require_once 'includes/footer.php'; ?>

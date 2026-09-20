# SIM Siswa - Aplikasi CRUD Standar PHP Native & Bootstrap 5

Aplikasi manajemen data siswa sederhana berbasis **PHP Native** dan **Bootstrap 5**, dilengkapi dengan sistem **Session Login Siswa**, **Soft Delete (`is_delete`)**, dan **Audit Trail** (`created_at`, `created_by`, `updated_at`, `updated_by`).

---

## 🚀 Fitur Utama
1. **Sistem Login & Session**:
   - Login menggunakan **Nama Siswa** dan **Password**.
   - Session login siswa dengan proteksi halaman terpusat.
   - Fitur logout untuk mengakhiri sesi.
2. **Soft Delete (`is_delete`)**:
   - Data yang dihapus tidak langsung hilang dari database, melainkan ditandai dengan `is_delete = 1`.
   - Data yang tampil di halaman utama hanya data yang aktif (`is_delete = 0`).
3. **Audit Trail**:
   - `created_at`: Waktu data pertama kali dibuat.
   - `created_by`: Nama user/siswa yang membuat data tersebut.
   - `updated_at`: Waktu data terakhir diubah / dihapus.
   - `updated_by`: Nama user/siswa yang mengubah / menghapus data tersebut.
4. **CRUD Lengkap**:
   - **Create**: Tambah siswa baru dengan password akun.
   - **Read**: Tampil data siswa dengan status dan riwayat audit.
   - **Update**: Edit data siswa dan ubah password (opsional).
   - **Delete**: Hapus siswa dengan metode soft delete dan konfirmasi.
   - **Search**: Pencarian instan berdasarkan NIS, Nama, atau Jurusan.

---

## 🔑 Akun Login Bawaan (Default Dummy)
Setelah mengimport `database.sql`, Anda dapat login menggunakan salah satu akun berikut:

| Nama Siswa (Username) | Password | Peran / Jurusan |
| :--- | :--- | :--- |
| **Ahmad Pratama** | `123456` | Rekayasa Perangkat Lunak |
| **Siti Nurhaliza** | `123456` | Teknik Komputer & Jaringan |
| **Budi Santoso** | `123456` | Multimedia |

---

## 📁 Struktur Folder
```text
ujikom/
├── config/
│   └── database.php       # Konfigurasi koneksi MySQLi
├── includes/
│   ├── header.php         # Proteksi session, navbar & Bootstrap CSS
│   └── footer.php         # Footer & Bootstrap JS
├── .gitignore             # File ignore Git
├── database.sql           # File SQL skema & data awal
├── edit.php               # Form edit data
├── hapus.php              # Logika proses soft delete
├── index.php              # Halaman utama (daftar data & pencarian)
├── login.php              # Halaman login siswa
├── logout.php             # Logika logout session
├── proses_edit.php        # Logika simpan perubahan & audit trail
├── proses_login.php       # Validasi login & set session
├── proses_tambah.php      # Logika simpan data baru & hash password
├── tambah.php             # Form tambah siswa baru
└── README.md              # Dokumentasi project
```

---

## 🛠️ Panduan Instalasi & Menjalankan

### 1. Nyalakan XAMPP
Buka **XAMPP Control Panel**, lalu klik **Start** pada modul:
- **Apache**
- **MySQL**

### 2. Import Database
1. Buka browser ke: [http://localhost/phpmyadmin](http://localhost/phpmyadmin)
2. Klik database `db_ujikom` (jika sudah ada sebelumnya, bisa drop database atau tabel `siswa` lama terlebih dahulu).
3. Klik menu **Import**, pilih file `database.sql`.
4. Klik tombol **Kirim / Import**.

### 3. Jalankan Aplikasi
Buka browser dan akses:
```text
http://localhost/ujikom
```
*(Akan otomatis diarahkan ke `login.php` jika belum login)*

---

## 🐙 Panduan Push ke Git (GitHub / GitLab)

File `.gitignore` sudah otomatis disediakan. Jalankan perintah berikut di terminal:
```bash
git init
git add .
git commit -m "feat: auth session login, soft delete, dan audit trail"
git branch -M main
git remote add origin <URL_REPOSITORY_ANDA>
git push -u origin main
```

# SIM Siswa - Aplikasi CRUD Standar PHP Native & Bootstrap 5

Aplikasi manajemen data siswa sederhana berbasis **PHP Native** dan **Bootstrap 5**, dirancang dengan standar yang bersih, rapi, dan mudah dipelajari untuk pemula maupun persiapan Uji Kompetensi Keahlian (Ujikom).

---

## 🚀 Fitur Utama
- **Create (Tambah Data)**: Menambah data siswa lengkap dengan validasi NIS duplikat.
- **Read (Tampil Data)**: Menampilkan tabel data siswa responsif dilengkapi pagination visual/badge status.
- **Search (Pencarian)**: Mencari data berdasarkan NIS, Nama, atau Jurusan secara dinamis.
- **Update (Edit Data)**: Memperbarui data siswa yang sudah ada.
- **Delete (Hapus Data)**: Menghapus data dengan dialog konfirmasi agar tidak terhapus tidak sengaja.
- **Alert Feedback**: Notifikasi alert Bootstrap interaktif setelah operasi (sukses/gagal).

---

## 📁 Struktur Folder
```text
ujikom/
├── config/
│   └── database.php       # Konfigurasi koneksi MySQLi
├── includes/
│   ├── header.php         # Navbar & asset Bootstrap CSS / Icons
│   └── footer.php         # Footer & asset Bootstrap JS
├── .gitignore             # File ignore untuk repository Git
├── database.sql           # File SQL untuk import database
├── edit.php               # Tampilan form ubah data
├── hapus.php              # Logika proses hapus data
├── index.php              # Halaman utama (daftar data & pencarian)
├── proses_edit.php        # Logika proses simpan perubahan
├── proses_tambah.php      # Logika proses simpan data baru
├── tambah.php             # Tampilan form tambah data
└── README.md              # Dokumentasi project
```

---

## 🛠️ Panduan Instalasi & Menjalankan

### 1. Nyalakan XAMPP
Buka **XAMPP Control Panel**, lalu klik **Start** pada modul:
- **Apache**
- **MySQL**

### 2. Import Database
1. Buka browser dan kunjungi: [http://localhost/phpmyadmin](http://localhost/phpmyadmin)
2. Buat database baru bernama: `db_ujikom` (atau langsung gunakan menu Import).
3. Klik tab **Import**, lalu pilih file `database.sql` yang ada di dalam folder project ini.
4. Klik tombol **Import / Kirim** di bagian bawah.

### 3. Jalankan Aplikasi
Buka browser dan akses alamat berikut:
```text
http://localhost/ujikom
```

---

## 🐙 Panduan Push ke Git (GitHub / GitLab)

File `.gitignore` sudah otomatis disediakan sehingga file sampah sistem tidak akan ikut ter-upload.

Jalankan perintah berikut di terminal/PowerShell pada folder project ini:
```bash
git init
git add .
git commit -m "feat: initial commit CRUD PHP Native + Bootstrap 5"
git branch -M main
git remote add origin <URL_REPOSITORY_ANDA>
git push -u origin main
```

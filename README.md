# SIM Perpustakaan Siswa (CRUD PHP Native & Bootstrap)

Project CRUD standar sederhana yang sangat mudah dipelajari untuk pemula maupun ujian kompetensi (Ujikom).

---

## 🚀 Fitur Utama
1. **Login Session**: Login dengan Nama Siswa & Password (default: `123456`).
2. **Master Siswa**: Tambah, Tampil, Cari, Edit, dan Hapus Siswa.
3. **Master Buku**: Tambah, Tampil, Cari, Edit, dan Hapus Buku (stok siap untuk transaksi).
4. **Soft Delete (`is_delete`)**: Data tidak hilang permanen, hanya statusnya diubah menjadi `1`.
5. **Audit Trail**: Mencatat pembuat (`created_by`, `created_at`) dan pengubah (`updated_by`, `updated_at`).

---

## 📁 Struktur File (Sangat Ringkas)
```text
ujikom/
├── koneksi.php          # Koneksi MySQLi
├── navbar.php           # Navigasi & pengecekan login
├── database.sql         # File SQL database db_ujikom
│
├── login.php            # Halaman login (form + proses langsung)
├── logout.php           # Logout session
│
├── index.php            # Data Siswa (Tampil & Cari)
├── tambah.php           # Tambah Siswa (Form + Simpan)
├── edit.php             # Edit Siswa (Form + Update)
├── hapus.php            # Hapus Siswa (Soft Delete)
│
├── buku.php             # Data Buku (Tampil & Cari)
├── buku_tambah.php      # Tambah Buku (Form + Simpan)
├── buku_edit.php        # Edit Buku (Form + Update)
├── buku_hapus.php       # Hapus Buku (Soft Delete)
│
├── .gitignore           # File ignore Git
└── README.md            # Dokumentasi ini
```

---

## 🔑 Akun Login Uji Coba
| Nama Siswa (Username) | Password |
| :--- | :--- |
| **Ahmad Pratama** | `123456` |
| **Siti Nurhaliza** | `123456` |
| **Budi Santoso** | `123456` |

---

## 🛠️ Cara Menjalankan
1. Nyalakan **Apache** dan **MySQL** di XAMPP.
2. Buka [http://localhost/phpmyadmin](http://localhost/phpmyadmin) dan import file `database.sql`.
3. Buka browser ke: [http://localhost/ujikom](http://localhost/ujikom)

# SIM Perpustakaan (PHP Native & Bootstrap)

Aplikasi Perpustakaan sederhana berbasis **PHP Native** dan **Bootstrap 5**, dirancang khusus untuk pemula dan standar Ujikom dengan kode yang sangat bersih, mudah dipelajari, dan langsung to-the-point.

---

## 🚀 Fitur Utama

1. **Login Session**:
   - Login menggunakan **Nama Anggota** dan Password (default: `123456`).
2. **Master Data Anggota**:
   - Menampilkan, mencari, menambah, mengedit, dan menghapus (soft delete) anggota perpustakaan.
3. **Master Data Buku**:
   - Menampilkan, mencari, menambah, mengedit, dan menghapus (soft delete) buku perpustakaan lengkap dengan jumlah stok.
4. **Transaksi Peminjaman & Pengembalian Buku**:
   - Anggota dapat meminjam buku yang tersedia (otomatis memotong stok buku).
   - Batas maksimal waktu peminjaman adalah **3 hari**.
   - **Aturan Denda**: Jika pengembalian melewati 3 hari, sistem otomatis mengenakan **denda Rp 500 per hari keterlambatan**.
   - Saat buku dikembalikan, stok buku otomatis bertambah kembali.
5. **Soft Delete (`is_delete`)**:
   - Data yang dihapus tidak langsung hilang permanen dari database, melainkan ditandai `is_delete = 1`.
6. **Audit Trail**:
   - Mencatat waktu dan user yang membuat (`created_at`, `created_by`) serta yang mengubah/menghapus (`updated_at`, `updated_by`).

---

## 📁 Struktur File di Root (Sangat Ringkas)

```text
ujikom/
├── koneksi.php          # Koneksi MySQLi sederhana
├── navbar.php           # Navigasi & pengecekan login session
├── database.sql         # Skema database & data contoh
│
├── login.php            # Halaman login anggota
├── logout.php           # Logout session
│
├── index.php            # Master Data Anggota (Tampil & Cari)
├── anggota_tambah.php   # Tambah Anggota Baru
├── anggota_edit.php     # Edit Data Anggota
├── anggota_hapus.php    # Soft Delete Anggota
│
├── buku.php             # Master Data Buku (Tampil & Cari)
├── buku_tambah.php      # Tambah Buku Baru
├── buku_edit.php        # Edit Data Buku
├── buku_hapus.php       # Soft Delete Buku
│
├── peminjaman.php       # Daftar Transaksi Peminjaman & Pengembalian
├── pinjam_tambah.php    # Form Transaksi Peminjaman (Potong Stok)
├── pinjam_kembali.php   # Proses Pengembalian Buku (Hitung Denda & Tambah Stok)
│
├── .gitignore           # File ignore Git
└── README.md            # Dokumentasi ini
```

---

## 🔑 Akun Login Uji Coba

| Nama Anggota (User) | Password | Tipe (ENUM) |
| :--- | :--- | :--- |
| **Ahmad Pratama** | `123456` | Admin |
| **Siti Nurhaliza** | `123456` | Staff |
| **Budi Santoso** | `123456` | Staff |

---

## 🛠️ Cara Menjalankan

1. Jalankan modul **Apache** dan **MySQL** di XAMPP Control Panel.
2. Buka [http://localhost/phpmyadmin](http://localhost/phpmyadmin) lalu import file `database.sql`.
3. Buka aplikasi di browser:
   ```text
   http://localhost/ujikom
   ```

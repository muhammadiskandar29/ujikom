# SIM Perpustakaan (Versi Ultra-Simple & Basic)

Aplikasi Perpustakaan berbasis **PHP Native** dan **Bootstrap 5** yang dirancang khusus untuk pemula dan ujian praktik (Ujikom) dengan kode yang **sangat pendek, mudah dihafal, dan cepat diketik**.

---

## 🚀 Fitur Utama
1. **Login Super Admin**:
   - Akun admin tersimpan di tabel `user` terpisah.
   - Username: `admin` | Password: `admin`
2. **Master Data Anggota**:
   - Murni data peminjam (tanpa password/login).
   - CRUD lengkap (Nomor Anggota, Nama, Jenis Kelamin, Tipe, Alamat).
3. **Master Data Buku**:
   - Data katalog buku (Kode Buku, Judul, Pengarang, Stok).
4. **Transaksi Peminjaman & Pengembalian Buku**:
   - Pinjam buku: Stok buku berkurang 1, batas pinjam 3 hari.
   - Kembalikan buku: Stok buku bertambah 1.
   - **Aturan Denda**: Jika pengembalian $> 3$ hari, dikenakan denda **Rp 500 / hari keterlambatan**.
5. **Soft Delete (`is_delete`)**:
   - Data tidak terhapus permanen dari MySQL, hanya diubah `is_delete = 1`.

---

## 📁 Struktur File (Sangat Ringkas di Root)

```text
ujikom/
├── koneksi.php          # Koneksi MySQLi (3 baris)
├── navbar.php           # Navigasi & cek session login
├── database.sql         # Skema database db_ujikom
│
├── login.php            # Login Super Admin
├── logout.php           # Logout session (5 baris)
│
├── index.php            # Tampil & cari data anggota
├── anggota_tambah.php   # Tambah anggota (tanpa password)
├── anggota_edit.php     # Edit data anggota
├── anggota_hapus.php    # Soft delete anggota (6 baris)
│
├── buku.php             # Tampil & cari data buku
├── buku_tambah.php      # Tambah buku baru
├── buku_edit.php        # Edit data buku
├── buku_hapus.php       # Soft delete buku (6 baris)
│
├── peminjaman.php       # Tampil daftar transaksi
├── pinjam_tambah.php    # Form pinjam (potong stok)
└── pinjam_kembali.php   # Proses kembali (hitung denda & tambah stok)
```

---

## 🛠️ Cara Menjalankan
1. Nyalakan **Apache** dan **MySQL** di XAMPP.
2. Buka [http://localhost/phpmyadmin](http://localhost/phpmyadmin) lalu import file `database.sql`.
3. Buka browser:
   ```text
   http://localhost/ujikom
   ```
4. Login menggunakan akun Super Admin:
   - Username: **admin**
   - Password: **admin**

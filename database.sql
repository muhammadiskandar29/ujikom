-- Buat Database jika belum ada
CREATE DATABASE IF NOT EXISTS `db_ujikom`;
USE `db_ujikom`;

-- 1. Tabel `siswa` (dengan Auth, Soft Delete & Audit Trail)
CREATE TABLE IF NOT EXISTS `siswa` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `nis` VARCHAR(20) NOT NULL UNIQUE,
  `nama` VARCHAR(100) NOT NULL,
  `password` VARCHAR(255) NOT NULL,
  `jenis_kelamin` ENUM('Laki-laki', 'Perempuan') NOT NULL,
  `jurusan` VARCHAR(50) NOT NULL,
  `alamat` TEXT NULL,
  `is_delete` TINYINT(1) NOT NULL DEFAULT 0,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `created_by` VARCHAR(100) NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` VARCHAR(100) NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Data Awal (Dummy Data) Siswa
-- Password default: 123456
INSERT INTO `siswa` (`nis`, `nama`, `password`, `jenis_kelamin`, `jurusan`, `alamat`, `is_delete`, `created_by`) VALUES
('1001', 'Ahmad Pratama', '$2y$10$dYCj0iRY.R3Z1eHodGaX7OfhbyWsie7P.KBoBuPGnW5fi6nU.BN9i', 'Laki-laki', 'Rekayasa Perangkat Lunak', 'Jl. Merdeka No. 12, Bandung', 0, 'System'),
('1002', 'Siti Nurhaliza', '$2y$10$dYCj0iRY.R3Z1eHodGaX7OfhbyWsie7P.KBoBuPGnW5fi6nU.BN9i', 'Perempuan', 'Teknik Komputer & Jaringan', 'Jl. Pahlawan No. 45, Cimahi', 0, 'System'),
('1003', 'Budi Santoso', '$2y$10$dYCj0iRY.R3Z1eHodGaX7OfhbyWsie7P.KBoBuPGnW5fi6nU.BN9i', 'Laki-laki', 'Multimedia', 'Jl. Sukajadi No. 88, Bandung', 0, 'System')
ON DUPLICATE KEY UPDATE `nis`=`nis`;

-- 2. Tabel `buku` (Master Data Buku untuk Transaksi Peminjaman)
CREATE TABLE IF NOT EXISTS `buku` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `kode_buku` VARCHAR(20) NOT NULL UNIQUE,
  `judul` VARCHAR(255) NOT NULL,
  `pengarang` VARCHAR(100) NOT NULL,
  `penerbit` VARCHAR(100) NOT NULL,
  `tahun_terbit` INT(4) NOT NULL,
  `kategori` VARCHAR(50) NOT NULL,
  `stok` INT NOT NULL DEFAULT 0,
  `is_delete` TINYINT(1) NOT NULL DEFAULT 0,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `created_by` VARCHAR(100) NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` VARCHAR(100) NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Data Awal (Dummy Data) Buku
INSERT INTO `buku` (`kode_buku`, `judul`, `pengarang`, `penerbit`, `tahun_terbit`, `kategori`, `stok`, `is_delete`, `created_by`) VALUES
('BK-001', 'Belajar Pemrograman Web dengan PHP Native & MySQL', 'Budi Raharjo', 'Informatika', 2022, 'Teknologi', 5, 0, 'System'),
('BK-002', 'Dasar Jaringan Komputer dan Cisco CCNA', 'Iwan Sofana', 'Informatika', 2021, 'Jaringan', 4, 0, 'System'),
('BK-003', 'Desain Grafis dan UI/UX Modern untuk Pemula', 'Rian Kurniawan', 'Andi Publisher', 2023, 'Desain', 3, 0, 'System'),
('BK-004', 'Algoritma & Struktur Data Menggunakan C/C++', 'Wahyu Hidayat', 'Elex Media Komputindo', 2020, 'Teknologi', 2, 0, 'System')
ON DUPLICATE KEY UPDATE `kode_buku`=`kode_buku`;

-- Buat Database jika belum ada
CREATE DATABASE IF NOT EXISTS `db_ujikom`;
USE `db_ujikom`;

-- 1. Tabel `anggota` (Master Data Anggota dengan Tipe ENUM Admin & Staff)
CREATE TABLE IF NOT EXISTS `anggota` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `nomor_anggota` VARCHAR(20) NOT NULL UNIQUE,
  `nama` VARCHAR(100) NOT NULL,
  `password` VARCHAR(255) NOT NULL,
  `jenis_kelamin` ENUM('Laki-laki', 'Perempuan') NOT NULL,
  `tipe_anggota` ENUM('Admin', 'Staff') NOT NULL DEFAULT 'Staff',
  `alamat` TEXT NULL,
  `is_delete` TINYINT(1) NOT NULL DEFAULT 0,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `created_by` VARCHAR(100) NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` VARCHAR(100) NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Data Awal Anggota (Password default: 123456)
INSERT INTO `anggota` (`nomor_anggota`, `nama`, `password`, `jenis_kelamin`, `tipe_anggota`, `alamat`, `is_delete`, `created_by`) VALUES
('ANG-001', 'Ahmad Pratama', '$2y$10$dYCj0iRY.R3Z1eHodGaX7OfhbyWsie7P.KBoBuPGnW5fi6nU.BN9i', 'Laki-laki', 'Admin', 'Jl. Merdeka No. 12, Bandung', 0, 'System'),
('ANG-002', 'Siti Nurhaliza', '$2y$10$dYCj0iRY.R3Z1eHodGaX7OfhbyWsie7P.KBoBuPGnW5fi6nU.BN9i', 'Perempuan', 'Staff', 'Jl. Pahlawan No. 45, Cimahi', 0, 'System'),
('ANG-003', 'Budi Santoso', '$2y$10$dYCj0iRY.R3Z1eHodGaX7OfhbyWsie7P.KBoBuPGnW5fi6nU.BN9i', 'Laki-laki', 'Staff', 'Jl. Sukajadi No. 88, Bandung', 0, 'System')
ON DUPLICATE KEY UPDATE `nomor_anggota`=`nomor_anggota`;

-- 2. Tabel `buku` (Master Data Buku)
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

-- Data Awal Buku
INSERT INTO `buku` (`kode_buku`, `judul`, `pengarang`, `penerbit`, `tahun_terbit`, `kategori`, `stok`, `is_delete`, `created_by`) VALUES
('BK-001', 'Belajar Pemrograman Web dengan PHP Native & MySQL', 'Budi Raharjo', 'Informatika', 2022, 'Teknologi', 5, 0, 'System'),
('BK-002', 'Dasar Jaringan Komputer dan Cisco CCNA', 'Iwan Sofana', 'Informatika', 2021, 'Jaringan', 4, 0, 'System'),
('BK-003', 'Desain Grafis dan UI/UX Modern untuk Pemula', 'Rian Kurniawan', 'Andi Publisher', 2023, 'Desain', 3, 0, 'System')
ON DUPLICATE KEY UPDATE `kode_buku`=`kode_buku`;

-- 3. Tabel `peminjaman` (Transaksi Peminjaman & Pengembalian)
-- Batas pinjam: 3 hari. Denda: Rp 500 / hari jika lebih dari 3 hari.
CREATE TABLE IF NOT EXISTS `peminjaman` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `id_anggota` INT NOT NULL,
  `id_buku` INT NOT NULL,
  `tanggal_pinjam` DATE NOT NULL,
  `jatuh_tempo` DATE NOT NULL,
  `tanggal_kembali` DATE NULL,
  `status` ENUM('Dipinjam', 'Dikembalikan') NOT NULL DEFAULT 'Dipinjam',
  `terlambat` INT NOT NULL DEFAULT 0,
  `denda` INT NOT NULL DEFAULT 0,
  `is_delete` TINYINT(1) NOT NULL DEFAULT 0,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `created_by` VARCHAR(100) NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` VARCHAR(100) NULL,
  INDEX (`id_anggota`),
  INDEX (`id_buku`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

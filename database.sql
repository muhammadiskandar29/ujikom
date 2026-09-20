-- Database db_ujikom
CREATE DATABASE IF NOT EXISTS `db_ujikom`;
USE `db_ujikom`;

-- 1. Tabel User (Khusus Login Super Admin / Petugas)
CREATE TABLE IF NOT EXISTS `user` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `username` VARCHAR(50) NOT NULL UNIQUE,
  `password` VARCHAR(255) NOT NULL,
  `nama` VARCHAR(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `user` (`username`, `password`, `nama`) VALUES
('admin', MD5('admin'), 'Super Admin')
ON DUPLICATE KEY UPDATE `username`=`username`;

-- 2. Tabel Anggota (Murni Master Data Peminjam, Tanpa Password)
CREATE TABLE IF NOT EXISTS `anggota` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `nomor_anggota` VARCHAR(20) NOT NULL UNIQUE,
  `nama` VARCHAR(100) NOT NULL,
  `jenis_kelamin` ENUM('Laki-laki', 'Perempuan') NOT NULL DEFAULT 'Laki-laki',
  `tipe_anggota` ENUM('Admin', 'Staff') NOT NULL DEFAULT 'Staff',
  `alamat` TEXT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `anggota` (`nomor_anggota`, `nama`, `jenis_kelamin`, `tipe_anggota`, `alamat`) VALUES
('ANG-001', 'Ahmad Pratama', 'Laki-laki', 'Admin', 'Bandung'),
('ANG-002', 'Siti Nurhaliza', 'Perempuan', 'Staff', 'Cimahi'),
('ANG-003', 'Budi Santoso', 'Laki-laki', 'Staff', 'Bandung')
ON DUPLICATE KEY UPDATE `nomor_anggota`=`nomor_anggota`;

-- 3. Tabel Buku (Master Data Buku)
CREATE TABLE IF NOT EXISTS `buku` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `kode_buku` VARCHAR(20) NOT NULL UNIQUE,
  `judul` VARCHAR(255) NOT NULL,
  `pengarang` VARCHAR(100) NOT NULL,
  `stok` INT NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `buku` (`kode_buku`, `judul`, `pengarang`, `stok`) VALUES
('BK-001', 'Pemrograman Web PHP Native', 'Budi Raharjo', 5),
('BK-002', 'Dasar Jaringan Komputer', 'Iwan Sofana', 4),
('BK-003', 'Desain Grafis Pemula', 'Rian Kurniawan', 3)
ON DUPLICATE KEY UPDATE `kode_buku`=`kode_buku`;

-- 4. Tabel Peminjaman (Transaksi: Batas 3 Hari, Denda Rp 500/hari)
CREATE TABLE IF NOT EXISTS `peminjaman` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `id_anggota` INT NOT NULL,
  `id_buku` INT NOT NULL,
  `tanggal_pinjam` DATE NOT NULL,
  `jatuh_tempo` DATE NOT NULL,
  `tanggal_kembali` DATE NULL,
  `status` ENUM('Dipinjam', 'Dikembalikan') NOT NULL DEFAULT 'Dipinjam',
  `denda` INT NOT NULL DEFAULT 0,
  CONSTRAINT `fk_pinjam_anggota` FOREIGN KEY (`id_anggota`) REFERENCES `anggota` (`id`) ON UPDATE CASCADE ON DELETE CASCADE,
  CONSTRAINT `fk_pinjam_buku` FOREIGN KEY (`id_buku`) REFERENCES `buku` (`id`) ON UPDATE CASCADE ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Buat Database jika belum ada
CREATE DATABASE IF NOT EXISTS `db_ujikom`;
USE `db_ujikom`;

-- Buat Tabel `siswa` (dengan Auth, Soft Delete & Audit Trail)
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

-- Data Awal (Dummy Data) untuk Pengujian
-- Catatan: Password default untuk semua akun siswa adalah: 123456
INSERT INTO `siswa` (`nis`, `nama`, `password`, `jenis_kelamin`, `jurusan`, `alamat`, `is_delete`, `created_by`) VALUES
('1001', 'Ahmad Pratama', '$2y$10$dYCj0iRY.R3Z1eHodGaX7OfhbyWsie7P.KBoBuPGnW5fi6nU.BN9i', 'Laki-laki', 'Rekayasa Perangkat Lunak', 'Jl. Merdeka No. 12, Bandung', 0, 'System'),
('1002', 'Siti Nurhaliza', '$2y$10$dYCj0iRY.R3Z1eHodGaX7OfhbyWsie7P.KBoBuPGnW5fi6nU.BN9i', 'Perempuan', 'Teknik Komputer & Jaringan', 'Jl. Pahlawan No. 45, Cimahi', 0, 'System'),
('1003', 'Budi Santoso', '$2y$10$dYCj0iRY.R3Z1eHodGaX7OfhbyWsie7P.KBoBuPGnW5fi6nU.BN9i', 'Laki-laki', 'Multimedia', 'Jl. Sukajadi No. 88, Bandung', 0, 'System')
ON DUPLICATE KEY UPDATE `nis`=`nis`;

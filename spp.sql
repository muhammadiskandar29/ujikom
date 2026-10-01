-- Database: `spp`

SET FOREIGN_KEY_CHECKS = 0;
DROP TABLE IF EXISTS `cek_pembayaran`;
DROP TABLE IF EXISTS `tb_pembayaran`;
DROP TABLE IF EXISTS `tb_siswa`;
DROP TABLE IF EXISTS `tb_petugas`;
DROP TABLE IF EXISTS `tb_kelas`;
DROP TABLE IF EXISTS `tb_spp`;
SET FOREIGN_KEY_CHECKS = 1;

-- --------------------------------------------------------
-- 1. Table structure for table `tb_spp`
-- --------------------------------------------------------
CREATE TABLE `tb_spp` (
  `id_spp` VARCHAR(11) NOT NULL,
  `tahun` INT(11) NOT NULL,
  `nominal` VARCHAR(40) NOT NULL,
  PRIMARY KEY (`id_spp`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------
-- 2. Table structure for table `tb_kelas`
-- --------------------------------------------------------
CREATE TABLE `tb_kelas` (
  `id_kelas` VARCHAR(11) NOT NULL,
  `nama_kelas` VARCHAR(10) NOT NULL,
  `komp_keahlian` VARCHAR(50) NOT NULL,
  PRIMARY KEY (`id_kelas`),
  UNIQUE KEY `uq_nama_kelas` (`nama_kelas`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------
-- 3. Table structure for table `tb_petugas`
-- --------------------------------------------------------
CREATE TABLE `tb_petugas` (
  `id_petugas` VARCHAR(11) NOT NULL,
  `username` VARCHAR(25) NOT NULL,
  `password` VARCHAR(32) NOT NULL,
  `nama_petugas` VARCHAR(35) NOT NULL,
  `level` ENUM('admin', 'petugas', 'siswa') NOT NULL,
  PRIMARY KEY (`id_petugas`),
  UNIQUE KEY `username_unique` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------
-- 4. Table structure for table `tb_siswa`
-- --------------------------------------------------------
CREATE TABLE `tb_siswa` (
  `nisn` VARCHAR(10) NOT NULL,
  `nis` VARCHAR(8) NOT NULL,
  `nama` VARCHAR(50) NOT NULL,
  `id_kelas` VARCHAR(11) NOT NULL,
  `nama_kelas` VARCHAR(10) DEFAULT NULL,
  `alamat` TEXT DEFAULT NULL,
  `no_tlp` VARCHAR(13) DEFAULT NULL,
  `id_spp` VARCHAR(40) NOT NULL,
  PRIMARY KEY (`nisn`),
  UNIQUE KEY `uq_siswa_nama` (`nama`),
  UNIQUE KEY `uq_siswa_no_tlp` (`no_tlp`),
  UNIQUE KEY `uq_siswa_nisn_spp` (`nisn`, `id_spp`),
  KEY `fk_siswa_kelas` (`id_kelas`),
  KEY `fk_siswa_spp` (`id_spp`),
  KEY `fk_siswa_nama_kelas` (`nama_kelas`),
  CONSTRAINT `fk_siswa_kelas` FOREIGN KEY (`id_kelas`) REFERENCES `tb_kelas` (`id_kelas`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_siswa_nama_kelas` FOREIGN KEY (`nama_kelas`) REFERENCES `tb_kelas` (`nama_kelas`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------
-- 5. Table structure for table `tb_pembayaran`
-- --------------------------------------------------------
CREATE TABLE `tb_pembayaran` (
  `id_pembayaran` VARCHAR(11) NOT NULL,
  `nisn` VARCHAR(10) NOT NULL,
  `tgl_bayar` DATE NOT NULL,
  `tgl_terakhir_bayar` DATE DEFAULT NULL,
  `batas_pembayaran` DATE DEFAULT NULL,
  `jumlah_bulan` VARCHAR(10) NOT NULL,
  `id_spp` VARCHAR(40) NOT NULL,
  `nominal_bayar` VARCHAR(100) NOT NULL,
  `jumlah_bayar` VARCHAR(40) NOT NULL,
  `kembalian` VARCHAR(100) NOT NULL,
  `status` ENUM('belum lunas', 'sudah lunas') NOT NULL DEFAULT 'belum lunas',
  PRIMARY KEY (`id_pembayaran`),
  KEY `fk_pembayaran_siswa` (`nisn`),
  KEY `fk_pembayaran_spp` (`id_spp`),
  CONSTRAINT `fk_pembayaran_siswa_nisn_spp` FOREIGN KEY (`nisn`, `id_spp`) REFERENCES `tb_siswa` (`nisn`, `id_spp`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------
-- 6. Table structure for table `cek_pembayaran`
-- --------------------------------------------------------
CREATE TABLE `cek_pembayaran` (
  `nisn` VARCHAR(10) NOT NULL,
  `tgl_terakhir_bayar` DATE DEFAULT NULL,
  `tgl_sekarang` DATE NOT NULL,
  `status_pembayaran` ENUM('belum lunas', 'sudah lunas') NOT NULL,
  `jumlah_bulan` VARCHAR(5) NOT NULL,
  `nama` VARCHAR(50) NOT NULL,
  `no_tlp` VARCHAR(13) DEFAULT NULL,
  PRIMARY KEY (`nisn`),
  KEY `fk_cek_nama` (`nama`),
  KEY `fk_cek_no_tlp` (`no_tlp`),
  CONSTRAINT `fk_cek_siswa` FOREIGN KEY (`nisn`) REFERENCES `tb_siswa` (`nisn`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_cek_nama` FOREIGN KEY (`nama`) REFERENCES `tb_siswa` (`nama`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_cek_no_tlp` FOREIGN KEY (`no_tlp`) REFERENCES `tb_siswa` (`no_tlp`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------
-- Data Awal / Dummy untuk Pengujian (5 Baris Master, 2 Baris Transaksi)
-- --------------------------------------------------------

-- tb_spp (5 Baris Master)
INSERT INTO `tb_spp` (`id_spp`, `tahun`, `nominal`) VALUES
('SPP01', 2022, '250000'),
('SPP02', 2023, '300000'),
('SPP03', 2024, '350000'),
('SPP04', 2025, '400000'),
('SPP05', 2026, '450000');

-- tb_kelas (5 Baris Master)
INSERT INTO `tb_kelas` (`id_kelas`, `nama_kelas`, `komp_keahlian`) VALUES
('KLS01', 'X RPL 1', 'Rekayasa Perangkat Lunak'),
('KLS02', 'XI RPL 1', 'Rekayasa Perangkat Lunak'),
('KLS03', 'XII RPL 1', 'Rekayasa Perangkat Lunak'),
('KLS04', 'XII TKJ 1', 'Teknik Komputer dan Jaringan'),
('KLS05', 'XII DKV 1', 'Desain Komunikasi Visual');

-- tb_petugas (5 Baris Master)
INSERT INTO `tb_petugas` (`id_petugas`, `username`, `password`, `nama_petugas`, `level`) VALUES
('PTG01', 'admin', MD5('admin'), 'Hendra Gunawan', 'admin'),
('PTG02', 'petugas1', MD5('petugas1'), 'Asep Saepudin', 'petugas'),
('PTG03', 'petugas2', MD5('petugas2'), 'Dadang Hermawan', 'petugas'),
('PTG04', 'siswa1', MD5('siswa1'), 'Taupik Suwandi', 'siswa'),
('PTG05', 'siswa2', MD5('siswa2'), 'Jajang Nurjaman', 'siswa');

-- tb_siswa (5 Baris Master)
INSERT INTO `tb_siswa` (`nisn`, `nis`, `nama`, `id_kelas`, `nama_kelas`, `alamat`, `no_tlp`, `id_spp`) VALUES
('0012345671', '1001', 'Taupik Suwandi', 'KLS03', 'XII RPL 1', 'Jl. Merdeka No. 10', '081234567891', 'SPP05'),
('0012345672', '1002', 'Jajang Nurjaman', 'KLS03', 'XII RPL 1', 'Jl. Sudirman No. 22', '081234567892', 'SPP05'),
('0012345673', '1003', 'Muhammad Zubair', 'KLS02', 'XI RPL 1', 'Jl. Diponegoro No. 5', '081234567893', 'SPP04'),
('0012345674', '1004', 'Lucky Suhartini', 'KLS04', 'XII TKJ 1', 'Jl. Gajah Mada No. 15', '081234567894', 'SPP05'),
('0012345675', '1005', 'Taufit Hidayat', 'KLS01', 'X RPL 1', 'Jl. Pahlawan No. 8', '081234567895', 'SPP03');

-- tb_pembayaran (2 Baris Transaksi)
INSERT INTO `tb_pembayaran` (`id_pembayaran`, `nisn`, `tgl_bayar`, `tgl_terakhir_bayar`, `batas_pembayaran`, `jumlah_bulan`, `id_spp`, `nominal_bayar`, `jumlah_bayar`, `kembalian`, `status`) VALUES
('BYR001', '0012345671', '2026-01-10', '2026-01-10', '2026-01-15', '1', 'SPP05', '450000', '450000', '0', 'sudah lunas'),
('BYR002', '0012345672', '2026-01-12', '2026-01-12', '2026-01-15', '1', 'SPP05', '450000', '500000', '50000', 'sudah lunas');

-- cek_pembayaran (2 Baris Transaksi/Status)
INSERT INTO `cek_pembayaran` (`nisn`, `tgl_terakhir_bayar`, `tgl_sekarang`, `status_pembayaran`, `jumlah_bulan`, `nama`, `no_tlp`) VALUES
('0012345671', '2026-01-10', '2026-01-15', 'sudah lunas', '1', 'Taupik Suwandi', '081234567891'),
('0012345673', NULL, '2026-01-15', 'belum lunas', '0', 'Muhammad Zubair', '081234567893');

-- Database Schema untuk Sistem Peminjaman Alat
-- CodeIgniter 3 dengan Role-Based Access Control

-- 1. Tabel User (Admin, Petugas, Peminjam)
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL UNIQUE,
  `email` varchar(100) NOT NULL UNIQUE,
  `password` varchar(255) NOT NULL,
  `nama_lengkap` varchar(255) NOT NULL,
  `role` enum('admin','petugas','peminjam') NOT NULL,
  `no_identitas` varchar(50),
  `no_telp` varchar(20),
  `alamat` text,
  `status` enum('aktif','nonaktif') DEFAULT 'aktif',
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `role` (`role`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- 2. Tabel Kategori Alat
CREATE TABLE IF NOT EXISTS `kategori_alat` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_kategori` varchar(255) NOT NULL,
  `deskripsi` text,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- 3. Tabel Alat
CREATE TABLE IF NOT EXISTS `alat` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_alat` varchar(255) NOT NULL,
  `kategori_id` int(11) NOT NULL,
  `kode_alat` varchar(50) NOT NULL UNIQUE,
  `deskripsi` text,
  `status` enum('tersedia','dipinjam','diperbaiki') DEFAULT 'tersedia',
  `lokasi` varchar(255),
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `kategori_id` (`kategori_id`),
  FOREIGN KEY (`kategori_id`) REFERENCES `kategori_alat` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- 4. Tabel Peminjaman
CREATE TABLE IF NOT EXISTS `peminjaman` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `alat_id` int(11) NOT NULL,
  `peminjam_id` int(11) NOT NULL,
  `tanggal_pinjam` date NOT NULL,
  `tanggal_kembali_rencana` date NOT NULL,
  `tanggal_kembali_aktual` date,
  `keperluan` text NOT NULL,
  `status` enum('menunggu','disetujui','ditolak','dikembalikan') DEFAULT 'menunggu',
  `disetujui_oleh` int(11),
  `catatan_petugas` text,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `alat_id` (`alat_id`),
  KEY `peminjam_id` (`peminjam_id`),
  KEY `disetujui_oleh` (`disetujui_oleh`),
  FOREIGN KEY (`alat_id`) REFERENCES `alat` (`id`) ON DELETE CASCADE,
  FOREIGN KEY (`peminjam_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  FOREIGN KEY (`disetujui_oleh`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- 5. Tabel Pengembalian
CREATE TABLE IF NOT EXISTS `pengembalian` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `peminjaman_id` int(11) NOT NULL,
  `tanggal_dikembalikan` date NOT NULL,
  `kondisi_alat` enum('baik','rusak_ringan','rusak_berat') DEFAULT 'baik',
  `keterangan` text,
  `diperiksa_oleh` int(11),
  `kerusakan_biaya` decimal(10,2) DEFAULT 0,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `peminjaman_id` (`peminjaman_id`),
  KEY `diperiksa_oleh` (`diperiksa_oleh`),
  FOREIGN KEY (`peminjaman_id`) REFERENCES `peminjaman` (`id`) ON DELETE CASCADE,
  FOREIGN KEY (`diperiksa_oleh`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- 6. Tabel Log Aktivitas
CREATE TABLE IF NOT EXISTS `log_aktivitas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `aksi` varchar(255) NOT NULL,
  `deskripsi` text,
  `tabel` varchar(100),
  `record_id` int(11),
  `ip_address` varchar(45),
  `user_agent` text,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- Insert Data Sample
-- 1. User Admin (password: admin123)
INSERT INTO `users` (`username`, `email`, `password`, `nama_lengkap`, `role`, `no_telp`, `status`) 
VALUES 
('admin', 'admin@peminjaman.com', '$2y$10$DT4rKLgVZ7yg7Oz7fvKfGe8y3SBjxF4Pk8K8V7H9I6J0K1L2M3N4O', 'Administrator', 'admin', '081234567890', 'aktif'),
('petugas1', 'petugas@peminjaman.com', '$2y$10$DT4rKLgVZ7yg7Oz7fvKfGe8y3SBjxF4Pk8K8V7H9I6J0K1L2M3N4O', 'Petugas Gudang', 'petugas', '081234567891', 'aktif'),
('peminjam1', 'peminjam@peminjaman.com', '$2y$10$DT4rKLgVZ7yg7Oz7fvKfGe8y3SBjxF4Pk8K8V7H9I6J0K1L2M3N4O', 'Budi Santoso', 'peminjam', '081234567892', 'aktif');

-- 2. Kategori Alat
INSERT INTO `kategori_alat` (`nama_kategori`, `deskripsi`) VALUES
('Alat Pertukangan', 'Alat-alat untuk pekerjaan pertukangan'),
('Alat Berkebun', 'Alat-alat untuk berkebun dan landscape'),
('Alat Elektronik', 'Alat elektronik dan listrik'),
('Alat Olahraga', 'Alat-alat untuk olahraga');

-- 3. Alat
INSERT INTO `alat` (`nama_alat`, `kategori_id`, `kode_alat`, `deskripsi`, `status`, `lokasi`) VALUES
('Bor Listrik', 1, 'ALT-001', 'Bor listrik 500W', 'tersedia', 'Gudang A1'),
('Gergaji Rantai', 1, 'ALT-002', 'Gergaji rantai 2500W', 'tersedia', 'Gudang A2'),
('Mesin Potong Rumput', 2, 'ALT-003', 'Mesin potong rumput bensin', 'dipinjam', 'Gudang B1'),
('Selang Taman', 2, 'ALT-004', 'Selang taman 20m', 'tersedia', 'Gudang B2'),
('Lampu LED Sorot', 3, 'ALT-005', 'Lampu LED sorot 100W', 'tersedia', 'Gudang C1'),
('Proyektor', 3, 'ALT-006', 'Proyektor 3000 Lumen', 'dipinjam', 'Gudang C2');

-- Password untuk user sample adalah 'password123'
-- Admin: admin / password123
-- Petugas: petugas1 / password123
-- Peminjam: peminjam1 / password123


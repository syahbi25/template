# 📚 Tutorial Lengkap: Sistem Peminjaman Alat dengan CodeIgniter 3

**Tingkat Kesulitan:** Menengah | **Durasi:** 4-6 jam | **Terakhir Diupdate:** Februari 2026

---

## 📋 Daftar Isi

1. [Pendahuluan](#pendahuluan)
2. [Persyaratan Sistem](#persyaratan-sistem)
3. [Instalasi & Setup Awal](#instalasi--setup-awal)
4. [Database Design](#database-design)
5. [Konfigurasi CodeIgniter](#konfigurasi-codeigniter)
6. [Membuat Helpers](#membuat-helpers)
7. [Membuat Models](#membuat-models)
8. [Membuat Controllers](#membuat-controllers)
9. [Membuat Views & Partials](#membuat-views--partials)
10. [Styling dengan Tailwind CSS](#styling-dengan-tailwind-css)
11. [Testing & Deployment](#testing--deployment)

---

## Pendahuluan

### Apa itu Sistem Peminjaman Alat?

Sistem Peminjaman Alat adalah aplikasi web yang memungkinkan pengelolaan peminjaman dan pengembalian alat/barang. Sistem ini dirancang dengan **Role-Based Access Control (RBAC)** untuk 3 tipe pengguna:

- **Admin** - Mengelola seluruh sistem (users, alat, kategori, peminjaman, log)
- **Petugas** - Menyetujui/menolak peminjaman, mengelola pengembalian
- **Peminjam** - Mengajukan dan mengembalikan peminjaman

### Teknologi yang Digunakan

| Komponen | Teknologi |
|----------|-----------|
| **Backend Framework** | CodeIgniter 3 (PHP) |
| **Database** | MySQL/MariaDB |
| **Frontend UI** | Tailwind CSS + Font Awesome 6 |
| **Template Engine** | Native PHP |
| **Authentication** | Session-based, Password hashing (bcrypt) |
| **Web Server** | Apache (Laragon/XAMPP) |

### Fitur Utama

✅ Manajemen User (Create, Read, Update, Delete)  
✅ Manajemen Kategori Alat  
✅ Manajemen Data Alat  
✅ Sistem Peminjaman dengan Approval  
✅ Sistem Pengembalian dengan Kondisi Alat  
✅ Log Aktivitas (Audit Trail)  
✅ Laporan Peminjaman & Pengembalian  
✅ Dashboard Dinamis per Role  
✅ Responsive Design (Mobile-friendly)  
✅ Form Validation & Error Handling  

---

## Persyaratan Sistem

### Software yang Dibutuhkan

- **PHP 5.4+** (Recommended: PHP 7.0+)
- **MySQL 5.5+** atau **MariaDB 10+**
- **Apache Web Server**
- **CodeIgniter 3** (Framework)
- **Text Editor/IDE** (VS Code, PhpStorm, dll)

### Installation Packages

```bash
# Instalasi Laragon (All-in-one untuk Windows)
# Download dari: https://laragon.org

# Atau gunakan XAMPP
# Download dari: https://www.apachefriends.org
```

### Browser Compatibility

- ✓ Chrome 90+
- ✓ Firefox 88+
- ✓ Safari 14+
- ✓ Edge 90+

---

## Instalasi & Setup Awal

### Langkah 1: Setup Laragon/XAMPP

#### Untuk Laragon:
```bash
1. Download Laragon dari https://laragon.org
2. Extract ke folder (misal: C:\Laragon)
3. Jalankan Laragon.exe
4. Klik START ALL untuk menjalankan Apache & MySQL
5. Buka http://localhost untuk melihat Laragon dashboard
```

#### Untuk XAMPP:
```bash
1. Download XAMPP dari https://www.apachefriends.org
2. Install dan pilih folder instalasi
3. Buka XAMPP Control Panel
4. Jalankan Apache dan MySQL
```

### Langkah 2: Download CodeIgniter 3

```bash
# Opsi 1: Download dari GitHub
https://github.com/bcit-ci/CodeIgniter/archive/refs/heads/3.1-stable.zip

# Opsi 2: Download via Composer
composer create-project codeigniter/framework [nama-folder] 3.1.*

# Opsi 3: Extract langsung ke htdocs/www
# Pastikan folder bernama 'CodeIgniter' atau nama proyek Anda
```

### Langkah 3: Verifikasi Instalasi

```bash
# Buka browser dan akses:
http://localhost/CodeIgniter

# Jika melihat halaman Welcome CodeIgniter, instalasi berhasil ✓
```

### Langkah 4: Struktur Folder Dasar

```
CodeIgniter/
├── application/
│   ├── config/          (Konfigurasi sistem)
│   ├── controllers/      (Logika bisnis)
│   ├── helpers/          (Fungsi-fungsi utility)
│   ├── libraries/        (Custom libraries)
│   ├── models/           (Database queries)
│   ├── views/            (Template HTML)
│   └── logs/             (Error logs)
├── system/              (Core CodeIgniter - jangan diubah)
├── index.php            (Entry point)
└── database_lengkap.sql (Database script)
```

---

## Database Design

### Analisis Kebutuhan Data

Sistem peminjaman alat memerlukan tabel-tabel berikut:

1. **users** - Data pengguna dengan role berbeda
2. **kategori_alat** - Klasifikasi alat berdasarkan jenis
3. **alat** - Database alat dengan status ketersediaan
4. **peminjaman** - Transaksi peminjaman dengan approval
5. **pengembalian** - Transaksi pengembalian dengan kondisi
6. **log_aktivitas** - Audit trail untuk tracking

### Entity Relationship Diagram (ERD)

```
users
  ├── 1 ─── M ─── peminjaman (peminjam_id)
  ├── 1 ─── M ─── pengembalian (diperiksa_oleh)
  └── 1 ─── M ─── log_aktivitas (user_id)

kategori_alat
  └── 1 ─── M ─── alat (kategori_id)

alat
  └── 1 ─── M ─── peminjaman (alat_id)

peminjaman
  ├── M ─── 1 ─── alat (alat_id)
  ├── M ─── 1 ─── users (peminjam_id)
  ├── M ─── 1 ─── users (disetujui_oleh)
  └── 1 ─── M ─── pengembalian (peminjaman_id)
```

### SQL Script Lengkap

```sql
-- ============================================
-- 1. TABEL USERS (Role: admin, petugas, peminjam)
-- ============================================
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
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`),
  KEY `role` (`role`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- ============================================
-- 2. TABEL KATEGORI ALAT
-- ============================================
CREATE TABLE IF NOT EXISTS `kategori_alat` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_kategori` varchar(255) NOT NULL,
  `deskripsi` text,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- ============================================
-- 3. TABEL ALAT
-- ============================================
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
  UNIQUE KEY `kode_alat` (`kode_alat`),
  KEY `kategori_id` (`kategori_id`),
  FOREIGN KEY (`kategori_id`) REFERENCES `kategori_alat` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- ============================================
-- 4. TABEL PEMINJAMAN
-- ============================================
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
  KEY `status` (`status`),
  FOREIGN KEY (`alat_id`) REFERENCES `alat` (`id`) ON DELETE CASCADE,
  FOREIGN KEY (`peminjam_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  FOREIGN KEY (`disetujui_oleh`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- ============================================
-- 5. TABEL PENGEMBALIAN
-- ============================================
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

-- ============================================
-- 6. TABEL LOG AKTIVITAS
-- ============================================
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
  KEY `aksi` (`aksi`),
  KEY `created_at` (`created_at`),
  FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- ============================================
-- DATA SAMPLE
-- ============================================

-- Insert Users (password: password123)
INSERT INTO `users` 
  (`username`, `email`, `password`, `nama_lengkap`, `role`, `no_telp`, `status`) 
VALUES 
  ('admin', 'admin@peminjaman.com', 
   '$2y$10$DT4rKLgVZ7yg7Oz7fvKfGe8y3SBjxF4Pk8K8V7H9I6J0K1L2M3N4O', 
   'Administrator', 'admin', '081234567890', 'aktif'),
  ('petugas1', 'petugas@peminjaman.com', 
   '$2y$10$DT4rKLgVZ7yg7Oz7fvKfGe8y3SBjxF4Pk8K8V7H9I6J0K1L2M3N4O', 
   'Petugas Gudang', 'petugas', '081234567891', 'aktif'),
  ('peminjam1', 'peminjam@peminjaman.com', 
   '$2y$10$DT4rKLgVZ7yg7Oz7fvKfGe8y3SBjxF4Pk8K8V7H9I6J0K1L2M3N4O', 
   'Budi Santoso', 'peminjam', '081234567892', 'aktif');

-- Insert Kategori Alat
INSERT INTO `kategori_alat` (`nama_kategori`, `deskripsi`) VALUES
  ('Alat Pertukangan', 'Alat-alat untuk pekerjaan pertukangan'),
  ('Alat Berkebun', 'Alat-alat untuk berkebun dan landscape'),
  ('Alat Elektronik', 'Alat elektronik dan listrik'),
  ('Alat Olahraga', 'Alat-alat untuk olahraga');

-- Insert Alat
INSERT INTO `alat` 
  (`nama_alat`, `kategori_id`, `kode_alat`, `deskripsi`, `status`, `lokasi`) 
VALUES
  ('Bor Listrik', 1, 'ALT-001', 'Bor listrik 500W', 'tersedia', 'Gudang A1'),
  ('Gergaji Rantai', 1, 'ALT-002', 'Gergaji rantai 2500W', 'tersedia', 'Gudang A2'),
  ('Mesin Potong Rumput', 2, 'ALT-003', 'Mesin potong rumput bensin', 'dipinjam', 'Gudang B1'),
  ('Selang Taman', 2, 'ALT-004', 'Selang taman 20m', 'tersedia', 'Gudang B2'),
  ('Lampu LED Sorot', 3, 'ALT-005', 'Lampu LED sorot 100W', 'tersedia', 'Gudang C1'),
  ('Proyektor', 3, 'ALT-006', 'Proyektor 3000 Lumen', 'dipinjam', 'Gudang C2');
```

### Cara Mengimplementasikan Database

#### Via phpMyAdmin (Recommended):

```bash
1. Buka browser: http://localhost/phpmyadmin
2. Login dengan user root (default: no password untuk XAMPP)
3. Klik tombol "New" untuk membuat database baru
4. Masukkan nama database: peminjaman_alat
5. Klik "Create"
6. Buka tab "SQL"
7. Copy-paste semua script SQL di atas
8. Klik tombol "Go" untuk execute
9. Selesai! Database sudah siap
```

#### Via Command Line:

```bash
# Login ke MySQL
mysql -u root -p

# Buat database
CREATE DATABASE peminjaman_alat;
USE peminjaman_alat;

# Execute file SQL
SOURCE /path/to/database_lengkap.sql;

# Verify
SHOW TABLES;
SELECT COUNT(*) FROM users;
```

---

## Konfigurasi CodeIgniter

### Langkah 1: Konfigurasi Database

**File:** `application/config/database.php`

```php
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// Database connection configuration
$db['default'] = array(
    'dsn'   => '', 
    'hostname' => 'localhost',    // Host database
    'username' => 'root',         // User MySQL
    'password' => '',             // Password (kosong untuk XAMPP default)
    'database' => 'peminjaman_alat', // Nama database
    'dbdriver' => 'mysqli',       // Driver (i untuk improved)
    'dbprefix' => '',
    'pconnect' => FALSE,
    'db_debug' => (ENVIRONMENT !== 'production'),
    'cache_on' => FALSE,
    'cachedir' => '',
    'char_set' => 'utf8',
    'dbcollat' => 'utf8_general_ci',
    'swap_pre' => '',
    'encrypt' => FALSE,
    'compress' => FALSE,
    'stricton' => FALSE,
    'failover' => array(),
    'save_queries' => TRUE
);
```

### Langkah 2: Konfigurasi Session

**File:** `application/config/config.php`

```php
// Cari baris "Session" (sekitar line 383)

$config['sess_driver'] = 'files';
$config['sess_cookie_name'] = 'ci_session';
$config['sess_expiration'] = 7200; // 2 jam
$config['sess_save_path'] = NULL;
$config['sess_match_ip'] = FALSE;
$config['sess_time_to_update'] = 300;
$config['sess_regenerate_destroy'] = FALSE;

// Base URL
$config['base_url'] = 'http://localhost/CodeIgniter/';
```

### Langkah 3: Konfigurasi Autoload

**File:** `application/config/autoload.php`

```php
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// Load libraries secara default
$autoload['libraries'] = array('session', 'database', 'form_validation');

// Load helpers secara default
$autoload['helpers'] = array('form', 'url', 'auth');

// Load models untuk diakses global (opsional)
$autoload['model'] = array();
```

### Langkah 4: Konfigurasi Routes

**File:** `application/config/routes.php`

```php
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'auth';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

// Redirect ke login jika akses halaman yang tidak ada
$route['admin'] = 'dashboard';
$route['dashboard'] = 'dashboard/index';
```

### Verifikasi Konfigurasi

Buka browser dan akses:

```
http://localhost/CodeIgniter/index.php/auth
```

Jika terlihat form login, konfigurasi berhasil ✓

---

## Membuat Helpers

### Konsep Helper

Helper adalah file yang berisi fungsi-fungsi utility yang dapat digunakan di seluruh aplikasi tanpa perlu membuat class terpisah.

### Auth Helper - Role-Based Access Control

**File:** `application/helpers/Auth_helper.php`

```php
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Auth Helper - Role-Based Access Control
 * 
 * File ini berisi fungsi-fungsi untuk:
 * - Checking login status
 * - Checking user role
 * - Logging user activity
 */

/**
 * Check apakah user sudah login
 * 
 * @return boolean
 */
if (!function_exists('is_logged_in')) {
    function is_logged_in()
    {
        $CI = &get_instance();
        return $CI->session->userdata('user_id') ? TRUE : FALSE;
    }
}

/**
 * Check user role
 * 
 * @param string|array $roles - Role yang akan dicek
 * @return boolean
 */
if (!function_exists('has_role')) {
    function has_role($roles)
    {
        $CI = &get_instance();
        $user_role = $CI->session->userdata('role');

        if (is_array($roles)) {
            return in_array($user_role, $roles);
        }

        return $user_role === $roles;
    }
}

/**
 * Get current user data
 * 
 * @return object|null
 */
if (!function_exists('get_current_user')) {
    function get_current_user()
    {
        $CI = &get_instance();
        return (object) [
            'id' => $CI->session->userdata('user_id'),
            'username' => $CI->session->userdata('username'),
            'nama_lengkap' => $CI->session->userdata('nama_lengkap'),
            'role' => $CI->session->userdata('role'),
            'email' => $CI->session->userdata('email')
        ];
    }
}

/**
 * Redirect ke login jika belum login
 * 
 * @return void
 */
if (!function_exists('require_login')) {
    function require_login()
    {
        if (!is_logged_in()) {
            redirect('auth');
        }
    }
}

/**
 * Redirect jika tidak memiliki role yang sesuai
 * 
 * @param string|array $roles - Role yang harus dimiliki
 * @return void
 */
if (!function_exists('require_role')) {
    function require_role($roles)
    {
        require_login();
        
        if (!has_role($roles)) {
            show_error('Anda tidak memiliki akses ke halaman ini', 403);
        }
    }
}

/**
 * Log aktivitas user
 * 
 * @param string $aksi - Jenis aksi (CREATE, READ, UPDATE, DELETE)
 * @param string $tabel - Nama tabel yang diakses
 * @param int $record_id - ID record yang diakses
 * @param string $deskripsi - Deskripsi aktivitas
 * @return void
 */
if (!function_exists('log_activity')) {
    function log_activity($aksi, $tabel, $record_id = NULL, $deskripsi = '')
    {
        $CI = &get_instance();
        
        // Jangan log jika belum login
        if (!is_logged_in()) {
            return;
        }

        $data = [
            'user_id' => $CI->session->userdata('user_id'),
            'aksi' => strtoupper($aksi),
            'tabel' => $tabel,
            'record_id' => $record_id,
            'deskripsi' => $deskripsi,
            'ip_address' => $CI->input->ip_address(),
            'user_agent' => $CI->input->user_agent(),
            'created_at' => date('Y-m-d H:i:s')
        ];

        $CI->db->insert('log_aktivitas', $data);
    }
}
```

### Cara Menggunakan Helper di Controller

```php
<?php
class Dashboard extends CI_Controller {
    
    public function __construct()
    {
        parent::__construct();
        require_login();  // Pastikan user sudah login
    }

    public function index()
    {
        // Check role
        if (has_role('admin')) {
            $this->load->view('dashboard/admin');
        } elseif (has_role('petugas')) {
            $this->load->view('dashboard/petugas');
        } else {
            $this->load->view('dashboard/peminjam');
        }

        // Log aktivitas
        log_activity('READ', 'dashboard', NULL, 'Membuka dashboard');
    }
}
```

---

## Membuat Models

### Konsep Model

Model adalah layer yang menangani semua interaksi dengan database. Setiap model mewakili satu tabel database.

### 1. User Model

**File:** `application/models/User_model.php`

```php
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {

    private $table = 'users';

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    /**
     * Get user berdasarkan username
     */
    public function get_by_username($username)
    {
        return $this->db->get_where($this->table, ['username' => $username])->row();
    }

    /**
     * Get user berdasarkan ID
     */
    public function get_by_id($id)
    {
        return $this->db->get_where($this->table, ['id' => $id])->row();
    }

    /**
     * Get semua user dengan filter role (optional)
     */
    public function get_all($role = NULL)
    {
        if ($role) {
            return $this->db->get_where($this->table, ['role' => $role])->result();
        }
        return $this->db->get($this->table)->result();
    }

    /**
     * Insert user baru
     */
    public function insert($data)
    {
        // Hash password sebelum disimpan
        if (isset($data['password'])) {
            $data['password'] = password_hash($data['password'], PASSWORD_BCRYPT);
        }

        return $this->db->insert($this->table, $data);
    }

    /**
     * Update user
     */
    public function update($id, $data)
    {
        // Hash password jika ada perubahan password
        if (isset($data['password'])) {
            $data['password'] = password_hash($data['password'], PASSWORD_BCRYPT);
        }

        $this->db->where('id', $id);
        return $this->db->update($this->table, $data);
    }

    /**
     * Delete user
     */
    public function delete($id)
    {
        return $this->db->delete($this->table, ['id' => $id]);
    }

    /**
     * Verify password - untuk login
     */
    public function verify_password($username, $password)
    {
        $user = $this->get_by_username($username);
        
        if ($user && password_verify($password, $user->password)) {
            return $user;
        }

        return FALSE;
    }

    /**
     * Count user berdasarkan role
     */
    public function count_by_role($role)
    {
        return $this->db->where('role', $role)->count_all_results($this->table);
    }
}
```

### 2. Alat Model

**File:** `application/models/Alat_model.php`

```php
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Alat_model extends CI_Model {

    private $table = 'alat';

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    /**
     * Get semua alat dengan kategori
     */
    public function get_all()
    {
        $this->db->select('a.*, k.nama_kategori');
        $this->db->from('alat a');
        $this->db->join('kategori_alat k', 'a.kategori_id = k.id', 'left');
        $this->db->order_by('a.nama_alat', 'ASC');
        return $this->db->get()->result();
    }

    /**
     * Get alat berdasarkan ID
     */
    public function get_by_id($id)
    {
        $this->db->select('a.*, k.nama_kategori');
        $this->db->from('alat a');
        $this->db->join('kategori_alat k', 'a.kategori_id = k.id', 'left');
        $this->db->where('a.id', $id);
        return $this->db->get()->row();
    }

    /**
     * Get alat berdasarkan status
     */
    public function get_by_status($status)
    {
        $this->db->select('a.*, k.nama_kategori');
        $this->db->from('alat a');
        $this->db->join('kategori_alat k', 'a.kategori_id = k.id', 'left');
        $this->db->where('a.status', $status);
        return $this->db->get()->result();
    }

    /**
     * Insert alat baru
     */
    public function insert($data)
    {
        return $this->db->insert($this->table, $data);
    }

    /**
     * Update alat
     */
    public function update($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update($this->table, $data);
    }

    /**
     * Delete alat
     */
    public function delete($id)
    {
        return $this->db->delete($this->table, ['id' => $id]);
    }

    /**
     * Count alat berdasarkan status
     */
    public function count_by_status($status)
    {
        return $this->db->where('status', $status)->count_all_results($this->table);
    }

    /**
     * Check apakah alat tersedia
     */
    public function is_available($id)
    {
        $alat = $this->get_by_id($id);
        return $alat && $alat->status === 'tersedia';
    }
}
```

### 3. Peminjaman Model

**File:** `application/models/Peminjaman_model.php`

```php
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Peminjaman_model extends CI_Model {

    private $table = 'peminjaman';

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    /**
     * Get semua peminjaman dengan detail
     */
    public function get_all()
    {
        $this->db->select('p.*, a.nama_alat, u.nama_lengkap as peminjam');
        $this->db->from('peminjaman p');
        $this->db->join('alat a', 'p.alat_id = a.id', 'left');
        $this->db->join('users u', 'p.peminjam_id = u.id', 'left');
        $this->db->order_by('p.created_at', 'DESC');
        return $this->db->get()->result();
    }

    /**
     * Get peminjaman berdasarkan ID
     */
    public function get_by_id($id)
    {
        $this->db->select('p.*, a.nama_alat, u.nama_lengkap as peminjam, u2.nama_lengkap as petugas');
        $this->db->from('peminjaman p');
        $this->db->join('alat a', 'p.alat_id = a.id', 'left');
        $this->db->join('users u', 'p.peminjam_id = u.id', 'left');
        $this->db->join('users u2', 'p.disetujui_oleh = u2.id', 'left');
        $this->db->where('p.id', $id);
        return $this->db->get()->row();
    }

    /**
     * Get peminjaman by status
     */
    public function get_by_status($status)
    {
        $this->db->select('p.*, a.nama_alat, u.nama_lengkap as peminjam');
        $this->db->from('peminjaman p');
        $this->db->join('alat a', 'p.alat_id = a.id', 'left');
        $this->db->join('users u', 'p.peminjam_id = u.id', 'left');
        $this->db->where('p.status', $status);
        $this->db->order_by('p.created_at', 'DESC');
        return $this->db->get()->result();
    }

    /**
     * Get peminjaman by peminjam
     */
    public function get_by_peminjam($peminjam_id)
    {
        $this->db->select('p.*, a.nama_alat');
        $this->db->from('peminjaman p');
        $this->db->join('alat a', 'p.alat_id = a.id', 'left');
        $this->db->where('p.peminjam_id', $peminjam_id);
        $this->db->order_by('p.created_at', 'DESC');
        return $this->db->get()->result();
    }

    /**
     * Insert peminjaman baru
     */
    public function insert($data)
    {
        return $this->db->insert($this->table, $data);
    }

    /**
     * Update status peminjaman
     */
    public function update_status($id, $status, $data = [])
    {
        $data['status'] = $status;
        $this->db->where('id', $id);
        return $this->db->update($this->table, $data);
    }

    /**
     * Approve peminjaman
     */
    public function approve($id, $user_id, $catatan = '')
    {
        return $this->update_status($id, 'disetujui', [
            'disetujui_oleh' => $user_id,
            'catatan_petugas' => $catatan
        ]);
    }

    /**
     * Reject peminjaman
     */
    public function reject($id, $catatan = '')
    {
        return $this->update_status($id, 'ditolak', [
            'catatan_petugas' => $catatan
        ]);
    }

    /**
     * Count peminjaman by status
     */
    public function count_pending()
    {
        return $this->db->where('status', 'menunggu')->count_all_results($this->table);
    }
}
```

### Model Lainnya

Cara membuat model untuk tabel lain sama seperti di atas. Buat:

- **Kategori_model.php** - CRUD kategori alat
- **Pengembalian_model.php** - CRUD pengembalian
- **Log_model.php** - Read-only untuk log aktivitas

---

## Membuat Controllers

### Konsep Controller

Controller adalah class yang menangani request dari user, memanggil model untuk data, dan menampilkan view.

### 1. Auth Controller - Sistem Login/Logout

**File:** `application/controllers/Auth.php`

```php
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('User_model');
        $this->load->library('form_validation');
        $this->load->helper('auth');
    }

    /**
     * Halaman login
     */
    public function index()
    {
        // Redirect ke dashboard jika sudah login
        if ($this->session->userdata('user_id')) {
            redirect('dashboard');
        }

        $this->load->view('auth/login');
    }

    /**
     * Proses login
     */
    public function login()
    {
        // Redirect jika sudah login
        if ($this->session->userdata('user_id')) {
            redirect('dashboard');
        }

        // Set validation rules
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run() == FALSE) {
            // Validation failed, reload login form
            $this->load->view('auth/login');
        } else {
            $username = $this->input->post('username');
            $password = $this->input->post('password');

            // Verify password
            $user = $this->User_model->verify_password($username, $password);

            if ($user) {
                // Check status user
                if ($user->status !== 'aktif') {
                    $data['error'] = 'Akun Anda telah dinonaktifkan';
                    $this->load->view('auth/login', $data);
                    return;
                }

                // Create session
                $this->session->set_userdata([
                    'user_id' => $user->id,
                    'username' => $user->username,
                    'nama_lengkap' => $user->nama_lengkap,
                    'email' => $user->email,
                    'role' => $user->role,
                    'logged_in' => TRUE
                ]);

                // Log activity
                log_activity('LOGIN', 'users', $user->id, 'User login');

                // Redirect ke dashboard
                redirect('dashboard');
            } else {
                // Login failed
                $data['error'] = 'Username atau password salah';
                $this->load->view('auth/login', $data);
            }
        }
    }

    /**
     * Logout
     */
    public function logout()
    {
        // Log activity
        log_activity('LOGOUT', 'users', $this->session->userdata('user_id'), 'User logout');

        // Destroy session
        $this->session->sess_destroy();

        // Redirect ke login
        redirect('auth');
    }
}
```

### 2. Dashboard Controller - Multi-Role Dashboard

**File:** `application/controllers/Dashboard.php`

```php
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        require_login();
        $this->load->model('User_model');
        $this->load->model('Alat_model');
        $this->load->model('Peminjaman_model');
        $this->load->helper('auth');
    }

    /**
     * Dashboard main
     */
    public function index()
    {
        $user_role = $this->session->userdata('role');

        // Siapkan data statistik
        $data['total_users'] = $this->User_model->count_all('users');
        $data['total_alat'] = $this->Alat_model->count_all('alat');
        $data['peminjaman_pending'] = $this->Peminjaman_model->count_pending();

        // Load view sesuai role
        if ($user_role === 'admin') {
            $this->load->view('dashboard/dashboard_admin', $data);
        } elseif ($user_role === 'petugas') {
            $this->load->view('dashboard/dashboard_petugas', $data);
        } else {
            $this->load->view('dashboard/dashboard_peminjam', $data);
        }

        log_activity('READ', 'dashboard', NULL, 'Membuka dashboard');
    }
}
```

### 3. Alat Controller - CRUD Alat

**File:** `application/controllers/Alat.php`

```php
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Alat extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        require_login();
        require_role('admin');
        $this->load->model('Alat_model');
        $this->load->model('Kategori_model');
        $this->load->library('form_validation');
        $this->load->helper('auth');
    }

    /**
     * List semua alat
     */
    public function index()
    {
        $data['alat'] = $this->Alat_model->get_all();
        $this->load->view('partials/header', ['title' => 'Daftar Alat']);
        $this->load->view('alat/index', $data);
        $this->load->view('partials/footer');
    }

    /**
     * Form tambah alat
     */
    public function create()
    {
        $data['kategori'] = $this->Kategori_model->get_all();
        $this->load->view('partials/header', ['title' => 'Tambah Alat']);
        $this->load->view('alat/create', $data);
        $this->load->view('partials/footer');
    }

    /**
     * Store - simpan alat baru
     */
    public function store()
    {
        // Set validation rules
        $this->form_validation->set_rules('nama_alat', 'Nama Alat', 'required');
        $this->form_validation->set_rules('kategori_id', 'Kategori', 'required|numeric');
        $this->form_validation->set_rules('kode_alat', 'Kode Alat', 'required|is_unique[alat.kode_alat]');
        $this->form_validation->set_rules('status', 'Status', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            // Prepare data
            $data = [
                'nama_alat' => $this->input->post('nama_alat'),
                'kategori_id' => $this->input->post('kategori_id'),
                'kode_alat' => $this->input->post('kode_alat'),
                'deskripsi' => $this->input->post('deskripsi'),
                'status' => $this->input->post('status'),
                'lokasi' => $this->input->post('lokasi')
            ];

            // Insert
            if ($this->Alat_model->insert($data)) {
                log_activity('CREATE', 'alat', NULL, 'Tambah alat baru');
                $this->session->set_flashdata('message', 'Alat berhasil ditambahkan');
                redirect('alat');
            } else {
                $this->session->set_flashdata('error', 'Gagal menambahkan alat');
                $this->create();
            }
        }
    }

    /**
     * Form edit alat
     */
    public function edit($id)
    {
        $data['alat'] = $this->Alat_model->get_by_id($id);
        $data['kategori'] = $this->Kategori_model->get_all();

        if (!$data['alat']) {
            show_404();
        }

        $this->load->view('partials/header', ['title' => 'Edit Alat']);
        $this->load->view('alat/edit', $data);
        $this->load->view('partials/footer');
    }

    /**
     * Update alat
     */
    public function update($id)
    {
        $alat = $this->Alat_model->get_by_id($id);
        if (!$alat) {
            show_404();
        }

        // Set validation rules
        $this->form_validation->set_rules('nama_alat', 'Nama Alat', 'required');
        $this->form_validation->set_rules('kategori_id', 'Kategori', 'required|numeric');
        $this->form_validation->set_rules('status', 'Status', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->edit($id);
        } else {
            // Prepare data
            $data = [
                'nama_alat' => $this->input->post('nama_alat'),
                'kategori_id' => $this->input->post('kategori_id'),
                'deskripsi' => $this->input->post('deskripsi'),
                'status' => $this->input->post('status'),
                'lokasi' => $this->input->post('lokasi')
            ];

            // Update
            if ($this->Alat_model->update($id, $data)) {
                log_activity('UPDATE', 'alat', $id, 'Edit alat');
                $this->session->set_flashdata('message', 'Alat berhasil diubah');
                redirect('alat');
            } else {
                $this->session->set_flashdata('error', 'Gagal mengubah alat');
                $this->edit($id);
            }
        }
    }

    /**
     * Delete alat
     */
    public function delete($id)
    {
        $alat = $this->Alat_model->get_by_id($id);
        if (!$alat) {
            show_404();
        }

        if ($this->Alat_model->delete($id)) {
            log_activity('DELETE', 'alat', $id, 'Hapus alat');
            $this->session->set_flashdata('message', 'Alat berhasil dihapus');
        } else {
            $this->session->set_flashdata('error', 'Gagal menghapus alat');
        }

        redirect('alat');
    }
}
```

**Catatan:** Buat controller serupa untuk: User, Kategori, Peminjaman, Pengembalian, Log, dan Laporan dengan struktur CRUD yang sama.

---

## Membuat Views & Partials

### Konsep View

View adalah file HTML/PHP yang menampilkan datanya kepada user. CodeIgniter memisahkan view agar logika tetap bersih.

### 1. Layout Partials

#### Header Partial

**File:** `application/views/partials/header.php`

```php
<?php 
$current_user = get_current_user();
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo $title ?? 'Sistem Peminjaman Alat'; ?></title>
    
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Font Awesome 6 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <!-- Custom CSS -->
    <style>
        .fade-out {
            animation: fadeOut 4s ease-in-out forwards;
        }
        
        @keyframes fadeOut {
            0% { opacity: 1; }
            90% { opacity: 1; }
            100% { opacity: 0; }
        }

        .navbar {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }

        .sidebar {
            min-height: 100vh;
            background: #f8f9fa;
        }

        .main-content {
            background: #f5f5f5;
            min-height: 100vh;
        }
    </style>
</head>
<body class="bg-gray-50">
    <div class="flex h-screen">
        <!-- Sidebar -->
        <?php $this->load->view('partials/sidebar'); ?>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col">
            <!-- Navbar -->
            <nav class="navbar text-white shadow-lg">
                <div class="flex justify-between items-center px-6 py-4">
                    <h1 class="text-2xl font-bold">
                        <i class="fas fa-tools mr-2"></i>Sistem Peminjaman Alat
                    </h1>
                    <div class="flex items-center gap-4">
                        <span class="text-sm">
                            Selamat datang, <strong><?php echo $current_user->nama_lengkap; ?></strong>
                        </span>
                        <a href="<?php echo site_url('auth/logout'); ?>" 
                           class="bg-red-500 hover:bg-red-600 px-4 py-2 rounded text-sm transition">
                            <i class="fas fa-sign-out-alt mr-1"></i>Logout
                        </a>
                    </div>
                </div>
            </nav>

            <!-- Page Content -->
            <div class="flex-1 overflow-auto p-6">
                <div class="max-w-7xl mx-auto">
```

#### Sidebar Partial

**File:** `application/views/partials/sidebar.php`

```php
<?php 
$current_user = get_current_user();
$current_page = $this->router->class;
?>

<aside class="sidebar w-64 border-r border-gray-200">
    <div class="p-6">
        <h2 class="text-xl font-bold text-gray-800 mb-2">
            <i class="fas fa-briefcase text-blue-600 mr-2"></i>Menu
        </h2>
        <p class="text-xs text-gray-500 mb-6">
            Role: <span class="font-semibold text-gray-700"><?php echo ucfirst($current_user->role); ?></span>
        </p>

        <nav class="space-y-2">
            <!-- Dashboard -->
            <a href="<?php echo site_url('dashboard'); ?>" 
               class="block px-4 py-3 rounded transition <?php echo ($current_page === 'dashboard') ? 'bg-blue-100 text-blue-700 font-semibold' : 'text-gray-700 hover:bg-gray-100'; ?>">
                <i class="fas fa-chart-line mr-2"></i>Dashboard
            </a>

            <!-- Menu Admin -->
            <?php if (has_role('admin')): ?>
            <div class="text-xs font-semibold text-gray-600 uppercase mt-6 mb-2 px-4">Admin</div>
            
            <a href="<?php echo site_url('user'); ?>" 
               class="block px-4 py-3 rounded transition <?php echo ($current_page === 'user') ? 'bg-blue-100 text-blue-700 font-semibold' : 'text-gray-700 hover:bg-gray-100'; ?>">
                <i class="fas fa-users mr-2"></i>Kelola User
            </a>

            <a href="<?php echo site_url('kategori'); ?>" 
               class="block px-4 py-3 rounded transition <?php echo ($current_page === 'kategori') ? 'bg-blue-100 text-blue-700 font-semibold' : 'text-gray-700 hover:bg-gray-100'; ?>">
                <i class="fas fa-tag mr-2"></i>Kategori Alat
            </a>

            <a href="<?php echo site_url('alat'); ?>" 
               class="block px-4 py-3 rounded transition <?php echo ($current_page === 'alat') ? 'bg-blue-100 text-blue-700 font-semibold' : 'text-gray-700 hover:bg-gray-100'; ?>">
                <i class="fas fa-wrench mr-2"></i>Daftar Alat
            </a>

            <a href="<?php echo site_url('log'); ?>" 
               class="block px-4 py-3 rounded transition <?php echo ($current_page === 'log') ? 'bg-blue-100 text-blue-700 font-semibold' : 'text-gray-700 hover:bg-gray-100'; ?>">
                <i class="fas fa-history mr-2"></i>Log Aktivitas
            </a>
            <?php endif; ?>

            <!-- Menu Petugas & Admin -->
            <?php if (has_role(['admin', 'petugas'])): ?>
            <div class="text-xs font-semibold text-gray-600 uppercase mt-6 mb-2 px-4">Peminjaman</div>

            <a href="<?php echo site_url('peminjaman'); ?>" 
               class="block px-4 py-3 rounded transition <?php echo ($current_page === 'peminjaman') ? 'bg-blue-100 text-blue-700 font-semibold' : 'text-gray-700 hover:bg-gray-100'; ?>">
                <i class="fas fa-handshake mr-2"></i>Daftar Peminjaman
            </a>

            <a href="<?php echo site_url('pengembalian'); ?>" 
               class="block px-4 py-3 rounded transition <?php echo ($current_page === 'pengembalian') ? 'bg-blue-100 text-blue-700 font-semibold' : 'text-gray-700 hover:bg-gray-100'; ?>">
                <i class="fas fa-undo mr-2"></i>Pengembalian
            </a>

            <a href="<?php echo site_url('laporan'); ?>" 
               class="block px-4 py-3 rounded transition <?php echo ($current_page === 'laporan') ? 'bg-blue-100 text-blue-700 font-semibold' : 'text-gray-700 hover:bg-gray-100'; ?>">
                <i class="fas fa-file-pdf mr-2"></i>Laporan
            </a>
            <?php endif; ?>

            <!-- Menu Peminjam -->
            <?php if (has_role('peminjam')): ?>
            <div class="text-xs font-semibold text-gray-600 uppercase mt-6 mb-2 px-4">Peminjaman Saya</div>

            <a href="<?php echo site_url('alat'); ?>" 
               class="block px-4 py-3 rounded transition text-gray-700 hover:bg-gray-100">
                <i class="fas fa-search mr-2"></i>Cari Alat
            </a>

            <a href="<?php echo site_url('peminjaman'); ?>" 
               class="block px-4 py-3 rounded transition text-gray-700 hover:bg-gray-100">
                <i class="fas fa-handshake mr-2"></i>Peminjaman Saya
            </a>
            <?php endif; ?>
        </nav>
    </div>
</aside>
```

#### Footer Partial

**File:** `application/views/partials/footer.php`

```php
                </div>
            </div>

            <!-- Footer -->
            <footer class="bg-white border-t border-gray-200 p-4 text-center text-gray-600 text-sm">
                <p>&copy; 2026 Sistem Peminjaman Alat. All rights reserved.</p>
            </footer>
        </div>
    </div>
</body>
</html>
```

#### Table Partial (Reusable Table Component)

**File:** `application/views/partials/table.php`

```php
<?php
if (isset($table_part) && $table_part === 'header') {
    // Render table header
    ?>
    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <table class="w-full">
            <thead class="bg-gray-100 border-b border-gray-200">
                <tr>
                    <?php foreach ($columns as $col): ?>
                    <th class="<?php echo $col['class']; ?>">
                        <?php echo $col['label']; ?>
                    </th>
                    <?php endforeach; ?>
                </tr>
            </thead>
            <tbody>
    <?php
} elseif (isset($table_part) && $table_part === 'footer') {
    // Close table
    ?>
            </tbody>
        </table>
    </div>
    <?php
}
```

### 2. View Login

**File:** `application/views/auth/login.php`

```php
<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login - Sistem Peminjaman Alat</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-gradient-to-br from-blue-600 to-blue-800 min-h-screen flex items-center justify-center">
    <div class="w-full max-w-md">
        <div class="bg-white rounded-lg shadow-xl p-8">
            <!-- Header -->
            <div class="text-center mb-8">
                <i class="fas fa-tools text-blue-600 text-4xl mb-4 block"></i>
                <h1 class="text-3xl font-bold text-gray-800">Sistem Peminjaman</h1>
                <p class="text-gray-600 text-sm mt-1">Masuk ke akun Anda</p>
            </div>

            <!-- Error Message -->
            <?php if (isset($error)): ?>
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg mb-6">
                <i class="fas fa-exclamation-circle mr-2"></i><?php echo $error; ?>
            </div>
            <?php endif; ?>

            <!-- Validation Errors -->
            <?php if (validation_errors()): ?>
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg mb-6 text-sm">
                <?php echo validation_errors('<p>', '</p>'); ?>
            </div>
            <?php endif; ?>

            <!-- Login Form -->
            <form method="post" action="<?php echo site_url('auth/login'); ?>" class="space-y-4">
                <div>
                    <label for="username" class="block text-sm font-semibold text-gray-700 mb-2">
                        <i class="fas fa-user mr-2"></i>Username
                    </label>
                    <input type="text" id="username" name="username" 
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                           placeholder="Masukkan username" autocomplete="off">
                </div>

                <div>
                    <label for="password" class="block text-sm font-semibold text-gray-700 mb-2">
                        <i class="fas fa-lock mr-2"></i>Password
                    </label>
                    <input type="password" id="password" name="password" 
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                           placeholder="Masukkan password">
                </div>

                <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-lg transition">
                    <i class="fas fa-sign-in-alt mr-2"></i>Masuk
                </button>
            </form>

            <!-- Info -->
            <div class="mt-6 p-4 bg-blue-50 rounded-lg border border-blue-200 text-sm text-gray-700">
                <p class="font-semibold mb-2"><i class="fas fa-info-circle text-blue-600 mr-2"></i>Akun Demo:</p>
                <ul class="space-y-1 text-xs">
                    <li><strong>Admin:</strong> admin / password123</li>
                    <li><strong>Petugas:</strong> petugas1 / password123</li>
                    <li><strong>Peminjam:</strong> peminjam1 / password123</li>
                </ul>
            </div>
        </div>
    </div>
</body>
</html>
```

### 3. View Alat Index (List)

**File:** `application/views/alat/index.php`

```php
<?php defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('partials/header', array('title' => 'Daftar Alat')); ?>

<div class="flex justify-between items-center mb-6">
    <h2 class="text-3xl font-bold text-gray-800">
        <i class="fas fa-wrench text-blue-600 mr-2"></i> Daftar Alat
    </h2>
    <?php if (has_role('admin')): ?>
    <a href="<?php echo site_url('alat/create'); ?>" 
       class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-lg transition">
        <i class="fas fa-plus mr-2"></i> Tambah Alat Baru
    </a>
    <?php endif; ?>
</div>

<!-- Flash Messages -->
<?php if ($this->session->flashdata('message')): ?>
<div class="alert-box bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg mb-4 fade-out transition">
    <i class="fas fa-check-circle mr-2"></i> <?php echo $this->session->flashdata('message'); ?>
</div>
<?php endif; ?>

<!-- Table -->
<?php
$columns = [
    ['label' => 'No', 'class' => 'px-4 py-3 text-left text-sm font-semibold text-gray-700 w-12'],
    ['label' => 'Nama Alat', 'class' => 'px-4 py-3 text-left text-sm font-semibold text-gray-700'],
    ['label' => 'Kategori', 'class' => 'px-4 py-3 text-left text-sm font-semibold text-gray-700'],
    ['label' => 'Status', 'class' => 'px-4 py-3 text-left text-sm font-semibold text-gray-700 w-24'],
    ['label' => 'Aksi', 'class' => 'px-4 py-3 text-left text-sm font-semibold text-gray-700 w-48'],
];
$this->load->view('partials/table', array('columns' => $columns, 'table_part' => 'header'));
?>
    <?php if (count($alat) > 0): ?>
        <?php $no = 1; foreach ($alat as $a): ?>
        <tr class="hover:bg-gray-50 transition border-b">
            <td class="px-4 py-3 text-sm text-gray-700"><?php echo $no++; ?></td>
            <td class="px-4 py-3 text-sm font-semibold text-gray-800"><?php echo htmlspecialchars($a->nama_alat); ?></td>
            <td class="px-4 py-3 text-sm text-gray-700"><?php echo htmlspecialchars($a->nama_kategori); ?></td>
            <td class="px-4 py-3 text-sm">
                <?php 
                    $status_class = ($a->status === 'tersedia') ? 'bg-green-200 text-green-800' : 'bg-yellow-200 text-yellow-800';
                ?>
                <span class="<?php echo $status_class; ?> px-3 py-1 rounded-full text-xs font-semibold">
                    <?php echo ucfirst($a->status); ?>
                </span>
            </td>
            <td class="px-4 py-3 text-sm space-x-2 flex">
                <a href="<?php echo site_url('peminjaman/create?alat_id='.$a->id); ?>" 
                   class="inline-flex items-center gap-1 px-3 py-1 rounded text-xs font-semibold transition bg-cyan-500 hover:bg-cyan-600 text-white">
                    <i class="fas fa-check"></i> Pinjam
                </a>
                <?php if (has_role('admin')): ?>
                <a href="<?php echo site_url('alat/edit/' . $a->id); ?>" 
                   class="inline-flex items-center gap-1 px-3 py-1 rounded text-xs font-semibold transition bg-yellow-500 hover:bg-yellow-600 text-white">
                    <i class="fas fa-edit"></i> Edit
                </a>
                <a href="<?php echo site_url('alat/delete/' . $a->id); ?>" 
                   class="inline-flex items-center gap-1 px-3 py-1 rounded text-xs font-semibold transition bg-red-500 hover:bg-red-600 text-white"
                   onclick="return confirm('Apakah Anda yakin?');">
                    <i class="fas fa-trash"></i> Hapus
                </a>
                <?php endif; ?>
            </td>
        </tr>
        <?php endforeach; ?>
    <?php else: ?>
    <tr>
        <td colspan="5" class="px-4 py-8 text-center text-gray-500">
            <i class="fas fa-inbox text-4xl mb-2 block"></i>
            <p class="font-semibold">Tidak ada data alat</p>
        </td>
    </tr>
    <?php endif; ?>
<?php $this->load->view('partials/table', array('table_part' => 'footer')); ?>

<?php $this->load->view('partials/footer'); ?>
```

---

## Styling dengan Tailwind CSS

### Pengenalan Tailwind CSS

Tailwind CSS adalah utility-first CSS framework yang memudahkan styling tanpa perlu menulis CSS custom.

### Cara Menggunakan Tailwind

#### 1. Text Styling
```html
<!-- Size -->
<h1 class="text-4xl">Heading 1</h1>
<p class="text-sm">Small text</p>

<!-- Weight -->
<p class="font-bold">Bold text</p>
<p class="font-semibold">Semibold</p>

<!-- Color -->
<p class="text-blue-600">Blue text</p>
<p class="text-white">White text</p>
```

#### 2. Spacing
```html
<!-- Padding: p-{size} -->
<div class="p-4">Padding 1rem</div>
<div class="px-4 py-2">Horizontal padding, vertical padding</div>

<!-- Margin: m-{size} -->
<div class="mb-6">Margin bottom</div>
<div class="mt-4 ml-2">Margin top dan left</div>

<!-- Gap: gap-{size} -->
<div class="flex gap-2">
    <div>Item 1</div>
    <div>Item 2</div>
</div>
```

#### 3. Flexbox & Grid
```html
<!-- Flex container -->
<div class="flex justify-between items-center">
    <!-- Justify content: center, between, around, etc -->
    <!-- Align items: start, center, end -->
</div>

<!-- Grid -->
<div class="grid grid-cols-3 gap-4">
    <div>Column 1</div>
    <div>Column 2</div>
    <div>Column 3</div>
</div>
```

#### 4. Colors
```html
<!-- Background colors -->
<div class="bg-blue-600">Blue background</div>
<div class="bg-red-500 hover:bg-red-600">With hover state</div>

<!-- Border -->
<div class="border border-gray-300 rounded">With border</div>
<div class="border-l-4 border-blue-500">Left border</div>
```

#### 5. Responsive Design
```html
<!-- Mobile-first approach -->
<h1 class="text-2xl md:text-3xl lg:text-4xl">
    Text size changes based on screen size
</h1>

<!-- GridStat responsive -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
    <!-- 1 col on mobile, 2 on tablet, 4 on desktop -->
</div>
```

### Tailwind Components

Gunakan kombinasi class untuk membuat components:

```html
<!-- Button -->
<button class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-lg transition">
    Click me
</button>

<!-- Card -->
<div class="bg-white rounded-lg shadow-md p-6 border border-gray-200">
    <h3 class="font-bold text-gray-800 mb-2">Card Title</h3>
    <p class="text-gray-600">Card content</p>
</div>

<!-- Alert -->
<div class="bg-blue-100 border border-blue-400 text-blue-700 px-4 py-3 rounded-lg">
    <i class="fas fa-info-circle mr-2"></i>Alert message
</div>
```

---

## Testing & Deployment

### Testing Aplikasi Secara Manual

#### 1. Test Login

```
1. Buka: http://localhost/CodeIgniter/index.php/auth
2. Masukkan username: admin, password: password123
3. Klik Login
4. Seharusnya redirect ke dashboard
5. Cek session di Firefox Dev Tools > Storage > Cookies
```

#### 2. Test CRUD Alat

```
1. Login sebagai admin
2. Klik menu "Daftar Alat"
3. Klik "Tambah Alat Baru"
4. Isi form dan submit
5. Cek apakah data muncul di list
6. Edit dan delete untuk test
```

#### 3. Test Role-Based Access

```
1. Login sebagai peminjam
2. Coba akses /alat/create
3. Seharusnya menampilkan error 403
4. Setup routes jika diperlukan
```

#### 4. Test Database Logging

```
1. Lakukan beberapa aksi (create, update, delete)
2. Klik menu "Log Aktivitas"
3. Cek apakah aktivitas tercatat dengan benar
```

### Deployment ke Production

#### Step 1: Setup Production Server

```bash
# Upload ke hosting (via FTP/SSH)
1. FTP ke folder public_html atau www
2. Upload semua file CodeIgniter
3. Setup database di hosting
```

#### Step 2: Konfigurasi Production

**File:** `application/config/config.php`

```php
// Change environment to production
define('ENVIRONMENT', isset($_SERVER['CI_ENV']) ? $_SERVER['CI_ENV'] : 'production');

// Update base URL
$config['base_url'] = 'https://yourdomain.com/';

// Disable error display
$config['log_threshold'] = 1; // Only log errors
```

#### Step 3: Security Checklist

- ✓ Change admin password
- ✓ Update database credentials
- ✓ Remove debug information
- ✓ Set proper file permissions (644 for files, 755 for folders)
- ✓ Enable HTTPS
- ✓ Backup database secara regular
- ✓ Update CodeIgniter ke versi terbaru

---

## Maintenance & Best Practices

### Regular Maintenance

```bash
# 1. Backup database
Jalankan export database dari phpMyAdmin setiap minggu

# 2. Monitor logs
Check application/logs/ untuk error messages

# 3. Update dependencies
Pastikan library terakhir digunakan

# 4. Clean cache
Delete temporary files di application/cache/
```

### Best Practices

| Praktik | Penjelasan | Contoh |
|---------|-----------|--------|
| **Input Validation** | Selalu validasi input user | `form_validation->set_rules()` |
| **SQL Injection Prevention** | Gunakan query builder, jangan raw SQL | `$this->db->get_where()` |
| **XSS Prevention** | Escape output html | `htmlspecialchars()` |
| **Password Hashing** | Jangan simpan plain text password | `password_hash()` |
| **Error Handling** | Handle error gracefully | `try-catch` atau cek `$this->db->error()` |
| **Logging** | Log semua aktivitas penting |  `log_activity()` helper |
| **MVC Pattern** | Pisahkan logika, view, dan data | Model, Controller, View yang jelas |

---

## Troubleshooting

### Problem: Database Connection Error

**Solusi:**
```bash
1. Cek database.php - pastikan hostname, username, password benar
2. Pastikan MySQL sudah running
3. Buat database dengan nama yang sesuai

# Test connection
mysql -u root -p -h localhost
USE peminjaman_alat;
SHOW TABLES;
```

### Problem: 404 Page saat login

**Solusi:**
```php
// Check routes.php
$route['default_controller'] = 'auth';

// Buka: http://localhost/CodeIgniter/index.php/auth
// Bukan: http://localhost/CodeIgniter/
```

### Problem: Session tidak terseaving

**Solusi:**
```php
// Check config/config.php
$config['sess_driver'] = 'files';
$config['sess_save_path'] = NULL; // Akan otomatis ke /var/lib/php/sessions

// Atau custom path:
// $config['sess_save_path'] = BASEPATH . '../application/sessions';
// Pastikan folder ada dan writable (chmod 777)
```

### Problem: Password salah meski benar

**Solusi:**
```php
// Pastikan menggunakan password_hash dan password_verify
// Update user dengan password yang benar:

$password = 'password123';
$hashed = password_hash($password, PASSWORD_BCRYPT);
// Kemudian query: UPDATE users SET password = '$hashed' WHERE id = 1
```

---

## Kesimpulan

Dengan 6 jam atau lebih waktu, Anda sudah dapat membuat sistem peminjaman alat yang lengkap dengan:

✅ Database dengan 6 tabel terstruktur  
✅ 9+ Controller untuk CRUD operations  
✅ 5+ Model untuk business logic  
✅ 15+ View dengan layout responsive  
✅ Role-based access control (RBAC)  
✅ Form validation dan error handling  
✅ Modern UI dengan Tailwind CSS  
✅ Audit trail dan logging  
✅ Ready for deployment  

### Next Steps

1. **Customize sesuai kebutuhan** - Tambahkan fitur lain jika diperlukan
2. **Tingkatkan security** - Implementasi CSRF token, rate limiting
3. **Optimize performance** - Cache database queries, minimize CSS/JS
4. **Deploy ke production** - Gunakan automatic backups dan monitoring

---

## Resources & Referensi

- [CodeIgniter 3 Documentation](https://codeigniter.com/user_guide/)
- [Tailwind CSS Docs](https://tailwindcss.com/docs)
- [Font Awesome Icons](https://fontawesome.com/icons)
- [MySQL Docs](https://dev.mysql.com/doc/)
- [PHP Security](https://www.php.net/manual/en/security.php)

---

**Happy Coding! 🚀**

*Tutorial ini dibuat untuk pembelajaran dan dapat dimodifikasi sesuai kebutuhan.*

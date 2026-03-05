# Sistem Peminjaman Alat - CodeIgniter 3

Sistem manajemen peminjaman alat dengan role-based access control (RBAC) untuk 3 tipe user: **Admin**, **Petugas**, dan **Peminjam**.

## 📋 Fitur Utama

### Untuk Admin
- ✅ CRUD User (Admin, Petugas, Peminjam)
- ✅ CRUD Alat & Kategori
- ✅ CRUD Peminjaman
- ✅ CRUD Pengembalian
- ✅ Log Aktivitas
- ✅ Dashboard dengan statistik

### Untuk Petugas
- ✅ Menyetujui/Menolak Peminjaman
- ✅ Memantau Pengembalian
- ✅ Mencetak Laporan
- ✅ Melihat Daftar Alat
- ✅ Dashboard dengan statistik

### Untuk Peminjam
- ✅ Melihat Daftar Alat
- ✅ Mengajukan Peminjaman
- ✅ Mengembalikan Alat
- ✅ Melihat Peminjaman Saya
- ✅ Dashboard personal

## 🗄️ Struktur Database

### Tabel-tabel yang Dibuat:
1. **users** - Data user (admin, petugas, peminjam)
2. **kategori_alat** - Kategori alat
3. **alat** - Data master alat
4. **peminjaman** - Data peminjaman
5. **pengembalian** - Data pengembalian alat
6. **log_aktivitas** - Log semua aktivitas sistem

## 🚀 Instalasi

### 1. Setup Database

Jalankan script SQL dari file `database_lengkap.sql`:

```sql
-- Buka file database_lengkap.sql dan jalankan semua query
```

Atau copy-paste seluruh isi file ke phpMyAdmin dan jalankan.

### 2. Load Auth Helper

Edit file `application/config/autoload.php` dan tambahkan auth helper:

```php
$autoload['helper'] = array('auth', 'form');
```

### 3. Akses Aplikasi

Buka browser dan akses:

```
http://localhost/CodeIgniter/index.php/auth
```

## 🔐 Data Login Sample

Setelah menjalankan SQL script, gunakan data login berikut:

| Role | Username | Password |
|------|----------|----------|
| Admin | admin | password123 |
| Petugas | petugas1 | password123 |
| Peminjam | peminjam1 | password123 |

## 📁 File yang Dibuat

### Models
- `application/models/User_model.php` - Model untuk user management
- `application/models/Peminjaman_model.php` - Model untuk peminjaman

### Controllers
- `application/controllers/Auth.php` - Login/Logout
- `application/controllers/Dashboard.php` - Dashboard untuk setiap role
- `application/controllers/Peminjaman.php` - CRUD Peminjaman (sudah ada)

### Helpers
- `application/helpers/Auth_helper.php` - Helper untuk role-based access control

### Views
- `application/views/auth/login.php` - Halaman login
- `application/views/dashboard/dashboard_admin.php` - Dashboard admin
- `application/views/dashboard/dashboard_petugas.php` - Dashboard petugas
- `application/views/dashboard/dashboard_peminjam.php` - Dashboard peminjam
- `application/views/peminjaman/` - Views untuk CRUD peminjaman (sudah ada)

## 🔑 Auth Helper Functions

Helper ini menyediakan fungsi-fungsi untuk mengecek role dan validasi akses:

### Mengecek Status Login
```php
is_logged_in() // Return boolean
```

### Mengecek Role
```php
has_role('admin') // Cek role spesifik
is_admin() // Cek apakah admin
is_petugas() // Cek apakah petugas
is_peminjam() // Cek apakah peminjam
```

### Mendapatkan Data User
```php
get_user_id() // Get ID user yang login
get_user_name() // Get nama lengkap user
get_user_role() // Get role user
```

### Require Login & Role
```php
require_login() // Wajib login, redirect ke auth jika belum
require_role('admin') // Wajib role admin
require_role(array('admin', 'petugas')) // Accept multiple roles
```

## 💻 Cara Menggunakan

### Penggunaan di Controller

```php
<?php
class User extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->helper('auth');
        require_role('admin'); // Hanya admin yang bisa akses
    }
    
    public function index() {
        if (is_admin()) {
            // Lakukan something untuk admin
        }
    }
}
```

### Penggunaan di View

```php
<?php if (is_admin()): ?>
    <div>Ini hanya terlihat untuk admin</div>
<?php endif; ?>
```

## 🔄 Alur Peminjaman

1. **Peminjam** mengajukan peminjaman alat
2. **Status**: Menunggu Persetujuan
3. **Petugas** melihat peminjaman menunggu
4. **Petugas** menyetujui atau menolak
5. **Jika Disetujui**: Status menjadi "Disetujui"
6. **Peminjam** mengambil alat
7. **Peminjam** mengembalikan alat
8. **Petugas** menerima pengembalian dan cek kondisi
9. **Status**: "Dikembalikan" (Selesai)

## 📊 Dashboard Features

### Dashboard Admin
- Statistik: Total User, Total Alat, Total Peminjaman, Peminjaman Menunggu
- Akses ke semua menu manajemen

### Dashboard Petugas
- Statistik: Peminjaman Menunggu, Peminjaman Disetujui, Alat Sedang Dipinjam
- Menu untuk kelola peminjaman & pengembalian

### Dashboard Peminjam
- Statistik: Total Peminjaman, Menunggu, Aktif
- Menu untuk melihat alat dan mengajukan peminjaman

## 🔒 Security Features

- Password di-hash menggunakan bcrypt
- Session management untuk prevent unauthorized access
- Role-based access control untuk setiap fitur
- SQL injection prevention (menggunakan query builder)
- CSRF protection (default CodeIgniter)
- Log aktivitas untuk audit trail

## 🛠️ Teknologi

- **Framework**: CodeIgniter 3
- **Database**: MySQL
- **Frontend**: Bootstrap 4
- **Icons**: Font Awesome 6
- **Password Hashing**: BCrypt

## 📝 Catatan Penting

1. **Helper Auth** harus di-load di setiap controller yang membutuhkan role checking
2. **Autoload Auth Helper** di config/autoload.php agar otomatis tersedia
3. Password menggunakan BCrypt, jangan ubah method ke plain text
4. Log aktivitas otomatis tercatat di setiap login/logout
5. User harus aktif (status='aktif') untuk bisa login

## 🔄 Migrasi dari Sistem Lama

Jika punya system lama, ubah table:

```sql
ALTER TABLE peminjaman ADD COLUMN status ENUM('menunggu','disetujui','ditolak','dikembalikan');
ALTER TABLE alat ADD COLUMN status ENUM('tersedia','dipinjam','diperbaiki');
```

## 🚀 Pengembangan Lanjutan

Fitur yang bisa ditambahkan:
- Email notification untuk persetujuan peminjaman
- SMS notification untuk reminder pengembalian
- Export laporan ke PDF/Excel
- Pagination untuk list data
- Search & filter untuk alat
- Dashboard dengan chart/graph
- Mobile app using CodeIgniter REST API
- API untuk integrasi dengan sistem lain

## 📞 Support

Jika ada pertanyaan atau error, pastikan:
1. Database sudah dibuat dengan benar
2. Auth helper sudah di-autoload
3. Session library aktif di CodeIgniter
4. File-file sudah di-tempat yang benar

## 📄 License

MIT License - Bebas digunakan untuk project apapun

---

**Dibuat dengan ❤️ untuk CodeIgniter 3**

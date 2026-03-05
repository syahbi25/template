# PANDUAN SETUP SISTEM PEMINJAMAN ALAT

## ⚡ QUICK START (5 Menit)

### Langkah 1: Buat Database
1. Buka phpMyAdmin atau MySQL terminal
2. Jalankan SQL script dari file **`database_lengkap.sql`**
3. Database dan tabel akan otomatis dibuat

### Langkah 2: Konfigurasi CodeIgniter

Edit file `application/config/autoload.php`:

Cari bagian `$autoload['helper']` (sekitar baris 89):

```php
// BEFORE:
$autoload['helper'] = array('form');

// AFTER:
$autoload['helper'] = array('form', 'auth');
```

Pastikan `$autoload['libraries']` sudah include session:

```php
$autoload['libraries'] = array('session');
```

### Langkah 3: Akses Sistem

1. Buka browser: `http://localhost/CodeIgniter/index.php/auth`
2. Login dengan salah satu akun sample (lihat tabel di bawah)
3. Selesai! ✅

---

## 👥 Akun Login Sample

Semua akun menggunakan password: **`password123`**

| Role | Username | Fitur |
|------|----------|-------|
| **Admin** | admin | Kelola semua (user, alat, peminjaman) |
| **Petugas** | petugas1 | Setujui/Tolak peminjaman, Laporan |
| **Peminjam** | peminjam1 | Ajukan peminjaman, Kembalikan alat |

---

## 📂 File-File yang Sudah Dibuat

### Database
- ✅ `database_lengkap.sql` - SQL script dengan semua tabel dan data sample

### Scripts SQL Database
```
- users (untuk login 3 role)
- kategori_alat
- alat
- peminjaman
- pengembalian
- log_aktivitas
```

### Models (`application/models/`)
- ✅ `User_model.php` - User management & authentication
- ✅ `Peminjaman_model.php` - Peminjaman (dari sebelumnya)

### Controllers (`application/controllers/`)
- ✅ `Auth.php` - Login/Logout
- ✅ `Dashboard.php` - Dashboard untuk 3 role berbeda
- ✅ `Peminjaman.php` - CRUD Peminjaman (dari sebelumnya)

### Helpers (`application/helpers/`)
- ✅ `Auth_helper.php` - Fungsi untuk role-based access

### Views (`application/views/`)
- `auth/login.php` - Halaman login
- `dashboard/dashboard_admin.php` - Dashboard admin
- `dashboard/dashboard_petugas.php` - Dashboard petugas
- `dashboard/dashboard_peminjam.php` - Dashboard peminjam
- `peminjaman/` - Views CRUD Peminjaman (dari sebelumnya)

---

## 🔐 Fitur Keamanan

✅ Password di-hash dengan BCrypt  
✅ Session management  
✅ Role-based access control (Admin, Petugas, Peminjam)  
✅ Log aktivitas user  
✅ SQL injection prevention  

---

## 🗺️ URL Routes

### Authentication
| URL | Method | Deskripsi |
|-----|--------|-----------|
| `/auth` | GET | Halaman login |
| `/auth/login` | POST | Proses login |
| `/auth/logout` | GET | Logout |

### Dashboard
| URL | Akses | Deskripsi |
|-----|-------|-----------|
| `/dashboard` | Semua role | Dashboard sesuai role |

### Peminjaman (Akan ditambah di tahap selanjutnya)
| URL | Akses | Deskripsi |
|-----|-------|-----------|
| `/peminjaman` | Admin, Petugas, Peminjam | Lihat peminjaman |
| `/peminjaman/create` | Peminjam | Ajukan peminjaman |
| `/peminjaman/edit/{id}` | Admin | Edit peminjaman |

---

## 🎯 Alur Penggunaan

### Skenario 1: Peminjam Ajukan Peminjaman

```
1. Peminjam login (peminjam1)
2. Klik "Dashboard" → "Ajukan Peminjaman"
3. Pilih alat, tanggal, keperluan
4. Submit (status: Menunggu)
5. Tunggu persetujuan petugas
```

### Skenario 2: Petugas Setujui

```
1. Petugas login (petugas1)
2. Buka Dashboard → "Peminjaman Menunggu"
3. Klik peminjaman → "Setujui"
4. Peminjam bisa ambil alat
```

### Skenario 3: Peminjam Kembalikan Alat

```
1. Peminjam login (peminjam1)
2. Buka "Peminjaman Saya"
3. Klik "Kembalikan" pada peminjaman aktif
4. Isi kondisi alat
5. Petugas verifikasi pengembalian
```

---

## ⚙️ Konfigurasi Lanjutan

### 1. Ganti Password User

Di phpMyAdmin:
```sql
-- Ganti password admin
UPDATE users SET password = '$2y$10$...' WHERE username = 'admin';
```

Untuk generate bcrypt hash, gunakan:
```php
echo password_hash('password_baru', PASSWORD_BCRYPT);
```

### 2. Tambah User Baru

Bisa melalui admin panel (akan dibuat di tahap selanjutnya) atau SQL:

```sql
INSERT INTO users (username, email, password, nama_lengkap, role) 
VALUES ('user_baru', 'email@domain.com', '[BCRYPT_HASH]', 'Nama User', 'peminjam');
```

### 3. Ubah Status User

```sql
-- Non-aktifkan user
UPDATE users SET status = 'nonaktif' WHERE id = 1;

-- Aktifkan kembali
UPDATE users SET status = 'aktif' WHERE id = 1;
```

---

## 🔧 Troubleshooting

### Problem: Halaman Blank / Error
**Solusi**: 
- Check error logs di `application/logs/`
- Pastikan database terkoneksi
- Clear cache browser (Ctrl+Shift+Delete)

### Problem: Session tidak bekerja
**Solusi**:
- Buat folder: `application/sessions/` (jika belum ada)
- Chmod 755 untuk folder tersebut
- Check `application/config/config.php` line 370:
  ```php
  $config['sess_driver'] = 'files';
  ```

### Problem: Login Gagal
**Solusi**:
- Pastikan database sudah import SQL script
- Check username & password benar
- Verifikasi user status = 'aktif' di database

### Problem: 404 Not Found
**Solusi**:
- Pastikan URL: `/auth` (bukan `/auth/index`)
- Check mod_rewrite enabled (untuk URL tanpa index.php)

---

## 📈 Tahap Selanjutnya (Optional)

Fitur tambahan yang bisa dikembangkan:

1. **CRUD User** - Admin panel untuk kelola user
2. **CRUD Alat & Kategori** - Admin panel untuk master data
3. **CRUD Pengembalian** - Proses pengembalian alat
4. **Report/Laporan** - Export PDF, Excel
5. **Dashboard Charts** - Grafik statistik
6. **Email Notifications** - Notifikasi via email
7. **Search & Filter** - Pencarian data
8. **API** - REST API untuk mobile app

---

## ✅ Checklist Sebelum Go Live

- [ ] Database sudah dibuat dengan SQL script
- [ ] Auth helper sudah di-autoload
- [ ] Folder `application/sessions/` ada dan writable
- [ ] Bisa login dengan akun sample
- [ ] Dashboard menampilkan sesuai role
- [ ] Test logout
- [ ] Test akses URL yang tidak diizinkan (harus redirect)

---

## 😊 Kesimpulan

Sistem sudah siap digunakan! Sekarang Anda memiliki:

✅ Sistem login dengan 3 role (Admin, Petugas, Peminjam)  
✅ Role-based access control yang aman  
✅ Database lengkap dengan relasi  
✅ Dashboard untuk setiap role  
✅ Siap untuk manajemen peminjaman alat  

Happy coding! 🚀

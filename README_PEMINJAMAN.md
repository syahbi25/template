# CRUD Peminjaman Alat - CodeIgniter 3

Ini adalah contoh implementasi CRUD sederhana untuk sistem peminjaman alat di CodeIgniter 3.

## Fitur

- ✅ Create (Tambah) - Menambahkan data peminjaman baru
- ✅ Read (Baca) - Menampilkan daftar dan detail peminjaman
- ✅ Update (Edit) - Mengubah data peminjaman
- ✅ Delete (Hapus) - Menghapus data peminjaman
- ✅ Form Validation - Validasi form input
- ✅ Flash Messages - Pesan berhasil/gagal
- ✅ Bootstrap UI - Antarmuka yang menarik dan responsif

## Instalasi

### 1. Buat Database Table

Jalankan script SQL di bawah ini di database Anda:

```sql
CREATE TABLE IF NOT EXISTS `peminjaman` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_alat` varchar(255) NOT NULL,
  `peminjam` varchar(255) NOT NULL,
  `tanggal_pinjam` date NOT NULL,
  `tanggal_kembali` date NOT NULL,
  `keterangan` text NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
```

Atau buka file `database_peminjaman.sql` dan jalankan scriptnya.

### 2. File yang Dibuat

Berikut adalah file-file yang telah dibuat:

#### Model
- `application/models/Peminjaman_model.php`

#### Controller
- `application/controllers/Peminjaman.php`

#### Views
- `application/views/peminjaman/index.php` - Daftar peminjaman
- `application/views/peminjaman/create.php` - Form tambah peminjaman
- `application/views/peminjaman/edit.php` - Form edit peminjaman
- `application/views/peminjaman/view.php` - Detail peminjaman

## Cara Menggunakan

### 1. Akses Aplikasi

Buka browser dan navigasi ke:
```
http://localhost/CodeIgniter/index.php/peminjaman
```

### 2. Daftar URL

Berikut adalah URL yang tersedia:

| URL | Deskripsi |
|-----|-----------|
| `/peminjaman` | Tampilkan daftar semua peminjaman |
| `/peminjaman/create` | Tampilkan form tambah peminjaman |
| `/peminjaman/store` | Simpan peminjaman baru (POST) |
| `/peminjaman/view/{id}` | Tampilkan detail peminjaman |
| `/peminjaman/edit/{id}` | Tampilkan form edit peminjaman |
| `/peminjaman/update/{id}` | Update peminjaman (POST) |
| `/peminjaman/delete/{id}` | Hapus peminjaman |

### 3. Operasi CRUD

#### Create (Tambah)
1. Klik tombol "Tambah Peminjaman"
2. Isi form dengan data peminjaman
3. Klik "Simpan"

#### Read (Baca)
1. Lihat daftar peminjaman di halaman utama
2. Klik tombol "Lihat" untuk melihat detail

#### Update (Edit)
1. Di halaman daftar, klik tombol "Edit"
2. Ubah data yang diperlukan
3. Klik "Update"

#### Delete (Hapus)
1. Di halaman daftar, klik tombol "Hapus"
2. Konfirmasi penghapusan
3. Data akan terhapus

## Validasi Form

Form memiliki validasi untuk:
- `nama_alat` - Harus diisi
- `peminjam` - Harus diisi
- `tanggal_pinjam` - Harus diisi
- `tanggal_kembali` - Harus diisi
- `keterangan` - Harus diisi

## Struktur Database

Tabel `peminjaman` memiliki kolom:

| Kolom | Tipe | Keterangan |
|-------|------|-----------|
| id | int | Primary Key, Auto Increment |
| nama_alat | varchar(255) | Nama alat yang dipinjam |
| peminjam | varchar(255) | Nama orang yang meminjam |
| tanggal_pinjam | date | Tanggal peminjaman |
| tanggal_kembali | date | Tanggal pengembalian |
| keterangan | text | Catatan/keterangan peminjaman |
| created_at | datetime | Waktu data dibuat |
| updated_at | datetime | Waktu data diupdate |

## Catatan

- Aplikasi menggunakan Bootstrap 4 untuk styling
- Semua input di-sanitasi untuk keamanan
- Flash messages ditampilkan untuk feedback pengguna
- Form validation berjalan di server side

## Demo Data

Untuk menguji aplikasi, Anda bisa menambahkan data contoh:

```sql
INSERT INTO `peminjaman` (`nama_alat`, `peminjam`, `tanggal_pinjam`, `tanggal_kembali`, `keterangan`) 
VALUES 
('Bor Listrik', 'Budi Santoso', '2026-02-10', '2026-02-15', 'Bor untuk proyek rumah'),
('Gergaji Rantai', 'Ani Wijaya', '2026-02-12', '2026-02-20', 'Memotong kayu untuk kerajinan'),
('Ladder 5m', 'Joko Setiawan', '2026-02-14', '2026-02-16', 'Perbaikan atap rumah');
```

## Pengembangan Lebih Lanjut

Anda bisa menambahkan fitur:
- Pagination untuk daftar data
- Search/Filter
- Export ke Excel/PDF
- Status peminjaman (sedang dipinjam, sudah dikembalikan)
- User authentication
- dll

Selamat belajar CodeIgniter! 🚀

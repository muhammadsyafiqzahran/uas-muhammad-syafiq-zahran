# Sistem Informasi Perpustakaan (UAS) 📚

Aplikasi Sistem Informasi Perpustakaan berbasis Web ini dibangun untuk memenuhi tugas Ujian Akhir Semester (UAS). Sistem ini dirancang untuk pengguna tunggal (Single User - Admin) untuk mengelola data operasional perpustakaan secara digital.

## ✨ Fitur Utama

- **📊 Dashboard Interaktif:** Menampilkan 4 statistik utama secara *real-time* (Jumlah Buku, Anggota, Sedang Dipinjam, dan Tersedia), lengkap dengan grafik interaktif menggunakan Chart.js dan notifikasi stok buku habis.
- **📖 Manajemen Data Buku (CRUD):** Tambah, Edit, Hapus, dan Pencarian buku. Mendukung fitur upload gambar/cover buku serta manajemen stok otomatis.
- **👥 Manajemen Data Anggota (CRUD):** Kelola data anggota perpustakaan dengan fitur pencarian dan avatar inisial otomatis.
- **🔄 Transaksi Peminjaman:** Mengelola transaksi peminjaman buku oleh anggota. Stok buku akan berkurang otomatis saat dipinjam dan kembali bertambah saat dikembalikan. Terdapat indikator khusus jika pengembalian terlambat.
- **📄 Laporan & Export:** Mendukung export data transaksi peminjaman ke format **PDF** dan **Excel**.
- **📱 Desain Responsif:** Antarmuka modern yang nyaman diakses melalui perangkat Desktop maupun Mobile (HP).

## 🛠️ Tech Stack yang Digunakan

- **Framework:** Laravel 10 (PHP 8.1+)
- **Database:** MySQL
- **Frontend / UI:** Bootstrap 5 (Custom CSS, Glassmorphism, CSS Variables)
- **Icons:** Bootstrap Icons
- **Charts:** Chart.js
- **Packages:**
  - `barryvdh/laravel-dompdf` (Untuk Export PDF)
  - `maatwebsite/excel` (Untuk Export Excel)

---

## 🚀 Cara Instalasi & Penggunaan

Ikuti langkah-langkah di bawah ini untuk menjalankan aplikasi di komputer lokal Anda:

### 1. Persiapan Kebutuhan Lingkungan (Prerequisites)
Pastikan komputer Anda sudah terinstall perangkat lunak berikut:
- PHP (minimal versi 8.1)
- Composer
- MySQL Database (melalui XAMPP, Laragon, dsb.)
- Git

### 2. Clone Repositori
Clone proyek ini ke dalam folder komputer Anda (misal: `htdocs` jika XAMPP, atau `www` jika Laragon).
```bash
git clone https://github.com/username-anda/nama-repo-ini.git
cd nama-repo-ini
```

### 3. Install Dependensi (Composer)
Jalankan perintah berikut untuk mengunduh semua *library* PHP yang dibutuhkan:
```bash
composer install
```

### 4. Konfigurasi Environment (File `.env`)
Salin file pengaturan bawaan dan buat file `.env` baru:
```bash
cp .env.example .env
```
Buka file `.env` dan sesuaikan bagian koneksi database:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nama_database_anda
DB_USERNAME=root
DB_PASSWORD=
```

### 5. Generate Application Key
```bash
php artisan key:generate
```

### 6. Jalankan Migrasi & Seeder Database
*(Pastikan Anda sudah membuat database kosong di MySQL/phpMyAdmin sesuai dengan nama `DB_DATABASE` di langkah 4).*
Perintah ini akan membuat struktur tabel beserta data _dummy_ (contoh) awal:
```bash
php artisan migrate:fresh --seed
```

### 7. Buat Symlink Storage (Untuk Gambar Cover Buku)
Agar gambar cover buku dapat diakses secara publik, jalankan perintah ini:
```bash
php artisan storage:link
```

### 8. Jalankan Server Lokal
```bash
php artisan serve
```

Aplikasi sekarang sudah dapat diakses melalui web browser di URL:
**`http://127.0.0.1:8000`**

---

## 📝 Catatan Penting
Aplikasi ini di-desain khusus sebagai *Single User Admin Panel*. Begitu Anda membuka URL tersebut, Anda sudah berada di dalam sistem tanpa perlu melakukan *login*, sesuai dengan instruksi tugas (Sistem *single user*).

---
*Dibuat oleh Syafiq untuk penyelesaian UAS Pemrograman Web.*

# 📚 LibVerse – Sistem Informasi Perpustakaan Digital

Aplikasi **LibVerse** merupakan Sistem Informasi Perpustakaan Digital berbasis web yang dikembangkan sebagai **Tugas Akhir / Ujian Kompetensi Keahlian (UKK)**.

Aplikasi ini memiliki dua peran utama yaitu **Admin** dan **Member**, dengan fitur peminjaman buku, pengembalian, serta sistem denda keterlambatan yang berjalan otomatis.

---

## 🛠️ Teknologi yang Digunakan

- **Framework** : Laravel 12  
- **Bahasa Pemrograman** : PHP 8.2  
- **Database** : MySQL  
- **Frontend** : Blade Template + Custom CSS  
- **Authentication** : Laravel Auth  

---

## 👥 Role & Hak Akses

### 🔐 Admin
Admin memiliki hak akses penuh untuk:
- Mengelola data buku
- Mengelola kategori buku
- Melihat dan mengelola data peminjaman
- Mengonfirmasi pengembalian buku
- Mengelola denda keterlambatan
- Stok buku otomatis bertambah setelah pengembalian dikonfirmasi

### 👤 Member
Member dapat:
- Melihat daftar dan detail buku
- Mengajukan peminjaman buku
- Melihat status peminjaman
- Melihat denda keterlambatan
- Tidak dapat meminjam buku yang sama selama masih dipinjam

---

## ✨ Fitur Utama

- ✅ Login Admin & Member  
- ✅ Role otomatis (admin & member memiliki halaman berbeda)  
- ✅ Manajemen buku & kategori  
- ✅ Sistem peminjaman dan pengembalian buku  
- ✅ Batas waktu peminjaman  
- ✅ Status peminjaman (menunggu, dipinjam, selesai)  
- ✅ Perhitungan denda otomatis  
- ✅ Admin konfirmasi pengembalian  
- ✅ Tampilan modern & custom  

---

## ⏰ Sistem Denda

Denda akan muncul otomatis jika pengembalian melewati batas waktu.

Perhitungan denda dilakukan secara dinamis berdasarkan tanggal saat ini.

---

## 🚀 Cara Menjalankan Project

1. Clone repository:
```bash
git clone https://github.com/raflioyoy10-svg/libverse-app.git
cd libverse-app
composer install
cp .env.example .env
php artisan key:generate
Atur koneksi database di file .env
php artisan migrate
php artisan serve


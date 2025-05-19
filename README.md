# SISFO SARPRAS

Sistem Informasi Sarana dan Prasarana untuk pengelolaan data peminjaman barang sekolah berbasis Laravel + Flutter.

## Fitur Utama

- Manajemen User
- Kategori & Barang
- Peminjaman Barang (Approve/Reject)
- Pengembalian Barang (dengan foto & nama pengembali)
- Laporan Barang, Peminjaman, dan Pengembalian (Excel)
- API dengan Laravel Sanctum
- Flutter (on progress)

## Tech Stack

- Laravel 10
- MySQL
- Sanctum API
- Bootstrap
- Flutter (client mobile)

## Cara Install

1. Clone repo ini
2. Jalankan `composer install`
3. Copy `.env.example` jadi `.env` dan atur koneksi database
4. Jalankan `php artisan key:generate`
5. Jalankan migration: `php artisan migrate`
6. Jalankan `php artisan serve`

## API Endpoint Penting

- `POST /api/login`
- `GET /api/barangs`
- `POST /api/peminjaman`
- `POST /api/pengembalian`

## Developer

- Nama: Satria Nur Najmuddin
- Kelas: IX RPL 2

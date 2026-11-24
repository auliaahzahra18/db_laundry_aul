# Sistem Manajemen Laundry (LaundryKu)

Aplikasi manajemen laundry berbasis Laravel, MySQL, dan Bootstrap 5 dengan pembatasan hak akses **Admin** dan **Kasir**.

## Link Website
- **Akses Lokal:** `http://127.0.0.1:8000` *(jalankan `php artisan serve` terlebih dahulu)*

## Akun Uji Coba
- **Admin:** `admin@laundry.com` / `password`
- **Kasir:** `kasir@laundry.com` / `password`

## Cara Menjalankan di Lokal
1. Jalankan `composer install`
2. Salin `.env.example` menjadi `.env`, sesuaikan konfigurasi database MySQL, lalu jalankan `php artisan key:generate`
3. Jalankan `php artisan migrate:fresh --seed`
4. Jalankan `php artisan serve` dan buka `http://127.0.0.1:8000` di browser
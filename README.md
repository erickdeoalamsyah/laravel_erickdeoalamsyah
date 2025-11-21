Aplikasi Manajemen Rumah Sakit Soal B


Setup Local Development

Ikuti langkah berikut untuk menjalankan aplikasi ini di lokal:

Prasyarat

Pastikan Anda sudah memiliki:

PHP versi 8.1 atau yang lebih baru (Disarankan menggunakan Laragon).

Composer (Manajer paket PHP).

MySQL atau database sejenis.

1. Clone Repository

Buka terminal atau command prompt, lalu clone repositori dan masuk ke folder proyek:

git clone https://github.com/erickdeoalamsyah/laravel_erickdeoalamsyah
cd rs-app


2. Install Dependency PHP

Install semua paket dan library PHP yang dibutuhkan menggunakan Composer:

composer install


3. Buat File .env

Buat file konfigurasi environment (.env) dari contohnya:

cp .env.example .env


4. Atur Konfigurasi Database

Buka file .env, lalu sesuaikan bagian berikut dengan set MySQL lokal Anda:

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=rs_db  # Pastikan database ini sudah dibuat di MySQL
DB_USERNAME=root
DB_PASSWORD=

#atau boleh menggunakan nama db lain 

5. Generate Application Key

Jalankan perintah ini untuk membuat key aplikasi Laravel yang unik dan aman:

php artisan key:generate


6. Buat Database MySQL

Buat database baru di MySQL atau phpMyAdmin Anda. Nama database harus sama dengan yang Anda atur di DB_DATABASE (rs_db).

CREATE DATABASE rs_db;


7. Jalankan Migration dan Seeder

Jalankan perintah ini untuk membuat semua tabel dan mengisi data awal yang diperlukan:

php artisan migrate --seed


8. Jalankan Server Lokal

Jalankan server pengembangan Laravel:

php artisan serve


Aplikasi dapat diakses melalui browser di :
http://127.0.0.1:8000

9. Login ke Aplikasi

Anda dapat login menggunakan akun default yang dibuat oleh seeder:

Deskripsi

Nilai

URL Login

http://127.00.1:8000/login

Username
Password


Selamat Mencoba!
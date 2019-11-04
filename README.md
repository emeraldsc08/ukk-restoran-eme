# ukk-restoran
Latihan UKK Kode 1 (Restoran)

# Cara Menggunakan
1. Clone projectnya ke folder htdocs (xampp).
2. Buka Command Prompt / terminal dan change directory ke project
3. Ketik "composer install" atau "composer update" di cmd / terminal (tanpa tanda ")
4. Tunggu sampai selesai
5. Buat file baru bernama .env
6. Copy isi file .env.example ke .env
7. Sesuaikan DB_CONNECTION, DB_HOST, DB_PORT, DB_DATABASE, DB_USERNAME dan DB_PASSWORD dengan database kalian
8. Ketik "php artisan key:generate" di cmd / terminal (tanpa tanda ")
9. Kalau sudah, ketik "php artisan migrate:fresh --seed" di cmd / terminal (tanpa tanda ")
10. Tunggu sampai selesai
11. Selamat belajar!

# Users
1. username: admin, pass: admin
2. username: waiter, pass: waiter
3. username: kasir, pass: kasir
4. username: owner, pass: mataram03

# Errors
1. CSS tidak nyambung. how to fix : jangan pakai "php artisan serve", tapi lewat url untuk pengaksesan, misalkan localhost/projects/ukk-restoran/home
2. Connection refused ketika migration. how to fix : jalankan "php artisan config:clear" sebelum melakukan langkah ke-9

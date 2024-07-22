
# Proyek CodeIgniter 4

Proyek ini adalah aplikasi web berbasis CodeIgniter 4. README ini memberikan panduan untuk memulai proyek ini.

## Prasyarat

Sebelum Anda memulai, pastikan Anda telah menginstal perangkat lunak berikut:

- PHP 8.2.12
- Composer
- Database Server (MySQL, PostgreSQL, dll)

## Instalasi

Ikuti langkah-langkah berikut untuk menginstal proyek ini:

1. Clone repositori ini:

    ```bash
    git clone https://github.com/arifhida1647/tokokelontongleon.git
    ```
    
2. Instal dependensi menggunakan Composer:

    ```bash
    composer install
    ```

3. Atur konfigurasi basis data di file `.env`:

    ```env
    database.default.hostname = localhost
    database.default.database = ci4
    database.default.username = root
    database.default.password = 
    database.default.DBDriver = MySQLi
    ```

6. Impor file `posci4.sql` ke basis data menggunakan phpMyAdmin:

    - Buka phpMyAdmin di browser Anda.
    - Pilih database `posci4`. Jika basis data belum ada, buat database baru dengan nama `posci4`.
    - Klik pada tab **Import**.
    - Klik tombol **Choose File** dan pilih file `posci4.sql` dari komputer Anda.
    - Klik tombol **Go** untuk memulai proses impor.

## Menjalankan Proyek

Setelah semua langkah instalasi selesai, jalankan server pengembangan CodeIgniter:

```bash
php spark serve
```

Proyek akan berjalan di `http://localhost:8080`.

## Struktur Direktori

Berikut adalah struktur direktori utama dalam proyek CodeIgniter 4:

- **app/**: Direktori utama untuk aplikasi Anda, berisi controller, model, view, dan lainnya.
- **public/**: Direktori ini berisi file yang bisa diakses oleh publik seperti index.php.
- **writable/**: Direktori ini berisi file yang bisa ditulis oleh server seperti cache, logs, dan uploads.
- **tests/**: Direktori ini berisi tes untuk aplikasi Anda.
- **vendor/**: Direktori ini berisi semua paket yang diinstal melalui Composer.

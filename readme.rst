PANDUAN INSTALASI APLIKASI E-TEST (CodeIgniter & PHP 7.3)

Panduan ini berisi langkah-langkah untuk mendapatkan, menginstal, dan menjalankan Aplikasi Ujian Online E-Test yang dibangun menggunakan framework CodeIgniter (PHP) di lingkungan server lokal XAMPP.

A. Persyaratan Sistem
Pastikan lingkungan Anda telah terinstal dan memenuhi persyaratan minimum berikut:
- XAMPP: Telah terinstal dan berjalan.
- PHP Version:7.3.33 
- Database: MySQL

B. Mengunduh File ZIP
1.  Unduh file ZIP dari halaman GitHub ini.
2.  Ekstrak file ZIP tersebut ke dalam folder `htdocs` XAMPP Anda.
3.  Ganti nama folder hasil ekstrak menjadi nama yang lebih ringkas (contoh: `e-test`).

C. Konfigurasi Database
1.  Akses phpMyAdmin: Buka browser Anda dan akses `http://localhost/phpmyadmin/`.
2.  Buat Database Baru:
    - Klik `New` atau `Baru` di panel kiri.
    - Buat database dengan nama `db_etest` (atau nama lain yang Anda tentukan).
3.  Import Data Awal:
    - Pilih database `db_etest` yang baru dibuat.
    - Pilih tab `Import` atau `Impor`.
    - Cari dan unggah file dump database, biasanya bernama `database.sql` yang terdapat di dalam folder aplikasi Anda.

D. Menjalankan Aplikasi
1.  Pastikan modul Apache dan MySQL pada XAMPP Control Panel telah berstatus Running.
2.  Buka browser Anda dan akses URL berikut:

    ```
    http://localhost/e-test/
    ```
(Ganti `e-test-ci` jika Anda menggunakan nama folder yang berbeda).

E. Login Administrator Awal
Setelah aplikasi terbuka, gunakan akun default berikut untuk memulai konfigurasi sistem sebagai Admin.
1. Halaman Login: Akses `http://localhost/e-test/auth/login` 
2. Akun Default Administrator:
      * Username:** `admin`
      * Password:** `admin` 

PERINGATAN KEAMANAN: Segera ganti password Administrator default setelah login pertama kali.

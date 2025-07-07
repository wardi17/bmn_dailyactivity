
# BMN Daily Activity

Aplikasi ini digunakan untuk mencatat aktivitas harian terkait Barang Milik Negara (BMN). Dibangun menggunakan PHP, HTML, CSS, Bootstrap, jQuery, dan database SQL Server.

---

## 📥 Cara Install dan Menjalankan Aplikasi

### 1. Clone Repository
Clone repository ke folder `htdocs` (jika menggunakan XAMPP) atau ke direktori server lokal kamu:

```bash
git clone https://github.com/wardi17/bmn_dailyactivity.git
2. Setup Database
a. Buat Database Baru
Buka SQL Server Management Studio (SSMS), lalu jalankan:

sql
Copy
Edit
CREATE DATABASE bmn;
b. Import Struktur Tabel dan Fungsi
Masuk ke folder:

bash
Copy
Edit
/table,sp&fun_SQL
Import semua file .sql di dalam folder tersebut ke database bmn. Gunakan SSMS atau tools lain yang mendukung SQL Server.

3. Konfigurasi Koneksi Database
Masuk ke folder berikut:

bash
Copy
Edit
/core
Edit file koneksi database (db.php, connection.php, atau sesuai nama file koneksimu). Contoh konfigurasi:

php
Copy
Edit
<?php
$serverName = "localhost"; // atau IP server SQL
$connectionOptions = [
    "Database" => "bmn",
    "Uid" => "sa",           // sesuaikan dengan user SQL kamu
    "PWD" => "your_password",
    "CharacterSet" => "UTF-8"
];
$conn = sqlsrv_connect($serverName, $connectionOptions);

if (!$conn) {
    die(print_r(sqlsrv_errors(), true));
}
?>
Pastikan kamu telah mengaktifkan ekstensi php_sqlsrv atau php_pdo_sqlsrv pada file php.ini.

📁 Struktur Folder
Folder / File	Keterangan
/core	File koneksi dan konfigurasi database
/table,sp&fun_SQL	File SQL (table, stored procedure, dll)
/assets	File CSS, JS, Bootstrap, gambar, dll
/pages	Halaman utama aplikasi (tampilan UI)
/index.php	Halaman utama / routing awal aplikasi

📌 Catatan Penting
Aplikasi hanya mendukung SQL Server

Gunakan SQL Server 2012 atau versi yang lebih baru

Ubah konfigurasi koneksi sesuai lingkungan development kamu

Pastikan ekstensi SQLSRV telah aktif di PHP




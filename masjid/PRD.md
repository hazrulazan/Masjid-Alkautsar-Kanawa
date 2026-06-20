# PRD Website Profil Masjid

## 1. Nama Produk

**Website Profil Masjid**

## 2. Deskripsi

Website ini dibuat untuk menampilkan informasi masjid secara online, seperti profil, manajemen masjid, artikel, organisasi, dan daftar kontak. Website juga memiliki halaman login untuk admin agar dapat mengelola data secara dinamis.

## 3. Teknologi

* PHP Native
* Tailwind CSS
* MySQL
* PDO
* HTML, CSS, JavaScript
* XAMPP

## 4. Pengguna

### Admin

Admin dapat login dan mengelola semua konten website.

### Pengunjung

Pengunjung dapat melihat informasi masjid tanpa login.

## 5. Fitur Utama

### 5.1 Login

Fitur untuk admin masuk ke dashboard. Login menggunakan username/email dan password. Password disimpan dengan sistem hash, dan koneksi database menggunakan PDO agar lebih aman.

### 5.2 Home

Halaman utama yang menampilkan ringkasan informasi masjid, artikel terbaru, statistik singkat, dan navigasi ke halaman lainnya.

### 5.3 Profile

Menampilkan informasi profil masjid, seperti sejarah, visi, misi, dan deskripsi singkat masjid.

### 5.4 Manajemen Masjid

Menampilkan informasi tentang pengelolaan masjid, program masjid, pelayanan jamaah, dan kegiatan utama.

### 5.5 Artikel

Menampilkan daftar artikel atau berita masjid. Admin dapat menambah, mengedit, dan menghapus artikel.

### 5.6 Organisasi

Menampilkan struktur organisasi atau pengurus masjid, seperti ketua, sekretaris, bendahara, dan bidang lainnya.

### 5.7 Daftar Kontak

Menampilkan kontak penting masjid, seperti nomor telepon, WhatsApp, email, alamat, media sosial, dan lokasi Google Maps.

## 6. Halaman Website

### Halaman Publik

* Home
* Profile
* Manajemen Masjid
* Artikel
* Detail Artikel
* Organisasi
* Daftar Kontak

### Halaman Admin

* Login
* Dashboard
* Kelola Profile
* Kelola Manajemen Masjid
* Kelola Artikel
* Kelola Organisasi
* Kelola Kontak
* Logout

## 7. Database Utama

Tabel yang dibutuhkan:

* `users`
* `profiles`
* `mosque_managements`
* `articles`
* `organizations`
* `contacts`

## 8. Desain UI/UX

Website menggunakan konsep desain **modern minimalis Islami** yang terinspirasi dari landing page modern. Tampilan dibuat bersih, profesional, responsif, dan mudah digunakan.

### 8.1 Konsep Tampilan

Struktur halaman utama terdiri dari:

* Navbar
* Hero Section
* Statistik Masjid
* Profile Masjid
* Manajemen Masjid
* Artikel Terbaru
* Organisasi
* Daftar Kontak
* Footer

### 8.2 Color Palette

#### Warna Utama

* Background Utama: `#FFFFFF`
* Background Section: `#F5F5F5`
* Teks Utama: `#111827`
* Teks Sekunder: `#6B7280`

#### Warna Identitas Masjid

* Hijau Tua: `#064E3B`
* Hijau Utama: `#047857`
* Hijau Muda: `#10B981`

#### Warna Aksen Islami

* Emas: `#F59E0B`
* Kuning Lembut: `#FBBF24`

#### Warna Aksen Modern

* Ungu: `#7C3AED`
* Ungu Muda: `#A855F7`

#### Warna Card Statistik

* Card Hijau: `#047857`
* Card Hitam: `#18181B`
* Card Emas: `#F59E0B`
* Card Ungu: `#7C3AED`

#### Warna Border dan Shadow

* Border: `#E5E7EB`
* Shadow Lembut: `rgba(0, 0, 0, 0.08)`

#### Warna Button

* Button Primary: `#047857`
* Button Primary Hover: `#065F46`
* Button Secondary: `#F59E0B`
* Button Secondary Hover: `#D97706`
* Button Dark: `#111827`

### 8.3 Style Desain

* Clean layout
* Card rounded
* Shadow lembut
* Banyak ruang kosong
* Button rounded
* Hero section besar
* Font modern seperti Poppins, Inter, atau Plus Jakarta Sans
* Responsive untuk desktop dan mobile

## 9. Konsep PDO

Website menggunakan PDO untuk koneksi PHP ke MySQL. PDO digunakan agar query database lebih aman, rapi, dan mendukung prepared statement untuk mengurangi risiko SQL Injection.

Contoh koneksi database:

```php
<?php
$host = "localhost";
$dbname = "db_masjid";
$username = "root";
$password = "";

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Koneksi gagal: " . $e->getMessage());
}
```

## 10. Kebutuhan Keamanan

* Password menggunakan `password_hash()`.
* Login menggunakan `password_verify()`.
* Query menggunakan prepared statement PDO.
* Halaman admin hanya bisa diakses setelah login.
* Validasi input pada form.
* Upload gambar dibatasi hanya format tertentu.

## 11. Kesimpulan

Website Profil Masjid ini dirancang untuk memudahkan masyarakat mendapatkan informasi tentang masjid dan memudahkan admin dalam mengelola konten. Dengan PHP, Tailwind CSS, MySQL, PDO, dan desain modern minimalis Islami, website menjadi ringan, aman, menarik, dan mudah dikembangkan.

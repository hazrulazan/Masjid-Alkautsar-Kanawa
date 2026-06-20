<?php
// config/database.php

$host = "localhost";
$dbname = "db_masjid";
$username = "root";
$password = "";

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
    // Set error mode
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // Set default fetch mode to object
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
} catch (PDOException $e) {
    die("Koneksi Database Gagal: " . $e->getMessage());
}

if (!function_exists('resolve_image_url')) {
    function resolve_image_url($path, $in_admin = false) {
        if (empty($path)) {
            return '';
        }
        if (strpos($path, 'http://') === 0 || strpos($path, 'https://') === 0) {
            return $path;
        }
        
        // Remove /masjid/ or masjid/ prefix if present
        if (strpos($path, '/masjid/') === 0) {
            $path = substr($path, 8);
        } elseif (strpos($path, 'masjid/') === 0) {
            $path = substr($path, 7);
        }
        
        $path = ltrim($path, '/');
        
        if ($in_admin) {
            return '../' . $path;
        }
        return $path;
    }
}
?>

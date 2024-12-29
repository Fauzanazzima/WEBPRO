<?php
// Koneksi ke database dengan PDO
$host = "localhost";
$user = "root";
$password = "";
$dbname = "financeManager";

// Membuat koneksi ke database menggunakan PDO
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);  // Menampilkan error jika ada masalah
} catch (PDOException $e) {
    die("Koneksi gagal: " . $e->getMessage());
}
?>

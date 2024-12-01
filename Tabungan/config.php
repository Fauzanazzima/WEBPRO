<?php
$host = "localhost";
$user = "root";
$password = "";
$dbname = "keuangan";

// Membuat koneksi ke database
$conn = mysqli_connect($host, $user, $password, $dbname);

// Mengecek koneksi
if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>

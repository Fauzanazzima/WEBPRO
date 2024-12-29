<?php
session_start();  // Pastikan session dimulai di awal file
include "config.php";  // Menghubungkan dengan database
include "Templet/mainheader.php";  // Menghubungkan dengan template header

// Memeriksa apakah pengguna sudah login
if (!isset($_SESSION['user_id'])) {
    // Jika pengguna tidak login, redirect ke halaman login dengan pesan
    header("Location: login.php?msg=" . urlencode("Anda harus login terlebih dahulu."));
    exit;
}
?>

<h1>Selamat Datang, <?= htmlspecialchars($_SESSION['username']); ?>!</h1>
<p>Hanya pengguna yang login yang dapat mengakses halaman ini.</p>

<!-- Menampilkan pesan jika ada dari URL -->
<?php
if (isset($_GET['msg'])) {
    echo '<div class="alert alert-info">' . htmlspecialchars($_GET['msg']) . '</div>';
}
?>

<?php
include "Templet/mainfooter.php";  // Menghubungkan dengan template footer
?>

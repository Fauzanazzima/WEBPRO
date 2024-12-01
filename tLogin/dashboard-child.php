<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'children') {
    header("Location: login.php");  // Jika bukan anak, arahkan ke halaman login
    exit;
}

include "template/mainheader.php";
?>

<div class="container mt-5">
    <h4>Dashboard Anak</h4>
    <p>Selamat datang, <?php echo $_SESSION['username']; ?>!</p>
</div>

<?php include "template/mainfooter.php"; ?>

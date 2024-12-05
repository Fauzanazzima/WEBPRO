<?php
session_start();
include "template/mainheader.php";
?>

<div class="container mt-5">
    <h4>Dashboard Orang Tua</h4>
    <p>Selamat datang, <?= $_SESSION['username'] ?>!</p>
</div>

<?php include "template/mainfooter.php"; ?>

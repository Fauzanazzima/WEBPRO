<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php?errMsg=" . urlencode("Anda harus login terlebih dahulu."));
    exit;
}
?>

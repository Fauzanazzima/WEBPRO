<?php
session_start();  // Memulai session

// Menghancurkan semua session
session_unset();  
session_destroy();  

// Mengarahkan pengguna ke halaman login
header("Location: login.php?msg=" . urlencode("Anda telah logout."));
exit;
?>

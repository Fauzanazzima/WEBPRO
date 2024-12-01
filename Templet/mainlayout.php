<?php 
// Menyertakan header
include "mainheader.php"; 
?>

<!-- Konten Dinamis Halaman -->
<div class="container mt-3">
    <?php 
    // Bagian konten halaman utama akan ditampilkan di sini
    if (isset($content)) {
        echo $content;
    }
    ?>
</div>

<?php 
// Menyertakan footer
include "mainfooter.php"; 
?>

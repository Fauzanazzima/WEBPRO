<?php
include "../config.php";
include "autentikasi.php";

if(isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql= "DELETE FROM savings WHERE id='$id'";
    $result = mysqli_query($conn, $sql);

    if($result){
        $succesMsg = "Tabungan berhasil dihapus";
        header("location: indexsaving.php?succesMsg=". urlencode($succesMsg));
        exit;
    } else {
        $errMsg = "Gagal menghapus tabungan: ". mysqli_error($conn);
        header("Location: indexsaving.php?errMsg=".urlencode($errMsg));
        exit;
    }
}else {
    header("location: index.php?errMsg=" . urlencode("Id tabungan tidak valid"));
    exit;
}

mysqli_close($conn);
?>

<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $jenis_transaksi = $_POST['jenis_transaksi'];
    $keterangan = $_POST['keterangan'];
    $jumlah = $_POST['jumlah'];
    $tanggal = $_POST['tanggal'];

    $sql = "INSERT INTO transaksi (jenis_transaksi, keterangan, jumlah, tanggal) 
            VALUES ('$jenis_transaksi', '$keterangan', $jumlah, '$tanggal')";

    if ($conn->query($sql) === TRUE) {
        header("Location: index.php");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>
<?php
include 'koneksi.php';

if (isset($_POST['submit'])) {
    $nama = $_POST['nama'];
    $jumlah = $_POST['jumlah'];
    $tanggal = $_POST['tanggal'];

    $query = "INSERT INTO tabungan (nama, jumlah, tanggal) VALUES ('$nama', '$jumlah', '$tanggal')";
    if (mysqli_query($conn, $query)) {
        header("Location: index.php");
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Tambah Data</title>
</head>
<body>
    <h1>Tambah Data Tabungan</h1>
    <form method="post">
        <label>Nama:</label><br>
        <input type="text" name="nama" required><br>
        <label>Jumlah:</label><br>
        <input type="number" step="0.01" name="jumlah" required><br>
        <label>Tanggal:</label><br>
        <input type="date" name="tanggal" required><br><br>
        <button type="submit" name="submit">Simpan</button>
    </form>
</body>
</html>
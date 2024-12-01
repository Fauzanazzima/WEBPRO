<?php
include 'koneksi.php';

$id = $_GET['id'];
$result = mysqli_query($conn, "SELECT * FROM tabungan WHERE id=$id");
$data = mysqli_fetch_assoc($result);

if (isset($_POST['submit'])) {
    $nama = $_POST['nama'];
    $jumlah = $_POST['jumlah'];
    $tanggal = $_POST['tanggal'];

    $query = "UPDATE tabungan SET nama='$nama', jumlah='$jumlah', tanggal='$tanggal' WHERE id=$id";
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
    <title>Edit Data</title>
</head>
<body>
    <h1>Edit Data Tabungan</h1>
    <form method="post">
        <label>Nama:</label><br>
        <input type="text" name="nama" value="<?= $data['nama']; ?>" required><br>
        <label>Jumlah:</label><br>
        <input type="number" step="0.01" name="jumlah" value="<?= $data['jumlah']; ?>" required><br>
        <label>Tanggal:</label><br>
        <input type="date" name="tanggal" value="<?= $data['tanggal']; ?>" required><br><br>
        <button type="submit" name="submit">Simpan</button>
    </form>
</body>
</html>
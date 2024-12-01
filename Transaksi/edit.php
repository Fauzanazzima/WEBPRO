<?php
include 'db.php';

$id = $_GET['id'];
$result = $conn->query("SELECT * FROM transaksi WHERE id = $id");
$data = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Transaksi</title>
</head>
<body>
    <h1>Edit Transaksi</h1>
    <form action="update.php" method="POST">
        <input type="hidden" name="id" value="<?= $data['id'] ?>">
        <label>Jenis Transaksi:</label>
        <select name="jenis_transaksi" required>
            <option value="pemasukan" <?= $data['jenis_transaksi'] == 'pemasukan' ? 'selected' : '' ?>>Pemasukan</option>
            <option value="pengeluaran" <?= $data['jenis_transaksi'] == 'pengeluaran' ? 'selected' : '' ?>>pengeluaran</option>
        </select><br><br>
        <label>Keterangan:</label>
        <input type="text" name="keterangan" value="<?= $data['keterangan'] ?>"><br><br>
        <label>Jumlah:</label>
        <input type="number" step="0.01" name="jumlah" value="<?= $data['jumlah'] ?>" required><br><br>
        <label>Tanggal:</label>
        <input type="date" name="tanggal" value="<?= $data['tanggal'] ?>" required><br><br>
        <button type="submit">Update</button>
    </form>
</body>
</html>

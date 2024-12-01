<?php include 'db.php'; ?>

<!DOCTYPE html>
<html>
<head>
    <title>Finance Manager</title>
</head>
<body>
    <h1>Tambah Transaksi</h1>
    <form action="pengeluaran.php" method="POST">
        <label>Jenis Transaksi:</label>
        <select name="jenis_transaksi" required>
            <option value="pemasukan">Pemasukan</option>
            <option value="Pengeluaran">Pengeluaran</option>
        </select>
        </select><br><br>
        <label>Keterangan:</label>
        <input type="text" name="keterangan" require><br><br>
        <label>Jumlah:</label>
        <input type="number" step="0.01" name="jumlah" required><br><br>
        <label>Tanggal:</label>
        <input type="date" name="tanggal" required><br><br>
        <button type="submit">Simpan</button>
    </form>
</body>
</html>
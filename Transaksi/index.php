<?php
include 'db.php';
include "config.php";
include "../Templet/mainheader.php";
$result = $conn->query("SELECT * FROM transaksi ORDER BY tanggal DESC");
?>

<!DOCTYPE html>
<html>
<head>
    <title>List Transaksi</title>
</head>
<body>
    <h1>Daftar Transaksi</h1>
    <a href="create.php">Tambah Transaksi</a>
    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Jenis</th>
                <th>Keterangan</th>
                <th>Jumlah</th>
                <th>Tanggal</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= $row['id'] ?></td>
                    <td><?= $row['jenis_transaksi'] ?></td>
                    <td><?= $row['keterangan'] ?></td>
                    <td><?= $row['jumlah'] ?></td>
                    <td><?= $row['tanggal'] ?></td>
                    <td>
                        <a href="edit.php?id=<?= $row['id'] ?>">Edit</a>
                        <a href="delete.php?id=<?= $row['id'] ?>" onclick="return confirm('Yakin ingin menghapus?')">Hapus</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</body>
</html>
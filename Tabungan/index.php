<?php
include 'koneksi.php';
include "config.php";

// Ambil semua data tabungan
$result = mysqli_query($conn, "SELECT * FROM tabungan");
include "../Templet/mainheader.php";
?>

<!DOCTYPE html>
<html>
<head>
    <title>CRUD Tabungan</title>
</head>
<body>
    <h1>Daftar Tabungan</h1>
    <a href="tambah.php">Tambah Data</a>
    <table border="1" cellpadding="10" cellspacing="0">
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Jumlah</th>
            <th>Tanggal</th>
            <th>Aksi</th>
        </tr>
        <?php $no = 1; while ($row = mysqli_fetch_assoc($result)): ?>
        <tr>
            <td><?= $no++; ?></td>
            <td><?= $row['nama']; ?></td>
            <td><?= $row['jumlah']; ?></td>
            <td><?= $row['tanggal']; ?></td>
            <td>
                <a href="edit.php?id=<?= $row['id']; ?>">Edit</a>
                <a href="hapus.php?id=<?= $row['id']; ?>" onclick="return confirm('Yakin ingin menghapus?')">Hapus</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>

<?php
include "../config.php"; // Koneksi ke database

// Cek apakah parameter id dikirim melalui URL
if (!isset($_GET['id'])) {
    header("Location: indexsavings.php?errMsg=" . urlencode("ID tabungan tidak ditemukan."));
    exit;
}

$id = $_GET['id'];

// Ambil data tabungan berdasarkan ID
$sql = "SELECT * FROM savings WHERE id = '$id'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) == 0) {
    header("Location: indexsaving.php?errMsg=" . urlencode("Tabungan tidak ditemukan."));
    exit;
}

$data = mysqli_fetch_assoc($result);

// Proses update data jika form dikirim
if (isset($_POST['btnUpdate'])) {
    $name = $_POST["name"];
    $start_date = $_POST["start_date"];
    $end_date = $_POST["end_date"];
    $amount_saved = $_POST["amount_saved"];
    $target_amount = $_POST["target_amount"];

    $query = "UPDATE savings SET name = '$name', start_date = '$start_date',  
            end_date = '$end_date', amount_saved = '$amount_saved', 
            target_amount = '$target_amount' 
            WHERE id = '$id'";

    if (mysqli_query($conn, $query)) {
        $successMsg = "Tabungan berhasil diperbarui.";
        header("Location: indexsaving.php?successMsg=" . urlencode($successMsg));
        exit;
    } else {
        $errMsg = "Gagal memperbarui tabungan. Error: " . mysqli_error($conn);
    }
}

mysqli_close($conn);
?>

<?php include "../templete/mainheader.php"; ?>

<div class="container mt-5">
    <h3>Edit Tabungan</h3>
    <?php if (isset($errMsg)) : ?>
        <div class="alert alert-danger" role="alert">
            <?= $errMsg; ?>
        </div>
    <?php endif; ?>
    <form action="" method="POST">
        <div class="mb-3">
            <label for="name" class="form-label">Nama Tabungan</label>
            <input type="text" class="form-control" id="name" name="name" value="<?= $data['name']; ?>" required>
        </div>
        <div class="mb-3">
            <label for="start_date" class="form-label">Tanggal Mulai</label>
            <input type="date" class="form-control" id="start_date" name="start_date" value="<?= $data['start_date']; ?>" required>
        </div>
        <div class="mb-3">
            <label for="end_date" class="form-label">Tanggal Selesai</label>
            <input type="date" class="form-control" id="end_date" name="end_date" value="<?= $data['end_date']; ?>" required>
        </div>
        <div class="mb-3">
            <label for="amount_saved" class="form-label">Jumlah Tabungan</label>
            <input type="number" class="form-control" id="amount_saved" name="amount_saved" value="<?= $data['amount_saved']; ?>" required>
        </div>
        <div class="mb-3">
            <label for="target_amount" class="form-label">Target Tabungan</label>
            <input type="number" class="form-control" id="target_amount" name="target_amount" value="<?= $data['target_amount']; ?>" required>
        </div>
        <div class="mt-4">
            <button type="submit" class="btn btn-primary" name="btnUpdate">Update</button>
            <a href="index.php" class="btn btn-secondary">Batal</a>
        </div>
    </form>
</div>

<?php include "../templete/mainfooter.php"; ?>

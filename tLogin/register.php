<?php
session_start();
include "config.php";  // Koneksi ke database
include "template/mainheader.php";  // Template header

// Menangani registrasi
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ambil data form
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);  // Enkripsi password
    $role = $_POST['role'];
    $parent_id = null;

    // Jika role adalah 'child', maka masukkan parent_id
    if ($role === 'child') {
        $parent_id = $_POST['parent_id'];

        // Validasi apakah parent_id ada dan orang tua sudah terdaftar
        $stmt = $pdo->prepare("SELECT id FROM users WHERE id = ? AND role = 'parent'");
        $stmt->execute([$parent_id]);

        if ($stmt->rowCount() == 0) {
            $error = "ID Orang Tua tidak valid atau belum terdaftar. Pastikan orang tua sudah terdaftar terlebih dahulu.";
        }
    }

    // Validasi jika username atau email sudah terdaftar
    if (!isset($error)) {
        $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ? OR email = ?");
        $stmt->execute([$username, $email]);

        if ($stmt->rowCount() > 0) {
            $error = "Username atau email sudah terdaftar!";
        } else {
            // Jika tidak ada error, masukkan data ke database
            $stmt = $pdo->prepare("INSERT INTO users (username, email, password, role, parent_id) VALUES (?, ?, ?, ?, ?)");
            if ($stmt->execute([$username, $email, $password, $role, $parent_id])) {
                $lastInsertId = $pdo->lastInsertId();  // Ambil ID terakhir yang diinsert (ID orang tua atau anak)

                if ($role === 'parent') {
                    // Jika registrasi orang tua berhasil, berikan ID mereka
                    $_SESSION['parent_id_message'] = "Registrasi berhasil! ID Orang Tua Anda adalah: " . $lastInsertId;
                } else {
                    // Jika registrasi anak berhasil, beri tahu bahwa mereka sudah terdaftar
                    $_SESSION['success_message'] = "Registrasi berhasil! Anda telah terhubung dengan orang tua ID: $parent_id.";
                }

                // Redirect ke halaman login setelah berhasil registrasi
                header("Location: register.php");
                exit();
            } else {
                $error = "Terjadi kesalahan saat registrasi.";
            }
        }
    }
}
?>

<!-- Form Registrasi -->
<div style="margin-left: 50px;">
    <form method="post" action="register.php">
        <div class="mb-1 row">
            <div class="col-2">
                <label for="username" class="col-form-label">Username</label>
            </div>
            <div class="col-auto">
                <input type="text" class="form-control" id="username" name="username" required>
            </div>
        </div>

        <div class="mb-1 row">
            <div class="col-2">
                <label for="email" class="col-form-label">Email</label>
            </div>
            <div class="col-auto">
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
        </div>

        <div class="mb-1 row">
            <div class="col-2">
                <label for="password" class="col-form-label">Password</label>
            </div>
            <div class="col-auto">
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
        </div>

        <!-- Pilih Role (Parent / Child) -->
        <div class="mb-1 row">
            <div class="col-2">
                <label for="role" class="col-form-label">Role</label>
            </div>
            <div class="col-auto">
                <select class="form-control" id="role" name="role" required>
                    <option value="parent">Orang Tua</option>
                    <option value="child">Anak</option>
                </select>
            </div>
        </div>

        <!-- Input Parent ID hanya untuk Anak -->
        <div class="mb-1 row" id="parentIdRow" style="display: none;">
            <div class="col-2">
                <label for="parent_id" class="col-form-label">ID Orang Tua</label>
            </div>
            <div class="col-auto">
                <!-- Dropdown untuk memilih ID Orang Tua yang terdaftar -->
                <select class="form-control" id="parent_id" name="parent_id">
                    <option value="">Pilih ID Orang Tua</option>
                    <?php
                    // Ambil daftar orang tua yang terdaftar
                    $stmt = $pdo->prepare("SELECT id, username FROM users WHERE role = 'parent'");
                    $stmt->execute();
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        echo "<option value='" . $row['id'] . "'>" . $row['username'] . " (ID: " . $row['id'] . ")</option>";
                    }
                    ?>
                </select>
            </div>
        </div>

        <div class="mb-1 row">
            <div class="col-auto">
                <input type="submit" class="btn btn-success" id="btnSubmit" name="btnRegister" value="Daftar">
            </div>
        </div>
    </form>
</div>

<?php
// Menampilkan pesan jika ada
if (isset($_SESSION['success_message'])) {
    echo "<div class='alert alert-success mt-3'>" . $_SESSION['success_message'] . "</div>";
    unset($_SESSION['success_message']); // Hapus pesan setelah ditampilkan
}
if (isset($_SESSION['parent_id_message'])) {
    echo "<div class='alert alert-info mt-3'>" . $_SESSION['parent_id_message'] . "</div>";
    unset($_SESSION['parent_id_message']); // Hapus pesan setelah ditampilkan
}
?>

<?php if (isset($error)) { echo "<div class='alert alert-warning mt-3'>{$error}</div>"; } ?>

<div style="margin-left: 50px;"> 
    <p>Sudah memiliki akun? <a href="login.php">Login di sini</a></p>
</div>

<?php include "template/mainfooter.php"; ?>

<!-- JavaScript untuk menampilkan Parent ID hanya untuk role "child" -->
<script>
    document.getElementById('role').addEventListener('change', function() {
        var parentIdRow = document.getElementById('parentIdRow');
        if (this.value === 'child') {
            parentIdRow.style.display = 'block';  // Tampilkan input Parent ID jika Child dipilih
        } else {
            parentIdRow.style.display = 'none';  // Sembunyikan input Parent ID jika Parent dipilih
        }
    });
</script>

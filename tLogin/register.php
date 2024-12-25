<?php
session_start();  // Mulai sesi untuk menangani session jika diperlukan

include "config.php";
include "template/mainheader.php";  // Pastikan template header ada dan terhubung dengan benar

// Cek apakah tombol "btnRegister" sudah ditekan
if (isset($_POST['btnRegister'])) {
    // Mengambil data dari form dan melakukan validasi
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = $_POST['password'];
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $role = $_POST['role'];
    $parent_id = ($role == 'anak') ? mysqli_real_escape_string($conn, $_POST['parent_id']) : null;

    // Cek apakah username atau email sudah terdaftar
    $sql = "SELECT * FROM users WHERE username = '$username' OR email = '$email'";
    $result = mysqli_query($conn, $sql);

    // Jika query gagal
    if (!$result) {
        die("Query gagal: " . mysqli_error($conn));
    }

    // Jika username atau email sudah terdaftar
    if (mysqli_num_rows($result) > 0) {
        $errMsg = "Username atau Email sudah terdaftar. Silakan pilih username/email lain.";
    } else {
        // Validasi ID Orang Tua jika role = 'anak'
        if ($role == 'anak') {
            $parent_check = "SELECT * FROM users WHERE id = '$parent_id' AND role = 'parents'";
            $parent_result = mysqli_query($conn, $parent_check);

            if (mysqli_num_rows($parent_result) == 0) {
                $errMsg = "ID Orang Tua tidak valid. Pastikan Anda memasukkan ID orang tua yang benar.";
            }
        }

        // Hash password sebelum disimpan
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Masukkan data ke dalam database
        if (!isset($errMsg)) {
            $sql_insert = "INSERT INTO users (username, password, email, role, parent_id) VALUES ('$username', '$hashed_password', '$email', '$role', '$parent_id')";
            if (mysqli_query($conn, $sql_insert)) {
                // Redirect ke halaman login setelah registrasi berhasil
                header("Location: login.php?msg=" . urlencode("Registrasi berhasil. Silakan login."));
                exit;
            } else {
                $errMsg = "Terjadi kesalahan saat registrasi.";
            }
        }
    }
}
?>

<!-- Form Registrasi -->
<div style="margin-left: 50px;">
    <form method="post" action="register.php"> <!-- Pastikan form mengirim data ke register.php -->
        <div class="mb-1 row">
            <div class="col-2">
                <label for="username" class="col-form-label">Username</label>
            </div>
            <div class="col-auto">
                <input type="text" class="form-control" id="username" name="username" size="20" placeholder="Username" required>
            </div>
        </div>

        <div class="mb-1 row">
            <div class="col-2">
                <label for="email" class="col-form-label">Email</label>
            </div>
            <div class="col-auto">
                <input type="email" class="form-control" id="email" name="email" size="20" placeholder="Email" required>
            </div>
        </div>

        <div class="mb-1 row">
            <div class="col-2">
                <label for="password" class="col-form-label">Password</label>
            </div>
            <div class="col-auto">
                <input type="password" class="form-control" id="password" name="password" size="20" placeholder="Password" required>
            </div>
        </div>

        <!-- Pilihan Role: Orang Tua atau Anak -->
        <div class="mb-1 row">
            <div class="col-2">
                <label for="role" class="col-form-label">Role</label>
            </div>
            <div class="col-auto">
                <select class="form-control" id="role" name="role" required>
                    <option value="parents">Orang Tua</option>
                    <option value="anak">Anak</option>
                </select>
            </div>
        </div>

        <!-- Input Parent ID (hanya untuk Anak) -->
        <div class="mb-1 row" id="parentIdRow" style="display: none;">
            <div class="col-2">
                <label for="parent_id" class="col-form-label">Parent ID</label>
            </div>
            <div class="col-auto">
                <input type="text" class="form-control" id="parent_id" name="parent_id" size="20" placeholder="Masukkan ID Orang Tua" required>
            </div>
        </div>

        <div class="mb-1 row">
            <div class="col-auto">
                <input type="submit" class="btn btn-success" id="btnSubmit" name="btnRegister" value="Daftar">
            </div>
        </div>
    </form>
</div>

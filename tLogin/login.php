<?php
session_start();
include "config.php";  // Koneksi ke database
include "template/mainheader.php";  // Template header

// Menangani proses login
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ambil data form
    $username = trim($_POST['username']);
    $password = $_POST['password'];
    $role = $_POST['role'];  // Menambahkan role
    $parent_id = isset($_POST['parent_id']) ? $_POST['parent_id'] : null; // ID Orang Tua untuk Anak

    // Validasi input
    if (empty($username) || empty($password) || empty($role)) {
        $error = "Username, Password, dan Role wajib diisi!";
    } else {
        // Jika role adalah anak, validasi Parent ID
        if ($role === 'child' && empty($parent_id)) {
            $error = "Parent ID harus diisi untuk anak!";
        }

        if (empty($error)) {
            // Cari data user berdasarkan username dan role yang dipilih
            $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ? AND role = ?");
            $stmt->execute([$username, $role]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($user) {
                // Verifikasi password
                if (password_verify($password, $user['password'])) {
                    // Jika role = child, pastikan Parent ID valid
                    if ($role === 'child') {
                        $stmt = $pdo->prepare("SELECT * FROM users WHERE id = ? AND role = 'parent'");
                        $stmt->execute([$parent_id]);
                        if ($stmt->rowCount() == 0) {
                            $error = "ID Orang Tua tidak valid atau tidak terdaftar!";
                        } else {
                            // Set session untuk pengguna yang berhasil login
                            $_SESSION['user_id'] = $user['id'];
                            $_SESSION['username'] = $user['username'];
                            $_SESSION['role'] = $user['role'];
                            $_SESSION['parent_id'] = $parent_id;  // Menyimpan ID Orang Tua

                            // Redirect ke dashboard anak
                            header("Location: dashboard_child.php");
                            exit();
                        }
                    } else {
                        // Jika role = parent, set session dan redirect ke dashboard orang tua
                        $_SESSION['user_id'] = $user['id'];
                        $_SESSION['username'] = $user['username'];
                        $_SESSION['role'] = $user['role'];

                        // Redirect ke halaman dashboard orang tua setelah login
                        header("Location: dashboard_parent.php");
                        exit();
                    }
                } else {
                    $error = "Username atau password salah!";
                }
            } else {
                $error = "Username tidak ditemukan untuk role '$role'!";
            }
        }
    }
}
?>

<!-- Halaman Login Form -->
<div style="margin-left: 50px;">
    <form method="post" action="login.php">
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
                <label for="password" class="col-form-label">Password</label>
            </div>
            <div class="col-auto">
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
        </div>

        <!-- Pilihan Role (Parent / Child) -->
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
                <input type="text" class="form-control" id="parent_id" name="parent_id" placeholder="Masukkan ID Orang Tua">
            </div>
        </div>

        <div class="mb-1 row">
            <div class="col-auto">
                <input type="submit" class="btn btn-success" id="btnSubmit" name="btnLogin" value="Login">
            </div>
        </div>
    </form>
</div>

<?php
// Menampilkan pesan error jika ada
if (isset($error)) {
    echo "<div class='alert alert-warning mt-3'>{$error}</div>";
}
?>

<div style="margin-left: 50px;"> 
    <p>Belum memiliki akun? <a href="register.php">Daftar di sini</a></p>
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

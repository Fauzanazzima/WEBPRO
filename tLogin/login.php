<?php
session_start();  // Pastikan sesi dimulai di awal file

include "config.php";  // Pastikan koneksi database ada di sini
include "template/mainheader.php";  // Pastikan header dan template terhubung dengan baik

// Cek apakah form login disubmit
if (isset($_POST['btnLogin'])) {
    // Ambil data dari form
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = $_POST['password'];

    // Query untuk mencari pengguna berdasarkan username
    $sql = "SELECT * FROM users WHERE username = '$username'";
    $result = mysqli_query($conn, $sql);

    // Jika query gagal
    if (!$result) {
        die("Query gagal: " . mysqli_error($conn));
    }

    // Cek apakah ada pengguna yang ditemukan
    if (mysqli_num_rows($result) > 0) {
        // Ambil data pengguna
        $user = mysqli_fetch_assoc($result);

        // Cek apakah password yang dimasukkan cocok dengan password yang ada di database
        if (password_verify($password, $user['password'])) {
            // Jika login sukses, simpan informasi pengguna ke dalam session
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['role'] = $user['role'];
            $_SESSION['parent_id'] = $user['parent_id']; // Menyimpan ID orang tua jika ada

            // Arahkan ke halaman dashboard sesuai dengan role
            if ($user['role'] == 'parents') {
                header("Location: dashboard_parents.php");  // Dashboard untuk Orang Tua
            } else {
                header("Location: dashboard_child.php");  // Dashboard untuk Anak
            }
            exit;
        } else {
            // Jika password salah
            $errMsg = "Password salah!";
        }
    } else {
        // Jika username tidak ditemukan
        $errMsg = "Username tidak ditemukan.";
    }
}

?>

<!-- Form Login -->
<div style="margin-left: 50px;"> 
    <form method="post" action="login.php">
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
                <label for="password" class="col-form-label">Password</label>
            </div>
            <div class="col-auto">
                <input type="password" class="form-control" id="password" name="password" size="20" placeholder="Password" required>
            </div>
        </div>

        <div class="mb-1 row">
            <div class="col-auto">
                <input type="submit" class="btn btn-success" id="btnSubmit" name="btnLogin" size="20" value="Login">
            </div>
        </div>
    </form>
</div>

<!-- Pemberitahuan jika ada pesan dari URL -->
<?php
if (isset($errMsg)) {
    echo '<div class="alert alert-warning mt-3">' . htmlspecialchars($errMsg) . '</div>';
}
?>

<div style="margin-left: 50px;"> 
    <p>Belum memiliki akun? <a href="register.php">Daftar di sini</a></p>
</div>

<?php
include "template/mainfooter.php";
?>

<?php
session_start();  // Pastikan session dimulai di awal file

include "config.php";
include "template/mainheader.php";

// Pastikan koneksi ke database sudah berhasil
if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

if (isset($_POST['btnLogin'])) {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = $_POST['password'];

    // Query untuk memeriksa apakah username ada di database
    $sql = "SELECT * FROM users WHERE username = '$username'";
    $result = mysqli_query($conn, $sql);

    if (!$result) {
        die("Query gagal: " . mysqli_error($conn));
    }

    if (mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);

        // Membandingkan password yang dimasukkan dengan yang ada di database
        if ($password === $user['password']) {
            // Menyimpan informasi pengguna ke session
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];  // Menyimpan username
            $_SESSION['role'] = $user['role'];  // Menyimpan role (parent atau child)

            // Redirect ke halaman dashboard sesuai dengan role
            if ($user['role'] === 'parent') {
                header("Location: dashboard_parent.php");  // Dashboard untuk parent
            } else {
                header("Location: dashboard_child.php");  // Dashboard untuk child
            }
            exit;
        } else {
            $errMsg = "Password salah!";
        }
    } else {
        // Mengirimkan pesan error melalui query string
        header("Location: login.php?msg=" . urlencode("Username tidak ditemukan. Silahkan daftar."));
        exit;
    }
}
?>

<!-- Form Login -->
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

<!-- Pemberitahuan jika ada pesan dari URL -->
<?php
if (isset($_GET['msg'])) {
    echo '<div class="alert alert-warning mt-3">' . htmlspecialchars($_GET['msg']) . '</div>';
}
?>

<div class="mt-3">
    <p>Belum memiliki akun? <a href="register.php">Daftar di sini</a></p>
</div>

<?php
include "template/mainfooter.php";
?>


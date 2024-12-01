<?php
include "config.php";

if (isset($_POST['btnRegister'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Validasi apakah username sudah ada
    $sql_check = "SELECT * FROM users WHERE username = '$username' OR email = '$email'";
    $result_check = mysqli_query($conn, $sql_check);

    if (mysqli_num_rows($result_check) > 0) {
        $errMsg = "Username atau email sudah digunakan!";
    } else {
        // Insert ke database tanpa hashing password
        $sql_insert = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$password')";
        if (mysqli_query($conn, $sql_insert)) {
            header("Location: login.php"); // Redirect ke login page setelah registrasi berhasil
            exit;
        } else {
            $errMsg = "Terjadi kesalahan saat registrasi!";
        }
    }
}
?>
<?php
include "../Templet/mainheader.php";
?>
<div class="row mt-3 mb-4">
    <div class="col-md-6">
        <h4>Registrasi</h4>
    </div>
</div>
<form action="register.php" method="POST">
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
            <input type="email" class="form-control" id="email" name="email" placeholder="Email" required>
        </div>
    </div>

    <div class="mb-1 row">
        <div class="col-2">
            <label for="password" class="col-form-label">Password</label>
        </div>
        <div class="col-auto">
            <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
        </div>
    </div>

    <div class="mb-1 row">
        <div class="col-auto">
            <input type="submit" class="btn btn-success" id="btnRegister" name="btnRegister" value="Daftar">
        </div>
    </div>
</form>

<?php if (isset($errMsg)): ?>
    <div class="alert alert-danger mt-3">
        <?php echo $errMsg; ?>
    </div>
<?php endif; ?>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz4fnFO9gybFf4j5p1h7z3Qd9Od9q8jzToQsmDfm/5N5vXjxz9ffdk7wA8" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js" integrity="sha384-pzjw8f+ua7Kw1TIq0u6fES3NOy0Yl5lHZ5N18zqJk2T4hfcF6l+aDZTLuMXddZjM" crossorigin="anonymous"></script>
</body>
</html>
<?php
include "config.php"; // Koneksi ke database

// Proses registrasi
if (isset($_POST['btnRegister'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $role = $_POST['role']; // Mengambil nilai role (parents atau children)

    // Validasi apakah username atau email sudah ada
    $sql_check = "SELECT * FROM users WHERE username = '$username' OR email = '$email'";
    $result_check = mysqli_query($conn, $sql_check);

    if (mysqli_num_rows($result_check) > 0) {
        $errMsg = "Username atau email sudah digunakan!";
    } else {
        // Insert ke database tanpa hashing password (untuk demo)
        $sql_insert = "INSERT INTO users (username, email, password, role) 
                       VALUES ('$username', '$email', '$password', '$role')";

        if (mysqli_query($conn, $sql_insert)) {
            header("Location: login.php"); // Redirect ke halaman login setelah registrasi berhasil
            exit;
        } else {
            $errMsg = "Terjadi kesalahan saat registrasi!";
        }
    }
}

include "template/mainheader.php"; // Menyertakan header
?>

<div class="container mt-5">
    <!-- Judul Registrasi -->
    <div class="row mb-4">
        <div class="col-md-6">
            <h4>Registrasi Pengguna</h4>
        </div>
    </div>

    <!-- Form Registrasi -->
    <form action="register.php" method="POST">
        <!-- Username -->
        <div class="mb-2 row">
            <div class="col-3">
                <label for="username" class="col-form-label">Username</label>
            </div>
            <div class="col-auto">
                <input type="text" class="form-control" id="username" name="username" placeholder="Username" required>
            </div>
        </div>

        <!-- Email -->
        <div class="mb-2 row">
            <div class="col-3">
                <label for="email" class="col-form-label">Email</label>
            </div>
            <div class="col-auto">
                <input type="email" class="form-control" id="email" name="email" placeholder="Email" required>
            </div>
        </div>

        <!-- Password -->
        <div class="mb-2 row">
            <div class="col-3">
                <label for="password" class="col-form-label">Password</label>
            </div>
            <div class="col-auto">
                <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
            </div>
        </div>

        <!-- Role -->
        <div class="mb-2 row">
            <div class="col-3">
                <label for="role" class="col-form-label">Role</label>
            </div>
            <div class="col-auto">
                <select class="form-control" id="role" name="role" required>
                    <option value="parents">Parents</option>
                    <option value="children">Children</option>
                </select>
            </div>
        </div>

        <!-- Button Submit -->
        <div class="mb-3 row">
            <div class="col-auto">
                <button type="submit" class="btn btn-success" id="btnRegister" name="btnRegister">Daftar</button>
            </div>
        </div>
    </form>

    <!-- Menampilkan Pesan Error jika ada -->
    <?php if (isset($errMsg)): ?>
        <div class="alert alert-danger mt-3">
            <?php echo $errMsg; ?>
        </div>
    <?php endif; ?>
</div>

<?php
include "template/mainfooter.php"; // Menyertakan footer
?>

<!-- JavaScript Bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz4fnFO9gybFf4j5p1h7z3Qd9Od9q8jzToQsmDfm/5N5vXjxz9ffdk7wA8" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js" integrity="sha384-pzjw8f+ua7Kw1TIq0u6fES3NOy0Yl5lHZ5N18zqJk2T4hfcF6l+aDZTLuMXddZjM" crossorigin="anonymous"></script>


<?php
include "template/mainheader.php";
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

    <!-- Menambahkan pilihan role (Parents atau Children) -->
    <div class="mb-1 row">
        <div class="col-2">
            <label for="role" class="col-form-label">Role</label>
        </div>
        <div class="col-auto">
            <select class="form-control" id="role" name="role" required>
                <option value="parents">Parents</option>
                <option value="children">Children</option>
            </select>
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

<?php
include "template/mainfooter.php";
?>

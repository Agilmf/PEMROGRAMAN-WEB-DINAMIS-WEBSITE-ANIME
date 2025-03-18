<?php
session_start(); // Memulai sesi
include 'db.php';

if (isset($_POST['register'])) {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // Cek apakah username sudah ada
    $checkUser = "SELECT * FROM users WHERE username = '$username'";
    $result = $conn->query($checkUser);

    if ($result->num_rows > 0) {
        echo "<script>alert('Username sudah ada, coba username lain!');</script>";
    } else {
        $sql = "INSERT INTO users (username, password) VALUES ('$username', '$password')";
        if ($conn->query($sql) === TRUE) {
            // Setelah registrasi berhasil, langsung login dan simpan data ke sesi
            $_SESSION['username'] = $username; // Menyimpan username ke sesi
            echo "<script>alert('Registrasi berhasil! Silakan login.');</script>";
            header("Location: index.php"); // Alihkan ke halaman utama setelah registrasi
        } else {
            echo "<script>alert('Terjadi kesalahan, coba lagi!');</script>";
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="login-container">
        <div class="login-box">
            <h2>Register</h2>
            <form action="register.php" method="POST">
                <div class="input-box">
                    <input type="text" name="username" required>
                    <label>Username</label>
                </div>
                <div class="input-box">
                    <input type="password" name="password" required>
                    <label>Password</label>
                </div>
                <button type="submit" name="register" class="login-btn">Register</button>
            </form>
            <p>Sudah punya akun? <a href="login.php">Login disini</a></p>
        </div>
    </div>
</body>
</html>

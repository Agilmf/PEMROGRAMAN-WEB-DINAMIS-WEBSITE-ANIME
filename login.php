<?php
session_start();
include 'db.php';

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $captchaResponse = $_POST['g-recaptcha-response'];  // Ambil respons CAPTCHA

    
    $secretKey = '6Lc28agqAAAAAKiToNPGLO7X_U6vl-raKET_rN55';  
    $verifyURL = 'https://www.google.com/recaptcha/api/siteverify';
    $verifyData = [
        'secret' => $secretKey,
        'response' => $captchaResponse
    ];

    
    if (empty($captchaResponse)) {
        echo "<script>alert('Harap verifikasi CAPTCHA!');</script>";
    } else {
        $verifyResponse = file_get_contents($verifyURL . '?' . http_build_query($verifyData));
        $captchaResult = json_decode($verifyResponse);

        // Cek apakah CAPTCHA valid
        if (!$captchaResult->success) {
            echo "<script>alert('Verifikasi CAPTCHA gagal!');</script>";
        } else {
            // Jika CAPTCHA valid, lanjutkan dengan login
            $query = "SELECT * FROM users WHERE username='$username'";
            $result = $conn->query($query);
            $user = $result->fetch_assoc();

            if ($user && password_verify($password, $user['password'])) {
                $_SESSION['username'] = $username;
                header("Location: index.php");
                exit();
            } else {
                echo "<script>alert('Username atau password salah!');</script>";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
    <!-- Tambahkan link reCAPTCHA API -->
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
</head>
<body>
    <div class="login-container">
        <div class="login-box">
            <h2>Login</h2>
            <form action="login.php" method="POST">
                <div class="input-box">
                    <input type="text" name="username" required>
                    <label>Username</label>
                </div>
                <div class="input-box">
                    <input type="password" name="password" required>
                    <label>Password</label>
                </div>

                <!-- Menambahkan reCAPTCHA -->
                <div class="g-recaptcha" data-sitekey="6Lc28agqAAAAAKDnjA4dezYxLq7wQG7UxAEG0K9Z"></div> <!--  site key  -->

                <button type="submit" name="login" class="login-btn">Login</button>
            </form>
            <p>Belum punya akun? <a href="register.php">Daftar disini</a></p>
        </div>
    </div>
</body>
</html>

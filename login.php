<?php
include "koneksi.php";
session_start();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login Page</title>
    <link rel="stylesheet" href="style.css">
    <body>
    <div class="login-container">
        <div class="login-box">
            <h2>Login</h2>
            <form action="login_process.php" method="post">
                <div class="input-group">
                    <label for="username">Username:</label>
                    <input type="text" id="username" name="username" required>
                </div>
                <div class="input-group">
                    <label for="password">Password:</label>
                    <input type="password" id="password" name="password" required>
                </div>
                <button type="submit">Login</button>
            </form>
            <p>Sudah Punya Akun? <a href="index.php">Daftar di sini</a></p>
        </div>
    </div></title>
</head>
<body>
    
</body>
</html>
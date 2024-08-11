<?php

include 'koneksi.php';
session_start();

if (isset($_POST['submit'])) {
    // Mengambil data dari form
    $username = $_POST['username'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    // Query untuk memeriksa apakah username dan password ada di database

    if ($role == 'mahasiswa') {
        $query = "SELECT * FROM mahasiswa WHERE username='$username' AND password='$password'";
    } else if ($role == 'prodi') {
        $query = "SELECT * FROM prodi WHERE username='$username' AND password='$password'";
    }
    // $query = "SELECT * FROM mahasiswa WHERE username='$username' AND password='$password'";
    $result = mysqli_query($koneksi, $query);

    if (mysqli_num_rows($result) === 1) {
        // Jika username dan password cocok, ambil data pengguna
        $row = mysqli_fetch_assoc($result);

        // Menyimpan data pengguna ke sesi
        $_SESSION['username'] = $row['username'];
        $_SESSION['nim'] = $row['nim'];
        $_SESSION['role'] = $role;

        // Redirect ke halaman dashboard atau halaman lainnya

        if ($role == 'mahasiswa') {
            header('Location: mahasiswa.php'); // Redirect ke dashboard mahasiswa
        } else if ($role == 'prodi') {
            header('Location: petugas.php'); // Redirect ke dashboard prodi
        }
        // header("Location: mahasiswa.php");
        exit();
    } else {
        // Jika username atau password salah
        echo "<script>alert('Username atau Password salah!');</script>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"> -->

	<link rel="stylesheet" type="text/css" href="css/style.css">

	<title>Login Form</title>
</head>
<body>
	<div class="container">
		<form action="" method="POST" class="login-email">
			<p class="login-text" style="font-size: 2rem; font-weight: 800;">Login</p>
			<div class="input-group">
				<input type="text" placeholder="Username" name="username" required>
			</div>
			<div class="input-group">
				<input type="password" placeholder="Password" name="password" required>
			</div>
            <div class="input-group">
                <select name="role" required>
                    <option value="">Login as:</option>
                    <option value="mahasiswa">Mahasiswa</option>
                    <option value="prodi">Kaprodi</option>
                </select>
            </div>
			<div class="input-group">
				<button name="submit" class="btn">Login</button>
			</div>
			<p class="login-register-text">Don't have an account? <a href="register.php">Register Here</a>.</p>
		</form>
	</div>
</body>
</html>

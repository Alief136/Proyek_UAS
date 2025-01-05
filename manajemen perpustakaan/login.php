<?php
session_start();
include 'config/koneksi.php';

// Periksa apakah form login telah disubmit
if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password']; // Ambil password yang dimasukkan user

    // Hindari SQL injection dengan menggunakan prepared statement
    $query = $conn->prepare("SELECT * FROM user WHERE username = ? AND password = ?");
    $query->bind_param("ss", $username, $password); // Bind parameter untuk mencegah SQL injection
    $query->execute();
    $result = $query->get_result();

    // Cek apakah ada baris yang cocok
    if ($result->num_rows > 0) {
        // Jika login berhasil, buat session dan redirect
        $_SESSION['username'] = $username;
        header('Location:home.php');
        exit();
    } else {
        // Jika login gagal, beri pesan error
        $error = "Username atau password salah!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../assets/css/style.css">
    <title>Login</title>
</head>
<body>
    <h1>Login Admin</h1>
    <?php if (isset($error)): ?>
        <div style="color: red;"><?php echo $error; ?></div>
    <?php endif; ?>
    <form method="POST">
        <label>Username</label>
        <input type="text" name="username" required>
        <label>Password</label>
        <input type="password" name="password" required>
        <button type="submit" name="login">Login</button>
    </form>
</body>
</html>

<?php
session_start();
include 'config/koneksi.php';


if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password']; 

  
    $query = $conn->prepare("SELECT * FROM user WHERE username = ? AND password = ?");
    $query->bind_param("ss", $username, $password); 
    $query->execute();
    $result = $query->get_result();


    if ($result->num_rows > 0) {
     
        $_SESSION['username'] = $username;
        header('Location:home.php');
        exit();
    } else {
     
        $error = "Username atau password salah!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../../assets/css/style.css">
</head>
<style>

body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f9f9f9;
    color: #333;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh; 
    flex-direction: column;
}

h1 {
    text-align: center;
    color: #2c3e50;
    margin-bottom: 20px;
}

/* Form Styling */
.form-container {
    max-width: 400px;
    background: white;
    padding: 20px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    border-radius: 8px;
    width: 100%; 
}

form {
    display: flex;
    flex-direction: column;
}

form label {
    margin-bottom: 5px;
    font-weight: bold;
}

form input[type="text"],
form input[type="password"] {
    padding: 10px;
    margin-bottom: 15px;
    border: 1px solid #ccc;
    border-radius: 5px;
    outline: none;
}

form button {
    padding: 10px 15px;
    background-color: #2c3e50;
    color: white;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

form button:hover {
    background-color: #218838;
}

/* Error Message Styling */
div[style="color: red; text-align: center;"] {
    font-size: 14px;
    margin-bottom: 10px;
    text-align: center;
}


@media (max-width: 600px) {
    .form-container {
        width: 90%;
    }

    form input[type="text"],
    form input[type="password"] {
        width: 100%;
    }
}


</style>
<body>
    <h1>Login Admin</h1>

    <?php if (isset($error)): ?>
        <div style="color: red; text-align: center;"><?= htmlspecialchars($error); ?></div>
    <?php endif; ?>

    <div class="form-container">
        <!-- Form Login -->
        <form method="POST">
            <label>Username</label>
            <input type="text" name="username" required>
            <label>Password</label>
            <input type="password" name="password" required>
            <button type="submit" name="login">Login</button>
        </form>
    </div>
</body>
</html>

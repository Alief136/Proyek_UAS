<?php
include '../../config/koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $telepon = $_POST['telepon'];

    $query = "INSERT INTO anggota (nama, email, telepon) VALUES ('$nama', '$email', '$telepon')";
    if ($conn->query($query)) {
        header('Location: index.php');
    } else {
        echo "Error: " . $conn->error;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Anggota</title>
</head>
<style>
    /* General Styling */
body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f9;
    color: #333;
    margin: 0;
    padding: 0;
}

h1 {
    text-align: center;
    color: #2c3e50;
    margin-top: 20px;
}

/* Form Styling */
form {
    width: 100%;
    max-width: 500px;
    margin: 30px auto;
    padding: 20px;
    background-color: #fff;
    border-radius: 8px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
}

form label {
    display: block;
    margin: 10px 0 5px;
    font-weight: bold;
}

form input[type="text"],
form textarea {
    width: 100%;
    padding: 10px;
    margin-bottom: 15px;
    border: 1px solid #ccc;
    border-radius: 5px;
    box-sizing: border-box;
}

form textarea {
    resize: vertical;
    height: 100px;
}

/* Button Styling */
form button {
    width: 100%;
    padding: 12px;
    background-color: #2c3e50;
    color: white;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 16px;
    transition: background-color 0.3s ease;
}

form button:hover {
    background-color: #218838;
}

/* Responsiveness */
@media (max-width: 600px) {
    form {
        margin: 20px;
        padding: 15px;
    }

    form button {
        padding: 10px;
    }
}

</style>
<body>
    <h1>Tambah Anggota</h1>
    <form method="POST">
        <label>Nama</label>
        <input type="text" name="nama" required>
        <label>Email</label>
        <textarea name="email"></textarea>
        <label>Telepon</label>
        <input type="text" name="telepon">
        <button type="submit">Simpan</button>
    </form>
</body>
</html>

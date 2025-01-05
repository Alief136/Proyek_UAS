<?php
include '../../config/koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $kode_buku = $_POST['kode_buku'];
    $judul = $_POST['judul'];
    $penulis = $_POST['penulis'];
    $kategori = $_POST['kategori'];
    $tahun_terbit = $_POST['tahun_terbit'];
    $rak = $_POST['rak'];
    $stok = $_POST['stok'];

    $query = "INSERT INTO buku (kode_buku, judul, penulis, kategori, tahun_terbit, rak, stok) 
              VALUES ('$kode_buku', '$judul', '$penulis', '$kategori', '$tahun_terbit', '$rak', '$stok')";
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
    <title>Tambah Buku</title>
    <link rel="stylesheet" href="../../assets/css/style.css">
</head>
<style>
    /* General Styling */
body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f9f9f9;
    color: #333;
}

h1 {
    text-align: center;
    color: #2c3e50;
    margin: 20px 0;
}

a {
    text-decoration: none;
    color: white;
    background-color: #2c3e50;
    padding: 10px 15px;
    border-radius: 5px;
    margin: 10px auto;
    display: block;
    width: 200px;
    text-align: center;
    transition: background-color 0.3s;
}

a:hover {
    background-color: #34495e;
}

/* Form Styling */
.form-container {
    max-width: 500px;
    margin: 0 auto;
    background: white;
    padding: 20px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    border-radius: 8px;
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
form input[type="number"] {
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

/* Responsiveness */
@media (max-width: 600px) {
    .form-container {
        width: 90%;
    }

    form input[type="text"],
    form input[type="number"] {
        width: 100%;
    }
}

</style>
<body>
    <h1>Tambah Buku Baru</h1>

    <div class="form-container">
        <!-- Form untuk menambah buku -->
        <form method="POST">
            <label>Kode Buku</label>
            <input type="text" name="kode_buku" required>
            <label>Judul</label>
            <input type="text" name="judul" required>
            <label>Penulis</label>
            <input type="text" name="penulis" required>
            <label>Kategori</label>
            <input type="text" name="kategori" required>
            <label>Tahun Terbit</label>
            <input type="number" name="tahun_terbit" required>
            <label>Rak</label>
            <input type="number" name="rak" min="1" max="12" required>
            <label>Stok</label>
            <input type="number" name="stok" required>
            <button type="submit">Simpan</button>
        </form>
    </div>

    <a href="index.php" style="background-color: #2c3e50;">Kembali ke Data Buku</a>
</body>
</html>

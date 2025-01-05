<?php
include '../../config/koneksi.php';

$kode_buku = $_GET['kode_buku'];
$query = "SELECT * FROM buku WHERE kode_buku = '$kode_buku'";
$result = $conn->query($query);
$data = $result->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $judul = $_POST['judul'];
    $penulis = $_POST['penulis'];
    $kategori = $_POST['kategori'];
    $tahun_terbit = $_POST['tahun_terbit'];
    $rak = $_POST['rak'];
    $stok = $_POST['stok'];

    $update_query = "UPDATE buku 
                     SET judul = '$judul', penulis = '$penulis', kategori = '$kategori', 
                         tahun_terbit = '$tahun_terbit', rak = '$rak', stok = '$stok'
                     WHERE kode_buku = '$kode_buku'";
    if ($conn->query($update_query)) {
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
    <link rel="stylesheet" href="../../assets/css/style.css">
    <title>Edit Buku</title>
</head>
<style>/* General Styling */
body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f4f4f9;
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
    <div class="form-container">
        <h1>Edit Buku</h1>
        <form method="POST">
            <label>Judul</label>
            <input type="text" name="judul" value="<?php echo $data['judul']; ?>" required>
            <label>Penulis</label>
            <input type="text" name="penulis" value="<?php echo $data['penulis']; ?>" required>
            <label>Kategori</label>
            <input type="text" name="kategori" value="<?php echo $data['kategori']; ?>" required>
            <label>Tahun Terbit</label>
            <input type="number" name="tahun_terbit" value="<?php echo $data['tahun_terbit']; ?>" required>
            <label>Rak</label>
            <input type="number" name="rak" min="1" max="12" value="<?php echo $data['rak']; ?>" required>
            <label>Stok</label>
            <input type="number" name="stok" value="<?php echo $data['stok']; ?>" required>
            <button type="submit">Simpan Perubahan</button>
        </form>
    </div>
</body>
</html>

<?php
include '../../config/koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $telepon = $_POST['telepon'];

    $query = "INSERT INTO anggota (nama, alamat, telepon) VALUES ('$nama', '$alamat', '$telepon')";
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
    <link rel="stylesheet" href="../../assets/css/anggota.css">
    <title>Tambah Anggota</title>
</head>
<body>
    <h1>Tambah Anggota</h1>
    <form method="POST">
        <label>Nama</label>
        <input type="text" name="nama" required>
        <label>Alamat</label>
        <textarea name="alamat"></textarea>
        <label>Telepon</label>
        <input type="text" name="telepon">
        <button type="submit">Simpan</button>
    </form>
</body>
</html>

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
    <link rel="stylesheet" href="../../assets/css/style.css">
    <title>Tambah Buku</title>
</head>
<body>
    <h1>Tambah Buku Baru</h1>
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
</body>
</html>

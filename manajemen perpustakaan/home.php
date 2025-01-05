<?php
include 'config/koneksi.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/style.css">
    <title>Home - Perpustakaan</title>
</head>
<body>
    <div id="header">
        <h1>Sistem Informasi Perpustakaan</h1>
    </div>
    <div id="menu">
        <ul>
            <li><a href="home.php">Home</a></li>
            <li><a href="modules/buku/index.php">Data Buku</a></li>
            <li><a href="modules/anggota/index.php">Data Anggota</a></li>
            <li><a href="modules/peminjaman/index.php">Peminjaman</a></li>
            <li><a href="modules/export/export_excel.php">Export Data</a></li>
        </ul>
    </div>
    <div id="isi">
        <h2>Selamat Datang di Sistem Informasi Perpustakaan</h2>
        <p>Gunakan menu di atas untuk mengelola data perpustakaan.</p>
    </div>
    <a href="logout.php" onclick="return confirm('Apakah Anda yakin ingin logout?')">Logout</a>

</body>

</html>
<?php
include '../../config/koneksi.php';

// Ambil data anggota dan buku
$keyword_anggota = isset($_GET['keyword_anggota']) ? $_GET['keyword_anggota'] : '';
$keyword_buku = isset($_GET['keyword_buku']) ? $_GET['keyword_buku'] : '';

$anggota_query = "SELECT * FROM anggota WHERE nama LIKE '%$keyword_anggota%'";
$buku_query = "SELECT * FROM buku WHERE stok > 0 AND judul LIKE '%$keyword_buku%'";

$anggota_result = $conn->query($anggota_query);
$buku_result = $conn->query($buku_query);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_anggota = $_POST['id_anggota'];
    $id_buku = $_POST['id_buku'];
    $tanggal_pinjam = $_POST['tanggal_pinjam'];
    $tanggal_harus_kembali = date('Y-m-d', strtotime($tanggal_pinjam . ' +14 days')); // 14 hari setelah tanggal pinjam

    // Insert data peminjaman
    $query = "INSERT INTO peminjaman (id_anggota, id_buku, tanggal_pinjam, tanggal_harus_kembali)
              VALUES ('$id_anggota', '$id_buku', '$tanggal_pinjam', '$tanggal_harus_kembali')";
    
    if ($conn->query($query)) {
        // Update stok buku
        $update_query = "UPDATE buku SET stok = stok - 1 WHERE id_buku = '$id_buku'";
        $conn->query($update_query);

        header('Location: index.php'); // Redirect ke halaman index peminjaman
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
    <title>Tambah Peminjaman</title>
</head>
<style>
    /* Styling untuk body */
body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f4f4f9;
    color: #333;
}

/* Styling untuk judul halaman */
h1 {
    text-align: center;
    color: #2c3e50;
    margin-top: 20px;
}

/* Styling form */
form {
    max-width: 400px;
    margin: 20px auto;
    padding: 20px;
    background: #fff;
    border: 1px solid #ddd;
    border-radius: 8px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
}

/* Label styling */
label {
    display: block;
    font-weight: bold;
    margin-bottom: 10px;
    color: #555;
}

/* Input dan select styling */
input[type="text"], input[type="date"], select {
    width: 100%;
    padding: 10px;
    margin-bottom: 15px;
    border: 1px solid #ccc;
    border-radius: 5px;
    font-size: 14px;
    box-sizing: border-box;
}

/* Tombol styling */
button {
    width: 100%;
    padding: 10px;
    background-color: #2c3e50;
    color: white;
    font-weight: bold;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

button:hover {
    background-color: #4169E1;
}

/* Styling untuk pesan kosong */
option[value=""] {
    color: #aaa;
    font-style: italic;
}

</style>
<body>
    <h1>Tambah Peminjaman</h1>
    
    <!-- Filter Anggota -->
    <form method="GET" style="margin-bottom: 20px;">
        <label>Cari Anggota</label>
        <input type="text" name="keyword_anggota" placeholder="Masukkan nama anggota" value="<?= $keyword_anggota; ?>">
        <button type="submit">Cari</button>
    </form>

    <!-- Filter Buku -->
    <form method="GET" style="margin-bottom: 20px;">
        <label>Cari Buku</label>
        <input type="text" name="keyword_buku" placeholder="Masukkan judul buku" value="<?= $keyword_buku; ?>">
        <button type="submit">Cari</button>
    </form>

    <!-- Form Tambah Peminjaman -->
    <form method="POST">
        <label>Anggota</label>
        <select name="id_anggota" required>
            <?php if ($anggota_result->num_rows > 0): ?>
                <?php while ($anggota = $anggota_result->fetch_assoc()): ?>
                    <option value="<?= $anggota['id_anggota']; ?>"><?= $anggota['nama']; ?></option>
                <?php endwhile; ?>
            <?php else: ?>
                <option value="">Tidak ada anggota ditemukan</option>
            <?php endif; ?>
        </select>
        
        <label>Buku</label>
        <select name="id_buku" required>
            <?php if ($buku_result->num_rows > 0): ?>
                <?php while ($buku = $buku_result->fetch_assoc()): ?>
                    <option value="<?= $buku['id_buku']; ?>"><?= $buku['judul']; ?></option>
                <?php endwhile; ?>
            <?php else: ?>
                <option value="">Tidak ada buku ditemukan</option>
            <?php endif; ?>
        </select>
        
        <label>Tanggal Pinjam</label>
        <input type="date" name="tanggal_pinjam" required>
        
        <button type="submit">Tambah Peminjaman</button>
    </form>
</body>
</html>
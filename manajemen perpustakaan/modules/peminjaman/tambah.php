<?php
include '../../config/koneksi.php';

// Ambil data buku dan anggota
$anggota_query = "SELECT * FROM anggota";
$buku_query = "SELECT * FROM buku WHERE stok > 0"; // Hanya buku yang tersedia untuk dipinjam
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
<body>
    <h1>Tambah Peminjaman</h1>
    <form method="POST">
        <label>Anggota</label>
        <select name="id_anggota" required>
            <?php while ($anggota = $anggota_result->fetch_assoc()): ?>
                <option value="<?= $anggota['id_anggota']; ?>"><?= $anggota['nama']; ?></option>
            <?php endwhile; ?>
        </select>
        
        <label>Buku</label>
        <select name="id_buku" required>
            <?php while ($buku = $buku_result->fetch_assoc()): ?>
                <option value="<?= $buku['id_buku']; ?>"><?= $buku['judul']; ?></option>
            <?php endwhile; ?>
        </select>
        
        <label>Tanggal Pinjam</label>
        <input type="date" name="tanggal_pinjam" required>
        
        <button type="submit">Tambah Peminjaman</button>
    </form>
</body>
</html>

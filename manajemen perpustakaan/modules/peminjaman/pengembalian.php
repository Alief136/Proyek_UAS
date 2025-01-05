<?php
include '../../config/koneksi.php';

if (isset($_GET['id_peminjaman'])) {
    $id_peminjaman = $_GET['id_peminjaman'];

    // Ambil data peminjaman
    $query = "SELECT * FROM peminjaman WHERE id_peminjaman = '$id_peminjaman'";
    $result = $conn->query($query);
    $peminjaman = $result->fetch_assoc();

    if ($peminjaman) { // Pastikan peminjaman ditemukan
        $id_buku = $peminjaman['id_buku'];

        // Jika form disubmit
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $tanggal_kembali = $_POST['tanggal_kembali'];

            // Validasi tanggal kembali
            if (strtotime($tanggal_kembali) < strtotime($peminjaman['tanggal_pinjam'])) {
                echo "<p style='color:red;'>Tanggal kembali tidak boleh lebih awal dari tanggal pinjam!</p>";
            } else {
                // Update status peminjaman dan tanggal kembali
                $update_query = "UPDATE peminjaman 
                                 SET tanggal_kembali = '$tanggal_kembali', status = 'Dikembalikan' 
                                 WHERE id_peminjaman = '$id_peminjaman'";
                
                if ($conn->query($update_query)) {
                    // Kembalikan stok buku
                    $update_buku = "UPDATE buku SET stok = stok + 1 WHERE id_buku = '$id_buku'";
                    $conn->query($update_buku);

                    // Redirect ke halaman index peminjaman
                    header('Location: index.php');
                    exit;
                } else {
                    echo "<p style='color:red;'>Error: " . $conn->error . "</p>";
                }
            }
        }
    } else {
        echo "<p style='color:red;'>Data peminjaman tidak ditemukan.</p>";
    }
} else {
    echo "<p style='color:red;'>ID peminjaman tidak diberikan.</p>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../assets/css/style.css">
    <title>Kembalikan Buku</title>
</head>
<body>
    <h1>Kembalikan Buku</h1>
    <?php if (isset($peminjaman)): ?>
        <form method="POST">
            <label for="tanggal_kembali">Tanggal Kembali</label>
            <input type="date" id="tanggal_kembali" name="tanggal_kembali" required>

            <button type="submit">Kembalikan Buku</button>
        </form>
    <?php else: ?>
        <p>Data peminjaman tidak ditemukan atau tidak valid.</p>
    <?php endif; ?>

    <a href="index.php">Kembali ke Data Peminjaman</a>
</body>
</html>

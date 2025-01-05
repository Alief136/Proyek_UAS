<?php
include '../../config/koneksi.php';

// Ambil keyword dari form pencarian (jika ada)
$keyword = isset($_GET['keyword']) ? $_GET['keyword'] : '';

// Query untuk menampilkan data buku dengan filter keyword
$query = "SELECT * FROM buku WHERE 
          kode_buku LIKE '%$keyword%' OR 
          judul LIKE '%$keyword%' OR 
          penulis LIKE '%$keyword%' OR 
          kategori LIKE '%$keyword%' OR 
          tahun_terbit LIKE '%$keyword%' OR 
          rak LIKE '%$keyword%'";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../assets/css/style.css">
    <title>Data Buku</title>
</head>
<body>
    <h1>Data Buku</h1>
    
    <!-- Form Pencarian -->
    <form method="GET" action="index.php">
        <input type="text" name="keyword" placeholder="Cari buku..." value="<?= htmlspecialchars($keyword); ?>">
        <button type="submit">Cari</button>
        <a href="index.php">Reset</a> <!-- Tombol reset untuk kembali ke semua data -->
    </form>

    <a href="tambah.php">Tambah Buku</a>
    <a href="../../home.php">Kembali ke Home</a>
    <table border="1" cellspacing="0" cellpadding="5">
        <thead>
            <tr>
                <th>Kode Buku</th>
                <th>Judul</th>
                <th>Penulis</th>
                <th>Kategori</th>
                <th>Tahun Terbit</th>
                <th>Stok</th>
                <th>Rak</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($result->num_rows > 0): ?>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?= $row['kode_buku']; ?></td>
                        <td><?= $row['judul']; ?></td>
                        <td><?= $row['penulis']; ?></td>
                        <td><?= $row['kategori']; ?></td>
                        <td><?= $row['tahun_terbit']; ?></td>
                        <td><?= $row['stok']; ?></td>
                        <td><?= $row['rak']; ?></td>
                        <td>
                            <a href="edit.php?kode_buku=<?= $row['kode_buku']; ?>">Edit</a>
                            <a href="hapus.php?kode_buku=<?= $row['kode_buku']; ?>" onclick="return confirm('Yakin ingin menghapus buku ini?')">Hapus</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="8">Tidak ada data ditemukan</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</body>
</html>

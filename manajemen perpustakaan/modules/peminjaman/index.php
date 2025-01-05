<?php
include '../../config/koneksi.php';

// Query untuk mengambil data peminjaman dengan data anggota dan buku
$query = "SELECT p.id_peminjaman, a.id_anggota, a.nama, b.judul, p.tanggal_pinjam, 
                 p.tanggal_harus_kembali, p.tanggal_kembali, p.status
          FROM peminjaman p
          JOIN anggota a ON p.id_anggota = a.id_anggota
          JOIN buku b ON p.id_buku = b.id_buku";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../assets/css/style.css">
    <title>Data Peminjaman</title>
</head>
<body>
    <h1>Data Peminjaman</h1>
    <a href="tambah.php">Tambah Peminjaman</a>
    <a href="../../home.php">Kembali ke Home</a>
    <table border="1" cellspacing="0" cellpadding="5">
        <thead>
            <tr>
                <th>ID Peminjaman</th>
                <th>ID Anggota</th>
                <th>Nama Anggota</th>
                <th>Judul Buku</th>
                <th>Tanggal Pinjam</th>
                <th>Tanggal Harus Kembali</th>
                <th>Tanggal Kembali</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            // Looping untuk menampilkan data
            while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= htmlspecialchars($row['id_peminjaman']); ?></td>
                    <td><?= htmlspecialchars($row['id_anggota']); ?></td>
                    <td><?= htmlspecialchars($row['nama']); ?></td>
                    <td><?= htmlspecialchars($row['judul']); ?></td>
                    <td><?= htmlspecialchars($row['tanggal_pinjam']); ?></td>
                    <td><?= htmlspecialchars($row['tanggal_harus_kembali']); ?></td>
                    <td><?= htmlspecialchars($row['tanggal_kembali'] ?? '-'); ?></td>
                    <td><?= htmlspecialchars($row['status']); ?></td>
                    <td>
                        <?php if ($row['status'] === 'Dipinjam'): ?>
                            <a href="pengembalian.php?id_peminjaman=<?= htmlspecialchars($row['id_peminjaman']); ?>">Kembalikan</a>
                        <?php endif; ?>
                        <a href="hapus.php?id_peminjaman=<?= htmlspecialchars($row['id_peminjaman']); ?>" 
                           onclick="return confirm('Yakin ingin menghapus data ini?')">Hapus</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</body>
</html>

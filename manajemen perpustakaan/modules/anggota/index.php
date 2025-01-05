<?php
include '../../config/koneksi.php';

// Ambil data anggota
$query = "SELECT * FROM anggota";
$result = $conn->query($query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../assets/css/anggota.css">
    <title>Data Anggota</title>
</head>
<body class="index">
    <h1>Data Anggota</h1>

    <!-- Tombol tambah anggota -->
    <a href="tambah.php" style="padding: 6px; background-color: #28a745; color: white; text-decoration: none; border-radius: 4px;">Tambah Anggota</a>

    <table border="1" cellspacing="0" cellpadding="5" style="margin-top: 10px;">
        <tr>
            <th>ID Anggota</th>
            <th>Nama</th>
            <th>Alamat</th>
            <th>Telepon</th>
            <th>Aksi</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()) { ?>
        <tr>
            <td><?= $row['id_anggota']; ?></td>
            <td><?= $row['nama']; ?></td>
            <td><?= $row['alamat']; ?></td>
            <td><?= $row['telepon']; ?></td>
            <td>
                <a href="edit.php?id_anggota=<?= $row['id_anggota']; ?>">Edit</a> | 
                <a href="hapus.php?id_anggota=<?= $row['id_anggota']; ?>" onclick="return confirm('Yakin ingin menghapus?')">Hapus</a>
            </td>
        </tr>
        <?php } ?>
    </table>
    <a href="../../home.php" style="padding: 6px; background-color: #007bff; color: white; text-decoration: none; border-radius: 4px; margin-bottom: 10px; display: inline-block;">Kembali ke Home</a>

</body>
</html>

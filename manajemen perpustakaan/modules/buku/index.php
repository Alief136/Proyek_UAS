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
    <title>Data Buku</title>
    <style>
        /* General Styling */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f9;
            color: #333;
        }

        h1 {
            text-align: center;
            color: #2c3e50;
            margin: 20px 0;
        }

        a {
            text-decoration: none;
            color: white;
            background-color: #2c3e50;
            padding: 8px 12px;
            border-radius: 5px;
            margin: 5px;
            display: inline-block;
            transition: background-color 0.3s ease;
        }

        a:hover {
            background-color: #0056b3;
        }

        /* Form Styling */
        form {
            text-align: center;
            margin-bottom: 20px;
        }

        form input[type="text"] {
            width: 50%;
            padding: 10px;
            margin-right: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            outline: none;
        }

        form button {
            padding: 10px 15px;
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        form button:hover {
            background-color: #218838;
        }

        form a {
            color: white;
            background-color: #2c3e50;
        }

        form a:hover {
            background-color: #5a6268;
        }

        /* Table Styling */
        table {
            width: 90%;
            margin: 0 auto;
            border-collapse: collapse;
            background: white;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        table th, table td {
            text-align: left;
            padding: 10px;
            border: 1px solid #ddd;
        }

        table th {
            background-color: #2c3e50;
            color: white;
        }

        table tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        table tr:hover {
            background-color: #f1f1f1;
        }

        table td a {
            padding: 5px 10px;
            border-radius: 3px;
        }

        table td a:first-child {
            background-color: #ffc107;
        }

        table td a:first-child:hover {
            background-color: #e0a800;
        }

        table td a:last-child {
            background-color: #dc3545;
        }

        table td a:last-child:hover {
            background-color: #c82333;
        }

        /* Responsiveness */
        @media (max-width: 600px) {
            form input[type="text"] {
                width: 70%;
            }

            table {
                display: block;
                overflow-x: auto;
                white-space: nowrap;
            }

            a {
                font-size: 14px;
                padding: 6px 8px;
            }
        }
        /* Container untuk tombol di bawah tabel */
        .button-container {
            display: flex;
            justify-content: center; /* Menjaga tombol sejajar secara horizontal */
            gap: 10px; /* Memberikan jarak antar tombol */
            margin-top: 20px; /* Menambahkan jarak antara tabel dan tombol */
        }

        /* Untuk menjaga tombol agar tidak terlalu besar */
        .button-container a {
            padding: 10px 20px;
            text-align: center;
            border-radius: 5px;
            color: white;
            text-decoration: none;
}

    </style>
</head>
<body>
    <h1>Data Buku</h1>
    
    <!-- Form Pencarian -->
    <form method="GET" action="index.php">
        <input type="text" name="keyword" placeholder="Cari buku..." value="<?= htmlspecialchars($keyword); ?>">
        <button type="submit">Cari</button>
        <a href="index.php">Reset</a> <!-- Tombol reset untuk kembali ke semua data -->
    </form>

    <table>
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
                    <td colspan="8" style="text-align: center;">Tidak ada data ditemukan</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
    <!-- Container untuk tombol di bawah tabel -->
<div class="button-container">
    <a href="tambah.php" style="background-color: #28a745;">Tambah Buku</a>
    <a href="../../home.php" style="background-color: #2c3e50;">Kembali ke Home</a>
</div>

</body>
</html>

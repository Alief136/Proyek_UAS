<?php
include '../../config/koneksi.php';

// Ambil keyword dari form pencarian (jika ada)
$keyword = isset($_GET['keyword']) ? $_GET['keyword'] : '';

// Query data anggota dengan filter pencarian
$query = "SELECT * FROM anggota";
if (!empty($keyword)) {
    $query .= " WHERE nama LIKE '%$keyword%' OR email LIKE '%$keyword%' OR telepon LIKE '%$keyword%'";
}

$result = $conn->query($query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Anggota</title>
    <style>
        /* General Styling */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f9f9f9;
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
            padding: 10px 15px;
            border-radius: 5px;
            margin: 5px;
            display: inline-block;
            transition: background-color 0.3s;
        }

        a:hover {
            background-color: #34495e;
        }

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
            background-color: #6c757d;
        }

        form a:hover {
            background-color: #5a6268;
        }


        /* Table Styling */
        table {
            width: 90%;
            border-collapse: collapse;
            margin: 20px auto;
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
            background-color: #f2f2f2;
        }

        table tr:hover {
            background-color: #f1f1f1;
        }

        /* Responsiveness */
        @media (max-width: 600px) {
            table {
                display: block;
                overflow-x: auto;
                white-space: nowrap;
            }

            a {
                font-size: 14px;
                padding: 8px 10px;
            }
        }
    </style>
</head>
<body>
    <h1>Data Anggota</h1>

    <!-- Form Pencarian -->
    <form method="GET">
        <input type="text" name="keyword" placeholder="Cari nama, email, atau telepon" value="<?= htmlspecialchars($keyword); ?>">
        <button type="submit">Cari</button>
    </form>

    <!-- Tombol tambah anggota -->
    <a href="tambah.php" style="background-color: #28a745;">Tambah Anggota</a>

    <!-- Tabel Data Anggota -->
    <table>
        <tr>
            <th>ID Anggota</th>
            <th>Nama</th>
            <th>Email</th>
            <th>Telepon</th>
            <th>Aksi</th>
        </tr>
        <?php if ($result->num_rows > 0): ?>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= htmlspecialchars($row['id_anggota']); ?></td>
                    <td><?= htmlspecialchars($row['nama']); ?></td>
                    <td><?= htmlspecialchars($row['email']); ?></td>
                    <td><?= htmlspecialchars($row['telepon']); ?></td>
                    <td>
                        <a href="edit.php?id_anggota=<?= htmlspecialchars($row['id_anggota']); ?>" style="background-color: #f39c12;">Edit</a>
                        <a href="hapus.php?id_anggota=<?= htmlspecialchars($row['id_anggota']); ?>" style="background-color: #e74c3c;" onclick="return confirm('Yakin ingin menghapus?')">Hapus</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        <?php else: ?>
            <tr>
                <td colspan="5" style="text-align: center;">Tidak ada data ditemukan.</td>
            </tr>
        <?php endif; ?>
    </table>
    <a href="../../home.php" style="background-color: #007bff;">Kembali ke Home</a>
</body>
</html>

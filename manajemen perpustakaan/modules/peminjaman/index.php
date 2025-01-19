<?php
include '../../config/koneksi.php';

// Ambil keyword dari form pencarian (jika ada)
$keyword = isset($_GET['keyword']) ? $_GET['keyword'] : '';

// Query data peminjaman dengan filter pencarian
$query = "SELECT p.id_peminjaman, a.id_anggota, a.nama, b.judul, p.tanggal_pinjam, 
                 p.tanggal_harus_kembali, p.tanggal_kembali, p.status
          FROM peminjaman p
          JOIN anggota a ON p.id_anggota = a.id_anggota
          JOIN buku b ON p.id_buku = b.id_buku";

if (!empty($keyword)) {
    $query .= " WHERE a.nama LIKE '%$keyword%' OR b.judul LIKE '%$keyword%' OR p.status LIKE '%$keyword%'";
}

$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Peminjaman</title>
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
            justify-content: center;
            
        }

        a:hover {
            background-color: #0056b3;
            
        }

        form {
            text-align: center;
            margin: 20px;
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
            padding: 8px 15px;
            border: none;
            background-color: #2c3e50;
            color: white;
            border-radius: 4px;
            cursor: pointer;
        }

        form button:hover {
            background-color: #34495e;
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
    </style>
</head>
<body>
    <h1>Data Peminjaman</h1>

    <!-- Form Pencarian -->
    <form method="GET">
    <a href="tambah.php" style="background-color: #28a745;">Tambah Peminjaman</a>
    <input type="text" name="keyword" placeholder="Cari nama, judul buku, atau status" value="<?= htmlspecialchars($keyword); ?>">
    <button type="submit">Cari</button>
    </form>

    <table>
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
            if ($result->num_rows > 0):
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
                                <a href="pengembalian.php?id_peminjaman=<?= htmlspecialchars($row['id_peminjaman']); ?>" class="edit">Kembalikan</a>
                            <?php endif; ?>
                            <a href="hapus.php?id_peminjaman=<?= htmlspecialchars($row['id_peminjaman']); ?>" 
                               class="hapus" onclick="return confirm('Yakin ingin menghapus data ini?')">Hapus</a>
                        </td>
                    </tr>
                <?php endwhile; 
            else: ?>
                <tr>
                    <td colspan="9" style="text-align: center;">Tidak ada data ditemukan.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
    <a href="../../home.php" style="background-color: #007bff;">Kembali ke Home</a>
    <button id="scrollToTopBtn" style="display:none; position:fixed; bottom:20px; right:20px; padding:10px 15px; background-color:#2c3e50; color:white; border:none; border-radius:5px; cursor:pointer;">⬆️ </button>

    <script>
    // Ambil tombol
    const scrollToTopBtn = document.getElementById("scrollToTopBtn");

    // Tampilkan tombol saat pengguna scroll ke bawah
    window.onscroll = function () {
        if (document.body.scrollTop > 100 || document.documentElement.scrollTop > 100) {
            scrollToTopBtn.style.display = "block";
        } else {
            scrollToTopBtn.style.display = "none";
        }
    };

    // Fungsi untuk scroll ke atas
    scrollToTopBtn.addEventListener("click", function () {
        window.scrollTo({
            top: 0,
            behavior: "smooth" // Gulir halus
        });
    });
</script>

</body>
</html>

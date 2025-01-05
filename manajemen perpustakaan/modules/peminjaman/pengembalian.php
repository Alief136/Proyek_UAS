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
    <title>Kembalikan Buku</title>
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
            margin: 20px auto;
            width: 50%;
            background: white;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        form label {
            display: block;
            margin-bottom: 10px;
            font-weight: bold;
        }

        form input[type="date"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
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

        /* Responsiveness */
        @media (max-width: 600px) {
            form {
                width: 90%;
            }
        }
    </style>
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
        <p style="text-align: center;">Data peminjaman tidak ditemukan atau tidak valid.</p>
    <?php endif; ?>

    <div style="text-align: center;">
        <a href="index.php">Kembali ke Data Peminjaman</a>
    </div>
</body>
</html>

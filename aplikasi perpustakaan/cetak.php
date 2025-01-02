<!DOCTYPE html>
<html>
<head>
    <title>Cetak Data Buku</title>
    <style>
        body {
            margin: auto;
            width: 80%;
            font-family: sans-serif;
        }
        table {
            border-collapse: collapse;
            width: 100%;
        }
        th, td {
            border: 1px solid #ddd;
            text-align: center;
            padding: 8px;
        }
        th {
            background-color: #eee;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <h2 align="center">Data Buku</h2>
    <table>
        <tr>
            <th>No</th>
            <th>Kode Buku</th>
            <th>Judul</th>
            <th>Penulis</th>
            <th>Penerbit</th>
            <th>Tahun Terbit</th>
        </tr>
        <?php
        include 'koneksi.php';
        $no = 1;
        $tampil = mysqli_query($conn, "SELECT * FROM tb_buku");

        if (mysqli_num_rows($tampil) > 0) {
            while ($hasil = mysqli_fetch_array($tampil)) {
                echo "<tr>";
                echo "<td>" . $no++ . "</td>";
                echo "<td>" . $hasil['kode'] . "</td>";
                echo "<td>" . $hasil['judul'] . "</td>";
                echo "<td>" . $hasil['penulis'] . "</td>";
                echo "<td>" . $hasil['penerbit'] . "</td>";
                echo "<td>" . $hasil['tahun'] . "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr>";
            echo "<td colspan='6' align='center'>Data Kosong</td>";
            echo "</tr>";
        }
        ?>
    </table>
    <script>
        window.print();
    </script>
</body>
</html>

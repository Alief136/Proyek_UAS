<!DOCTYPE html>
<html>
<head>
    <title>Laporan Data</title>
</head>
<body>
    <div style="margin: 0 auto; width: 80%;">
        <h2 align="center">Laporan Data Buku</h2>
        <br>
        <table border="1" cellspacing="0" width="100%">
            <tr style="text-align: center; font-weight: bold; background-color: #eee; font-family: sans-serif;">
                <td>No</td>
                <td>Kode Buku</td>
                <td>Judul</td>
                <td>Penulis</td>
                <td>Penerbit</td>
                <td>Tahun Terbit</td>
            </tr>
            <?php
            include 'koneksi.php';
            $no = 1;
            $tampil = mysqli_query($conn, "SELECT * FROM tb_buku");
            if (mysqli_num_rows($tampil) > 0) {
                while ($hasil = mysqli_fetch_array($tampil)) {
            ?>
                <tr style="text-align: center; font-family: sans-serif;">
                    <td><?php echo $no++; ?></td>
                    <td><?php echo $hasil['kode']; ?></td>
                    <td><?php echo $hasil['judul']; ?></td>
                    <td><?php echo $hasil['penulis']; ?></td>
                    <td><?php echo $hasil['penerbit']; ?></td>
                    <td><?php echo $hasil['tahun']; ?></td>
                </tr>
            <?php
                }
            } else {
            ?>
                <tr>
                    <td colspan="6" align="center">Data Kosong</td>
                </tr>
            <?php
            }
            ?>
        </table>
        <br>
        <a href="cetak.php" target="_blank" style="padding: 4px 6px; background-color: #6495ED; border-radius: 3px; color: #FFFFFF; text-decoration: none;">Cetak</a>
    </div>
</body>
</html>

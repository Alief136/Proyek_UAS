<!DOCTYPE html>
<html>
    <head>
        <title>Perpustakaan</title>
        <link rel="stylesheet" type="text/css" href="style.css">
    </head>
    <body>
        <div id="canvas">
            <!-- Header -->
            <div id="header">
                <table align="center">
                    <tr>
                        <td id="header1">Aplikasi Manajemen Perpustakaan</td>
                    </tr>
                </table>
            </div>

            <!-- Menu -->
            <div id="menu">
                <ul>
                    <li class="active"><a href="home.php">Home</a></li>
                    <li><a href="index.php">Data Buku</a></li>
                    <li><a href="indexa.php">Data Anggota</a></li>
                    <li><a href="laporan.php">Laporan</a></li>
                </ul>
            </div>

            <!-- Isi - Halaman Home -->
            <div id="isi">
                <p class="judul">PERPUSTAKAAN</p>
                <div id="profiling">
                    <img src="GAMBAR/buku.png">
                </div>
                <h4>placeholder</h4>
            </div>

            <!-- Tabel Data Buku -->
            <div id="isi">
                <h3 align="center">Data Buku</h3>
                <a href="forminput.php" style="padding: 4px 6px; background-color: #6495ED; border-radius: 3px; color: #FFFFFF; text-decoration: none;">Tambah Buku</a>
                <table border="1" cellspacing="0" width="100%" style="text-align: center; font-weight: bold; background-color: #eee; font-family: sans-serif;">
                    <tr>
                        <td>Kode Buku</td>
                        <td>Judul</td>
                        <td>Penulis</td>
                        <td>Penerbit</td>
                        <td>Tahun Terbit</td>
                        <td>Aksi</td>
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
                                <td><?php echo $hasil['tahun']; ?></td>
                                <td style="font-weight: bold; color: #000080;">
                                    <a href="edit.php?kode=<?php echo $hasil['kode']; ?>">Edit</a> |
                                    <a href="hapus.php?kode=<?php echo $hasil['kode']; ?>">Hapus</a>
                                </td>
                            </tr>
                            <?php
                        }
                    } else {
                        ?>
                        <tr>
                            <td colspan="7" align="center">Data Kosong</td>
                        </tr>
                        <?php
                    }
                    ?>
                </table>
            </div>

            <!-- Footer -->
            <div id="footer">
                <a href="logout.php" style="padding: 4px 6px; background-color: #6495ED; border-radius: 3px; color: #FFFFFF; text-decoration: none;">Logout</a>
            </div>
        </div>
    </body>
</html>

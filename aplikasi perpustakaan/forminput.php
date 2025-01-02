<!DOCTYPE html>
<html>
<head>
    <title>Halaman Input Data</title>
</head>
<body>
    <h2 style="padding: 1px 20px;">Input Data Buku</h2>
    <form action="" method="POST">
        <table style="padding: 1px 20px;">
            <tr>
                <td>Kode</td>
                <td><input type="text" name="kode" placeholder="Kode Buku" required></td>
            </tr>
            <tr>
                <td>Judul</td>
                <td><input type="text" name="judul" placeholder="Judul" required></td>
            </tr>
            <tr>
                <td>Penulis</td>
                <td><input type="text" name="penulis" placeholder="Penulis" required></td>
            </tr>
            <tr>
                <td>Penerbit</td>
                <td><input type="text" name="penerbit" placeholder="Penerbit" required></td>
            </tr>
            <tr>
                <td>Tahun Terbit</td>
                <td><input type="text" name="tahun" placeholder="Tahun Terbit" required></td>
            </tr>
            <tr>
                <td></td>
                <td><input type="submit" name="simpan" value="Simpan"></td>
            </tr>
        </table>
    </form>

    <?php
    include 'koneksi.php';
    if (isset($_POST['simpan'])) {
        $kode = $_POST['kode'];
        $judul = $_POST['judul'];
        $penulis = $_POST['penulis'];
        $penerbit = $_POST['penerbit'];
        $tahun = $_POST['tahun'];

        $input = "INSERT INTO tb_buku VALUES ('$kode', '$judul', '$penulis', '$penerbit', '$tahun')";
        mysqli_query($conn, $input);
        header('location:index.php');
    }
    ?>
</body>
</html>

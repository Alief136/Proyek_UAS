<?php
include 'koneksi.php';

$edit = mysqli_query($conn, "SELECT * FROM tb_buku WHERE kode = '".$_GET['kode']."'");
$result = mysqli_fetch_array($edit);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Halaman Edit Data</title>
</head>
<body>
    <h2 style="padding: 1px 20px;">Edit Data Buku</h2>
    <form action="" method="POST">
        <table style="padding: 1px 20px;">
            <tr>
                <td>Kode Buku</td>
                <td><input type="text" name="kode" value="<?php echo $result['kode']; ?>"></td>
            </tr>
            <tr>
                <td>Judul</td>
                <td><input type="text" name="judul" value="<?php echo $result['judul']; ?>"></td>
            </tr>
            <tr>
                <td>Penulis</td>
                <td><input type="text" name="penulis" value="<?php echo $result['penulis']; ?>"></td>
            </tr>
            <tr>
                <td>Penerbit</td>
                <td><input type="text" name="penerbit" value="<?php echo $result['penerbit']; ?>"></td>
            </tr>
            <tr>
                <td>Tahun Terbit</td>
                <td><input type="text" name="tahun" value="<?php echo $result['tahun']; ?>"></td>
            </tr>
            <tr>
                <td></td>
                <td><input type="submit" name="edit" value="Simpan"></td>
            </tr>
        </table>
    </form>

    <?php
    if (isset($_POST['edit'])) {
        $kode = $_POST['kode'];
        $judul = $_POST['judul'];
        $penulis = $_POST['penulis'];
        $penerbit = $_POST['penerbit'];
        $tahun = $_POST['tahun'];

        $update = "UPDATE tb_buku SET judul = '$judul', penulis = '$penulis', penerbit = '$penerbit', tahun = '$tahun' WHERE kode = '$kode'";
        mysqli_query($conn, $update);

        header("location:index.php");
    }
    ?>
</body>
</html>

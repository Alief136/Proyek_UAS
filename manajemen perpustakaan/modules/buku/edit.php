<?php
include '../../config/koneksi.php';

$kode_buku = $_GET['kode_buku'];
$query = "SELECT * FROM buku WHERE kode_buku = '$kode_buku'";
$result = $conn->query($query);
$data = $result->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $judul = $_POST['judul'];
    $penulis = $_POST['penulis'];
    $kategori = $_POST['kategori'];
    $tahun_terbit = $_POST['tahun_terbit'];
    $rak = $_POST['rak'];
    $stok = $_POST['stok'];

    $update_query = "UPDATE buku 
                     SET judul = '$judul', penulis = '$penulis', kategori = '$kategori', 
                         tahun_terbit = '$tahun_terbit', rak = '$rak', stok = '$stok'
                     WHERE kode_buku = '$kode_buku'";
    if ($conn->query($update_query)) {
        header('Location: index.php');
    } else {
        echo "Error: " . $conn->error;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../assets/css/style.css">
    <title>Edit Buku</title>
</head>
<body>
    <h1>Edit Buku</h1>
    <form method="POST">
        <label>Judul</label>
        <input type="text" name="judul" value="<?php echo $data['judul']; ?>" required>
        <label>Penulis</label>
        <input type="text" name="penulis" value="<?php echo $data['penulis']; ?>" required>
        <label>Kategori</label>
        <input type="text" name="kategori" value="<?php echo $data['kategori']; ?>" required>
        <label>Tahun Terbit</label>
        <input type="number" name="tahun_terbit" value="<?php echo $data['tahun_terbit']; ?>" required>
        <label>Rak</label>
        <input type="number" name="rak" min="1" max="12" value="<?php echo $data['rak']; ?>" required>
        <label>Stok</label>
        <input type="number" name="stok" value="<?php echo $data['stok']; ?>" required>
        <button type="submit">Simpan Perubahan</button>
    </form>
</body>
</html>

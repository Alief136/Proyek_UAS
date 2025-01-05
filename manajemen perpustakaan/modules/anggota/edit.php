<?php
include '../../config/koneksi.php';

$id_anggota = $_GET['id_anggota'];
$query = "SELECT * FROM anggota WHERE id_anggota = '$id_anggota'";
$result = $conn->query($query);
$data = $result->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $telepon = $_POST['telepon'];

    $update_query = "UPDATE anggota 
                     SET nama = '$nama', alamat = '$alamat', telepon = '$telepon' 
                     WHERE id_anggota = '$id_anggota'";
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
    <link rel="stylesheet" href="../../assets/css/anggota.css">
    <title>Edit Anggota</title>
</head>
<body>
    <h1>Edit Anggota</h1>
    <form method="POST">
        <label>Nama</label>
        <input type="text" name="nama" value="<?= $data['nama']; ?>" required>
        <label>Alamat</label>
        <textarea name="alamat"><?= $data['alamat']; ?></textarea>
        <label>Telepon</label>
        <input type="text" name="telepon" value="<?= $data['telepon']; ?>">
        <button type="submit">Simpan Perubahan</button>
    </form>
</body>
</html>

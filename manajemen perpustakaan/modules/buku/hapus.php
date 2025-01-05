<?php
include '../../config/koneksi.php';

if (isset($_GET['kode_buku'])) {
    $kode_buku = $_GET['kode_buku'];
    $query = "DELETE FROM buku WHERE kode_buku = '$kode_buku'";
    if ($conn->query($query)) {
        header('Location: index.php');
        exit();
    } else {
        echo "Error: " . $conn->error;
    }
} else {
    echo "Kode buku tidak ditemukan.";
}
?>

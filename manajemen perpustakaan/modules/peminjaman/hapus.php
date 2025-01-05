<?php
include '../../config/koneksi.php';

if (isset($_GET['id_peminjaman'])) {
    $id_peminjaman = $_GET['id_peminjaman'];

    $query = "DELETE FROM peminjaman WHERE id_peminjaman = '$id_peminjaman'";
    if ($conn->query($query)) {
        header('Location: index.php');
    } else {
        echo "Error: " . $conn->error;
    }
} else {
    echo "ID peminjaman tidak ditemukan.";
}
?>

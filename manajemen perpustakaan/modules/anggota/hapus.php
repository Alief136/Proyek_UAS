<?php
include '../../config/koneksi.php';

if (isset($_GET['id_anggota'])) {
    $id_anggota = $_GET['id_anggota'];
    $query = "DELETE FROM anggota WHERE id_anggota = '$id_anggota'";
    if ($conn->query($query)) {
        header('Location: index.php');
    } else {
        echo "Error: " . $conn->error;
    }
}
?>

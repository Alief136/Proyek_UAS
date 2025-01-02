<?php 
    $conn = mysqli_connect('localhost', 'root', '', 'db_perpus');
    if (!$conn) {
        die("Gagal Terhubung Ke Database: " . mysqli_connect_error());
    }
?>

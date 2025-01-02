<?php
include 'koneksi.php';

if (isset($_GET['kode'])) {
    echo "<script>
        if (confirm('Apakah Anda yakin ingin menghapus data ini?')) {
            window.location.href = 'hapus.php?confirm=true&kode=" . $_GET['kode'] . "';
        } else {
            window.location.href = 'index.php';
        }
    </script>";
}

if (isset($_GET['confirm']) && $_GET['confirm'] == 'true') {
    $hapus = mysqli_query($conn, "DELETE FROM tb_buku WHERE kode = '".$_GET['kode']."'");
    header('location:index.php');
}
?>

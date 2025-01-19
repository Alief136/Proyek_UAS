<?php
include '../../config/koneksi.php';

// Fungsi untuk ekspor ke Excel
function exportToExcel($data, $headers, $filename) {
    header("Content-Type: application/vnd.ms-excel");
    header("Content-Disposition: attachment; filename=$filename.xls");
    header("Pragma: no-cache");
    header("Expires: 0");

    $output = fopen("php://output", "w");
    // Tulis header kolom
    fputcsv($output, $headers, "\t");
    // Tulis data
    foreach ($data as $row) {
        fputcsv($output, $row, "\t");
    }
    fclose($output);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $modul = $_POST['modul'];

    // Query dan header berdasarkan modul yang dipilih
    if ($modul == 'buku') {
        $query = "SELECT kode_buku AS 'Kode Buku', judul AS 'Judul Buku', penulis AS 'Penulis', kategori AS 'Kategori', tahun_terbit AS 'Tahun Terbit', rak AS 'Rak', stok AS 'Stok' FROM buku";

        $headers = ['Kode Buku', 'Judul Buku', 'Penulis', 'Kategori', 'Tahun Terbit', 'Rak', 'Stok'];
        $filename = "Data_Buku";
    } elseif ($modul == 'anggota') {
        $query = "SELECT id_anggota AS 'ID Anggota', nama AS 'Nama', email AS 'Email', telepon AS 'Telepon' FROM anggota";
        $headers = ['ID Anggota', 'Nama', 'Email', 'Telepon'];
        $filename = "Data_Anggota";
    } elseif ($modul == 'peminjaman') {
        $query = "SELECT p.id_peminjaman AS 'ID Peminjaman', a.nama AS 'Nama Anggota', b.judul AS 'Judul Buku', 
                  p.tanggal_pinjam AS 'Tanggal Pinjam', p.tanggal_harus_kembali AS 'Tanggal Harus Kembali', 
                  p.tanggal_kembali AS 'Tanggal Kembali', p.status AS 'Status'
                  FROM peminjaman p
                  JOIN anggota a ON p.id_anggota = a.id_anggota
                  JOIN buku b ON p.id_buku = b.id_buku";
        $headers = ['ID Peminjaman', 'Nama Anggota', 'Judul Buku', 'Tanggal Pinjam', 'Tanggal Harus Kembali', 'Tanggal Kembali', 'Status'];
        $filename = "Data_Peminjaman";
    } else {
        die("Modul tidak valid!");
    }

    // Ambil data dari database
    $result = $conn->query($query);
    $data = [];
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }

    // Ekspor ke Excel
    exportToExcel($data, $headers, $filename);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../assets/css/export.css">
    <title>Export Data</title>
</head>

<body>
    <h1>Export Data</h1>
    <form method="POST">
        <label for="modul">Pilih Modul:</label>
        <select name="modul" id="modul" required>
            <option value="buku">Data Buku</option>
            <option value="anggota">Data Anggota</option>
            <option value="peminjaman">Data Peminjaman</option>
        </select>
        <br><br>
        <button type="submit">Export ke Excel</button>
    </form>
    <br>
    <a href="../../home.php">Kembali ke Home</a>
</body>
</html>

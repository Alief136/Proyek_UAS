
<?php
$servername = "localhost";
$username = "root"; // Default username untuk XAMPP
$password = "";     // Default password untuk XAMPP (kosongkan)
$dbname = "perpustakaan"; // Nama database yang sudah dibuat

// Membuat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Mengecek koneksi
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>

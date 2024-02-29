<?php
header('content-type: application/JSON');
// **Informasi database**
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "Mahasiswa";

// **Membuat koneksi**
$conn = mysqli_connect($servername, $username, $password, $dbname);

// **Memeriksa koneksi**
if (!$conn) {
  die("Koneksi gagal: " . mysqli_connect_error());
}
?>

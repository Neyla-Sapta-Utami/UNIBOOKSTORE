<?php
// Konfigurasi koneksi ke database
$host = "localhost"; // Ganti sesuai dengan host database Anda
$user = "root"; // Ganti sesuai dengan username database Anda
$pass = ""; // Ganti sesuai dengan password database Anda, jika tidak ada, biarkan kosong
$dbname = "data"; // Ganti sesuai dengan nama database Anda

// Membuat koneksi
$koneksi = mysqli_connect($host, $user, $pass, $dbname);

// Memeriksa koneksi
if (mysqli_connect_errno()) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}
?>

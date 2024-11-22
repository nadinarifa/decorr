<?php
// File: includes/db.php

$servername = "localhost";  // Nama server database (biasanya localhost)
$username = "root";         // Nama pengguna database (biasanya root untuk XAMPP)
$password = "";             // Kata sandi pengguna database (kosong jika default XAMPP)
$dbname = "db_decor";  // Nama database yang digunakan

// Membuat koneksi ke database
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Memeriksa koneksi, tampilkan error jika gagal
if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>

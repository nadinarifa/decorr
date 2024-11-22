<?php
session_start();
include('includes/db.php'); // Koneksi ke database

$userId = $_SESSION['user_id']; // ID pengguna dari session

$query = "DELETE FROM tb_keranjang WHERE id_user = '$userId'";
mysqli_query($conn, $query);

header('Location: keranjang.php'); // Redirect ke halaman keranjang setelah kosong
?>

<?php
session_start();
include 'includes/db.php'; // Include your database connection

// Pastikan user sudah login
if (!isset($_SESSION['email'])) {
    echo "Anda harus login terlebih dahulu.";
    exit();
}

$email = $_SESSION['email'];

// Ambil data dari POST request
$current_password = $_POST['current_password'];
$new_password = $_POST['new_password'];

// Validasi input
if (empty($current_password) || empty($new_password)) {
    echo "Semua kolom harus diisi.";
    exit();
}

// Periksa apakah kata sandi saat ini benar
$sql = "SELECT password FROM tb_user WHERE email = ?";
$stmt = $conn->prepare($sql);

if ($stmt === false) {
    echo "Error preparing the SQL query: " . $conn->error;
    exit();
}

$stmt->bind_param('s', $email);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();

// Verifikasi kata sandi saat ini
if (!password_verify($current_password, $row['password'])) {
    echo "Kata sandi saat ini salah.";
    exit();
}

// Hash kata sandi baru
$hashed_new_password = password_hash($new_password, PASSWORD_DEFAULT);

// Update kata sandi di database
$update_sql = "UPDATE tb_user SET password = ? WHERE email = ?";
$update_stmt = $conn->prepare($update_sql);

if ($update_stmt === false) {
    echo "Error preparing the update query: " . $conn->error;
    exit();
}

$update_stmt->bind_param('ss', $hashed_new_password, $email);
if ($update_stmt->execute()) {
    echo "Kata sandi berhasil diperbarui.";
} else {
    echo "Gagal memperbarui kata sandi. Silakan coba lagi.";
}

// Tutup statement dan koneksi
$stmt->close();
$update_stmt->close();
$conn->close();
?>

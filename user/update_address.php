<?php
session_start();
include 'includes/db.php'; // Koneksi ke database

// Pastikan pengguna sudah login
if (!isset($_SESSION['email'])) {
    echo "Gagal: Pengguna belum login.";
    exit();
}

if (isset($_POST['new_address'])) {
    $email = $_SESSION['email'];
    $alamatBaru = $_POST['new_address'];

    // Update alamat di database
    $sql = "UPDATE tb_user SET alamat = ? WHERE email = ?";
    $stmt = $conn->prepare($sql);

    if ($stmt === false) {
        die("Error preparing the SQL query: " . $conn->error);
    }

    $stmt->bind_param('ss', $alamatBaru, $email);

    if ($stmt->execute()) {
        // Update alamat di session
        $_SESSION['alamat'] = $alamatBaru;
        echo "Alamat berhasil diperbarui.";
    } else {
        echo "Gagal memperbarui alamat.";
    }

    $stmt->close();
    $conn->close();
} else {
    echo "Gagal: Data alamat tidak ditemukan.";
}
?>

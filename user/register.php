<?php
session_start();
include 'includes/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Sanitize and validate inputs
    $username = htmlspecialchars($_POST['username']);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $alamat = htmlspecialchars($_POST['alamat']);
    $nomor_telepon = htmlspecialchars($_POST['nomor_telepon']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Using password_hash as before
    $role = 'user'; // Default role

    // Validate email format
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Email tidak valid.";
        exit();
    }

    // Check if email is already taken
    $result = $conn->query("SELECT * FROM tb_user WHERE email = '$email'");
    if ($result->num_rows > 0) {
        echo "Email sudah terdaftar, silakan gunakan email lain.";
        exit();
    }

    // Prepare SQL query to insert user
    $stmt = $conn->prepare("INSERT INTO tb_user (username, email, alamat, nomor_telepon, password, role, created_at) VALUES (?, ?, ?, ?, ?, ?, NOW())");
    if ($stmt === false) {
        echo "Error preparing statement: " . $conn->error;
        exit();
    }

    $stmt->bind_param("ssssss", $username, $email, $alamat, $nomor_telepon, $password, $role);

    // Execute and check if insertion is successful
    if ($stmt->execute()) {
        echo "<script>alert('Pendaftaran berhasil! Silakan login.'); window.location.href = 'login_form.php';</script>";
        exit();
    } else {
        echo "Error: " . $stmt->error; // Print any SQL error
    }

    $stmt->close();
}

$conn->close();
?>

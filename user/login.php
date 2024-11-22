<?php 
session_start(); 
include 'includes/db.php'; // Menghubungkan ke database

if (isset($_POST['email']) && isset($_POST['password'])) {
    // Tangkap nilai email dan password
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = $_POST['password'];

    // Query untuk memeriksa apakah email cocok
    $sql = "SELECT * FROM tb_user WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email); // Bind parameter email
    $stmt->execute();
    $result = $stmt->get_result();

    // Jika ditemukan pengguna dengan email yang cocok
    if ($result->num_rows == 1) {
        $user = $result->fetch_assoc();
        
        // Verifikasi password dengan password yang di-hash
        if (password_verify($password, $user['password'])) {
            // Set sesi dengan data pengguna
            $_SESSION['username'] = $user['username'];
            $_SESSION['email'] = $user['email'];
            $_SESSION['alamat'] = $user['alamat'];
            $_SESSION['nomor_telepon'] = $user['nomor_telepon'];
            $_SESSION['role'] = $user['role']; // Menyimpan role pengguna dalam sesi

            // Redirect berdasarkan role
            if ($user['role'] == 'admin') {
                header('Location: ../admin2/index.php');
                exit();
            } else {
                header('Location: landingpage.php');
                exit();
            }
        } else {
            echo "<script>alert('Password salah!'); window.history.back();</script>";
        }
    } else {
        echo "<script>alert('Email tidak terdaftar!'); window.history.back();</script>";
    }

    $stmt->close();
}
?>

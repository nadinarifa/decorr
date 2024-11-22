<?php
// Koneksi ke database
include 'includes/db.php';

// Pastikan ada id_user yang dikirim
if (isset($_POST['id_user'])) {
    $id_user = $_POST['id_user'];

    // Query untuk menghapus user berdasarkan id_user
    $query = "DELETE FROM tb_user WHERE id_user = ?";

    // Persiapkan statement
    if ($stmt = mysqli_prepare($conn, $query)) {
        // Bind parameter
        mysqli_stmt_bind_param($stmt, "i", $id_user);

        // Eksekusi query
        if (mysqli_stmt_execute($stmt)) {
            echo 'success'; // Mengembalikan respon sukses ke AJAX atau pemanggil
        } else {
            echo 'error: ' . mysqli_error($conn); // Jika gagal menghapus, tampilkan pesan error
        }

        // Tutup statement
        mysqli_stmt_close($stmt);
    } else {
        echo 'error: ' . mysqli_error($conn); // Jika gagal mempersiapkan statement
    }
} else {
    echo 'error: ID user tidak ditentukan'; // Jika id_user tidak dikirim
}

// Tutup koneksi
mysqli_close($conn);
?>

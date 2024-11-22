<?php
// Koneksi ke database
include 'includes/db.php';

// Pastikan ada id_kategori yang dikirim
if (isset($_POST['id_kategori'])) {
    $id_kategori = $_POST['id_kategori'];

    // Query untuk menghapus kategori berdasarkan id_kategori
    $query = "DELETE FROM tb_kategori WHERE id_kategori = ?";

    // Persiapkan statement
    if ($stmt = mysqli_prepare($conn, $query)) {
        // Bind parameter
        mysqli_stmt_bind_param($stmt, "i", $id_kategori);

        // Eksekusi query
        if (mysqli_stmt_execute($stmt)) {
            echo 'success'; // Mengembalikan respon sukses ke AJAX
        } else {
            echo 'error: ' . mysqli_error($conn); // Jika gagal menghapus, kirim pesan error
        }

        // Tutup statement
        mysqli_stmt_close($stmt);
    } else {
        echo 'error: ' . mysqli_error($conn); // Jika gagal mempersiapkan statement
    }
} else {
    echo 'error: ID kategori tidak ditentukan'; // Jika id_kategori tidak dikirim
}

// Tutup koneksi
mysqli_close($conn);
?>

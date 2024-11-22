<?php
// Koneksi ke database
include 'includes/db.php';

// Pastikan ada id_produk yang dikirim
if (isset($_POST['id_produk'])) {
    $id_produk = $_POST['id_produk'];

    // Query untuk menghapus produk berdasarkan id_produk
    $query = "DELETE FROM tb_produk WHERE id_produk = ?";

    // Persiapkan statement
    if ($stmt = mysqli_prepare($conn, $query)) {
        // Bind parameter
        mysqli_stmt_bind_param($stmt, "i", $id_produk);

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
    echo 'error: ID produk tidak ditentukan'; // Jika id_produk tidak dikirim
}

// Tutup koneksi
mysqli_close($conn);
?>

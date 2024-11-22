<?php
// Koneksi ke database
include 'includes/db.php';

// Pastikan ada id_komentar yang dikirim
if (isset($_POST['id_komentar'])) {
    $id_komentar = $_POST['id_komentar'];

    // Query untuk menghapus komentar berdasarkan id_komentar
    $query = "DELETE FROM tb_komentar WHERE id_komentar = ?";

    // Persiapkan statement
    if ($stmt = mysqli_prepare($conn, $query)) {
        // Bind parameter
        mysqli_stmt_bind_param($stmt, "i", $id_komentar);

        // Eksekusi query
        if (mysqli_stmt_execute($stmt)) {
            echo 'success'; // Mengembalikan respon sukses ke AJAX
        } else {
            echo 'error'; // Jika gagal menghapus, kirim pesan error
        }

        // Tutup statement
        mysqli_stmt_close($stmt);
    }
} else {
    echo 'error'; // Jika id_komentar tidak dikirim, kirim pesan error
}

// Tutup koneksi
mysqli_close($conn);
?>

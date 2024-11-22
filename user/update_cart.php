<?php
session_start();
include('includes/db.php');

// Mengecek apakah data POST ada
if (isset($_POST['id_produk']) && isset($_POST['quantity'])) {
    $product_id = $_POST['id_produk'];
    $quantity = $_POST['quantity'];

    // Cek apakah keranjang ada di session
    if (isset($_SESSION['keranjang'][$user_id][$product_id])) {
        // Perbarui kuantitas produk
        $_SESSION['keranjang'][$user_id][$product_id]['quantity'] = $quantity;

        // Kembalikan data keranjang yang diperbarui
        echo json_encode($_SESSION['keranjang'][$user_id]);
    } else {
        echo "Produk tidak ditemukan di keranjang.";
    }
} else {
    echo "Data tidak valid.";
}
?>

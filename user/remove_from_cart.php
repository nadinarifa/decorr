<?php
session_start();

if (isset($_GET['id'])) {
    $product_id = $_GET['id'];

    // Mencari dan menghapus produk dari keranjang
    foreach ($_SESSION['cart'] as $key => $item) {
        if ($item['id'] == $product_id) {
            unset($_SESSION['cart'][$key]);
            break;
        }
    }

    // Menyegarkan keranjang setelah produk dihapus
    header('Location: keranjang.php');
    exit;
}
?>

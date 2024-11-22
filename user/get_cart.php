<?php
session_start();

// Cek apakah keranjang ada dalam session
if (isset($_SESSION['keranjang'])) {
    $cart = $_SESSION['keranjang'];
    $response = [
        "status" => "success",
        "cart" => []
    ];

    // Mengonversi data keranjang menjadi format yang sesuai
    foreach ($cart as $id => $item) {
        $response['cart'][$id] = [
            'name' => $item['name'],
            'price' => $item['price'],
            'quantity' => $item['quantity'],
            'image' => $item['image']
        ];
    }

    // Kirim data keranjang sebagai JSON
    echo json_encode($response);
} else {
    // Jika tidak ada keranjang
    echo json_encode(["status" => "error", "message" => "Keranjang kosong."]);
}
?>

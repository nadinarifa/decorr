<?php
session_start();
include('includes/db.php');

// Pastikan user login
if (!isset($_SESSION['email'])) {
    echo "Harap login terlebih dahulu.";
    exit;
}

$email = $_SESSION['email']; // Ambil email dari session

// Ambil data user berdasarkan email
$sql_user = "SELECT id_user FROM tb_user WHERE email = ?";
$stmt_user = $conn->prepare($sql_user);
$stmt_user->bind_param("s", $email);
$stmt_user->execute();
$result_user = $stmt_user->get_result();
$user = $result_user->fetch_assoc();
$user_id = $user['id_user']; // Ambil ID user berdasarkan email

// Ambil produk yang ditambahkan ke keranjang
if (isset($_POST['id_produk']) && isset($_POST['quantity'])) {
    $id_produk = $_POST['id_produk'];
    $quantity = $_POST['quantity'];

    // Ambil data produk dari database
    $sql_produk = "SELECT * FROM tb_produk WHERE id_produk = ?";
    $stmt_produk = $conn->prepare($sql_produk);
    $stmt_produk->bind_param("i", $id_produk);
    $stmt_produk->execute();
    $result_produk = $stmt_produk->get_result();

    if ($result_produk->num_rows > 0) {
        $produk = $result_produk->fetch_assoc();

        // Tambahkan produk ke keranjang
        if (!isset($_SESSION['keranjang'][$user_id])) {
            $_SESSION['keranjang'][$user_id] = [];
        }

        $keranjang = $_SESSION['keranjang'][$user_id];

        // Cek jika produk sudah ada dalam keranjang
        $found = false;
        foreach ($keranjang as &$item) {
            if ($item['id_produk'] == $id_produk) {
                $item['quantity'] += $quantity; // Update quantity jika produk sudah ada
                $found = true;
                break;
            }
        }

        // Jika produk belum ada di keranjang, tambahkan
        if (!$found) {
            $_SESSION['keranjang'][$user_id][] = [
                'id_produk' => $produk['id_produk'],
                'nama_produk' => $produk['nama_produk'],
                'harga' => $produk['harga'],
                'quantity' => $quantity,
                'foto_produk' => $produk['foto_produk']
            ];
        }

        echo "Produk berhasil ditambahkan ke keranjang!";
    } else {
        echo "Produk tidak ditemukan.";
    }

    $stmt_produk->close();
}

$conn->close();
?>

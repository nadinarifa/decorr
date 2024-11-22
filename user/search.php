<?php
// search.php
$searchQuery = $_GET['query'];
$conn = new mysqli('localhost', 'username', 'password', 'db_d-ecor');

$sql = "SELECT * FROM tb_produk WHERE nama_produk LIKE ?";
$stmt = $conn->prepare($sql);
$searchTerm = '%' . $searchQuery . '%';
$stmt->bind_param('s', $searchTerm);
$stmt->execute();
$result = $stmt->get_result();

while ($row = $result->fetch_assoc()) {
    echo '<div class="product-wrap">';
    echo '<h3>' . $row['nama_produk'] . '</h3>';
    // Tambahkan tampilan produk sesuai hasil pencarian
    echo '</div>';
}
?>

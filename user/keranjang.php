<?php
session_start();
include('includes/db.php'); // Mengimpor koneksi database

// Mengecek apakah pengguna sudah login
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];

    // Ambil data keranjang dari session
    $cart = isset($_SESSION['keranjang'][$user_id]) ? $_SESSION['keranjang'][$user_id] : [];

    // Menampilkan tabel keranjang
    echo '<table class="cart-table">
            <thead>
                <tr>
                    <th class="product-thumbnail">Gambar</th>
                    <th class="product-name">Nama Produk</th>
                    <th class="product-cart-price">Harga</th>
                    <th class="cart-quality">Kuantitas</th>
                    <th class="product-total">Total</th>
                    <th class="product-remove">Hapus</th>
                </tr>
            </thead>
            <tbody>';

    foreach ($cart as $product) {
        $itemTotal = $product['harga'] * $product['quantity'];
        echo '<tr>
                <td class="product-thumbnail"><img src="' . $product['foto_produk'] . '" alt="' . $product['nama_produk'] . '"></td>
                <td class="product-name">' . $product['nama_produk'] . '</td>
                <td class="product-cart-price">Rp' . number_format($product['harga'], 0, ',', '.') . '</td>
                <td class="cart-quality">' . $product['quantity'] . '</td>
                <td class="product-total">Rp' . number_format($itemTotal, 0, ',', '.') . '</td>
                <td class="product-remove"><a href="#">Hapus</a></td>
              </tr>';
    }

    echo '</tbody></table>';
}
?>



<!DOCTYPE html>
<html lang="zxx">


<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>eCommerce Décor</title>
    <meta name="robots" content="noindex, follow" />
    <meta name="description"
        content="SayyamCode eCommerce Bootstrap 5 Template is a stunning eCommerce website template that is the best choice for any online store.">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <link rel="canonical" href="#" />

    <!-- Open Graph (OG) meta tags are snippets of code that control how URLs are displayed when shared on social media  -->
    <meta property="og:locale" content="en_US" />
    <meta property="og:type" content="website" />
    <meta property="og:title" content="sayyamcode eCommerce HTML Template" />
    <meta property="og:url" content="#" />
    <meta property="og:site_name" content="sayyamcode eCommerce HTML Template" />
    <!-- For the og:image content, replace the # with a link of an image -->
    <meta property="og:image" content="#" />
    <meta property="og:description"
        content="SayyamCode eCommerce Bootstrap 5 Template is a stunning eCommerce website template that is the best choice for any online store." />
    <!-- Add site Favicon -->
    <link rel="icon" href="assets/pic/logo/icon_32x32.png" sizes="32x32" />
    <link rel="icon" href="assets/pic/logo/icon_192x192.png" sizes="192x192" />
    <link rel="apple-touch-icon" href="assets/pic/logo/icon_180x180.png" />
    <meta name="msapplication-TileImage" content="assets/pic/logo/icon_270x270.png" />
    <!-- All CSS is here
    ============================================ -->
    <link rel="stylesheet" href="assets/css/vendor/bootstrap.min.css" />
    <link rel="stylesheet" href="assets/css/vendor/pe-icon-7-stroke.css" />
    <link rel="stylesheet" href="assets/css/vendor/themify-icons.css" />
    <link rel="stylesheet" href="assets/css/vendor/font-awesome.min.css" />
    <link rel="stylesheet" href="assets/css/plugins/animate.css" />
    <link rel="stylesheet" href="assets/css/plugins/aos.css" />
    <link rel="stylesheet" href="assets/css/plugins/magnific-popup.css" />
    <link rel="stylesheet" href="assets/css/plugins/swiper.min.css" />
    <link rel="stylesheet" href="assets/css/plugins/jquery-ui.css" />
    <link rel="stylesheet" href="assets/css/plugins/nice-select.css" />
    <link rel="stylesheet" href="assets/css/plugins/select2.min.css" />
    <link rel="stylesheet" href="assets/css/plugins/easyzoom.css" />
    <link rel="stylesheet" href="assets/css/plugins/slinky.css" />
    <link rel="stylesheet" href="assets/css/style.css" />
</head>
<style>
    /* Mengatur font dan ukuran untuk heading */
    h2,
    h3 {
        font-family: 'Poppins', sans-serif;
        font-size: 24px;
        /* Ukuran font seragam */
        font-weight: 600;
    }
</style>




<body>
    <div class="header-bottom sticky-bar">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-3 col-md-6 col-6">
                    <div class="logo-container">
                        <img src="assets/pic/logo/logo.png" alt="Logo" class="logo">
                    </div>
                </div>
                <div class="col-lg-6 d-none d-lg-block">
                    <div class="main-menu text-center">
                        <nav>
                            <ul>
                                <li><a href="landingpage.php">HOME</a></li>

                                <li><a href="#">FURNITUR</a>
                                    <ul class="sub-menu-style">
                                        <li><a href="shop-sofas.php">Sofa </a></li>
                                        <li><a href="shop-armchair.php">Kursi</a></li>
                                        <li><a href="shop-sidetable.php">Meja</a></li>
                                    </ul>
                                </li>
                                <li><a href="about-us.php">TENTANG</a></li>
                                <li><a href="contact-us.php">HUBUNGI KAMI</a></li>
                            </ul>
                        </nav>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-6">
                    <div class="header-action-wrap">
                        <div class="header-action-style header-search-1">
                            <a class="search-toggle" href="#">
                                <i class="pe-7s-search s-open"></i>
                                <i class="pe-7s-close s-close"></i>
                            </a>
                            <div class="search-wrap-1">
                                <form action="#">
                                    <input placeholder="Search products…" type="text">
                                    <button class="button-search"><i class="pe-7s-search"></i></button>
                                </form>
                            </div>
                        </div>
                        <div class="header-action-style">
                            <?php
                            // Periksa apakah pengguna sudah login
                            if (isset($_SESSION['email'])) {
                                // Jika sudah login, arahkan ke halaman profile.php
                                echo '<a title="Profile" href="profile.php"><i class="pe-7s-user"></i></a>';
                            } else {
                                // Jika belum login, arahkan ke halaman register.php
                                echo '<a title="Login/Register" href="register_form.php"><i class="pe-7s-user"></i></a>';
                            }
                            ?>
                        </div>


                        <div class="header-action-style d-block d-lg-none">
                            <a class="mobile-menu-active-button" href="#"><i class="pe-7s-menu"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </header>

    <br><br><br><br>

    <div class="container">
        <div class="about-us-title">
            <h2>Keranjang</h2>
        </div>
    </div>

    <!-- Tabel Keranjang -->
    <div class="cart-area pt-100 pb-100">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="cart-table-content">
                        <div class="table-content table-responsive">
                            <table>
                                <thead>
                                    <tr>
                                        <th class="width-thumbnail">Gambar</th>
                                        <th class="width-name">Nama Produk</th>
                                        <th class="width-price">Harga</th>
                                        <th class="width-quantity">Jumlah</th>
                                        <th class="width-subtotal">Subtotal</th>
                                        <th class="width-remove">Batal</th>
                                    </tr>
                                </thead>
                                <tbody id="cart-items">
                                    <!-- Produk akan diisi secara dinamis -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="cart-shiping-update-wrapper">
                                <div class="cart-shiping-update btn-hover">
                                    <a href="landingpage.php">Lanjut Belanja</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-4 col-md-6 col-12">
                            <div class="grand-total-wrap">
                                <div class="grand-total-content">
                                    <h3>Total <span id="total-price">Rp 0</span></h3>
                                </div>
                                <div class="grand-total-btn btn-hover">
                                    <a class="btn theme-color" href="checkout.php">Lanjut</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <footer class="footer-area">
        <footer class="footer-area">
            <div class="bg-gray-2">
                <div class="container">
                    <div class="footer-top pt-40 pb-20"> <!-- Ukuran footer kecil -->
                        <div class="row justify-content-center">
                            <div class="col-lg-4 col-md-6 col-sm-6 col-12 mb-30 text-left">
                                <!-- Teks rata kiri -->
                                <div class="footer-widget footer-about">
                                    <p>Kami di <strong>Décor</strong> berkomitmen untuk menghadirkan
                                        sentuhan estetika
                                        terbaik di setiap sudut ruang Anda. Bersama-sama, kita membuat
                                        rumah lebih dari
                                        sekadar tempat tinggal — sebuah ekspresi diri.</p>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6 col-sm-6 col-12 mb-30 text-left">
                                <!-- Teks rata kiri -->
                                <div class="footer-widget footer-list">
                                    <h3 class="footer-title">Informasi</h3>
                                    <ul>
                                        <li><a href="about-us.php">Tentang</a></li>
                                        <li><a href="#">Furnitur</a></li>
                                        <li><a href="my-account.php">Akun</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-6 col-12 mb-30 text-left">
                                <!-- Teks rata kiri -->
                                <div class="footer-widget footer-address">
                                    <h3 class="footer-title">Hubungi Kami</h3>
                                    <ul>
                                        <li><span>Alamat: </span>Lorem ipsum dolor sit amet</li>
                                        <li><span>Telepon: </span>(62) 895395172037</li>
                                        <li><span>Email: </span><a href="mailto:decor@gmail.com">decor@gmail.com</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="bg-gray-3">
                        <div class="container">
                            <div class="footer-bottom copyright text-center bg-gray-3">
                                <hr class="footer-divider">
                                <div class="footer-bottom text-center">
                                    <p>&copy; 2024 Décor. Semua Hak Dilindungi.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </footer>

        <!-- Mobile Menu start -->
        <div class="off-canvas-active">
            <a class="off-canvas-close"><i class=" ti-close "></i></a>
            <div class="off-canvas-wrap">
                <div class="welcome-text off-canvas-margin-padding">
                    <p>Décor Furnitur! </p>
                </div>
                <div class="mobile-menu-wrap off-canvas-margin-padding-2">
                    <div id="mobile-menu" class="slinky-mobile-menu text-left">
                        <ul>
                            <li>
                                <a href="landingpage.php">HOME</a>
                            </li>
                            <li>
                                <a href="#">FURNITUR</a>
                                <ul>
                                    <li><a href="shop-sofas.php">Sofa</a></li>
                                    <li><a href="shop-armchair.php">Kursi</a></li>
                                    <li><a href="shop-sidetable.php">Meja</a></li>
                                </ul>
                            <li>
                                <a href="about-us.php">TENTANG</a>
                            </li>
                            <li>
                                <a href="contact-us.php">HUBUNGI KAMI</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        </div>
        </div>
        <!-- All JS is here -->
        <script src="assets/js/vendor/modernizr-3.11.7.min.js"></script>
        <script src="assets/js/vendor/jquery-3.6.0.min.js"></script>
        <script src="assets/js/vendor/jquery-migrate-3.3.2.min.js"></script>
        <script src="assets/js/vendor/popper.min.js"></script>
        <script src="assets/js/vendor/bootstrap.min.js"></script>
        <script src="assets/js/plugins/wow.js"></script>
        <script src="assets/js/plugins/scrollup.js"></script>
        <script src="assets/js/plugins/aos.js"></script>
        <script src="assets/js/plugins/magnific-popup.js"></script>
        <script src="assets/js/plugins/jquery.syotimer.min.js"></script>
        <script src="assets/js/plugins/swiper.min.js"></script>
        <script src="assets/js/plugins/imagesloaded.pkgd.min.js"></script>
        <script src="assets/js/plugins/isotope.pkgd.min.js"></script>
        <script src="assets/js/plugins/jquery-ui.js"></script>
        <script src="assets/js/plugins/jquery-ui-touch-punch.js"></script>
        <script src="assets/js/plugins/jquery.nice-select.min.js"></script>
        <script src="assets/js/plugins/waypoints.min.js"></script>
        <script src="assets/js/plugins/jquery.counterup.js"></script>
        <script src="assets/js/plugins/select2.min.js"></script>
        <script src="assets/js/plugins/easyzoom.js"></script>
        <script src="assets/js/plugins/slinky.min.js"></script>
        <script src="assets/js/plugins/ajax-mail.js"></script>
        <!-- Main JS -->
        <script src="assets/js/main.js"></script>
        <script src="assets/js/cart.js"></script>

        <script>
            document.addEventListener('DOMContentLoaded', function () {
                // Ambil data keranjang dari sessionStorage
                const cart = JSON.parse(sessionStorage.getItem('cart')) || [];
                let total = 0;
                const cartItemsContainer = document.getElementById('cart-items');
                const totalPriceContainer = document.getElementById('total-price');

                if (cart.length > 0) {
                    cart.forEach(item => {
                        const subtotal = item.price * item.quantity;
                        total += subtotal;

                        // Buat elemen row untuk setiap item dalam keranjang
                        const row = document.createElement('tr');
                        row.innerHTML = `
                <td class="product-thumbnail">
                    <a href="#"><img src="${item.image}" alt="${item.name}" style="width: 100px;"></a>
                </td>
                <td class="product-name">
                    <h5><a href="#">${item.name}</a></h5>
                </td>
                <td class="product-cart-price">
                    <span class="amount">Rp${item.price.toLocaleString()}</span>
                </td>
                <td class="cart-quality">
                    <div class="product-quality">
                        <input class="cart-plus-minus-box input-text qty text" 
                               value="${item.quantity}" 
                               type="number" min="1"
                               onchange="updateCart(${item.id}, this.value)">
                    </div>
                </td>
                <td class="product-total">
                    <span>Rp${subtotal.toLocaleString()}</span>
                </td>
                <td class="product-remove">
                    <a href="#" onclick="removeFromCart(${item.id})"><i class="ti-trash"></i></a>
                </td>
            `;
                        cartItemsContainer.appendChild(row);
                    });

                    // Tampilkan total harga keranjang
                    totalPriceContainer.innerText = `Rp${total.toLocaleString()}`;
                } else {
                    cartItemsContainer.innerHTML = '<tr><td colspan="6" class="text-center">Keranjang Anda kosong.</td></tr>';
                }
            });

            // Fungsi untuk menghapus produk dari keranjang
            function removeFromCart(productId) {
                let cart = JSON.parse(sessionStorage.getItem('cart')) || [];
                cart = cart.filter(item => item.id !== productId);
                sessionStorage.setItem('cart', JSON.stringify(cart));
                location.reload();  // Refresh halaman setelah perubahan
            }

            // Fungsi untuk memperbarui kuantitas produk dalam keranjang
            function updateCart(productId, quantity) {
                let cart = JSON.parse(sessionStorage.getItem('cart')) || [];
                cart = cart.map(item => {
                    if (item.id === productId) {
                        item.quantity = parseInt(quantity);
                    }
                    return item;
                });
                sessionStorage.setItem('cart', JSON.stringify(cart));
                location.reload();  // Refresh halaman setelah perubahan
            }

        </script>
</body>


</html>
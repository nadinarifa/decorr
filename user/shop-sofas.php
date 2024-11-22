<?php
include 'includes/db.php';

// ID kategori untuk Sofa
$id_kategori_sofa = 1; // ID kategori Sofa

// Query untuk menghitung jumlah produk di kategori Sofa
$sql_count = "SELECT COUNT(*) AS total_produk FROM tb_produk WHERE id_kategori = $id_kategori_sofa";
$result_count = $conn->query($sql_count);
$row_count = $result_count->fetch_assoc();

// Menyimpan jumlah produk dalam variabel $total_produk
$total_produk = $row_count['total_produk'];

// Query untuk menampilkan produk dalam kategori Sofa
$sql = "SELECT * FROM tb_produk WHERE id_kategori = $id_kategori_sofa";
$result = $conn->query($sql);

$products = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $nama_produk_singkat = str_replace(' Sofa', '', $row['nama_produk']);

        // Menambahkan informasi diskon dan jalur gambar
        $diskon = isset($row['diskon']) && $row['diskon'] > 0 ? $row['diskon'] : null;

        // Pastikan foto_produk ada
        $foto_produk = !empty($row['foto_produk']) ? 'uploads/pic/' . $row['foto_produk'] : 'uploads/pic/default.jpg';

        $products[] = [
            'id_produk' => $row['id_produk'],
            'nama_produk' => $row['nama_produk'],
            'nama_produk_singkat' => $nama_produk_singkat,
            'foto_produk' => $foto_produk,
            'harga' => $row['harga'],
            'diskon' => $diskon
        ];
    }
}

$conn->close();
?>


<!DOCTYPE html>
<html lang="zxx">


<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>eCommerce Décor</title>
    <meta name="robots" content="noindex, follow" />
    <meta name="description" content="Décor">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <link rel="canonical" href="#" />

    <!-- Open Graph (OG) meta tags are snippets of code that control how URLs are displayed when shared on social media  -->
    <meta property="og:locale" content="en_US" />
    <meta property="og:type" content="website" />
    <meta property="og:title" content="Décor" />
    <meta property="og:url" content="#" />
    <meta property="og:site_name" content="Décor" />
    <!-- For the og:image content, replace the # with a link of an image -->
    <meta property="og:image" content="#" />
    <meta property="og:description" content="Décor" />
    <!-- Add site Favicon -->
    <link rel="icon" href="assets/pic/logo/icon.png" sizes="32x32" />
    <link rel="icon" href="assets/pic/logo/icon.png" sizes="192x192" />
    <link rel="apple-touch-icon" href="assets/pic/logo/icon_192x192.png" />
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
                        <div class="header-action-style header-action-cart">
                            <a class="cart-active" href="javascript:void(0)" onclick="toggleCart()">
                                <i class="pe-7s-shopbag"></i>
                                <span class="product-count bg-black" id="cart-count">0</span>
                            </a>
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
    <!-- mini cart start -->
    <div class="sidebar-cart-active" id="mini-cart" style="display: none;">
        <div class="sidebar-cart-all">
            <a class="cart-close" href="javascript:void(0)" onclick="toggleCart()">
                <i class="pe-7s-close"></i>
            </a>
            <div class="cart-content">
                <h3>Keranjang Belanja</h3>
                <ul id="cart-items">
                    <!-- Produk yang ditambahkan akan muncul di sini -->
                </ul>
                <div id="no-products-message" style="display: none;">
                    <li>Produk tidak ada</li>
                </div>
                <div class="cart-total">
                    <h4>Subtotal: <span id="cart-subtotal">Rp0</span></h4>
                </div>
                <div class="checkout-btn btn-hover">
                    <a class="theme-color" href="checkout.php">Beli</a>
                </div>
                <div class="checkout-btn btn-hover">
                    <a class="theme-color" href="Keranjang.php">Lihat keranjang</a>
                </div>
            </div>
        </div>
    </div>
    <!-- mini cart end -->

    <div class="shop-area pt-100 pb-100">
        <div class="container">
            <div class="row flex-row-reverse">
                <div class="col-12">
                    <div class="content-breadcrumb">
                        <div><a href="landingpage.php" class="content-item">Home</a></div>
                        <span class="separator">/</span>
                        <div class="content-item-active">Sofa</div>
                    </div>
                    <br><br>
                    <section class="content">
                        <hr><br>
                        <!-- Menampilkan jumlah produk di kategori Sofa -->
                        <p>Menampilkan semua <?php echo $total_produk; ?> hasil</p>
                    </section>
                </div>
            </div>
            <br>
            <div class="shop-bottom-area">
                <div class="tab-content jump">
                    <div id="shop-1" class="tab-pane active">
                        <div class="row">
                            <?php foreach ($products as $product): ?>
                                <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                                    <div class="product-wrap mb-35" data-aos="fade-up" data-aos-delay="400">
                                        <div class="product-img img-zoom mb-25">
                                            <a
                                                href="detail-sofa-<?php echo strtolower(str_replace(' ', '-', $product['nama_produk_singkat'])); ?>.php">
                                                <img src="<?php echo $product['foto_produk']; ?>"
                                                    alt="<?php echo htmlspecialchars($product['nama_produk']); ?>">
                                            </a>
                                            <?php if ($product['diskon']): ?>
                                                <div class="product-badge badge-top badge-right badge-pink">
                                                    <span>-<?php echo $product['diskon']; ?>%</span>
                                                </div>
                                            <?php endif; ?>
                                            <div class="product-action-wrap">
                                                <a href="detail-sofa-<?php echo strtolower(str_replace(' ', '-', $product['nama_produk_singkat'])); ?>.php"
                                                    class="product-action-btn-1">
                                                    <i class="pe-7s-look"></i>
                                                </a>
                                            </div>
                                            <div class="product-action-2-wrap">
                                                <button class="product-action-btn-2" title="Add To Cart"
                                                    data-id="<?php echo $product['id_produk']; ?>"
                                                    data-name="<?php echo htmlspecialchars($product['nama_produk']); ?>"
                                                    data-price="<?php echo number_format($product['harga'], 2, '.', ''); ?>"
                                                    data-image="<?php echo $product['foto_produk']; ?>"
                                                    data-discount="<?php echo isset($product['diskon']) ? $product['diskon'] : 0; ?>"
                                                    onclick="handleAddToCart(this)">
                                                    <i class="pe-7s-cart"></i> Tambah ke keranjang
                                                </button>
                                            </div>
                                        </div>
                                        <div class="product-content">
                                            <h3><a
                                                    href="detail-sofa-<?php echo strtolower(str_replace(' ', '-', $product['nama_produk_singkat'])); ?>.php">
                                                    <?php echo $product['nama_produk']; ?>
                                                </a></h3>
                                            <div class="product-price">
                                                <?php if ($product['diskon']): ?>
                                                    <span class="old-price">
                                                        Rp<?php echo number_format($product['harga'], 0, ',', '.'); ?>
                                                    </span>
                                                    <span class="new-price">
                                                        Rp<?php echo number_format($product['harga'] - ($product['harga'] * $product['diskon'] / 100), 0, ',', '.'); ?>
                                                    </span>
                                                <?php else: ?>
                                                    <span class="regular-price">
                                                        Rp<?php echo number_format($product['harga'], 0, ',', '.'); ?>
                                                    </span>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <footer class="footer-area">
        <div class="bg-gray-2">
            <div class="container">
                <div class="footer-top pt-40 pb-20"> <!-- Ukuran footer kecil -->
                    <div class="row justify-content-center">
                        <div class="col-lg-4 col-md-6 col-sm-6 col-12 mb-30 text-left">
                            <!-- Teks rata kiri -->
                            <div class="footer-widget footer-about">
                                <p>Kami di <strong>Décor</strong> berkomitmen untuk
                                    menghadirkan
                                    sentuhan estetika
                                    terbaik di setiap sudut ruang Anda. Bersama-sama, kita
                                    membuat rumah
                                    lebih dari
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

</body>


</html>
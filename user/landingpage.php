<?php
session_start(); // Panggil ini di baris pertama file PHP

// Kode PHP lainnya
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

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">



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
                        <!-- Search Bar -->
                        <div class="header-action-style header-search-1">
                            <a class="search-toggle" href="#" onclick="toggleSearch()">
                                <i class="pe-7s-search s-open"></i>
                                <i class="pe-7s-close s-close"></i>
                            </a>
                            <div class="search-wrap-1" style="display: none;">
                                <form id="customSearchForm" action="#">
                                    <input id="customSearchInput" placeholder="Cari Produk..." type="text">
                                    <button class="button-search" type="submit"><i class="pe-7s-search"></i></button>
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
                            <a class="cart-active" href="#" onclick="toggleCart()">
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
                    <a class="theme-color" href="keranjang.php">Lihat keranjang</a>
                </div>
            </div>
        </div>
    </div>



    <div class="big-bg" style="background-image:url(assets/pic/Banner/banner-home.png)">
        <div class="bg-content">
            <h1>Kualitas adalah hal terbaik <br> dalam bisnis </h1>
            <hr>
            <div class="bg-content">
                <p style="color: white;">
                    Kami membuat produk kami dalam bentuk terbaik demi kebahagiaan Anda, <br>
                    jadi kami berharap dapat membangun jembatan kepercayaan dengan Anda.
                </p>
                <div class="slider-btn-2 btn-hover">
                    <a href="#" class="btn hover-border-radius theme-color animated">
                        Beli Sekarang
                    </a>
                </div>
            </div>
        </div>
    </div>
    </br></br></br></br>
    <div class="service-area">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="service-wrap-2 text-center mb-30" data-aos="fade-up" data-aos-delay="200">
                        <div class="service-img-2">
                            <img src="assets/images/icon-img/car.png" alt="Free Shipping">
                        </div>
                        <div class="service-content-2">
                            <h3>Gratis Ongkir</h3>
                            <p>Gratis Ongkir untuk setiap pembelian</p>
                            <p>dengan jarak pengiriman dekat.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="service-wrap-2 text-center mb-30" data-aos="fade-up" data-aos-delay="400">
                        <div class="service-img-2">
                            <img src="assets/images/icon-img/time.png" alt="Support 24/7">
                        </div>
                        <div class="service-content-2">
                            <h3>Support 24/7</h3>
                            <p>Support 24 jam sehari.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="service-wrap-2 text-center mb-30" data-aos="fade-up" data-aos-delay="800">
                        <div class="service-img-2">
                            <img src="assets/images/icon-img/discount.png" alt="Order Discount">
                        </div>
                        <div class="service-content-2">
                            <h3>Diskon</h3>
                            <p>Berlaku untuk produk tertentu</p>
                            <p>ditandai dengan label diskon.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </br></br>
    <div class="product-area pb-95">
        <div class="container">
            <div class="section-border section-border-margin-1" data-aos="fade-up" data-aos-delay="200">
                <div class="section-title-timer-wrap bg-white">
                    <div class="section-title-1">
                        <h2>Penawaran Hari Ini</h2>
                    </div>
                </div>
            </div>


            <div class="product-slider-active-1 swiper-container">
                <div class="swiper-wrapper">
                    <!-- Produk Pertama -->
                    <div class="swiper-slide">
                        <div class="product-wrap" data-aos="fade-up" data-aos-delay="200">
                            <div class="product-img img-zoom mb-25">
                                <a href="detail-kursi-arjuna.php">
                                    <img src="assets/pic/Arm_chair/Kursi_Arjuna.png" alt="Kursi Arjuna">
                                </a>
                                <div class="product-badge badge-top badge-right badge-pink">
                                    <span>-15%</span>
                                </div>
                                <div class="product-action-wrap">
                                    <a href="detail-kursi-arjuna.php" class="product-action-btn-1">
                                        <i class="pe-7s-look"></i>
                                    </a>
                                </div>
                                <div class="product-action-2-wrap">
                                    <button class="product-action-btn-2" title="Add To Cart" data-id="1"
                                        data-name="Kursi Arjuna" data-price="3400000"
                                        data-image="assets/pic/Arm_chair/Kursi_Arjuna.png"
                                        onclick="handleAddToCart(this)">
                                        <i class="pe-7s-cart"></i> Tambah ke keranjang
                                    </button>
                                </div>
                            </div>
                            <div class="product-content">
                                <h3><a href="detail-kursi-arjuna.php">Kursi Arjuna</a></h3>
                                <div class="product-price">
                                    <span class="old-price">Rp4,000,000</span>
                                    <span class="new-price">Rp3,400,000</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Produk Kedua -->
                    <div class="swiper-slide">
                        <div class="product-wrap" data-aos="fade-up" data-aos-delay="400">
                            <div class="product-img img-zoom mb-25">
                                <a href="detail-meja-vintage.php">
                                    <img src="assets/pic/Side_table/meja_vintage.png" alt="Meja Vintage">
                                </a>
                                <div class="product-action-wrap">
                                    <a href="detail-meja-vintage.php" class="product-action-btn-1">
                                        <i class="pe-7s-look"></i>
                                    </a>
                                </div>
                                <div class="product-action-2-wrap">
                                    <button class="product-action-btn-2" title="Add To Cart" data-id="2"
                                        data-name="Meja Vintage" data-price="2500000"
                                        data-image="assets/pic/Side_table/meja_vintage.png"
                                        onclick="handleAddToCart(this)">
                                        <i class="pe-7s-cart"></i> Tambah ke keranjang
                                    </button>
                                </div>
                            </div>
                            <div class="product-content">
                                <h3><a href="detail-meja-vintage.php">Meja Vintage</a></h3>
                                <div class="product-price">
                                    <span>Rp2,500,000</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Produk Ketiga -->
                    <div class="swiper-slide">
                        <div class="product-wrap" data-aos="fade-up" data-aos-delay="800">
                            <div class="product-img img-zoom mb-25">
                                <a href="product-details.php">
                                    <img src="assets/pic/Arm_chair/Kursi_Jade.png" alt="Kursi Jade">
                                </a>
                                <div class="product-badge badge-top badge-right badge-pink">
                                    <span>-10%</span>
                                </div>
                                <div class="product-action-wrap">
                                    <button class="product-action-btn-1" title="Quick View" data-bs-toggle="modal"
                                        data-bs-target="#exampleModal">
                                        <i class="pe-7s-look"></i>
                                    </button>
                                </div>
                                <div class="product-action-2-wrap">
                                    <button class="product-action-btn-2" title="Add To Cart" data-id="3"
                                        data-name="Kursi Jade" data-price="3582000"
                                        data-image="assets/pic/Arm_chair/Kursi_Jade.png"
                                        onclick="handleAddToCart(this)">
                                        <i class="pe-7s-cart"></i> Tambah ke keranjang
                                    </button>
                                </div>
                            </div>
                            <div class="product-content">
                                <h3><a href="product-details.php">Kursi Jade</a></h3>
                                <div class="product-price">
                                    <span class="old-price">Rp3,980,000</span>
                                    <span class="new-price">Rp3,582,000</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Produk Keempat -->
                    <div class="swiper-slide">
                        <div class="product-wrap" data-aos="fade-up" data-aos-delay="800">
                            <div class="product-img img-zoom mb-25">
                                <a href="detail-meja-silinder.php">
                                    <img src="assets/pic/Side_table/meja_aksen_silinder.png" alt="Meja Aksen Silinder">
                                </a>
                                <div class="product-action-wrap">
                                    <a href="detail-meja-silinder.php" class="product-action-btn-1">
                                        <i class="pe-7s-look"></i>
                                    </a>
                                </div>
                                <div class="product-action-2-wrap">
                                    <button class="product-action-btn-2" title="Add To Cart" data-id="4"
                                        data-name="Meja Aksen Silinder" data-price="1670000"
                                        data-image="assets/pic/Side_table/meja_aksen_silinder.png"
                                        onclick="handleAddToCart(this)">
                                        <i class="pe-7s-cart"></i> Tambah ke keranjang
                                    </button>
                                </div>
                            </div>
                            <div class="product-content">
                                <h3><a href="detail-meja-silinder.php">Meja Aksen Silinder</a></h3>
                                <div class="product-price">
                                    <span>Rp1,670,000</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Produk Kelima -->
                    <div class="swiper-slide">
                        <div class="product-wrap" data-aos="fade-up" data-aos-delay="1200">
                            <div class="product-img img-zoom mb-25">
                                <a href="detail-kursi-junot.php">
                                    <img src="assets/pic/Arm_chair/Kursi_Junot.png" alt="Kursi Junot">
                                </a>
                                <div class="product-action-wrap">
                                    <a href="detail-kursi-junot.php" class="product-action-btn-1">
                                        <i class="pe-7s-look"></i>
                                    </a>
                                </div>
                                <div class="product-action-2-wrap">
                                    <button class="product-action-btn-2" title="Add To Cart" data-id="5"
                                        data-name="Kursi Junot" data-price="3942000"
                                        data-image="assets/pic/Arm_chair/Kursi_Junot.png"
                                        onclick="handleAddToCart(this)">
                                        <i class="pe-7s-cart"></i> Tambah ke keranjang
                                    </button>
                                </div>
                            </div>
                            <div class="product-content">
                                <h3><a href="detail-kursi-junot.php">Kursi Junot</a></h3>
                                <div class="product-price">
                                    <span class="old-price">Rp4,380,000</span>
                                    <span class="new-price">Rp3,942,000</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Navigasi Slider -->
                <div class="product-prev-1 product-nav-1" data-aos="fade-up" data-aos-delay="200">
                    <i class="fa fa-angle-left"></i>
                </div>
                <div class="product-next-1 product-nav-1" data-aos="fade-up" data-aos-delay="200">
                    <i class="fa fa-angle-right"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="product-area pb-95">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <div class="home-single-product-img" data-aos="fade-up" data-aos-delay="200">
                        <a href="detail-sofa-fayhimi.html"><img src="assets/pic/sofas/Single-product.png" alt=""></a>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="home-single-product-content">
                        <h2 data-aos="fade-up" data-aos-delay="200">Fayhimi Sofa</h2>
                        <h3 data-aos="fade-up" data-aos-delay="400">Rp15,800,000</h3>
                        <p data-aos="fade-up" data-aos-delay="600">Desain klasik yang elegan dengan lengan yang
                            digulung. Bantal punggung yang longgar dengan isian premium dilengkapi dengan aksen trim
                            paku payung. Didukung oleh kaki kayu sederhana untuk dukungan yang baik.</p>
                        <div class="product-color" data-aos="fade-up" data-aos-delay="800">
                        </div>
                        <div class="product-details-action-wrap" data-aos="fade-up" data-aos-delay="1000">
                            <div class="product-quality">
                                <input class="cart-plus-minus-box input-text qty text" name="qtybutton" value="1">
                            </div>
                            <div class="single-product-cart btn-hover">
                                <a href="#">Tambah ke keranjang</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="product-area pb-60">
        <div class="container">
            <div class="section-title-tab-wrap mb-75" data-aos="fade-up" data-aos-delay="200">
                <div class="section-title-2">
                    <h2>Rekomendasi Produk</h2>
                </div>
            </div>
            <div class="tab-content jump">
                <div id="pro-1" class="tab-pane active">
                    <div class="row">
                        <!-- Product 1: Kursi Cendana -->
                        <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                            <div class="product-wrap mb-35" data-aos="fade-up" data-aos-delay="400">
                                <div class="product-img img-zoom mb-25">
                                    <a href="detail-kursi-cendana.php">
                                        <img src="assets/pic/Arm_chair/Kursi_Cendana.png" alt="Kursi Cendana">
                                    </a>
                                    <div class="product-action-wrap">
                                        <a href="detail-kursi-cendana.php" class="product-action-btn-1">
                                            <i class="pe-7s-look"></i>
                                        </a>
                                    </div>
                                    <div class="product-action-2-wrap">
                                        <button class="product-action-btn-2" title="Add To Cart" data-id="1"
                                            data-name="Kursi Cendana" data-price="4680000"
                                            data-image="assets/pic/Arm_chair/Kursi_Cendana.png"
                                            onclick="handleAddToCart(this)">
                                            <i class="pe-7s-cart"></i> Tambah ke keranjang
                                        </button>
                                    </div>
                                </div>
                                <div class="product-content">
                                    <h3><a href="detail-kursi-cendana.php">Kursi Cendana</a></h3>
                                    <div class="product-price">
                                        <span>Rp4,680,000</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Product 2: Meja Aksen Silinder -->
                        <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                            <div class="product-wrap mb-35" data-aos="fade-up" data-aos-delay="400">
                                <div class="product-img img-zoom mb-25">
                                    <a href="detail-meja-silinder.php">
                                        <img src="assets/pic/Side_table/meja_aksen_silinder.png"
                                            alt="Meja Aksen Silinder">
                                    </a>
                                    <div class="product-action-wrap">
                                        <a href="detail-meja-silinder.php" class="product-action-btn-1">
                                            <i class="pe-7s-look"></i>
                                        </a>
                                    </div>
                                    <div class="product-action-2-wrap">
                                        <button class="product-action-btn-2" title="Add To Cart" data-id="2"
                                            data-name="Meja Aksen Silinder" data-price="1670000"
                                            data-image="assets/pic/Side_table/meja_aksen_silinder.png"
                                            onclick="handleAddToCart(this)">
                                            <i class="pe-7s-cart"></i> Tambah ke keranjang
                                        </button>
                                    </div>
                                </div>
                                <div class="product-content">
                                    <h3><a href="detail-meja-silinder.php">Meja Aksen Silinder</a></h3>
                                    <div class="product-price">
                                        <span>Rp1,670,000</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Product 3: Kursi Antique -->
                        <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                            <div class="product-wrap mb-35" data-aos="fade-up" data-aos-delay="400">
                                <div class="product-img img-zoom mb-25">
                                    <a href="detail-kursi-antique.php">
                                        <img src="assets/pic/Arm_chair/Kursi_Antique.png" alt="Kursi Antique">
                                    </a>
                                    <div class="product-action-wrap">
                                        <a href="detail-kursi-antique.php" class="product-action-btn-1">
                                            <i class="pe-7s-look"></i>
                                        </a>
                                    </div>
                                    <div class="product-action-2-wrap">
                                        <button class="product-action-btn-2" title="Add To Cart" data-id="3"
                                            data-name="Kursi Antique" data-price="4420000"
                                            data-image="assets/pic/Arm_chair/Kursi_Antique.png"
                                            onclick="handleAddToCart(this)">
                                            <i class="pe-7s-cart"></i> Tambah ke keranjang
                                        </button>
                                    </div>
                                </div>
                                <div class="product-content">
                                    <h3><a href="detail-kursi-antique.php">Kursi Antique</a></h3>
                                    <div class="product-price">
                                        <span>Rp4,420,000</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Product 4: Kursi Arjuna -->
                        <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                            <div class="product-wrap mb-35" data-aos="fade-up" data-aos-delay="500">
                                <div class="product-img img-zoom mb-25">
                                    <a href="detail-kursi-arjuna.php">
                                        <img src="assets/pic/Arm_chair/Kursi_Arjuna.png" alt="Kursi Arjuna">
                                    </a>
                                    <div class="product-badge badge-top badge-right badge-pink">
                                        <span>-15%</span>
                                    </div>
                                    <div class="product-action-wrap">
                                        <a href="detail-kursi-arjuna.php" class="product-action-btn-1">
                                            <i class="pe-7s-look"></i>
                                        </a>
                                    </div>
                                    <div class="product-action-2-wrap">
                                        <button class="product-action-btn-2" title="Add To Cart" data-id="4"
                                            data-name="Kursi Arjuna" data-price="3400000"
                                            data-image="assets/pic/Arm_chair/Kursi_Arjuna.png"
                                            onclick="handleAddToCart(this)">
                                            <i class="pe-7s-cart"></i> Tambah ke keranjang
                                        </button>
                                    </div>
                                </div>
                                <div class="product-content">
                                    <h3><a href="detail-kursi-arjuna.php">Kursi Arjuna</a></h3>
                                    <div class="product-price">
                                        <span class="old-price">Rp4,000,000</span>
                                        <span class="new-price">Rp3,400,000</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Product 5: Meja Vintage -->
                        <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                            <div class="product-wrap mb-35" data-aos="fade-up" data-aos-delay="400">
                                <div class="product-img img-zoom mb-25">
                                    <a href="detail-meja-vintage.php">
                                        <img src="assets/pic/Side_table/meja_vintage.png" alt="Meja Vintage">
                                    </a>
                                    <div class="product-action-wrap">
                                        <a href="detail-meja-vintage.php" class="product-action-btn-1">
                                            <i class="pe-7s-look"></i>
                                        </a>
                                    </div>
                                    <div class="product-action-2-wrap">
                                        <button class="product-action-btn-2" title="Add To Cart" data-id="5"
                                            data-name="Meja Vintage" data-price="2500000"
                                            data-image="assets/pic/Side_table/meja_vintage.png"
                                            onclick="handleAddToCart(this)">
                                            <i class="pe-7s-cart"></i> Tambah ke keranjang
                                        </button>
                                    </div>
                                </div>
                                <div class="product-content">
                                    <h3><a href="detail-meja-vintage.php">Meja Vintage</a></h3>
                                    <div class="product-price">
                                        <span>Rp2,500,000</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Product 6: Kursi Junot -->
                        <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                            <div class="product-wrap mb-35" data-aos="fade-up" data-aos-delay="500">
                                <div class="product-img img-zoom mb-25">
                                    <a href="detail-kursi-junot.php">
                                        <img src="assets/pic/Arm_chair/Kursi_Junot.png" alt="Kursi Junot">
                                    </a>
                                    <div class="product-badge badge-top badge-right badge-pink">
                                        <span>-10%</span>
                                    </div>
                                    <div class="product-action-wrap">
                                        <a href="detail-kursi-junot.php" class="product-action-btn-1">
                                            <i class="pe-7s-look"></i>
                                        </a>
                                    </div>
                                    <div class="product-action-2-wrap">
                                        <button class="product-action-btn-2" title="Add To Cart" data-id="6"
                                            data-name="Kursi Junot" data-price="3942000"
                                            data-image="assets/pic/Arm_chair/Kursi_Junot.png"
                                            onclick="handleAddToCart(this)">
                                            <i class="pe-7s-cart"></i> Tambah ke keranjang
                                        </button>
                                    </div>
                                </div>
                                <div class="product-content">
                                    <h3><a href="detail-kursi-junot.php">Kursi Junot</a></h3>
                                    <div class="product-price">
                                        <span class="old-price">Rp4,380,000</span>
                                        <span class="new-price">Rp3,942,000</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Product 7: Meja Bundar -->
                        <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                            <div class="product-wrap mb-35" data-aos="fade-up" data-aos-delay="400">
                                <div class="product-img img-zoom mb-25">
                                    <a href="detail-meja-bundar.php">
                                        <img src="assets/pic/Side_table/meja_bundar.png" alt="Meja Bundar">
                                    </a>
                                    <div class="product-action-wrap">
                                        <a href="detail-meja-bundar.php" class="product-action-btn-1">
                                            <i class="pe-7s-look"></i>
                                        </a>
                                    </div>
                                    <div class="product-action-2-wrap">
                                        <button class="product-action-btn-2" title="Add To Cart" data-id="7"
                                            data-name="Meja Bundar" data-price="1050000"
                                            data-image="assets/pic/Side_table/meja_bundar.png"
                                            onclick="handleAddToCart(this)">
                                            <i class="pe-7s-cart"></i> Tambah ke keranjang
                                        </button>
                                    </div>
                                </div>
                                <div class="product-content">
                                    <h3><a href="detail-meja-bundar.php">Meja Bundar</a></h3>
                                    <div class="product-price">
                                        <span>Rp1,050,000</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Product 8: Kursi Syamut -->
                        <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                            <div class="product-wrap mb-35" data-aos="fade-up" data-aos-delay="400">
                                <div class="product-img img-zoom mb-25">
                                    <a href="detail-kursi-syamut.php">
                                        <img src="assets/pic/Arm_chair/Kursi_Syamut.png" alt="Kursi Syamut">
                                    </a>
                                    <div class="product-action-wrap">
                                        <a href="detail-kursi-syamut.php" class="product-action-btn-1">
                                            <i class="pe-7s-look"></i>
                                        </a>
                                    </div>
                                    <div class="product-action-2-wrap">
                                        <button class="product-action-btn-2" title="Add To Cart" data-id="8"
                                            data-name="Kursi Syamut" data-price="2900000"
                                            data-image="assets/pic/Arm_chair/Kursi_Syamut.png"
                                            onclick="handleAddToCart(this)">
                                            <i class="pe-7s-cart"></i> Tambah ke keranjang
                                        </button>
                                    </div>
                                </div>
                                <div class="product-content">
                                    <h3><a href="detail-kursi-syamut.php">Kursi Syamut</a></h3>
                                    <div class="product-price">
                                        <span>Rp2,900,000</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Continue adding more products if necessary -->
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
                        <div class="col-lg-4 col-md-6 col-sm-6 col-12 mb-30 text-left"> <!-- Teks rata kiri -->
                            <div class="footer-widget footer-about">
                                <p>Kami di <strong>Décor</strong> berkomitmen untuk menghadirkan sentuhan estetika
                                    terbaik di setiap sudut ruang Anda. Bersama-sama, kita membuat rumah lebih dari
                                    sekadar tempat tinggal — sebuah ekspresi diri.</p>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-6 col-12 mb-30 text-left"> <!-- Teks rata kiri -->
                            <div class="footer-widget footer-list">
                                <h3 class="footer-title">Informasi</h3>
                                <ul>
                                    <li><a href="about-us.php">Tentang</a></li>
                                    <li><a href="#">Furnitur</a></li>
                                    <li><a href="my-account.php">Akun</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-6 col-12 mb-30 text-left"> <!-- Teks rata kiri -->
                            <div class="footer-widget footer-address">
                                <h3 class="footer-title">Hubungi Kami</h3>
                                <ul>
                                    <li><span>Alamat: </span>Lorem ipsum dolor sit amet</li>
                                    <li><span>Telepon: </span>(62) 895395172037</li>
                                    <li><span>Email: </span><a href="mailto:decor@gmail.com">decor@gmail.com</a></li>
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
                                <li><a href="shop-armchair.php">php</a></li>
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
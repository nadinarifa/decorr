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
                <div class="cart-total">
                    <h4>Subtotal: <span id="cart-subtotal">Rp0</span></h4>
                </div>
                <div class="checkout-btn btn-hover">
                    <a class="theme-color" href="checkout.php">Checkout</a>
                </div>
            </div>
        </div>
    </div>
    <nav aria-label="breadcrumb">
        <div class="nav-breadcrumb">
            <div><a href="landingpage.php" class="nav-item">Home</a></div>
            <span class="separator">/</span>
            <div><a href="shop-sidetable.php" class="nav-item">Meja</a></div>
            <span class="separator">/</span>
            <div class="nav-item-active">Meja Aksen Silinder</div>
        </div>
    </nav>
    <div class="product-details-area pb-100 pt-100">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="product-details-img-wrap" data-aos="fade-up" data-aos-delay="200">
                        <div class="easyzoom-style">
                            <div class="easyzoom easyzoom--overlay">
                                <a href="assets/pic/pro-zoom/meja-silinder.png">
                                    <img src="assets/pic/pro-large/meja-silinder.png" alt="">
                                </a>
                            </div>
                            <a class="easyzoom-pop-up img-popup" href="assets/pic/Side_table/meja_aksen_silinder.png">
                                <i class="pe-7s-search"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="product-details-content" data-aos="fade-up" data-aos-delay="400">
                        <h2>Meja Aksen Silinder</h2>
                        <div class="product-details-price">
                            <span> Rp1,670,000 </span>

                        </div>
                        <div class="product-details-meta">
                            <ul>
                                <li><span class="title">Dimensi :</span> 40 × 40 × 50 cm</li>
                                <li><span class="title">Warna :</span>Coklat, Cream </li>
                                <li><span class="title">Nama Kayu :</span>Jati</li>
                        </div>
                        <div class="product-details-action-wrap">
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
    <div class="description-review-area pb-85">
        <div class="container">
            <div class="description-review-topbar nav" data-aos="fade-up" data-aos-delay="200">
                <a class="active" data-bs-toggle="tab" href="#des-details1"> Deskripsi </a>
                <a data-bs-toggle="tab" href="#des-details2" class=""> Informasi </a>
                <a data-bs-toggle="tab" href="#des-details3" class=""> Komentar </a>
            </div>
            <div class="tab-content">
                <div id="des-details1" class="tab-pane active">
                    <div class="product-description-content text-center">
                        <p data-aos="fade-up" data-aos-delay="500">Meja ini memiliki desain modern dengan kombinasi
                            bentuk silinder pada bagian bawah dan permukaan meja bulat yang halus di bagian atas. Bagian
                            dasar terbuat dari kayu dengan alur vertikal yang memberikan tampilan tekstur unik,
                            sedangkan permukaan meja tampak berbahan marmer atau kayu yang lebih terang. Meja ini cocok
                            digunakan sebagai meja samping di ruang tamu atau meja aksen di sudut-sudut ruangan modern
                            minimalis.</p>
                        <p data-aos="fade-up" data-aos-delay="400"> sedangkan permukaan meja tampak berbahan marmer atau
                            kayu yang lebih terang. Meja ini cocok digunakan sebagai meja samping di ruang tamu atau
                            meja aksen di sudut-sudut ruangan modern minimalis.</p>
                    </div>
                </div>
                <div id="des-details2" class="tab-pane">
                    <div class="specification-wrap table-responsive">
                        <table>
                            <tbody>
                                <tr>
                                    <td class="width1">Dimensi</td>
                                    <td>40 × 40 × 50 cm</td>
                                </tr>
                                <tr>
                                    <td class="width1">Warna</td>
                                    <td>Coklat, Cream</td>
                                </tr>
                                <tr>
                                    <td class="width1">Nama Kayu</td>
                                    <td>Jati</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div id="des-details3" class="tab-pane">
                    <div class="review-wrapper">
                        <h3>1 komentar untuk Meja Aksen Silinder</h3>
                        <div class="single-review">
                            <div class="review-img">
                                <img src="assets/images/product-details/review-1.png" alt="">
                            </div>
                            <h5><span>Lione</span> - April 29, 2024</h5>
                            <p>>Lorem ipsum dolor sit amet, cons adipi elit, sed do eiusmod tempor incididunt ut aliqua.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <br> <br> <br> <br> <br>
            <div class="ratting-form-wrapper">
                <h3>Tambah Komentar</h3>
                <p>Alamat email Anda tidak akan dipublikasikan. Kolom yang wajib diisi ditandai <span>*</span></p>
                <div class="ratting-form">
                    <form action="#">
                        <div class="row">
                            <div class="col-lg-6 col-md-6">
                                <div class="rating-form-style mb-15">
                                    <label>Nama <span>*</span></label>
                                    <input type="text">
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <div class="rating-form-style mb-15">
                                    <label>Email <span>*</span></label>
                                    <input type="email">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="rating-form-style mb-15">
                                    <label>Komentar Anda <span>*</span></label>
                                    <textarea name="Komentar Anda"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-submit">
                                <input type="submit" value="Kirim">
                            </div>
                        </div>
                </div>
                </form>
            </div>
        </div>
    </div>
    </div>
    </div>
    </div>
    <div class="related-product-area pb-95">
        <div class="container">
            <div class="section-title-2 st-border-center text-center mb-75" data-aos="fade-up" data-aos-delay="200">
                <h2>Produk Terkait</h2>
            </div>
            <div class="tab-content jump">
                <div id="pro-1" class="tab-pane active">
                    <div class="row">
                        <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                            <div class="product-wrap mb-35" data-aos="fade-up" data-aos-delay="400">
                                <div class="product-img img-zoom mb-25">
                                    <a href="detail-meja-rotan.php">
                                        <img src="assets/pic/Side_table/meja_sisi_rotan.png" alt="">
                                    </a>
                                    <div class="product-action-wrap">
                                        <a href="detail-meja-rotan.php" class="product-action-btn-1">
                                            <i class="pe-7s-look"></i>
                                        </a>
                                    </div>
                                    <div class="product-action-2-wrap">
                                        <button class="product-action-btn-2" title="Add To Cart"
                                            onclick="handleAddToCart(this)" data-id="1" data-name="Meja Sisi Rotan"
                                            data-price="2400000" data-image="assets/pic/Side_table/meja_sisi_rotan.png">
                                            <i class="pe-7s-cart"></i> Tambah ke keranjang
                                        </button>
                                    </div>
                                </div>
                                <div class="product-content">
                                    <h3><a href="detail-meja-rotan.php">Meja Sisi Rotan</a></h3>
                                    <div class="product-price">
                                        <span>Rp2,400,000</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                            <div class="product-wrap mb-35" data-aos="fade-up" data-aos-delay="400">
                                <div class="product-img img-zoom mb-25">
                                    <a href="detail-meja-bulat.php">
                                        <img src="assets/pic/Side_table/Meja_Bulat_Klasik.png" alt="">
                                    </a>
                                    <div class="product-action-wrap">
                                        <a href="detail-meja-bulat.php" class="product-action-btn-1">
                                            <i class="pe-7s-look"></i>
                                        </a>
                                    </div>
                                    <div class="product-action-2-wrap">
                                        <button class="product-action-btn-2" title="Add To Cart"
                                            onclick="handleAddToCart(this)" data-id="2" data-name="Meja Bulat Klasik"
                                            data-price="1600000"
                                            data-image="assets/pic/Side_table/Meja_Bulat_Klasik.png">
                                            <i class="pe-7s-cart"></i> Tambah ke keranjang
                                        </button>
                                    </div>
                                </div>
                                <div class="product-content">
                                    <h3><a href="detail-meja-bulat.php">Meja Bulat Klasik</a></h3>
                                    <div class="product-price">
                                        <span>Rp1,600,000</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                            <div class="product-wrap mb-35" data-aos="fade-up" data-aos-delay="400">
                                <div class="product-img img-zoom mb-25">
                                    <a href="detail-meja-vintage.php">
                                        <img src="assets/pic/Side_table/meja_vintage.png" alt="">
                                    </a>
                                    <div class="product-action-wrap">
                                        <a href="detail-meja-vintage.php" class="product-action-btn-1">
                                            <i class="pe-7s-look"></i>
                                        </a>
                                    </div>
                                    <div class="product-action-2-wrap">
                                        <button class="product-action-btn-2" title="Add To Cart"
                                            onclick="handleAddToCart(this)" data-id="4" data-name="Meja Vintage"
                                            data-price="2500000" data-image="assets/pic/Side_table/meja_vintage.png">
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

                        <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                            <div class="product-wrap mb-35" data-aos="fade-up" data-aos-delay="400">
                                <div class="product-img img-zoom mb-25">
                                    <a href="detail-meja-bundar.php">
                                        <img src="assets/pic/Side_table/meja_bundar.png" alt="">
                                    </a>
                                    <div class="product-action-wrap">
                                        <a href="detail-meja-bundar.php" class="product-action-btn-1">
                                            <i class="pe-7s-look"></i>
                                        </a>
                                    </div>
                                    <div class="product-action-2-wrap">
                                        <button class="product-action-btn-2" title="Add To Cart"
                                            onclick="handleAddToCart(this)" data-id="5" data-name="Meja Bundar"
                                            data-price="1050000" data-image="assets/pic/Side_table/meja_bundar.png">
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
                                    <li><a href="profile.php">Akun</a></li>
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
        // JavaScript code for handling the cart
        function handleAddToCart(button) {
            const productId = parseInt(button.getAttribute('data-id'));
            const productName = button.getAttribute('data-name');
            const productPrice = parseFloat(button.getAttribute('data-price'));
            const productImage = button.getAttribute('data-image');

            // Call your addToCart function (defined in your previous JavaScript)
            addToCart({
                id: productId,
                name: productName,
                price: productPrice,
                quantity: 1, // Set default quantity
                image: productImage
            });
        }
    </script>
</body>


</html>
<?php
// Mulai session untuk mengambil id_user dari session jika pengguna login
session_start();

// Koneksi ke database
include('includes/db.php');

// ID produk yang akan digunakan (misalnya untuk Sofa Lylia)
$id_produk = 4; // Ganti dengan ID produk yang sesuai

// Inisialisasi variabel untuk menghindari undefined variable
$nama_produk = '';
$jumlah_komentar = 0;

// Ambil nama produk dan jumlah komentar
$query_produk = "SELECT nama_produk FROM tb_produk WHERE id_produk = '$id_produk'";
$result_produk = mysqli_query($conn, $query_produk);

if ($result_produk && mysqli_num_rows($result_produk) > 0) {
    $row_produk = mysqli_fetch_assoc($result_produk);
    $nama_produk = $row_produk['nama_produk'];

    // Ambil semua komentar dari database
    $query_komentar = "SELECT k.komentar, k.tanggal_komentar, u.username 
                       FROM tb_komentar k 
                       JOIN tb_user u ON k.id_user = u.id_user 
                       WHERE k.id_produk = '$id_produk' 
                       ORDER BY k.tanggal_komentar DESC";
    $result_komentar = mysqli_query($conn, $query_komentar);
    $jumlah_komentar = mysqli_num_rows($result_komentar);
} else {
    echo "Produk tidak ditemukan.";
}

// Cek jika form komentar disubmit
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Ambil data dari form
    $nama = mysqli_real_escape_string($conn, $_POST['nama']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $komentar = mysqli_real_escape_string($conn, $_POST['komentar']);

    // Cek apakah user sudah terdaftar (gunakan tabel user berdasarkan email)
    $query_user = "SELECT id_user FROM tb_user WHERE email = '$email'";
    $result_user = mysqli_query($conn, $query_user);

    if (mysqli_num_rows($result_user) > 0) {
        $row_user = mysqli_fetch_assoc($result_user);
        $id_user = $row_user['id_user'];
    } else {
        // Jika user belum terdaftar, buat akun baru
        $insert_user = "INSERT INTO tb_user (username, email) VALUES ('$nama', '$email')";
        mysqli_query($conn, $insert_user);
        $id_user = mysqli_insert_id($conn); // Ambil ID user yang baru dibuat
    }

    // Masukkan komentar ke database
    $query_insert = "INSERT INTO tb_komentar (id_produk, id_user, komentar, tanggal_komentar) 
                     VALUES ('$id_produk', '$id_user', '$komentar', NOW())";
    mysqli_query($conn, $query_insert);

    // Ambil semua komentar terbaru setelah penambahan
    $query_komentar = "SELECT k.komentar, k.tanggal_komentar, u.username 
                       FROM tb_komentar k 
                       JOIN tb_user u ON k.id_user = u.id_user 
                       WHERE k.id_produk = '$id_produk' 
                       ORDER BY k.tanggal_komentar DESC";
    $result_komentar = mysqli_query($conn, $query_komentar);
    $jumlah_komentar = mysqli_num_rows($result_komentar); // Update jumlah komentar
}

?>

<!DOCTYPE html>
<html lang="zxx">


<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>eCommerce Décor</title>
    <meta name="robots" content="noindex, follow" />
    <meta name="description" content="SayyamCode eCommerce Bootstrap 5 Template is a stunning eCommerce website template that is the best choice for any online store.">
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
    <meta property="og:description" content="SayyamCode eCommerce Bootstrap 5 Template is a stunning eCommerce website template that is the best choice for any online store." />
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
                <div><a href="landingpage.html" class="nav-item">Home</a></div>
                <span class="separator">/</span>
                <div><a href="shop-sofas.html" class="nav-item">Sofa</a></div>
                <span class="separator">/</span>
                <div class="nav-item-active">Grahma Sofa</div>
            </div>
        </nav>  
        <div class="product-details-area pb-100 pt-100">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="product-details-img-wrap" data-aos="fade-up" data-aos-delay="200">
                            <div class="easyzoom-style">
                                <div class="easyzoom easyzoom--overlay">
                                    <a href="assets/pic/pro-zoom/grahma-sofa.png">
                                        <img src="assets/pic/pro-large/grahma-sofa.png" alt="">
                                    </a>
                                </div>
                                <a class="easyzoom-pop-up img-popup" href="assets/pic/sofas/Grahma_sofa.png">
                                    <i class="pe-7s-search"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="product-details-content" data-aos="fade-up" data-aos-delay="400">
                            <h2>Grahma Sofa </h2>
                            <div class="product-details-price">
                                <span>Rp7,463,000</span>
                            </div>
                            <div class="product-details-meta">
                                <ul>
                                        <li><span class="title">Dimensi :</span>205 × 84 × 91 cm</span>
                                           </li>
                                    <li><span class="title">Warna :</span>Biru</li>
                                    <li><span class="title">Nama Kain :</span>Linen</li>                          
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
                            <p data-aos="fade-up" data-aos-delay="500">Bantal punggung berumbai kancing yang menambahkan detail dekoratif. Garis-garis persegi yang bersih yang memberikan estetika modern namun tak lekang oleh waktu. Pelapis warna terang yang memberikan tampilan segar dan serbaguna. Kaki kayu yang sedikit melebar meningkatkan nuansa pertengahan abad.</p>
                        </div>
                    </div>
                    <div id="des-details2" class="tab-pane">
                        <div class="specification-wrap table-responsive">
                            <table>
                                <tbody>
                                    <tr>
                                        <td class="width1">Dimensi</td>
                                        <td>205 × 84 × 91 cm           
                           </td>
                                    </tr>
                                    <tr>
                                        <td class="width1">Warna</td>
                                        <td>Biru</td>
                                    </tr>
                                    <tr>
                                        <td class="width1">Nama Kain</td>
                                        <td>Linen</td>
                                    </tr>
                                    <tr>
                                        <td class="width1">Nama Kayu</td>
                                        <td>Ek (Oak)</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div id="des-details3" class="tab-pane">
                        <div class="review-wrapper">
                            <h3><?php echo $jumlah_komentar; ?> komentar untuk
                                <?php echo htmlspecialchars($nama_produk); ?></h3>

                            <?php
                            // Menampilkan komentar
                            if ($jumlah_komentar > 0) {
                                while ($row_komentar = mysqli_fetch_assoc($result_komentar)) {
                                    // Format tanggal menjadi bulan, tanggal, tahun dan waktu
                                    $tanggal_komentar = date('l, F j, Y H:i', strtotime($row_komentar['tanggal_komentar']));
                                    // Menampilkan komentar
                                    echo '<div class="single-review">';
                                    // Menampilkan username dan tanggal dalam satu baris
                                    echo '<h5><span>' . htmlspecialchars($row_komentar['username']) . '</span> <span class="review-date"> - ' . $tanggal_komentar . '</span></h5>';
                                    // Menampilkan isi komentar di baris berikutnya
                                    echo '<p>' . htmlspecialchars($row_komentar['komentar']) . '</p>';
                                    echo '</div>';
                                }
                            } else {
                                echo '<p>Belum ada komentar.</p>';
                            }
                            ?>
                        </div>
                    </div>
                <br> <br>  <br>  <br>  <br>
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
                                        <a href="detail-sofa-lylia.html">
                                            <img src="assets/pic/sofas/Lylia_sofa.png" alt="">
                                        </a>
                                        <div class="product-action-wrap">
                                            <a href="detail-sofa-lylia.html" class="product-action-btn-1">
                                                <i class="pe-7s-look"></i>
                                            </a>
                                        </div>
                                        <div class="product-action-2-wrap">
                                            <button class="product-action-btn-2" title="Add To Cart"><i class="pe-7s-cart"></i> Tambah ke keranjang</button>
                                        </div>
                                    </div>
                                    <div class="product-content">
                                        <h3><a href="detail-sofa-lylia.html">Lylia Sofa</a></h3>
                                        <div class="product-price">
                                            <span>Rp12,000,000 </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                                <div class="product-wrap mb-35" data-aos="fade-up" data-aos-delay="400">
                                    <div class="product-img img-zoom mb-25">
                                        <a href="detail-sofa-malila.html">
                                            <img src="assets/pic/sofas/Malila_Sofa.png" alt="">
                                        </a>
                                        <div class="product-action-wrap">
                                            <a href="detail-sofa-malila.html" class="product-action-btn-1">
                                                <i class="pe-7s-look"></i>
                                            </a>
                                        </div>
                                        <div class="product-action-2-wrap">
                                            <button class="product-action-btn-2" title="Add To Cart"><i class="pe-7s-cart"></i> Tambah ke keranjang</button>
                                        </div>
                                    </div>
                                    <div class="product-content">
                                        <h3><a href="detail-sofa-malila.html">Malila Sofa</a></h3>
                                        <div class="product-price">
                                            <span>Rp7,742,000 </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                                <div class="product-wrap mb-35" data-aos="fade-up" data-aos-delay="400">
                                    <div class="product-img img-zoom mb-25">
                                        <a href="detail-sofa-kanza.html">
                                            <img src="assets/pic/sofas/Kanza_sofa.png" alt="">
                                        </a>
                                        <div class="product-action-wrap">
                                            <a href="detail-sofa-kanza.html" class="product-action-btn-1">
                                                <i class="pe-7s-look"></i>
                                            </a>
                                        </div>
                                        <div class="product-action-2-wrap">
                                            <button class="product-action-btn-2" title="Add To Cart"><i class="pe-7s-cart"></i> Tambah ke keranjang</button>
                                        </div>
                                    </div>
                                    <div class="product-content">
                                        <h3><a href="detail-sofa-kanza.html">Kanza Sofa</a></h3>
                                        <div class="product-price">
                                            <span>Rp13,589,000</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                                <div class="product-wrap mb-35" data-aos="fade-up" data-aos-delay="400">
                                    <div class="product-img img-zoom mb-25">
                                        <a href="detail-sofa-fayhimi.html">
                                            <img src="assets/pic/sofas/fayhimi_sofa.png" alt="">
                                        </a>
                                        <div class="product-action-wrap">
                                            <a href="detail-sofa-fayhimi.html" class="product-action-btn-1">
                                                <i class="pe-7s-look"></i>
                                            </a>
                                        </div>
                                        <div class="product-action-2-wrap">
                                            <button class="product-action-btn-2" title="Add To Cart"><i class="pe-7s-cart"></i> Tambah ke keranjang</button>
                                        </div>
                                    </div>
                                    <div class="product-content">
                                        <h3><a href="detail-sofa-fayhimi.html">Fayhimi Sofa</a></h3>
                                        <div class="product-price">
                                            <span>Rp15,800,000</span>
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
                            <p>Kami di <strong>Décor</strong> berkomitmen untuk menghadirkan sentuhan estetika terbaik di setiap sudut ruang Anda. Bersama-sama, kita membuat rumah lebih dari sekadar tempat tinggal — sebuah ekspresi diri.</p>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6 col-12 mb-30 text-left"> <!-- Teks rata kiri -->
                        <div class="footer-widget footer-list">
                            <h3 class="footer-title">Informasi</h3>
                            <ul>
                                <li><a href="about-us.html">Tentang</a></li>
                                <li><a href="#">Furnitur</a></li>
                                <li><a href="my-account.html">Akun</a></li>
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
                            <a href="landingpage.html">HOME</a>
                        </li>
                        <li>
                            <a href="#">FURNITUR</a>
                                    <ul>
                                        <li><a href="shop-sofas.html">Sofa</a></li>
                                        <li><a href="shop-armchair.html">Kursi</a></li>
                                        <li><a href="shop-sidetable.html">Meja</a></li>
                                    </ul>
                                    <li>
                                        <a href="about-us.html">TENTANG</a>
                                    </li>
                        <li>
                            <a href="contact-us.html">HUBUNGI KAMI</a>
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
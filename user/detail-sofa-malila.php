<?php
// Mulai session untuk mengambil id_user dari session jika pengguna login
session_start();

// Koneksi ke database
include('includes/db.php');

// Dapatkan id_produk dari URL atau default ke 1
$id_produk = isset($_GET['id_produk']) ? (int) $_GET['id_produk'] : 1;

// Inisialisasi variabel untuk menghindari undefined variable
$nama_produk = '';
$dimensi = '';
$warna = '';
$kain = '';
$kayu = '';
$harga = 0;
$jumlah_komentar = 0;
$foto_produk = '';
$deskripsi = '';

// Ambil detail produk dari database
$query_produk = "SELECT nama_produk, dimensi, warna, kain, kayu, harga, foto_produk, deskripsi 
                 FROM tb_produk WHERE id_produk = ?";
$stmt_produk = mysqli_prepare($conn, $query_produk);

if ($stmt_produk) {
    mysqli_stmt_bind_param($stmt_produk, "i", $id_produk);
    mysqli_stmt_execute($stmt_produk);
    $result_produk = mysqli_stmt_get_result($stmt_produk);

    if ($result_produk && mysqli_num_rows($result_produk) > 0) {
        $row_produk = mysqli_fetch_assoc($result_produk);
        $nama_produk = $row_produk['nama_produk'];
        $dimensi = $row_produk['dimensi'];
        $warna = $row_produk['warna'];
        $kain = $row_produk['kain'];
        $kayu = $row_produk['kayu'];
        $harga = $row_produk['harga'];
        $foto_produk = $row_produk['foto_produk'];
        $deskripsi = $row_produk['deskripsi'];
    } else {
        echo "Produk tidak ditemukan.";
    }
    mysqli_stmt_close($stmt_produk);
} else {
    echo "Terjadi kesalahan dalam mengambil data produk.";
}

// Fetch comments before checking for POST request, so they appear on the page
$query_komentar = "SELECT k.komentar, k.tanggal_komentar, u.username 
                   FROM tb_komentar k 
                   JOIN tb_user u ON k.id_user = u.id_user 
                   WHERE k.id_produk = '$id_produk' 
                   ORDER BY k.tanggal_komentar DESC";
$result_komentar = mysqli_query($conn, $query_komentar);
$jumlah_komentar = mysqli_num_rows($result_komentar); // Update jumlah komentar

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

    // Fetch updated comments after insertion
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
                                        <li><a href="shop-sofas.php">Sofa</a></li>
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
                <div class="view-cart-btn btn-hover" style="margin-top: 10px;">
                    <a class="theme-color" href="keranjang.php">Lihat Keranjang</a>
                </div>
            </div>
        </div>
    </div>



    <div class="wrapper">
        <nav aria-label="breadcrumb">
            <div class="nav-breadcrumb">
                <?php
                // Mengambil URL saat ini
                $current_url = $_SERVER['REQUEST_URI'];

                // Menentukan breadcrumb berdasarkan URL
                if (strpos($current_url, 'shop-sofas.php') !== false) {
                    // Halaman kategori sofa
                    echo '<div><a href="landingpage.php" class="nav-item">Home</a></div>';
                    echo '<span class="separator">/</span>';
                    echo '<div><a href="shop-sofas.php" class="nav-item">Sofa</a></div>';
                } elseif (strpos($current_url, 'product-detail.php') !== false) {
                    // Halaman detail produk
                    $product_name = "Malila Sofa"; // Ganti dengan nama produk yang sesuai
                    echo '<div><a href="landingpage.php" class="nav-item">Home</a></div>';
                    echo '<span class="separator">/</span>';
                    echo '<div><a href="shop-sofas.php" class="nav-item">Sofa</a></div>';
                    echo '<span class="separator">/</span>';
                    echo '<div class="nav-item-active">' . $product_name . '</div>';
                } else {
                    // Halaman utama
                    echo '<div><a href="landingpage.php" class="nav-item">Home</a></div>';
                }
                ?>
            </div>
        </nav>
    </div>

    <!-- Tampilan HTML untuk Detail Produk -->
    <!-- Product Details -->
    <div class="product-details-area pb-100 pt-100">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="product-details-img-wrap" data-aos="fade-up" data-aos-delay="200">
                        <div class="easyzoom-style">
                            <div class="easyzoom easyzoom--overlay">
                                <!-- Menampilkan gambar produk dengan zoom -->
                                <a href="uploads/pic/<?php echo htmlspecialchars($foto_produk); ?>">
                                    <img src="uploads/pic/<?php echo htmlspecialchars($foto_produk); ?>"
                                        alt="Product Image">
                                </a>
                            </div>
                            <a class="easyzoom-pop-up img-popup"
                                href="uploads/pic/<?php echo htmlspecialchars($foto_produk); ?>">
                                <i class="pe-7s-search"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="product-details-content" data-aos="fade-up" data-aos-delay="400">
                        <h2><?php echo htmlspecialchars($nama_produk); ?></h2>
                        <div class="product-details-price">
                            <span>Rp <?php echo number_format($harga, 0, ',', '.'); ?></span>
                        </div>
                        <div class="product-details-meta">
                            <ul>
                                <li><span class="title">Dimensi :</span> <?php echo htmlspecialchars($dimensi); ?></li>
                                <li><span class="title">Warna :</span> <?php echo htmlspecialchars($warna); ?></li>
                                <li><span class="title">Nama Kain :</span> <?php echo htmlspecialchars($kain); ?></li>
                                <li><span class="title">Nama Kayu :</span> <?php echo htmlspecialchars($kayu); ?></li>
                            </ul>
                        </div>
                        <div class="product-details-action-wrap">
                            <div class="product-quality">
                                <!-- Quantity input -->
                                <input class="cart-plus-minus-box input-text qty text" id="qtybutton" name="qtybutton"
                                    value="1" min="1">
                            </div>
                            <div class="single-product-cart btn-hover">
                                <!-- Add to cart button -->
                                <a href="javascript:void(0);" onclick="handleAddToCart(this)"
                                    data-id="<?php echo htmlspecialchars($id_produk); ?>"
                                    data-name="<?php echo htmlspecialchars($nama_produk); ?>"
                                    data-price="<?php echo htmlspecialchars($harga); ?>"
                                    data-image="uploads/pic/<?php echo htmlspecialchars($foto_produk); ?>"
                                    data-quantity="1"> <!-- You can dynamically set the quantity -->
                                    Tambah ke keranjang
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Deskripsi Produk -->
    <div class="description-review-area pb-85">
        <div class="container">
            <div class="description-review-topbar nav" data-aos="fade-up" data-aos-delay="200">
                <a class="active" data-bs-toggle="tab" href="#des-details1"> Deskripsi </a>
                <a data-bs-toggle="tab" href="#des-details2"> Informasi </a>
                <a data-bs-toggle="tab" href="#des-details3"> Komentar </a>
            </div>
            <div class="tab-content">
                <div id="des-details1" class="tab-pane active">
                    <div class="product-description-content text-center">
                        <p data-aos="fade-up" data-aos-delay="500">
                            <?php echo nl2br(htmlspecialchars($deskripsi)); ?>
                        </p>
                    </div>
                </div>
                <div id="des-details2" class="tab-pane">
                    <div class="specification-wrap table-responsive">
                        <table>
                            <tbody>
                                <tr>
                                    <td class="width1" style="vertical-align: top;">Dimensi</td>
                                    <td><?php echo htmlspecialchars($dimensi); ?></td>
                                </tr>
                                <tr>
                                    <td class="width1" style="vertical-align: top;">Warna</td>
                                    <td><?php echo htmlspecialchars($warna); ?></td>
                                </tr>
                                <tr>
                                    <td class="width1" style="vertical-align: top;">Nama Kain</td>
                                    <td><?php echo htmlspecialchars($kain); ?></td>
                                </tr>
                                <tr>
                                    <td class="width1" style="vertical-align: top;">Nama Kayu</td>
                                    <td><?php echo htmlspecialchars($kayu); ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div id="des-details3" class="tab-pane">
                    <div class="review-wrapper">
                        <h3><?php echo $jumlah_komentar; ?> komentar untuk <?php echo htmlspecialchars($nama_produk); ?>
                        </h3>
                        <?php
                        if ($jumlah_komentar > 0) {
                            while ($row_komentar = mysqli_fetch_assoc($result_komentar)) {
                                // Format tanggal menjadi bulan, tanggal, tahun dan waktu
                                $tanggal_komentar = date('F j, Y H:i', strtotime($row_komentar['tanggal_komentar']));
                                echo '<div class="single-review">';
                                echo '<h5><span>' . htmlspecialchars($row_komentar['username']) . '</span> - ' . $tanggal_komentar . '</h5>';
                                echo '<p>' . htmlspecialchars($row_komentar['komentar']) . '</p>';
                                echo '</div>';
                            }
                        } else {
                            echo '<p>Belum ada komentar.</p>';
                        }
                        ?>
                    </div>
                </div>
                <br><br><br><br><br>

                <div class="ratting-form-wrapper">
                    <h3>Tambah Komentar</h3>
                    <p>Alamat email Anda tidak akan dipublikasikan. Kolom yang wajib diisi ditandai <span>*</span></p>
                    <div class="ratting-form">
                        <form method="POST" action="">
                            <div class="row">
                                <div class="col-lg-6 col-md-6">
                                    <div class="rating-form-style mb-15">
                                        <label>Nama <span>*</span></label>
                                        <input type="text" name="nama" required>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6">
                                    <div class="rating-form-style mb-15">
                                        <label>Email <span>*</span></label>
                                        <input type="email" name="email" required>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="rating-form-style mb-15">
                                        <label>Komentar Anda <span>*</span></label>
                                        <textarea name="komentar" required></textarea>
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

    <br><br>


    <footer class="footer-area">
        <div class="bg-gray-2">
            <div class="container">
                <div class="footer-top pt-40 pb-20"> <!-- Ukuran footer kecil -->
                    <div class="row justify-content-center">
                        <div class="col-lg-4 col-md-6 col-sm-6 col-12 mb-30 text-left">
                            <!-- Teks rata kiri -->
                            <div class="footer-widget footer-about">
                                <p>Kami di <strong>Décor</strong> berkomitmen untuk menghadirkan sentuhan
                                    estetika
                                    terbaik di setiap sudut ruang Anda. Bersama-sama, kita membuat rumah
                                    lebih dari
                                    sekadar tempat tinggal — sebuah ekspresi diri.</p>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-6 col-12 mb-30 text-left">
                            <!-- Teks rata kiri -->
                            <div class="footer-widget footer-list">
                                <h3 class="footer-title">Informasi</h3>
                                <ul>
                                    <li><a href="about-us.html">Tentang</a></li>
                                    <li><a href="#">Furnitur</a></li>
                                    <li><a href="my-account.html">Akun</a></li>
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
        // Handle Add to Cart
        function handleAddToCart(element) {
            // Get product details from data attributes
            var productId = element.getAttribute("data-id");
            var productName = element.getAttribute("data-name");
            var productPrice = element.getAttribute("data-price");
            var productImage = element.getAttribute("data-image");
            var quantity = document.getElementById("qtybutton").value || 1;  // Default to 1 if no quantity is selected

            // Create a cart item object
            var cartItem = {
                id: productId,
                name: productName,
                price: productPrice,
                image: productImage,
                quantity: parseInt(quantity)
            };

            // Add the cart item to sessionStorage (or localStorage if you want it to persist after page refresh)
            var cart = JSON.parse(sessionStorage.getItem('cart')) || []; // Get existing cart or empty array
            var productIndex = cart.findIndex(item => item.id === productId);

            if (productIndex !== -1) {
                // If product is already in cart, update quantity
                cart[productIndex].quantity += cartItem.quantity;
            } else {
                // If product is not in cart, add new item
                cart.push(cartItem);
            }

            // Save the updated cart back to sessionStorage
            sessionStorage.setItem('cart', JSON.stringify(cart));

            // Optional: Display message or update UI
            alert('Produk berhasil ditambahkan ke keranjang!');
        }
    </script>



</body>


</html>
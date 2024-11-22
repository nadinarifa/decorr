<?php
session_start();
include 'includes/db.php'; // Include the database connection file

// Ensure user is logged in
if (!isset($_SESSION['email'])) {
    header('Location: login.php'); // Redirect to login page if not logged in
    exit();
}

// Fetch user data from the session
$email = $_SESSION['email'];

// Prepare the SQL query to get user orders by joining tb_user and tb_pesanan based on id_user
$sql = "SELECT tb_pesanan.* 
        FROM tb_pesanan 
        JOIN tb_user ON tb_pesanan.id_user = tb_user.id_user 
        WHERE tb_user.email = ? 
        ORDER BY tb_pesanan.tanggal_pesanan DESC";

$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $email); // Bind the email parameter
$stmt->execute();
$result = $stmt->get_result(); // Get the result

// Check if there are any orders
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        // Display order details
        echo "Order ID: " . $row['id_pesanan'] . "<br>";
        echo "Total Price: " . $row['total_harga'] . "<br>";
        echo "Status: " . $row['status_pesanan'] . "<br>";
        echo "Date: " . $row['tanggal_pesanan'] . "<br><br>";
    }
} else {
    echo "";
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
                <div class="cart-total">
                    <h4>Subtotal: <span id="cart-subtotal">Rp0</span></h4>
                </div>
                <div class="checkout-btn btn-hover">
                    <a class="theme-color" href="checkout.php">Checkout</a>
                </div>
            </div>
        </div>
    </div>
    <br>
    <div class="about-us-title">
        <h2>PROFILE</h2>
    </div>

    <div class="my-account-wrapper pb-100 pt-100">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="myaccount-page-wrapper">
                        <div class="row">
                            <div class="col-lg-3 col-md-4">
                                <div class="myaccount-tab-menu nav" role="tablist">
                                    <a href="#dashboard" class="active" data-bs-toggle="tab">Dasbor</a>
                                    <a href="#orders" data-bs-toggle="tab">Pesanan</a>
                                    <a href="#address-edit" data-bs-toggle="tab">Alamat </a>
                                    <a href="#account-info" data-bs-toggle="tab">Detail Akun</a>
                                    <a href="logout.php">Keluar</a>
                                </div>
                            </div>

                            <div class="col-lg-9 col-md-8">
                                <div class="tab-content" id="myaccountContent">
                                    <div class="tab-pane fade show active" id="dashboard" role="tabpanel">
                                        <div class="myaccount-content">
                                            <h3>Dasbor</h3>
                                            <div class="welcome">
                                                <p>Hello, <strong><?php echo $_SESSION['username']; ?></strong></p>
                                            </div>
                                            <p class="mb-0">Dari dasbor akun Anda, Anda dapat dengan mudah memeriksa &
                                                melihat pesanan terkini, mengelola alamat pengiriman dan penagihan,
                                                serta mengedit kata sandi dan detail akun Anda.</p>
                                        </div>
                                    </div>

                                    <div class="tab-pane fade" id="orders" role="tabpanel">
                                        <div class="myaccount-content">
                                            <h3> Riwayat pesanan</h3>
                                            <div class="myaccount-table table-responsive text-center">
                                                <table class="table table-bordered">
                                                    <thead class="thead-light">
                                                        <tr>
                                                            <th>Nama Produk</th>
                                                            <th>Jumlah</th>
                                                            <th>Total</th>
                                                            <th>Tanggal Pesan</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        if (mysqli_num_rows($result) > 0) {
                                                            while ($row = mysqli_fetch_assoc($result)) {
                                                                $total = $row['jumlah'] * $row['harga'];
                                                                echo "<tr>
                                                                <td>{$row['nama_produk']}</td>
                                                                <td>{$row['jumlah']}</td>
                                                                <td>Rp" . number_format($total, 2) . "</td>
                                                                <td>{$row['tanggal_pesanan']}</td>
                                                            </tr>";
                                                            }
                                                        } else {
                                                            echo "<tr><td colspan='4'>Belum ada pesanan.</td></tr>";
                                                        }
                                                        ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="tab-pane fade" id="address-edit" role="tabpanel">
                                        <div class="myaccount-content">
                                            <h3>Alamat</h3>
                                            <address>
                                                <p><?php echo $_SESSION['alamat']; ?></p>
                                            </address>
                                            <!-- Button to trigger the dropdown form -->
                                            <a href="#" class="css-check-btn sqr-btn" id="toggleAddressForm">
                                                <i class="fa fa-edit"></i> Edit Alamat
                                            </a>

                                            <!-- Form dropdown, initially hidden -->
                                            <div id="edit-address-form" style="display: none;">
                                                <form id="edit-address-form-id" method="POST">
                                                    <fieldset>
                                                        <div class="form-legend">Perubahan Alamat</div>
                                                        <div class="css-single-input-item">
                                                            <label for="new_address" class="required">Alamat
                                                                Baru</label>
                                                            <div class="css-address-wrapper">
                                                                <input type="text" name="new_address" id="new_address"
                                                                    placeholder="Masukkan alamat baru" required />
                                                            </div>
                                                        </div>
                                                        <div class="css-single-input-item css-btn-hover">
                                                            <button type="button" onclick="updateAddress()"
                                                                class="css-check-btn sqr-btn">Simpan Perubahan</button>
                                                        </div>
                                                    </fieldset>
                                                </form>
                                            </div>
                                        </div>
                                    </div>



                                    <div class="tab-pane fade" id="account-info" role="tabpanel">
                                        <div class="myaccount-content">
                                            <h3>Detail Akun</h3>
                                            <div class="account-details-form">
                                                <form action="update_profile.php" method="POST">
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <!-- Display Username, Email, and Phone Number without input fields -->
                                                            <div class="single-input-item">
                                                                <label for="username">Username</label>
                                                                <p><?php echo $_SESSION['username']; ?></p>
                                                            </div>
                                                            <div class="single-input-item">
                                                                <label for="email">Alamat Email</label>
                                                                <p><?php echo $_SESSION['email']; ?></p>
                                                            </div>
                                                            <div class="single-input-item">
                                                                <label for="phone">Nomor Telepon</label>
                                                                <p><?php echo $_SESSION['nomor_telepon']; ?></p>
                                                            </div>

                                                            <a href="#" class="check-btn sqr-btn"
                                                                id="change-password-btn">
                                                                <i class="fa fa-edit"></i> Ubah Kata Sandi
                                                            </a>

                                                            <!-- Change password form, initially hidden -->
                                                            <div id="change-password-form" style="display: none;">
                                                                <form id="change-password-form-id" method="POST">
                                                                    <fieldset>
                                                                        <legend>Perubahan Kata Sandi</legend>
                                                                        <div class="single-input-item">
                                                                            <label for="current_password"
                                                                                class="required">Kata Sandi Saat
                                                                                Ini</label>
                                                                            <div class="password-wrapper">
                                                                                <input type="password"
                                                                                    name="current_password"
                                                                                    id="current_password"
                                                                                    placeholder="Masukkan kata sandi saat ini"
                                                                                    minlength="8" maxlength="8"
                                                                                    required />
                                                                                <span class="toggle-password"
                                                                                    onclick="togglePassword('current_password', 'current-eye')">
                                                                                    <i class="fa fa-eye-slash"
                                                                                        id="current-eye"></i>
                                                                                </span>
                                                                            </div>
                                                                        </div>
                                                                        <div class="single-input-item">
                                                                            <label for="new_password"
                                                                                class="required">Kata Sandi Baru</label>
                                                                            <div class="password-wrapper">
                                                                                <input type="password"
                                                                                    name="new_password"
                                                                                    id="new_password"
                                                                                    placeholder="Masukkan kata sandi baru"
                                                                                    minlength="8" maxlength="8"
                                                                                    required />
                                                                                <span class="toggle-password"
                                                                                    onclick="togglePassword('new_password', 'new-eye')">
                                                                                    <i class="fa fa-eye-slash"
                                                                                        id="new-eye"></i>
                                                                                </span>
                                                                            </div>
                                                                        </div>
                                                                        <div class="single-input-item btn-hover">
                                                                            <button type="button"
                                                                                onclick="changePassword()"
                                                                                class="check-btn sqr-btn">Simpan
                                                                                Perubahan</button>
                                                                        </div>
                                                                    </fieldset>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div> <!-- My Account Tab Content End -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    <!-- my account wrapper end -->
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

    <script>
        document.getElementById('change-password-btn').addEventListener('click', function (event) {
            event.preventDefault();
            var form = document.getElementById('change-password-form');
            form.style.display = (form.style.display === "none" || form.style.display === "") ? "block" : "none";
        });
    </script>

    <script>
        function changePassword() {
            var currentPassword = document.getElementById('current_password').value;
            var newPassword = document.getElementById('new_password').value;

            if (currentPassword === "" || newPassword === "") {
                alert("Semua kolom harus diisi.");
                return;
            }

            var xhr = new XMLHttpRequest();
            xhr.open("POST", "change_password.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    alert(xhr.responseText);
                    document.getElementById('change-password-form').style.display = 'none';
                }
            };

            xhr.send("current_password=" + encodeURIComponent(currentPassword) + "&new_password=" + encodeURIComponent(newPassword));
        }


        function togglePassword(fieldId, iconId) {
            var passwordField = document.getElementById(fieldId);
            var toggleIcon = document.getElementById(iconId);
            if (passwordField.type === "password") {
                passwordField.type = "text";
                toggleIcon.classList.remove("fa-eye-slash");
                toggleIcon.classList.add("fa-eye");
            } else {
                passwordField.type = "password";
                toggleIcon.classList.remove("fa-eye");
                toggleIcon.classList.add("fa-eye-slash");
            }
        }

    </script>

    <script>
        document.getElementById('toggleAddressForm').addEventListener('click', function (event) {
            event.preventDefault();
            var addressForm = document.getElementById('edit-address-form');
            if (addressForm.style.display === "none") {
                addressForm.style.display = "block";
            } else {
                addressForm.style.display = "none";
            }
        });

        function updateAddress() {
            var newAddress = document.getElementById('new_address').value;

            if (newAddress === "") {
                alert("Alamat tidak boleh kosong.");
                return;
            }

            var xhr = new XMLHttpRequest();
            xhr.open("POST", "update_address.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    alert(xhr.responseText);

                    // Update displayed address
                    document.querySelector('address p').innerText = newAddress;

                    // Hide the form after successful update
                    document.getElementById('edit-address-form').style.display = 'none';
                }
            };

            // Send the new address to the server
            xhr.send("new_address=" + encodeURIComponent(newAddress));
        }
    </script>
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
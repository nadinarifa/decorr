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
    <div class="register-container">
        <div class="register-left-section">
            <img src="assets/pic/Banner/banner-register.png" alt="Furniture" class="register-furniture-image">
        </div>
        <div class="register-right-section">
            <h2 class="register-title">Buat Akun</h2>
            <form class="register-form" method="POST" action="register.php">
                <div class="form-group">
                    <input type="text" class="register-input" placeholder=" " name="username" id="username" required>
                    <label for="nama">Username*</label>
                </div>
                <div class="form-group">
                    <input type="email" class="register-input" placeholder=" " name="email" id="email" required>
                    <label for="email">Email*</label>
                </div>
                <div class="form-group">
                    <input type="text" class="register-input" placeholder=" " name="alamat" id="alamat" required>
                    <label for="alamat">Alamat*</label>
                </div>
                <div class="form-group">
                    <input type="tel" class="register-input" placeholder=" " name="nomor_telepon" id="telepon" required>
                    <label for="telepon">Nomor Telepon*</label>
                </div>
                <div class="form-group password-group">
                    <input type="password" class="register-input" placeholder=" " name="password" id="password">
                    <label for="password">Password*</label>
                    <span class="toggle-password">
                        <i class="fa fa-eye-slash" id="eye-icon"></i>
                    </span>
                </div>
                <button type="submit" name="insert" class="register-btn">Daftar</button>
            </form>
            <p class="register-prompt">Sudah punya akun? <a href="login_form.php">Masuk</a></p>
        </div>
    </div>

    <script>
        document.querySelector('.register-form').addEventListener('submit', function (event) {
            // Ambil nilai dari inputan form
            var nama = document.getElementById('username').value.trim();
            var email = document.getElementById('email').value.trim();
            var alamat = document.getElementById('alamat').value.trim();
            var telepon = document.getElementById('telepon').value.trim();
            var password = document.getElementById('password').value.trim();

            // Debugging untuk memastikan semua input terbaca
            console.log("Usename:", nama, "Email:", email, "Alamat:", alamat, "Telepon:", telepon, "Password:", password);

            // Cek apakah semua input sudah diisi
            if (nama === "" || email === "" || alamat === "" || telepon === "" || password === "") {
                // Tampilkan pesan error jika ada yang kosong
                alert("Semua kolom harus diisi!");
                event.preventDefault(); // Mencegah form untuk dikirim
            });
    </script>


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
    <script src="assets/js/togglePassword.js"></script>
</body>


</html>
﻿<?php
include 'includes/db.php';  // Menghubungkan ke database

$errors = [];

// Query untuk mendapatkan kategori
$query_kategori = "SELECT id_kategori, nama_kategori FROM tb_kategori";
$result_kategori = mysqli_query($conn, $query_kategori);

// Cek jika form disubmit
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$nama_produk = trim($_POST['nama_produk']);
	$id_kategori = $_POST['id_kategori'];
	$stok = $_POST['stok'];
	$diskon = !empty($_POST['diskon']) ? $_POST['diskon'] : 0;
	$harga = $_POST['harga'];
	$deskripsi = $_POST['deskripsi'];
	$dimensi = $_POST['dimensi'];
	$warna = $_POST['warna'];
	$kain = $_POST['kain'];
	$kayu = $_POST['kayu'];

	// Validasi input
	if (empty($nama_produk))
		$errors[] = "Nama produk harus diisi.";
	if (empty($id_kategori))
		$errors[] = "Kategori harus dipilih.";
	if (empty($stok))
		$errors[] = "Jumlah stok harus diisi.";
	if (empty($harga))
		$errors[] = "Harga harus diisi.";
	if (empty($_FILES['foto_produk']['name']))
		$errors[] = "Gambar produk harus diunggah.";
	if (empty($deskripsi))
		$errors[] = "Deskripsi harus diisi.";

	if (empty($errors)) {
		$foto_produk = $_FILES['foto_produk']['name'];
		$target_dir = "assets/pic/";
		$target_file = $target_dir . basename($foto_produk);
		$uploadOk = 1;
		$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

		// Cek apakah file adalah gambar
		$check = getimagesize($_FILES['foto_produk']['tmp_name']);
		if ($check === false) {
			$errors[] = "File bukan gambar.";
			$uploadOk = 0;
		}

		// Cek ukuran file
		if ($_FILES['foto_produk']['size'] > 500000) {
			$errors[] = "Ukuran file terlalu besar.";
			$uploadOk = 0;
		}

		// Hanya izinkan file dengan ekstensi tertentu
		if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
			$errors[] = "Hanya file JPG, JPEG, & PNG yang diperbolehkan.";
			$uploadOk = 0;
		}

		// Cek jika semua validasi lolos
		if ($uploadOk == 1) {
			// Buat direktori `assets/pic` jika belum ada
			if (!is_dir($target_dir)) {
				mkdir($target_dir, 0755, true);
			}

			// Pindahkan file yang diunggah
			if (move_uploaded_file($_FILES['foto_produk']['tmp_name'], $target_file)) {
				// Simpan data ke database
				$stmt = $conn->prepare("INSERT INTO tb_produk (nama_produk, foto_produk, id_kategori, stok, diskon, harga, deskripsi, dimensi, warna, kain, kayu) 
                                        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
				$stmt->bind_param("ssiiissssss", $nama_produk, $foto_produk, $id_kategori, $stok, $diskon, $harga, $deskripsi, $dimensi, $warna, $kain, $kayu);

				if ($stmt->execute()) {
					header("Location: product-list.php");  // Redirect setelah berhasil menyimpan
					exit;
				} else {
					echo "Gagal menyimpan data ke database: " . mysqli_error($conn) . "<br>";
				}
			} else {
				$errors[] = "Gagal mengunggah file.";
			}
		}
	}

	// Tampilkan pesan error jika ada
	if (!empty($errors)) {
		foreach ($errors as $error) {
			echo "<p style='color: red;'>$error</p>";
		}
	}
}

$conn->close();
?>


<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="keywords" content="">
	<meta name="author" content="">
	<meta name="robots" content="">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="Fillow : Fillow Saas Admin  Bootstrap 5 Template">
	<meta property="og:title" content="Fillow : Fillow Saas Admin  Bootstrap 5 Template">
	<meta property="og:description" content="Fillow : Fillow Saas Admin  Bootstrap 5 Template">
	<meta property="og:image" content="https://fillow.dexignlab.com/xhtml/social-image.png">
	<meta name="format-detection" content="telephone=no">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

	<!-- PAGE TITLE HERE -->
	<title>Admin Dashboard</title>

	<!-- FAVICONS ICON -->
	<link rel="shortcut icon" type="image/png" href="images/favicon.png">
	<!-- Datatable -->
	<link href="vendor/datatables/css/jquery.dataTables.min.css" rel="stylesheet">
	<!-- Custom Stylesheet -->
	<link href="vendor/jquery-nice-select/css/nice-select.css" rel="stylesheet">
	<link href="css/style.css" rel="stylesheet">

</head>
<style>
	/* Default Light Mode */
	:root {
		--circle-bg: #f0f0f0;
		--icon-color: #000;
	}

	/* Dark Mode */
	body.dark-mode {
		--circle-bg: #333;
		--icon-color: #fff;
	}

	/* Mode Gelap untuk Dropdown */
	body.dark-mode .dropdown-menu {
		background-color: #444;
		color: #fff;
	}

	body.dark-mode .dropdown-item {
		color: #fff;
	}

	body.dark-mode .dropdown-item:hover {
		background-color: #555;
	}
</style>

<body>

	<!--*******************
		Preloader start
	********************-->
	<div id="preloader">
		<div class="lds-ripple">
			<div></div>
			<div></div>
		</div>
	</div>
	<!--*******************
		Preloader end
	********************-->


	<!--**********************************
		Main wrapper start
	***********************************-->
	<div id="main-wrapper">

		<!--**********************************
			Nav header start
		***********************************-->
		<div class="nav-header">
			<a href="index.php" class="brand-logo">
				<svg class="logo-abbr" width="55" height="55" viewbox="0 0 55 55" fill="none"
					xmlns="http://www.w3.org/2000/svg">
					<path fill-rule="evenodd" clip-rule="evenodd"
						d="M27.5 0C12.3122 0 0 12.3122 0 27.5C0 42.6878 12.3122 55 27.5 55C42.6878 55 55 42.6878 55 27.5C55 12.3122 42.6878 0 27.5 0ZM28.0092 46H19L19.0001 34.9784L19 27.5803V24.4779C19 14.3752 24.0922 10 35.3733 10V17.5571C29.8894 17.5571 28.0092 19.4663 28.0092 24.4779V27.5803H36V34.9784H28.0092V46Z"
						fill="url(#paint0_linear)"></path>
					<defs>
					</defs>
				</svg>
				<div class="brand-title">
					<h2 class="">Decor.</h2>
					<span class="brand-sub-title">@decor</span>
				</div>
			</a>
			<div class="nav-control">
				<div class="hamburger">
					<span class="line"></span><span class="line"></span><span class="line"></span>
				</div>
			</div>
		</div>
		<!--**********************************
			Nav header end
		***********************************-->

		<!--**********************************
			Chat box start
		***********************************-->
		<div class="chatbox">
			<div class="chatbox-close"></div>
			<div class="custom-tab-1">
				<ul class="nav nav-tabs">
					<li class="nav-item">
						<a class="nav-link" data-bs-toggle="tab" href="#notes">Notes</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" data-bs-toggle="tab" href="#alerts">Alerts</a>
					</li>
					<li class="nav-item">
						<a class="nav-link active" data-bs-toggle="tab" href="#chat">Chat</a>
					</li>
				</ul>
				<div class="tab-content">
					<div class="tab-pane fade active show" id="chat" role="tabpanel">
						<div class="card mb-sm-3 mb-md-0 contacts_card dlab-chat-user-box">
							<div class="card-header chat-list-header text-center">
								<a href="javascript:void(0);"><svg xmlns="http://www.w3.org/2000/svg"
										xmlns:xlink="http://www.w3.org/1999/xlink" width="18px" height="18px"
										viewbox="0 0 24 24" version="1.1">
										<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
											<rect fill="#000000" x="4" y="11" width="16" height="2" rx="1"></rect>
											<rect fill="#000000" opacity="0.3"
												transform="translate(12.000000, 12.000000) rotate(-270.000000) translate(-12.000000, -12.000000) "
												x="4" y="11" width="16" height="2" rx="1"></rect>
										</g>
									</svg></a>
								<div>
									<h6 class="mb-1">Chat List</h6>
									<p class="mb-0">Show All</p>
								</div>
								<a href="javascript:void(0);"><svg xmlns="http://www.w3.org/2000/svg"
										xmlns:xlink="http://www.w3.org/1999/xlink" width="18px" height="18px"
										viewbox="0 0 24 24" version="1.1">
										<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
											<rect x="0" y="0" width="24" height="24"></rect>
											<circle fill="#000000" cx="5" cy="12" r="2"></circle>
											<circle fill="#000000" cx="12" cy="12" r="2"></circle>
											<circle fill="#000000" cx="19" cy="12" r="2"></circle>
										</g>
									</svg></a>
							</div>
							<div class="card-body contacts_body p-0 dlab-scroll  " id="DLAB_W_Contacts_Body">
								<ul class="contacts">
									<li class="name-first-letter">A</li>
									<li class="active dlab-chat-user">
										<div class="d-flex bd-highlight">
											<div class="img_cont">
												<img src="images/avatar/1.jpg" class="rounded-circle user_img" alt="">
												<span class="online_icon"></span>
											</div>
											<div class="user_info">
												<span>Archie Parker</span>
												<p>Kalid is online</p>
											</div>
										</div>
									</li>
									<li class="dlab-chat-user">
										<div class="d-flex bd-highlight">
											<div class="img_cont">
												<img src="images/avatar/2.jpg" class="rounded-circle user_img" alt="">
												<span class="online_icon offline"></span>
											</div>
											<div class="user_info">
												<span>Alfie Mason</span>
												<p>Taherah left 7 mins ago</p>
											</div>
										</div>
									</li>
									<li class="dlab-chat-user">
										<div class="d-flex bd-highlight">
											<div class="img_cont">
												<img src="images/avatar/3.jpg" class="rounded-circle user_img" alt="">
												<span class="online_icon"></span>
											</div>
											<div class="user_info">
												<span>AharlieKane</span>
												<p>Sami is online</p>
											</div>
										</div>
									</li>
									<li class="dlab-chat-user">
										<div class="d-flex bd-highlight">
											<div class="img_cont">
												<img src="images/avatar/4.jpg" class="rounded-circle user_img" alt="">
												<span class="online_icon offline"></span>
											</div>
											<div class="user_info">
												<span>Athan Jacoby</span>
												<p>Nargis left 30 mins ago</p>
											</div>
										</div>
									</li>
									<li class="name-first-letter">B</li>
									<li class="dlab-chat-user">
										<div class="d-flex bd-highlight">
											<div class="img_cont">
												<img src="images/avatar/5.jpg" class="rounded-circle user_img" alt="">
												<span class="online_icon offline"></span>
											</div>
											<div class="user_info">
												<span>Bashid Samim</span>
												<p>Rashid left 50 mins ago</p>
											</div>
										</div>
									</li>
									<li class="dlab-chat-user">
										<div class="d-flex bd-highlight">
											<div class="img_cont">
												<img src="images/avatar/1.jpg" class="rounded-circle user_img" alt="">
												<span class="online_icon"></span>
											</div>
											<div class="user_info">
												<span>Breddie Ronan</span>
												<p>Kalid is online</p>
											</div>
										</div>
									</li>
									<li class="dlab-chat-user">
										<div class="d-flex bd-highlight">
											<div class="img_cont">
												<img src="images/avatar/2.jpg" class="rounded-circle user_img" alt="">
												<span class="online_icon offline"></span>
											</div>
											<div class="user_info">
												<span>Ceorge Carson</span>
												<p>Taherah left 7 mins ago</p>
											</div>
										</div>
									</li>
									<li class="name-first-letter">D</li>
									<li class="dlab-chat-user">
										<div class="d-flex bd-highlight">
											<div class="img_cont">
												<img src="images/avatar/3.jpg" class="rounded-circle user_img" alt="">
												<span class="online_icon"></span>
											</div>
											<div class="user_info">
												<span>Darry Parker</span>
												<p>Sami is online</p>
											</div>
										</div>
									</li>
									<li class="dlab-chat-user">
										<div class="d-flex bd-highlight">
											<div class="img_cont">
												<img src="images/avatar/4.jpg" class="rounded-circle user_img" alt="">
												<span class="online_icon offline"></span>
											</div>
											<div class="user_info">
												<span>Denry Hunter</span>
												<p>Nargis left 30 mins ago</p>
											</div>
										</div>
									</li>
									<li class="name-first-letter">J</li>
									<li class="dlab-chat-user">
										<div class="d-flex bd-highlight">
											<div class="img_cont">
												<img src="images/avatar/5.jpg" class="rounded-circle user_img" alt="">
												<span class="online_icon offline"></span>
											</div>
											<div class="user_info">
												<span>Jack Ronan</span>
												<p>Rashid left 50 mins ago</p>
											</div>
										</div>
									</li>
									<li class="dlab-chat-user">
										<div class="d-flex bd-highlight">
											<div class="img_cont">
												<img src="images/avatar/1.jpg" class="rounded-circle user_img" alt="">
												<span class="online_icon"></span>
											</div>
											<div class="user_info">
												<span>Jacob Tucker</span>
												<p>Kalid is online</p>
											</div>
										</div>
									</li>
									<li class="dlab-chat-user">
										<div class="d-flex bd-highlight">
											<div class="img_cont">
												<img src="images/avatar/2.jpg" class="rounded-circle user_img" alt="">
												<span class="online_icon offline"></span>
											</div>
											<div class="user_info">
												<span>James Logan</span>
												<p>Taherah left 7 mins ago</p>
											</div>
										</div>
									</li>
									<li class="dlab-chat-user">
										<div class="d-flex bd-highlight">
											<div class="img_cont">
												<img src="images/avatar/3.jpg" class="rounded-circle user_img" alt="">
												<span class="online_icon"></span>
											</div>
											<div class="user_info">
												<span>Joshua Weston</span>
												<p>Sami is online</p>
											</div>
										</div>
									</li>
									<li class="name-first-letter">O</li>
									<li class="dlab-chat-user">
										<div class="d-flex bd-highlight">
											<div class="img_cont">
												<img src="images/avatar/4.jpg" class="rounded-circle user_img" alt="">
												<span class="online_icon offline"></span>
											</div>
											<div class="user_info">
												<span>Oliver Acker</span>
												<p>Nargis left 30 mins ago</p>
											</div>
										</div>
									</li>
									<li class="dlab-chat-user">
										<div class="d-flex bd-highlight">
											<div class="img_cont">
												<img src="images/avatar/5.jpg" class="rounded-circle user_img" alt="">
												<span class="online_icon offline"></span>
											</div>
											<div class="user_info">
												<span>Oscar Weston</span>
												<p>Rashid left 50 mins ago</p>
											</div>
										</div>
									</li>
								</ul>
							</div>
						</div>
						<div class="card chat dlab-chat-history-box d-none">
							<div class="card-header chat-list-header text-center">
								<a href="javascript:void(0);" class="dlab-chat-history-back">
									<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
										width="18px" height="18px" viewbox="0 0 24 24" version="1.1">
										<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
											<polygon points="0 0 24 0 24 24 0 24"></polygon>
											<rect fill="#000000" opacity="0.3"
												transform="translate(15.000000, 12.000000) scale(-1, 1) rotate(-90.000000) translate(-15.000000, -12.000000) "
												x="14" y="7" width="2" height="10" rx="1"></rect>
											<path
												d="M3.7071045,15.7071045 C3.3165802,16.0976288 2.68341522,16.0976288 2.29289093,15.7071045 C1.90236664,15.3165802 1.90236664,14.6834152 2.29289093,14.2928909 L8.29289093,8.29289093 C8.67146987,7.914312 9.28105631,7.90106637 9.67572234,8.26284357 L15.6757223,13.7628436 C16.0828413,14.136036 16.1103443,14.7686034 15.7371519,15.1757223 C15.3639594,15.5828413 14.7313921,15.6103443 14.3242731,15.2371519 L9.03007346,10.3841355 L3.7071045,15.7071045 Z"
												fill="#000000" fill-rule="nonzero"
												transform="translate(9.000001, 11.999997) scale(-1, -1) rotate(90.000000) translate(-9.000001, -11.999997) ">
											</path>
										</g>
									</svg>
								</a>
								<div>
									<h6 class="mb-1">Chat with Khelesh</h6>
									<p class="mb-0 text-success">Online</p>
								</div>
								<div class="dropdown">
									<a href="javascript:void(0);" data-bs-toggle="dropdown" aria-expanded="false"><svg
											xmlns="http://www.w3.org/2000/svg"
											xmlns:xlink="http://www.w3.org/1999/xlink" width="18px" height="18px"
											viewbox="0 0 24 24" version="1.1">
											<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
												<rect x="0" y="0" width="24" height="24"></rect>
												<circle fill="#000000" cx="5" cy="12" r="2"></circle>
												<circle fill="#000000" cx="12" cy="12" r="2"></circle>
												<circle fill="#000000" cx="19" cy="12" r="2"></circle>
											</g>
										</svg></a>
									<ul class="dropdown-menu dropdown-menu-end">
										<li class="dropdown-item"><i class="fa fa-user-circle text-primary me-2"></i>
											View profile</li>
										<li class="dropdown-item"><i class="fa fa-users text-primary me-2"></i> Add to
											btn-close friends</li>
										<li class="dropdown-item"><i class="fa fa-plus text-primary me-2"></i> Add to
											group</li>
										<li class="dropdown-item"><i class="fa fa-ban text-primary me-2"></i> Block</li>
									</ul>
								</div>
							</div>
							<div class="card-body msg_card_body dlab-scroll" id="DLAB_W_Contacts_Body3">
								<div class="d-flex justify-content-start mb-4">
									<div class="img_cont_msg">
										<img src="images/avatar/1.jpg" class="rounded-circle user_img_msg" alt="">
									</div>
									<div class="msg_cotainer">
										Hi, how are you samim?
										<span class="msg_time">8:40 AM, Today</span>
									</div>
								</div>
								<div class="d-flex justify-content-end mb-4">
									<div class="msg_cotainer_send">
										Hi Khalid i am good tnx how about you?
										<span class="msg_time_send">8:55 AM, Today</span>
									</div>
									<div class="img_cont_msg">
										<img src="images/avatar/2.jpg" class="rounded-circle user_img_msg" alt="">
									</div>
								</div>
								<div class="d-flex justify-content-start mb-4">
									<div class="img_cont_msg">
										<img src="images/avatar/1.jpg" class="rounded-circle user_img_msg" alt="">
									</div>
									<div class="msg_cotainer">
										I am good too, thank you for your chat template
										<span class="msg_time">9:00 AM, Today</span>
									</div>
								</div>
								<div class="d-flex justify-content-end mb-4">
									<div class="msg_cotainer_send">
										You are welcome
										<span class="msg_time_send">9:05 AM, Today</span>
									</div>
									<div class="img_cont_msg">
										<img src="images/avatar/2.jpg" class="rounded-circle user_img_msg" alt="">
									</div>
								</div>
								<div class="d-flex justify-content-start mb-4">
									<div class="img_cont_msg">
										<img src="images/avatar/1.jpg" class="rounded-circle user_img_msg" alt="">
									</div>
									<div class="msg_cotainer">
										I am looking for your next templates
										<span class="msg_time">9:07 AM, Today</span>
									</div>
								</div>
								<div class="d-flex justify-content-end mb-4">
									<div class="msg_cotainer_send">
										Ok, thank you have a good day
										<span class="msg_time_send">9:10 AM, Today</span>
									</div>
									<div class="img_cont_msg">
										<img src="images/avatar/2.jpg" class="rounded-circle user_img_msg" alt="">
									</div>
								</div>
								<div class="d-flex justify-content-start mb-4">
									<div class="img_cont_msg">
										<img src="images/avatar/1.jpg" class="rounded-circle user_img_msg" alt="">
									</div>
									<div class="msg_cotainer">
										Bye, see you
										<span class="msg_time">9:12 AM, Today</span>
									</div>
								</div>
								<div class="d-flex justify-content-start mb-4">
									<div class="img_cont_msg">
										<img src="images/avatar/1.jpg" class="rounded-circle user_img_msg" alt="">
									</div>
									<div class="msg_cotainer">
										Hi, how are you samim?
										<span class="msg_time">8:40 AM, Today</span>
									</div>
								</div>
								<div class="d-flex justify-content-end mb-4">
									<div class="msg_cotainer_send">
										Hi Khalid i am good tnx how about you?
										<span class="msg_time_send">8:55 AM, Today</span>
									</div>
									<div class="img_cont_msg">
										<img src="images/avatar/2.jpg" class="rounded-circle user_img_msg" alt="">
									</div>
								</div>
								<div class="d-flex justify-content-start mb-4">
									<div class="img_cont_msg">
										<img src="images/avatar/1.jpg" class="rounded-circle user_img_msg" alt="">
									</div>
									<div class="msg_cotainer">
										I am good too, thank you for your chat template
										<span class="msg_time">9:00 AM, Today</span>
									</div>
								</div>
								<div class="d-flex justify-content-end mb-4">
									<div class="msg_cotainer_send">
										You are welcome
										<span class="msg_time_send">9:05 AM, Today</span>
									</div>
									<div class="img_cont_msg">
										<img src="images/avatar/2.jpg" class="rounded-circle user_img_msg" alt="">
									</div>
								</div>
								<div class="d-flex justify-content-start mb-4">
									<div class="img_cont_msg">
										<img src="images/avatar/1.jpg" class="rounded-circle user_img_msg" alt="">
									</div>
									<div class="msg_cotainer">
										I am looking for your next templates
										<span class="msg_time">9:07 AM, Today</span>
									</div>
								</div>
								<div class="d-flex justify-content-end mb-4">
									<div class="msg_cotainer_send">
										Ok, thank you have a good day
										<span class="msg_time_send">9:10 AM, Today</span>
									</div>
									<div class="img_cont_msg">
										<img src="images/avatar/2.jpg" class="rounded-circle user_img_msg" alt="">
									</div>
								</div>
								<div class="d-flex justify-content-start mb-4">
									<div class="img_cont_msg">
										<img src="images/avatar/1.jpg" class="rounded-circle user_img_msg" alt="">
									</div>
									<div class="msg_cotainer">
										Bye, see you
										<span class="msg_time">9:12 AM, Today</span>
									</div>
								</div>
							</div>
							<div class="card-footer type_msg">
								<div class="input-group">
									<textarea class="form-control" placeholder="Type your message..."></textarea>
									<div class="input-group-append">
										<button type="button" class="btn btn-primary"><i
												class="fa fa-location-arrow"></i></button>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="tab-pane fade" id="alerts" role="tabpanel">
						<div class="card mb-sm-3 mb-md-0 contacts_card">
							<div class="card-header chat-list-header text-center">
								<a href="javascript:void(0);"><svg xmlns="http://www.w3.org/2000/svg"
										xmlns:xlink="http://www.w3.org/1999/xlink" width="18px" height="18px"
										viewbox="0 0 24 24" version="1.1">
										<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
											<rect x="0" y="0" width="24" height="24"></rect>
											<circle fill="#000000" cx="5" cy="12" r="2"></circle>
											<circle fill="#000000" cx="12" cy="12" r="2"></circle>
											<circle fill="#000000" cx="19" cy="12" r="2"></circle>
										</g>
									</svg></a>
								<div>
									<h6 class="mb-1">Notications</h6>
									<p class="mb-0">Show All</p>
								</div>
								<a href="javascript:void(0);"><svg xmlns="http://www.w3.org/2000/svg"
										xmlns:xlink="http://www.w3.org/1999/xlink" width="18px" height="18px"
										viewbox="0 0 24 24" version="1.1">
										<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
											<rect x="0" y="0" width="24" height="24"></rect>
											<path
												d="M14.2928932,16.7071068 C13.9023689,16.3165825 13.9023689,15.6834175 14.2928932,15.2928932 C14.6834175,14.9023689 15.3165825,14.9023689 15.7071068,15.2928932 L19.7071068,19.2928932 C20.0976311,19.6834175 20.0976311,20.3165825 19.7071068,20.7071068 C19.3165825,21.0976311 18.6834175,21.0976311 18.2928932,20.7071068 L14.2928932,16.7071068 Z"
												fill="#000000" fill-rule="nonzero" opacity="0.3"></path>
											<path
												d="M11,16 C13.7614237,16 16,13.7614237 16,11 C16,8.23857625 13.7614237,6 11,6 C8.23857625,6 6,8.23857625 6,11 C6,13.7614237 8.23857625,16 11,16 Z M11,18 C7.13400675,18 4,14.8659932 4,11 C4,7.13400675 7.13400675,4 11,4 C14.8659932,4 18,7.13400675 18,11 C18,14.8659932 14.8659932,18 11,18 Z"
												fill="#000000" fill-rule="nonzero"></path>
										</g>
									</svg></a>
							</div>
							<div class="card-body contacts_body p-0 dlab-scroll" id="DLAB_W_Contacts_Body1">
								<ul class="contacts">
									<li class="name-first-letter">SEVER STATUS</li>
									<li class="active">
										<div class="d-flex bd-highlight">
											<div class="img_cont primary">KK</div>
											<div class="user_info">
												<span>David Nester Birthday</span>
												<p class="text-primary">Today</p>
											</div>
										</div>
									</li>
									<li class="name-first-letter">SOCIAL</li>
									<li>
										<div class="d-flex bd-highlight">
											<div class="img_cont success">RU</div>
											<div class="user_info">
												<span>Perfection Simplified</span>
												<p>Jame Smith commented on your status</p>
											</div>
										</div>
									</li>
									<li class="name-first-letter">SEVER STATUS</li>
									<li>
										<div class="d-flex bd-highlight">
											<div class="img_cont primary">AU</div>
											<div class="user_info">
												<span>AharlieKane</span>
												<p>Sami is online</p>
											</div>
										</div>
									</li>
									<li>
										<div class="d-flex bd-highlight">
											<div class="img_cont info">MO</div>
											<div class="user_info">
												<span>Athan Jacoby</span>
												<p>Nargis left 30 mins ago</p>
											</div>
										</div>
									</li>
								</ul>
							</div>
							<div class="card-footer"></div>
						</div>
					</div>
					<div class="tab-pane fade" id="notes">
						<div class="card mb-sm-3 mb-md-0 note_card">
							<div class="card-header chat-list-header text-center">
								<a href="javascript:void(0);"><svg xmlns="http://www.w3.org/2000/svg"
										xmlns:xlink="http://www.w3.org/1999/xlink" width="18px" height="18px"
										viewbox="0 0 24 24" version="1.1">
										<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
											<rect fill="#000000" x="4" y="11" width="16" height="2" rx="1"></rect>
											<rect fill="#000000" opacity="0.3"
												transform="translate(12.000000, 12.000000) rotate(-270.000000) translate(-12.000000, -12.000000) "
												x="4" y="11" width="16" height="2" rx="1"></rect>
										</g>
									</svg></a>
								<div>
									<h6 class="mb-1">Notes</h6>
									<p class="mb-0">Add New Nots</p>
								</div>
								<a href="javascript:void(0);"><svg xmlns="http://www.w3.org/2000/svg"
										xmlns:xlink="http://www.w3.org/1999/xlink" width="18px" height="18px"
										viewbox="0 0 24 24" version="1.1">
										<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
											<rect x="0" y="0" width="24" height="24"></rect>
											<path
												d="M14.2928932,16.7071068 C13.9023689,16.3165825 13.9023689,15.6834175 14.2928932,15.2928932 C14.6834175,14.9023689 15.3165825,14.9023689 15.7071068,15.2928932 L19.7071068,19.2928932 C20.0976311,19.6834175 20.0976311,20.3165825 19.7071068,20.7071068 C19.3165825,21.0976311 18.6834175,21.0976311 18.2928932,20.7071068 L14.2928932,16.7071068 Z"
												fill="#000000" fill-rule="nonzero" opacity="0.3"></path>
											<path
												d="M11,16 C13.7614237,16 16,13.7614237 16,11 C16,8.23857625 13.7614237,6 11,6 C8.23857625,6 6,8.23857625 6,11 C6,13.7614237 8.23857625,16 11,16 Z M11,18 C7.13400675,18 4,14.8659932 4,11 C4,7.13400675 7.13400675,4 11,4 C14.8659932,4 18,7.13400675 18,11 C18,14.8659932 14.8659932,18 11,18 Z"
												fill="#000000" fill-rule="nonzero"></path>
										</g>
									</svg></a>
							</div>
							<div class="card-body contacts_body p-0 dlab-scroll" id="DLAB_W_Contacts_Body2">
								<ul class="contacts">
									<li class="active">
										<div class="d-flex bd-highlight">
											<div class="user_info">
												<span>New order placed..</span>
												<p>10 Aug 2020</p>
											</div>
											<div class="ms-auto">
												<a href="javascript:void(0);"
													class="btn btn-primary btn-xs sharp me-1"><i
														class="fas fa-pencil-alt"></i></a>
												<a href="javascript:void(0);" class="btn btn-danger btn-xs sharp"><i
														class="fa fa-trash"></i></a>
											</div>
										</div>
									</li>
									<li>
										<div class="d-flex bd-highlight">
											<div class="user_info">
												<span>Youtube, a video-sharing website..</span>
												<p>10 Aug 2020</p>
											</div>
											<div class="ms-auto">
												<a href="javascript:void(0);"
													class="btn btn-primary btn-xs sharp me-1"><i
														class="fas fa-pencil-alt"></i></a>
												<a href="javascript:void(0);" class="btn btn-danger btn-xs sharp"><i
														class="fa fa-trash"></i></a>
											</div>
										</div>
									</li>
									<li>
										<div class="d-flex bd-highlight">
											<div class="user_info">
												<span>john just buy your product..</span>
												<p>10 Aug 2020</p>
											</div>
											<div class="ms-auto">
												<a href="javascript:void(0);"
													class="btn btn-primary btn-xs sharp me-1"><i
														class="fas fa-pencil-alt"></i></a>
												<a href="javascript:void(0);" class="btn btn-danger btn-xs sharp"><i
														class="fa fa-trash"></i></a>
											</div>
										</div>
									</li>
									<li>
										<div class="d-flex bd-highlight">
											<div class="user_info">
												<span>Athan Jacoby</span>
												<p>10 Aug 2020</p>
											</div>
											<div class="ms-auto">
												<a href="javascript:void(0);"
													class="btn btn-primary btn-xs sharp me-1"><i
														class="fas fa-pencil-alt"></i></a>
												<a href="javascript:void(0);" class="btn btn-danger btn-xs sharp"><i
														class="fa fa-trash"></i></a>
											</div>
										</div>
									</li>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!--**********************************
			Chat box End
		***********************************-->




		<!--**********************************
			Header start
		***********************************-->
		<div class="header border-bottom">
			<div class="header-content">
				<nav class="navbar navbar-expand">
					<div class="collapse navbar-collapse justify-content-between">
						<div class="header-left">
						</div>


						<li class="nav-item dropdown header-profile">
							<a class="nav-link" href="javascript:void(0);" role="button" data-bs-toggle="dropdown"
								style="display: flex; align-items: center; justify-content: center; width: 32px; height: 32px; background-color: var(--circle-bg, #f0f0f0); border-radius: 50%; padding: 0;">
								<!-- Ikon user menggunakan SVG -->
								<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
									class="bi bi-person" viewBox="0 0 16 16" style="color: var(--icon-color, #000);">
									<path
										d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm-5.784 6a5.998 5.998 0 0 1 11.568 0H2.216z" />
								</svg>
							</a>
							<div class="dropdown-menu dropdown-menu-end">
								<a href="../user/logout.php" class="dropdown-item ai-icon">
									<svg id="icon-logout" xmlns="http://www.w3.org/2000/svg" class="text-danger"
										width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor"
										stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
										<path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
										<polyline points="16 17 21 12 16 7"></polyline>
										<line x1="21" y1="12" x2="9" y2="12"></line>
									</svg>
									<span class="ms-2">Keluar</span>
								</a>
							</div>
						</li>
					</div>
				</nav>
			</div>
		</div>
	</div>

	<!--**********************************
			Header end ti-comment-alt
		***********************************-->

	<!--**********************************
			Sidebar start
		***********************************-->
	<div class="dlabnav">
		<div class="dlabnav-scroll">
			<ul class="metismenu" id="menu">
				<li><a href="index.php" class="" aria-expanded="false">
						<i class="fas fa-home"></i>
						<span class="nav-text">Dashboard</span>
					</a>
				</li>

				<li>
					<a class="has-arrow" href="javascript:void()" aria-expanded="false">
						<i class="fas fa-cog"></i> <!-- Mengganti ikon menjadi gear (manage) -->
						<span class="nav-text">Manage</span>
					</a>


					<ul aria-expanded="false">

						<li><a class="has-arrow" href="javascript:void()" aria-expanded="false">Produk</a>
							<ul aria-expanded="false">
								<li><a href="product-list.php">Daftar Produk</a></li>
								<li><a href="pesanan.php">Pesanan</a></li>
							</ul>
						<li><a href="kategori.php">Kategori</a></li>
						<li><a href="user.php">User</a></li>
				</li>
			</ul>
			</li>



			<li><a href="komentar.php" class="" aria-expanded="false">
					<i class="fas fa-comment-dots"></i>
					<span class="nav-text">Komentar</span>
				</a>
			</li>

		</div>
	</div>
	<!--**********************************
			Sidebar end
		***********************************-->

	<!--**********************************
			Content body start
		***********************************-->
	<div class="content-body">
		<div class="container-fluid">
			<div class="row">
				<div class="col-xl-12 col-xxl-12">
					<div class="card">
						<div class="card-header">
							<h4 class="card-title">Tambah Produk</h4>
						</div>
						<div class="card-body">
							<form id="formProduk" action="addproduct.php" method="POST" enctype="multipart/form-data">
								<div class="row">
									<!-- Nama Produk -->
									<div class="col-lg-6 mb-3">
										<div class="form-group">
											<label class="form-label">Nama Produk*</label>
											<input type="text" name="nama_produk" class="form-control"
												placeholder="Nama Produk" required>
										</div>
									</div>

									<!-- Kategori Produk -->
									<div class="col-lg-6 mb-3">
										<div class="form-group">
											<label class="form-label">Kategori*</label>
											<select class="default-select wide form-control" name="id_kategori"
												id="kategoriSelect" required>
												<option data-display="Pilih Kategori">Pilih Kategori</option>
												<?php
												// Menampilkan kategori dari query yang diambil
												if ($result_kategori->num_rows > 0) {
													while ($row = $result_kategori->fetch_assoc()) {
														echo '<option value="' . $row['id_kategori'] . '">' . $row['nama_kategori'] . '</option>';
													}
												} else {
													echo '<option value="">Tidak ada kategori tersedia</option>';
												}
												?>
											</select>
										</div>
									</div>

									<!-- Stok Produk -->
									<div class="col-lg-6 mb-3">
										<div class="form-group">
											<label class="form-label">Stok*</label>
											<input type="number" name="stok" class="form-control"
												placeholder="Masukkan jumlah stok" required>
										</div>
									</div>

									<!-- Harga Produk -->
									<div class="col-lg-6 mb-3">
										<div class="form-group">
											<label class="form-label">Harga*</label>
											<input type="number" name="harga" class="form-control"
												placeholder="Masukkan harga" required>
										</div>
									</div>

									<!-- Diskon Produk -->
									<div class="col-lg-6 mb-3">
										<div class="form-group">
											<label class="form-label">Diskon (%)</label>
											<input type="number" name="diskon" class="form-control" step="0.01" min="0"
												max="100" placeholder="Masukkan diskon" value="0"
												onfocus="if(this.value == '0') this.value=''"
												onblur="if(this.value == '') this.value='0'">
										</div>
									</div>


									<!-- Dimensi Produk -->
									<div class="col-lg-6 mb-3">
										<div class="form-group">
											<label class="form-label">Dimensi*</label>
											<input type="text" name="dimensi" class="form-control"
												placeholder=" (cth: Panjang: 175 cm x Kedalaman: 86 cm)" required>
										</div>
									</div>

									<!-- Warna Produk -->
									<div class="col-lg-6 mb-3">
										<div class="form-group">
											<label class="form-label">Warna*</label>
											<input type="text" name="warna" class="form-control"
												placeholder="Masukkan warna" required>
										</div>
									</div>

									<!-- Kain Produk -->
									<div class="col-lg-6 mb-3">
										<div class="form-group">
											<label class="form-label">Kain*</label>
											<input type="text" name="kain" class="form-control"
												placeholder="Masukkan jenis kain" required>
										</div>
									</div>

									<!-- Kayu Produk -->
									<div class="col-lg-6 mb-3">
										<div class="form-group">
											<label class="form-label">Kayu*</label>
											<input type="text" name="kayu" class="form-control"
												placeholder="Masukkan jenis kayu " required>
										</div>
									</div>

									<!-- Deskripsi Produk -->
									<div class="col-lg-12 mb-3">
										<div class="form-group">
											<label class="form-label">Deskripsi Produk*</label>
											<textarea name="deskripsi" class="form-control" style="height: 200px;"
												placeholder="Masukkan deskripsi produk" required></textarea>
										</div>
									</div>

									<!-- Gambar Produk -->
									<div class="col-lg-12 mb-3">
										<div class="form-group">
											<label class="form-label">Gambar Produk*</label>
											<div class="image-upload" id="imageUpload"
												style="border: 2px dashed #ccc; text-align: center; padding: 50px 0; position: relative;">
												<input type="file" name="foto_produk" id="foto_produk" accept="image/*"
													required style="display: none;">
												<div class="image-uploads" id="imagePreview"
													onclick="document.getElementById('foto_produk').click();">
													<i class="fas fa-upload"
														style="font-size: 30px; color: #ff5722; margin-bottom: 10px;"></i>
													<h4 style="color: #666;">Seret dan jatuhkan file untuk diunggah
													</h4>
													<span id="cancelIcon" class="cancel-icon"
														style="display: none; position: absolute; top: 10px; right: 10px;"
														onclick="clearImage(event);">
														<i class="fas fa-times"
															style="cursor: pointer; font-size: 20px;"></i>
													</span>
												</div>
											</div>
										</div>
									</div>

									<!-- Tombol Submit dan Batal -->
									<div class="col-lg-12">
										<button type="submit" id="submitBtn" class="btn btn-primary">Kirim</button>
										<a href="product-list.php" class="btn btn-secondary">Batal</a>
									</div>
								</div>
							</form>

							<!-- Menampilkan gambar yang diunggah (untuk debugging) -->
							<?php if (!empty($foto_produk)) { ?>
								<div class="uploaded-image">
									<h5>Gambar yang diunggah:</h5>
									<img src="uploads/<?php echo $foto_produk; ?>" alt="Gambar Produk"
										style="max-width: 100%; height: auto;">
								</div>
							<?php } ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!--**********************************
			Content body end
		***********************************-->


	<!--**********************************
			Footer start
		***********************************-->

	<!--**********************************
			Footer end
		***********************************-->

	<!--**********************************
		   Support ticket button start
		***********************************-->

	<!--**********************************
		   Support ticket button end
		***********************************-->


	</div>
	<!--**********************************
		Main wrapper end
	***********************************-->

	<!--**********************************
		Scripts
	***********************************-->
	<!-- Required vendors -->
	<script src="vendor/global/global.min.js"></script>

	<script src="vendor/jquery-steps/build/jquery.steps.min.js"></script>
	<script src="vendor/jquery-validation/jquery.validate.min.js"></script>
	<!-- Form validate init -->
	<script src="js/plugins-init/jquery.validate-init.js"></script>


	<!-- Form Steps -->
	<script src="vendor/jquery-smartwizard/dist/js/jquery.smartWizard.js"></script>
	<script src="vendor/jquery-nice-select/js/jquery.nice-select.min.js"></script>

	<script src="js/custom.min.js"></script>
	<script src="js/dlabnav-init.js"></script>
	<script src="js/demo.js"></script>
	<script src="js/styleSwitcher.js"></script>
	<script>
		// Elemen yang diperlukan
		const imageUpload = document.getElementById('imageUpload');
		const fileInput = document.getElementById('foto_produk');
		const imagePreview = document.getElementById('imagePreview');
		const cancelIcon = document.getElementById('cancelIcon');
		const modalImage = document.getElementById('modalImage');

		// Fungsi untuk menangani file
		function handleFile(file) {
			const reader = new FileReader();
			reader.onload = function (e) {
				imagePreview.innerHTML = `<img src="${e.target.result}" alt="Uploaded Image" style="max-width: 100%; max-height: 150px; object-fit: contain;">`;
				cancelIcon.style.display = 'block'; // Tampilkan ikon cancel
				imageUpload.classList.add('active'); // Tambahkan kelas untuk styling aktif
				imagePreview.onclick = () => {
					modalImage.src = e.target.result; // Set src modal
					$('#imageModal').modal('show'); // Tampilkan modal
				};
			};
			reader.readAsDataURL(file); // Membaca file
		}

		// Fungsi untuk menangani event dari input file
		fileInput.addEventListener('change', (event) => {
			const file = event.target.files[0];
			if (file && file.type.startsWith('image/')) {
				handleFile(file); // Memproses file gambar
			} else {
				alert('Mohon pilih file gambar yang valid.');
			}
		});

		// Fungsi untuk menangani drag and drop
		function dropHandler(event) {
			event.preventDefault();
			const file = event.dataTransfer.files[0];
			if (file && file.type.startsWith('image/')) {
				handleFile(file); // Proses file gambar yang diseret
			} else {
				alert('Mohon seret file gambar yang valid.');
			}
			imageUpload.classList.remove('drag-over'); // Hapus efek drag-over setelah drop
		}

		// Fungsi untuk menangani drag over
		function dragOverHandler(event) {
			event.preventDefault();
			imageUpload.classList.add('drag-over'); // Tambahkan class drag-over saat file diseret
		}

		// Fungsi untuk menangani drag keluar (drag leave)
		function dragLeaveHandler(event) {
			imageUpload.classList.remove('drag-over'); // Hapus efek drag-over saat file diseret keluar
		}

		// Fungsi untuk menghapus gambar
		function clearImage(event) {
			event.stopPropagation(); // Mencegah event bubbling
			imagePreview.innerHTML = `<i class="fas fa-upload" style="font-size: 40px; color: #ff5722; margin-bottom: 10px;"></i>
							  <h4 style="color: #666;">Seret dan jatuhkan file untuk diunggah</h4>`;
			cancelIcon.style.display = 'none'; // Sembunyikan ikon cancel
			imageUpload.classList.remove('active'); // Hapus kelas aktif
			fileInput.value = ''; // Reset input file
		}

		// Fungsi untuk menutup modal
		function closeModal() {
			$('#imageModal').modal('hide'); // Menutup modal
		}

		// Event listener untuk drag-and-drop
		imageUpload.addEventListener('drop', dropHandler);
		imageUpload.addEventListener('dragover', dragOverHandler);
		imageUpload.addEventListener('dragleave', dragLeaveHandler); // Event untuk drag keluar

		// Event listener untuk ikon cancel
		cancelIcon.addEventListener('click', clearImage);

		function submitForm() {
			// Memanggil submit pada form
			document.getElementById('formProduk').submit();
		}
	</script>

</body>

</html>
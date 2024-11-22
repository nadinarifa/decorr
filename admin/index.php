<?php
// Include database connection
include 'includes/db.php';

// Fetch total number of users
$sql_users = "SELECT COUNT(*) as total_users FROM tb_user";
$result_users = $conn->query($sql_users);
$total_users = $result_users->num_rows > 0 ? $result_users->fetch_assoc()['total_users'] : 0;

// Fetch total number of comments
$sql_comments = "SELECT COUNT(*) as total_comments FROM tb_komentar";
$result_comments = $conn->query($sql_comments);
$total_comments = $result_comments->num_rows > 0 ? $result_comments->fetch_assoc()['total_comments'] : 0;

// Fetch categories and count the number of products per category
$sql_categories = "
    SELECT k.id_kategori, k.nama_kategori, COUNT(p.id_produk) AS total_produk
    FROM tb_kategori k
    LEFT JOIN tb_produk p ON k.id_kategori = p.id_kategori
    GROUP BY k.id_kategori
";
$result_categories = $conn->query($sql_categories);
$categories = [];
$values = [];

if ($result_categories && $result_categories->num_rows > 0) {
    while ($row = $result_categories->fetch_assoc()) {
        $categories[] = $row['nama_kategori']; // Nama kategori
        $values[] = (int) $row['total_produk']; // Jumlah produk per kategori, pastikan integer
    }
} else {
    echo "Tidak ada kategori ditemukan.";
}

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
	<meta property="og:image" content="https:/fillow.dexignlab.com/xhtml/social-image.png">
	<meta name="format-detection" content="telephone=no">

	<!-- PAGE TITLE HERE -->
	<title>Admin Dashboard</title>

	<!-- FAVICONS ICON -->
	<link rel="shortcut icon" type="image/png" href="images/favicon.png">
	<link href="vendor/jquery-nice-select/css/nice-select.css" rel="stylesheet">
	<link href="vendor/owl-carousel/owl.carousel.css" rel="stylesheet">
	<link rel="stylesheet" href="vendor/nouislider/nouislider.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">


	<!-- Style css -->
	<link href="css/style.css" rel="stylesheet">
	<script src="https://cdn.jsdelivr.net/npm/apexcharts@3.28.3/dist/apexcharts.min.js"></script>

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
							<div class="dashboard_bar">
								Dashboard
							</div>
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
				<li>
					<a href="index.php" class="<?= $current_page == 'index.php' ? 'active' : '' ?>"
						aria-expanded="false">
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
		<!-- row -->
		<div class="container-fluid">
			<div class="row">
				<div class="col-xl-12">
					<div class="row">
						<div class="col-xl-6">
							<div class="row">
								<div class="col-xl-12">
									<div class="card tryal-gradient">
										<div class="card-body tryal row">
											<div class="col-xl-7 col-sm-6">
												<h2>Kelola proyek Anda dengan satu sentuhan</h2>

											</div>
											<div class="col-xl-5 col-sm-6">
												<img src="images/chart.png" alt="" class="sd-shape">
											</div>
										</div>
									</div>
								</div>
								<div class="col-xl-12">
									<div class="card">
										<div class="card-header border-0 flex-wrap">
											<h4 class="fs-20 font-w700 mb-2">Statistik Proyek</h4>
											<div class="d-flex align-items-center project-tab mb-2">
												<div class="card-tabs mt-3 mt-sm-0 mb-3 ">
													<ul class="nav nav-tabs" role="tablist">
														<li class="nav-item">
															<a class="nav-link active" data-bs-toggle="tab"
																href="#monthly" role="tab">Bulanan</a>
														</li>
														<li class="nav-item">
															<a class="nav-link" data-bs-toggle="tab" href="#Weekly"
																role="tab">Harian</a>
														</li>
														<li class="nav-item">
															<a class="nav-link" data-bs-toggle="tab" href="#Today"
																role="tab">Hari
																Ini</a>
														</li>
													</ul>
												</div>
												<div class="dropdown ms-2">
													<div class="btn-link" data-bs-toggle="dropdown">
														<svg width="24" height="24" viewbox="0 0 24 24" fill="none"
															xmlns="http://www.w3.org/2000/svg">
															<circle cx="12.4999" cy="3.5" r="2.5" fill="#A5A5A5">
															</circle>
															<circle cx="12.4999" cy="11.5" r="2.5" fill="#A5A5A5">
															</circle>
															<circle cx="12.4999" cy="19.5" r="2.5" fill="#A5A5A5">
															</circle>
														</svg>
													</div>
													<div class="dropdown-menu dropdown-menu-right">
														<a class="dropdown-item" href="javascript:void(0)">Delete</a>
														<a class="dropdown-item" href="javascript:void(0)">Edit</a>
													</div>
												</div>
											</div>
										</div>
										<div class="card-body">
											<div class="d-flex justify-content-between align-items-center flex-wrap">
												<div class="d-flex">
													<div class="d-inline-block position-relative donut-chart-sale mb-3">
														<span class="donut1"
															data-peity='{ "fill": ["rgba(136,108,192,1)", "rgba(241, 234, 255, 1)"],   "innerRadius": 20, "radius": 15}'>5/8</span>
													</div>
													<div class="ms-3">
														<h4 class="fs-24 font-w700 ">246</h4>
														<span class="fs-16 font-w400 d-block">Total
															Projects</span>
													</div>
												</div>
												<div class="d-flex">
													<div class="d-flex me-5">
														<div class="mt-2">
															<svg width="13" height="13" viewbox="0 0 13 13" fill="none"
																xmlns="http://www.w3.org/2000/svg">
																<circle cx="6.5" cy="6.5" r="6.5" fill="#FFCF6D">
																</circle>
															</svg>
														</div>
														<div class="ms-3">
															<h4 class="fs-24 font-w700 ">246</h4>
															<span class="fs-16 font-w400 d-block">On
																Going</span>
														</div>
													</div>
													<div class="d-flex">
														<div class="mt-2">
															<svg width="13" height="13" viewbox="0 0 13 13" fill="none"
																xmlns="http://www.w3.org/2000/svg">
																<circle cx="6.5" cy="6.5" r="6.5" fill="#FFA7D7">
																</circle>
															</svg>

														</div>
														<div class="ms-3">
															<h4 class="fs-24 font-w700 ">28</h4>
															<span class="fs-16 font-w400 d-block">Unfinished</span>
														</div>
													</div>
												</div>
											</div>
											<div class="tab-content">
												<div class="tab-pane fade active show" id="monthly">
													<div id="chartBar" class="chartBar"></div>
												</div>
												<div class="tab-pane fade" id="Weekly">
													<div id="chartBar1" class="chartBar"></div>
												</div>
												<div class="tab-pane fade" id="Today">
													<div id="chartBar2" class="chartBar"></div>
												</div>
											</div>
											<div class="d-flex align-items-center">
												<label class="form-check-label font-w400 fs-16 mb-0"
													for="flexSwitchCheckChecked1">Number</label>
												<div class="form-check form-switch toggle-switch">
													<input class="form-check-input custome" type="checkbox"
														id="flexSwitchCheckChecked1" checked="">

												</div>
												<label class="form-check-label font-w400 fs-16 mb-0 ms-3"
													for="flexSwitchCheckChecked2">Analytics</label>
												<div class="form-check form-switch toggle-switch">
													<input class="form-check-input custome" type="checkbox"
														id="flexSwitchCheckChecked2" checked="">
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="col-xl-12">
									<div class="card">
									</div>
								</div>
							</div>

						</div>
						<div class="col-xl-6">
							<div class="row">
								<div class="col-xl-12">
									<div class="row">
										<div class="col-xl-6 col-sm-6">
											<div class="card">
												<div class="card-body d-flex px-4 pb-0 justify-content-between">
													<div>
														<h4 class="fs-18 font-w600 mb-4 text-nowrap">
															Total User</h4>
														<div class="d-flex align-items-center">
															<h2 class="fs-32 font-w700 mb-0">
																<?php echo $total_users; ?>
															</h2>
															<span class="d-block ms-4">
																<svg width="21" height="11" viewbox="0 0 21 11"
																	fill="none" xmlns="http://www.w3.org/2000/svg">
																	<path
																		d="M1.49217 11C0.590508 11 0.149368 9.9006 0.800944 9.27736L9.80878 0.66117C10.1954 0.29136 10.8046 0.291359 11.1912 0.661169L20.1991 9.27736C20.8506 9.9006 20.4095 11 19.5078 11H1.49217Z"
																		fill="#09BD3C"></path>
																</svg>
																<small
																	class="d-block fs-16 font-w400 text-success">+0,5%</small>
															</span>
														</div>
													</div>
													<div id="columnChart"></div>
												</div>
											</div>
										</div>

										<div class="col-xl-6 col-sm-6">
											<div class="card">
												<div class="card-body px-4 pb-0">
													<h4 class="fs-18 font-w600 mb-5 text-nowrap">
														Komentar</h4>
													<div class="progress default-progress">
														<div class="progress-bar bg-gradient1 progress-animated"
															style="width: 40%; height:10px;" role="progressbar">
															<span class="sr-only">45%
																Complete</span>
														</div>
													</div>
													<div
														class="d-flex align-items-end mt-2 pb-3 justify-content-between">
														<span>Jumlah Komentar</span>
														<h4 class="mb-0">
															<?php echo $total_comments; ?>
														</h4>
													</div>
												</div>
											</div>
										</div>

										<div class="col-xl-6 col-sm-6">
											<div class="card">
												<div class="card-body d-flex px-4  justify-content-between">
													<div>
														<div class="">
															<h2 class="fs-32 font-w700">562</h2>
															<span class="fs-18 font-w500 d-block">Penjualan</span>
															<span class="d-block fs-16 font-w400"><small
																	class="text-danger">-2%</small>
																dari bulan
																lalu</span>
														</div>
													</div>
													<div id="NewCustomers"></div>
												</div>
											</div>
										</div>
										<div class="col-xl-6 col-sm-6">
											<div class="card">
												<div class="card-body d-flex px-4  justify-content-between">
													<div>
														<div class="">
															<h2 class="fs-32 font-w700">892</h2>
															<span class="fs-18 font-w500 d-block">Penghasilan</span>
															<span class="d-block fs-16 font-w400"><small
																	class="text-success">-2%</small>
																dari bulan
																lalu</span>
														</div>
													</div>
													<div id="NewCustomers1"></div>
												</div>
											</div>
										</div>
									</div>

								</div>


								<div class="col-xl-12 col-lg-12">
									<div class="card">
										<div class="card-header border-0">
											<div>
												<h4 class="fs-20 font-w700">Kategori Produk</h4>
											</div>
										</div>
										<div class="card-body">
											<!-- Grafik Kategori Produk -->
											<div id="emailchart"></div>
										</div>
									</div>
								</div>



							</div>

						</div>
						</class>
					</div>

				</div>
			</div>

		</div>
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
	<script src="vendor/chart.js/Chart.bundle.min.js"></script>
	<script src="vendor/jquery-nice-select/js/jquery.nice-select.min.js"></script>

	<!-- Apex Chart -->
	<script src="vendor/apexchart/apexchart.js"></script>

	<script src="vendor/chart.js/Chart.bundle.min.js"></script>

	<!-- Chart piety plugin files -->
	<script src="vendor/peity/jquery.peity.min.js"></script>
	<!-- Dashboard 1 -->
	<script src="js/dashboard/dashboard-1.js"></script>

	<script src="vendor/owl-carousel/owl.carousel.js"></script>

	<script src="js/custom.min.js"></script>
	<script src="js/dlabnav-init.js"></script>
	<script src="js/demo.js"></script>
	<script src="js/styleSwitcher.js"></script>
	<script>
		function cardsCenter() {

			/*  testimonial one function by = owl.carousel.js */



			jQuery('.card-slider').owlCarousel({
				loop: true,
				margin: 0,
				nav: true,
				//center:true,
				slideSpeed: 3000,
				paginationSpeed: 3000,
				dots: true,
				navText: ['<i class="fas fa-arrow-left"></i>', '<i class="fas fa-arrow-right"></i>'],
				responsive: {
					0: {
						items: 1
					},
					576: {
						items: 1
					},
					800: {
						items: 1
					},
					991: {
						items: 1
					},
					1200: {
						items: 1
					},
					1600: {
						items: 1
					}
				}
			})
		}

		jQuery(window).on('load', function () {
			setTimeout(function () {
				cardsCenter();
			}, 1000);
		});

	</script>

	<script>
		// Get data from PHP
		const categories = <?php echo json_encode($categories); ?>;
		const values = <?php echo json_encode($values); ?>;

		const options = {
			series: values, // Data values from PHP
			chart: {
				type: 'donut',
				width: '100%',
			},
			labels: categories, // Category names from PHP
			colors: ['#FF6384', '#FFCD56', '#36A2EB', '#4BC0C0', '#7E57C2'], // Customize colors as needed
			tooltip: {
				enabled: true,
				y: {
					formatter: function (val) {
						return val + " Produk"; // Customize unit if needed
					}
				}
			},
			dataLabels: {
				enabled: true, // Enable data labels on the chart
				formatter: function (val, opts) {

				},
				style: {
					fontSize: '16px',
					fontWeight: 'bold',
					colors: ['#fff']
				}
			}
		};

		// Render the chart in the 'emailchart' div
		const chart = new ApexCharts(document.querySelector("#emailchart"), options);
		chart.render();
	</script>

</body>

</html>
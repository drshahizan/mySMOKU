<!DOCTYPE html>
<html lang="en">
	<!--begin::Head-->
	<head><base href=""/>
		<title>Selamat Datang - Sistem BKOKU</title>
		<meta charset="utf-8" />
		<meta name="description" content="Bantuan ini merupakan keistimewaan yang diberikan kepada pelajar OKU. Oleh itu, ianya harus dibezakan dengan kemudahan-kemudahan lain yang turut diterima oleh pelajar bukan OKU. Ini bermakna sekiranya seseorang pelajar OKU itu menerima biasiswa atau kemudahan lain yang juga turut dinikmati oleh pelajar bukan OKU, maka pelajar OKU tersebut adalah layak menerima elaun ini." />
		<meta name="keywords" content="bkoku, ppk, bantuan, oku" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<meta property="og:locale" content="en_US" />
		<meta property="og:type" content="article" />
		<meta property="og:title" content="Sistem BKOKU" />
		<meta property="og:site_name" content="Sistem BKOKU" />
		<link rel="shortcut icon" href="assets/media/logos/favicon.ico" />
		<!--begin::Fonts(mandatory for all pages)-->
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700" />
		<link href="https://fonts.googleapis.com/css2?family=Blacksword&display=swap" rel="stylesheet">

		<!--end::Fonts-->
		<!--begin::Global Stylesheets Bundle(mandatory for all pages)-->
		<link href="assets/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css" />
		<link href="assets/css/style.bundle.css" rel="stylesheet" type="text/css" />
		<!--end::Global Stylesheets Bundle-->
		<style>

			.header-background {
				position: relative;
				width: 100%;
				height: 100vh; 
				display: flex;
				/* justify-content: space-between; */
				align-items: center;
				overflow: hidden; /* To ensure any overflow is hidden */
			}

			/* Background video styling */
			.background-video {
				position: absolute;
				top: 50%;
				left: 50%;
				width: 100%;
				height: 100%;
				object-fit: cover;
				transform: translate(-50%, -50%);
				z-index: 0; /* Background video behind everything */
			}

			.overlay {
				position: absolute; /* Ensure it's positioned relative to its closest positioned ancestor */
				/* top: 1%; */
				left: 0;
				width: 100%;
				z-index: 1; /* Ensure content is above the video */
				/* background: rgba(255, 255, 255, 0.8);  */
				padding: 100px; /* Add padding if needed */

			}

			

			.bg-card-container {
				position: relative;
				overflow: hidden;
				height: 100%; /* Adjust height as needed */
			}

			.bg-card-wrapper {
				display: flex;
				flex-direction: column;
				height: 100%;
				/* animation: verticalScroll 15s linear infinite; */
			}

			.bg-card {
				width: 100%;
				background-color: rgba(255, 255, 255, 0.705); /* Background color for each card */
				padding: 10px;
				margin-bottom: 10px;
				box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); /* Shadow effect */
				font-family: 'Inter', sans-serif;
				font-size: 1.5rem;
				font-weight: 400;
				color: white;
				overflow: hidden; /* Ensure content outside the card is hidden */
			}

			.bg-card-st {
				width: 100%;
				background-color: rgba(255, 255, 255, 0.705); /* Background color for each card */
				padding: 10px;
				margin-bottom: 10px;
				box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); /* Shadow effect */
				font-family: 'Inter', sans-serif;
				font-size: 1.5rem;
				font-weight: 400;
				color: white;
				overflow: hidden; /* Ensure content outside the card is hidden */
			}

			/* Keyframes for vertical scrolling */
			@keyframes verticalScroll {
				0% {
					transform: translateY(0%);
				}
				100% {
					transform: translateY(-100%);
				}
			}

			.text-transition {
				transition: all 0.5s linear;
				color: #FFFFFF;
			}

			.text-transition:hover {
				color: #0570ea;
				transform: scale(1.1);
			}

			.id-color {
				/* Style for the id-color span if needed */
			}

			/* Button styling */
			.btn-permohonan {
				background-color: #c60000;
				border-color: #0c4277;
				font-size: 2.0rem;
				width: 100%;
				padding: 8px 16px;
				margin-top: 10px;
				display: inline-block;
				color: #f2f2f2;
				text-decoration: none;
				text-align: center;
				align-items: center;
				font-weight: bold;
			}

			.btn-permohonan img{
				width: 45px;
				
			}

			.btn-permohonan:hover {
				background-color: #ffb004;
				border-color: #10355a;
			}
			.card-container {
				display: flex;
				flex-direction: column;
				justify-content: space-between;
			}

			/* Active state */
			.landing-header .menu .menu-item .menu-link.active {
				color: #3E97FF; /* Color when active */
			}
			.content-jata {
				position: relative;
				display: flex;
				justify-content: space-between; /* Align the left and right content to the edges */
				align-items: center; /* Vertically centers the content */
				padding: 60px; /* Optional: Add padding for spacing */
			}
		
			/* CSS for table */
			table {
				width: 100%;
				border-collapse: collapse;
				margin-bottom: 20px;
			}
			th, td {
				border: 1px solid #ddd;
				padding: 8px;
				text-align: left;
			}
			th {
				background-color: #f2f2f2;
			}

			.table-style-2 {
				width: 100%;
				box-shadow: 0 10px 10px rgba(0, 0, 0, 0.2);
				border: 1px solid #ccc;
			}

			.table-style-2 th, .table-style-2 td {
				border: 1px solid transparent;
				text-align: center;
			}

			.table-style-2 th {
				background-color: transparent;
			}
			
			.text-justify {
				text-align: justify; /* Justifies text within its container */
			}

			.card-bkoku {
				position: relative;
				width: 100%;
				height: 200px;
				border-radius: 15px;
				overflow: hidden;
				box-shadow: 0 10px 20px rgba(227, 16, 16, 0.1);
				transition: transform 0.3s;
				background-color: white;
			}

			.card-bkoku.active {
				box-shadow: 0 10px 20px rgba(16, 82, 227, 0.5); /* Change the box-shadow color */
				border: 5px solid rgba(16, 82, 227, 1); /* Add an outer border color */
				transform: scale(1.05); /* Optional: Add a scale effect */
				background-color: #FBC412;
			}

			.card-ppk {
				position: relative;
				width: 100%;
				height: 200px;
				border-radius: 15px;
				overflow: hidden;
				box-shadow: 0 10px 20px rgba(227, 16, 16, 0.1);
				transition: transform 0.3s;
				background-color: white;
			}

			.card-ppk.active {
				box-shadow: 0 10px 20px rgba(16, 82, 227, 0.5); /* Change the box-shadow color */
				border: 5px solid rgba(16, 82, 227, 1); /* Add an outer border color */
				transform: scale(1.05); /* Optional: Add a scale effect */
				background-color: #FBC412;
			}

			.card {
				position: relative;
				width: 100%;
				height: 200px;
				border-radius: 15px;
				overflow: hidden;
				box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
				transition: transform 0.3s;
			}

			.card-text {
				position: absolute;
				bottom: 35px;
				left: 20px;
				right: 20px;
				color: white;
				font-size: 1rem;
				font-weight: bold;
				text-align: center;
			}

			.card:hover {
				transform: translateY(-10px);
			}


			@media (max-width: 1200px) {
				.background-video {
					object-fit: cover; /* Ensure the video scales nicely */
				}

				.header-background {
					text-align: center; /* Ensure text stays centered */
				}
				
				.overlay {
					font-size: 1rem !important; /* Make overlay text smaller */
				}

				.overlay h1 {
					font-size: 2rem !important; /* Adjust font size for headings */
					margin: 1 auto;
				}

				.bg-card-st, .bg-card {
					text-align: center; /* Ensure text stays centered */
					font-size: 0.9rem !important; /* Further reduce font size */
					margin: 5 auto;
				}

				.btn-permohonan {
					font-size: 1rem; /* Adjust button font size */
					width: auto; /* Adjust button width */
					padding: 5px 10px; /* Optional: adjust padding for better appearance */
				}

				.btn-permohonan img {
					width: 30px; /* Adjust button width */
				}

				.bg-card-container {
					width: auto; /* Adjust width */
					font-size: 1rem; /* Adjust font size */
				}

				.bg-card-container span {
					width: auto; /* Adjust width */
					font-size: 1rem !important; /* Adjust font size */
				}
			}

			@media (max-width: 800px) {
				.background-video {
					object-fit: cover; /* Ensure the video scales nicely */
				}

				.header-background {
					text-align: center; /* Ensure text stays centered */
				}
				
				.overlay {
					font-size: 1rem !important; /* Make overlay text smaller */
				}

				.overlay h1 {
					font-size: 2rem !important; /* Adjust font size for headings */
					margin: 1 auto;
				}

				.bg-card-st, .bg-card {
					text-align: center; /* Ensure text stays centered */
					font-size: 0.9rem !important; /* Further reduce font size */
					margin: 5 auto;
				}

				.btn-permohonan {
					font-size: 1rem; /* Adjust button font size */
					width: auto; /* Adjust button width */
					padding: 5px 10px; /* Optional: adjust padding for better appearance */
				}

				.btn-permohonan img {
					width: 30px; /* Adjust button width */
				}

				.bg-card-container {
					width: auto; /* Adjust width */
					font-size: 1rem; /* Adjust font size */
				}

				.bg-card-container span {
					width: auto; /* Adjust width */
					font-size: 1rem !important; /* Adjust font size */
				}
			}

			@media (max-width: 500px) {
				.background-video {
					object-fit: cover; /* Ensure the video scales nicely */
				}

				.header-background {
					text-align: center; /* Ensure text stays centered */
				}
				
				.overlay {
					font-size: 1rem !important; /* Make overlay text smaller */
				}

				.overlay h1 {
					font-size: 2rem !important; /* Adjust font size for headings */
					margin: 1 auto;
				}

				.bg-card-st, .bg-card {
					text-align: center; /* Ensure text stays centered */
					font-size: 0.9rem !important; /* Further reduce font size */
					margin: 5 auto;
				}

				.btn-permohonan {
					font-size: 1rem; /* Adjust button font size */
					width: auto; /* Adjust button width */
					padding: 5px 10px; /* Optional: adjust padding for better appearance */
				}

				.btn-permohonan img {
					width: 30px; /* Adjust button width */
				}

				.bg-card-container {
					width: auto; /* Adjust width */
					font-size: 1rem; /* Adjust font size */
				}

				.bg-card-container span {
					width: auto; /* Adjust width */
					font-size: 1rem !important; /* Adjust font size */
				}
			}

			
		</style>
		
	</head>
	<!--end::Head-->
	
	<!--begin::Body-->
	<body  id="laman_utama" data-bs-spy="scroll" data-bs-target="#kt_landing_menu" class="bg-body position-relative app-blank" >
		<div class="d-flex flex-column flex-root" id="kt_app_root">
			<!--Header-->
			<div class="landing-header" data-kt-sticky="true" data-kt-sticky-name="landing-header" data-kt-sticky-offset="{default: '10px', lg: '10px'}">
				<div class="col-md-2">
					<div class="content-jata">
						<a href="#laman_utama">
							<img alt="Portal" src="assets/media/portal_sispo.png" class="logo-default h-35px h-lg-60px"/>
							<img alt="Portal" src="assets/media/portal_sispo.png" class="logo-sticky h-30px h-lg-60px"/>
						</a>
					</div>
				</div>
				<div class="col-md-4 mx-auto text-center">
				</div>
				<div class="col-md-6 text-end" >
					<!--begin::Mobile menu toggle-->
					<button class="btn btn-icon btn-active-color-primary me-3 d-flex d-lg-none" id="kt_landing_menu_toggle">
						<i class="ki-duotone ki-abstract-14 fs-2hx">
							<span class="path1"></span>
							<span class="path2"></span>
						</i>
					</button>
					<!--end::Mobile menu toggle-->
					
					<!--begin::Wrapper-->
					<div class="d-flex align-items-center justify-content-between">
						<!--begin::Menu wrapper-->
						<div class="d-lg-block" id="kt_header_nav_wrapper">
							<div class="d-lg-block p-5 p-lg-0" data-kt-drawer="true" data-kt-drawer-name="landing-menu" data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true" data-kt-drawer-width="300px" data-kt-drawer-direction="start" data-kt-drawer-toggle="#kt_landing_menu_toggle" data-kt-swapper="true" data-kt-swapper-mode="prepend" data-kt-swapper-parent="{default: '#laman_utama', lg: '#kt_header_nav_wrapper'}">
								<!--begin::Menu-->
								<div class="menu menu-column flex-nowrap menu-rounded menu-lg-row menu-state-title-primary fs-5 fw-bold" id="kt_landing_menu">
									<!--begin::Menu item-->
									<div class="menu-item">
										<a style="font-size: 1.5rem;" class="menu-link nav-link py-3 px-4 px-xxl-6" href="#utama" id="show-utama" data-kt-scroll-toggle="true" data-kt-drawer-dismiss="true">UTAMA</a>
									</div>
									<!--end::Menu item-->
									
									<!-- Dropdown Menu for Maklumat BKOKU -->
									<div class="menu-item">
										<a style="font-size: 1.5rem;" class="menu-link nav-link py-3 px-4 px-xxl-6 dropdown-toggle" href="#" id="dropdown-bkoku" data-bs-toggle="dropdown" aria-expanded="false">MAKLUMAT PENAJAAN</a>
										<ul class="dropdown-menu" aria-labelledby="dropdown-bkoku">
											<li><a style="font-size: 1.5rem;" class="menu-link nav-link py-3 px-4 px-xxl-6" href="#bkoku" id="show-bkoku" data-kt-scroll-toggle="true" data-kt-drawer-dismiss="true">MAKLUMAT BKOKU</a></li>
											<li><a style="font-size: 1.5rem;" class="menu-link nav-link py-3 px-4 px-xxl-6" href="#ppk" id="show-ppk" data-kt-scroll-toggle="true" data-kt-drawer-dismiss="true">MAKLUMAT PPK</a></li>
										</ul>
									</div>
									
									<!--begin::Menu item-->
									<div class="menu-item">
										<a style="font-size: 1.5rem;" class="menu-link nav-link py-3 px-4 px-xxl-6" href="#hubungi" id="show-hubungi" data-kt-scroll-toggle="true" data-kt-drawer-dismiss="true">HUBUNGI KAMI</a>
									</div>
									<!--end::Menu item-->
								</div>
								<!--end::Menu-->
							</div>
						</div>
						<!--end::Menu wrapper-->
					</div>
					<!--end::Wrapper-->
				</div>
			</div>
			
			<!--Background-->
			<div class="mb-0" id="home">
				<!--begin::Wrapper-->
				<div class="header-background">
					<video autoplay loop muted class="background-video">
						<source src="assets/media/background_9.mp4" type="video/mp4">
					</video>
					<div class="overlay">
						<div class="row">
							<div class="col-md-8">
								<div>
									<h1 class="text-transition" style="font-size: 3.0rem;"><span>Selamat Datang ke</span></h1>
									<h1 class="text-transition" style="font-size: 5.0rem;"><span style="text-transform:uppercase">Sistem Penajaan <br>Orang Kurang Upaya </span><br><span>(SisPO)</span></h1>
								</div>
							</div>
							
							<div class="col-md-4" >
								{{-- TUTUP BUTTON PERMOHONAN --}}
								<div class="bg-card-st">
									<div class="col-md-12">
										<div class="left" style="color: rgb(2, 2, 55); text-align: center; font-weight: bold;">KLIK DI SINI UNTUK PERMOHONAN</div>
										<a href="{{ env('APP_URL') }}/login" class="btn btn-permohonan">
											PERMOHONAN&nbsp;<img src="assets/media/arrow.png" alt="klik">
										</a>
									</div>
								</div>
								<div class="bg-card-container">
									<div class="bg-card-wrapper">
										<div class="bg-card">
											<div class="col-md-12">
												<div class="left" style="color:rgb(2, 2, 55); text-align: center; font-weight: bold;">HEBAHAN</div>
												<div class="middle">
													<span style="font-size: 1.5rem; color:rgb(0, 0, 0);">{!! $catatan ?? 'No notes available' !!}</span>
												</div>
											</div>
										</div>
										{{-- <div class="bg-card">
											<div class="col-md-12">
												<span class="badge badge-default">Label 1</span>
											</div>
										</div>
										<div class="bg-card">
											<div class="col-md-12">
												<span class="badge badge-default">Label 2</span>
											</div>
										</div> --}}
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!--end::Wrapper-->
			</div>

			<!--Utama-->
			<div class="row" id="utama">
				<!-- Card Container -->
				<div class="col-md-1 d-flex">
				</div>
				<div class="col-md-5 d-flex">
					<!--begin::Card 1-->
					<div class="w-100 d-flex flex-column flex-center rounded-3 py-10 px-10 me-3 card-container" style="background-color: #ffffff; box-shadow: 0 30px 30px rgba(0, 0, 0, 0.2); border: 1px solid #ccc;">
						<div class="card-utama border-0">
							<div class="card-body">
								<!--begin::Features-->
								<div class="w-100 mb-10">
									<!--begin::Item-->
									<div class="d-flex flex-column mb-5" style="background-color: #A31C44; padding: 15px; border-radius: 5px;">
										<span class="fw-bold text-light fs-2 mb-2">LATAR BELAKANG</span>
									</div>
									<br><br><br>
									<!--end::Item-->
									<!--begin::Item-->
									<div class="d-flex flex-stack mb-5">
										<i class="ki-duotone ki-verify fs-1 text-danger me-3">
											<span class="path1"></span>
											<span class="path2"></span>
										</i>
										<span class="fw-semibold fs-2 text-gray-800 text-justify flex-grow-1">
											Bantuan kewangan ini tidak mengambil kira taraf pendapatan sebagai syarat kelayakan selaras dengan objektif bantuan ini yang bertujuan untuk meningkatkan dan memperluaskan peluang pembelajaran sepanjang hayat kepada golongan OKU yang mengikuti pengajian di IPT.
										</span>
									</div>
									<br>
									<!--end::Item-->
									<!--begin::Item-->
									<div class="d-flex flex-stack mb-5">
										<i class="ki-duotone ki-verify fs-1 text-danger me-3">
											<span class="path1"></span>
											<span class="path2"></span>
										</i>
										<span class="fw-semibold fs-2 text-gray-800 text-justify flex-grow-1">
											Bantuan kewangan ini tidak mengambil kira taraf pendapatan sebagai syarat kelayakan selaras dengan objektif bantuan ini yang bertujuan untuk meningkatkan dan memperluaskan peluang pembelajaran sepanjang hayat kepada golongan OKU yang mengikuti pengajian di IPT.
										</span>
									</div>
									<!--end::Item-->
								</div>
								<!--end::Features-->
							</div>
						</div>
					</div>
					<!--end::Card 1-->
				</div>
				
				<div class="col-md-5 d-flex">
					<!--begin::Card 2-->
					<div class="w-100 d-flex flex-column flex-center rounded-3 py-10 px-10 me-3 card-container" style="background-color: #ffffff; box-shadow: 0 30px 30px rgba(0, 0, 0, 0.2); border: 1px solid #ccc;">
						<div class="card-utama border-0">
							<div class="card-body">
								<!--begin::Features-->
								<div class="w-100 mb-10">
									<!--begin::Item-->
									<div class="d-flex flex-column mb-5" style="background-color: #A31C44; padding: 15px; border-radius: 5px;">
										<span class="fw-bold text-light fs-2 mb-2">CADANGAN ATAU PERTANYAAN</span><br>
										<span class="fw-bold text-light fs-4">Kementerian Pendidikan Tinggi mengalu-alukan cadangan dan pertanyaan berhubung bantuan ini.</span>
									</div>
									<!--end::Item-->
									<br><br><br>
									<!--begin::Item-->
									<div class="d-flex flex-stack mb-5">
										<form class="w-100" style="text-align: left;" method="POST" action="{{ route('sendEmail') }}">
											@csrf
											<div class="row mb-3">
												<div class="col-md-6">
													<label for="nama" class="form-label">Nama</label>
													<div class="input-group">
														<span class="input-group-text">
															<i class="fa-solid fa-user"></i>
														</span>
														<input type="text" class="form-control" id="nama" name="nama">
													</div>
												</div>
												<div class="col-md-6">
													<label for="telefon" class="form-label">Telefon</label>
													<div class="input-group">
														<span class="input-group-text">
															<i class="fa-solid fa-phone"></i>
														</span>
														<input type="tel" class="form-control" id="telefon" name="telefon">
													</div>
												</div>
											</div>
											<div class="row mb-3">
												<div class="col-md-6">
													<label for="emel" class="form-label">Emel</label>
													<div class="input-group">
														<span class="input-group-text">
															<i class="fa-solid fa-envelope"></i>
														</span>
														<input type="email" class="form-control" id="emel" name="emel">
													</div>
												</div>
												<div class="col-md-6">
													<label for="tajuk" class="form-label">Tajuk</label>
													<div class="input-group">
														<span class="input-group-text">
															<i class="fa-solid fa-tag"></i>
														</span>
														<input type="text" class="form-control" id="tajuk" name="tajuk">
													</div>
												</div>
											</div>
											<div class="mb-3">
												<label for="mesej" class="form-label">Mesej</label>
												<textarea class="form-control" id="mesej" name="mesej" rows="3" placeholder="Masukkan mesej anda"></textarea>
											</div>
											<button type="submit" class="btn btn-primary">Hantar</button>
										</form>
									</div>
									<!--end::Item-->
								</div>
								<!--end::Features-->
							</div>
						</div>
					</div>
					<!--end::Card 2-->
				</div>
				<div class="col-md-1 d-flex">
				</div>
			</div>
			
			<!--begin::Maklumat BKOKU Section-->
			<div class="py-10 py-lg-20" id="bkoku">
				<!--begin::Wrapper-->
				<div class="py-1 landing-dark-bg" style="background-color: rgb(255, 255, 255);">
					<!--begin::Container-->
					<div class="container">
						<!--begin::Plans-->
						<div class="d-flex flex-column container pt-lg-15">
							<!--begin::BKOKU-->
							<div class="text-center">
								<!--begin::Row-->
								<div class="row g-10">
									<!--begin::Col-->
									<div class="col-xl-12">
										<div class="d-flex h-100">
											<!--begin::Card 1-->
											<div class="w-100 d-flex flex-column flex-center rounded-3 py-10 px-10 me-3" style="flex-grow: 1; background-color: rgb(255, 255, 255); box-shadow: 0 30px 30px rgba(0, 0, 0, 0.2); border: 1px solid #ccc;">
												<div class="card-utama border-0">
													<div class="card-body">
														<!--begin::Features-->
														<div class="w-100 mb-10">
															<!--begin::Item-->
															<div class="d-flex flex-column mb-5" style="background-color: #EF402D; padding: 15px; border-radius: 5px;">
																<span class="fw-bold text-light fs-2 mb-2">BANTUAN KEWANGAN ORANG KURANG UPAYA (OKU)</span>
															</div>
															<!--end::Item-->
															<!--begin::Item-->
															<div class="d-flex flex-column mb-5 align-items-start">
																<label class="mb-2 fw-bold fs-2 text-justify flex-grow-1"><b>Objektif:</b></label>
																<span class="fw-semibold fs-2 text-gray-800 text-justify flex-grow-1">
																	Program ini bertujuan untuk meningkatkan dan memperluaskan peluang pembelajaran sepanjang hayat kepada golongan OKU yang melanjutkan pengajian di UA, IPTS, Kolej Komuniti dan Politeknik di bawah seliaan KPT
																</span><br><br>
															</div>
															<!--end::Item-->
															<!--begin::Item-->
															<div class="d-flex flex-column mb-5 align-items-start">
																<label class="mb-2 fw-bold fs-2 text-justify flex-grow-1"><b>Tatacara Permohonan:</b></label>
																<span class="fw-semibold fs-2 text-gray-800 text-justify flex-grow-1">
																	i.	Pemohon perlu membuat permohonan dengan mengemukakan salinan dokumen yang dinyatakan dengan lengkap melalui sistem Penajaan OKU (SisPO).
																</span><br><br>
																<span class="fw-semibold fs-2 text-gray-800 text-justify flex-grow-1">
																	ii.	Hanya Invois Asal yang perlu dimuatnaik melalui Sistem Penajaan OKU (SisPO).
																</span><br><br>
															</div>
															<!--end::Item-->

															<!--begin::Item-->
															<div class="container">
																<div class="row">
																	<!-- Card 1 -->
																	<div class="col-md-3 mb-4">
																		<a id="show_skop_bkoku" href="#skop_bkoku" data-kt-scroll-toggle="true" data-kt-drawer-dismiss="true">
																			<!--div class="card-bkoku" style="background-color: #1F97D4; padding: 15px; border-radius: 5px;"-->
																			<div class="card-bkoku">
																				<div class="card-body">
																					<div class="justify-content-center" >
																						<img src="assets/media/human-resource.png" alt="Skop" style="width: 80px; height: auto; margin-top: 20px;">
																					</div>
																					<div class="d-flex justify-content-center mb-5">
																						<div class="fs-5 fs-lg-1 fw-bold text-dark">Skop Pembiayaan</div>
																					</div>
																				</div>
																			</div>
																		</a>
																	</div>
																	<!-- Card 2 -->
																	<div class="col-md-3 mb-4">
																		<a id="show_syarat_bkoku" href="#syarat_bkoku" data-kt-scroll-toggle="true" data-kt-drawer-dismiss="true">
																			<!--div class="card-bkoku" style="background-color: #59BA47; padding: 15px; border-radius: 5px;"-->
																			<div class="card-bkoku">
																				<div class="card-body">
																					<div class="justify-content-center" >
																						<img src="assets/media/file.png" alt="Syarat" style="width: 80px; height: auto; margin-top: 20px;">
																					</div>
																					<div class="d-flex justify-content-center mb-5">
																						<div class="fs-5 fs-lg-1 fw-bold text-dark">Syarat Pembiayaan</div>
																					</div>
																				</div>
																			</div>
																		</a>	
																	</div>
																	<!-- Card 3 -->
																	<div class="col-md-3 mb-4">
																		<a id="show_elemen_bkoku" href="#elemen_bkoku" data-kt-scroll-toggle="true" data-kt-drawer-dismiss="true">
																			<!--div class="card-bkoku" style="background-color: #FBC412; padding: 15px; border-radius: 5px;"-->
																			<div class="card-bkoku">
																				<div class="card-body">
																					<div class="justify-content-center" >
																						<img src="assets/media/business-aggrement.png" alt="Elemen" style="width: 80px; height: auto; margin-top: 20px;">
																					</div>
																					<div class="d-flex justify-content-center mb-5">
																						<div class="fs-5 fs-lg-1 fw-bold text-dark">Elemen Tajaan</div>
																					</div>
																				</div>
																			</div>
																		</a>	
																	</div>
																	<!-- Card 4 -->
																	<div class="col-md-3 mb-4">
																		<a id="show_tempoh_bkoku" href="#tempoh_bkoku" data-kt-scroll-toggle="true" data-kt-drawer-dismiss="true">
																			<!--div class="card-bkoku" style="background-color: #EF402D; padding: 15px; border-radius: 5px;"-->
																			<div class="card-bkoku">
																				<div class="card-body">
																					<div class="justify-content-center" >
																						<img src="assets/media/timetable.png" alt="Tempoh" style="width: 80px; height: auto; margin-top: 20px;">
																					</div>
																					<div class="d-flex justify-content-center mb-5">
																						<div class="fs-5 fs-lg-1 fw-bold text-dark">Tempoh Penajaan</div>
																					</div>
																				</div>
																			</div>
																		</a>	
																	</div>
																</div>
															</div>
															<!--end::Item-->
															<div class="container" style="text-align: left;">
																<!--begin::Skop BKOKU-->
																<div class="flex-column mb-5" id="skop_bkoku" style="display:none;">
																	<br><br>
																	<span class="fw-semibold fs-2 text-gray-800 text-justify flex-grow-1">
																		i. Skop pembiayaan OKU adalah tertumpu kepada institusi yang terletak dibawah pengurusan dan kawalan Kementerian Pendidikan Tinggi (KPT) iaitu semua IPTA, IPTS, Politeknik dan Kolej Komuniti sahaja;
																	</span><br><br>
																	<span class="fw-semibold fs-2 text-gray-800 text-justify flex-grow-1">
																		ii. Skop peringkat pengajian pula adalah tertakluk kepada tafsiran pengajian tinggi (tertiary) iaitu peringkat diploma dan ke atas sahaja. Walau bagaimanapun, kursus peringkat sijil jangka panjang di politeknik dan kolej komuniti yang di bawah tanggungjawab KPT boleh dipertimbangkan untuk bantuan kewangan OKU ini;
																	</span><br><br>
																	<span class="fw-semibold fs-2 text-gray-800 text-justify flex-grow-1">
																		iii. Pelajar OKU yang menuntut di institusi-institusi latihan bukan bertaraf IPT yang dikawal oleh kementerian-kementerian lain dan institusi-institusi pengajian tinggi luar negara adalah di luar skop pembiayaan.
																	</span><br><br>
																</div>
																<!--end::Skop BKOKU-->
																<!--begin::Syarat BKOKU-->
																<div class="flex-column mb-5" id="syarat_bkoku" style="display:none;">
																	<br><br>
																	<span class="fw-semibold fs-2 text-gray-800 text-justify flex-grow-1">
																		i. Pelajar warganegara Malaysia;
																	</span><br><br>
																	<span class="fw-semibold fs-2 text-gray-800 text-justify flex-grow-1">
																		ii. Pelajar berdaftar dengan Jabatan Kebajikan Masyarakat (JKM) dan telah mempunyai kad OKU;
																	</span><br><br>
																	<span class="fw-semibold fs-2 text-gray-800 text-justify flex-grow-1">
																		iii. Kursus yang diikuti hendaklah diiktiraf oleh Agensi Kelayakan Malaysia (MQA) atau Jabatan Perkhidmatan Awam (JPA);
																	</span><br><br>
																	<span class="fw-semibold fs-2 text-gray-800 text-justify flex-grow-1">
																		iv.	Pelajar OKU yang menerima pinjaman pelajaran atau pembiayaan sendiri adalah layak menerima elemen wangsaku dan yuran pengajian. Penerima biasiswa pula layak mendapat wang saku sahaja;
																	</span><br><br>
																	<span class="fw-semibold fs-2 text-gray-800 text-justify flex-grow-1">
																		v.	Pelajar hendaklah sedang melanjutkan pengajian di mana-mana universiti awam atau IPTS (bawah seliaan KPT) atau Kolej Komuniti dan Politeknik;
																	</span><br><br>
																	<span class="fw-semibold fs-2 text-gray-800 text-justify flex-grow-1">
																		vi.	Pelajar yang mengikuti kursus separuh masa atau pengajian jarak jauh layak menerima bantuan kewangan ini;
																	</span><br><br>
																	<span class="fw-semibold fs-2 text-gray-800 text-justify flex-grow-1">
																		vii. Pelajar OKU yang menerima biasiswa atas dasar kurang upayanya semasa melanjutkan pengajiannya tidak layak menerima bantuan kewangan ini. Misalnya jika seseorang pelajar OKU itu telah menerima biasiswa khas untuk melanjutkan pengajian di IPT kerana keistimewaannya, elaun khas ini tidak akan dipanjangkan kepada beliau;
																	</span><br><br>
																	<span class="fw-semibold fs-2 text-gray-800 text-justify flex-grow-1">
																		viii. Pelajar OKU hendaklah bukan dalam tempoh cuti belajar bergaji (penuh/sebahagian);dan
																	</span><br><br>
																	<span class="fw-semibold fs-2 text-gray-800 text-justify flex-grow-1">
																		ix. Bagi pelajar yang ingin memohon perlanjutan tempoh pengajian adalah tidak layak mendapat bantuan dalam proses perlanjutan tersebut. Hal ini kerana tempoh tajaan Bantuan kewangan ini adalah mengikut tempoh surat tawaran asal. Pelajar yang ingin menukar tempat pengajian dalam tempoh pembiayaan BKOKU, hendaklah maklum kepada pihak kementerian secara bertulis dan juga kepada pihak institusi pengajian sebelum dari tempoh lapor diri di tempat pengajian baru.
																	</span><br><br>
																</div>
																<!--end::Syarat BKOKU-->
																<!--begin::Elemen BKOKU-->
																<div class="flex-column mb-5" id="elemen_bkoku" style="display:none;">
																	<br><br>
																	<span class="fw-semibold fs-2 text-gray-800 text-justify flex-grow-1">
																		i. Pembiayaan ini meliputi yuran pengajian dan elaun wang saku sebanyak RM400 sebulan dengan kadar maksimum RM6,200 setahun (mengikut kalendar akademik) atau RM24,800 sepanjang tempoh pengajian.
																	</span><br><br>
																	<span class="fw-semibold fs-2 text-gray-800 text-justify flex-grow-1">
																		ii. Senarai Yuran Layak dan Yuran Tidak Layak:<br><br>
																		<!-- Table Start -->
																		<table style="box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);">
																			<thead>
																				<tr>
																					<th style="background-color: #96b6cd;">Bil.</th>
																					<th style="background-color: #96b6cd;">Yuran Pengajian Yang LAYAK Dituntut</th>
																					<th style="background-color: #96b6cd;">Yuran Pengajian Yang TIDAK LAYAK Dituntut</th>
																				</tr>
																			</thead>
																			<tbody>
																				<tr>
																					<td>1.</td>
																					<td>Yuran Pendaftaran Pengajian</td>
																					<td>Yuran Penempatan / Yuran Asrama</td>
																				</tr>
																				<tr>
																					<td>2.</td>
																					<td>Kad Kampus / Kad Matrik</td>
																					<td>Insuran Kesihatan / Perlindungan Insuran</td>
																				</tr>
																				<tr>
																					<td>3.</td>
																					<td>Yuran Perpustakaan</td>
																					<td>Yuran Kebajikan / Persatuan / Alumni / Aktiviti / Khairiat</td>
																				</tr>
																				<tr>
																					<td>4.</td>
																					<td>Yuran Peperiksaan</td>
																					<td>Yuran Kelengkapan / Tabung Pengurusan MPA</td>
																				</tr>
																				<tr>
																					<td>5.</td>
																					<td>Yuran Perkhidmatan</td>
																					<td>Yuran Pencalonan</td>
																				</tr>
																				<tr>
																					<td>6.</td>
																					<td>Yuran Ko-Kurikulum / Sukan</td>
																					<td>Tabung Kecemasan</td>
																				</tr>
																				<tr>
																					<td>7.</td>
																					<td>Yuran Graduasi (Jika bergraduat dalam tempoh tajaan sahaja)</td>
																					<td>Elaun Buku</td>
																				</tr>
																				<tr>
																					<td>8.</td>
																					<td>Yuran Pemeriksaan / Yuran Tesis</td>
																					<td>Elaun Sara Hidup</td>
																				</tr>
																				<tr>
																					<td>9.</td>
																					<td>Yuran Komputer</td>
																					<td>Elaun Tesis</td>
																				</tr>
																				<tr>
																					<td>10.</td>
																					<td>Yuran Peralatan / Bahan Makmal</td>
																					<td>Elaun Latihan Amali / Klinikal / Kerja Lapangan</td>
																				</tr>
																				<tr>
																					<td>11.</td>
																					<td></td>
																					<td>Elaun Perjalanan / Tambang</td>
																				</tr>
																				<tr>
																					<td>12.</td>
																					<td></td>
																					<td>Elaun Akhir Pengajian</td>
																				</tr>
																				<tr>
																					<td>13.</td>
																					<td></td>
																					<td>Elaun Penyelidikan</td>
																				</tr>
																				<tr>
																					<td>14.</td>
																					<td></td>
																					<td>Elaun Pengangkutan</td>
																				</tr>
																			</tbody>
																		</table>
																		<!-- Table End -->
																	</span><br><br>
																	<span class="fw-semibold fs-2 text-gray-800 text-justify flex-grow-1">
																		iii. Maklumat Pembiayaan:<br><br>
																		<!-- Table Start -->
																		<table  class="table-style-2">
																			<thead>
																				<tr>
																					<th></th>
																					<th></th>
																					<th>
																						<div class="w-100 d-flex flex-column flex-center rounded-3 py-2" style="background-color: rgb(55, 63, 168);">
																							<!-- begin::Heading -->
																							<div class="mb-2">
																								<!-- begin::Title -->
																								<div class="text-light fw-bold" style="font-size:14px;">Yuran </div>
																								<!-- end::Title -->
																							</div>
																							<!-- end::Heading -->
																						</div>
																					</th>
																					<th>
																						<div class="w-100 d-flex flex-column flex-center rounded-3 py-2" style="background-color: rgb(55, 63, 168);">
																							<!-- begin::Heading -->
																							<div class="mb-2">
																								<!-- begin::Title -->
																								<div class="text-light fw-bold" style="font-size:14px;">Wang Saku</div>
																								<!-- end::Title -->
																							</div>
																							<!-- end::Heading -->
																						</div>
																					</th>
																				</tr>
																			</thead>
																			<tbody>
																				<tr>
																					<td rowspan="2">
																						<div class="w-100 d-flex flex-column flex-center rounded-3 py-6 px-6 mb-4" style="background-color: #59BA47;">
																							<!-- begin::Heading -->
																							<div class="mb-4">
																								<!-- begin::Title -->
																								<div class="fw-bold" style="font-size:24px;">Sepenuh Masa</div>
																								<!-- end::Title -->
																							</div>
																							<!-- end::Heading -->
																						</div>
																					</td>
																					<td>
																						<div class="w-100 d-flex flex-column flex-center rounded-3 py-2 px-6 mb-2" style="background-color: #59BA47;">
																							<!-- begin::Heading -->
																							<div class="mb-2">
																								<!-- begin::Title -->
																								<div class="fw-bold" style="font-size:14px;">Pinjaman Pelajaran / Pembiayaan Sendiri </div>
																								<!-- end::Title -->
																							</div>
																							<!-- end::Heading -->
																						</div>
																					</td>
																					<td>
																						<div class="mb-2">
																							<!-- begin::Title -->
																							<i class="ki-duotone ki-check-circle text-success" style="font-size: 3em;">
																								<span class="path1"></span>
																								<span class="path2"></span>
																							</i>
																							<!-- end::Title -->
																						</div>
																					</td>
																					<td>
																						<div class="mb-2">
																							<!-- begin::Title -->
																							<i class="ki-duotone ki-check-circle text-success" style="font-size: 3em;">
																								<span class="path1"></span>
																								<span class="path2"></span>
																							</i>
																							<!-- end::Title -->
																						</div>
																					</td>
																				</tr>
																				<tr>
																					<td>
																						<div class="w-100 d-flex flex-column flex-center rounded-3 py-2 px-6 mb-2" style="background-color: #59BA47;">
																							<!-- begin::Heading -->
																							<div class="mb-2">
																								<!-- begin::Title -->
																								<div class="fw-bold" style="font-size:14px;">Biasiswa</div>
																								<!-- end::Title -->
																							</div>
																							<!-- end::Heading -->
																						</div>
																					</td>
																					<td>
																						<div class="mb-2">
																							<!-- begin::Title -->
																							<i class="ki-duotone ki-cross-circle text-danger" style="font-size: 3em;">
																								<span class="path1"></span>
																								<span class="path2"></span>
																							</i>
																							<!-- end::Title -->
																						</div>
																					</td>
																					<td>
																						<div class="mb-2">
																							<!-- begin::Title -->
																							<i class="ki-duotone ki-check-circle text-success" style="font-size: 3em;">
																								<span class="path1"></span>
																								<span class="path2"></span>
																							</i>
																							<!-- end::Title -->
																						</div>
																					</td>
																				</tr>
																				<tr>
																					<td rowspan="2">
																						<div class="w-100 d-flex flex-column flex-center rounded-3 py-6 px-6 mb-4" style="background-color: #27BFE6;">
																							<!-- begin::Heading -->
																							<div class="mb-4">
																								<!-- begin::Title -->
																								<div class="fw-bold" style="font-size:24px;">Separuh Masa</div>
																								<!-- end::Title -->
																							</div>
																							<!-- end::Heading -->
																						</div>
																					</td>
																					<td>
																						<div class="w-100 d-flex flex-column flex-center rounded-3 py-2 px-6 mb-2" style="background-color: #27BFE6;">
																							<!-- begin::Heading -->
																							<div class="mb-2">
																								<!-- begin::Title -->
																								<div class="fw-bold" style="font-size:14px;">Pinjaman Pelajaran / Pembiayaan Sendiri </div>
																								<!-- end::Title -->
																							</div>
																							<!-- end::Heading -->
																						</div>
																					</td>
																					<td>
																						<div class="mb-2">
																							<!-- begin::Title -->
																							<i class="ki-duotone ki-check-circle text-success" style="font-size: 3em;">
																								<span class="path1"></span>
																								<span class="path2"></span>
																							</i>
																							<!-- end::Title -->
																						</div>
																					</td>
																					<td>
																						<div class="mb-2">
																							<!-- begin::Title -->
																							<i class="ki-duotone ki-cross-circle text-danger" style="font-size: 3em;">
																								<span class="path1"></span>
																								<span class="path2"></span>
																							</i>
																							<!-- end::Title -->
																						</div>
																					</td>
																				</tr>
																				<tr>
																					<td>
																						<div class="w-100 d-flex flex-column flex-center rounded-3 py-2 px-6 mb-2" style="background-color: #27BFE6;">
																							<!-- begin::Heading -->
																							<div class="mb-2">
																								<!-- begin::Title -->
																								<div class="fw-bold" style="font-size:14px;">Biasiswa</div>
																								<!-- end::Title -->
																							</div>
																							<!-- end::Heading -->
																						</div>
																					</td>
																					<td>
																						<div class="mb-2">
																							<!-- begin::Title -->
																							<i class="ki-duotone ki-cross-circle text-danger" style="font-size: 3em;">
																								<span class="path1"></span>
																								<span class="path2"></span>
																							</i>
																							<!-- end::Title -->
																						</div>
																					</td>
																					<td>
																						<div class="mb-2">
																							<!-- begin::Title -->
																							<i class="ki-duotone ki-cross-circle text-danger" style="font-size: 3em;">
																								<span class="path1"></span>
																								<span class="path2"></span>
																							</i>
																							<!-- end::Title -->
																						</div>
																					</td>
																				</tr>
																			</tbody>
																		</table>
																		<!-- Table End -->
																	</span><br><br>
																</div>
																<!--end::Elemen BKOKU-->
																<!--begin::Tempoh BKOKU-->
																<div class="flex-column mb-5" id="tempoh_bkoku" style="display:none;">
																	<br><br>
																	<span class="fw-semibold fs-2 text-gray-800 text-justify flex-grow-1">
																		<!--begin::Card Tempoh-->
																		<div class="row w-100 gy-10 mb-md-20">
																			<!--begin::Col-->
																			<div class="col-md-4 px-1">
																				<!--begin::Sijil Asas / Sijil-->
																				<div class="text-center mb-12 mb-md-0">
																					<div class="card" style="background-color: #F26A2E">
																						<div class="card-text">
																							<!--begin::Heading-->
																							<!--begin::Badge-->
																							<div class="fs-6 fs-lg-6"><span class="badge badge-circle badge-light-danger fw-bold fs-3">1</span></div>
																							<!--end::Badge-->
																							<div class="d-flex flex-center mb-5">
																								<!--begin::Title-->
																								<div class="fs-5 fs-lg-1 fw-bold text-light">Sijil Asas / Sijil</div>
																								<!--end::Title-->
																							</div>
																							<!--end::Heading-->
																							<!--begin::Description-->
																							<div class="fs-6 fs-lg-4">2 Tahun</div>
																							<div class="fs-7 fs-lg-6">(Kolej Komuniti dan Politeknik)<br/>(Had Pembiayaan RM6,200.00 sehingga RM12,400.00)</div>
																							<!--end::Description-->
																						</div>
																					</div>
																				</div>
																				<!--end::Sijil Asas / Sijil-->

																				<!--begin::Diploma-->
																				<div class="text-center mb-10 mb-md-0">
																					<div class="card" style="background-color: #59BA47">
																						<div class="card-text">
																							<!--begin::Heading-->
																							<!--begin::Badge-->
																							<div class="fs-6 fs-lg-6"><span class="badge badge-circle badge-light-danger fw-bold fs-3">2</span></div>
																							<!--end::Badge-->
																							<div class="d-flex flex-center mb-5">
																								<!--begin::Title-->
																								<div class="fs-5 fs-lg-1 fw-bold text-light">Diploma</div>
																								<!--end::Title-->
																							</div>
																							<!--end::Heading-->
																							<!--begin::Description-->
																							<div class="fs-6 fs-lg-4">3 Tahun</div>
																							<div class="fs-7 fs-lg-6">(Had Pembiayaan RM6,200.00 sehingga RM18,600.00)</div>
																							<!--end::Description-->
																						</div>	
																					</div>
																				</div>
																				<!--end::Diploma-->
																			</div>
																			<!--end::Col-->
																			<!--begin::Col-->
																			<div class="col-md-4 px-1">
																				<!--begin::Sarjana Muda-->
																				<div class="text-center mb-10 mb-md-0">
																					<div class="card" style="background-color: #E01483">
																						<div class="card-text">
																							<!--begin::Heading-->
																							<!--begin::Badge-->
																							<div class="fs-6 fs-lg-6"><span class="badge badge-circle badge-light-danger fw-bold fs-3">3</span></div>
																							<!--end::Badge-->
																							<div class="d-flex flex-center mb-5">
																								<!--begin::Title-->
																								<div class="fs-5 fs-lg-1 fw-bold text-light">Sarjana Muda</div>
																								<!--end::Title-->
																							</div>
																							<!--end::Heading-->
																							<!--begin::Description-->
																							<div class="fs-6 fs-lg-4">4 Tahun</div>
																							<div class="fs-7 fs-lg-6">(Had Pembiayaan RM6,200.00 sehingga RM24,800.00)</div>
																							<!--end::Description-->
																						</div>	
																					</div>
																				</div>
																				<!--end::Sarjana Muda-->

																				<!--begin::Diploma Lepasan Ijazah-->
																				<div class="text-center mb-10 mb-md-0">
																					<div class="card" style="background-color: #136A9F">
																						<div class="card-text">
																							<!--begin::Heading-->
																							<!--begin::Badge-->
																							<div class="fs-6 fs-lg-6"><span class="badge badge-circle badge-light-danger fw-bold fs-3">4</span></div>
																							<!--end::Badge-->
																							<div class="d-flex flex-center mb-5">
																								<!--begin::Title-->
																								<div class="fs-5 fs-lg-1 fw-bold text-light">Diploma Lepasan Ijazah</div>
																								<!--end::Title-->
																							</div>
																							<!--end::Heading-->
																							<!--begin::Description-->
																							<div class="fs-6 fs-lg-4">2 Tahun</div>
																							<div class="fs-7 fs-lg-6">(Had Pembiayaan RM6,200.00 sehingga RM12,400.00)</div>
																							<!--end::Description-->
																						</div>	
																					</div>
																				</div>
																				<!--end::Diploma Lepasan Ijazah-->
																			</div>
																			<!--end::Col-->
																			<!--begin::Col-->
																			<div class="col-md-4 px-1">
																				<!--begin::Sarjana-->
																				<div class="text-center mb-10 mb-md-0">
																					<div class="card" style="background-color: #F89D2A">
																						<div class="card-text">
																							<!--begin::Heading-->
																							<!--begin::Badge-->
																							<div class="fs-6 fs-lg-6"><span class="badge badge-circle badge-light-danger fw-bold fs-3">5</span></div>
																							<!--end::Badge-->
																							<div class="d-flex flex-center mb-5">
																								<!--begin::Title-->
																								<div class="fs-5 fs-lg-1 fw-bold text-light">Sarjana</div>
																								<!--end::Title-->
																							</div>
																							<!--end::Heading-->
																							<!--begin::Description-->
																							<div class="fs-6 fs-lg-4">2 Tahun</div>
																							<div class="fs-7 fs-lg-6">(Had Pembiayaan RM6,200.00 sehingga RM12,400.00)</div>
																							<!--end::Description-->
																						</div>	
																					</div>
																				</div>
																				<!--end::Sarjana-->

																				<!--begin::Ph.D-->
																				<div class="text-center mb-10 mb-md-0">
																					<div class="card" style="background-color: #14496B">
																						<div class="card-text">
																							<!--begin::Heading-->
																							<!--begin::Badge-->
																							<div class="fs-6 fs-lg-6"><span class="badge badge-circle badge-light-danger fw-bold fs-3">6</span></div>
																							<!--end::Badge-->
																							<div class="d-flex flex-center mb-5">
																								<!--begin::Title-->
																								<div class="fs-5 fs-lg-1 fw-bold text-light">Ph.D</div>
																								<!--end::Title-->
																							</div>
																							<!--end::Heading-->
																							<!--begin::Description-->
																							<div class="fs-6 fs-lg-4">4 Tahun</div>
																							<div class="fs-7 fs-lg-6">(Had Pembiayaan RM6,200.00 sehingga RM24,800.00)</div>
																							<!--end::Description-->
																						</div>	
																					</div>
																				</div>
																				<!--end::Ph.D-->
																			</div>
																			<!--end::Col-->
																		</div>
																		<!--end::Card Tempoh-->
																	</span><br><br>
																</div>
																<!--end::Tempoh BKOKU-->
															</div>
														</div>
														<!--end::Features-->
													</div>
												</div>
											</div>
											<!--end::Card 1-->
										</div>

									</div>
									<!--end::Col-->
								</div>
								<!--end::Row-->
							</div>
							<!--end::BKOKU-->
						</div>
						<!--end::Plans-->
					</div>
					<!--end::Container-->
				</div>
				<!--end::Wrapper-->
			</div>
			<!--end::Maklumat BKOKU Section-->

			<!--begin::Maklumat PPK Section-->
			<div class="py-10 py-lg-20" id="ppk">
				<!--begin::Wrapper-->
				<div class="py-1 landing-dark-bg" style="background-color: rgb(255, 255, 255);">
					<!--begin::Container-->
					<div class="container">
						<!--begin::Plans-->
						<div class="d-flex flex-column container pt-lg-15">
							<!--begin::PPK-->
							<div class="text-center">
								<!--begin::Row-->
								<div class="row g-10">
									<!--begin::Col-->
									<div class="col-xl-12">
										<div class="d-flex h-100">
											<!--begin::Card 1-->
											<div class="w-100 d-flex flex-column flex-center rounded-3 py-10 px-10 me-3" style="flex-grow: 1; background-color: rgb(255, 255, 255); box-shadow: 0 30px 30px rgba(0, 0, 0, 0.2); border: 1px solid #ccc;">
												<div class="card-utama border-0">
													<div class="card-body">
														<!--begin::Features-->
														<div class="w-100 mb-10">
															<!--begin::Item-->
															<div class="d-flex flex-column mb-5" style="background-color: #EF402D; padding: 15px; border-radius: 5px;">
																<span class="fw-bold text-light fs-2 mb-2">PROGRAM PENDIDIKAN KHAS (PPK)</span>
															</div>
															<!--end::Item-->
															<!--begin::Item-->
															<div class="d-flex flex-column mb-5 align-items-start">
																<label class="mb-2 fw-bold fs-2 text-justify flex-grow-1"><b>Objektif:</b></label>
																<span class="fw-semibold fs-2 text-gray-800 text-justify flex-grow-1">
																	Program ini bertujuan untuk meningkatkan dan memperluaskan peluang pembelajaran sepanjang hayat kepada golongan OKU yang melanjutkan pengajian di UA, IPTS, Kolej Komuniti dan Politeknik di bawah seliaan KPT
																</span><br><br>
															</div>
															<!--end::Item-->
															<!--begin::Item-->
															<div class="d-flex flex-column mb-5 align-items-start">
																<label class="mb-2 fw-bold fs-2 text-justify flex-grow-1"><b>Tatacara Permohonan:</b></label>
																<span class="fw-semibold fs-2 text-gray-800 text-justify flex-grow-1">
																	i.	Pemohon perlu membuat permohonan dengan mengemukakan salinan dokumen yang dinyatakan dengan lengkap melalui sistem Penajaan OKU (SisPO).
																</span><br><br>
																<span class="fw-semibold fs-2 text-gray-800 text-justify flex-grow-1">
																	ii.	Hanya Invois Asal yang perlu dimuatnaik melalui Sistem Penajaan OKU (SisPO).
																</span><br><br>
															</div>
															<!--end::Item-->

															<!--begin::Item-->
															<div class="container">
																<div class="row">
																	<!-- Card 1 -->
																	<div class="col-md-3 mb-4">
																		<a id="show_skop_ppk" href="#skop_ppk" data-kt-scroll-toggle="true" data-kt-drawer-dismiss="true">
																			<!--div class="card-ppk" style="background-color: #1F97D4; padding: 15px; border-radius: 5px;"-->
																			<div class="card-ppk">
																				<div class="card-body">
																					<div class="justify-content-center" >
																						<img src="assets/media/human-resource.png" alt="Skop" style="width: 80px; height: auto; margin-top: 20px;">
																					</div>
																					<div class="d-flex justify-content-center mb-5">
																						<div class="fs-5 fs-lg-1 fw-bold text-dark">Skop Pembiayaan</div>
																					</div>
																				</div>
																			</div>
																		</a>
																	</div>
																	<!-- Card 2 -->
																	<div class="col-md-3 mb-4">
																		<a id="show_syarat_ppk" href="#syarat_ppk" data-kt-scroll-toggle="true" data-kt-drawer-dismiss="true">
																			<!--div class="card-ppk" style="background-color: #59BA47; padding: 15px; border-radius: 5px;"-->
																			<div class="card-ppk">
																				<div class="card-body">
																					<div class="justify-content-center" >
																						<img src="assets/media/file.png" alt="Syarat" style="width: 80px; height: auto; margin-top: 20px;">
																					</div>
																					<div class="d-flex justify-content-center mb-5">
																						<div class="fs-5 fs-lg-1 fw-bold text-dark">Syarat Pembiayaan</div>
																					</div>
																				</div>
																			</div>
																		</a>	
																	</div>
																	<!-- Card 3 -->
																	<div class="col-md-3 mb-4">
																		<a id="show_elemen_ppk" href="#elemen_ppk" data-kt-scroll-toggle="true" data-kt-drawer-dismiss="true">
																			<!--div class="card-ppk" style="background-color: #FBC412; padding: 15px; border-radius: 5px;"-->
																			<div class="card-ppk">
																				<div class="card-body">
																					<div class="justify-content-center" >
																						<img src="assets/media/business-aggrement.png" alt="Elemen" style="width: 80px; height: auto; margin-top: 20px;">
																					</div>
																					<div class="d-flex justify-content-center mb-5">
																						<div class="fs-5 fs-lg-1 fw-bold text-dark">Elemen Tajaan</div>
																					</div>
																				</div>
																			</div>
																		</a>	
																	</div>
																	<!-- Card 4 -->
																	<div class="col-md-3 mb-4">
																		<a id="show_tempoh_ppk" href="#tempoh_ppk" data-kt-scroll-toggle="true" data-kt-drawer-dismiss="true">
																			<!--div class="card-ppk" style="background-color: #EF402D; padding: 15px; border-radius: 5px;"-->
																			<div class="card-ppk">
																				<div class="card-body">
																					<div class="justify-content-center" >
																						<img src="assets/media/timetable.png" alt="Tempoh" style="width: 80px; height: auto; margin-top: 20px;">
																					</div>
																					<div class="d-flex justify-content-center mb-5">
																						<div class="fs-5 fs-lg-1 fw-bold text-dark">Tempoh Penajaan</div>
																					</div>
																				</div>
																			</div>
																		</a>	
																	</div>
																</div>
															</div>
															<!--end::Item-->
															<div class="container" style="text-align: left;">
																<!--begin::Skop PPK-->
																<div class="flex-column mb-5" id="skop_ppk" style="display:none;">
																	<br><br>
																	<span class="fw-semibold fs-2 text-gray-800 text-justify flex-grow-1">
																		i. Skop pembiayaan PPK adalah tertumpu kepada Kolej Komuniti dan Politeknik terpilih sahaja dari Sijil Kemahiran Khas.
																	</span><br><br>
																	<span class="fw-semibold fs-2 text-gray-800 text-justify flex-grow-1">
																		ii. Senarai Institusi dan Nama Program yang Terlibat:
																	</span><br><br>
																	<span class="fw-semibold fs-2 text-gray-800 text-justify flex-grow-1">
																		<!-- Table Start -->
																		<table style="box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);">
																			<thead>
																				<tr>
																					<th style="background-color: #96b6cd;">Bil.</th>
																					<th style="background-color: #96b6cd;">Institusi</th>
																					<th style="background-color: #96b6cd;">Nama Program</th>
																				</tr>
																			</thead>
																			<tbody>
																				<tr>
																					<td>1.</td>
																					<td>Politeknik Ungku Omar</td>
																					<td>Sijil Khas Pembinaan</td>
																				</tr>
																				<tr>
																					<td>2.</td>
																					<td>Politeknik Sultan Salahuddin Abdul Aziz Shah</td>
																					<td>Sijil Khas Penyenggaraan Mekanikal</td>
																				</tr>
																				<tr>
																					<td>3.</td>
																					<td>Politeknik Kota Kinabalu</td>
																					<td>Sijil Khas Operasi Katering</td>
																				</tr>
																				<tr>
																					<td>4.</td>
																					<td>Politeknik Tuanku Syed Sirajuddin</td>
																					<td>Sijil Khas Operasi Katering</td>
																				</tr>
																				<tr>
																					<td>5.</td>
																					<td>Politeknik Ibrahim Sultan</td>
																					<td>
																						<ul>a. Sijil Khas Operasi Katering</ul>
																						<ul>b. Sijil Khas Reka Bentuk Fesyen</ul>
																						<ul>c. Sijil Khas Reka Bentuk Grafik</ul>
																					</td>
																				</tr>
																				<tr>
																					<td>6.</td>
																					<td>Kolej Komuniti Selayang</td>
																					<td>Sijil Asas Kulinari</td>
																				</tr>
																			</tbody>
																		</table>
																		<!-- Table End -->
																	</span><br><br>
																</div>
																<!--end::Skop PPK-->
																<!--begin::Syarat PPK-->
																<div class="flex-column mb-5" id="syarat_ppk" style="display:none;">
																	<br><br>
																	<span class="fw-semibold fs-2 text-gray-800 text-justify flex-grow-1">
																		Pelajar OKU yang mempunyai kod DD atau DE (Pendengaran sahaja) di Kolej Komuniti dan Politeknik terpilih.
																	</span><br><br>
																</div>
																<!--end::Syarat PPK-->
																<!--begin::Elemen PPK-->
																<div class="flex-column mb-5" id="elemen_ppk" style="display:none;">
																	<br><br>
																	<span class="fw-semibold fs-2 text-gray-800 text-justify flex-grow-1">
																		i. Kadar Bayaran PPK adalah sebanyak :
																	</span><br><br>
																	<span class="fw-semibold fs-2 text-gray-800 text-justify flex-grow-1">
																		<i class="fa-solid fa-check"></i> RM 4260 / Semester 1 sahaja; dan
																	</span><br><br>
																	<span class="fw-semibold fs-2 text-gray-800 text-justify flex-grow-1">
																		<i class="fa-solid fa-check"></i> RM 3960 / Semester 2 hingga 4
																	</span><br><br>
																</div>
																<!--end::Elemen PPK-->
																<!--begin::Tempoh PPK-->
																<div class="flex-column mb-5" id="tempoh_ppk" style="display:none;">
																	<br><br>
																	<span class="fw-semibold fs-2 text-gray-800 text-justify flex-grow-1">
																		2 Tahun
																	</span><br><br>
																</div>
																<!--end::Tempoh PPK-->
															</div>
														</div>
														<!--end::Features-->
													</div>
												</div>
											</div>
											<!--end::Card 1-->
										</div>

									</div>
									<!--end::Col-->
								</div>
								<!--end::Row-->
							</div>
							<!--end::PPK-->
						</div>
						<!--end::Plans-->
					</div>
					<!--end::Container-->
				</div>
				<!--end::Wrapper-->
			</div>
			<!--end::Maklumat PPK Section-->

			<!--Hubungi Kami-->
			<div class="row" id="hubungi" style="margin-top: 30px;">
				<div class="col-md-3">
					<div class="media">
						<div class="media-body">
							<div class="media mt-3">
								<div class="ms-12">
									<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3984.721301282511!2d101.66520007654144!3d2.8964460546508257!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31cdb7a1f5e8db05%3A0xd07cf0be45f8944c!2sMinistry%20of%20Higher%20Education!5e0!3m2!1sen!2smy!4v1725518423614!5m2!1sen!2smy" 
									width="250" height="200" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-3">
					<div class="fs-4 fw-bold text-dark mb-3">Lokasi :</div>
					<!--begin::Alamat-->
					<div class="fw-semibold fs-6">Kementerian Pendidikan Tinggi,
						<br /> Bahagian Biasiswa,
						<br /> Unit Pra Perkhidmatan,
						<br /> Aras 2, No. 2, Menara 2,
						<br /> Jalan P5/6, Presint 5,
						<br /> 62200 Wilayah Persekutuan Putrajaya.
					</div>
					<!--end::Alamat-->
				</div>
				<div class="col-md-3">
					<!--begin::Title-->
					<div class="fs-4 fw-bold text-dark mb-3">Hubungi Kami :</div>
					<!--end::Title-->
					<!--begin::Telefon-->
					<div class="fw-semibold fs-7"><i class="fa-solid fa-phone"></i>&nbsp;&nbsp;+603 8870 6347</div>									
					<!--end::Telefon-->
					<br />
					<!--begin::Title-->
					<div class="fs-4 fw-bold text-dark mb-3">E-mel Unit BKOKU :</div>
					<!--end::Title-->
					<!--begin::Emel-->
					<div class="fw-semibold fs-6">(i) Institusi Pengajian Tinggi Swasta, Politeknik & Kolej Komuniti
						<br /><i class="fa-regular fa-envelope"></i>&nbsp;&nbsp;bkoku@mohe.gov.my</div>
					<br />
					<div class="fw-semibold fs-6">(ii)Universiti Awam
						<br /><i class="fa-regular fa-envelope"></i>&nbsp;&nbsp;iptabkoku@mohe.gov.my</div>
					<!--end::Emel-->
				</div>
				<div class="col-md-3">
					 <!--begin::Title-->
					 <div class="fs-4 fw-bold text-dark mb-3">Waktu Operasi :</div>
					 <!--end::Title-->
					 <!--begin::Waktu-->
					 <div class="fw-semibold fs-6">Isnin hingga Jumaat 
					 <br /> 9.00 pagi - 4.30 petang</div>
					 <!--end::Waktu-->
					 <br />
					 <!--begin::Waktu-->
					 <div class="fw-semibold fs-6">Kecuali Cuti Umum & Hari Kelepasan Am
					 </div>
					 <!--end::Waktu-->
					 <br />
					 <!--begin::Title-->
					 <div class="fs-4 fw-bold text-dark mb-3">Waktu Rehat :</div>
					 <!--end::Title-->
					 <!--begin::Waktu-->
					 <div class="fw-semibold fs-6">Isnin hingga Khamis 
					 <br /> (1.00 tengah hari - 2.00 petang)</div>
					 <!--end::Waktu-->
					 <!--begin::Waktu-->
					 <div class="fw-semibold fs-6">Jumaat 
					 <br /> (12.15 tengah hari - 2.45 petang)</div>
					 <!--end::Waktu-->
				</div>
			</div>

			<!--begin::Footer Section-->
			<div class="mb-0">
				<!--begin::Curve top-->
				{{-- <div class="landing-curve landing-dark-color" style="color: rgb(2, 2, 55);">
					<svg viewBox="15 -1 1470 48" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M1 48C4.93573 47.6644 8.85984 47.3311 12.7725 47H1489.16C1493.1 47.3311 1497.04 47.6644 1501 48V47H1489.16C914.668 -1.34764 587.282 -1.61174 12.7725 47H1V48Z" fill="currentColor"></path>
					</svg>
				</div> --}}
				<!--end::Curve top-->

				<!--begin::Wrapper-->
				<div class="landing-dark-bg" style="background-color: rgb(2, 2, 55);">
					<!--begin::Container-->
					<div class="container">
						<!--begin::Wrapper-->
						<div class="app-container container-fluid d-flex flex-column flex-md-row flex-center py-3">
							<!--begin::Footer-->
							<div class="d-flex align-items-center flex-center order-2 order-md-1">
								<span class="mx-5 fs-7 fw-semibold text-light">
									SisPO, Kementerian Pendidikan Tinggi <span id="currentYear"></span> © Hak Cipta Terpelihara
								</span>

								<script>
									document.getElementById('currentYear').innerText = new Date().getFullYear();
								</script>
							</div>
							<!--end::Footer-->
						</div>
						<!--end::Wrapper-->
					</div>
					<!--end::Container-->
				</div>
				<!--end::Wrapper-->
			</div>
			<!--end::Footer Section-->
		</div>

		<!--begin::Javascript-->
		<script>var hostUrl = "assets/";</script>
		<!--begin::Global Javascript Bundle(mandatory for all pages)-->
		<script src="assets/plugins/global/plugins.bundle.js"></script>
		<script src="assets/js/scripts.bundle.js"></script>
		<!--end::Global Javascript Bundle-->	

		<!--end::Custom Javascript-->
		<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
		<script>
			// Get all nav links
			const navLinks = document.querySelectorAll('.landing-header .menu .nav-link');

			// Add click event to each main nav link
			navLinks.forEach(link => {
				link.addEventListener('click', function() {
					// Remove active class from all links
					navLinks.forEach(l => l.classList.remove('active'));

					// Add active class to the clicked link
					this.classList.add('active');
					
					// Check if the clicked link is "MAKLUMAT BKOKU or PPK"
					if (this.id === 'show-ppk' || this.id === 'show-bkoku') {
						// Activate the parent "MAKLUMAT PENAJAAN" link
						const parentLink = document.getElementById('dropdown-bkoku');
						parentLink.classList.add('active');
					}
				});
			});

		</script>
		<script>
			// Hide all sections initially
			$(`#utama, #hubungi, #bkoku, #ppk`).hide();

			$('#show-utama').click(function(event) {
				$('#utama').show();
				$('#hubungi').hide();
				$('#bkoku').hide();
				$('#ppk').hide();
			});

			$('#show-bkoku').click(function(event) {
				$('#utama').hide();
				$('#hubungi').hide();
				$('#bkoku').show();
				$('#ppk').hide();
			});

			$('#show-ppk').click(function(event) {
				$('#utama').hide();
				$('#hubungi').hide();
				$('#bkoku').hide();
				$('#ppk').show();
			});

			$('#show-hubungi').click(function(event) {
				$('#utama').hide();
				$('#hubungi').show();
				$('#bkoku').hide();
				$('#ppk').hide();
			});
		</script>

		<script>
			$(document).ready(function() {
				function initializeCardToggle(section) {
					$(`.card-${section}`).click(function() {
						// Remove 'active' class from all cards
						$(`.card-${section}`).removeClass('active');

						// Add 'active' class to the clicked card
						$(this).addClass('active');
					});

					// Hide all sections initially
					$(`#skop_${section}, #syarat_${section}, #elemen_${section}, #tempoh_${section}`).hide();

					// Click event handlers for showing and hiding sections
					$(`#show_skop_${section}`).click(function() {
						$(`#skop_${section}`).show();
						$(`#syarat_${section}, #elemen_${section}, #tempoh_${section}`).hide();
					});

					$(`#show_syarat_${section}`).click(function() {
						$(`#skop_${section}`).hide();
						$(`#syarat_${section}`).show();
						$(`#elemen_${section}, #tempoh_${section}`).hide();
					});

					$(`#show_elemen_${section}`).click(function() {
						$(`#skop_${section}, #syarat_${section}`).hide();
						$(`#elemen_${section}`).show();
						$(`#tempoh_${section}`).hide();
					});

					$(`#show_tempoh_${section}`).click(function() {
						$(`#skop_${section}, #syarat_${section}, #elemen_${section}`).hide();
						$(`#tempoh_${section}`).show();
					});
				}

				// Initialize for both BKOKU and PPK sections
				initializeCardToggle('bkoku');
				initializeCardToggle('ppk');
			});
		</script>
		
		<!--end::Javascript-->

	</body>
</html>
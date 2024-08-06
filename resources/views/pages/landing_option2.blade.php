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
		<!--end::Fonts-->
		<!--begin::Global Stylesheets Bundle(mandatory for all pages)-->
		<link href="assets/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css" />
		<link href="assets/css/style.bundle.css" rel="stylesheet" type="text/css" />
		<!--end::Global Stylesheets Bundle-->
		<script>// Frame-busting to prevent site from being loaded within a frame without permission (click-jacking) if (window.top != window.self) { window.top.location.replace(window.self.location.href); }</script>
		<style>
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


			.header-background {
				position: relative;
				min-height: 100px;
				min-height: 800px;
			}

			.background-video {
				position: absolute;
				top: 50%;
				left: 50%;
				width: 100%;
				height: 100%;
				object-fit: cover;
				transform: translate(-50%, -50%);
				z-index: 0;
			}

											
			.landing-header {
				/* background-color: white;  */

				position: absolute;
				top: 0;
				width: 100%;
				z-index: 10; /* Ensure the header stays above other elements */
			}

			.landing-header .container {
				display: flex;
				align-items: center;
				justify-content: space-between;
			}

			.menu-link {
				color: rgb(106, 190, 232);
			}

			.menu-link:hover {
				color: #ddd; 
			}

			.btn-permohonan {
				background-color: #0c4277;
				border-color: #0c4277;
			}

			.btn-permohonan:hover {
				background-color: #10355a;
				border-color: #10355a;
			}
			.content-left {
				position: absolute;
				left: 50%;
				top: 50%;
				width: 100%;
				transform: translate(-50%, -50%);
				z-index: 20;
				color: white;
				text-align: center;
				/* background: rgba(134, 188, 222, 0.5);  */
				/* Optional: add background to make text more readable */
				padding: 20px;
				border-radius: 10px;
			}

			.content-left img {
				padding-bottom: 30px;
			}

			.content-left h4 .id-color {
				color: #f9b200;
			}

			.text-transition {
				transition: all 0.5s linear;
				color: #FFFFFF;
			}

			.text-transition:hover {
				color: #0570ea;
				transform: scale(1.1);
			}
		</style>
		<style>
			.card-container {
				display: flex;
				gap: 20px;
				width: 100%;
				overflow-x: auto;
				/* padding: 10px; */
			}

			.card {
				position: relative;
				width: 500px;
				height: 300px;
				border-radius: 15px;
				overflow: hidden;
				box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
				transition: transform 0.3s;
			}

			.card img {
				width: 100%;
				height: 300px;
				display: block;
			}

			.card-text {
				position: absolute;
				bottom: 20px;
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

			.box {
				position: absolute;
				left: 50%;
				top: 100%;
				transform: translate(-50%, -50%);
				display: flex;
				align-items: center;
				width: 70%;
				height: 50px;
				background-color: #333;
				color: white;
			}
			.box .left {
				background-color: #e91e63;
				padding: 10px 30px;
				font-weight: bold;
			}
			.box .middle {
				flex-grow: 1;
				padding: 10px 30px;
				display: flex;
				align-items: center;
				justify-content: space-between;
			}

			/* .moving-icon {
				display: inline-block;
				padding: 5px 5px;
				background-color: #ffeb3b; 
				color: #333; 
				font-weight: bold;
				font-family: Arial, sans-serif;
				border-radius: 10px;
				animation: move 2s linear infinite;
			}

			@keyframes move {
				0% { transform: translateX(0); }
				50% { transform: translateX(10px); }
				100% { transform: translateX(0); }
			} */
		</style>
	</head>
	<!--end::Head-->
	
	<!--begin::Body-->
	<body id="laman_utama" data-bs-spy="scroll" data-bs-target="#kt_landing_menu" class="bg-body position-relative app-blank" >
		<!--begin::Theme mode setup on page load-->
		<script>var defaultThemeMode = "light"; var themeMode; if ( document.documentElement ) { if ( document.documentElement.hasAttribute("data-bs-theme-mode")) { themeMode = document.documentElement.getAttribute("data-bs-theme-mode"); } else { if ( localStorage.getItem("data-bs-theme") !== null ) { themeMode = localStorage.getItem("data-bs-theme"); } else { themeMode = defaultThemeMode; } } if (themeMode === "system") { themeMode = window.matchMedia("(prefers-color-scheme: dark)").matches ? "dark" : "light"; } document.documentElement.setAttribute("data-bs-theme", themeMode); }</script>
		<!--end::Theme mode setup on page load-->
		<!--begin::Root-->
		<div class="d-flex flex-column flex-root" id="kt_app_root">
			<!--begin::Header Section-->
			<div class="mb-0" id="home">
				<!--begin::Wrapper-->
				<div class="header-background">
					<video autoplay loop muted class="background-video">
						<source src="assets/media/video_landing.mp4" type="video/mp4">
					</video>
					<!--begin::Header-->
					<div class="landing-header" data-kt-sticky="true" data-kt-sticky-name="landing-header" data-kt-sticky-offset="{default: '10px', lg: '10px'}">
						<!--begin::Container-->
						<div class="container">
							<!--begin::Wrapper-->
							<div class="d-flex align-items-center justify-content-between">
								<!--begin::Logo-->
								<div class="d-flex align-items-center flex-equal">
									<!--begin::Mobile menu toggle-->
									<button class="btn btn-icon btn-active-color-primary me-3 d-flex d-lg-none" id="kt_landing_menu_toggle">
										<i class="ki-duotone ki-abstract-14 fs-2hx">
											<span class="path1"></span>
											<span class="path2"></span>
										</i>
									</button>
									<!--end::Mobile menu toggle-->
									<!--begin::Logo image-->
									<a href="/landing">
										<img alt="Logo" src="assets/media/logos/bkoku.svg" class="logo-default h-35px h-lg-60px" />
										<img alt="Logo" src="assets/media/logos/bkoku.svg" class="logo-sticky h-30px h-lg-60px" />
									</a>
									<!--end::Logo image-->
								</div>
								<!--end::Logo-->
								<!--begin::Menu wrapper-->
								<div class="d-lg-block" id="kt_header_nav_wrapper">
									<div class="d-lg-block p-5 p-lg-0" data-kt-drawer="true" data-kt-drawer-name="landing-menu" data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true" data-kt-drawer-width="200px" data-kt-drawer-direction="start" data-kt-drawer-toggle="#kt_landing_menu_toggle" data-kt-swapper="true" data-kt-swapper-mode="prepend" data-kt-swapper-parent="{default: '#laman_utama', lg: '#kt_header_nav_wrapper'}">
										<!--begin::Menu-->
										<div class="menu menu-column flex-nowrap menu-rounded menu-lg-row menu-state-title-primary nav nav-flush fs-5 fw-bold" id="kt_landing_menu">
											<!--begin::Menu item-->
											<div class="menu-item">
												<!--begin::Menu link-->
												<a style="font-size: 1.5rem;" class="menu-link nav-link py-3 px-4 px-xxl-6" href="#laman_utama" data-kt-scroll-toggle="true" data-kt-drawer-dismiss="true">Utama</a>
												<!--end::Menu link-->
											</div>
											<!--end::Menu item-->
											<!--begin::Menu item-->
											<div class="menu-item">
												<!--begin::Menu link-->
												<a style="font-size: 1.5rem;" class="menu-link nav-link py-3 px-4 px-xxl-6" href="#info" data-kt-scroll-toggle="true" data-kt-drawer-dismiss="true">Info</a>
												<!--end::Menu link-->
											</div>
											<!--end::Menu item-->
											<!--begin::Menu item-->
											<div class="menu-item">
												<!--begin::Menu link-->
												<a style="font-size: 1.5rem;" class="menu-link nav-link py-3 px-4 px-xxl-6" href="#syarat" data-kt-scroll-toggle="true" data-kt-drawer-dismiss="true">Syarat</a>
												<!--end::Menu link-->
											</div>
											<!--end::Menu item-->
											<!--begin::Menu item-->
											<div class="menu-item">
												<!--begin::Menu link-->
												<a style="font-size: 1.5rem;" class="menu-link nav-link py-3 px-4 px-xxl-6" href="#kategori" data-kt-scroll-toggle="true" data-kt-drawer-dismiss="true">Kategori</a>
												<!--end::Menu link-->
											</div>
											<!--end::Menu item-->
											<!--begin::Menu item-->
											<div class="menu-item">
												<!--begin::Menu link-->
												<a style="font-size: 1.5rem;" class="menu-link nav-link py-3 px-4 px-xxl-6" href="#tempoh" data-kt-scroll-toggle="true" data-kt-drawer-dismiss="true">Tempoh</a>
												<!--end::Menu link-->
											</div>
											<!--end::Menu item-->
											<!--begin::Menu item-->
											<div class="menu-item">
												<!--begin::Menu link-->
												<a style="font-size: 1.5rem;" class="menu-link nav-link py-3 px-4 px-xxl-6" href="#bayaran" data-kt-scroll-toggle="true" data-kt-drawer-dismiss="true">Maklumat Pembiayaan</a>
												<!--end::Menu link-->
											</div>
											<!--end::Menu item-->
											<!--begin::Menu item-->
											<div class="menu-item">
												<!--begin::Menu link-->
												<a style="font-size: 1.5rem;" class="menu-link nav-link py-3 px-4 px-xxl-6" href="#hubungi" data-kt-scroll-toggle="true" data-kt-drawer-dismiss="true">Hubungi Kami</a>
												<!--end::Menu link-->
											</div>
											<!--end::Menu item-->
											<!--begin::Menu item-->
											<div class="menu-item">
												<!--begin::Menu link-->
												<a style="font-size: 1.5rem; color:#f2f2f2" href="http://bkoku.mohe.gov.my/login" class=" menu-link nav-link py-3 px-4 px-xxl-6 btn btn-permohonan">Permohonan</a>
												<!--end::Menu link-->
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
						<!--end::Container-->
					</div>
					<!--end::Header-->
					<!--begin::Center content-->
					<div class="content-left">
						<!--img src="assets/media/jata_kpt.svg" alt="KPT Malaysia" width="25%" style="padding-bottom:30px"-->
						<h4 class="text-transition" style="font-size: 3.5rem;"><span class="id-color">Selamat Datang ke</span></h4>
						<h1 class="text-transition" style="font-size: 3.5rem;"><span style="text-transform:uppercase">Sistem Bantuan Kewangan OKU & PPK</span></h1>
					</div>
					<!--end::Center content-->

					<!--begin::Hebahan content-->
					<div class="box">
						<div class="left">HEBAHAN</div>
						<!-- div class="moving-icon">PENTING</div-->
						<div class="middle">
        					<span style="font-size: 1.5rem;">{!! $catatan  ?? 'No notes available' !!}</span>
						</div>
					</div>
					
					<!--end::Hebahan content-->
				</div>
				<!--end::Wrapper-->
				<!--begin::Curve bottom-->
				<div class="landing-curve landing-dark-color mb-5 mb-lg-5">
					<!-- Add any additional design elements here -->
				</div>
				<!--end::Curve bottom-->
			</div>
			<!--end::Header Section-->

			<!--begin::Info Section-->
			<div class="py-10 py-lg-20">
				<!--begin::Curve top-->
				<div class="landing-curve landing-dark-color" style="color: rgb(2, 2, 55);">
					<svg viewBox="15 -1 1470 48" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M1 48C4.93573 47.6644 8.85984 47.3311 12.7725 47H1489.16C1493.1 47.3311 1497.04 47.6644 1501 48V47H1489.16C914.668 -1.34764 587.282 -1.61174 12.7725 47H1V48Z" fill="currentColor"></path>
					</svg>
				</div>
				<!--end::Curve top-->
				<!--begin::Wrapper-->
				<div class="py-1 landing-dark-bg" style="background-color: rgb(2, 2, 55);">
					<!--begin::Container-->
					<div class="container">
						<!--begin::Plans-->
						<div class="d-flex flex-column container pt-lg-15">
							<!--begin::Heading-->
							<div class="mb-13 text-center">
								<h1 class="fs-2hx fw-bold" style="color: white;" id="info" data-kt-scroll-offset="{default: 100, lg: 150}">SYARAT DAN SKOP PEMBIAYAAN</h1>
							</div>
							<!--end::Heading-->
							<!--begin::Syarat-->
							<div class="text-center">
								<!--begin::Row-->
								<div class="row g-10">
									<!--begin::Col-->
									<div class="col-xl-12">
										<div class="d-flex h-100 align-items-center">
											<!--begin::Option-->
											<div class="w-100 d-flex flex-column flex-center rounded-3 bg-body py-10 px-10">
												<!--begin::Features-->
												<div class="w-100 mb-10">
													<!--begin::Item-->
													<div class="d-flex flex-stack mb-5" style="background-color: #96b6cd; padding: 5px; border-radius: 5px;">
														<span class="fw-bold fs-6">SYARAT DAN GARIS PANDUAN UMUM</span>
													</div>
													<!--end::Item-->
													<!--begin::Item-->
													<div class="d-flex flex-stack mb-5">
														<span class="fw-semibold fs-6 text-gray-800 text-start pe-3">Bantuan ini merupakan keistimewaan yang diberikan kepada pelajar OKU. Oleh itu, ianya harus dibezakan dengan kemudahan-kemudahan lain yang turut diterima oleh pelajar bukan OKU. Ini bermakna sekiranya seseorang pelajar OKU itu menerima biasiswa atau kemudahan lain yang juga turut dinikmati oleh pelajar bukan OKU, maka pelajar OKU tersebut adalah layak menerima elaun ini.</span>
														<i class="ki-duotone ki-verify fs-1 text-danger">
															<span class="path1"></span>
															<span class="path2"></span>
														</i>
													</div>
													<!--end::Item-->
													<!--begin::Item-->
													<div class="d-flex flex-stack mb-5">
														<span class="fw-semibold fs-6 text-gray-800 text-start pe-3">Elaun khas ini tidak mengambil kira taraf pendapatan sebagai syarat kelayakan.</span>
														<i class="ki-duotone ki-verify fs-1 text-danger">
															<span class="path1"></span>
															<span class="path2"></span>
														</i>
													</div>
													<!--end::Item-->
													<!--begin::Item-->
													<div class="d-flex flex-stack mb-5" style="background-color: #96b6cd; padding: 5px; border-radius: 5px;">
														<span class="fw-bold fs-6">SKOP PEMBIAYAAN ELAUN KHAS</span>
													</div>
													<!--end::Item-->
													<!--begin::Item-->
													<div class="d-flex flex-stack mb-5">
														<span class="fw-semibold fs-6 text-gray-800 text-start pe-3">Skop pembiayaan OKU adalah tertumpu kepada institusi yang terletak dibawah pengurusan dan kawalan Kementerian Pendidikan Tinggi (KPT) iaitu semua IPTA, IPTS, Politeknik dan Kolej Komuniti sahaja;</span>
														<i class="ki-duotone ki-pin fs-1 text-danger">
															<span class="path1"></span>
															<span class="path2"></span>
														</i>
													</div>
													<!--end::Item-->
													<!--begin::Item-->
													<div class="d-flex flex-stack mb-5">
														<span class="fw-semibold fs-6 text-gray-800 text-start pe-3">Skop peringkat pengajian pula adalah tertakluk kepada tafsiran pengajian tinggi (tertiary) iaitu peringkat diploma dan ke atas sahaja. Walau bagaimanapun, kursus peringkat sijil jangka panjang di politeknik dan kolej komuniti yang di bawah tanggungjawab KPT boleh dipertimbangkan untuk bantuan kewangan OKU ini;</span>
														<i class="ki-duotone ki-pin fs-1 text-danger">
															<span class="path1"></span>
															<span class="path2"></span>
														</i>
													</div>
													<!--end::Item-->
													<!--begin::Item-->
													<div class="d-flex flex-stack mb-5">
														<span class="fw-semibold fs-6 text-gray-800 text-start pe-3">Pelajar OKU yang menuntut di institusi-institusi latihan bukan bertaraf IPT yang dikawal oleh kementerian-kementerian lain dan institusi-institusi pengajian tinggi luar negara adalah di luar skop pembiayaan.</span>
														<i class="ki-duotone ki-pin fs-1 text-danger">
															<span class="path1"></span>
															<span class="path2"></span>
														</i>
													</div>
													<!--end::Item-->
													
												</div>
												<!--end::Features-->
												
											</div>
											<!--end::Option-->
										</div>
									</div>
									<!--end::Col-->
								</div>
								<!--end::Row-->
							</div>
							<!--end::Syarat-->
						</div>
						<!--end::Plans-->
					</div>
					<!--end::Container-->
				</div>
				<!--end::Wrapper-->
				<!--begin::Curve bottom-->
				<div class="landing-curve landing-dark-color" style="color: rgb(2, 2, 55);">
					<svg viewBox="15 12 1470 48" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M0 11C3.93573 11.3356 7.85984 11.6689 11.7725 12H1488.16C1492.1 11.6689 1496.04 11.3356 1500 11V12H1488.16C913.668 60.3476 586.282 60.6117 11.7725 12H0V11Z" fill="currentColor"></path>
					</svg>
				</div>
				<!--end::Curve bottom-->
			</div>
			<!--end::Info Section-->

			<!--begin::Syarat Section-->
			<div class="py-10 py-lg-20">
				<!--begin::Curve top-->
				<div class="landing-curve landing-dark-color" style="color: rgb(2, 2, 55);">
					<svg viewBox="15 -1 1470 48" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M1 48C4.93573 47.6644 8.85984 47.3311 12.7725 47H1489.16C1493.1 47.3311 1497.04 47.6644 1501 48V47H1489.16C914.668 -1.34764 587.282 -1.61174 12.7725 47H1V48Z" fill="currentColor"></path>
					</svg>
				</div>
				<!--end::Curve top-->
				<!--begin::Wrapper-->
				<div class="py-1 landing-dark-bg" style="background-color: rgb(2, 2, 55);">
					<!--begin::Container-->
					<div class="container">
						<!--begin::Plans-->
						<div class="d-flex flex-column container pt-lg-15">
							<!--begin::Heading-->
							<div class="mb-13 text-center">
								<h1 class="fs-2hx fw-bold" style="color: white;" id="syarat" data-kt-scroll-offset="{default: 100, lg: 150}">SYARAT-SYARAT BANTUAN KEWANGAN PELAJAR OKU</h1>
							</div>
							<!--end::Heading-->
							<!--begin::Syarat-->
							<div class="text-center">
								<!--begin::Row-->
								<div class="row g-10">
									<!--begin::Col-->
									<div class="col-xl-12">
										<div class="d-flex h-100 align-items-center">
											<!--begin::Option-->
											<div class="w-100 d-flex flex-column flex-center rounded-3 bg-body py-10 px-10">
												<!--begin::Features-->
												<div class="w-100 mb-10">
													<!--begin::Item-->
													<div class="d-flex flex-stack mb-5">
														<span class="fw-semibold fs-6 text-gray-800 text-start pe-3">i. Pelajar warganegara Malaysia;</span>
														<i class="ki-duotone ki-check-circle fs-1 text-success">
															<span class="path1"></span>
															<span class="path2"></span>
														</i>
													</div>
													<!--end::Item-->
													<!--begin::Item-->
													<div class="d-flex flex-stack mb-5">
														<span class="fw-semibold fs-6 text-gray-800 text-start pe-3">ii. Pelajar berdaftar dengan Jabatan Kebajikan Masyarakat (JKM) dan telah mempunyai kad OKU;</span>
														<i class="ki-duotone ki-check-circle fs-1 text-success">
															<span class="path1"></span>
															<span class="path2"></span>
														</i>
													</div>
													<!--end::Item-->
													<!--begin::Item-->
													<div class="d-flex flex-stack mb-5">
														<span class="fw-semibold fs-6 text-gray-800 text-start pe-3">iii. Kursus yang diikuti hendaklah diiktiraf oleh Agensi Kelayakan Malaysia (MQA) atau Jabatan Perkhidmatan Awam (JPA).</span>
														<i class="ki-duotone ki-check-circle fs-1 text-success">
															<span class="path1"></span>
															<span class="path2"></span>
														</i>
													</div>
													<!--end::Item-->
													<!--begin::Item-->
													<div class="d-flex flex-stack mb-5">
														<span class="fw-semibold fs-6 text-gray-800 text-start pe-3">iv. Pelajar OKU yang menerima pinjaman pelajaran atau pembiayaan sendiri adalah layak menerima elemen wangsaku dan yuran pengajian. Penerima biasiswa pula layak mendapat wang saku sahaja;</span>
														<i class="ki-duotone ki-check-circle fs-1 text-success">
															<span class="path1"></span>
															<span class="path2"></span>
														</i>
													</div>
													<!--end::Item-->
													<!--begin::Item-->
													<div class="d-flex flex-stack mb-5">
														<span class="fw-semibold fs-6 text-gray-800 text-start pe-3">v. Pelajar hendaklah sedang melanjutkan pengajian di mana-mana universiti awam atau IPTS (bawah seliaan KPT) atau Kolej Komuniti dan Politeknik;</span>
														<i class="ki-duotone ki-check-circle fs-1 text-success">
															<span class="path1"></span>
															<span class="path2"></span>
														</i>
													</div>
													<!--end::Item-->
													<!--begin::Item-->
													<div class="d-flex flex-stack mb-5">
														<span class="fw-semibold fs-6 text-gray-800 text-start pe-3">vi. Pelajar yang mengikuti kursus separuh masa atau pengajian jarak jauh layak menerima bantuan kewangan ini;dan</span>
														<i class="ki-duotone ki-check-circle fs-1 text-success">
															<span class="path1"></span>
															<span class="path2"></span>
														</i>
													</div>
													<!--end::Item-->
													<!--begin::Item-->
													<div class="d-flex flex-stack mb-5">
														<span class="fw-semibold fs-6 text-gray-800 text-start pe-3">vii. Pelajar OKU hendaklah bukan dalam tempoh cuti belajar bergaji (penuh/sebahagian).</span>
														<i class="ki-duotone ki-check-circle fs-1 text-success">
															<span class="path1"></span>
															<span class="path2"></span>
														</i>
													</div>
													<!--end::Item-->
													<!--begin::Item-->
													<div class="d-flex flex-stack">
														<span class="fw-semibold fs-6 text-gray-800 text-start pe-3">viii. Bagi pelajar yang ingin memohon perlanjutan tempoh pengajian adalah tidak layak mendapat bantuan dalam proses perlanjutan tersebut. Hal ini kerana tempoh tajaan Bantuan kewangan ini adalah mengikut tempoh surat tawaran asal. Pelajar yang ingin menukar tempat pengajian dalam tempoh pembiayaan BKOKU, hendaklah maklum kepada pihak kementerian secara bertulis dan juga kepada pihak institusi pengajian sebelum dari tempoh lapor diri di tempat pengajian baru</span>
														<i class="ki-duotone ki-check-circle fs-1 text-success">
															<span class="path1"></span>
															<span class="path2"></span>
														</i>
													</div>
													<!--end::Item-->
												</div>
												<!--end::Features-->
												
											</div>
											<!--end::Option-->
										</div>
									</div>
									<!--end::Col-->
								</div>
								<!--end::Row-->
							</div>
							<!--end::Syarat-->
						</div>
						<!--end::Plans-->
					</div>
					<!--end::Container-->
				</div>
				<!--end::Wrapper-->
				<!--begin::Curve bottom-->
				<div class="landing-curve landing-dark-color" style="color: rgb(2, 2, 55);">
					<svg viewBox="15 12 1470 48" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M0 11C3.93573 11.3356 7.85984 11.6689 11.7725 12H1488.16C1492.1 11.6689 1496.04 11.3356 1500 11V12H1488.16C913.668 60.3476 586.282 60.6117 11.7725 12H0V11Z" fill="currentColor"></path>
					</svg>
				</div>
				<!--end::Curve bottom-->
			</div>
			<!--end::Syarat Section-->

			<!--begin::Kategori Section-->
			<div class="py-10 py-lg-20">
				<!--begin::Curve top-->
				<div class="landing-curve landing-dark-color" style="color: rgb(2, 2, 55);">
					<svg viewBox="15 -1 1470 48" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M1 48C4.93573 47.6644 8.85984 47.3311 12.7725 47H1489.16C1493.1 47.3311 1497.04 47.6644 1501 48V47H1489.16C914.668 -1.34764 587.282 -1.61174 12.7725 47H1V48Z" fill="currentColor"></path>
					</svg>
				</div>
				<!--end::Curve top-->
				<!--begin::Wrapper-->
				<div class="py-1 landing-dark-bg" style="background-color: rgb(2, 2, 55);">
					<!--begin::Container-->
					<div class="container">
						<!--begin::Plans-->
						<div class="d-flex flex-column container pt-lg-15">
							<!--begin::Heading-->
							<div class="mb-13 text-center">
								<h1 class="fs-2hx fw-bold" style="color: white;" id="kategori" data-kt-scroll-offset="{default: 100, lg: 150}">KATEGORI YURAN YANG LAYAK DAN TIDAK LAYAK DITUNTUT</h1>
							</div>
							<!--end::Heading-->
							<!--begin::Kategori-->
							<div class="text-center">
								<!--begin::Row-->
								<div class="row g-10">
									<!--begin::Col-->
									<div class="col-xl-12">
										<div class="d-flex h-100 align-items-center">
											<!--begin::Option-->
											<div class="w-100 d-flex flex-column flex-center rounded-3 bg-body py-10 px-10">
												<!--begin::Features-->
												<div class="w-100 mb-10">
													<!-- Table Start -->
													<table>
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
													<!--begin::Nota-->
													<div class="d-flex flex-stack mb-5">
														<span class="fw-semibold fs-6 text-start fw-bold" style="color: red;">Nota : Bagi tuntutan lain yang tidak tersenarai dalam senarai yuran yang LAYAK atau TIDAK LAYAK seperti di atas adalah tidak layak dituntut.</span>
													</div>
													<!--end::Nota-->
												</div>
												<!--end::Features-->
												
											</div>
											<!--end::Option-->
										</div>
									</div>
									<!--end::Col-->
								</div>
								<!--end::Row-->
							</div>
							<!--end::Kategori-->
						</div>
						<!--end::Plans-->
					</div>
					<!--end::Container-->
				</div>
				<!--end::Wrapper-->
				<!--begin::Curve bottom-->
				<div class="landing-curve landing-dark-color" style="color: rgb(2, 2, 55);">
					<svg viewBox="15 12 1470 48" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M0 11C3.93573 11.3356 7.85984 11.6689 11.7725 12H1488.16C1492.1 11.6689 1496.04 11.3356 1500 11V12H1488.16C913.668 60.3476 586.282 60.6117 11.7725 12H0V11Z" fill="currentColor"></path>
					</svg>
				</div>
				<!--end::Curve bottom-->
			</div>
			<!--end::Kategori Section-->

			<!--begin::Tempoh Section-->
			<div class="mb-n20 mb-lg-n20 z-index-2">
				<!--begin::Container-->
				<div class="container">
					<!--begin::Heading-->
					<div class="text-center mb-10">
						<!--begin::Title-->
						<h3 class="fs-2hx text-dark mb-2" id="tempoh" data-kt-scroll-offset="{default: 100, lg: 150}">TEMPOH PEMBIAYAAN</h3>
						<!--end::Title-->
						<!--begin::Text-->
						<div class="fs-5 text-muted fw-bold">Tempoh tajaan ini adalah tertakluk kepada surat tawaran asal institusi pengajian 
						<br />dan tidak melebihi tempoh maksimum penajaan seperti berikut :</div>
						<!--end::Text-->
					</div>
					<!--end::Heading-->
					<!--begin::Row-->
					<div class="card-container">
						<div class="card">
							<img src="assets/media/patterns/pattern-1.jpg" alt="Digital Services">
							<div class="card-text">
								<!--begin::Heading-->
								<!--begin::Badge-->
									<div class="fs-6 fs-lg-6"><span class="badge badge-circle badge-light-success fw-bold fs-3">1</span></div>
								<!--end::Badge-->
								<div class="d-flex flex-center mb-5">
									<!--begin::Title-->
									<div class="fs-5 fs-lg-3 fw-bold text-dark">Sijil Asas / Sijil</div>
									<!--end::Title-->
								</div>
								<!--end::Heading-->
								<!--begin::Description-->
								<div class="fs-6 fs-lg-6">2 Tahun</div>
								<div class="fs-7 fs-lg-7">(Kolej Komuniti dan Politeknik)
								<br/>(Had Pembiayaan RM6,200.00 sehingga RM12,400.00)
								</div>
								<!--end::Description-->
							</div>
						</div>
						<div class="card">
							<img src="assets/media/patterns/pattern-1.jpg" alt="Shared Services">
							<div class="card-text">
								<!--begin::Heading-->
								<!--begin::Badge-->
									<div class="fs-6 fs-lg-6"><span class="badge badge-circle badge-light-success fw-bold fs-3">2</span></div>
								<!--end::Badge-->
								<div class="d-flex flex-center mb-5">
									<!--begin::Title-->
									<div class="fs-5 fs-lg-3 fw-bold text-dark">Diploma</div>
									<!--end::Title-->
								</div>
								<!--end::Heading-->
								<!--begin::Description-->
								<div class="fs-6 fs-lg-6">3 Tahun</div>
								<div class="fs-7 fs-lg-7">(Had Pembiayaan RM6,200.00 sehingga RM18,600.00)</div>
								<!--end::Description-->
							</div>
						</div>
						<div class="card">
							<img src="assets/media/patterns/pattern-1.jpg" alt="Technical Approval">
							<div class="card-text">
								<!--begin::Heading-->
								<!--begin::Badge-->
									<div class="fs-6 fs-lg-6"><span class="badge badge-circle badge-light-success fw-bold fs-3">3</span></div>
								<!--end::Badge-->
								<div class="d-flex flex-center mb-5">
									<!--begin::Title-->
									<div class="fs-5 fs-lg-3 fw-bold text-dark">Sarjana Muda</div>
									<!--end::Title-->
								</div>
								<!--end::Heading-->
								<!--begin::Description-->
								<div class="fs-6 fs-lg-6">4 Tahun</div>
								<div class="fs-7 fs-lg-7">(Had Pembiayaan RM6,200.00 sehingga RM24,800.00)</div>
								<!--end::Description-->
							</div>
						</div>
						<div class="card">
							<img src="assets/media/patterns/pattern-1.jpg" alt="Project Management">
							<div class="card-text">
								<!--begin::Heading-->
								<!--begin::Badge-->
									<div class="fs-6 fs-lg-6"><span class="badge badge-circle badge-light-success fw-bold fs-3">4</span></div>
								<!--end::Badge-->
								<div class="d-flex mb-0">
									<!--begin::Title-->
									<div class="fs-5 fs-lg-3 fw-bold text-dark">Diploma Lepasan Ijazah</div>
									<!--end::Title-->
								</div>
								<!--end::Heading-->
								<!--begin::Description-->
								<div class="fs-6 fs-lg-6">2 Tahun</div>
								<div class="fs-7 fs-lg-7">(Had Pembiayaan RM6,200.00 sehingga RM12,400.00)</div>
								<!--end::Description-->
							</div>
						</div>
						<div class="card">
							<img src="assets/media/patterns/pattern-1.jpg" alt="Project Management">
							<div class="card-text">
								<!--begin::Heading-->
								<!--begin::Badge-->
									<div class="fs-6 fs-lg-6"><span class="badge badge-circle badge-light-success fw-bold fs-3">5</span></div>
								<!--end::Badge-->
								<div class="d-flex flex-center mb-5">
									<!--begin::Title-->
									<div class="fs-5 fs-lg-3 fw-bold text-dark">Sarjana</div>
									<!--end::Title-->
								</div>
								<!--end::Heading-->
								<!--begin::Description-->
								<div class="fs-6 fs-lg-6">2 Tahun</div>
								<div class="fs-7 fs-lg-7">(Had Pembiayaan RM6,200.00 sehingga RM12,400.00)</div>
								<!--end::Description-->
							</div>
						</div>
						<div class="card">
							<img src="assets/media/patterns/pattern-1.jpg" alt="Project Management">
							<div class="card-text">
								<!--begin::Heading-->
								<!--begin::Badge-->
									<div class="fs-6 fs-lg-6"><span class="badge badge-circle badge-light-success fw-bold fs-3">6</span></div>
								<!--end::Badge-->
								<div class="d-flex flex-center mb-5">
									<!--begin::Title-->
									<div class="fs-5 fs-lg-3 fw-bold text-dark">Ph.D</div>
									<!--end::Title-->
								</div>
								<!--end::Heading-->
								<!--begin::Description-->
								<div class="fs-6 fs-lg-6">4 Tahun</div>
								<div class="fs-7 fs-lg-7">(Had Pembiayaan RM6,200.00 sehingga RM24,800.00)</div>
								<!--end::Description-->
							</div>
						</div>
					</div>
					<!--end::Row-->
					
				</div>
				<!--end::Container-->
			</div>
			<!--end::Tempoh Section-->
			
			<!--begin::Bayaran Section-->
			<div class="py-10 py-lg-20">
				<!--begin::Curve top-->
				<div class="landing-curve landing-dark-color" style="color: rgb(2, 2, 55);">
					<svg viewBox="15 -1 1470 48" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M1 48C4.93573 47.6644 8.85984 47.3311 12.7725 47H1489.16C1493.1 47.3311 1497.04 47.6644 1501 48V47H1489.16C914.668 -1.34764 587.282 -1.61174 12.7725 47H1V48Z" fill="currentColor"></path>
					</svg>
				</div>
				<!--end::Curve top-->
				<!--begin::Wrapper-->
				<div class="py-10 landing-dark-bg" style="background-color: rgb(2, 2, 55);">
					<!--begin::Container-->
					<div class="container">
						<!--begin::Plans-->
						<div class="d-flex flex-column container pt-lg-15">
							<!--begin::Heading-->
							<div class="mb-15 text-center">
								<h1 class="fs-2hx fw-bold text-white mb-5" id="bayaran" data-kt-scroll-offset="{default: 100, lg: 150}">MAKLUMAT PEMBIAYAAN</h1>
							</div>
							<!--end::Heading-->
							<!--begin::Bayaran-->
							<div class="text-center">
								<!--begin::Row-->
								<div class="row g-10">
									<!--begin::Col-->
									<div class="col-xl-4">
										<div class="d-flex h-100 flex-column align-items-center">
											<div class="w-100 d-flex flex-column flex-center rounded-3 py-6 px-6 mb-8" >
												<!-- begin::Heading -->
												<!-- end::Heading -->
											</div>
											<!-- begin::Option for Sepenuh Masa -->
											<div class="w-100 d-flex flex-column flex-center rounded-3 bg-body py-6 px-6 mb-8">
												<!-- begin::Heading -->
												<div class="mb-4">
													<!-- begin::Title -->
													<div class="fw-bold" style="font-size:24px;">Sepenuh Masa</div>
													<!-- end::Title -->
												</div>
												<!-- end::Heading -->
											</div>
											<!-- end::Option for Sepenuh Masa -->

											<!-- begin::Option for Separuh Masa -->
											<div class="w-100 d-flex flex-column flex-center rounded-3 py-6 px-6" style="background-color: #96b6cd;">
												<!-- begin::Heading -->
												<div class="mb-4">
													<!-- begin::Title -->
													<div class="fw-bold" style="font-size:24px;">Separuh Masa</div>
													<!-- end::Title -->
												</div>
												<!-- end::Heading -->
											</div>
											<!-- end::Option for Separuh Masa -->
										</div>
									</div>
									<!--end::Col-->
									<!--begin::Col-->
									<div class="col-xl-4">
										<div class="d-flex h-100 flex-column align-items-center">
											<div class="w-100 d-flex flex-column flex-center rounded-3 py-6 px-6 mb-8">
												<!-- begin::Heading -->
												<!-- end::Heading -->
											</div>
											<!-- begin::Option for Sepenuh Masa -->
											<div class="w-100 d-flex flex-column flex-center rounded-3 bg-body py-2 px-6 mb-2">
												<!-- begin::Heading -->
												<div class="mb-2">
													<!-- begin::Title -->
													<div class="fw-bold" style="font-size:14px;">Pinjaman Pelajaran / Pembiayaan Sendiri </div>
													<!-- end::Title -->
												</div>
												<!-- end::Heading -->
											</div>
											<div class="w-100 d-flex flex-column flex-center rounded-3 bg-body py-2 px-6 mb-8">
												<!-- begin::Heading -->
												<div class="mb-2">
													<!-- begin::Title -->
													<div class="fw-bold" style="font-size:14px;">Biasiswa</div>
													<!-- end::Title -->
												</div>
												<!-- end::Heading -->
											</div>
											<!-- end::Option for Sepenuh Masa -->

											<!-- begin::Option for Separuh Masa -->
											<div class="w-100 d-flex flex-column flex-center rounded-3 py-2 px-6 mb-2" style="background-color: #96b6cd;">
												<!-- begin::Heading -->
												<div class="mb-2">
													<!-- begin::Title -->
													<div class="fw-bold" style="font-size:14px;">Pinjaman Pelajaran / Pembiayaan Sendiri </div>
													<!-- end::Title -->
												</div>
												<!-- end::Heading -->
											</div>
											<div class="w-100 d-flex flex-column flex-center rounded-3 py-2 px-6 mb-8" style="background-color: #96b6cd;">
												<!-- begin::Heading -->
												<div class="mb-2">
													<!-- begin::Title -->
													<div class="fw-bold" style="font-size:14px;">Biasiswa</div>
													<!-- end::Title -->
												</div>
												<!-- end::Heading -->
											</div>
											<!-- end::Option for Separuh Masa -->
										</div>
									</div>
									<!--end::Col-->
									<!--begin::Col-->
									<div class="col-xl-2">
										<div class="d-flex h-100 flex-column align-items-center">
											<div class="w-100 d-flex flex-column flex-center rounded-3 py-4 px-6 mb-5" style="background-color: grey;">
												<!-- begin::Heading -->
												<div class="mb-2">
													<!-- begin::Title -->
													<div class="text-dark fw-bold" style="font-size:14px;">Yuran </div>
													<!-- end::Title -->
												</div>
												<!-- end::Heading -->
											</div>
											<!-- begin::Option for Sepenuh Masa -->
												<!-- begin::Heading -->
												<div class="mb-2">
													<!-- begin::Title -->
													<i class="ki-duotone ki-check-circle text-success"  style="font-size: 3em;">
														<span class="path1"></span>
														<span class="path2"></span>
													</i>
													<!-- end::Title -->
												</div>
												<!-- end::Heading -->
												<div class="mb-2">
													<!-- begin::Title -->
													<i class="ki-duotone ki-cross-circle text-danger  mb-6" style="font-size: 3em; ">
														<span class="path1"></span>
														<span class="path2"></span>
													</i>
													<!-- end::Title -->
												</div>
												<!-- end::Heading -->
											<!-- end::Option for Sepenuh Masa -->

											<!-- begin::Option for Separuh Masa -->
												<!-- begin::Heading -->
												<div class="mb-2">
													<!-- begin::Title -->
													<i class="ki-duotone ki-check-circle text-success"  style="font-size: 3em;">
														<span class="path1"></span>
														<span class="path2"></span>
													</i>
													<!-- end::Title -->
												</div>
												<!-- end::Heading -->
												<div class="mb-2">
													<!-- begin::Title -->
													<i class="ki-duotone ki-cross-circle text-danger" style="font-size: 3em;">
														<span class="path1"></span>
														<span class="path2"></span>
													</i>
													<!-- end::Title -->
												</div>
												<!-- end::Heading -->
											<!-- end::Option for Separuh Masa -->
										</div>
									</div>
									<!--end::Col-->
									<!--begin::Col-->
									<div class="col-xl-2">
										<div class="d-flex h-100 flex-column align-items-center">
											<div class="w-100 d-flex flex-column flex-center rounded-3 py-4 px-6 mb-5" style="background-color: grey;">
												<div class="mb-2">
													<!-- begin::Title -->
													<div class="text-dark fw-bold" style="font-size:14px;">Wang Saku</div>
													<!-- end::Title -->
												</div>
											</div>
											<!-- begin::Option for Sepenuh Masa -->
												<!-- begin::Heading -->
												<div class="mb-2">
													<!-- begin::Title -->
													<i class="ki-duotone ki-check-circle text-success"  style="font-size: 3em;">
														<span class="path1"></span>
														<span class="path2"></span>
													</i>
													<!-- end::Title -->
												</div>
												<!-- end::Heading -->
												<div class="mb-2">
													<!-- begin::Title -->
													<i class="ki-duotone ki-check-circle text-success  mb-6" style="font-size: 3em; ">
														<span class="path1"></span>
														<span class="path2"></span>
													</i>
													<!-- end::Title -->
												</div>
												<!-- end::Heading -->
											<!-- end::Option for Sepenuh Masa -->

											<!-- begin::Option for Separuh Masa -->
												<!-- begin::Heading -->
												<div class="mb-2">
													<!-- begin::Title -->
													<i class="ki-duotone ki-cross-circle text-danger"  style="font-size: 3em;">
														<span class="path1"></span>
														<span class="path2"></span>
													</i>
													<!-- end::Title -->
												</div>
												<!-- end::Heading -->
												<div class="mb-2">
													<!-- begin::Title -->
													<i class="ki-duotone ki-cross-circle text-danger" style="font-size: 3em;">
														<span class="path1"></span>
														<span class="path2"></span>
													</i>
													<!-- end::Title -->
												</div>
												<!-- end::Heading -->
											<!-- end::Option for Separuh Masa -->
										</div>
									</div>
									<!--end::Col-->
								</div>
								<!--end::Row-->
							</div>
							<!--end::Bayaran-->
						</div>
						<!--end::Plans-->
					</div>
					<!--end::Container-->
				</div>
				<!--end::Wrapper-->
				<!--begin::Curve bottom-->
				<div class="landing-curve landing-dark-color" style="color: rgb(2, 2, 55);">
					<svg viewBox="15 12 1470 48" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M0 11C3.93573 11.3356 7.85984 11.6689 11.7725 12H1488.16C1492.1 11.6689 1496.04 11.3356 1500 11V12H1488.16C913.668 60.3476 586.282 60.6117 11.7725 12H0V11Z" fill="currentColor"></path>
					</svg>
				</div>
				<!--end::Curve bottom-->
			</div>
			<!--end::Bayaran Section-->

			<!--begin::PPK Section-->
			<div class="py-10 py-lg-20">
				<!--begin::Curve top-->
				<div class="landing-curve landing-dark-color" style="color: rgb(2, 2, 55);">
					<svg viewBox="15 -1 1470 48" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M1 48C4.93573 47.6644 8.85984 47.3311 12.7725 47H1489.16C1493.1 47.3311 1497.04 47.6644 1501 48V47H1489.16C914.668 -1.34764 587.282 -1.61174 12.7725 47H1V48Z" fill="currentColor"></path>
					</svg>
				</div>
				<!--end::Curve top-->
				<!--begin::Wrapper-->
				<div class="py-10 landing-dark-bg" style="background-color: rgb(2, 2, 55);">
					<!--begin::Container-->
					<div class="container">
						<!--begin::Plans-->
						<div class="d-flex flex-column container pt-lg-15">
							<!--begin::Heading-->
							<div class="mb-13 text-center">
								<h1 class="fs-2hx fw-bold" style="color: white;" id="syarat" data-kt-scroll-offset="{default: 100, lg: 150}">PROGRAM PENDIDIKAN KHAS (PPK)</h1>
							</div>
							<!--end::Heading-->
							<!--begin::PPK-->
							<div class="text-center">
								<!--begin::Row-->
								<div class="row g-10">
									<!--begin::Col-->
									<div class="col-xl-12">
										<div class="d-flex h-100 align-items-center">
											<!--begin::Option-->
											<div class="w-100 d-flex flex-column flex-center rounded-3 bg-body py-10 px-10">
												<!--begin::Features-->
												<div class="w-100 mb-10">
													<!--begin::Item-->
													<div class="d-flex flex-stack mb-5">
														<span class="fw-semibold fs-6 text-gray-800 text-start pe-3">i. Skop pembiayaan PPK adalah tertumpu kepada <b>Kolej Komuniti</b> dan <b>Politeknik</b> terpilih sahaja dari Sijil Kemahiran Khas.</span>
													</div>
													<!--end::Item-->
													<!--begin::Item-->
													<div class="d-flex flex-stack mb-5">
														<span class="fw-semibold fs-6 text-gray-800 text-start pe-3">ii. Pelajar OKU yang mempunyai kod DD atau DE <b>(Pendengaran sahaja)</b> di Kolej Komuniti dan Politeknik terpilih.</span>
													</div>
													<!--end::Item-->
													<!--begin::Item-->
													<div class="d-flex flex-stack mb-5">
														<span class="fw-semibold fs-6 text-gray-800 text-start pe-3">iii. Kadar Bayaran PPK adalah sebanyak :</span>
													</div>
													<div class="d-flex flex-stack">
														<span class="fw-semibold fs-6 text-gray-800 text-start">
															<ul>
																<li>RM 4260 / Semester 1 sahaja.</li>
																<li>RM 3960 / Semester 2 hingga 4.</li>
															</ul>
														</span>
													</div>
													<!--end::Item-->
													<!--begin::Senarai Kursus-->
													<div class="d-flex flex-stack mb-5">
														<span class="fw-semibold fs-6 text-gray-800 text-start pe-3">iv. Senarai institusi dan nama program yang terlibat :</span>
													</div>
													<div class="text-center">
														<!--begin::Row-->
														<div class="row g-10">
															<!--begin::Col-->
															<div class="col-xl-12">
																<div class="d-flex h-100 align-items-center">
																	<!--begin::Option-->
																	<div class="w-100 d-flex flex-column flex-center rounded-3 bg-body py-10 px-10">
																		<!--begin::Features-->
																		<div class="w-100 mb-10">
																			<!-- Table Start -->
																			<table>
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
																		</div>
																		<!--end::Features-->
																		
																	</div>
																	<!--end::Option-->
																</div>
															</div>
															<!--end::Col-->
														</div>
														<!--end::Row-->
													</div>
													<!--end::Senarai Kursus-->
												</div>
												<!--end::Features-->
												
											</div>
											<!--end::Option-->
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
				<!--begin::Curve bottom-->
				<div class="landing-curve landing-dark-color" style="color: rgb(2, 2, 55);">
					<svg viewBox="15 12 1470 48" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M0 11C3.93573 11.3356 7.85984 11.6689 11.7725 12H1488.16C1492.1 11.6689 1496.04 11.3356 1500 11V12H1488.16C913.668 60.3476 586.282 60.6117 11.7725 12H0V11Z" fill="currentColor"></path>
					</svg>
				</div>
				<!--end::Curve bottom-->
			</div>
			<!--end::PPK Section-->

			<!--begin::Hubungi Section-->
			<div class="mb-n20 mb-lg-n20 z-index-2">
				<!--begin::Container-->
				<div class="container">
					<!--begin::Heading-->
					<div class="text-center mb-15">
						<!--begin::Title-->
						<h3 class="fs-2hx text-dark mb-5" id="hubungi" data-kt-scroll-offset="{default: 125, lg: 150}">PERMOHONAN / PERTANYAAN</h3>
						<!--end::Title-->
						<!--begin::Description-->
						<div class="fs-5 text-muted fw-bold">Untuk sebarang pertanyaan, sila hubungi:</div>
						<!--end::Description-->
					</div>
					<!--end::Heading-->
					<!--begin::Row-->
					<div class="row g-lg-12 mb-20 mb-lg-20 justify-content-between">
						<!--begin::Col-->
						<div class="col-lg-4">
							<!--begin::Alamat-->
							<div class="d-flex flex-column justify-content-between h-lg-100 px-10 px-lg-0 pe-lg-10 mb-15 mb-lg-0">
								<!--begin::Wrapper-->
								<div class="mb-7">
									<!--begin::Title-->
									<div class="fs-4 fw-bold text-dark mb-3">Alamat :</div>
									<!--end::Title-->
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
								<!--end::Wrapper-->
							</div>
							<!--end::Alamat-->
						</div>
						<!--end::Col-->
						<!--begin::Col-->
						<div class="col-lg-5">
							<!--begin::Hubungi-->
							<div class="d-flex flex-column justify-content-between h-lg-200 px-10 px-lg-0 pe-lg-10 mb-15 mb-lg-0">
								<!--begin::Wrapper-->
								<div class="mb-7">
									<!--begin::Title-->
									<div class="fs-4 fw-bold text-dark mb-3">Pegawai Untuk Dihubungi :</div>
									<!--end::Title-->
									<!--begin::Telefon-->
									<div class="fw-semibold fs-7">Cik Nur Dayana binti Rozaini : 03-8870 6373</div>
									<div class="fw-semibold fs-7">Cik Nurul Atiqah Noor Azmir binti Abdul Muhaymin : 03-8870 6347</div>
									
									<!--end::Telefon-->
									<br />
									<!--begin::Title-->
									<div class="fs-4 fw-bold text-dark mb-3">E-mel Unit BKOKU :</div>
									<!--end::Title-->
									<!--begin::Emel-->
									<div class="fw-semibold fs-6">bkoku@mohe.gov.my</div>
									<div class="fw-semibold fs-6">iptabkoku@mohe.gov.my</div>
									<!--end::Emel-->
								</div>
								<!--end::Wrapper-->
								
							</div>
							<!--end::Hubungi-->
						</div>
						<!--end::Col-->
						<!--begin::Col-->
						<div class="col-lg-3">
							<!--begin::Waktu-->
							<div class="d-flex flex-column justify-content-between h-lg-100 px-10 px-lg-0 pe-lg-10 mb-10 mb-lg-0">
								<!--begin::Wrapper-->
								<div class="mb-7">
									<!--begin::Title-->
									<div class="fs-4 fw-bold text-dark mb-3">Waktu Pejabat</div>
									<!--end::Title-->
									<!--begin::Waktu-->
									<div class="fw-semibold fs-6">Isnin hingga Jumaat 
									<br /> 9.00 pagi - 4.30 petang</div>
									<!--end::Waktu-->
									<br />
									<!--begin::Title-->
									<div class="fs-4 fw-bold text-dark mb-3">Waktu Rehat</div>
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
								<!--end::Wrapper-->
								
							</div>
							<!--end::Waktu-->
						</div>
						<!--end::Col-->
					</div>
					<!--end::Row-->
				</div>
				<!--end::Container-->
			</div>
			<!--end::Hubungi Section-->

			<!--begin::Footer Section-->
			<div class="mb-0">
				<!--begin::Curve top-->
				<div class="landing-curve landing-dark-color" style="color: rgb(2, 2, 55);">
					<svg viewBox="15 -1 1470 48" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M1 48C4.93573 47.6644 8.85984 47.3311 12.7725 47H1489.16C1493.1 47.3311 1497.04 47.6644 1501 48V47H1489.16C914.668 -1.34764 587.282 -1.61174 12.7725 47H1V48Z" fill="currentColor"></path>
					</svg>
				</div>
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
									Sistem BKOKU, Kementerian Pendidikan Tinggi <span id="currentYear"></span> © Hak Cipta Terpelihara
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
			<!--begin::Scrolltop-->
			<div id="kt_scrolltop" class="scrolltop" data-kt-scrolltop="true">
				<i class="ki-duotone ki-arrow-up">
					<span class="path1"></span>
					<span class="path2"></span>
				</i>
			</div>
			<!--end::Scrolltop-->
		</div>
		<!--end::Root-->
		<!--begin::Scrolltop-->
		<div id="kt_scrolltop" class="scrolltop" data-kt-scrolltop="true">
			<i class="ki-duotone ki-arrow-up">
				<span class="path1"></span>
				<span class="path2"></span>
			</i>
		</div>
		<!--end::Scrolltop-->
		<!--begin::Javascript-->
		<script>var hostUrl = "assets/";</script>
		<!--begin::Global Javascript Bundle(mandatory for all pages)-->
		<script src="assets/plugins/global/plugins.bundle.js"></script>
		<script src="assets/js/scripts.bundle.js"></script>
		<!--end::Global Javascript Bundle-->
		<!--begin::Vendors Javascript(used for this page only)-->
		<!--end::Vendors Javascript-->
		<!--begin::Custom Javascript(used for this page only)-->
		<!--end::Custom Javascript-->
		
		<!--end::Javascript-->
	</body>
</html>
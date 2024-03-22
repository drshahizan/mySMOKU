<!DOCTYPE html>
<html lang="en">
	<!--begin::Head-->
	<head><base href=""/>
		<title>Selamat Datang - Sistem BKOKU</title>
		<meta charset="utf-8" />
		<meta name="description" content="The most advanced Bootstrap 5 Admin Theme with 40 unique prebuilt layouts on Themeforest trusted by 100,000 beginners and professionals. Multi-demo, Dark Mode, RTL support and complete React, Angular, Vue, Asp.Net Core, Rails, Spring, Blazor, Django, Express.js, Node.js, Flask, Symfony & Laravel versions. Grab your copy now and get life-time updates for free." />
		<meta name="keywords" content="metronic, bootstrap, bootstrap 5, angular, VueJs, React, Asp.Net Core, Rails, Spring, Blazor, Django, Express.js, Node.js, Flask, Symfony & Laravel starter kits, admin themes, web design, figma, web development, free templates, free admin themes, bootstrap theme, bootstrap template, bootstrap dashboard, bootstrap dak mode, bootstrap button, bootstrap datepicker, bootstrap timepicker, fullcalendar, datatables, flaticon" />
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
										<img alt="Logo" src="assets/media/logos/bkoku.svg" class="logo-default h-25px h-lg-50px" />
										<img alt="Logo" src="assets/media/logos/bkoku.svg" class="logo-sticky h-20px h-lg-50px" />
									</a>
									<!--end::Logo image-->
								</div>
								<!--end::Logo-->
								<!--begin::Menu wrapper-->
								<div class="d-lg-block" id="kt_header_nav_wrapper" >
									<div class="d-lg-block p-5 p-lg-0" data-kt-drawer="true" data-kt-drawer-name="landing-menu" data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true" data-kt-drawer-width="200px" data-kt-drawer-direction="start" data-kt-drawer-toggle="#kt_landing_menu_toggle" data-kt-swapper="true" data-kt-swapper-mode="prepend" data-kt-swapper-parent="{default: '#laman_utama', lg: '#kt_header_nav_wrapper'}" >
										<!--begin::Menu-->
										<div class="menu menu-column flex-nowrap menu-rounded menu-lg-row menu-title-gray-600 menu-state-title-primary nav nav-flush fs-5 fw-semibold" id="kt_landing_menu">
											<!--begin::Menu item-->
											<div class="menu-item">
												<!--begin::Menu link-->
												<a class="menu-link nav-link py-3 px-4 px-xxl-6" href="#laman_utama" data-kt-scroll-toggle="true" data-kt-drawer-dismiss="true">Laman Utama</a>
												<!--end::Menu link-->
											</div>
											<!--end::Menu item-->
											<!--begin::Menu item-->
											<div class="menu-item">
												<!--begin::Menu link-->
												<a class="menu-link nav-link py-3 px-4 px-xxl-6" href="#info" data-kt-scroll-toggle="true" data-kt-drawer-dismiss="true">Info</a>
												<!--end::Menu link-->
											</div>
											<!--end::Menu item-->
											<!--begin::Menu item-->
											<div class="menu-item">
												<!--begin::Menu link-->
												<a class="menu-link nav-link py-3 px-4 px-xxl-6" href="#syarat" data-kt-scroll-toggle="true" data-kt-drawer-dismiss="true">Syarat-syarat</a>
												<!--end::Menu link-->
											</div>
											<!--end::Menu item-->
											<!--begin::Menu item-->
											<div class="menu-item">
												<!--begin::Menu link-->
												<a class="menu-link nav-link py-3 px-4 px-xxl-6" href="#bayaran" data-kt-scroll-toggle="true" data-kt-drawer-dismiss="true">Maklumat Pembiayaan</a>
												<!--end::Menu link-->
											</div>
											<!--end::Menu item-->
											<!--begin::Menu item-->
											<div class="menu-item">
												<!--begin::Menu link-->
												<a class="menu-link nav-link py-3 px-4 px-xxl-6" href="#hubungi" data-kt-scroll-toggle="true" data-kt-drawer-dismiss="true">Hubungi Kami</a>
												<!--end::Menu link-->
											</div>
											<!--end::Menu item-->
											<!--begin::Toolbar-->
											<div class="flex-equal text-end ms-1">
												<a href="http://bkoku.mohe.gov.my/login" class="btn btn-primary">Permohonan</a>
											</div>
											<!--end::Toolbar-->
											
										</div>
										<!--end::Menu-->
									</div>
								</div>
								<!--end::Menu wrapper-->
								<!--begin::Toolbar-->
								<div class="flex-equal text-end ms-1">
									
								</div>
								<!--end::Toolbar-->
							</div>
							<!--end::Wrapper-->
						</div>
						<!--end::Container-->
					</div>
				<!--end::Header-->
				<!--begin::Wrapper-->
				<div class="bgi-no-repeat bgi-size-contain bgi-position-x-center" style="background-image: url(assets/media/KPT1.jpg);">
					<!--begin::Landing hero-->
					<div class="d-flex flex-column flex-center w-100 min-h-400px min-h-lg-500px">
						
					</div>
					<!--end::Landing hero-->
				</div>
				<!--end::Wrapper-->
				<!--begin::Curve bottom-->
				<div class="landing-curve landing-dark-color mb-10 mb-lg-20">
					
				</div>
				<!--end::Curve bottom-->
			</div>
			<!--end::Header Section-->
			<!--begin::Info Section-->
			<div class="mb-n20 mb-lg-n20 z-index-2">
				<!--begin::Container-->
				<div class="container">
					<!--begin::Heading-->
					<div class="text-center mb-10">
						<!--begin::Title-->
						<h3 class="fs-2hx text-dark mb-2" id="info" data-kt-scroll-offset="{default: 100, lg: 150}">TEMPOH PEMBIAYAAN</h3>
						<!--end::Title-->
						<!--begin::Text-->
						<div class="fs-5 text-muted fw-bold">Tempoh tajaan ini adalah tertakluk kepada surat tawaran asal institusi pengajian 
						<br />dan tidak melebihi tempoh maksimum penajaan seperti berikut :</div>
						<!--end::Text-->
					</div>
					<!--end::Heading-->
					<!--begin::Row-->
					<div class="row w-100 gy-10 mb-md-20">
						<!--begin::Col-->
						<div class="col-md-2 px-1">
							<!--begin::Story-->
							<div class="text-center mb-12 mb-md-0">
								<!--begin::Illustration-->
								<img src="assets/media/illustrations/sketchy-1/2.png" class="mh-125px mb-9" alt="" />
								<!--end::Illustration-->
								<!--begin::Heading-->
								<div class="d-flex flex-center mb-5">
									<!--begin::Badge-->
									<span class="badge badge-circle badge-light-success fw-bold p-5 me-3 fs-3">1</span>
									<!--end::Badge-->
									<!--begin::Title-->
									<div class="fs-5 fs-lg-3 fw-bold text-dark">Sijil Asas / Sijil</div>
									<!--end::Title-->
								</div>
								<!--end::Heading-->
								<!--begin::Description-->
								<div class="fw-semibold fs-6 fs-lg-6 text-muted">2 Tahun (Kolej Komuniti dan Politeknik Sahaja)
								<br/>(Had Pembiayaan RM5,000.00 sehingga RM10,000.00)
								</div>
								<!--end::Description-->
							</div>
							<!--end::Story-->
						</div>
						<!--end::Col-->
						<!--begin::Col-->
						<div class="col-md-2 px-1">
							<!--begin::Story-->
							<div class="text-center mb-10 mb-md-0">
								<!--begin::Illustration-->
								<img src="assets/media/illustrations/sketchy-1/8.png" class="mh-125px mb-9" alt="" />
								<!--end::Illustration-->
								<!--begin::Heading-->
								<div class="d-flex flex-center mb-5">
									<!--begin::Badge-->
									<span class="badge badge-circle badge-light-success fw-bold p-5 me-3 fs-3">2</span>
									<!--end::Badge-->
									<!--begin::Title-->
									<div class="fs-5 fs-lg-3 fw-bold text-dark">Diploma</div>
									<!--end::Title-->
								</div>
								<!--end::Heading-->
								<!--begin::Description-->
								<div class="fw-semibold fs-6 fs-lg-6 text-muted">3 Tahun 
								<br />(Had Pembiayaan RM5,000.00 sehingga RM15,000.00)</div>
								<!--end::Description-->
							</div>
							<!--end::Story-->
						</div>
						<!--end::Col-->
						<!--begin::Col-->
						<div class="col-md-2 px-1">
							<!--begin::Story-->
							<div class="text-center mb-10 mb-md-0">
								<!--begin::Illustration-->
								<img src="assets/media/illustrations/sketchy-1/12.png" class="mh-125px mb-9" alt="" />
								<!--end::Illustration-->
								<!--begin::Heading-->
								<div class="d-flex flex-center mb-5">
									<!--begin::Badge-->
									<span class="badge badge-circle badge-light-success fw-bold p-5 me-3 fs-3">3</span>
									<!--end::Badge-->
									<!--begin::Title-->
									<div class="fs-5 fs-lg-3 fw-bold text-dark">Sarjana Muda</div>
									<!--end::Title-->
								</div>
								<!--end::Heading-->
								<!--begin::Description-->
								<div class="fw-semibold fs-6 fs-lg-6 text-muted">4 Tahun
								<br />(Had Pembiayaan RM5,000.00 sehingga RM20,000.00)</div>
								<!--end::Description-->
							</div>
							<!--end::Story-->
						</div>
						<!--end::Col-->
						<!--begin::Col-->
						<div class="col-md-2 px-1">
							<!--begin::Story-->
							<div class="text-center mb-10 mb-md-0">
								<!--begin::Illustration-->
								<img src="assets/media/illustrations/sketchy-1/17.png" class="mh-125px mb-9" alt="" />
								<!--end::Illustration-->
								<!--begin::Heading-->
								<div class="d-flex flex-center mb-5">
									<!--begin::Badge-->
									<span class="badge badge-circle badge-light-success fw-bold p-5 me-3 fs-3">4</span>
									<!--end::Badge-->
									<!--begin::Title-->
									<div class="fs-5 fs-lg-3 fw-bold text-dark">Diploma Lepasan Ijazah</div>
									<!--end::Title-->
								</div>
								<!--end::Heading-->
								<!--begin::Description-->
								<div class="fw-semibold fs-6 fs-lg-6 text-muted">2 Tahun
								<br />(Had Pembiayaan RM5,000.00 sehingga RM10,000.00)</div>
								<!--end::Description-->
							</div>
							<!--end::Story-->
						</div>
						<!--end::Col-->
						<!--begin::Col-->
						<div class="col-md-2 px-1">
							<!--begin::Story-->
							<div class="text-center mb-10 mb-md-0">
								<!--begin::Illustration-->
								<img src="assets/media/illustrations/sketchy-1/10.png" class="mh-125px mb-9" alt="" />
								<!--end::Illustration-->
								<!--begin::Heading-->
								<div class="d-flex flex-center mb-5">
									<!--begin::Badge-->
									<span class="badge badge-circle badge-light-success fw-bold p-5 me-3 fs-3">5</span>
									<!--end::Badge-->
									<!--begin::Title-->
									<div class="fs-5 fs-lg-3 fw-bold text-dark">Sarjana</div>
									<!--end::Title-->
								</div>
								<!--end::Heading-->
								<!--begin::Description-->
								<div class="fw-semibold fs-6 fs-lg-6 text-muted">2 Tahun
								<br />(Had Pembiayaan RM5,000.00 sehingga RM10,000.00)</div>
								<!--end::Description-->
							</div>
							<!--end::Story-->
						</div>
						<!--end::Col-->
						<!--begin::Col-->
						<div class="col-md-2 px-1">
							<!--begin::Story-->
							<div class="text-center mb-10 mb-md-0">
								<!--begin::Illustration-->
								<img src="assets/media/illustrations/sketchy-1/4.png" class="mh-125px mb-9" alt="" />
								<!--end::Illustration-->
								<!--begin::Heading-->
								<div class="d-flex flex-center mb-5">
									<!--begin::Badge-->
									<span class="badge badge-circle badge-light-success fw-bold p-5 me-3 fs-3">6</span>
									<!--end::Badge-->
									<!--begin::Title-->
									<div class="fs-5 fs-lg-3 fw-bold text-dark">Ph.D</div>
									<!--end::Title-->
								</div>
								<!--end::Heading-->
								<!--begin::Description-->
								<div class="fw-semibold fs-6 fs-lg-6 text-muted">4 Tahun
								<br />(Had Pembiayaan RM5,000.00 sehingga RM20,000.00)</div>
								<!--end::Description-->
							</div>
							<!--end::Story-->
						</div>
						<!--end::Col-->
					</div>
					<!--end::Row-->
					
				</div>
				<!--end::Container-->
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
								<h1 class="fs-2hx fw-bold text-white mb-5" id="bayaran" data-kt-scroll-offset="{default: 100, lg: 150}">Maklumat Pembiayaan</h1>
							</div>
							<!--end::Heading-->
							<!--begin::Pricing-->
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
													<div class="text-dark fw-bold" style="font-size:24px;">Sepenuh Masa</div>
													<!-- end::Title -->
												</div>
												<!-- end::Heading -->
											</div>
											<!-- end::Option for Sepenuh Masa -->

											<!-- begin::Option for Separuh Masa -->
											<div class="w-100 d-flex flex-column flex-center rounded-3 bg-primary py-6 px-6">
												<!-- begin::Heading -->
												<div class="mb-4">
													<!-- begin::Title -->
													<div class="text-white fw-bold" style="font-size:24px;">Separuh Masa</div>
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
													<div class="text-dark fw-bold" style="font-size:14px;">Pinjaman Pelajaran / Pembiayaan Sendiri </div>
													<!-- end::Title -->
												</div>
												<!-- end::Heading -->
											</div>
											<div class="w-100 d-flex flex-column flex-center rounded-3 bg-body py-2 px-6 mb-8">
												<!-- begin::Heading -->
												<div class="mb-2">
													<!-- begin::Title -->
													<div class="text-dark fw-bold" style="font-size:14px;">Biasiswa</div>
													<!-- end::Title -->
												</div>
												<!-- end::Heading -->
											</div>
											<!-- end::Option for Sepenuh Masa -->

											<!-- begin::Option for Separuh Masa -->
											<div class="w-100 d-flex flex-column flex-center rounded-3 bg-primary py-2 px-6 mb-2">
												<!-- begin::Heading -->
												<div class="mb-2">
													<!-- begin::Title -->
													<div class="text-white fw-bold" style="font-size:14px;">Pinjaman Pelajaran / Pembiayaan Sendiri </div>
													<!-- end::Title -->
												</div>
												<!-- end::Heading -->
											</div>
											<div class="w-100 d-flex flex-column flex-center rounded-3 bg-primary py-2 px-6 mb-8">
												<!-- begin::Heading -->
												<div class="mb-2">
													<!-- begin::Title -->
													<div class="text-white fw-bold" style="font-size:14px;">Biasiswa</div>
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
							<!--end::Pricing-->
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
									<div class="fs-6 fw-bold text-dark mb-3">Alamat :</div>
									<!--end::Title-->
									<!--begin::Alamat-->
									<div class="text-gray-500 fw-semibold fs-6">Kementerian Pendidikan Tinggi,
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
									<div class="fs-6 fw-bold text-dark mb-3">No. Untuk Dihubungi :</div>
									<!--end::Title-->
									<!--begin::Telefon-->
									<div class="text-gray-500 fw-semibold fs-7">Cik Nur Dayana binti Rozaini : 03-8870 6373
									<br />Cik Nurul Atiqah Noor Azmir binti Abdul Muhaymin : 03-8870 6347</div>
									
									<!--end::Telefon-->
									<br />
									<!--begin::Title-->
									<div class="fs-6 fw-bold text-dark mb-3">Emel Unit BKOKU :</div>
									<!--end::Title-->
									<!--begin::Emel-->
									<div class="text-gray-500 fw-semibold fs-6">bkoku@mohe.gov.my</div>
									<div class="text-gray-500 fw-semibold fs-6">iptabkoku@mohe.gov.my</div>
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
									<div class="fs-6 fw-bold text-dark mb-3">Waktu pejabat SAHAJA</div>
									<!--end::Title-->
									<!--begin::Waktu-->
									<div class="text-gray-500 fw-semibold fs-6">Isnin hingga Jumaat 
									<br /> 9.00 pagi - 4.30 petang</div>
									<!--end::Waktu-->
									<br />
									<!--begin::Title-->
									<div class="fs-6 fw-bold text-dark mb-3">Waktu Rehat</div>
									<!--end::Title-->
									<!--begin::Waktu-->
									<div class="text-gray-500 fw-semibold fs-6">Isnin hingga Khamis 
									<br /> (1.00 tengah hari - 2.00 petang)</div>
									<!--end::Waktu-->
									<!--begin::Waktu-->
									<div class="text-gray-500 fw-semibold fs-6">Jumaat 
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
		<script src="assets/plugins/custom/fslightbox/fslightbox.bundle.js"></script>
		<!--end::Vendors Javascript-->
		<!--begin::Custom Javascript(used for this page only)-->
		<script src="assets/js/custom/landing.js"></script>
		<!--end::Custom Javascript-->
		<!--end::Javascript-->
	</body>
</html>
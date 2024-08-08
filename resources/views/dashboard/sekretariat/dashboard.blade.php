<x-default-layout>
	<head>
		<meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">

        <!-- MAIN CSS -->
        <link rel="stylesheet" href="/assets/css/sekretariat.css">
		<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

		<style>
            .nav{
                margin-left: 20px!important;
            }
        </style>
	</head>


	<!--begin::Page title-->
	<div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
		<h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Laman Utama</h1>
		<!--begin::Breadcrumb-->
		<ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
			<li class="breadcrumb-item text-dark" style="color:darkblue">Laman Utama</li>
			<li class="breadcrumb-item">
				<span class="bullet bg-gray-400 w-5px h-2px"></span>
			</li>
			<li class="breadcrumb-item text-dark" style="color:darkblue">Paparan Pemuka</li>
		</ul>
		<!--end::Breadcrumb-->
	</div>
	<!--end::Page title-->

	<br>

	{{-- Body Content --}}
	<div id="main-content">
		<div class="container-fluid">
			<div class="block-header">
				<div class="row clearfix">
					<div class="card">
						<div class="header">
							<h2>Bilangan Permohonan dan Tuntutan<br><small>Sila klik tab BKOKU UA, BKOKU POLI, BKOKU KK, BKOKU IPTS atau PPK untuk lihat jumlah terperinci.</small></h2>
						</div>

						{{-- top nav bar --}}
						<ul class="nav nav-tabs" id="myTab" role="tablist">
							<li class="nav-item" role="presentation">
								<button class="nav-link active" id="bkokuUA-tab" data-toggle="tab" data-target="#bkokuUA" type="button" role="tab" aria-controls="bkokuUA" aria-selected="true">BKOKU UA</button>
							</li>
							<li class="nav-item" role="presentation">
								<button class="nav-link" id="bkokuPOLI-tab" data-toggle="tab" data-target="#bkokuPOLI" type="button" role="tab" aria-controls="bkokuPOLI" aria-selected="true">BKOKU POLI</button>
							</li>
							<li class="nav-item" role="presentation">
								<button class="nav-link" id="bkokuKK-tab" data-toggle="tab" data-target="#bkokuKK" type="button" role="tab" aria-controls="bkokuKK" aria-selected="true">BKOKU KK</button>
							</li>
							<li class="nav-item" role="presentation">
								<button class="nav-link" id="bkokuIPTS-tab" data-toggle="tab" data-target="#bkokuIPTS" type="button" role="tab" aria-controls="bkokuIPTS" aria-selected="true">BKOKU IPTS</button>
							</li>
							<li class="nav-item" role="presentation">
								<button class="nav-link" id="ppk-tab" data-toggle="tab" data-target="#ppk" type="button" role="tab" aria-controls="ppk" aria-selected="false">PPK</button>
							</li>
						</ul>

						<div class="tab-content" id="myTabContent">
							{{-- BKOKU UA --}}
							<div class="tab-pane fade show active" id="bkokuUA" role="tabpanel" aria-labelledby="bkokuUA-tab">
								<!--Permohonan-->
								<div class="header">
									<h2>Permohonan BKOKU Universiti Awam</h2>
								</div>
								<div class="body">
										<!--begin::First Row-->
										<div class="row g-3 g-lg-6" style="text-align: center;">
											<!--begin::Col-->
											<div class="col-4">
												<!--begin::Items-->
												<div class="px-6 pt-5 card-rounded h-150px w-100 card theme-dark-bg-body" style="background-color: #787878">
													<!--begin::Symbol-->
													<div class="symbol symbol-30px me-0 mb-5">
															<i class="fas fa-list-ol text-light" style="font-size: 20px;">
																<span class="path1"></span>
																<span class="path2"></span>
																<span class="fw-semibold me-1 align-self-center" style="padding-bottom: 5px; padding-left:5px; font-family:sans-serif;">Keseluruhan</span>
															</i>
													</div>
													<!--end::Symbol-->
													<!--begin::Stats-->
													<div class="m-0">
														<a href="{{ route('keseluruhanUA.permohonan', ['status' => '!=9']) }}">
															<span class="text-white fw-bolder d-block fs-4x lh-1 ls-n1 mb-1 keseluruhanUA"></span>
															<span class="text-white fw-bold fs-7">Klik untuk Lihat</span>
														</a>
													</div>
													<!--end::Stats-->
												</div>
												<!--end::Items-->
											</div>
											<!--end::Col-->

											<!--begin::Col-->
											<div class="col-4">
												<!--begin::Items-->
												<div class="px-6 pt-5 card-rounded h-150px w-100 card theme-dark-bg-body bg-info">
													<!--begin::Symbol-->
													<div class="symbol symbol-30px me-0 mb-5">
															<i class="fa-solid fa-file-lines text-light" style="font-size: 20px;">
																<span class="path1"></span>
																<span class="path2"></span>
																<span class="path3"></span>
																<span class="fw-semibold me-1 align-self-center" style="padding-bottom: 5px; padding-left:5px; font-family:sans-serif;">Deraf</span>
															</i>
													</div>
													<!--end::Symbol-->
													<!--begin::Stats-->
													<div class="m-0">
														<a href="{{ route('statusUA.permohonan', ['status' => '1']) }}">
															<span class="text-white fw-bolder d-block fs-4x lh-1 ls-n1 mb-1 derafUA"></span>
															<span class="text-white fw-bold fs-7">Klik untuk Lihat</span>
														</a>
													</div>
													<!--end::Stats-->
												</div>
												<!--end::Items-->
											</div>
											<!--end::Col-->

											<!--begin::Col-->
											<div class="col-4">
												<!--begin::Items-->
												<div class="px-6 pt-5 card-rounded h-150px w-100 card theme-dark-bg-body" style="background-color: #186ee6">
													<!--begin::Symbol-->
													<div class="symbol symbol-30px me-0 mb-5">
															<i class="fa-solid fa-file-circle-plus text-light" style="font-size: 20px;">
																<span class="path1"></span>
																<span class="path2"></span>
																<span class="fw-semibold me-1 align-self-center" style="padding-bottom: 5px; padding-left:5px; font-family:sans-serif;">Baharu</span>
															</i>
													</div>
													<!--end::Symbol-->
													<!--begin::Stats-->
													<div class="m-0">
														<a href="{{ route('statusUA.permohonan', ['status' => '2']) }}">
															<span class="text-white fw-bolder d-block fs-4x lh-1 ls-n1 mb-1 baharuUA"></span>
															<span class="text-white fw-bold fs-7">Klik untuk Lihat</span>
														</a>
													</div>
													<!--end::Stats-->
												</div>
												<!--end::Items-->
											</div>
											<!--end::Col-->
										</div>
										<!--end::Row-->

										<!--begin::Second Row-->
										<div class="row g-3 g-lg-6" style="text-align: center;">
											<!--begin::Col-->
											<div class="col-4">
												<!--begin::Items-->
												<div class="px-5 pt-5 card-rounded h-150px w-100 card theme-dark-bg-body" style="background-color: #ea40acdc">
													<!--begin::Symbol-->
													<div class="symbol symbol-30px me-0 mb-5">
															<i class="fas fa-th-list text-light" style="font-size: 20px;">
																<span class="path1"></span>
																<span class="path2"></span>
																<span class="fw-semibold me-1 align-self-center" style="padding-bottom:5px; padding-left:5px; font-family:sans-serif;">Sedang Disaring</span>
															</i>
													</div>
													<!--end::Symbol-->
													<!--begin::Stats-->
													<div class="m-0">
														<a href="{{ route('statusUA.permohonan', ['status' => '3']) }}">
															<span class="text-white fw-bolder d-block fs-4x lh-1 ls-n1 mb-1 saringanUA"></span>
															<span class="text-white fw-bold fs-7">Klik untuk Lihat</span>
														</a>
													</div>
													<!--end::Stats-->
												</div>
												<!--end::Items-->
											</div>
											<!--end::Col-->

											<!--begin::Col-->
											<div class="col-4">
												<!--begin::Items-->
												<div class="px-6 pt-5 card-rounded h-150px w-100 card theme-dark-bg-body bg-warning">
													<!--begin::Symbol-->
													<div class="symbol symbol-30px me-0 mb-5">
															<i class="fa-solid fa-check-to-slot text-light" style="font-size: 20px;">
																<span class="path1"></span>
																<span class="path2"></span>
																<span class="path3"></span>
																<span class="fw-semibold me-1 align-self-center" style="padding-bottom: 5px; padding-left:5px; font-family:sans-serif;">Disokong</span>
															</i>
													</div>
													<!--end::Symbol-->
													<!--begin::Stats-->
													<div class="m-0">
														<a href="{{ route('statusUA.permohonan', ['status' => '4']) }}">
															<span class="text-white fw-bolder d-block fs-4x lh-1 ls-n1 mb-1 disokongUA"></span>
															<span class="text-white fw-bold fs-7">Klik untuk Lihat</span>
														</a>
													</div>
													<!--end::Stats-->
												</div>
												<!--end::Items-->
											</div>
											<!--end::Col-->

											<!--begin::Col-->
											<div class="col-4">
												<!--begin::Items-->
												<div class="px-6 pt-5 card-rounded h-150px w-100 card theme-dark-bg-body"  style="background-color: #d75b50">
													<!--begin::Symbol-->
													<div class="symbol symbol-30px me-0 mb-5">
															<i class="fa-solid fa-reply-all text-light" style="font-size: 20px;">
																<span class="path1"></span>
																<span class="path2"></span>
																<span class="path3"></span>
																<span class="fw-semibold me-1 align-self-center" style="padding-bottom: 5px; padding-left:5px; font-family:sans-serif;">Dikembalikan</span>
															</i>
													</div>
													<!--end::Symbol-->
													<!--begin::Stats-->
													<div class="m-0">
														<a href="{{ route('statusUA.permohonan', ['status' => '5']) }}">
															<span class="text-white fw-bolder d-block fs-4x lh-1 ls-n1 mb-1 dikembalikanUA"></span>
															<span class="text-white fw-bold fs-7">Klik untuk Lihat</span>
														</a>
													</div>
													<!--end::Stats-->
												</div>
												<!--end::Items-->
											</div>
											<!--end::Col-->
										</div>
										<!--end::Row-->

										<!--begin::Third Row-->
										<div class="row g-3 g-lg-6" style="text-align: center;">
											<!--begin::Col-->
											<div class="col-4">
												<!--begin::Items-->
												<div class="px-6 pt-5 card-rounded h-150px w-100 card theme-dark-bg-body" style="background-color: #0ca1ab">
													<!--begin::Symbol-->
													<div class="symbol symbol-30px me-0 mb-5">
															<i class="fa-solid fa-money-bill-transfer text-light" style="font-size: 20px;">
																<span class="path1"></span>
																<span class="path2"></span>
																<span class="fw-semibold me-1 align-self-center" style="padding-bottom: 5px; padding-left:5px; font-family:sans-serif;">Dibayar</span>
															</i>
													</div>
													<!--end::Symbol-->
													<!--begin::Stats-->
													<div class="m-0">
														<a href="{{ route('statusUA.permohonan', ['status' => '8']) }}">
															<span class="text-white fw-bolder d-block fs-4x lh-1 ls-n1 mb-1 dibayarUA"></span>
															<span class="text-white fw-bold fs-7">Klik untuk Lihat</span>
														</a>
													</div>
													<!--end::Stats-->
												</div>
												<!--end::Items-->
											</div>
											<!--end::Col-->
											
											<!--begin::Col-->
											<div class="col-4">
												<!--begin::Items-->
												<div class="px-6 pt-5 card-rounded h-150px w-100 card theme-dark-bg-body bg-success">
													<!--begin::Symbol-->
													<div class="symbol symbol-30px me-0 mb-5">
															<i class="fas fa-user-check text-light" style="font-size: 20px;">
																<span class="path1"></span>
																<span class="path2"></span>
																<span class="fw-semibold me-1 align-self-center" style="padding-bottom: 5px; padding-left:5px; font-family:sans-serif;">Layak</span>
															</i>
													</div>
													<!--end::Symbol-->
													<!--begin::Stats-->
													<div class="m-0">
														<a href="{{ route('statusUA.permohonan', ['status' => '6']) }}">
															<span class="text-white fw-bolder d-block fs-4x lh-1 ls-n1 mb-1 layakUA"></span>
															<span class="text-white fw-bold fs-7">Klik untuk Lihat</span>
														</a>
													</div>
													<!--end::Stats-->
												</div>
												<!--end::Items-->
											</div>
											<!--end::Col-->

											<!--begin::Col-->
											<div class="col-4">
												<!--begin::Items-->
												<div class="px-6 pt-5 card-rounded h-150px w-100 card theme-dark-bg-body bg-danger">
													<!--begin::Symbol-->
													<div class="symbol symbol-30px me-0 mb-5">
															<i class="fa-solid fa-user-xmark text-light" style="font-size: 20px;">
																<span class="path1"></span>
																<span class="path2"></span>
																<span class="path3"></span>
																<span class="fw-semibold me-1 align-self-center" style="padding-bottom: 5px; padding-left:5px; font-family:sans-serif;">Tidak Layak</span>
															</i>
													</div>
													<!--end::Symbol-->
													<!--begin::Stats-->
													<div class="m-0">
														<a href="{{ route('statusUA.permohonan', ['status' => '7']) }}">
															<span class="text-white fw-bolder d-block fs-4x lh-1 ls-n1 mb-1 tidaklayakUA"></span>
															<span class="text-white fw-bold fs-7">Klik untuk Lihat</span>
														</a>
													</div>
													<!--end::Stats-->
												</div>
												<!--end::Items-->
											</div>
											<!--end::Col-->
										</div>
										<!--end::Row-->
								</div>

								<!--Tuntutan-->
								<div class="header">
									<h2>Tuntutan BKOKU Universiti Awam</h2>
								</div>
								<div class="body">
									<!--begin::First Row-->
									<div class="row g-3 g-lg-6" style="text-align: center;">
										<!--begin::Col-->
										<div class="col-4">
											<!--begin::Items-->
											<div class="px-6 pt-5 card-rounded h-150px w-100 card theme-dark-bg-body" style="background-color: #787878">
												<!--begin::Symbol-->
												<div class="symbol symbol-30px me-0 mb-5">
														<i class="fas fa-list-ol text-light" style="font-size: 20px;">
															<span class="path1"></span>
															<span class="path2"></span>
															<span class="fw-semibold me-1 align-self-center" style="padding-bottom: 5px; padding-left:5px; font-family:sans-serif;">Keseluruhan</span>
														</i>
												</div>
												<!--end::Symbol-->
												<!--begin::Stats-->
												<div class="m-0">
													<a href="{{ route('keseluruhanUA.tuntutan', ['status' => '!=9']) }}">
														<span class="text-white fw-bolder d-block fs-4x lh-1 ls-n1 mb-1 keseluruhanTuntutanUA"></span>
														<span class="text-white fw-bold fs-7">Klik untuk Lihat</span>
													</a>
												</div>
												<!--end::Stats-->
											</div>
											<!--end::Items-->
										</div>
										<!--end::Col-->

										<!--begin::Col-->
										<div class="col-4">
											<!--begin::Items-->
											<div class="px-6 pt-5 card-rounded h-150px w-100 card theme-dark-bg-body bg-info">
												<!--begin::Symbol-->
												<div class="symbol symbol-30px me-0 mb-5">
														<i class="fa-solid fa-file-lines text-light" style="font-size: 20px;">
															<span class="path1"></span>
															<span class="path2"></span>
															<span class="path3"></span>
															<span class="fw-semibold me-1 align-self-center" style="padding-bottom: 5px; padding-left:5px; font-family:sans-serif;">Deraf</span>
														</i>
												</div>
												<!--end::Symbol-->
												<!--begin::Stats-->
												<div class="m-0">
													<a href="{{ route('statusUA.tuntutan', ['status' => '1']) }}">
														<span class="text-white fw-bolder d-block fs-4x lh-1 ls-n1 mb-1 derafTuntutanUA"></span>
														<span class="text-white fw-bold fs-7">Klik untuk Lihat</span>
													</a>
												</div>
												<!--end::Stats-->
											</div>
											<!--end::Items-->
										</div>
										<!--end::Col-->

										<!--begin::Col-->
										<div class="col-4">
											<!--begin::Items-->
											<div class="px-6 pt-5 card-rounded h-150px w-100 card theme-dark-bg-body" style="background-color: #186ee6">
												<!--begin::Symbol-->
												<div class="symbol symbol-30px me-0 mb-5">
														<i class="fa-solid fa-file-circle-plus text-light" style="font-size: 20px;">
															<span class="path1"></span>
															<span class="path2"></span>
															<span class="fw-semibold me-1 align-self-center" style="padding-bottom: 5px; padding-left:5px; font-family:sans-serif;">Baharu</span>
														</i>
												</div>
												<!--end::Symbol-->
												<!--begin::Stats-->
												<div class="m-0">
													<a href="{{ route('statusUA.tuntutan', ['status' => '2']) }}">
														<span class="text-white fw-bolder d-block fs-4x lh-1 ls-n1 mb-1 baharuTuntutanUA"></span>
														<span class="text-white fw-bold fs-7">Klik untuk Lihat</span>
													</a>
												</div>
												<!--end::Stats-->
											</div>
											<!--end::Items-->
										</div>
										<!--end::Col-->
									</div>
									<!--end::Row-->

									<!--begin::Second Row-->
									<div class="row g-3 g-lg-6" style="text-align: center;">
										<!--begin::Col-->
										<div class="col-4">
											<!--begin::Items-->
											<div class="px-5 pt-5 card-rounded h-150px w-100 card theme-dark-bg-body" style="background-color: #ea40acdc">
												<!--begin::Symbol-->
												<div class="symbol symbol-30px me-0 mb-5">
														<i class="fas fa-th-list text-light" style="font-size: 20px;">
															<span class="path1"></span>
															<span class="path2"></span>
															<span class="fw-semibold me-1 align-self-center" style="padding-bottom:5px; padding-left:5px; font-family:sans-serif;">Sedang Disaring</span>
														</i>
												</div>
												<!--end::Symbol-->
												<!--begin::Stats-->
												<div class="m-0">
													<a href="{{ route('statusUA.tuntutan', ['status' => '3']) }}">
														<span class="text-white fw-bolder d-block fs-4x lh-1 ls-n1 mb-1 saringanTuntutanUA"></span>
														<span class="text-white fw-bold fs-7">Klik untuk Lihat</span>
													</a>
												</div>
												<!--end::Stats-->
											</div>
											<!--end::Items-->
										</div>
										<!--end::Col-->

										<!--begin::Col-->
										<div class="col-4">
											<!--begin::Items-->
											<div class="px-6 pt-5 card-rounded h-150px w-100 card theme-dark-bg-body bg-warning">
												<!--begin::Symbol-->
												<div class="symbol symbol-30px me-0 mb-5">
														<i class="fa-solid fa-check-to-slot text-light" style="font-size: 20px;">
															<span class="path1"></span>
															<span class="path2"></span>
															<span class="path3"></span>
															<span class="fw-semibold me-1 align-self-center" style="padding-bottom: 5px; padding-left:5px; font-family:sans-serif;">Disokong</span>
														</i>
												</div>
												<!--end::Symbol-->
												<!--begin::Stats-->
												<div class="m-0">
													<a href="{{ route('statusUA.tuntutan', ['status' => '4']) }}">
														<span class="text-white fw-bolder d-block fs-4x lh-1 ls-n1 mb-1 disokongTuntutanUA"></span>
														<span class="text-white fw-bold fs-7">Klik untuk Lihat</span>
													</a>
												</div>
												<!--end::Stats-->
											</div>
											<!--end::Items-->
										</div>
										<!--end::Col-->

										<!--begin::Col-->
										<div class="col-4">
											<!--begin::Items-->
											<div class="px-6 pt-5 card-rounded h-150px w-100 card theme-dark-bg-body"  style="background-color: #d75b50">
												<!--begin::Symbol-->
												<div class="symbol symbol-30px me-0 mb-5">
														<i class="fa-solid fa-reply-all text-light" style="font-size: 20px;">
															<span class="path1"></span>
															<span class="path2"></span>
															<span class="path3"></span>
															<span class="fw-semibold me-1 align-self-center" style="padding-bottom: 5px; padding-left:5px; font-family:sans-serif;">Dikembalikan</span>
														</i>
												</div>
												<!--end::Symbol-->
												<!--begin::Stats-->
												<div class="m-0">
													<a href="{{ route('statusUA.tuntutan', ['status' => '5']) }}">
														<span class="text-white fw-bolder d-block fs-4x lh-1 ls-n1 mb-1 dikembalikanTuntutanUA"></span>
														<span class="text-white fw-bold fs-7">Klik untuk Lihat</span>
													</a>
												</div>
												<!--end::Stats-->
											</div>
											<!--end::Items-->
										</div>
										<!--end::Col-->
									</div>
									<!--end::Row-->

									<!--begin::Third Row-->
									<div class="row g-3 g-lg-6" style="text-align: center;">
										<!--begin::Col-->
										<div class="col-4">
											<!--begin::Items-->
											<div class="px-6 pt-5 card-rounded h-150px w-100 card theme-dark-bg-body" style="background-color: #0ca1ab">
												<!--begin::Symbol-->
												<div class="symbol symbol-30px me-0 mb-5">
														<i class="fa-solid fa-money-bill-transfer text-light" style="font-size: 20px;">
															<span class="path1"></span>
															<span class="path2"></span>
															<span class="fw-semibold me-1 align-self-center" style="padding-bottom: 5px; padding-left:5px; font-family:sans-serif;">Dibayar</span>
														</i>
												</div>
												<!--end::Symbol-->
												<!--begin::Stats-->
												<div class="m-0">
													<a href="{{ route('statusUA.tuntutan', ['status' => '8']) }}">
														<span class="text-white fw-bolder d-block fs-4x lh-1 ls-n1 mb-1 dibayarTuntutanUA"></span>
														<span class="text-white fw-bold fs-7">Klik untuk Lihat</span>
													</a>
												</div>
												<!--end::Stats-->
											</div>
											<!--end::Items-->
										</div>
										<!--end::Col-->
										
										<!--begin::Col-->
										<div class="col-4">
											<!--begin::Items-->
											<div class="px-6 pt-5 card-rounded h-150px w-100 card theme-dark-bg-body bg-success">
												<!--begin::Symbol-->
												<div class="symbol symbol-30px me-0 mb-5">
														<i class="fas fa-user-check text-light" style="font-size: 20px;">
															<span class="path1"></span>
															<span class="path2"></span>
															<span class="fw-semibold me-1 align-self-center" style="padding-bottom: 5px; padding-left:5px; font-family:sans-serif;">Layak</span>
														</i>
												</div>
												<!--end::Symbol-->
												<!--begin::Stats-->
												<div class="m-0">
													<a href="{{ route('statusUA.tuntutan', ['status' => '6']) }}">
														<span class="text-white fw-bolder d-block fs-4x lh-1 ls-n1 mb-1 layakTuntutanUA"></span>
														<span class="text-white fw-bold fs-7">Klik untuk Lihat</span>
													</a>
												</div>
												<!--end::Stats-->
											</div>
											<!--end::Items-->
										</div>
										<!--end::Col-->

										<!--begin::Col-->
										<div class="col-4">
											<!--begin::Items-->
											<div class="px-6 pt-5 card-rounded h-150px w-100 card theme-dark-bg-body bg-danger">
												<!--begin::Symbol-->
												<div class="symbol symbol-30px me-0 mb-5">
														<i class="fa-solid fa-user-xmark text-light" style="font-size: 20px;">
															<span class="path1"></span>
															<span class="path2"></span>
															<span class="path3"></span>
															<span class="fw-semibold me-1 align-self-center" style="padding-bottom: 5px; padding-left:5px; font-family:sans-serif;">Tidak Layak</span>
														</i>
												</div>
												<!--end::Symbol-->
												<!--begin::Stats-->
												<div class="m-0">
													<a href="{{ route('statusUA.tuntutan', ['status' => '7']) }}">
														<span class="text-white fw-bolder d-block fs-4x lh-1 ls-n1 mb-1 tidaklayakTuntutanUA"></span>
														<span class="text-white fw-bold fs-7">Klik untuk Lihat</span>
													</a>
												</div>
												<!--end::Stats-->
											</div>
											<!--end::Items-->
										</div>
										<!--end::Col-->
									</div>
									<!--end::Row-->
								</div>
							</div>

							{{-- BKOKU POLI --}}
							<div class="tab-pane fade" id="bkokuPOLI" role="tabpanel" aria-labelledby="bkokuPOLI-tab">
								<!--Permohonan-->
								<div class="header">
									<h2>Permohonan BKOKU Politeknik</h2>
								</div>
								<div class="body">
									<!--begin::First Row-->
									<div class="row g-3 g-lg-6" style="text-align: center;">
										<!--begin::Col-->
										<div class="col-4">
											<!--begin::Items-->
											<div class="px-6 pt-5 card-rounded h-150px w-100 card theme-dark-bg-body" style="background-color: #787878">
												<!--begin::Symbol-->
												<div class="symbol symbol-30px me-0 mb-5">
														<i class="fas fa-list-ol text-light" style="font-size: 20px;">
															<span class="path1"></span>
															<span class="path2"></span>
															<span class="fw-semibold me-1 align-self-center" style="padding-bottom: 5px; padding-left:5px; font-family:sans-serif;">Keseluruhan</span>
														</i>
												</div>
												<!--end::Symbol-->
												<!--begin::Stats-->
												<div class="m-0">
													<a href="{{ route('keseluruhanPOLI.permohonan') }}">
														<span class="text-white fw-bolder d-block fs-4x lh-1 ls-n1 mb-1 keseluruhanPOLI"></span>
														<span class="text-white fw-bold fs-7">Klik untuk Lihat</span>
													</a>
												</div>
												<!--end::Stats-->
											</div>
											<!--end::Items-->
										</div>
										<!--end::Col-->

										<!--begin::Col-->
										<div class="col-4">
											<!--begin::Items-->
											<div class="px-6 pt-5 card-rounded h-150px w-100 card theme-dark-bg-body bg-info">
												<!--begin::Symbol-->
												<div class="symbol symbol-30px me-0 mb-5">
														<i class="fa-solid fa-file-lines text-light" style="font-size: 20px;">
															<span class="path1"></span>
															<span class="path2"></span>
															<span class="path3"></span>
															<span class="fw-semibold me-1 align-self-center" style="padding-bottom: 5px; padding-left:5px; font-family:sans-serif;">Deraf</span>
														</i>
												</div>
												<!--end::Symbol-->
												<!--begin::Stats-->
												<div class="m-0">
													<a href="{{ route('statusPOLI.permohonan', ['status' => '1']) }}">
														<span class="text-white fw-bolder d-block fs-4x lh-1 ls-n1 mb-1 derafPOLI"></span>
														<span class="text-white fw-bold fs-7">Klik untuk Lihat</span>
													</a>
												</div>
												<!--end::Stats-->
											</div>
											<!--end::Items-->
										</div>
										<!--end::Col-->

										<!--begin::Col-->
										<div class="col-4">
											<!--begin::Items-->
											<div class="px-6 pt-5 card-rounded h-150px w-100 card theme-dark-bg-body" style="background-color: #186ee6">
												<!--begin::Symbol-->
												<div class="symbol symbol-30px me-0 mb-5">
														<i class="fa-solid fa-file-circle-plus text-light" style="font-size: 20px;">
															<span class="path1"></span>
															<span class="path2"></span>
															<span class="fw-semibold me-1 align-self-center" style="padding-bottom: 5px; padding-left:5px; font-family:sans-serif;">Baharu</span>
														</i>
												</div>
												<!--end::Symbol-->
												<!--begin::Stats-->
												<div class="m-0">
													<a href="{{ route('statusPOLI.permohonan', ['status' => '2']) }}">
														<span class="text-white fw-bolder d-block fs-4x lh-1 ls-n1 mb-1 baharuPOLI"></span>
														<span class="text-white fw-bold fs-7">Klik untuk Lihat</span>
													</a>
												</div>
												<!--end::Stats-->
											</div>
											<!--end::Items-->
										</div>
										<!--end::Col-->
									</div>
									<!--end::Row-->

									<!--begin::Second Row-->
									<div class="row g-3 g-lg-6" style="text-align: center;">
										<!--begin::Col-->
										<div class="col-4">
											<!--begin::Items-->
											<div class="px-5 pt-5 card-rounded h-150px w-100 card theme-dark-bg-body" style="background-color: #ea40acdc">
												<!--begin::Symbol-->
												<div class="symbol symbol-30px me-0 mb-5">
														<i class="fas fa-th-list text-light" style="font-size: 20px;">
															<span class="path1"></span>
															<span class="path2"></span>
															<span class="fw-semibold me-1 align-self-center" style="padding-bottom:5px; padding-left:5px; font-family:sans-serif;">Sedang Disaring</span>
														</i>
												</div>
												<!--end::Symbol-->
												<!--begin::Stats-->
												<div class="m-0">
													<a href="{{ route('statusPOLI.permohonan', ['status' => '3']) }}">
														<span class="text-white fw-bolder d-block fs-4x lh-1 ls-n1 mb-1 saringanPOLI"></span>
														<span class="text-white fw-bold fs-7">Klik untuk Lihat</span>
													</a>
												</div>
												<!--end::Stats-->
											</div>
											<!--end::Items-->
										</div>
										<!--end::Col-->

										<!--begin::Col-->
										<div class="col-4">
											<!--begin::Items-->
											<div class="px-6 pt-5 card-rounded h-150px w-100 card theme-dark-bg-body bg-warning">
												<!--begin::Symbol-->
												<div class="symbol symbol-30px me-0 mb-5">
														<i class="fa-solid fa-check-to-slot text-light" style="font-size: 20px;">
															<span class="path1"></span>
															<span class="path2"></span>
															<span class="path3"></span>
															<span class="fw-semibold me-1 align-self-center" style="padding-bottom: 5px; padding-left:5px; font-family:sans-serif;">Disokong</span>
														</i>
												</div>
												<!--end::Symbol-->
												<!--begin::Stats-->
												<div class="m-0">
													<a href="{{ route('statusPOLI.permohonan', ['status' => '4']) }}">
														<span class="text-white fw-bolder d-block fs-4x lh-1 ls-n1 mb-1 disokongPOLI"></span>
														<span class="text-white fw-bold fs-7">Klik untuk Lihat</span>
													</a>
												</div>
												<!--end::Stats-->
											</div>
											<!--end::Items-->
										</div>
										<!--end::Col-->

										<!--begin::Col-->
										<div class="col-4">
											<!--begin::Items-->
											<div class="px-6 pt-5 card-rounded h-150px w-100 card theme-dark-bg-body"  style="background-color: #d75b50">
												<!--begin::Symbol-->
												<div class="symbol symbol-30px me-0 mb-5">
														<i class="fa-solid fa-reply-all text-light" style="font-size: 20px;">
															<span class="path1"></span>
															<span class="path2"></span>
															<span class="path3"></span>
															<span class="fw-semibold me-1 align-self-center" style="padding-bottom: 5px; padding-left:5px; font-family:sans-serif;">Dikembalikan</span>
														</i>
												</div>
												<!--end::Symbol-->
												<!--begin::Stats-->
												<div class="m-0">
													<a href="{{ route('statusPOLI.permohonan', ['status' => '5']) }}">
														<span class="text-white fw-bolder d-block fs-4x lh-1 ls-n1 mb-1 dikembalikanPOLI"></span>
														<span class="text-white fw-bold fs-7">Klik untuk Lihat</span>
													</a>
												</div>
												<!--end::Stats-->
											</div>
											<!--end::Items-->
										</div>
										<!--end::Col-->
									</div>
									<!--end::Row-->

									<!--begin::Third Row-->
									<div class="row g-3 g-lg-6" style="text-align: center;">
										<!--begin::Col-->
										<div class="col-4">
											<!--begin::Items-->
											<div class="px-6 pt-5 card-rounded h-150px w-100 card theme-dark-bg-body" style="background-color: #0ca1ab">
												<!--begin::Symbol-->
												<div class="symbol symbol-30px me-0 mb-5">
														<i class="fa-solid fa-money-bill-transfer text-light" style="font-size: 20px;">
															<span class="path1"></span>
															<span class="path2"></span>
															<span class="fw-semibold me-1 align-self-center" style="padding-bottom: 5px; padding-left:5px; font-family:sans-serif;">Dibayar</span>
														</i>
												</div>
												<!--end::Symbol-->
												<!--begin::Stats-->
												<div class="m-0">
													<a href="{{ route('statusPOLI.permohonan', ['status' => '8']) }}">
														<span class="text-white fw-bolder d-block fs-4x lh-1 ls-n1 mb-1 dibayarPOLI"></span>
														<span class="text-white fw-bold fs-7">Klik untuk Lihat</span>
													</a>
												</div>
												<!--end::Stats-->
											</div>
											<!--end::Items-->
										</div>
										<!--end::Col-->
										
										<!--begin::Col-->
										<div class="col-4">
											<!--begin::Items-->
											<div class="px-6 pt-5 card-rounded h-150px w-100 card theme-dark-bg-body bg-success">
												<!--begin::Symbol-->
												<div class="symbol symbol-30px me-0 mb-5">
														<i class="fas fa-user-check text-light" style="font-size: 20px;">
															<span class="path1"></span>
															<span class="path2"></span>
															<span class="fw-semibold me-1 align-self-center" style="padding-bottom: 5px; padding-left:5px; font-family:sans-serif;">Layak</span>
														</i>
												</div>
												<!--end::Symbol-->
												<!--begin::Stats-->
												<div class="m-0">
													<a href="{{ route('statusPOLI.permohonan', ['status' => '6']) }}">
														<span class="text-white fw-bolder d-block fs-4x lh-1 ls-n1 mb-1 layakPOLI"></span>
														<span class="text-white fw-bold fs-7">Klik untuk Lihat</span>
													</a>
												</div>
												<!--end::Stats-->
											</div>
											<!--end::Items-->
										</div>
										<!--end::Col-->

										<!--begin::Col-->
										<div class="col-4">
											<!--begin::Items-->
											<div class="px-6 pt-5 card-rounded h-150px w-100 card theme-dark-bg-body bg-danger">
												<!--begin::Symbol-->
												<div class="symbol symbol-30px me-0 mb-5">
														<i class="fa-solid fa-user-xmark text-light" style="font-size: 20px;">
															<span class="path1"></span>
															<span class="path2"></span>
															<span class="path3"></span>
															<span class="fw-semibold me-1 align-self-center" style="padding-bottom: 5px; padding-left:5px; font-family:sans-serif;">Tidak Layak</span>
														</i>
												</div>
												<!--end::Symbol-->
												<!--begin::Stats-->
												<div class="m-0">
													<a href="{{ route('statusPOLI.permohonan', ['status' => '7']) }}">
														<span class="text-white fw-bolder d-block fs-4x lh-1 ls-n1 mb-1 tidaklayakPOLI"></span>
														<span class="text-white fw-bold fs-7">Klik untuk Lihat</span>
													</a>
												</div>
												<!--end::Stats-->
											</div>
											<!--end::Items-->
										</div>
										<!--end::Col-->
									</div>
									<!--end::Row-->
								</div>

								<!--Tuntutan-->
								<div class="header">
									<h2>Tuntutan BKOKU Politeknik</h2>
								</div>
								<div class="body">
									<!--begin::First Row-->
									<div class="row g-3 g-lg-6" style="text-align: center;">
										<!--begin::Col-->
										<div class="col-4">
											<!--begin::Items-->
											<div class="px-6 pt-5 card-rounded h-150px w-100 card theme-dark-bg-body" style="background-color: #787878">
												<!--begin::Symbol-->
												<div class="symbol symbol-30px me-0 mb-5">
														<i class="fas fa-list-ol text-light" style="font-size: 20px;">
															<span class="path1"></span>
															<span class="path2"></span>
															<span class="fw-semibold me-1 align-self-center" style="padding-bottom: 5px; padding-left:5px; font-family:sans-serif;">Keseluruhan</span>
														</i>
												</div>
												<!--end::Symbol-->
												<!--begin::Stats-->
												<div class="m-0">
													<a href="{{ route('keseluruhanPOLI.tuntutan', ['status' => '!=9']) }}">
														<span class="text-white fw-bolder d-block fs-4x lh-1 ls-n1 mb-1 keseluruhanTuntutanPOLI"></span>
														<span class="text-white fw-bold fs-7">Klik untuk Lihat</span>
													</a>
												</div>
												<!--end::Stats-->
											</div>
											<!--end::Items-->
										</div>
										<!--end::Col-->

										<!--begin::Col-->
										<div class="col-4">
											<!--begin::Items-->
											<div class="px-6 pt-5 card-rounded h-150px w-100 card theme-dark-bg-body bg-info">
												<!--begin::Symbol-->
												<div class="symbol symbol-30px me-0 mb-5">
														<i class="fa-solid fa-file-lines text-light" style="font-size: 20px;">
															<span class="path1"></span>
															<span class="path2"></span>
															<span class="path3"></span>
															<span class="fw-semibold me-1 align-self-center" style="padding-bottom: 5px; padding-left:5px; font-family:sans-serif;">Deraf</span>
														</i>
												</div>
												<!--end::Symbol-->
												<!--begin::Stats-->
												<div class="m-0">
													<a href="{{ route('statusPOLI.tuntutan', ['status' => '1']) }}">
														<span class="text-white fw-bolder d-block fs-4x lh-1 ls-n1 mb-1 derafTuntutanPOLI"></span>
														<span class="text-white fw-bold fs-7">Klik untuk Lihat</span>
													</a>
												</div>
												<!--end::Stats-->
											</div>
											<!--end::Items-->
										</div>
										<!--end::Col-->

										<!--begin::Col-->
										<div class="col-4">
											<!--begin::Items-->
											<div class="px-6 pt-5 card-rounded h-150px w-100 card theme-dark-bg-body" style="background-color: #186ee6">
												<!--begin::Symbol-->
												<div class="symbol symbol-30px me-0 mb-5">
														<i class="fa-solid fa-file-circle-plus text-light" style="font-size: 20px;">
															<span class="path1"></span>
															<span class="path2"></span>
															<span class="fw-semibold me-1 align-self-center" style="padding-bottom: 5px; padding-left:5px; font-family:sans-serif;">Baharu</span>
														</i>
												</div>
												<!--end::Symbol-->
												<!--begin::Stats-->
												<div class="m-0">
													<a href="{{ route('statusPOLI.tuntutan', ['status' => '2']) }}">
														<span class="text-white fw-bolder d-block fs-4x lh-1 ls-n1 mb-1 baharuTuntutanPOLI"></span>
														<span class="text-white fw-bold fs-7">Klik untuk Lihat</span>
													</a>
												</div>
												<!--end::Stats-->
											</div>
											<!--end::Items-->
										</div>
										<!--end::Col-->
									</div>
									<!--end::Row-->

									<!--begin::Second Row-->
									<div class="row g-3 g-lg-6" style="text-align: center;">
										<!--begin::Col-->
										<div class="col-4">
											<!--begin::Items-->
											<div class="px-5 pt-5 card-rounded h-150px w-100 card theme-dark-bg-body" style="background-color: #ea40acdc">
												<!--begin::Symbol-->
												<div class="symbol symbol-30px me-0 mb-5">
														<i class="fas fa-th-list text-light" style="font-size: 20px;">
															<span class="path1"></span>
															<span class="path2"></span>
															<span class="fw-semibold me-1 align-self-center" style="padding-bottom:5px; padding-left:5px; font-family:sans-serif;">Sedang Disaring</span>
														</i>
												</div>
												<!--end::Symbol-->
												<!--begin::Stats-->
												<div class="m-0">
													<a href="{{ route('statusPOLI.tuntutan', ['status' => '3']) }}">
														<span class="text-white fw-bolder d-block fs-4x lh-1 ls-n1 mb-1 saringanTuntutanPOLI"></span>
														<span class="text-white fw-bold fs-7">Klik untuk Lihat</span>
													</a>
												</div>
												<!--end::Stats-->
											</div>
											<!--end::Items-->
										</div>
										<!--end::Col-->

										<!--begin::Col-->
										<div class="col-4">
											<!--begin::Items-->
											<div class="px-6 pt-5 card-rounded h-150px w-100 card theme-dark-bg-body bg-warning">
												<!--begin::Symbol-->
												<div class="symbol symbol-30px me-0 mb-5">
														<i class="fa-solid fa-check-to-slot text-light" style="font-size: 20px;">
															<span class="path1"></span>
															<span class="path2"></span>
															<span class="path3"></span>
															<span class="fw-semibold me-1 align-self-center" style="padding-bottom: 5px; padding-left:5px; font-family:sans-serif;">Disokong</span>
														</i>
												</div>
												<!--end::Symbol-->
												<!--begin::Stats-->
												<div class="m-0">
													<a href="{{ route('statusPOLI.tuntutan', ['status' => '4']) }}">
														<span class="text-white fw-bolder d-block fs-4x lh-1 ls-n1 mb-1 disokongTuntutanPOLI"></span>
														<span class="text-white fw-bold fs-7">Klik untuk Lihat</span>
													</a>
												</div>
												<!--end::Stats-->
											</div>
											<!--end::Items-->
										</div>
										<!--end::Col-->

										<!--begin::Col-->
										<div class="col-4">
											<!--begin::Items-->
											<div class="px-6 pt-5 card-rounded h-150px w-100 card theme-dark-bg-body"  style="background-color: #d75b50">
												<!--begin::Symbol-->
												<div class="symbol symbol-30px me-0 mb-5">
														<i class="fa-solid fa-reply-all text-light" style="font-size: 20px;">
															<span class="path1"></span>
															<span class="path2"></span>
															<span class="path3"></span>
															<span class="fw-semibold me-1 align-self-center" style="padding-bottom: 5px; padding-left:5px; font-family:sans-serif;">Dikembalikan</span>
														</i>
												</div>
												<!--end::Symbol-->
												<!--begin::Stats-->
												<div class="m-0">
													<a href="{{ route('statusPOLI.tuntutan', ['status' => '5']) }}">
														<span class="text-white fw-bolder d-block fs-4x lh-1 ls-n1 mb-1 dikembalikanTuntutanPOLI"></span>
														<span class="text-white fw-bold fs-7">Klik untuk Lihat</span>
													</a>
												</div>
												<!--end::Stats-->
											</div>
											<!--end::Items-->
										</div>
										<!--end::Col-->
									</div>
									<!--end::Row-->

									<!--begin::Third Row-->
									<div class="row g-3 g-lg-6" style="text-align: center;">
										<!--begin::Col-->
										<div class="col-4">
											<!--begin::Items-->
											<div class="px-6 pt-5 card-rounded h-150px w-100 card theme-dark-bg-body" style="background-color: #0ca1ab">
												<!--begin::Symbol-->
												<div class="symbol symbol-30px me-0 mb-5">
														<i class="fa-solid fa-money-bill-transfer text-light" style="font-size: 20px;">
															<span class="path1"></span>
															<span class="path2"></span>
															<span class="fw-semibold me-1 align-self-center" style="padding-bottom: 5px; padding-left:5px; font-family:sans-serif;">Dibayar</span>
														</i>
												</div>
												<!--end::Symbol-->
												<!--begin::Stats-->
												<div class="m-0">
													<a href="{{ route('statusPOLI.tuntutan', ['status' => '8']) }}">
														<span class="text-white fw-bolder d-block fs-4x lh-1 ls-n1 mb-1 dibayarTuntutanPOLI"></span>
														<span class="text-white fw-bold fs-7">Klik untuk Lihat</span>
													</a>
												</div>
												<!--end::Stats-->
											</div>
											<!--end::Items-->
										</div>
										<!--end::Col-->
										
										<!--begin::Col-->
										<div class="col-4">
											<!--begin::Items-->
											<div class="px-6 pt-5 card-rounded h-150px w-100 card theme-dark-bg-body bg-success">
												<!--begin::Symbol-->
												<div class="symbol symbol-30px me-0 mb-5">
														<i class="fas fa-user-check text-light" style="font-size: 20px;">
															<span class="path1"></span>
															<span class="path2"></span>
															<span class="fw-semibold me-1 align-self-center" style="padding-bottom: 5px; padding-left:5px; font-family:sans-serif;">Layak</span>
														</i>
												</div>
												<!--end::Symbol-->
												<!--begin::Stats-->
												<div class="m-0">
													<a href="{{ route('statusPOLI.tuntutan', ['status' => '6']) }}">
														<span class="text-white fw-bolder d-block fs-4x lh-1 ls-n1 mb-1 layakTuntutanPOLI"></span>
														<span class="text-white fw-bold fs-7">Klik untuk Lihat</span>
													</a>
												</div>
												<!--end::Stats-->
											</div>
											<!--end::Items-->
										</div>
										<!--end::Col-->

										<!--begin::Col-->
										<div class="col-4">
											<!--begin::Items-->
											<div class="px-6 pt-5 card-rounded h-150px w-100 card theme-dark-bg-body bg-danger">
												<!--begin::Symbol-->
												<div class="symbol symbol-30px me-0 mb-5">
														<i class="fa-solid fa-user-xmark text-light" style="font-size: 20px;">
															<span class="path1"></span>
															<span class="path2"></span>
															<span class="path3"></span>
															<span class="fw-semibold me-1 align-self-center" style="padding-bottom: 5px; padding-left:5px; font-family:sans-serif;">Tidak Layak</span>
														</i>
												</div>
												<!--end::Symbol-->
												<!--begin::Stats-->
												<div class="m-0">
													<a href="{{ route('statusPOLI.tuntutan', ['status' => '7']) }}">
														<span class="text-white fw-bolder d-block fs-4x lh-1 ls-n1 mb-1 tidaklayakTuntutanPOLI"></span>
														<span class="text-white fw-bold fs-7">Klik untuk Lihat</span>
													</a>
												</div>
												<!--end::Stats-->
											</div>
											<!--end::Items-->
										</div>
										<!--end::Col-->
									</div>
									<!--end::Row-->
								</div>
							</div>

							{{-- BKOKU KK --}}
							<div class="tab-pane fade" id="bkokuKK" role="tabpanel" aria-labelledby="bkokuKK-tab">
								<!--Permohonan-->
								<div class="header">
									<h2>Permohonan BKOKU Kolej Komuniti</h2>
								</div>
								<div class="body">
									<!--begin::First Row-->
									<div class="row g-3 g-lg-6" style="text-align: center;">
										<!--begin::Col-->
										<div class="col-4">
											<!--begin::Items-->
											<div class="px-6 pt-5 card-rounded h-150px w-100 card theme-dark-bg-body" style="background-color: #787878">
												<!--begin::Symbol-->
												<div class="symbol symbol-30px me-0 mb-5">
														<i class="fas fa-list-ol text-light" style="font-size: 20px;">
															<span class="path1"></span>
															<span class="path2"></span>
															<span class="fw-semibold me-1 align-self-center" style="padding-bottom: 5px; padding-left:5px; font-family:sans-serif;">Keseluruhan</span>
														</i>
												</div>
												<!--end::Symbol-->
												<!--begin::Stats-->
												<div class="m-0">
													<a href="{{ route('keseluruhanKK.permohonan') }}">
														<span class="text-white fw-bolder d-block fs-4x lh-1 ls-n1 mb-1 keseluruhanKK"></span>
														<span class="text-white fw-bold fs-7">Klik untuk Lihat</span>
													</a>
												</div>
												<!--end::Stats-->
											</div>
											<!--end::Items-->
										</div>
										<!--end::Col-->

										<!--begin::Col-->
										<div class="col-4">
											<!--begin::Items-->
											<div class="px-6 pt-5 card-rounded h-150px w-100 card theme-dark-bg-body bg-info">
												<!--begin::Symbol-->
												<div class="symbol symbol-30px me-0 mb-5">
														<i class="fa-solid fa-file-lines text-light" style="font-size: 20px;">
															<span class="path1"></span>
															<span class="path2"></span>
															<span class="path3"></span>
															<span class="fw-semibold me-1 align-self-center" style="padding-bottom: 5px; padding-left:5px; font-family:sans-serif;">Deraf</span>
														</i>
												</div>
												<!--end::Symbol-->
												<!--begin::Stats-->
												<div class="m-0">
													<a href="{{ route('statusKK.permohonan', ['status' => '1']) }}">
														<span class="text-white fw-bolder d-block fs-4x lh-1 ls-n1 mb-1 derafKK"></span>
														<span class="text-white fw-bold fs-7">Klik untuk Lihat</span>
													</a>
												</div>
												<!--end::Stats-->
											</div>
											<!--end::Items-->
										</div>
										<!--end::Col-->

										<!--begin::Col-->
										<div class="col-4">
											<!--begin::Items-->
											<div class="px-6 pt-5 card-rounded h-150px w-100 card theme-dark-bg-body" style="background-color: #186ee6">
												<!--begin::Symbol-->
												<div class="symbol symbol-30px me-0 mb-5">
														<i class="fa-solid fa-file-circle-plus text-light" style="font-size: 20px;">
															<span class="path1"></span>
															<span class="path2"></span>
															<span class="fw-semibold me-1 align-self-center" style="padding-bottom: 5px; padding-left:5px; font-family:sans-serif;">Baharu</span>
														</i>
												</div>
												<!--end::Symbol-->
												<!--begin::Stats-->
												<div class="m-0">
													<a href="{{ route('statusKK.permohonan', ['status' => '2']) }}">
														<span class="text-white fw-bolder d-block fs-4x lh-1 ls-n1 mb-1 baharuKK"></span>
														<span class="text-white fw-bold fs-7">Klik untuk Lihat</span>
													</a>
												</div>
												<!--end::Stats-->
											</div>
											<!--end::Items-->
										</div>
										<!--end::Col-->
									</div>
									<!--end::Row-->

									<!--begin::Second Row-->
									<div class="row g-3 g-lg-6" style="text-align: center;">
										<!--begin::Col-->
										<div class="col-4">
											<!--begin::Items-->
											<div class="px-5 pt-5 card-rounded h-150px w-100 card theme-dark-bg-body" style="background-color: #ea40acdc">
												<!--begin::Symbol-->
												<div class="symbol symbol-30px me-0 mb-5">
														<i class="fas fa-th-list text-light" style="font-size: 20px;">
															<span class="path1"></span>
															<span class="path2"></span>
															<span class="fw-semibold me-1 align-self-center" style="padding-bottom:5px; padding-left:5px; font-family:sans-serif;">Sedang Disaring</span>
														</i>
												</div>
												<!--end::Symbol-->
												<!--begin::Stats-->
												<div class="m-0">
													<a href="{{ route('statusKK.permohonan', ['status' => '3']) }}">
														<span class="text-white fw-bolder d-block fs-4x lh-1 ls-n1 mb-1 saringanKK"></span>
														<span class="text-white fw-bold fs-7">Klik untuk Lihat</span>
													</a>
												</div>
												<!--end::Stats-->
											</div>
											<!--end::Items-->
										</div>
										<!--end::Col-->

										<!--begin::Col-->
										<div class="col-4">
											<!--begin::Items-->
											<div class="px-6 pt-5 card-rounded h-150px w-100 card theme-dark-bg-body bg-warning">
												<!--begin::Symbol-->
												<div class="symbol symbol-30px me-0 mb-5">
														<i class="fa-solid fa-check-to-slot text-light" style="font-size: 20px;">
															<span class="path1"></span>
															<span class="path2"></span>
															<span class="path3"></span>
															<span class="fw-semibold me-1 align-self-center" style="padding-bottom: 5px; padding-left:5px; font-family:sans-serif;">Disokong</span>
														</i>
												</div>
												<!--end::Symbol-->
												<!--begin::Stats-->
												<div class="m-0">
													<a href="{{ route('statusKK.permohonan', ['status' => '4']) }}">
														<span class="text-white fw-bolder d-block fs-4x lh-1 ls-n1 mb-1 disokongKK"></span>
														<span class="text-white fw-bold fs-7">Klik untuk Lihat</span>
													</a>
												</div>
												<!--end::Stats-->
											</div>
											<!--end::Items-->
										</div>
										<!--end::Col-->

										<!--begin::Col-->
										<div class="col-4">
											<!--begin::Items-->
											<div class="px-6 pt-5 card-rounded h-150px w-100 card theme-dark-bg-body"  style="background-color: #d75b50">
												<!--begin::Symbol-->
												<div class="symbol symbol-30px me-0 mb-5">
														<i class="fa-solid fa-reply-all text-light" style="font-size: 20px;">
															<span class="path1"></span>
															<span class="path2"></span>
															<span class="path3"></span>
															<span class="fw-semibold me-1 align-self-center" style="padding-bottom: 5px; padding-left:5px; font-family:sans-serif;">Dikembalikan</span>
														</i>
												</div>
												<!--end::Symbol-->
												<!--begin::Stats-->
												<div class="m-0">
													<a href="{{ route('statusKK.permohonan', ['status' => '5']) }}">
														<span class="text-white fw-bolder d-block fs-4x lh-1 ls-n1 mb-1 dikembalikanKK"></span>
														<span class="text-white fw-bold fs-7">Klik untuk Lihat</span>
													</a>
												</div>
												<!--end::Stats-->
											</div>
											<!--end::Items-->
										</div>
										<!--end::Col-->
									</div>
									<!--end::Row-->

									<!--begin::Third Row-->
									<div class="row g-3 g-lg-6" style="text-align: center;">
										<!--begin::Col-->
										<div class="col-4">
											<!--begin::Items-->
											<div class="px-6 pt-5 card-rounded h-150px w-100 card theme-dark-bg-body" style="background-color: #0ca1ab">
												<!--begin::Symbol-->
												<div class="symbol symbol-30px me-0 mb-5">
														<i class="fa-solid fa-money-bill-transfer text-light" style="font-size: 20px;">
															<span class="path1"></span>
															<span class="path2"></span>
															<span class="fw-semibold me-1 align-self-center" style="padding-bottom: 5px; padding-left:5px; font-family:sans-serif;">Dibayar</span>
														</i>
												</div>
												<!--end::Symbol-->
												<!--begin::Stats-->
												<div class="m-0">
													<a href="{{ route('statusKK.permohonan', ['status' => '8']) }}">
														<span class="text-white fw-bolder d-block fs-4x lh-1 ls-n1 mb-1 dibayarKK"></span>
														<span class="text-white fw-bold fs-7">Klik untuk Lihat</span>
													</a>
												</div>
												<!--end::Stats-->
											</div>
											<!--end::Items-->
										</div>
										<!--end::Col-->
										
										<!--begin::Col-->
										<div class="col-4">
											<!--begin::Items-->
											<div class="px-6 pt-5 card-rounded h-150px w-100 card theme-dark-bg-body bg-success">
												<!--begin::Symbol-->
												<div class="symbol symbol-30px me-0 mb-5">
														<i class="fas fa-user-check text-light" style="font-size: 20px;">
															<span class="path1"></span>
															<span class="path2"></span>
															<span class="fw-semibold me-1 align-self-center" style="padding-bottom: 5px; padding-left:5px; font-family:sans-serif;">Layak</span>
														</i>
												</div>
												<!--end::Symbol-->
												<!--begin::Stats-->
												<div class="m-0">
													<a href="{{ route('statusKK.permohonan', ['status' => '6']) }}">
														<span class="text-white fw-bolder d-block fs-4x lh-1 ls-n1 mb-1 layakKK"></span>
														<span class="text-white fw-bold fs-7">Klik untuk Lihat</span>
													</a>
												</div>
												<!--end::Stats-->
											</div>
											<!--end::Items-->
										</div>
										<!--end::Col-->

										<!--begin::Col-->
										<div class="col-4">
											<!--begin::Items-->
											<div class="px-6 pt-5 card-rounded h-150px w-100 card theme-dark-bg-body bg-danger">
												<!--begin::Symbol-->
												<div class="symbol symbol-30px me-0 mb-5">
														<i class="fa-solid fa-user-xmark text-light" style="font-size: 20px;">
															<span class="path1"></span>
															<span class="path2"></span>
															<span class="path3"></span>
															<span class="fw-semibold me-1 align-self-center" style="padding-bottom: 5px; padding-left:5px; font-family:sans-serif;">Tidak Layak</span>
														</i>
												</div>
												<!--end::Symbol-->
												<!--begin::Stats-->
												<div class="m-0">
													<a href="{{ route('statusKK.permohonan', ['status' => '7']) }}">
														<span class="text-white fw-bolder d-block fs-4x lh-1 ls-n1 mb-1 tidaklayakKK"></span>
														<span class="text-white fw-bold fs-7">Klik untuk Lihat</span>
													</a>
												</div>
												<!--end::Stats-->
											</div>
											<!--end::Items-->
										</div>
										<!--end::Col-->
									</div>
									<!--end::Row-->
								</div>

								<!--Tuntutan-->
								<div class="header">
									<h2>Tuntutan Kolej Komuniti</h2>
								</div>
								<div class="body">
									<!--begin::First Row-->
									<div class="row g-3 g-lg-6" style="text-align: center;">
										<!--begin::Col-->
										<div class="col-4">
											<!--begin::Items-->
											<div class="px-6 pt-5 card-rounded h-150px w-100 card theme-dark-bg-body" style="background-color: #787878">
												<!--begin::Symbol-->
												<div class="symbol symbol-30px me-0 mb-5">
														<i class="fas fa-list-ol text-light" style="font-size: 20px;">
															<span class="path1"></span>
															<span class="path2"></span>
															<span class="fw-semibold me-1 align-self-center" style="padding-bottom: 5px; padding-left:5px; font-family:sans-serif;">Keseluruhan</span>
														</i>
												</div>
												<!--end::Symbol-->
												<!--begin::Stats-->
												<div class="m-0">
													<a href="{{ route('keseluruhanKK.tuntutan', ['status' => '!=9']) }}">
														<span class="text-white fw-bolder d-block fs-4x lh-1 ls-n1 mb-1 keseluruhanTuntutanKK"></span>
														<span class="text-white fw-bold fs-7">Klik untuk Lihat</span>
													</a>
												</div>
												<!--end::Stats-->
											</div>
											<!--end::Items-->
										</div>
										<!--end::Col-->

										<!--begin::Col-->
										<div class="col-4">
											<!--begin::Items-->
											<div class="px-6 pt-5 card-rounded h-150px w-100 card theme-dark-bg-body bg-info">
												<!--begin::Symbol-->
												<div class="symbol symbol-30px me-0 mb-5">
														<i class="fa-solid fa-file-lines text-light" style="font-size: 20px;">
															<span class="path1"></span>
															<span class="path2"></span>
															<span class="path3"></span>
															<span class="fw-semibold me-1 align-self-center" style="padding-bottom: 5px; padding-left:5px; font-family:sans-serif;">Deraf</span>
														</i>
												</div>
												<!--end::Symbol-->
												<!--begin::Stats-->
												<div class="m-0">
													<a href="{{ route('statusKK.tuntutan', ['status' => '1']) }}">
														<span class="text-white fw-bolder d-block fs-4x lh-1 ls-n1 mb-1 derafTuntutanKK"></span>
														<span class="text-white fw-bold fs-7">Klik untuk Lihat</span>
													</a>
												</div>
												<!--end::Stats-->
											</div>
											<!--end::Items-->
										</div>
										<!--end::Col-->

										<!--begin::Col-->
										<div class="col-4">
											<!--begin::Items-->
											<div class="px-6 pt-5 card-rounded h-150px w-100 card theme-dark-bg-body" style="background-color: #186ee6">
												<!--begin::Symbol-->
												<div class="symbol symbol-30px me-0 mb-5">
														<i class="fa-solid fa-file-circle-plus text-light" style="font-size: 20px;">
															<span class="path1"></span>
															<span class="path2"></span>
															<span class="fw-semibold me-1 align-self-center" style="padding-bottom: 5px; padding-left:5px; font-family:sans-serif;">Baharu</span>
														</i>
												</div>
												<!--end::Symbol-->
												<!--begin::Stats-->
												<div class="m-0">
													<a href="{{ route('statusKK.tuntutan', ['status' => '2']) }}">
														<span class="text-white fw-bolder d-block fs-4x lh-1 ls-n1 mb-1 baharuTuntutanKK"></span>
														<span class="text-white fw-bold fs-7">Klik untuk Lihat</span>
													</a>
												</div>
												<!--end::Stats-->
											</div>
											<!--end::Items-->
										</div>
										<!--end::Col-->
									</div>
									<!--end::Row-->

									<!--begin::Second Row-->
									<div class="row g-3 g-lg-6" style="text-align: center;">
										<!--begin::Col-->
										<div class="col-4">
											<!--begin::Items-->
											<div class="px-5 pt-5 card-rounded h-150px w-100 card theme-dark-bg-body" style="background-color: #ea40acdc">
												<!--begin::Symbol-->
												<div class="symbol symbol-30px me-0 mb-5">
														<i class="fas fa-th-list text-light" style="font-size: 20px;">
															<span class="path1"></span>
															<span class="path2"></span>
															<span class="fw-semibold me-1 align-self-center" style="padding-bottom:5px; padding-left:5px; font-family:sans-serif;">Sedang Disaring</span>
														</i>
												</div>
												<!--end::Symbol-->
												<!--begin::Stats-->
												<div class="m-0">
													<a href="{{ route('statusKK.tuntutan', ['status' => '3']) }}">
														<span class="text-white fw-bolder d-block fs-4x lh-1 ls-n1 mb-1 saringanTuntutanKK"></span>
														<span class="text-white fw-bold fs-7">Klik untuk Lihat</span>
													</a>
												</div>
												<!--end::Stats-->
											</div>
											<!--end::Items-->
										</div>
										<!--end::Col-->

										<!--begin::Col-->
										<div class="col-4">
											<!--begin::Items-->
											<div class="px-6 pt-5 card-rounded h-150px w-100 card theme-dark-bg-body bg-warning">
												<!--begin::Symbol-->
												<div class="symbol symbol-30px me-0 mb-5">
														<i class="fa-solid fa-check-to-slot text-light" style="font-size: 20px;">
															<span class="path1"></span>
															<span class="path2"></span>
															<span class="path3"></span>
															<span class="fw-semibold me-1 align-self-center" style="padding-bottom: 5px; padding-left:5px; font-family:sans-serif;">Disokong</span>
														</i>
												</div>
												<!--end::Symbol-->
												<!--begin::Stats-->
												<div class="m-0">
													<a href="{{ route('statusKK.tuntutan', ['status' => '4']) }}">
														<span class="text-white fw-bolder d-block fs-4x lh-1 ls-n1 mb-1 disokongTuntutanKK"></span>
														<span class="text-white fw-bold fs-7">Klik untuk Lihat</span>
													</a>
												</div>
												<!--end::Stats-->
											</div>
											<!--end::Items-->
										</div>
										<!--end::Col-->

										<!--begin::Col-->
										<div class="col-4">
											<!--begin::Items-->
											<div class="px-6 pt-5 card-rounded h-150px w-100 card theme-dark-bg-body"  style="background-color: #d75b50">
												<!--begin::Symbol-->
												<div class="symbol symbol-30px me-0 mb-5">
														<i class="fa-solid fa-reply-all text-light" style="font-size: 20px;">
															<span class="path1"></span>
															<span class="path2"></span>
															<span class="path3"></span>
															<span class="fw-semibold me-1 align-self-center" style="padding-bottom: 5px; padding-left:5px; font-family:sans-serif;">Dikembalikan</span>
														</i>
												</div>
												<!--end::Symbol-->
												<!--begin::Stats-->
												<div class="m-0">
													<a href="{{ route('statusKK.tuntutan', ['status' => '5']) }}">
														<span class="text-white fw-bolder d-block fs-4x lh-1 ls-n1 mb-1 dikembalikanTuntutanKK"></span>
														<span class="text-white fw-bold fs-7">Klik untuk Lihat</span>
													</a>
												</div>
												<!--end::Stats-->
											</div>
											<!--end::Items-->
										</div>
										<!--end::Col-->
									</div>
									<!--end::Row-->

									<!--begin::Third Row-->
									<div class="row g-3 g-lg-6" style="text-align: center;">
										<!--begin::Col-->
										<div class="col-4">
											<!--begin::Items-->
											<div class="px-6 pt-5 card-rounded h-150px w-100 card theme-dark-bg-body" style="background-color: #0ca1ab">
												<!--begin::Symbol-->
												<div class="symbol symbol-30px me-0 mb-5">
														<i class="fa-solid fa-money-bill-transfer text-light" style="font-size: 20px;">
															<span class="path1"></span>
															<span class="path2"></span>
															<span class="fw-semibold me-1 align-self-center" style="padding-bottom: 5px; padding-left:5px; font-family:sans-serif;">Dibayar</span>
														</i>
												</div>
												<!--end::Symbol-->
												<!--begin::Stats-->
												<div class="m-0">
													<a href="{{ route('statusKK.tuntutan', ['status' => '8']) }}">
														<span class="text-white fw-bolder d-block fs-4x lh-1 ls-n1 mb-1 dibayarTuntutanKK"></span>
														<span class="text-white fw-bold fs-7">Klik untuk Lihat</span>
													</a>
												</div>
												<!--end::Stats-->
											</div>
											<!--end::Items-->
										</div>
										<!--end::Col-->
										
										<!--begin::Col-->
										<div class="col-4">
											<!--begin::Items-->
											<div class="px-6 pt-5 card-rounded h-150px w-100 card theme-dark-bg-body bg-success">
												<!--begin::Symbol-->
												<div class="symbol symbol-30px me-0 mb-5">
														<i class="fas fa-user-check text-light" style="font-size: 20px;">
															<span class="path1"></span>
															<span class="path2"></span>
															<span class="fw-semibold me-1 align-self-center" style="padding-bottom: 5px; padding-left:5px; font-family:sans-serif;">Layak</span>
														</i>
												</div>
												<!--end::Symbol-->
												<!--begin::Stats-->
												<div class="m-0">
													<a href="{{ route('statusKK.tuntutan', ['status' => '6']) }}">
														<span class="text-white fw-bolder d-block fs-4x lh-1 ls-n1 mb-1 layakTuntutanKK"></span>
														<span class="text-white fw-bold fs-7">Klik untuk Lihat</span>
													</a>
												</div>
												<!--end::Stats-->
											</div>
											<!--end::Items-->
										</div>
										<!--end::Col-->

										<!--begin::Col-->
										<div class="col-4">
											<!--begin::Items-->
											<div class="px-6 pt-5 card-rounded h-150px w-100 card theme-dark-bg-body bg-danger">
												<!--begin::Symbol-->
												<div class="symbol symbol-30px me-0 mb-5">
														<i class="fa-solid fa-user-xmark text-light" style="font-size: 20px;">
															<span class="path1"></span>
															<span class="path2"></span>
															<span class="path3"></span>
															<span class="fw-semibold me-1 align-self-center" style="padding-bottom: 5px; padding-left:5px; font-family:sans-serif;">Tidak Layak</span>
														</i>
												</div>
												<!--end::Symbol-->
												<!--begin::Stats-->
												<div class="m-0">
													<a href="{{ route('statusKK.tuntutan', ['status' => '7']) }}">
														<span class="text-white fw-bolder d-block fs-4x lh-1 ls-n1 mb-1 tidaklayakTuntutanKK"></span>
														<span class="text-white fw-bold fs-7">Klik untuk Lihat</span>
													</a>
												</div>
												<!--end::Stats-->
											</div>
											<!--end::Items-->
										</div>
										<!--end::Col-->
									</div>
									<!--end::Row-->
								</div>
							</div>

							{{-- BKOKU IPTS --}}
							<div class="tab-pane fade" id="bkokuIPTS" role="tabpanel" aria-labelledby="bkokuIPTS-tab">
								<!--Permohonan-->
								<div class="header">
									<h2>Permohonan BKOKU Institusi Pengajian Tinggi Swasta</h2>
								</div>
								<div class="body">
									<!--begin::First Row-->
									<div class="row g-3 g-lg-6" style="text-align: center;">
										<!--begin::Col-->
										<div class="col-4">
											<!--begin::Items-->
											<div class="px-6 pt-5 card-rounded h-150px w-100 card theme-dark-bg-body" style="background-color: #787878">
												<!--begin::Symbol-->
												<div class="symbol symbol-30px me-0 mb-5">
														<i class="fas fa-list-ol text-light" style="font-size: 20px;">
															<span class="path1"></span>
															<span class="path2"></span>
															<span class="fw-semibold me-1 align-self-center" style="padding-bottom: 5px; padding-left:5px; font-family:sans-serif;">Keseluruhan</span>
														</i>
												</div>
												<!--end::Symbol-->
												<!--begin::Stats-->
												<div class="m-0">
													<a href="{{ route('keseluruhanIPTS.permohonan') }}">
														<span class="text-white fw-bolder d-block fs-4x lh-1 ls-n1 mb-1 keseluruhanIPTS"></span>
														<span class="text-white fw-bold fs-7">Klik untuk Lihat</span>
													</a>
												</div>
												<!--end::Stats-->
											</div>
											<!--end::Items-->
										</div>
										<!--end::Col-->

										<!--begin::Col-->
										<div class="col-4">
											<!--begin::Items-->
											<div class="px-6 pt-5 card-rounded h-150px w-100 card theme-dark-bg-body bg-info">
												<!--begin::Symbol-->
												<div class="symbol symbol-30px me-0 mb-5">
														<i class="fa-solid fa-file-lines text-light" style="font-size: 20px;">
															<span class="path1"></span>
															<span class="path2"></span>
															<span class="path3"></span>
															<span class="fw-semibold me-1 align-self-center" style="padding-bottom: 5px; padding-left:5px; font-family:sans-serif;">Deraf</span>
														</i>
												</div>
												<!--end::Symbol-->
												<!--begin::Stats-->
												<div class="m-0">
													<a href="{{ route('statusIPTS.permohonan', ['status' => '1']) }}">
														<span class="text-white fw-bolder d-block fs-4x lh-1 ls-n1 mb-1 derafIPTS"></span>
														<span class="text-white fw-bold fs-7">Klik untuk Lihat</span>
													</a>
												</div>
												<!--end::Stats-->
											</div>
											<!--end::Items-->
										</div>
										<!--end::Col-->

										<!--begin::Col-->
										<div class="col-4">
											<!--begin::Items-->
											<div class="px-6 pt-5 card-rounded h-150px w-100 card theme-dark-bg-body" style="background-color: #186ee6">
												<!--begin::Symbol-->
												<div class="symbol symbol-30px me-0 mb-5">
														<i class="fa-solid fa-file-circle-plus text-light" style="font-size: 20px;">
															<span class="path1"></span>
															<span class="path2"></span>
															<span class="fw-semibold me-1 align-self-center" style="padding-bottom: 5px; padding-left:5px; font-family:sans-serif;">Baharu</span>
														</i>
												</div>
												<!--end::Symbol-->
												<!--begin::Stats-->
												<div class="m-0">
													<a href="{{ route('statusIPTS.permohonan', ['status' => '2']) }}">
														<span class="text-white fw-bolder d-block fs-4x lh-1 ls-n1 mb-1 baharuIPTS"></span>
														<span class="text-white fw-bold fs-7">Klik untuk Lihat</span>
													</a>
												</div>
												<!--end::Stats-->
											</div>
											<!--end::Items-->
										</div>
										<!--end::Col-->
									</div>
									<!--end::Row-->

									<!--begin::Second Row-->
									<div class="row g-3 g-lg-6" style="text-align: center;">
										<!--begin::Col-->
										<div class="col-4">
											<!--begin::Items-->
											<div class="px-5 pt-5 card-rounded h-150px w-100 card theme-dark-bg-body" style="background-color: #ea40acdc">
												<!--begin::Symbol-->
												<div class="symbol symbol-30px me-0 mb-5">
														<i class="fas fa-th-list text-light" style="font-size: 20px;">
															<span class="path1"></span>
															<span class="path2"></span>
															<span class="fw-semibold me-1 align-self-center" style="padding-bottom:5px; padding-left:5px; font-family:sans-serif;">Sedang Disaring</span>
														</i>
												</div>
												<!--end::Symbol-->
												<!--begin::Stats-->
												<div class="m-0">
													<a href="{{ route('statusIPTS.permohonan', ['status' => '3']) }}">
														<span class="text-white fw-bolder d-block fs-4x lh-1 ls-n1 mb-1 saringanIPTS"></span>
														<span class="text-white fw-bold fs-7">Klik untuk Lihat</span>
													</a>
												</div>
												<!--end::Stats-->
											</div>
											<!--end::Items-->
										</div>
										<!--end::Col-->

										<!--begin::Col-->
										<div class="col-4">
											<!--begin::Items-->
											<div class="px-6 pt-5 card-rounded h-150px w-100 card theme-dark-bg-body bg-warning">
												<!--begin::Symbol-->
												<div class="symbol symbol-30px me-0 mb-5">
														<i class="fa-solid fa-check-to-slot text-light" style="font-size: 20px;">
															<span class="path1"></span>
															<span class="path2"></span>
															<span class="path3"></span>
															<span class="fw-semibold me-1 align-self-center" style="padding-bottom: 5px; padding-left:5px; font-family:sans-serif;">Disokong</span>
														</i>
												</div>
												<!--end::Symbol-->
												<!--begin::Stats-->
												<div class="m-0">
													<a href="{{ route('statusIPTS.permohonan', ['status' => '4']) }}">
														<span class="text-white fw-bolder d-block fs-4x lh-1 ls-n1 mb-1 disokongIPTS"></span>
														<span class="text-white fw-bold fs-7">Klik untuk Lihat</span>
													</a>
												</div>
												<!--end::Stats-->
											</div>
											<!--end::Items-->
										</div>
										<!--end::Col-->

										<!--begin::Col-->
										<div class="col-4">
											<!--begin::Items-->
											<div class="px-6 pt-5 card-rounded h-150px w-100 card theme-dark-bg-body"  style="background-color: #d75b50">
												<!--begin::Symbol-->
												<div class="symbol symbol-30px me-0 mb-5">
														<i class="fa-solid fa-reply-all text-light" style="font-size: 20px;">
															<span class="path1"></span>
															<span class="path2"></span>
															<span class="path3"></span>
															<span class="fw-semibold me-1 align-self-center" style="padding-bottom: 5px; padding-left:5px; font-family:sans-serif;">Dikembalikan</span>
														</i>
												</div>
												<!--end::Symbol-->
												<!--begin::Stats-->
												<div class="m-0">
													<a href="{{ route('statusIPTS.permohonan', ['status' => '5']) }}">
														<span class="text-white fw-bolder d-block fs-4x lh-1 ls-n1 mb-1 dikembalikanIPTS"></span>
														<span class="text-white fw-bold fs-7">Klik untuk Lihat</span>
													</a>
												</div>
												<!--end::Stats-->
											</div>
											<!--end::Items-->
										</div>
										<!--end::Col-->
									</div>
									<!--end::Row-->

									<!--begin::Third Row-->
									<div class="row g-3 g-lg-6" style="text-align: center;">
										<!--begin::Col-->
										<div class="col-4">
											<!--begin::Items-->
											<div class="px-6 pt-5 card-rounded h-150px w-100 card theme-dark-bg-body" style="background-color: #0ca1ab">
												<!--begin::Symbol-->
												<div class="symbol symbol-30px me-0 mb-5">
														<i class="fa-solid fa-money-bill-transfer text-light" style="font-size: 20px;">
															<span class="path1"></span>
															<span class="path2"></span>
															<span class="fw-semibold me-1 align-self-center" style="padding-bottom: 5px; padding-left:5px; font-family:sans-serif;">Dibayar</span>
														</i>
												</div>
												<!--end::Symbol-->
												<!--begin::Stats-->
												<div class="m-0">
													<a href="{{ route('statusIPTS.permohonan', ['status' => '8']) }}">
														<span class="text-white fw-bolder d-block fs-4x lh-1 ls-n1 mb-1 dibayarIPTS"></span>
														<span class="text-white fw-bold fs-7">Klik untuk Lihat</span>
													</a>
												</div>
												<!--end::Stats-->
											</div>
											<!--end::Items-->
										</div>
										<!--end::Col-->
										
										<!--begin::Col-->
										<div class="col-4">
											<!--begin::Items-->
											<div class="px-6 pt-5 card-rounded h-150px w-100 card theme-dark-bg-body bg-success">
												<!--begin::Symbol-->
												<div class="symbol symbol-30px me-0 mb-5">
														<i class="fas fa-user-check text-light" style="font-size: 20px;">
															<span class="path1"></span>
															<span class="path2"></span>
															<span class="fw-semibold me-1 align-self-center" style="padding-bottom: 5px; padding-left:5px; font-family:sans-serif;">Layak</span>
														</i>
												</div>
												<!--end::Symbol-->
												<!--begin::Stats-->
												<div class="m-0">
													<a href="{{ route('statusIPTS.permohonan', ['status' => '6']) }}">
														<span class="text-white fw-bolder d-block fs-4x lh-1 ls-n1 mb-1 layakIPTS"></span>
														<span class="text-white fw-bold fs-7">Klik untuk Lihat</span>
													</a>
												</div>
												<!--end::Stats-->
											</div>
											<!--end::Items-->
										</div>
										<!--end::Col-->

										<!--begin::Col-->
										<div class="col-4">
											<!--begin::Items-->
											<div class="px-6 pt-5 card-rounded h-150px w-100 card theme-dark-bg-body bg-danger">
												<!--begin::Symbol-->
												<div class="symbol symbol-30px me-0 mb-5">
														<i class="fa-solid fa-user-xmark text-light" style="font-size: 20px;">
															<span class="path1"></span>
															<span class="path2"></span>
															<span class="path3"></span>
															<span class="fw-semibold me-1 align-self-center" style="padding-bottom: 5px; padding-left:5px; font-family:sans-serif;">Tidak Layak</span>
														</i>
												</div>
												<!--end::Symbol-->
												<!--begin::Stats-->
												<div class="m-0">
													<a href="{{ route('statusIPTS.permohonan', ['status' => '7']) }}">
														<span class="text-white fw-bolder d-block fs-4x lh-1 ls-n1 mb-1 tidaklayakIPTS"></span>
														<span class="text-white fw-bold fs-7">Klik untuk Lihat</span>
													</a>
												</div>
												<!--end::Stats-->
											</div>
											<!--end::Items-->
										</div>
										<!--end::Col-->
									</div>
									<!--end::Row-->
								</div>

								<!--Tuntutan-->
								<div class="header">
									<h2>Tuntutan BKOKU Institusi Pengajian Tinggi Swasta</h2>
								</div>
								<div class="body">
									<!--begin::First Row-->
									<div class="row g-3 g-lg-6" style="text-align: center;">
										<!--begin::Col-->
										<div class="col-4">
											<!--begin::Items-->
											<div class="px-6 pt-5 card-rounded h-150px w-100 card theme-dark-bg-body" style="background-color: #787878">
												<!--begin::Symbol-->
												<div class="symbol symbol-30px me-0 mb-5">
														<i class="fas fa-list-ol text-light" style="font-size: 20px;">
															<span class="path1"></span>
															<span class="path2"></span>
															<span class="fw-semibold me-1 align-self-center" style="padding-bottom: 5px; padding-left:5px; font-family:sans-serif;">Keseluruhan</span>
														</i>
												</div>
												<!--end::Symbol-->
												<!--begin::Stats-->
												<div class="m-0">
													<a href="{{ route('keseluruhanIPTS.tuntutan', ['status' => '!=9']) }}">
														<span class="text-white fw-bolder d-block fs-4x lh-1 ls-n1 mb-1 keseluruhanTuntutanIPTS"></span>
														<span class="text-white fw-bold fs-7">Klik untuk Lihat</span>
													</a>
												</div>
												<!--end::Stats-->
											</div>
											<!--end::Items-->
										</div>
										<!--end::Col-->

										<!--begin::Col-->
										<div class="col-4">
											<!--begin::Items-->
											<div class="px-6 pt-5 card-rounded h-150px w-100 card theme-dark-bg-body bg-info">
												<!--begin::Symbol-->
												<div class="symbol symbol-30px me-0 mb-5">
														<i class="fa-solid fa-file-lines text-light" style="font-size: 20px;">
															<span class="path1"></span>
															<span class="path2"></span>
															<span class="path3"></span>
															<span class="fw-semibold me-1 align-self-center" style="padding-bottom: 5px; padding-left:5px; font-family:sans-serif;">Deraf</span>
														</i>
												</div>
												<!--end::Symbol-->
												<!--begin::Stats-->
												<div class="m-0">
													<a href="{{ route('statusIPTS.tuntutan', ['status' => '1']) }}">
														<span class="text-white fw-bolder d-block fs-4x lh-1 ls-n1 mb-1 derafTuntutanIPTS"></span>
														<span class="text-white fw-bold fs-7">Klik untuk Lihat</span>
													</a>
												</div>
												<!--end::Stats-->
											</div>
											<!--end::Items-->
										</div>
										<!--end::Col-->

										<!--begin::Col-->
										<div class="col-4">
											<!--begin::Items-->
											<div class="px-6 pt-5 card-rounded h-150px w-100 card theme-dark-bg-body" style="background-color: #186ee6">
												<!--begin::Symbol-->
												<div class="symbol symbol-30px me-0 mb-5">
														<i class="fa-solid fa-file-circle-plus text-light" style="font-size: 20px;">
															<span class="path1"></span>
															<span class="path2"></span>
															<span class="fw-semibold me-1 align-self-center" style="padding-bottom: 5px; padding-left:5px; font-family:sans-serif;">Baharu</span>
														</i>
												</div>
												<!--end::Symbol-->
												<!--begin::Stats-->
												<div class="m-0">
													<a href="{{ route('statusIPTS.tuntutan', ['status' => '2']) }}">
														<span class="text-white fw-bolder d-block fs-4x lh-1 ls-n1 mb-1 baharuTuntutanIPTS"></span>
														<span class="text-white fw-bold fs-7">Klik untuk Lihat</span>
													</a>
												</div>
												<!--end::Stats-->
											</div>
											<!--end::Items-->
										</div>
										<!--end::Col-->
									</div>
									<!--end::Row-->

									<!--begin::Second Row-->
									<div class="row g-3 g-lg-6" style="text-align: center;">
										<!--begin::Col-->
										<div class="col-4">
											<!--begin::Items-->
											<div class="px-5 pt-5 card-rounded h-150px w-100 card theme-dark-bg-body" style="background-color: #ea40acdc">
												<!--begin::Symbol-->
												<div class="symbol symbol-30px me-0 mb-5">
														<i class="fas fa-th-list text-light" style="font-size: 20px;">
															<span class="path1"></span>
															<span class="path2"></span>
															<span class="fw-semibold me-1 align-self-center" style="padding-bottom:5px; padding-left:5px; font-family:sans-serif;">Sedang Disaring</span>
														</i>
												</div>
												<!--end::Symbol-->
												<!--begin::Stats-->
												<div class="m-0">
													<a href="{{ route('statusIPTS.tuntutan', ['status' => '3']) }}">
														<span class="text-white fw-bolder d-block fs-4x lh-1 ls-n1 mb-1 saringanTuntutanIPTS"></span>
														<span class="text-white fw-bold fs-7">Klik untuk Lihat</span>
													</a>
												</div>
												<!--end::Stats-->
											</div>
											<!--end::Items-->
										</div>
										<!--end::Col-->

										<!--begin::Col-->
										<div class="col-4">
											<!--begin::Items-->
											<div class="px-6 pt-5 card-rounded h-150px w-100 card theme-dark-bg-body bg-warning">
												<!--begin::Symbol-->
												<div class="symbol symbol-30px me-0 mb-5">
														<i class="fa-solid fa-check-to-slot text-light" style="font-size: 20px;">
															<span class="path1"></span>
															<span class="path2"></span>
															<span class="path3"></span>
															<span class="fw-semibold me-1 align-self-center" style="padding-bottom: 5px; padding-left:5px; font-family:sans-serif;">Disokong</span>
														</i>
												</div>
												<!--end::Symbol-->
												<!--begin::Stats-->
												<div class="m-0">
													<a href="{{ route('statusIPTS.tuntutan', ['status' => '4']) }}">
														<span class="text-white fw-bolder d-block fs-4x lh-1 ls-n1 mb-1 disokongTuntutanIPTS"></span>
														<span class="text-white fw-bold fs-7">Klik untuk Lihat</span>
													</a>
												</div>
												<!--end::Stats-->
											</div>
											<!--end::Items-->
										</div>
										<!--end::Col-->

										<!--begin::Col-->
										<div class="col-4">
											<!--begin::Items-->
											<div class="px-6 pt-5 card-rounded h-150px w-100 card theme-dark-bg-body"  style="background-color: #d75b50">
												<!--begin::Symbol-->
												<div class="symbol symbol-30px me-0 mb-5">
														<i class="fa-solid fa-reply-all text-light" style="font-size: 20px;">
															<span class="path1"></span>
															<span class="path2"></span>
															<span class="path3"></span>
															<span class="fw-semibold me-1 align-self-center" style="padding-bottom: 5px; padding-left:5px; font-family:sans-serif;">Dikembalikan</span>
														</i>
												</div>
												<!--end::Symbol-->
												<!--begin::Stats-->
												<div class="m-0">
													<a href="{{ route('statusIPTS.tuntutan', ['status' => '5']) }}">
														<span class="text-white fw-bolder d-block fs-4x lh-1 ls-n1 mb-1 dikembalikanTuntutanIPTS"></span>
														<span class="text-white fw-bold fs-7">Klik untuk Lihat</span>
													</a>
												</div>
												<!--end::Stats-->
											</div>
											<!--end::Items-->
										</div>
										<!--end::Col-->
									</div>
									<!--end::Row-->

									<!--begin::Third Row-->
									<div class="row g-3 g-lg-6" style="text-align: center;">
										<!--begin::Col-->
										<div class="col-4">
											<!--begin::Items-->
											<div class="px-6 pt-5 card-rounded h-150px w-100 card theme-dark-bg-body" style="background-color: #0ca1ab">
												<!--begin::Symbol-->
												<div class="symbol symbol-30px me-0 mb-5">
														<i class="fa-solid fa-money-bill-transfer text-light" style="font-size: 20px;">
															<span class="path1"></span>
															<span class="path2"></span>
															<span class="fw-semibold me-1 align-self-center" style="padding-bottom: 5px; padding-left:5px; font-family:sans-serif;">Dibayar</span>
														</i>
												</div>
												<!--end::Symbol-->
												<!--begin::Stats-->
												<div class="m-0">
													<a href="{{ route('statusIPTS.tuntutan', ['status' => '8']) }}">
														<span class="text-white fw-bolder d-block fs-4x lh-1 ls-n1 mb-1 dibayarTuntutanIPTS"></span>
														<span class="text-white fw-bold fs-7">Klik untuk Lihat</span>
													</a>
												</div>
												<!--end::Stats-->
											</div>
											<!--end::Items-->
										</div>
										<!--end::Col-->
										
										<!--begin::Col-->
										<div class="col-4">
											<!--begin::Items-->
											<div class="px-6 pt-5 card-rounded h-150px w-100 card theme-dark-bg-body bg-success">
												<!--begin::Symbol-->
												<div class="symbol symbol-30px me-0 mb-5">
														<i class="fas fa-user-check text-light" style="font-size: 20px;">
															<span class="path1"></span>
															<span class="path2"></span>
															<span class="fw-semibold me-1 align-self-center" style="padding-bottom: 5px; padding-left:5px; font-family:sans-serif;">Layak</span>
														</i>
												</div>
												<!--end::Symbol-->
												<!--begin::Stats-->
												<div class="m-0">
													<a href="{{ route('statusIPTS.tuntutan', ['status' => '6']) }}">
														<span class="text-white fw-bolder d-block fs-4x lh-1 ls-n1 mb-1 layakTuntutanIPTS"></span>
														<span class="text-white fw-bold fs-7">Klik untuk Lihat</span>
													</a>
												</div>
												<!--end::Stats-->
											</div>
											<!--end::Items-->
										</div>
										<!--end::Col-->

										<!--begin::Col-->
										<div class="col-4">
											<!--begin::Items-->
											<div class="px-6 pt-5 card-rounded h-150px w-100 card theme-dark-bg-body bg-danger">
												<!--begin::Symbol-->
												<div class="symbol symbol-30px me-0 mb-5">
														<i class="fa-solid fa-user-xmark text-light" style="font-size: 20px;">
															<span class="path1"></span>
															<span class="path2"></span>
															<span class="path3"></span>
															<span class="fw-semibold me-1 align-self-center" style="padding-bottom: 5px; padding-left:5px; font-family:sans-serif;">Tidak Layak</span>
														</i>
												</div>
												<!--end::Symbol-->
												<!--begin::Stats-->
												<div class="m-0">
													<a href="{{ route('statusIPTS.tuntutan', ['status' => '7']) }}">
														<span class="text-white fw-bolder d-block fs-4x lh-1 ls-n1 mb-1 tidaklayakTuntutanIPTS"></span>
														<span class="text-white fw-bold fs-7">Klik untuk Lihat</span>
													</a>
												</div>
												<!--end::Stats-->
											</div>
											<!--end::Items-->
										</div>
										<!--end::Col-->
									</div>
									<!--end::Row-->
								</div>
							</div>

							{{-- PPK --}}
							<div class="tab-pane fade" id="ppk" role="tabpanel" aria-labelledby="ppk-tab">
								<!--Permohonan-->
								<div class="header">
									<h2>Permohonan PPK</h2>
								</div>
								<div class="body">
									<!--begin::First Row-->
									<div class="row g-3 g-lg-6" style="text-align: center;">
										<!--begin::Col-->
										<div class="col-4">
											<!--begin::Items-->
											<div class="px-6 pt-5 card-rounded h-150px w-100 card theme-dark-bg-body" style="background-color: #787878">
												<!--begin::Symbol-->
												<div class="symbol symbol-30px me-0 mb-5">
														<i class="fas fa-list-ol text-light" style="font-size: 20px;">
															<span class="path1"></span>
															<span class="path2"></span>
															<span class="fw-semibold me-1 align-self-center" style="padding-bottom: 5px; padding-left:5px; font-family:sans-serif;">Keseluruhan</span>
														</i>
												</div>
												<!--end::Symbol-->
												<!--begin::Stats-->
												<div class="m-0">
													<a href="{{ route('keseluruhanP.permohonan', ['status' => '!=9']) }}">
														<span class="text-white fw-bolder d-block fs-4x lh-1 ls-n1 mb-1 keseluruhanP"></span>
														<span class="text-white fw-bold fs-7">Klik untuk Lihat</span>
													</a>
												</div>
												<!--end::Stats-->
											</div>
											<!--end::Items-->
										</div>
										<!--end::Col-->

										<!--begin::Col-->
										<div class="col-4">
											<!--begin::Items-->
											<div class="px-6 pt-5 card-rounded h-150px w-100 card theme-dark-bg-body bg-info">
												<!--begin::Symbol-->
												<div class="symbol symbol-30px me-0 mb-5">
														<i class="fa-solid fa-file-lines text-light" style="font-size: 20px;">
															<span class="path1"></span>
															<span class="path2"></span>
															<span class="path3"></span>
															<span class="fw-semibold me-1 align-self-center" style="padding-bottom: 5px; padding-left:5px; font-family:sans-serif;">Deraf</span>
														</i>
												</div>
												<!--end::Symbol-->
												<!--begin::Stats-->
												<div class="m-0">
													<a href="{{ route('statusP.permohonan', ['status' => '1']) }}">
														<span class="text-white fw-bolder d-block fs-4x lh-1 ls-n1 mb-1 derafP"></span>
														<span class="text-white fw-bold fs-7">Klik untuk Lihat</span>
													</a>
												</div>
												<!--end::Stats-->
											</div>
											<!--end::Items-->
										</div>
										<!--end::Col-->

										<!--begin::Col-->
										<div class="col-4">
											<!--begin::Items-->
											<div class="px-6 pt-5 card-rounded h-150px w-100 card theme-dark-bg-body" style="background-color: #186ee6">
												<!--begin::Symbol-->
												<div class="symbol symbol-30px me-0 mb-5">
														<i class="fa-solid fa-file-circle-plus text-light" style="font-size: 20px;">
															<span class="path1"></span>
															<span class="path2"></span>
															<span class="fw-semibold me-1 align-self-center" style="padding-bottom: 5px; padding-left:5px; font-family:sans-serif;">Baharu</span>
														</i>
												</div>
												<!--end::Symbol-->
												<!--begin::Stats-->
												<div class="m-0">
													<a href="{{ route('statusP.permohonan', ['status' => '2']) }}">
														<span class="text-white fw-bolder d-block fs-4x lh-1 ls-n1 mb-1 baharuP"></span>
														<span class="text-white fw-bold fs-7">Klik untuk Lihat</span>
													</a>
												</div>
												<!--end::Stats-->
											</div>
											<!--end::Items-->
										</div>
										<!--end::Col-->
									</div>
									<!--end::Row-->

									<!--begin::Second Row-->
									<div class="row g-3 g-lg-6" style="text-align: center;">
										<!--begin::Col-->
										<div class="col-4">
											<!--begin::Items-->
											<div class="px-6 pt-5 card-rounded h-150px w-100 card theme-dark-bg-body" style="background-color: #ea40acdc">
												<!--begin::Symbol-->
												<div class="symbol symbol-30px me-0 mb-5">
														<i class="fas fa-th-list text-light" style="font-size: 20px;">
															<span class="path1"></span>
															<span class="path2"></span>
															<span class="fw-semibold me-1 align-self-center" style="padding-bottom: 5px; padding-left:5px; font-family:sans-serif;">Sedang Disaring</span>
														</i>
												</div>
												<!--end::Symbol-->
												<!--begin::Stats-->
												<div class="m-0">
													<a href="{{ route('statusP.permohonan', ['status' => '3']) }}">
														<span class="text-white fw-bolder d-block fs-4x lh-1 ls-n1 mb-1 saringanP"></span>
														<span class="text-white fw-bold fs-7">Klik untuk Lihat</span>
													</a>
												</div>
												<!--end::Stats-->
											</div>
											<!--end::Items-->
										</div>
										<!--end::Col-->

										<!--begin::Col-->
										<div class="col-4">
											<!--begin::Items-->
											<div class="px-6 pt-5 card-rounded h-150px w-100 card theme-dark-bg-body bg-warning">
												<!--begin::Symbol-->
												<div class="symbol symbol-30px me-0 mb-5">
														<i class="fa-solid fa-check-to-slot text-light" style="font-size: 20px;">
															<span class="path1"></span>
															<span class="path2"></span>
															<span class="path3"></span>
															<span class="fw-semibold me-1 align-self-center" style="padding-bottom: 5px; padding-left:5px; font-family:sans-serif;">Disokong</span>
														</i>
												</div>
												<!--end::Symbol-->
												<!--begin::Stats-->
												<div class="m-0">
													<a href="{{ route('statusP.permohonan', ['status' => '4']) }}">
														<span class="text-white fw-bolder d-block fs-4x lh-1 ls-n1 mb-1 disokongP"></span>
														<span class="text-white fw-bold fs-7">Klik untuk Lihat</span>
													</a>
												</div>
												<!--end::Stats-->
											</div>
											<!--end::Items-->
										</div>
										<!--end::Col-->

										<!--begin::Col-->
										<div class="col-4">
											<!--begin::Items-->
											<div class="px-6 pt-5 card-rounded h-150px w-100 card theme-dark-bg-body"  style="background-color: #d75b50">
												<!--begin::Symbol-->
												<div class="symbol symbol-30px me-0 mb-5">
														<i class="fa-solid fa-reply-all text-light" style="font-size: 20px;">
															<span class="path1"></span>
															<span class="path2"></span>
															<span class="path3"></span>
															<span class="fw-semibold me-1 align-self-center" style="padding-bottom: 5px; padding-left:5px; font-family:sans-serif;">Dikembalikan</span>
														</i>
												</div>
												<!--end::Symbol-->
												<!--begin::Stats-->
												<div class="m-0">
													<a href="{{ route('statusP.permohonan', ['status' => '5']) }}">
														<span class="text-white fw-bolder d-block fs-4x lh-1 ls-n1 mb-1 dikembalikanP"></span>
														<span class="text-white fw-bold fs-7">Klik untuk Lihat</span>
													</a>
												</div>
												<!--end::Stats-->
											</div>
											<!--end::Items-->
										</div>
										<!--end::Col-->
									</div>
									<!--end::Row-->

									<!--begin::Third Row-->
									<div class="row g-3 g-lg-6" style="text-align: center;">
										<!--begin::Col-->
										<div class="col-4">
											<!--begin::Items-->
											<div class="px-6 pt-5 card-rounded h-150px w-100 card theme-dark-bg-body" style="background-color: #0ca1ab">
												<!--begin::Symbol-->
												<div class="symbol symbol-30px me-0 mb-5">
														<i class="fa-solid fa-money-bill-transfer text-light" style="font-size: 20px;">
															<span class="path1"></span>
															<span class="path2"></span>
															<span class="fw-semibold me-1 align-self-center" style="padding-bottom: 5px; padding-left:5px; font-family:sans-serif;">Dibayar</span>
														</i>
												</div>
												<!--end::Symbol-->
												<!--begin::Stats-->
												<div class="m-0">
													<a href="{{ route('statusP.permohonan', ['status' => '8']) }}">
														<span class="text-white fw-bolder d-block fs-4x lh-1 ls-n1 mb-1 dibayarP"></span>
														<span class="text-white fw-bold fs-7">Klik untuk Lihat</span>
													</a>
												</div>
												<!--end::Stats-->
											</div>
											<!--end::Items-->
										</div>
										<!--end::Col-->
										
										<!--begin::Col-->
										<div class="col-4">
											<!--begin::Items-->
											<div class="px-6 pt-5 card-rounded h-150px w-100 card theme-dark-bg-body bg-success">
												<!--begin::Symbol-->
												<div class="symbol symbol-30px me-0 mb-5">
														<i class="fas fa-user-check text-light" style="font-size: 20px;">
															<span class="path1"></span>
															<span class="path2"></span>
															<span class="fw-semibold me-1 align-self-center" style="padding-bottom: 5px; padding-left:5px; font-family:sans-serif;">Layak</span>
														</i>
												</div>
												<!--end::Symbol-->
												<!--begin::Stats-->
												<div class="m-0">
													<a href="{{ route('statusP.permohonan', ['status' => '6']) }}">
														<span class="text-white fw-bolder d-block fs-4x lh-1 ls-n1 mb-1 layakP"></span>
														<span class="text-white fw-bold fs-7">Klik untuk Lihat</span>
													</a>
												</div>
												<!--end::Stats-->
											</div>
											<!--end::Items-->
										</div>
										<!--end::Col-->

										<!--begin::Col-->
										<div class="col-4">
											<!--begin::Items-->
											<div class="px-6 pt-5 card-rounded h-150px w-100 card theme-dark-bg-body bg-danger">
												<!--begin::Symbol-->
												<div class="symbol symbol-30px me-0 mb-5">
														<i class="fa-solid fa-user-xmark text-light" style="font-size: 20px;">
															<span class="path1"></span>
															<span class="path2"></span>
															<span class="path3"></span>
															<span class="fw-semibold me-1 align-self-center" style="padding-bottom: 5px; padding-left:5px; font-family:sans-serif;">Tidak Layak</span>
														</i>
												</div>
												<!--end::Symbol-->
												<!--begin::Stats-->
												<div class="m-0">
													<a href="{{ route('statusP.permohonan', ['status' => '7']) }}">
														<span class="text-white fw-bolder d-block fs-4x lh-1 ls-n1 mb-1 tidaklayakP"></span>
														<span class="text-white fw-bold fs-7">Klik untuk Lihat</span>
													</a>
												</div>
												<!--end::Stats-->
											</div>
											<!--end::Items-->
										</div>
										<!--end::Col-->
									</div>
									<!--end::Row-->
								</div>

								<!--Tuntutan-->
								<div class="header">
									<h2>Tuntutan PPK</h2>
								</div>
								<div class="body">
									<!--begin::First Row-->
									<div class="row g-3 g-lg-6" style="text-align: center;">
										<!--begin::Col-->
										<div class="col-4">
											<!--begin::Items-->
											<div class="px-6 pt-5 card-rounded h-150px w-100 card theme-dark-bg-body" style="background-color: #787878">
												<!--begin::Symbol-->
												<div class="symbol symbol-30px me-0 mb-5">
														<i class="fas fa-list-ol text-light" style="font-size: 20px;">
															<span class="path1"></span>
															<span class="path2"></span>
															<span class="fw-semibold me-1 align-self-center" style="padding-bottom: 5px; padding-left:5px; font-family:sans-serif;">Keseluruhan</span>
														</i>
												</div>
												<!--end::Symbol-->
												<!--begin::Stats-->
												<div class="m-0">
													<a href="{{ route('keseluruhanP.tuntutan', ['status' => '!=9']) }}">
														<span class="text-white fw-bolder d-block fs-4x lh-1 ls-n1 mb-1 keseluruhanTP"></span>
														<span class="text-white fw-bold fs-7">Klik untuk Lihat</span>
													</a>
												</div>
												<!--end::Stats-->
											</div>
											<!--end::Items-->
										</div>
										<!--end::Col-->

										<!--begin::Col-->
										<div class="col-4">
											<!--begin::Items-->
											<div class="px-6 pt-5 card-rounded h-150px w-100 card theme-dark-bg-body bg-info">
												<!--begin::Symbol-->
												<div class="symbol symbol-30px me-0 mb-5">
														<i class="fa-solid fa-file-lines text-light" style="font-size: 20px;">
															<span class="path1"></span>
															<span class="path2"></span>
															<span class="path3"></span>
															<span class="fw-semibold me-1 align-self-center" style="padding-bottom: 5px; padding-left:5px; font-family:sans-serif;">Deraf</span>
														</i>
												</div>
												<!--end::Symbol-->
												<!--begin::Stats-->
												<div class="m-0">
													<a href="{{ route('statusP.tuntutan', ['status' => '1']) }}">
														<span class="text-white fw-bolder d-block fs-4x lh-1 ls-n1 mb-1 derafTP"></span>
														<span class="text-white fw-bold fs-7">Klik untuk Lihat</span>
													</a>
												</div>
												<!--end::Stats-->
											</div>
											<!--end::Items-->
										</div>
										<!--end::Col-->

										<!--begin::Col-->
										<div class="col-4">
											<!--begin::Items-->
											<div class="px-6 pt-5 card-rounded h-150px w-100 card theme-dark-bg-body" style="background-color: #186ee6">
												<!--begin::Symbol-->
												<div class="symbol symbol-30px me-0 mb-5">
														<i class="fa-solid fa-file-circle-plus text-light" style="font-size: 20px;">
															<span class="path1"></span>
															<span class="path2"></span>
															<span class="fw-semibold me-1 align-self-center" style="padding-bottom: 5px; padding-left:5px; font-family:sans-serif;">Baharu</span>
														</i>
												</div>
												<!--end::Symbol-->
												<!--begin::Stats-->
												<div class="m-0">
													<a href="{{ route('statusP.tuntutan', ['status' => '2']) }}">
														<span class="text-white fw-bolder d-block fs-4x lh-1 ls-n1 mb-1 baharuTP"></span>
														<span class="text-white fw-bold fs-7">Klik untuk Lihat</span>
													</a>
												</div>
												<!--end::Stats-->
											</div>
											<!--end::Items-->
										</div>
										<!--end::Col-->
									</div>
									<!--end::Row-->

									<!--begin::Second Row-->
									<div class="row g-3 g-lg-6" style="text-align: center;">
										<!--begin::Col-->
										<div class="col-4">
											<!--begin::Items-->
											<div class="px-6 pt-5 card-rounded h-150px w-100 card theme-dark-bg-body" style="background-color: #ea40acdc">
												<!--begin::Symbol-->
												<div class="symbol symbol-30px me-0 mb-5">
														<i class="fas fa-th-list text-light" style="font-size: 20px;">
															<span class="path1"></span>
															<span class="path2"></span>
															<span class="fw-semibold me-1 align-self-center" style="padding-bottom: 5px; padding-left:5px; font-family:sans-serif;">Sedang Disaring</span>
														</i>
												</div>
												<!--end::Symbol-->
												<!--begin::Stats-->
												<div class="m-0">
													<a href="{{ route('statusP.tuntutan', ['status' => '3']) }}">
														<span class="text-white fw-bolder d-block fs-4x lh-1 ls-n1 mb-1 saringanTP"></span>
														<span class="text-white fw-bold fs-7">Klik untuk Lihat</span>
													</a>
												</div>
												<!--end::Stats-->
											</div>
											<!--end::Items-->
										</div>
										<!--end::Col-->

										<!--begin::Col-->
										<div class="col-4">
											<!--begin::Items-->
											<div class="px-6 pt-5 card-rounded h-150px w-100 card theme-dark-bg-body bg-warning">
												<!--begin::Symbol-->
												<div class="symbol symbol-30px me-0 mb-5">
														<i class="fa-solid fa-check-to-slot text-light" style="font-size: 20px;">
															<span class="path1"></span>
															<span class="path2"></span>
															<span class="path3"></span>
															<span class="fw-semibold me-1 align-self-center" style="padding-bottom: 5px; padding-left:5px; font-family:sans-serif;">Disokong</span>
														</i>
												</div>
												<!--end::Symbol-->
												<!--begin::Stats-->
												<div class="m-0">
													<a href="{{ route('statusP.tuntutan', ['status' => '4']) }}">
														<span class="text-white fw-bolder d-block fs-4x lh-1 ls-n1 mb-1 disokongTP"></span>
														<span class="text-white fw-bold fs-7">Klik untuk Lihat</span>
													</a>
												</div>
												<!--end::Stats-->
											</div>
											<!--end::Items-->
										</div>
										<!--end::Col-->

										<!--begin::Col-->
										<div class="col-4">
											<!--begin::Items-->
											<div class="px-6 pt-5 card-rounded h-150px w-100 card theme-dark-bg-body"  style="background-color: #d75b50">
												<!--begin::Symbol-->
												<div class="symbol symbol-30px me-0 mb-5">
														<i class="fa-solid fa-reply-all text-light" style="font-size: 20px;">
															<span class="path1"></span>
															<span class="path2"></span>
															<span class="path3"></span>
															<span class="fw-semibold me-1 align-self-center" style="padding-bottom: 5px; padding-left:5px; font-family:sans-serif;">Dikembalikan</span>
														</i>
												</div>
												<!--end::Symbol-->
												<!--begin::Stats-->
												<div class="m-0">
													<a href="{{ route('statusP.tuntutan', ['status' => '5']) }}">
														<span class="text-white fw-bolder d-block fs-4x lh-1 ls-n1 mb-1 dikembalikanTP"></span>
														<span class="text-white fw-bold fs-7">Klik untuk Lihat</span>
													</a>
												</div>
												<!--end::Stats-->
											</div>
											<!--end::Items-->
										</div>
										<!--end::Col-->
									</div>
									<!--end::Row-->

									<!--begin::Third Row-->
									<div class="row g-3 g-lg-6" style="text-align: center;">
										<!--begin::Col-->
										<div class="col-4">
											<!--begin::Items-->
											<div class="px-6 pt-5 card-rounded h-150px w-100 card theme-dark-bg-body" style="background-color: #0ca1ab">
												<!--begin::Symbol-->
												<div class="symbol symbol-30px me-0 mb-5">
														<i class="fa-solid fa-money-bill-transfer text-light" style="font-size: 20px;">
															<span class="path1"></span>
															<span class="path2"></span>
															<span class="fw-semibold me-1 align-self-center" style="padding-bottom: 5px; padding-left:5px; font-family:sans-serif;">Dibayar</span>
														</i>
												</div>
												<!--end::Symbol-->
												<!--begin::Stats-->
												<div class="m-0">
													<a href="{{ route('statusP.tuntutan', ['status' => '8']) }}">
														<span class="text-white fw-bolder d-block fs-4x lh-1 ls-n1 mb-1 dibayarTP"></span>
														<span class="text-white fw-bold fs-7">Klik untuk Lihat</span>
													</a>
												</div>
												<!--end::Stats-->
											</div>
											<!--end::Items-->
										</div>
										<!--end::Col-->
										
										<!--begin::Col-->
										<div class="col-4">
											<!--begin::Items-->
											<div class="px-6 pt-5 card-rounded h-150px w-100 card theme-dark-bg-body bg-success">
												<!--begin::Symbol-->
												<div class="symbol symbol-30px me-0 mb-5">
														<i class="fas fa-user-check text-light" style="font-size: 20px;">
															<span class="path1"></span>
															<span class="path2"></span>
															<span class="fw-semibold me-1 align-self-center" style="padding-bottom: 5px; padding-left:5px; font-family:sans-serif;">Layak</span>
														</i>
												</div>
												<!--end::Symbol-->
												<!--begin::Stats-->
												<div class="m-0">
													<a href="{{ route('statusP.tuntutan', ['status' => '6']) }}">
														<span class="text-white fw-bolder d-block fs-4x lh-1 ls-n1 mb-1 layakTP"></span>
														<span class="text-white fw-bold fs-7">Klik untuk Lihat</span>
													</a>
												</div>
												<!--end::Stats-->
											</div>
											<!--end::Items-->
										</div>
										<!--end::Col-->

										<!--begin::Col-->
										<div class="col-4">
											<!--begin::Items-->
											<div class="px-6 pt-5 card-rounded h-150px w-100 card theme-dark-bg-body bg-danger">
												<!--begin::Symbol-->
												<div class="symbol symbol-30px me-0 mb-5">
														<i class="fa-solid fa-user-xmark text-light" style="font-size: 20px;">
															<span class="path1"></span>
															<span class="path2"></span>
															<span class="path3"></span>
															<span class="fw-semibold me-1 align-self-center" style="padding-bottom: 5px; padding-left:5px; font-family:sans-serif;">Tidak Layak</span>
														</i>
												</div>
												<!--end::Symbol-->
												<!--begin::Stats-->
												<div class="m-0">
													<a href="{{ route('statusP.tuntutan', ['status' => '7']) }}">
														<span class="text-white fw-bolder d-block fs-4x lh-1 ls-n1 mb-1 tidaklayakTP"></span>
														<span class="text-white fw-bold fs-7">Klik untuk Lihat</span>
													</a>
												</div>
												<!--end::Stats-->
											</div>
											<!--end::Items-->
										</div>
										<!--end::Col-->
									</div>
									<!--end::Row-->
								</div>
							</div>

						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<script>
        $(document).ready(function() {
			$.ajax({
				url: '{{ route("dashboard.getPermohonanIPTS") }}', // Replace with actual server URL
				type: 'GET',
				success: function(response) {
					var keseluruhanIPTS = response.keseluruhanIPTS ?? 0;
					var derafIPTS = response.derafIPTS ?? 0;
					var baharuIPTS = response.baharuIPTS ?? 0;
					var saringanIPTS = response.saringanIPTS ?? 0;
					var disokongIPTS = response.disokongIPTS ?? 0;
					var dikembalikanIPTS = response.dikembalikanIPTS ?? 0;
					var layakIPTS = response.layakIPTS ?? 0;
					var tidaklayakIPTS = response.tidaklayakIPTS ?? 0;
					var dibayarIPTS = response.dibayarIPTS ?? 0;

					// Update HTML content with the obtained variables
					$(".keseluruhanIPTS").text(keseluruhanIPTS);
					$(".derafIPTS").text(derafIPTS);
					$(".baharuIPTS").text(baharuIPTS);
					$(".saringanIPTS").text(saringanIPTS);
					$(".disokongIPTS").text(disokongIPTS);
					$(".dikembalikanIPTS").text(dikembalikanIPTS);
					$(".layakIPTS").text(layakIPTS);
					$(".tidaklayakIPTS").text(tidaklayakIPTS);
					$(".dibayarIPTS").text(dibayarIPTS);
				},
				error: function(xhr, status, error) {
					console.error(error);
				}
			});

			$.ajax({
				url: '{{ route("dashboard.getTuntutanIPTS") }}', // Replace with actual server URL
				type: 'GET',
				success: function(response) {
					var keseluruhanTuntutanIPTS = response.keseluruhanTuntutanIPTS ?? 0;
					var derafTuntutanIPTS = response.derafTuntutanIPTS ?? 0;
					var baharuTuntutanIPTS = response.baharuTuntutanIPTS ?? 0;
					var saringanTuntutanIPTS = response.saringanTuntutanIPTS ?? 0;
					var disokongTuntutanIPTS = response.disokongTuntutanIPTS ?? 0;
					var dikembalikanTuntutanIPTS = response.dikembalikanTuntutanIPTS ?? 0;
					var layakTuntutanIPTS = response.layakTuntutanIPTS ?? 0;
					var tidaklayakTuntutanIPTS = response.tidaklayakTuntutanIPTS ?? 0;
					var dibayarTuntutanIPTS = response.dibayarTuntutanIPTS ?? 0;

					// Update HTML content with the obtained variables
					$(".keseluruhanTuntutanIPTS").text(keseluruhanTuntutanIPTS);
					$(".derafTuntutanIPTS").text(derafTuntutanIPTS);
					$(".baharuTuntutanIPTS").text(baharuTuntutanIPTS);
					$(".saringanTuntutanIPTS").text(saringanTuntutanIPTS);
					$(".disokongTuntutanIPTS").text(disokongTuntutanIPTS);
					$(".dikembalikanTuntutanIPTS").text(dikembalikanTuntutanIPTS);
					$(".layakTuntutanIPTS").text(layakTuntutanIPTS);
					$(".tidaklayakTuntutanIPTS").text(tidaklayakTuntutanIPTS);
					$(".dibayarTuntutanIPTS").text(dibayarTuntutanIPTS);
				},
				error: function(xhr, status, error) {
					console.error(error);
				}
			});

			$.ajax({
				url: '{{ route("dashboard.getPermohonanPOLI") }}', // Replace with actual server URL
				type: 'GET',
				success: function(response) {
					var keseluruhanPOLI = response.keseluruhanPOLI ?? 0;
					var derafPOLI = response.derafPOLI ?? 0;
					var baharuPOLI = response.baharuPOLI ?? 0;
					var saringanPOLI = response.saringanPOLI ?? 0;
					var disokongPOLI = response.disokongPOLI ?? 0;
					var dikembalikanPOLI = response.dikembalikanPOLI ?? 0;
					var layakPOLI = response.layakPOLI ?? 0;
					var tidaklayakPOLI = response.tidaklayakPOLI ?? 0;
					var dibayarPOLI = response.dibayarPOLI ?? 0;

					// Update HTML content with the obtained variables
					$(".keseluruhanPOLI").text(keseluruhanPOLI);
					$(".derafPOLI").text(derafPOLI);
					$(".baharuPOLI").text(baharuPOLI);
					$(".saringanPOLI").text(saringanPOLI);
					$(".disokongPOLI").text(disokongPOLI);
					$(".dikembalikanPOLI").text(dikembalikanPOLI);
					$(".layakPOLI").text(layakPOLI);
					$(".tidaklayakPOLI").text(tidaklayakPOLI);
					$(".dibayarPOLI").text(dibayarPOLI);
				},
				error: function(xhr, status, error) {
					console.error(error);
				}
			});

			$.ajax({
				url: '{{ route("dashboard.getTuntutanPOLI") }}', // Update route name
				type: 'GET',
				success: function(response) {
					var keseluruhanTuntutanPOLI = response.keseluruhanTuntutanPOLI ?? 0;
					var derafTuntutanPOLI = response.derafTuntutanPOLI ?? 0;
					var baharuTuntutanPOLI = response.baharuTuntutanPOLI ?? 0;
					var saringanTuntutanPOLI = response.saringanTuntutanPOLI ?? 0;
					var disokongTuntutanPOLI = response.disokongTuntutanPOLI ?? 0;
					var dikembalikanTuntutanPOLI = response.dikembalikanTuntutanPOLI ?? 0;
					var layakTuntutanPOLI = response.layakTuntutanPOLI ?? 0;
					var tidaklayakTuntutanPOLI = response.tidaklayakTuntutanPOLI ?? 0;
					var dibayarTuntutanPOLI = response.dibayarTuntutanPOLI ?? 0;

					// Update HTML content with the obtained variables
					$(".keseluruhanTuntutanPOLI").text(keseluruhanTuntutanPOLI);
					$(".derafTuntutanPOLI").text(derafTuntutanPOLI);
					$(".baharuTuntutanPOLI").text(baharuTuntutanPOLI);
					$(".saringanTuntutanPOLI").text(saringanTuntutanPOLI);
					$(".disokongTuntutanPOLI").text(disokongTuntutanPOLI);
					$(".dikembalikanTuntutanPOLI").text(dikembalikanTuntutanPOLI);
					$(".layakTuntutanPOLI").text(layakTuntutanPOLI);
					$(".tidaklayakTuntutanPOLI").text(tidaklayakTuntutanPOLI);
					$(".dibayarTuntutanPOLI").text(dibayarTuntutanPOLI);
				},
				error: function(xhr, status, error) {
					console.error(error);
				}
			});

			$.ajax({
				url: '{{ route("dashboard.getPermohonanKK") }}', // Update route name
				type: 'GET',
				success: function(response) {
					var keseluruhanKK = response.keseluruhanKK ?? 0;
					var derafKK = response.derafKK ?? 0;
					var baharuKK = response.baharuKK ?? 0;
					var saringanKK = response.saringanKK ?? 0;
					var disokongKK = response.disokongKK ?? 0;
					var dikembalikanKK = response.dikembalikanKK ?? 0;
					var layakKK = response.layakKK ?? 0;
					var tidaklayakKK = response.tidaklayakKK ?? 0;
					var dibayarKK = response.dibayarKK ?? 0;

					// Update HTML content with the obtained variables
					$(".keseluruhanKK").text(keseluruhanKK);
					$(".derafKK").text(derafKK);
					$(".baharuKK").text(baharuKK);
					$(".saringanKK").text(saringanKK);
					$(".disokongKK").text(disokongKK);
					$(".dikembalikanKK").text(dikembalikanKK);
					$(".layakKK").text(layakKK);
					$(".tidaklayakKK").text(tidaklayakKK);
					$(".dibayarKK").text(dibayarKK);
				},
				error: function(xhr, status, error) {
					console.error(error);
				}
			});

			$.ajax({
				url: '{{ route("dashboard.getTuntutanKK") }}', // Update route name
				type: 'GET',
				success: function(response) {
					var keseluruhanTuntutanKK = response.keseluruhanTuntutanKK ?? 0;
					var derafTuntutanKK = response.derafTuntutanKK ?? 0;
					var baharuTuntutanKK = response.baharuTuntutanKK ?? 0;
					var saringanTuntutanKK = response.saringanTuntutanKK ?? 0;
					var disokongTuntutanKK = response.disokongTuntutanKK ?? 0;
					var dikembalikanTuntutanKK = response.dikembalikanTuntutanKK ?? 0;
					var layakTuntutanKK = response.layakTuntutanKK ?? 0;
					var tidaklayakTuntutanKK = response.tidaklayakTuntutanKK ?? 0;
					var dibayarTuntutanKK = response.dibayarTuntutanKK ?? 0;

					// Update HTML content with the obtained variables
					$(".keseluruhanTuntutanKK").text(keseluruhanTuntutanKK);
					$(".derafTuntutanKK").text(derafTuntutanKK);
					$(".baharuTuntutanKK").text(baharuTuntutanKK);
					$(".saringanTuntutanKK").text(saringanTuntutanKK);
					$(".disokongTuntutanKK").text(disokongTuntutanKK);
					$(".dikembalikanTuntutanKK").text(dikembalikanTuntutanKK);
					$(".layakTuntutanKK").text(layakTuntutanKK);
					$(".tidaklayakTuntutanKK").text(tidaklayakTuntutanKK);
					$(".dibayarTuntutanKK").text(dibayarTuntutanKK);
				},
				error: function(xhr, status, error) {
					console.error(error);
				}
			});

			$.ajax({
				url: '{{ route("dashboard.getPermohonanUA") }}', // Update route name
				type: 'GET',
				success: function(response) {
					var keseluruhanUA = response.keseluruhanUA ?? 0;
					var derafUA = response.derafUA ?? 0;
					var baharuUA = response.baharuUA ?? 0;
					var saringanUA = response.saringanUA ?? 0;
					var disokongUA = response.disokongUA ?? 0;
					var dikembalikanUA = response.dikembalikanUA ?? 0;
					var layakUA = response.layakUA ?? 0;
					var tidaklayakUA = response.tidaklayakUA ?? 0;
					var dibayarUA = response.dibayarUA ?? 0;

					// Update HTML content with the obtained variables
					$(".keseluruhanUA").text(keseluruhanUA);
					$(".derafUA").text(derafUA);
					$(".baharuUA").text(baharuUA);
					$(".saringanUA").text(saringanUA);
					$(".disokongUA").text(disokongUA);
					$(".dikembalikanUA").text(dikembalikanUA);
					$(".layakUA").text(layakUA);
					$(".tidaklayakUA").text(tidaklayakUA);
					$(".dibayarUA").text(dibayarUA);
				},
				error: function(xhr, status, error) {
					console.error(error);
				}
			});

			$.ajax({
				url: '{{ route("dashboard.getTuntutanUA") }}', // Update route name
				type: 'GET',
				success: function(response) {
					var keseluruhanTuntutanUA = response.keseluruhanTuntutanUA ?? 0;
					var derafTuntutanUA = response.derafTuntutanUA ?? 0;
					var baharuTuntutanUA = response.baharuTuntutanUA ?? 0;
					var saringanTuntutanUA = response.saringanTuntutanUA ?? 0;
					var disokongTuntutanUA = response.disokongTuntutanUA ?? 0;
					var dikembalikanTuntutanUA = response.dikembalikanTuntutanUA ?? 0;
					var layakTuntutanUA = response.layakTuntutanUA ?? 0;
					var tidaklayakTuntutanUA = response.tidaklayakTuntutanUA ?? 0;
					var dibayarTuntutanUA = response.dibayarTuntutanUA ?? 0;

					// Update HTML content with the obtained variables
					$(".keseluruhanTuntutanUA").text(keseluruhanTuntutanUA);
					$(".derafTuntutanUA").text(derafTuntutanUA);
					$(".baharuTuntutanUA").text(baharuTuntutanUA);
					$(".saringanTuntutanUA").text(saringanTuntutanUA);
					$(".disokongTuntutanUA").text(disokongTuntutanUA);
					$(".dikembalikanTuntutanUA").text(dikembalikanTuntutanUA);
					$(".layakTuntutanUA").text(layakTuntutanUA);
					$(".tidaklayakTuntutanUA").text(tidaklayakTuntutanUA);
					$(".dibayarTuntutanUA").text(dibayarTuntutanUA);
				},
				error: function(xhr, status, error) {
					console.error(error);
				}
			});

			$.ajax({
				url: '{{ route("dashboard.getPermohonanP") }}',
				type: 'GET',
				success: function(response) {
					var keseluruhanP = response.keseluruhanP ?? 0;
					var derafP = response.derafP ?? 0;
					var baharuP = response.baharuP ?? 0;
					var saringanP = response.saringanP ?? 0;
					var disokongP = response.disokongP ?? 0;
					var dikembalikanP = response.dikembalikanP ?? 0;
					var layakP = response.layakP ?? 0;
					var tidaklayakP = response.tidaklayakP ?? 0;
					var dibayarP = response.dibayarP ?? 0;

					// Update HTML content with the obtained variables
					$(".keseluruhanP").text(keseluruhanP);
					$(".derafP").text(derafP);
					$(".baharuP").text(baharuP);
					$(".saringanP").text(saringanP);
					$(".disokongP").text(disokongP);
					$(".dikembalikanP").text(dikembalikanP);
					$(".layakP").text(layakP);
					$(".tidaklayakP").text(tidaklayakP);
					$(".dibayarP").text(dibayarP);
				},
				error: function(xhr, status, error) {
					console.error(error);
				}
			});

			$.ajax({
				url: '{{ route("dashboard.getTuntutanP") }}', // Update route name
				type: 'GET',
				success: function(response) {
					var keseluruhanTP = response.keseluruhanTP ?? 0;
					var derafTP = response.derafTP ?? 0;
					var baharuTP = response.baharuTP ?? 0;
					var saringanTP = response.saringanTP ?? 0;
					var disokongTP = response.disokongTP ?? 0;
					var dikembalikanTP = response.dikembalikanTP ?? 0;
					var layakTP = response.layakTP ?? 0;
					var tidaklayakTP = response.tidaklayakTP ?? 0;
					var dibayarTP = response.dibayarTP ?? 0;

					// Update HTML content with the obtained variables
					$(".keseluruhanTP").text(keseluruhanTP);
					$(".derafTP").text(derafTP);
					$(".baharuTP").text(baharuTP);
					$(".saringanTP").text(saringanTP);
					$(".disokongTP").text(disokongTP);
					$(".dikembalikanTP").text(dikembalikanTP);
					$(".layakTP").text(layakTP);
					$(".tidaklayakTP").text(tidaklayakTP);
					$(".dibayarTP").text(dibayarTP);
				},
				error: function(xhr, status, error) {
					console.error(error);
				}
			});


		});
    </script>	

</x-default-layout>

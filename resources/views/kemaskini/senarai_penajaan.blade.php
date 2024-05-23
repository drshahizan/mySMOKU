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
							<h2>Senarai Status Penajaan<br><small>Sila klik tab BKOKU IPTS, BKOKU POLI, BKOKU KK, BKOKU UA atau PPK untuk lihat jumlah terperinci.</small></h2>
						</div>

						{{-- top nav bar --}}
						<ul class="nav nav-tabs" id="myTab" role="tablist">
							<li class="nav-item" role="presentation">
								<button class="nav-link active" id="keseluruhan-tab" data-toggle="tab" data-target="#keseluruhan" type="button" role="tab" aria-controls="keseluruhan" aria-selected="true">KESELURUHAN</button>
							</li>
							<li class="nav-item" role="presentation">
								<button class="nav-link" id="bkokuIPTS-tab" data-toggle="tab" data-target="#bkokuIPTS" type="button" role="tab" aria-controls="bkokuIPTS" aria-selected="true">BKOKU IPTS</button>
							</li>
							<li class="nav-item" role="presentation">
								<button class="nav-link" id="bkokuPOLI-tab" data-toggle="tab" data-target="#bkokuPOLI" type="button" role="tab" aria-controls="bkokuPOLI" aria-selected="true">BKOKU POLI</button>
							</li>
							<li class="nav-item" role="presentation">
								<button class="nav-link" id="bkokuKK-tab" data-toggle="tab" data-target="#bkokuKK" type="button" role="tab" aria-controls="bkokuKK" aria-selected="true">BKOKU KK</button>
							</li>
							<li class="nav-item" role="presentation">
							<button class="nav-link" id="bkokuUA-tab" data-toggle="tab" data-target="#bkokuUA" type="button" role="tab" aria-controls="bkokuUA" aria-selected="true">BKOKU UA</button>
							</li>
							<li class="nav-item" role="presentation">
								<button class="nav-link" id="ppk-tab" data-toggle="tab" data-target="#ppk" type="button" role="tab" aria-controls="ppk" aria-selected="false">PPK</button>
							</li>
						</ul>

						<div class="tab-content" id="myTabContent">
							{{-- KESELURUHAN --}}
							<div class="tab-pane fade show active" id="keseluruhan" role="tabpanel" aria-labelledby="keseluruhan-tab">
								<!--Permohonan-->
								<div class="header">
									<h2>Senarai Penajaan Keseluruhan</h2>
								</div>
								<div class="body">
									<!--begin:: Row-->
									<div class="row g-3 g-lg-6" style="text-align: center;">
										<!--begin::Col-->
										<div class="col-6">
											<!--begin::Items-->
											<div class="px-6 pt-5 card-rounded h-150px w-100 card theme-dark-bg-body" style="background-color: #0ca1ab">
												<!--begin::Symbol-->
												<div class="symbol symbol-30px me-0 mb-5">
														<i class="fa-solid fa-money-bill-transfer text-light" style="font-size: 20px;">
															<span class="path1"></span>
															<span class="path2"></span>
															<span class="fw-semibold me-1 align-self-center" style="padding-bottom: 5px; padding-left:5px; font-family:sans-serif;">Senarai Pelajar Semester Akhir</span>
														</i>
												</div>
												<!--end::Symbol-->
												<!--begin::Stats-->
												<div class="m-0">
													<a href="{{ route('status.keseluruhan') }}">
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
										<div class="col-6">
											<!--begin::Items-->
											<div class="px-6 pt-5 card-rounded h-150px w-100 card theme-dark-bg-body bg-danger">
												<!--begin::Symbol-->
												<div class="symbol symbol-30px me-0 mb-5">
														<i class="fa-solid fa-user-xmark text-light" style="font-size: 20px;">
															<span class="path1"></span>
															<span class="path2"></span>
															<span class="path3"></span>
															<span class="fw-semibold me-1 align-self-center" style="padding-bottom: 5px; padding-left:5px; font-family:sans-serif;">Senarai Pelajar Telah Tamat</span>
														</i>
												</div>
												<!--end::Symbol-->
												<!--begin::Stats-->
												<div class="m-0">
													<a href="{{ route('status.keseluruhan.tamat') }}">
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
							</div>

							{{-- BKOKU IPTS --}}
							<div class="tab-pane fade" id="bkokuIPTS" role="tabpanel" aria-labelledby="bkokuIPTS-tab">
								<!--Permohonan-->
								<div class="header">
									<h2>Senarai Penajaan</h2>
								</div>
								<div class="body">
									<!--begin:: Row-->
									<div class="row g-3 g-lg-6" style="text-align: center;">
										<!--begin::Col-->
										<div class="col-6">
											<!--begin::Items-->
											<div class="px-6 pt-5 card-rounded h-150px w-100 card theme-dark-bg-body" style="background-color: #0ca1ab">
												<!--begin::Symbol-->
												<div class="symbol symbol-30px me-0 mb-5">
														<i class="fa-solid fa-money-bill-transfer text-light" style="font-size: 20px;">
															<span class="path1"></span>
															<span class="path2"></span>
															<span class="fw-semibold me-1 align-self-center" style="padding-bottom: 5px; padding-left:5px; font-family:sans-serif;">Senarai Pelajar Semester Akhir</span>
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
										<div class="col-6">
											<!--begin::Items-->
											<div class="px-6 pt-5 card-rounded h-150px w-100 card theme-dark-bg-body bg-danger">
												<!--begin::Symbol-->
												<div class="symbol symbol-30px me-0 mb-5">
														<i class="fa-solid fa-user-xmark text-light" style="font-size: 20px;">
															<span class="path1"></span>
															<span class="path2"></span>
															<span class="path3"></span>
															<span class="fw-semibold me-1 align-self-center" style="padding-bottom: 5px; padding-left:5px; font-family:sans-serif;">Senarai Pelajar Telah Tamat</span>
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
							</div>

							{{-- BKOKU POLI --}}
							<div class="tab-pane fade" id="bkokuPOLI" role="tabpanel" aria-labelledby="bkokuPOLI-tab">
								<!--Permohonan-->
								<div class="header">
									<h2>Permohonan BKOKU Politeknik</h2>
								</div>
								<div class="body">
									<!--begin:: Row-->
									<div class="row g-3 g-lg-6" style="text-align: center;">
										<!--begin::Col-->
										<div class="col-6">
											<!--begin::Items-->
											<div class="px-6 pt-5 card-rounded h-150px w-100 card theme-dark-bg-body" style="background-color: #0ca1ab">
												<!--begin::Symbol-->
												<div class="symbol symbol-30px me-0 mb-5">
														<i class="fa-solid fa-money-bill-transfer text-light" style="font-size: 20px;">
															<span class="path1"></span>
															<span class="path2"></span>
															<span class="fw-semibold me-1 align-self-center" style="padding-bottom: 5px; padding-left:5px; font-family:sans-serif;">Senarai Pelajar Semester Akhir</span>
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
										<div class="col-6">
											<!--begin::Items-->
											<div class="px-6 pt-5 card-rounded h-150px w-100 card theme-dark-bg-body bg-danger">
												<!--begin::Symbol-->
												<div class="symbol symbol-30px me-0 mb-5">
														<i class="fa-solid fa-user-xmark text-light" style="font-size: 20px;">
															<span class="path1"></span>
															<span class="path2"></span>
															<span class="path3"></span>
															<span class="fw-semibold me-1 align-self-center" style="padding-bottom: 5px; padding-left:5px; font-family:sans-serif;">Senarai Pelajar Telah Tamat</span>
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
							</div>

							{{-- BKOKU KK --}}
							<div class="tab-pane fade" id="bkokuKK" role="tabpanel" aria-labelledby="bkokuKK-tab">
								<!--Permohonan-->
								<div class="header">
									<h2>Permohonan BKOKU Kolej Komuniti</h2>
								</div>
								<div class="body">
									<!--begin:: Row-->
									<div class="row g-3 g-lg-6" style="text-align: center;">
										<!--begin::Col-->
										<div class="col-6">
											<!--begin::Items-->
											<div class="px-6 pt-5 card-rounded h-150px w-100 card theme-dark-bg-body" style="background-color: #0ca1ab">
												<!--begin::Symbol-->
												<div class="symbol symbol-30px me-0 mb-5">
														<i class="fa-solid fa-money-bill-transfer text-light" style="font-size: 20px;">
															<span class="path1"></span>
															<span class="path2"></span>
															<span class="fw-semibold me-1 align-self-center" style="padding-bottom: 5px; padding-left:5px; font-family:sans-serif;">Senarai Pelajar Semester Akhir</span>
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
										<div class="col-6">
											<!--begin::Items-->
											<div class="px-6 pt-5 card-rounded h-150px w-100 card theme-dark-bg-body bg-danger">
												<!--begin::Symbol-->
												<div class="symbol symbol-30px me-0 mb-5">
														<i class="fa-solid fa-user-xmark text-light" style="font-size: 20px;">
															<span class="path1"></span>
															<span class="path2"></span>
															<span class="path3"></span>
															<span class="fw-semibold me-1 align-self-center" style="padding-bottom: 5px; padding-left:5px; font-family:sans-serif;">Senarai Pelajar Telah Tamat</span>
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
							</div>

							{{-- BKOKU UA --}}
							<div class="tab-pane fade" id="bkokuUA" role="tabpanel" aria-labelledby="bkokuUA-tab">
								<!--Permohonan-->
								<div class="header">
									<h2>Permohonan BKOKU Universiti Awam</h2>
								</div>
								<div class="body">
									<!--begin:: Row-->
									<div class="row g-3 g-lg-6" style="text-align: center;">
										<!--begin::Col-->
										<div class="col-6">
											<!--begin::Items-->
											<div class="px-6 pt-5 card-rounded h-150px w-100 card theme-dark-bg-body" style="background-color: #0ca1ab">
												<!--begin::Symbol-->
												<div class="symbol symbol-30px me-0 mb-5">
														<i class="fa-solid fa-money-bill-transfer text-light" style="font-size: 20px;">
															<span class="path1"></span>
															<span class="path2"></span>
															<span class="fw-semibold me-1 align-self-center" style="padding-bottom: 5px; padding-left:5px; font-family:sans-serif;">Senarai Pelajar Semester Akhir</span>
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
										<div class="col-6">
											<!--begin::Items-->
											<div class="px-6 pt-5 card-rounded h-150px w-100 card theme-dark-bg-body bg-danger">
												<!--begin::Symbol-->
												<div class="symbol symbol-30px me-0 mb-5">
														<i class="fa-solid fa-user-xmark text-light" style="font-size: 20px;">
															<span class="path1"></span>
															<span class="path2"></span>
															<span class="path3"></span>
															<span class="fw-semibold me-1 align-self-center" style="padding-bottom: 5px; padding-left:5px; font-family:sans-serif;">Senarai Pelajar Telah Tamat</span>
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
							</div>

							{{-- PPK --}}
							<div class="tab-pane fade" id="ppk" role="tabpanel" aria-labelledby="ppk-tab">
								<!--Permohonan-->
								<div class="header">
									<h2>Permohonan PPK</h2>
								</div>
								<div class="body">
									<!--begin:: Row-->
									<div class="row g-3 g-lg-6" style="text-align: center;">
										<!--begin::Col-->
										<div class="col-6">
											<!--begin::Items-->
											<div class="px-6 pt-5 card-rounded h-150px w-100 card theme-dark-bg-body" style="background-color: #0ca1ab">
												<!--begin::Symbol-->
												<div class="symbol symbol-30px me-0 mb-5">
														<i class="fa-solid fa-money-bill-transfer text-light" style="font-size: 20px;">
															<span class="path1"></span>
															<span class="path2"></span>
															<span class="fw-semibold me-1 align-self-center" style="padding-bottom: 5px; padding-left:5px; font-family:sans-serif;">Senarai Pelajar Semester Akhir</span>
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
										<div class="col-6">
											<!--begin::Items-->
											<div class="px-6 pt-5 card-rounded h-150px w-100 card theme-dark-bg-body bg-danger">
												<!--begin::Symbol-->
												<div class="symbol symbol-30px me-0 mb-5">
														<i class="fa-solid fa-user-xmark text-light" style="font-size: 20px;">
															<span class="path1"></span>
															<span class="path2"></span>
															<span class="path3"></span>
															<span class="fw-semibold me-1 align-self-center" style="padding-bottom: 5px; padding-left:5px; font-family:sans-serif;">Senarai Pelajar Telah Tamat</span>
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
				url: '{{ route("status.getStatusKeseluruhan") }}', // Replace with actual server URL
				type: 'GET',
				success: function(response) {
					var dibayarIPTS = response.dibayarIPTS ?? 0;
					var tidaklayakIPTS = response.tidaklayakIPTS ?? 0;

					// Update HTML content with the obtained variables
					$(".dibayarIPTS").text(dibayarIPTS);
					$(".tidaklayakIPTS").text(tidaklayakIPTS);

				},
				error: function(xhr, status, error) {
					console.error(error);
				}
			});


		});
    </script>	

</x-default-layout>

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
							<h2>Bilangan Permohonan dan Tuntutan<br><small>Sila klik tab BKOKU atau PPK untuk lihat</small></h2>
						</div>

						@php
							$keseluruhanB = DB::table('permohonan')->where('program','=','BKOKU')->count();
							$derafB = DB::table('permohonan')->where('program','=','BKOKU')->where('status','=','1')->count();
							$baharuB = DB::table('permohonan')->where('program','=','BKOKU')->where('status','=','2')->count();
							$saringanB = DB::table('permohonan')->where('program','=','BKOKU')->where('status','=','3')->count();
							$disokongB = DB::table('permohonan')->where('program','=','BKOKU')->where('status','=','4')->count();
							$dikembalikanB = DB::table('permohonan')->where('program','=','BKOKU')->where('status','=','5')->count();
							$layakB = DB::table('permohonan')->where('program','=','BKOKU')->where('status','=','6')->count();
							$tidaklayakB = DB::table('permohonan')->where('program','=','BKOKU')->where('status','=','7')->count();
							$dibayarB = DB::table('maklumattuntutan')->join('permohonan', 'permohonan.nokp_pelajar', '=', 'maklumattuntutan.nokp_pelajar')->where('maklumattuntutan.status', '=', 8)->where('permohonan.program','=','BKOKU')->count();
						@endphp

						@php
							$keseluruhanP = DB::table('permohonan')->where('program','=','PPK')->count();
							$derafP = DB::table('permohonan')->where('program','=','PPK')->where('status','=','1')->count();
							$baharuP = DB::table('permohonan')->where('program','=','PPK')->where('status','=','2')->count();
							$saringanP = DB::table('permohonan')->where('program','=','PPK')->where('status','=','3')->count();
							$disokongP = DB::table('permohonan')->where('program','=','PPK')->where('status','=','4')->count();
							$dikembalikanP = DB::table('permohonan')->where('program','=','PPK')->where('status','=','5')->count();
							$layakP = DB::table('permohonan')->where('program','=','PPK')->where('status','=','6')->count();
							$tidaklayakP = DB::table('permohonan')->where('program','=','PPK')->where('status','=','7')->count();
							$dibayarP = DB::table('maklumattuntutan')->join('permohonan', 'permohonan.nokp_pelajar', '=', 'maklumattuntutan.nokp_pelajar')->where('maklumattuntutan.status', '=', 8)->where('permohonan.program','=','PPK')->count();
						@endphp

						{{-- top nav bar --}}
						<ul class="nav nav-tabs" id="myTab" role="tablist">
							<li class="nav-item" role="presentation">
								<button class="nav-link active" id="bkoku-tab" data-toggle="tab" data-target="#bkoku" type="button" role="tab" aria-controls="bkoku" aria-selected="true">BKOKU</button>
							</li>
							<li class="nav-item" role="presentation">
								<button class="nav-link" id="ppk-tab" data-toggle="tab" data-target="#ppk" type="button" role="tab" aria-controls="ppk" aria-selected="false">PPK</button>
							</li>
						</ul>

						<div class="tab-content" id="myTabContent">
							{{-- BKOKU --}}
							<div class="tab-pane fade show active" id="bkoku" role="tabpanel" aria-labelledby="bkoku-tab">
								{{-- Permohonan --}}
								<div class="header">
									<h2>Permohonan BKOKU</h2>
								</div>
								<div class="body">
									<!--begin::First Row-->
									<div class="row g-3 g-lg-6" style="text-align: center;">
										<!--begin::Col-->
										<div class="col-3">
											<!--begin::Items-->
											<div class="px-6 pt-5 card-rounded h-150px w-100 card theme-dark-bg-body" style="background-color: #787878">
												<!--begin::Symbol-->
												<div class="symbol symbol-30px me-0 mb-5">
													{{-- <span class="symbol-label"> --}}
														<i class="fas fa-list-ol text-light" style="font-size: 20px;">
															<span class="path1"></span>
															<span class="path2"></span>
															<span class="fw-semibold me-1 align-self-center" style="padding-bottom: 5px; padding-left:5px; font-family:sans-serif;">Keseluruhan</span>
														</i>
													{{-- </span> --}}
												</div>
												<!--end::Symbol-->
												<!--begin::Stats-->
												<div class="m-0">
													<a href="{{url('permohonan/BKOKU')}}">
														<span class="text-white fw-bolder d-block fs-4x lh-1 ls-n1 mb-1">{{$keseluruhanB}}</span>
														<span class="text-white fw-bold fs-7">Klik untuk Lihat</span>
													</a>
												</div>
												<!--end::Stats-->
											</div>
											<!--end::Items-->
										</div>
										<!--end::Col-->

										<!--begin::Col-->
										<div class="col-3">
											<!--begin::Items-->
											<div class="px-6 pt-5 card-rounded h-150px w-100 card theme-dark-bg-body bg-info">
												<!--begin::Symbol-->
												<div class="symbol symbol-30px me-0 mb-5">
													{{-- <span class="symbol-label"> --}}
														<i class="fa-solid fa-file-lines text-light" style="font-size: 20px;">
															<span class="path1"></span>
															<span class="path2"></span>
															<span class="path3"></span>
															<span class="fw-semibold me-1 align-self-center" style="padding-bottom: 5px; padding-left:5px; font-family:sans-serif;">Deraf</span>
														</i>
													{{-- </span> --}}
												</div>
												<!--end::Symbol-->
												<!--begin::Stats-->
												<div class="m-0">
													<a href="{{ route('statusB.permohonan', ['status' => '1']) }}">
														<span class="text-white fw-bolder d-block fs-4x lh-1 ls-n1 mb-1">{{$derafB}}</span>
														<span class="text-white fw-bold fs-7">Klik untuk Lihat</span>
													</a>
												</div>
												<!--end::Stats-->
											</div>
											<!--end::Items-->
										</div>
										<!--end::Col-->

										<!--begin::Col-->
										<div class="col-3">
											<!--begin::Items-->
											<div class="px-6 pt-5 card-rounded h-150px w-100 card theme-dark-bg-body" style="background-color: #186ee6">
												<!--begin::Symbol-->
												<div class="symbol symbol-30px me-0 mb-5">
													{{-- <span class="symbol-label"> --}}
														<i class="fa-solid fa-file-circle-plus text-light" style="font-size: 20px;">
															<span class="path1"></span>
															<span class="path2"></span>
															<span class="fw-semibold me-1 align-self-center" style="padding-bottom: 5px; padding-left:5px; font-family:sans-serif;">Baharu</span>
														</i>
													{{-- </span> --}}
												</div>
												<!--end::Symbol-->
												<!--begin::Stats-->
												<div class="m-0">
													<a href="{{ route('statusB.permohonan', ['status' => '2']) }}">
														<span class="text-white fw-bolder d-block fs-4x lh-1 ls-n1 mb-1">{{$baharuB}}</span>
														<span class="text-white fw-bold fs-7">Klik untuk Lihat</span>
													</a>
												</div>
												<!--end::Stats-->
											</div>
											<!--end::Items-->
										</div>
										<!--end::Col-->

										<!--begin::Col-->
										<div class="col-3">
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
													<a href="{{ route('statusB.permohonan', ['status' => '3']) }}">
														<span class="text-white fw-bolder d-block fs-4x lh-1 ls-n1 mb-1">{{$saringanB}}</span>
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
										<div class="col-3">
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
													<a href="{{ route('statusB.permohonan', ['status' => '4']) }}">
														<span class="text-white fw-bolder d-block fs-4x lh-1 ls-n1 mb-1">{{$disokongB}}</span>
														<span class="text-white fw-bold fs-7">Klik untuk Lihat</span>
													</a>
												</div>
												<!--end::Stats-->
											</div>
											<!--end::Items-->
										</div>
										<!--end::Col-->

										<!--begin::Col-->
										<div class="col-3">
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
													<a href="{{ route('statusB.permohonan', ['status' => '5']) }}">
														<span class="text-white fw-bolder d-block fs-4x lh-1 ls-n1 mb-1">{{$dikembalikanB}}</span>
														<span class="text-white fw-bold fs-7">Klik untuk Lihat</span>
													</a>
												</div>
												<!--end::Stats-->
											</div>
											<!--end::Items-->
										</div>
										<!--end::Col-->
										
										<!--begin::Col-->
										<div class="col-3">
											<!--begin::Items-->
											<div class="px-6 pt-5 card-rounded h-150px w-100 card theme-dark-bg-body bg-success">
												<!--begin::Symbol-->
												<div class="symbol symbol-30px me-0 mb-5">
													{{-- <span class="symbol-label"> --}}
														<i class="fas fa-user-check text-light" style="font-size: 20px;">
															<span class="path1"></span>
															<span class="path2"></span>
															<span class="fw-semibold me-1 align-self-center" style="padding-bottom: 5px; padding-left:5px; font-family:sans-serif;">Layak</span>
														</i>
													{{-- </span> --}}
												</div>
												<!--end::Symbol-->
												<!--begin::Stats-->
												<div class="m-0">
													<a href="{{ route('statusB.permohonan', ['status' => '6']) }}">
														<span class="text-white fw-bolder d-block fs-4x lh-1 ls-n1 mb-1">{{$layakB}}</span>
														<span class="text-white fw-bold fs-7">Klik untuk Lihat</span>
													</a>
												</div>
												<!--end::Stats-->
											</div>
											<!--end::Items-->
										</div>
										<!--end::Col-->

										<!--begin::Col-->
										<div class="col-3">
											<!--begin::Items-->
											<div class="px-6 pt-5 card-rounded h-150px w-100 card theme-dark-bg-body bg-danger">
												<!--begin::Symbol-->
												<div class="symbol symbol-30px me-0 mb-5">
													{{-- <span class="symbol-label"> --}}
														<i class="fa-solid fa-user-xmark text-light" style="font-size: 20px;">
															<span class="path1"></span>
															<span class="path2"></span>
															<span class="path3"></span>
															<span class="fw-semibold me-1 align-self-center" style="padding-bottom: 5px; padding-left:5px; font-family:sans-serif;">Tidak Layak</span>
														</i>
													{{-- </span> --}}
												</div>
												<!--end::Symbol-->
												<!--begin::Stats-->
												<div class="m-0">
													<a href="{{ route('statusB.permohonan', ['status' => '7']) }}">
														<span class="text-white fw-bolder d-block fs-4x lh-1 ls-n1 mb-1">{{$tidaklayakB}}</span>
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

								{{-- Tuntutan --}}
								<div class="header">
									<h2>Tuntutan BKOKU</h2>
								</div>
								<div class="body">
									<!--begin::First Row-->
									<div class="row g-3 g-lg-6" style="text-align: center;">
										<!--begin::Col-->
										<div class="col-3">
											<!--begin::Items-->
											<div class="px-6 pt-5 card-rounded h-150px w-100 card theme-dark-bg-body" style="background-color: #0ca1ab">
												<!--begin::Symbol-->
												<div class="symbol symbol-30px me-0 mb-5">
													{{-- <span class="symbol-label"> --}}
														<i class="fa-solid fa-money-bill-transfer text-light" style="font-size: 20px;">
															<span class="path1"></span>
															<span class="path2"></span>
															<span class="fw-semibold me-1 align-self-center" style="padding-bottom: 5px; padding-left:5px; font-family:sans-serif;">Dibayar</span>
														</i>
													{{-- </span> --}}
												</div>
												<!--end::Symbol-->
												<!--begin::Stats-->
												<div class="m-0">
													<a href="{{url('permohonan/BKOKU')}}">
														<span class="text-white fw-bolder d-block fs-4x lh-1 ls-n1 mb-1">{{$dibayarB}}</span>
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
								{{-- Permohonan --}}
								<div class="header">
									<h2>Permohonan PPK</h2>
								</div>
								<div class="body">
									<!--begin::First Row-->
									<div class="row g-3 g-lg-6" style="text-align: center;">
										<!--begin::Col-->
										<div class="col-3">
											<!--begin::Items-->
											<div class="px-6 pt-5 card-rounded h-150px w-100 card theme-dark-bg-body" style="background-color: #787878">
												<!--begin::Symbol-->
												<div class="symbol symbol-30px me-0 mb-5">
													{{-- <span class="symbol-label"> --}}
														<i class="fas fa-list-ol text-light" style="font-size: 20px;">
															<span class="path1"></span>
															<span class="path2"></span>
															<span class="fw-semibold me-1 align-self-center" style="padding-bottom: 5px; padding-left:5px; font-family:sans-serif;">Keseluruhan</span>
														</i>
													{{-- </span> --}}
												</div>
												<!--end::Symbol-->
												<!--begin::Stats-->
												<div class="m-0">
													<a href="{{url('permohonan/PPK')}}">
														<span class="text-white fw-bolder d-block fs-4x lh-1 ls-n1 mb-1">{{$keseluruhanP}}</span>
														<span class="text-white fw-bold fs-7">Klik untuk Lihat</span>
													</a>
												</div>
												<!--end::Stats-->
											</div>
											<!--end::Items-->
										</div>
										<!--end::Col-->

										<!--begin::Col-->
										<div class="col-3">
											<!--begin::Items-->
											<div class="px-6 pt-5 card-rounded h-150px w-100 card theme-dark-bg-body bg-info">
												<!--begin::Symbol-->
												<div class="symbol symbol-30px me-0 mb-5">
													{{-- <span class="symbol-label"> --}}
														<i class="fa-solid fa-file-lines text-light" style="font-size: 20px;">
															<span class="path1"></span>
															<span class="path2"></span>
															<span class="path3"></span>
															<span class="fw-semibold me-1 align-self-center" style="padding-bottom: 5px; padding-left:5px; font-family:sans-serif;">Deraf</span>
														</i>
													{{-- </span> --}}
												</div>
												<!--end::Symbol-->
												<!--begin::Stats-->
												<div class="m-0">
													<a href="{{ route('statusP.permohonan', ['status' => '1']) }}">
														<span class="text-white fw-bolder d-block fs-4x lh-1 ls-n1 mb-1">{{$derafP}}</span>
														<span class="text-white fw-bold fs-7">Klik untuk Lihat</span>
													</a>
												</div>
												<!--end::Stats-->
											</div>
											<!--end::Items-->
										</div>
										<!--end::Col-->

										<!--begin::Col-->
										<div class="col-3">
											<!--begin::Items-->
											<div class="px-6 pt-5 card-rounded h-150px w-100 card theme-dark-bg-body" style="background-color: #186ee6">
												<!--begin::Symbol-->
												<div class="symbol symbol-30px me-0 mb-5">
													{{-- <span class="symbol-label"> --}}
														<i class="fa-solid fa-file-circle-plus text-light" style="font-size: 20px;">
															<span class="path1"></span>
															<span class="path2"></span>
															<span class="fw-semibold me-1 align-self-center" style="padding-bottom: 5px; padding-left:5px; font-family:sans-serif;">Baharu</span>
														</i>
													{{-- </span> --}}
												</div>
												<!--end::Symbol-->
												<!--begin::Stats-->
												<div class="m-0">
													<a href="{{ route('statusP.permohonan', ['status' => '2']) }}">
														<span class="text-white fw-bolder d-block fs-4x lh-1 ls-n1 mb-1">{{$baharuP}}</span>
														<span class="text-white fw-bold fs-7">Klik untuk Lihat</span>
													</a>
												</div>
												<!--end::Stats-->
											</div>
											<!--end::Items-->
										</div>
										<!--end::Col-->

										<!--begin::Col-->
										<div class="col-3">
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
														<span class="text-white fw-bolder d-block fs-4x lh-1 ls-n1 mb-1">{{$saringanP}}</span>
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
										<div class="col-3">
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
														<span class="text-white fw-bolder d-block fs-4x lh-1 ls-n1 mb-1">{{$disokongP}}</span>
														<span class="text-white fw-bold fs-7">Klik untuk Lihat</span>
													</a>
												</div>
												<!--end::Stats-->
											</div>
											<!--end::Items-->
										</div>
										<!--end::Col-->

										<!--begin::Col-->
										<div class="col-3">
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
														<span class="text-white fw-bolder d-block fs-4x lh-1 ls-n1 mb-1">{{$dikembalikanP}}</span>
														<span class="text-white fw-bold fs-7">Klik untuk Lihat</span>
													</a>
												</div>
												<!--end::Stats-->
											</div>
											<!--end::Items-->
										</div>
										<!--end::Col-->
										
										<!--begin::Col-->
										<div class="col-3">
											<!--begin::Items-->
											<div class="px-6 pt-5 card-rounded h-150px w-100 card theme-dark-bg-body bg-success">
												<!--begin::Symbol-->
												<div class="symbol symbol-30px me-0 mb-5">
													{{-- <span class="symbol-label"> --}}
														<i class="fas fa-user-check text-light" style="font-size: 20px;">
															<span class="path1"></span>
															<span class="path2"></span>
															<span class="fw-semibold me-1 align-self-center" style="padding-bottom: 5px; padding-left:5px; font-family:sans-serif;">Layak</span>
														</i>
													{{-- </span> --}}
												</div>
												<!--end::Symbol-->
												<!--begin::Stats-->
												<div class="m-0">
													<a href="{{ route('statusP.permohonan', ['status' => '6']) }}">
														<span class="text-white fw-bolder d-block fs-4x lh-1 ls-n1 mb-1">{{$layakP}}</span>
														<span class="text-white fw-bold fs-7">Klik untuk Lihat</span>
													</a>
												</div>
												<!--end::Stats-->
											</div>
											<!--end::Items-->
										</div>
										<!--end::Col-->

										<!--begin::Col-->
										<div class="col-3">
											<!--begin::Items-->
											<div class="px-6 pt-5 card-rounded h-150px w-100 card theme-dark-bg-body bg-danger">
												<!--begin::Symbol-->
												<div class="symbol symbol-30px me-0 mb-5">
													{{-- <span class="symbol-label"> --}}
														<i class="fa-solid fa-user-xmark text-light" style="font-size: 20px;">
															<span class="path1"></span>
															<span class="path2"></span>
															<span class="path3"></span>
															<span class="fw-semibold me-1 align-self-center" style="padding-bottom: 5px; padding-left:5px; font-family:sans-serif;">Tidak Layak</span>
														</i>
													{{-- </span> --}}
												</div>
												<!--end::Symbol-->
												<!--begin::Stats-->
												<div class="m-0">
													<a href="{{ route('statusP.permohonan', ['status' => '7']) }}">
														<span class="text-white fw-bolder d-block fs-4x lh-1 ls-n1 mb-1">{{$tidaklayakP}}</span>
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

								{{-- Tuntutan --}}
								<div class="header">
									<h2>Tuntutan PPK</h2>
								</div>
								<div class="body">
									<!--begin::First Row-->
									<div class="row g-3 g-lg-6" style="text-align: center;">
										<!--begin::Col-->
										<div class="col-3">
											<!--begin::Items-->
											<div class="px-6 pt-5 card-rounded h-150px w-100 card theme-dark-bg-body" style="background-color: #0ca1ab">
												<!--begin::Symbol-->
												<div class="symbol symbol-30px me-0 mb-5">
													{{-- <span class="symbol-label"> --}}
														<i class="fa-solid fa-money-bill-transfer text-light" style="font-size: 20px;">
															<span class="path1"></span>
															<span class="path2"></span>
															<span class="fw-semibold me-1 align-self-center" style="padding-bottom: 5px; padding-left:5px; font-family:sans-serif;">Dibayar</span>
														</i>
													{{-- </span> --}}
												</div>
												<!--end::Symbol-->
												<!--begin::Stats-->
												<div class="m-0">
													<a href="{{url('permohonan/BKOKU')}}">
														<span class="text-white fw-bolder d-block fs-4x lh-1 ls-n1 mb-1">{{$dibayarP}}</span>
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
</x-default-layout>

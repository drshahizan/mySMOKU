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
							<h2>Bilangan Permohonan dan Tuntutan<br><small>Sila klik tab BKOKU, BKOKU UA atau PPK untuk lihat</small></h2>
						</div>

						{{-- COUNT PERMOHONAN --}}
						@php
							// $keseluruhanB = DB::table('permohonan')->where('program', 'BKOKU')
							// ->whereNotExists(function ($query) {
							// 	$query->select(DB::raw(1))
							// 		  ->from('smoku_akademik')
							// 		  ->join('bk_info_institusi', 'smoku_akademik.id_institusi', '=', 'bk_info_institusi.id_institusi')
							// 		  ->whereColumn('smoku_akademik.smoku_id', 'permohonan.smoku_id')
							// 		  ->where('bk_info_institusi.jenis_institusi', 'UA');
							// })
							// ->count();
							$keseluruhanB = DB::table('permohonan')
							->join('smoku_akademik', 'permohonan.smoku_id', '=', 'smoku_akademik.smoku_id')
							->join('bk_info_institusi', 'smoku_akademik.id_institusi', '=', 'bk_info_institusi.id_institusi')
							->where('permohonan.program', 'BKOKU')
							->whereNotIn('bk_info_institusi.jenis_institusi', ['UA']) // Exclude jenis_institusi 'UA'
							->count();


							$derafB = DB::table('permohonan')->where('program', 'BKOKU')->where('status', '=', '1')
							->whereNotExists(function ($query) {
								$query->select(DB::raw(1))
									  ->from('smoku_akademik')
									  ->join('bk_info_institusi', 'smoku_akademik.id_institusi', '=', 'bk_info_institusi.id_institusi')
									  ->whereColumn('smoku_akademik.smoku_id', 'permohonan.smoku_id')
									  ->where('bk_info_institusi.jenis_institusi', 'UA');
							})
							->count();

							$baharuB = DB::table('permohonan')->where('program', 'BKOKU')->where('status', '=', '2')
							->whereNotExists(function ($query) {
								$query->select(DB::raw(1))
									  ->from('smoku_akademik')
									  ->join('bk_info_institusi', 'smoku_akademik.id_institusi', '=', 'bk_info_institusi.id_institusi')
									  ->whereColumn('smoku_akademik.smoku_id', 'permohonan.smoku_id')
									  ->where('bk_info_institusi.jenis_institusi', 'UA');
							})
							->count();

							$saringanB = DB::table('permohonan')->where('program', 'BKOKU')->where('status', '=', '3')
							->whereNotExists(function ($query) {
								$query->select(DB::raw(1))
									  ->from('smoku_akademik')
									  ->join('bk_info_institusi', 'smoku_akademik.id_institusi', '=', 'bk_info_institusi.id_institusi')
									  ->whereColumn('smoku_akademik.smoku_id', 'permohonan.smoku_id')
									  ->where('bk_info_institusi.jenis_institusi', 'UA');
							})
							->count();

							$disokongB = DB::table('permohonan')->where('program', 'BKOKU')->where('status', '=', '4')
							->whereNotExists(function ($query) {
								$query->select(DB::raw(1))
									  ->from('smoku_akademik')
									  ->join('bk_info_institusi', 'smoku_akademik.id_institusi', '=', 'bk_info_institusi.id_institusi')
									  ->whereColumn('smoku_akademik.smoku_id', 'permohonan.smoku_id')
									  ->where('bk_info_institusi.jenis_institusi', 'UA');
							})
							->count();

							$dikembalikanB = DB::table('permohonan')->where('program', 'BKOKU')->where('status', '=', '5')
							->whereNotExists(function ($query) {
								$query->select(DB::raw(1))
									  ->from('smoku_akademik')
									  ->join('bk_info_institusi', 'smoku_akademik.id_institusi', '=', 'bk_info_institusi.id_institusi')
									  ->whereColumn('smoku_akademik.smoku_id', 'permohonan.smoku_id')
									  ->where('bk_info_institusi.jenis_institusi', 'UA');
							})
							->count();

							$layakB = DB::table('permohonan')->where('program', 'BKOKU')->where('status', '=', '6')
							->whereNotExists(function ($query) {
								$query->select(DB::raw(1))
									  ->from('smoku_akademik')
									  ->join('bk_info_institusi', 'smoku_akademik.id_institusi', '=', 'bk_info_institusi.id_institusi')
									  ->whereColumn('smoku_akademik.smoku_id', 'permohonan.smoku_id')
									  ->where('bk_info_institusi.jenis_institusi', 'UA');
							})
							->count();

							$tidaklayakB = DB::table('permohonan')->where('program', 'BKOKU')->where('status', '=', '7')
							->whereNotExists(function ($query) {
								$query->select(DB::raw(1))
									  ->from('smoku_akademik')
									  ->join('bk_info_institusi', 'smoku_akademik.id_institusi', '=', 'bk_info_institusi.id_institusi')
									  ->whereColumn('smoku_akademik.smoku_id', 'permohonan.smoku_id')
									  ->where('bk_info_institusi.jenis_institusi', 'UA');
							})
							->count();

							$dibayarB = DB::table('permohonan')->where('program', 'BKOKU')->where('status', '=', '8')
							->whereNotExists(function ($query) {
								$query->select(DB::raw(1))
									  ->from('smoku_akademik')
									  ->join('bk_info_institusi', 'smoku_akademik.id_institusi', '=', 'bk_info_institusi.id_institusi')
									  ->whereColumn('smoku_akademik.smoku_id', 'permohonan.smoku_id')
									  ->where('bk_info_institusi.jenis_institusi', 'UA');
							})
							->count();
						@endphp

						@php
							$UApermohonanAll = DB::table('permohonan')->join('smoku_akademik', 'permohonan.smoku_id', '=', 'smoku_akademik.smoku_id')
							->join('bk_info_institusi', 'smoku_akademik.id_institusi', '=', 'bk_info_institusi.id_institusi')
							->where('bk_info_institusi.jenis_institusi', 'UA') 
							->count();

							$UApermohonan1 = DB::table('permohonan')->join('smoku_akademik', 'permohonan.smoku_id', '=', 'smoku_akademik.smoku_id')
							->join('bk_info_institusi', 'smoku_akademik.id_institusi', '=', 'bk_info_institusi.id_institusi')
							->where('bk_info_institusi.jenis_institusi', 'UA') 
							->where('permohonan.status', 1)
							->count();

							$UApermohonan2 = DB::table('permohonan')->join('smoku_akademik', 'permohonan.smoku_id', '=', 'smoku_akademik.smoku_id')
							->join('bk_info_institusi', 'smoku_akademik.id_institusi', '=', 'bk_info_institusi.id_institusi')
							->where('bk_info_institusi.jenis_institusi', 'UA') 
							->where('permohonan.status', 2)
							->count();

							$UApermohonan3 = DB::table('permohonan')->join('smoku_akademik', 'permohonan.smoku_id', '=', 'smoku_akademik.smoku_id')
							->join('bk_info_institusi', 'smoku_akademik.id_institusi', '=', 'bk_info_institusi.id_institusi')
							->where('bk_info_institusi.jenis_institusi', 'UA') 
							->where('permohonan.status', 3)
							->count();

							$UApermohonan4 = DB::table('permohonan')->join('smoku_akademik', 'permohonan.smoku_id', '=', 'smoku_akademik.smoku_id')
							->join('bk_info_institusi', 'smoku_akademik.id_institusi', '=', 'bk_info_institusi.id_institusi')
							->where('bk_info_institusi.jenis_institusi', 'UA') 
							->where('permohonan.status', 4)
							->count();

							$UApermohonan5 = DB::table('permohonan')->join('smoku_akademik', 'permohonan.smoku_id', '=', 'smoku_akademik.smoku_id')
							->join('bk_info_institusi', 'smoku_akademik.id_institusi', '=', 'bk_info_institusi.id_institusi')
							->where('bk_info_institusi.jenis_institusi', 'UA') 
							->where('permohonan.status', 5)
							->count();

							$UApermohonan6 = DB::table('permohonan')->join('smoku_akademik', 'permohonan.smoku_id', '=', 'smoku_akademik.smoku_id')
							->join('bk_info_institusi', 'smoku_akademik.id_institusi', '=', 'bk_info_institusi.id_institusi')
							->where('bk_info_institusi.jenis_institusi', 'UA') 
							->where('permohonan.status', 6)
							->count();

							$UApermohonan7 = DB::table('permohonan')->join('smoku_akademik', 'permohonan.smoku_id', '=', 'smoku_akademik.smoku_id')
							->join('bk_info_institusi', 'smoku_akademik.id_institusi', '=', 'bk_info_institusi.id_institusi')
							->where('bk_info_institusi.jenis_institusi', 'UA') 
							->where('permohonan.status', 7)
							->count();

							$UApermohonan8 = DB::table('permohonan')->join('smoku_akademik', 'permohonan.smoku_id', '=', 'smoku_akademik.smoku_id')
							->join('bk_info_institusi', 'smoku_akademik.id_institusi', '=', 'bk_info_institusi.id_institusi')
							->where('bk_info_institusi.jenis_institusi', 'UA') 
							->where('permohonan.status', 8)
							->count();
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
							$dibayarP = DB::table('permohonan')->where('program','=','PPK')->where('status','=','8')->count();
						@endphp

						{{-- COUNT TUNTUTAN --}}
						@php
							$keseluruhanTB = DB::table('tuntutan')->join('permohonan', 'permohonan.id', '=', 'tuntutan.permohonan_id')->where('tuntutan.status', '!=', 9)->where('permohonan.program','=','BKOKU')->count();
							$derafTB = DB::table('tuntutan')->join('permohonan', 'permohonan.id', '=', 'tuntutan.permohonan_id')->where('tuntutan.status', '=', 1)->where('permohonan.program','=','BKOKU')->count();
							$baharuTB = DB::table('tuntutan')->join('permohonan', 'permohonan.id', '=', 'tuntutan.permohonan_id')->where('tuntutan.status', '=', 2)->where('permohonan.program','=','BKOKU')->count();
							$saringanTB = DB::table('tuntutan')->join('permohonan', 'permohonan.id', '=', 'tuntutan.permohonan_id')->where('tuntutan.status', '=', 3)->where('permohonan.program','=','BKOKU')->count();
							$disokongTB = DB::table('tuntutan')->join('permohonan', 'permohonan.id', '=', 'tuntutan.permohonan_id')->where('tuntutan.status', '=', 4)->where('permohonan.program','=','BKOKU')->count();
							$dikembalikanTB = DB::table('tuntutan')->join('permohonan', 'permohonan.id', '=', 'tuntutan.permohonan_id')->where('tuntutan.status', '=', 5)->where('permohonan.program','=','BKOKU')->count();
							$layakTB = DB::table('tuntutan')->join('permohonan', 'permohonan.id', '=', 'tuntutan.permohonan_id')->where('tuntutan.status', '=', 6)->where('permohonan.program','=','BKOKU')->count();
							$tidaklayakTB = DB::table('tuntutan')->join('permohonan', 'permohonan.id', '=', 'tuntutan.permohonan_id')->where('tuntutan.status', '=', 7)->where('permohonan.program','=','BKOKU')->count();
							$dibayarTB = DB::table('tuntutan')->join('permohonan', 'permohonan.id', '=', 'tuntutan.permohonan_id')->where('tuntutan.status', '=', 8)->where('permohonan.program','=','BKOKU')->count();
						@endphp

						@php
							$UAtuntutanAll = DB::table('tuntutan')
							->join('permohonan', 'permohonan.id', '=', 'tuntutan.permohonan_id')
							->join('smoku_akademik', 'permohonan.smoku_id', '=', 'smoku_akademik.smoku_id')
							->join('bk_info_institusi', 'smoku_akademik.id_institusi', '=', 'bk_info_institusi.id_institusi')
							->where('tuntutan.status', '!=', 9)
							->where('permohonan.program', 'BKOKU')
							->where('bk_info_institusi.jenis_institusi', 'UA') 
							->count();

							$UAtuntutan1 = DB::table('tuntutan')
							->join('permohonan', 'permohonan.id', '=', 'tuntutan.permohonan_id')
							->join('smoku_akademik', 'permohonan.smoku_id', '=', 'smoku_akademik.smoku_id')
							->join('bk_info_institusi', 'smoku_akademik.id_institusi', '=', 'bk_info_institusi.id_institusi')
							->where('tuntutan.status', '=', 1)
							->where('permohonan.program', 'BKOKU')
							->where('bk_info_institusi.jenis_institusi', 'UA') 
							->count();

							$UAtuntutan2 = DB::table('tuntutan')
							->join('permohonan', 'permohonan.id', '=', 'tuntutan.permohonan_id')
							->join('smoku_akademik', 'permohonan.smoku_id', '=', 'smoku_akademik.smoku_id')
							->join('bk_info_institusi', 'smoku_akademik.id_institusi', '=', 'bk_info_institusi.id_institusi')
							->where('tuntutan.status', '=', 2)
							->where('permohonan.program', 'BKOKU')
							->where('bk_info_institusi.jenis_institusi', 'UA') 
							->count();

							$UAtuntutan3 = DB::table('tuntutan')
							->join('permohonan', 'permohonan.id', '=', 'tuntutan.permohonan_id')
							->join('smoku_akademik', 'permohonan.smoku_id', '=', 'smoku_akademik.smoku_id')
							->join('bk_info_institusi', 'smoku_akademik.id_institusi', '=', 'bk_info_institusi.id_institusi')
							->where('tuntutan.status', '=', 3)
							->where('permohonan.program', 'BKOKU')
							->where('bk_info_institusi.jenis_institusi', 'UA') 
							->count();

							$UAtuntutan4 = DB::table('tuntutan')
							->join('permohonan', 'permohonan.id', '=', 'tuntutan.permohonan_id')
							->join('smoku_akademik', 'permohonan.smoku_id', '=', 'smoku_akademik.smoku_id')
							->join('bk_info_institusi', 'smoku_akademik.id_institusi', '=', 'bk_info_institusi.id_institusi')
							->where('tuntutan.status', '=', 4)
							->where('permohonan.program', 'BKOKU')
							->where('bk_info_institusi.jenis_institusi', 'UA') 
							->count();

							$UAtuntutan5 = DB::table('tuntutan')
							->join('permohonan', 'permohonan.id', '=', 'tuntutan.permohonan_id')
							->join('smoku_akademik', 'permohonan.smoku_id', '=', 'smoku_akademik.smoku_id')
							->join('bk_info_institusi', 'smoku_akademik.id_institusi', '=', 'bk_info_institusi.id_institusi')
							->where('tuntutan.status', '=', 5)
							->where('permohonan.program', 'BKOKU')
							->where('bk_info_institusi.jenis_institusi', 'UA') 
							->count();

							$UAtuntutan6 = DB::table('tuntutan')
							->join('permohonan', 'permohonan.id', '=', 'tuntutan.permohonan_id')
							->join('smoku_akademik', 'permohonan.smoku_id', '=', 'smoku_akademik.smoku_id')
							->join('bk_info_institusi', 'smoku_akademik.id_institusi', '=', 'bk_info_institusi.id_institusi')
							->where('tuntutan.status', '=', 6)
							->where('permohonan.program', 'BKOKU')
							->where('bk_info_institusi.jenis_institusi', 'UA') 
							->count();

							$UAtuntutan7 = DB::table('tuntutan')
							->join('permohonan', 'permohonan.id', '=', 'tuntutan.permohonan_id')
							->join('smoku_akademik', 'permohonan.smoku_id', '=', 'smoku_akademik.smoku_id')
							->join('bk_info_institusi', 'smoku_akademik.id_institusi', '=', 'bk_info_institusi.id_institusi')
							->where('tuntutan.status', '=', 7)
							->where('permohonan.program', 'BKOKU')
							->where('bk_info_institusi.jenis_institusi', 'UA') 
							->count();

							$UAtuntutan8 = DB::table('tuntutan')
							->join('permohonan', 'permohonan.id', '=', 'tuntutan.permohonan_id')
							->join('smoku_akademik', 'permohonan.smoku_id', '=', 'smoku_akademik.smoku_id')
							->join('bk_info_institusi', 'smoku_akademik.id_institusi', '=', 'bk_info_institusi.id_institusi')
							->where('tuntutan.status', '=', 8)
							->where('permohonan.program', 'BKOKU')
							->where('bk_info_institusi.jenis_institusi', 'UA') 
							->count();
						@endphp

						@php
							$keseluruhanTP = DB::table('tuntutan')->join('permohonan', 'permohonan.id', '=', 'tuntutan.permohonan_id')->where('tuntutan.status', '!=', 9)->where('permohonan.program','=','PPK')->count();
							$derafTP = DB::table('tuntutan')->join('permohonan', 'permohonan.id', '=', 'tuntutan.permohonan_id')->where('tuntutan.status', '=', 1)->where('permohonan.program','=','PPK')->count();
							$baharuTP = DB::table('tuntutan')->join('permohonan', 'permohonan.id', '=', 'tuntutan.permohonan_id')->where('tuntutan.status', '=', 2)->where('permohonan.program','=','PPK')->count();
							$saringanTP = DB::table('tuntutan')->join('permohonan', 'permohonan.id', '=', 'tuntutan.permohonan_id')->where('tuntutan.status', '=', 3)->where('permohonan.program','=','PPK')->count();
							$disokongTP = DB::table('tuntutan')->join('permohonan', 'permohonan.id', '=', 'tuntutan.permohonan_id')->where('tuntutan.status', '=', 4)->where('permohonan.program','=','PPK')->count();
							$dikembalikanTP = DB::table('tuntutan')->join('permohonan', 'permohonan.id', '=', 'tuntutan.permohonan_id')->where('tuntutan.status', '=', 5)->where('permohonan.program','=','PPK')->count();
							$layakTP = DB::table('tuntutan')->join('permohonan', 'permohonan.id', '=', 'tuntutan.permohonan_id')->where('tuntutan.status', '=', 6)->where('permohonan.program','=','PPK')->count();
							$tidaklayakTP = DB::table('tuntutan')->join('permohonan', 'permohonan.id', '=', 'tuntutan.permohonan_id')->where('tuntutan.status', '=', 7)->where('permohonan.program','=','PPK')->count();
							$dibayarTP = DB::table('tuntutan')->join('permohonan', 'permohonan.id', '=', 'tuntutan.permohonan_id')->where('tuntutan.status', '=', 8)->where('permohonan.program','=','PPK')->count();
						@endphp

						{{-- top nav bar --}}
						<ul class="nav nav-tabs" id="myTab" role="tablist">
							<li class="nav-item" role="presentation">
								<button class="nav-link active" id="bkoku1-tab" data-toggle="tab" data-target="#bkoku1" type="button" role="tab" aria-controls="bkoku1" aria-selected="true">BKOKU</button>
							</li>
							<li class="nav-item" role="presentation">
								<button class="nav-link" id="bkoku2-tab" data-toggle="tab" data-target="#bkoku2" type="button" role="tab" aria-controls="bkoku2" aria-selected="true">BKOKU UA</button>
							</li>
							<li class="nav-item" role="presentation">
								<button class="nav-link" id="ppk-tab" data-toggle="tab" data-target="#ppk" type="button" role="tab" aria-controls="ppk" aria-selected="false">PPK</button>
							</li>
						</ul>

						<div class="tab-content" id="myTabContent">
							{{-- BKOKU --}}
							<div class="tab-pane fade show active" id="bkoku1" role="tabpanel" aria-labelledby="bkoku1-tab">
								{{-- Permohonan --}}
								<div class="header">
									<h2>Permohonan BKOKU</h2>
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
													<a href="{{ route('keseluruhanB.permohonan', ['status' => '!=9']) }}">
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
										<div class="col-4">
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
										<div class="col-4">
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
													<a href="{{ route('statusB.permohonan', ['status' => '8']) }}">
														<span class="text-white fw-bolder d-block fs-4x lh-1 ls-n1 mb-1">{{$dibayarB}}</span>
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
										<div class="col-4">
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
										<div class="col-4">
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
													<a href="{{ route('keseluruhanB.tuntutan', ['status' => '!=9']) }}">
														<span class="text-white fw-bolder d-block fs-4x lh-1 ls-n1 mb-1">{{$keseluruhanTB-$UAtuntutanAll}}</span>
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
													<a href="{{ route('statusB.tuntutan', ['status' => '1']) }}">
														<span class="text-white fw-bolder d-block fs-4x lh-1 ls-n1 mb-1">{{$derafTB-$UAtuntutan1}}</span>
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
													<a href="{{ route('statusB.tuntutan', ['status' => '2']) }}">
														<span class="text-white fw-bolder d-block fs-4x lh-1 ls-n1 mb-1">{{$baharuTB-$UAtuntutan2}}</span>
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
													<a href="{{ route('statusB.tuntutan', ['status' => '3']) }}">
														<span class="text-white fw-bolder d-block fs-4x lh-1 ls-n1 mb-1">{{$saringanTB-$UAtuntutan3}}</span>
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
													<a href="{{ route('statusB.tuntutan', ['status' => '4']) }}">
														<span class="text-white fw-bolder d-block fs-4x lh-1 ls-n1 mb-1">{{$disokongTB-$UAtuntutan4}}</span>
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
													<a href="{{ route('statusB.tuntutan', ['status' => '5']) }}">
														<span class="text-white fw-bolder d-block fs-4x lh-1 ls-n1 mb-1">{{$dikembalikanTB-$UAtuntutan5}}</span>
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
													<a href="{{ route('statusB.tuntutan', ['status' => '8']) }}">
														<span class="text-white fw-bolder d-block fs-4x lh-1 ls-n1 mb-1">{{$dibayarTB-$UAtuntutan8}}</span>
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
													<a href="{{ route('statusB.tuntutan', ['status' => '6']) }}">
														<span class="text-white fw-bolder d-block fs-4x lh-1 ls-n1 mb-1">{{$layakTB-$UAtuntutan6}}</span>
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
													<a href="{{ route('statusB.tuntutan', ['status' => '7']) }}">
														<span class="text-white fw-bolder d-block fs-4x lh-1 ls-n1 mb-1">{{$tidaklayakTB-$UAtuntutan7}}</span>
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
							<div class="tab-pane fade" id="bkoku2" role="tabpanel" aria-labelledby="bkoku2-tab">
								{{-- Permohonan --}}
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
														<a href="{{ route('keseluruhanUA.permohonan', ['status' => '!=9']) }}">
															<span class="text-white fw-bolder d-block fs-4x lh-1 ls-n1 mb-1">{{ $UApermohonanAll }}</span>
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
														<a href="{{ route('statusUA.permohonan', ['status' => '1']) }}">
															<span class="text-white fw-bolder d-block fs-4x lh-1 ls-n1 mb-1">{{$UApermohonan1}}</span>
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
														<a href="{{ route('statusUA.permohonan', ['status' => '2']) }}">
															<span class="text-white fw-bolder d-block fs-4x lh-1 ls-n1 mb-1">{{$UApermohonan2}}</span>
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
															<span class="text-white fw-bolder d-block fs-4x lh-1 ls-n1 mb-1">{{$UApermohonan3}}</span>
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
															<span class="text-white fw-bolder d-block fs-4x lh-1 ls-n1 mb-1">{{$UApermohonan4}}</span>
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
															<span class="text-white fw-bolder d-block fs-4x lh-1 ls-n1 mb-1">{{$UApermohonan5}}</span>
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
														<a href="{{ route('statusUA.permohonan', ['status' => '8']) }}">
															<span class="text-white fw-bolder d-block fs-4x lh-1 ls-n1 mb-1">{{$UApermohonan8}}</span>
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
														<a href="{{ route('statusUA.permohonan', ['status' => '6']) }}">
															<span class="text-white fw-bolder d-block fs-4x lh-1 ls-n1 mb-1">{{$UApermohonan6}}</span>
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
														<a href="{{ route('statusUA.permohonan', ['status' => '7']) }}">
															<span class="text-white fw-bolder d-block fs-4x lh-1 ls-n1 mb-1">{{$UApermohonan7}}</span>
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
													<a href="{{ route('keseluruhanUA.tuntutan', ['status' => '!=9']) }}">
														<span class="text-white fw-bolder d-block fs-4x lh-1 ls-n1 mb-1">{{$UAtuntutanAll}}</span>
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
													<a href="{{ route('statusUA.tuntutan', ['status' => '1']) }}">
														<span class="text-white fw-bolder d-block fs-4x lh-1 ls-n1 mb-1">{{$UAtuntutan1}}</span>
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
													<a href="{{ route('statusUA.tuntutan', ['status' => '2']) }}">
														<span class="text-white fw-bolder d-block fs-4x lh-1 ls-n1 mb-1">{{$UAtuntutan2}}</span>
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
														<span class="text-white fw-bolder d-block fs-4x lh-1 ls-n1 mb-1">{{$UAtuntutan3}}</span>
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
														<span class="text-white fw-bolder d-block fs-4x lh-1 ls-n1 mb-1">{{$UAtuntutan4}}</span>
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
														<span class="text-white fw-bolder d-block fs-4x lh-1 ls-n1 mb-1">{{$UAtuntutan5}}</span>
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
													<a href="{{ route('statusUA.tuntutan', ['status' => '8']) }}">
														<span class="text-white fw-bolder d-block fs-4x lh-1 ls-n1 mb-1">{{$UAtuntutan8}}</span>
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
													<a href="{{ route('statusUA.tuntutan', ['status' => '6']) }}">
														<span class="text-white fw-bolder d-block fs-4x lh-1 ls-n1 mb-1">{{$UAtuntutan6}}</span>
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
													<a href="{{ route('statusUA.tuntutan', ['status' => '7']) }}">
														<span class="text-white fw-bolder d-block fs-4x lh-1 ls-n1 mb-1">{{$UAtuntutan7}}</span>
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
										<div class="col-4">
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
													<a href="{{ route('keseluruhanP.permohonan', ['status' => '!=9']) }}">
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
										<div class="col-4">
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
										<div class="col-4">
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
														<span class="text-white fw-bolder d-block fs-4x lh-1 ls-n1 mb-1">{{$saringanP}}</span>
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
														<span class="text-white fw-bolder d-block fs-4x lh-1 ls-n1 mb-1">{{$dikembalikanP}}</span>
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
													<a href="{{ route('statusP.permohonan', ['status' => '8']) }}">
														<span class="text-white fw-bolder d-block fs-4x lh-1 ls-n1 mb-1">{{$dibayarP}}</span>
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
										<div class="col-4">
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
										<div class="col-4">
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
													<a href="{{ route('keseluruhanP.tuntutan', ['status' => '!=9']) }}">
														<span class="text-white fw-bolder d-block fs-4x lh-1 ls-n1 mb-1">{{$keseluruhanTP}}</span>
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
													<a href="{{ route('statusP.tuntutan', ['status' => '1']) }}">
														<span class="text-white fw-bolder d-block fs-4x lh-1 ls-n1 mb-1">{{$derafTP}}</span>
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
													<a href="{{ route('statusP.tuntutan', ['status' => '2']) }}">
														<span class="text-white fw-bolder d-block fs-4x lh-1 ls-n1 mb-1">{{$baharuTP}}</span>
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
														<span class="text-white fw-bolder d-block fs-4x lh-1 ls-n1 mb-1">{{$saringanTP}}</span>
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
														<span class="text-white fw-bolder d-block fs-4x lh-1 ls-n1 mb-1">{{$disokongTP}}</span>
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
														<span class="text-white fw-bolder d-block fs-4x lh-1 ls-n1 mb-1">{{$dikembalikanTP}}</span>
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
													<a href="{{ route('statusP.tuntutan', ['status' => '8']) }}">
														<span class="text-white fw-bolder d-block fs-4x lh-1 ls-n1 mb-1">{{$dibayarTP}}</span>
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
													<a href="{{ route('statusP.tuntutan', ['status' => '6']) }}">
														<span class="text-white fw-bolder d-block fs-4x lh-1 ls-n1 mb-1">{{$layakTP}}</span>
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
													<a href="{{ route('statusP.tuntutan', ['status' => '7']) }}">
														<span class="text-white fw-bolder d-block fs-4x lh-1 ls-n1 mb-1">{{$tidaklayakTP}}</span>
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

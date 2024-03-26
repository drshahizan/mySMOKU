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
							<h2>Bilangan Permohonan dan Tuntutan<br><small>Sila klik tab BKOKU IPTS, BKOKU POLI, BKOKU KK, BKOKU UA atau PPK untuk lihat jumlah terperinci.</small></h2>
						</div>

						{{-- COUNT PERMOHONAN --}}
						{{-- @php
							$keseluruhanIPTS = DB::table('permohonan')
							->join('smoku_akademik', 'permohonan.smoku_id', '=', 'smoku_akademik.smoku_id')
							->join('bk_info_institusi', 'smoku_akademik.id_institusi', '=', 'bk_info_institusi.id_institusi')
							->where('program', 'BKOKU')
							->where('bk_info_institusi.jenis_institusi', 'IPTS') 
							->count();
						
							$derafIPTS = DB::table('permohonan')
							->join('smoku_akademik', 'permohonan.smoku_id', '=', 'smoku_akademik.smoku_id')
							->join('bk_info_institusi', 'smoku_akademik.id_institusi', '=', 'bk_info_institusi.id_institusi')
							->where('permohonan.status', '=', '1')
							->where('program', 'BKOKU')
							->where('bk_info_institusi.jenis_institusi', 'IPTS') 
							->count();

							$baharuIPTS = DB::table('permohonan')
							->join('smoku_akademik', 'permohonan.smoku_id', '=', 'smoku_akademik.smoku_id')
							->join('bk_info_institusi', 'smoku_akademik.id_institusi', '=', 'bk_info_institusi.id_institusi')
							->where('permohonan.status', '=', '2')
							->where('program', 'BKOKU')
							->where('bk_info_institusi.jenis_institusi', 'IPTS') 
							->count();

							$saringanIPTS = DB::table('permohonan')
							->join('smoku_akademik', 'permohonan.smoku_id', '=', 'smoku_akademik.smoku_id')
							->join('bk_info_institusi', 'smoku_akademik.id_institusi', '=', 'bk_info_institusi.id_institusi')
							->where('permohonan.status', '=', '3')
							->where('program', 'BKOKU')
							->where('bk_info_institusi.jenis_institusi', 'IPTS') 
							->count();

							$disokongIPTS = DB::table('permohonan')
							->join('smoku_akademik', 'permohonan.smoku_id', '=', 'smoku_akademik.smoku_id')
							->join('bk_info_institusi', 'smoku_akademik.id_institusi', '=', 'bk_info_institusi.id_institusi')
							->where('permohonan.status', '=', '4')
							->where('program', 'BKOKU')
							->where('bk_info_institusi.jenis_institusi', 'IPTS') 
							->count();

							$dikembalikanIPTS = DB::table('permohonan')
							->join('smoku_akademik', 'permohonan.smoku_id', '=', 'smoku_akademik.smoku_id')
							->join('bk_info_institusi', 'smoku_akademik.id_institusi', '=', 'bk_info_institusi.id_institusi')
							->where('permohonan.status', '=', '5')
							->where('program', 'BKOKU')
							->where('bk_info_institusi.jenis_institusi', 'IPTS') 
							->count();

							$layakIPTS = DB::table('permohonan')
							->join('smoku_akademik', 'permohonan.smoku_id', '=', 'smoku_akademik.smoku_id')
							->join('bk_info_institusi', 'smoku_akademik.id_institusi', '=', 'bk_info_institusi.id_institusi')
							->where('permohonan.status', '=', '6')
							->where('program', 'BKOKU')
							->where('bk_info_institusi.jenis_institusi', 'IPTS') 
							->count();

							$tidaklayakIPTS = DB::table('permohonan')
							->join('smoku_akademik', 'permohonan.smoku_id', '=', 'smoku_akademik.smoku_id')
							->join('bk_info_institusi', 'smoku_akademik.id_institusi', '=', 'bk_info_institusi.id_institusi')
							->where('permohonan.status', '=', '7')
							->where('program', 'BKOKU')
							->where('bk_info_institusi.jenis_institusi', 'IPTS') 
							->count();

							$dibayarIPTS = DB::table('permohonan')
							->join('smoku_akademik', 'permohonan.smoku_id', '=', 'smoku_akademik.smoku_id')
							->join('bk_info_institusi', 'smoku_akademik.id_institusi', '=', 'bk_info_institusi.id_institusi')
							->where('permohonan.status', '=', '8')
							->where('program', 'BKOKU')
							->where('bk_info_institusi.jenis_institusi', 'IPTS') 
							->count();
						@endphp --}}
						@php
							$permohonanIPTS = DB::table('permohonan')
								->join('smoku_akademik', 'permohonan.smoku_id', '=', 'smoku_akademik.smoku_id')
								->join('bk_info_institusi', 'smoku_akademik.id_institusi', '=', 'bk_info_institusi.id_institusi')
								->selectRaw('
									COUNT(CASE WHEN permohonan.status NOT IN (9, 10) THEN 1 END) AS keseluruhanIPTS,
									COUNT(CASE WHEN permohonan.status = 1 THEN 1 END) AS derafIPTS,
									COUNT(CASE WHEN permohonan.status = 2 THEN 1 END) AS baharuIPTS,
									COUNT(CASE WHEN permohonan.status = 3 THEN 1 END) AS saringanIPTS,
									COUNT(CASE WHEN permohonan.status = 4 THEN 1 END) AS disokongIPTS,
									COUNT(CASE WHEN permohonan.status = 5 THEN 1 END) AS dikembalikanIPTS,
									COUNT(CASE WHEN permohonan.status = 6 THEN 1 END) AS layakIPTS,
									COUNT(CASE WHEN permohonan.status = 7 THEN 1 END) AS tidaklayakIPTS,
									COUNT(CASE WHEN permohonan.status = 8 THEN 1 END) AS dibayarIPTS
								')
								->where('program', 'BKOKU')
								->where('bk_info_institusi.jenis_institusi', 'IPTS')
								->first();
							
							$keseluruhanIPTS = $permohonanIPTS->keseluruhanIPTS ?? 0;
							$derafIPTS = $permohonanIPTS->derafIPTS ?? 0;
							$baharuIPTS = $permohonanIPTS->baharuIPTS ?? 0;
							$saringanIPTS = $permohonanIPTS->saringanIPTS ?? 0;
							$disokongIPTS = $permohonanIPTS->disokongIPTS ?? 0;
							$dikembalikanIPTS = $permohonanIPTS->dikembalikanIPTS ?? 0;
							$layakIPTS = $permohonanIPTS->layakIPTS ?? 0;
							$tidaklayakIPTS = $permohonanIPTS->tidaklayakIPTS ?? 0;
							$dibayarIPTS = $permohonanIPTS->dibayarIPTS ?? 0;
						@endphp

						@php
							$permohonanPOLI = DB::table('permohonan')
								->join('smoku_akademik', 'permohonan.smoku_id', '=', 'smoku_akademik.smoku_id')
								->join('bk_info_institusi', 'smoku_akademik.id_institusi', '=', 'bk_info_institusi.id_institusi')
								->selectRaw('
									COUNT(CASE WHEN permohonan.status NOT IN (9, 10) THEN 1 END) AS keseluruhanPOLI,
									COUNT(CASE WHEN permohonan.status = 1 THEN 1 END) AS derafPOLI,
									COUNT(CASE WHEN permohonan.status = 2 THEN 1 END) AS baharuPOLI,
									COUNT(CASE WHEN permohonan.status = 3 THEN 1 END) AS saringanPOLI,
									COUNT(CASE WHEN permohonan.status = 4 THEN 1 END) AS disokongPOLI,
									COUNT(CASE WHEN permohonan.status = 5 THEN 1 END) AS dikembalikanPOLI,
									COUNT(CASE WHEN permohonan.status = 6 THEN 1 END) AS layakPOLI,
									COUNT(CASE WHEN permohonan.status = 7 THEN 1 END) AS tidaklayakPOLI,
									COUNT(CASE WHEN permohonan.status = 8 THEN 1 END) AS dibayarPOLI
								')
								->where('program', 'BKOKU')
								->where('bk_info_institusi.jenis_institusi', 'P')
								->first();
							
							$keseluruhanPOLI = $permohonanPOLI->keseluruhanPOLI ?? 0;
							$derafPOLI = $permohonanPOLI->derafPOLI ?? 0;
							$baharuPOLI = $permohonanPOLI->baharuPOLI ?? 0;
							$saringanPOLI = $permohonanPOLI->saringanPOLI ?? 0;
							$disokongPOLI = $permohonanPOLI->disokongPOLI ?? 0;
							$dikembalikanPOLI = $permohonanPOLI->dikembalikanPOLI ?? 0;
							$layakPOLI = $permohonanPOLI->layakPOLI ?? 0;
							$tidaklayakPOLI = $permohonanPOLI->tidaklayakPOLI ?? 0;
							$dibayarPOLI = $permohonanPOLI->dibayarPOLI ?? 0;
						@endphp

						@php
							$permohonanKK = DB::table('permohonan')
								->join('smoku_akademik', 'permohonan.smoku_id', '=', 'smoku_akademik.smoku_id')
								->join('bk_info_institusi', 'smoku_akademik.id_institusi', '=', 'bk_info_institusi.id_institusi')
								->selectRaw('
									COUNT(CASE WHEN permohonan.status NOT IN (9, 10) THEN 1 END) AS keseluruhanKK,
									COUNT(CASE WHEN permohonan.status = 1 THEN 1 END) AS derafKK,
									COUNT(CASE WHEN permohonan.status = 2 THEN 1 END) AS baharuKK,
									COUNT(CASE WHEN permohonan.status = 3 THEN 1 END) AS saringanKK,
									COUNT(CASE WHEN permohonan.status = 4 THEN 1 END) AS disokongKK,
									COUNT(CASE WHEN permohonan.status = 5 THEN 1 END) AS dikembalikanKK,
									COUNT(CASE WHEN permohonan.status = 6 THEN 1 END) AS layakKK,
									COUNT(CASE WHEN permohonan.status = 7 THEN 1 END) AS tidaklayakKK,
									COUNT(CASE WHEN permohonan.status = 8 THEN 1 END) AS dibayarKK
								')
								->where('program', 'BKOKU')
								->where('bk_info_institusi.jenis_institusi', 'KK')
								->first();

							$keseluruhanKK = $permohonanKK->keseluruhanKK ?? 0;
							$derafKK = $permohonanKK->derafKK ?? 0;
							$baharuKK = $permohonanKK->baharuKK ?? 0;
							$saringanKK = $permohonanKK->saringanKK ?? 0;
							$disokongKK = $permohonanKK->disokongKK ?? 0;
							$dikembalikanKK = $permohonanKK->dikembalikanKK ?? 0;
							$layakKK = $permohonanKK->layakKK ?? 0;
							$tidaklayakKK = $permohonanKK->tidaklayakKK ?? 0;
							$dibayarKK = $permohonanKK->dibayarKK ?? 0;
						@endphp

						@php
							$permohonanUA = DB::table('permohonan')
								->join('smoku_akademik', 'permohonan.smoku_id', '=', 'smoku_akademik.smoku_id')
								->join('bk_info_institusi', 'smoku_akademik.id_institusi', '=', 'bk_info_institusi.id_institusi')
								->selectRaw('
									COUNT(CASE WHEN permohonan.status NOT IN (9, 10) THEN 1 END) AS keseluruhanUA,
									COUNT(CASE WHEN permohonan.status = 1 THEN 1 END) AS derafUA,
									COUNT(CASE WHEN permohonan.status = 2 THEN 1 END) AS baharuUA,
									COUNT(CASE WHEN permohonan.status = 3 THEN 1 END) AS saringanUA,
									COUNT(CASE WHEN permohonan.status = 4 THEN 1 END) AS disokongUA,
									COUNT(CASE WHEN permohonan.status = 5 THEN 1 END) AS dikembalikanUA,
									COUNT(CASE WHEN permohonan.status = 6 THEN 1 END) AS layakUA,
									COUNT(CASE WHEN permohonan.status = 7 THEN 1 END) AS tidaklayakUA,
									COUNT(CASE WHEN permohonan.status = 8 THEN 1 END) AS dibayarUA
								')
								->where('program', 'BKOKU')
								->where('bk_info_institusi.jenis_institusi', 'UA')
								->first();

							$keseluruhanUA = $permohonanUA->keseluruhanUA ?? 0;
							$derafUA = $permohonanUA->derafUA ?? 0;
							$baharuUA = $permohonanUA->baharuUA ?? 0;
							$saringanUA = $permohonanUA->saringanUA ?? 0;
							$disokongUA = $permohonanUA->disokongUA ?? 0;
							$dikembalikanUA = $permohonanUA->dikembalikanUA ?? 0;
							$layakUA = $permohonanUA->layakUA ?? 0;
							$tidaklayakUA = $permohonanUA->tidaklayakUA ?? 0;
							$dibayarUA = $permohonanUA->dibayarUA ?? 0;
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
						{{-- @php
							$keseluruhanTuntutanIPTS = DB::table('tuntutan')->join('permohonan', 'permohonan.id', '=', 'tuntutan.permohonan_id')
														->join('smoku_akademik', 'permohonan.smoku_id', '=', 'smoku_akademik.smoku_id')
														->join('bk_info_institusi', 'smoku_akademik.id_institusi', '=', 'bk_info_institusi.id_institusi')
														->where('permohonan.program','=','BKOKU')
														->where('bk_info_institusi.jenis_institusi', 'IPTS')
														->where('tuntutan.status', '!=', 9)
														->count();
							$derafTuntutanIPTS = DB::table('tuntutan')->join('permohonan', 'permohonan.id', '=', 'tuntutan.permohonan_id')
													->join('smoku_akademik', 'permohonan.smoku_id', '=', 'smoku_akademik.smoku_id')
													->join('bk_info_institusi', 'smoku_akademik.id_institusi', '=', 'bk_info_institusi.id_institusi')
													->where('permohonan.program','=','BKOKU')
													->where('bk_info_institusi.jenis_institusi', 'IPTS')
													->where('tuntutan.status', '=', 1)
													->count();
							$baharuTuntutanIPTS = DB::table('tuntutan')->join('permohonan', 'permohonan.id', '=', 'tuntutan.permohonan_id')
													->join('smoku_akademik', 'permohonan.smoku_id', '=', 'smoku_akademik.smoku_id')
													->join('bk_info_institusi', 'smoku_akademik.id_institusi', '=', 'bk_info_institusi.id_institusi')
													->where('permohonan.program','=','BKOKU')
													->where('bk_info_institusi.jenis_institusi', 'IPTS')
													->where('tuntutan.status', '=', 2)
													->count();
							$saringanTuntutanIPTS = DB::table('tuntutan')->join('permohonan', 'permohonan.id', '=', 'tuntutan.permohonan_id')
													->join('smoku_akademik', 'permohonan.smoku_id', '=', 'smoku_akademik.smoku_id')
													->join('bk_info_institusi', 'smoku_akademik.id_institusi', '=', 'bk_info_institusi.id_institusi')
													->where('permohonan.program','=','BKOKU')
													->where('bk_info_institusi.jenis_institusi', 'IPTS')
													->where('tuntutan.status', '=', 3)
													->count();
							$disokongTuntutanIPTS = DB::table('tuntutan')->join('permohonan', 'permohonan.id', '=', 'tuntutan.permohonan_id')
													->join('smoku_akademik', 'permohonan.smoku_id', '=', 'smoku_akademik.smoku_id')
													->join('bk_info_institusi', 'smoku_akademik.id_institusi', '=', 'bk_info_institusi.id_institusi')
													->where('permohonan.program','=','BKOKU')
													->where('bk_info_institusi.jenis_institusi', 'IPTS')
													->where('tuntutan.status', '=', 4)
													->count();
							$dikembalikanTuntutanIPTS = DB::table('tuntutan')->join('permohonan', 'permohonan.id', '=', 'tuntutan.permohonan_id')
													->join('smoku_akademik', 'permohonan.smoku_id', '=', 'smoku_akademik.smoku_id')
													->join('bk_info_institusi', 'smoku_akademik.id_institusi', '=', 'bk_info_institusi.id_institusi')
													->where('permohonan.program','=','BKOKU')
													->where('bk_info_institusi.jenis_institusi', 'IPTS')
													->where('tuntutan.status', '=', 5)
													->count();
							$layakTuntutanIPTS = DB::table('tuntutan')->join('permohonan', 'permohonan.id', '=', 'tuntutan.permohonan_id')
													->join('smoku_akademik', 'permohonan.smoku_id', '=', 'smoku_akademik.smoku_id')
													->join('bk_info_institusi', 'smoku_akademik.id_institusi', '=', 'bk_info_institusi.id_institusi')
													->where('permohonan.program','=','BKOKU')
													->where('bk_info_institusi.jenis_institusi', 'IPTS')
													->where('tuntutan.status', '=', 6)
													->count();
							$tidakLayakTuntutanIPTS = DB::table('tuntutan')->join('permohonan', 'permohonan.id', '=', 'tuntutan.permohonan_id')
													->join('smoku_akademik', 'permohonan.smoku_id', '=', 'smoku_akademik.smoku_id')
													->join('bk_info_institusi', 'smoku_akademik.id_institusi', '=', 'bk_info_institusi.id_institusi')
													->where('permohonan.program','=','BKOKU')
													->where('bk_info_institusi.jenis_institusi', 'IPTS')
													->where('tuntutan.status', '=', 7)
													->count();
							$dibayarTuntutanIPTS = DB::table('tuntutan')->join('permohonan', 'permohonan.id', '=', 'tuntutan.permohonan_id')
													->join('smoku_akademik', 'permohonan.smoku_id', '=', 'smoku_akademik.smoku_id')
													->join('bk_info_institusi', 'smoku_akademik.id_institusi', '=', 'bk_info_institusi.id_institusi')
													->where('permohonan.program','=','BKOKU')
													->where('bk_info_institusi.jenis_institusi', 'IPTS')
													->where('tuntutan.status', '=', 8)
													->count();
						@endphp --}}
						@php
							$tuntutanIPTS = DB::table('tuntutan')
												->join('permohonan', 'permohonan.id', '=', 'tuntutan.permohonan_id')
												->join('smoku_akademik', 'permohonan.smoku_id', '=', 'smoku_akademik.smoku_id')
												->join('bk_info_institusi', 'smoku_akademik.id_institusi', '=', 'bk_info_institusi.id_institusi')
												->where('permohonan.program','=','BKOKU')
												->where('bk_info_institusi.jenis_institusi', 'IPTS')
												->select(
													DB::raw('COUNT(CASE WHEN tuntutan.status NOT IN (9, 10) THEN 1 END) AS keseluruhanTuntutanIPTS'),
													DB::raw('COUNT(CASE WHEN tuntutan.status != 9 THEN 1 END) AS keseluruhanTuntutanIPTS'),
													DB::raw('COUNT(CASE WHEN tuntutan.status = 1 THEN 1 END) AS derafTuntutanIPTS'),
													DB::raw('COUNT(CASE WHEN tuntutan.status = 2 THEN 1 END) AS baharuTuntutanIPTS'),
													DB::raw('COUNT(CASE WHEN tuntutan.status = 3 THEN 1 END) AS saringanTuntutanIPTS'),
													DB::raw('COUNT(CASE WHEN tuntutan.status = 4 THEN 1 END) AS disokongTuntutanIPTS'),
													DB::raw('COUNT(CASE WHEN tuntutan.status = 5 THEN 1 END) AS dikembalikanTuntutanIPTS'),
													DB::raw('COUNT(CASE WHEN tuntutan.status = 6 THEN 1 END) AS layakTuntutanIPTS'),
													DB::raw('COUNT(CASE WHEN tuntutan.status = 7 THEN 1 END) AS tidakLayakTuntutanIPTS'),
													DB::raw('COUNT(CASE WHEN tuntutan.status = 8 THEN 1 END) AS dibayarTuntutanIPTS')
												)
												->first();

							// Access the counts like this:
							$keseluruhanTuntutanIPTS = $tuntutanIPTS->keseluruhanTuntutanIPTS ?? 0;
							$derafTuntutanIPTS = $tuntutanIPTS->derafTuntutanIPTS ?? 0;
							$baharuTuntutanIPTS = $tuntutanIPTS->baharuTuntutanIPTS ?? 0;
							$saringanTuntutanIPTS = $tuntutanIPTS->saringanTuntutanIPTS ?? 0;
							$disokongTuntutanIPTS = $tuntutanIPTS->disokongTuntutanIPTS ?? 0;
							$dikembalikanTuntutanIPTS = $tuntutanIPTS->dikembalikanTuntutanIPTS ?? 0;
							$layakTuntutanIPTS = $tuntutanIPTS->layakTuntutanIPTS ?? 0;
							$tidakLayakTuntutanIPTS = $tuntutanIPTS->tidakLayakTuntutanIPTS ?? 0;
							$dibayarTuntutanIPTS = $tuntutanIPTS->dibayarTuntutanIPTS ?? 0;
						@endphp

						@php
							$tuntutanPOLI = DB::table('tuntutan')
												->join('permohonan', 'permohonan.id', '=', 'tuntutan.permohonan_id')
												->join('smoku_akademik', 'permohonan.smoku_id', '=', 'smoku_akademik.smoku_id')
												->join('bk_info_institusi', 'smoku_akademik.id_institusi', '=', 'bk_info_institusi.id_institusi')
												->where('permohonan.program','=','BKOKU')
												->where('bk_info_institusi.jenis_institusi', 'P')
												->select(
													DB::raw('COUNT(CASE WHEN tuntutan.status NOT IN (9, 10) THEN 1 END) AS keseluruhanTuntutanPOLI'),
													DB::raw('COUNT(CASE WHEN tuntutan.status = 1 THEN 1 END) AS derafTuntutanPOLI'),
													DB::raw('COUNT(CASE WHEN tuntutan.status = 2 THEN 1 END) AS baharuTuntutanPOLI'),
													DB::raw('COUNT(CASE WHEN tuntutan.status = 3 THEN 1 END) AS saringanTuntutanPOLI'),
													DB::raw('COUNT(CASE WHEN tuntutan.status = 4 THEN 1 END) AS disokongTuntutanPOLI'),
													DB::raw('COUNT(CASE WHEN tuntutan.status = 5 THEN 1 END) AS dikembalikanTuntutanPOLI'),
													DB::raw('COUNT(CASE WHEN tuntutan.status = 6 THEN 1 END) AS layakTuntutanPOLI'),
													DB::raw('COUNT(CASE WHEN tuntutan.status = 7 THEN 1 END) AS tidakLayakTuntutanPOLI'),
													DB::raw('COUNT(CASE WHEN tuntutan.status = 8 THEN 1 END) AS dibayarTuntutanPOLI')
												)
												->first();

							// Access the counts like this:
							$keseluruhanTuntutanPOLI = $tuntutanPOLI->keseluruhanTuntutanPOLI ?? 0;
							$derafTuntutanPOLI = $tuntutanPOLI->derafTuntutanPOLI ?? 0;
							$baharuTuntutanPOLI = $tuntutanPOLI->baharuTuntutanPOLI ?? 0;
							$saringanTuntutanPOLI = $tuntutanPOLI->saringanTuntutanPOLI ?? 0;
							$disokongTuntutanPOLI = $tuntutanPOLI->disokongTuntutanPOLI ?? 0;
							$dikembalikanTuntutanPOLI = $tuntutanPOLI->dikembalikanTuntutanPOLI ?? 0;
							$layakTuntutanPOLI = $tuntutanPOLI->layakTuntutanPOLI ?? 0;
							$tidakLayakTuntutanPOLI = $tuntutanPOLI->tidakLayakTuntutanPOLI ?? 0;
							$dibayarTuntutanPOLI = $tuntutanPOLI->dibayarTuntutanPOLI ?? 0;
						@endphp

						@php
							$tuntutanKK = DB::table('tuntutan')
												->join('permohonan', 'permohonan.id', '=', 'tuntutan.permohonan_id')
												->join('smoku_akademik', 'permohonan.smoku_id', '=', 'smoku_akademik.smoku_id')
												->join('bk_info_institusi', 'smoku_akademik.id_institusi', '=', 'bk_info_institusi.id_institusi')
												->where('permohonan.program','=','BKOKU')
												->where('bk_info_institusi.jenis_institusi', 'KK')
												->select(
													DB::raw('COUNT(CASE WHEN tuntutan.status NOT IN (9, 10) THEN 1 END) AS keseluruhanTuntutanKK'),
													DB::raw('COUNT(CASE WHEN tuntutan.status != 9 THEN 1 END) AS keseluruhanTuntutanKK'),
													DB::raw('COUNT(CASE WHEN tuntutan.status = 1 THEN 1 END) AS derafTuntutanKK'),
													DB::raw('COUNT(CASE WHEN tuntutan.status = 2 THEN 1 END) AS baharuTuntutanKK'),
													DB::raw('COUNT(CASE WHEN tuntutan.status = 3 THEN 1 END) AS saringanTuntutanKK'),
													DB::raw('COUNT(CASE WHEN tuntutan.status = 4 THEN 1 END) AS disokongTuntutanKK'),
													DB::raw('COUNT(CASE WHEN tuntutan.status = 5 THEN 1 END) AS dikembalikanTuntutanKK'),
													DB::raw('COUNT(CASE WHEN tuntutan.status = 6 THEN 1 END) AS layakTuntutanKK'),
													DB::raw('COUNT(CASE WHEN tuntutan.status = 7 THEN 1 END) AS tidakLayakTuntutanKK'),
													DB::raw('COUNT(CASE WHEN tuntutan.status = 8 THEN 1 END) AS dibayarTuntutanKK')
												)
												->first();

							// Access the counts like this:
							$keseluruhanTuntutanKK = $tuntutanKK->keseluruhanTuntutanKK ?? 0;
							$derafTuntutanKK = $tuntutanKK->derafTuntutanKK ?? 0;
							$baharuTuntutanKK = $tuntutanKK->baharuTuntutanKK ?? 0;
							$saringanTuntutanKK = $tuntutanKK->saringanTuntutanKK ?? 0;
							$disokongTuntutanKK = $tuntutanKK->disokongTuntutanKK ?? 0;
							$dikembalikanTuntutanKK = $tuntutanKK->dikembalikanTuntutanKK ?? 0;
							$layakTuntutanKK = $tuntutanKK->layakTuntutanKK ?? 0;
							$tidakLayakTuntutanKK = $tuntutanKK->tidakLayakTuntutanKK ?? 0;
							$dibayarTuntutanKK = $tuntutanKK->dibayarTuntutanKK ?? 0;
						@endphp

						@php
							$tuntutanUA = DB::table('tuntutan')
												->join('permohonan', 'permohonan.id', '=', 'tuntutan.permohonan_id')
												->join('smoku_akademik', 'permohonan.smoku_id', '=', 'smoku_akademik.smoku_id')
												->join('bk_info_institusi', 'smoku_akademik.id_institusi', '=', 'bk_info_institusi.id_institusi')
												->where('permohonan.program','=','BKOKU')
												->where('bk_info_institusi.jenis_institusi', 'UA')
												->select(
													DB::raw('COUNT(CASE WHEN tuntutan.status NOT IN (9, 10) THEN 1 END) AS keseluruhanTuntutanUA'),
													DB::raw('COUNT(CASE WHEN tuntutan.status = 1 THEN 1 END) AS derafTuntutanUA'),
													DB::raw('COUNT(CASE WHEN tuntutan.status = 2 THEN 1 END) AS baharuTuntutanUA'),
													DB::raw('COUNT(CASE WHEN tuntutan.status = 3 THEN 1 END) AS saringanTuntutanUA'),
													DB::raw('COUNT(CASE WHEN tuntutan.status = 4 THEN 1 END) AS disokongTuntutanUA'),
													DB::raw('COUNT(CASE WHEN tuntutan.status = 5 THEN 1 END) AS dikembalikanTuntutanUA'),
													DB::raw('COUNT(CASE WHEN tuntutan.status = 6 THEN 1 END) AS layakTuntutanUA'),
													DB::raw('COUNT(CASE WHEN tuntutan.status = 7 THEN 1 END) AS tidakLayakTuntutanUA'),
													DB::raw('COUNT(CASE WHEN tuntutan.status = 8 THEN 1 END) AS dibayarTuntutanUA')
												)
												->first();

							// Access the counts like this:
							$keseluruhanTuntutanUA = $tuntutanUA->keseluruhanTuntutanUA ?? 0;
							$derafTuntutanUA = $tuntutanUA->derafTuntutanUA ?? 0;
							$baharuTuntutanUA = $tuntutanUA->baharuTuntutanUA ?? 0;
							$saringanTuntutanUA = $tuntutanUA->saringanTuntutanUA ?? 0;
							$disokongTuntutanUA = $tuntutanUA->disokongTuntutanUA ?? 0;
							$dikembalikanTuntutanUA = $tuntutanUA->dikembalikanTuntutanUA ?? 0;
							$layakTuntutanUA = $tuntutanUA->layakTuntutanUA ?? 0;
							$tidakLayakTuntutanUA = $tuntutanUA->tidakLayakTuntutanUA ?? 0;
							$dibayarTuntutanUA = $tuntutanUA->dibayarTuntutanUA ?? 0;
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
								<button class="nav-link active" id="bkokuIPTS-tab" data-toggle="tab" data-target="#bkokuIPTS" type="button" role="tab" aria-controls="bkokuIPTS" aria-selected="true">BKOKU IPTS</button>
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
							{{-- BKOKU IPTS --}}
							<div class="tab-pane fade show active" id="bkokuIPTS" role="tabpanel" aria-labelledby="bkokuIPTS-tab">
								{{-- Permohonan --}}
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
													<a href="{{ route('keseluruhanIPTS.permohonan') }}">
														<span class="text-white fw-bolder d-block fs-4x lh-1 ls-n1 mb-1">{{$keseluruhanIPTS}}</span>
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
													<a href="{{ route('statusIPTS.permohonan', ['status' => '1']) }}">
														<span class="text-white fw-bolder d-block fs-4x lh-1 ls-n1 mb-1">{{$derafIPTS}}</span>
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
													<a href="{{ route('statusIPTS.permohonan', ['status' => '2']) }}">
														<span class="text-white fw-bolder d-block fs-4x lh-1 ls-n1 mb-1">{{$baharuIPTS}}</span>
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
														<span class="text-white fw-bolder d-block fs-4x lh-1 ls-n1 mb-1">{{$saringanIPTS}}</span>
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
														<span class="text-white fw-bolder d-block fs-4x lh-1 ls-n1 mb-1">{{$disokongIPTS}}</span>
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
														<span class="text-white fw-bolder d-block fs-4x lh-1 ls-n1 mb-1">{{$dikembalikanIPTS}}</span>
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
													<a href="{{ route('statusIPTS.permohonan', ['status' => '8']) }}">
														<span class="text-white fw-bolder d-block fs-4x lh-1 ls-n1 mb-1">{{$dibayarIPTS}}</span>
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
													<a href="{{ route('statusIPTS.permohonan', ['status' => '6']) }}">
														<span class="text-white fw-bolder d-block fs-4x lh-1 ls-n1 mb-1">{{$layakIPTS}}</span>
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
													<a href="{{ route('statusIPTS.permohonan', ['status' => '7']) }}">
														<span class="text-white fw-bolder d-block fs-4x lh-1 ls-n1 mb-1">{{$tidaklayakIPTS}}</span>
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
													<a href="{{ route('keseluruhanIPTS.tuntutan', ['status' => '!=9']) }}">
														<span class="text-white fw-bolder d-block fs-4x lh-1 ls-n1 mb-1">{{$keseluruhanTuntutanIPTS}}</span>
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
													<a href="{{ route('statusIPTS.tuntutan', ['status' => '1']) }}">
														<span class="text-white fw-bolder d-block fs-4x lh-1 ls-n1 mb-1">{{$derafTuntutanIPTS}}</span>
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
													<a href="{{ route('statusIPTS.tuntutan', ['status' => '2']) }}">
														<span class="text-white fw-bolder d-block fs-4x lh-1 ls-n1 mb-1">{{$baharuTuntutanIPTS}}</span>
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
														<span class="text-white fw-bolder d-block fs-4x lh-1 ls-n1 mb-1">{{$saringanTuntutanIPTS}}</span>
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
														<span class="text-white fw-bolder d-block fs-4x lh-1 ls-n1 mb-1">{{$disokongTuntutanIPTS}}</span>
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
														<span class="text-white fw-bolder d-block fs-4x lh-1 ls-n1 mb-1">{{$dikembalikanTuntutanIPTS}}</span>
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
													<a href="{{ route('statusIPTS.tuntutan', ['status' => '8']) }}">
														<span class="text-white fw-bolder d-block fs-4x lh-1 ls-n1 mb-1">{{$dibayarTuntutanIPTS}}</span>
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
													<a href="{{ route('statusIPTS.tuntutan', ['status' => '6']) }}">
														<span class="text-white fw-bolder d-block fs-4x lh-1 ls-n1 mb-1">{{$layakTuntutanIPTS}}</span>
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
													<a href="{{ route('statusIPTS.tuntutan', ['status' => '7']) }}">
														<span class="text-white fw-bolder d-block fs-4x lh-1 ls-n1 mb-1">{{$tidakLayakTuntutanIPTS}}</span>
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
								{{-- Permohonan --}}
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
													<a href="{{ route('keseluruhanPOLI.permohonan') }}">
														<span class="text-white fw-bolder d-block fs-4x lh-1 ls-n1 mb-1">{{$keseluruhanPOLI}}</span>
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
													<a href="{{ route('statusPOLI.permohonan', ['status' => '1']) }}">
														<span class="text-white fw-bolder d-block fs-4x lh-1 ls-n1 mb-1">{{$derafPOLI}}</span>
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
													<a href="{{ route('statusPOLI.permohonan', ['status' => '2']) }}">
														<span class="text-white fw-bolder d-block fs-4x lh-1 ls-n1 mb-1">{{$baharuPOLI}}</span>
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
														<span class="text-white fw-bolder d-block fs-4x lh-1 ls-n1 mb-1">{{$saringanPOLI}}</span>
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
														<span class="text-white fw-bolder d-block fs-4x lh-1 ls-n1 mb-1">{{$disokongPOLI}}</span>
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
														<span class="text-white fw-bolder d-block fs-4x lh-1 ls-n1 mb-1">{{$dikembalikanPOLI}}</span>
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
													<a href="{{ route('statusPOLI.permohonan', ['status' => '8']) }}">
														<span class="text-white fw-bolder d-block fs-4x lh-1 ls-n1 mb-1">{{$dibayarPOLI}}</span>
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
													<a href="{{ route('statusPOLI.permohonan', ['status' => '6']) }}">
														<span class="text-white fw-bolder d-block fs-4x lh-1 ls-n1 mb-1">{{$layakPOLI}}</span>
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
													<a href="{{ route('statusPOLI.permohonan', ['status' => '7']) }}">
														<span class="text-white fw-bolder d-block fs-4x lh-1 ls-n1 mb-1">{{$tidaklayakPOLI}}</span>
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
													<a href="{{ route('keseluruhanPOLI.tuntutan', ['status' => '!=9']) }}">
														<span class="text-white fw-bolder d-block fs-4x lh-1 ls-n1 mb-1">{{$keseluruhanTuntutanPOLI}}</span>
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
													<a href="{{ route('statusPOLI.tuntutan', ['status' => '1']) }}">
														<span class="text-white fw-bolder d-block fs-4x lh-1 ls-n1 mb-1">{{$derafTuntutanPOLI}}</span>
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
													<a href="{{ route('statusPOLI.tuntutan', ['status' => '2']) }}">
														<span class="text-white fw-bolder d-block fs-4x lh-1 ls-n1 mb-1">{{$baharuTuntutanPOLI}}</span>
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
														<span class="text-white fw-bolder d-block fs-4x lh-1 ls-n1 mb-1">{{$saringanTuntutanPOLI}}</span>
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
														<span class="text-white fw-bolder d-block fs-4x lh-1 ls-n1 mb-1">{{$disokongTuntutanPOLI}}</span>
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
														<span class="text-white fw-bolder d-block fs-4x lh-1 ls-n1 mb-1">{{$dikembalikanTuntutanPOLI}}</span>
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
													<a href="{{ route('statusPOLI.tuntutan', ['status' => '8']) }}">
														<span class="text-white fw-bolder d-block fs-4x lh-1 ls-n1 mb-1">{{$dibayarTuntutanPOLI}}</span>
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
													<a href="{{ route('statusPOLI.tuntutan', ['status' => '6']) }}">
														<span class="text-white fw-bolder d-block fs-4x lh-1 ls-n1 mb-1">{{$layakTuntutanPOLI}}</span>
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
													<a href="{{ route('statusPOLI.tuntutan', ['status' => '7']) }}">
														<span class="text-white fw-bolder d-block fs-4x lh-1 ls-n1 mb-1">{{$tidakLayakTuntutanPOLI}}</span>
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
								{{-- Permohonan --}}
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
													<a href="{{ route('keseluruhanKK.permohonan') }}">
														<span class="text-white fw-bolder d-block fs-4x lh-1 ls-n1 mb-1">{{$keseluruhanKK}}</span>
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
													<a href="{{ route('statusKK.permohonan', ['status' => '1']) }}">
														<span class="text-white fw-bolder d-block fs-4x lh-1 ls-n1 mb-1">{{$derafKK}}</span>
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
													<a href="{{ route('statusKK.permohonan', ['status' => '2']) }}">
														<span class="text-white fw-bolder d-block fs-4x lh-1 ls-n1 mb-1">{{$baharuKK}}</span>
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
														<span class="text-white fw-bolder d-block fs-4x lh-1 ls-n1 mb-1">{{$saringanKK}}</span>
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
														<span class="text-white fw-bolder d-block fs-4x lh-1 ls-n1 mb-1">{{$disokongKK}}</span>
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
														<span class="text-white fw-bolder d-block fs-4x lh-1 ls-n1 mb-1">{{$dikembalikanKK}}</span>
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
													<a href="{{ route('statusKK.permohonan', ['status' => '8']) }}">
														<span class="text-white fw-bolder d-block fs-4x lh-1 ls-n1 mb-1">{{$dibayarKK}}</span>
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
													<a href="{{ route('statusKK.permohonan', ['status' => '6']) }}">
														<span class="text-white fw-bolder d-block fs-4x lh-1 ls-n1 mb-1">{{$layakKK}}</span>
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
													<a href="{{ route('statusKK.permohonan', ['status' => '7']) }}">
														<span class="text-white fw-bolder d-block fs-4x lh-1 ls-n1 mb-1">{{$tidaklayakKK}}</span>
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
													<a href="{{ route('keseluruhanKK.tuntutan', ['status' => '!=9']) }}">
														<span class="text-white fw-bolder d-block fs-4x lh-1 ls-n1 mb-1">{{$keseluruhanTuntutanKK}}</span>
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
													<a href="{{ route('statusKK.tuntutan', ['status' => '1']) }}">
														<span class="text-white fw-bolder d-block fs-4x lh-1 ls-n1 mb-1">{{$derafTuntutanKK}}</span>
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
													<a href="{{ route('statusKK.tuntutan', ['status' => '2']) }}">
														<span class="text-white fw-bolder d-block fs-4x lh-1 ls-n1 mb-1">{{$baharuTuntutanKK}}</span>
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
														<span class="text-white fw-bolder d-block fs-4x lh-1 ls-n1 mb-1">{{$saringanTuntutanKK}}</span>
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
														<span class="text-white fw-bolder d-block fs-4x lh-1 ls-n1 mb-1">{{$disokongTuntutanKK}}</span>
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
														<span class="text-white fw-bolder d-block fs-4x lh-1 ls-n1 mb-1">{{$dikembalikanTuntutanKK}}</span>
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
													<a href="{{ route('statusKK.tuntutan', ['status' => '8']) }}">
														<span class="text-white fw-bolder d-block fs-4x lh-1 ls-n1 mb-1">{{$dibayarTuntutanKK}}</span>
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
													<a href="{{ route('statusKK.tuntutan', ['status' => '6']) }}">
														<span class="text-white fw-bolder d-block fs-4x lh-1 ls-n1 mb-1">{{$layakTuntutanKK}}</span>
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
													<a href="{{ route('statusKK.tuntutan', ['status' => '7']) }}">
														<span class="text-white fw-bolder d-block fs-4x lh-1 ls-n1 mb-1">{{$tidakLayakTuntutanKK}}</span>
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
															<span class="text-white fw-bolder d-block fs-4x lh-1 ls-n1 mb-1">{{ $keseluruhanUA }}</span>
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
															<span class="text-white fw-bolder d-block fs-4x lh-1 ls-n1 mb-1">{{$derafUA}}</span>
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
															<span class="text-white fw-bolder d-block fs-4x lh-1 ls-n1 mb-1">{{$baharuUA}}</span>
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
															<span class="text-white fw-bolder d-block fs-4x lh-1 ls-n1 mb-1">{{$saringanUA}}</span>
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
															<span class="text-white fw-bolder d-block fs-4x lh-1 ls-n1 mb-1">{{$disokongUA}}</span>
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
															<span class="text-white fw-bolder d-block fs-4x lh-1 ls-n1 mb-1">{{$dikembalikanUA}}</span>
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
															<span class="text-white fw-bolder d-block fs-4x lh-1 ls-n1 mb-1">{{$dibayarUA}}</span>
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
															<span class="text-white fw-bolder d-block fs-4x lh-1 ls-n1 mb-1">{{$layakUA}}</span>
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
															<span class="text-white fw-bolder d-block fs-4x lh-1 ls-n1 mb-1">{{$tidaklayakUA}}</span>
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
														<span class="text-white fw-bolder d-block fs-4x lh-1 ls-n1 mb-1">{{$keseluruhanTuntutanUA}}</span>
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
														<span class="text-white fw-bolder d-block fs-4x lh-1 ls-n1 mb-1">{{$derafTuntutanUA}}</span>
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
														<span class="text-white fw-bolder d-block fs-4x lh-1 ls-n1 mb-1">{{$baharuTuntutanUA}}</span>
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
														<span class="text-white fw-bolder d-block fs-4x lh-1 ls-n1 mb-1">{{$saringanTuntutanUA}}</span>
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
														<span class="text-white fw-bolder d-block fs-4x lh-1 ls-n1 mb-1">{{$disokongTuntutanUA}}</span>
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
														<span class="text-white fw-bolder d-block fs-4x lh-1 ls-n1 mb-1">{{$dikembalikanTuntutanUA}}</span>
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
														<span class="text-white fw-bolder d-block fs-4x lh-1 ls-n1 mb-1">{{$dibayarTuntutanUA}}</span>
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
														<span class="text-white fw-bolder d-block fs-4x lh-1 ls-n1 mb-1">{{$layakTuntutanUA}}</span>
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
														<span class="text-white fw-bolder d-block fs-4x lh-1 ls-n1 mb-1">{{$tidakLayakTuntutanUA}}</span>
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

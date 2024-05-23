{{-- PELAJAR UA/IPTS/PPK --}}
@if(Auth::user()->tahap=='1')
	@php
		$smoku_id = DB::table('smoku')->where('no_kp',Auth::user()->no_kp)->first();
		$permohonan = DB::table('permohonan')->where('smoku_id', $smoku_id->id)->first();
		$akademik = DB::table('smoku_akademik')->where('smoku_id', $smoku_id->id)->where('status', 1)->first();
		$institusi = DB::table('bk_info_institusi')->where('id_institusi', $akademik->id_institusi)->first();

		// Retrieve data from bk_tarikh_iklan table
		$bk_tarikh_iklan = DB::table('bk_tarikh_iklan')->orderBy('created_at', 'desc')->first();

		// Get current date and time
		$currentDateTime = now();

		// Check if current date and time fall within the allowed range
		$tarikhMula = \Carbon\Carbon::parse($bk_tarikh_iklan->tarikh_mula . ' ' . $bk_tarikh_iklan->masa_mula);
		$tarikhTamat = \Carbon\Carbon::parse($bk_tarikh_iklan->tarikh_tamat . ' ' . $bk_tarikh_iklan->masa_tamat);

		// Check if current date and time fall within the allowed range
		$isWithinRange = $currentDateTime->between($tarikhMula, $tarikhTamat);
	@endphp
			
	<!--begin::sidebar menu-->
	<div class="app-sidebar-menu overflow-hidden flex-column-fluid">
		<!--begin::Menu wrapper-->
		<div id="kt_app_sidebar_menu_wrapper" class="app-sidebar-wrapper hover-scroll-overlay-y my-5" data-kt-scroll="true" data-kt-scroll-activate="true" data-kt-scroll-height="auto" data-kt-scroll-dependencies="#kt_app_sidebar_logo, #kt_app_sidebar_footer" data-kt-scroll-wrappers="#kt_app_sidebar_menu" data-kt-scroll-offset="5px" data-kt-scroll-save-state="true">
			<!--begin::Menu-->
			<div class="menu menu-column menu-rounded menu-sub-indention px-3 fw-semibold fs-6" id="#kt_app_sidebar_menu" data-kt-menu="true" data-kt-menu-expand="false">
				<!--begin:Menu item-->
				<div class="menu-item">
					<a class="menu-link" href="{{ route('dashboard') }}">
						<span class="menu-icon">{!! getIcon('element-11', 'fs-2') !!}</span>
						<span class="menu-title">Laman Utama</span>
					</a>
				</div>
				@if($permohonan != null && $permohonan->status ==8 && in_array($institusi->jenis_institusi, ['IPTS', 'UA', 'KK', 'P']))
				<div class="menu-item pt-5">
					<div class="menu-content">
						<span class="menu-heading fw-bold text-uppercase fs-7">Kemaskini</span>
					</div>
				</div>
				<div class="menu-item">
					<a class="menu-link" href="{{ route('kemaskini.keputusan') }}">
						<span class="menu-icon">{!! getIcon('update-file', 'fs-2') !!}</span>
						<span class="menu-title">Keputusan Peperiksaan</span>
					</a>
				</div>
				<div class="menu-item">
					<a class="menu-link" href="{{ route('tamat.pengajian') }}">
						<span class="menu-icon">{!! getIcon('document', 'fs-2') !!}</span>
						<span class="menu-title">Lapor Tamat Pengajian</span>
					</a>
				</div>
				@endif

				@if(in_array($institusi->jenis_institusi, ['IPTS', 'UA', 'KK', 'P']))
					<div class="menu-item pt-5">
						<div class="menu-content">
							<span class="menu-heading fw-bold text-uppercase fs-7">Permohonan</span>
						</div>
					</div>

					@if($institusi->jenis_institusi === 'IPTS')
						@if($isWithinRange)
							<div class="menu-item">
								<a class="menu-link" href="{{ route('permohonan') }}">
									<span class="menu-icon">{!! getIcon('book', 'fs-2') !!}</span>
									<span class="menu-title">Baharu</span>
								</a>
							</div>							
						@else
							<div class="menu-item">
								<a class="menu-link" href="#" onclick="showAlert()">
									<span class="menu-icon">{!! getIcon('book', 'fs-2') !!}</span>
									<span class="menu-title">Baharu</span>
								</a>
							</div>
						@endif
					@endif

					<div class="menu-item">
						<a class="menu-link" href="{{ route('pelajar.sejarah.permohonan') }}">
							<span class="menu-icon">{!! getIcon('search-list', 'fs-2') !!}</span>
							<span class="menu-title">Sejarah</span>
						</a>
					</div>
				@endif

				@if($permohonan != null && $permohonan->status == 8)
					@if(in_array($institusi->jenis_institusi, ['IPTS', 'UA', 'KK', 'P']))
						<div class="menu-item pt-5">
							<div class="menu-content">
								<span class="menu-heading fw-bold text-uppercase fs-7">Tuntutan</span>
							</div>
						</div>

						@if($institusi->jenis_institusi === 'IPTS')
							@if($isWithinRange)
								<div class="menu-item">
									<a class="menu-link" href="{{ route('tuntutan.baharu') }}">
										<span class="menu-icon">{!! getIcon('book', 'fs-2') !!}</span>
										<span class="menu-title">Baharu</span>
									</a>
								</div>
							@else
								<div class="menu-item">
									<a class="menu-link" href="#" onclick="showAlertTuntutan()">
										<span class="menu-icon">{!! getIcon('book', 'fs-2') !!}</span>
										<span class="menu-title">Baharu</span>
									</a>
								</div>
							@endif
						@endif

						<div class="menu-item">
							<a class="menu-link" href="{{ route('pelajar.sejarah.tuntutan') }}">
								<span class="menu-icon">{!! getIcon('search-list', 'fs-2') !!}</span>
								<span class="menu-title">Sejarah</span>
							</a>
						</div>
					@endif
				@endif
			</div>
			<!--end::Menu-->


{{-- PENYELARAS UA --}}
@elseif(Auth::user()->tahap=='2')
	@php
		$user = DB::table('users')->where('no_kp',Auth::user()->no_kp)->first();
		$institusi = DB::table('bk_info_institusi')->where('id_institusi', $user->id_institusi)->first();
	@endphp

	<!--begin::sidebar menu-->
	<div class="app-sidebar-menu overflow-hidden flex-column-fluid">
		<!--begin::Menu wrapper-->
		<div id="kt_app_sidebar_menu_wrapper" class="app-sidebar-wrapper hover-scroll-overlay-y my-5" data-kt-scroll="true" data-kt-scroll-activate="true" data-kt-scroll-height="auto" data-kt-scroll-dependencies="#kt_app_sidebar_logo, #kt_app_sidebar_footer" data-kt-scroll-wrappers="#kt_app_sidebar_menu" data-kt-scroll-offset="5px" data-kt-scroll-save-state="true">
			<!--begin::Menu-->
			<div class="menu menu-column menu-rounded menu-sub-indention px-3 fw-semibold fs-6" id="#kt_app_sidebar_menu" data-kt-menu="true" data-kt-menu-expand="false">
					<!--begin:Menu item-->
				<div class="menu-item">
					<a class="menu-link" href="{{ route('dashboard') }}">
						<span class="menu-icon">{!! getIcon('element-11', 'fs-2') !!}</span>
						<span class="menu-title">Laman Utama</span>
					</a>
				</div>

				<div class="menu-item pt-5">
					<div class="menu-content">
						<span class="menu-heading fw-bold text-uppercase fs-7">Permohonan</span>
					</div>
				</div>

				<div class="menu-item">
					<a class="menu-link" href="{{ route('senarai.permohonanBaharu')}}">
						<span class="menu-icon">{!! getIcon('wallet', 'fs-2') !!}</span>
						<span class="menu-title">Baharu</span>
					</a>
				</div>
					
				<div class="menu-item">
					<a class="menu-link" href="{{ route('bkoku.sejarah.permohonan')}}">
						<span class="menu-icon">{!! getIcon('search-list', 'fs-2') !!}</span>
						<span class="menu-title">Sejarah</span>
					</a>
				</div>

				<div class="menu-item pt-5">
						<div class="menu-content">
							<span class="menu-heading fw-bold text-uppercase fs-7">Tuntutan</span>
						</div>
				</div>

				<div class="menu-item">
					<a class="menu-link" href="{{route('senarai.bkoku.tuntutanBaharu')}}">
						<span class="menu-icon">{!! getIcon('wallet', 'fs-2') !!}</span>
						<span class="menu-title">Baharu</span>
					</a>
				</div>
					
				<div class="menu-item">
					<a class="menu-link" href="{{route('bkoku.sejarah.tuntutan')}}">
						<span class="menu-icon">{!! getIcon('search-list', 'fs-2') !!}</span>
						<span class="menu-title">Sejarah</span>
					</a>
				</div>

				@if($institusi->jenis_institusi === 'UA')
					<div class="menu-item pt-5">
						<div class="menu-content">
							<span class="menu-heading fw-bold text-uppercase fs-7">Penyaluran</span>
						</div>
					</div>
					<div class="menu-item">
						<a class="menu-link" href="{{ route('penyelaras.kemaskini.layak') }}">
							<span class="menu-icon">{!! getIcon('file', 'fs-2') !!}</span>
							<span class="menu-title">Kemaskini Pembayaran</span>
						</a>
					</div>
					<div class="menu-item">
						<a class="menu-link" href="{{ route('penyelaras.muat-turun.SPBB')}}">
							<span class="menu-icon">{!! getIcon('file', 'fs-2') !!}</span>
							<span class="menu-title">Muat Turun SPBB</span>
						</a>
					</div>
					<div class="menu-item">
						<a class="menu-link" href="{{ route('penyelaras.muat-naik.SPBB')}}">
							<span class="menu-icon">{!! getIcon('file', 'fs-2') !!}</span>
							<span class="menu-title">Muat Naik SPBB</span>
						</a>
					</div>
					<div class="menu-item">
						<a class="menu-link" href="{{ route('penyelaras.senarai.dibayar') }}">
							<span class="menu-icon">{!! getIcon('file', 'fs-2') !!}</span>
							<span class="menu-title">Keputusan Pembayaran</span>
						</a>
					</div>

					<div class="menu-item pt-5">
						<div class="menu-content">
							<span class="menu-heading fw-bold text-uppercase fs-7">Kemaskini</span>
						</div>
					</div>
					<div class="menu-item">
						<a class="menu-link" href="{{ route('maklumat.bank')}}">
							<span class="menu-icon">{!! getIcon('file', 'fs-2') !!}</span>
							<span class="menu-title">Maklumat Bank Universiti</span>
						</a>
					</div>
					<div class="menu-item">
						<a class="menu-link" href="{{ route('senarai.pelajar.ua')}}">
							<span class="menu-icon">{!! getIcon('user', 'fs-2') !!}</span>
							<span class="menu-title">Tukar Institusi</span>
						</a>
					</div>
				@endif
			</div>
			<!--end::Menu-->


{{-- SEKRETARIAT --}}
@elseif(Auth::user()->tahap=='3')
	@php
		$baharu = DB::table('permohonan')->where('status', '=', '2')->count();
		$sokong = DB::table('permohonan')->where('status', '=', '4')->count();
		// $keputusan = DB::table('permohonan')->whereIn('status', ['6', '7'])->count();
		$layak = DB::table('permohonan')->where('status', '=', '6')->whereNull('data_migrate')->count();
		$bayar = DB::table('permohonan')->where('status', '=', '8')->count();
		$total = DB::table('permohonan')->count();
		$baharuT = DB::table('tuntutan')->where('status', '=', '2')->count();
		// $keputusanT = DB::table('tuntutan')->whereIn('status', ['6', '7'])->count();
		$layakT = DB::table('tuntutan')->where('status', '=', '6')->whereNull('data_migrate')->count();
		$bayarT = DB::table('tuntutan')->where('status', '=', '8')->count();
		$totalT = DB::table('tuntutan')->count();

		//tukar institusi
		$tukarInstitusi = DB::table('tukar_institusi')->where('status', '=', '0')->count();
		$pengesahanCGPA = DB::table('permohonan_peperiksaan')->where('pengesahan_rendah', '=', '1')->count();
	@endphp

	<!--begin::sidebar menu-->
	<div class="app-sidebar-menu overflow-hidden flex-column-fluid">
		<!--begin::Menu wrapper-->
		<div id="kt_app_sidebar_menu_wrapper" class="app-sidebar-wrapper hover-scroll-overlay-y my-5" data-kt-scroll="true" data-kt-scroll-activate="true" data-kt-scroll-height="auto" data-kt-scroll-dependencies="#kt_app_sidebar_logo, #kt_app_sidebar_footer" data-kt-scroll-wrappers="#kt_app_sidebar_menu" data-kt-scroll-offset="5px" data-kt-scroll-save-state="true">
			<!--begin::Menu-->
			<div class="menu menu-column menu-rounded menu-sub-indention px-3 fw-semibold fs-6" id="#kt_app_sidebar_menu" data-kt-menu="true" data-kt-menu-expand="false">
				<!--begin:Menu item-->
				<div class="menu-item">
					<a class="menu-link" href="{{ url('dashboard/sekretariat') }}">
						<span class="menu-icon">{!! getIcon('element-11', 'fs-2') !!}</span>
						<span class="menu-title">Laman Utama</span>
					</a>
				</div>

				<div class="menu-item pt-5">
					<div class="menu-content">
						<span class="menu-heading fw-bold text-uppercase fs-7">Permohonan</span>
					</div>
				</div>
				<div class="menu-item">
					<a class="menu-link" href="{{url('permohonan/sekretariat/saringan/senarai-permohonan')}}">
							<span class="menu-icon">{!! getIcon('notepad-edit', 'fs-2') !!}</span>
							<span class="menu-title">Saringan ({{$baharu}})</span>
					</a>
				</div>
				<div class="menu-item">
					<a class="menu-link" href="{{url('permohonan/sekretariat/kelulusan')}}">
							<span class="menu-icon">{!! getIcon('loading', 'fs-2') !!}</span>
							<span class="menu-title">Kelulusan ({{$sokong}})</span>
					</a>
				</div>

				<div class="menu-item">
					<a class="menu-link" href="{{url('permohonan/sekretariat/keputusan')}}">
							<span class="menu-icon">{!! getIcon('check-square', 'fs-2') !!}</span>
							<span class="menu-title">Keputusan </span>
					</a>
				</div>
				<div class="menu-item">
					<a class="menu-link" href="{{ route('permohonan.esp')}}">
							<span class="menu-icon">{!! getIcon('square-brackets', 'fs-2') !!}</span>
							<span class="menu-title">Maklumat ESP ({{$layak}})</span>
					</a>
				</div>
				<div class="menu-item">
					<a class="menu-link" href="{{url('permohonan/sekretariat/pembayaran/senarai')}}">
						<span class="menu-icon">{!! getIcon('dollar', 'fs-2') !!}</span>
						<span class="menu-title">Pembayaran ({{$bayar}})</span>
					</a>
				</div>
				<div class="menu-item">
					<a class="menu-link" href="{{url('permohonan/sekretariat/sejarah/sejarah-permohonan')}}">
						<span class="menu-icon">{!! getIcon('watch', 'fs-2') !!}</span>
						<span class="menu-title">Sejarah ({{$total}})</span>
					</a>
				</div>

				<div class="menu-item pt-5">
					<div class="menu-content">
						<span class="menu-heading fw-bold text-uppercase fs-7">Tuntutan</span>
					</div>
				</div>
				<div class="menu-item">
					<a class="menu-link" href="{{ url('tuntutan/sekretariat/saringan/senarai-tuntutan') }}">
							<span class="menu-icon">{!! getIcon('notepad-edit', 'fs-2') !!}</span>
							<span class="menu-title">Saringan ({{$baharuT}})</span>
					</a>
				</div>
				<div class="menu-item">
					<a class="menu-link" href="{{ url('tuntutan/sekretariat/keputusan/keputusan-tuntutan') }}">
							<span class="menu-icon">{!! getIcon('check-square', 'fs-2') !!}</span>
							<span class="menu-title">Keputusan </span>
					</a>
				</div>
				<div class="menu-item">
					<a class="menu-link" href="{{ route('tuntutan.esp')}}">
							<span class="menu-icon">{!! getIcon('square-brackets', 'fs-2') !!}</span>
							<span class="menu-title">Maklumat ESP ({{$layakT}})</span>
					</a>
				</div>
				<div class="menu-item">
					<a class="menu-link" href="{{url('tuntutan/sekretariat/pembayaran/senarai')}}">
						<span class="menu-icon">{!! getIcon('dollar', 'fs-2') !!}</span>
						<span class="menu-title">Pembayaran ({{$bayarT}})</span>
					</a>
				</div>
				<div class="menu-item">
					<a class="menu-link" href="{{ route('senarai.tuntutan') }}">
						<span class="menu-icon">{!! getIcon('watch', 'fs-2') !!}</span>
						<span class="menu-title">Sejarah ({{$totalT}})</span>
					</a>
				</div>

				<div class="menu-item pt-5">
					<div class="menu-content">
						<span class="menu-heading fw-bold text-uppercase fs-7">Kemaskini</span>
					</div>
				</div>
				<div class="menu-item">
					<a class="menu-link" href="{{ route('peringkat.pengajian') }}">
						<span class="menu-icon">{!! getIcon('teacher', 'fs-2') !!}</span>
						<span class="menu-title">Peringkat Pengajian</span>
					</a>
				</div>
				<div class="menu-item">
					<a class="menu-link" href="{{ route('tangguh.lanjut.pengajian') }}">
						<span class="menu-icon">{!! getIcon('time', 'fs-2') !!}</span>
						<span class="menu-title">Permohonan Penangguhan / Perlanjutan</span>
					</a>
				</div>
				<div class="menu-item">
					<a class="menu-link" href="{{ route('senarai.tukar.institusi')}}">
						<span class="menu-icon">{!! getIcon('user', 'fs-2') !!}</span>
						<span class="menu-title">Tukar Institusi ({{$tukarInstitusi}}) </span>
					</a>
				</div>
				<div class="menu-item">
					<a class="menu-link" href="{{ route('senarai.pengesahan.cgpa')}}">
						<span class="menu-icon">{!! getIcon('key', 'fs-2') !!}</span>
						<span class="menu-title">Pengesahan CGPA ({{$pengesahanCGPA}}) </span>
					</a>
				</div>
				<div class="menu-item">
					<a class="menu-link" href="{{url('kemaskini/sekretariat/jumlah-peruntukan')}}">
						<span class="menu-icon">{!! getIcon('send', 'fs-2') !!}</span>
						<span class="menu-title">Peruntukan Tahunan</span>
					</a>
				</div>
				<div class="menu-item">
					<a class="menu-link" href="{{ route('preview') }}">
						<span class="menu-icon">{!! getIcon('document', 'fs-2') !!}</span>
						<span class="menu-title">Surat Tawaran</span>
					</a>
				</div>
				<div class="menu-item">
					<a class="menu-link" href="{{url('kemaskini/sekretariat/emel/senarai-emel')}}">
						<span class="menu-icon">{!! getIcon('send', 'fs-2') !!}</span>
						<span class="menu-title">Emel</span>
					</a>
				</div>

				<div class="menu-item pt-5">
					<div class="menu-content">
						<span class="menu-heading fw-bold text-uppercase fs-7">Penyaluran</span>
					</div>
				</div>
				<div class="menu-item">
					<a class="menu-link" href="{{ route('sekretariat.muat-turun.SPBB')}}">
						<span class="menu-icon">{!! getIcon('folder', 'fs-2') !!}</span>
						<span class="menu-title">Muat Turun SPBB & Penyata Bank</span>
					</a>
				</div>

				<div class="menu-item pt-5">
					<div class="menu-content">
						<span class="menu-heading fw-bold text-uppercase fs-7">Pelaporan</span>
					</div>
				</div>
				<div class="menu-item">
					<a class="menu-link" href="{{ route('laporan.keseluruhan') }}">
						<span class="menu-icon">{!! getIcon('calculator', 'fs-2') !!}</span>
						<span class="menu-title">Keseluruhan</span>
					</a>
				</div>
				<div class="menu-item">
					<a class="menu-link" href="{{ route('laporan.permohonan') }}" >
						<span class="menu-icon">{!! getIcon('chart-simple', 'fs-2') !!}</span>
						<span class="menu-title">Permohonan</span>
					</a>
					<!-- Start of submenu -->
					<ul> 
						<a class="menu-link" href="{{ route('laporan.statistik') }}">
							<span class="menu-bullet">
								<span class="bullet bullet-dot"></span>
							</span>
							<span class="menu-title">Statistik</span>
						</a>
					</ul> 
					<!-- End of submenu -->
				</div>
				<div class="menu-item">
					<a class="menu-link" href="{{ route('laporan.tuntutan') }}">
						<span class="menu-icon">{!! getIcon('chart-line', 'fs-2') !!}</span>
						<span class="menu-title">Tuntutan</span>
					</a>
				</div>
			</div>
			<!--end::Menu-->


{{-- PEGAWAI ATASAN --}}
@elseif(Auth::user()->tahap=='4')
	<!--begin::sidebar menu-->
	<div class="app-sidebar-menu overflow-hidden flex-column-fluid">
		<!--begin::Menu wrapper-->
		<div id="kt_app_sidebar_menu_wrapper" class="app-sidebar-wrapper hover-scroll-overlay-y my-5" data-kt-scroll="true" data-kt-scroll-activate="true" data-kt-scroll-height="auto" data-kt-scroll-dependencies="#kt_app_sidebar_logo, #kt_app_sidebar_footer" data-kt-scroll-wrappers="#kt_app_sidebar_menu" data-kt-scroll-offset="5px" data-kt-scroll-save-state="true">
			<!--begin::Menu-->
			<div class="menu menu-column menu-rounded menu-sub-indention px-3 fw-semibold fs-6" id="#kt_app_sidebar_menu" data-kt-menu="true" data-kt-menu-expand="false">
				<!--begin:Menu item-->
				<div class="menu-item">
					<a class="menu-link" href="{{ route('dashboard') }}">
						<span class="menu-icon">{!! getIcon('element-11', 'fs-2') !!}</span>
						<span class="menu-title">Laman Utama</span>
					</a>
				</div>
				<div class="menu-item pt-5">
					<div class="menu-content">
						<span class="menu-heading fw-bold text-uppercase fs-7">Pelaporan</span>
					</div>
				</div>

				<div class="menu-item">
					<a class="menu-link" href="{{ route('laporan.permohonan') }}">
						<span class="menu-icon">{!! getIcon('chart-simple', 'fs-2') !!}</span>
						<span class="menu-title">Permohonan</span>
					</a>
					<!-- Start of submenu -->
					<ul> 
						<a class="menu-link" href="{{ route('laporan.statistik') }}">
							<span class="menu-bullet">
								<span class="bullet bullet-dot"></span>
							</span>
							<span class="menu-title">Statistik</span>
						</a>
					</ul> 
					<!-- End of submenu -->
				</div>
				
				<div class="menu-item">
					<a class="menu-link" href="{{ route('laporan.tuntutan') }}">
						<span class="menu-icon">{!! getIcon('chart-line', 'fs-2') !!}</span>
						<span class="menu-title">Tuntutan</span>
					</a>
				</div>

				<div class="menu-item pt-5">
					<div class="menu-content">
						<span class="menu-heading fw-bold text-uppercase fs-7">Kemaskini</span>
					</div>
				</div>

				<div class="menu-item">
					<a class="menu-link" href="{{ route('status.penajaan') }}">
						<span class="menu-icon">{!! getIcon('address-book', 'fs-2') !!}</span>
						<span class="menu-title">Status Penajaan</span>
					</a>
				</div>
			</div>


{{-- PENTADBIR --}}
@elseif(Auth::user()->tahap=='5')
	<!--begin::sidebar menu-->
	<div class="app-sidebar-menu overflow-hidden flex-column-fluid">
		<!--begin::Menu wrapper-->
		<div id="kt_app_sidebar_menu_wrapper" class="app-sidebar-wrapper hover-scroll-overlay-y my-5" data-kt-scroll="true" data-kt-scroll-activate="true" data-kt-scroll-height="auto" data-kt-scroll-dependencies="#kt_app_sidebar_logo, #kt_app_sidebar_footer" data-kt-scroll-wrappers="#kt_app_sidebar_menu" data-kt-scroll-offset="5px" data-kt-scroll-save-state="true">
			<!--begin::Menu-->
			<div class="menu menu-column menu-rounded menu-sub-indention px-3 fw-semibold fs-6" id="#kt_app_sidebar_menu" data-kt-menu="true" data-kt-menu-expand="false">
				<!--begin:Menu item-->
				<div class="menu-item">
					<a class="menu-link" href="{{ route('dashboard') }}">
						<span class="menu-icon">{!! getIcon('element-11', 'fs-2') !!}</span>
						<span class="menu-title">Laman Utama</span>
					</a>
				</div>
				<div class="menu-item pt-5">
					<div class="menu-content">
						<span class="menu-heading fw-bold text-uppercase fs-7">Pentadbir Sistem</span>
					</div>
				</div>

				<div class="menu-item">
					<a class="menu-link" href="{{url('daftarpengguna')}}">
							<span class="menu-icon">{!! getIcon('notepad-edit', 'fs-2') !!}</span>
							<span class="menu-title">Daftar Pengguna</span>
					</a>
				</div>
				<div class="menu-item">
					<a class="menu-link" href="{{url('pentadbir/api-connection')}}">
							<span class="menu-icon">{!! getIcon('notepad-edit', 'fs-2') !!}</span>
							<span class="menu-title">Semakan API</span>
					</a>
				</div>
				<div class="menu-item">
					<a class="menu-link" href="{{url('pentadbir/tarikh')}}">
							<span class="menu-icon">{!! getIcon('notepad-edit', 'fs-2') !!}</span>
							<span class="menu-title">Set Tarikh Iklan</span>
					</a>
				</div>
				<div class="menu-item">
					<a class="menu-link" href="{{url('pentadbir/jumlah-tuntutan')}}">
							<span class="menu-icon">{!! getIcon('notepad-edit', 'fs-2') !!}</span>
							<span class="menu-title">Selenggara Had Maksima Tuntutan</span>
					</a>
				</div>
				<div class="menu-item">
					<a class="menu-link" href="{{url('pentadbir/alamat')}}">
							<span class="menu-icon">{!! getIcon('notepad-edit', 'fs-2') !!}</span>
							<span class="menu-title">Kemaskini Alamat Kementerian</span>
					</a>
				</div>
				<div class="menu-item">
					<a class="menu-link" href="{{url('pentadbir/kod-esp/institusi')}}">
							<span class="menu-icon">{!! getIcon('notepad-edit', 'fs-2') !!}</span>
							<span class="menu-title">Kemaskini Kod Institusi</span>
					</a>
				</div>
				<div class="menu-item pt-5">
					<div class="menu-content">
						<span class="menu-heading fw-bold text-uppercase fs-7">Pelaporan</span>
					</div>
				</div>
				<div class="menu-item">
					<a class="menu-link" href="{{ route('laporan.permohonan') }}" >
						<span class="menu-icon">{!! getIcon('chart-simple', 'fs-2') !!}</span>
						<span class="menu-title">Permohonan</span>
					</a>
				</div>
				<div class="menu-item">
					<a class="menu-link" href="{{ route('laporan.tuntutan') }}">
						<span class="menu-icon">{!! getIcon('chart-line', 'fs-2') !!}</span>
						<span class="menu-title">Tuntutan</span>
					</a>
				</div>
			</div>
			<!--end::Menu-->

			
{{-- PENYELARAS PPK --}}
@elseif(Auth::user()->tahap=='6')
	<!--begin::sidebar menu-->
	<div class="app-sidebar-menu overflow-hidden flex-column-fluid">
		<!--begin::Menu wrapper-->
		<div id="kt_app_sidebar_menu_wrapper" class="app-sidebar-wrapper hover-scroll-overlay-y my-5" data-kt-scroll="true" data-kt-scroll-activate="true" data-kt-scroll-height="auto" data-kt-scroll-dependencies="#kt_app_sidebar_logo, #kt_app_sidebar_footer" data-kt-scroll-wrappers="#kt_app_sidebar_menu" data-kt-scroll-offset="5px" data-kt-scroll-save-state="true">
			<!--begin::Menu-->
			<div class="menu menu-column menu-rounded menu-sub-indention px-3 fw-semibold fs-6" id="#kt_app_sidebar_menu" data-kt-menu="true" data-kt-menu-expand="false">
				<!--begin:Menu item-->
				<div class="menu-item">
					<a class="menu-link" href="{{ route('dashboard') }}">
						<span class="menu-icon">{!! getIcon('element-11', 'fs-2') !!}</span>
						<span class="menu-title">Laman Utama</span>
					</a>
				</div>
				<div class="menu-item pt-5">
					<div class="menu-content">
						<span class="menu-heading fw-bold text-uppercase fs-7">Permohonan</span>
					</div>
				</div>
				<div class="menu-item">
					<a class="menu-link" href="{{ route('senarai.ppk.permohonanBaharu')}}">
							<span class="menu-icon">{!! getIcon('wallet', 'fs-2') !!}</span>
							<span class="menu-title">Baharu</span>
					</a>
				</div>
				<div class="menu-item">
					<a class="menu-link" href="{{ route('senarai.ppk.permohonanDibayar')}}">
							<span class="menu-icon">{!! getIcon('dollar', 'fs-2') !!}</span>
							<span class="menu-title">Pembayaran</span>
					</a>
				</div>
				<div class="menu-item">
					<a class="menu-link" href="{{route('ppk.sejarah.permohonan')}}">
						<span class="menu-icon">{!! getIcon('search-list', 'fs-2') !!}</span>
						<span class="menu-title">Sejarah</span>
					</a>
				</div>
				<div class="menu-item pt-5">
					<div class="menu-content">
						<span class="menu-heading fw-bold text-uppercase fs-7">Tuntutan</span>
					</div>
				</div>
				<div class="menu-item">
					<a class="menu-link" href="{{route('senarai.ppk.tuntutanBaharu')}}">
						<span class="menu-icon">{!! getIcon('wallet', 'fs-2') !!}</span>
						<span class="menu-title">Baharu</span>
					</a>
				</div>
				<div class="menu-item">
					<a class="menu-link" href="{{ route('senarai.ppk.tuntutanDibayar')}}">
						<span class="menu-icon">{!! getIcon('dollar', 'fs-2') !!}</span>
						<span class="menu-title">Pembayaran</span>
					</a>
				</div>
				<div class="menu-item">
					<a class="menu-link" href="{{route('ppk.sejarah.tuntutan')}}">
						<span class="menu-icon">{!! getIcon('search-list', 'fs-2') !!}</span>
						<span class="menu-title">Sejarah</span>
					</a>
				</div>
			</div>
			<!--end::Menu-->
@endif

</div>
<!--end::Menu wrapper-->
</div>
<!--end::sidebar menu-->

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script>
	function showAlert() 
	{
		Swal.fire({
		icon: 'error',
		title: 'Permohonan ditutup pada masa sekarang.',
		text: ' {!! session('failed') !!}',
		confirmButtonText: 'OK'
		});
	}

	function showAlertTuntutan() 
	{
		Swal.fire({
		icon: 'error',
		title: 'Tuntutan ditutup pada masa sekarang.',
		text: ' {!! session('failed') !!}',
		confirmButtonText: 'OK'
		});
	}
</script>

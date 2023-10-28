@if(Auth::user()->tahap=='1')
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

			<div class="menu-item pt-5">
				<div class="menu-content">
					<span class="menu-heading fw-bold text-uppercase fs-7">Permohonan</span>
				</div>
			</div>
			<div class="menu-item">
				<a class="menu-link" href="{{ route('permohonan') }}">
					<span class="menu-icon">{!! getIcon('book', 'fs-2') !!}</span>
					<span class="menu-title">Baharu</span>
				</a>
			</div>
			<div class="menu-item">
				<a class="menu-link" href="{{ route('pelajar.sejarah.permohonan') }}">
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
				<a class="menu-link" href="{{ route('tuntutan.baharu') }}">
					<span class="menu-icon">{!! getIcon('book', 'fs-2') !!}</span>
					<span class="menu-title">Baharu</span>
				</a>
			</div>
			<div class="menu-item">
				<a class="menu-link" href="{{ route('pelajar.sejarah.tuntutan') }}">
					<span class="menu-icon">{!! getIcon('search-list', 'fs-2') !!}</span>
					<span class="menu-title">Sejarah</span>
				</a>
			</div>
		</div>
		<!--end::Menu-->

@elseif(Auth::user()->tahap=='2')
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

			<div class="menu-item pt-5">
				<div class="menu-content">
					<span class="menu-heading fw-bold text-uppercase fs-7">Penyaluran</span>
				</div>
			</div>
			<div class="menu-item">
				<a class="menu-link" href="{{ route('penyelaras.muat-turun.SPPB')}}">
					<span class="menu-icon">{!! getIcon('file', 'fs-2') !!}</span>
					<span class="menu-title">Muat Turun SPBB</span>
				</a>
			</div>
			<div class="menu-item">
				<a class="menu-link" href="{{ route('penyelaras.muat-naik.SPPB')}}">
					<span class="menu-icon">{!! getIcon('file', 'fs-2') !!}</span>
					<span class="menu-title">Muat Naik SPBB</span>
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
		</div>
		<!--end::Menu-->

@elseif(Auth::user()->tahap=='3')
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
					<span class="menu-heading fw-bold text-uppercase fs-7">Permohonan</span>
				</div>
			</div>
			<div class="menu-item">
				<a class="menu-link" href="{{url('permohonan/sekretariat/saringan/senarai-permohonan')}}">
						<span class="menu-icon">{!! getIcon('notepad-edit', 'fs-2') !!}</span>
						<span class="menu-title">Saringan</span>
				</a>
			</div>
			<div class="menu-item">
				<a class="menu-link" href="{{url('permohonan/sekretariat/kelulusan')}}">
						<span class="menu-icon">{!! getIcon('loading', 'fs-2') !!}</span>
						<span class="menu-title">Kelulusan</span>
				</a>
			</div>

			<div class="menu-item">
				<a class="menu-link" href="{{url('permohonan/sekretariat/keputusan')}}">
						<span class="menu-icon">{!! getIcon('check-square', 'fs-2') !!}</span>
						<span class="menu-title">Keputusan</span>
				</a>
			</div>
			<div class="menu-item">
				<a class="menu-link" href="{{ route('permohonan.esp')}}">
						<span class="menu-icon">{!! getIcon('square-brackets', 'fs-2') !!}</span>
						<span class="menu-title">Maklumat ESP</span>
				</a>
			</div>
			<div class="menu-item">
				<a class="menu-link" href="{{url('permohonan/sekretariat/pembayaran/senarai')}}">
					<span class="menu-icon">{!! getIcon('dollar', 'fs-2') !!}</span>
					<span class="menu-title">Pembayaran</span>
				</a>
			</div>
			<div class="menu-item">
				<a class="menu-link" href="{{url('permohonan/sekretariat/sejarah/sejarah-permohonan')}}">
					<span class="menu-icon">{!! getIcon('watch', 'fs-2') !!}</span>
					<span class="menu-title">Sejarah</span>
				</a>
			</div>

			<div class="menu-item pt-5">
				<div class="menu-content">
					<span class="menu-heading fw-bold text-uppercase fs-7">Tuntutan</span>
				</div>
			</div>
			<div class="menu-item">
				<a class="menu-link" href="{{ url('tuntutan/sekretariat/saringan/senarai_tuntutan') }}">
				<!-- "{{ route('dashboard') }}" -->
						<span class="menu-icon">{!! getIcon('notepad-edit', 'fs-2') !!}</span>
						<span class="menu-title">Saringan</span>
				</a>
			</div>
			<div class="menu-item">
				<a class="menu-link" href="{{ url('tuntutan/sekretariat/keputusan/keputusan-tuntutan') }}">
				<!-- "{{ route('dashboard') }}" -->
						<span class="menu-icon">{!! getIcon('check-square', 'fs-2') !!}</span>
						<span class="menu-title">Keputusan</span>
				</a>
			</div>
			<div class="menu-item">
				<a class="menu-link" href="{{ route('tuntutan.esp')}}">
						<span class="menu-icon">{!! getIcon('square-brackets', 'fs-2') !!}</span>
						<span class="menu-title">Maklumat ESP</span>
				</a>
			</div>
			<div class="menu-item">
				<a class="menu-link" href="{{url('tuntutan/sekretariat/pembayaran/senarai')}}">
					<span class="menu-icon">{!! getIcon('dollar', 'fs-2') !!}</span>
					<span class="menu-title">Pembayaran</span>
				</a>
			</div>
			
			<div class="menu-item">
				<a class="menu-link" href="{{url('tuntutan/sekretariat/sejarah/sejarah-tuntutan')}}">
					<span class="menu-icon">{!! getIcon('watch', 'fs-2') !!}</span>
					<span class="menu-title">Sejarah</span>
				</a>
			</div>

			<div class="menu-item pt-5">
				<div class="menu-content">
					<span class="menu-heading fw-bold text-uppercase fs-7">Penyaluran</span>
				</div>
			</div>
			<div class="menu-item">
				<a class="menu-link" href="{{ route('sekretariat.muat-turun.SPPB')}}">
					<span class="menu-icon">{!! getIcon('folder', 'fs-2') !!}</span>
					<span class="menu-title">Muat Turun SPBB</span>
				</a>
			</div>
			<div class="menu-item">
				<a class="menu-link" href="{{ route('sekretariat.muat-naik.SPPB')}}">
					<span class="menu-icon">{!! getIcon('folder', 'fs-2') !!}</span>
					<span class="menu-title">Muat Naik SPBB</span>
				</a>
			</div>
		</div>
		<!--end::Menu-->

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
					<span class="menu-heading fw-bold text-uppercase fs-7">Permohonan</span>
				</div>
			</div>
			<div class="menu-item">
				<a class="menu-link" href="#">
					<span class="menu-icon">{!! getIcon('some-files', 'fs-2') !!}</span>
					<span class="menu-title">Keseluruhan</span>
				</a>
			</div>

			<div class="menu-item pt-5">
					<div class="menu-content">
						<span class="menu-heading fw-bold text-uppercase fs-7">Tuntutan</span>
					</div>
			</div>
			<div class="menu-item">
				<a class="menu-link" href="#')}}">
					<span class="menu-icon">{!! getIcon('some-files', 'fs-2') !!}</span>
					<span class="menu-title">Keseluruhan</span>
				</a>
			</div>


		</div>

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
								<span class="menu-title">Semak API</span>
						</a>
					</div>
					<div class="menu-item">
						<a class="menu-link" href="{{url('pentadbir/alamat')}}">
								<span class="menu-icon">{!! getIcon('notepad-edit', 'fs-2') !!}</span>
								<span class="menu-title">Alamat Kementerian</span>
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
								<span class="menu-title">Set Jumlah Tuntutan</span>
						</a>
					</div>


				</div>
			<!--end::Menu-->
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

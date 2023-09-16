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
					<span class="menu-heading fw-bold text-uppercase fs-7">Permohonan</span>
				</div>
			</div>
			<div class="menu-item">
			<a class="menu-link" href="permohonan">
			<!-- "{{ route('dashboard') }}" -->
					<span class="menu-icon">{!! getIcon('book', 'fs-2') !!}</span>
					<span class="menu-title">Baru</span>
			</a>
		</div>

		<div class="menu-item">
			<a class="menu-link" href="{{ route('permohonan.sejarah') }}">

					<span class="menu-icon">{!! getIcon('search-list', 'fs-2') !!}</span>
					<span class="menu-title">Sejarah</span>
			</a>
		</div>

		<div class="menu-item">
			<a class="menu-link" href="{{ route('baharuimohon') }}">

					<span class="menu-icon">{!! getIcon('update-file', 'fs-2') !!}</span>
					<span class="menu-title">Perbaharui</span>
			</a>
		</div>

		<div class="menu-item pt-5">
				<div class="menu-content">
					<span class="menu-heading fw-bold text-uppercase fs-7">Tuntutan</span>
				</div>
			</div>
			<div class="menu-item">
			<a class="menu-link" href="{{ route('borangTuntutanYuran') }}">
			<!-- "{{ route('dashboard') }}" -->
					<span class="menu-icon">{!! getIcon('book', 'fs-2') !!}</span>
					<span class="menu-title">Baru</span>
			</a>
		</div>
		<div class="menu-item">
			<a class="menu-link" href="#">
			<!-- "{{ route('dashboard') }}" -->
					<span class="menu-icon">{!! getIcon('notepad-edit', 'fs-2') !!}</span>
					<span class="menu-title">Kemaskini</span>
			</a>
		</div>
		<div class="menu-item">
			<a class="menu-link" href="#">
			<!-- "{{ route('dashboard') }}" -->
					<span class="menu-icon">{!! getIcon('search-list', 'fs-2') !!}</span>
					<span class="menu-title">Sejarah</span>
			</a>
		</div>
		<div class="menu-item">
			<a class="menu-link" href="#">
					<span class="menu-icon">{!! getIcon('status', 'fs-2') !!}</span>
					<span class="menu-title">Status</span>
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
			<a class="menu-link" href="{{ route('keseluruhan-Permohonan')}}">
					<span class="menu-icon">{!! getIcon('book', 'fs-2') !!}</span>
					<span class="menu-title">Keseluruhan</span>
			</a>
		</div>


		<div class="menu-item">
			<a class="menu-link" href="{{ route('permohonanbaru')}}">
					<span class="menu-icon">{!! getIcon('search-list', 'fs-2') !!}</span>
					<span class="menu-title">Baru</span>
			</a>
		</div>
		<div class="menu-item">
			<a class="menu-link" href="#">
					<span class="menu-icon">{!! getIcon('status', 'fs-2') !!}</span>
					<span class="menu-title">Perbaharui</span>
			</a>
		</div>
		<div class="menu-item pt-5">
				<div class="menu-content">
					<span class="menu-heading fw-bold text-uppercase fs-7">Tuntutan</span>
				</div>
		</div>
		<div class="menu-item">
			<a class="menu-link" href="{{url('tuntutan/sekretariat/sejarah/sejarah-tuntutan')}}">
			<!-- "{{ route('dashboard') }}" -->
					<span class="menu-icon">{!! getIcon('book', 'fs-2') !!}</span>
					<span class="menu-title">Keseluruhan</span>
			</a>
		</div>
		<div class="menu-item">
			<a class="menu-link" href="{{url('tuntutan/sekretariat/wang-saku/senarai-tuntutan')}}">
			<!-- "{{ route('dashboard') }}" -->
					<span class="menu-icon">{!! getIcon('wallet', 'fs-2') !!}</span>
					<span class="menu-title">Wang Saku</span>
			</a>
		</div>
		<div class="menu-item">
			<a class="menu-link" href="{{url('tuntutan/sekretariat/yuran-dan-wang-saku/senarai-tuntutan')}}">
			<!-- "{{ route('dashboard') }}" -->
					<span class="menu-icon">{!! getIcon('dollar', 'fs-2') !!}</span>
					<span class="menu-title">Yuran Pengajian dan Wang Saku</span>
			</a>
		</div>
		<div class="menu-item">
			<a class="menu-link" href="{{url('tuntutan/sekretariat/kemaskini/kemaskini-tuntutan')}}">

					<span class="menu-icon">{!! getIcon('notepad-edit', 'fs-2') !!}</span>
					<span class="menu-title">Kemaskini</span>
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
			<a class="menu-link" href="{{url('permohonan/kelulusan')}}">
					<span class="menu-icon">{!! getIcon('search-list', 'fs-2') !!}</span>
					<span class="menu-title">Kelulusan</span>
			</a>
		</div>
		<div class="menu-item">
			<a class="menu-link" href="{{url('permohonan/keputusan')}}">
					<span class="menu-icon">{!! getIcon('status', 'fs-2') !!}</span>
					<span class="menu-title">Keputusan</span>
			</a>
		</div>
        <div class="menu-item">
            <a class="menu-link" href="{{url('permohonan/sekretariat/sejarah/senarai-permohonan')}}">
                <span class="menu-icon">{!! getIcon('watch', 'fs-2') !!}</span>
                <span class="menu-title">Sejarah</span>
            </a>
        </div>
		<div class="menu-item pt-5">
			<div class="menu-content">
				<span class="menu-heading fw-bold text-uppercase fs-7">Tuntutan</span>
			</div>
		</div>
		{{-- <div class="menu-item">
		<a class="menu-link" href="{{ url('tuntutan-keseluruhan') }}">
		<!-- "{{ route('dashboard') }}" -->
				<span class="menu-icon">{!! getIcon('book', 'fs-2') !!}</span>
				<span class="menu-title">Keseluruhan</span>
		</a>
		</div> --}}
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
					<span class="menu-icon">{!! getIcon('status', 'fs-2') !!}</span>
					<span class="menu-title">Keputusan</span>
			</a>
		</div>
        <div class="menu-item">
            <a class="menu-link" href="{{url('tuntutan/sekretariat/sejarah/sejarah-tuntutan')}}">
                <span class="menu-icon">{!! getIcon('watch', 'fs-2') !!}</span>
                <span class="menu-title">Sejarah</span>
            </a>
        </div>
		</div>
		<!--end::Menu-->

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

				</div>
			<!--end::Menu-->
@endif

	</div>
	<!--end::Menu wrapper-->
</div>
<!--end::sidebar menu-->

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
			<a class="menu-link" href="{{ route('sejarahpermohonan') }}">
			
					<span class="menu-icon">{!! getIcon('search-list', 'fs-2') !!}</span>
					<span class="menu-title">Sejarah</span>
			</a>
		</div>

		<!-- <div class="menu-item">
			<a class="menu-link" href="#">
			
					<span class="menu-icon">{!! getIcon('search', 'fs-2') !!}</span>
					<span class="menu-title">Test Salinan Maklumat</span>
			</a>
		</div> -->
		
		<div class="menu-item pt-5">
				<div class="menu-content">
					<span class="menu-heading fw-bold text-uppercase fs-7">Tuntutan</span>
				</div>
			</div>
			<div class="menu-item">
			<a class="menu-link" href="#">
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
			<a class="menu-link" href="{{ route('permohonanbaru')}}">
			<!-- "{{ route('dashboard') }}" -->
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
					<span class="menu-title">Keputusan</span>
			</a>
		</div>
		<div class="menu-item pt-5">
				<div class="menu-content">
					<span class="menu-heading fw-bold text-uppercase fs-7">Tuntutan</span>
				</div>
			</div>
			<div class="menu-item">
			<a class="menu-link" href="{{url('tuntutan-wang-saku')}}">
			<!-- "{{ route('dashboard') }}" -->
					<span class="menu-icon">{!! getIcon('wallet', 'fs-2') !!}</span>
					<span class="menu-title">Wang Saku</span>
			</a>
		</div>
		<div class="menu-item">
			<a class="menu-link" href="{{url('tuntutan-yuran-pengajian')}}">
			<!-- "{{ route('dashboard') }}" -->
					<span class="menu-icon">{!! getIcon('dollar', 'fs-2') !!}</span>
					<span class="menu-title">Yuran Pengajian dan Wang Saku</span>
			</a>
		</div>
		<!-- <div class="menu-item">
			<a class="menu-link" href="{{url('kemaskini-tuntutan')}}">
		
					<span class="menu-icon">{!! getIcon('notepad-edit', 'fs-2') !!}</span>
					<span class="menu-title">Kemaskini</span>
			</a>
		</div> -->
		<div class="menu-item">
			<a class="menu-link" href="{{url('penyelaras-sejarah-tuntutan')}}">
			<!-- "{{ route('dashboard') }}" -->
					<span class="menu-icon">{!! getIcon('search-list', 'fs-2') !!}</span>
					<span class="menu-title">Sejarah</span>
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
			<a class="menu-link" href="{{url('keseluruhanPermohonan')}}">
					<span class="menu-icon">{!! getIcon('book', 'fs-2') !!}</span>
					<span class="menu-title">Keseluruhan</span>
			</a>
		</div>
		<div class="menu-item">
			<a class="menu-link" href="{{url('saringan')}}">
					<span class="menu-icon">{!! getIcon('notepad-edit', 'fs-2') !!}</span>
					<span class="menu-title">Saringan</span>
			</a>
		</div>
		<div class="menu-item">
			<a class="menu-link" href="{{url('kelulusanPermohonan')}}">
					<span class="menu-icon">{!! getIcon('search-list', 'fs-2') !!}</span>
					<span class="menu-title">Kelulusan</span>
			</a>
		</div>
		<div class="menu-item">
			<a class="menu-link" href="{{url('keputusanPermohonan')}}">
					<span class="menu-icon">{!! getIcon('status', 'fs-2') !!}</span>
					<span class="menu-title">Keputusan</span>
			</a>
		</div>
		<div class="menu-item pt-5">
				<div class="menu-content">
					<span class="menu-heading fw-bold text-uppercase fs-7">Tuntutan</span>
				</div>
			</div>
			<div class="menu-item">
			<a class="menu-link" href="{{ url('tuntutan-keseluruhan') }}">
			<!-- "{{ route('dashboard') }}" -->
					<span class="menu-icon">{!! getIcon('book', 'fs-2') !!}</span>
					<span class="menu-title">Keseluruhan</span>
			</a>
		</div>
		<div class="menu-item">
			<a class="menu-link" href="{{ url('tuntutan-saring') }}">
			<!-- "{{ route('dashboard') }}" -->
					<span class="menu-icon">{!! getIcon('notepad-edit', 'fs-2') !!}</span>
					<span class="menu-title">Saringan</span>
			</a>
		</div>
		<div class="menu-item">
			<a class="menu-link" href="{{ url('tuntutan-kelulusan') }}">
			<!-- "{{ route('dashboard') }}" -->
					<span class="menu-icon">{!! getIcon('search-list', 'fs-2') !!}</span>
					<span class="menu-title">Kelulusan</span>
			</a>
		</div>
		<div class="menu-item">
			<a class="menu-link" href="{{ url('tuntutan-keputusan') }}">
			<!-- "{{ route('dashboard') }}" -->
					<span class="menu-icon">{!! getIcon('status', 'fs-2') !!}</span>
					<span class="menu-title">Keputusan</span>
			</a>
		</div>
		</div>
		<!--end::Menu-->

@endif
















		
	</div>
	<!--end::Menu wrapper-->
</div>
<!--end::sidebar menu-->

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
			<a class="menu-link" href="{{ route('statuspermohonan') }}">
			<!-- "{{ route('dashboard') }}" -->
					<span class="menu-icon">{!! getIcon('status', 'fs-2') !!}</span>
					<span class="menu-title">Status</span>
			</a>
		</div>
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
			<a class="menu-link" href="{{url('sekretariatStatus')}}">
					<span class="menu-icon">{!! getIcon('book', 'fs-2') !!}</span>
					<span class="menu-title">Status</span>
			</a>
		</div>
		<div class="menu-item">
			<a class="menu-link" href="{{url('saringan')}}">
					<span class="menu-icon">{!! getIcon('notepad-edit', 'fs-2') !!}</span>
					<span class="menu-title">Saringan</span>
			</a>
		</div>
		<div class="menu-item">
			<a class="menu-link" href="{{url('sekretariatPengesahan')}}">
					<span class="menu-icon">{!! getIcon('search-list', 'fs-2') !!}</span>
					<span class="menu-title">Pengesahan</span>
			</a>
		</div>
		<div class="menu-item">
			<a class="menu-link" href="{{url('sekretariatKeputusan')}}">
					<span class="menu-icon">{!! getIcon('search-list', 'fs-2') !!}</span>
					<span class="menu-title">Keputusan</span>
			</a>
		</div>
		<div class="menu-item pt-5">
				<div class="menu-content">
					<span class="menu-heading fw-bold text-uppercase fs-7">Tuntutan</span>
				</div>
			</div>
			<div class="menu-item">
			<a class="menu-link" href="#">
			<!-- "{{ route('dashboard') }}" -->
					<span class="menu-icon">{!! getIcon('book', 'fs-2') !!}</span>
					<span class="menu-title">Status Tuntutan</span>
			</a>
		</div>
		<div class="menu-item">
			<a class="menu-link" href="#">
			<!-- "{{ route('dashboard') }}" -->
					<span class="menu-icon">{!! getIcon('notepad-edit', 'fs-2') !!}</span>
					<span class="menu-title">Saring Tuntutan</span>
			</a>
		</div>
		<div class="menu-item">
			<a class="menu-link" href="#">
			<!-- "{{ route('dashboard') }}" -->
					<span class="menu-icon">{!! getIcon('search-list', 'fs-2') !!}</span>
					<span class="menu-title">Pengesahan Tuntutan</span>
			</a>
		</div>
		<div class="menu-item">
			<a class="menu-link" href="#">
			<!-- "{{ route('dashboard') }}" -->
					<span class="menu-icon">{!! getIcon('status', 'fs-2') !!}</span>
					<span class="menu-title">Keputusan Tuntutan</span>
			</a>
		</div>
		</div>
		<!--end::Menu-->

@endif
















		
	</div>
	<!--end::Menu wrapper-->
</div>
<!--end::sidebar menu-->

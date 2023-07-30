<!--begin:Pages menu-->
<div class="menu-active-bg px-4 px-lg-0">
	<!--begin:Tabs nav-->
	<div class="d-flex w-100 overflow-auto">
		<ul class="nav nav-stretch nav-line-tabs fw-bold fs-6 p-0 p-lg-10 flex-nowrap flex-grow-1">
			<!--begin:Nav item-->
			<li class="nav-item mx-lg-1">
				<a class="nav-link py-3 py-lg-6 active text-active-primary" href="#" data-bs-toggle="tab" data-bs-target="#kt_app_header_menu_pages_pages">General</a>
			</li>
			<!--end:Nav item-->
			<!--begin:Nav item-->
			<li class="nav-item mx-lg-1">
				<a class="nav-link py-3 py-lg-6 text-active-primary" href="#" data-bs-toggle="tab" data-bs-target="#kt_app_header_menu_pages_account">Account</a>
			</li>
			<!--end:Nav item-->
			<!--begin:Nav item-->
			<li class="nav-item mx-lg-1">
				<a class="nav-link py-3 py-lg-6 text-active-primary" href="#" data-bs-toggle="tab" data-bs-target="#kt_app_header_menu_pages_authentication">Authentication</a>
			</li>
			<!--end:Nav item-->
			<!--begin:Nav item-->
			<li class="nav-item mx-lg-1">
				<a class="nav-link py-3 py-lg-6 text-active-primary" href="#" data-bs-toggle="tab" data-bs-target="#kt_app_header_menu_pages_utilities">Utilities</a>
			</li>
			<!--end:Nav item-->
			<!--begin:Nav item-->
			<li class="nav-item mx-lg-1">
				<a class="nav-link py-3 py-lg-6 text-active-primary" href="#" data-bs-toggle="tab" data-bs-target="#kt_app_header_menu_pages_widgets">Widgets</a>
			</li>
			<!--end:Nav item-->
		</ul>
	</div>
	<!--end:Tabs nav-->
	<!--begin:Tab content-->
	<div class="tab-content py-4 py-lg-8 px-lg-7">
		<!--begin:Tab pane-->
		<div class="tab-pane active w-lg-1000px" id="kt_app_header_menu_pages_pages">
			@include(config('settings.KT_THEME_LAYOUT_DIR').'/partials/header-layout/header/_menu/__pages-general')
		</div>
		<!--end:Tab pane-->
		<!--begin:Tab pane-->
		<div class="tab-pane w-lg-600px" id="kt_app_header_menu_pages_account">
			@include(config('settings.KT_THEME_LAYOUT_DIR').'/partials/header-layout/header/_menu/__pages-account')
		</div>
		<!--end:Tab pane-->
		<!--begin:Tab pane-->
		<div class="tab-pane w-lg-1000px" id="kt_app_header_menu_pages_authentication">
			@include(config('settings.KT_THEME_LAYOUT_DIR').'/partials/header-layout/header/_menu/__pages-authentication')
		</div>
		<!--end:Tab pane-->
		<!--begin:Tab pane-->
		<div class="tab-pane w-lg-1000px" id="kt_app_header_menu_pages_utilities">
			@include(config('settings.KT_THEME_LAYOUT_DIR').'/partials/header-layout/header/_menu/__pages-utilities')
		</div>
		<!--end:Tab pane-->
		<!--begin:Tab pane-->
		<div class="tab-pane w-lg-500px" id="kt_app_header_menu_pages_widgets">
			@include(config('settings.KT_THEME_LAYOUT_DIR').'/partials/header-layout/header/_menu/__pages-widgets')
		</div>
		<!--end:Tab pane-->
	</div>
	<!--end:Tab content-->
</div>
<!--end:Pages menu-->

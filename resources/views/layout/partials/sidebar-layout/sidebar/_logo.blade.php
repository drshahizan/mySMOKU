<style>
	/* .icon-toggle
	{
		line-height: 1;
		font-size: 1rem;
		background: darkgrey;
	} */
</style>
<!--begin::Logo-->
<div class="app-sidebar-logo px-4" id="kt_app_sidebar_logo">
	<!--begin::Logo image-->
	<a href="/">
		<img alt="Logo" src="{{ image('logos/3.svg') }}" class="h-50px app-sidebar-logo-default" />
		<img alt="Logo" src="{{ image('logos/3.svg') }}" class="h-20px app-sidebar-logo-minimize" />
	</a>
	
	<!--end::Logo image-->
	<!--begin::Sidebar toggle-->
	<!--begin::Minimized sidebar setup:
            if (isset($_COOKIE["sidebar_minimize_state"]) && $_COOKIE["sidebar_minimize_state"] === "on") {
                1. "src/js/layout/sidebar.js" adds "sidebar_minimize_state" cookie value to save the sidebar minimize state.
                2. Set data-kt-app-sidebar-minimize="on" attribute for body tag.
                3. Set data-kt-toggle-state="active" attribute to the toggle element with "kt_app_sidebar_toggle" id.
                4. Add "active" class to to sidebar toggle element with "kt_app_sidebar_toggle" id.
            }
        -->
	<div id="kt_app_sidebar_toggle" class="app-sidebar-toggle btn btn-icon btn-shadow btn-sm btn-color-muted btn-active-color-primary h-30px w-30px position-absolute top-50 start-100 translate-middle rotate" data-kt-toggle="true" data-kt-toggle-state="active" data-kt-toggle-target="body" data-kt-toggle-name="app-sidebar-minimize">
		<div class="icon-toggle">
			{!! getIcon('black-left-line', 'fs-3 rotate-180 ms-1') !!}
		</div>
	</div>
	<!--end::Sidebar toggle-->
</div>
<!--end::Logo-->

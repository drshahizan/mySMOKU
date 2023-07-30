<!--begin::Chart widget 14-->
<div class="card card-flush h-xl-100">
	<!--begin::Header-->
	<div class="card-header pt-7">
		<!--begin::Title-->
		<h3 class="card-title align-items-start flex-column">
			<span class="card-label fw-bold text-dark">Departments</span>
			<span class="text-gray-400 pt-2 fw-semibold fs-6">Performance & achievements</span>
		</h3>
		<!--end::Title-->
		<!--begin::Toolbar-->
		<div class="card-toolbar">
			<!--begin::Menu-->
			<button class="btn btn-icon btn-color-gray-400 btn-active-color-primary justify-content-end" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end" data-kt-menu-overflow="true">{!! getIcon('dots-square', 'fs-1 text-gray-300 me-n1') !!}</button>
			@include('partials/menus/_menu-3')
			<!--end::Menu-->
		</div>
		<!--end::Toolbar-->
	</div>
	<!--end::Header-->
	<!--begin::Body-->
	<div class="card-body pt-5">
		<!--begin::Chart container-->
		<div id="kt_charts_widget_14_chart" class="w-100 h-350px"></div>
		<!--end::Chart container-->
	</div>
	<!--end::Body-->
</div>
<!--end::Chart widget 14-->
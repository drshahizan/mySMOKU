<!--begin::Chart widget 20-->
<div class="card card-flush h-xl-100">
	<!--begin::Header-->
	<div class="card-header py-5">
		<!--begin::Title-->
		<h3 class="card-title fw-bold text-dark-800">Monthly Targets</h3>
		<!--end::Title-->
		<!--begin::Toolbar-->
		<div class="card-toolbar">
			<!--begin::Daterangepicker(defined in src/js/layout/app.js)-->
			<div data-kt-daterangepicker="true" data-kt-daterangepicker-opens="left" class="btn btn-sm btn-light d-flex align-items-center px-4">
			<!--begin::Display range-->
			<div class="text-gray-600 fw-bold">Loading date range...</div>
			<!--end::Display range-->
			{!! getIcon('calendar-8', 'fs-1 ms-2 me-0') !!}</div>
			<!--end::Daterangepicker-->
		</div>
		<!--end::Toolbar-->
	</div>
	<!--end::Header-->
	<!--begin::Card body-->
	<div class="card-body d-flex justify-content-between flex-column pb-0 px-0 pt-1">
		<!--begin::Items-->
		<div class="d-flex flex-wrap d-grid gap-5 px-9 mb-5">
			<!--begin::Item-->
			<div class="me-md-2">
				<!--begin::Statistics-->
				<div class="d-flex mb-2">
					<span class="fs-4 fw-semibold text-gray-400 me-1">$</span>
					<span class="fs-2hx fw-bold text-gray-800 me-2 lh-1 ls-n2">12,706</span>
				</div>
				<!--end::Statistics-->
				<!--begin::Description-->
				<span class="fs-6 fw-semibold text-gray-400">Targets for April</span>
				<!--end::Description-->
			</div>
			<!--end::Item-->
			<!--begin::Item-->
			<div class="border-start-dashed border-end-dashed border-start border-end border-gray-300 px-5 ps-md-10 pe-md-7 me-md-5">
				<!--begin::Statistics-->
				<div class="d-flex mb-2">
					<span class="fs-4 fw-semibold text-gray-400 me-1">$</span>
					<span class="fs-2hx fw-bold text-gray-800 me-2 lh-1 ls-n2">8,035</span>
				</div>
				<!--end::Statistics-->
				<!--begin::Description-->
				<span class="fs-6 fw-semibold text-gray-400">Actual for April</span>
				<!--end::Description-->
			</div>
			<!--end::Item-->
			<!--begin::Item-->
			<div class="m-0">
				<!--begin::Statistics-->
				<div class="d-flex align-items-center mb-2">
					<!--begin::Currency-->
					<span class="fs-4 fw-semibold text-gray-400 align-self-start me-1">$</span>
					<!--end::Currency-->
					<!--begin::Value-->
					<span class="fs-2hx fw-bold text-gray-800 me-2 lh-1 ls-n2">4,684</span>
					<!--end::Value-->
					<!--begin::Label-->
					<span class="badge badge-light-success fs-base">{!! getIcon('black-up', 'fs-7 text-success ms-n1') !!} 4.5%</span>
					<!--end::Label-->
				</div>
				<!--end::Statistics-->
				<!--begin::Description-->
				<span class="fs-6 fw-semibold text-gray-400">GAP</span>
				<!--end::Description-->
			</div>
			<!--end::Item-->
		</div>
		<!--end::Items-->
		<!--begin::Chart-->
		<div id="kt_charts_widget_20" class="min-h-auto ps-4 pe-6" data-kt-chart-info="Revenue" style="height: 300px"></div>
		<!--end::Chart-->
	</div>
	<!--end::Card body-->
</div>
<!--end::Chart widget 20-->

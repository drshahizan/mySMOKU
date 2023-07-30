<!--begin::Step 4-->
<div data-kt-stepper-element="content">
	<!--begin::Wrapper-->
	<div class="w-100">
		<!--begin::Heading-->
		<div class="pb-10 pb-lg-12">
			<!--begin::Title-->
			<h1 class="fw-bold text-dark">Budget Estimates</h1>
			<!--end::Title-->
			<!--begin::Description-->
			<div class="text-muted fw-semibold fs-4">If you need more info, please check 
			<a href="#" class="link-primary">Campaign Guidelines</a></div>
			<!--end::Description-->
		</div>
		<!--end::Heading-->
		<!--begin::Input group-->
		<div class="fv-row mb-10">
			<!--begin::Label-->
			<label class="fs-6 fw-semibold mb-2">Campaign Duration 
			<i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Choose how long you want your ad to run for"></i></label>
			<!--end::Label-->
			<!--begin::Duration option-->
			<div class="d-flex gap-9 mb-7">
				<!--begin::Button-->
				<button type="button" class="btn btn-outline btn-outline-dashed btn-active-light-primary active" id="kt_modal_create_campaign_duration_all">Continuous duration 
				<br />
				<span class="fs-7">Your ad will run continuously for a daily budget.</span></button>
				<!--end::Button-->
				<!--begin::Button-->
				<button type="button" class="btn btn-outline btn-outline-dashed btn-active-light-primary btn-outline-default" id="kt_modal_create_campaign_duration_fixed">Fixed duration 
				<br />
				<span class="fs-7">Your ad will run on the specified dates only.</span></button>
				<!--end::Button-->
			</div>
			<!--end::Duration option-->
			<!--begin::Datepicker-->
			<input class="form-control form-control-solid d-none" placeholder="Pick date &amp; time" id="kt_modal_create_campaign_datepicker" />
			<!--end::Datepicker-->
		</div>
		<!--end::Input group-->
		<!--begin::Input group-->
		<div class="fv-row mb-10">
			<!--begin::Label-->
			<label class="fs-6 fw-semibold mb-2">Daily Budget 
			<i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Choose the budget allocated for each day. Higher budget will generate better results"></i></label>
			<!--end::Label-->
			<!--begin::Slider-->
			<div class="d-flex flex-column text-center">
				<div class="d-flex align-items-start justify-content-center mb-7">
					<span class="fw-bold fs-4 mt-1 me-2">$</span>
					<span class="fw-bold fs-3x" id="kt_modal_create_campaign_budget_label"></span>
					<span class="fw-bold fs-3x">.00</span>
				</div>
				<div id="kt_modal_create_campaign_budget_slider" class="noUi-sm"></div>
			</div>
			<!--end::Slider-->
		</div>
		<!--end::Input group-->
	</div>
	<!--end::Wrapper-->
</div>
<!--end::Step 4-->
<x-default-layout> 
<head>

<!-- MAIN CSS -->
<link rel="stylesheet" href="/assets/css/saringan.css">
<script src="https://cdn.tiny.cloud/1/v736541al0ntzh14edk63z19dzyqs1xn2bkc5em78rv1yeis/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js"></script>
<link href="/assets/css/style.bundle.css" rel="stylesheet" type="text/css" />

</head>
<!--begin::Page title-->
<div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
	<!--begin::Title-->
	<h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Set Tarikh Iklan</h1>
	<!--end::Title-->
</div>
<br>
<!--end::Page title-->
<div class="table-responsive">
	<!--begin::Content-->
	<div id="kt_app_content" class="app-content flex-column-fluid">
		<!--begin::Content container-->
		<div id="kt_app_content_container" class="app-container container-xxl">
			<!--begin::Card-->
			<div class="card">
				<!--begin::Card header-->
				<div class="card-header border-0 pt-6">
					<!--begin::Card title-->
					<div class="card-title">
						<!--begin::Search-->
						<div class="d-flex align-items-center position-relative my-1">
							<i>
								<span class="path1"></span>
								<span class="path2"></span>
							</i>
						</div>
						<!--end::Search-->
					</div>
					<!--begin::Card title-->
				</div>
				<!--end::Card header-->
				<!--begin::Card body-->
				<div class="card-body pt-0">	
					<!--begin::Form-->
					<form class="form" id="iklan" onsubmit="return validateForm()" action="{{ route('simpan.tarikh') }}" method="post">
						@csrf
						
						<div class="row mb-10">
							<!--begin::Input group-->
							<div class="col-md-6 fv-row">
								<!--begin::Label-->
								<label class="fs-6 fw-semibold mb-2">Tarikh Mula</label>
								<!--end::Label-->
								<!--begin::Input-->
								<input type="date" class="form-control form-control-solid" name="tarikh_mula" value="" required oninvalid="this.setCustomValidity('Masukkan tarikh mula.')" oninput="setCustomValidity('')"/>
								<!--end::Input-->
							</div>
							<!--end::Input group-->
							<!--begin::Input group-->
							<div class="col-md-6 fv-row">
								<!--begin::Label-->
								<label class="fs-6 fw-semibold mb-2">Masa Mula</label>
								<!--end::Label-->
								<!--begin::Input-->
								<input type="time" class="form-control form-control-solid" name="masa_mula" value="" required oninvalid="this.setCustomValidity('Masukkan masa mula.')" oninput="setCustomValidity('')"/>
								<!--end::Input-->
							</div>
							<!--end::Input group-->
						</div>
						<div class="row mb-10">
							<!--begin::Input group-->
							<div class="col-md-6 fv-row">
								<!--begin::Label-->
								<label class="fs-6 fw-semibold mb-2">Tarikh Tamat</label>
								<!--end::Label-->
								<!--begin::Input-->
								<input type="date" class="form-control form-control-solid" name="tarikh_tamat" value="" required oninvalid="this.setCustomValidity('Masukkan tarikh tamat.')" oninput="setCustomValidity('')"/>
								<!--end::Input-->
							</div>
							<!--end::Input group-->
							<!--begin::Input group-->
							<div class="col-md-6 fv-row">
								<!--begin::Label-->
								<label class="fs-6 fw-semibold mb-2">Masa Tamat</label>
								<!--end::Label-->
								<!--begin::Input-->
								<input type="time" class="form-control form-control-solid" name="masa_tamat" value="" required oninvalid="this.setCustomValidity('Masukkan masa tamat.')" oninput="setCustomValidity('')"/>
								<!--end::Input-->
							</div>
							<!--end::Input group-->
						</div>
						<!--begin::Input group-->
						<div class="col-md-6 fv-row">
							<!--begin::Label-->
							<label class="fs-6 fw-semibold mb-2">Catatan</label>
							<!--end::Label-->
							<!--begin::Input-->
							<textarea class="form-control form-control-solid" name="catatan" id="catatan"></textarea>
							<!--end::Input-->
						</div>
						<!--end::Input group-->
						
						<br>
						<!--begin::action-->
						<div class="modal-footer flex-center">
							<!--begin::Button-->
							{{-- <button type="submit" onclick="validateForm()" id="kt_modal_add_customer_submit" class="btn btn-primary">
								<span class="indicator-label">Simpan</span>
								<span class="indicator-progress">Sila tunggu...
								<span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
							</button> --}}
							<button type="submit" class="btn btn-primary">
								<span class="indicator-label">Simpan</span>
								<span class="indicator-progress">Sila tunggu...
								<span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
							</button>
							<!--end::Button-->
						</div>
						<!--end::action-->
					</form>
					<!--end::Form-->
				</div>
				<!--end::Card body-->
				<!--begin::Card body-->
				<div class="card-body pt-0">
					<!--begin::Table-->
					<div class="table-responsive">
						<table class="table align-center table-row-dashed fs-6 gy-5" id="kt_customers_table">
							<thead>
								<tr class="text-start align-center text-gray-400 fw-bold fs-7 gs-0">
									<th class="min-w-125px align-center">Tarikh Mula</th>
									<th class="min-w-125px align-center">Tarikh Tamat</th>
									<th class="min-w-125px align-center">Catatan</th>
									<th class="min-w-125px align-center">Tarikh Kemaskini</th>
								</tr>
							</thead>
							<tbody class="fw-semibold text-gray-600">
								<tr>
									<td>{{ $tarikh->tarikh_mula}}</td>
									<td>{{ $tarikh->tarikh_tamat}}</td>
									<td class="align-left">{!! $tarikh->catatan !!}</td>
									<td>{{ $tarikh->created_at->format('d/m/Y h:i:sa')}}</td>
								</tr>
							</tbody>
						</table>
					</div>
					<!--end::Table-->
				</div>
				<!--end::Card body-->
			</div>
			<!--end::Card-->	
		</div>
		<!--end::Content container-->
	</div>
	<!--end::Content-->
	
</div>

<!--begin::Javascript-->
<script>
	// Initialize TinyMCE
	tinymce.init({
		selector: '#catatan',
		plugins: 'autolink lists link image charmap print preview',
		toolbar: 'undo redo | formatselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
		height: 300,
		setup: function (editor) {
			// You can perform additional setup here if needed
		}
	});

	function validateForm() {
		// Get the content of TinyMCE editor
		var editorContent = tinymce.get('catatan').getContent();

		// Check if the content is not empty
		if (editorContent.trim().length === 0) {
			alert('Masukkan maklumat iklan.');
		} 
		else {
			// Form is valid, you can proceed with further actions
			// alert('Iklan telah dikemaskini.');
			return true; // Allow form submission
		}
	}
</script>

<!--end::Javascript-->
	
<style>
.align-center {
    text-align: center;
}

.align-left {
	text-align: left;
}
</style>



</x-default-layout>
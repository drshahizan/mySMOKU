<x-default-layout> 
<head>

<!-- MAIN CSS -->
<link rel="stylesheet" href="/assets/css/saringan.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js"></script>
<link href="assets/css/style.bundle.css" rel="stylesheet" type="text/css" />

</head>
		<!--begin::Page title-->
<div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
	<!--begin::Title-->
	<h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Alamat Kementerian</h1>
	<!--end::Title-->
	
</div>
<br>
<!--end::Page title-->
<div class="table-responsive">
	<!--begin::Content-->
	<div id="kt_app_content" class="app-content flex-column-fluid">
		<!--begin::Content container-->
		<div id="kt_app_content_container" class="app-container container-xxl">
			
			
						<!--begin::Form-->
						<form class="form" action="{{ route('daftarpengguna.post') }}"  data-kt-redirect="{{ route('daftarpengguna') }}" method="post">
							@csrf
							
							<div class="row mb-10">
								<!--begin::Input group-->
								<div class="col-md-6 fv-row">
									<!--begin::Label-->
									<label class="fs-6 fw-semibold mb-2">Nama Kementerian (Bm)</label>
									<!--end::Label-->
									<!--begin::Input-->
									<input type="text" class="form-control form-control-solid" placeholder="" name="nama" value="" />
									<!--end::Input-->
								</div>
								<!--end::Input group-->
								<!--begin::Input group-->
								<div class="col-md-6 fv-row">
									<!--begin::Label-->
									<label class="fs-6 fw-semibold mb-2">Nama Kementerian (Bi)</label>
									<!--end::Label-->
									<!--begin::Input-->
									<input type="email" class="form-control form-control-solid" placeholder="" name="email" value="" />
									<!--end::Input-->
								</div>
								<!--end::Input group-->
							</div>

							<div class="row mb-10">
								<!--begin::Input group-->
								<div class="col-md-6 fv-row">
									<!--begin::Label-->
									<label class="fs-6 fw-semibold mb-2">Nama Bahagian (Bm)</label>
									<!--end::Label-->
									<!--begin::Input-->
									<input type="text" class="form-control form-control-solid" placeholder="" name="no_kp" />
									<!--end::Input-->
								</div>
								<!--end::Input group-->
								<!--begin::Input group-->
								<div class="col-md-6 fv-row">
									<!--begin::Label-->
									<label class="fs-6 fw-semibold mb-2">Nama Bahagian (Bi)</label>
									<!--end::Label-->
									<!--begin::Input-->
									<input type="text" class="form-control form-control-solid" placeholder="" name="jawatan" value="" />
									<!--end::Input-->
								</div>
								<!--end::Input group-->
							</div>

							<div class="row mb-10">
								<!--begin::Input group-->
								<div class="col-md-6 fv-row">
									<!--begin::Label-->
									<label class="fs-6 fw-semibold mb-2">Alamat1</label>
									<!--end::Label-->
									<!--begin::Input-->
									<input type="text" class="form-control form-control-solid" placeholder="" name="no_kp" />
									<!--end::Input-->
								</div>
								<!--end::Input group-->
								<!--begin::Input group-->
								<div class="col-md-6 fv-row">
									<!--begin::Label-->
									<label class="fs-6 fw-semibold mb-2">Alamat2</label>
									<!--end::Label-->
									<!--begin::Input-->
									<input type="text" class="form-control form-control-solid" placeholder="" name="jawatan" value="" />
									<!--end::Input-->
								</div>
								<!--end::Input group-->
							</div>

							<div class="row mb-10">
								<!--begin::Input group-->
								<div class="col-md-4 fv-row">
									<!--begin::Label-->
									<label class="fs-6 fw-semibold mb-2">Poskod</label>
									<!--end::Label-->
									<!--begin::Input-->
									<input type="text" class="form-control form-control-solid" placeholder="" name="no_kp" />
									<!--end::Input-->
								</div>
								<!--end::Input group-->
								<!--begin::Input group-->
								<div class="col-md-4 fv-row">
									<!--begin::Label-->
									<label class="fs-6 fw-semibold mb-2">Negeri</label>
									<!--end::Label-->
									<!--begin::Input-->
									<input type="text" class="form-control form-control-solid" placeholder="" name="jawatan" value="" />
									<!--end::Input-->
								</div>
								<!--end::Input group-->
								<!--begin::Input group-->
								<div class="col-md-4 fv-row">
									<!--begin::Label-->
									<label class="fs-6 fw-semibold mb-2">Negara</label>
									<!--end::Label-->
									<!--begin::Input-->
									<input type="text" class="form-control form-control-solid" placeholder="" name="jawatan" value="" />
									<!--end::Input-->
								</div>
								<!--end::Input group-->
							</div>
							
							<div class="row mb-10">
								<!--begin::Input group-->
								<div class="col-md-4 fv-row">
									<!--begin::Label-->
									<label class="fs-6 fw-semibold mb-2">Tel</label>
									<!--end::Label-->
									<!--begin::Input-->
									<input type="text" class="form-control form-control-solid" placeholder="" name="no_kp" />
									<!--end::Input-->
								</div>
								<!--end::Input group-->
								<!--begin::Input group-->
								<div class="col-md-4 fv-row">
									<!--begin::Label-->
									<label class="fs-6 fw-semibold mb-2">Hotline</label>
									<!--end::Label-->
									<!--begin::Input-->
									<input type="text" class="form-control form-control-solid" placeholder="" name="jawatan" value="" />
									<!--end::Input-->
								</div>
								<!--end::Input group-->
								<!--begin::Input group-->
								<div class="col-md-4 fv-row">
									<!--begin::Label-->
									<label class="fs-6 fw-semibold mb-2">Faks</label>
									<!--end::Label-->
									<!--begin::Input-->
									<input type="text" class="form-control form-control-solid" placeholder="" name="jawatan" value="" />
									<!--end::Input-->
								</div>
								<!--end::Input group-->
							</div>
							<!--begin::Modal footer-->
							<div class="modal-footer flex-center">
								<!--begin::Button-->
								<button type="reset" id="kt_modal_add_customer_cancel" class="btn btn-light me-3">Kembali</button>
								<!--end::Button-->
								<!--begin::Button-->
								<button type="submit" id="kt_modal_add_customer_submit" class="btn btn-primary">
									<span class="indicator-label">Simpan</span>
									<span class="indicator-progress">Sila tunggu...
									<span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
								</button>
								<!--end::Button-->
							</div>
							<!--end::Modal footer-->
						</form>
						<!--end::Form-->
					
			
		</div>
		<!--end::Content container-->
	</div>
	<!--end::Content-->
	
</div>

<!--begin::Javascript-->
<!--begin::Global Javascript Bundle(mandatory for all pages)-->

<script src="assets/js/scripts.bundle.js"></script>
<!--end::Global Javascript Bundle-->

<!--begin::Custom Javascript(used for this page only)-->
<script src="assets/js/custom/apps/customers/list/export.js"></script>
<script src="assets/js/custom/apps/customers/list/list.js"></script>
<script src="assets/js/custom/apps/customers/add.js"></script>
<script src="assets/js/custom/utilities/modals/new-card.js"></script>
<script src="assets/js/custom/utilities/modals/users-search.js"></script>
<!--end::Custom Javascript-->
<!--end::Javascript-->
	




</x-default-layout>
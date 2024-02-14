<x-default-layout> 
<head>

<!-- MAIN CSS -->
<link rel="stylesheet" href="/assets/css/saringan.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js"></script>
<link href="/assets/css/style.bundle.css" rel="stylesheet" type="text/css" />

</head>
		<!--begin::Page title-->
<div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
	<!--begin::Title-->
	<h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Kemaskini Alamat Kementerian</h1>
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
					<form class="form" action="{{ route('alamat.save') }}" method="post">
						@csrf
						
						@foreach ($maklumat as $maklumat)
						<div class="row mb-10">
							<!--begin::Input group-->
							<div class="col-md-6 fv-row">
								<!--begin::Label-->
								<label class="fs-6 fw-semibold mb-2">Nama Kementerian (Bm)</label>
								<!--end::Label-->
								<!--begin::Input-->
								<input type="text" class="form-control form-control-solid" placeholder="" name="nama_kementerian_bm" value="{{$maklumat->nama_kementerian_bm}}" />
								<!--end::Input-->
							</div>
							<!--end::Input group-->
							<!--begin::Input group-->
							<div class="col-md-6 fv-row">
								<!--begin::Label-->
								<label class="fs-6 fw-semibold mb-2">Nama Kementerian (Bi)</label>
								<!--end::Label-->
								<!--begin::Input-->
								<input type="text" class="form-control form-control-solid" placeholder="" name="nama_kementerian_bi" value="{{$maklumat->nama_kementerian_bi}}" />
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
								<input type="text" class="form-control form-control-solid" placeholder="" name="nama_bahagian_bm" value="{{$maklumat->nama_bahagian_bm}}"/>
								<!--end::Input-->
							</div>
							<!--end::Input group-->
							<!--begin::Input group-->
							<div class="col-md-6 fv-row">
								<!--begin::Label-->
								<label class="fs-6 fw-semibold mb-2">Nama Bahagian (Bi)</label>
								<!--end::Label-->
								<!--begin::Input-->
								<input type="text" class="form-control form-control-solid" placeholder="" name="nama_bahagian_bi" value="{{$maklumat->nama_bahagian_bi}}" />
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
								<input type="text" class="form-control form-control-solid" placeholder="" name="alamat1" value="{{$maklumat->alamat1}}"/>
								<!--end::Input-->
							</div>
							<!--end::Input group-->
							<!--begin::Input group-->
							<div class="col-md-6 fv-row">
								<!--begin::Label-->
								<label class="fs-6 fw-semibold mb-2">Alamat2</label>
								<!--end::Label-->
								<!--begin::Input-->
								<input type="text" class="form-control form-control-solid" placeholder="" name="alamat2" value="{{$maklumat->alamat2}}" />
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
								<input type="text" class="form-control form-control-solid" placeholder="" name="poskod" value="{{$maklumat->poskod}}"/>
								<!--end::Input-->
							</div>
							<!--end::Input group-->
							<!--begin::Input group-->
							<div class="col-md-4 fv-row">
								<!--begin::Label-->
								<label class="fs-6 fw-semibold mb-2">Negeri</label>
								<!--end::Label-->
								<!--begin::Input-->
								<input type="text" class="form-control form-control-solid" placeholder="" name="negeri" value="{{$maklumat->negeri}}"/>
								<!--end::Input-->
							</div>
							<!--end::Input group-->
							<!--begin::Input group-->
							<div class="col-md-4 fv-row">
								<!--begin::Label-->
								<label class="fs-6 fw-semibold mb-2">Negara</label>
								<!--end::Label-->
								<!--begin::Input-->
								<input type="text" class="form-control form-control-solid" placeholder="" name="negara" value="{{$maklumat->negara}}" />
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
								<input type="text" class="form-control form-control-solid" placeholder="" name="tel" value="{{$maklumat->tel}}"/>
								<!--end::Input-->
							</div>
							<!--end::Input group-->
							<!--begin::Input group-->
							<div class="col-md-4 fv-row">
								<!--begin::Label-->
								<label class="fs-6 fw-semibold mb-2">Hotline</label>
								<!--end::Label-->
								<!--begin::Input-->
								<input type="text" class="form-control form-control-solid" placeholder="" name="hotline" value="{{$maklumat->hotline}}" />
								<!--end::Input-->
							</div>
							<!--end::Input group-->
							<!--begin::Input group-->
							<div class="col-md-4 fv-row">
								<!--begin::Label-->
								<label class="fs-6 fw-semibold mb-2">Faks</label>
								<!--end::Label-->
								<!--begin::Input-->
								<input type="text" class="form-control form-control-solid" placeholder="" name="faks" value="{{$maklumat->faks}}" />
								<!--end::Input-->
							</div>
							<!--end::Input group-->
						</div>
						@endforeach
						<!--begin::action-->
						<div class="modal-footer flex-center">
							<!--begin::Button-->
							<button type="submit" id="kt_modal_add_customer_submit" class="btn btn-primary">
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
			</div>
			<!--end::Card-->	
		</div>
		<!--end::Content container-->
	</div>
	<!--end::Content-->
	
</div>

<!--begin::Javascript-->
<!--begin::Global Javascript Bundle(mandatory for all pages)-->

<script src="/assets/js/scripts.bundle.js"></script>
<!--end::Global Javascript Bundle-->

<!--begin::Custom Javascript(used for this page only)-->
{{-- <script src="assets/js/custom/apps/customers/list/export.js"></script>
<script src="assets/js/custom/apps/customers/list/list.js"></script>
<script src="assets/js/custom/apps/customers/add.js"></script>
<script src="assets/js/custom/utilities/modals/new-card.js"></script>
<script src="assets/js/custom/utilities/modals/users-search.js"></script> --}}
<!--end::Custom Javascript-->
<!--end::Javascript-->
	




</x-default-layout>
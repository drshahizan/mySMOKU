<x-default-layout> 
<head>
	<link rel="stylesheet" href="/assets/css/saringan.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
	<script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js"></script>
</head>
<!--begin::Content-->
<div id="kt_app_content" class="app-content flex-column-fluid">
	<!--begin::Content container-->
	<div id="kt_app_content_container" class="app-container container-xxl">
		<!--begin::Layout-->
		<div class="d-flex flex-column flex-lg-row">
			<!--begin::Content-->
			<div class="flex-lg-row-fluid mb-10 mb-lg-0 me-lg-7 me-xl-10">
				<!--begin::Card-->
				<div class="card">
					<!--begin::Card body-->
					<div class="card-body p-12">
						<!--begin::Form-->
						<form action="{{ route('save') }}" method="post" enctype="multipart/form-data">
							@csrf
							<div class="d-flex flex-column align-items-start flex-xxl-row">
								<div class="d-flex flex-center flex-equal fw-row text-nowrap order-1 order-xxl-2 me-4" data-bs-toggle="tooltip" data-bs-trigger="hover">
									<span class="fs-3 fw-bold text-gray-800">Keputusan Peperiksaan Baru</span>
								</div>
							</div>
							<br>
							<!--begin::Wrapper-->
							<div class="mb-0">
								<!--begin::Row-->
								<div class="row gx-10 mb-5">
									<!--begin::Col-->
									<div class="col-lg-6">
										<label class="form-label fs-6 fw-bold text-gray-700 mb-3">Sesi Pengajian</label>
										<div class="mb-5">
											<input type="text" name="sesi" class="form-control form-control-solid" placeholder="2023/2024" />
										</div>
									</div>
									<div class="col-lg-6">
										<label class="form-label fs-6 fw-bold text-gray-700 mb-3">Semester</label>
										<div class="mb-5">
											<select id="semester" name="semester" class="form-select form-select-solid" data-control="select2" data-hide-search="true" data-placeholder="Pilih">
												<option></option>
												<option value="1">1</option>
												<option value="2">2</option>					
												<option value="3">3</option>					
											</select>
										</div>
									</div>
									<!--end::Col-->
								</div>
								<!--end::Row-->
								<!--begin::Row-->
								<div class="row gx-10 mb-5">
									<div class="col-lg-6">
										<label class="form-label fs-6 fw-bold text-gray-700 mb-3">Salinan Keputusan Pengajian&nbsp;<a href="/assets/contoh/bank.pdf" target="_blank" data-bs-toggle="tooltip" title="CONTOH NYA MACAM NI"><i class="fa-solid fa-circle-info"></i></a></label>
										<div class="mb-5">
											<input type="file" id="kepPeperiksaan" name="kepPeperiksaan[]"/>
										</div>
									</div>
									<div class="col-lg-6">
										<label class="form-label fs-6 fw-bold text-gray-700 mb-3">CGPA</label>
										<div class="mb-5">
											<input type="text" name="cgpa" class="form-control form-control-solid"  placeholder="" />
										</div>
									</div>
								</div>
								<!--end::Row-->
								<!--begin::Action-->
								<div class="d-flex flex-center mt-15">
									<button type="submit"  class="btn btn-primary">
										Simpan
									</button>
								</div>
								<!--end::Action-->
							</div>
							<!--end::Wrapper-->
						</form>
						<!--end::Form-->
					</div>
					<!--end::Card body-->
				</div>
				<!--end::Card-->
			</div>
			<!--end::Content-->
			<!--begin::Sidebar-->
			<div class="flex-lg-auto min-w-lg-450px">
				<!--begin::Card-->
				<div class="card" data-kt-sticky="true" data-kt-sticky-name="invoice" data-kt-sticky-offset="{default: false, lg: '200px'}" data-kt-sticky-width="{lg: '250px', lg: '300px'}" data-kt-sticky-left="auto" data-kt-sticky-top="150px" data-kt-sticky-animation="false" data-kt-sticky-zindex="95">
					<!--begin::Card body-->
					<div class="card-body p-10">
						<!--begin::Input group-->
						<div class="mb-10">
							<!--begin::Label-->
							<label class="fs-3 fw-bold text-gray-800">Keputusan Peperiksaan</label>
							<br>
							<br>
							<div class="table-responsive">
								<table id="sortTable" class="table table-striped table-hover dataTable js-exportable">
									<thead>
										<tr class="fw-semibold fs-6 text-gray-800 border-bottom border-gray-200">
											<th>Sesi</th>
											<th>Semester</th>
											<th>Keputusan (CGPA)</th>
											<th>Salinan</th>
										</tr>
									</thead>
									<tbody class="fw-semibold text-gray-600">
										@foreach ($peperiksaan as $peperiksaan)
										<tr>
											<td>{{ $peperiksaan->sesi}}</td>
											<td>{{ $peperiksaan->semester}}</td>
											<td>{{ $peperiksaan->cgpa}}</td>
											<td><a href="/assets/dokumen/peperiksaan/{{$peperiksaan->kepPeperiksaan}}" target="_blank">Papar</a></td>
										</tr>
										@endforeach	
									</tbody>
								</table>
							</div>
						</div>
					</div>
					<!--end::Card body-->
				</div>
				<!--end::Card-->
			</div>
			<!--end::Sidebar-->
		</div>
		<!--end::Layout-->
	</div>
	<!--end::Content container-->
</div>
<!--end::Content-->
						
		
<!--begin::Javascript-->
<!--end::Javascript-->


</x-default-layout> 
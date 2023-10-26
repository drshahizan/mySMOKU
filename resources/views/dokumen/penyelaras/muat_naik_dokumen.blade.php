<x-default-layout> 

<head>
	<!-- MAIN CSS -->
	<link rel="stylesheet" href="/assets/css/saringan.css">
	<script src="https://cdn.tiny.cloud/1/v736541al0ntzh14edk63z19dzyqs1xn2bkc5em78rv1yeis/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
	<script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js"></script>
	<link href="assets/css/style.bundle.css" rel="stylesheet" type="text/css" />
</head>

<!--begin::Content-->
<div id="kt_app_content" class="app-content flex-column-fluid">
	<!--begin::Content container-->
	<div id="kt_app_content_container" class="app-container container-xxl"  style="width:80%">
		<!--begin::Layout-->
		<div class="d-flex flex-column flex-lg-row">
			<!--begin::Content-->
			<div class="flex-lg-row-fluid mb-10 mb-lg-0 me-lg-7 me-xl-10">
				<!--begin::Card-->
				<div class="card">
					<!--begin::Card body-->
					<div class="card-body p-12">
						<!--begin::Wrapper-->
						<div class="d-flex flex-column align-items-start flex-xl-row">
							<!--begin::Input group-->
							<div class="d-flex flex-center flex-equal fw-row text-nowrap order-1 order-xl-2 me-4" data-bs-toggle="tooltip" data-bs-trigger="hover">
								<span class="fs-3 fw-bold text-gray-800">Borang Salur Peruntukan Program BKOKU</span>
							</div>
						</div>
						<!--end::Top-->
					</div>
					<!--end::Card header-->

					@if(session('success'))
						<div class="alert alert-success" style="width: 90%; margin: 0 auto;">
							{{ session('success') }}
						</div>
						<br>
					@endif

					@if ($errors->any())
						<div class="alert alert-danger" style="width: 90%; margin: 0 auto;">
							@foreach ($errors->all() as $error)
								<li>{{ $error }}</li>
							@endforeach
						</div>
						<br><br>
					@endif

					<!--begin::Card body-->
					<div class="card-body pt-0">
						@foreach ($dokumen as $item)
						<form class="form" action="{{ route('penyelaras.hantar.dokumen', ['id' => $item->id ]) }}" method="post" enctype="multipart/form-data">
							@csrf
							<!--begin::Table-->
							<table class="table table-row-dashed fs-6 gy-5">
								<thead>
									<tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0">
										<th class="text-center" style="width: 15%">Item</th>
										<th class="text-center" style="width: 25%">Muat Turun Borang</th>
										<th class="text-center" style="width: 60%">Muat Naik Borang</th>
									</tr>
								</thead>
								<tbody class="fw-semibold text-gray-600" >
									<tr>
										<td class="text-gray-800 text-center">SPBB 1&nbsp;<a href="/assets/contoh/bank.pdf" target="_blank" data-bs-toggle="tooltip" title="CONTOH"><i class="fa-solid fa-circle-info"></i></a></td>
										<td class="text-center">
											<a href="{{ asset('assets/dokumen/esp/dokumen1/' . $item->dokumen1) }}" target="_blank" class="btn btn-secondary btn-sm">
												Lihat
												<i class='fas fa-eye' style='font-size:10px; padding-left:20px;'></i>
											</a>
										</td>
										<td class="fv-row">
											<input type="file" class="form-control form-control-sm" name="dokumen1"/>
										</td>
									</tr>

									<tr>
										<td class="text-gray-800 text-center">SPBB 2&nbsp;<a href="/assets/contoh/bank.pdf" target="_blank" data-bs-toggle="tooltip" title="CONTOH"><i class="fa-solid fa-circle-info"></i></a></td>
										<td class="text-center">
											<a href="{{ asset('assets/dokumen/esp/dokumen2/' . $item->dokumen2) }}" target="_blank" class="btn btn-secondary btn-sm">
												Lihat
												<i class='fas fa-eye' style='font-size:10px; padding-left:20px;'></i>
											</a>
										</td>
										<td class="fv-row">
											<input type="file" class="form-control form-control-sm" name="dokumen2"/>
										</td>
									</tr>

									<tr>
										<td class="text-gray-800 text-center">SPBB 3&nbsp;<a href="/assets/contoh/bank.pdf" target="_blank" data-bs-toggle="tooltip" title="CONTOH"><i class="fa-solid fa-circle-info"></i></a></td>
										<td class="text-center">
											<a href="{{ asset('assets/dokumen/esp/dokumen3/' . $item->dokumen3) }}" target="_blank" class="btn btn-secondary btn-sm">
												Lihat
												<i class='fas fa-eye' style='font-size:10px; padding-left:20px;'></i>
											</a>
										</td>
										<td class="fv-row">
											<input type="file" class="form-control form-control-sm" name="dokumen3"/>
										</td>
									</tr>

									<tr>
										<td colspan="3">
											<div class="text-dark fw-semibold fs-6"><i class='fas fa-exclamation-triangle' style='color:orange; font-size:15px;'></i>&nbsp;
												Gunakan kemudahan <a href="https://compressjpeg.com/" target="_blank">di sini</a> untuk mengurangkan saiz fail sebelum memuat naik fail.</a>
											</div>
						
											<div class="text-dark fw-semibold fs-6"><i class='fas fa-info-circle' style='color:gray; font-size:15px;'></i>&nbsp; 
												Format fail yang boleh dimuat naik adalah format '.pdf', '.xls', '.xlsx'.
											</div>
						
											<div class="text-dark fw-semibold fs-6"><i class='fas fa-info-circle' style='color:gray; font-size:15px;'></i>&nbsp; 
												Saiz maksimum fail adalah 2 MB.
											</div>
										</td>
									</tr>
								</tbody>
							</table>
							<!--end::Table-->
						
							<br>
						
							<div class="modal-footer flex-center">
								<button type="submit" id="kt_modal_add_customer_submit" class="btn btn-primary">
									<span class="indicator-label">Hantar</span>
									<span class="indicator-progress">Sila tunggu...
										<span class="spinner-border spinner-border-sm align-middle ms-2"></span>
									</span>
								</button>
							</div>
						</form>
						@endforeach
					</div>
					<!--end::Card body-->
				</div>
				<!--end::Card-->	
			</div>
		</div>
	</div>
	<!--end::Content container-->
</div>
<!--end::Content-->
</x-default-layout>
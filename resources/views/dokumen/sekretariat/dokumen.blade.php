<x-default-layout> 

<head>
<!-- MAIN CSS -->
	<link rel="stylesheet" href="/assets/css/sekretariat.css">
	<script src="https://cdn.tiny.cloud/1/v736541al0ntzh14edk63z19dzyqs1xn2bkc5em78rv1yeis/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
	<script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js"></script>
	<link href="assets/css/style.bundle.css" rel="stylesheet" type="text/css" />
</head>
<!--begin::Page title-->
<div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
	<!--begin::Title-->
	<h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Muat Naik</h1>
	<!--end::Title-->
	<!--begin::Breadcrumb-->
	<ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
		<!--begin::Item-->
		<li class="breadcrumb-item text-dark" style="color:darkblue">Muat Naik</li>
		<!--end::Item-->
		<!--begin::Item-->
		<li class="breadcrumb-item">
			<span class="bullet bg-gray-400 w-5px h-2px"></span>
		</li>
		<!--end::Item-->
		<!--begin::Item-->
		<li class="breadcrumb-item text-dark" style="color:darkblue">Dokumen ESP</li>
		<!--end::Item-->
	</ul>
<!--end::Breadcrumb-->
</div>
<br>

<!--begin::Content-->
<div id="kt_app_content" class="app-content flex-column-fluid">
	<!--begin::Content container-->
	<div id="kt_app_content_container" class="app-container container-xl" style="width:80%">
		<!--begin::Layout-->
		<div class="d-flex flex-column flex-lg-row">
			<!--begin::Content-->
			<div class="flex-lg-row-fluid mb-10 mb-lg-0 me-lg-7 me-xl-10">
				<!--begin::Card-->
				<div class="card">
					<!--begin::Card body-->
					<div class="card-body p-12">
						<!--begin::Form-->
						<form action="#" method="post" enctype="multipart/form-data">
							@csrf
							<!--begin::Wrapper-->
							<div class="d-flex flex-column align-items-start flex-xl-row">
								<!--begin::Input group-->
								<div class="d-flex flex-center flex-equal fw-row text-nowrap order-1 order-xl-2 me-4" data-bs-toggle="tooltip" data-bs-trigger="hover">
									<span class="fs-3 fw-bold text-gray-800">Muat Naik Dokumen ESP</span>
								</div>
							</div>
							<!--end::Top-->
						
							<br>
						
							<table class="table table-bordered table-striped">
								<thead>
									<tr>
										<th>Item</th>
										<th>Dokumen</th>
									</tr>
								</thead>

								<tbody>
									{{-- DOKUMEN 1 --}}
									<tr>
										<td>Dokumen 1&nbsp;<a href="/assets/contoh/surat_tamat_pengajian__transkrip_akademik.pdf" target="_blank" data-bs-toggle="tooltip" title="contoh"><i class="fa-solid fa-circle-info"></i></a></td>
										<td>
											<input type="file" id="sijilTamat" name="sijilTamat[]" required/>
											{{-- @if(session()->has('uploadedSijilTamat'))
												@foreach(session('uploadedSijilTamat') as $sijil)
													<a href="{{ asset('assets/dokumen/sijil_tamat/' . $sijil) }}" target="_blank">{{ $sijil }}</a>
												@endforeach
											@endif --}}
										</td>
									</tr>
						
									{{-- DOKUMEN 2 --}}
									<tr>
										<td>Dokumen 2&nbsp;<a href="/assets/contoh/surat_tamat_pengajian__transkrip_akademik.pdf" target="_blank" data-bs-toggle="tooltip" title="contoh"><i class="fa-solid fa-circle-info"></i></a></td>
										<td>
											<input type="file" id="transkrip" name="transkrip[]" required/>
											{{-- @if(session()->has('uploadedTranskrip'))
												@foreach(session('uploadedTranskrip') as $transkrip)
													<a href="{{ asset('assets/dokumen/salinan_transkrip/' . $transkrip) }}" target="_blank">{{ $transkrip }}</a>
												@endforeach
											@endif --}}
										</td>
									</tr>

									{{-- DOKUMEN 3 --}}
									<tr>
										<td>Dokumen 3&nbsp;<a href="/assets/contoh/surat_tamat_pengajian__transkrip_akademik.pdf" target="_blank" data-bs-toggle="tooltip" title="contoh"><i class="fa-solid fa-circle-info"></i></a></td>
										<td>
											<input type="file" id="transkrip" name="transkrip[]" required/>
											{{-- @if(session()->has('uploadedTranskrip'))
												@foreach(session('uploadedTranskrip') as $transkrip)
													<a href="{{ asset('assets/dokumen/salinan_transkrip/' . $transkrip) }}" target="_blank">{{ $transkrip }}</a>
												@endforeach
											@endif --}}
										</td>
									</tr>
						
									<tr>
										<td colspan="2">
											<div class="text-dark fw-semibold fs-6"><i class='fas fa-exclamation-triangle' style='color:orange; font-size:15px;'></i>&nbsp;
												Gunakan kemudahan <a href="https://compressjpeg.com/" target="_blank">di sini</a> untuk mengurangkan saiz fail sebelum memuat naik fail.</a>
											</div>
						
											<div class="text-dark fw-semibold fs-6"><i class='fas fa-info-circle' style='color:gray; font-size:15px;'></i>&nbsp; 
												Format fail yang boleh dimuat naik adalah format '.pdf', '.jpg', '.png', dan '.jpeg'.
											</div>
						
											<div class="text-dark fw-semibold fs-6"><i class='fas fa-info-circle' style='color:gray; font-size:15px;'></i>&nbsp; 
												Saiz maksimum fail adalah 2 MB.
											</div>
										</td>
									</tr>
								</tbody>
							</table>
						
							<div class="modal-footer flex-center">
								<button type="submit" id="kt_modal_add_customer_submit" class="btn btn-primary">
									<span class="indicator-label">Hantar</span>
									<span class="indicator-progress">Sila tunggu...
										<span class="spinner-border spinner-border-sm align-middle ms-2"></span>
									</span>
								</button>
							</div>
						</form>							
						<!--end::Form-->
					</div>
					<!--end::Card body-->
				</div>
				<!--end::Card-->
			</div>
			<!--end::Content-->
		</div>
		<!--end::Layout-->
	</div>
	<!--end::Content container-->
</div>
<!--end::Content-->

</x-default-layout>
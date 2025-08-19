<x-default-layout> 

<head>
	<!-- MAIN CSS -->
	<script src="https://cdn.tiny.cloud/1/v736541al0ntzh14edk63z19dzyqs1xn2bkc5em78rv1yeis/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
	<script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js"></script>
	<link href="assets/css/style.bundle.css" rel="stylesheet" type="text/css" />

	<style>
		th{
			padding-top: 12px!important;
			padding-bottom: 12px!important;
			background-color: #3d0066!important;
			color: white!important;
		}

		.maklumat{
			width: 100%!important;
			border: none!important;
		}
		.w-13{
			width: 22% !important;
		}
		.w-3{
			width: 3% !important;
		}
		.maklumat td{
			padding: 5px!important;
			border: none!important;
		}
		.white{
			color: white!important;
		}

		.vertical-top{
			vertical-align: top!important;
		}

		.file-input {
			display: flex; 
			align-items: center;
		}
	</style>
</head>

<body>
	<!--begin::Page title-->
	<div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
		<!--begin::Title-->
		<h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Salur</h1>
		<!--end::Title-->
		<!--begin::Breadcrumb-->
		<ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
			<!--begin::Item-->
			<li class="breadcrumb-item text-dark" style="color:darkblue">Kemaskini</li>
			<!--end::Item-->
			<!--begin::Item-->
			<li class="breadcrumb-item">
				<span class="bullet bg-gray-400 w-5px h-2px"></span>
			</li>
			<!--end::Item-->
			<!--begin::Item-->
			<li class="breadcrumb-item text-dark" style="color:darkblue">Maklumat Lejar</li>
			<!--end::Item-->
		</ul>
	<!--end::Breadcrumb-->
	</div>

	<br>

	<!-- Main body part  -->
	<!--begin::Content-->
	<div id="kt_app_content" class="app-content flex-column-fluid">
		<!--begin::Content container-->
		<div id="kt_app_content_container" class="app-container container-xl">
			<!--begin::Layout-->
			<div class="d-flex flex-column flex-lg-row">
				<!--begin::Content-->
				<div class="flex-lg-row-fluid mb-10 mb-lg-0 me-lg-7 me-xl-10">
					<!--begin::Card-->
					<div class="card">
						<!--begin::Card body 1-->
						<div class="card-body pt-10 p-20">
							{{-- Header --}}
							<div class="d-flex flex-column align-items-start flex-xl-row mb-10">
								<div class="d-flex flex-center flex-equal fw-row text-nowrap order-1 order-xl-2 me-4"
									data-bs-toggle="tooltip" data-bs-trigger="hover">
									<span class="fs-3 fw-bold text-gray-800">Muat Turun & Muat Naik Maklumat Lejar</span>
								</div>
							</div>

							{{-- Table --}}
							<table class="table table-bordered table-striped pt-0">
								<thead>
									<tr>
										<th>Lejar</th>
										<th>Muat Turun</th>
										<th>Muat Naik</th>
									</tr>
								</thead>

								@php
									$nama_uni = DB::table('bk_info_institusi')->where('id_institusi', $institusiId)->value('nama_institusi');
								@endphp

								<tbody>
									{{-- NAMA INSTITUSI --}}
									<tr>
										<td>Nama Institusi Pengajian</td>
										<td colspan="2" class="text-center">
											<input type="text" class="form-control d-inline-block" id="nama_institusi" name="nama_institusi" value="{{$nama_uni}}" readonly style="max-width: 400px; text-align: center;">
										</td>
									</tr>

									{{--  Lejar Baharu (Permohonan) --}}
									<tr>
										<td>Lejar Baharu (Permohonan)</td>
										<td>
											<div id="file-input-container">
												<div class="d-flex">
													<div class="file-input">
														<a href="{{ route('penyelaras.permohonan.senarai.layak.excel') }}" class="btn btn-info btn-sm" style="width: 100%; margin: 0 auto;">
															Muat Turun<i class='fas fa-download' style='color:white; padding-left:20px;'></i>
														</a>
													</div>
												</div>
											</div>                                                                                     
										</td>

										<td>
											<div id="file-input-container">
												<div class="d-flex">
													<div class="file-input">
														<form id="uploadForm1" action="{{ route('modified.file.pembayaran.permohonan') }}" method="POST" enctype="multipart/form-data">
                                                            @csrf
                                                            <input type="file" name="modified_excel_file1" accept=".xlsx, .xls" style="display: none" onchange="fileSelected1(event)">
                                                            <input type="hidden" name="form_submitted1" id="formSubmitted1" value="0">
                                                            <button type="button" class="btn btn-primary btn-lg" style="width: 100%; margin: 0 auto;" onclick="uploadFilePermohonan()"> 
                                                                Muat Naik<i class='fas fa-upload' style='color:white; padding-left:20px;'></i>
                                                            </button>
                                                        </form>
													</div>
												</div>
											</div>
										</td>

									</tr>

									{{--  Lejar Sedia Ada (Tuntutan) --}}
									<tr>
										<td> Lejar Sedia Ada (Tuntutan)</td>
										<td>
											<div id="file-input-container">
												<div class="d-flex">
													<div class="file-input">
														<a href="{{ route('penyelaras.tuntutan.senarai.layak.excel') }}" class="btn btn-info btn-sm" style="width: 100%; margin: 0 auto;">
															Muat Turun<i class='fas fa-download' style='color:white; padding-left:20px;'></i>
														</a>
													</div>
												</div>
											</div>                                                                                     
										</td>
										<td>
											<div id="file-input-container">
												<div class="d-flex">
													<div class="file-input">
														<form id="uploadForm2" action="{{ route('modified.file.pembayaran.tuntutan') }}" method="POST" enctype="multipart/form-data">
                                                            @csrf
                                                            <input type="file" name="modified_excel_file2" accept=".xlsx, .xls" style="display: none" onchange="fileSelected2(event)">
                                                            <input type="hidden" name="form_submitted2" id="formSubmitted2" value="0">
															 <button type="button" class="btn btn-primary btn-lg" style="width: 100%; margin: 0 auto;" onclick="uploadFileTuntutan()"> 
                                                                Muat Naik<i class='fas fa-upload' style='color:white; padding-left:20px;'></i>
                                                            </button>
                                                        </form>
													</div>
												</div>
											</div>
										</td>
									</tr>

									<tr>
										<td colspan="3">
											<div class="text-dark fw-semibold fs-6">
												<i class='fas fa-info-circle' style='color:blue; font-size:15px;'></i>&nbsp;
												Sila klik pada butang Muat Turun untuk memuat turun Maklumat Lejar.
											</div>
 											<div class="text-dark fw-semibold fs-6">
												<i class='fas fa-info-circle' style='color:blue; font-size:15px;'></i>&nbsp;
												Sila klik pada butang Muat Naik untuk memuat naik Maklumat Lejar.
											</div>
										</td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<script>
		//permohonan
		function uploadFilePermohonan() {
			// Trigger the click event of the hidden file input
			document.querySelector('input[name="modified_excel_file1"]').click();
		}

		function fileSelected1(event) {
			// Set the hidden input value to 1 when a file is selected
			document.getElementById('formSubmitted1').value = 1;
			// Submit the form
			document.getElementById('uploadForm1').submit();
		}

		//tuntutan
		function uploadFileTuntutan() {
			// Trigger the click event of the hidden file input
			document.querySelector('input[name="modified_excel_file2"]').click();
		}

		function fileSelected2(event) {
			// Set the hidden input value to 1 when a file is selected
			document.getElementById('formSubmitted2').value = 1;
			// Submit the form
			document.getElementById('uploadForm2').submit();
		}

		// Display SweetAlert for success and error messages after file import
		@if(session('success'))
			Swal.fire({
				icon: 'success',
				title: 'Berjaya!',
				text: '{!! session('success') !!}',
				confirmButtonText: 'OK'
			});
		@endif

		@if(session('failed'))
			Swal.fire({
				icon: 'error',
				title: 'Tidak Berjaya!',
				text: '{!! session('failed') !!}',
				confirmButtonText: 'OK'
			});
		@endif
	</script>
</body>
	
</x-default-layout>
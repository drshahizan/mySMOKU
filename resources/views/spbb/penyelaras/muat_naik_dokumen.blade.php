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

	<!--begin::Breadcrumb-->
	<div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
		<!--begin::Title-->
		<h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Penyaluran</h1>
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
			<li class="breadcrumb-item text-dark" style="color:darkblue">Borang SPBB</li>
			<!--end::Item-->
		</ul>
	<!--end::Breadcrumb-->
	</div>

	<br>

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
						<div class="card-body pt-10 p-15">
							<form action="{{ route('penyelaras.kemaskini.SPBB') }}" method="post" enctype="multipart/form-data">
								@csrf
								<div class="d-flex flex-column align-items-start flex-xl-row">
									<div class="d-flex flex-center flex-equal fw-row text-nowrap order-1 order-xl-2 me-4"
										data-bs-toggle="tooltip" data-bs-trigger="hover">
										<span class="fs-3 fw-bold text-gray-800">Muat Naik Borang Salur Peruntukan Bantuan BKOKU</span>
									</div>
								</div>
								<br>

								@if(session('success'))
									<div class="alert alert-success text-center" style="width: 80%; margin: 0 auto;">
										{{ session('success') }}
									</div>
									<br>
								@endif

								@if ($errors->any())
									<div class="alert alert-danger text-center" style="width: 80%; margin: 0 auto;">
										@foreach ($errors->all() as $error)
											<li>{{ $error }}</li>
										@endforeach
									</div>
									<br><br>
								@endif

								<table class="table table-bordered table-striped">
									<thead>
										<tr>
											<th style="width: 40%">Item</th>
											<th style="width: 60%">Muat Naik</th>
										</tr>
									</thead>

									@php
										$nama_uni = DB::table('bk_info_institusi')->where('id_institusi', $institusiId)->value('nama_institusi');
									@endphp

									<tbody>
										{{-- NAMA INSTITUSI --}}
										<tr>
											<td>Nama Institusi Pengajian</td>
											<td>
												<input type="text" class="form-control" id="nama_institusi" name="nama_institusi" value="{{$nama_uni}}" readonly>												
											</td>
										</tr>

										{{-- DOKUMEN SPBB 1a --}}
										<tr>
											<td>Borang SPBB 1a (Permohonan Berstatus Layak)</td>
											<td>
												<div id="file-input-container">
													<!-- File input fields for SPPB1a -->
													<div class="d-flex">
														<div class="file-input">
															<input type="file" name="dokumen1a[]"/>
															@if ($dokumen->isNotEmpty() && !empty($dokumen->first()->dokumen1a))
																<a href="{{ asset('assets/dokumen/sppb_1a/' . $dokumen->first()->dokumen1a) }}" target="_blank">{{ $dokumen->first()->dokumen1a }}</a>
															@endif
														</div>
													</div>
												</div>                                                                                     
											</td>
										</tr>

										{{-- DOKUMEN SPBB 1 --}}
										<tr>
											<td>Borang SPBB 1 (Tuntutan Berstatus Layak)</td>
											<td>
												<div id="file-input-container">
													<!-- File input fields for SPPB1 -->
													<div class="d-flex">
														<div class="file-input">
															<input type="file" name="dokumen1[]"/>
															@if ($dokumen->isNotEmpty() && !empty($dokumen->first()->dokumen1))
																<a href="{{ asset('assets/dokumen/sppb_1/' . $dokumen->first()->dokumen1) }}" target="_blank">{{ $dokumen->first()->dokumen1 }}</a>
															@endif
														</div>
													</div>
												</div>                                                                                     
											</td>
										</tr>

										{{-- DOKUMEN SPBB 2 --}}
										<tr>
											<td>Borang SPBB 2 (Laporan Bayaran)</td>
											<td>
												<div id="file-input-container">
													<!-- File input fields for SPPB2 -->
													<div class="d-flex">
														<div class="file-input">
															<input type="file" name="dokumen2[]"/>
															@if ($dokumen->isNotEmpty() && !empty($dokumen->first()->dokumen2))
																<a href="{{ asset('assets/dokumen/sppb_2/' . $dokumen->first()->dokumen2) }}" target="_blank">{{ $dokumen->first()->dokumen2 }}</a>
															@endif
														</div>
													</div>
												</div>																						
											</td>
										</tr>

										{{-- DOKUMEN SPBB 2a --}}
										<tr>
											<td>Borang SPBB 2a (Laporan Tuntutan)</td>
											<td>
												<div id="file-input-container">
													<!-- File input fields for SPPB2a -->
													<div class="d-flex">
														<div class="file-input">
															<input type="file" name="dokumen2a[]"/>
															@if ($dokumen->isNotEmpty() && !empty($dokumen->first()->dokumen2a))
																<a href="{{ asset('assets/dokumen/sppb_2a/' . $dokumen->first()->dokumen2a) }}" target="_blank">{{ $dokumen->first()->dokumen2a }}</a>
															@endif
														</div>
													</div>
												</div>																						
											</td>
										</tr>

										{{-- DOKUMEN SPBB 3 --}}
										<tr>
											<td>Borang SPBB 3 (Penyata Terimaan)</td>
											<td>
												<div id="file-input-container">
													<!-- File input fields for SPPB3 -->
													<div class="d-flex">
														<div class="file-input">
															<input type="file" name="dokumen3[]"/>
															@if ($dokumen->isNotEmpty() && !empty($dokumen->first()->dokumen3))
																<a href="{{ asset('assets/dokumen/sppb_3/' . $dokumen->first()->dokumen3) }}" target="_blank">{{ $dokumen->first()->dokumen3 }}</a>
															@endif
														</div>
													</div>
												</div>																						
											</td>
										</tr>

										{{-- DOKUMEN SPBB 4 --}}
										<tr>
											<td>Borang SPBB 4 (Surat Iringan Universiti)</td>
											<td>
												<div id="file-input-container">
													<!-- File input fields for SPPB3 -->
													<div class="d-flex">
														<div class="file-input">
															<input type="file" name="dokumen4[]"/>
															@if ($dokumen->isNotEmpty() && !empty($dokumen->first()->dokumen4))
																<a href="{{ asset('assets/dokumen/sppb_4/' . $dokumen->first()->dokumen4) }}" target="_blank">{{ $dokumen->first()->dokumen4 }}</a>
															@endif
														</div>
													</div>
												</div>																						
											</td>
										</tr>
										
										{{-- Nota --}}
										<tr>
											<td colspan="2">
												<div class="text-dark fw-semibold fs-6"><i class='fas fa-exclamation-triangle' style='color:orange; font-size:15px;'></i>&nbsp;
													Gunakan kemudahan <a href="https://compressjpeg.com/" target="_blank">di sini</a>
													untuk mengurangkan saiz fail sebelum memuat naik fail.</a>
												</div>

												<div class="text-dark fw-semibold fs-6"><i class='fas fa-info-circle' style='color:gray; font-size:15px;'></i>&nbsp;
													Format fail yang boleh dimuat naik adalah format '.pdf', '.xls', '.xlsx'.
												</div>

												<div class="text-dark fw-semibold fs-6"><i class='fas fa-info-circle' style='color:gray; font-size:15px;'></i>&nbsp;
													Saiz maksimum fail adalah 2 MB / 2048 KB.
												</div>
											</td>
										</tr>
									</tbody>
								</table>

								<div class="modal-footer mt-3">
									<button type="submit" id="kt_modal_add_customer_submit" class="btn btn-primary" style="margin: 0 auto;">
										<span class="indicator-label">Hantar</span>
									</button>
								</div>
							</form>
						</div>
						<!--end::Card body 1-->
					</div>
					<!--end::Card-->
				</div>
			</div>
		</div>
	</div>
	<!--end::Content-->
						
	<script>
		document.addEventListener("DOMContentLoaded", function () {
			const fileInputContainer = document.getElementById("file-input-container");
			const addFileInputButton = document.getElementById("add-file-input");
	
			let fileInputIndex = 2; // Start with 2 for SPPB2
	
			addFileInputButton.addEventListener("click", function () {
				// Create a new file input container
				const newFileInputContainer = document.createElement("div");
				newFileInputContainer.classList.add("file-input");
	
				// Create a new file input field
				const newInput = document.createElement("input");
				newInput.type = "file";
				newInput.name = `dokumen${fileInputIndex}[]`;
				newInput.required = true;
				newInput.multiple = true;
	
				// Append the new file input to the container
				newFileInputContainer.appendChild(newInput);
	
				// Append the new container to the file input container
				fileInputContainer.appendChild(newFileInputContainer);
	
				fileInputIndex++;
			});
		});
	</script>
	
	<script>
		$(document).ready(function () {
			$('#institusi_id').on('change', function () {
				var selectedInstitusiId = $(this).val();
				var formAction = "{{ route('sekretariat.hantar.SPBB') }}";
				formAction = formAction.replace('selectedInstitusiId', selectedInstitusiId);
				$('#sppbForm').attr('action', formAction);
			});
		});
	</script>
</x-default-layout>
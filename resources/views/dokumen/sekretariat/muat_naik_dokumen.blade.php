<x-default-layout> 
	<head>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
		<script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
		<script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js"></script>
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10">

		<style>
			th{
				padding-top: 12px!important;
				padding-bottom: 12px!important;
				background-color: rgb(35, 58, 108)!important;
				color: white!important;
			}

			#file-input-container {
				display: flex;
				flex-direction: column;
				gap: 5px;
			}

			.file-input {
				display: flex;
			}

			.btn {
				margin-left: 300px;
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
			<li class="breadcrumb-item text-dark" style="color:darkblue">Dokumen ESP</li>
			<!--end::Item-->
		</ul>
	<!--end::Breadcrumb-->
	</div>

	<br>

	<!--begin::Content-->
	<div id="kt_app_content" class="app-content flex-column-fluid">
		<!--begin::Content container-->
		<div id="kt_app_content_container" class="app-container container-xl" style="width:90%">
			<!--begin::Layout-->
			<div class="d-flex flex-column flex-lg-row">
				<!--begin::Content-->
				<div class="flex-lg-row-fluid mb-10 mb-lg-0 me-lg-7 me-xl-10">
					<!--begin::Card-->
					<div class="card">
						<!--begin::Card body 1-->
						<div class="card-body pt-10 p-20">
							<!--begin::Form-->
							<form action="{{ route('sekretariat.hantar.SPPB') }}" method="post" enctype="multipart/form-data">
								@csrf
								<div class="d-flex flex-column align-items-start flex-xl-row">
									<div class="d-flex flex-center flex-equal fw-row text-nowrap order-1 order-xl-2 me-4"
										data-bs-toggle="tooltip" data-bs-trigger="hover">
										<span class="fs-3 fw-bold text-gray-800">Borang Salur Peruntukan Program BKOKU</span>
									</div>
								</div>
								<br>

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

								<table class="table table-bordered table-striped">
									<thead>
										<tr>
											<th style="width: 25%">Item</th>
											<th style="width: 75%">Pilih</th>
										</tr>
									</thead>

									<tbody>
										{{-- NAMA INSTITUSI --}}
										<tr>
											<td>Nama Institusi</td>
											<td>
												<select name="institusi_id" style="padding: 5px;">
													<option value="">Pilih Institusi Pengajian</option>
													@foreach ($institusiPengajian as $institusi)
														<option value="{{ $institusi->id_institusi }}" {{ old('institusi_id') == $institusi->id_institusi ? 'selected' : '' }}>
															{{ $institusi->nama_institusi }}
														</option>
													@endforeach
												</select>												
											</td>
										</tr>

										{{-- DOKUMEN SPPB --}}
										<tr>
											<td>Dokumen SPBB</td>
											<td>
												<div id="file-input-container">
													<!-- File input fields for SPPB1 -->
													<div class="d-flex">
														<div class="file-input">
															<input type="file" name="dokumen1[]" required multiple />
														</div>
														<button id="add-file-input" class="btn btn-warning btn-sm" style="font-size: 12px; padding: 4px 10px;">+</button>
													</div>
												</div>																						
											</td>
										</tr>
										
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
													Saiz maksimum fail adalah 2 MB.
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

						<!--begin::Card body 2-->
						<div class="card-body p-20 pt-0">
							<table id="sortTable1" class="table table-bordered table-striped">
								<thead>
									<tr>
										<th class="text-center" style="width: 5%">No</th>
										<th class="text-center" style="width: 70%">Institusi</th>
										<th class="text-center" style="width: 25%">Dokumen</th>
									</tr>
								</thead>
						
								<tbody>
									@php
									$i = 0;
									@endphp

									@foreach ($dokumen as $uni)
										@php
											$id = $uni->institusi_id;
											$nama_institusi = DB::table('bk_info_institusi')->where('id_institusi', $id)->value('nama_institusi');
										@endphp
										<tr>
											<td class="text-center" data-no="{{ $i++ }}">{{ $i }}</td>
											<td>{{ $nama_institusi }}</td>
											<td class="text-center">
												<a href="{{ asset('assets/dokumen/esp/dokumen1/' . $uni->dokumen) }}" class="btn btn-info btn-sm" style="width: 70%; margin: 0 auto;">
													Lihat <i class='fas fa-eye' style='color:white; padding-left:20px;'></i>
												</a>
											</td>
										</tr>
										@endforeach
								</tbody>
							</table>
						</div>
						<!--end::Card body 2-->
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
				var formAction = "{{ route('sekretariat.hantar.SPPB') }}";
				formAction = formAction.replace('selectedInstitusiId', selectedInstitusiId);
				$('#sppbForm').attr('action', formAction);
			});
		});
	</script>
</x-default-layout>
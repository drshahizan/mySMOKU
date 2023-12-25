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
			<li class="breadcrumb-item text-dark" style="color:darkblue">Borang SPBB</li>
			<!--end::Item-->
		</ul>
	<!--end::Breadcrumb-->
	</div>

	<br>

	<!--begin::Content-->
	<div id="kt_app_content" class="app-content flex-column-fluid">
		<!--begin::Content container-->
		<div id="kt_app_content_container" class="app-container container-xl" style="width:90%; margin: 0 auto;">
			<!--begin::Layout-->
			<div class="d-flex flex-column flex-lg-row">
				<!--begin::Content-->
				<div class="flex-lg-row-fluid mb-10 mb-lg-0 me-lg-7 me-xl-10">
					<!--begin::Card-->
					<div class="card">
						<!--begin::Card body 1-->
						<div class="card-body pt-10 p-15">
							<!--begin::Form-->
							<form action="{{ route('sekretariat.hantar.SPBB') }}" method="post" enctype="multipart/form-data">
								@csrf
								<div class="d-flex flex-column align-items-start flex-xl-row">
									<div class="d-flex flex-center flex-equal fw-row text-nowrap order-1 order-xl-2 me-4"
										data-bs-toggle="tooltip" data-bs-trigger="hover">
										<span class="fs-3 fw-bold text-gray-800">Borang Salur Peruntukan Program BKOKU</span>
									</div>
								</div>
								<br>

								@if(session('success'))
								<div class="alert alert-success" style="width: 100%; margin: 0 auto;">
									{{ session('success') }}
								</div>
								<br>
								@endif

								@if ($errors->any())
								<div class="alert alert-danger" style="width: 100%; margin: 0 auto;">
									@foreach ($errors->all() as $error)
									<li>{{ $error }}</li>
									@endforeach
								</div>
								<br><br>
								@endif

								<table class="table table-bordered table-striped">
									<thead>
										<tr>
											<th style="width: 50% !important;">Item</th>
											<th style="width: 50% !important;">Pilih</th>
										</tr>
									</thead>

									<tbody>
										{{-- NAMA INSTITUSI --}}
										<tr>
											<td style="width: 50% !important;">Nama Institusi Pengajian</td>
											<td>
												<select name="institusi_id" style="padding: 5px; width:100%;">
													<option value="">Pilih Institusi Pengajian</option>
													@foreach ($institusiPengajian as $institusi)
														<option value="{{ $institusi->id_institusi }}" {{ old('institusi_id') == $institusi->id_institusi ? 'selected' : '' }}>
															{{ $institusi->nama_institusi }}
														</option>
													@endforeach
												</select>												
											</td>
										</tr>

										{{-- DOKUMEN SPBB 1 --}}
										<tr>
											<td style="width: 50% !important;">Borang SPBB 1 (Permohonan Salur Pelajar Sedia Ada)</td>
											<td>
												<div id="file-input-container">
													<!-- File input fields for SPPB1 -->
													<div class="d-flex">
														<div class="file-input" style="width: 50% !important;">
															<input type="file" name="dokumen1[]"/>
														</div>
													</div>
												</div>																						
											</td>
										</tr>

										{{-- DOKUMEN SPBB 1a --}}
										<tr>
											<td style="width: 50% !important;">Borang SPBB 1a (Permohonan Salur Pelajar Baharu)</td>
											<td>
												<div id="file-input-container">
													<!-- File input fields for SPPB1a -->
													<div class="d-flex">
														<div class="file-input" style="width: 50% !important;">
															<input type="file" name="dokumen1a[]"/>
														</div>
													</div>
												</div>																						
											</td>
										</tr>

										{{-- DOKUMEN SPBB 2 --}}
										<tr>
											<td style="width: 50% !important;">Borang SPBB 2 (Laporan Bayaran)</td>
											<td>
												<div id="file-input-container">
													<!-- File input fields for SPPB2 -->
													<div class="d-flex">
														<div class="file-input" style="width: 50% !important;">
															<input type="file" name="dokumen2[]"/>
														</div>
													</div>
												</div>																						
											</td>
										</tr>

										{{-- DOKUMEN SPBB 2a --}}
										<tr>
											<td style="width: 50% !important;">Borang SPBB 2a (Laporan Tuntutan)</td>
											<td>
												<div id="file-input-container">
													<!-- File input fields for SPPB2a -->
													<div class="d-flex">
														<div class="file-input" style="width: 50% !important;">
															<input type="file" name="dokumen2a[]"/>
														</div>
													</div>
												</div>																						
											</td>
										</tr>

										{{-- DOKUMEN SPBB 3 --}}
										<tr>
											<td style="width: 50% !important;">Borang SPBB 3 (Penyata Terimaan)</td>
											<td>
												<div id="file-input-container">
													<!-- File input fields for SPPB3 -->
													<div class="d-flex">
														<div class="file-input" style="width: 50% !important;">
															<input type="file" name="dokumen3[]"/>
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
									<button type="submit" id="kt_modal_add_customer_submit" class="btn btn-primary btn-sm" style="margin: 0 auto;">
										<span class="indicator-label">Hantar</span>
									</button>
								</div>
							</form>
							<!--end::Form-->
						</div>
						<!--end::Card body 1-->

						<!--begin::Card body 2-->
						<div class="card-body p-15 pt-0">
							<table id="sortTable1" class="table table-bordered table-striped">
								<thead>
									<tr>
										<th class="text-center" style="width: 5%">No</th>
										<th class="text-center" style="width: 70%">Institusi Pengajian</th>
										<th class="text-center" style="width: 25%">Borang SPBB</th>
									</tr>
								</thead>
								<tbody>
									@php
										$i = 0;
									@endphp
						
									@foreach ($dokumen as $doc)
										@php
											$id = $doc->institusi_id;
											$nama_institusi = DB::table('bk_info_institusi')->where('id_institusi', $id)->value('nama_institusi');
										@endphp
						
										@if (str_ends_with($doc->no_rujukan, '/1'))
											<tr>
												<td class="text-center" data-no="{{ $i++ }}">{{ $i }}</td>
												<td>{{ $nama_institusi }}</td>
												<td class="text-center">
													<a href="{{ url('penyaluran/sekretariat/lihat/salinan-dokumen/SPBB/'.$id) }}" class="btn btn-info btn-sm" style="width: 70%; margin: 0 auto;">
														Lihat <i class='fas fa-eye' style='color:white; padding-left:20px;'></i>
													</a>
												</td>
											</tr>
										@endif
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
				var formAction = "{{ route('sekretariat.hantar.SPBB') }}";
				formAction = formAction.replace('selectedInstitusiId', selectedInstitusiId);
				$('#sppbForm').attr('action', formAction);
			});
		});
	</script>
</x-default-layout>
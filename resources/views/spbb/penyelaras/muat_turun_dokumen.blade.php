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
		<h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Penyaluran</h1>
		<!--end::Title-->
		<!--begin::Breadcrumb-->
		<ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
			<!--begin::Item-->
			<li class="breadcrumb-item text-dark" style="color:darkblue">Muat Turun</li>
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
									<span class="fs-3 fw-bold text-gray-800">Muat Turun Borang Salur Peruntukan Bantuan BKOKU</span>
								</div>
							</div>

							{{-- Table --}}
							<table class="table table-bordered table-striped pt-0">
								<thead>
									<tr>
										<th style="width: 45%">Item</th>
										<th style="width: 55%">Muat Turun</th>
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
									{{-- <tr>
										<td>Borang SPBB 1a (Permohonan Berstatus Layak)</td>
										<td>
											<div id="file-input-container">
												<div class="d-flex">
													<div class="file-input">
														<a href="{{ route('penyelaras.dokumen.SPBB1a') }}" class="btn btn-info btn-sm" style="width: 100%; margin: 0 auto;">
															Muat Turun SPBB 1a<i class='fas fa-download' style='color:white; padding-left:20px;'></i>
														</a>
													</div>
												</div>
											</div>                                                                                     
										</td>
									</tr> --}}

									{{-- DOKUMEN SPBB 1 --}}
									{{-- <tr>
										<td>Borang SPBB 1 (Tuntutan Berstatus Layak)</td>
										<td>
											<div id="file-input-container">
												<div class="d-flex">
													<div class="file-input">
														<a href="{{ route('penyelaras.dokumen.SPBB1') }}" class="btn btn-info btn-sm" style="width: 100%; margin: 0 auto;">
															Muat Turun SPBB 1<i class='fas fa-download' style='color:white; padding-left:20px;'></i>
														</a>
													</div>
												</div>
											</div>                                                                                     
										</td>
									</tr> --}}

									{{-- DOKUMEN SPBB 2 --}}
									<tr>
										<td>Borang SPBB 2 (Laporan Bayaran)</td>
										<td>
											<div id="file-input-container">
												<div class="d-flex">
													<div class="file-input">
														<a href="{{ route('penyelaras.dokumen.SPBB2') }}" class="btn btn-info btn-sm" style="width: 100%; margin: 0 auto;">
															Muat Turun SPBB 2<i class='fas fa-download' style='color:white; padding-left:20px;'></i>
														</a>
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
												<div class="d-flex">
													<div class="file-input">
														<a href="{{ route('penyelaras.dokumen.SPBB3') }}" class="btn btn-info btn-sm" style="width: 100%; margin: 0 auto;">
															Muat Turun SPBB 3<i class='fas fa-download' style='color:white; padding-left:20px;'></i>
														</a>
													</div>
												</div>
											</div>                                                                                     
										</td>
									</tr>

									<tr>
										<td colspan="2">
											<div class="text-dark fw-semibold fs-6"><i class='fas fa-info-circle' style='color:gray; font-size:15px;'></i>&nbsp;
												Sila klik pada butang  untuk memuat turun dokumen SPBB berkenaan. 
											</div> 

											<div class="text-dark fw-semibold fs-6"><i class='fas fa-info-circle' style='color:gray; font-size:15px;'></i>&nbsp;
												Sila semak dan tandatangan dokumen yang telah dimuat turun.
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
		$(document).ready(function() {
			var table = $('#sortTable1').DataTable({
				"columnDefs": [
					{
						"targets": 'no-sort',
						"orderable": false
					}
				],
			});

			// Disable sorting for the "No" column
			table.on('order.dt', function() {
				table.column(0, { order: 'applied' }).nodes().each(function(cell, i) {
					cell.innerHTML = i + 1;
				});
			}).draw();
		});
	</script>
</body>
	
</x-default-layout>
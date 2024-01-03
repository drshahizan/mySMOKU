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
			<li class="breadcrumb-item text-dark" style="color:darkblue">Salur Peruntukan Bantuan BKOKU</li>
			<!--end::Item-->
		</ul>
	<!--end::Breadcrumb-->
	</div>

	<br>

	<!-- Main body part  -->
	<div id="main-content">
		<div class="container-fluid">
			<div class="block-header">
				<div class="row clearfix">
					<div class="card p-5">
						<div class="header">
							<h2>Borang Salur Peruntukan Bantuan BKOKU<br><small>Sila klik pada ikon "Lihat" untuk semak dokumen yang dimuat naik oleh penyelaras universiti awam.</small></h2>
						</div>

						<div class="body">
							<div class="table-responsive" id="table-responsive">
								<table id="sortTable1" class="table table-bordered table-striped">
									<thead>
										<tr>
											<th class="text-center" style="width: 5%">No.</th>
											<th class="text-center" style="width: 50%">Nama Institusi Pengajian</th>
											<th class="text-center" style="width: 22%">Tarikh Kemaskini Dokumen</th>
											<th class="text-center" style="width: 23%">Borang SPBB & Penyata Bank</th>
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
							
											@if (str_ends_with($doc->no_rujukan, '/2'))
												<tr>
													<td class="text-center" data-no="{{ $i++ }}">{{ $i }}.</td>
													<td>{{ $nama_institusi }}</td>
													<td class="text-center">{{date('d/m/Y', strtotime($doc->updated_at))}}</td>
													<td class="text-center">
														<a href="{{ url('penyaluran/sekretariat/lihat/salinan-dokumen/SPBB/'.$id) }}" class="btn btn-info btn-sm" style="width: 60%; margin: 0 auto;">
															Lihat <i class='fas fa-eye' style='color:white; padding-left:20px;'></i>
														</a>
													</td>
												</tr>
											@endif
										@endforeach
									</tbody>
								</table>
							</div>
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
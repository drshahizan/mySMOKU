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
			<li class="breadcrumb-item text-dark" style="color:darkblue">Draf Borang</li>
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
							<h2>Draf Borang Salur Peruntukan Bantuan BKOKU<br><small>Sila klik nama borang untuk semak dokumen.</small></h2>
						</div>

						<div class="body">
							<div class="table-responsive" id="table-responsive">
								<table id="sortTable1" class="table table-bordered table-striped">
									<thead>
										<tr>
											<th class="text-center" style="width: 5%">No.</th>
											<th class="text-center" style="width: 70%">Nama Institusi Pengajian</th>
											<th class="text-center" style="width: 25%">Draf SPBB</th>
										</tr>
									</thead>
									<tbody>
										
										@foreach ($institusiPengajianUA as $ua)
											<tr>
												<td class="text-center" data-no="{{ $loop->iteration }}">{{ $loop->iteration }}.</td>
												<td>{{ $ua->nama_institusi }}</td>
												<td>
													<div><a href="{{ route('sekretariat.draf.SPBB1', ['id_institusi' => $ua->id_institusi]) }}">SPBB 1</a></div>
													<div><a href="{{ route('sekretariat.draf.SPBB1a', ['id_institusi' => $ua->id_institusi]) }}">SPBB 1a</a></div>
													<div><a href="{{ route('sekretariat.draf.SPBB2', ['id_institusi' => $ua->id_institusi]) }}">SPBB 2</a></div>
													<div><a href="{{ route('sekretariat.draf.SPBB2a', ['id_institusi' => $ua->id_institusi]) }}">SPBB 2a</a></div>
													<div><a href="{{ route('sekretariat.draf.SPBB3', ['id_institusi' => $ua->id_institusi]) }}">SPBB 3</a></div>
												</td>
											</tr>
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

			
		});
	</script>
</body>
	
</x-default-layout>
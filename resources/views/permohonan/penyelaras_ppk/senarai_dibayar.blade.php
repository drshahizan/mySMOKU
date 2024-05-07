<x-default-layout>
<head>
	<!-- MAIN CSS -->
    <link rel="stylesheet" href="/assets/css/saringan.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
	<script src="/assets/lang/Malay.json"></script>
    <script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js"></script>
</head>	 
<div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
	<!--begin::Title-->
	<h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Permohonan</h1>
	<!--end::Title-->
	<!--begin::Breadcrumb-->
	<ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
		<!--begin::Item-->
		<li class="breadcrumb-item text-muted">
			<a href="/" class="text-dark text-hover-primary" style="color:darkblue">Permohonan</a>
		</li>
		<!--end::Item-->
		<!--begin::Item-->
		<li class="breadcrumb-item">
			<span class="bullet bg-gray-400 w-5px h-2px"></span>
		</li>
		<!--end::Item-->
		<!--begin::Item-->
		<li class="breadcrumb-item text-dark" style="color:darkblue">Permohonan Layak</li>
		<!--end::Item-->
	</ul>
	<!--end::Breadcrumb-->
</div>
<br>
<div class="row clearfix">
	<div class="col-lg-12">
		<div class="card">
			<div class="header">
				<h2>Senarai Permohonan yang telah Dibayar</h2>
			</div>

			<div class="body">
				<div class="table-responsive">
					<table id="sortTable2" class="table table-striped table-hover dataTable js-exportable">
						<thead>
							<tr>
								<th style="width: 10%"><b>ID Permohonan</b></th>                                        
								<th style="width: 25%"><b>Nama</b></th>
								<th style="width: 25%"><b>Nama Kursus</b></th>
								<th style="width: 15%" class="text-center"><b>Tarikh Permohonan</b></th>
								<th style="width: 15%" class="text-center"><b>Amaun Wang Saku Dibayar</b></th>
								<th style="width: 15%" class="text-center"><b>Tarikh Transaksi</b></th>
								<th style="width: 15%" class="text-center"><b>Status Permohonan</b></th>
							</tr>
						</thead>
						<tbody>
							@foreach ($smoku as $smoku)
							@php
								$text = ucwords(strtolower($smoku->nama)); // Assuming you're sending the text as a POST parameter
								$conjunctions = ['bin', 'binti'];
								$words = explode(' ', $text);
								$result = [];
								foreach ($words as $word) {
									if (in_array(Str::lower($word), $conjunctions)) {
										$result[] = Str::lower($word);
									} else {
										$result[] = $word;
									}
								}
								$pemohon = implode(' ', $result);

								$smoku->tarikh_hantar = new DateTime($smoku->tarikh_hantar);
								$formattedDate = $smoku->tarikh_hantar->format('d/m/Y');

								$smoku->tarikh_transaksi = new DateTime($smoku->tarikh_transaksi);
								$tarikh_transaksi = $smoku->tarikh_transaksi->format('d/m/Y');
						
							@endphp
							<tr>
								<td>{{ $smoku->no_rujukan_permohonan}}</td>
								<td>{{ $pemohon}}</td>
								<td>{{ $smoku->nama_kursus}}</td>
								<td class="text-center">{{ $formattedDate}}</td>
								<td class="text-center"> RM {{ $smoku->wang_saku_dibayar}}</td>
								<td class="text-center">{{ $tarikh_transaksi}}</td>
								<td class="text-center">
									<a href="{{ route('generate-pdf', ['permohonanId' => $smoku->permohonan_id]) }}" class="btn bg-dibayar btn-round btn-sm custom-width-btn">
										<i class="fa fa-download fa-sm custom-white-icon" style="color: white !important;"></i> Dibayar
									</a>
								</td>
							</tr>  
							@endforeach	
						</tbody>
					</table>
				</div>
			</div>
			{{-- End of Body --}}
		</div>
	</div>
</div>
<style>
	.custom-width-btn {
		width: 130px; 
		height: 30px;
	}
</style>
<script>

	$('#sortTable2').DataTable({
            ordering: true, // Enable manual sorting
            order: [], // Disable initial sorting
			language: {
				url: "/assets/lang/Malay.json"
			}
    });
</script>		                             
</x-default-layout> 
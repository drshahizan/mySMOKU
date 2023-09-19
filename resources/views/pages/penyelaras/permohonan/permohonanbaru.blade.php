<x-default-layout> 
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
		<li class="breadcrumb-item text-dark" style="color:darkblue">Permohonan Baharu</li>
		<!--end::Item-->
	</ul>
	<!--end::Breadcrumb-->
</div>
<br>
    <head>
    <!-- MAIN CSS -->
    <link rel="stylesheet" href="/assets/css/saringan.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js"></script>
    </head>

        <div class="row clearfix">
			<div class="col-lg-12">
				<div class="card">
					<div class="header">
						<h2>Senarai Permohonan</h2>
					</div>
					<div class="body">
						<div class="table-responsive">
							<table id="sortTable" class="table table-striped table-hover dataTable js-exportable">
								<thead>
									<tr>
										<th style="width: 17%"><b>ID Permohonan</b></th>                                        
										<th style="width: 33%"><b>Nama</b></th>
										<th style="width: 33%"><b>Institusi</b></th>
										<th style="width: 15%" class="text-center"><b>Tarikh Permohonan</b></th>
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
								
										//institusi pengajian
										$text3 = ucwords(strtolower($smoku->nama_institusi)); // Assuming you're sending the text as a POST parameter
										$conjunctions = ['of', 'in', 'and'];
										$words = explode(' ', $text3);
										$result = [];
										foreach ($words as $word) {
											if (in_array(Str::lower($word), $conjunctions)) {
												$result[] = Str::lower($word);
											} else {
												$result[] = $word;
											}
										}
										$institusi = implode(' ', $result);
									@endphp
                                    <tr>
                                        <td><a href="{{route('penyelaras.view.permohonan',$smoku->smoku_id)}}">{{ $smoku->no_rujukan_permohonan}}</a></td>
                                        <td>{{ $pemohon}}</td>
                                        <td>{{ $institusi}}</td>
                                        <td class="text-center">{{ $smoku->created_at->format('d/m/Y h:i:sa')}}</td>
                                        <td class="text-center"><button type="button" class="btn btn-success btn-sm">Hantar</button></td>
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
</x-default-layout> 
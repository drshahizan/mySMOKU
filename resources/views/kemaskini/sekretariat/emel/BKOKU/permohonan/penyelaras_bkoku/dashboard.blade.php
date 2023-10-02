<x-default-layout>
<!--begin::Page title-->
<div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
	<!--begin::Title-->
	<h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Utama</h1>
	<!--end::Title-->
	<!--begin::Breadcrumb-->
	<ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
		<!--begin::Item-->
		<li class="breadcrumb-item text-muted">
			<a href="/" class="text-dark text-hover-primary" style="color:darkblue">Laman Utama</a>
		</li>
		<!--end::Item-->
		<!--begin::Item-->
		<li class="breadcrumb-item">
			<span class="bullet bg-gray-400 w-5px h-2px"></span>
		</li>
		<!--end::Item-->
		<!--begin::Item-->
		<li class="breadcrumb-item text-dark" style="color:darkblue">Paparan Pemuka</li>
		<!--end::Item-->
	</ul>
	<!--end::Breadcrumb-->
</div>
<head>
    <link rel="stylesheet" href="/assets/css/saringan.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js"></script>
</head>
<br>
                             
<!--begin::Row-->
<div class="row g-5 g-xl-8">
	<!--begin::Col-->
	<div class="col-xl-4">
		<!--begin::Engage widget 9-->
		<div class="card h-lg-100" style="background:  #ffffff )">
			<!--begin::Body-->
			<div class="card-body">
				<!--begin::Row-->
				<div class="row align-items-center">
					<!--begin::form-->
					<form class="form w-100" action="{{ route('penyelaras.dashboard')}}" method="post"> 
					@csrf 
						<!--begin::Heading-->
						<div class="text-center mb-11">
							<br>
							<!--begin::Subtitle-->
							<h2 class="text-dark fw-bolder mb-3">
								Sistem Maklumat Orang Kurang Upaya (SMOKU)
							</h2>
							<!--end::Subtitle--->
						</div>
						<!--begin::logo-->
						<div class="text-center mb-11">
							<img alt="Logo" src="{{ image('logos/logo.png') }}" class="h-100px h-lg-90px"/>        
						</div>
						<!--end::logo-->
						<!--begin::Input group-"-->
						<div class="col-xs-3">
						<!--begin::Name-->
						<input type="text" placeholder="No Kad Pengenalan" name="no_kp" maxlength="12" autocomplete="off" class="form-control bg-transparent" style="text-align:center; display: block;margin-left: auto; margin-right: auto;"/>
						<!--end::Name-->
						</div>
						<!--begin::Submit button-->
						<div class="d-flex flex-center mt-15">
							<button type="submit"  class="btn btn-primary">
								Daftar
							</button>
						</div>
					</form>
					<!--end::form-->
				</div>
			</div>
			<!--end::Body-->
		</div>
	</div>
	<!--end::Col-->
	<!--begin::Col-->
	<div class="col-xl-8">
		<!--begin::Table widget 9-->
		<div class="card card-flush h-xl-100">
			<!--begin::Header-->
			<div class="card-header pt-5">
				<!--begin::Title-->
				<h3 class="card-title align-items-start flex-column">
					<span class="card-label fw-bold text-gray-800">Pendaftaran Pelajar BKOKU</span>
					<!--<span class="text-gray-400 pt-1 fw-semibold fs-6">Program BKOKU</span>-->
				</h3>
				<!--end::Title-->
				@if (session('message'))
					<div class="alert alert-success" style="color:black;">{{ session('message') }}</div>
				@endif
				@if (session('xmessage'))
					<div class="alert alert-danger" style="color:black;">{{ session('xmessage') }}</div>
				@endif
			</div>
			<!--end::Header-->
			<!--begin::Body-->
			<div class="body">
				<!--begin::Table container-->
				<div class="table-responsive">
					<!--begin::Table-->
					<table id="sortTable" class="table table-striped table-hover dataTable js-exportable">
						<!--begin::Table head-->
						<thead>
							<tr class="fs-7 fw-bold border-0 text-dark">
								<th class="min-w-150px text-center" colspan="2">No. Kad Pengenalan</th>
								<th class="min-w-150px text-center" colspan="2">Nama</th>
								<th class="text-center min-w-150px" colspan="2">Status Permohonan</th>
							</tr>
						</thead>
						<!--end::Table head-->
						<!--begin::Table body-->
						<tbody>
							@foreach ($smoku as $smoku)
								@php
								$text = ucwords(strtolower($smoku->nama)); 
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
								@endphp
							<tr>
								<td class="" colspan="2">
									<span class="text-dark fw-bold fs-6 me-3">{{ $smoku->no_kp}}</span>
								</td>
								<td class="" colspan="2">
									<span class="text-gray-800 fw-bold text-center mb-1 fs-6">{{$pemohon}}</span>
								</td>
								<td class="text-center"><a href="{{route('penyelaras.permohonan.baharu',$smoku->smoku_id)}}">
									<button class="btn bg-primary text-white">Belum Mohon</button></a>
								</td>
							</tr>
							@endforeach	
						</tbody>
						<!--end::Table body-->
					</table>
					<!--end::Table-->
				</div>
				<!--end::Table container-->
			</div>
			<!--end::Body-->
		</div>
		<!--end::Table Widget 9-->
	</div>
	</div> <script>
			$('#sortTable').DataTable();
		</script>
	</div>

</x-default-layout>

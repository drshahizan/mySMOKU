<x-default-layout> 
<head>
	<!-- MAIN CSS -->
	<link rel="stylesheet" href="/assets/css/saringan.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
	<script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js"></script>
</head>
<!--begin::Page title-->
<div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
	<!--begin::Title-->
	<h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Sejarah Permohonan</h1>
	<!--end::Title-->
	<!--begin::Breadcrumb-->
	<ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
		<!--begin::Item-->
		<li class="breadcrumb-item text-dark">
			<a href="/" class="text-dark text-hover-primary" style="color:darkblue">Permohonan</a>
		</li>
		<!--end::Item-->
		<!--begin::Item-->
		<li class="breadcrumb-item">
			<span class="bullet bg-gray-400 w-5px h-2px"></span>
		</li>
		<!--end::Item-->
		<!--begin::Item-->
		<li class="breadcrumb-item text-dark" style="color:darkblue">Sejarah Permohonan</li>
		<!--end::Item-->
	</ul>
	<!--end::Breadcrumb-->
</div>
<!--end::Page title-->
<br>

<div class="table-responsive">
	<table id="sortTable2" class="table table-striped table-hover dataTable js-exportable">
		<thead>
			<tr>
				<th>ID Permohonan</th>
				<th>Tarikh Permohonan</th>
				<th>Status Permohonan</th>
			</tr>
		</thead>
		<tbody>
		{{-- @foreach($permohonan as $permohonan) --}}
		<tr> 
			<td>{{$permohonan->no_rujukan_permohonan}}</td>
			<td>{{$permohonan->updated_at->format('d/m/Y h:i:sa')}}</td>
			@if($permohonan->status == "LAYAK")
				<td class="text-center">
					<a href="{{ route('generate-pdf', ['permohonanId' => $permohonan->id]) }}" class="btn btn-success btn-round btn-sm custom-width-btn">
						<i class="fa fa-download custom-white-icon" style="color: white !important;"></i> Layak
					</a>
				</td>
			@elseif($permohonan->status == "TIDAK LAYAK")
				<td class="text-center"><button type="button" class="btn btn-danger btn-sm">Tidak Layak</button></td>
			@else
			<td class="text-center"><button type="button" class="btn btn-success btn-sm">{{ucwords(strtolower($permohonan->status))}}</button></td>
			@endif
			{{-- <td><a href="{{ route('delete',  $permohonan->permohonan_id) }}" class="btn btn-primary btn-sm">Batal</a></td> --}}
		</tr>
		{{-- @endforeach --}}
		</tbody>
	</table>
</div>


<style>
	.custom-width-btn {
		width: 130px; 
		height: 30px;
	}
</style>



</x-default-layout>
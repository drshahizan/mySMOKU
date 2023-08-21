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
	<table class="table table-rounded table-striped border gy-7 gs-7" style="background-color:#FFFFE0;">
		<thead>
			<tr class="fw-semibold fs-6 text-gray-800 border-bottom border-gray-200">
				<th>ID Permohonan</th>
				<th>Status Permohonan</th>
				<th>Tindakan Permohonan</th>
				<th>Tarikh Kemaskini</th>
			</tr>
		</thead>
		<tbody>
		@foreach($permohonan as $permohonan)
		<tr> 
			<td>{{$permohonan->id_permohonan}}</td>
			<td>{{$permohonan->status}} </td>
			<td><a href="{{ route('delete',  $permohonan->nokp_pelajar) }}" class="btn btn-primary">Batal</a> </td>
			<td>{{$permohonan->created_at->format('d/m/Y')}}</td>
			
		</tr>
		@endforeach
		</tbody>
	</table>
</div>






</x-default-layout>
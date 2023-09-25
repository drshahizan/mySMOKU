<x-default-layout> 
<head>

<!-- MAIN CSS -->
<link rel="stylesheet" href="/assets/css/saringan.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js"></script>
<link href="assets/css/style.bundle.css" rel="stylesheet" type="text/css" />

</head>
		<!--begin::Page title-->
<div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
	<!--begin::Title-->
	<h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Status Sambungan API</h1>
	<!--end::Title-->
	
</div>
<br>
<!--end::Page title-->
<div class="table-responsive">
	<!--begin::Content-->
	<div id="kt_app_content" class="app-content flex-column-fluid">
		<!--begin::Content container-->
		<div id="kt_app_content_container" class="app-container container-xxl">
			
			<!--begin::Table-->
			<table class="table table-row-dashed fs-6 gy-5">
				<thead>
					<tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0">
						<th class="min-w-100px">API</th>
						<th class="min-w-100px">Status</th>
						<th class="w-100px">Semak</th>
					</tr>
				</thead>
				<tbody class="fw-semibold text-gray-600" >
					<tr>
						<td class="text-gray-800">SMOKU</td>
						<td> 
							@if(isset($error))
								<p style="color: red;">Ralat: {{ $error }}</p>
							@endif
				
							@if(isset($success))
								<p style="color: green;">Berjaya: {{ $success }}</p>
							@endif
						</td>
						<td></td>
					</tr>
					<tr>
						<td class="text-gray-800">MQA</td>
						<td></td>
						<td></td>
					</tr>
					<tr>
						<td class="text-gray-800">ESP</td>
						<td></td>
						<td></td>
					</tr>
				</tbody>
			</table>
			<!--end::Table-->
			
		</div>
		<!--end::Content container-->
	</div>
	<!--end::Content-->
	
</div>

<!--begin::Javascript-->
<!--begin::Global Javascript Bundle(mandatory for all pages)-->

<script src="assets/js/scripts.bundle.js"></script>
<!--end::Global Javascript Bundle-->

<!--begin::Custom Javascript(used for this page only)-->
<script src="assets/js/custom/apps/customers/list/export.js"></script>
<script src="assets/js/custom/apps/customers/list/list.js"></script>
<script src="assets/js/custom/apps/customers/add.js"></script>
<script src="assets/js/custom/utilities/modals/new-card.js"></script>
<script src="assets/js/custom/utilities/modals/users-search.js"></script>
<!--end::Custom Javascript-->
<!--end::Javascript-->
	




</x-default-layout>
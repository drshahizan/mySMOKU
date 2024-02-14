<x-default-layout> 
<head>

<!-- MAIN CSS -->
<link rel="stylesheet" href="/assets/css/saringan.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js"></script>
<link href="/assets/css/style.bundle.css" rel="stylesheet" type="text/css" />

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
			<!--begin::Card-->
			<div class="card">
				<!--begin::Card header-->
				<div class="card-header border-0 pt-6">
					<!--begin::Card title-->
					<div class="card-title">
						<!--begin::Search-->
						<div class="d-flex align-items-center position-relative my-1">
							<i>
								<span class="path1"></span>
								<span class="path2"></span>
							</i>
							
						</div>
						<!--end::Search-->
					</div>
					<!--begin::Card title-->
				</div>
				<!--end::Card header-->
				<!--begin::Card body-->
				<div class="card-body pt-0">	
					<!--begin::Table-->
					<table class="table table-row-dashed fs-6 gy-5">
						<thead>
							<tr class="text-start text-gray-400 fw-bold fs-7 gs-0">
								<th class="min-w-100px">API</th>
								<th class="min-w-100px">Status</th>
							</tr>
						</thead>
						<tbody class="fw-semibold text-gray-600">
							<tr>
								<td class="text-gray-800">SMOKU</td>
								<td>
									@if(isset($error['smoku']))
										<p style="color: red;"> {{ $error['smoku'] }}</p>
									@endif
					
									@if(isset($success['smoku']))
										<p style="color: green;">Berjaya: {{ $success['smoku'] }}</p>
									@endif
								</td>
							</tr>
							<tr>
								<td class="text-gray-800">MQA</td>
								<td>
									@if(isset($error['mqa']))
										<p style="color: red;"> {{ $error['mqa'] }}</p>
									@endif
					
									@if(isset($success['mqa']))
										<p style="color: green;">Berjaya: {{ $success['mqa'] }}</p>
									@endif
								</td>
							</tr>
							<tr>
								<td class="text-gray-800">ESP</td>
								<td>
									@if(isset($error['esp']))
										<p style="color: red;"> {{ $error['esp'] }}</p>
									@endif
					
									@if(isset($success['esp']))
										<p style="color: green;">Berjaya: {{ $success['esp'] }}</p>
									@endif
								</td>
							</tr>
						</tbody>
					</table>
					
					<!--end::Table-->
				</div>
				<!--end::Card body-->
			</div>
			<!--end::Card-->	
		</div>
		<!--end::Content container-->
	</div>
	<!--end::Content-->
</div>

<!--begin::Javascript-->

<!--end::Javascript-->
	




</x-default-layout>
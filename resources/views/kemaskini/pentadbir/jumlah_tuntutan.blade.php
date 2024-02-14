<x-default-layout> 
	<head>
		<!-- MAIN CSS -->
		<link rel="stylesheet" href="/assets/css/saringan.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
		<script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
		<script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js"></script>
		<link href="/assets/css/style.bundle.css" rel="stylesheet" type="text/css" />

		<style>
			.align-center {
				text-align: center;
			}	
		</style>
	</head>

	<!--begin::Page title-->
	<div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
		<!--begin::Title-->
		<h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Selenggara Had Maksima Tuntutan</h1>
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
						<!--begin::Form-->
						<form id="dataForm" class="form" action="{{ route('simpan.jumlah') }}" method="post">
							@csrf
							
							<div class="row mb-10">
								<!--begin::Input group-->
								<div class="col-md-6 fv-row">
									<!--begin::Label-->
									<label class="fs-6 fw-semibold mb-2">Program</label>
									<!--end::Label-->
									<!--begin::Input-->
									<select name="program" id="program" class="form-select form-select-solid" data-control="select2" data-placeholder="Pilih">
										<option value=""></option>
										<option value="BKOKU">BKOKU</option>
										<option value="PPK">PPK</option>
									</select>
									<!--end::Input-->
								</div>
								<!--end::Input group-->
								<!--begin::Input group-->
								<div class="col-md-6 fv-row">
									<!--begin::Label-->
									<label class="fs-6 fw-semibold mb-2">Jenis</label>
									<!--end::Label-->
									<!--begin::Input-->
									<select name="jenis" id="jenis" class="form-select form-select-solid" data-control="select2" data-placeholder="Pilih">
										<option value=""></option>
										<option value="Yuran">Yuran</option>
										<option value="Wang Saku">Wang Saku</option>
									</select>
									<!--end::Input-->
								</div>
								<!--end::Input group-->
							</div>
							<div class="row mb-10">
								<!--begin::Input group-->
								<div class="col-md-6 fv-row" id="div_semester">
									<!--begin::Label-->
									<label class="fs-6 fw-semibold mb-2">Semester</label>
									<!--end::Label-->
									<!--begin::Input-->
									<select name="semester" id="semester" class="form-select form-select-solid" data-control="select2" data-placeholder="Pilih">
										<option value=""></option>
										<option value="1">1</option>
										<option value="2">2</option>
										<option value="3">3</option>
										<option value="4">4</option>
									</select>
									<!--end::Input-->
								</div>
								<!--end::Input group-->
								<!--begin::Input group-->
								<div class="col-md-6 fv-row">
									<!--begin::Label-->
									<label class="fs-6 fw-semibold mb-2">Jumlah</label>
									<!--end::Label-->
									<!--begin::Input-->
									<input type="text" class="form-control form-control-solid" name="jumlah" id="jumlah" value="" />
									<!--end::Input-->
								</div>
								<!--end::Input group-->
							</div>
							
							
							<br>
							<!--begin::action-->
							<div class="modal-footer flex-center">
								<!--begin::Button-->
								<button type="submit" id="kt_modal_add_customer_submit" class="btn btn-primary">
									<span class="indicator-label">Simpan</span>
									<span class="indicator-progress">Sila tunggu...
									<span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
								</button>
								<!--end::Button-->
							</div>
							<!--end::action-->
						</form>
						<!--end::Form-->
					</div>
					<!--end::Card body-->
					<!--begin::Card body-->
					<div class="card-body pt-0">
						<!--begin::Table-->
						<div class="table-responsive">
							<table class="table align-center table-row-dashed fs-6 gy-5" id="myTable">
								<thead>
									<tr class="text-start align-center text-gray-400 fw-bold fs-7 gs-0">
										<th class="min-w-125px align-center">Program</th>
										<th class="min-w-125px align-center">Jenis</th>
										<th class="min-w-125px align-center">Semester</th>
										<th class="min-w-125px align-center">Jumlah</th>
										<th class="min-w-125px align-center">Tarikh Kemaskini</th>
									</tr>
								</thead>
								<tbody class="fw-semibold text-gray-600">
									@foreach ($jumlah as $jumlah)
									<tr>
										<td>{{ $jumlah->program}}</td>
										<td>{{ $jumlah->jenis}}</td>
										<td>{{ $jumlah->semester}}</td>
										<td>RM {{ $jumlah->jumlah}}</td>
										<td>{{ $jumlah->updated_at->format('d/m/Y')}}</td>
		
									</tr>
									@endforeach
								</tbody>
							</table>
						</div>
						<!--end::Table-->
						<div style="font-size: 11px;"> Double click row untuk kemaskini had maksima </div>
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
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	<script>
		$(document).ready(function () {
			$('#myTable tbody tr').on('dblclick', function () {
				// Handle double-click event here
				var rowData = $(this).find('td'); // Get the data from the clicked row

				// Extract data for the Program and Jenis fields (adjust column indices as needed)
				var programValue = $(rowData[0]).text(); // Assuming Program data is in the first column
				var jenisValue = $(rowData[1]).text(); // Assuming Jenis data is in the second column
				var semValue = $(rowData[2]).text(); // Assuming Jenis data is in the second column
				var jumlahValue = $(rowData[3]).text().replace('RM ', ''); // Assuming Jenis data is in the second column
				

				// Set the selected options in the <select> elements
				$('#program').val(programValue);
				$('#jenis').val(jenisValue);
				$('#semester').val(semValue);
				$('#jumlah').val(jumlahValue);

				$('#program').trigger('change');
				$('#jenis').trigger('change');
				$('#semester').trigger('change');
				// Show the form
				$('#dataForm').show();
			});

		});


		$(document).ready(function(){
		$('#program').on('change', function() {
		if ( this.value == 'PPK'){
			$("#div_semester").show();
		} else {
			$("#div_semester").hide();
		}
		});
	});
	</script>
	<!--end::Javascript-->
</x-default-layout>
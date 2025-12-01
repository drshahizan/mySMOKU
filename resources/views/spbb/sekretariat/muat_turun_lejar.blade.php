<x-default-layout> 

<head>
<!-- MAIN CSS -->
	<link rel="stylesheet" href="/assets/css/sekretariat.css">
	<script src="https://cdn.tiny.cloud/1/v736541al0ntzh14edk63z19dzyqs1xn2bkc5em78rv1yeis/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
	<script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js"></script>
	<link href="/assets/css/style.bundle.css" rel="stylesheet" type="text/css" />
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
			<li class="breadcrumb-item text-dark" style="color:darkblue">Lejar</li>
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
							<h2>Maklumat Lejar<br><small>Sila pilih sesi salur.</small></h2>
						</div>

						<!--begin::Card toolbar-->
                       	<div class="card-toolbar">
							<!--begin::Toolbar-->
							<div class="d-flex justify-content-between align-items-center" style="margin-left: 20px;" data-kt-subscription-table-toolbar="base">
								<!--begin::Filter-->
								<div data-kt-subscription-table-filter="form">
									<!--begin::Input group-->
									<div class="row mb-0">
										<div class="col-md-8">
											<!-- Label and dropdown side by side -->
											<div class="d-flex align-items-center">
												<label for="sesiDropdown" class="form-label me-2 mb-0" style="white-space: nowrap;">Sesi Salur :</label>
												<select id="sesiDropdown" name="sesi" class="form-select custom-width-select js-example-basic-single" style="flex: 1; min-width: 150px;">
													<option value="">Pilih Sesi Salur</option>
												</select>
											</div>
										</div>
									</div>
									<!--end::Input group-->
								</div>
								<!--end::Filter-->
							</div>
							<!--end::Toolbar-->
						</div>
                        <!--end::Card toolbar-->

						<div class="body">
							<div class="table-responsive" id="table-responsive">
								<table id="sortTable1" class="table table-bordered table-striped">
									<thead>
										<tr>
											<th class="text-center">No.</th>
											<th class="text-center">Nama Institusi Pengajian</th>
											<th class="text-center">Lejar Baharu (Permohonan)</th>
											<th class="text-center">Lejar Sedia Ada (Tuntutan)</th>
										</tr>
									</thead>
									<tbody>
										
										@foreach ($institusiPengajianUA as $ua)
											<tr>
												<td class="text-center" data-no="{{ $loop->iteration }}">{{ $loop->iteration }}.</td>
												<td>{{ $ua->nama_institusi }}</td>
												<td class="text-center">
													<div>
														<a href="#" class="download-permohonan" data-id="{{ $ua->id_institusi }}">
															<i class="fa-solid fa-download"></i>
														</a>
													</div>
												</td>

												<td class="text-center">
													<div>
														<a href="#" class="download-tuntutan" data-id="{{ $ua->id_institusi }}">
															<i class="fa-solid fa-download"></i>
														</a>
													</div>
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
	<style>
        .custom-width-select {
            width: 200px !important; /* Important to override other styles */
        }
        .form-select {
                margin-left: 10px !important; 
        }
    </style>
	<script>
        $(document).ready(function() {
			$('.js-example-basic-single').select2();
		});
    </script>
	<script>
		
		$(document).ready(function() {
			var sesiSalur = @json($sesiSalur);

			var table = $('#sortTable1').DataTable({
				ordering: true, // Enable manual sorting
				order: [], // Disable initial sorting
				columnDefs: [
					{
						"targets": 'no-sort',
						"orderable": false
					}
				],
				language: {
					url: "/assets/lang/Malay.json"
				}
			});
				

			// Function to clear filters for all tables
			function clearFilters() {
				if ($.fn.DataTable.isDataTable('#sortTable1')) {
					$('#sortTable1').DataTable().destroy();
				}
			}

			// Function to update the institution dropdown
			function updateSesiDropdown(sesiList) {
				// Clear existing options
				$('#sesiDropdown').empty();

				// Add default option
				$('#sesiDropdown').append('<option value="">Pilih Sesi Salur</option>');

				// Add options based on the selected tab
				for (var i = 0; i < sesiList.length; i++) {
					$('#sesiDropdown').append('<option value="' + sesiList[i].sesi + '">' + sesiList[i].sesi + '</option>');
				}
			}

			// Trigger the function for the default active tab (bkoku-tab)
			updateSesiDropdown(sesiSalur);
			initializeDataTable1(); // Initialize DataTable1 on page load

			
		});
	</script>

	<script>
        // DOWNLOAD PERMOHONAN
		$(document).on('click', '.download-permohonan', function (e) {
			e.preventDefault();

			let sesi = $('#sesiDropdown').val();
			let id = $(this).data('id');

			if (!sesi) {
				alert("Sila pilih sesi terlebih dahulu.");
				return;
			}

			sesi = encodeURIComponent(sesi);

			let url = "{{ route('sekretariat.muat-turun.lejar.permohonan', [':id', ':sesi']) }}";
			url = url.replace(':id', id).replace(':sesi', sesi);

			window.location.href = url;

		});


		// DOWNLOAD TUNTUTAN
		$(document).on('click', '.download-tuntutan', function (e) {
			e.preventDefault();

			let sesi = $('#sesiDropdown').val();
			let id = $(this).data('id');

			if (!sesi) {
				alert("Sila pilih sesi terlebih dahulu.");
				return;
			}

			sesi = encodeURIComponent(sesi);

			let url = "{{ route('sekretariat.muat-turun.lejar.tuntutan', [':id', ':sesi']) }}";
			url = url.replace(':id', id).replace(':sesi', sesi);

			window.location.href = url;

		});

        
    </script>
</body>
	
</x-default-layout>
<x-default-layout> 
<head>
	<link rel="stylesheet" href="/assets/css/saringan.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
	<script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js"></script>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.min.css">
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
</head>
<!--begin::Content-->
<div id="kt_app_content" class="app-content flex-column-fluid">
	<!--begin::Content container-->
	<div id="kt_app_content_container" class="app-container container-xxl">
		<!--begin::Layout-->
		<div class="d-flex flex-column flex-lg-row">
			@if ($permohonan->yuran == '1')
			<!--begin::Content-->
			<div class="flex-lg-row-fluid mb-10 mb-lg-0 me-lg-7 me-xl-10">
				<!--begin::Card-->
				<div class="card">
					<!--begin::Card body-->
					<div class="card-body p-8">
						<!--begin::Form-->
						<form id="dataForm" action="{{ route('bkoku.simpan.tuntutan',$smoku_id) }}" method="post" enctype="multipart/form-data">
							@csrf
							<!--begin::Wrapper-->
							<div class="d-flex flex-column align-items-start flex-xxl-row">
								<div class="d-flex flex-center flex-equal fw-row text-nowrap order-1 order-xxl-2 me-4" data-bs-toggle="tooltip" data-bs-trigger="hover">
									<span class="fs-3 fw-bold text-gray-800">Borang Tuntutan</span>
								</div>
							</div>
							<br>
							<!--begin::Wrapper-->
							<!--begin::Wrapper-->
							<input type="hidden" class="form-control form-control-solid" name="max_yuran" id="max_yuran" value=""/>
							<input type="hidden" class="form-control form-control-solid" name="max_wang_saku" id="max_wang_saku" value=""/>

							<div class="mb-0">
								<!--begin::Row-->
								<div class="row gx-10 mb-5">
									<!--begin::Col-->
									<div class="col-lg-6">
										<label class="form-label fs-6 fw-bold text-gray-700 mb-3">Sesi Pengajian</label>
										<div class="mb-5">
											<input type="text" id="sesi" name="sesi" class="form-control form-control-solid" placeholder="" value="{{$sesiSemasa}}" readonly/>
										</div>
									</div>
									<div class="col-lg-6">
										<label class="form-label fs-6 fw-bold text-gray-700 mb-3">Semester</label>
										<!--begin::Input group-->
										<div class="mb-5">
											<input type="text" id="semester" name="semester" class="form-control form-control-solid" placeholder="" value="{{$semSemasa}}" readonly/>
										</div>
									</div>
									<!--end::Col-->
								</div>
								<!--end::Row-->
								<div class="row gx-10 mb-5">
									<!--begin::Col-->
									<div class="col-lg-12">
										<label class="form-label fs-6 fw-bold text-gray-700 mb-3">Jenis Yuran</label>
										<!--begin::Input group-->
										<select id="jenis_yuran" name="jenis_yuran" class="form-select form-select-solid" data-control="select2" data-hide-search="true" data-placeholder="Pilih" required oninvalid="this.setCustomValidity('Sila pilih jenis yuran.')" oninput="setCustomValidity('')">
											<option></option>
											<option value="Yuran Pengajian">Yuran Pengajian</option>
											<option value="Yuran Pendaftaran Pengajian">Yuran Pendaftaran Pengajian</option>
											<option value="Kad Kampus/Kad Matrik">Kad Kampus/ Kad Matrik</option>
											<option value="Yuran Peperiksaan">Yuran Peperiksaan</option>
											<option value="Yuran Perpustakaan">Yuran Perpustakaan</option>
											<option value="Yuran Peralatan/ Bahan Makmal">Yuran Peralatan/ Bahan Makmal</option>
											<option value="Yuran Perkhidmatan">Yuran Perkhidmatan</option>
											<option value="Yuran Pemeriksaan/ Yuran Tesis">Yuran Pemeriksaan/ Yuran Tesis</option>
											<option value="Yuran Komputer">Yuran Komputer</option>						
										</select>
										<!--end::Input group-->
									</div>
									<!--end::Col-->
								</div>
								<div class="row gx-10 mb-5">
									<div class="col-lg-12">
										<label class="form-label fs-6 fw-bold text-gray-700 mb-3">No. resit/ invois</label>
										<!--begin::Input group-->
										<div class="mb-5">
											<input type="text" id="no_resit" name="no_resit" class="form-control form-control-solid" placeholder=""  required oninvalid="this.setCustomValidity('Sila isi no. resit.')" oninput="setCustomValidity('')"/>
										</div>
									</div>
								</div>
								<div class="row gx-10 mb-5">
									<div class="col-lg-12">
										<label class="form-label fs-6 fw-bold text-gray-700 mb-3">Perihal</label>
										<div class="mb-5">
											<input type="text" id="nota_resit" name="nota_resit" class="form-control form-control-solid" placeholder="Yuran Pengajian Semester 1 2023/2024" required oninvalid="this.setCustomValidity('Sila isi perihal.')" oninput="setCustomValidity('')"/>
										</div>
									</div>
								</div>
								<div class="row gx-10 mb-5">
									<div class="col-lg-12">
										<label class="form-label fs-6 fw-bold text-gray-700 mb-3">Amaun Yuran</label>
										<!--begin::Input group-->
										<div class="d-flex">
											<span class="input-group-text">RM</span>
											<input type="hidden" id="baki_total" name="baki_total" class="form-control form-control-solid" placeholder="" value={{$baki_total}}>
											<input type="number" id="amaun_yuran" name="amaun_yuran" onchange="myFunction()" class="form-control form-control-solid" placeholder="" step="0.01" inputmode="decimal" required oninvalid="this.setCustomValidity('Sila isi amaun yuran.')" oninput="setCustomValidity('')" />
										</div>
									</div>
								</div>
								<div class="row gx-10 mb-5">
									<div class="col-lg-12">
										<td class="text-gray-800">Salinan Resit/Invois&nbsp;<a href="/assets/contoh/invois.pdf" target="_blank" data-bs-toggle="tooltip" title="Papar contoh"><i class="fa-solid fa-circle-info" style="color: rgb(18, 178, 231);"></i></a></td>
										<div class="input-group control-group img_div form-group col-md-11" >
											<input type="file" id="resit" name="resit[]" />
										</div>
										<div id="fileLinkContainer" class="input-group control-group img_div form-group col-md-11" >
											<input type="hidden" id="resit" name="resit[]" />
											<span id="fileNameDisplay"></span>
										</div>
									</div>
								</div>
								<div class="d-flex flex-center mt-15">
									<button type="submit" class="btn btn-primary">
										Simpan
									</button>&nbsp;&nbsp;&nbsp;
								</div>
							</div>
							<!--end::Wrapper-->
						</form>
						<!--end::Form-->
					</div>
					<!--end::Card body-->
				</div>
				<!--end::Card-->
			</div>
			<!--end::Content-->
			@endif
			<!--begin::Sidebar-->
			<div class="flex-lg-auto min-w-lg-450px">
				<!--begin::Card-->
				<div class="card">
					<!--begin::Card body-->
					<div class="card-body p-10">
						<!--begin::Input group-->
						@if ($permohonan->yuran == '1')
						<div class="mb-10">
							<!--begin::Label-->
							<label class="fs-3 fw-bold text-gray-800">Item Tuntutan</label>
							<br>
							<br>
							<div class="table-responsive">
								<table id="itemtuntutan" class="table table-striped table-hover dataTable js-exportable">
									<thead>
										<tr class="fw-semibold fs-6 text-gray-800 border-bottom border-gray-200">
											<th class="text-center">Bil</th>
											<th class="text-center">Jenis Yuran</th>
											<th class="text-center">No. Resit</th>
											<th class="text-center">Perihal</th>
											<th class="text-center">RM</th>
											<th class="text-center"></th>
										</tr>
									</thead>
									<tbody class="fw-semibold text-gray-600">
										@foreach ($tuntutan_item as $tuntutan_item)
										<tr>
											<td>{{ $loop->iteration }}.</td>
											<td>{{ $tuntutan_item->jenis_yuran}}</td>
											<td><a href="/assets/dokumen/tuntutan/{{$tuntutan_item->resit}}" target="_blank">{{ $tuntutan_item->no_resit}}</a></td>
											<td>{{ $tuntutan_item->nota_resit}}</td>
											<td id="amaun" class="text-right">{{number_format($tuntutan_item->amaun, 2, '.', '')}}</td>
											<td class="text-center">
												<a href="{{ route('bkoku.tuntutan.item.delete', ['id' => $tuntutan_item->id]) }}" onclick="return confirm('Adakah anda pasti ingin padam item tuntutan ini?')">
													<span data-bs-toggle="tooltip" data-bs-trigger="hover" title="Padam">
														<i class="fa fa-trash fa-sm custom-white-icon"></i>
													</span>
												</a>
											</td>
										</tr>
										@endforeach	
									</tbody>
								</table>
								<div style="font-size: 11px;"> Klik dua kali untuk kemaskini item tuntutan. </div>
							</div>
						</div>
						@endif
						<!--begin::Form-->
						<form action="{{ route('bkoku.hantar.tuntutan',$smoku_id) }}" method="post" enctype="multipart/form-data">
						@csrf
							<!--begin::Item-->
							@if ($permohonan->wang_saku == '1')
								@if ($permohonan->yuran != '1')
									<!--begin::Wrapper-->
									<div class="d-flex flex-column align-items-start flex-xxl-row">
										<div class="d-flex flex-center flex-equal fw-row text-nowrap order-1 order-xxl-2 me-4" data-bs-toggle="tooltip" data-bs-trigger="hover">
											<span class="fs-3 fw-bold text-gray-800">Borang Tuntutan</span>
										</div>
									</div>
									<br>
									<!--begin::Wrapper-->
									<!--begin::Wrapper-->
									<input type="hidden" class="form-control form-control-solid" name="max_yuran" id="max_yuran" value=""/>
									<input type="hidden" class="form-control form-control-solid" name="max_wang_saku" id="max_wang_saku" value=""/>
									<!--begin::Row-->
									<div class="row gx-10 mb-5">
										<!--begin::Col-->
										<div class="col-lg-6">
											<label class="form-label fs-6 fw-bold text-gray-700 mb-3">Sesi Pengajian</label>
											<div class="mb-5">
												<input type="text" id="sesi" name="sesi" class="form-control form-control-solid" placeholder="" value="{{$sesiSemasa}}" readonly/>
											</div>
										</div>
										<div class="col-lg-6">
											<label class="form-label fs-6 fw-bold text-gray-700 mb-3">Semester</label>
											<!--begin::Input group-->
											<div class="mb-5">
												<input type="text" id="semester" name="semester" class="form-control form-control-solid" placeholder="" value="{{$semSemasa}}" readonly/>
											</div>
										</div>
										<!--end::Col-->
									</div>
									<!--end::Row-->
								@endif

							<div class="d-flex flex-stack">
								<div class="me-5">
									<input type="hidden" id="baki_total" name="baki_total" class="form-control form-control-solid" placeholder="" value={{$baki_total}}>

									<input id="wang_saku" name="wang_saku" onclick="myFunction()" type="checkbox" value="1" value="1" />
									<label class="form-label fw-bold fs-4 text-700">Elaun Wang Saku</label>
								</div>
							</div>
							<!--end::Item-->
							<br>
							<!--begin::Wrapper-->
							<div class="d-flex flex-stack flex-grow-1">
								<!--begin::Content-->
								<div class="fw-semibold">
									<div class="fs-6 text-dark">Amaun Wang Saku </div>
								</div>
								<!--end::Content-->
							</div>
							<!--end::Wrapper-->
							<div class="d-flex">
								<span class="input-group-text">RM</span>
								<input type="hidden" id="bil_bulan_per_sem" name="bil_bulan_per_sem" class="input-group-text" style="width: 100%;" value="{{$akademik->bil_bulan_per_sem}}"/>
								<input type="text" id="amaun_wang_saku" name="amaun_wang_saku" class="input-group-text" style="width: 100%;" value="" readonly/>
							</div>
							@endif
							<br>
							<br>
							<div class="d-flex flex-stack flex-grow-1">
								<!--begin::Content-->
								<div class="fw-semibold">
									<div class="fs-6 text-dark"><b>Jumlah Keseluruhan Tuntutan</b></div>
								</div>
								<!--end::Content-->
							</div>
							<div class="d-flex">
								<span class="input-group-text">RM</span>
								<input type="text" id="jumlah" name="jumlah" class="input-group-text" style="width: 100%;" readonly/>
							</div>
							<br>
							<br>
							<!--end::Actions-->
							<div class="d-flex justify-content-end">
								<button type="submit"  class="btn btn-primary">
									Hantar
								</button>
							</div>
						</form>	
					</div>
					<!--end::Card body-->
				</div>
				<!--end::Card-->
			</div>	
			<!--end::Sidebar-->
		</div>
		<!--end::Layout-->
	</div>
	<!--end::Content container-->
</div>
<!--end::Content-->

<!--begin::Javascript-->
<!--end::Javascript-->


<script>

	var max_yuran; // Declare these variables in a higher scope
	var max_wang_saku;
	// Make an AJAX request to fetch data based on the selected semester
	$.ajax({
		type: 'GET',
		url: '/fetch-amaun/bkoku', // Replace with the actual route for fetching data
		success: function(response) {
			// Format the value to display with .00
			var max_yuran = response.amaun_yuran;
			var max_wang_saku = response.amaun_wang_saku;
	
			document.getElementById("max_yuran").value = max_yuran;
			document.getElementById("max_wang_saku").value = max_wang_saku;
	
		},
		error: function(error) {
			console.error('Error fetching data:', error);
		}
	});	
	
	function myFunction() {
	
		var checkBox = document.getElementById("wang_saku");
		var bilbulan = parseInt(document.getElementById('bil_bulan_per_sem').value); // Convert to integer
		var wang_saku_perbulan = parseInt(document.getElementById('max_wang_saku').value);
		// alert(wang_saku_perbulan);
		var currentDate = Date.now();
		var tarikhMulaTimestamp = new Date('<?php echo $akademik->tarikh_mula; ?>').getTime();
		var tarikhTamatTimestamp = new Date('<?php echo $akademik->tarikh_tamat; ?>').getTime();
		// alert('Is tarikhMula earlier than tarikhTamat? ' + (tarikhMulaTimestamp < tarikhTamatTimestamp));
	
		if (tarikhMulaTimestamp < tarikhTamatTimestamp) {
			 var tarikhNextSem = new Date(tarikhMulaTimestamp);
			 tarikhNextSem.setMonth(tarikhNextSem.getMonth() + bilbulan);
			//  alert(tarikhNextSem);
	
			if (currentDate > tarikhNextSem) {
				var wang_saku = wang_saku_perbulan * bilbulan;
		// 		break; // Exit the loop
			} else {
				var wang_saku = 0.00;
			}
		}
	
		// alert(wang_saku);
	
		console.log('Calculated wang_saku:', wang_saku);
	
	
		// Initialize a variable to store the total
		var totalAmaun = 0;
	
		// Query the table rows using the correct selector
		var rows = document.querySelectorAll("table#itemtuntutan tbody tr");
	
		for (var i = 0; i < rows.length; i++) {
			var amaunCell = rows[i].querySelector("td#amaun");
			if (amaunCell) {
				var amaunText = amaunCell.textContent.trim();
				var amaunValue = parseFloat(amaunText) || 0;
				totalAmaun += amaunValue;
			}
		}
	
		var yuranInput = document.getElementById('amaun_yuran');
		// console.log(yuranInput);
		if (yuranInput !== null) {
			var yuran = parseFloat(yuranInput.value).toFixed(2);
		} else {
			// Set yuran to 0.00 if yuranInput is null
			var yuran = '0.00';
		}
		var total_yuran = (parseFloat(yuran) + parseFloat(totalAmaun)).toFixed(2);
		
	
		// Define the maximum limit for 'amaun_yuran'
		var baki_total = document.getElementById('baki_total');
		var maxLimit = parseFloat(baki_total.value);
		console.log(maxLimit);
	
		if (total_yuran > maxLimit) {
			yuranInput.value = '';
			Swal.fire({
				icon: 'error',
				title: 'Ralat',
				text: 'Amaun Yuran Pengajian dan Wang Saku tidak boleh melebihi RM' + maxLimit + ' / tahun kalendar akademik.',
			});

			return;
		}
	
		var total = (parseFloat(wang_saku) + parseFloat(totalAmaun)).toFixed(2);
	
		if (checkBox.checked == true) {
			if (total <= maxLimit) {
				document.getElementById("amaun_wang_saku").value= wang_saku.toFixed(2);
				var amaun_wang_saku = parseFloat(document.getElementById('amaun_wang_saku').value) || 0; 
				document.getElementById("jumlah").value = (amaun_wang_saku + totalAmaun).toFixed(2);
				console.log("Total amount is within the limit: " + parseFloat(total));
			} else {
				var baki_wang_saku = maxLimit - totalAmaun;
				if (!isNaN(baki_wang_saku)) {
					document.getElementById("amaun_wang_saku").value = parseFloat(baki_wang_saku).toFixed(2);
					console.log("Total amount exceeds the limit: " + parseFloat(total));
					var amaun_wang_saku = parseFloat(document.getElementById('amaun_wang_saku').value) || 0; 
					document.getElementById("jumlah").value = (baki_wang_saku + totalAmaun).toFixed(2);
				} else {
					document.getElementById("amaun_wang_saku").value = "";
					console.log("Invalid input. Cannot calculate total amount.");
				}
			}
			
		} else {
			document.getElementById("amaun_wang_saku").value = "";
			document.getElementById("jumlah").value = totalAmaun.toFixed(2);
		}
	}
	
	
	// Initialize a variable to store the total
	var totalAmaun = 0;
	
	// Query the table rows using the correct selector
	var rows = document.querySelectorAll("table#itemtuntutan tbody tr");
	
	for (var i = 0; i < rows.length; i++) {
		var amaunCell = rows[i].querySelector("td#amaun");
		if (amaunCell) {
			var amaunText = amaunCell.textContent.trim();
			var amaunValue = parseFloat(amaunText) || 0;
			totalAmaun += amaunValue;
		}
	}
	
	document.getElementById("jumlah").value = totalAmaun.toFixed(2);
	
	myFunction();
</script>

<script>
    $(document).ready(function () {
        $('#itemtuntutan tbody tr').on('dblclick', function () {
            // Handle double-click event here
            var rowData = $(this).find('td'); // Get the data from the clicked row
    		console.log('rowData:', rowData);

            // Extract data 
            var jenisValue = $(rowData[1]).text(); 
			var noresitValue = $(rowData[2]).text().trim();
            var notaresitValue = $(rowData[3]).text().trim(); 
            var amaunyuranValue = $(rowData[4]).text(); 

			var linkElement = $(rowData[2]).find('a');
        var hrefValue = linkElement.attr('href');

        // Assuming the <span> has an id of "fileNameDisplay"
        var fileNameDisplay = $('#fileNameDisplay');

        // Assuming the <div> has an id of "fileLinkContainer"
        var fileLinkContainer = $('#fileLinkContainer');

        // Create an anchor element dynamically
        var fileLink = $('<a>');

        // Set the href attribute to the file URL
        fileLink.attr('href', hrefValue);

        // Set the text content to the filename
        var fileName = hrefValue.split('/').pop(); // Assumes the file name is at the end of the URL
        fileLink.text(fileName);

        // Clear previous content in the container
        fileLinkContainer.empty();

        // Append the anchor element to the container
        fileLinkContainer.append(fileLink);

			
            // Set the selected options in the <select> elements
            $('#jenis_yuran').val(jenisValue);
            $('#no_resit').val(noresitValue);
            $('#nota_resit').val(notaresitValue);
            $('#amaun_yuran').val(amaunyuranValue);

			$('#jenis_yuran').trigger('change');
			$('#no_resit').trigger('change');
			$('#nota_resit').trigger('change');
			$('#amaun_yuran').trigger('change');
            // Show the form
            $('#dataForm').show();
        });

    });

</script>
</x-default-layout> 
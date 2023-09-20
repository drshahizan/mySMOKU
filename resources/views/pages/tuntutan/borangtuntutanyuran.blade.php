<x-default-layout> 
<head>
   <link rel="stylesheet" href="/assets/css/saringan.css">
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
   <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
   <script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
</head>
<!--begin::Content-->
<div id="kt_app_content" class="app-content flex-column-fluid">
	<!--begin::Content container-->
	<div id="kt_app_content_container" class="app-container container-xxl">
		<!--begin::Layout-->
		<!--MULA:: YURAN TUNTUTAN FORM & ELAUN WANG SAKU-->
		<div class="d-flex flex-column flex-lg-row">
			<!--begin::Content-->
			<div class="flex-lg-row-fluid mb-10 mb-lg-0 me-lg-7 me-xl-10">
				<!--begin::Card-->
				<div class="card">
					<!--begin::Card body-->
					<div class="card-body p-10">
						<!--begin::Form-->
						<form action="{{ route('simpan.tuntutan') }}" method="post" enctype="multipart/form-data">
							@csrf
							<!--begin::Wrapper-->
							<div class="d-flex flex-column align-items-start flex-xxl-row">
								<div class="d-flex flex-center flex-equal fw-row text-nowrap order-1 order-xxl-2 me-4" data-bs-toggle="tooltip" data-bs-trigger="hover">
									<span class="fs-3 fw-bold text-gray-800">Borang Tuntutan Yuran</span>
								</div>
							</div>
							<br>
							<!--begin::Wrapper-->
							<div class="mb-0">
								<!--begin::Row-->
								<div class="row gx-10 mb-5">
									<!--begin::Col-->
									<div class="col-lg-6">
										<label class="form-label fs-6 fw-bold text-gray-700 mb-3">Sesi Pengajian</label>
										<!--begin::Input group-->
										<div class="mb-5">
											<input type="text" name="sesi" class="form-control form-control-solid" placeholder="2023/2024" />
										</div>
									</div>
									<div class="col-lg-6">
										<label class="form-label fs-6 fw-bold text-gray-700 mb-3">Semester</label>
										<!--begin::Input group-->
										<div class="mb-5">
											<input type="text" name="semester" class="form-control form-control-solid" placeholder="2"  />
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
										<select id="jenis_yuran" name="jenis_yuran" class="form-select form-select-solid" data-control="select2" data-hide-search="true" data-placeholder="Pilih">
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
										<label class="form-label fs-6 fw-bold text-gray-700 mb-3">No resit/ invois</label>
										<!--begin::Input group-->
										<div class="mb-5">
											<input type="text" name="no_resit" class="form-control form-control-solid" placeholder=""  />
										</div>
									</div>
								</div>
								<div class="row gx-10 mb-5">
									<div class="col-lg-12">
										<label class="form-label fs-6 fw-bold text-gray-700 mb-3">Perihal</label>
										<div class="mb-5">
											<input type="text" name="nota_resit" class="form-control form-control-solid" placeholder="Yuran Pengajian Semester 1 2023/2024" />
										</div>
									</div>
								</div>
								<div class="row gx-10 mb-5">
									<div class="col-lg-12">
										<label class="form-label fs-6 fw-bold text-gray-700 mb-3">Jumlah Amaun</label>
										<!--begin::Input group-->
										<div class="mb-5">
											<input type="text" name="amaun_yuran" class="form-control form-control-solid" placeholder=""  />
										</div>
									</div>
								</div>
								<div class="row gx-10 mb-5">
									<div class="col-lg-12">
										<label class="form-label fs-6 fw-bold text-gray-700 mb-3">Salinan Resit/ Invois&nbsp;<a href="/assets/contoh/bank.pdf" target="_blank" data-bs-toggle="tooltip" title="CONTOH"><i class="fa-solid fa-circle-info"></i></a></label>
										<div class="input-group control-group img_div form-group col-md-11" >
											<input type="file" name="resit[]" />
											<br>
										</div>
									</div>
								</div>
								<br>
								<div class="d-flex flex-center mt-15">
									<button type="submit"  class="btn btn-primary">
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
			<!--begin::Sidebar-->
			<!--begin::Card-->
			<div class="card" data-kt-sticky="true" data-kt-sticky-name="invoice" data-kt-sticky-offset="{default: false, lg: '200px'}" data-kt-sticky-width="{lg: '250px', lg: '300px'}" data-kt-sticky-left="auto" data-kt-sticky-top="150px" data-kt-sticky-animation="false" data-kt-sticky-zindex="95">
				<!--begin::Card body-->
				<div class="card-body p-10">
					<!--begin::Input group-->
					<div class="mb-10">
						<!--begin::Label-->
						<label class="form-label fw-bold fs-4 text-700">Item Tuntutan</label>
						<br>
						<br>
						<div class="table-responsive" id="itemtuntutan">
							<table class="table table-rounded table-striped border gy-7 gs-7">
								<thead>
									<tr class="fw-semibold fs-6 text-gray-700 border-bottom border-gray-200">
										<th>Bil</th>
										<th>Jenis Yuran</th>
										<th>No. Resit</th>
										<th>Perihal</th>
										<th>Amaun</th>
									</tr>
								</thead>
								<tbody class="fw-semibold text-gray-600">
									@foreach ($tuntutan as $key => $tuntutan)
									<tr>
										<td>{{ $key + 1 }}.</td>
										<td>{{ $tuntutan->jenis_yuran}}</td>
										<td><a href="/assets/dokumen/tuntutan/{{$tuntutan->resit}}" target="_blank">{{ $tuntutan->no_resit}}</a></td>
										<td>{{ $tuntutan->nota_resit}}</td>
										<td id="amaun">RM {{ $tuntutan->amaun}}</td>
									</tr>
									@endforeach	
								</tbody>
							</table>
						</div>
					</div>
					<!--begin::Item-->
					<div class="d-flex flex-stack">
						<div class="me-5">
							<input id="wang_saku" name="wang_saku" onclick="myFunction()" type="checkbox" value="1" />
							<label class="form-label fw-bold fs-4 text-700">Elaun Wang Saku</label>
						</div>
					</div>
					<!--end::Item-->
					<br>
					<!--begin::Wrapper-->
					<div class="d-flex flex-stack flex-grow-1">
						<!--begin::Content-->
						<div class="fw-semibold">
							<div class="fs-6 text-dark">Jumlah Elaun Wang Saku </div>
						</div>
						<!--end::Content-->
					</div>
					<!--end::Wrapper-->
					<div class="d-flex">
						<span class="input-group-text">RM</span>
						<input type="text" id="amaun_wang_saku" name="amaun_wang_saku" class="input-group-text" style="width: 100%;">
					</div>
					<div class="fs-6 fw-semibold text-gray-400">
						Elaun wang saku akan bertukar mengikut kadar bayaran tuntutan yuran dalam satu sesi pengajian
					</div>
					<br>
					<br>
					<div class="d-flex flex-stack flex-grow-1">
						<!--begin::Content-->
						<div class="fw-semibold">
							<div class="fs-6 text-dark">Jumlah Keseluruhan Tuntutan</div>
						</div>
						<!--end::Content-->
					</div>
					<div class="d-flex">
						<span class="input-group-text">RM</span>
						<input type="text" id="jumlah" name="jumlah" class="input-group-text" style="width: 100%;"/>
					</div>
					<br>
					<br>
					<!--end::Actions-->
					<div class="d-flex justify-content-end">
						<a href="{{route('hantartuntutan')}}"><button type="submit"  class="btn btn-primary">
							Hantar
						</button></a>
					</div>
				</div>
				<!--end::Card body-->
			</div>
			<!--end::Card-->
			<!--end::Sidebar-->
		</div>
		<!--end::Layout-->
		<!--TUTUP:: YURAN TUNTUTAN FORM & ELAUN WANG SAKU-->
	</div>
	<br>
	<!-- MULA:: YURAN TUNTUTAN FORM SAHAJA-->
	<div id="kt_app_content_container" class="app-container container-xxl">
		<div class="d-flex flex-column flex-lg-row">
			<!--begin::Content-->
			<div class="flex-lg-row-fluid mb-10 mb-lg-0 me-lg-7 me-xl-10">
				<!--begin::Card-->
				<div class="card">
					<!--begin::Card body-->
					<div class="card-body p-10">
						<!--begin::Form-->
						<form action="{{ route('simpan.tuntutan') }}" method="post" enctype="multipart/form-data">
							@csrf
							<!--begin::Wrapper-->
							<div class="d-flex flex-column align-items-start flex-xxl-row">
								<!--begin::Input group-->
								<div class="d-flex flex-center flex-equal fw-row text-nowrap order-1 order-xxl-2 me-4" data-bs-toggle="tooltip" data-bs-trigger="hover">
									<span class="fs-3 fw-bold text-gray-800">Borang Tuntutan Yuran</span>
								</div>
							</div>
							<br>
							<!--begin::Wrapper-->
							<div class="mb-0">
								<!--begin::Row-->
								<div class="row gx-10 mb-5">
									<!--begin::Col-->
									<div class="col-lg-6">
										<label class="form-label fs-6 fw-bold text-gray-700 mb-3">Sesi Pengajian</label>
										<!--begin::Input group-->
										<div class="mb-5">
											<input type="text" name="sesi" class="form-control form-control-solid" placeholder="2023/2024" />
										</div>
									</div>
									<div class="col-lg-6">
										<label class="form-label fs-6 fw-bold text-gray-700 mb-3">Semester</label>
										<!--begin::Input group-->
										<div class="mb-5">
											<input type="text" name="semester" class="form-control form-control-solid" placeholder="2"  />
										</div>
									</div>
								</div>
								<div class="row gx-10 mb-5">
									<!--begin::Col-->
									<div class="col-lg-12">
										<label class="form-label fs-6 fw-bold text-gray-700 mb-3">Jenis Yuran</label>
										<!--begin::Input group-->
										<select id="jenis_yuran" name="jenis_yuran" class="form-select form-select-solid" data-control="select2" data-hide-search="true" data-placeholder="Pilih">
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
									</div>
								</div>
								<div class="row gx-10 mb-5">
									<div class="col-lg-12">
										<label class="form-label fs-6 fw-bold text-gray-700 mb-3">No resit/ invois</label>
										<!--begin::Input group-->
										<div class="mb-5">
											<input type="text" name="no_resit" class="form-control form-control-solid" placeholder=""  />
										</div>
									</div>
								</div>
								<div class="row gx-10 mb-5">
									<div class="col-lg-12">
										<label class="form-label fs-6 fw-bold text-gray-700 mb-3">Perihal</label>
										<div class="mb-5">
											<input type="text" name="nota_resit" class="form-control form-control-solid" placeholder="Yuran Pengajian Semester 1 2023/2024" />
										</div>
									</div>
								</div>
								<div class="row gx-10 mb-5">
									<div class="col-lg-12">
										<label class="form-label fs-6 fw-bold text-gray-700 mb-3">Jumlah Amaun</label>
										<!--begin::Input group-->
										<div class="mb-5">
											<input type="text" name="amaun_yuran" class="form-control form-control-solid" placeholder=""  />
										</div>
									</div>
								</div>
								<div class="row gx-10 mb-5">
									<div class="col-lg-12">
										<label class="form-label fs-6 fw-bold text-gray-700 mb-3">Salinan Resit/ Invois&nbsp;<a href="/assets/contoh/bank.pdf" target="_blank" data-bs-toggle="tooltip" title="CONTOH NYA MACAM NI"><i class="fa-solid fa-circle-info"></i></a></label>
										<div class="input-group control-group img_div form-group col-md-11" >
											<input type="file" name="resit[]" />
											<br>
										</div>
									</div>
								</div>
								<br>
								<br>
								<div class="d-flex flex-center mt-15">
									<button type="submit"  class="btn btn-primary">
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
			<!--begin::Sidebar-->
			<!--begin::Card-->
			<div class="card" data-kt-sticky="true" data-kt-sticky-name="invoice" data-kt-sticky-offset="{default: false, lg: '200px'}" data-kt-sticky-width="{lg: '250px', lg: '300px'}" data-kt-sticky-left="auto" data-kt-sticky-top="150px" data-kt-sticky-animation="false" data-kt-sticky-zindex="95">
				<!--begin::Card body-->
				<div class="card-body p-10">
					<!--begin::Input group-->
					<div class="mb-10">
						<!--begin::Label-->
						<label class="form-label fw-bold fs-4 text-gray-700">Item Tuntutan</label>
						<br>
						<br>
						<div class="table-responsive">
							<table class="table table-rounded table-striped border gy-7 gs-7" style="background-color:#FFFFE0;">
								<thead>
									<tr class="fw-semibold fs-6 text-gray-700 border-bottom border-gray-200">
										<th>Id Tuntutan</th>
										<th>Jenis Yuran</th>
										<th>No resit</th>
										<th>Perihal</th>
										<th>Amaun</th>
										<th>Salinan</th>
									</tr>
								</thead>
								<tbody class="fw-semibold text-gray-600">
									<tr>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
										<td>RM</td>
										<td><a href="" target="_blank">Papar</a></td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
					<div class="d-flex justify-content-end">
						<a href="{{route('hantartuntutan')}}"><button type="submit"  class="btn btn-primary">
							Hantar
						</button></a>
					</div>
				</div>
				<!--end::Card body-->
			</div>
			<!--end::Card-->
			<!--end::Sidebar-->
		</div>
	</div>
	<!--TUTUP:: YURAN TUNTUTAN FORM SAHAJA-->
</div>
<!--end::Content-->

<!--begin::Javascript-->
<script>var hostUrl = "assets/";</script>
<!--begin::Global Javascript Bundle(mandatory for all pages)-->
<script src="assets/plugins/global/plugins.bundle.js"></script>
<script src="assets/js/scripts.bundle.js"></script>
<!--end::Global Javascript Bundle-->
<!--begin::Vendors Javascript(used for this page only)-->
<script src="assets/plugins/custom/datatables/datatables.bundle.js"></script>
<!--end::Vendors Javascript-->
<!--begin::Custom Javascript(used for this page only)-->
<script src="assets/js/custom/apps/invoices/create.js"></script>
<script src="assets/js/widgets.bundle.js"></script>
<script src="assets/js/custom/widgets.js"></script>
<script src="assets/js/custom/apps/chat/chat.js"></script>
<script src="assets/js/custom/utilities/modals/upgrade-plan.js"></script>
<script src="assets/js/custom/utilities/modals/create-app.js"></script>
<script src="assets/js/custom/utilities/modals/users-search.js"></script>
<!--end::Custom Javascript-->
<!--end::Javascript-->


<script>
/*
function myFunction() {
	var checkBox = document.getElementById("wang_saku");	
	var bilbulan = document.getElementById('bil_bulan_per_sem').value; //nanti tambah bil_bulan_per_sem
	var layak = "300";
	var total = layak * bilbulan; //nanti tambah bil_bulan_per_sem
	if(checkBox.checked == true){
		document.getElementById("amaun_wang_saku").value= total;
	}
	else {
		document.getElementById("amaun_wang_saku").value="";
	}

}

// Initialize a variable to store the total
var totalAmaun = 0;

// Query the table rows using the correct selector
var rows = document.querySelectorAll("table.itemtuntutan tbody tr");

for (var i = 0; i < rows.length; i++) {
    var amaunCell = rows[i].querySelector("td#amaun");
    if (amaunCell) {
        var amaunText = amaunCell.textContent.trim();
        var amaunValue = parseFloat(amaunText.replace("RM", "")) || 0;
        totalAmaun += amaunValue;
    }
}



var amaun_yuran = parseFloat(document.getElementById('amaun').value) || 0; // Parse the value to a number, default to 0 if it's not a valid number
var amaun_wang_saku = parseFloat(document.getElementById('amaun_wang_saku').value) || 0; // Parse the value to a number, default to 0 if it's not a valid number
var jumlah = amaun_yuran + amaun_wang_saku;
document.getElementById("jumlah").textContent = "Total: RM" + totalAmaun.toFixed(2);
*/

</script>


</x-default-layout> 
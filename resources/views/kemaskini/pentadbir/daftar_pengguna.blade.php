<x-default-layout>
	<!--begin::Page title-->
	<div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
		<h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Daftar Pengguna</h1>
		<!--begin::Breadcrumb-->
		<ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
			<li class="breadcrumb-item text-dark" style="color:darkblue">Laman Utama</li>
			<li class="breadcrumb-item">
				<span class="bullet bg-gray-400 w-5px h-2px"></span>
			</li>
			<li class="breadcrumb-item text-dark" style="color:darkblue">Daftar Pengguna</li>
		</ul>
		<!--end::Breadcrumb-->
	</div>
	<!--end::Page title-->


    <br>
	<!--begin::Head-->
	<head>

		<!-- MAIN CSS -->
		<link rel="stylesheet" href="/assets/css/saringan.css">
		<!--begin::Vendor Stylesheets(used for this page only)-->
		<link href="/assets/plugins/custom/datatables/datatables.bundle.css" rel="stylesheet" type="text/css" />
		<!--end::Vendor Stylesheets-->
		<!--begin::Global Stylesheets Bundle(mandatory for all pages)-->
		<link href="/assets/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css" />
		<link href="/assets/css/style.bundle.css" rel="stylesheet" type="text/css" />
		<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

	</head>
	<!--end::Head-->
	<!--begin::Body-->
	<div class="card shadow-sm">
		<div class="table-responsive">
			<!--begin::Content-->
			<div id="kt_app_content" class="app-content flex-column-fluid">
				<!--begin::Content container-->
				<div id="kt_app_content_container" class="app-container container-xxl">
					<!--begin::Card header-->
					<div class="card-header border-0 pt-6">
						<!--begin::Card title-->
						<div class="card-title">
						</div>
						<!--begin::Card title-->
						<!--begin::Card toolbar-->
						<div class="card-toolbar">
							<!--begin::Toolbar-->
							<div class="d-flex justify-content-end" data-kt-customer-table-toolbar="base">
								<!--begin::Add customer-->
								<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#kt_modal_add_customer">Tambah Pengguna</button>
								<!--end::Add customer-->
							</div>
							<!--end::Toolbar-->
						</div>
						<!--end::Card toolbar-->
					</div>
					<!--end::Card header-->
					<!--begin::Card body-->
					<div class="card-body pt-0">
						<!--begin::Table-->
						<div class="table-responsive">
							<table id="sortTable1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th><b>Nama</b></th>                                        
                                            <th><b>No. Kad Pengenalan</b></th>
                                            <th><b>E-mel</b></th>
                                            <th><b>Peranan</b></th>
                                            <th><b>Tarikh Daftar</b></th>
                                            <th><b>Status</b></th>
                                            <th><b>Tindakan</b></th>
                                        </tr>
                                    </thead>
                                </table>
						</div>
						<!--end::Table-->
					</div>
					<!--end::Card body-->
					<!--begin::Modals-->
					<!--begin::Modal - Customers - Edit-->
					<div class="modal fade" id="editUserModal" tabindex="-1" aria-hidden="true">
						<div class="modal-dialog modal-dialog-centered mw-650px">
							<div class="modal-content">
								<div class="modal-header">
									<h2>Kemaskini Maklumat</h2>
									<div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
										<i class="ki-duotone ki-cross fs-1">
											<span class="path1"></span><span class="path2"></span>
										</i>
									</div>
								</div>
								<div class="modal-body scroll-y mx-5 mx-xl-15 my-7">
									<form id="editUserForm" method="POST" action="{{ route('daftarpengguna.post') }}">
										@csrf

										<input type="hidden" name="id_institusi" id="id_institusi">
										<div class="fv-row mb-7">
											<label class="fs-6 fw-semibold mb-2">Nama</label>
											<input type="text" class="form-control form-control-solid" name="nama" id="edit_nama">
										</div>

										<div class="fv-row mb-7">
											<label class="fs-6 fw-semibold mb-2">E-mel</label>
											<input type="email" class="form-control form-control-solid" name="email" id="edit_email">
										</div>

										<div class="fv-row mb-7">
											<label class="fs-6 fw-semibold mb-2">No. Kad Pengenalan</label>
											<input type="text" class="form-control form-control-solid" name="no_kp" id="edit_no_kp">
										</div>

										<div class="fv-row mb-7">
											<label class="fs-6 fw-semibold mb-2">Peranan</label>
											<select name="tahap" id="edit_tahap" class="form-select form-select-solid basic-search">
												@foreach($tahap as $t)
													<option value="{{ $t->id }}">{{ strtoupper($t->name) }}</option>
												@endforeach
											</select>
										</div>

										<!-- Institusi Field -->
										<div id="div_institusi" class="fv-row mb-7" style="display: none;">
											<label class="fs-6 fw-semibold mb-2">Nama Pusat Pengajian</label>
											<select name="edit_institusi_ipt" id="edit_institusi_ipt" data-placeholder="Pilih" class="form-select form-select-solid basic-search">
												@foreach($infoipt as $ipt)
													<option value="{{ $ipt->id_institusi }}">{{ strtoupper($ipt->nama_institusi) }}</option>
												@endforeach
											</select>
										</div>


										<div id="div_id_institusippk" class="fv-row mb-7" style="display: none;">
											<label class="fs-6 fw-semibold mb-2">Nama Pusat Pengajian</label>
											<select name="edit_institusi_ppk" id="edit_institusi_ppk" data-placeholder="Pilih" class="form-select form-select-solid basic-search">
												@foreach($infoppk as $item)
													<option value="{{ $item->id_institusi }}">{{ strtoupper($item->nama_institusi) }}</option>
												@endforeach
											</select>
										</div>

										<!-- Jawatan Field -->
										<div id="div_jawatan" class="fv-row mb-7" style="display: none;">
											<label class="fs-6 fw-semibold mb-2">Jawatan</label>
											<input type="text" name="jawatan" id="edit_jawatan" class="form-control form-control-solid">
										</div>

										<div class="fv-row mb-7">
											<label class="fs-6 fw-semibold mb-2">Status</label>
											<select name="status" id="edit_status" data-placeholder="Pilih" class="form-select form-select-solid basic-search">
												<option value="1">AKTIF</option>
												<option value="0">TIDAK AKTIF</option>
											</select>
										</div>

										<div class="text-center pt-15">
											<button type="submit" class="btn btn-primary">
												<span class="indicator-label">Simpan</span>
												<span class="indicator-progress">Sila tunggu...
													<span class="spinner-border spinner-border-sm align-middle ms-2"></span>
												</span>
											</button>
										</div>
									</form>
								</div>
							</div>
						</div>
					</div>
					<!--end::Modal - Customers - Edit-->
					<!--begin::Modal - Customers - Add-->
					<div class="modal fade" id="kt_modal_add_customer" tabindex="-1" aria-hidden="true">
						<!--begin::Modal dialog-->
						<div class="modal-dialog modal-dialog-centered mw-650px">
							<!--begin::Modal content-->
							<div class="modal-content">
								<!--begin::Form-->
								<form class="form" action="{{ route('daftarpengguna.post') }}" id="kt_modal_add_customer_form" method="post" data-kt-redirect="{{ route('daftarpengguna') }}">
									@csrf
									<!--begin::Modal header-->
									<div class="modal-header" id="kt_modal_add_customer_header">
										<!--begin::Modal title-->
										<h2 class="fw-bold">Tambah Pengguna</h2>
										<!--end::Modal title-->
										<!--begin::Close-->
										<div id="kt_modal_add_customer_close" class="btn btn-icon btn-sm btn-active-icon-primary">
											<i class="ki-duotone ki-cross fs-1">
												<span class="path1"></span>
												<span class="path2"></span>
											</i>
										</div>
										<!--end::Close-->
									</div>
									<!--end::Modal header-->
									<!--begin::Modal body-->
									<div class="modal-body py-10 px-lg-17">
										<!--begin::Scroll-->
										<div class="scroll-y me-n7 pe-7" id="kt_modal_add_customer_scroll" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_add_customer_header" data-kt-scroll-wrappers="#kt_modal_add_customer_scroll" data-kt-scroll-offset="300px">
											<!--begin::Input group-->
											<div class="fv-row mb-7">
												<!--begin::Label-->
												<label class="fs-6 fw-semibold mb-2">Nama</label>
												<!--end::Label-->
												<!--begin::Input-->
												<input type="text" class="form-control form-control-solid" placeholder="" name="nama" value="" oninput="this.value = this.value.toUpperCase()" />
												<!--end::Input-->
											</div>
											<!--end::Input group-->
											<!--begin::Input group-->
											<div class="fv-row mb-7">
												<!--begin::Label-->
												<label class="fs-6 fw-semibold mb-2">Emel</label>
												<!--end::Label-->
												<!--begin::Input-->
												<input type="email" class="form-control form-control-solid" placeholder="" name="email" value="" />
												<!--end::Input-->
											</div>
											<!--end::Input group-->
											<!--begin::Input group-->
											<div class="fv-row mb-7">
												<!--begin::Label-->
												<label class="fs-6 fw-semibold mb-2">No. Kad Pengenalan</label>
												<!--end::Label-->
												<!--begin::Input-->
												<input type="text" maxlength="12" class="form-control form-control-solid" placeholder="" name="no_kp" />
												<!--end::Input-->
											</div>
											<!--end::Input group-->
											<!--begin::Input group-->
											<div class="fv-row mb-7">
												<!--begin::Label-->
												<label class="fs-6 fw-semibold mb-2">Peranan</label>
												<!--end::Label-->
												<!--begin::Input-->
												<select name="tahap" id="pilihtahap" aria-label="Pilih" data-control="select2" data-placeholder="Pilih" data-dropdown-parent="#kt_modal_add_customer" class="form-select form-select-solid fw-bold">
													<option value="">Pilih</option>
													@foreach ($tahap as $tahap)
													<option value="{{$tahap->id}}">{{$tahap->name}}</option>
													@endforeach
													
												</select>
												<!--end::Input-->
											</div>
											<!--end::Input group-->
											<!-- Institusi Field -->
											<div id="div_institusi_ipt" class="fv-row mb-7" style="display: none;">
												<label class="fs-6 fw-semibold mb-2">Nama Pusat Pengajian</label>
												<select name="edit_institusi_ipt" id="institusi_ipt" data-placeholder="Pilih" class="form-select form-select-solid basic-search">
													<option value="">Pilih</option>
													@foreach($infoipt as $iptadd)
														<option value="{{ $iptadd->id_institusi }}">{{ strtoupper($iptadd->nama_institusi) }}</option>
													@endforeach
												</select>
											</div>


											<div id="div_institusi_ppk" class="fv-row mb-7" style="display: none;">
												<label class="fs-6 fw-semibold mb-2">Nama Pusat Pengajian</label>
												<select name="edit_institusi_ppk" id="institusi_ppk" data-placeholder="Pilih" class="form-select form-select-solid basic-search">
													<option value="">Pilih</option>
													@foreach($infoppk as $itemadd)
														<option value="{{ $itemadd->id_institusi }}">{{ strtoupper($itemadd->nama_institusi) }}</option>
													@endforeach
												</select>
											</div>

											<!-- Jawatan Field -->
											<div id="div_jawatan_add" class="fv-row mb-7" style="display: none;">
												<label class="fs-6 fw-semibold mb-2">Jawatan</label>
												<input type="text" name="jawatan" id="edit_jawatan" class="form-control form-control-solid">
											</div>
											
										</div>
										<!--end::Scroll-->
									</div>
									<!--end::Modal body-->
									<!--begin::Modal footer-->
									<div class="modal-footer flex-center">
										<!--begin::Button-->
										<button type="reset" id="kt_modal_add_customer_cancel" class="btn btn-light me-3">Batal</button>
										<!--end::Button-->
										<!--begin::Button-->
										<button type="submit" id="kt_modal_add_customer_submit" class="btn btn-primary">
											<span class="indicator-label">Hantar</span>
											<span class="indicator-progress">Tunggu sebentar...
											<span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
										</button>
										<!--end::Button-->
									</div>
									<!--end::Modal footer-->
								</form>
								<!--end::Form-->
							</div>
						</div>
					</div>
					<!--end::Modal - Customers - Add-->
				</div>
				<!--end::Content container-->
			</div>
			<!--end::Content-->
		</div>
	</div>

	<!--begin::Javascript-->
	{{-- <script>var hostUrl = "assets/";</script> --}}
	<!--begin::Global Javascript Bundle(mandatory for all pages)-->
	<script src="/assets/plugins/global/plugins.bundle.js"></script>
	<script src="/assets/js/scripts.bundle.js"></script>
	<!--end::Global Javascript Bundle-->
	<!--begin::Vendors Javascript(used for this page only)-->
	<script src="/assets/plugins/custom/datatables/datatables.bundle.js"></script>
	<!--end::Vendors Javascript-->
	<!--begin::Custom Javascript(used for this page only)-->
	<script src="/assets/js/custom/apps/customers/list/export.js"></script>
	<script src="/assets/js/custom/apps/customers/list/list.js"></script>
	<script src="/assets/js/custom/apps/customers/add.js"></script>
	<!--end::Custom Javascript-->


	<script>
    $(document).ready(function() {
		// Initialize Select2 untuk semua elemen dengan class .basic-search
		// For editUserModal
		$('#editUserModal .basic-search').select2({
			dropdownParent: $('#editUserModal')
		});

		// For kt_modal_add_customer
		$('#kt_modal_add_customer .basic-search').select2({
			dropdownParent: $('#kt_modal_add_customer')
		});
		$(document).on('select2:open', () => {
			let searchField = document.querySelector('.select2-container--open .select2-search__field');
			if (searchField) {
				searchField.focus();
			}
		});

		// DataTable initialization functions
		function initializeDataTable1() {
			$('#sortTable1').DataTable({
				ordering: true, // Enable manual sorting
					order: [], // Disable initial sorting
					columnDefs: [
						{ orderable: false, targets: [0] }
					],
				ajax: {
					url: '{{ route("pentadbir.getSenaraiPengguna") }}', // URL to fetch data from
					dataSrc: '' // Property in the response object containing the data array
				},
				language: {
					url: "/assets/lang/Malay.json"
				},
				columns: [ 
				{
					data: 'nama',
					render: function(data, type, row) {
						var conjunctions_lower = ['bin', 'binti'];
						var conjunctions_upper = ['A/L', 'A/P'];

						var words = data.split(' ');

						for (var i = 0; i < words.length; i++) {
							var word = words[i];

							// Handle words starting with a single quote
							if (word.startsWith("'")) {
								// Capitalize the character after the quote
								words[i] = "'" + word.charAt(1).toUpperCase() + word.slice(2).toLowerCase();
							} 
							else if (conjunctions_lower.includes(word.toLowerCase())) {
								words[i] = word.toLowerCase();
							} 
							else if (conjunctions_upper.includes(word.toUpperCase())) {
								words[i] = word.toUpperCase();
							} 
							else {
								words[i] = word.charAt(0).toUpperCase() + word.slice(1).toLowerCase();
							}
						}

						return words.join(' ');
					}
				},
				{ data: 'no_kp' }, 
				
				{ data: 'email' }, 
				{ data: 'peranan' },
				{ 
					data: 'created_at',
					render: function(data, type, row) {
						if (type === 'display' || type === 'filter') {
							if (!data) return ' '; // handle null, undefined, or empty string

							var date = new Date(data);
							if (isNaN(date.getTime())) return ' '; // handle invalid dates

							// Get the year, month, and day components
							var year = date.getFullYear();
							var month = ('0' + (date.getMonth() + 1)).slice(-2); // Add leading zero if needed
							var day = ('0' + date.getDate()).slice(-2); // Add leading zero if needed

							// Return the formatted date as YYYY/MM/DD
							return day + '/' + month + '/' + year;
						} else {
							// For sorting and other purposes, return the original data
							return data;
						}
					}

				},
				{
					data: 'status',
					render: function (data, type, row) {
						if (parseInt(data) === 1) {
							return '<div class="badge badge-light-success fw-bold">Aktif</div>';
						} else {
							return '<div class="badge badge-light-danger fw-bold">Tidak Aktif</div>';
						}
					},
					className: 'text-center'
				},
				{
					data: 'no_kp',
					render: function (data, type, row) {
						return `
							<button class="btn btn-icon btn-active-light-primary w-30px h-30px me-3"
									title="Kemaskini Profil"
									onclick='openEditModal(${JSON.stringify(row)})'>
								<i class="ki-solid ki-pencil text-dark fs-2"></i>
							</button>
						`;
					},
					orderable: false,
					searchable: false,
					className: 'text-center'
				}
				]
			});
		}

		initializeDataTable1(); // Initialize DataTable1 on page load

    });
    </script>

	<script>
		function openEditModal(user) {
			// console.log("user.status =", user.status, typeof user.status);
			document.getElementById('edit_no_kp').value = user.no_kp;
			document.getElementById('edit_nama').value = user.nama;
			document.getElementById('edit_email').value = user.email;
			document.getElementById('edit_tahap').value = user.tahap;
			document.getElementById('id_institusi').value = user.institusi;
			document.getElementById('edit_status').value = user.status;
			document.getElementById('edit_jawatan').value = user.jawatan ?? '';

			// Reset selects
			$('#edit_institusi_ipt').val('').trigger('change');
			$('#edit_institusi_ppk').val('').trigger('change');
			$('#edit_status').val(user.status).trigger('change');

			// Set institusi value if exists
			if (user.tahap == 2 && user.institusi) {
				$('#edit_institusi_ipt').val(user.institusi).trigger('change');
			} else if (user.tahap == 6 && user.institusi) {
				$('#edit_institusi_ppk').val(user.institusi).trigger('change');
			}

			// Apply visibility logic
			updateVisibility(user.tahap);

			// Trigger tahap change
    		$('#edit_tahap').trigger('change');

			const modal = new bootstrap.Modal(document.getElementById('editUserModal'));
			modal.show();
		}

		function updateVisibility(tahap) {
			const divInstitusi = document.getElementById('div_institusi');
			const divInstitusiPPK = document.getElementById('div_id_institusippk');
			const divJawatan = document.getElementById('div_jawatan');

			// Hide all first
			divInstitusi.style.display = 'none';
			divInstitusiPPK.style.display = 'none';
			divJawatan.style.display = 'none';

			switch (parseInt(tahap)) {
				case 2:
					divInstitusi.style.display = 'block';
					divJawatan.style.display = 'block';
					break;
				case 6:
					divInstitusiPPK.style.display = 'block';
					divJawatan.style.display = 'block';
					break;
				case 3:
				case 4:
				case 5:
					divJawatan.style.display = 'block';
					break;
			}
		}

		document.getElementById('edit_tahap').addEventListener('change', function () {
			updateVisibility(this.value);
		});
	</script>

	<script>
		$(document).ready(function () {
			$('#pilihtahap').on('change', function () {
				let selectedValue = $(this).val();
				console.log("User tahap:", selectedValue);

				// Always show jawatan for 2, 3, or 6
				if (selectedValue === '2') {
					$("#div_jawatan_add").show();

					$('#div_institusi_ipt').show();
					$('#institusi_ipt').prop('required', true);

					$('#div_institusi_ppk').hide();
					$('#institusi_ppk').prop('required', false);

				} else if (selectedValue === '6') {
					$("#div_jawatan_add").show();

					$('#div_institusi_ppk').show();
					$('#institusi_ppk').prop('required', true);

					$('#div_institusi_ipt').hide();
					$('#institusi_ipt').prop('required', false);

				} else if (selectedValue === '3') {
					$("#div_jawatan_add").show();

					$('#div_institusi_ipt').hide();
					$('#institusi_ipt').prop('required', false);

					$('#div_institusi_ppk').hide();
					$('#institusi_ppk').prop('required', false);

				} else {
					// Hide all optional sections
					$("#div_jawatan_add").hide();

					$('#div_institusi_ipt').hide();
					$('#institusi_ipt').prop('required', false);

					$('#div_institusi_ppk').hide();
					$('#institusi_ppk').prop('required', false);
				}
			});
		});

	</script>

	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
	<script>
		// Check if there is a flash message
		@if(session('message'))
			Swal.fire({
				icon: 'success',
				title: 'Berjaya!',
				text: ' {!! session('message') !!}',
				confirmButtonText: 'OK'
			});
		@endif

		// Check if there is a flash message
		@if(session('tidak'))
			Swal.fire({
				icon: 'error',
				title: 'Tidak Aktif!',
				text: ' {!! session('tidak') !!}',
				confirmButtonText: 'OK'
			});
		@endif	
	</script>
</x-default-layout>
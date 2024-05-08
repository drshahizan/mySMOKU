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
							<table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_customers_table">
								<thead>
									<tr class="text-start text-gray-400 fw-bold fs-7 gs-0">
										<th class="min-w-125px">Nama</th>
										<th class="min-w-125px">No. Kad Pengenalan</th>
										<th class="min-w-125px">Emel</th>
										<th class="min-w-125px">Peranan</th>
										<th class="min-w-125px">Tarikh Daftar</th>
										<th class="w-10px pe-2">Status</th>
										<th class="w-10px pe-2">Tindakan</th>
									</tr>
								</thead>
								<tbody class="fw-semibold text-gray-600">
									@foreach ($user as $user)
									@php

										$text = ucwords(strtolower($user->nama)); // Assuming you're sending the text as a POST parameter
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
										$nama_user = implode(' ', $result);
									@endphp
									<tr>
										<td>{{ $nama_user}}</td>
										<td>{{ $user->no_kp}}</td>
										<td>{{ $user->email}}</td>
										<td>{{ $user->name}}</td>
										<td>{{$user->created_at->format('d/m/Y h:i:sa')}}</td>
										<td>
											@if($user->status == 1)
											<div class="badge badge-light-success fw-bold">Aktif</div>
											@else
											<div class="badge badge-light-danger fw-bold">Tidak Aktif</div>
											@endif
										</td>
										<td>

											<!--begin::Toolbar-->
											<div class="d-flex">
												<!--begin::Edit-->
												<a href="#" class="btn btn-icon btn-active-light-primary w-30px h-30px me-3" data-bs-toggle="modal" data-bs-target="#kt_modal_new_card{{$user->no_kp}}">
													<span data-bs-toggle="tooltip" data-bs-trigger="hover" title="Kemaskini">
														<i class="ki-duotone bi bi-pencil fs-3"></i>
													</span>
												</a>
												<!--end::Edit-->
											</div>
											<!--end::Toolbar-->

										</td>
										<!--begin::Modal - Customers - Edit-->
											<div class="modal fade" id="kt_modal_new_card{{$user->no_kp}}" tabindex="-1" aria-hidden="true">
												<!--begin::Modal dialog-->
												<div class="modal-dialog modal-dialog-centered mw-650px">
													<!--begin::Modal content-->
													<div class="modal-content">
														<!--begin::Modal header-->
														<div class="modal-header">
															<!--begin::Modal title-->
															<h2>Kemaskini Maklumat</h2>
															<!--end::Modal title-->
															<!--begin::Close-->
															<div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
																<i class="ki-duotone ki-cross fs-1">
																	<span class="path1"></span>
																	<span class="path2"></span>
																</i>
															</div>
															<!--end::Close-->
														</div>
														<!--end::Modal header-->
														<!--begin::Modal body-->
														<div class="modal-body scroll-y mx-5 mx-xl-15 my-7">
															<!--begin::Form-->
															<form class="form" id="kt_modal_new_card_form" action="{{ route('daftarpengguna.post') }}" method="post">
																@csrf
																<!--begin::Scroll-->

																<div class="scroll-y me-n7 pe-7" id="kt_modal_add_customer_scroll" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_add_customer_header" data-kt-scroll-wrappers="#kt_modal_add_customer_scroll" data-kt-scroll-offset="300px">
																	<!--begin::Input group-->
																	<div class="fv-row mb-7">
																		<!--begin::Label-->
																		<label class="fs-6 fw-semibold mb-2">Nama</label>
																		<!--end::Label-->
																		<!--begin::Input-->
																		<input type="text" class="form-control form-control-solid" placeholder="" name="nama" value="{{$user->nama}}" />
																		<!--end::Input-->
																	</div>
																	<!--end::Input group-->
																	<!--begin::Input group-->
																	<div class="fv-row mb-7">
																		<!--begin::Label-->
																		<label class="fs-6 fw-semibold mb-2">Emel</label>
																		<!--end::Label-->
																		<!--begin::Input-->
																		<input type="email" class="form-control form-control-solid" placeholder="" name="email" value="{{$user->email}}" />
																		<!--end::Input-->
																	</div>
																	<!--end::Input group-->
																	<!--begin::Input group-->
																	<div class="fv-row mb-7">
																		<!--begin::Label-->
																		<label class="fs-6 fw-semibold mb-2">No. Kad Pengenalan</label>
																		<!--end::Label-->
																		<!--begin::Input-->
																		<input type="text" maxlength="12" class="form-control form-control-solid" placeholder="" name="no_kp" value="{{$user->no_kp}}"/>
																		<!--end::Input-->
																	</div>
																	<!--end::Input group-->
																	<!--begin::Input group-->
																	<div class="fv-row mb-7">
																		<!--begin::Label-->
																		<label class="fs-6 fw-semibold mb-2">Peranan</label>
																		<!--end::Label-->
																		<!--begin::Input-->
																		<select name="tahap" id="tahap" class="form-select form-select-solid" data-placeholder="Pilih">
																			@foreach($tahap as $tahap1)
																				<option value="{{ $tahap1->id }}" {{$user->tahap == $tahap1->id  ? 'selected' : ''}}>{{ strtoupper($tahap1->name)}}</option>
																			@endforeach
																		</select>
																		<!--end::Input-->
																	</div>
																	<!--end::Input group-->

																	@if ($user->tahap =='2' || $user->tahap =='6')
																	<!--begin::Input group-->
																	<div class="fv-row mb-7" id="div_ipt">
																		<!--begin::Label-->
																		<label class="fs-6 fw-semibold mb-2">Nama Pusat Pengajian</label>
																		<!--end::Label-->
																		<!--begin::Input-->
																		<select name="id_institusi" id="id_institusi" class="form-select form-select-solid js-example-basic-single" data-placeholder="Pilih">
																			@foreach ($infoipt as $infoipt2)
																			<option value="{{ $infoipt2->id_institusi}}" {{$user->id_institusi == $infoipt2->id_institusi ? 'selected' : ''}}>{{ strtoupper($infoipt2->nama_institusi)}}</option>
																			@endforeach
																		</select>
																		<!--end::Input-->
																	</div>
																	<!--end::Input group-->
																	@endif
																	

																	@if ($user->tahap !='1')
																	<!--begin::Input group-->
																	<div class="fv-row mb-7">
																		<!--begin::Label-->
																		<label class="fs-6 fw-semibold mb-2">Jawatan</label>
																		<!--end::Label-->
																		<!--begin::Input-->
																		<input type="text" class="form-control form-control-solid" placeholder="" name="jawatan" value="{{$user->jawatan}}" />
																		<!--end::Input-->
																	</div>
																	<!--end::Input group-->
																	@endif

																	<!--begin::Input group-->
																	<div class="fv-row mb-7">
																		<!--begin::Label-->
																		<label class="fs-6 fw-semibold mb-2">Status</label>
																		<!--end::Label-->
																		<!--begin::Input-->
																		<select name="status" id="status" class="form-select form-select-solid"  data-placeholder="Pilih">
																			<option value="1" {{$user->status == 1  ? 'selected' : ''}}>AKTIF</option>
																			<option value="0" {{$user->status == 0  ? 'selected' : ''}}>TIDAK AKTIF</option>
																		</select>
																		<!--end::Input-->
																	</div>
																	<!--end::Input group-->


																</div>
																<!--end::Scroll-->

																<!--begin::Actions-->
																<div class="text-center pt-15">
																	<button type="submit" id="kt_modal_new_card_submit" class="btn btn-primary">
																		<span class="indicator-label">Simpan</span>
																		<span class="indicator-progress">Sila tunggu...
																		<span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
																	</button>
																</div>
																<!--end::Actions-->
															</form>
															<!--end::Form-->
														</div>
														<!--end::Modal body-->
													</div>
													<!--end::Modal content-->
												</div>
												<!--end::Modal dialog-->
											</div>
										<!--end::Modal - Customers - Edit-->
									</tr>
									@endforeach
								</tbody>
							</table>
						</div>
						<!--end::Table-->
					</div>
					<!--end::Card body-->
					<!--begin::Modals-->
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
												<input type="text" class="form-control form-control-solid" placeholder="" name="nama" value="" />
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
											<!--begin::Input group-->
											<div class="fv-row mb-7" id="div_id_institusi">
												<!--begin::Label-->
												<label class="fs-6 fw-semibold mb-2">Nama Pusat Pengajian</label>
												<!--end::Label-->
												<!--begin::Input-->
												<select name="id_institusibkoku" id="id_institusibkoku" aria-label="Pilih" data-control="select2" data-placeholder="Pilih" data-dropdown-parent="#kt_modal_add_customer" class="form-select form-select-solid fw-bold">
													<option value="">Pilih</option>
													@foreach ($infoipt as $infoipt1)
														<option value="{{ $infoipt1->id_institusi}}">{{ $infoipt1->nama_institusi}}</option>
													@endforeach
												</select>
												<!--end::Input-->
											</div>
											<!--end::Input group-->
											<!--begin::Input group-->
											<div class="fv-row mb-7" id="div_id_institusippk">
												<!--begin::Label-->
												<label class="fs-6 fw-semibold mb-2">Nama Pusat Pengajian</label>
												<!--end::Label-->
												<!--begin::Input-->
												<select name="id_institusippk" id="id_institusippk" aria-label="Pilih" data-control="select2" data-placeholder="Pilih" data-dropdown-parent="#kt_modal_add_customer" class="form-select form-select-solid fw-bold">
													<option value="">Pilih</option>
													@foreach ($infoppk as $infoppk)
														<option value="{{$infoppk->id_institusi}}">{{ $infoppk->nama_institusi}}</option>
													@endforeach
												</select>
												<!--end::Input-->
											</div>
											<!--end::Input group-->
											<!--begin::Input group-->
											<div class="fv-row mb-7" id="div_jawatan">
												<!--begin::Label-->
												<label class="fs-6 fw-semibold mb-2">Jawatan</label>
												<!--end::Label-->
												<!--begin::Input-->
												<input type="text" class="form-control form-control-solid" placeholder="" name="jawatan" value="" />
												<!--end::Input-->
											</div>
											<!--end::Input group-->
											<!--begin::Input group-->
											{{-- <div class="fv-row mb-7">
												<!--begin::Label-->
												<label class="fs-6 fw-semibold mb-2">Kata Laluan</label>
												<!--end::Label-->
												<!--begin::Input-->
												<div class="fv-row mb-8" data-kt-password-meter="true">
													<!--begin::Wrapper-->
													<div class="mb-1">
														<!--begin::Input wrapper-->
														<div class="position-relative mb-3">
															<input min="12" class="form-control bg-transparent" type="password" placeholder="Katalaluan" name="password" autocomplete="off"/>
	
															<span class="btn btn-sm btn-icon position-absolute translate-middle top-50 end-0 me-n2" data-kt-password-meter-control="visibility">
																<i class="bi bi-eye-slash fs-2"></i>
																<i class="bi bi-eye fs-2 d-none"></i>
															</span>
														</div>
														<!--end::Input wrapper-->
	
														<!--begin::Meter-->
														<div class="d-flex align-items-center mb-3" data-kt-password-meter-control="highlight">
															<div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
															<div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
															<div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
															<div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px"></div>
														</div>
														<!--end::Meter-->
													</div>
													<!--end::Wrapper-->
	
													<!--begin::Hint-->
													<div class="text-muted">
														Gunakan 12 atau lebih aksara dengan gabungan huruf, nombor & simbol.
													</div>
													<!--end::Hint-->
												</div>
												<!--end::Input-->
											</div> --}}
											<!--end::Input group-->
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
				</div>
				<!--end::Content container-->
			</div>
			<!--end::Content-->
		</div>
	</div>

	<!--begin::Javascript-->
	<script>var hostUrl = "assets/";</script>
	<!--begin::Global Javascript Bundle(mandatory for all pages)-->
	<script src="/assets/plugins/global/plugins.bundle.js"></script>
	<script src="/assets/js/scripts.bundle.js"></script>
	<!--end::Global Javascript Bundle-->
	<!--begin::Vendors Javascript(used for this page only)-->
	<script src="/assets/plugins/custom/datatables/datatables.bundle.js"></script>
	<script src="/assets/lang/Malay.json"></script>
	<!--end::Vendors Javascript-->
	<!--begin::Custom Javascript(used for this page only)-->
	<script src="/assets/js/custom/apps/customers/list/export.js"></script>
	<script src="/assets/js/custom/apps/customers/list/list.js"></script>
	<script src="/assets/js/custom/apps/customers/add.js"></script>
	<!--end::Custom Javascript-->
	<!--end::Javascript-->
	<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
	<script>
	
		$(document).ready(function() {
			// Destroy existing DataTable instance
			$('#kt_customers_table').DataTable().destroy();
			$('#kt_customers_table').DataTable({
				ordering: true, // Enable manual sorting
				order: [], // Disable initial sorting
				language: {
					url: "assets/lang/Malay.json" // Adjust the path accordingly
				}
			});
		});
	</script>
	
	<script>
		$(document).ready(function() {
			$('.js-example-basic-single').select2();
			});
		// $(document).ready(function(){
			console.log("Document is ready!");
			$('#tahap').on('change', function() {
			if ( this.value == '2'){
				$("#div_ipt").show();
			}
			else {
				$("#div_ipt").hide();
			}
			});
		// });
	</script>

	<script>
		$(document).ready(function(){
			$('#pilihtahap').on('change', function() {
				if (this.value == '2') {
					$("#div_id_institusi").show();
					$("#div_id_institusippk").hide();
				} else if (this.value == '6') {
					$("#div_id_institusi").hide();
					$("#div_id_institusippk").show();
				} else if (this.value == '1') {
					$("#div_jawatan").hide();
					$("#div_id_institusi").hide();
					$("#div_id_institusippk").hide();
				} else {
					$("#div_id_institusi").hide();
					$("#div_id_institusippk").hide();
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
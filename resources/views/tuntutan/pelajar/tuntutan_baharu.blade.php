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
			
			<!--begin::Sidebar-->
			<div class="flex-lg-auto min-w-lg-450px">
				<!--begin::Card-->
				<div class="card">
					<!--begin::Card body-->
					<div class="card-body p-10">
						<!--begin::Form-->
						<form action="{{ route('hantar.tuntutan') }}" method="post" enctype="multipart/form-data">
						@csrf
							<!--begin::Item-->
							<div class="d-flex flex-column align-items-start flex-xxl-row">
								<div class="d-flex flex-center flex-equal fw-row text-nowrap order-1 order-xxl-2 me-4" data-bs-toggle="tooltip" data-bs-trigger="hover">
									<span class="fs-3 fw-bold text-gray-800">Borang Tuntutan</span>
								</div>
							</div>
							<div class="separator separator-dashed my-5"></div>
							<div class="mb-6">
								<div class="fw-bold mb-4">Maklumat Akademik</div>
								<div class="row gx-10 gy-4">
									<div class="col-lg-6">
										<div class="fw-semibold text-gray-600">Nama Institusi</div>
										<div class="text-gray-800">
											{{ $akademik->nama_institusi ?? '-' }}
										</div>
									</div>
									<div class="col-lg-6">
										<div class="fw-semibold text-gray-600">Peringkat Pengajian</div>
										<div class="text-gray-800">
											{{ $akademik?->peringkat?->peringkat ?? $akademik->peringkat_pengajian ?? '-' }}
										</div>
									</div>
									<div class="col-lg-6">
										<div class="fw-semibold text-gray-600">Tarikh Mula</div>
										<div class="text-gray-800">
											{{ $akademik?->tarikh_mula ? \Carbon\Carbon::parse($akademik->tarikh_mula)->format('d/m/Y') : '-' }}
										</div>
									</div>
									<div class="col-lg-6">
										<div class="fw-semibold text-gray-600">Nama Kursus</div>
										<div class="text-gray-800">
											{{ $akademik->nama_kursus ?? '-' }}
										</div>
									</div>
									<div class="col-lg-6">
										<div class="fw-semibold text-gray-600">Tarikh Tamat</div>
										<div class="text-gray-800">
											{{ $akademik?->tarikh_tamat ? \Carbon\Carbon::parse($akademik->tarikh_tamat)->format('d/m/Y') : '-' }}
										</div>
									</div>
								</div>
							</div>
							<div class="separator separator-dashed my-5"></div>
							<div class="row gx-10 mb-5">
								<!--begin::Col-->
								<div class="col-lg-6">
									<label class="form-label fs-6 fw-bold text-gray-700 mb-3">Tahun Pengajian</label>
									<div class="mb-5">
										@php
											$year = date('Y'); 
											$nextYear = $year + 1; 
											$sesiSemasa = $year . '/' . $nextYear; 
										@endphp

										<select id="sesi" name="sesi"  
											class="form-select form-select-solid" 
											data-control="select2" 
											data-hide-search="true" 
											data-placeholder="Pilih" 
											required 
											oninvalid="this.setCustomValidity('Sila pilih tahun pengajian.')" 
											oninput="setCustomValidity('')">

											<option></option>
											@for ($i = -1; $i <= 1; $i++) 
												@php 
													$start = $year + $i; 
													$end = $start + 1; 
													$sesi = $start . '/' . $end; 
												@endphp
												<option value="{{ $sesi }}" {{ $tuntutan?->sesi == $sesi ? 'selected' : '' }}>
													{{ $sesi }}
												</option>
											@endfor
										</select>

									</div>

								</div>
								<div class="col-lg-6">
									<label class="form-label fs-6 fw-bold text-gray-700 mb-3">Sesi</label>
									<!--begin::Input group-->
									<div class="mb-5">
										<select id="semester" name="semester"  class="form-select form-select-solid" data-control="select2" data-hide-search="true" data-placeholder="Pilih" required oninvalid="this.setCustomValidity('Sila pilih sesi.')" oninput="setCustomValidity('')">
											<option></option>
											<option value="1" {{ $tuntutan?->semester == 1 ? 'selected' : '' }}>Sesi 1 (Kemasukan Julai sehingga Disember)</option>
											<option value="2" {{ $tuntutan?->semester == 2 ? 'selected' : '' }}>Sesi 2 (Kemasukan Januari sehingga Jun)</option>
										</select>
									</div>
								</div>
								<!--end::Col-->
							</div>
							<div class="row gx-10 mb-5">
								<div class="col-lg-6">
									<input class="form-check-input" type="checkbox" value="1" id="wang_saku" name="wang_saku" checked disabled/>
									<label class="fs-6 fw-semibold form-label">
										Tuntut Elaun Wang Saku
									</label>
								</div>
							</div>
							<br>

							<div class="row gx-10 mb-5">
								<label class="fs-6 fw-semibold mb-2">Amaun Wang Saku</label>
								<div class="d-flex">
									<span class="input-group-text">RM</span>
									<input type="number" name="amaun_wang_saku" class="form-control form-control-solid"
										value="{{ number_format($amaun->jumlah, 2, '.', '') }}" step="0.01" readonly/>
								</div>
							</div>
							
							<br>
							<br>
							<!--end::Actions-->
							<div class="d-flex justify-content-end">
								<button 
									type="submit" 
									id="submitButton" 
									class="btn {{ ($tuntutan && $tuntutan->status == 5) ? 'btn-danger' : 'btn-primary' }}"
									{{ ($tuntutan && $tuntutan->status == 2) ? 'disabled' : '' }}>
									
									{{ ($tuntutan && $tuntutan->status == 5) ? 'Hantar Semula' : (($tuntutan && $tuntutan->status == 2) ? 'Tuntutan Telah Dihantar' : 'Hantar') }}
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
<script>

</script>


</x-default-layout> 

<x-default-layout> 
<head>
	<link rel="stylesheet" href="/assets/css/saringan.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
	<script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js"></script>
</head>
<!--begin::Content-->
<div id="kt_app_content" class="app-content flex-column-fluid">
	<!--begin::Content container-->
	<div id="kt_app_content_container" class="app-container container-xxl">
		<!--begin::Layout-->
		<div class="d-flex flex-column flex-lg-row">
			<!--begin::Content-->
			<div class="flex-lg-row-fluid mb-10 mb-lg-0 me-lg-7 me-xl-10">
				<!--begin::Card-->
				<div class="card">
					<!--begin::Card body-->
					<div class="card-body p-12">
						<!--begin::Form-->
						<form action="{{ route('bkoku.keputusan.hantar',$smoku_id) }}" method="post" enctype="multipart/form-data">
							@csrf
							<div class="d-flex flex-column align-items-start flex-xxl-row">
								<div class="d-flex flex-center flex-equal fw-row text-nowrap order-1 order-xxl-2 me-4" data-bs-toggle="tooltip" data-bs-trigger="hover">
									<span class="fs-3 fw-bold text-gray-800">Keputusan Peperiksaan</span>
								</div>
							</div>
							<br>
							<!--begin::Wrapper-->
							<div class="mb-0">
								<!--begin::Row-->
								<div class="row gx-10 mb-5">
									<div class="col-lg-12">
										<label class="form-label fs-6 fw-bold text-gray-700 mb-3">Nama</label>
										<!--begin::Input group-->
										<div class="mb-5">
											<input type="text" id="nama" name="nama" value="{{ $smoku?->nama }}" class="form-control form-control-solid" placeholder="" oninput="setCustomValidity('')" readonly/>
										</div>
									</div>
								</div>
								<div class="row gx-10 mb-5">
									<div class="col-lg-12">
										<label class="form-label fs-6 fw-bold text-gray-700 mb-3">No. Kad Pengenalan</label>
										<!--begin::Input group-->
										<div class="mb-5">
											<input type="text" id="no_kp" name="no_kp" value="{{ $smoku?->no_kp }}" class="form-control form-control-solid" placeholder="" oninput="setCustomValidity('')" readonly/>
										</div>
									</div>
								</div>
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
													<option value="{{ $sesi }}" {{ $previousSesi == $sesi ? 'selected' : '' }}>
														{{ $sesi }}
													</option>
												@endfor
											</select>

										</div>
									</div>
									<div class="col-lg-6">
										<label class="form-label fs-6 fw-bold text-gray-700 mb-3">Sesi</label>
										<div class="mb-5">
											<select id="semester" name="semester"  class="form-select form-select-solid" data-control="select2" data-hide-search="true" data-placeholder="Pilih" required oninvalid="this.setCustomValidity('Sila pilih sesi.')" oninput="setCustomValidity('')">
												<option></option>
												<option value="1" {{ $sesiLepas == '1' ? 'selected' : '' }}>Sesi 1 (Kemasukan Julai sehingga Disember)</option>
												<option value="2" {{ $sesiLepas == '2' ? 'selected' : '' }}>Sesi 2 (Kemasukan Januari sehingga Jun)</option>
											</select>
										</div>
									</div>
									<!--end::Col-->
								</div>
								<!--end::Row-->
								<!--begin::Row-->
								<div class="row gx-10 mb-5">
									<div class="col-lg-6">
										<label class="form-label fs-6 fw-bold text-gray-700 mb-3">
											Salinan Keputusan Peperiksaan&nbsp;
											<a href="/assets/contoh/invois.pdf" target="_blank" data-bs-toggle="tooltip" title="Papar contoh">
												<i class="fa-solid fa-circle-info" style="color: rgb(18, 178, 231);"></i>
											</a>
										</label>
										<div class="mb-5">
											<input type="file" id="kepPeperiksaan" name="kepPeperiksaan"/>
										</div>
									</div>

									<div class="col-lg-6">
										<!-- PILIHAN -->
										<div>
											<label>
												<input type="radio" name="choice" value="pointer" required oninvalid="this.setCustomValidity('Sila pilih salah satu.')" oninput="setCustomValidity('')"> CGPA
											</label>
											<label>
												<input type="radio" name="choice" value="penyelidikan" required oninvalid="this.setCustomValidity('Sila pilih salah satu.')" oninput="setCustomValidity('')"> Penyelidikan
											</label>
										</div>
										<!-- CGPA -->
										<div id="cgpa-input" class="mb-5" style="display:none;">
											<label class="fs-6 fw-semibold form-label mb-2">
												<i class="fa-solid fa-circle-info text-info"></i>
											</label>
											<input
												type="number"
												class="form-control form-control-solid"
												step="0.01"
												max="4.00"
												pattern="^[0-4](\.\d{1,2})?$"
												name="cgpa"
												oninvalid="this.setCustomValidity('Sila isi CGPA.')"
												oninput="this.setCustomValidity('')">
										</div>
										<!-- PENYELIDIKAN -->
										<div id="penyelidikan-input" class="mb-5" style="display:none;">
											<select
												class="form-select form-control-solid"
												name="cgpa"
												oninvalid="this.setCustomValidity('Sila pilih.')"
												oninput="this.setCustomValidity('')">
												<option value="" disabled selected>Sila pilih</option>
												<option value="LULUS">Lulus</option>
												<option value="TIDAK LULUS">Tidak Lulus</option>
											</select>
										</div>
									</div>
								</div>

								<!--end::Row-->
								{{-- NOTES --}}
								<div>
									<div class="text-dark fw-semibold fs-6"><i class='fas fa-exclamation-triangle' style='color:orange; font-size:15px;'></i>&nbsp;
										Gunakan kemudahan <a href="https://compressjpeg.com/" target="_blank">di sini</a> untuk mengurangkan saiz fail sebelum memuat naik fail.</a>
									</div>
				
									<div class="text-dark fw-semibold fs-6"><i class='fas fa-info-circle' style="color: rgb(18, 178, 231);"></i>&nbsp; 
										Format fail yang boleh dimuat naik adalah format '.pdf', '.jpg', '.png', dan '.jpeg'.
									</div>
				
									<div class="text-dark fw-semibold fs-6"><i class='fas fa-info-circle' style="color: rgb(18, 178, 231);"></i>&nbsp; 
										Saiz maksimum fail adalah 2 MB.
									</div>
								</div>
								<!--begin::Action-->
								{{-- @if(!$result) --}}
								<div class="d-flex flex-center mt-15">
									<button id="submitButton" type="submit"  class="btn btn-primary">
										Simpan
									</button>
								</div>
								{{-- @else
									<div class="alert alert-warning mt-15" role="alert" style="color: black;">
										Keputusan peperiksaan lepas sudah dikemaskini.
									</div>
								@endif --}}
								<!--end::Action-->
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
			<div class="flex-lg-auto min-w-lg-450px">
				<!--begin::Card-->
				<div class="card">
					<!--begin::Card body-->
					<div class="card-body p-10">
						<!--begin::Input group-->
						<div class="mb-10">
							<!--begin::Label-->
							<label class="fs-3 fw-bold text-gray-800">Keputusan Peperiksaan.</label>
							<br>
							<br>
							<div class="table-responsive">
								<table id="sortTable" class="table table-striped table-hover dataTable js-exportable">
									<thead>
										<tr class="fw-semibold fs-6 text-gray-800 border-bottom border-gray-200">
											<th>Tahun</th>
											<th>Sesi</th>
											<th>Keputusan (CGPA)</th>
											<th>Salinan</th>
											<th class="text-center"></th>
										</tr>
									</thead>
									<tbody class="fw-semibold text-gray-600">
										@foreach ($peperiksaan as $peperiksaan)
										<tr>
											<td>{{ $peperiksaan->sesi}}</td>
											<td>{{ $peperiksaan->semester}}</td>
											<td>{{ $peperiksaan->cgpa}}</td>
											<td>
												@if ($peperiksaan->kepPeperiksaan)
													<a href="{{ asset('assets/dokumen/peperiksaan/' . $peperiksaan->kepPeperiksaan) }}" target="_blank">Papar</a>
												@else
													-
												@endif
											</td>
											<td class="text-center">
												<a href="{{ route('bkoku.keputusan.delete', ['id' => $peperiksaan->id]) }}" onclick="return confirm('Adakah anda pasti ingin padam keputusan ini?')">
													<span data-bs-toggle="tooltip" data-bs-trigger="hover" title="Padam">
														<i class="fa fa-trash fa-sm custom-white-icon"></i>
													</span>
												</a>
											</td>
										</tr>
										@endforeach	
									</tbody>
								</table>
							</div>
						</div>
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
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
  $(document).ready(function() {
    const cgpaInput = $('#cgpa-input');
    const penyelidikanInput = $('#penyelidikan-input');
    const submitButton = $('#submitButton');
    const cgpaField = cgpaInput.find('input');
    const penyelidikanField = penyelidikanInput.find('select');

    $('input[name="choice"]').on('change', function () {
		if (this.value === 'pointer') {
			// Show CGPA, hide Penyelidikan
			cgpaInput.show();
			penyelidikanInput.hide();
			penyelidikanField.val('');

			// Enable + name cgpa (so it will submit)
			cgpaField.prop('disabled', false).prop('required', true).attr('name', 'cgpa');

			// Disable + remove name (so it won't submit)
			penyelidikanField.prop('disabled', true).prop('required', false).removeAttr('name').val('');

		} else if (this.value === 'penyelidikan') {
			// Show Penyelidikan, hide CGPA
			penyelidikanInput.show();
			cgpaInput.hide();
			cgpaField.val('');

			// Enable + name cgpa (so it will submit)
			penyelidikanField.prop('disabled', false).prop('required', true).attr('name', 'cgpa');

			// Disable + remove name (so it won't submit)
			cgpaField.prop('disabled', true).prop('required', false).removeAttr('name').val('');
		}

		// Clear radio validity
		$('input[name="choice"]').each(function () {
			this.setCustomValidity('');
		});
	});

    cgpaField.on('change', function() {
        const cgpa = parseFloat($(this).val());
        if (cgpa >= 0.0 && cgpa < 2.0) {
            Swal.fire({
                icon: 'warning',
                title: 'Pengesahan Keputusan Peperiksaan!',
                text: 'PNG pelajar bawah 2.00. Sila klik butang "Hantar Pengesahan" untuk pengesahan daripada sekretariat KPT.',
                confirmButtonText: 'OK'
            }).then((result) => {
                if (result.isConfirmed) {
                    $('#submitButton').text('Hantar Pengesahan');
                }
            });
        } else {
            submitButton.text('Hantar');
        }
    });
});

</script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script>
	@if(session('success'))
		Swal.fire({
			icon: 'success',
			title: 'Berjaya!',
			text: ' {!! session('success') !!}',
			confirmButtonText: 'OK'
		});
	@endif
	@if(session('error'))
		Swal.fire({
			icon: 'warning',
			title: 'Peringatan!',
			text: ' {!! session('error') !!}',
			confirmButtonText: 'OK'
		});
	@endif
</script>
<!--end::Javascript-->


</x-default-layout> 
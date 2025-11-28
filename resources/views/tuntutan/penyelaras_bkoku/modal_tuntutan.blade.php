<!-- resources/views/bkoku/modal_tuntutan.blade.php -->
<div class="modal fade" id="kt_modal_tuntutan{{ $layak->smoku_id }}" tabindex="-1" aria-hidden="true">
    
	<div class="modal-dialog modal-dialog-centered mw-650px">
        <div class="modal-content">
            <div class="modal-header">
                <h2>Tuntutan Elaun Wang Saku</h2>
                <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                    <i class="ki-duotone ki-cross fs-1">
                        <span class="path1"></span>
                        <span class="path2"></span>
                    </i>
                </div>
            </div>

			<!--//comment-->
			{{-- <div class="p-3 mb-3 border rounded bg-light">
				<h6 class="fw-bold mb-2">Maklumat Pengajian:</h6>

				@foreach ($nextSemesterDates as $data)
					<div>
						Date: {{ $data['date'] ?? '-' }},
						Semester: {{ $data['semester'] ?? '-' }},
						Tahun: {{ $data['sesi'] ?? '-' }},
						Sesi: {{ $data['sesi_bulan'] ?? '-' }}
					</div>
				@endforeach
			</div>
			<div class="p-3 text-start">
				<p><b>Tahun Lepas:</b> {{ $previousSesi ?? 'Tiada' }}</p>
				<p><b>Tahun Semasa:</b> {{ $currentSesi ?? 'Tiada' }}</p>
				<p><b>Sesi Lepas:</b> {{ $sesiLepas ?? 'Tiada' }}</p>
				<p><b>Sesi Semasa:</b> {{ $sesiSemasa ?? 'Tiada' }}</p>
				<p><b>Semester Semasa:</b> {{ $semSemasa ?? 'Tiada' }}</p>
			</div> --}}
			<!--//comment-->
            <div class="modal-body scroll-y mx-5 mx-xl-15 my-7">
                <form id="dataForm" 
                      action="{{ route('bkoku.hantar.tuntutan',$layak->smoku_id) }}" 
                      method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="scroll-y me-n7 pe-7">
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
                    </div>

                    <div class="text-center pt-15">
                        <button type="submit" class="btn btn-primary">
                            <span class="indicator-label">Hantar</span>
                            <span class="indicator-progress">
                                Sila tunggu... 
                                <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                            </span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<script>
document.addEventListener('DOMContentLoaded', function () {
    const modals = document.querySelectorAll('.modal');

    modals.forEach(modal => {
        modal.addEventListener('hidden.bs.modal', function () {
            const form = modal.querySelector('form');
            if (form) {
                form.reset();
                // Clear Select2 dropdowns
                const select2s = form.querySelectorAll('[data-control="select2"]');
                select2s.forEach(select => {
                    $(select).val(null).trigger('change');
                });
            }
        });
    });
});
</script>

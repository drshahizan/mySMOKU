<x-default-layout> 
	<head>
		<link rel="stylesheet" href="/assets/css/saringan.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
		<script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
		<script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js"></script>
	</head>

	<body>
		<!--begin::Content-->
		<div id="kt_app_content" class="app-content flex-column-fluid">
			<!--begin::Content container-->
			<div id="kt_app_content_container" class="app-container container-xl" style="width:80%">
				<!--begin::Layout-->
				<div class="d-flex flex-column flex-lg-row">
					<!--begin::Content-->
					<div class="flex-lg-row-fluid mb-10 mb-lg-0 me-lg-7 me-xl-10">
						<!--begin::Card-->
						<div class="card">
							<!--begin::Card body-->
							<div class="card-body p-10">
								<!--begin::Form-->
								<form action="{{ route('hantar.tamat.pengajian') }}" method="post" enctype="multipart/form-data" id="tamatPengajianForm">
									@csrf
									<!--begin::Wrapper-->
									<div class="d-flex flex-column align-items-start flex-xl-row">
										<!--begin::Input group-->
										<div class="d-flex flex-center flex-equal fw-row text-nowrap order-1 order-xl-2 me-4" data-bs-toggle="tooltip" data-bs-trigger="hover">
											<span class="fs-3 fw-bold text-gray-800">Lapor Tamat Pengajian</span>
										</div>
									</div>
									<!--end::Top-->
								
									<table class="table table-bordered table-striped">
										<thead>
											<tr>
												<th colspan="2" class="text-center">Dokumen Lampiran Tamat Pengajian</th>
											</tr>
										</thead>
								
										<tbody>
											{{-- SIJIL TAMAT / SENAT --}}
											<tr>
												<td style="width: 45% !important;">
													Sijil Tamat Pengajian / Surat Senat&nbsp;
													<a href="/assets/contoh/senat.pdf" target="_blank" data-bs-toggle="tooltip" title="Papar Contoh"><i class="fa-solid fa-circle-info" style="color: rgb(18, 178, 231);"></i></a>
												</td>
												<td>
													<input type="file" id="sijilTamat" name="sijilTamat[]" required accept=".pdf, .jpg, .png, .jpeg" oninvalid="this.setCustomValidity('Sila muat naik fail.')" oninput="setCustomValidity('')">
													@if($uploadedSijilTamat)
														@foreach($uploadedSijilTamat as $sijil)
															<a href="{{ asset('assets/dokumen/sijil_tamat/' . $sijil) }}" target="_blank">{{ $sijil}}</a>
														@endforeach
													@endif
												</td>
											</tr>

											{{-- TRANSKRIP --}}
											<tr>
												<td style="width: 45% !important;">
													Salinan Transkrip &nbsp;
													<a href="/assets/contoh/transkrip.pdf" target="_blank" data-bs-toggle="tooltip" title="Papar Contoh"><i class="fa-solid fa-circle-info" style="color: rgb(18, 178, 231);"></i></a>
												</td>
												
												<td>
													<input type="file" id="transkrip" name="transkrip[]" required accept=".pdf, .jpg, .png, .jpeg" oninvalid="this.setCustomValidity('Sila muat naik fail.')" oninput="setCustomValidity('')">
													@if($uploadedTranskrip)
														@foreach($uploadedTranskrip as $transkrip)
															<a href="{{ asset('assets/dokumen/salinan_transkrip/' . $transkrip) }}" target="_blank">{{ $transkrip }}</a>
														@endforeach
													@endif
												</td>
											</tr>

											{{-- CGPA --}}
											<tr>
												<td style="width: 45% !important;">
													PNGK&nbsp;
													<span data-bs-toggle="tooltip" data-bs-trigger="hover" title="Purata Nilai Gred Kumulatif">
														<i class="fa-solid fa-circle-info" style="color: rgb(18, 178, 231);"></i>
													</span>
												</td>
												
												<td style="width: 55% !important;">
													<!--begin::Input-->
													<input id="cgpa" type="number" name="cgpa" class="form-control form-control-solid" step="0.01" max="4.00" pattern="^[0-4](\.\d{1,2})?$" placeholder="3.50" required oninvalid="this.setCustomValidity('Sila isi.')" oninput="setCustomValidity('')" value="{{ $cgpa }}"/>
													<!--end::Input-->
												</td>
											</tr>

											{{-- Kelas --}}
											<tr>
												<td style="width: 45% !important;">
													Kelas Penganugerahan
												</td>
												<td style="width: 55% !important;">
													<!--begin::Input-->
													<select id="kelas" name="kelas" class="form-select form-select-solid" data-control="select2" data-hide-search="true" data-placeholder="PILIH" required oninvalid="this.setCustomValidity('Sila pilih.')" oninput="setCustomValidity('')">
														<option></option>
														@foreach ($kelas as $kelas)
															<option value="{{$kelas->id}}" {{$kelas_p == $kelas->id ? 'selected' : ''}}>{{ $kelas->kelas}}</option>
														@endforeach
													</select>
													<!--end::Input-->
												</td>
											</tr>
											{{-- NOTES --}}
											<tr>
												<td colspan="2">
													<div class="text-dark fw-semibold fs-6"><i class='fas fa-exclamation-triangle' style='color:orange; font-size:15px;'></i>&nbsp;
														Gunakan kemudahan <a href="https://compressjpeg.com/" target="_blank">di sini</a> untuk mengurangkan saiz fail sebelum memuat naik fail.</a>
													</div>
								
													<div class="text-dark fw-semibold fs-6"><i class='fas fa-info-circle' style="color: rgb(18, 178, 231);"></i>&nbsp; 
														Format fail yang boleh dimuat naik adalah format '.pdf', '.jpg', '.png', dan '.jpeg'.
													</div>
								
													<div class="text-dark fw-semibold fs-6"><i class='fas fa-info-circle' style="color: rgb(18, 178, 231);"></i>&nbsp; 
														Saiz maksimum fail adalah 2 MB.
													</div>
												</td>
											</tr>
										</tbody>

										{{-- MAKLUMAT PEKERJAAN --}}
										<thead>
											<tr>
												<th colspan="2" class="text-center">Maklumat Pekerjaan Terkini</th>
											</tr>
										</thead>
								
										<tbody>
											{{-- Status --}}
											<tr>
												<td style="width: 45% !important;">
													Status Pekerjaan
												</td>
												<td style="width: 55% !important;">
													<!--begin::Input-->
													<select id="status_pekerjaan" name="status_pekerjaan" class="form-select form-select-solid" data-control="select2" data-hide-search="true" data-placeholder="PILIH" >
														<option></option>
														<option value="TIDAK BEKERJA" {{$status_pekerjaan == "TIDAK BEKERJA" ? 'selected' : ''}}>TIDAK BEKERJA</option>
														<option value="BEKERJA" {{$status_pekerjaan == "BEKERJA" ? 'selected' : ''}}>BEKERJA</option>
													</select>
													<!--end::Input-->
												</td>
											</tr>

											{{-- Sektor --}}
											<tr id="div_sektor">
												<td style="width: 45% !important;">
													Sektor Pekerjaan
												</td>
												<td style="width: 55% !important;">
													<!--begin::Input-->
													<select id="sektor" name="sektor" class="form-select form-select-solid" data-control="select2" data-hide-search="true" data-placeholder="PILIH" >
														<option></option>
														<option value="KERAJAAN" {{$sektor == "KERAJAAN" ? 'selected' : ''}}>KERAJAAN</option>
														<option value="SWASTA" {{$sektor == "SWASTA" ? 'selected' : ''}}>SWASTA</option>
													</select>
													<!--end::Input-->
												</td>
											</tr>
								
											{{-- Pekerjaan --}}
											<tr id="div_pekerjaan">
												<td style="width: 45% !important;">
													Pekerjaan
												</td>
												
												<td style="width: 55% !important;">
													<!--begin::Input-->
													<input type="text" class="form-control form-control-solid" id="pekerjaan" name="pekerjaan" style="text-transform: uppercase;" placeholder="Polis" value="{{ $pekerjaan }}" />
													<!--end::Input-->
												</td>
											</tr>

											{{-- Pendapatan --}}
											<tr id="div_pendapatan">
												<td style="width: 45% !important;">
													Pendapatan&nbsp;
													<span data-bs-toggle="tooltip" data-bs-trigger="hover" title="Nilai tanpa .00">
														<i class="fa-solid fa-circle-info" style="color: rgb(18, 178, 231);"></i>
													</span>
												</td>
												
												<td style="width: 55% !important;">
													<!--begin::Input-->
													<div class="d-flex">
														<span class="input-group-text">RM</span>
														<input type="number" class="form-control form-control-solid" id="pendapatan" name="pendapatan" placeholder="2500" value="{{ $pendapatan }}" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="5"/>
													</div>
													<!--end::Input-->
												</td>
											</tr>
										</tbody>
								
										<thead>
											<tr>
												<th colspan="2" class="text-center">Perakuan Pelajar</th>
											</tr>
										</thead>
										<tbody>
											<tr>
												<td colspan="2" style="text-align: justify;">
													<input type="checkbox" value="1" id="perakuan" name="perakuan" @if($perakuan) checked @endif required oninvalid="this.setCustomValidity('Sila tandakan kotak ini jika anda ingin teruskan.')" oninput="setCustomValidity('')"/>
													Saya mengaku bahawa maklumat dan dokumen yang disertakan adalah betul dan benar dan bertanggungjawab ke atas maklumat dan dokumen tersebut. 
													Saya memahami bahawa saya boleh dikenakan tindakan sekiranya mana-mana maklumat dan/atau dokumen yang disertakan adalah tidak benar.
												</td>											
											</tr>
										</tbody>
									</table>
								
									<div class="d-flex flex-center mt-10">
										<button type="submit" class="btn btn-primary btn-sm">
											Simpan
										</button>
									</div>
								</form>							
								<!--end::Form-->
							</div>
							<!--end::Card body-->
						</div>
						<!--end::Card-->
					</div>
					<!--end::Content-->
				</div>
				<!--end::Layout-->
			</div>
			<!--end::Content container-->
		</div>
		<!--end::Content-->

		<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
		<script>
			//BEKERJA
			$(document).ready(function(){
				var status_pekerjaan = document.getElementById('status_pekerjaan').value;
				if ( status_pekerjaan == "BEKERJA"){
					$("#div_sektor").show();
					$("#div_pekerjaan").show();
					$("#div_pendapatan").show();
				}
				else{
					$("#div_sektor").hide();
					$("#div_pekerjaan").hide();
					$("#div_pendapatan").hide();
				}
				
				$('#status_pekerjaan').on('change', function() {
				if ( this.value == "BEKERJA"){
					$("#div_sektor").show();
					$("#div_pekerjaan").show();
					$("#div_pendapatan").show();
				}
				else {
					$("#div_sektor").hide();
					$("#div_pekerjaan").hide();
					$("#div_pendapatan").hide();
				}
				});

			});
		</script>
		<script>
			// Submit the form using JavaScript
			function submitForm() {
				document.getElementById('tamatPengajianForm').submit();
			}
		
			@if(session('success'))
				Swal.fire({
					icon: 'success',
					title: 'Berjaya!',
					text: ' {!! session('success') !!}',
					confirmButtonText: 'OK'
				});
			@endif

			// Display SweetAlert error message
			@if ($errors->any())
				Swal.fire({
					icon: 'error',
					title: 'Tidak Berjaya! Sila semak format dan saiz fail yang dimuat naik.',
					text: ' {!! session('failed') !!}',
					confirmButtonText: 'OK'
				});
			@endif
		</script>
	</body>
</x-default-layout> 
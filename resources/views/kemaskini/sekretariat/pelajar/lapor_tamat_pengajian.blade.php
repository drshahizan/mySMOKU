<x-default-layout> 
	<head>
		{{-- <link rel="stylesheet" href="/assets/css/saringan.css"> --}}
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
		<script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
		<script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js"></script>
	</head>

	<body>
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
								<form action="{{ route('kemaskini.sekretariat.hantar.tamat.pengajian', $smoku->id) }}" method="post" enctype="multipart/form-data" id="tamatPengajianForm">
									@csrf
									<!--begin::Wrapper-->
									<div class="d-flex flex-column align-items-start flex-xl-row">
										<!--begin::Input group-->
										<div class="d-flex flex-center flex-equal fw-row text-nowrap order-1 order-xl-2 me-4" data-bs-toggle="tooltip" data-bs-trigger="hover">
											<span class="fs-3 fw-bold text-gray-800">Lapor Tamat Pengajian</span>
										</div>
									</div>
									<!--end::Top-->
									<div class="table-responsive">
										<table class="table table-bordered table-striped">
											{{-- MAKLUMAT PELAJAR--}}
											<thead>
												<tr>
													<th colspan="2" class="text-center">Maklumat Pelajar</th>
												</tr>
											</thead>
									
											<tbody>
												{{-- Nama --}}
												<tr>
													<td>
														Nama Pelajar
													</td>
													
													<td>
														<!--begin::Input-->
														<input id="nama_pelajar" type="text" name="nama_pelajar" class="form-control form-control-solid" placeholder="Nama Pelajar" readonly value="{{ $smoku->nama }}"/>
														<!--end::Input-->
													</td>
												</tr>

												{{-- No Kad Pengenalan --}}
												<tr>
													<td>
														No. Kad Pengenalan
													</td>
													<td>
														<!--begin::Input-->
														<input id="no_kp" type="text" name="no_kp" class="form-control form-control-solid" placeholder="No. Kad Pengenalan" readonly value="{{ $smoku->no_kp }}"/>
														<!--end::Input-->
													</td>
												</tr>
												{{-- NOTES --}}
												<tr>
													<td colspan="2">
														
													</td>
												</tr>
											</tbody>
											
											{{-- MAKLUMAT TAMAT PENGAJIAN--}}
											<thead>
												<tr>
													<th colspan="2" class="text-center">Maklumat Tamat Pengajian</th>
												</tr>
											</thead>
									
											<tbody>
												{{-- SIJIL TAMAT / SENAT --}}
												<tr>
													<td>
														Sijil Tamat Pengajian / Surat Senat&nbsp;
														<a href="/assets/contoh/senat.pdf" target="_blank" data-bs-toggle="tooltip" title="Papar Contoh">
															<i class="fa-solid fa-circle-info" style="color: rgb(18, 178, 231);"></i>
														</a>
													</td>
													<td>
														{{-- File Input (hidden if file already uploaded) --}}
														<input 
															type="file" 
															id="sijilTamat" 
															name="sijilTamat[]" 
															accept=".pdf, .jpg, .png, .jpeg"
															@if(empty($uploadedSijilTamat)) required @endif
															oninvalid="this.setCustomValidity('Sila muat naik fail.')"
															oninput="setCustomValidity('')"
															@if(!empty($uploadedSijilTamat)) style="display: none;" @endif
														>

														{{-- Show existing uploaded files --}}
														@if(!empty($uploadedSijilTamat))
															@foreach($uploadedSijilTamat as $sijil)
																<br><a href="{{ asset('assets/dokumen/sijil_tamat/' . $sijil) }}" target="_blank">{{ $sijil }}</a>
															@endforeach
															<br>
															<small class="text-muted">Fail telah dimuat naik. Muat naik semula hanya jika ingin menggantikan.</small>

															{{-- Optional: Show a "Replace File" button to toggle file input --}}
															<br>
															<button type="button" onclick="document.getElementById('sijilTamat').style.display = 'inline'; this.style.display = 'none';">
																Muat Naik Semula
															</button>
														@endif
													</td>

												</tr>

												{{-- TRANSKRIP --}}
												<tr>
													<td>
														Salinan Transkrip&nbsp;
														<a href="/assets/contoh/transkrip.pdf" target="_blank" data-bs-toggle="tooltip" title="Papar Contoh">
															<i class="fa-solid fa-circle-info" style="color: rgb(18, 178, 231);"></i>
														</a>
													</td>
													<td>
														{{-- File Input: hide if file uploaded --}}
														<input 
															type="file" 
															id="transkrip" 
															name="transkrip[]" 
															accept=".pdf, .jpg, .png, .jpeg"
															@if(empty($uploadedTranskrip)) required @endif
															oninvalid="this.setCustomValidity('Sila muat naik fail.')"
															oninput="setCustomValidity('')"
															@if(!empty($uploadedTranskrip)) style="display: none;" @endif
														>

														{{-- Show uploaded files --}}
														@if(!empty($uploadedTranskrip))
															@foreach($uploadedTranskrip as $transkrip)
																<br><a href="{{ asset('assets/dokumen/salinan_transkrip/' . $transkrip) }}" target="_blank">{{ $transkrip }}</a>
															@endforeach
															<br>
															<small class="text-muted">Fail telah dimuat naik. Muat naik semula hanya jika ingin menggantikan.</small>

															{{-- Optional: Replace button --}}
															<br>
															<button type="button" onclick="document.getElementById('transkrip').style.display = 'inline'; this.style.display = 'none';">
																Muat Naik Semula
															</button>
														@endif
													</td>

												</tr>

												{{-- CGPA --}}
												<tr>
													<td>
														PNGK&nbsp;
														<span data-bs-toggle="tooltip" data-bs-trigger="hover" title="Purata Nilai Gred Kumulatif">
															<i class="fa-solid fa-circle-info" style="color: rgb(18, 178, 231);"></i>
														</span>
													</td>
													
													<td>
														<!--begin::Input-->
														<input id="cgpa" type="number" name="cgpa" class="form-control form-control-solid" step="0.01" max="4.00" pattern="^[0-4](\.\d{1,2})?$" placeholder="3.50" required oninvalid="this.setCustomValidity('Sila isi.')" oninput="setCustomValidity('')" value="{{ $cgpa }}"/>
														<!--end::Input-->
													</td>
												</tr>

												{{-- Kelas --}}
												<tr>
													<td>
														Kelas Penganugerahan
													</td>
													<td>
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
													<td>
														Status Pekerjaan
													</td>
													<td>
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
													<td>
														Sektor Pekerjaan
													</td>
													<td>
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
													<td>
														Pekerjaan
													</td>
													
													<td>
														<!--begin::Input-->
														<input type="text" class="form-control form-control-solid" id="pekerjaan" name="pekerjaan" style="text-transform: uppercase;" placeholder="Polis" value="{{ $pekerjaan }}" />
														<!--end::Input-->
													</td>
												</tr>

												{{-- Pendapatan --}}
												<tr id="div_pendapatan">
													<td>
														Pendapatan&nbsp;
														<span data-bs-toggle="tooltip" data-bs-trigger="hover" title="Nilai tanpa .00">
															<i class="fa-solid fa-circle-info" style="color: rgb(18, 178, 231);"></i>
														</span>
													</td>
													
													<td>
														<!--begin::Input-->
														<div class="d-flex">
															<span class="input-group-text">RM</span>
															<input type="number" class="form-control form-control-solid" id="pendapatan" name="pendapatan" placeholder="2500" value="{{ $pendapatan }}" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="5"/>
														</div>
														<!--end::Input-->
													</td>
												</tr>

												{{-- NOTES --}}
												<tr>
													<td colspan="2">
														
													</td>
												</tr>
											</tbody>

											<br>

											{{-- PERMOHONAN BAHARU --}}
											<thead>
												<tr>
													<th colspan="2" class="text-center">Maklumat Permohonan Pengajian Baharu</th>
												</tr>
											</thead>
									
											<tbody>
												{{-- TAWARAN --}}
												<tr>
													<td style="width: 45% !important;">
														Salinan Surat Tawaran Pengajian&nbsp;
														<a href="/assets/contoh/tawaran.pdf" target="_blank" data-bs-toggle="tooltip" title="Papar Contoh">
															<i class="fa-solid fa-circle-info" style="color: rgb(18, 178, 231);"></i>
														</a>
													</td>
													<td>
														{{-- Hide file input if file is already uploaded --}}
														<input 
															type="file" 
															id="tawaran" 
															name="tawaran[]" 
															accept=".pdf, .jpg, .png, .jpeg"
															oninvalid="this.setCustomValidity('Sila muat naik fail.')"
															oninput="setCustomValidity('')"
															@if(!empty($uploadedTawaran)) style="display: none;" @endif
														>

														{{-- Display uploaded files --}}
														@if(!empty($uploadedTawaran))
															@foreach($uploadedTawaran as $tawaran)
																<br><a href="{{ asset('assets/dokumen/permohonan/' . $tawaran) }}" target="_blank">{{ $tawaran }}</a>
															@endforeach
															<br>
															<small class="text-muted">Fail telah dimuat naik. Muat naik semula hanya jika ingin menggantikan.</small>

															{{-- Show button to re-enable input --}}
															<br>
															<button type="button" onclick="document.getElementById('tawaran').style.display = 'inline'; this.style.display = 'none';">
																Muat Naik Semula
															</button>
														@endif
													</td>

												</tr>


												{{-- Institusi --}}
												<tr>
													<td>
														Nama Institusi Pengajian
													</td>
													<td>
														<!--begin::Input-->
														<select id="id_institusi" name="id_institusi" class="form-select form-select-lg form-select-solid basic-search" data-control="select2" data-hide-search="true" data-placeholder="PILIH">
															<option></option>
															@foreach($ipt as $item)
																<option value="{{ $item->id_institusi }}" 
																	{{ ($tamat_pengajian->institusi ?? '') == $item->id_institusi ? 'selected' : '' }}>
																	{{ strtoupper($item->nama_institusi) }}
																</option>
															@endforeach

														</select>
													<!--end::Input-->
													</td>

												</tr>

												{{-- Peringkat --}}
												<tr>
													<td>
														Peringkat Pengajian
													</td>
													<td>
														<!--begin::Input-->
														<input type="hidden" class="form-control form-control-solid" placeholder="" id="peringkat" name="peringkat" value="{{ $tamat_pengajian->peringkat ?? '' }}" />
														<select id="peringkat_pengajian" name="peringkat_pengajian" class="form-select form-select-lg form-select-solid basic-search"  data-control="select2" data-hide-search="true" data-placeholder="PILIH">
															<option></option>
														</select>
														<!--end::Input-->
													</td>
												</tr>

												{{-- Kursus --}}
												<tr>
													<td>
														Nama Kursus
													</td>
													<td>
														<!--begin::Input-->
														<input type="hidden" id="nama_kursus_asal" value="{{ $tamat_pengajian->kursus ?? '' }}">
														<select id='nama_kursus' name='nama_kursus' class="form-select form-select-lg form-select-solid basic-search"  data-control="select2" data-hide-search="true" data-placeholder="PILIH">
															<option></option>
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
									</div>
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
		<style>
			.select2-container {
				width: 100% !important;
				max-width: 600px;
			}
		</style>

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
        	$(document).ready(function () {
				let id_institusi = $('#id_institusi').val();
				let kod_peringkat = $('#peringkat').val(); // hidden input with saved value

				// Fetch peringkat and optionally select one
				function fetchPeringkat(id, preselect = false) {
					$.ajax({
						url: '/peringkatProfilPelajar/' + id,
						type: 'get',
						dataType: 'json',
						success: function (response) {
							$("#peringkat_pengajian").empty();
							$("#peringkat_pengajian").append(`<option value="">-- PILIH PERINGKAT --</option>`);

							if (response['data']) {
								response['data'].forEach(function (item) {
									const selected = preselect && item.kod_peringkat === kod_peringkat ? "selected" : "";
									const option = `<option value="${item.kod_peringkat}" ${selected}>${item.peringkat.toUpperCase()}</option>`;
									$("#peringkat_pengajian").append(option);
								});

								// If preselect is true, load kursus
								if (preselect && kod_peringkat) {
									fetchKursus(id, kod_peringkat);
								}
							}
						},
						error: function () {
							alert('Failed to load peringkat options');
						}
					});
				}

				// Fetch kursus
				function fetchKursus(id_institusi, kod_peringkat) {
					$.ajax({
						url: '/kursusProfilPelajar/' + kod_peringkat + '/' + id_institusi,
						type: 'get',
						dataType: 'json',
						success: function (response) {
							$("#nama_kursus").empty();
							$("#nama_kursus").append(`<option value="">-- PILIH KURSUS --</option>`);

							if (response['data']) {
								const selectedValue = $('#nama_kursus_asal').val();

								response['data'].forEach(function (item) {
									const selected = item.nama_kursus === selectedValue ? "selected" : "";
									const option = `<option value="${item.nama_kursus}" ${selected}>${item.no_rujukan} - ${item.nama_kursus.toUpperCase()} - ${item.kod_nec} (${item.bidang.toUpperCase()})</option>`;
									$("#nama_kursus").append(option);
								});
							}
						},
						error: function () {
							alert('Failed to load kursus options');
						}
					});
				}

				if (id_institusi && kod_peringkat) {
					fetchPeringkat(id_institusi, true); // with preselect
				}

				$('#id_institusi').change(function () {
					id_institusi = $(this).val();
					kod_peringkat = null;
					$("#nama_kursus").empty().append(`<option value="">-- PILIH KURSUS --</option>`);
					$("#peringkat_pengajian").empty().append(`<option value="">-- PILIH PERINGKAT --</option>`);

					if (id_institusi) {
						fetchPeringkat(id_institusi, false); // don't preselect
					}
				});

				$('#peringkat_pengajian').change(function () {
					kod_peringkat = $(this).val();
					if (id_institusi && kod_peringkat) {
						fetchKursus(id_institusi, kod_peringkat);
					}
				});
			});



			$(document).ready(function() {
				$('.basic-search').select2();
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
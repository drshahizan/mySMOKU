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
								<form action="{{ route('hantar.tamat.pengajian') }}" method="post" enctype="multipart/form-data">
									@csrf
									<!--begin::Wrapper-->
									<div class="d-flex flex-column align-items-start flex-xl-row">
										<!--begin::Input group-->
										<div class="d-flex flex-center flex-equal fw-row text-nowrap order-1 order-xl-2 me-4" data-bs-toggle="tooltip" data-bs-trigger="hover">
											<span class="fs-3 fw-bold text-gray-800">Lapor Tamat Pengajian</span>
										</div>
									</div>
									<!--end::Top-->
								
									<br>
								
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
													<a href="/assets/contoh/surat_tamat_pengajian__transkrip_akademik.pdf" target="_blank" data-bs-toggle="tooltip" title="contoh"><i class="fa-solid fa-circle-info"></i></a>
												</td>
												<td style="width: 55% !important;">
													<input type="file" id="sijilTamat" name="sijilTamat[]" required/>
													@if(session()->has('uploadedSijilTamat'))
														@foreach(session('uploadedSijilTamat') as $sijil)
															<a href="{{ asset('assets/dokumen/sijil_tamat/' . $sijil) }}" target="_blank">{{ $sijil }}</a>
														@endforeach
													@endif
												</td>
											</tr>
								
											{{-- TRANSKRIP --}}
											<tr>
												<td style="width: 45% !important;">
													Salinan Transkrip &nbsp;
													<a href="/assets/contoh/surat_tamat_pengajian__transkrip_akademik.pdf" target="_blank" data-bs-toggle="tooltip" title="contoh"><i class="fa-solid fa-circle-info"></i></a>
												</td>
												<td style="width: 55% !important;">
													<input type="file" id="transkrip" name="transkrip[]" required/>
													@if(session()->has('uploadedTranskrip'))
														@foreach(session('uploadedTranskrip') as $transkrip)
															<a href="{{ asset('assets/dokumen/salinan_transkrip/' . $transkrip) }}" target="_blank">{{ $transkrip }}</a>
														@endforeach
													@endif
												</td>
											</tr>
								
											<tr>
												<td colspan="2">
													<div class="text-dark fw-semibold fs-6"><i class='fas fa-exclamation-triangle' style='color:orange; font-size:15px;'></i>&nbsp;
														Gunakan kemudahan <a href="https://compressjpeg.com/" target="_blank">di sini</a> untuk mengurangkan saiz fail sebelum memuat naik fail.</a>
													</div>
								
													<div class="text-dark fw-semibold fs-6"><i class='fas fa-info-circle' style='color:gray; font-size:15px;'></i>&nbsp; 
														Format fail yang boleh dimuat naik adalah format '.pdf', '.jpg', '.png', dan '.jpeg'.
													</div>
								
													<div class="text-dark fw-semibold fs-6"><i class='fas fa-info-circle' style='color:gray; font-size:15px;'></i>&nbsp; 
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
													<input type="checkbox" value="1" id="perakuan" name="perakuan" @if(session('perakuan') == 1) checked @endif required/>
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
					icon: 'error',
					title: 'Tidak Berjaya!',
					text: ' {!! session('error') !!}',
					confirmButtonText: 'OK'
				});
			@endif
		</script>
		
	</body>
</x-default-layout> 
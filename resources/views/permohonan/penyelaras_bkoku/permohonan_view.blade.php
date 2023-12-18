<x-default-layout> 
	<style>
		/* Some custom styles to beautify this example */
		.bs-example{
			margin: 60px 0;
		}
		a, button{
			margin-right: 30px;
		  }
		i{
			font-size: 22px;
		}
	</style>
	
	<script>
	$(document).ready(function(){
		$('[data-bs-toggle="tooltip"]').tooltip();
	});
	</script>	

<!--begin::Page title-->
<div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
	<!--begin::Title-->
	<h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Permohonan</h1>
	<!--end::Title-->
	<!--begin::Breadcrumb-->
	<ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
		<!--begin::Item-->
		<li class="breadcrumb-item text-dark">
			<span class="text-dark text-hover-primary" style="color:darkblue">Permohonan</span>
		</li>
		<!--end::Item-->
		<!--begin::Item-->
		<li class="breadcrumb-item">
			<span class="bullet bg-gray-400 w-5px h-2px"></span>
		</li>
		<!--end::Item-->
		<!--begin::Item-->
		<li class="breadcrumb-item text-dark" style="color:darkblue">Borang Permohonan Baru</li>
		<!--end::Item-->
	</ul>
	<!--end::Breadcrumb-->
</div>
<!--end::Page title-->
<br>
<div class="stepper stepper-pills stepper-column d-flex flex-column flex-xl-row flex-row-fluid gap-10" id="kt_create_account_stepper">
	<!--begin::Aside-->
	<div class="card d-flex justify-content-center justify-content-xl-start flex-row-auto w-100 w-xl-300px w-xxl-400px">
		<!--begin::Wrapper-->
		<div class="card-body px-6 px-lg-10 px-xxl-15 py-20">
			<!--begin::Nav-->
			<div class="stepper-nav">
				<!--begin::Step 1-->
				<div class="stepper-item" data-kt-stepper-element="nav">
					<!--begin::Wrapper-->
					<div class="stepper-wrapper">
						<!--begin::Icon-->
						<div class="stepper-icon w-40px h-40px">
							<i class="ki-duotone ki-check fs-2 stepper-check"></i>
							<span class="stepper-number">1</span>
						</div>
						<!--end::Icon-->
						<!--begin::Label-->
						<div class="stepper-label">
							<h3 class="stepper-title">Maklumat Peribadi</h3>
							<div class="stepper-desc fw-semibold">Profil Peribadi Diri</div>
						</div>
						<!--end::Label-->
					</div>
					<!--end::Wrapper-->
					<!--begin::Line-->
					<div class="stepper-line h-40px"></div>
					<!--end::Line-->
				</div>
				<!--end::Step 1-->
				<!--begin::Step 2-->
				<div class="stepper-item" data-kt-stepper-element="nav">
					<!--begin::Wrapper-->
					<div class="stepper-wrapper">
						<!--begin::Icon-->
						<div class="stepper-icon w-40px h-40px">
							<i class="ki-duotone ki-check fs-2 stepper-check"></i>
							<span class="stepper-number">2</span>
						</div>
						<!--end::Icon-->
						<!--begin::Label-->
						<div class="stepper-label">
							<h3 class="stepper-title">Maklumat Waris</h3>
							<div class="stepper-desc fw-semibold">Profil Waris</div>
						</div>
						<!--end::Label-->
					</div>
					<!--end::Wrapper-->
					<!--begin::Line-->
					<div class="stepper-line h-40px"></div>
					<!--end::Line-->
				</div>
				<!--end::Step 2-->
				<!--begin::Step 3-->
				<div class="stepper-item" data-kt-stepper-element="nav">
					<!--begin::Wrapper-->
					<div class="stepper-wrapper">
						<!--begin::Icon-->
						<div class="stepper-icon w-40px h-40px">
							<i class="ki-duotone ki-check fs-2 stepper-check"></i>
							<span class="stepper-number">3</span>
						</div>
						<!--end::Icon-->
						<!--begin::Label-->
						<div class="stepper-label">
							<h3 class="stepper-title">Maklumat Akademik</h3>
							<div class="stepper-desc fw-semibold">Pembelajaran Akademik</div>
						</div>
						<!--end::Label-->
					</div>
					<!--end::Wrapper-->
					<!--begin::Line-->
					<div class="stepper-line h-40px"></div>
					<!--end::Line-->
				</div>
				<!--end::Step 3-->
				<!--begin::Step 4-->
				<div class="stepper-item" data-kt-stepper-element="nav">
					<!--begin::Wrapper-->
					<div class="stepper-wrapper">
						<!--begin::Icon-->
						<div class="stepper-icon w-40px h-40px">
							<i class="ki-duotone ki-check fs-2 stepper-check"></i>
							<span class="stepper-number">4</span>
						</div>
						<!--end::Icon-->
						<!--begin::Label-->
						<div class="stepper-label">
							<h3 class="stepper-title">Maklumat Bayaran</h3>
							<div class="stepper-desc fw-semibold">Bayaran</div>
						</div>
						<!--end::Label-->
						
					</div>
					<!--end::Wrapper-->
					<div class="stepper-line h-40px"></div>
				</div>
				<!--end::Step 4-->
				<!--begin::Step 5-->
				<div class="stepper-item" data-kt-stepper-element="nav">
					<!--begin::Wrapper-->
					<div class="stepper-wrapper">
						<!--begin::Icon-->
						<div class="stepper-icon w-40px h-40px">
							<i class="ki-duotone ki-check fs-2 stepper-check"></i>
							<span class="stepper-number">5</span>
						</div>
						<!--end::Icon-->
						<!--begin::Label-->
						<div class="stepper-label">
							<h3 class="stepper-title">Dokumen</h3>
							<div class="stepper-desc fw-semibold">Salinan Dokumen</div>
						</div>
						<!--end::Label-->
						
					</div>
					<!--end::Wrapper-->
					<div class="stepper-line h-40px"></div>
				</div>
				<!--end::Step 5-->
				<!--begin::Step 6-->
				<div class="stepper-item" data-kt-stepper-element="nav">
					<!--begin::Wrapper-->
					<div class="stepper-wrapper">
						<!--begin::Icon-->
						<div class="stepper-icon w-40px h-40px">
							<i class="ki-duotone ki-check fs-2 stepper-check"></i>
							<span class="stepper-number">6</span>
						</div>
						<!--end::Icon-->
						<!--begin::Label-->
						<div class="stepper-label">
							<h3 class="stepper-title">Perakuan</h3>
							<div class="stepper-desc fw-semibold">Pengesahan Semua Maklumat</div>
						</div>
						<!--end::Label-->
					</div>
					<!--end::Wrapper-->
					<!--begin::Line-->
					<div class="stepper-line h-40px"></div>
					<!--end::Line-->
				</div>
				<!--end::Step 6-->
				<!--begin::Step 7-->
				<div class="stepper-item  mark-completed" data-kt-stepper-element="nav">
					<!--begin::Wrapper-->
					<div class="stepper-wrapper">
						<!--begin::Icon-->
						<div class="stepper-icon w-40px h-40px">
							<i class="ki-duotone ki-check fs-2 stepper-check"></i>
							<span class="stepper-number">7</span>
						</div>
						<!--end::Icon-->
						<!--begin::Label-->
						<div class="stepper-label">
							<h3 class="stepper-title">Hantar</h3>
							<div class="stepper-desc fw-semibold">Selesai</div>
						</div>
						<!--end::Label-->
					</div>
					<!--end::Wrapper-->
					<!--begin::Line-->
					<!--end::Line-->
				</div>
				<!--end::Step 7-->
			</div>
			<!--end::Nav-->
		</div>
		<!--end::Wrapper-->
	</div>
	<!--end::Aside-->
		<!--begin::Content-->
		<div class="card d-flex flex-row-fluid flex-center">
			<!--begin::Form-->
			<form id="kt_create_account_form" action="{{ route('hantar') }}" method="post" class="card-body py-20 w-100 mw-xl-700px px-9" enctype="multipart/form-data">
				
				{{-- @foreach ($butiranPelajar as $butiranPelajar) --}}
				<!--begin::Step 1-->
				<div class="current" data-kt-stepper-element="content">
				@csrf
					<!--begin::Wrapper-->
					<div class="w-100">
						<!--begin::Heading-->
						<div class="pb-10 pb-lg-15">
							<!--begin::Title-->
							<h2 class="fw-bold text-dark">Maklumat Peribadi</h2>
							<!--end::Title-->
							<!--begin::Notice-->
							<div class="text-muted fw-semibold fs-6">Profil Diri</div>
							<!--end::Notice-->
						</div>
						<!--end::Heading-->
						<!--begin::Input group-->
						<div class="mb-10 fv-row">
							<!--begin::Label-->
							<label class="form-label mb-3">Nama</label>
							<!--end::Label-->
							<!--begin::Input-->
							<input type="text" class="form-control form-control-lg form-control-solid"  id="nama_pelajar" name="nama_pelajar" placeholder="" value="{{$butiranPelajar->nama}}" readonly/>
							<!--end::Input-->
						</div>
						<!--end::Input group-->
						<!--begin::Input group-->
						<div class="row mb-10">
							<!--begin::Col-->
							<div class="col-md-4 fv-row">
								<!--begin::Label-->
								<label class=" fs-6 fw-semibold form-label mb-2">No. Kad Pengenalan</label>
								<!--end::Label-->
								<!--begin::Row-->
								<div class="row fv-row">
									<!--begin::Col-->
									<div class="col-12">
										<input type="text" class="form-control form-control-lg form-control-solid" maxlength="12" id="no_kp" name="no_kp" placeholder="" value="{{$butiranPelajar->no_kp}}" readonly/>
									</div>
									<!--end::Col-->
								</div>
								<!--end::Row-->
							</div>
							<div class="col-md-3 fv-row">
								<!--begin::Label-->
								<label class=" fs-6 fw-semibold form-label mb-2">Tarikh Lahir</label>
								<!--end::Label-->
								<!--begin::Row-->
								<div class="row fv-row">
									<!--begin::Col-->
									<div class="col-12">
										<!--begin::Input-->
										<input type="date" data-date-autoclose="true" class="form-control form-control-solid" placeholder="" id="tkh_lahir" name="tkh_lahir" value="{{$butiranPelajar->tarikh_lahir}}" readonly/>
										<!--end::Input-->
									</div>
								</div>	
							</div>
							<div class="col-md-3 fv-row">
								<!--begin::Label-->
								<label class=" fs-6 fw-semibold form-label mb-2">Negeri Lahir</label>
								<!--end::Label-->
								<!--begin::Row-->
								<div class="row fv-row">
									<!--begin::Col-->
									<div class="col-12">
										<!--begin::Input-->
										<select id="negeri_lahir" name="negeri_lahir" class="form-select form-select-lg form-select-solid js-example-basic-single"  data-control="select2" data-hide-search="true" {{ in_array($butiranPelajar->status, [2, 3, 4, 6, 7, 8, 9]) ? 'disabled' : '' }}>
											@foreach ($negeri as $negerilahir)
											<option value="{{$negerilahir->id}}" {{$butiranPelajar->negeri_lahir == $negerilahir->id ? 'selected' : ''}}>{{ $negerilahir->negeri}}</option>
											@endforeach
										</select>
										<!--end::Input-->
									</div>
								</div>	
							</div>
							<div class="col-md-2 fv-row">
								<label class=" fs-6 fw-semibold form-label mb-2">Umur</label>
								<!--end::Label-->
								<div class="row fv-row">
									<!--begin::Input wrapper-->
									<div class="col-12">
										<!--begin::Input-->
										<input type="text" class="form-control form-control-solid" id="umur" name="umur" placeholder="" value="{{$butiranPelajar->umur}}" readonly/>
										<!--end::Input-->
									</div>
									<!--end::Input wrapper-->
								</div>
							</div>	
							<!--end::Col-->
						</div>
						<!--end::Input group-->
						<!--begin::Input group-->
						<div class="row mb-10">
							<div class="col-md-4 fv-row">
								<!--begin::Label-->
								<label class=" fs-6 fw-semibold form-label mb-2">Jantina</label>
								<!--end::Label-->
								<!--begin::Input wrapper-->
								<div class="col-12">
									<!--begin::Input-->
									<select id="jantina" name="jantina" class="form-select form-select-lg form-select-solid" data-control="select2" data-placeholder="Pilih" data-hide-search="true">
										<option value="{{ $butiranPelajar->kod_jantina }}">{{ $butiranPelajar->jantina }}</option>
									</select>
									<!--end::Input-->
								</div>
								<!--end::Input wrapper-->
							</div>
							<div class="col-md-4 fv-row">
								<!--begin::Label-->
								<label class="fs-6 fw-semibold form-label mb-2">Keturunan</label>
								<!--end::Label-->
								<!--begin::Input wrapper-->
								<div class="col-12">
									<!--begin::Input-->
									<select id="keturunan" name="keturunan" class="form-select form-select-lg form-select-solid" data-control="select2" data-placeholder="Pilih" data-hide-search="true">
										<option value="{{$butiranPelajar->kod_keturunan}}">{{$butiranPelajar->keturunan}}</option>
									</select>
									<!--end::Input-->
								</div>
								<!--end::Input wrapper-->
							</div>
							<div class="col-md-4 fv-row">
								<!--begin::Label-->
								<label class=" fs-6 fw-semibold form-label mb-2">Agama</label>
								<!--end::Label-->
								<!--begin::Input wrapper-->
								<div class="col-12">
									<!--begin::Input-->
									<select id="agama" name="agama" class="form-select form-select-lg form-select-solid js-example-basic-single" data-control="select2" data-hide-search="true" {{ in_array($butiranPelajar->status, [2, 3, 4, 6, 7, 8, 9]) ? 'disabled' : '' }}>
										@foreach ($agama as $agama)
											<option value="{{$agama->id}}" {{$butiranPelajar->agama == $agama->id ? 'selected' : ''}}>{{ $agama->agama}}</option>
										@endforeach
									</select>
									<!--end::Input-->
								</div>
								<!--end::Input wrapper-->
							</div>
						</div>
						<!--end::Input group-->
						<!--begin::Input group-->
						<div class="fv-row mb-10">
							<!--end::Label-->
							<label class="form-label">Alamat Tetap</label>
							<!--end::Label-->
							<!--begin::Input-->
							<textarea id="alamat_tetap" name="alamat_tetap" class="form-control form-control-lg form-control-solid" rows="2" style="text-transform: uppercase;" {{ in_array($butiranPelajar->status, [2, 3, 4, 6, 7, 8, 9]) ? 'readonly' : '' }}>{{$butiranPelajar->alamat_tetap_baru}}</textarea>
							<!--end::Input-->
						</div>
						<div class="row mb-10">
							<div class="col-md-5 fv-row">
								<!--begin::Label-->
								<label class=" fs-6 fw-semibold form-label mb-2">Negeri</label>
								<!--end::Label-->
								<!--begin::Input wrapper-->
								<div class="col-12">
									<!--begin::Input-->
									<select id="alamat_tetap_negeri" name="alamat_tetap_negeri" class="form-select form-select-lg form-select-solid js-example-basic-single"  data-control="select2" data-hide-search="true" {{ in_array($butiranPelajar->status, [2, 3, 4, 6, 7, 8, 9]) ? 'disabled' : '' }}>{{$butiranPelajar->alamat_tetap_baru}}>
										@foreach ($negeri as $negeritetap)	
										<option value="{{$negeritetap->id}}" {{$butiranPelajar->alamat_tetap_negeri == $negeritetap->id ? 'selected' : ''}}>{{ $negeritetap->negeri}}</option>
										@endforeach
									</select>
									<!--end::Input-->
								</div>
								<!--end::Input wrapper-->
							</div>
							<div class="col-md-4 fv-row">
								<!--begin::Label-->
								<label class=" fs-6 fw-semibold form-label mb-2">Bandar</label>
								<!--end::Label-->
								<!--begin::Input wrapper-->
								<div class="col-12">
									<!--begin::Input-->
									<select id='alamat_tetap_bandar' name='alamat_tetap_bandar' class="form-select form-select-lg form-select-solid js-example-basic-single" data-placeholder="Pilih"  data-control="select2" data-hide-search="true" {{ in_array($butiranPelajar->status, [2, 3, 4, 6, 7, 8, 9]) ? 'disabled' : '' }}>
										<option></option>
										@foreach ($bandar as $bandartetap)	
										<option value="{{$bandartetap->id}}" {{$butiranPelajar->alamat_tetap_bandar == $bandartetap->id ? 'selected' : ''}}>{{ $bandartetap->bandar}}</option>
										@endforeach
									</select>
									<!--end::Input-->
								</div>
								<!--end::Input wrapper-->
							</div>
							<div class="col-md-3 fv-row">
								<!--begin::Label-->
								<label class=" fs-6 fw-semibold form-label mb-2">Poskod
								</label>
								<!--end::Label-->
								<!--begin::Input wrapper-->
								<div class="col-12">
									<!--begin::Input-->
									<input type="text" maxlength="5" class="form-control form-control-solid" id="alamat_tetap_poskod" name="alamat_tetap_poskod" placeholder="" value="{{$butiranPelajar->alamat_tetap_poskod}}" {{ in_array($butiranPelajar->status, [2, 3, 4, 6, 7, 8, 9]) ? 'readonly' : '' }}/>
									<!--end::Input-->
								</div>
								<!--end::Input wrapper-->
							</div>
						</div>
						<!--end::Input group-->
						<div class="row mb-10">
							<div class="col-md-7 fv-row">
								<!--begin::Label-->
								<label class=" fs-6 fw-semibold form-label mb-2">Parlimen</label>
								<!--end::Label-->
								<!--begin::Input wrapper-->
								<div class="col-12">
									<!--begin::Input-->
									<select id='parlimen' name='parlimen' class="form-select form-select-lg form-select-solid js-example-basic-single"  data-control="select2" data-hide-search="true" {{ in_array($butiranPelajar->status, [2, 3, 4, 6, 7, 8, 9]) ? 'disabled' : '' }}>
										<option value="">Pilih</option>
										@foreach ($parlimen as $parlimen)	
										<option value="{{$parlimen->id}}" {{$butiranPelajar->parlimen == $parlimen->id ? 'selected' : ''}}>{{ $parlimen->kod_parlimen}} - {{ strtoupper($parlimen->parlimen)}}</option>
										@endforeach
									</select>
									<!--end::Input-->
								</div>
								<!--end::Input wrapper-->
							</div>
							<div class="col-md-5 fv-row">
								<!--begin::Label-->
								<label class=" fs-6 fw-semibold form-label mb-2">DUN</label>
								<!--end::Label-->
								<!--begin::Input wrapper-->
								<div class="col-12">
									<!--begin::Input-->
									<select id="dun" name="dun" class="form-select form-select-lg form-select-solid js-example-basic-single"  data-control="select2" data-hide-search="true" {{ in_array($butiranPelajar->status, [2, 3, 4, 6, 7, 8, 9]) ? 'disabled' : '' }}>
										<option value="">Pilih</option>
										@foreach ($dun as $dun)	
										<option value="{{$dun->id}}" {{$butiranPelajar->dun == $dun->id ? 'selected' : ''}}>{{ $dun->kod_dun}} - {{ strtoupper($dun->dun)}}</option>
										@endforeach
									</select>
									<!--end::Input-->
								</div>
								<!--end::Input wrapper-->
							</div>
						</div>
							<!--begin::Alamat Surat-->
							<div class="fv-row mb-10">
								<!--end::Label-->
								<label class="form-label">Alamat Surat Menyurat</label>
								<!--end::Label-->
								<!--begin::Input group-->
								<div class="fv-row mb-7">
									<!--begin::Wrapper-->
									<div class="d-flex flex-stack">
										<!--begin::Label-->
										<div class="me-5">
											<!--begin::Input-->
											<input class="form-check-input" id="sama" name="sama" onclick="myFunction()" type="checkbox" value="1" @if($butiranPelajar->alamat_surat_baru == $butiranPelajar->alamat_tetap_baru) checked @endif />
											<!--end::Input-->
											<!--begin::Label-->
											<label class="form-label">Sama seperti Alamat Tetap</label>
											<!--end::Label-->
										</div>
										<!--end::Label-->
									</div>
									<!--begin::Wrapper-->
								</div>
								<!--end::Input group-->
								<!--begin::Input-->
								<textarea id="alamat_surat_menyurat" name="alamat_surat_menyurat" class="form-control form-control-lg form-control-solid" rows="2" style="text-transform: uppercase;" {{ in_array($butiranPelajar->status, [2, 3, 4, 6, 7, 8, 9]) && $butiranPelajar->alamat_surat_baru !== null ? 'readonly' : '' }}>{{$butiranPelajar->alamat_surat_baru}}</textarea>
								<!--end::Input-->
							</div>
							<div class="row mb-10">
								<div class="col-md-5 fv-row">
									<!--begin::Label-->
									<label class=" fs-6 fw-semibold form-label mb-2">Negeri</label>
									<!--end::Label-->
									<!--begin::Input wrapper-->
									<div class="col-12">
										<!--begin::Input-->
										<select id="alamat_surat_negeri" name="alamat_surat_negeri" class="form-select form-select-lg form-select-solid js-example-basic-single"  data-control="select2" data-hide-search="true" {{ in_array($butiranPelajar->status, [2, 3, 4, 6, 7, 8, 9]) ? 'disabled' : '' }}>
											<option value="">Pilih</option>
											@foreach ($negeri as $negerisurat)	
											<option value="{{$negerisurat->id}}" {{$butiranPelajar->alamat_surat_negeri == $negerisurat->id ? 'selected' : ''}}>{{ $negerisurat->negeri}}</option>
											@endforeach
										</select>
										<!--end::Input-->
									</div>
									<!--end::Input wrapper-->
								</div>
								<div class="col-md-4 fv-row">
									<!--begin::Label-->
									<label class=" fs-6 fw-semibold form-label mb-2">Bandar</label>
									<!--end::Label-->
									<!--begin::Input wrapper-->
									<div class="col-12">
										<!--begin::Input-->
										<select id='alamat_surat_bandar' name='alamat_surat_bandar' class="form-select form-select-lg form-select-solid js-example-basic-single"  data-control="select2" data-hide-search="true" {{ in_array($butiranPelajar->status, [2, 3, 4, 6, 7, 8, 9]) ? 'disabled' : '' }}>
											<option value="">Pilih</option>
											@foreach ($bandar as $bandarsurat)	
											<option value="{{$bandarsurat->id}}" {{$butiranPelajar->alamat_surat_bandar == $bandarsurat->id ? 'selected' : ''}}>{{ $bandarsurat->bandar}}</option>
											@endforeach
										</select>
										<!--end::Input-->
									</div>
									<!--end::Input wrapper-->
								</div>
								<div class="col-md-3 fv-row">
									<!--begin::Label-->
									<label class=" fs-6 fw-semibold form-label mb-2">Poskod</label>
									<!--end::Label-->
									<!--begin::Input wrapper-->
									<div class="col-12">
										<!--begin::Input-->
										<input type="text" maxlength="5" class="form-control form-control-solid" id="alamat_surat_poskod" name="alamat_surat_poskod" placeholder="" value="{{$butiranPelajar->alamat_surat_poskod}}" {{ in_array($butiranPelajar->status, [2, 3, 4, 6, 7, 8, 9]) ? 'readonly' : '' }}/>
										<!--end::Input-->
									</div>
									<!--end::Input wrapper-->
								</div>
							</div>
						<!--end::Input group-->
						<div class="row mb-10">
							<div class="col-md-5 fv-row">
								<!--begin::Label-->
								<label class=" fs-6 fw-semibold form-label mb-2">Alamat emel</label>
								<!--end::Label-->
								<!--begin::Input wrapper-->
								<div class="col-12">
									<!--begin::Input-->
									<input type="text" class="form-control form-control-solid" id="emel" name="emel" placeholder="" value="{{$butiranPelajar->emel}}" readonly/>
									<!--end::Input-->
								</div>
								<!--end::Input wrapper-->
							</div>
							<div class="col-md-4 fv-row">
								<!--begin::Label-->
								<label class=" fs-6 fw-semibold form-label mb-2">No. Tel Bimbit</label>
								<!--end::Label-->
								<!--begin::Input wrapper-->
								<div class="col-12">
									<!--begin::Input-->
									<input type="text" class="form-control form-control-solid" id="tel_bimbit" name="tel_bimbit" placeholder="" value="{{$butiranPelajar->tel_bimbit_baru}}" {{ in_array($butiranPelajar->status, [2, 3, 4, 6, 7, 8, 9]) ? 'readonly' : '' }}/>
									<!--end::Input-->
								</div>
								<!--end::Input wrapper-->
							</div>
							<div class="col-md-3 fv-row">
								<!--begin::Label-->
								<label class=" fs-6 fw-semibold form-label mb-2">No. Tel Rumah
								</label>
								<!--end::Label-->
								<!--begin::Input wrapper-->
								<div class="col-12">
									<!--begin::Input-->
									<input type="text" class="form-control form-control-solid" id="tel_rumah" name="tel_rumah" placeholder="" value="{{$butiranPelajar->tel_rumah_baru}}" {{ in_array($butiranPelajar->status, [2, 3, 4, 6, 7, 8, 9]) ? 'readonly' : '' }}/>
									<!--end::Input-->
								</div>
								<!--end::Input wrapper-->
							</div>
						</div>
						<!--end::Input group-->
						<!--end::Input group-->
						<div class="row mb-10">
							<div class="col-md-4 fv-row">
								<!--begin::Label-->
								<label class=" fs-6 fw-semibold form-label mb-2">Status Pekerjaan</label>
								<!--end::Label-->
								<!--begin::Input wrapper-->
								<div class="col-12">
									<!--begin::Input-->
									<select id="status_pekerjaan" name="status_pekerjaan" class="form-select form-select-solid" data-control="select2" data-hide-search="true" data-placeholder="Pilih" {{ in_array($butiranPelajar->status, [2, 3, 4, 6, 7, 8, 9]) ? 'disabled' : '' }}>
										<option></option>
										<option value="TIDAK BEKERJA" {{$butiranPelajar->status_pekerjaan_baru == "TIDAK BEKERJA" ? 'selected' : ''}}>TIDAK BEKERJA</option>
										<option value="BEKERJA" {{$butiranPelajar->status_pekerjaan_baru == "BEKERJA" ? 'selected' : ''}}>BEKERJA</option>
									</select>
									<!--end::Input-->
								</div>
								<!--end::Input wrapper-->
							</div>
							<div class="col-md-4 fv-row" id="div_pekerjaan">
								<!--begin::Label-->
								<label class=" fs-6 fw-semibold form-label mb-2">Pekerjaan
								</label>
								<!--end::Label-->
								<!--begin::Input wrapper-->
								<div class="col-12">
									<!--begin::Input-->
									<input type="text" class="form-control form-control-solid" id="pekerjaan" name="pekerjaan" style="text-transform: uppercase;" placeholder="" value="{{$butiranPelajar->pekerjaan_baru}}" {{ in_array($butiranPelajar->status, [2, 3, 4, 6, 7, 8, 9]) ? 'readonly' : '' }}/>
									<!--end::Input-->
								</div>
								<!--end::Input wrapper-->
							</div>
							<div class="col-md-4 fv-row" id="div_pendapatan">
								<!--begin::Label-->
								<label class=" fs-6 fw-semibold form-label mb-2">Pendapatan
								</label>
								<!--end::Label-->
								<!--begin::Input wrapper-->
								<div class="col-12">
									<!--begin::Input-->
									<input type="number" class="form-control form-control-solid" id="pendapatan" name="pendapatan" placeholder="" value="{{$butiranPelajar->pendapatan_baru}}" {{ in_array($butiranPelajar->status, [2, 3, 4, 6, 7, 8, 9]) ? 'readonly' : '' }}/>
									<!--end::Input-->
								</div>
								<!--end::Input wrapper-->
							</div>
						</div>
						<!--end::Input group-->
						<!--end::Input group-->
						<div class="row mb-10">
							<div class="separator my-14"></div>
							<div class="pb-10 pb-lg-15">
								<!--begin::Title-->
								<h2 class="fw-bold text-dark">Maklumat Sistem Maklumat Orang Kurang Upaya (SMOKU)</h2>
								<!--end::Title-->
								<!--begin::Notice-->
								<div class="text-muted fw-semibold fs-6">Jabatan Kebajikan Malaysia</div>
								<!--end::Notice-->
							</div>
							<div class="row mb-10">
								<div class="col-md-6 fv-row">
									<!--begin::Label-->
									<label class=" fs-6 fw-semibold form-label mb-2">No. JKM
									</label>
									<!--end::Label-->
									<!--begin::Input wrapper-->
									<div class="col-12">
										<!--begin::Input-->
										<input type="text" class="form-control form-control-solid" id="no_daftar_oku" name="no_daftar_oku" placeholder="" value="{{$butiranPelajar->no_daftar_oku}}"  readonly/>
										<!--end::Input-->
									</div>
									<!--end::Input wrapper-->
								</div>
								<div class="col-md-6 fv-row">
									<!--begin::Label-->
									<label class="fs-6 fw-semibold form-label mb-2">Kategori Kecacatan
									</label>
									<!--end::Label-->
									<!--begin::Input wrapper-->
									<div class="col-12">
										<!--begin::Input-->
										<input type="text" class="form-control form-control-solid" placeholder="" value="{{$butiranPelajar->kecacatan}}" readonly/>
										<input type="hidden" class="form-control form-control-solid" id="kecacatan" name="kecacatan" placeholder="" value="{{$butiranPelajar->kod_oku}}" readonly/>
										<!--end::Input-->
									</div>
									<!--end::Input wrapper-->
								</div>
							</div>
							<!--end::Input group-->
							@php
								$user = DB::table('users')->where('no_kp',Auth::user()->no_kp)->first();
								$institusi = DB::table('bk_info_institusi')->where('id_institusi', $user->id_institusi)->first();
							@endphp
							@if($institusi->jenis_institusi != 'UA')
								<!--begin::maklumat bank-->
								<div class="separator my-14"></div>
								<div class="pb-10 pb-lg-15">
									<!--begin::Title-->
									<h2 class="fw-bold text-dark">Maklumat Perbankan</h2>
									<!--end::Title-->
									<!--begin::Notice-->
									<div class="text-muted fw-semibold fs-6">Bank Islam</div>
									<!--end::Notice-->
								</div>
								<div class="col-md-6 fv-row">
									<!--begin::Label-->
									<label class=" fs-6 fw-semibold form-label mb-2">No. Akaun Bank</label>&nbsp;<a href="#" data-bs-toggle="tooltip" title="16113020138680"><i class="fa-solid fa-circle-info"></i></a>
									<!--end::Label-->
									<!--begin::Input wrapper-->
									<div class="col-12">
										<!--begin::Input-->
										<input type="text" class="form-control form-control-solid" maxlength="14" id="no_akaun_bank" name="no_akaun_bank" placeholder="" value="{{ $butiranPelajar->no_akaun_bank }}" {{ in_array($butiranPelajar->status, [2, 3, 4, 6, 7, 8, 9]) ? 'readonly' : '' }}/>
										<!--end::Input-->
									</div>
									<!--end::Input wrapper-->
								</div>
								<!--end::maklumat bank-->
							@endif	
						</div>
						<!--end::Input group-->
					</div>
					<!--end::Wrapper-->
				</div>
				<!--end::Step 1-->

				<!--begin::Step 2-->
				<div data-kt-stepper-element="content">
				@csrf	
					<!--begin::Wrapper-->
					<div class="w-100">
						<!--begin::Heading-->
						<div class="pb-10 pb-lg-15">
							<!--begin::Title-->
							<h2 class="fw-bold text-dark">Maklumat Waris</h2>
							<!--end::Title-->
							<!--begin::Notice-->
							<div class="text-muted fw-semibold fs-6">Profil Waris</div>
							<!--end::Notice-->
						</div>
						<!--end::Heading-->
						<!--begin::Input group-->
						<div class="mb-10 fv-row">
							<!--begin::Label-->
							<label class="form-label mb-3">Nama</label>
							<!--end::Label-->
							<!--begin::Input-->
							<input type="text" class="form-control form-control-lg form-control-solid" id="nama_waris" name="nama_waris" style="text-transform: uppercase;" placeholder="" value="{{$butiranPelajar->nama_waris}}" {{ in_array($butiranPelajar->status, [2, 3, 4, 6, 7, 8, 9]) ? 'readonly' : '' }}/>
							<!--end::Input-->
						</div>
						<div class="row mb-10">
							<!--begin::Col-->
							<div class="col-md-6 fv-row">
								<!--begin::Label-->
								<label class=" fs-6 fw-semibold form-label mb-2">No. Kad Pengenalan</label>
								<!--end::Label-->
								<!--begin::Row-->
								<div class="row fv-row">
									<!--begin::Col-->
									<div class="col-12">
										<input type="text" class="form-control form-control-lg form-control-solid" maxlength="12" id="no_kp_waris" name="no_kp_waris" placeholder="" value="{{$butiranPelajar->no_kp_waris}}" {{ in_array($butiranPelajar->status, [2, 3, 4, 6, 7, 8, 9]) ? 'readonly' : '' }}/>
									</div>
									<!--end::Col-->
								</div>
								<!--end::Row-->
							</div>
							<div class="col-md-6 fv-row">
								<!--begin::Label-->
								<label class=" fs-6 fw-semibold form-label mb-2">No Pasport</label>
								<!--end::Label-->
								<!--begin::Row-->
								<div class="row fv-row">
									<!--begin::Col-->
									<div class="col-12">
										<input type="text" class="form-control form-control-lg form-control-solid" id="no_pasport_waris" name="no_pasport_waris" placeholder="" value="{{$butiranPelajar->no_pasport_waris}}" {{ in_array($butiranPelajar->status, [2, 3, 4, 6, 7, 8, 9]) ? 'readonly' : '' }}/>
									</div>
									<!--end::Col-->
								</div>
								<!--end::Row-->
							</div>
						</div>
						<div class="row mb-10">
							<!--begin::Label-->
							<div class="col-md-6 fv-row">
								<label class="form-label mb-6">Hubungan Waris</label>
								<select id="hubungan_waris" name="hubungan_waris" class="form-select form-select-lg form-select-solid hubungan_waris" data-control="select2" data-placeholder="Pilih" {{ in_array($butiranPelajar->status, [2, 3, 4, 6, 7, 8, 9]) ? 'disabled' : '' }}>
									@foreach ($hubungan as $hubungan)
									<option value="{{$hubungan->kod_hubungan}}" {{$butiranPelajar->hubungan_waris == $hubungan->kod_hubungan ? 'selected' : ''}}>{{ $hubungan->hubungan}}</option>
									@endforeach
								</select>
							</div>
							<div class="col-md-6 fv-row">
								<!--begin::Label-->
								<label class="form-label mb-6">No. Tel Bimbit</label>
								<!--end::Label-->
								<!--begin::Input-->
								<input type="text" class="form-control form-control-solid" id="tel_bimbit_waris" name="tel_bimbit_waris" placeholder="" value="{{$butiranPelajar->tel_bimbit_waris}}"  {{ in_array($butiranPelajar->status, [2, 3, 4, 6, 7, 8, 9]) ? 'readonly' : '' }}/>
								<!--end::Input-->
							</div>
							
						</div>
						<!--end::Input group-->
						<div class="row mb-10" id="div_waris_lain">
							<div class="col-md-6 fv-row">
								<!--begin::Label-->
								<label class="form-label mb-6">(Jika Lain-lain) Sila Nyatakan:</label>
								<!--end::Label-->
								<!--begin::Input-->
								<input type="text" class="form-control form-control-lg form-control-solid" id="hubungan_lain_waris" name="hubungan_lain_waris" placeholder="" value="{{$butiranPelajar->hubungan_lain_waris}}" {{ in_array($butiranPelajar->status, [2, 3, 4, 6, 7, 8, 9]) ? 'readonly' : '' }}/>
								<!--end::Input-->													
							</div>
							
						</div>
						<!--begin::Input group-->
						<div class="fv-row mb-10">
							<!--end::Label-->
							<label class="form-label">Alamat Tetap</label>
							<!--end::Label-->
							<!--begin::Input-->
							<textarea id="alamat_waris" name="alamat_waris" class="form-control form-control-lg form-control-solid" style="text-transform: uppercase;" rows="2" {{ in_array($butiranPelajar->status, [2, 3, 4, 6, 7, 8, 9]) ? 'readonly' : '' }}>{{$butiranPelajar->alamat_waris}}</textarea>
							<!--end::Input-->
						</div>
						<div class="row mb-10">
							<div class="col-md-4 fv-row">
								<!--begin::Label-->
								<label class="fs-6 fw-semibold form-label mb-2">Negeri
								</label>
								<!--end::Label-->
								<!--begin::Input wrapper-->
								<div class="col-12">
									<!--begin::Input-->
									<select id="alamat_negeri_waris" name="alamat_negeri_waris" class="form-select form-select-lg form-select-solid js-example-basic-single" data-placeholder="Pilih" data-control="select2" data-hide-search="true" {{ in_array($butiranPelajar->status, [2, 3, 4, 6, 7, 8, 9]) ? 'disabled' : '' }}>
										<option></option>
										@foreach ($negeri as $negeri)
										<option value="{{$negeri->id}}" {{$butiranPelajar->alamat_negeri_waris == $negeri->id ? 'selected' : ''}}>{{ $negeri->negeri}}</option>
										@endforeach
									</select>
									<!--end::Input-->
								</div>
								<!--end::Input wrapper-->
							</div>
							<div class="col-md-4 fv-row">
								<!--begin::Label-->
								<label class="fs-6 fw-semibold form-label mb-2">Bandar</label>
								<!--end::Label-->
								<!--begin::Input wrapper-->
								<div class="col-12">
									<!--begin::Input-->
									<select id='alamat_bandar_waris' name='alamat_bandar_waris' class="form-select form-select-lg form-select-solid js-example-basic-single" data-placeholder="Pilih" data-control="select2" data-hide-search="true" {{ in_array($butiranPelajar->status, [2, 3, 4, 6, 7, 8, 9]) ? 'disabled' : '' }}>
										<option></option>
										@foreach ($bandar as $bandar)
										<option value="{{$bandar->id}}" {{$butiranPelajar->alamat_bandar_waris == $bandar->id ? 'selected' : ''}}>{{ $bandar->bandar}}</option>
										@endforeach
									</select>
									<!--end::Input-->
								</div>
								<!--end::Input wrapper-->
							</div>
							<div class="col-md-4 fv-row">
								<!--begin::Label-->
								<label class="fs-6 fw-semibold form-label mb-2">Poskod</label>
								<!--end::Label-->
								<!--begin::Input wrapper-->
								<div class="col-12">
									<!--begin::Input-->
									<input type="text" maxlength="5" class="form-control form-control-solid" id="alamat_poskod_waris" name="alamat_poskod_waris" placeholder="" value="{{$butiranPelajar->alamat_poskod_waris}}" {{ in_array($butiranPelajar->status, [2, 3, 4, 6, 7, 8, 9]) ? 'readonly' : '' }}/>
									<!--end::Input-->
								</div>
								<!--end::Input wrapper-->
							</div>
						</div>
						<!--end::Input group-->
						
						<div class="row mb-10">
							<div class="col-md-6 fv-row">
								<!--begin::Label-->
								<label class="fs-6 fw-semibold form-label mb-2">Pekerjaan Waris
								</label>
								<!--end::Label-->
								<!--begin::Input wrapper-->
								<div class="col-12">
									<!--begin::Input-->
									<input type="text" class="form-control form-control-solid" id="pekerjaan_waris" name="pekerjaan_waris" placeholder="" value="{{$butiranPelajar->pekerjaan_waris}}" {{ in_array($butiranPelajar->status, [2, 3, 4, 6, 7, 8, 9]) ? 'readonly' : '' }}/>
									<!--end::Input-->
								</div>
								<!--end::Input wrapper-->
							</div>
							<div class="col-md-6 fv-row">
								<!--begin::Label-->
								<label class="fs-6 fw-semibold form-label mb-2">Pendapatan Bulanan Waris</label>&nbsp;<a href="#" data-bs-toggle="tooltip" title="Nilai tanpa .00"><i class="fa-solid fa-circle-info"></i></a>
								<!--end::Label-->
								<!--begin::Input wrapper-->
								<div class="col-12">
									<!--begin::Input-->
									<input type="number" class="form-control form-control-solid" id="pendapatan_waris" name="pendapatan_waris" placeholder="RM" value="{{$butiranPelajar->pendapatan_waris}}" {{ in_array($butiranPelajar->status, [2, 3, 4, 6, 7, 8, 9]) ? 'readonly' : '' }}/>
									<!--end::Input-->
								</div>
								<!--end::Input wrapper-->
							</div>
						</div>
						<!--end::Input group-->
					</div>
					<!--end::Wrapper-->
				</div>
				<!--end::Step 2-->
				
				<!--begin::Step 3-->
				<div data-kt-stepper-element="content">
				@csrf
					<!--begin::Wrapper-->
					<div class="w-100">
						<!--begin::Heading-->
						<div class="pb-10 pb-lg-15">
							<!--begin::Title-->
							<h2 class="fw-bold text-dark">Maklumat Akademik</h2>
							<!--end::Title-->
							<!--begin::Notice-->
							<div class="text-muted fw-semibold fs-6">Profil Akademik</div>
							<!--end::Notice-->
						</div>
						<!--end::Heading-->
						<!--begin::Input group-->
						<div class="row mb-10">
							<div class="col-md-7 fv-row">
								<!--begin::Label-->
								<label class="d-flex align-items-center fs-6 fw-semibold form-label mb-2">
									<span class="">Nama Pusat Pengajian</span>
								</label>
								<!--end::Label-->
								<select id="id_institusi" name="id_institusi" class="form-select form-select-solid js-example-basic-single" data-control="select2" data-hide-search="true" data-placeholder="Pilih" {{ in_array($butiranPelajar->status, [2, 3, 4, 6, 7, 8, 9]) ? 'readonly' : '' }}>
									@foreach ($infoipt as $infoipt)
									<option value="{{$infoipt->id_institusi}}" {{$butiranPelajar->id_institusi == $infoipt->id_institusi ? 'selected' : ''}}>{{ strtoupper($infoipt->nama_institusi)}}</option>
									@endforeach
								</select>
							</div>
							<!--begin::Col-->
							<div class="col-md-5 fv-row">
								<!--begin::Label-->
								<label class=" fs-6 fw-semibold form-label mb-2">Peringkat Pengajian</label>
								<!--end::Label-->
								<!--begin::Row-->
								<div class="row fv-row">
									<!--begin::Input wrapper-->
									<select id="peringkat_pengajian" name="peringkat_pengajian" class="form-select form-select-solid" data-control="select2" data-hide-search="true" {{ in_array($butiranPelajar->status, [2, 3, 4, 6, 7, 8, 9]) ? 'readonly' : '' }}>
										<option value="">Pilih</option>
										@foreach ($peringkat as $peringkat)
										<option value="{{$peringkat->kod_peringkat}}" {{$butiranPelajar->peringkat_pengajian == $peringkat->kod_peringkat ? 'selected' : ''}}>{{ $peringkat->peringkat}}</option>
										@endforeach
									</select>
									<!--end::Input wrapper-->
								</div>
								<!--end::Row-->
							</div>
							<!--end::Col-->
						</div>
						<!--end::Input group-->
						<div class="d-flex flex-column mb-7 fv-row">
							<!--begin::Label-->
							<label class="d-flex align-items-center fs-6 fw-semibold form-label mb-2">
								<span class="">Nama Kursus</span>
							</label>
							<!--end::Label-->
							<select id="nama_kursus" name="nama_kursus" class="form-select form-select-solid js-example-basic-single" data-control="select2" data-hide-search="true" data-placeholder="Pilih" {{ in_array($butiranPelajar->status, [2, 3, 4, 6, 7, 8, 9]) ? 'readonly' : '' }}>
								<option value="{{ $butiranPelajar->nama_kursus}}">{{ strtoupper($butiranPelajar->nama_kursus)}}</option>
							</select>
						</div>
						<!--end::Input group-->
						<!--begin::Input group-->
						<div class="row mb-10">
							<!--begin::Col-->
							<div class="col-md-6 fv-row">
								<!--begin::Label-->
								<label class="d-flex align-items-center fs-6 fw-semibold form-label mb-2">
								<span class="">Sesi Pengajian Semasa</span>&nbsp;<a href="#" data-bs-toggle="tooltip" title="2023/2024"><i class="fa-solid fa-circle-info"></i></a>
								</label>
								<!--end::Label-->
									<!--begin::Input wrapper-->
									<select id="sesi" name="sesi" class="form-select form-select-solid" data-placeholder="Pilih" data-control="select2" data-hide-search="true" {{ in_array($butiranPelajar->status, [2, 3, 4, 6, 7, 8, 9]) ? 'disabled' : '' }}>
										<option></option>
										@if(empty($butiranPelajar->sesi))
											@php
												$currentYear = date('Y');
											@endphp
											@for($year = $currentYear - 1; $year <= ($currentYear + 1); $year++)
												@php
													$sesi = $year . '/' . ($year + 1);
												@endphp
												<option value="{{ $sesi }}">{{ $sesi }}</option>
											@endfor
										@else
											@for($year = date('Y') - 1; $year <= (date('Y') + 1); $year++)
												@php
													$sesi = $year . '/' . ($year + 1);
												@endphp
												@if($butiranPelajar->sesi == $sesi)
													<option value="{{ $sesi }}" selected>{{ $sesi }}</option>
												@else
													<option value="{{ $sesi }}">{{ $sesi }}</option>
												@endif
											@endfor
										@endif
									</select>																		
									<!--end::Input wrapper-->
							</div>
							<!--end::Col-->
							<!--begin::Col-->
							<div class="col-md-6 fv-row">
								<!--begin::Label-->
								<label class="d-flex align-items-center fs-6 fw-semibold form-label mb-2">Mod Pengajian</label>
								<!--end::Label-->
								<!--begin::Input wrapper-->
								<select name="mod" id="mod" class="form-select form-select-solid" onchange="select1()" data-control="select2" data-hide-search="true" data-placeholder="Pilih" {{ in_array($butiranPelajar->status, [2, 3, 4, 6, 7, 8, 9]) ? 'disabled' : '' }}>
									<option></option>
									@foreach ($mod as $mod)
									<option value="{{$mod->kod_mod}}" {{$butiranPelajar->mod == $mod->kod_mod ? 'selected' : ''}}>{{ $mod->mod}}</option>
									@endforeach
								</select>
								<!--end::Input wrapper-->
							</div>
							<!--end::Col-->
						</div>
						<!--end::Input group-->
						<div class="row mb-10">
							<div class="col-md-6 fv-row">
								<!--begin::Label-->
								<label class="d-flex align-items-center fs-6 fw-semibold form-label mb-2">
									<span class="">No Pendaftaran Pelajar</span>
									
								</label>
								<!--end::Label-->
								<input type="text" class="form-control form-control-solid" placeholder="" id="no_pendaftaran_pelajar" name="no_pendaftaran_pelajar" value="{{$butiranPelajar->no_pendaftaran_pelajar}}" {{ in_array($butiranPelajar->status, [2, 3, 4, 6, 7, 8, 9]) ? 'readonly' : '' }}/>
							</div>
							<div class="col-md-6 fv-row">
								<!--begin::Label-->
								<label class="d-flex align-items-center fs-6 fw-semibold form-label mb-2">Tempoh Pengajian (Tahun)</label>
								<!--end::Label-->
									<!--begin::Input wrapper-->
									<select id="tempoh_pengajian" name="tempoh_pengajian" class="form-select form-select-solid" data-placeholder="Pilih" data-control="select2" onchange=dateCheck() data-hide-search="true" required {{ in_array($butiranPelajar->status, [2, 3, 4, 6, 7, 8, 9]) ? 'disabled' : '' }}>
										<option></option>
										@if(empty($butiranPelajar->tempoh_pengajian))
											@for($i = 1; $i <= 4; $i += 0.5)
												<option value="{{ ($i == (int)$i) ? (int)$i : $i }}">{{ ($i == (int)$i) ? (int)$i : number_format($i, 1) }}</option>
											@endfor
										@else
											@for($i = 1; $i <= 4; $i += 0.5)
												@if($butiranPelajar->tempoh_pengajian == ($i == (int)$i ? (int)$i : number_format($i, 1)))
													<option value="{{ ($i == (int)$i) ? (int)$i : $i }}" selected>{{ ($i == (int)$i) ? (int)$i : number_format($i, 1) }}</option>
												@else
													<option value="{{ ($i == (int)$i) ? (int)$i : $i }}">{{ ($i == (int)$i) ? (int)$i : number_format($i, 1) }}</option>
												@endif
											@endfor
										@endif
									</select>																											
									<!--end::Input wrapper-->
							</div>
							<!--end::Col-->
						</div>
						<div class="row mb-10">
							<!--begin::Col-->
							<div class="col-md-6 fv-row">
								<!--begin::Label-->
								<label class=" fs-6 fw-semibold form-label mb-2">Semester Semasa</label>
								<!--end::Label-->
								<!--begin::Row-->
								<div class="row fv-row">
									<!--begin::Input wrapper-->
									<select id="sem_semasa" name="sem_semasa" onchange="select1()" class="form-select form-select-solid" data-placeholder="Pilih" data-control="select2" data-hide-search="true" {{ in_array($butiranPelajar->status, [2, 3, 4, 6, 7, 8, 9]) ? 'disabled' : '' }}>
										<option></option>
										@if(empty($butiranPelajar->sem_semasa))
											@for($i = 1; $i <= 12; $i++)
												<option value="{{ $i }}">{{ $i }}</option>
											@endfor
										@else
											@for($i = 1; $i <= 12; $i++)
												@if($butiranPelajar->sem_semasa == $i)
													<option value="{{ $i }}" selected>{{ $i }}</option>
												@else
													<option value="{{ $i }}">{{ $i }}</option>
												@endif
											@endfor
										@endif
									</select>
									<!--end::Input wrapper-->
								</div>
								<!--end::Row-->
							</div>
							<!--end::Col-->
							<!--begin::Col-->
							<div class="col-md-6 fv-row">
								<!--begin::Label-->
								<label class=" fs-6 fw-semibold form-label mb-2">Bil Bulan Persemester</label>
								<!--end::Label-->
								<!--begin::Row-->
								<div class="row fv-row">
									<!--begin::Input wrapper-->
									<select id="bil_bulan_per_sem" name="bil_bulan_per_sem" class="form-select form-select-solid" data-placeholder="Pilih" data-control="select2" data-hide-search="true" {{ in_array($butiranPelajar->status, [2, 3, 4, 6, 7, 8, 9]) ? 'disabled' : '' }}>
										<option></option>
										@if(!empty($butiranPelajar->bil_bulan_per_sem))
											<option value="{{$butiranPelajar->bil_bulan_per_sem}}" selected>{{$butiranPelajar->bil_bulan_per_sem}}</option>
										@else
											<option value="4">4</option>
											<option value="6">6</option>
										@endif
									</select>
									<!--end::Input wrapper-->
								</div>
								<!--end::Row-->
							</div>
							<!--end::Col-->
						</div>
						<!--begin::Input group-->
						<div class="row mb-10">
							<!--begin::Col-->
							<div class="col-md-6 fv-row">
								<!--begin::Label-->
								<label class="fs-6 fw-semibold form-label mb-2">
									<span class="">Tarikh Mula Pengajian</span>&nbsp;<a href="#" data-bs-toggle="tooltip" title="Ikut Surat Tawaran"><i class="fa-solid fa-circle-info"></i></a>
								</label>
								<!--end::Label-->
									<!--begin::Input wrapper-->
									<input type="date" class="form-control form-control-solid" placeholder="" id="tarikh_mula" name="tarikh_mula" onchange=dateCheck() value="{{$butiranPelajar->tarikh_mula}}" {{ in_array($butiranPelajar->status, [2, 3, 4, 6, 7, 8, 9]) ? 'readonly' : '' }}/>
									<!--end::Input wrapper-->
							</div>
							<!--end::Col-->
							<!--begin::Col-->
							<div class="col-md-6 fv-row">
								<!--begin::Label-->
								<label class="d-flex align-items-center fs-6 fw-semibold form-label mb-2">
									<span class="">Tarikh Tamat Pengajian</span>&nbsp;<a href="#" data-bs-toggle="tooltip" title="Ikut Surat Tawaran"><i class="fa-solid fa-circle-info"></i></a>
								</label>
								<!--end::Label-->
								<!--begin::Input wrapper-->
									<input type="date" class="form-control form-control-solid" placeholder="" id="tarikh_tamat" name="tarikh_tamat" value="{{$butiranPelajar->tarikh_tamat}}" {{ in_array($butiranPelajar->status, [2, 3, 4, 6, 7, 8, 9]) ? 'readonly' : '' }}/>
								<!--end::Input wrapper-->
							</div>
							<!--end::Col-->
						</div>
						<!--end::Input group-->
						<!--begin::Input group-->
						<div class="row mb-10">
							<!--begin::Col-->
							<div class="col-md-6 fv-row">
								<!--begin::Label-->
								<label class=" fs-6 fw-semibold form-label mb-2">Sumber Pembiayaan</label> <a href="#" data-bs-toggle="tooltip" title="CONTOH"><i class="fa-solid fa-circle-info"></i></a>
								<!--end::Label-->
								<!--begin::Row-->
								<div class="row fv-row">
									<!--begin::Input wrapper-->
										<select id="sumber_biaya" name="sumber_biaya" class="form-select form-select-solid" data-control="select2" data-hide-search="true" data-placeholder="Pilih" {{ in_array($butiranPelajar->status, [2, 3, 4, 6, 7, 8, 9]) ? 'disabled' : '' }}>
											<option></option>
											@foreach ($biaya as $biaya)
											<option value="{{$biaya->kod_biaya}}" {{$butiranPelajar->sumber_biaya == $biaya->kod_biaya ? 'selected' : ''}}>{{ $biaya->biaya}}</option>
											@endforeach
										</select>
									<!--end::Input wrapper-->
								</div>
								<!--end::Row-->
							</div>
							<!--end::Col-->
							<!--begin::Col-->
							<div class="col-md-6 fv-row" id="div_biaya_lain">
								<!--begin::Label-->
								<label class="d-flex align-items-center fs-6 fw-semibold form-label mb-2">(Jika Lain-lain) Sila Nyatakan:</label>
								<!--end::Label-->
								<!--begin::Input wrapper-->
								<input type="text" class="form-control form-control-solid" placeholder="" id="sumber_lain" name="sumber_lain" value="{{$butiranPelajar->sumber_lain}}" {{ in_array($butiranPelajar->status, [2, 3, 4, 6, 7, 8, 9]) ? 'readonly' : '' }}/>
								<!--end::Input wrapper-->
							</div>
							<!--end::Col-->
						</div>
						<!--end::Input group-->
						<!--begin::Input group-->
						<div class="row mb-10">
							{{-- @if ($butiranPelajar->sumber_biaya == '1') --}}
							<div class="col-md-6 fv-row" id="div_nama_penaja">
								<!--begin::Label-->
								<label class="d-flex align-items-center fs-6 fw-semibold form-label mb-2">
									<span class="">Nama Penajaaa</span>&nbsp;<a href="#" data-bs-toggle="tooltip" title="CONTOH"><i class="fa-solid fa-circle-info"></i></a>
								</label>															
								<!--end::Label-->
								<select id="nama_penaja" name="nama_penaja" class="form-select form-select-solid" data-placeholder="Pilih" data-control="select2" data-hide-search="true" {{ in_array($butiranPelajar->status, [2, 3, 4, 6, 7, 8, 9]) ? 'disabled' : '' }}>
									<option></option>
									@foreach ($penaja as $penaja)
									<option value="{{$penaja->kod_penaja}}"{{$butiranPelajar->nama_penaja == $penaja->kod_penaja ? 'selected' : ''}}>{{ $penaja->penaja}}</option>
									@endforeach
								</select>
							</div>
							{{-- @endif --}}
							<!--begin::Col-->
							<div class="col-md-6 fv-row" id="div_penaja_lain">
								<!--begin::Label-->
								<label class="d-flex align-items-center fs-6 fw-semibold form-label mb-2">(Jika Lain-lain) Sila Nyatakan:</label>
								<!--end::Label-->
								<!--begin::Input wrapper-->
								<input type="text" class="form-control form-control-solid" placeholder="" id="penaja_lain" name="penaja_lain" value="{{$butiranPelajar->penaja_lain}}" {{ in_array($butiranPelajar->status, [2, 3, 4, 6, 7, 8, 9]) ? 'readonly' : '' }}/>
								<!--end::Input wrapper-->
							</div>
							<!--end::Col-->
						</div>
						<!--end::Input group-->
					</div>
					<!--end::Wrapper-->
				</div>
				<!--end::Step 3-->

				<!--begin::Step 4-->
				<div data-kt-stepper-element="content">
				@csrf
					<!--begin::Wrapper-->
					<div class="w-100">
						<!--begin::Heading-->
						<div class="pb-10 pb-lg-15">
							<!--begin::Title-->
							<h2 class="fw-bold text-dark">Maklumat Bayaran</h2>
							<!--end::Title-->
							<!--begin::Notice-->
							<div class="text-muted fw-semibold fs-6">Bayaran</div>
							<!--end::Notice-->
						</div>
						<!--end::Heading-->
						<!--begin::Input group-->
						<div class="d-flex flex-column mb-7 fv-row">
							<!--begin::Label-->
							<label class="d-flex align-items-center fs-6 fw-semibold form-label mb-2">
								<span class="required">Kadar Bayaran</span>
							</label>
							<!--end::Label-->
							<br>
							<br>
							<input type="hidden" class="form-control form-control-solid" name="max_yuran" id="max_yuran" placeholder="" step="0.01" inputmode="decimal" value="" readonly/>
							<input type="hidden" class="form-control form-control-solid" name="max_wang_saku" id="max_wang_saku" placeholder="" step="0.01" inputmode="decimal" value="" readonly/>
							<div class="row mb-10" id="divyuran">
								<br>
								<br>
								<div class="col-6">
									<input class="form-check-input" type="checkbox" value="1" id="yuran"  name="yuran" onclick="return false" checked/>
									<label class="fs-6 fw-semibold form-label">
										Yuran
									</label>
								</div>
								<div class="col-6">
									<label class="d-flex align-items-center fs-6 fw-semibold form-label mb-2">Amaun Yuran</label>
									<!--begin::Input-->
									<div class="d-flex">
										<span class="input-group-text">RM</span>
										<input type="number" class="form-control form-control-solid" id="amaun_yuran" name="amaun_yuran" onchange="select1()" placeholder="" value="{{$butiranPelajar->amaun_yuran}}" {{ in_array($butiranPelajar->status, [2, 3, 4, 6, 7, 8, 9]) ? 'readonly' : '' }}/>
									</div>
									<!--end::Input-->
								</div>
							</div>
							<br>
							<div class="row mb-10" id="divelaun">
								<br>
								<br>
								<div class="col-6">
									<input class="form-check-input" type="checkbox" value="1" id="wang_saku"  name="wang_saku" onclick="return false" checked/>
									<label class="fs-6 fw-semibold form-label">
										Elaun Wang Saku
									</label>
								</div>
								<div class="col-6">
									<label class="d-flex align-items-center fs-6 fw-semibold form-label mb-2">Amaun Wang Saku</label>
									<!--begin::Input-->
									<div class="d-flex">
										<span class="input-group-text">RM</span>
										<input type="number" class="form-control form-control-solid" name="amaun_wang_saku" id="amaun_wang_saku" placeholder="" value="{{$butiranPelajar->amaun_wang_saku}}" readonly/>
									</div>
									<!--end::Input-->
								</div>
							</div>	
						</div>
					</div>
					<!--end::Wrapper-->
				</div>
				<!--end::Step 4-->

				<!--begin::Step 5-->
				<div data-kt-stepper-element="content">
				@csrf
					<!--begin::Wrapper-->
					<div class="w-100">
						<!--begin::Heading-->
						<div class="pb-10 pb-lg-15">
							<!--begin::Title-->
							<h2 class="fw-bold text-dark">Dokumen</h2>
							<!--end::Title-->
							<!--begin::Notice-->
							<div class="text-muted fw-semibold fs-6">Senarai Dokumen</div>
							<!--end::Notice-->
						</div>
						<!--end::Heading-->
						<!--begin::Table-->
						<table class="table table-row-dashed fs-6 gy-5">
							<thead>
								<tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0">
									<th class="min-w-100px">Nama</th>
									<th class="min-w-100px">Dokumen</th>
									<th class="w-110px">Catatan</th>
								</tr>
							</thead>
							<tbody class="fw-semibold text-gray-600">
								@php
									$user = DB::table('users')->where('no_kp',Auth::user()->no_kp)->first();
									$institusi = DB::table('bk_info_institusi')->where('id_institusi', $user->id_institusi)->first();
								@endphp

								@if (!$dokumen->isEmpty() && ($institusi->jenis_institusi == 'UA' && $dokumen->count() >= 2) || ($institusi->jenis_institusi != 'UA' && $dokumen->count() >= 3))
								@foreach($dokumen as $dok)
									<tr>
										<td class="text-gray-800">
											@if($dok->id_dokumen == '1')
												Salinan Penyata Bank
											@elseif($dok->id_dokumen == '2')
												Salinan Surat Tawaran Pengajian
											@elseif($dok->id_dokumen == '3')
												Salinan Resit/Invois
											@else
												Resit/Invois Tambahan (Jika Ada)	
											@endif
										</td>
										@if($dok->id_dokumen == '1' || $dok->id_dokumen == '2' || $dok->id_dokumen == '3')
											<td><a href="/assets/dokumen/permohonan/{{ $dok->dokumen }}" target="_blank">{{ $dok->dokumen }}</a></td>
											<td><textarea type="text" class="form-control form-control-sm" id="catatan" rows="1" name="catatan" readonly>{{ $dok->catatan }}</textarea></td>
										@else
											<td><a href="/assets/dokumen/permohonan/{{ $dok->dokumen }}" target="_blank">{{ $dok->dokumen }}</a></td>
											<td><textarea type="text" class="form-control form-control-sm" id="catatan" rows="1" name="catatan" readonly>{{ $dok->catatan }}</textarea></td>
										@endif
									</tr>
								@endforeach	
								@else
								@if($institusi->jenis_institusi != 'UA')
								<tr>
									<td class="text-gray-800">Salinan Penyata Bank&nbsp;<a href="/assets/contoh/bank.pdf" target="_blank" data-bs-toggle="tooltip" title="CONTOH"><i class="fa-solid fa-circle-info"></i></a></td>
									<td class="fv-row"><input type="file" class="form-control form-control-sm" id="akaunBank" name="akaunBank"/></td>
									<td><textarea type="text" class="form-control form-control-sm" id="nota_akaunBank" rows="1" name="nota_akaunBank"></textarea></td>
								</tr>
								@endif
								<tr>
									<td class="text-gray-800">Salinan Surat Tawaran Pengajian&nbsp;<a href="/assets/contoh/tawaran.pdf" target="_blank" data-bs-toggle="tooltip" title="CONTOH"><i class="fa-solid fa-circle-info"></i></a></td>
									<td class="fv-row"><input type="file" class="form-control form-control-sm" id="suratTawaran" name="suratTawaran"/></td>
									<td><textarea type="text" class="form-control form-control-sm" id="nota_suratTawaran" rows="1" name="nota_suratTawaran"></textarea></td>
								</tr>
								<tr>
									<td class="text-gray-800">Salinan Resit/Invois&nbsp;<a href="/assets/contoh/resit.pdf" target="_blank" data-bs-toggle="tooltip" title="CONTOH"><i class="fa-solid fa-circle-info"></i></a></td>
									<td class="fv-row"><input type="file" class="form-control form-control-sm" id="invoisResit" name="invoisResit"/></td>
									<td><textarea type="text" class="form-control form-control-sm" id="nota_invoisResit" rows="1" name="nota_invoisResit"></textarea></td>
								</tr>
								 @endif	
								
							</tbody>
							
						</table>
						<!--end::Table-->
						<!--begin::Table-->
						<table class="table table-row-dashed fs-6 gy-5">
							<thead>
								<tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0">
									<th class="min-w-50px"></th>
									<th class="min-w-500px"></th>
								</tr>
							</thead>

							<tbody class="fw-semibold text-gray-600">
								<tr>
									<td>
										<!-- Add More Button -->
										<button class="btn btn-success btn-sm btn-add-more" type="button">+</button>
										<!-- End -->
									</td>
									<td class="input-group control-group img_div form-group col-md-10">
										Resit/Invois Tambahan (Jika Ada)
									</td>
								</tr>
								<tr>
									<!-- Add More Image upload field  -->
									<td class="clone" style="display:none">
										<div class="control-group input-group">
											<input type="file" id="dokumen[]" name="dokumen[]" class="form-control form-control-sm">
											&nbsp;
											&nbsp;
											<textarea type="text" class="form-control form-control-sm" id="catatan[]" rows="1" name="catatan[]"></textarea>
											&nbsp;
											<button class="btn btn-danger btn-sm btn-remove" type="button">x</button>
										</div>
									</td>
									<!-- End -->	
								</tr>
							</tbody>
						</table>
						<!--end::Table-->
						<br>
						<br>
						<div class="pb-10 pb-lg-15">
							<!--begin::Notice-->
							<div class="text-dark fw-semibold fs-6">
								<i class='fas fa-exclamation-triangle' style='color:orange'></i>&nbsp;
								Gunakan kemudahan <a href="https://compressjpeg.com/" target="_blank">di sini</a>untuk mengurangkan saiz fail sebelum memuat naik fail.
							</div>							
							<div class="text-dark fw-semibold fs-6"><i class='fas fa-exclamation-triangle' style='color:orange'></i>&nbsp; Format fail yang boleh dimuat naik adalah format 
							'.pdf', '.jpg', '.png' dan '.jpeg'
							</div>
							<div class="text-dark fw-semibold fs-6"><i class='fas fa-exclamation-triangle' style='color:orange'></i>&nbsp; Saiz maksimum fail adalah 2 MB.
							</div>
							<!--end::Notice-->
						</div>
					</div>
					<!--end::Wrapper-->
				</div>
				<!--end::Step 5-->
				
				<!--begin::Step 6-->
				<div data-kt-stepper-element="content">
				@csrf	
					<!--begin::Wrapper-->
					<div class="w-100">
						<!--begin::Heading-->
						<div class="pb-10 pb-lg-15">
							<!--begin::Title-->
							<h2 class="fw-bold text-dark">Perakuan dan Pengesahan</h2>
							<!--end::Title-->
						</div>
						<!--end::Heading-->
						<div class="d-flex flex-column mb-7 fv-row">
							<div class="form-check">
								<input class="form-check-input" type="checkbox" value="1" id="perakuan" name="perakuan" @if($butiranPelajar->perakuan !== null) checked @endif {{ in_array($butiranPelajar->status, [2, 3, 4, 6, 7, 8, 9]) ? 'disabled' : '' }} />
								<label style="color:black;font-size:18px; text-align: justify;" class="form-check-label" >
								Saya mengaku bahawa segala maklumat yang diberikan adalah betul dan benar belaka. Saya juga faham
								sekiranya maklumat yang diberikan didapati palsu atau tidak benar, pihak kementerian berhak menolak
								permohonan saya dan menghentikan bantuan kewangan ini kepada saya.
								</label>
							</div>
						</div>
					</div>
					<!--end::Wrapper-->
				</div>
				<!--end::Step 6-->
				{{-- @endforeach --}}

				<!--begin::Step 7-->
				<div data-kt-stepper-element="content">
					<!--begin::Wrapper-->
					<div class="w-100">
						<!--begin::Heading-->
						<div class="pb-8 pb-lg-10">
							<!--begin::Title-->
							<h2 class="fw-bold text-dark">Permohonan anda telah dihantar.</h2>
							<!--end::Title-->
						</div>
						<!--end::Heading-->
					</div>
					<!--end::Wrapper-->
				</div>
				<!--end::Step 7-->
				<!--begin::Actions-->
				<div class="d-flex flex-stack pt-10">
					<!--begin::Wrapper-->
					<div class="mr-2">
						<button type="button" class="btn btn-lg btn-light-primary me-3" data-kt-stepper-action="previous">
						<i class="ki-duotone ki-arrow-left fs-4 me-1">
							<span class="path1"></span>
							<span class="path2"></span>
						</i>Kembali</button>
					</div>
					<!--end::Wrapper-->
					<!--begin::Wrapper-->
					<div>
					@if(in_array($butiranPelajar->status, [1, 5, 9]))  
					<button type="submit" class="btn btn-lg btn-primary me-3" data-kt-stepper-action="submit" onclick="if(!this.form.perakuan.checked){alert('Sila tandakan kotak untuk perakuan dan pengesahan.');return false}">
						<span class="indicator-label">Hantar
						<i class="ki-duotone ki-arrow-right fs-3 ms-2 me-0">
							<span class="path1"></span>
							<span class="path2"></span>
						</i></span>
						<span class="indicator-progress">Sila tunggu...
						<span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
					</button>
					
					@endif

					<button type="button" class="btn btn-lg btn-primary{{ in_array($permohonan->status, [1, 5, 9]) ? ' save-next-button' : '' }}" data-kt-stepper-action="next">
						Teruskan
						<i class="ki-duotone ki-arrow-right fs-4 ms-1 me-0">
							<span class="path1"></span>
							<span class="path2"></span>
						</i>
					</button>	
					</div>
					<!--end::Wrapper-->
				</div>
				<!--end::Actions-->
			</form>
			<!--end::Form-->
		</div>
		<!--end::Content-->
									

</div>



<!--begin::Javascript-->

		<!--begin::Global Javascript Bundle(mandatory for all pages)-->
		<script src="/assets/js/scripts.bundle.js"></script>
		<!--end::Global Javascript Bundle-->

		<!--begin::Custom Javascript(used for this page only)-->
		<script src="/assets/js/custom/utilities/modals/create-account.js"></script>
		<!--end::Custom Javascript-->
		<!--end::Javascript-->

		<script src = "https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
		<script type="text/javascript">
   
			$(".save-next-button").click(function(e){
				e.preventDefault();
				var data = $('#kt_create_account_form').serialize();
				//alert (data);
				$.ajax({
					type: 'post',
					url: "{{ route('simpan') }}",
					data: data,

				});
				
			});
		</script> 
		<script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
		<script>
			function myFunction() {
			var checkBox = document.getElementById("sama");  
			var alamat_tetap = document.getElementById("alamat_tetap");
			var alamat_tetap_negeri = document.getElementById("alamat_tetap_negeri");
			var alamat_tetap_bandar = document.getElementById("alamat_tetap_bandar");
			var alamat_tetap_poskod = document.getElementById("alamat_tetap_poskod");

			var alamat_surat_menyurat = document.getElementById("alamat_surat_menyurat");
			var alamat_surat_negeri = document.getElementById("alamat_surat_negeri");
			var alamat_surat_bandar = document.getElementById("alamat_surat_bandar");
			var alamat_surat_poskod = document.getElementById("alamat_surat_poskod");
			if (checkBox.checked == true){
				alamat_surat_menyurat.value=alamat_tetap.value; 
				alamat_surat_negeri.value=alamat_tetap_negeri.value;
				alamat_surat_bandar.value=alamat_tetap_bandar.value;
				alamat_surat_poskod.value=alamat_tetap_poskod.value;
				// Trigger select2 update
				$(alamat_surat_negeri).trigger('change.select2');
        		$(alamat_surat_bandar).trigger('change.select2');
			} else {
				alamat_surat_menyurat.value="";
				alamat_surat_negeri.value="";
				alamat_surat_bandar.value="";
				alamat_surat_poskod.value="";
				// Trigger select2 update
				$(alamat_surat_negeri).trigger('change.select2');
        		$(alamat_surat_bandar).trigger('change.select2');
			}
		}	

			$(document).ready(function(){
				$('#alamat_tetap_negeri').on('change', function() {
					var idnegeri = $(this).val();
					//alert(id);
					// Empty the dropdown
					$('#alamat_tetap_bandar').find('option').not(':first').remove();

					// AJAX request 
					$.ajax({
						
						url: 'getBandar/'+idnegeri,
						type: 'get',
						dataType: 'json',
						success: function(response){
							//alert('AJAX loaded something');
							var len = 0;
									if(response['data'] != null){
										len = response['data'].length;
									}

									if(len > 0){
										// Read data and create <option >
										for(var i=0; i<len; i++){

											var id = response['data'][i].id;
											var bandar = response['data'][i].bandar;

											var option = "<option value='"+id+"'>"+bandar+"</option>";

											$("#alamat_tetap_bandar").append(option); 
										}
									}
							}, 
							error: function(){
							alert('AJAX load did not work');
							}

					});
				});

			});

			//parlimen
			$(document).ready(function(){
				$('#alamat_tetap_negeri').on('change', function() {
					var idnegeri = $(this).val();
					//alert(id);
					// Empty the dropdown
					$('#parlimen').find('option').not(':first').remove();

					// AJAX request 
					$.ajax({
						
						url: '/getParlimen/'+idnegeri,
						type: 'get',
						dataType: 'json',
						success: function(response){
							//alert('AJAX loaded something');
							var len = 0;
									if(response['data'] != null){
										len = response['data'].length;
									}

									if(len > 0){
										// Read data and create <option >
										for(var i=0; i<len; i++){

											var id = response['data'][i].id;
											var kod = response['data'][i].kod_parlimen;
											var parlimen = response['data'][i].parlimen.toUpperCase();

											var option = "<option value='"+id+"'>"+kod+" - "+parlimen+"</option>";

											$("#parlimen").append(option); 
										}
									}
							}, 
							error: function(){
							alert('AJAX load did not work');
							}

					});
				});

			});

			//dun
			$(document).ready(function(){
				$('#parlimen').on('change', function() {
					var idparlimen = $(this).val();
					// alert(idparlimen);
					// Empty the dropdown
					$('#dun').find('option').not(':first').remove();

					// AJAX request 
					$.ajax({
						
						url: '/getDun/'+idparlimen,
						type: 'get',
						dataType: 'json',
						success: function(response){
							//alert('AJAX loaded something');
							var len = 0;
									if(response['data'] != null){
										len = response['data'].length;
									}

									if(len > 0){
										// Read data and create <option >
										for(var i=0; i<len; i++){

											var id = response['data'][i].id;
											var kod_dun = response['data'][i].kod_dun;
											var dun = response['data'][i].dun.toUpperCase();

											var option = "<option value='"+id+"'>"+kod_dun+"-"+dun+"</option>";

											$("#dun").append(option); 
										}
									}
							}, 
							error: function(){
							alert('AJAX load did not work');
							}

					});
				});

			});

    		$(document).ready(function(){
				$('#alamat_negeri_waris').on('change', function() {
					var idnegeri = $(this).val();
					//alert(id);
					// Empty the dropdown
					$('#alamat_bandar_waris').find('option').not(':first').remove();

					// AJAX request 
					$.ajax({
						
						url: '/bandar/'+idnegeri,
						type: 'get',
						dataType: 'json',
						success: function(response){
							//alert('AJAX loaded something');
							var len = 0;
									if(response['data'] != null){
										len = response['data'].length;
									}

									if(len > 0){
										// Read data and create <option >
										for(var i=0; i<len; i++){

											var id = response['data'][i].id;
											var bandar = response['data'][i].bandar;

											var option = "<option value='"+id+"'>"+bandar+"</option>";

											$("#alamat_bandar_waris").append(option); 
										}
									}
							}, 
							error: function(){
							alert('AJAX load did not work');
							}

					});
				});

			});

			$(document).ready(function() {
			$('.js-example-basic-single').select2();
			});
		</script>

		<script>
			//BEKERJA
			$(document).ready(function(){
				var status_pekerjaan = document.getElementById('status_pekerjaan').value;
				if ( this.value == "BEKERJA"){
					$("#div_pekerjaan").show();
					$("#div_pendapatan").show();
				}
				else {
					$("#div_pekerjaan").hide();
					$("#div_pendapatan").hide();
				}
				
				$('#status_pekerjaan').on('change', function() {
				if ( this.value == "BEKERJA"){
					$("#div_pekerjaan").show();
					$("#div_pendapatan").show();
				}
				else {
					$("#div_pekerjaan").hide();
					$("#div_pendapatan").hide();
				}
				});

			});

			//WARIS LAIN-LAIN
			$(document).ready(function(){
				$("#div_waris_lain").hide();
				$('#hubungan_waris').on('change', function() {
				if ( this.value == '6'){
					$("#div_waris_lain").show();
				}
				else {
					$("#div_waris_lain").hide();
				}
				});
			});

			//SUMBER BIAYA LAIN-LAIN
			$(document).ready(function () {
				$("#div_biaya_lain").hide();
				// $("#div_nama_penaja").hide();

				var penajaOptions = {!! json_encode($penajaArray) !!};
				// console.log("nama_penaja value:", {!! json_encode($butiranPelajar->nama_penaja) !!});

				// Ensure penajaOptions is an array before attempting to iterate
				if (Array.isArray(penajaOptions)) {
					$('#sumber_biaya').on('change', function () {
						var selectedValue = this.value;

						if (selectedValue == '5') {
							$("#div_biaya_lain").show();
							$("#div_nama_penaja").hide();
							$('#nama_penaja').empty().append('<option value="">Pilih</option>');
						} else if (selectedValue == '2' || selectedValue == '3' || selectedValue == '4') {
							$("#div_nama_penaja").hide();
							$("#div_biaya_lain").hide();
							$('#nama_penaja').empty().append('<option value="">Pilih</option>');
						} else {
							$("#div_biaya_lain").hide();
							$("#div_nama_penaja").show();

							// Update options based on the selected value
							$('#nama_penaja').empty().append('<option value="">Pilih</option>');
							var preSelectedValue = {!! json_encode($butiranPelajar->nama_penaja) !!};
							// console.log("Pre-selected Value:", preSelectedValue);

							penajaOptions.forEach(function (penaja) {
								// console.log("Comparing:", preSelectedValue, penaja.kod_penaja);

								// Check if the option matches the pre-selected value
								var isSelected = preSelectedValue == penaja.kod_penaja;

								// console.log("Is Selected:", isSelected);

								$('#nama_penaja').append('<option value="' + penaja.kod_penaja + '"' + (isSelected ? ' selected' : '') + '>' + penaja.penaja + '</option>');
							});
						}
					});
				} else {
					console.error("Error: penajaOptions is not an array");
				}
			});


			//PENAJA LAIN-LAIN
			$(document).ready(function(){
				$("#div_penaja_lain").hide();
				$('#nama_penaja').on('change', function() {
				if ( this.value == '9'){
					$("#div_penaja_lain").show();
				}
				else {
					$("#div_penaja_lain").hide();
				}
				});
			});

			function dateCheck(){
				let startDate = new Date($("#tarikh_mula").val());
				let endDate = new Date($("#tarikh_tamat").val());
				var studyPeriod = parseFloat(document.getElementById("tempoh_pengajian").value);

				if (!isNaN(studyPeriod)) {
				//alert(studyPeriod);
				 	endDate.setFullYear(startDate.getFullYear() + Math.floor(studyPeriod));

				 	var remainingMonths = (studyPeriod - Math.floor(studyPeriod)) * 12;
				 	endDate.setMonth(startDate.getMonth() + Math.floor(remainingMonths));

				 	document.getElementById("tarikh_tamat").valueAsDate = endDate;
				}

			}


			//TAMBAH UPLOAD FILE
			// $("#tambahresit").hide();
			// function onButtonClick() {
			// 	$("#tambahresit").show();
			// }
			$(document).ready(function() {
 
			$(".btn-add-more").click(function(){ 
				var html = $(".clone").html();
				$(".img_div").after(html);
			});

			$("body").on("click",".btn-remove",function(){ 
				$(this).parents(".control-group").remove();
			});

			});
			
			
		</script>
		<script type='text/javascript'>
			$(document).ready(function(){
	
				// institusi Change
				$('#id_institusi').change(function(){
	
					// institusi id
					var id_institusi = $(this).val();
					//alert (id_institusi);
	
					// Empty the dropdown
					$('#peringkat_pengajian').find('option').not(':first').remove();
					$('#nama_kursus').find('option').not(':first').remove();
	
					// AJAX request 
					$.ajax({
						url: '/peringkat/'+id_institusi,
						type: 'get',
						dataType: 'json',
						success: function(response){
							//alert('AJAX loaded something');
	
							var len = 0;
							if(response['data'] != null){
								len = response['data'].length;
							}
	
							if(len > 0){
								// Read data and create <option >
								for(var i=0; i<len; i++){
	
									var id_institusi = response['data'][i].id_institusi;
									var kod_peringkat = response['data'][i].kod_peringkat;
									var peringkat = response['data'][i].peringkat;
	
									var option = "<option value='"+kod_peringkat+"'>"+peringkat+"</option>";
	
									$("#peringkat_pengajian").append(option); 
								}
							}
	
						},
						error: function(){
						alert('AJAX load did not work');
						}
					});
	
				});
	
				// peringkat Change
				$('#peringkat_pengajian').change(function(){
	
				// institusi id
				var idipt = $(id_institusi).val();
				var kodperingkat = $(this).val();
	
				// Empty the dropdown
				$('#nama_kursus').find('option').not(':first').remove();
				//alert(idipt);
	
	
				// AJAX request 
				$.ajax({
					url: '/kursus/'+kodperingkat+'/'+idipt,
					type: 'get',
					dataType: 'json',
				
					success: function(response){
	
						var len = 0;
						if(response['data'] != null){
							len = response['data'].length;
						}
	
						if(len > 0){
							// Read data and create <option >
							for(var i=0; i<len; i++){
	
								var id_institusi = response['data'][i].id_institusi;
								var kod_peringkat = response['data'][i].kod_peringkat;
								var nama_kursus = response['data'][i].nama_kursus;
								var kod_nec = response['data'][i].kod_nec;
								var bidang = response['data'][i].bidang.toUpperCase();
								var uppercaseValue  = response['data'][i].nama_kursus.toUpperCase();
	
								var option = "<option value='"+nama_kursus+"'>"+uppercaseValue+" - "+kod_nec+" ( "+bidang+" )</option>";
	
								$("#nama_kursus").append(option); 
								
							}
						}
	
					}
				});
	
				});
		
			});

			</script>


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
	function select1(){
		console.clear();
		
		// var sumber = document.getElementById('sumber_biaya').value;
		// var mod = document.getElementById('mod').value;
		// $('#mod').on('change', function() {
			// Store the value of 'sumber_biaya' element in sessionStorage with key 'mod'
			sessionStorage.setItem('mod', document.getElementById('mod').value);

		// });
		// $('#sumber_biaya').on('change', function() {
			// sessionStorage.setItem('sumber', $(this).val());
			// Store the value of 'sumber_biaya' element in sessionStorage with key 'mod'
			sessionStorage.setItem('sumber', document.getElementById('sumber_biaya').value);

		// });
		

		var mod = sessionStorage.getItem('mod');
		var sumber = sessionStorage.getItem('sumber');
		var bilbulan = document.getElementById('bil_bulan_per_sem').value;
		console.log("Debug - mod: ", mod);
		console.log("Debug - sumber: ", sumber);
		

		var max_yuran = parseFloat(document.getElementById('max_yuran').value).toFixed(2);
		var max_wang_saku = parseFloat(document.getElementById('max_wang_saku').value).toFixed(2);

		// var max_wang_saku = document.getElementById('max_wang_saku').value.toFixed(2);
		var yuranInput = document.getElementById('amaun_yuran');
		var yuran = parseFloat(yuranInput.value).toFixed(2);

		// Define the maximum limit for 'amaun_yuran'
		var maxLimit = max_yuran;
		console.log(yuran > maxLimit);  // This will be false

		if (!isNaN(yuran)) {
			if (parseFloat(yuran) > parseFloat(maxLimit)) {
				yuranInput.value = '';
				alert('Ralat: Amaun Yuran Pengajian dan Wang Saku tidak boleh melebihi RM'+ maxLimit+ ' / tahun kalendar akademik.' );
				return;
			}
		}
		
		
		
		
		
		if (mod === '1' && sumber === '1') { //sepenuh masa && biasiswa
			// console.log("Condition mod==='1' && sumber==='1' is met.");
			// console.log("Debug - mod: ", mod);
			// console.log("Debug - sumber: ", sumber);
			// console.log("Debug - bil bulan: ", bilbulan);
			// console.log("wang_saku_perbulan: ", wang_saku_perbulan);
			// console.log("wang_saku: ", wang_saku);
			var wang_saku_perbulan = max_wang_saku;

			var wang_saku = wang_saku_perbulan * bilbulan;

			document.getElementById("divyuran").style.display = "none";
			document.getElementById("divelaun").style.display = "";
			document.getElementById("wang_saku").disabled = false;
			document.getElementById("yuran").value = '';
			document.getElementById("amaun_yuran").value = '';
			document.getElementById("amaun_wang_saku").value = wang_saku.toFixed(2);
		}
		else if(mod === '1' && sumber === '4'){
			console.log("Condition mod==='1' && sumber==='4' is met.");
			console.log("Debug - mod: ", mod);
			console.log("Debug - sumber: ", sumber);

			var wang_saku_perbulan = max_wang_saku;

			var wang_saku = wang_saku_perbulan * bilbulan;

			console.log("Total amount yuran: " + parseFloat(yuran));
			if (isNaN(yuran)) {
				yuran = 0; // Set yuran to 0 or handle it as needed
			}
			var total = (parseFloat(wang_saku) + parseFloat(yuran)).toFixed(2);
			if (total <= max_yuran) {
				document.getElementById("amaun_wang_saku").value= wang_saku.toFixed(2);
				console.log("Total amount is within the limit: " + parseFloat(total));
			} else {

				var baki_wang_saku = max_yuran - yuran;
				if (!isNaN(baki_wang_saku)) {
					document.getElementById("amaun_wang_saku").value = parseFloat(baki_wang_saku).toFixed(2);
					console.log("Total amount exceeds the limit: " + parseFloat(total));
				} 
				else {
					document.getElementById("amaun_wang_saku").value = "";
					console.log("Invalid input. Cannot calculate total amount.");
				}

			}
			document.getElementById("yuran").value = '1';
			document.getElementById("divyuran").style.display = "";
			document.getElementById("yuran").disabled = false;
			document.getElementById("divelaun").style.display = "";
			document.getElementById("wang_saku").value = '1';
			document.getElementById("wang_saku").disabled = false;
			
		}
		else if(mod === '1' && sumber === '3'){
			console.log("Condition mod==='1' && sumber==='3' is met.");
			console.log("Debug - mod: ", mod);
			console.log("Debug - sumber: ", sumber);

			var wang_saku_perbulan = max_wang_saku;

			var wang_saku = wang_saku_perbulan * bilbulan;

			console.log("Total amount yuran: " + parseFloat(yuran));
			if (isNaN(yuran)) {
				yuran = 0; // Set yuran to 0 or handle it as needed
			}
			var total = (parseFloat(wang_saku) + parseFloat(yuran)).toFixed(2);
			if (total <= max_yuran) {
				document.getElementById("amaun_wang_saku").value= wang_saku.toFixed(2);
				console.log("Total amount is within the limit: " + parseFloat(total));
			} else {

				var baki_wang_saku = max_yuran - yuran;
				if (!isNaN(baki_wang_saku)) {
					document.getElementById("amaun_wang_saku").value = parseFloat(baki_wang_saku).toFixed(2);
					console.log("Total amount exceeds the limit: " + parseFloat(total));
				} 
				else {
					document.getElementById("amaun_wang_saku").value = "";
					console.log("Invalid input. Cannot calculate total amount.");
				}

			}
			document.getElementById("yuran").value = '1';
			document.getElementById("divyuran").style.display = "";
			document.getElementById("yuran").disabled = false;
			document.getElementById("divelaun").style.display = "";
			document.getElementById("wang_saku").value = '1';
			document.getElementById("wang_saku").disabled = false;

			
		}
		else if(mod === '2' && sumber !== '1'){
			console.log("Condition mod ==='2' && sumber !=='1' is met.");
			document.getElementById("yuran").value = '1';
			document.getElementById("divyuran").style.display = "";
			document.getElementById("yuran").disabled = false;
			document.getElementById("divelaun").style.display = "none";
			document.getElementById("wang_saku").value = '';
			document.getElementById("amaun_wang_saku").value = '';


		}
		else if(mod === '2' && sumber === '1'){
			console.log("Condition mod ==='2' && sumber ==='1' is met.");
			document.getElementById("divyuran").style.display = "none";
			document.getElementById("divelaun").style.display = "none";
		}
		else{
			var wang_saku_perbulan = max_wang_saku;

			var wang_saku = wang_saku_perbulan * bilbulan;

			document.getElementById("divyuran").style.display = "none";
			document.getElementById("yuran").value = '';
			document.getElementById("amaun_yuran").value = '';
			document.getElementById("divelaun").style.display = "";
			document.getElementById("wang_saku").disabled = false;
			document.getElementById("wang_saku").value = '1';
			document.getElementById("amaun_wang_saku").value = wang_saku.toFixed(2);
			
		}
		



		
	}

</script>

		


</x-default-layout>
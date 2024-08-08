<x-default-layout> 
<head>
	<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

	<style>
		.bs-example{
			margin: 60px 0;
		}
		button{
			margin-right: 30px;
		}
		i{
			font-size: 22px;
		}
	</style>
</head>	
		
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
            <div class="stepper-nav flex-center flex-wrap mb-10">
				<!--begin::Step 1-->
                <div class="stepper-item mx-8 my-4 current" data-kt-stepper-element="nav" data-kt-stepper-action="step">
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
                <div class="stepper-item mx-8 my-4" data-kt-stepper-element="nav" data-kt-stepper-action="step">
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
							<h3 class="stepper-title">Maklumat Ibu Bapa / Penjaga</h3>
							<div class="stepper-desc fw-semibold">Profil Ibu Bapa / Penjaga</div>
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
                <div class="stepper-item mx-8 my-4" data-kt-stepper-element="nav" data-kt-stepper-action="step">
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
							<div class="stepper-desc fw-semibold">Profil Akademik</div>
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
                <div class="stepper-item mx-8 my-4" data-kt-stepper-element="nav" data-kt-stepper-action="step">
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
							<h3 class="stepper-title">Maklumat Tuntutan</h3>
							<div class="stepper-desc fw-semibold">Tuntutan</div>
						</div>
						<!--end::Label-->
						
					</div>
					<!--end::Wrapper-->
					<div class="stepper-line h-40px"></div>
				</div>
				<!--end::Step 4-->
				<!--begin::Step 5-->
                <div class="stepper-item mx-8 my-4" data-kt-stepper-element="nav" data-kt-stepper-action="step">
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
                <div class="stepper-item mx-8 my-4" data-kt-stepper-element="nav" data-kt-stepper-action="step">
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
                <div class="stepper-item mx-8 my-4" data-kt-stepper-element="nav" data-kt-stepper-action="step">
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
			<form id="kt_create_account_form" action="{{ route('ppk.hantar') }}" method="post" class="card-body py-20 w-100 mw-xl-700px px-9" enctype="multipart/form-data">
				
				@foreach ($butiranPelajar as $butiranPelajar)
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
									<select id='keturunan' name='keturunan' class="form-select form-select-lg form-select-solid js-example-basic-single"  data-control="select2" data-hide-search="true" {{ in_array($butiranPelajar->status, [2, 3, 4, 6, 7, 8, 9]) ? 'disabled' : '' }}>
										<option value="">Pilih</option>
										@foreach ($keturunan as $keturunan)	
										<option value="{{$keturunan->id}}" {{$butiranPelajar->kod_keturunan == $keturunan->id ? 'selected' : ''}}>{{ strtoupper($keturunan->keturunan)}}</option>
										@endforeach
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
									<input type="hidden" class="form-control form-control-solid" placeholder="" id="alamat_negeri" name="alamat_negeri" value="{{$butiranPelajar->alamat_tetap_negeri}}" />
									<select id="alamat_tetap_negeri" name="alamat_tetap_negeri" class="form-select form-select-lg form-select-solid js-example-basic-single"  data-control="select2" data-hide-search="true" {{ in_array($butiranPelajar->status, [2, 3, 4, 6, 7, 8, 9]) ? 'disabled' : '' }}>{{$butiranPelajar->alamat_tetap_baru}}>
										<option></option>
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
								<label class=" fs-6 fw-semibold form-label mb-2">Bandar
								</label>
								<!--end::Label-->
								<!--begin::Input wrapper-->
								<div class="col-12">
									<!--begin::Input-->
									<input type="hidden" class="form-control form-control-solid" placeholder="" id="alamat_bandar" name="alamat_bandar" value="{{$butiranPelajar->alamat_tetap_bandar}}" />
									<select id='alamat_tetap_bandar' name='alamat_tetap_bandar' class="form-select form-select-lg form-select-solid js-example-basic-single" data-placeholder="Pilih"  data-control="select2" data-hide-search="true" {{ in_array($butiranPelajar->status, [2, 3, 4, 6, 7, 8, 9]) ? 'disabled' : '' }}>
										<option></option>
										{{-- @foreach ($bandar as $bandartetap)	
										<option value="{{$bandartetap->id}}" {{$butiranPelajar->alamat_tetap_bandar == $bandartetap->id ? 'selected' : ''}}>{{ $bandartetap->bandar}}</option>
										@endforeach --}}
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
								<label class=" fs-6 fw-semibold form-label mb-2">Parlimen (Jika ada)</label>
								<!--end::Label-->
								<!--begin::Input wrapper-->
								<div class="col-12">
									<!--begin::Input-->
									<input type="hidden" class="form-control form-control-solid" placeholder="" id="parlimen_asal" name="parlimen_asal" value="{{$butiranPelajar->id_parlimen}}" />
									<select id='parlimen' name='parlimen' class="form-select form-select-lg form-select-solid js-example-basic-single" data-placeholder="Pilih" data-control="select2" data-hide-search="true" {{ in_array($butiranPelajar->status, [2, 3, 4, 6, 7, 8, 9]) ? 'disabled' : '' }}>
										<option></option>
									</select>
									<!--end::Input-->
								</div>
								<!--end::Input wrapper-->
							</div>
							<div class="col-md-5 fv-row" id="divdun">
								<!--begin::Label-->
								<label class=" fs-6 fw-semibold form-label mb-2">DUN (Jika ada)</label>
								<!--end::Label-->
								<!--begin::Input wrapper-->
								<div class="col-12">
									<!--begin::Input-->
									<input type="hidden" class="form-control form-control-solid" placeholder="" id="dunn" name="dunn" value="{{$butiranPelajar->dun}}" />
									<select id="dun" name="dun" class="form-select form-select-lg form-select-solid js-example-basic-single" data-placeholder="Pilih" data-control="select2" data-hide-search="true" {{ in_array($butiranPelajar->status, [2, 3, 4, 6, 7, 8, 9]) ? 'disabled' : '' }}>
										<option></option>
										{{-- @foreach ($dun as $dun)	
										<option value="{{$dun->id}}" {{$butiranPelajar->dun == $dun->id ? 'selected' : ''}}>{{ $dun->kod_dun}} - {{ strtoupper($dun->dun)}}</option>
										@endforeach --}}
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
								<div class="col-md-4 fv-row">
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
								<div class="col-md-5 fv-row">
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
									<input type="text" maxlength="12" class="form-control form-control-solid" id="tel_bimbit" name="tel_bimbit" placeholder="" value="{{$butiranPelajar->tel_bimbit_baru}}" {{ in_array($butiranPelajar->status, [2, 3, 4, 6, 7, 8, 9]) ? 'readonly' : '' }}/>
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
									<input type="text" maxlength="12" class="form-control form-control-solid" id="tel_rumah" name="tel_rumah" placeholder="" value="{{$butiranPelajar->tel_rumah_baru}}" {{ in_array($butiranPelajar->status, [2, 3, 4, 6, 7, 8, 9]) ? 'readonly' : '' }}/>
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
							<!--end::Input group-->
							<!--begin::Input group-->
							<div class="separator my-14"></div>
							<div class="pb-10 pb-lg-15">
								<!--begin::Title-->
								<h2 class="fw-bold text-dark">Maklumat Perbankan</h2>
								<!--end::Title-->
								<!--begin::Notice-->
								<div class="text-muted fw-semibold fs-6">Bank Islam</div>
								<div class="fw-semibold fs-4" style="color: red">* Pelajar perlu memastikan akaun bank berstatus aktif</div>
								<!--end::Notice-->
							</div>
							<div class="col-md-6 fv-row">
								<!--begin::Label-->
								<label class=" fs-6 fw-semibold form-label mb-2">No. Akaun Bank</label>&nbsp;
								<td>
									<span data-bs-toggle="tooltip" data-bs-trigger="hover" title="16113020138680">
										<i class="fa-solid fa-circle-info" style="color: rgb(18, 178, 231);"></i>
									</span>
								</td>
								<!--end::Label-->
								<!--begin::Input wrapper-->
								<div class="col-12">
									<!--begin::Input-->
									<input type="text" class="form-control form-control-solid" maxlength="14" id="no_akaun_bank" name="no_akaun_bank" placeholder="" value="{{ $butiranPelajar->no_akaun_bank }}" {{ in_array($butiranPelajar->status, [2, 3, 4, 6, 7, 8, 9]) ? 'readonly' : '' }}/>
									<!--end::Input-->
								</div>
								<!--end::Input wrapper-->
							</div>
							
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
							<h2 class="fw-bold text-dark">Maklumat Ibu Bapa / Penjaga</h2>
							<!--end::Title-->
							<!--begin::Notice-->
							<div class="text-muted fw-semibold fs-6">Profil Ibu Bapa / Penjaga</div>
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
								<label class=" fs-6 fw-semibold form-label mb-2">No. Pasport (Jika ada)</label>
								<!--end::Label-->
								<!--begin::Row-->
								<div class="row fv-row">
									<!--begin::Col-->
									<div class="col-12">
										<input type="text" maxlength="9" class="form-control form-control-lg form-control-solid" id="no_pasport_waris" name="no_pasport_waris" placeholder="" value="{{$butiranPelajar->no_pasport_waris}}" {{ in_array($butiranPelajar->status, [2, 3, 4, 6, 7, 8, 9]) ? 'readonly' : '' }}/>
									</div>
									<!--end::Col-->
								</div>
								<!--end::Row-->
							</div>
						</div>
						<div class="row mb-10">
							<!--begin::Label-->
							<div class="col-md-6 fv-row">
								<label class="form-label mb-6">Hubungan</label>
								<select id="hubungan_waris" name="hubungan_waris" class="form-select form-select-lg form-select-solid hubungan_waris" data-control="select2" data-placeholder="Pilih" {{ in_array($butiranPelajar->status, [2, 3, 4, 6, 7, 8, 9]) ? 'disabled' : '' }}>
									<option></option>
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
								<input type="text" maxlength="12" class="form-control form-control-solid" id="tel_bimbit_waris" name="tel_bimbit_waris" placeholder="" value="{{$butiranPelajar->tel_bimbit_waris}}"  {{ in_array($butiranPelajar->status, [2, 3, 4, 6, 7, 8, 9]) ? 'readonly' : '' }}/>
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
							<!--begin::Input group-->
							<div class="fv-row mb-7">
								<!--begin::Wrapper-->
								<div class="d-flex flex-stack">
									<!--begin::Label-->
									<div class="me-5">
										<!--begin::Input-->
										<input class="form-check-input" id="sama_waris" name="sama_waris" onclick="alamatWaris()" type="checkbox" value="1" @if($butiranPelajar->alamat_waris == $butiranPelajar->alamat_tetap_baru) checked @endif/>
										<!--end::Input-->
										<!--begin::Label-->
										<label class="form-label">Sama seperti Alamat Tetap Pelajar</label>
										<!--end::Label-->
									</div>
									<!--end::Label-->
								</div>
								<!--begin::Wrapper-->
							</div>
							<!--end::Input group-->
							<!--begin::Input-->
							<textarea id="alamat_waris" name="alamat_waris" class="form-control form-control-lg form-control-solid" rows="2" style="text-transform: uppercase;" {{ in_array($butiranPelajar->status, [2, 3, 4, 6, 7, 8, 9]) ? 'readonly' : '' }}> {{$butiranPelajar->alamat_waris}}</textarea>
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
									<select id="alamat_negeri_waris" name="alamat_negeri_waris" class="form-select form-select-lg form-select-solid js-example-basic-single"  data-control="select2" data-hide-search="true" {{ in_array($butiranPelajar->status, [2, 3, 4, 6, 7, 8, 9]) ? 'disabled' : '' }}>
										<option value="">Pilih</option>
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
									<select id='alamat_bandar_waris' name='alamat_bandar_waris' class="form-select form-select-lg form-select-solid js-example-basic-single"  data-control="select2" data-hide-search="true" {{ in_array($butiranPelajar->status, [2, 3, 4, 6, 7, 8, 9]) ? 'disabled' : '' }}>
										<option value="">Pilih</option>
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
								<label class="fs-6 fw-semibold form-label mb-2">Pekerjaan</label>
								<!--end::Label-->
								<!--begin::Input wrapper-->
								<div class="col-12">
									<!--begin::Input-->
									<input type="text" class="form-control form-control-solid" id="pekerjaan_waris" name="pekerjaan_waris" style="text-transform: uppercase;" placeholder="" value="{{$butiranPelajar->pekerjaan_waris}}" {{ in_array($butiranPelajar->status, [2, 3, 4, 6, 7, 8, 9]) ? 'readonly' : '' }}/>
									<!--end::Input-->
								</div>
								<!--end::Input wrapper-->
							</div>
							<div class="col-md-6 fv-row">
								<!--begin::Label-->
								<label class="fs-6 fw-semibold form-label mb-2">
									Pendapatan Bulanan&nbsp;
									<span data-bs-toggle="tooltip" data-bs-trigger="hover" title="Nilai tanpa .00">
										<i class="fa-solid fa-circle-info" style="color: rgb(18, 178, 231);"></i>
									</span>
								</label>
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
								<select id="id_institusi" name="id_institusi" class="form-select form-select-solid" data-control="select2" data-hide-search="true" data-placeholder="Pilih" {{ in_array($butiranPelajar->status, [2, 3, 4, 6, 7, 8, 9]) ? 'readonly' : '' }}>
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
									<select id="peringkat_pengajian" name="peringkat_pengajian" class="form-select form-select-solid" data-placeholder="Pilih" data-control="select2" data-hide-search="true" {{ in_array($butiranPelajar->status, [2, 3, 4, 6, 7, 8, 9]) ? 'readonly' : '' }}>
										<option value="3">SIJIL ASAS / SIJIL</option>
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
							<select id="nama_kursus" name="nama_kursus" class="form-select form-select-solid" data-control="select2" data-hide-search="true" data-placeholder="Pilih" {{ in_array($butiranPelajar->status, [2, 3, 4, 6, 7, 8, 9]) ? 'readonly' : '' }}>
								<option value="{{ $butiranPelajar->nama_kursus}}">{{ strtoupper($butiranPelajar->nama_kursus)}}</option>
							</select>
						</div>
						<!--end::Input group-->
						<!--begin::Input group-->
						<div class="row mb-10">
							<!--begin::Col-->
							<div class="col-md-6 fv-row">
								<!--begin::Label-->
								<label class="fs-6 fw-semibold form-label mb-2">
									Sesi Pengajian Semasa&nbsp;
									<span data-bs-toggle="tooltip" data-bs-trigger="hover" title="2023/2024">
										<i class="fa-solid fa-circle-info" style="color: rgb(18, 178, 231);"></i>
									</span>
								</label>
								<!--end::Label-->
									<!--begin::Input wrapper-->
									<select id="sesi" name="sesi" class="form-select form-select-solid" data-control="select2" data-hide-search="true" {{ in_array($butiranPelajar->status, [2, 3, 4, 6, 7, 8, 9]) ? 'disabled' : '' }}>
										<option value="">Pilih</option>
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
								<select name="mod" id="mod" class="form-select form-select-solid" data-control="select2" data-hide-search="true" {{ in_array($butiranPelajar->status, [2, 3, 4, 6, 7, 8, 9]) ? 'disabled' : '' }}>
									<option value="1">SEPENUH MASA</option>
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
									<select id="tempoh_pengajian" name="tempoh_pengajian" onchange=dateCheck() class="form-select form-select-solid" data-control="select2" data-hide-search="true" required {{ in_array($butiranPelajar->status, [2, 3, 4, 6, 7, 8, 9]) ? 'disabled' : '' }}>
										<option value="">Pilih</option>
										@if(empty($butiranPelajar->tempoh_pengajian))
											@for($i = 1; $i <= 2; $i += 0.5)
												<option value="{{ ($i == (int)$i) ? (int)$i : $i }}">{{ ($i == (int)$i) ? (int)$i : number_format($i, 1) }}</option>
											@endfor
										@else
											@for($i = 1; $i <= 2; $i += 0.5)
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
									<select id="sem_semasa" name="sem_semasa" onchange="select1()" class="form-select form-select-solid" data-control="select2" data-hide-search="true" {{ in_array($butiranPelajar->status, [2, 3, 4, 6, 7, 8, 9]) ? 'disabled' : '' }}>
										<option value="">Pilih</option>
										@if(empty($butiranPelajar->sem_semasa))
											@for($i = 1; $i <= 4; $i++)
												<option value="{{ $i }}">{{ $i }}</option>
											@endfor
										@else
											@for($i = 1; $i <= 4; $i++)
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
									<select id="bil_bulan_per_sem" name="bil_bulan_per_sem" class="form-select form-select-solid" data-control="select2" data-hide-search="true" {{ in_array($butiranPelajar->status, [2, 3, 4, 6, 7, 8, 9]) ? 'disabled' : '' }}>
										<option value="6">6</option>
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
									Tarikh Mula Pengajian&nbsp;
									<span data-bs-toggle="tooltip" data-bs-trigger="hover" title="Sama seperti dalam surat tawaran">
										<i class="fa-solid fa-circle-info" style="color: rgb(18, 178, 231);"></i>
									</span>
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
								<label class="fs-6 fw-semibold form-label mb-2">
									Tarikh Tamat Pengajian&nbsp;
									<span data-bs-toggle="tooltip" data-bs-trigger="hover" title="Sama seperti dalam surat tawaran">
										<i class="fa-solid fa-circle-info" style="color: rgb(18, 178, 231);"></i>
									</span>
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
								<label class="fs-6 fw-semibold form-label mb-2">
									Sumber Pembiayaan&nbsp;
									<span data-bs-toggle="tooltip" data-bs-trigger="hover" title="SENDIRI/TIADA PENAJA
									BIASISWA (CONTOH:SIME DARBY)
									PINJAMAN (CONTOH:PTPTN)
									LAIN-LAIN (CONTOH:DERMASISWA)">
										<i class="fa-solid fa-circle-info" style="color: rgb(18, 178, 231);"></i>
									</span>
								</label>
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
							@if ($butiranPelajar->sumber_biaya != '4')
							<div class="col-md-6 fv-row" id="div_nama_penaja">
								<!--begin::Label-->
								<label class="d-flex align-items-center fs-6 fw-semibold form-label mb-2">
									<span class="">Nama Penaja</span>
								</label>															
								<!--end::Label-->
								<select id="nama_penaja" name="nama_penaja" class="form-select form-select-solid js-example-basic-single" data-placeholder="Pilih" data-control="select2" data-hide-search="true" {{ in_array($butiranPelajar->status, [2, 3, 4, 6, 7, 8, 9]) ? 'disabled' : '' }}>
									<option value="">Pilih</option>
									@foreach ($penaja as $penaja)
									<option value="{{$penaja->id}}" {{$butiranPelajar->nama_penaja == $penaja->id ? 'selected' : ''}}>{{ $penaja->penaja}}</option>
									@endforeach
								</select>
							</div>
							@endif
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
							<h2 class="fw-bold text-dark">Maklumat Tuntutan</h2>
							<!--end::Title-->
							<!--begin::Notice-->
							<div class="text-muted fw-semibold fs-6">Tuntutan Elaun Wang Saku</div>
							<div class="fw-semibold fs-4" style="color: red">* Tuntutan perlu dikemukakan pada semester semasa</div>
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
							<div class="row mb-10">
								<br>
								<br>
								<div class="col-6" id="divelaun">
									<input class="form-check-input" type="checkbox" value="1" id="wang_saku"  name="wang_saku" onclick="return false" checked/>
									<label class="fs-6 fw-semibold form-label">
										Elaun Wang Saku
									</label>
								</div>
								<div class="col-6" id="divamaunelaun">
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
						@php
							$saringan = DB::table('permohonan_saringan')->where('permohonan_id', $permohonan->id)->orderBy('id', 'DESC')->value('catatan_salinan_dokumen');
							$saring_bank = Str::contains($saringan, 'Ralat pada penyata bank');
							$saring_surat = Str::contains($saringan, 'Ralat pada surat tawaran');
							$saring_resit = Str::contains($saringan, 'Ralat pada resit');
						@endphp
						<!--begin::Table-->
						<table class="table table-row-dashed fs-6 gy-5">
							<thead>
								<tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0">
									<th class="min-w-100px">Nama</th>
									<th class="min-w-100px">Dokumen</th>
									@if($butiranPelajar->status == 5 && $saringan !=null)
									<th class="min-w-100px"></th>
									@endif
									<th class="w-110px">Catatan</th>
								</tr>
							</thead>
							<tbody class="fw-semibold text-gray-600">
								@if (!$dokumen->isEmpty() && $dokumen->count() >= 2)
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
											@if($butiranPelajar->status == 5 && $saringan !=null)
												@php
												$id = ''; // Initialize $id variable
												@endphp
										
												@if($dok->id_dokumen == '1')
													@php
														$id='akaunBank';
													@endphp
												@elseif($dok->id_dokumen == '2')
													@php
														$id='suratTawaran';
													@endphp
												@elseif($dok->id_dokumen == '3')
													@php
														$id='invoisResit';
													@endphp
												@endif
												@if($id == 'akaunBank' && $saring_bank)
													<td class="fv-row"><input type="file" class="form-control form-control-sm" id="{{$id}}" name="{{$id}}"/></td>
													@elseif($id == 'suratTawaran' && $saring_surat)
														<td class="fv-row"><input type="file" class="form-control form-control-sm" id="{{$id}}" name="{{$id}}"/></td>
													@elseif($id == 'invoisResit' && $saring_resit)
														<td class="fv-row"><input type="file" class="form-control form-control-sm" id="{{$id}}" name="{{$id}}"/></td>
													@else
														<td class="fv-row"></td>
													@endif
												@endif
												<td><a href="/assets/dokumen/permohonan/{{ $dok->dokumen }}" target="_blank">{{ $dok->dokumen }}</a></td>
												<td><textarea type="text" class="form-control form-control-sm" id="catatan" rows="1" name="catatan" readonly>{{ $dok->catatan }}</textarea></td>
											@else
											<td><a href="/assets/dokumen/permohonan/{{ $dok->dokumen }}" target="_blank">{{ $dok->dokumen }}</a></td>
											<td><textarea type="text" class="form-control form-control-sm" id="catatan" rows="1" name="catatan" readonly>{{ $dok->catatan }}</textarea></td>
										@endif
									</tr>
								@endforeach	
								@else
								<tr>
									<td class="text-gray-800">Salinan Penyata Bank&nbsp;<a href="/assets/contoh/penyata_bank.pdf" target="_blank" data-bs-toggle="tooltip" title="Papar contoh"><i class="fa-solid fa-circle-info" style="color: rgb(18, 178, 231);"></i></a></td>
									<td class="fv-row"><input type="file" class="form-control form-control-sm" id="akaunBank" name="akaunBank"/></td>
									<td><textarea type="text" class="form-control form-control-sm" id="nota_akaunBank" rows="1" name="nota_akaunBank"></textarea></td>
								</tr>
								<tr>
									<td class="text-gray-800">Salinan Surat Tawaran Pengajian&nbsp;<a href="/assets/contoh/tawaran.pdf" target="_blank" data-bs-toggle="tooltip" title="Papar contoh"><i class="fa-solid fa-circle-info" style="color: rgb(18, 178, 231);"></i></a></td>
									<td class="fv-row"><input type="file" class="form-control form-control-sm" id="suratTawaran" name="suratTawaran"/></td>
									<td><textarea type="text" class="form-control form-control-sm" id="nota_suratTawaran" rows="1" name="nota_suratTawaran"></textarea></td>
								</tr>
								 @endif	
								
							</tbody>
							
						</table>
						<!--end::Table-->

						<br>
						<br>

						<div class="pb-10 pb-lg-15">
							<!--begin::Notice-->
							<div class="text-dark fw-semibold fs-6">
								<i class='fas fa-exclamation-triangle' style='color:orange'></i>&nbsp;
								Gunakan kemudahan <a href="https://compressjpeg.com/" target="_blank">di sini </a>untuk mengurangkan saiz fail sebelum memuat naik fail.
							</div>							
							<div class="text-dark fw-semibold fs-6"><i class='fas fa-exclamation-triangle' style='color:orange'></i>&nbsp; 
								Format fail yang boleh dimuat naik adalah format '.pdf', '.jpg', '.png' dan '.jpeg'.
							</div>
							<div class="text-dark fw-semibold fs-6"><i class='fas fa-exclamation-triangle' style='color:orange'></i>&nbsp; 
								Saiz maksimum fail adalah 2 MB.
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
								<input class="form-check-input" type="checkbox" value="1" id="perakuan" name="perakuan" @if($butiranPelajar->perakuan !== null) checked @endif {{ in_array($butiranPelajar->status, [2, 3, 4, 6, 7, 8, 9]) ? 'disabled' : '' }}/>
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
				@endforeach

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
		<script src="/assets/js/custom/utilities/modals/view-account.js"></script>
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
					url: "{{ route('ppk.kemaskini') }}",
					data: data,

				});
				
			});
		</script>
		<script>
			$(document).ready(function(){
				$('[data-bs-toggle="tooltip"]').tooltip();
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
					alamat_surat_menyurat.value="{{$butiranPelajar->alamat_surat_baru}}";
					alamat_surat_negeri.value="{{$butiranPelajar->alamat_surat_negeri}}";
					alamat_surat_bandar.value="{{$butiranPelajar->alamat_surat_bandar}}";
					alamat_surat_poskod.value="{{$butiranPelajar->alamat_surat_poskod}}";
					// Trigger select2 update
					$(alamat_surat_negeri).trigger('change.select2');
					$(alamat_surat_bandar).trigger('change.select2');
				}
			}

			function alamatWaris() {
				var checkBox = document.getElementById("sama_waris");  
				var alamat_tetap = document.getElementById("alamat_tetap");
				var alamat_tetap_negeri = document.getElementById("alamat_tetap_negeri");
				var alamat_tetap_bandar = document.getElementById("alamat_tetap_bandar");
				var alamat_tetap_poskod = document.getElementById("alamat_tetap_poskod");
				console.log('negeri_p:', alamat_tetap_negeri);
				console.log('bandar_p:', alamat_tetap_bandar);

				var alamat_waris = document.getElementById("alamat_waris");
				var alamat_negeri_waris = document.getElementById("alamat_negeri_waris");
				var alamat_bandar_waris = document.getElementById("alamat_bandar_waris");
				var alamat_poskod_waris = document.getElementById("alamat_poskod_waris");
				console.log('negeri_w:', alamat_negeri_waris);
				console.log('bandar_w:', alamat_bandar_waris);

				if (checkBox.checked == true){
					alamat_waris.value=alamat_tetap.value; 
					alamat_negeri_waris.value=alamat_tetap_negeri.value;
					alamat_bandar_waris.value=alamat_tetap_bandar.value;
					console.log('negeri:', alamat_negeri_waris.value);
					console.log('bandar:', alamat_bandar_waris.value);
					alamat_poskod_waris.value=alamat_tetap_poskod.value;
					
					// Trigger select2 update
					$(alamat_negeri_waris).trigger('change.select2');
					$(alamat_bandar_waris).trigger('change.select2');
				} else {
					alamat_waris.value = '';
					alamat_negeri_waris.value = '';
					alamat_bandar_waris.value = '';
					alamat_poskod_waris.value = '';

					// Trigger select2 update.
					$(alamat_negeri_waris).trigger('change.select2');
					$(alamat_bandar_waris).trigger('change.select2');
				}
			}

			$(document).ready(function () {
				var previousIdNegeri = $('#alamat_negeri').val();

				function getBandarData(idnegeri) {
					$("#alamat_tetap_bandar").empty();
					$("#parlimen").empty();

					$.ajax({
						url: '/getBandar/' + idnegeri,
						type: 'get',
						dataType: 'json',
						success: function (response) {
							if (response['data']) {
								var selectedValue = $("#alamat_bandar").val();

								for (var i = 0; i < response['data'].length; i++) {
									var id = response['data'][i].id;
									var bandar = response['data'][i].bandar;
									var isSelected = (id == selectedValue);

									var option = "<option value='" + id + "'" + (isSelected ? " selected" : "") + ">" + bandar + "</option>";

									$("#alamat_tetap_bandar").append(option);
								}
							}
						},
						error: function () {
							// alert('AJAX load did not work');
						}
					});
				}

				function getParlimenData(idnegeri) {
					$('#parlimen').empty().append('<option value="" selected></option>');
					$("#dun").empty();

					$.ajax({
						url: '/getParlimen/' + idnegeri,
						type: 'get',
						dataType: 'json',
						success: function (response) {
							if (response['data']) {
								var selectedValue = $("#parlimen_asal").val();

								for (var i = 0; i < response['data'].length; i++) {
									var id = response['data'][i].id;
									var kod = response['data'][i].kod_parlimen;
									var parlimen = response['data'][i].parlimen.toUpperCase();
									var isSelected = (id == selectedValue);

									var option = "<option value='" + id + "'" + (isSelected ? " selected" : "") + ">" + kod + "-" + parlimen + "</option>";

									$("#parlimen").append(option);
								}
							}
						},
						error: function () {
							// alert('AJAX load did not work');
						}
					});
				}

				// Initial AJAX requests
				getBandarData(previousIdNegeri);
				getParlimenData(previousIdNegeri);

				$('#alamat_tetap_negeri').on('change', function () {
					var idnegeri = $(this).val();
					// alert(previousIdNegeri);
					// alert(idnegeri);
					
					previousIdNegeri = idnegeri;
					$("#parlimen").empty();
					$('#alamat_tetap_poskod').val('');


					getBandarData(idnegeri);
					getParlimenData(idnegeri);
				});

				// Negeri takde dun
				$('#alamat_tetap_negeri').on('change', function () {
					var hideDun = ['14', '15', '16', '17'].includes(this.value);
					$("#divdun").toggle(!hideDun);
				});

				// Dun
				var previousParlimen = $('#parlimen_asal').val();

				function getDunData(idparlimen) {
					$("#dun").empty();

					$.ajax({
						url: '/getDun/' + idparlimen,
						type: 'get',
						dataType: 'json',
						success: function (response) {
							if (response['data']) {
								var selectedValue = $("#dunn").val();

								for (var i = 0; i < response['data'].length; i++) {
									var id = response['data'][i].id;
									var kod_dun = response['data'][i].kod_dun;
									var dun = response['data'][i].dun.toUpperCase();
									var isSelected = (id == selectedValue);

									var option = "<option value='" + id + "'" + (isSelected ? " selected" : "") + ">" + kod_dun + "-" + dun + "</option>";

									$("#dun").append(option);
								}
							}
						},
						error: function () {
							// alert('AJAX load did not work');
						}
					});
				}

				// Initial AJAX request
				getDunData(previousParlimen);

				$('#parlimen').on('change', function () {
					var idparlimen = $(this).val();
					previousParlimen = idparlimen;

					getDunData(idparlimen);
				});
			});

			//negeri surat
			$(document).ready(function(){
				$('#alamat_surat_negeri').on('change', function() {
					var idnegeri = $(this).val();
					//alert(id);
					// Empty the dropdown
					$('#alamat_surat_bandar').find('option').not(':first').remove();
					$('#alamat_surat_poskod').val('');
					// AJAX request 
					$.ajax({
						
						url: '/getBandar/'+idnegeri,
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

											$("#alamat_surat_bandar").append(option); 
										}
									}
							}, 
							error: function(){
							// alert('AJAX load did not work');
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
							// alert('AJAX load did not work');
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

			//SUMBER BIAYA DAN PENAJA
			$(document).ready(function () {
				var sumber = document.getElementById("sumber_biaya").value;
				if (sumber == '4') {
					$("#div_nama_penaja").hide();
				}

				// Initialize hidden divs
				$("#div_biaya_lain").hide();
				$("#div_penaja_lain").hide();

				var penajaOptions = {!! json_encode($penajaArray) !!};

				// Ensure penajaOptions is an array before attempting to iterate
				if (Array.isArray(penajaOptions)) {
					// Event handler for sumber_biaya change
					$('#sumber_biaya').on('change', function () {
						$("#div_penaja_lain").hide();
						var selectedValue = this.value;

						// Update options based on the selected value
						$('#nama_penaja').empty().append('<option value="">Pilih</option>');

						// Display "LAIN-LAIN" option for each sumber
						$('#nama_penaja').append('<option value="99">LAIN-LAIN</option>');

						// Show or hide div elements based on the selected value
						if (selectedValue == '2' || selectedValue == '4') {
							$("#div_nama_penaja").hide();
							$("#div_biaya_lain").hide();
						} else {
							if (selectedValue == '5') {
								$("#div_biaya_lain").show();
								$("#div_nama_penaja").show();
							} else {
								$("#div_biaya_lain").hide();
								$("#div_nama_penaja").show();
							}

							// Fetch penaja options based on sumber_biaya
							$.ajax({
								url: '/getPenaja/' + selectedValue,
								type: 'get',
								dataType: 'json',
								success: function (response) {
									// Empty the dropdown
									$('#nama_penaja').find('option').not(':first').remove();

									var len = response['data'] ? response['data'].length : 0;

									if (len > 0) {
										// Read data and create <option>
										for (var i = 0; i < len; i++) {
											var id = response['data'][i].id;
											var penaja = response['data'][i].penaja;
											var option = "<option value='" + id + "'>" + penaja + "</option>";
											$("#nama_penaja").append(option);
										}
									}
								},
								error: function () {
									// alert('AJAX load did not work');
								}
							});
						}
					});

					// Event handler for nama_penaja change
					$('#nama_penaja').on('change', function () {
						if (this.value == '99') {
							$("#div_penaja_lain").show();
						} else {
							$("#div_penaja_lain").hide();
						}
					});
				} else {
					console.error("Error: penajaOptions is not an array");
				}
			});

			function dateCheck(){
				let startDate = new Date($("#tarikh_mula").val());
				let endDate = new Date($("#tarikh_tamat").val());
				var studyPeriod = parseFloat(document.getElementById("tempoh_pengajian").value);
				// Get the current date
				var currentDate = new Date();
				
				if (!isNaN(studyPeriod)) {
				
					if (startDate >= currentDate) {
						alert("Tarikh mula pengajian tidak boleh lebih daripada tarikh hari ini.");
						document.getElementById("tarikh_mula").value = "";
						return;
					}
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
	
				// institusi id
				var id_institusi = document.getElementById("id_institusi").value;
				var peringkat = document.getElementById("peringkat_pengajian").value;
				

				// AJAX request 
				// $.ajax({
				// 	url: '/ppk/peringkat/'+id_institusi,
				// 	type: 'get',
				// 	dataType: 'json',
				// 	success: function(response){
						

				// 		var len = 0;
				// 		if(response['data'] != null){
				// 			len = response['data'].length;
				// 		}
						
				// 		if(len > 0){
				// 			// Read data and create <option >
				// 			for(var i=0; i<len; i++){

				// 				var id_institusi = response['data'][i].id_institusi;
				// 				var kod_peringkat = response['data'][i].kod_peringkat;
				// 				var peringkatValue = response['data'][i].peringkat;
								
				// 				// Check if the current option value is equal to the selected peringkat
				// 				var selected = kod_peringkat === peringkat ? 'selected' : '';

				// 				var option = "<option value='" + kod_peringkat + "' " + selected + ">" + peringkatValue + "</option>";

				// 				$("#peringkat_pengajian").append(option); 
				// 			}
				// 		}

				// 	},
				// 	error: function(){
				// 	alert('AJAX load did not work');
				// 	}
				// });
	
				// peringkat Change
				// $('#peringkat_pengajian').change(function(){
	
					// institusi id
					var idipt = document.getElementById("id_institusi").value;
					var kodperingkat = document.getElementById("peringkat_pengajian").value;
		
					// Empty the dropdown
					$('#nama_kursus').find('option').not(':first').remove();
					// alert(idipt);
		
		
					// AJAX request 
					$.ajax({
						url: '/kursus/ppk/'+kodperingkat+'/'+idipt,
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
									var uppercaseValue  = response['data'][i].nama_kursus.toUpperCase();
		
									var option = "<option value='"+nama_kursus+"'>"+uppercaseValue+"</option>";
		
									$("#nama_kursus").append(option); 
									
								}
							}
		
						}
					});
	
				// });
		
			});

			</script>


<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
    function select1() {
        var sem_semasa = document.getElementById('sem_semasa').value;
        console.log('Selected Semester:', sem_semasa);

        // Make an AJAX request to fetch data based on the selected semester
        $.ajax({
            type: 'GET',
            url: '/fetch-amaun', // Replace with the actual route for fetching data
            data: {sem_semasa: sem_semasa},
            success: function(response) {
                // Format the value to display with .00
            	var formattedAmaun = response.amaun ? response.amaun.toFixed(2) : '';

				// Update the value of 'amaun_wang_saku' input
				document.getElementById("amaun_wang_saku").value = formattedAmaun;

            },
            error: function(error) {
                console.error('Error fetching data:', error);
            }
        });
    }
</script>

		


</x-default-layout>
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
<main class="login-form">
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
																<h3 class="stepper-title">Maklumat Tuntutan</h3>
																<div class="stepper-desc fw-semibold">Tuntutan Yuran dan Elaun Wang Saku</div>
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
													<div class="stepper-item  mark-completed" data-kt-stepper-element="nav">
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
	<!--begin::Aside-->
										<!--begin::Content-->
										<div class="card d-flex flex-row-fluid flex-center">
											<!--begin::Form-->
											<form id="kt_create_account_form" action="{{ route('hantar') }}" method="post" class="card-body py-20 w-100 mw-xl-700px px-9" enctype="multipart/form-data">
											
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
															<div class="text-muted fw-semibold fs-6">Profil Diri 
															</div>
															<!--end::Notice-->
														</div>
														<!--end::Heading-->
														@foreach ($smoku as $smoku)
														<!--begin::Input group-->
														<div class="mb-10 fv-row">
															<!--begin::Label-->
															<label class="form-label mb-3">Nama</label>
															<!--end::Label-->
															<!--begin::Input-->
															<input type="text" class="form-control form-control-lg form-control-solid"  id="nama_pelajar" name="nama_pelajar" placeholder="" value="{{$smoku->nama}}" readonly/>
															<!--end::Input-->
														</div>
														<!--end::Input group-->
														<!--begin::Input group-->
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
																		<input type="text" class="form-control form-control-lg form-control-solid" minlength="12" id="nokp_pelajar" name="nokp_pelajar" placeholder="" value="{{$smoku->nokp}}" readonly/>
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
																	<input type="date" data-date-autoclose="true" class="form-control form-control-solid" placeholder="" id="tkh_lahir" name="tkh_lahir" value="{{$smoku->tkh_lahir}}" readonly/>
																	<!--end::Input-->
																	</div>
																</div>	
																</div>
																<div class="col-md-3 fv-row">
																<label class=" fs-6 fw-semibold form-label mb-2">Umur</label>
																<!--end::Label-->
																<div class="row fv-row">
																<!--begin::Input wrapper-->
																<div class="col-12">
																	<!--begin::Input-->
																	<input type="text" class="form-control form-control-solid" id="umur" name="umur" placeholder="" value="{{$smoku->umur}}" readonly/>
																	<!--end::Input-->
																</div>
																<!--end::Input wrapper-->
															</div>
																
																</div>	
																
															<!--end::Col-->
															<!--begin::Col-->
															
															<!--end::Col-->
														</div>
														<div class="row mb-10">
														<div class="col-md-6 fv-row">
																<!--begin::Label-->
																<label class=" fs-6 fw-semibold form-label mb-2">Jantina</label>
																<!--end::Label-->
																<!--begin::Input wrapper-->
																<div class="col-12">
																	<!--begin::Input-->
																	<select id="jantina" name="jantina" class="form-select form-select-lg form-select-solid" data-control="select2" data-placeholder="Pilih" data-hide-search="true">
																		<option value="{{$smoku->kodjantina}}">{{$smoku->jantina}}</option>
																	</select>
																	<!--end::Input-->
																</div>
																<!--end::Input wrapper-->
															</div>
														<div class="col-md-6 fv-row">
																<!--begin::Label-->
																<label class="fs-6 fw-semibold form-label mb-2">Bangsa
																</label>
																<!--end::Label-->
																<!--begin::Input wrapper-->
																<div class="col-12">
																	<!--begin::Input-->
																	<select id="bangsa" name="bangsa" class="form-select form-select-lg form-select-solid" data-control="select2" data-placeholder="Pilih" data-hide-search="true">
																		<option value="{{$smoku->kodbangsa}}">{{$smoku->bangsa}}</option>
																	</select>
																	<!--end::Input-->
																</div>
																<!--end::Input wrapper-->
															</div>
</div>
														<!--begin::Input group-->
														<div class="fv-row mb-10">
															<!--end::Label-->
															<label class="form-label">Alamat Rumah</label>
															<!--end::Label-->
															<!--begin::Input-->
															<textarea id="alamat1" name="alamat1" class="form-control form-control-lg form-control-solid" rows="2">{{$smoku->alamat1}}</textarea>
															<!--end::Input-->
														</div>
														<div class="row mb-10">
															<div class="col-md-4 fv-row">
																<!--begin::Label-->
																<label class=" fs-6 fw-semibold form-label mb-2">Poskod
																</label>
																<!--end::Label-->
																<!--begin::Input wrapper-->
																<div class="col-12">
																	<!--begin::Input-->
																	<input type="text" class="form-control form-control-solid" id="alamat_poskod" name="alamat_poskod" placeholder="" value="{{$smoku->alamat_poskod}}" />
																	<!--end::Input-->
																</div>
																<!--end::Input wrapper-->
															</div>
															<div class="col-md-4 fv-row">
																<!--begin::Label-->
																<label class=" fs-6 fw-semibold form-label mb-2">Negeri
																</label>
																<!--end::Label-->
																<!--begin::Input wrapper-->
																<div class="col-12">
																	<!--begin::Input-->
																	<input type="text" class="form-control form-control-solid" id="alamat_negeri" name="alamat_negeri" placeholder="" value="{{$smoku->alamat_negeri}}" />
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
																	<input type="text" class="form-control form-control-solid" id="alamat_bandar" name="alamat_bandar" placeholder="" value="{{$smoku->alamat_bandar}}"/>
																	<!--end::Input-->
																</div>
																<!--end::Input wrapper-->
															</div>
														</div>
														<!--end::Input group-->
														<div class="row mb-10">
															<div class="col-md-6 fv-row">
																<!--begin::Label-->
																<label class=" fs-6 fw-semibold form-label mb-2">No. Tel(HP)
																</label>
																<!--end::Label-->
																<!--begin::Input wrapper-->
																<div class="col-12">
																	<!--begin::Input-->
																	<input type="text" class="form-control form-control-solid" id="no_tel" name="no_tel" placeholder="" value="{{$smoku->no_tel}}" />
																	<!--end::Input-->
																</div>
																<!--end::Input wrapper-->
															</div>
															<div class="col-md-6 fv-row">
																<!--begin::Label-->
																<label class=" fs-6 fw-semibold form-label mb-2">No. Tel Rumah
																</label>
																<!--end::Label-->
																<!--begin::Input wrapper-->
																<div class="col-12">
																	<!--begin::Input-->
																	<input type="text" class="form-control form-control-solid" id="no_telR" name="no_telR" placeholder="" value="{{$smoku->no_telR}}" />
																	<!--end::Input-->
																</div>
																<!--end::Input wrapper-->
															</div>
														</div>
														
														<!--end::Input group-->
														<!--end::Input group-->
														<div class="row mb-10">
															<div class="col-md-6 fv-row">
																<!--begin::Label-->
																<label class=" fs-6 fw-semibold form-label mb-2">Alamat emel
																</label>
																<!--end::Label-->
																<!--begin::Input wrapper-->
																<div class="col-12">
																	<!--begin::Input-->
																	<input type="text" class="form-control form-control-solid" id="emel" name="emel" placeholder="" value="{{$smoku->email}}" readonly/>
																	<!--end::Input-->
																</div>
																<!--end::Input wrapper-->
															</div>
														<div class="separator my-14"></div>
														<div class="pb-10 pb-lg-15">
															<!--begin::Title-->
															<h2 class="fw-bold text-dark">Maklumat Sistem Maklumat Orang Kurang Upaya (SMOKU)</h2>
															<!--end::Title-->
															<!--begin::Notice-->
															<div class="text-muted fw-semibold fs-6">Jabatan Kebajikan Malaysia 
															</div>
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
																	<input type="text" class="form-control form-control-solid" id="noJKM" name="noJKM" placeholder="" value="{{$smoku->noJKM}}"  readonly/>
																	<!--end::Input-->
																</div>
																<!--end::Input wrapper-->
															</div>
															<div class="col-md-6 fv-row">
																<!--begin::Label-->
																<label class="fs-6 fw-semibold form-label mb-2">Kecacatan
																</label>
																<!--end::Label-->
																<!--begin::Input wrapper-->
																<div class="col-12">
																	<!--begin::Input-->
																	<input type="text" class="form-control form-control-solid" placeholder="" value="{{$smoku->kecacatan}}" readonly/>
																	<input type="hidden" class="form-control form-control-solid" id="kecacatan" name="kecacatan" placeholder="" value="{{$smoku->kodoku}}" readonly/>
																	<!--end::Input-->
																</div>
																<!--end::Input wrapper-->
															</div>
															
														</div>
														<!--end::Input group-->
														<!--begin::Input group-->
														<div class="separator my-14"></div>
														<div class="pb-10 pb-lg-15">
															<!--begin::Title-->
															<h2 class="fw-bold text-dark">Maklumat Perbankan</h2>
															<!--end::Title-->
															<!--begin::Notice-->
															<div class="text-muted fw-semibold fs-6">Bank Islam 
															</div>
															<!--end::Notice-->
														</div>
															<div class="col-md-6 fv-row">
																<!--begin::Label-->
																<label class=" fs-6 fw-semibold form-label mb-2">No. Akaun Bank</label>&nbsp;<a href="#" data-bs-toggle="tooltip" title="16113020138680"><i class="fa-solid fa-circle-info"></i></a>
																
																
																<!--end::Label-->
																<!--begin::Input wrapper-->
																<div class="col-12">
																	<!--begin::Input-->
																	<input type="text" class="form-control form-control-solid" maxlength="14" id="no_akaunbank" name="no_akaunbank" placeholder="" value="" />
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
															<h2 class="fw-bold text-dark">Maklumat Waris</h2>
															<!--end::Title-->
															<!--begin::Notice-->
															<div class="text-muted fw-semibold fs-6">Profil Waris
															</div>
															<!--end::Notice-->
														</div>
														<!--end::Heading-->
														<!--begin::Input group-->
														<div class="mb-10 fv-row">
															<!--begin::Label-->
															<label class="form-label mb-3">Nama</label>
															<!--end::Label-->
															<!--begin::Input-->
															<input type="text" class="form-control form-control-lg form-control-solid" id="nama_waris" name="nama_waris" placeholder="" value="{{$smoku->nama_waris}}"  />
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
																		<input type="text" class="form-control form-control-lg form-control-solid" id="nokp_waris" name="nokp_waris" placeholder="" value="{{$smoku->nokp_waris}}"  />
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
																		<input type="text" class="form-control form-control-lg form-control-solid" id="noPasport" name="noPasport" placeholder="" value="" />
																	</div>
																	<!--end::Col-->
																</div>
																<!--end::Row-->
															</div>
														</div>
														<div class="row mb-10 hubungan_row">
															<!--begin::Label-->
															<div class="col-md-6 fv-row hubungan_row">
															<label class="form-label mb-6">Hubungan Waris</label>
																
															<select id="hubungan" name="hubungan" class="form-select form-select-lg form-select-solid hubungan_waris" data-control="select2" data-placeholder="Pilih" data-allow-clear="true">
															
															@if ($smoku->hubungan)
															<option value="{{$smoku->kodhubungan}}">{{$smoku->hubungan}}</option>
															@endif
															@foreach ($hubungan as $hubungan)
															<option  value="{{$hubungan->kodhubungan}}" >{{$hubungan->hubungan}}</option>
															@endforeach
															</select>
															
														</div>
															<div class="col-md-6 fv-row lain_hubungan">
															<!--begin::Label-->
															<label class="form-label mb-6">(Jika Lain-lain) Sila Nyatakan:</label>
															<!--end::Label-->
															<!--begin::Input-->
															<input type="text" class="form-control form-control-lg form-control-solid lain_hubungan_input" id="lain_hubungan" name="lain_hubungan" placeholder="" value="" />
															<!--end::Input-->													
															</div>
														</div>
														
														<!--end::Input group-->
														<!--begin::Input group-->
														<div class="fv-row mb-10">
															<!--end::Label-->
															<label class="form-label">Alamat Rumah</label>
															<!--end::Label-->
															<!--begin::Input-->
															<textarea id="alamatW1" name="alamatW1" class="form-control form-control-lg form-control-solid" rows="2"></textarea>
															<!--end::Input-->
														</div>
														<div class="row mb-10">
															<div class="col-md-4 fv-row">
																<!--begin::Label-->
																<label class="fs-6 fw-semibold form-label mb-2">Poskod
																</label>
																<!--end::Label-->
																<!--begin::Input wrapper-->
																<div class="col-12">
																	<!--begin::Input-->
																	<input type="text" class="form-control form-control-solid" id="alamatW_poskod" name="alamatW_poskod" placeholder="" value="" />
																	<!--end::Input-->
																</div>
																<!--end::Input wrapper-->
															</div>
															<div class="col-md-4 fv-row">
																<!--begin::Label-->
																<label class="fs-6 fw-semibold form-label mb-2">Negeri
																</label>
																<!--end::Label-->
																<!--begin::Input wrapper-->
																<div class="col-12">
																	<!--begin::Input-->
																	<select id="alamatW_negeri" name="alamatW_negeri" class="form-select form-select-lg form-select-solid js-example-basic-single"  data-control="select2" data-hide-search="true">
																		<option value="">Pilih</option>
																		@foreach ($negeri as $negeri)	
																		<option value="{{ $negeri->id}}">{{ $negeri->nama}}</option> 
																		@endforeach
																	</select>
																	<!--end::Input-->
																</div>
																<!--end::Input wrapper-->
															</div>
															<div class="col-md-4 fv-row">
																<!--begin::Label-->
																<label class="fs-6 fw-semibold form-label mb-2">Bandar
																</label>
																<!--end::Label-->
																<!--begin::Input wrapper-->
																<div class="col-12">
																	<!--begin::Input-->
																	<select id='alamatW_bandar'  name='alamatW_bandar' class="form-select form-select-lg form-select-solid js-example-basic-single"  data-control="select2" data-hide-search="true">
																		<option value="">Pilih</option>
																	</select>
																	<!--end::Input-->
																</div>
																<!--end::Input wrapper-->
															</div>
															
														</div>
														<!--end::Input group-->
														<div class="row mb-10">
															<div class="col-md-6 fv-row">
																<!--begin::Label-->
																<label class="fs-6 fw-semibold form-label mb-2">No. Tel(HP)
																</label>
																<!--end::Label-->
																<!--begin::Input wrapper-->
																<div class="col-12">
																	<!--begin::Input-->
																	<input type="text" class="form-control form-control-solid" id="no_telW" name="no_telW" placeholder="" value="{{$smoku->notel_waris}}"  />
																	<!--end::Input-->
																</div>
																<!--end::Input wrapper-->
															</div>
															<div class="col-md-6 fv-row">
																<!--begin::Label-->
																<label class="fs-6 fw-semibold form-label mb-2">No. Tel Rumah
																</label>
																<!--end::Label-->
																<!--begin::Input wrapper-->
																<div class="col-12">
																	<!--begin::Input-->
																	<input type="text" class="form-control form-control-solid" id="no_telRW" name="no_telRW" placeholder="" value="" />
																	<!--end::Input-->
																</div>
																<!--end::Input wrapper-->
															</div>
															</div>
															<div class="row mb-10">

															<div class="col-md-6 fv-row">
																<!--begin::Label-->
																<label class="fs-6 fw-semibold form-label mb-2">Pekerjaan
																</label>
																<!--end::Label-->
																<!--begin::Input wrapper-->
																<div class="col-12">
																	<!--begin::Input-->
																	<input type="text" class="form-control form-control-solid" id="pendapatan" name="pendapatan" placeholder="" value="{{$smoku->pekerjaan_waris}}"  />
																	<!--end::Input-->
																</div>
																<!--end::Input wrapper-->
															</div>
															<div class="col-md-6 fv-row">
																<!--begin::Label-->
																<label class="fs-6 fw-semibold form-label mb-2">Pendapatan
																</label>
																<!--end::Label-->
																<!--begin::Input wrapper-->
																<div class="col-12">
																	<!--begin::Input-->
																	<input type="text" class="form-control form-control-solid" id="pendapatan" name="pendapatan" placeholder="" value="{{$smoku->pendapatan_waris}}"  />
																	<!--end::Input-->
																</div>
																<!--end::Input wrapper-->
															</div>
														
															@endforeach
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
														@foreach ($akademikmqa as $akademik)
														<!--begin::Input group-->
														<div class="d-flex flex-column mb-7 fv-row">
															<!--begin::Label-->
															<label class="d-flex align-items-center fs-6 fw-semibold form-label mb-2">
																<span class="">Nama Pusat Pengajian</span>
																
															</label>
															<!--end::Label-->
															<select id="id_institusi" name="id_institusi" class="form-select form-select-solid" data-control="select2" data-hide-search="true" data-placeholder="Pilih">
																<option value="{{ $akademik->idipt}}">{{ $akademik->namaipt}}</option>
															</select>
														</div>
														<div class="d-flex flex-column mb-7 fv-row">
															<!--begin::Label-->
															<label class="d-flex align-items-center fs-6 fw-semibold form-label mb-2">
																<span class="">Nama Kursus</span>
																
															</label>
															<!--end::Label-->
															<select id="nama_kursus" name="nama_kursus" class="form-select form-select-solid" data-control="select2" data-hide-search="true" data-placeholder="Pilih">
																<option value="{{ $akademik->nama_kursus}}">{{ $akademik->nama_kursus}}</option>
															</select>
														</div>
														
														
														
														<!--end::Input group-->

														<!--begin::Input group-->
														<div class="row mb-10">
															<!--begin::Col-->
															<div class="col-md-4 fv-row">
																<!--begin::Label-->
																<label class=" fs-6 fw-semibold form-label mb-2">Peringkat Pengajian</label>
																<!--end::Label-->
																<!--begin::Row-->
																<div class="row fv-row">
																	<!--begin::Input wrapper-->
																	<select id="peringkat_pengajian" name="peringkat_pengajian" class="form-select form-select-solid" data-control="select2" data-hide-search="true" data-placeholder="Pilih">
																		<option value="{{ $akademik->kodperingkat}}">{{ $akademik->peringkat}}</option>
																	</select>
																	<!--end::Input wrapper-->
																</div>
																<!--end::Row-->
															</div>
															<!--end::Col-->
															<!--begin::Col-->
															<div class="col-md-4 fv-row">
																<!--begin::Label-->
																<label class="d-flex align-items-center fs-6 fw-semibold form-label mb-2">
																<span class="">Sesi Pengajian</span>&nbsp;<a href="#" data-bs-toggle="tooltip" title="2023/2024"><i class="fa-solid fa-circle-info"></i></a>
																</label>
																<!--end::Label-->
																	<!--begin::Input wrapper-->
																	<input type="text" class="form-control form-control-solid" placeholder="" id="sesi" name="sesi" value="" />
																	<!--end::Input wrapper-->
															</div>
															<!--end::Col-->
															<div class="col-md-4 fv-row">
															<!--begin::Label-->
															<label class="d-flex align-items-center fs-6 fw-semibold form-label mb-2">
																<span class="">No Pendaftaran Pelajar</span>
																
															</label>
															<!--end::Label-->
															<input type="text" class="form-control form-control-solid" placeholder="" id="no_pendaftaranpelajar" name="no_pendaftaranpelajar" value="" />
														</div>
														</div>
														<!--end::Input group-->
														<!-- @endforeach -->


														<!--begin::Input group-->
														<div class="row mb-10">
															<!--begin::Col-->
															<div class="col-md-4 fv-row">
																<!--begin::Label-->
																<label class="d-flex align-items-center fs-6 fw-semibold form-label mb-2">Mod Pengajian</label>
																<!--end::Label-->
																<!--begin::Input wrapper-->
																		<select name="mod" id="mod"  class="form-select form-select-solid" onchange="select1()" data-control="select2" data-hide-search="true" data-placeholder="Pilih">
																			@foreach ($mod as $mod)
																			<option></option>
																			<option value="{{ $mod->kodmod}}">{{ $mod->mod}}</option>
																			@endforeach
																		</select>
																	<!--end::Input wrapper-->
															</div>
															<div class="col-md-4 fv-row">
																<!--begin::Label-->
																<label class="fs-6 fw-semibold form-label mb-2">Tarikh Mula Pengajian</label>
																<!--end::Label-->
																	<!--begin::Input wrapper-->
																	<input type="date" class="form-control form-control-solid" placeholder="" id="tkh_mula" name="tkh_mula" value="" />
																	<!--end::Input wrapper-->
															</div>
															<!--end::Col-->
															<!--begin::Col-->
															<div class="col-md-4 fv-row">
																<!--begin::Label-->
																<label class="d-flex align-items-center fs-6 fw-semibold form-label mb-2">Tarikh Tamat Pengajian</label>
																<!--end::Label-->
																<!--begin::Input wrapper-->
																	<input type="date" class="form-control form-control-solid" placeholder="" id="tkh_tamat" name="tkh_tamat" value="" />
																<!--end::Input wrapper-->
															</div>
															<!--end::Col-->
														</div>
														<!--end::Input group-->

														<!--begin::Input group-->
														<div class="row mb-10">
															<!--begin::Col-->
															<div class="col-md-3 fv-row">
																<!--begin::Label-->
																<label class=" fs-6 fw-semibold form-label mb-2">Semester Semasa</label>
																<!--end::Label-->
																<!--begin::Row-->
																<div class="row fv-row">
																	<!--begin::Input wrapper-->
																	
																		<select id="sem_semasa" name="sem_semasa" class="form-select form-select-solid" data-control="select2" data-hide-search="true" data-placeholder="Pilih">
																			<option></option>
																			<option value="1">1</option>
																			<option value="2">2</option>
																			<option value="3">3</option>
																			<option value="4">4</option>
																			<option value="5">5</option>
																			<option value="6">6</option>
																			<option value="7">7</option>
																			<option value="8">8</option>
																			<option value="9">9</option>
																			<option value="10">10</option>
																			<option value="11">11</option>
																			<option value="12">12</option>
																			
																		</select>
																	<!--end::Input wrapper-->
																</div>
																<!--end::Row-->
															</div>
															<!--end::Col-->
															<!--begin::Col-->
															<div class="col-md-3 fv-row">
																<!--begin::Label-->
																<label class="d-flex align-items-center fs-6 fw-semibold form-label mb-2">Tempoh Pengajian</label>
																<!--end::Label-->
																<!--begin::Input wrapper-->
																	<input type="text" class="form-control form-control-solid" placeholder="" id="tempoh_pengajian" name="tempoh_pengajian" value="" required/>
																	
																	<!--end::Input wrapper-->
															</div>
															<!--end::Col-->
															<div class="col-md-3 fv-row">
																<!--begin::Label-->
																<label class=" fs-6 fw-semibold form-label mb-2">Bil Bulan Persemester</label>
																<!--end::Label-->
																<!--begin::Row-->
																<div class="row fv-row">
																	<!--begin::Input wrapper-->
																		<select id="bil_bulanpersem" name="bil_bulanpersem" class="form-select form-select-solid" data-control="select2" data-hide-search="true" data-placeholder="Pilih">
																			<option></option>
																			<option value="4">4</option>
																			<option value="6">6</option>
																		</select>
																	<!--end::Input wrapper-->
																</div>
																<!--end::Row-->
															</div>
															<div class="col-md-3 fv-row">
															<!--begin::Label-->
															<label class="d-flex align-items-center fs-6 fw-semibold form-label mb-2">
																<span class="">CGPA Terkini</span>
																
															</label>
															<!--end::Label-->
															<input type="text" class="form-control form-control-solid" placeholder="" id="cgpa" name="cgpa" value="" />
														</div>
														</div>
														<!--end::Input group-->

														

														

														<!--begin::Input group-->
														<div class="row mb-10">
															<!--begin::Col-->
															<div class="col-md-6 fv-row">
																<!--begin::Label-->
																<label class=" fs-6 fw-semibold form-label mb-2">Sumber Pembiayaan</label> <a href="#" data-bs-toggle="tooltip" title="CONTOH NYA MACAM NI"><i class="fa-solid fa-circle-info"></i></a>
																<!--end::Label-->
																<!--begin::Row-->
																<div class="row fv-row">
																	<!--begin::Input wrapper-->
																		<select id="sumber_biaya" name="sumber_biaya" class="form-select form-select-solid" onchange="select1()" data-control="select2" data-hide-search="true" data-placeholder="Pilih">
																			@foreach ($biaya as $biaya)
																			<option></option>
																			<option value="{{ $biaya->kodbiaya}}">{{ $biaya->biaya}}</option>
																			@endforeach
																		</select>
																	<!--end::Input wrapper-->
																</div>
																<!--end::Row-->
															</div>
															<!--end::Col-->
															<!--begin::Col-->
															<div class="col-md-6 fv-row">
																<!--begin::Label-->
																<label class="d-flex align-items-center fs-6 fw-semibold form-label mb-2">Lain-lain</label>
																<!--end::Label-->
																<!--begin::Input wrapper-->
																<input type="text" class="form-control form-control-solid" placeholder="" id="sumber_biayalain" name="sumber_biayalain" value="" />
																<!--end::Input wrapper-->
															</div>
															<!--end::Col-->
														</div>
														<!--end::Input group-->

														<div class="d-flex flex-column mb-7 fv-row">
															<!--begin::Label-->
															<label class="d-flex align-items-center fs-6 fw-semibold form-label mb-2">
																<span class="">Nama Penaja</span>&nbsp;<a href="#" data-bs-toggle="tooltip" title="CONTOH NYA MACAM NI"><i class="fa-solid fa-circle-info"></i></a>
																
															</label>															
															<!--end::Label-->
															<input type="text" class="form-control form-control-solid" placeholder="JPA" id="nama_penaja" name="nama_penaja" value="" />
														</div>
														
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
															<div class="text-muted fw-semibold fs-6">Tuntutan</div>
															<!--end::Notice-->
														</div>
														<!--end::Heading-->
														

														<!--begin::Input group-->
														<div class="d-flex flex-column mb-7 fv-row">
															<!--begin::Label-->
															<label class="d-flex align-items-center fs-6 fw-semibold form-label mb-2">
																<span class="required">Jenis Tuntutan</span>
															</label>
															<!--end::Label-->
															<br>
															<br>
															<div class="row mb-10">
															<br>
															<br>
																<div class="col-6">
																	<input class="form-check-input" type="checkbox" value="1" id="yuran"  name="yuran" />
																	<label class="fs-6 fw-semibold form-label">
																		Yuran
																	</label>
																</div>
																<div class="col-6" id="divamaun">
																	<label class="d-flex align-items-center fs-6 fw-semibold form-label mb-2">Amaun Yuran</label>
																	<!--begin::Input-->
																	<input type="text" class="form-control form-control-solid" id="amaun" name="amaun" placeholder="" value="" />
																	<!--end::Input-->
																</div>
															</div>
															<br>
															<div class="row mb-10">
															<br>
															<br>
																<div class="col-6">
																	<input class="form-check-input" type="checkbox" value="1" id="elaun"  name="elaun" />
																	<label class="fs-6 fw-semibold form-label">
																		Elaun Wang Saku
																	</label>
																</div>
																<div class="col-6" id="divamaunelaun">
																	<label class="d-flex align-items-center fs-6 fw-semibold form-label mb-2">Amaun Wang Saku</label>
																	<!--begin::Input-->
																	<input type="text" class="form-control form-control-solid" name="amaunelaun" id="amaunelaun" placeholder="" value="" />
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
														<table id="kt_file_manager_list" data-kt-filemanager-table="files" class="table align-middle table-row-dashed fs-6 gy-5">
															<thead>
																<tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0">
																	
																	<th class="w-250px">Nama</th>
																	<th class="w-250px">Dokumen</th>
																	<th class="w-200px">Catatan</th>
																</tr>
															</thead>
															<tbody class="fw-semibold text-gray-600">
																<tr>
																	<td class="text-gray-800">Salinan Penyata Bank&nbsp;<a href="/assets/contoh/bank.pdf" target="_blank" data-bs-toggle="tooltip" title="CONTOH NYA MACAM NI"><i class="fa-solid fa-circle-info"></i></a></td>
																	<td class="fv-row"><input type="file" id="akaunBank" name="akaunBank"/></td>
																	<td><input type="text" class="form-control form-control-solid" id="nota_akaunBank" name="nota_akaunBank"/></td>
																</tr>
																<tr>
																	<td class="text-gray-800">Salinan Surat Tawaran Pengajian&nbsp;<a href="/assets/contoh/tawaran.pdf" target="_blank" data-bs-toggle="tooltip" title="CONTOH NYA MACAM NI"><i class="fa-solid fa-circle-info"></i></a></td>
																	<td class="fv-row"><input type="file" id="suratTawaran" name="suratTawaran"/></td>
																	<td><input type="text" class="form-control form-control-solid" id="nota_suratTawaran" name="nota_suratTawaran"/></td>
																</tr>
																<tr>
																	<td class="text-gray-800">Salinan Resit/Invois&nbsp;<a href="/assets/contoh/resit.pdf" target="_blank" data-bs-toggle="tooltip" title="CONTOH NYA MACAM NI"><i class="fa-solid fa-circle-info"></i></a></td>
																	<td class="fv-row"><input type="file" id="invoisResit" name="invoisResit"/></td>
																	<td><input type="text" class="form-control form-control-solid" id="nota_invoisResit" name="nota_invoisResit"/></td>
																</tr>

															</tbody>
														</table>
														<!--end::Table-->
														<br>
														<br>

														<div class="pb-10 pb-lg-15">
															<!--begin::Notice-->
															<div class="text-dark fw-semibold fs-6"><i class='fas fa-exclamation-triangle' style='color:red'></i>&nbsp; <a href="https://compressjpeg.com/" target="_blank">Kecilkan saiz fail dokumen disini.</a>
															</div>

															<div class="text-dark fw-semibold fs-6"><i class='fas fa-exclamation-triangle' style='color:red'></i>&nbsp; Format fail yang boleh dimuat naik adalah format 
															'.pdf', '.jpg', '.png' dan '.jpeg'
															</div>
															<div class="text-dark fw-semibold fs-6"><i class='fas fa-exclamation-triangle' style='color:red'></i>&nbsp; Saiz maksimum fail adalah 2 MB.
															</div>
															<!--end::Notice-->
														</div>
		
													</div>
													<!--end::Wrapper-->
												</div>
												<!--end::Step 5-->

												<!--begin::Step 5-->
												<div data-kt-stepper-element="content">
												@csrf	
												
													<!--begin::Wrapper-->
													<div class="w-100">
														<!--begin::Heading-->
														<div class="pb-10 pb-lg-15">
															<!--begin::Title-->
															<h2 class="fw-bold text-dark">Perakuan dan Pengesahan</h2>
															<!--end::Title-->
															<!--begin::Notice-->
															<div class="text-muted fw-semibold fs-6">Perakuan</div>
															<!--end::Notice-->
														</div>
														<!--end::Heading-->
														
														<div class="d-flex flex-column mb-7 fv-row">
															<div class="form-check">
																<input class="form-check-input" type="checkbox" value="1" id="perakuan" name="perakuan"/>
																<label class="form-check-label" >
																Saya mengaku bahawa segala maklumat yang diberikan adalah betul dan benar belaka. Saya juga faham
																sekiranya maklumat yang diberikan didapati palsu atau tidak benar, pihak kementerian berhak menolak
																permohonan saya dan menghentikan bantuan kewangan ini kepada saya.
																</label>
															</div>
															
														</div>

														
														
													</div>
													<!--end::Wrapper-->
												</div>
												<!--end::Step 5-->

												<!--begin::Step 6-->
												<div data-kt-stepper-element="content">
													<!--begin::Wrapper-->
													<div class="w-100">
														<!--begin::Heading-->
														<div class="pb-8 pb-lg-10">
															<!--begin::Title-->
															<h2 class="fw-bold text-dark">Your Are Done!</h2>
															<!--end::Title-->
															<!--begin::Notice-->
															<div class="text-muted fw-semibold fs-6">If you need more info, please......</div>
															<!--end::Notice-->
														</div>
														<!--end::Heading-->
														<!--begin::Body-->
														<div class="mb-0">
															<!--begin::Text-->
															<div class="fs-6 text-gray-600 mb-5">Writing headlines for blog posts is as much an art as it is a science and probably warrants its own post, but for all advise is with what works for your great & amazing audience.</div>
															<!--end::Text-->
															<!--begin::Alert-->
															<!--begin::Notice-->
															<div class="notice d-flex bg-light-warning rounded border-warning border border-dashed p-6">
																<!--begin::Icon-->
																<i class="ki-duotone ki-information fs-2tx text-warning me-4">
																	<span class="path1"></span>
																	<span class="path2"></span>
																	<span class="path3"></span>
																</i>
																<!--end::Icon-->
																<!--begin::Wrapper-->
																<div class="d-flex flex-stack flex-grow-1">
																	<!--begin::Content-->
																	<div class="fw-semibold">
																		<h4 class="text-gray-900 fw-bold">We need your attention!</h4>
																		<div class="fs-6 text-gray-700">To start using great tools, please,
																		...</div>
																	</div>
																	<!--end::Content-->
																</div>
																<!--end::Wrapper-->
															</div>
															<!--end::Notice-->
															<!--end::Alert-->
														</div>
														<!--end::Body-->
													</div>
													<!--end::Wrapper-->
												</div>
												<!--end::Step 6-->
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
														<button type="submit" class="btn btn-lg btn-primary me-3" data-kt-stepper-action="submit">
															<span class="indicator-label">Hantar
															<i class="ki-duotone ki-arrow-right fs-3 ms-2 me-0">
																<span class="path1"></span>
																<span class="path2"></span>
															</i></span>
															<span class="indicator-progress">Please wait...
															<span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
														</button>
														<button type="button" class="btn btn-lg btn-primary save-form" data-kt-stepper-action="next">Teruskan
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
									<!--end::Stepper-->
								</div>
								<!--end::Content container-->
							</div>
							<!--end::Content-->
						</div>

</div>
</main>



<!--begin::Javascript-->

		<!--begin::Global Javascript Bundle(mandatory for all pages)-->
		<script src="assets/js/scripts.bundle.js"></script>
		<!--end::Global Javascript Bundle-->

		<!--begin::Custom Javascript(used for this page only)-->
		<script src="assets/js/custom/utilities/modals/create-account.js"></script>
		<script src="assets/js/custom/apps/file-manager/list.js"></script>
		<script src="assets/js/custom/utilities/modals/create-app.js"></script>
		<!--end::Custom Javascript-->
		<!--end::Javascript-->

		<script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
		<script type="text/javascript">
   
			$(".save-form").click(function(e){
				e.preventDefault();
				var data = $('#kt_create_account_form').serialize();
				//alert (data);
				$.ajax({
					type: 'post',
					url: "{{ route('permohonan.post') }}",
					data: data,

				});
				
			});
		</script>

<script type='text/javascript'>
    		$(document).ready(function(){

				// institusi Change
				$('#alamatW_negeri').change(function(){

							// institusi id
							var id = $(this).val();
							//alert(id);

							// Empty the dropdown
							$('#alamatW_bandar').find('option').not(':first').remove();

							// AJAX request 
							$.ajax({
								url: 'getBandar/'+id,
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

											var id = response['data'][i].id;
											var nama = response['data'][i].nama;

											var option = "<option value='"+id+"'>"+nama+"</option>";

											$("#alamatW_bandar").append(option); 
										}
									}

								}
							});

				});

			});

			$(document).ready(function() {
			$('.js-example-basic-single').select2();
			});
   		</script>


<script>
			function select1(){
            var sumber = document.getElementById('sumber_biaya').value;
			var mod = document.getElementById('mod').value;
			var bilbulan = document.getElementById('bil_bulanpersem').value;
			var layak = "300";
			var total = layak * bilbulan;
            if(sumber=="1" && mod=="1"){
                document.getElementById("yuran").disabled = true;
                document.getElementById("divamaun").style.display = "none";
				document.getElementById("elaun").disabled = false;
				//document.getElementById("amaunelaun").disabled = true;
				document.getElementById("amaunelaun").value= total;
            }
			else if(sumber!="1" && mod=="2"){
                document.getElementById("yuran").disabled = false;
				document.getElementById("elaun").disabled = true;
				document.getElementById("divamaunelaun").style.display = "none";
            }
			else if(sumber=="1" && mod=="2"){
                document.getElementById("yuran").disabled = true;
				document.getElementById("elaun").disabled = true;
				document.getElementById("divamaun").style.display = "none";
				document.getElementById("divamaunelaun").style.display = "none";
            }
            else{
                document.getElementById("yuran").disabled = false;
				document.getElementById("elaun").disabled = false;
				document.getElementById("amaunelaun").value= total;
				//document.getElementById("amaunelaun").disabled = true;
            }
        }

		</script>

		


</x-default-layout>
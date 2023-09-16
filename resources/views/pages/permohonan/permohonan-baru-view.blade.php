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
			<form id="kt_create_account_form" action="" method="post" class="card-body py-20 w-100 mw-xl-700px px-9" enctype="multipart/form-data">
				
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
							<div class="col-md-6 fv-row">
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
							<div class="col-md-4 fv-row">
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
							<div class="col-md-6 fv-row">
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
							<div class="col-md-6 fv-row">
								<!--begin::Label-->
								<label class="fs-6 fw-semibold form-label mb-2">Keturunan</label>
								<!--end::Label-->
								<!--begin::Input wrapper-->
								<div class="col-12">
									<!--begin::Input-->
									<select id="bangsa" name="bangsa" class="form-select form-select-lg form-select-solid" data-control="select2" data-placeholder="Pilih" data-hide-search="true">
										<option value="{{$butiranPelajar->kod_keturunan}}">{{$butiranPelajar->keturunan}}</option>
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
							<textarea id="alamat_tetap" name="alamat_tetap" class="form-control form-control-lg form-control-solid" rows="2" readonly>{{$butiranPelajar->alamat_tetap}}</textarea>
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
									<input type="text" class="form-control form-control-solid" id="alamat_tetap_negeri" name="alamat_tetap_negeri" placeholder="" value="" readonly/>
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
									<input type="text" class="form-control form-control-solid" id="alamat_tetap_bandar" name="alamat_tetap_bandar" placeholder="" value="" readonly/>
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
									<input type="text" class="form-control form-control-solid" id="alamat_tetap_poskod" name="alamat_tetap_poskod" placeholder="" value=""/>
									<!--end::Input-->
								</div>
								<!--end::Input wrapper-->
							</div>
						</div>
						<!--end::Input group-->
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
											<input class="form-check-input" id="sama" name="sama" type="checkbox" value="1" @if($butiranPelajar->alamat_surat_menyurat == $butiranPelajar->alamat_tetap) checked @endif />
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
								<textarea id="alamat_surat" name="alamat_surat" class="form-control form-control-lg form-control-solid" rows="2" readonly>{{$butiranPelajar->alamat_surat_menyurat}}</textarea>
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
										<input type="text" class="form-control form-control-solid" id="alamat_surat_negeri" name="alamat_surat_negeri" placeholder="" value="{{$butiranPelajar->alamat_surat_negeri}}"  readonly/>
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
										<input type="text" class="form-control form-control-solid" id="alamat_surat_bandar" name="alamat_surat_bandar" placeholder="" value="{{$butiranPelajar->alamat_surat_bandar}}" readonly/>
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
										<input type="text" maxlength="5" class="form-control form-control-solid" id="alamat_surat_poskod" name="alamat_surat_poskod" placeholder="" value="{{$butiranPelajar->alamat_surat_poskod}}" readonly/>
										<!--end::Input-->
									</div>
									<!--end::Input wrapper-->
								</div>
							</div>
						<!--end::Input group-->
						<div class="row mb-10">
							<div class="col-md-6 fv-row">
								<!--begin::Label-->
								<label class=" fs-6 fw-semibold form-label mb-2">No. Tel Bimbit</label>
								<!--end::Label-->
								<!--begin::Input wrapper-->
								<div class="col-12">
									<!--begin::Input-->
									<input type="text" class="form-control form-control-solid" id="tel_bimbit" name="tel_bimbit" placeholder="" value="{{$butiranPelajar->tel_bimbit}}" readonly/>
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
									<input type="text" class="form-control form-control-solid" id="tel_rumah" name="tel_rumah" placeholder="" value="{{$butiranPelajar->tel_rumah}}" readonly/>
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
									<input type="text" class="form-control form-control-solid" maxlength="14" id="no_akaun_bank" name="no_akaun_bank" placeholder="" value="{{$butiranPelajar->no_akaun_bank}}" readonly/>
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
							<input type="text" class="form-control form-control-lg form-control-solid" id="nama_waris" name="nama_waris" placeholder="" value="{{$butiranPelajar->nama_waris}}" readonly/>
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
										<input type="text" class="form-control form-control-lg form-control-solid" maxlength="12" id="no_kp_waris" name="no_kp_waris" placeholder="" value="{{$butiranPelajar->no_kp_waris}}" readonly/>
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
										<input type="text" class="form-control form-control-lg form-control-solid" id="no_pasport_waris" name="no_pasport_waris" placeholder="" value="{{$butiranPelajar->no_pasport_waris}}" readonly/>
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
								<select id="hubungan_waris" name="hubungan_waris" class="form-select form-select-lg form-select-solid hubungan_waris" data-control="select2" data-placeholder="Pilih" disabled>
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
								<input type="text" class="form-control form-control-solid" id="tel_bimbit_waris" name="tel_bimbit_waris" placeholder="" value="{{$butiranPelajar->tel_bimbit_waris}}"  readonly/>
								<!--end::Input-->
							</div>
							
						</div>
						<!--end::Input group-->
						<div class="row mb-10">
							<div class="col-md-6 fv-row" id="div_waris_lain">
								<!--begin::Label-->
								<label class="form-label mb-6">(Jika Lain-lain) Sila Nyatakan:</label>
								<!--end::Label-->
								<!--begin::Input-->
								<input type="text" class="form-control form-control-lg form-control-solid" id="hubungan_lain_waris" name="hubungan_lain_waris" placeholder="" value="{{$butiranPelajar->hubungan_lain_waris}}" readonly/>
								<!--end::Input-->													
							</div>
							
						</div>
						<!--begin::Input group-->
						<div class="fv-row mb-10">
							<!--end::Label-->
							<label class="form-label">Alamat Tetap</label>
							<!--end::Label-->
							<!--begin::Input-->
							<textarea id="alamat_waris" name="alamat_waris" class="form-control form-control-lg form-control-solid" rows="2" readonly> {{$butiranPelajar->alamat_waris}}</textarea>
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
									<select id="alamat_negeri_waris" name="alamat_negeri_waris" class="form-select form-select-lg form-select-solid js-example-basic-single"  data-control="select2" data-hide-search="true" disabled>
										@foreach ($negeri as $negeri)
										<option value="{{$negeri->kod_negeri}}" {{$butiranPelajar->alamat_negeri_waris == $negeri->kod_negeri ? 'selected' : ''}}>{{ $negeri->negeri}}</option>
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
									<select id='alamat_bandar_waris' name='alamat_bandar_waris' class="form-select form-select-lg form-select-solid js-example-basic-single"  data-control="select2" data-hide-search="true" disabled>
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
									<input type="text" maxlength="5" class="form-control form-control-solid" id="alamat_poskod_waris" name="alamat_poskod_waris" placeholder="" value="{{$butiranPelajar->alamat_poskod_waris}}" readonly/>
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
									<input type="text" class="form-control form-control-solid" id="pekerjaan_waris" name="pekerjaan_waris" placeholder="" value="{{$butiranPelajar->pekerjaan_waris}}" readonly/>
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
									<input type="text" class="form-control form-control-solid" id="pendapatan_waris" name="pendapatan_waris" placeholder="RM" value="{{$butiranPelajar->pendapatan_waris}}" readonly/>
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
						<div class="d-flex flex-column mb-7 fv-row">
							<!--begin::Label-->
							<label class="d-flex align-items-center fs-6 fw-semibold form-label mb-2">
								<span class="">Nama Pusat Pengajian</span>
							</label>
							<!--end::Label-->
							<select id="id_institusi" name="id_institusi" class="form-select form-select-solid" data-control="select2" data-hide-search="true" data-placeholder="Pilih" disabled>
								@foreach ($institusi as $institusi)
								<option value="{{$institusi->id_institusi}}" {{$butiranPelajar->id_institusi == $institusi->id_institusi ? 'selected' : ''}}>{{ $institusi->nama_institusi}}</option>
								@endforeach
							</select>
						</div>
						<div class="d-flex flex-column mb-7 fv-row">
							<!--begin::Label-->
							<label class="d-flex align-items-center fs-6 fw-semibold form-label mb-2">
								<span class="">Nama Kursus</span>
							</label>
							<!--end::Label-->
							<select id="nama_kursus" name="nama_kursus" class="form-select form-select-solid" data-control="select2" data-hide-search="true" data-placeholder="Pilih" disabled>
								<option value="{{ $butiranPelajar->nama_kursus}}">{{ $butiranPelajar->nama_kursus}}</option>
							</select>
						</div>
						<!--end::Input group-->
						<!--begin::Input group-->
						<div class="row mb-10">
							<!--begin::Col-->
							<div class="col-md-6 fv-row">
								<!--begin::Label-->
								<label class=" fs-6 fw-semibold form-label mb-2">Peringkat Pengajian</label>
								<!--end::Label-->
								<!--begin::Row-->
								<div class="row fv-row">
									<!--begin::Input wrapper-->
									<select id="peringkat_pengajian" name="peringkat_pengajian" class="form-select form-select-solid" data-control="select2" data-hide-search="true" data-placeholder="Pilih" disabled>
										@foreach ($peringkat as $peringkat)
										<option value="{{$peringkat->kod_peringkat}}" {{$butiranPelajar->peringkat_pengajian == $peringkat->kod_peringkat ? 'selected' : ''}}>{{ $peringkat->peringkat}}</option>
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
								<label class="d-flex align-items-center fs-6 fw-semibold form-label mb-2">Mod Pengajian</label>
								<!--end::Label-->
								<!--begin::Input wrapper-->
								<select name="mod" id="mod" class="form-select form-select-solid" onchange=select1() data-control="select2" data-hide-search="true" data-placeholder="Pilih" disabled>
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
								<label class="d-flex align-items-center fs-6 fw-semibold form-label mb-2">Tempoh Pengajian (Tahun)</label>
								<!--end::Label-->
									<!--begin::Input wrapper-->
									<select id="tempoh_pengajian" name="tempoh_pengajian" class="form-select form-select-solid" data-control="select2" data-hide-search="true" data-placeholder="Pilih" required disabled>
										<option value="{{$butiranPelajar->tempoh_pengajian}}">{{$butiranPelajar->tempoh_pengajian}}</option>
										<option value="1">1</option>
										<option value="1.5">1.5</option>
										<option value="2">2</option>
										<option value="2.5">2.5</option>
										<option value="3">3</option>
										<option value="3.5">3.5</option>
										<option value="4">4</option>
									</select>
									<!--end::Input wrapper-->
							</div>
							<!--end::Col-->
							<div class="col-md-6 fv-row">
								<!--begin::Label-->
								<label class=" fs-6 fw-semibold form-label mb-2">Bil Bulan Persemester</label>
								<!--end::Label-->
								<!--begin::Row-->
								<div class="row fv-row">
									<!--begin::Input wrapper-->
										<select id="bil_bulan_per_sem" name="bil_bulan_per_sem" class="form-select form-select-solid" data-control="select2" data-hide-search="true" data-placeholder="Pilih" disabled>
											<option value="{{$butiranPelajar->bil_bulan_per_sem}}">{{$butiranPelajar->bil_bulan_per_sem}}</option>
											<option value="4">4</option>
											<option value="6">6</option>
										</select>
									<!--end::Input wrapper-->
								</div>
								<!--end::Row-->
							</div>
						</div>
						<div class="row mb-10">
							<div class="col-md-6 fv-row">
								<!--begin::Label-->
								<label class="d-flex align-items-center fs-6 fw-semibold form-label mb-2">
								<span class="">Sesi Pengajian Semasa</span>&nbsp;<a href="#" data-bs-toggle="tooltip" title="2023/2024"><i class="fa-solid fa-circle-info"></i></a>
								</label>
								<!--end::Label-->
									<!--begin::Input wrapper-->
									<select id="sesi" name="sesi" class="form-select form-select-solid" data-control="select2" data-hide-search="true" data-placeholder="Pilih" disabled>
										<option value="{{$butiranPelajar->sesi}}">{{$butiranPelajar->sesi}}</option>
										<option value="2023/2024">2023/2024</option>
										<option value="2024/2025">2024/2025</option>
									</select>
									<!--end::Input wrapper-->
							</div>
							<!--end::Col-->
							<div class="col-md-6 fv-row">
								<!--begin::Label-->
								<label class="d-flex align-items-center fs-6 fw-semibold form-label mb-2">
									<span class="">No Pendaftaran Pelajar</span>
									
								</label>
								<!--end::Label-->
								<input type="text" class="form-control form-control-solid" placeholder="" id="no_pendaftaran_pelajar" name="no_pendaftaran_pelajar" value="{{$butiranPelajar->no_pendaftaran_pelajar}}" readonly/>
							</div>
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
									<input type="date" class="form-control form-control-solid" placeholder="" id="tarikh_mula" name="tarikh_mula" value="{{$butiranPelajar->tarikh_mula}}" readonly/>
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
									<input type="date" class="form-control form-control-solid" placeholder="" id="tarikh_tamat" name="tarikh_tamat" onchange=dateCheck() value="{{$butiranPelajar->tarikh_tamat}}" readonly/>
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
								<label class=" fs-6 fw-semibold form-label mb-2">Semester Semasa</label>
								<!--end::Label-->
								<!--begin::Row-->
								<div class="row fv-row">
									<!--begin::Input wrapper-->
									
										<select id="sem_semasa" name="sem_semasa" class="form-select form-select-solid" data-control="select2" data-hide-search="true" data-placeholder="Pilih" disabled>
											<option value="{{$butiranPelajar->sem_semasa}}">{{$butiranPelajar->sem_semasa}}</option>
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
										<select id="sumber_biaya" name="sumber_biaya" class="form-select form-select-solid" onchange="select1()" data-control="select2" data-hide-search="true" data-placeholder="Pilih" disabled>
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
								<input type="text" class="form-control form-control-solid" placeholder="" id="sumber_lain" name="sumber_lain" value="{{$butiranPelajar->sumber_lain}}" readonly/>
								<!--end::Input wrapper-->
							</div>
							<!--end::Col-->
						</div>
						<!--end::Input group-->
						<!--begin::Input group-->
						<div class="row mb-10">
							<div class="col-md-6 fv-row">
								<!--begin::Label-->
								<label class="d-flex align-items-center fs-6 fw-semibold form-label mb-2">
									<span class="">Nama Penaja</span>&nbsp;<a href="#" data-bs-toggle="tooltip" title="CONTOH"><i class="fa-solid fa-circle-info"></i></a>
								</label>															
								<!--end::Label-->
								<select id="nama_penaja" name="nama_penaja" class="form-select form-select-solid" data-control="select2" data-hide-search="true" data-placeholder="Pilih" disabled>
									@foreach ($penaja as $penaja)
									<option value="{{$penaja->kod_penaja}}" {{$butiranPelajar->nama_penaja == $penaja->kod_penaja ? 'selected' : ''}}>{{ $penaja->penaja}}</option>
									@endforeach
								</select>
							</div>
							<!--begin::Col-->
							<div class="col-md-6 fv-row" id="div_penaja_lain">
								<!--begin::Label-->
								<label class="d-flex align-items-center fs-6 fw-semibold form-label mb-2">(Jika Lain-lain) Sila Nyatakan:</label>
								<!--end::Label-->
								<!--begin::Input wrapper-->
								<input type="text" class="form-control form-control-solid" placeholder="" id="penaja_lain" name="penaja_lain" value="{{$butiranPelajar->penaja_lain}}" readonly/>
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
								<div class="col-6" id="divyuran">
									<input class="form-check-input" type="checkbox" value="1" id="yuran"  name="yuran" onclick="return false" checked/>
									<label class="fs-6 fw-semibold form-label">
										Yuran
									</label>
								</div>
								<div class="col-6" id="divamaun">
									<label class="d-flex align-items-center fs-6 fw-semibold form-label mb-2">Amaun Yuran</label>
									<!--begin::Input-->
									<input type="text" class="form-control form-control-solid" id="amaun_yuran" name="amaun_yuran" placeholder="" value="{{$butiranPelajar->amaun_yuran}}" readonly/>
									<!--end::Input-->
								</div>
							</div>
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
									<input type="text" class="form-control form-control-solid" name="amaun_wang_saku" id="amaun_wang_saku" placeholder="" value="{{$butiranPelajar->amaun_wang_saku}}" readonly/>
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
							</tbody>
							
						</table>
						<!--end::Table-->

						<br>
						<br>
						<div class="pb-10 pb-lg-15">
							<!--begin::Notice-->
							<div class="text-dark fw-semibold fs-6"><i class='fas fa-exclamation-triangle' style='color:orange'></i>&nbsp; <a href="https://compressjpeg.com/" target="_blank">Gunakan kemudahan di sini untuk mengurangkan saiz fail sebelum memuat naik fail.</a>
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
								<input class="form-check-input" type="checkbox" value="1" id="perakuan" name="perakuan" @if($butiranPelajar->perakuan !== null) checked disabled @endif />
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
					@if($butiranPelajar->status <='2')  
						<button type="button" class="btn btn-lg btn-primary me-3" data-kt-stepper-action="submit" onclick="confirmFunction()">Kemaskini</button>
						<button type="button" class="btn btn-lg btn-primary" data-kt-stepper-action="next">Teruskan
						<i class="ki-duotone ki-arrow-right fs-4 ms-1 me-0">
							<span class="path1"></span>
							<span class="path2"></span>
						</i>
						</button>
					@else
						<button type="button" class="btn btn-lg btn-primary" data-kt-stepper-action="next">Teruskan
						<i class="ki-duotone ki-arrow-right fs-4 ms-1 me-0">
							<span class="path1"></span>
							<span class="path2"></span>
						</i>
						</button>	
					@endif	
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
		<script src="assets/js/scripts.bundle.js"></script>
		<!--end::Global Javascript Bundle-->

		<!--begin::Custom Javascript(used for this page only)-->
		<script src="assets/js/custom/utilities/modals/view-permohonan.js"></script>
		<!--end::Custom Javascript-->
		<!--end::Javascript-->

		<script src = "https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
		<script type="text/javascript">
   
			$(".save-form").click(function(e){
				e.preventDefault();
				var data = $('#kt_create_account_form').serialize();
				//alert (data);
				$.ajax({
					type: 'post',
					url: "{{ route('permohonan.simpan') }}",
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

			var alamat_surat = document.getElementById("alamat_surat");
			var alamat_surat_negeri = document.getElementById("alamat_surat_negeri");
			var alamat_surat_bandar = document.getElementById("alamat_surat_bandar");
			var alamat_surat_poskod = document.getElementById("alamat_surat_poskod");
			if (checkBox.checked == true){
				alamat_surat.value=alamat_tetap.value; 
				alamat_surat_negeri.value=alamat_tetap_negeri.value;
				alamat_surat_bandar.value=alamat_tetap_bandar.value;
				alamat_surat_poskod.value=alamat_tetap_poskod.value;
			} else {
				alamat_surat.value="";
				alamat_surat_negeri.value="";
				alamat_surat_bandar.value="";
				alamat_surat_poskod.value="";
			}
		}	

    		$(document).ready(function(){
				$('#alamat_negeri_waris').on('change', function() {
					var idnegeri = $(this).val();
					//alert(id);
					// Empty the dropdown
					$('#alamat_bandar_waris').find('option').not(':first').remove();

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
			$(document).ready(function(){
				$("#div_biaya_lain").hide();
				$('#sumber_biaya').on('change', function() {
				if ( this.value == '5'){
					$("#div_biaya_lain").show();
				}
				else {
					$("#div_biaya_lain").hide();
				}
				});
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

				if(startDate > endDate) {
					alert("Tarikh Tamat Pengajian perlu lebih besar daripada Tarikh Mula Pengajian");
					$("#tarikh_tamat").val('');
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


		<script>
			function select1(){
            var sumber = document.getElementById('sumber_biaya').value;
			var mod = document.getElementById('mod').value;
			var bilbulan = document.getElementById('bil_bulan_per_sem').value;
			var layakyuran = "5000";
			var layak = "300";
			var total = layak * bilbulan;
            if(sumber=="1" && mod=="1"){
                document.getElementById("divyuran").style.display = "none";
                document.getElementById("divamaun").style.display = "none";
				document.getElementById("wang_saku").disabled = false;
				document.getElementById("amaun_wang_saku").value= total;
            }
			else if(sumber!="1" && mod=="2"){
                document.getElementById("yuran").disabled = false;
				document.getElementById("divelaun").style.display = "none";
				document.getElementById("divamaunelaun").style.display = "none";
            }
			else if(sumber=="1" && mod=="2"){
                document.getElementById("divyuran").style.display = "none";
				document.getElementById("divelaun").style.display = "none";
				document.getElementById("divamaun").style.display = "none";
				document.getElementById("divamaunelaun").style.display = "none";
            }
            else{
                document.getElementById("yuran").disabled = false;
				document.getElementById("amaun_yuran").value= layakyuran;
				document.getElementById("wang_saku").disabled = false;
				document.getElementById("amaun_wang_saku").value= total;
            }
        }

		</script>

		


</x-default-layout>
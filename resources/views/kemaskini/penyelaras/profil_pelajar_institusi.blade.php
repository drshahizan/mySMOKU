<x-default-layout> 
	<style>
		/* Some custom styles to beautify this example */
		.bs-example{
			margin: 60px 0;
		}
		i{
			font-size: 22px;
		}
	</style>

<!--begin::Page title-->
<div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
	<!--begin::Title-->
	<h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Profil Pelajar</h1>
	<!--end::Title-->
	
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
							<div class="stepper-desc fw-semibold">Profil Diri</div>
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
							<h3 class="stepper-title">Dokumen</h3>
							<div class="stepper-desc fw-semibold">Salinan Dokumen</div>
						</div>
						<!--end::Label-->
					</div>
					<!--end::Wrapper-->
				</div>
				<!--end::Step 4-->
			</div>
			<!--end::Nav-->
		</div>
		<!--end::Wrapper-->
	</div>
	<!--end::Aside-->
		<!--begin::Content-->
		<div class="card d-flex flex-row-fluid flex-center">
			<!--begin::Form-->
			<form id="kt_create_account_form" action="{{ route('simpan.profil.pelajar.institusi', ['id' => $smoku->smoku_id ]) }}" method="post" class="card-body py-20 w-100 mw-xl-700px px-9" enctype="multipart/form-data">
				
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
							<input type="text" class="form-control form-control-lg form-control-solid"  id="nama_pelajar" name="nama_pelajar" style="text-transform: uppercase;" placeholder="" value="{{strtoupper($smoku->nama)}}"/>
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
										<input type="text" class="form-control form-control-lg form-control-solid" maxlength="12" id="no_kp" name="no_kp" placeholder="" value="{{$smoku->no_kp}}"/>
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
										<input type="date" data-date-autoclose="true" class="form-control form-control-solid" placeholder="" id="tarikh_lahir" name="tarikh_lahir" value="{{$smoku->tarikh_lahir}}" />
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
										<select id="negeri_lahir" name="negeri_lahir" class="form-select form-select-lg form-select-solid basic-search" data-placeholder="Pilih" data-control="select2" data-hide-search="true" >
											<option></option>
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
										<input type="int" class="form-control form-control-solid" id="umur" name="umur" placeholder="" value="{{$smoku->umur}}" readonly/>
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
									<select id="jantina" name="jantina" class="form-select form-select-lg form-select-solid" data-control="select2" data-placeholder="Pilih" data-hide-search="true" >
										<option value="L" {{$smoku->kod_jantina == "L" ? 'selected' : ''}}>LELAKI</option>
										<option value="P" {{$smoku->kod_jantina == "P" ? 'selected' : ''}}>PEREMPUAN</option>
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
									<select id='keturunan' name='keturunan' class="form-select form-select-lg form-select-solid basic-search" data-placeholder="Pilih" data-control="select2" data-hide-search="true">
										<option></option>
										@foreach ($keturunan as $keturunan)	
										<option value="{{$keturunan->id}}" {{$smoku->kod_keturunan == $keturunan->id ? 'selected' : ''}}>{{ strtoupper($keturunan->keturunan)}}</option>
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
									<select id="agama" name="agama" class="form-select form-select-lg form-select-solid basic-search" data-placeholder="Pilih" data-control="select2" data-hide-search="true">
										<option></option>
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
							<textarea id="alamat_tetap" name="alamat_tetap" class="form-control form-control-lg form-control-solid" rows="2" style="text-transform: uppercase;"  style="text-transform: uppercase;">{{$butiranPelajar->alamat_tetap}}</textarea>
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
									<select id="alamat_tetap_negeri" name="alamat_tetap_negeri" class="form-select form-select-lg form-select-solid basic-search" data-placeholder="Pilih" data-control="select2" data-hide-search="true" >
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
									<select id='alamat_tetap_bandar' name='alamat_tetap_bandar' class="form-select form-select-lg form-select-solid basic-search" data-placeholder="Pilih" data-control="select2" data-hide-search="true" >
										<option value="">Pilih</option>
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
									<input type="text" maxlength="5" class="form-control form-control-solid" id="alamat_tetap_poskod" name="alamat_tetap_poskod" placeholder="" value="{{$butiranPelajar->alamat_tetap_poskod}}"/>
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
									<select id="parlimen" name="parlimen" class="form-select form-select-lg form-select-solid basic-search" 
											data-placeholder="Pilih" data-control="select2" data-hide-search="true" 
											data-selected="{{ $butiranPelajar->parlimen }}">
										<option value="">Pilih</option>
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
									<select id="dun" name="dun" class="form-select form-select-lg form-select-solid basic-search" data-placeholder="Pilih" data-control="select2" data-hide-search="true" >
										<option></option>
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
											<input class="form-check-input" id="sama" name="sama" onclick="myFunction()" type="checkbox" value="1"
												@if($butiranPelajar->alamat_surat_menyurat && $butiranPelajar->alamat_tetap && $butiranPelajar->alamat_surat_menyurat == $butiranPelajar->alamat_tetap)
													checked
												@endif
											/>
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
								<textarea id="alamat_surat_menyurat" name="alamat_surat_menyurat" class="form-control form-control-lg form-control-solid" rows="2" style="text-transform: uppercase;">{{$butiranPelajar->alamat_surat_menyurat}}</textarea>
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
										<select id="alamat_surat_negeri" name="alamat_surat_negeri" class="form-select form-select-lg form-select-solid basic-search" data-placeholder="Pilih" data-control="select2" data-hide-search="true" >
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
										<select id='alamat_surat_bandar' name='alamat_surat_bandar' class="form-select form-select-lg form-select-solid basic-search" data-placeholder="Pilih" data-control="select2" data-hide-search="true" >
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
										<input type="text" maxlength="5" class="form-control form-control-solid" id="alamat_surat_poskod" name="alamat_surat_poskod" placeholder="" value="{{$butiranPelajar->alamat_surat_poskod}}"/>
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
									<input type="text" class="form-control form-control-solid" id="emel" name="emel" placeholder="" value="{{$butiranPelajar->emel}}"/>
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
									<input type="text" class="form-control form-control-solid" id="tel_bimbit" name="tel_bimbit" placeholder="" value="{{str_replace('-', '', $butiranPelajar->tel_bimbit)}}" />
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
									<input type="text" class="form-control form-control-solid" id="tel_rumah" name="tel_rumah" placeholder="" value="{{str_replace('-', '', $butiranPelajar->tel_rumah)}}" />
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
									<select id="status_pekerjaan" name="status_pekerjaan" class="form-select form-select-solid" data-control="select2" data-hide-search="true" data-placeholder="Pilih" >
										<option></option>
										<option value="TIDAK BEKERJA" {{$butiranPelajar->status_pekerjaan == "TIDAK BEKERJA" ? 'selected' : ''}}>TIDAK BEKERJA</option>
										<option value="BEKERJA" {{$butiranPelajar->status_pekerjaan == "BEKERJA" ? 'selected' : ''}}>BEKERJA</option>
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
									<input type="text" class="form-control form-control-solid" id="pekerjaan" name="pekerjaan" style="text-transform: uppercase;" placeholder="" value="{{strtoupper($butiranPelajar->pekerjaan)}}" />
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
									<input type="number" class="form-control form-control-solid" id="pendapatan" name="pendapatan" placeholder="" value="{{$butiranPelajar->pendapatan}}" />
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
										<input type="text" class="form-control form-control-solid" id="no_daftar_oku" name="no_daftar_oku" placeholder="" value="{{$smoku->no_daftar_oku}}"/>
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
										<select id="oku" name="oku" class="form-select form-select-lg form-select-solid basic-search" data-placeholder="Pilih" data-control="select2" data-hide-search="true">
											<option></option>
											@foreach ($oku as $oku)
												<option value="{{$oku->kod_oku}}" {{$smoku->kategori == $oku->kod_oku ? 'selected' : ''}}>{{ $oku->kecacatan}}</option>
											@endforeach
										</select>
										<input type="hidden" class="form-control form-control-solid" id="kecacatan" name="kecacatan" placeholder="" value="{{$smoku->kod_oku}}" readonly/>
										<!--end::Input-->
									</div>
									<!--end::Input wrapper-->
								</div>
							</div>
							<!--end::Input group-->
							@php
								$akademik_id = DB::table('smoku_akademik')->where('smoku_id',$smoku->smoku_id)->first();
								$institusi_id = DB::table('bk_info_institusi')->where('id_institusi', $akademik_id->id_institusi)->first();
							@endphp
							@if($institusi_id->jenis_institusi != 'UA')
								<div class="separator my-14"></div>
								<div class="pb-10 pb-lg-15">
									<!--begin::Title-->
									<h2 class="fw-bold text-dark">Maklumat Perbankan</h2>
									<!--end::Title-->
									<!--begin::Notice-->
									<div class="text-muted fw-semibold fs-6">Bank Islam</div>
									<div class="fw-semibold fs-4" style="color: red">* Pelajar perlu memastikan akaun bank berstatus aktif.</div>
									<div class="fw-semibold fs-4" style="color: red">* Pemberian bantuan hanya akan dilaksanakan melalui akaun Bank Islam. Mohon pastikan akaun yang dikemukakan adalah akaun Bank Islam yang aktif.</div>
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
										<input type="text" class="form-control form-control-solid" maxlength="14" id="no_akaun_bank" name="no_akaun_bank" placeholder="" value="{{ $butiranPelajar->no_akaun_bank }}" />
										<!--end::Input-->
									</div>
									<!--end::Input wrapper-->
								</div>
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
							<input type="text" class="form-control form-control-lg form-control-solid" id="nama_waris" name="nama_waris" style="text-transform: uppercase;" placeholder="" value="{{strtoupper($waris->nama_waris)}}" />
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
										<input type="text" class="form-control form-control-lg form-control-solid" maxlength="12" id="no_kp_waris" name="no_kp_waris" placeholder="" value="{{$waris->no_kp_waris}}" />
									</div>
									<!--end::Col-->
								</div>
								<!--end::Row-->
							</div>
							<div class="col-md-6 fv-row">
								<!--begin::Label-->
								<label class=" fs-6 fw-semibold form-label mb-2">No Pasport (Jika ada)</label>
								<!--end::Label-->
								<!--begin::Row-->
								<div class="row fv-row">
									<!--begin::Col-->
									<div class="col-12">
										<input type="text" class="form-control form-control-lg form-control-solid" id="no_pasport_waris" name="no_pasport_waris" placeholder="" value="{{$butiranPelajar->no_pasport_waris}}" />
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
								<select id="hubungan_waris" name="hubungan_waris" class="form-select form-select-lg form-select-solid hubungan_waris" data-control="select2" data-placeholder="Pilih" >
									<option></option>
									@foreach ($hubungan as $hubungan)
										<option value="{{$hubungan->kod_hubungan}}" {{$waris->hubungan_waris == $hubungan->kod_hubungan ? 'selected' : ''}}>{{ $hubungan->hubungan}}</option>
									@endforeach
								</select>
							</div>
							<div class="col-md-6 fv-row">
								<!--begin::Label-->
								<label class="form-label mb-6">No. Tel Bimbit</label>
								<!--end::Label-->
								<!--begin::Input-->
								<input type="text" class="form-control form-control-solid" id="tel_bimbit_waris" name="tel_bimbit_waris" placeholder="" value="{{str_replace('-', '', $waris->tel_bimbit_waris)}}"  />
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
								<input type="text" class="form-control form-control-lg form-control-solid" id="hubungan_lain_waris" name="hubungan_lain_waris" style="text-transform: uppercase;" placeholder="" value="{{$waris->hubungan_lain_waris}}" />
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
										<input class="form-check-input" id="sama_waris" name="sama_waris" onclick="alamatWaris()" type="checkbox" value="1"
											@if($butiranPelajar->alamat_tetap && $waris->alamat_waris && $butiranPelajar->alamat_tetap == $waris->alamat_waris)
												checked
											@endif
										/>

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
							<textarea id="alamat_waris" name="alamat_waris" class="form-control form-control-lg form-control-solid" rows="2" style="text-transform: uppercase;" >{{strtoupper($waris->alamat_waris)}}</textarea>
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
									<select id="alamat_negeri_waris" name="alamat_negeri_waris" class="form-select form-select-lg form-select-solid basic-search"  data-control="select2" data-hide-search="true" >
										<option value="">Pilih</option>
                                        @foreach ($negeri as $negeri)
										<option value="{{$negeri->id}}" {{$waris->alamat_negeri_waris == $negeri->id ? 'selected' : ''}}>{{ $negeri->negeri}}</option>
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
									<select id='alamat_bandar_waris' name='alamat_bandar_waris' class="form-select form-select-lg form-select-solid basic-search"  data-control="select2" data-hide-search="true" >
										<option value="">Pilih</option>
										@foreach ($bandar as $bandar)
										<option value="{{$bandar->id}}" {{$waris->alamat_bandar_waris == $bandar->id ? 'selected' : ''}}>{{ $bandar->bandar}}</option>
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
									<input type="text" maxlength="5" class="form-control form-control-solid" id="alamat_poskod_waris" name="alamat_poskod_waris" placeholder="" value="{{$waris->alamat_poskod_waris}}" />
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
									<input type="text" class="form-control form-control-solid" id="pekerjaan_waris" style="text-transform: uppercase;" name="pekerjaan_waris" placeholder="" value="{{$waris->pekerjaan_waris}}" />
									<!--end::Input-->
								</div>
								<!--end::Input wrapper-->
							</div>
							<div class="col-md-6 fv-row">
								<!--begin::Label-->
								<label class="fs-6 fw-semibold form-label mb-2">
									Pendapatan Bulanan Isi Rumah&nbsp;
									<span data-bs-toggle="tooltip" data-bs-trigger="hover" title="Nilai tanpa .00">
										<i class="fa-solid fa-circle-info" style="color: rgb(18, 178, 231);"></i>
									</span>
								</label>
								<div class="fw-semibold fs-8" style="color: red">* Maklumat yang diisi mestilah benar, sekiranya didapati maklumat yang dinyatakan tidak benar, bantuan ini akan ditarikh balik dan boleh dikenakan tindakan.</div>							
								<br>
								<!--end::Label-->
								<!--begin::Input wrapper-->
								<div class="col-12">
									<!--begin::Input-->
									<input type="number" class="form-control form-control-solid" id="pendapatan_waris" name="pendapatan_waris" placeholder="RM" value="{{$waris->pendapatan_waris}}" />
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
							<select id="id_institusi" name="id_institusi" class="form-select form-select-solid basic-search" data-control="select2" data-hide-search="true" data-placeholder="Pilih">
								@foreach ($institusi as $institusi)
									<option value="{{$institusi->id_institusi}}" {{$akademik->id_institusi == $institusi->id_institusi ? 'selected' : ''}}>{{ strtoupper($institusi->nama_institusi)}}</option>
								@endforeach
							</select>							 
						</div>
						<!--begin::Input group-->
						<div class="row mb-10">
							<div class="col-md-6 fv-row">
								<!--begin::Label-->
								<label class="d-flex align-items-center fs-6 fw-semibold form-label mb-2">
									<span class="">No Pendaftaran Pelajar</span>
								</label>
								<!--end::Label-->
								<input type="text" class="form-control form-control-solid" placeholder="" id="no_pendaftaran_pelajar" name="no_pendaftaran_pelajar" value="{{$akademik->no_pendaftaran_pelajar}}" />
							</div>
							<!--begin::Col-->
							<div class="col-md-6 fv-row">
								<!--begin::Label-->
								<label class=" fs-6 fw-semibold form-label mb-2">Peringkat Pengajian</label>
								<!--end::Label-->
								<!--begin::Row-->
								<div class="row fv-row">
									<!--begin::Input wrapper-->
									<input type="hidden" class="form-control form-control-solid" placeholder="" id="peringkat" name="peringkat" value="{{$akademik->peringkat_pengajian}}" />
									<select id="peringkat_pengajian" name="peringkat_pengajian" class="form-select form-select-solid" data-control="select2" data-hide-search="true" data-placeholder="Pilih">
										<option value="">Pilih</option>
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
							<input type="hidden" class="form-control form-control-solid" placeholder="" id="nama_kursus_asal" name="nama_kursus_asal" value="{{$akademik->nama_kursus}}" />
							<select id="nama_kursus" name="nama_kursus" class="form-select form-select-solid" data-control="select2" data-placeholder="Pilih">
								<option value="">Pilih</option>
							</select>
						</div>
						<!--end::Input group-->
						<div class="row mb-10">
							<div class="col-md-6 fv-row">
								<!--begin::Label-->
								<label class="d-flex align-items-center fs-6 fw-semibold form-label mb-2">Tempoh Pengajian (Tahun)</label>
								<!--end::Label-->
									<!--begin::Input wrapper-->
									<select id="tempoh_pengajian" name="tempoh_pengajian" onchange=dateCheck() class="form-select form-select-solid" data-control="select2" data-hide-search="true" data-placeholder="Pilih" required>
										<option></option>
										@for($i = 1; $i <= 4; $i += 0.5)
											@if($akademik->tempoh_pengajian == ($i == (int)$i ? (int)$i : number_format($i, 1)))
												<option value="{{ ($i == (int)$i) ? (int)$i : $i }}" selected>{{ ($i == (int)$i) ? (int)$i : number_format($i, 1) }}</option>
											@else
												<option value="{{ ($i == (int)$i) ? (int)$i : $i }}">{{ ($i == (int)$i) ? (int)$i : number_format($i, 1) }}</option>
											@endif
										@endfor
									</select>
									<!--end::Input wrapper-->
							</div>
							<!--end::Col-->
							<div class="col-md-6 fv-row">
								<!--begin::Label-->
								<label class=" fs-6 fw-semibold form-label mb-2">Bilangan Bulan Persemester</label>
								<!--end::Label-->
								<!--begin::Row-->
								<div class="row fv-row">
									<!--begin::Input wrapper-->
										<select id="bil_bulan_per_sem" name="bil_bulan_per_sem" class="form-select form-select-solid" data-control="select2" data-hide-search="true" data-placeholder="Pilih">
										<option value="4" {{$akademik->bil_bulan_per_sem == "4" ? 'selected' : ''}}>4</option>
										<option value="6" {{$akademik->bil_bulan_per_sem == "6" ? 'selected' : ''}}>6</option>
										</select>
									<!--end::Input wrapper-->
								</div>
								<!--end::Row-->
							</div>
						</div>
						<!--begin::Input group-->
						<div class="row mb-10">
							<!--begin::Col-->
							<div class="col-md-6 fv-row">
								<!--begin::Label-->
								<label class="fs-6 fw-semibold form-label mb-2">
									Sesi Pengajian&nbsp;
									<span data-bs-toggle="tooltip" data-bs-trigger="hover" title="2023/2024">
										<i class="fa-solid fa-circle-info" style="color: rgb(18, 178, 231);"></i>
									</span>
								</label>
								<!--end::Label-->
								<!--begin::Input wrapper-->
								<select id="sesi" name="sesi" class="form-select form-select-solid" data-control="select2" data-hide-search="true" data-placeholder="Pilih">
									{{-- <option></option> --}}
									@if(empty($akademik->sesi))
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
										@php
											$currentSesi = $akademik->sesi;
											$found = false;
										@endphp
										
										<!-- Display the current sesi as the first option -->
										@if($currentSesi)
											<option value="{{ $currentSesi }}" selected>{{ $currentSesi }}</option>
										@endif
										
										@for($year = date('Y') - 1; $year <= (date('Y') + 1); $year++)
											@php
												$sesi = $year . '/' . ($year + 1);
											@endphp
											@if($sesi === $currentSesi)
												@php $found = true; @endphp
												<!-- Skip to avoid duplicate if currentSesi matches -->
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
								<select name="mod" id="mod" class="form-select form-select-solid" data-control="select2" data-hide-search="true" data-placeholder="Pilih">
									<option></option>
									@foreach ($mod as $mod)
										<option value="{{$mod->kod_mod}}" {{$akademik->mod == $mod->kod_mod ? 'selected' : ''}}>{{ $mod->mod}}</option>
									@endforeach
								</select>
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
									Tarikh Mula Pengajian&nbsp;
									<span data-bs-toggle="tooltip" data-bs-trigger="hover" title="Sama seperti dalam surat tawaran">
										<i class="fa-solid fa-circle-info" style="color: rgb(18, 178, 231);"></i>
									</span>
								</label>
								<!--end::Label-->
								<!--begin::Input wrapper-->
								<input type="date" class="form-control form-control-solid" placeholder="" id="tarikh_mula" name="tarikh_mula" onchange=dateCheck() value="{{$akademik->tarikh_mula}}" />
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
								<input type="date" class="form-control form-control-solid" placeholder="" id="tarikh_tamat" name="tarikh_tamat" value="{{$akademik->tarikh_tamat}}" />
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
										<select id="sumber_biaya" name="sumber_biaya" class="form-select form-select-solid" data-control="select2" data-hide-search="true" data-placeholder="Pilih">
											<option></option>
											@foreach ($biaya as $biaya)
											<option value="{{$biaya->kod_biaya}}" {{$akademik->sumber_biaya == $biaya->kod_biaya ? 'selected' : ''}}>{{ $biaya->biaya}}</option>
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
								<input type="text" class="form-control form-control-solid" placeholder="" id="sumber_lain" name="sumber_lain" value="{{$akademik->sumber_lain}}"/>
								<!--end::Input wrapper-->
							</div>
							<!--end::Col-->
						</div>
						<!--end::Input group-->
						<!--begin::Input group-->
						<div class="row mb-10">
							<div class="col-md-6 fv-row" id="div_nama_penaja">
								<!--begin::Label-->
								<label class="d-flex align-items-center fs-6 fw-semibold form-label mb-2">
									<span class="">Nama Penaja</span>
								</label>															
								<!--end::Label-->
								<select id="nama_penaja" name="nama_penaja" class="form-select form-select-solid" data-placeholder="Pilih" data-control="select2" data-hide-search="true" {{ in_array($butiranPelajar->status, [2, 3, 4, 6, 7, 8, 9]) ? 'disabled' : '' }}>
									<option value="">Pilih</option>
									@foreach ($penaja as $penaja)
									<option value="{{$penaja->id}}" {{$akademik->nama_penaja == $penaja->id ? 'selected' : ''}}>{{ $penaja->penaja}}</option>
									@endforeach
								</select>
							</div>
							<!--begin::Col-->
							<div class="col-md-6 fv-row" id="div_penaja_lain">
								<!--begin::Label-->
								<label class="d-flex align-items-center fs-6 fw-semibold form-label mb-2">(Jika Lain-lain) Sila Nyatakan:</label>
								<!--end::Label-->
								<!--begin::Input wrapper-->
								<input type="text" class="form-control form-control-solid" placeholder="" id="penaja_lain" name="penaja_lain" value="{{$akademik->penaja_lain}}"/>
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
							<h2 class="fw-bold text-dark">Dokumen</h2>
							<!--end::Title-->
							<!--begin::Notice-->
							<div class="text-muted fw-semibold fs-6">Senarai Dokumen</div>
							<!--end::Notice-->
						</div>
						<!--end::Heading-->
						@php
						
							//user migrate
							$user = DB::table('users')->where('no_kp', Auth::user()->no_kp)->first();
							
						@endphp
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
								@if (!$dokumen->isEmpty() && $dokumen->count() >= 2)
									@foreach($dokumen as $dok)
										<tr>
											<td class="text-gray-800">
												@if($dok->id_dokumen == '1')
													Salinan Penyata Bank
												@elseif($dok->id_dokumen == '2')
													Salinan Surat Tawaran Pengajian
												@endif
											</td>
											@if($dok->id_dokumen == '1' || $dok->id_dokumen == '2')
											@php
												$namaDok = ($dok->id_dokumen == '1') ? 'akaunBank' : 'suratTawaran';
											@endphp
											<td>
												<a href="/assets/dokumen/permohonan/{{ $dok->dokumen }}" target="_blank">{{ $dok->dokumen }}</a>
												<button type="button" class="btn btn-link p-0" onclick="toggleUpload('{{ $namaDok }}')">
													<i class="fa-solid fa-pen"></i>
												</button>
												<input type="file" class="form-control form-control-sm mt-2" id="upload_{{ $namaDok }}" name="upload_{{ $namaDok }}" style="display: none;">
											</td>
											<td>
												<textarea type="text" class="form-control form-control-sm" id="nota_{{ $namaDok }}" rows="1" name="nota_{{ $namaDok }}">{{ $dok->catatan }}</textarea>
											</td>
											@endif
										</tr>
									@endforeach
								@else
									<tr>
										<td class="text-gray-800">Salinan Penyata Bank&nbsp;
											<a href="/assets/contoh/penyata_bank.pdf" target="_blank" data-bs-toggle="tooltip" title="Papar contoh">
												<i class="fa-solid fa-circle-info" style="color: rgb(18, 178, 231);"></i>
											</a>
										</td>
										<td class="fv-row">
											<input type="file" class="form-control form-control-sm" id="upload_akaunBank" name="upload_akaunBank"/>
										</td>
										<td>
											<textarea type="text" class="form-control form-control-sm" id="nota_akaunBank" rows="1" name="nota_akaunBank"></textarea>
										</td>
									</tr>
									<tr>
										<td class="text-gray-800">Salinan Surat Tawaran Pengajian&nbsp;
											<a href="/assets/contoh/tawaran.pdf" target="_blank" data-bs-toggle="tooltip" title="Papar contoh">
												<i class="fa-solid fa-circle-info" style="color: rgb(18, 178, 231);"></i>
											</a>
										</td>
										<td class="fv-row">
											<input type="file" class="form-control form-control-sm" id="upload_suratTawaran" name="upload_suratTawaran"/>
										</td>
										<td>
											<textarea type="text" class="form-control form-control-sm" id="nota_suratTawaran" rows="1" name="nota_suratTawaran"></textarea>
										</td>
									</tr>
								@endif
							</tbody>
						</table>
						<!--end::Table-->
						
						<script>
							function toggleUpload(docId) {
								var uploadField = document.getElementById('upload_' + docId);
								if (uploadField.style.display === 'none') {
									uploadField.style.display = 'block';
								} else {
									uploadField.style.display = 'none';
								}
							}
						</script>
						<br>
						<br>

						<div class="pb-10 pb-lg-15">
							<!--begin::Notice-->
							<div class="text-dark fw-semibold fs-6"><i class='fas fa-exclamation-triangle' style='color:orange;'></i>&nbsp;
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
				<!--end::Step 4-->

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
					@php
						$permohonan = DB::table('permohonan')->orderBy('id', 'desc')->where('smoku_id',$smoku->smoku_id)->first();
					@endphp
							
					<!--begin::Wrapper-->
					<div>
						@if (in_array($permohonan->status, [1, 2, 5, 6, 7, 8]))
							<button type="submit" class="btn btn-lg btn-primary me-3" data-kt-stepper-action="submit" >
								<span class="indicator-label">Simpan
								<i class="ki-duotone ki-arrow-right fs-3 ms-2 me-0">
									<span class="path1"></span>
									<span class="path2"></span>
								</i></span>
								<span class="indicator-progress">Sila tunggu...
								<span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
							</button>
						
						@endif

						{{-- <button type="button" class="btn btn-lg btn-primary{{ in_array($permohonan->status, [1, 5, 9]) ? ' save-next-button' : '' }}" data-kt-stepper-action="next"> --}}
						<button type="button" class="btn btn-lg btn-primary" data-kt-stepper-action="next">
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
		<script src="/assets/js/custom/utilities/modals/view-profile.js"></script>
		{{-- <script src="/assets/js/custom/apps/file-manager/list.js"></script>
		<script src="/assets/js/custom/utilities/modals/create-app.js"></script> --}}
		<!--end::Custom Javascript-->
		<!--end::Javascript-->

		<script src = "https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
		
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

            //NEGERI ALAMAT TETAP
			$(document).ready(function(){
				$('#alamat_tetap_negeri').on('change', function() {
					var idnegeri = $(this).val();
					//alert(id);
					// Empty the dropdown
					$('#alamat_tetap_bandar').find('option').not(':first').remove();

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

											$("#alamat_tetap_bandar").append(option); 
										}
									}
							}, 
							error: function(){
							// alert('AJAX load did not work tetap bandar');
							}

					});
				});

			});

			//PARLIMEN
			$(document).ready(function() {
				function clearParlimenAndDun() {
					console.log("Clearing #parlimen and #dun options"); // Debugging

					$('#parlimen').empty().append('<option value="">Pilih</option>').select2();
					$('#dun').empty().append('<option value="">Pilih</option>').select2();
				}

				function loadParlimen() {
					var idnegeri = $('#alamat_tetap_negeri').val();
					var selectedParlimen = $('#parlimen').data('selected');
					if (!idnegeri) return; // Exit if no value is selected

					console.log("Fetching Parlimen for Negeri ID:", idnegeri); // Debugging

					// AJAX request 
					$.ajax({
						url: '/getParlimen/' + idnegeri,
						type: 'get',
						dataType: 'json',
						success: function(response) {
							console.log("Response:", response); // Debugging

							if (response.data && response.data.length > 0) {
								$.each(response.data, function(index, item) {
									var isSelected = selectedParlimen == item.id ? 'selected' : ''; // Compare with stored value
                    				var option = `<option value="${item.id}" ${isSelected}>${item.kod_parlimen} - ${item.parlimen.toUpperCase()}</option>`;
									$('#parlimen').append(option);
								});
							}

							// Refresh Select2
							$('#parlimen').select2();
						},
						error: function() {
							console.error('AJAX request failed for parlimen');
						}
					});
				}

				// Clear only when negeri changes
				$('#alamat_tetap_negeri').on('change', function() {
					clearParlimenAndDun();
					loadParlimen();
				});

				// Run function on page load if value exists
				if ($('#alamat_tetap_negeri').val()) {
					loadParlimen();
				}
			});

			//negeri takde dun
			$(document).ready(function(){
				$('#alamat_tetap_negeri').on('change', function() {
					if (['14', '15', '16', '17'].includes(this.value)) {
						$("#divdun").hide();
					} else {
						$("#divdun").show();
					}
				});
			});

			//DUN
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
							// alert('AJAX load did not work dun');
							}

					});
				});

			});

            //NEGERI WARIS
    		$(document).ready(function(){
				$('#alamat_negeri_waris').on('change', function() {
					var idnegeri = $(this).val();
					//alert(id);
					// Empty the dropdown
					$('#alamat_bandar_waris').find('option').not(':first').remove();

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

											$("#alamat_bandar_waris").append(option); 
										}
									}
							}, 
							error: function(){
							// alert('AJAX load did not work bandar waris');
							}

					});
				});

			});

			$(document).ready(function() {
			$('.basic-search').select2();
			});

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

			//CALCULATE TARIKH TAMAT
			function dateCheck(){
				let startDate = new Date($("#tarikh_mula").val());
				let endDate = new Date($("#tarikh_tamat").val());
				var studyPeriod = parseFloat(document.getElementById("tempoh_pengajian").value);

				// Get the current date
				var currentDate = new Date();

				if (!isNaN(studyPeriod)) {
					// alert(currentDate);
					// Check if the start date is not more than the current date
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


		</script>
		<script>
			$(document).ready(function() {
				var id_institusi = $('#id_institusi').val();
				var kod_peringkat = $('#peringkat').val();

				// Function to fetch peringkat options
				function fetchPeringkat(id) {
					$.ajax({
						url: '/getPeringkatPProfilPelajar/' + id,
						type: 'get',
						dataType: 'json',
						success: function(response) {
							$("#peringkat_pengajian").empty();
							
							if (response['data']) {
								var selectedValue = $('#peringkat').val();

								response['data'].forEach(function(item) {
									var option = `<option value="${item.kod_peringkat}" ${item.kod_peringkat === selectedValue ? "selected" : ""}>${item.peringkat}</option>`;
									$("#peringkat_pengajian").append(option);
								});

								// Update kod_peringkat to the newly selected value
								kod_peringkat = $('#peringkat_pengajian').val();

								// Fetch courses based on the new id_institusi and kod_peringkat
								fetchKursus(id_institusi, kod_peringkat);
							}
						},
						error: function() {
							alert('Failed to load peringkat options');
						}
					});
				}

				// Function to fetch kursus options based on id_institusi and kod_peringkat
				function fetchKursus(id_institusi, kod_peringkat) {
					$.ajax({
						url: '/getKursusProfilPelajarB/' + kod_peringkat + '/' + id_institusi,
						type: 'get',
						dataType: 'json',
						success: function(response) {
							$("#nama_kursus").empty();

							if (response['data']) {
								var selectedValue = $('#nama_kursus_asal').val();
								var found = false;

								// If selectedValue is not in the list, add it manually
								if (!found && selectedValue) {
									var fallbackOption = `<option value="${selectedValue}" selected>${selectedValue} (-)</option>`;
									$("#nama_kursus").append(fallbackOption);
								}

								response['data'].forEach(function(item) {
									var uppercaseValue = item.nama_kursus.toUpperCase();
									var isSelected = item.nama_kursus === selectedValue;

									if (isSelected) found = true;

									var option = `<option value="${item.nama_kursus}" ${isSelected ? "selected" : ""}>
										${uppercaseValue} - ${item.kod_nec} (${item.bidang.toUpperCase()}) - ${item.no_rujukan}
									</option>`;
									$("#nama_kursus").append(option);
								});

								
							}
						},
						error: function() {
							alert('Failed to load kursus options');
						}
					});
				}

				// Initial load
				fetchPeringkat(id_institusi);

				// When id_institusi changes
				$('#id_institusi').change(function() {
					id_institusi = $(this).val();
					fetchPeringkat(id_institusi);  // Reload peringkat options
				});

				// When peringkat changes
				$('#peringkat_pengajian').change(function() {
					kod_peringkat = $(this).val();
					fetchKursus(id_institusi, kod_peringkat);  // Reload kursus options based on new kod_peringkat
				});
			});

		</script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script>
    // Check if there is a flash message
    @if(session('success'))
        Swal.fire({
            icon: 'success',
            title: 'Berjaya!',
            text: ' {!! session('success') !!}',
            confirmButtonText: 'OK'
        });
    @endif

    @if(session('failed'))
        Swal.fire({
            icon: 'error',
            title: 'Tidak Berjaya!',
            text: ' {!! session('failed') !!}',
            confirmButtonText: 'OK'
        });
    @endif
</script>

		
<!--end::Javascript-->	

</x-default-layout>
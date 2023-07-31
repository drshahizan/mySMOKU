<x-default-layout> 

<div class="stepper stepper-pills stepper-column d-flex flex-column flex-xl-row flex-row-fluid gap-10" id="kt_create_account_stepper">
										<!--begin::Aside-->
										<div class="card d-flex justify-content-center justify-content-xl-start flex-row-auto w-100 w-xl-300px w-xxl-400px">
											<!--begin::Wrapper-->
											<div class="card-body px-6 px-lg-10 px-xxl-15 py-20">
												<!--begin::Nav-->
												<div class="stepper-nav">
													<!--begin::Step 1-->
													<div class="stepper-item current" data-kt-stepper-element="nav">
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
																<h3 class="stepper-title">Semakan Kelayakan MQA</h3>
																<div class="stepper-desc fw-semibold">Semak kelayakan syarat permohonan BKOKU</div>
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
																<h3 class="stepper-title">Maklumat Tuntutan</h3>
																<div class="stepper-desc fw-semibold">Yuran Tuntutan dan Elauan Wang Saku</div>
															</div>
															<!--end::Label-->
															
														</div>
														<!--end::Wrapper-->
														<div class="stepper-line h-40px"></div>
													</div>
													<!--end::Step 5-->
													<!--begin::Step 2-->
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
														
														<!--end::Line-->
													</div>
											
													<!--end::Step 5-->
												</div>
												<!--end::Nav-->
											</div>
											<!--end::Wrapper-->
										</div>
	<!--begin::Aside-->
										<!--begin::Content-->
										<div class="card d-flex flex-row-fluid flex-center">
											<!--begin::Form-->
											<form class="card-body py-20 w-100 mw-xl-700px px-9" novalidate="novalidate" id="kt_create_account_form">
												<!--begin::Step 1-->
												<div class="current" data-kt-stepper-element="content">
													<!--begin::Wrapper-->
													<div class="w-100">
														<!--begin::Heading-->
														<div class="pb-10 pb-lg-15">
															<!--begin::Title-->
															<h2 class="fw-bold d-flex align-items-center text-dark">Semakan Kelayakan MQA</h2> 
															<img alt="Logo" src="{{ image('logos/mqalogo.png') }}" class="h-150px app-sidebar-logo-default" />
															<div class="text-muted fw-semibold fs-6">Panduan Semak Pencarian
															<p>Carian boleh dilakukan melalui kata kunci/kombinasi kata kunci di bawah:</p>   
                               							 	<p>(1) Pilih Universiti</p>  
                                							<p>(2) Pilih Peringkat</p>   
                                							<p>(3) Pilih Kursus</p></div>
														</div>
														<div class="fv-row mb-10">
															
                                    					<!-- <div class="col-lg-12 col-md-12"> -->
                                      					  
														<label class="form-label required">Nama Institusi</label>
													<select name="nama_institusi" class="form-select form-select-lg form-select-solid"  data-control="select2" data-placeholder="Pilih" data-allow-clear="true" data-hide-search="true">

                                                	<option value="UMS">Universiti Malaysia Sabah</option>
                                                	<option value="UKM">Universiti Kebangsaan Malaysia</option>
                                                	<option value="UM">Universiti Malaya</option>
                                                	<option value="UPM">Universiti Putra Malaysia</option>
                                                	<option value="UTeM">Universiti Teknikal Malaysia Melaka</option>
                                                	<option value="USM">Universiti Sains Malaysia</option>
                                                	<option value="UPNM">Universiti Pertahanan Nasional Malaysia</option>
                                                	<option value="UTHM">Universiti Tun Hussein Onn Malaysia</option>
                                                	<option value="UMK">Universiti Malaysia Kelantan</option>
                                                	<option value="UUM">Univeristi Utara Malaysia</option>
                                            		</select>
                                        	
</div>
<!-- </div> -->

								<div class="fv-row mb-10">
                                    
                                        
										<label class="form-label required">Peringkat</label>
										<select name="peringkat" class="form-select form-select-lg form-select-solid"  data-control="select2" data-placeholder="Pilih" data-allow-clear="true" data-hide-search="true">
                                                <!-- <option value="">Pilih</option> -->
                                                <option value="SS">Sijil Kemahiran</option>
                                                <option value="XX">Diploma</option>
                                                <option value="SS">Sarjana Muda</option>
                                                <option value="FF">Diploma Pendidikan</option>
                                                <option value="QQQ">Sarjana</option>
                                                <option value="AAA">Ijazah Kedoktoran</option>
                                            </select>
                                      
								</div>
								<div class="fv-row mb-10">
                                    
									   <label class="form-label required">Nama Kursus</label>
															<select name="nama_kursus" class="form-select form-select-lg form-select-solid"  data-control="select2" data-placeholder="Pilih" data-allow-clear="true" data-hide-search="true">
																<option value="1">Komputer Sains</option>
																<option value="1">C Corporation</option>
																<option value="2">Sole Proprietorship</option>
																<option value="3">Non-profit</option>
																<option value="4">Limited Liability</option>
																<option value="5">General Partnership</option>
															</select>
                                    
</div>
                                   
									<div class="fv-row mb-10">
															<label class="form-label required">Adakah anda penerima HLP?</label>	
															<div class="row mb-2" data-kt-buttons="true">
																	<!--begin::Col-->
																	<div class="col">
																		<!--begin::Option-->
																		<label class="btn btn-outline btn-outline-dashed btn-active-light-primary w-100 p-4">
																			<input type="radio" class="btn-check" name="ya" value="1-1" />
																			<span class="fw-bold fs-3">Ya</span>
																		</label>
																		<!--end::Option-->
																	</div>
																	<!--end::Col-->
																	<!--begin::Col-->
																	<div class="col">
																		<!--begin::Option-->
																		<label class="btn btn-outline btn-outline-dashed btn-active-light-primary w-100 p-4 active">
																			<input type="radio" class="btn-check" name="" checked="checked" value="2-10" />
																			<span class="fw-bold fs-3">Tidak</span>
																		</label>
																		<!--end::Option-->
																	</div>
															</div>
															
														</div>
												
</div>
</div>

												<!--end::Step 1-->
												<!--begin::Step 2-->
												<div data-kt-stepper-element="content">
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
														<!--begin::Input group-->
														<div class="mb-10 fv-row">
															<!--begin::Label-->
															<label class="form-label mb-3">Nama</label>
															<!--end::Label-->
															<!--begin::Input-->
															<input type="text" class="form-control form-control-lg form-control-solid" name="nama_pelajar" placeholder="" value="" />
															<!--end::Input-->
														</div>
														<!--end::Input group-->
														<!--begin::Input group-->
														<div class="row mb-10">
															<!--begin::Col-->
															<div class="col-md-4 fv-row">
																<!--begin::Label-->
																<label class="required fs-6 fw-semibold form-label mb-2">No. Kad Pengenalan</label>
																<!--end::Label-->
																<!--begin::Row-->
																<div class="row fv-row">
																	<!--begin::Col-->
																	<div class="col-12">
																		<input type="text" class="form-control form-control-lg form-control-solid" minlength="12" name="nokp" placeholder="" value="" />
																	</div>
																	<!--end::Col-->
																</div>
																<!--end::Row-->
															</div>
															<div class="col-md-3 fv-row">
																<!--begin::Label-->
																<label class="required fs-6 fw-semibold form-label mb-2">Tarikh Lahir</label>
																<!--end::Label-->
																<!--begin::Row-->
																<div class="row fv-row">
																	<!--begin::Col-->
																	<div class="col-12">
																		<!--begin::Input-->
																	<input data-provide="datepicker" data-date-autoclose="true" class="form-control form-control-solid" placeholder="" name="tkh_lahir">
																	<!--end::Input-->
																	</div>
																</div>	
																</div>
																<div class="col-md-2 fv-row">
																<label class="required fs-6 fw-semibold form-label mb-2">Umur</label>
																<!--end::Label-->
																<div class="row fv-row">
																<!--begin::Input wrapper-->
																<div class="col-12">
																	<!--begin::Input-->
																	<input type="text" class="form-control form-control-solid" name="umur" placeholder="" value="" />
																	<!--end::Input-->
																</div>
																<!--end::Input wrapper-->
															</div>
																
																</div>	
																<div class="col-md-3 fv-row">
																<!--begin::Label-->
																<label class="required fs-6 fw-semibold form-label mb-2">Jantina</label>
																<!--end::Label-->
																<!--begin::Input wrapper-->
																<div class="col-12">
																	<!--begin::Input-->
																	<input type="text" class="form-control form-control-solid" name="jantina" placeholder="" value="" />
																	<!--end::Input-->
																</div>
																<!--end::Input wrapper-->
															</div>
															<!--end::Col-->
															<!--begin::Col-->
															
															<!--end::Col-->
														</div>
														<!--begin::Input group-->
														<div class="row mb-10">
															<div class="col-md-4 fv-row">
																<!--begin::Label-->
																<label class="required fs-6 fw-semibold form-label mb-2">No. JKM
																</label>
																<!--end::Label-->
																<!--begin::Input wrapper-->
																<div class="col-12">
																	<!--begin::Input-->
																	<input type="text" class="form-control form-control-solid" name="noJKM" placeholder="" value="" />
																	<!--end::Input-->
																</div>
																<!--end::Input wrapper-->
															</div>
															<div class="col-md-4 fv-row">
																<!--begin::Label-->
																<label class="required fs-6 fw-semibold form-label mb-2">Kecacatan
																</label>
																<!--end::Label-->
																<!--begin::Input wrapper-->
																<div class="col-12">
																	<!--begin::Input-->
																	<input type="text" class="form-control form-control-solid" name="kecacatan" placeholder="" value="" />
																	<!--end::Input-->
																</div>
																<!--end::Input wrapper-->
															</div>
															<div class="col-md-4 fv-row">
																<!--begin::Label-->
																<label class="required fs-6 fw-semibold form-label mb-2">Bangsa
																</label>
																<!--end::Label-->
																<!--begin::Input wrapper-->
																<div class="col-12">
																	<!--begin::Input-->
																	<input type="text" class="form-control form-control-solid" name="bangsa" placeholder="" value="" />
																	<!--end::Input-->
																</div>
																<!--end::Input wrapper-->
															</div>
														</div>
														<!--end::Input group-->
														<!--begin::Input group-->
														<div class="fv-row mb-10">
															<!--end::Label-->
															<label class="form-label">Alamat Rumah</label>
															<!--end::Label-->
															<!--begin::Input-->
															<textarea name="alamat" class="form-control form-control-lg form-control-solid" rows="2"></textarea>
															<!--end::Input-->
														</div>
														<div class="row mb-10">
															<div class="col-md-4 fv-row">
																<!--begin::Label-->
																<label class="required fs-6 fw-semibold form-label mb-2">Poskod
																</label>
																<!--end::Label-->
																<!--begin::Input wrapper-->
																<div class="col-12">
																	<!--begin::Input-->
																	<input type="text" class="form-control form-control-solid" name="poskod" placeholder="" value="" />
																	<!--end::Input-->
																</div>
																<!--end::Input wrapper-->
															</div>
															<div class="col-md-4 fv-row">
																<!--begin::Label-->
																<label class="required fs-6 fw-semibold form-label mb-2">Bandar
																</label>
																<!--end::Label-->
																<!--begin::Input wrapper-->
																<div class="col-12">
																	<!--begin::Input-->
																	<input type="text" class="form-control form-control-solid" name="bandar" placeholder="" value="" />
																	<!--end::Input-->
																</div>
																<!--end::Input wrapper-->
															</div>
															<div class="col-md-4 fv-row">
																<!--begin::Label-->
																<label class="required fs-6 fw-semibold form-label mb-2">Negeri
																</label>
																<!--end::Label-->
																<!--begin::Input wrapper-->
																<div class="col-12">
																	<!--begin::Input-->
																	<input type="text" class="form-control form-control-solid" name="negeri" placeholder="" value="" />
																	<!--end::Input-->
																</div>
																<!--end::Input wrapper-->
															</div>
														</div>
														<!--end::Input group-->
														<div class="row mb-10">
															<div class="col-md-6 fv-row">
																<!--begin::Label-->
																<label class="required fs-6 fw-semibold form-label mb-2">No. Tel(HP)
																</label>
																<!--end::Label-->
																<!--begin::Input wrapper-->
																<div class="col-12">
																	<!--begin::Input-->
																	<input type="text" class="form-control form-control-solid" name="no_tel" placeholder="" value="" />
																	<!--end::Input-->
																</div>
																<!--end::Input wrapper-->
															</div>
															<div class="col-md-6 fv-row">
																<!--begin::Label-->
																<label class="required fs-6 fw-semibold form-label mb-2">No. Tel Rumah
																</label>
																<!--end::Label-->
																<!--begin::Input wrapper-->
																<div class="col-12">
																	<!--begin::Input-->
																	<input type="text" class="form-control form-control-solid" name="no_telR" placeholder="" value="" />
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
																<label class="required fs-6 fw-semibold form-label mb-2">Alamat emel
																</label>
																<!--end::Label-->
																<!--begin::Input wrapper-->
																<div class="col-12">
																	<!--begin::Input-->
																	<input type="text" class="form-control form-control-solid" name="emel" placeholder="" value="" />
																	<!--end::Input-->
																</div>
																<!--end::Input wrapper-->
															</div>
															<div class="col-md-6 fv-row">
																<!--begin::Label-->
																<label class="required fs-6 fw-semibold form-label mb-2">No. Akaun Bank
																</label>
																<!--end::Label-->
																<!--begin::Input wrapper-->
																<div class="col-12">
																	<!--begin::Input-->
																	<input type="text" class="form-control form-control-solid" name="no_akaun_bank" placeholder="" value="" />
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
															<input type="text" class="form-control form-control-lg form-control-solid" name="nama_waris" placeholder="" value="" />
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
																		<input type="text" class="form-control form-control-lg form-control-solid" name="nokp" placeholder="" value="" />
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
																		<input type="text" class="form-control form-control-lg form-control-solid" name="noPasport" placeholder="" value="" />
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
															<select name="hubungan" class="form-select form-select-lg form-select-solid hubungan_waris" data-control="select2" data-placeholder="Pilih" data-allow-clear="true" data-hide-search="true">
																<option></option>
																<option value="Ibu">Ibu</option>
																<option value="Bapa">Bapa</option>
																<option value="Suami/Isteri">Suami/Isteri</option>
																<option value="Penjaga">Penjaga</option>
																<option value="Saudara Kandung">Saudara Kandung</option>
																<option value="lain-lain">Lain-lain</option>
															</select>
														</div>
															<div class="col-md-6 fv-row nama_waris1">
															<!--begin::Label-->
															<label class="form-label mb-6">Lain-lain:</label>
															<!--end::Label-->
															<!--begin::Input-->
															<input type="text" class="form-control form-control-lg form-control-solid nama_waris_input" name="nama_waris1" placeholder="" value="" />
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
															<textarea name="alamatW" class="form-control form-control-lg form-control-solid" rows="2"></textarea>
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
																	<input type="text" class="form-control form-control-solid" name="poskodW" placeholder="" value="" />
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
																	<input type="text" class="form-control form-control-solid" name="bandarW" placeholder="" value="" />
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
																	<input type="text" class="form-control form-control-solid" name="negeriW" placeholder="" value="" />
																	<!--end::Input-->
																</div>
																<!--end::Input wrapper-->
															</div>
														</div>
														<!--end::Input group-->
														<div class="row mb-10">
															<div class="col-md-4 fv-row">
																<!--begin::Label-->
																<label class="fs-6 fw-semibold form-label mb-2">No. Tel(HP)
																</label>
																<!--end::Label-->
																<!--begin::Input wrapper-->
																<div class="col-12">
																	<!--begin::Input-->
																	<input type="text" class="form-control form-control-solid" name="no_telW" placeholder="" value="" />
																	<!--end::Input-->
																</div>
																<!--end::Input wrapper-->
															</div>
															<div class="col-md-4 fv-row">
																<!--begin::Label-->
																<label class="fs-6 fw-semibold form-label mb-2">No. Tel Rumah
																</label>
																<!--end::Label-->
																<!--begin::Input wrapper-->
																<div class="col-12">
																	<!--begin::Input-->
																	<input type="text" class="form-control form-control-solid" name="no_telRW" placeholder="" value="" />
																	<!--end::Input-->
																</div>
																<!--end::Input wrapper-->
															</div>
															<div class="col-md-4 fv-row">
																<!--begin::Label-->
																<label class="fs-6 fw-semibold form-label mb-2">Pendapatan
																</label>
																<!--end::Label-->
																<!--begin::Input wrapper-->
																<div class="col-12">
																	<!--begin::Input-->
																	<input type="text" class="form-control form-control-solid" name="pendapatan" placeholder="" value="" />
																	<!--end::Input-->
																</div>
																<!--end::Input wrapper-->
															</div>
														</div>
					
										
													<!--end::Input group-->
													</div>
													<!--end::Wrapper-->
												</div>
												<!--end::Step 3-->
												<!--begin::Step 4-->
												<div data-kt-stepper-element="content">
													<!--begin::Wrapper-->
													<div class="w-100">
														<!--begin::Heading-->
														<div class="pb-10 pb-lg-15">
															<!--begin::Title-->
															<h2 class="fw-bold text-dark">Billing Details</h2>
															<!--end::Title-->
															<!--begin::Notice-->
															<div class="text-muted fw-semibold fs-6">If you need more info, please check out
															<a href="#" class="text-primary fw-bold">Help Page</a>.</div>
															<!--end::Notice-->
														</div>
														<!--end::Heading-->
														<!--begin::Input group-->
														<div class="d-flex flex-column mb-7 fv-row">
															<!--begin::Label-->
															<label class="d-flex align-items-center fs-6 fw-semibold form-label mb-2">
																<span class="required">Name On Card</span>
																<span class="ms-1" data-bs-toggle="tooltip" title="Specify a card holder's name">
																	<i class="ki-duotone ki-information-5 text-gray-500 fs-6">
																		<span class="path1"></span>
																		<span class="path2"></span>
																		<span class="path3"></span>
																	</i>
																</span>
															</label>
															<!--end::Label-->
															<input type="text" class="form-control form-control-solid" placeholder="" name="card_name" value="Max Doe" />
														</div>
														<!--end::Input group-->
														<!--begin::Input group-->
														<div class="d-flex flex-column mb-7 fv-row">
															<!--begin::Label-->
															<label class="required fs-6 fw-semibold form-label mb-2">Card Number</label>
															<!--end::Label-->
															<!--begin::Input wrapper-->
															<div class="position-relative">
																<!--begin::Input-->
																<input type="text" class="form-control form-control-solid" placeholder="Enter card number" name="card_number" value="4111 1111 1111 1111" />
																<!--end::Input-->
																<!--begin::Card logos-->
																<div class="position-absolute translate-middle-y top-50 end-0 me-5">
																	<img src="assets/media/svg/card-logos/visa.svg" alt="" class="h-25px" />
																	<img src="assets/media/svg/card-logos/mastercard.svg" alt="" class="h-25px" />
																	<img src="assets/media/svg/card-logos/american-express.svg" alt="" class="h-25px" />
																</div>
																<!--end::Card logos-->
															</div>
															<!--end::Input wrapper-->
														</div>
														<!--end::Input group-->
														<!--begin::Input group-->
														<div class="row mb-10">
															<!--begin::Col-->
															<div class="col-md-8 fv-row">
																<!--begin::Label-->
																<label class="required fs-6 fw-semibold form-label mb-2">Expiration Date</label>
																<!--end::Label-->
																<!--begin::Row-->
																<div class="row fv-row">
																	<!--begin::Col-->
																	<div class="col-6">
																		<select name="card_expiry_month" class="form-select form-select-solid" data-control="select2" data-hide-search="true" data-placeholder="Month">
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
																	</div>
																	<!--end::Col-->
																	<!--begin::Col-->
																	<div class="col-6">
																		<select name="card_expiry_year" class="form-select form-select-solid" data-control="select2" data-hide-search="true" data-placeholder="Year">
																			<option></option>
																			<option value="2023">2023</option>
																			<option value="2024">2024</option>
																			<option value="2025">2025</option>
																			<option value="2026">2026</option>
																			<option value="2027">2027</option>
																			<option value="2028">2028</option>
																			<option value="2029">2029</option>
																			<option value="2030">2030</option>
																			<option value="2031">2031</option>
																			<option value="2032">2032</option>
																			<option value="2033">2033</option>
																		</select>
																	</div>
																	<!--end::Col-->
																</div>
																<!--end::Row-->
															</div>
															<!--end::Col-->
															<!--begin::Col-->
															<div class="col-md-4 fv-row">
																<!--begin::Label-->
																<label class="d-flex align-items-center fs-6 fw-semibold form-label mb-2">
																	<span class="required">CVV</span>
																	<span class="ms-1" data-bs-toggle="tooltip" title="Enter a card CVV code">
																		<i class="ki-duotone ki-information-5 text-gray-500 fs-6">
																			<span class="path1"></span>
																			<span class="path2"></span>
																			<span class="path3"></span>
																		</i>
																	</span>
																</label>
																<!--end::Label-->
																<!--begin::Input wrapper-->
																<div class="position-relative">
																	<!--begin::Input-->
																	<input type="text" class="form-control form-control-solid" minlength="3" maxlength="4" placeholder="CVV" name="card_cvv" />
																	<!--end::Input-->
																	<!--begin::CVV icon-->
																	<div class="position-absolute translate-middle-y top-50 end-0 me-3">
																		<i class="ki-duotone ki-credit-cart fs-2hx">
																			<span class="path1"></span>
																			<span class="path2"></span>
																		</i>
																	</div>
																	<!--end::CVV icon-->
																</div>
																<!--end::Input wrapper-->
															</div>
															<!--end::Col-->
														</div>
														<!--end::Input group-->
														<!--begin::Input group-->
														<div class="d-flex flex-stack">
															<!--begin::Label-->
															<div class="me-5">
																<label class="fs-6 fw-semibold form-label">Save Card for further billing?</label>
																<div class="fs-7 fw-semibold text-muted">If you need more info, please check budget planning</div>
															</div>
															<!--end::Label-->
															<!--begin::Switch-->
															<label class="form-check form-switch form-check-custom form-check-solid">
																<input class="form-check-input" type="checkbox" value="1" checked="checked" />
																<span class="form-check-label fw-semibold text-muted">Save Card</span>
															</label>
															<!--end::Switch-->
														</div>
														<!--end::Input group-->
													</div>
													<!--end::Wrapper-->
												</div>
												<!--end::Step 4-->
												<!--begin::Step 5-->
												<div data-kt-stepper-element="content">
													<!--begin::Wrapper-->
													<div class="w-100">
														<!--begin::Heading-->
														<div class="pb-8 pb-lg-10">
															<!--begin::Title-->
															<h2 class="fw-bold text-dark">Your Are Done!</h2>
															<!--end::Title-->
															<!--begin::Notice-->
															<div class="text-muted fw-semibold fs-6">If you need more info, please
															<a href="../../demo1/dist/authentication/layouts/corporate/sign-in.html" class="link-primary fw-bold">Sign In</a>.</div>
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
																		<a href="../../demo1/dist/utilities/wizards/vertical.html" class="fw-bold">Create Team Platform</a></div>
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
												<!--end::Step 5-->
												<!--begin::Actions-->
												<div class="d-flex flex-stack pt-10">
													<!--begin::Wrapper-->
													<div class="mr-2">
														<button type="button" class="btn btn-lg btn-light-primary me-3" data-kt-stepper-action="previous">
														<i class="ki-duotone ki-arrow-left fs-4 me-1">
															<span class="path1"></span>
															<span class="path2"></span>
														</i>Back</button>
													</div>
													<!--end::Wrapper-->
													<!--begin::Wrapper-->
													<div>
														<button type="button" class="btn btn-lg btn-primary me-3" data-kt-stepper-action="submit">
															<span class="indicator-label">Submit
															<i class="ki-duotone ki-arrow-right fs-3 ms-2 me-0">
																<span class="path1"></span>
																<span class="path2"></span>
															</i></span>
															<span class="indicator-progress">Please wait...
															<span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
														</button>
														<button type="button" class="btn btn-lg btn-primary" data-kt-stepper-action="next">Teruskan
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


<!--begin::Javascript-->

		<!--begin::Global Javascript Bundle(mandatory for all pages)-->
		<script src="assets/js/scripts.bundle.js"></script>
		<!--end::Global Javascript Bundle-->

		<!--begin::Custom Javascript(used for this page only)-->
		<script src="assets/js/custom/utilities/modals/create-account.js"></script>

		<!--end::Custom Javascript-->
		<!--end::Javascript-->



</x-default-layout>
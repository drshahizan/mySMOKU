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
			<form id="kt_create_account_form" action="{{ route('ppk.hantar') }}" method="post" class="card-body py-20 w-100 mw-xl-700px px-9" enctype="multipart/form-data">
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
							<div class="col-md-4 fv-row">
								<!--begin::Label-->
								<label class=" fs-6 fw-semibold form-label mb-2">No. Kad Pengenalan</label>
								<!--end::Label-->
								<!--begin::Row-->
								<div class="row fv-row">
									<!--begin::Col-->
									<div class="col-12">
										<input type="text" class="form-control form-control-lg form-control-solid" maxlength="12" id="no_kp" name="no_kp" placeholder="" value="{{$smoku->no_kp}}" readonly/>
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
										<input type="date" data-date-autoclose="true" class="form-control form-control-solid" placeholder="" id="tkh_lahir" name="tkh_lahir" value="{{$smoku->tarikh_lahir}}" readonly/>
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
										<select id="negeri_lahir" name="negeri_lahir" class="form-select form-select-lg form-select-solid js-example-basic-single"  data-control="select2" data-hide-search="true" data-placeholder="Pilih">
											<option></option>
											@foreach ($negeri as $negerilahir)	
											<option value="{{ $negerilahir->id}}">{{ $negerilahir->negeri}}</option> 
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
										@php
											// Extract birthdate from IC number (Assuming YYMMDD format)
											$birthYear = substr($smoku->no_kp, 0, 2);
											$birthMonth = substr($smoku->no_kp, 2, 2);
											$birthDay = substr($smoku->no_kp, 4, 2);

											// Assume a default birth century (e.g., 1900 for years 00-99)
											$birthYear = ($birthYear >= 0 && $birthYear <= 21) ? 2000 + $birthYear : 1900 + $birthYear;

											// Get the current date
											$currentYear = date('Y');
											$currentMonth = date('m');
											$currentDay = date('d');

											// Calculate age
											// $age = $currentYear - $birthYear - (($currentMonth < $birthMonth || ($currentMonth == $birthMonth && $currentDay < $birthDay)) ? 1 : 0); // YANG NI KIRA BULAN SEKALI
											$age = $currentYear - $birthYear;
										
										@endphp
										<!--begin::Input-->
										<input type="text" class="form-control form-control-solid" id="umur" name="umur" placeholder="" value="{{$age}}" readonly/>
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
										<option value="{{ $smoku->kod_jantina }}">{{ $smoku->jantina }}</option>
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
										<option></option>
										@foreach ($keturunan as $keturunan)
											<option value="{{$keturunan->kod_keturunan}}" {{$smoku->kod_keturunan == $keturunan->id ? 'selected' : ''}}>{{ $keturunan->keturunan}}</option>
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
									<select id="agama" name="agama" class="form-select form-select-lg form-select-solid" data-control="select2" data-hide-search="true" data-placeholder="Pilih">
										<option></option>
										@foreach ($agama as $agama)	
										<option value="{{ $agama->id}}">{{ $agama->agama}}</option> 
										@endforeach
									</select>
									<!--end::Input-->
								</div>
								<!--end::Input wrapper-->
							</div>
						</div>
						<!--end::Input group-->
						@php
						
							if (preg_match('/\b(\d{5})\b/', $smoku->alamat_tetap, $matches)) {
								$postcode = $matches[1];
							} else {
								$postcode = '';
							}

							

							// Split the address by the postcode
							$addressParts = explode($postcode, $smoku->alamat_tetap, 2);
							// dd($addressParts);

							// Check if the second part (after the postcode) exists
							if (isset($addressParts[1])) {

							// Extract state from the second part
							$statePart = trim($addressParts[1]);

							// Initialize variables
							$selectedState = '';
							$selectedCity = '';

							// Search for the state in your $negeri collection
							foreach ($negeri as $state) {
								$stateName = $state->negeri;
								$stateID = $state->id;

								// Check if the state name is present in the address
								if (stripos($statePart, $stateName) !== false) {
									$selectedState = $stateName;
									break; // Stop the loop once a match is found
								}
							}

							// Trim any leading or trailing spaces in $statePart
							$statePart = trim($statePart);

							// Search for the city in your $bandar collection
							$bandar_city = DB::table('bk_bandar')->where("negeri_id", $stateID)->orderBy("id", "asc")->select('id', 'bandar')->get();

							foreach ($bandar_city as $city) {
								$cityName = $city->bandar;

								// Check if the city name is present in the extracted part of the address
								if (stripos($statePart, $cityName) !== false) {
									$selectedCity = $cityName;
									break; // Stop the loop once a match is found
								}
							}
							} else {
							$selectedState = '';
							$selectedCity = '';
							}


							// Remove state and city from the address
							$trimmedAddress = str_replace([$selectedCity, $selectedState, $postcode], '', $smoku->alamat_tetap);

							// Remove "W.P." and extra spaces
							$trimmedAddress = trim(str_replace(['W.P.', 'WILAYAH PERSEKUTUAN'], '', $trimmedAddress));

							//parlimen dengan dun
							$parlimen = DB::table('bk_parlimen')->where('negeri_id', $stateID)
										->orderby("id","asc")->get();

						@endphp
						<!--begin::Input group-->
						<div class="fv-row mb-10">
							<!--end::Label-->
							<label class="form-label">Alamat Tetap</label>
							<!--end::Label-->
							<!--begin::Input-->
							<textarea id="alamat_tetap" name="alamat_tetap" class="form-control form-control-lg form-control-solid" rows="2" style="text-transform: uppercase;">{{$trimmedAddress}}</textarea>
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
									<select id="alamat_tetap_negeri" name="alamat_tetap_negeri" class="form-select form-select-lg form-select-solid js-example-basic-single"  data-control="select2" data-hide-search="true" data-placeholder="Pilih">
										<option></option>
										@foreach ($negeri as $negeritetap)	
										<option value="{{$negeritetap->id}}" {{$negeritetap->negeri == $selectedState ? 'selected' : ''}}>{{ $negeritetap->negeri}}</option>
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
									<select id='alamat_tetap_bandar' name='alamat_tetap_bandar' class="form-select form-select-lg form-select-solid js-example-basic-single"  data-control="select2" data-hide-search="true" data-placeholder="Pilih">
										<option></option>
										@foreach ($bandar as $bandartetap)	
										<option value="{{$bandartetap->id}}" {{$bandartetap->bandar == $selectedCity ? 'selected' : ''}}>{{ $bandartetap->bandar}}</option>
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
									<input type="text" maxlength="5" class="form-control form-control-solid" id="alamat_tetap_poskod" name="alamat_tetap_poskod" placeholder="" value="{{$postcode}}"/>
									<!--end::Input-->
								</div>
								<!--end::Input wrapper-->
							</div>
						</div>
						<div class="row mb-10">
							<div class="col-md-7 fv-row">
								<!--begin::Label-->
								<label class=" fs-6 fw-semibold form-label mb-2">Parlimen</label>
								<!--end::Label-->
								<!--begin::Input wrapper-->
								<div class="col-12">
									<!--begin::Input-->
									<select id='parlimen' name='parlimen' class="form-select form-select-lg form-select-solid js-example-basic-single"  data-control="select2" data-hide-search="true" data-placeholder="Pilih">
										<option></option>
										@foreach ($parlimen as $parlimen)	
										<option value="{{$parlimen->id}}">{{ $parlimen->kod_parlimen}} - {{ strtoupper($parlimen->parlimen)}}</option>
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
									<select id="dun" name="dun" class="form-select form-select-lg form-select-solid js-example-basic-single"  data-control="select2" data-hide-search="true" data-placeholder="Pilih">
										<option></option>
										@foreach ($dun as $dun)	
										<option value="{{$dun->id}}">{{ $dun->kod_dun}} - {{ strtoupper($dun->dun)}}</option>
										@endforeach
									</select>
									<!--end::Input-->
								</div>
								<!--end::Input wrapper-->
							</div>
						</div>
						<!--end::Input group-->
						@php
						if (!empty($smoku->alamat_surat_menyurat)) {
						
							if (preg_match('/\b(\d{5})\b/', $smoku->alamat_surat_menyurat, $matches)) {
								$postcode_surat = $matches[1];
							} else {
								$postcode_surat = '';
							}

							

							// Split the address by the postcode
							if (!empty($postcode_surat)) {
								$addressParts_surat = explode($postcode_surat, $smoku->alamat_surat_menyurat, 2);
							}

							// Check if the second part (after the postcode) exists
							if (isset($addressParts_surat[1])) {
								$selectedState_surat = '';
								$selectedCity_surat = '';

								foreach ($negeri as $state_surat) {
									$stateName_surat = $state_surat->negeri;
									$stateID_surat = $state_surat->id;

									// Check if the state name is present in the address
									if (stripos($smoku->alamat_surat_menyurat, $stateName_surat) !== false) {
										$selectedState_surat = $stateName_surat;
										break; // Stop the loop once a match is found
									}
								}
								// Trim any leading or trailing spaces and set $selectedCity
								$selectedCity_surat = trim($addressParts_surat[1]);

								// Search for the city in your $bandar collection
								$bandar_city_surat = DB::table('bk_bandar')->where("negeri_id", $stateID_surat)->orderBy("id", "asc")->select('id', 'bandar')->get();

								foreach ($bandar_city_surat as $city_surat) {
									$cityName_surat = $city_surat->bandar;

									// Check if the city name is present in the extracted part of the address
									if (stripos($selectedCity_surat, $cityName_surat) !== false) {
										$selectedCity_surat = $cityName_surat;
										break; // Stop the loop once a match is found
									}
								}
							} else {
								$selectedState_surat = '';
								$selectedCity_surat = '';
							}


							// Remove state and city from the address
							$trimmedAddress_surat = str_replace([$selectedCity_surat, $selectedState_surat, $postcode_surat], '', $smoku->alamat_surat_menyurat);

							// Remove "W.P." and extra spaces
							$trimmedAddress_surat = trim(str_replace(['W.P.', 'WILAYAH PERSEKUTUAN'], '', $trimmedAddress_surat));
						} else {
							// Handle the case where the address is empty
							$postcode_surat = '';
							$selectedState_surat = '';
							$selectedCity_surat = '';
							$trimmedAddress_surat = '';
						}	
						@endphp
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
											<input class="form-check-input" id="sama" name="sama" onclick="myFunction()" type="checkbox" value="1" />
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
								<textarea id="alamat_surat_menyurat" name="alamat_surat_menyurat" class="form-control form-control-lg form-control-solid" rows="2" style="text-transform: uppercase;">{{$trimmedAddress_surat}}</textarea>
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
										<select id="alamat_surat_negeri" name="alamat_surat_negeri" class="form-select form-select-lg form-select-solid js-example-basic-single"  data-control="select2" data-hide-search="true" data-placeholder="Pilih">
											<option></option>
											@foreach ($negeri as $negerisurat)	
											<option value="{{$negerisurat->id}}" {{$negerisurat->negeri == $selectedState_surat ? 'selected' : ''}}>{{ $negerisurat->negeri}}</option>
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
										<select id='alamat_surat_bandar' name='alamat_surat_bandar' class="form-select form-select-lg form-select-solid js-example-basic-single"  data-control="select2" data-hide-search="true" data-placeholder="Pilih">
											<option></option>
											@foreach ($bandar as $bandar)	
											<option value="{{$bandar->id}}" {{$bandar->bandar == $selectedCity_surat ? 'selected' : ''}}>{{ $bandar->bandar}}</option>
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
										<input type="text" maxlength="5" class="form-control form-control-solid" id="alamat_surat_poskod" name="alamat_surat_poskod" placeholder="" value="{{$postcode_surat}}" />
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
									<input type="text" class="form-control form-control-solid" id="emel" name="emel" placeholder="" value="{{$smoku->email}}"/>
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
									<input type="text" class="form-control form-control-solid" id="tel_bimbit" name="tel_bimbit" placeholder="" value="{{$smoku->tel_bimbit}}" />
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
									<input type="text" class="form-control form-control-solid" id="tel_rumah" name="tel_rumah" placeholder="" value="{{$smoku->tel_rumah}}" />
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
									<select id="status_pekerjaan" name="status_pekerjaan" class="form-select form-select-solid" data-control="select2" data-hide-search="true" data-placeholder="Pilih" required>
										<option></option>
										<option value="TIDAK BEKERJA" {{$smoku->status_pekerjaan == "TIDAK BEKERJA" ? 'selected' : ''}}>TIDAK BEKERJA</option>
										<option value="BEKERJA" {{$smoku->status_pekerjaan == "BEKERJA" ? 'selected' : ''}}>BEKERJA</option>
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
									<input type="text" class="form-control form-control-solid" id="pekerjaan" name="pekerjaan" placeholder="" value="{{$smoku->pekerjaan}}" style="text-transform: uppercase;"/>
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
									<input type="number" class="form-control form-control-solid" id="pendapatan" name="pendapatan" placeholder="" value="{{$smoku->pendapatan}}" />
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
										<input type="text" class="form-control form-control-solid" id="no_daftar_oku" name="no_daftar_oku" placeholder="" value="{{$smoku->no_daftar_oku}}"  readonly/>
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
										<input type="text" class="form-control form-control-solid" placeholder="" value="{{$smoku->kecacatan}}" readonly/>
										<input type="hidden" class="form-control form-control-solid" id="kecacatan" name="kecacatan" placeholder="" value="{{$smoku->kod_oku}}" readonly/>
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
									<input type="text" class="form-control form-control-solid" maxlength="14" id="no_akaun_bank" name="no_akaun_bank" placeholder="" value=""/>
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
				<div  data-kt-stepper-element="content">
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
										<input type="text" class="form-control form-control-lg form-control-solid" maxlength="12" id="no_kp_waris" name="no_kp_waris" placeholder="" value=""  />
									</div>
									<!--end::Col-->
								</div>
								<!--end::Row-->
							</div>
							<div class="col-md-6 fv-row">
								<!--begin::Label-->
								<label class=" fs-6 fw-semibold form-label mb-2">No. Pasport (Jika Ada)</label>
								<!--end::Label-->
								<!--begin::Row-->
								<div class="row fv-row">
									<!--begin::Col-->
									<div class="col-12">
										<input type="text" class="form-control form-control-lg form-control-solid" id="no_pasport_waris" name="no_pasport_waris" placeholder="" value="" />
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
								<select id="hubungan_waris" name="hubungan_waris" class="form-select form-select-lg form-select-solid hubungan_waris" data-control="select2" data-placeholder="Pilih">
									<option></option>
									@foreach ($hubungan as $hubungan)
									<option value="{{$hubungan->kod_hubungan}}" {{$smoku->hubungan_waris == $hubungan->kod_hubungan ? 'selected' : ''}}>{{ $hubungan->hubungan}}</option>
									@endforeach
								</select>
							</div>
							<div class="col-md-6 fv-row">
								<!--begin::Label-->
								<label class="form-label mb-6">No. Tel Bimbit</label>
								<!--end::Label-->
								<!--begin::Input-->
								<input type="text" class="form-control form-control-solid" id="tel_bimbit_waris" name="tel_bimbit_waris" placeholder="" value="{{$smoku->tel_bimbit_waris}}"  />
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
								<input type="text" class="form-control form-control-lg form-control-solid" id="hubungan_lain_waris" name="hubungan_lain_waris" placeholder="" value="" />
								<!--end::Input-->													
							</div>
							
						</div>
						<!--begin::Input group-->
						<div class="fv-row mb-10">
							<!--end::Label-->
							<label class="form-label">Alamat Tetap</label>
							<!--end::Label-->
							<!--begin::Input-->
							<textarea id="alamat_waris" name="alamat_waris" class="form-control form-control-lg form-control-solid" rows="2" style="text-transform: uppercase;"></textarea>
							<!--end::Input-->
						</div>
						<div class="row mb-10">
							<div class="col-md-5 fv-row">
								<!--begin::Label-->
								<label class="fs-6 fw-semibold form-label mb-2">Negeri
								</label>
								<!--end::Label-->
								<!--begin::Input wrapper-->
								<div class="col-12">
									<!--begin::Input-->
									<select id="alamat_negeri_waris" name="alamat_negeri_waris" class="form-select form-select-lg form-select-solid js-example-basic-single"  data-control="select2" data-hide-search="true" data-placeholder="Pilih">
										<option></option>
										@foreach ($negeri as $negeri)	
										<option value="{{ $negeri->id}}">{{ $negeri->negeri}}</option> 
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
									<select id='alamat_bandar_waris' name='alamat_bandar_waris' class="form-select form-select-lg form-select-solid js-example-basic-single"  data-control="select2" data-hide-search="true" data-placeholder="Pilih">
										<option></option>
									</select>
									<!--end::Input-->
								</div>
								<!--end::Input wrapper-->
							</div>
							<div class="col-md-3 fv-row">
								<!--begin::Label-->
								<label class="fs-6 fw-semibold form-label mb-2">Poskod</label>
								<!--end::Label-->
								<!--begin::Input wrapper-->
								<div class="col-12">
									<!--begin::Input-->
									<input type="text" maxlength="5" class="form-control form-control-solid" id="alamat_poskod_waris" name="alamat_poskod_waris" placeholder="" value="" />
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
									<input type="text" class="form-control form-control-solid" id="pekerjaan_waris" name="pekerjaan_waris" placeholder="" value="{{$smoku->pekerjaan_waris}}" style="text-transform: uppercase;" />
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
									<input type="number" class="form-control form-control-solid" id="pendapatan_waris" name="pendapatan_waris" placeholder="RM" value=""  />
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
				@endforeach

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
							<!--begin::Col-->
							<div class="col-md-7 fv-row">
								<!--begin::Label-->
								<label class="d-flex align-items-center fs-6 fw-semibold form-label mb-2">
									<span class="">Nama Pusat Pengajian</span>
								</label>
								<!--end::Label-->
								<select id="id_institusi" name="id_institusi" class="form-select form-select-solid" data-control="select2" data-hide-search="true" data-placeholder="Pilih">
									@foreach ($infoipt as $infoipt)
										<option value="{{ $infoipt->id_institusi}}">{{ strtoupper($infoipt->nama_institusi)}}</option>
									@endforeach
								</select>
							</div>
							<!--end::Col-->
							<!--begin::Col-->
							<div class="col-md-5 fv-row">
								<!--begin::Label-->
								<label class=" fs-6 fw-semibold form-label mb-2">Peringkat Pengajian</label>
								<!--end::Label-->
								<!--begin::Row-->
								<div class="row fv-row">
									<!--begin::Input wrapper-->
									<select id="peringkat_pengajian" name="peringkat_pengajian" class="form-select form-select-solid" data-control="select2" data-hide-search="true" data-placeholder="Pilih">
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
							<select id="nama_kursus" name="nama_kursus" class="form-select form-select-solid" data-control="select2" data-hide-search="true" data-placeholder="Pilih">
								<option></option>
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
									<select id="sesi" name="sesi" class="form-select form-select-solid" data-control="select2" data-hide-search="true" data-placeholder="Pilih">
										<option></option>
											@php
												$currentYear = date('Y');
											@endphp
											@for($year = $currentYear - 1; $year <= ($currentYear + 1); $year++)
												@php
													$sesi = $year . '/' . ($year + 1);
												@endphp
												<option value="{{ $sesi }}">{{ $sesi }}</option>
											@endfor
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
								<select name="mod" id="mod" class="form-select form-select-solid" onchange=select1() data-control="select2" data-hide-search="true" data-placeholder="Pilih">
									
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
								<input type="text" class="form-control form-control-solid" placeholder="" id="no_pendaftaran_pelajar" name="no_pendaftaran_pelajar" value="" />
							</div>
							<div class="col-md-6 fv-row">
								<!--begin::Label-->
								<label class="d-flex align-items-center fs-6 fw-semibold form-label mb-2">Tempoh Pengajian (Tahun)</label>
								<!--end::Label-->
									<!--begin::Input wrapper-->
									<select id="tempoh_pengajian" name="tempoh_pengajian" onchange=dateCheck() class="form-select form-select-solid" data-control="select2" data-hide-search="true" data-placeholder="Pilih" required>
										<option></option>
										<option value="1">1</option>
										<option value="2">2</option>
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
										<select id="sem_semasa" name="sem_semasa" onchange="select1()" class="form-select form-select-solid" data-control="select2" data-hide-search="true" data-placeholder="Pilih">
											<option></option>
											@for ($i = 1; $i <= 4; $i++)
												<option value="<?= $i ?>"><?= $i ?></option>
											@endfor
										</select>
									<!--end::Input wrapper-->
								</div>
								<!--end::Row-->
							</div>
							<!--end::Col-->
							<div class="col-md-6 fv-row">
								<!--begin::Label-->
								<label class=" fs-6 fw-semibold form-label mb-2">Bil Bulan Persemester</label>
								<!--end::Label-->
								<!--begin::Row-->
								<div class="row fv-row">
									<!--begin::Input wrapper-->
										<select id="bil_bulan_per_sem" name="bil_bulan_per_sem" class="form-select form-select-solid" data-control="select2" data-hide-search="true" data-placeholder="Pilih">
											<option value="6">6</option>
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
									<span class="">Tarikh Mula Pengajian</span>&nbsp;<a href="#" data-bs-toggle="tooltip" title="Ikut Surat Tawaran"><i class="fa-solid fa-circle-info"></i></a>
								</label>
								<!--end::Label-->
								<!--begin::Input wrapper-->
								<input type="date" class="form-control form-control-solid" placeholder="" id="tarikh_mula" name="tarikh_mula" onchange=dateCheck() value="" />
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
								<input type="date" class="form-control form-control-solid" placeholder="" id="tarikh_tamat" name="tarikh_tamat" value="" />
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
								<label class=" fs-6 fw-semibold form-label mb-2">Sumber Pembiayaan</label> <a href="#" data-bs-toggle="tooltip" title="CONTOH NYA MACAM NI"><i class="fa-solid fa-circle-info"></i></a>
								<!--end::Label-->
								<!--begin::Row-->
								<div class="row fv-row">
									<!--begin::Input wrapper-->
										<select id="sumber_biaya" name="sumber_biaya" class="form-select form-select-solid" data-control="select2" data-hide-search="true" data-placeholder="Pilih">
											@foreach ($biaya as $biaya)
											<option></option>
											<option value="{{ $biaya->kod_biaya}}">{{ $biaya->biaya}}</option>
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
								<input type="text" class="form-control form-control-solid" placeholder="" id="sumber_lain" name="sumber_lain" value="" />
								<!--end::Input wrapper-->
							</div>
							<!--end::Col-->
						</div>
						<!--end::Input group-->
						<!--begin::Input group-->
						<div class="row mb-10">
							<div class="col-md-6 fv-row"  id="div_nama_penaja">
								<!--begin::Label-->
								<label class="d-flex align-items-center fs-6 fw-semibold form-label mb-2">
									<span class="">Nama Penaja</span>&nbsp;<a href="#" data-bs-toggle="tooltip" title="CONTOH NYA MACAM NI"><i class="fa-solid fa-circle-info"></i></a>
								</label>															
								<!--end::Label-->
								<select id="nama_penaja" name="nama_penaja" class="form-select form-select-solid" data-control="select2" data-hide-search="true" data-placeholder="Pilih">
									@foreach ($penaja as $penaja)
										<option></option>
										<option value="{{ $penaja->kod_penaja}}">{{ $penaja->penaja}}</option>
									@endforeach
								</select>
							</div>
							<!--begin::Col-->
							<div class="col-md-6 fv-row" id="div_penaja_lain">
								<!--begin::Label-->
								<label class="d-flex align-items-center fs-6 fw-semibold form-label mb-2">(Jika Lain-lain) Sila Nyatakan:</label>
								<!--end::Label-->
								<!--begin::Input wrapper-->
								<input type="text" class="form-control form-control-solid" placeholder="" id="penaja_lain" name="penaja_lain" value="" />
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
										<input type="number" class="form-control form-control-solid" name="amaun_wang_saku" id="amaun_wang_saku" step="0.01" inputmode="decimal" placeholder="" value="" readonly/>
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
									<th class="w-100px">Catatan</th>
								</tr>
							</thead>
							<tbody class="fw-semibold text-gray-600" >
								<tr>
									<td class="text-gray-800">Salinan Penyata Bank&nbsp;<a href="/assets/contoh/bank.pdf" target="_blank" data-bs-toggle="tooltip" title="CONTOH"><i class="fa-solid fa-circle-info"></i></a></td>
									<td class="fv-row"><input type="file" class="form-control form-control-sm" id="akaunBank" name="akaunBank"/></td>
									<td><textarea type="text" class="form-control form-control-sm" id="nota_akaunBank" rows="1" name="nota_akaunBank"></textarea></td>
								</tr>
								<tr>
									<td class="text-gray-800">Salinan Surat Tawaran Pengajian&nbsp;<a href="/assets/contoh/tawaran.pdf" target="_blank" data-bs-toggle="tooltip" title="Papar contoh salinan"><i class="fa-solid fa-circle-info"></i></a></td>
									<td class="fv-row"><input type="file" class="form-control form-control-sm" id="suratTawaran" name="suratTawaran"/></td>
									<td><textarea type="text" class="form-control form-control-sm" id="nota_suratTawaran" rows="1" name="nota_suratTawaran"></textarea></td>
								</tr>
							</tbody>
						</table>
						<!--end::Table-->
						
						<br>
						<div class="pb-10 pb-lg-15">
							<!--begin::Notice-->
							<div class="text-dark fw-semibold fs-6"><i class='fas fa-exclamation-triangle' style='color:orange; font-size:15px;'></i>&nbsp;
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
								<input class="form-check-input" type="checkbox" value="1" id="perakuan" name="perakuan"/>
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
						<button type="submit" class="btn btn-lg btn-primary me-3" data-kt-stepper-action="submit" onclick="if(!this.form.perakuan.checked){alert('Anda mesti bersetuju dengan terma dan syarat.');return false}">
							<span class="indicator-label">Hantar
							<i class="ki-duotone ki-arrow-right fs-3 ms-2 me-0">
								<span class="path1"></span>
								<span class="path2"></span>
							</i></span>
							<span class="indicator-progress">Sila tunggu...
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
   
			$(".save-form").click(function(e){
				e.preventDefault();
				var data = $('#kt_create_account_form').serialize();
				//alert (data);
				$.ajax({
					type: 'post',
					url: "{{ route('ppk.simpan') }}",
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
			$(document).ready(function(){
				$("#div_biaya_lain").hide();
				$('#sumber_biaya').on('change', function() {
				if ( this.value == '5'){
					$("#div_biaya_lain").show();
				}
				else if (this.value == '4'){
					$("#div_nama_penaja").hide();
				}
				else {
					$("#div_biaya_lain").hide();
					$("#div_nama_penaja").show();
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
	
				// institusi id
				var id_institusi = document.getElementById("id_institusi").value; 
				
				// Empty the dropdown
				$('#peringkat_pengajian').find('option').not(':first').remove();
				$('#nama_kursus').find('option').not(':first').remove();

				// AJAX request 
				// $.ajax({
				// 	url: '/peringkat/'+id_institusi,
				// 	type: 'get',
				// 	dataType: 'json',
				// 	success: function(response){
				// 		//alert('AJAX loaded something');

				// 		var len = 0;
				// 		if(response['data'] != null){
				// 			len = response['data'].length;
				// 		}

				// 		if(len > 0){
				// 			// Read data and create <option >
				// 			for(var i=0; i<len; i++){

				// 				var id_institusi = response['data'][i].id_institusi;
				// 				var kod_peringkat = response['data'][i].kod_peringkat;
				// 				var peringkat = response['data'][i].peringkat;

				// 				var option = "<option value='"+kod_peringkat+"'>"+peringkat+"</option>";

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
					// alert(kodperingkat);
		
					// Empty the dropdown
					$('#nama_kursus').find('option').not(':first').remove();
	
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
<x-default-layout>
	<head>
		
        <!-- MAIN CSS -->
        <link rel="stylesheet" href="/assets/css/sekretariat.css">
		<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
	</head>


	<!--begin::Page title-->
	<div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
		<!--begin::Title-->
		<h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Laman Utama</h1>
		<!--end::Title-->
		<!--begin::Breadcrumb-->
		<ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
			<!--begin::Item-->
			<li class="breadcrumb-item text-dark" style="color:darkblue">Laman Utama</li>
			<!--end::Item-->
			<!--begin::Item-->
			<li class="breadcrumb-item">
				<span class="bullet bg-gray-400 w-5px h-2px"></span>
			</li>
			<!--end::Item-->
			<!--begin::Item-->
			<li class="breadcrumb-item text-dark" style="color:darkblue">Paparan Pemuka</li>
			<!--end::Item-->
		</ul>
	<!--end::Breadcrumb-->
	</div>
	<!--end::Page title-->

	<br>

	{{-- Body Content --}}
	<div id="main-content">
		<div class="container-fluid">
			<div class="block-header">
				<div class="row clearfix">
					<div class="card">
						<div class="header">
							<h2>Status Keseluruhan Permohonan</h2>
						</div>

						@php
							$keseluruhanB = DB::table('permohonan')->where('program','=','BKOKU')->count();
							$derafB = DB::table('permohonan')->where('program','=','BKOKU')->where('status','=','1')->count();
							$baharuB = DB::table('permohonan')->where('program','=','BKOKU')->where('status','=','2')->count();
							$saringanB = DB::table('permohonan')->where('program','=','BKOKU')->where('status','=','3')->count();
							$disokongB = DB::table('permohonan')->where('program','=','BKOKU')->where('status','=','4')->count();
							$dikembalikanB = DB::table('permohonan')->where('program','=','BKOKU')->where('status','=','5')->count();
							$layakB = DB::table('permohonan')->where('program','=','BKOKU')->where('status','=','6')->count();
							$tidaklayakB = DB::table('permohonan')->where('program','=','BKOKU')->where('status','=','7')->count();
						@endphp

						@php
							$keseluruhanP = DB::table('permohonan')->where('program','=','PPK')->count();
							$derafP = DB::table('permohonan')->where('program','=','PPK')->where('status','=','1')->count();
							$baharuP = DB::table('permohonan')->where('program','=','PPK')->where('status','=','2')->count();
							$saringanP = DB::table('permohonan')->where('program','=','PPK')->where('status','=','3')->count();
							$disokongP = DB::table('permohonan')->where('program','=','PPK')->where('status','=','4')->count();
							$dikembalikanP = DB::table('permohonan')->where('program','=','PPK')->where('status','=','5')->count();
							$layakP = DB::table('permohonan')->where('program','=','PPK')->where('status','=','6')->count();
							$tidaklayakP = DB::table('permohonan')->where('program','=','PPK')->where('status','=','7')->count();
						@endphp

						{{-- top nav bar --}}
						<ul class="nav nav-tabs" id="myTab" role="tablist">
							<li class="nav-item" role="presentation">
								<button class="nav-link active" id="bkoku-tab" data-toggle="tab" data-target="#bkoku" type="button" role="tab" aria-controls="bkoku" aria-selected="true">BKOKU</button>
							</li>
							<li class="nav-item" role="presentation">
								<button class="nav-link" id="ppk-tab" data-toggle="tab" data-target="#ppk" type="button" role="tab" aria-controls="ppk" aria-selected="false">PPK</button>
							</li>
						</ul>

						<div class="tab-content" id="myTabContent">
							{{-- BKOKU --}}
							<div class="tab-pane fade show active" id="bkoku" role="tabpanel" aria-labelledby="bkoku-tab">
								<br>
								<div class="body">
									<br>
									<!--begin::First Row-->
									<div class="row g-3 g-lg-6">
										<!--begin::Col-->
										<div class="col-3">
											<!--begin::Items-->
											<div class="px-6 pt-7 card-rounded h-150px w-100 card theme-dark-bg-body" style="background-color: #787878">
												<!--begin::Symbol-->
												<div class="symbol symbol-30px me-5 mb-8">
													{{-- <span class="symbol-label"> --}}
														<i class="fas fa-list-ol text-light" style="font-size: 20px;">
															<span class="path1"></span>
															<span class="path2"></span>
															<span class="fw-semibold me-1 align-self-center" style="padding-bottom: 5px; padding-left:10px; font-family:cursive;">Keseluruhan</span>
														</i>
													{{-- </span> --}}
												</div>
												<!--end::Symbol-->
												<!--begin::Stats-->
												<div class="m-0">
													<span class="text-white fw-bolder d-block fs-3x lh-1 ls-n1 mb-1">{{$keseluruhanB}}</span>
													<a href="{{url('keseluruhanPermohonan')}}"><span class="text-white fw-bold fs-7">Lihat</span></a>
												</div>
												<!--end::Stats-->
											</div>
											<!--end::Items-->
										</div>
										<!--end::Col-->

										<!--begin::Col-->
										<div class="col-3">
											<!--begin::Items-->
											<div class="px-6 pt-7 card-rounded h-150px w-100 card theme-dark-bg-body bg-info">
												<!--begin::Symbol-->
												<div class="symbol symbol-30px me-5 mb-8">
													{{-- <span class="symbol-label"> --}}
														<i class="fa-solid fa-file-lines text-light" style="font-size: 20px;">
															<span class="path1"></span>
															<span class="path2"></span>
															<span class="path3"></span>
															<span class="fw-semibold me-1 align-self-center" style="padding-bottom: 5px; padding-left:10px; font-family:cursive;">Deraf</span>
														</i>
													{{-- </span> --}}
												</div>
												<!--end::Symbol-->
												<!--begin::Stats-->
												<div class="m-0">
													<span class="text-white fw-bolder d-block fs-3x lh-1 ls-n1 mb-1">{{$derafB}}</span>
													<a href="{{url('keseluruhanPermohonan')}}"><span class="text-white fw-bold fs-7">Lihat</span></a>
												</div>
												<!--end::Stats-->
											</div>
											<!--end::Items-->
										</div>
										<!--end::Col-->

										<!--begin::Col-->
										<div class="col-3">
											<!--begin::Items-->
											<div class="px-6 pt-7 card-rounded h-150px w-100 card theme-dark-bg-body" style="background-color: #186ee6">
												<!--begin::Symbol-->
												<div class="symbol symbol-30px me-5 mb-8">
													{{-- <span class="symbol-label"> --}}
														<i class="fa-solid fa-file-circle-plus text-light" style="font-size: 20px;">
															<span class="path1"></span>
															<span class="path2"></span>
															<span class="fw-semibold me-1 align-self-center" style="padding-bottom: 5px; padding-left:10px; font-family:cursive;">Baharu</span>
														</i>
													{{-- </span> --}}
												</div>
												<!--end::Symbol-->
												<!--begin::Stats-->
												<div class="m-0">
													<span class="text-white fw-bolder d-block fs-3x lh-1 ls-n1 mb-1">{{$baharuB}}</span>
													<a href="{{url('keseluruhanPermohonan')}}"><span class="text-white fw-bold fs-7">Lihat</span></a>
												</div>
												<!--end::Stats-->
											</div>
											<!--end::Items-->
										</div>
										<!--end::Col-->

										<!--begin::Col-->
										<div class="col-3">
											<!--begin::Items-->
											<div class="px-6 pt-7 card-rounded h-150px w-100 card theme-dark-bg-body" style="background-color: #ea40acdc">
												<!--begin::Symbol-->
												<div class="symbol symbol-30px me-5 mb-8">
														<i class="fas fa-th-list text-light" style="font-size: 20px;">
															<span class="path1"></span>
															<span class="path2"></span>
															<span class="fw-semibold me-1 align-self-center" style="padding-bottom: 5px; padding-left:10px; font-family:cursive;">Saringan</span>
														</i>
												</div>
												<!--end::Symbol-->
												<!--begin::Stats-->
												<div class="m-0">
													<span class="text-white fw-bolder d-block fs-3x lh-1 ls-n1 mb-1">{{$saringanB}}</span>
													<a href="{{url('keseluruhanPermohonan')}}"><span class="text-white fw-bold fs-7">Lihat</span></a>
												</div>
												<!--end::Stats-->
											</div>
											<!--end::Items-->
										</div>
										<!--end::Col-->
									</div>
									<!--end::Row-->

									<!--begin::Second Row-->
									<div class="row g-3 g-lg-6">
										<!--begin::Col-->
										<div class="col-3">
											<!--begin::Items-->
											<div class="px-6 pt-7 card-rounded h-150px w-100 card theme-dark-bg-body"  style="background-color: #efd06c">
												<!--begin::Symbol-->
												<div class="symbol symbol-30px me-5 mb-8">
														<i class="fa-solid fa-check-to-slot text-light" style="font-size: 20px;">
															<span class="path1"></span>
															<span class="path2"></span>
															<span class="path3"></span>
															<span class="fw-semibold me-1 align-self-center" style="padding-bottom: 5px; padding-left:20px; font-family:cursive;">Disokong</span>
														</i>
												</div>
												<!--end::Symbol-->
												<!--begin::Stats-->
												<div class="m-0">
													<span class="text-white fw-bolder d-block fs-3x lh-1 ls-n1 mb-1">{{$disokongB}}</span>
													<a href="{{url('keseluruhanPermohonan')}}"><span class="text-white fw-bold fs-7">Lihat</span></a>
												</div>
												<!--end::Stats-->
											</div>
											<!--end::Items-->
										</div>
										<!--end::Col-->

										<!--begin::Col-->
										<div class="col-3">
											<!--begin::Items-->
											<div class="px-6 pt-7 card-rounded h-150px w-100 card theme-dark-bg-body"  style="background-color: #d75b50">
												<!--begin::Symbol-->
												<div class="symbol symbol-30px me-5 mb-8">
														<i class="fa-solid fa-reply-all text-light" style="font-size: 20px;">
															<span class="path1"></span>
															<span class="path2"></span>
															<span class="path3"></span>
															<span class="fw-semibold me-1 align-self-center" style="padding-bottom: 5px; padding-left:20px; font-family:cursive;">Dikembalikan</span>
														</i>
												</div>
												<!--end::Symbol-->
												<!--begin::Stats-->
												<div class="m-0">
													<span class="text-white fw-bolder d-block fs-3x lh-1 ls-n1 mb-1">{{$dikembalikanB}}</span>
													<a href="{{url('keseluruhanPermohonan')}}"><span class="text-white fw-bold fs-7">Lihat</span></a>
												</div>
												<!--end::Stats-->
											</div>
											<!--end::Items-->
										</div>
										<!--end::Col-->
										
										<!--begin::Col-->
										<div class="col-3">
											<!--begin::Items-->
											<div class="px-6 pt-7 card-rounded h-150px w-100 card theme-dark-bg-body bg-success">
												<!--begin::Symbol-->
												<div class="symbol symbol-30px me-5 mb-8">
													{{-- <span class="symbol-label"> --}}
														<i class="fas fa-user-check text-light" style="font-size: 20px;">
															<span class="path1"></span>
															<span class="path2"></span>
															<span class="fw-semibold me-1 align-self-center" style="padding-bottom: 5px; padding-left:20px; font-family:cursive;">Layak</span>
														</i>
													{{-- </span> --}}
												</div>
												<!--end::Symbol-->
												<!--begin::Stats-->
												<div class="m-0">
													<span class="text-white fw-bolder d-block fs-3x lh-1 ls-n1 mb-1">{{$layakB}}</span>
													<a href="{{url('keseluruhanPermohonan')}}"><span class="text-white fw-bold fs-7">Lihat</span></a>
												</div>
												<!--end::Stats-->
											</div>
											<!--end::Items-->
										</div>
										<!--end::Col-->

										<!--begin::Col-->
										<div class="col-3">
											<!--begin::Items-->
											<div class="px-6 pt-7 card-rounded h-150px w-100 card theme-dark-bg-body bg-danger">
												<!--begin::Symbol-->
												<div class="symbol symbol-30px me-5 mb-8">
													{{-- <span class="symbol-label"> --}}
														<i class="fa-solid fa-user-xmark text-light" style="font-size: 20px;">
															<span class="path1"></span>
															<span class="path2"></span>
															<span class="path3"></span>
															<span class="fw-semibold me-1 align-self-center" style="padding-bottom: 5px; padding-left:20px; font-family:cursive;">Tidak Layak</span>
														</i>
													{{-- </span> --}}
												</div>
												<!--end::Symbol-->
												<!--begin::Stats-->
												<div class="m-0">
													<span class="text-white fw-bolder d-block fs-3x lh-1 ls-n1 mb-1">{{$tidaklayakB}}</span>
													<a href="{{url('keseluruhanPermohonan')}}"><span class="text-white fw-bold fs-7">Lihat</span></a>
												</div>
												<!--end::Stats-->
											</div>
											<!--end::Items-->
										</div>
										<!--end::Col-->
									</div>
									<!--end::Row-->
								</div>

								{{-- <div class="table-responsive">
									<div class="body">
										<div class="row">
											<!--begin::Jumlah-->
											<div class="col-sm-6 col-xl-3 mb-xl-10">
												<!--begin::Card widget 2-->
												<div class="card h-lg-100">
													<!--begin::Body-->
													<div class="card-body d-flex justify-content-between align-items-start flex-column">         
														<!--begin::Icon--> 
														<div class="m-0">
															<i class="ki-duotone ki-compass fs-2hx text-gray-600">
																<span class="path1"></span>
																<span class="path2"></span>
																<span class="fs-1 fw-semibold me-1 align-self-center" style="padding-bottom: 5px; padding-left:20px;">Keseluruhan</span>
															</i>
														</div>                           
														<!--end::Icon-->

														<!--begin::Section--> 
														<div class="d-flex flex-column my-7">
															<span class="fw-semibold fs-3x text-gray-800 lh-1 ls-n2">{{$keseluruhanB}}</span> 

															<div class="m-0">
																<span class="badge badge-light fs-base m-0">
																	<a href="#" class="secondary text-black"><span class="path1"></span><span class="path2"></span>Lihat</a> 
																	
																</span>  
															</div>       
														</div>  
														<!--end::Section-->                                  
													</div>
													<!--end::Body-->
												</div>
												<!--end::Card widget 2-->
											</div>
											<!--end::Col-->

											<!--begin::Deraf-->
											<div class="col-sm-6 col-xl-3 mb-xl-10">
												<!--begin::Card widget 2-->
												<div class="card h-lg-100">
													<!--begin::Body-->
													<div class="card-body d-flex justify-content-between align-items-start flex-column">         
														<!--begin::Icon--> 
														<div class="m-0">
															<i class="ki-duotone ki-map fs-2hx text-gray-600">
																<span class="path1"></span>
																<span class="path2"></span>
																<span class="path3"></span>
																<span class="fs-1 fw-semibold me-1 align-self-center" style="padding-bottom: 5px; padding-left:20px;">Deraf</span>
															</i>               
														</div>                           
														<!--end::Icon-->

														<!--begin::Section--> 
														<div class="d-flex flex-column my-7">
															<span class="fw-semibold fs-3x text-gray-800 lh-1 ls-n2">{{$derafB}}</span> 

															<div class="m-0">
																<span class="badge badge-dark-secondary fs-base m-0">
																	<a href="#" class="dark-secondary text-turqoise"><span class="path1"></span><span class="path2"></span>Lihat</a> 
																</span>  
															</div>       
														</div>  
														<!--end::Section-->                                
													</div>
													<!--end::Body-->
												</div>
												<!--end::Card widget 2-->
											</div>
											<!--end::Col-->

											<!--begin::Baharu-->
											<div class="col-sm-6 col-xl-3 mb-xl-10">
												<!--begin::Card widget 2-->
												<div class="card h-lg-100">
													<!--begin::Body-->
													<div class="card-body d-flex justify-content-between align-items-start flex-column">         
														<!--begin::Icon--> 
														<div class="m-0">
															<i class="ki-duotone ki-compass fs-2hx text-gray-600">
																<span class="path1"></span>
																<span class="path2"></span>
																<span class="fs-1 fw-semibold me-1 align-self-center" style="padding-bottom: 5px; padding-left:20px;">Baharu</span>
															</i>
														</div>                           
														<!--end::Icon-->

														<!--begin::Section--> 
														<div class="d-flex flex-column my-7">
															<span class="fw-semibold fs-3x text-gray-800 lh-1 ls-n2">{{$baharuB}}</span> 

															<div class="m-0">
																<span class="badge badge-light-primary fs-base m-0">
																	<a href="#" class="primary text-primary"><span class="path1"></span><span class="path2"></span>Lihat</a> 
																</span>  
															</div>       
														</div>  
														<!--end::Section-->                                  
													</div>
													<!--end::Body-->
												</div>
												<!--end::Card widget 2-->
											</div>
											<!--end::Col-->

											<!--begin::Saringan-->
											<div class="col-sm-6 col-xl-3 mb-xl-10">
												<!--begin::Card widget 2-->
												<div class="card h-lg-100">
													<!--begin::Body-->
													<div class="card-body d-flex justify-content-between align-items-start flex-column">         
														<!--begin::Icon--> 
														<div class="m-0">
															<i class="ki-duotone ki-chart-simple fs-2hx text-gray-600">
																<span class="path1"></span>
																<span class="path2"></span>
																<span class="path3"></span>
																<span class="path4"></span>
																<span class="fs-1 fw-semibold me-1 align-self-center" style="padding-bottom: 5px; padding-left:20px;">Saringan</span>
															</i>                     
														</div>                           
														<!--end::Icon-->

														<!--begin::Section--> 
														<div class="d-flex flex-column my-7">
															<span class="fw-semibold fs-3x text-gray-800 lh-1 ls-n2">{{$saringanB}}</span> 

															<div class="m-0">
																<span class="badge badge-light-warning fs-base m-0">
																	<a href="#" class="warning text-warning"><span class="path1"></span><span class="path2"></span>Lihat</a> 
																</span>  
															</div>       
														</div>  
														<!--end::Section-->                            
													</div>
													<!--end::Body-->
												</div>
												<!--end::Card widget 2-->
											</div>
											<!--end::Col-->
										</div>

										<div class="row">
											<!--begin::Disokong-->
											<div class="col-sm-6 col-xl-3 mb-xl-10">
												<!--begin::Card widget 2-->
												<div class="card h-lg-100">
													<!--begin::Body-->
													<div class="card-body d-flex justify-content-between align-items-start flex-column">         
														<!--begin::Icon--> 
														<div class="m-0">
															<i class="ki-duotone ki-abstract-35 fs-2hx text-gray-600">
																<span class="path1"></span>
																<span class="path2"></span>
																<span class="fs-1 fw-semibold me-1 align-self-center" style="padding-bottom: 5px; padding-left:20px;">Disokong</span>
															</i>                     
														</div>                           
														<!--end::Icon-->

														 <!--begin::Section--> 
														<div class="d-flex flex-column my-7">
															<span class="fw-semibold fs-3x text-gray-800 lh-1 ls-n2">{{$disokongB}}</span> 

															<div class="m-0">
																<span class="badge badge-light-warning fs-base m-0">
																	<a href="#" class="warning text-warning"><span class="path1"></span><span class="path2"></span>Lihat</a> 
																</span>  
															</div>       
														</div>  
														<!--end::Section-->                              
													</div>
													<!--end::Body-->
												</div>
												<!--end::Card widget 2-->
											</div>
											<!--end::Col-->

											<!--begin::Dikembalikan-->
											<div class="col-sm-6 col-xl-3 mb-xl-10">
												<!--begin::Card widget 2-->
												<div class="card h-lg-100">
													<!--begin::Body-->
													<div class="card-body d-flex justify-content-between align-items-start flex-column">         
														<!--begin::Icon--> 
														<div class="m-0">
															<i class="ki-duotone ki-abstract-26 fs-2hx text-gray-600">
																<span class="path1"></span>
																<span class="path2"></span>
																<span class="fs-1 fw-semibold me-1 align-self-center" style="padding-bottom: 5px; padding-left:20px;">Dikembalikan</span>
															</i>                     
														</div>                           
														<!--end::Icon-->

														<!--begin::Section--> 
														<div class="d-flex flex-column my-7">
															<span class="fw-semibold fs-3x text-gray-800 lh-1 ls-n2">{{$dikembalikanB}}</span> 

															<div class="m-0">
																<span class="badge badge-light-danger fs-base m-0">
																	<a href="#"><span class="path1"></span><span class="path2"></span></a> 
																	Lihat
																</span>  
															</div>       
														</div>  
														<!--end::Section-->                               
													</div>
													<!--end::Body-->
												</div>
												<!--end::Card widget 2-->
											</div>
											<!--end::Col-->

											<!--begin::Layak-->
											<div class="col-sm-6 col-xl-3 mb-xl-10">
												<!--begin::Card widget 2-->
												<div class="card h-lg-100">
													<!--begin::Body-->
													<div class="card-body d-flex justify-content-between align-items-start flex-column">         
														<!--begin::Icon--> 
														<div class="m-0">
															<i class="ki-duotone ki-chart-simple fs-2hx text-gray-600">
																<span class="path1"></span>
																<span class="path2"></span>
																<span class="path3"></span>
																<span class="path4"></span>
																<span class="fs-1 fw-semibold me-1 align-self-center" style="padding-bottom: 5px; padding-left:20px;">Layak</span>
															</i>                     
														</div>                           
														<!--end::Icon-->

														<!--begin::Section--> 
														<div class="d-flex flex-column my-7">
															<span class="fw-semibold fs-3x text-gray-800 lh-1 ls-n2">{{$layakB}}</span> 

															<div class="m-0">
																<span class="badge badge-light-success fs-base m-0">
																	<a href="#"><span class="path1"></span><span class="path2"></span></a> 
																	Lihat
																</span>  
															</div>       
														</div>  
														<!--end::Section-->                            
													</div>
													<!--end::Body-->
												</div>
												<!--end::Card widget 2-->
											</div>
											<!--end::Col-->

											<!--begin::Tidak Layak-->
											<div class="col-sm-6 col-xl-3 mb-xl-10">      
												<!--begin::Card widget 2-->
												<div class="card h-lg-100">
													<!--begin::Body-->
													<div class="card-body d-flex justify-content-between align-items-start flex-column">         
														<!--begin::Icon--> 
														<div class="m-0">
															<i class="ki-duotone ki-abstract-39 fs-2hx text-gray-600">
																<span class="path1"></span>
																<span class="path2"></span>
																<span class="fs-1 fw-semibold me-1 align-self-center" style="padding-bottom: 5px; padding-left:20px;">Tidak Layak</span>
															</i>                     
														</div>                           
														<!--end::Icon-->

														<!--begin::Section--> 
														<div class="d-flex flex-column my-7">
															<span class="fw-semibold fs-3x text-gray-800 lh-1 ls-n2">{{$tidaklayakB}}</span> 

															<div class="m-0">
																<span class="badge badge-light-danger fs-base m-0">
																	<a href="#"><span class="path1"></span><span class="path2"></span></a> 
																	Lihat
																</span>  
															</div>       
														</div>  
														<!--end::Section-->                                
													</div>
													<!--end::Body-->
												</div>
												<!--end::Card widget 2-->
											</div>
											<!--end::Col-->

											<!--begin::Col-->
											{{-- <div class="col-sm-6 col-xl-3 mb-5 mb-xl-10">
												<!--begin::Card widget 2-->
												<div class="card h-lg-100">
													<!--begin::Body-->
													<div class="card-body d-flex justify-content-between align-items-start flex-column">         
														<!--begin::Icon--> 
														<div class="m-0">
															<i class="ki-duotone ki-abstract-26 fs-2hx text-gray-600"><span class="path1"></span><span class="path2"></span></i>                     
														</div>                           
														<!--end::Icon-->

														<!--begin::Section--> 
														<div class="d-flex flex-column my-7">
															<!--begin::Number-->           
															<span class="fw-semibold fs-3x text-gray-800 lh-1 ls-n2">106M</span> 
															<!--end::Number--> 

															<!--begin::Follower-->
															<div class="m-0">
																<span class="fw-semibold fs-6 text-gray-400">Dikembalikan</span>  
															</div>       
															<!--end::Follower--> 
														</div>  
														<!--end::Section-->          
														
														<!--begin::Badge--> 
														<span class="badge badge-light-success fs-base">
															<a href="#"><span class="path1"></span><span class="path2"></span></a> 
															Lihat
														</span>  
														<!--end::Badge-->                              
													</div>
													<!--end::Body-->
												</div>
												<!--end::Card widget 2-->
											</div> --}}
											<!--end::Col-->
										{{-- </div>
									</div>
								</div> --}}
							</div>

							{{-- PPK --}}
							<div class="tab-pane fade" id="ppk" role="tabpanel" aria-labelledby="ppk-tab">
								<br>
								<div class="body">
									<br>
									<!--begin::First Row-->
									<div class="row g-3 g-lg-6">
										<!--begin::Col-->
										<div class="col-3">
											<!--begin::Items-->
											<div class="px-6 pt-7 card-rounded h-150px w-100 card theme-dark-bg-body" style="background-color: #787878">
												<!--begin::Symbol-->
												<div class="symbol symbol-30px me-5 mb-8">
													{{-- <span class="symbol-label"> --}}
														<i class="fas fa-list-ol text-light" style="font-size: 20px;">
															<span class="path1"></span>
															<span class="path2"></span>
															<span class="fw-semibold me-1 align-self-center" style="padding-bottom: 5px; padding-left:10px; font-family:cursive;">Keseluruhan</span>
														</i>
													{{-- </span> --}}
												</div>
												<!--end::Symbol-->
												<!--begin::Stats-->
												<div class="m-0">
													<span class="text-white fw-bolder d-block fs-3x lh-1 ls-n1 mb-1">{{$keseluruhanP}}</span>
													<a href="{{url('keseluruhanPermohonan')}}"><span class="text-white fw-bold fs-7">Lihat</span></a>
												</div>
												<!--end::Stats-->
											</div>
											<!--end::Items-->
										</div>
										<!--end::Col-->

										<!--begin::Col-->
										<div class="col-3">
											<!--begin::Items-->
											<div class="px-6 pt-7 card-rounded h-150px w-100 card theme-dark-bg-body bg-info">
												<!--begin::Symbol-->
												<div class="symbol symbol-30px me-5 mb-8">
													{{-- <span class="symbol-label"> --}}
														<i class="fa-solid fa-file-lines text-light" style="font-size: 20px;">
															<span class="path1"></span>
															<span class="path2"></span>
															<span class="path3"></span>
															<span class="fw-semibold me-1 align-self-center" style="padding-bottom: 5px; padding-left:10px; font-family:cursive;">Deraf</span>
														</i>
													{{-- </span> --}}
												</div>
												<!--end::Symbol-->
												<!--begin::Stats-->
												<div class="m-0">
													<span class="text-white fw-bolder d-block fs-3x lh-1 ls-n1 mb-1">{{$derafP}}</span>
													<a href="{{url('keseluruhanPermohonan')}}"><span class="text-white fw-bold fs-7">Lihat</span></a>
												</div>
												<!--end::Stats-->
											</div>
											<!--end::Items-->
										</div>
										<!--end::Col-->

										<!--begin::Col-->
										<div class="col-3">
											<!--begin::Items-->
											<div class="px-6 pt-7 card-rounded h-150px w-100 card theme-dark-bg-body" style="background-color: #186ee6">
												<!--begin::Symbol-->
												<div class="symbol symbol-30px me-5 mb-8">
													{{-- <span class="symbol-label"> --}}
														<i class="fa-solid fa-file-circle-plus text-light" style="font-size: 20px;">
															<span class="path1"></span>
															<span class="path2"></span>
															<span class="fw-semibold me-1 align-self-center" style="padding-bottom: 5px; padding-left:10px; font-family:cursive;">Baharu</span>
														</i>
													{{-- </span> --}}
												</div>
												<!--end::Symbol-->
												<!--begin::Stats-->
												<div class="m-0">
													<span class="text-white fw-bolder d-block fs-3x lh-1 ls-n1 mb-1">{{$baharuP}}</span>
													<a href="{{url('keseluruhanPermohonan')}}"><span class="text-white fw-bold fs-7">Lihat</span></a>
												</div>
												<!--end::Stats-->
											</div>
											<!--end::Items-->
										</div>
										<!--end::Col-->

										<!--begin::Col-->
										<div class="col-3">
											<!--begin::Items-->
											<div class="px-6 pt-7 card-rounded h-150px w-100 card theme-dark-bg-body" style="background-color: #ea40acdc">
												<!--begin::Symbol-->
												<div class="symbol symbol-30px me-5 mb-8">
														<i class="fas fa-th-list text-light" style="font-size: 20px;">
															<span class="path1"></span>
															<span class="path2"></span>
															<span class="fw-semibold me-1 align-self-center" style="padding-bottom: 5px; padding-left:10px; font-family:cursive;">Saringan</span>
														</i>
												</div>
												<!--end::Symbol-->
												<!--begin::Stats-->
												<div class="m-0">
													<span class="text-white fw-bolder d-block fs-3x lh-1 ls-n1 mb-1">{{$saringanP}}</span>
													<a href="{{url('keseluruhanPermohonan')}}"><span class="text-white fw-bold fs-7">Lihat</span></a>
												</div>
												<!--end::Stats-->
											</div>
											<!--end::Items-->
										</div>
										<!--end::Col-->
									</div>
									<!--end::Row-->

									<!--begin::Second Row-->
									<div class="row g-3 g-lg-6">
										<!--begin::Col-->
										<div class="col-3">
											<!--begin::Items-->
											<div class="px-6 pt-7 card-rounded h-150px w-100 card theme-dark-bg-body"  style="background-color: #efd06c">
												<!--begin::Symbol-->
												<div class="symbol symbol-30px me-5 mb-8">
														<i class="fa-solid fa-check-to-slot text-light" style="font-size: 20px;">
															<span class="path1"></span>
															<span class="path2"></span>
															<span class="path3"></span>
															<span class="fw-semibold me-1 align-self-center" style="padding-bottom: 5px; padding-left:20px; font-family:cursive;">Disokong</span>
														</i>
												</div>
												<!--end::Symbol-->
												<!--begin::Stats-->
												<div class="m-0">
													<span class="text-white fw-bolder d-block fs-3x lh-1 ls-n1 mb-1">{{$disokongP}}</span>
													<a href="{{url('keseluruhanPermohonan')}}"><span class="text-white fw-bold fs-7">Lihat</span></a>
												</div>
												<!--end::Stats-->
											</div>
											<!--end::Items-->
										</div>
										<!--end::Col-->

										<!--begin::Col-->
										<div class="col-3">
											<!--begin::Items-->
											<div class="px-6 pt-7 card-rounded h-150px w-100 card theme-dark-bg-body"  style="background-color: #d75b50">
												<!--begin::Symbol-->
												<div class="symbol symbol-30px me-5 mb-8">
														<i class="fa-solid fa-reply-all text-light" style="font-size: 20px;">
															<span class="path1"></span>
															<span class="path2"></span>
															<span class="path3"></span>
															<span class="fw-semibold me-1 align-self-center" style="padding-bottom: 5px; padding-left:20px; font-family:cursive;">Dikembalikan</span>
														</i>
												</div>
												<!--end::Symbol-->
												<!--begin::Stats-->
												<div class="m-0">
													<span class="text-white fw-bolder d-block fs-3x lh-1 ls-n1 mb-1">{{$dikembalikanP}}</span>
													<a href="{{url('keseluruhanPermohonan')}}"><span class="text-white fw-bold fs-7">Lihat</span></a>
												</div>
												<!--end::Stats-->
											</div>
											<!--end::Items-->
										</div>
										<!--end::Col-->
										
										<!--begin::Col-->
										<div class="col-3">
											<!--begin::Items-->
											<div class="px-6 pt-7 card-rounded h-150px w-100 card theme-dark-bg-body bg-success">
												<!--begin::Symbol-->
												<div class="symbol symbol-30px me-5 mb-8">
													{{-- <span class="symbol-label"> --}}
														<i class="fas fa-user-check text-light" style="font-size: 20px;">
															<span class="path1"></span>
															<span class="path2"></span>
															<span class="fw-semibold me-1 align-self-center" style="padding-bottom: 5px; padding-left:20px; font-family:cursive;">Layak</span>
														</i>
													{{-- </span> --}}
												</div>
												<!--end::Symbol-->
												<!--begin::Stats-->
												<div class="m-0">
													<span class="text-white fw-bolder d-block fs-3x lh-1 ls-n1 mb-1">{{$layakP}}</span>
													<a href="{{url('keseluruhanPermohonan')}}"><span class="text-white fw-bold fs-7">Lihat</span></a>
												</div>
												<!--end::Stats-->
											</div>
											<!--end::Items-->
										</div>
										<!--end::Col-->

										<!--begin::Col-->
										<div class="col-3">
											<!--begin::Items-->
											<div class="px-6 pt-7 card-rounded h-150px w-100 card theme-dark-bg-body bg-danger">
												<!--begin::Symbol-->
												<div class="symbol symbol-30px me-5 mb-8">
													{{-- <span class="symbol-label"> --}}
														<i class="fa-solid fa-user-xmark text-light" style="font-size: 20px;">
															<span class="path1"></span>
															<span class="path2"></span>
															<span class="path3"></span>
															<span class="fw-semibold me-1 align-self-center" style="padding-bottom: 5px; padding-left:20px; font-family:cursive;">Tidak Layak</span>
														</i>
													{{-- </span> --}}
												</div>
												<!--end::Symbol-->
												<!--begin::Stats-->
												<div class="m-0">
													<span class="text-white fw-bolder d-block fs-3x lh-1 ls-n1 mb-1">{{$tidaklayakP}}</span>
													<a href="{{url('keseluruhanPermohonan')}}"><span class="text-white fw-bold fs-7">Lihat</span></a>
												</div>
												<!--end::Stats-->
											</div>
											<!--end::Items-->
										</div>
										<!--end::Col-->
									</div>
									<!--end::Row-->
								</div>
							</div>
						</div>

					</div>
				</div>
			</div>
		</div>
	</div>
</x-default-layout>

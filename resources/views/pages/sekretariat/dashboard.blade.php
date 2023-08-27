<x-default-layout>
	<head>
		<title>Sekretariat BKOKU KPT</title>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">

        <!-- MAIN CSS -->
        <link rel="stylesheet" href="/assets/css/sekretariat.css">
		<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
	</head>


	<!--begin::Page title-->
	<div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
		<!--begin::Title-->
		<h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Utama</h1>
		<!--end::Title-->
		<!--begin::Breadcrumb-->
		<ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
			<!--begin::Item-->
			<li class="breadcrumb-item text-dark" style="color:darkblue">Utama</li>
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
								<div class="table-responsive">
									<div class="body">
										<div class="row">
											<!--begin::Col-->
											<div class="col-sm-6 col-xl-3 mb-xl-10">
												<!--begin::Card widget 2-->
												<div class="card h-lg-100">
													<!--begin::Body-->
													<div class="card-body d-flex justify-content-between align-items-start flex-column">         
														<!--begin::Icon--> 
														<div class="m-0">
																			<i class="ki-duotone ki-compass fs-2hx text-gray-600"><span class="path1"></span><span class="path2"></span></i>                     
																	
														</div>                           
														<!--end::Icon-->

														<!--begin::Section--> 
														<div class="d-flex flex-column my-7">
															<!--begin::Number-->           
															<span class="fw-semibold fs-3x text-gray-800 lh-1 ls-n2">327</span> 
															<!--end::Number--> 

															<!--begin::Follower-->
															<div class="m-0">
																					<span class="fw-semibold fs-6 text-gray-400">
																		Projects                    </span>  
																
															</div>       
															<!--end::Follower--> 
														</div>  
														<!--end::Section-->          
														
														<!--begin::Badge--> 
														<span class="badge badge-light-success fs-base">
																			<i class="ki-duotone ki-arrow-up fs-5 text-success ms-n1"><span class="path1"></span><span class="path2"></span></i> 
																					
															2.1%
														</span>  
														<!--end::Badge-->                              
													</div>
													<!--end::Body-->
												</div>
												<!--end::Card widget 2-->
											</div>
											<!--end::Col-->

											<!--begin::Col-->
											<div class="col-sm-6 col-xl-3 mb-xl-10">
												<!--begin::Card widget 2-->
												<div class="card h-lg-100">
													<!--begin::Body-->
													<div class="card-body d-flex justify-content-between align-items-start flex-column">         
														<!--begin::Icon--> 
														<div class="m-0">
																			<i class="ki-duotone ki-chart-simple fs-2hx text-gray-600"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span></i>                     
																	
														</div>                           
														<!--end::Icon-->

														<!--begin::Section--> 
														<div class="d-flex flex-column my-7">
															<!--begin::Number-->           
															<span class="fw-semibold fs-3x text-gray-800 lh-1 ls-n2">27,5M</span> 
															<!--end::Number--> 

															<!--begin::Follower-->
															<div class="m-0">
																					<span class="fw-semibold fs-6 text-gray-400">
																		Stock Qty                    </span>  
																
															</div>       
															<!--end::Follower--> 
														</div>  
														<!--end::Section-->          
														
														<!--begin::Badge--> 
														<span class="badge badge-light-success fs-base">
																			<i class="ki-duotone ki-arrow-up fs-5 text-success ms-n1"><span class="path1"></span><span class="path2"></span></i> 
																					
															2.1%
														</span>  
														<!--end::Badge-->                              
													</div>
													<!--end::Body-->
												</div>
												<!--end::Card widget 2-->
											</div>
											<!--end::Col-->

											<!--begin::Col-->
											<div class="col-sm-6 col-xl-3 mb-xl-10">      
												<!--begin::Card widget 2-->
												<div class="card h-lg-100">
													<!--begin::Body-->
													<div class="card-body d-flex justify-content-between align-items-start flex-column">         
														<!--begin::Icon--> 
														<div class="m-0">
																			<i class="ki-duotone ki-abstract-39 fs-2hx text-gray-600"><span class="path1"></span><span class="path2"></span></i>                     
																	
														</div>                           
														<!--end::Icon-->

														<!--begin::Section--> 
														<div class="d-flex flex-column my-7">
															<!--begin::Number-->           
															<span class="fw-semibold fs-3x text-gray-800 lh-1 ls-n2">149M</span> 
															<!--end::Number--> 

															<!--begin::Follower-->
															<div class="m-0">
																					<span class="fw-semibold fs-6 text-gray-400">
																		Stock Value                    </span>  
																
															</div>       
															<!--end::Follower--> 
														</div>  
														<!--end::Section-->          
														
														<!--begin::Badge--> 
														<span class="badge badge-light-danger fs-base">
																			<i class="ki-duotone ki-arrow-down fs-5 text-danger ms-n1"><span class="path1"></span><span class="path2"></span></i>                  
																					
															0.47%
														</span>  
														<!--end::Badge-->                              
													</div>
													<!--end::Body-->
												</div>
												<!--end::Card widget 2-->
											</div>
											<!--end::Col-->

											<!--begin::Col-->
											<div class="col-sm-6 col-xl-3 mb-xl-10">
												<!--begin::Card widget 2-->
												<div class="card h-lg-100">
													<!--begin::Body-->
													<div class="card-body d-flex justify-content-between align-items-start flex-column">         
														<!--begin::Icon--> 
														<div class="m-0">
																			<i class="ki-duotone ki-map fs-2hx text-gray-600"><span class="path1"></span><span class="path2"></span><span class="path3"></span></i>                     
																	
														</div>                           
														<!--end::Icon-->

														<!--begin::Section--> 
														<div class="d-flex flex-column my-7">
															<!--begin::Number-->           
															<span class="fw-semibold fs-3x text-gray-800 lh-1 ls-n2">89M</span> 
															<!--end::Number--> 

															<!--begin::Follower-->
															<div class="m-0">
																					<span class="fw-semibold fs-6 text-gray-400">
																		C APEX                    </span>  
																
															</div>       
															<!--end::Follower--> 
														</div>  
														<!--end::Section-->          
														
														<!--begin::Badge--> 
														<span class="badge badge-light-success fs-base">
																			<i class="ki-duotone ki-arrow-up fs-5 text-success ms-n1"><span class="path1"></span><span class="path2"></span></i> 
																					
															2.1%
														</span>  
														<!--end::Badge-->                              
													</div>
													<!--end::Body-->
												</div>
												<!--end::Card widget 2-->
											</div>
											<!--end::Col-->
										</div>

										<div class="row">
											<!--begin::Col-->
											<div class="col-sm-6 col-xl-3 mb-xl-10">      
												<!--begin::Card widget 2-->
												<div class="card h-lg-100">
													<!--begin::Body-->
													<div class="card-body d-flex justify-content-between align-items-start flex-column">         
														<!--begin::Icon--> 
														<div class="m-0">
																			<i class="ki-duotone ki-abstract-39 fs-2hx text-gray-600"><span class="path1"></span><span class="path2"></span></i>                     
																	
														</div>                           
														<!--end::Icon-->

														<!--begin::Section--> 
														<div class="d-flex flex-column my-7">
															<!--begin::Number-->           
															<span class="fw-semibold fs-3x text-gray-800 lh-1 ls-n2">149M</span> 
															<!--end::Number--> 

															<!--begin::Follower-->
															<div class="m-0">
																					<span class="fw-semibold fs-6 text-gray-400">
																		Stock Value                    </span>  
																
															</div>       
															<!--end::Follower--> 
														</div>  
														<!--end::Section-->          
														
														<!--begin::Badge--> 
														<span class="badge badge-light-danger fs-base">
																			<i class="ki-duotone ki-arrow-down fs-5 text-danger ms-n1"><span class="path1"></span><span class="path2"></span></i>                  
																					
															0.47%
														</span>  
														<!--end::Badge-->                              
													</div>
													<!--end::Body-->
												</div>
												<!--end::Card widget 2-->
											</div>
											<!--end::Col-->

											<!--begin::Col-->
											<div class="col-sm-6 col-xl-3 mb-xl-10">
												<!--begin::Card widget 2-->
												<div class="card h-lg-100">
													<!--begin::Body-->
													<div class="card-body d-flex justify-content-between align-items-start flex-column">         
														<!--begin::Icon--> 
														<div class="m-0">
																			<i class="ki-duotone ki-map fs-2hx text-gray-600"><span class="path1"></span><span class="path2"></span><span class="path3"></span></i>                     
																	
														</div>                           
														<!--end::Icon-->

														<!--begin::Section--> 
														<div class="d-flex flex-column my-7">
															<!--begin::Number-->           
															<span class="fw-semibold fs-3x text-gray-800 lh-1 ls-n2">89M</span> 
															<!--end::Number--> 

															<!--begin::Follower-->
															<div class="m-0">
																					<span class="fw-semibold fs-6 text-gray-400">
																		C APEX                    </span>  
																
															</div>       
															<!--end::Follower--> 
														</div>  
														<!--end::Section-->          
														
														<!--begin::Badge--> 
														<span class="badge badge-light-success fs-base">
																			<i class="ki-duotone ki-arrow-up fs-5 text-success ms-n1"><span class="path1"></span><span class="path2"></span></i> 
																					
															2.1%
														</span>  
														<!--end::Badge-->                              
													</div>
													<!--end::Body-->
												</div>
												<!--end::Card widget 2-->
											</div>
											<!--end::Col-->

											<!--begin::Col-->
											<div class="col-sm-6 col-xl-3 mb-5 mb-xl-10">
												<!--begin::Card widget 2-->
												<div class="card h-lg-100">
													<!--begin::Body-->
													<div class="card-body d-flex justify-content-between align-items-start flex-column">         
														<!--begin::Icon--> 
														<div class="m-0">
																			<i class="ki-duotone ki-abstract-35 fs-2hx text-gray-600"><span class="path1"></span><span class="path2"></span></i>                     
																	
														</div>                           
														<!--end::Icon-->

														<!--begin::Section--> 
														<div class="d-flex flex-column my-7">
															<!--begin::Number-->           
															<span class="fw-semibold fs-3x text-gray-800 lh-1 ls-n2">72.4%</span> 
															<!--end::Number--> 

															<!--begin::Follower-->
															<div class="m-0">
																					<span class="fw-semibold fs-6 text-gray-400">
																		OPEX                    </span>  
																
															</div>       
															<!--end::Follower--> 
														</div>  
														<!--end::Section-->          
														
														<!--begin::Badge--> 
														<span class="badge badge-light-danger fs-base">
																			<i class="ki-duotone ki-arrow-down fs-5 text-danger ms-n1"><span class="path1"></span><span class="path2"></span></i>                  
																					
															0.647%
														</span>  
														<!--end::Badge-->                              
													</div>
													<!--end::Body-->
												</div>
												<!--end::Card widget 2-->
											</div>
											<!--end::Col-->

											<!--begin::Col-->
											<div class="col-sm-6 col-xl-3 mb-5 mb-xl-10">
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
																					<span class="fw-semibold fs-6 text-gray-400">
																		Saving                    </span>  
																
															</div>       
															<!--end::Follower--> 
														</div>  
														<!--end::Section-->          
														
														<!--begin::Badge--> 
														<span class="badge badge-light-success fs-base">
																			<i class="ki-duotone ki-arrow-up fs-5 text-success ms-n1"><span class="path1"></span><span class="path2"></span></i> 
																					
															2.1%
														</span>  
														<!--end::Badge-->                              
													</div>
													<!--end::Body-->
												</div>
												<!--end::Card widget 2-->
											</div>
											<!--end::Col-->
										</div>
									</div>
								</div>
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
											<div class="px-6 pt-7 card-rounded h-150px w-100 card theme-dark-bg-body"  style="background-color: #77dd77">
												<!--begin::Symbol-->
												<div class="symbol symbol-30px me-5 mb-8">
													<span class="symbol-label">
														<i class="ki-duotone ki-user-tick fs-1 text-dark">
															<span class="path1"></span>
															<span class="path2"></span>
														</i>
													</span>
												</div>
												<!--end::Symbol-->
												<!--begin::Stats-->
												<div class="m-0">
													<!--begin::Number-->
													<span class="text-white fw-bolder d-block fs-2x lh-1 ls-n1 mb-1">1689</span>
													<!--end::Number-->
													<!--begin::Desc-->
													<span class="text-white fw-bold fs-7">Aktif</span>
													<!--end::Number-->
													<!--begin::Desc-->
													
													<!--end::Desc-->
												</div>
												<!--end::Stats-->
											</div>
											<!--end::Items-->
										</div>
										<!--end::Col-->

										<!--begin::Col-->
										<div class="col-3">
											<!--begin::Items-->
											<div class="px-6 pt-7 card-rounded h-150px w-100 card theme-dark-bg-body"  style="background-color: #ff6961">
												<!--begin::Symbol-->
												<div class="symbol symbol-30px me-5 mb-8">
													<span class="symbol-label">
														<i class="ki-duotone ki-user fs-1 text-dark">
															<span class="path1"></span>
															<span class="path2"></span>
														</i>
													</span>
												</div>
												<!--end::Symbol-->
												<!--begin::Stats-->
												<div class="m-0">
													<!--begin::Number-->
													<span class="text-white fw-bolder d-block fs-2x lh-1 ls-n1 mb-1">500</span>
													<!--end::Number-->
													<!--begin::Desc-->
													<span class="text-white fw-bold fs-7">Tidak Aktif</span>
													<!--end::Desc-->
												</div>
												<!--end::Stats-->
											</div>
											<!--end::Items-->
										</div>
										<!--end::Col-->

										<!--begin::Col-->
										<div class="col-3">
											<!--begin::Items-->
											<div class="px-6 pt-7 card-rounded h-150px w-100 card theme-dark-bg-body"  style="background-color: #7ec4cf">
												<!--begin::Symbol-->
												<div class="symbol symbol-30px me-5 mb-8">
													<span class="symbol-label">
														<i class="ki-duotone ki-teacher fs-1 text-dark">
															<span class="path1"></span>
															<span class="path2"></span>
															<span class="path3"></span>
														</i>
													</span>
												</div>
												<!--end::Symbol-->
												<!--begin::Stats-->
												<div class="m-0">
													<!--begin::Number-->
													<span class="text-white fw-bolder d-block fs-2x lh-1 ls-n1 mb-1">300</span>
													<!--end::Number-->
													<!--begin::Desc-->
													<span class="text-white fw-semibold fs-7">Graduan</span>
													<!--end::Desc-->
												</div>
												<!--end::Stats-->
											</div>
											<!--end::Items-->
										</div>
										<!--end::Col-->

										<!--begin::Col-->
										<div class="col-3">
											<!--begin::Items-->
											<div class="px-6 pt-7 card-rounded h-150px w-100 card theme-dark-bg-body"  style="background-color: #9cadce">
												<!--begin::Symbol-->
												<div class="symbol symbol-30px me-5 mb-8">
													<span class="symbol-label">
														<i class="ki-duotone ki-book-open fs-1 text-dark">
															<span class="path1"></span>
															<span class="path2"></span>
															<span class="path3"></span>
														</i>
													</span>
												</div>
												<!--end::Symbol-->
												<!--begin::Stats-->
												<div class="m-0">
													<!--begin::Number-->
													<span class="text-white fw-bolder d-block fs-2x lh-1 ls-n1 mb-1">902</span>
													<!--end::Number-->
													<!--begin::Desc-->
													<span class="text-white fw-semibold fs-7">Menyambung Pelajaran</span>
													<!--end::Desc-->
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
											<div class="px-6 pt-7 card-rounded h-150px w-100 card theme-dark-bg-body"  style="background-color: #77dd77">
												<!--begin::Symbol-->
												<div class="symbol symbol-30px me-5 mb-8">
													<span class="symbol-label">
														<i class="ki-duotone ki-user-tick fs-1 text-dark">
															<span class="path1"></span>
															<span class="path2"></span>
														</i>
													</span>
												</div>
												<!--end::Symbol-->
												<!--begin::Stats-->
												<div class="m-0">
													<!--begin::Number-->
													<span class="text-white fw-bolder d-block fs-2x lh-1 ls-n1 mb-1">1689</span>
													<!--end::Number-->
													<!--begin::Desc-->
													<span class="text-white fw-bold fs-7">Aktif</span>
													<!--end::Number-->
													<!--begin::Desc-->
													
													<!--end::Desc-->
												</div>
												<!--end::Stats-->
											</div>
											<!--end::Items-->
										</div>
										<!--end::Col-->

										<!--begin::Col-->
										<div class="col-3">
											<!--begin::Items-->
											<div class="px-6 pt-7 card-rounded h-150px w-100 card theme-dark-bg-body"  style="background-color: #ff6961">
												<!--begin::Symbol-->
												<div class="symbol symbol-30px me-5 mb-8">
													<span class="symbol-label">
														<i class="ki-duotone ki-user fs-1 text-dark">
															<span class="path1"></span>
															<span class="path2"></span>
														</i>
													</span>
												</div>
												<!--end::Symbol-->
												<!--begin::Stats-->
												<div class="m-0">
													<!--begin::Number-->
													<span class="text-white fw-bolder d-block fs-2x lh-1 ls-n1 mb-1">500</span>
													<!--end::Number-->
													<!--begin::Desc-->
													<span class="text-white fw-bold fs-7">Tidak Aktif</span>
													<!--end::Desc-->
												</div>
												<!--end::Stats-->
											</div>
											<!--end::Items-->
										</div>
										<!--end::Col-->

										<!--begin::Col-->
										<div class="col-3">
											<!--begin::Items-->
											<div class="px-6 pt-7 card-rounded h-150px w-100 card theme-dark-bg-body"  style="background-color: #7ec4cf">
												<!--begin::Symbol-->
												<div class="symbol symbol-30px me-5 mb-8">
													<span class="symbol-label">
														<i class="ki-duotone ki-teacher fs-1 text-dark">
															<span class="path1"></span>
															<span class="path2"></span>
															<span class="path3"></span>
														</i>
													</span>
												</div>
												<!--end::Symbol-->
												<!--begin::Stats-->
												<div class="m-0">
													<!--begin::Number-->
													<span class="text-white fw-bolder d-block fs-2x lh-1 ls-n1 mb-1">300</span>
													<!--end::Number-->
													<!--begin::Desc-->
													<span class="text-white fw-semibold fs-7">Graduan</span>
													<!--end::Desc-->
												</div>
												<!--end::Stats-->
											</div>
											<!--end::Items-->
										</div>
										<!--end::Col-->

										<!--begin::Col-->
										<div class="col-3">
											<!--begin::Items-->
											<div class="px-6 pt-7 card-rounded h-150px w-100 card theme-dark-bg-body"  style="background-color: #9cadce">
												<!--begin::Symbol-->
												<div class="symbol symbol-30px me-5 mb-8">
													<span class="symbol-label">
														<i class="ki-duotone ki-book-open fs-1 text-dark">
															<span class="path1"></span>
															<span class="path2"></span>
															<span class="path3"></span>
														</i>
													</span>
												</div>
												<!--end::Symbol-->
												<!--begin::Stats-->
												<div class="m-0">
													<!--begin::Number-->
													<span class="text-white fw-bolder d-block fs-2x lh-1 ls-n1 mb-1">902</span>
													<!--end::Number-->
													<!--begin::Desc-->
													<span class="text-white fw-semibold fs-7">Menyambung Pelajaran</span>
													<!--end::Desc-->
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

	{{-- <!--begin::Row-->
	<div class="row g-5 g-xl-10">
		<!--begin::Col-->
		<div class="col-xl-4 mb-xl-10">
			<!--begin::Lists Widget 19-->
			<div class="card card-flush h-xl-100">
				<!--begin::Heading BKOKU-->
				<div class="card-header rounded bgi-no-repeat bgi-size-cover bgi-position-y-top bgi-position-x-center align-items-start h-250px" style="background-image:url('assets/media/svg/shapes/top-green.png" data-bs-theme="light">
					<!--begin::Title-->
					<h3 class="card-title align-items-start flex-column text-white pt-15">
						<span class="fw-bold fs-2x mb-3">Permohonan BKOKU</span>	
					</h3>
					<!--end::Title-->
				</div>
				<!--end::Heading-->

				<!--begin::Body-->
				<div class="card-body mt-n20">
					<!--begin::Stats-->
					<div class="mt-n20 position-relative">
						<!--begin::Row-->
						<div class="row g-3 g-lg-6">
							<!--begin::Col-->
							<div class="col-6">
								<!--begin::Items-->
								<div class="px-6 pt-7 card-rounded h-150px w-100 card theme-dark-bg-body"  style="background-color: #77dd77">
									<!--begin::Symbol-->
									<div class="symbol symbol-30px me-5 mb-8">
										<span class="symbol-label">
											<i class="ki-duotone ki-user-tick fs-1 text-dark">
												<span class="path1"></span>
												<span class="path2"></span>
											</i>
										</span>
									</div>
									<!--end::Symbol-->
									<!--begin::Stats-->
									<div class="m-0">
										<!--begin::Number-->
										<span class="text-white fw-bolder d-block fs-2x lh-1 ls-n1 mb-1">1689</span>
										<!--end::Number-->
										<!--begin::Desc-->
										<span class="text-white fw-bold fs-7">Aktif</span>
										<!--end::Number-->
										<!--begin::Desc-->
										
										<!--end::Desc-->
									</div>
									<!--end::Stats-->
								</div>
								<!--end::Items-->
							</div>
							<!--end::Col-->
							<!--begin::Col-->
							<div class="col-6">
								<!--begin::Items-->
								<div class="px-6 pt-7 card-rounded h-150px w-100 card theme-dark-bg-body"  style="background-color: #ff6961">
									<!--begin::Symbol-->
									<div class="symbol symbol-30px me-5 mb-8">
										<span class="symbol-label">
											<i class="ki-duotone ki-user fs-1 text-dark">
												<span class="path1"></span>
												<span class="path2"></span>
											</i>
										</span>
									</div>
									<!--end::Symbol-->
									<!--begin::Stats-->
									<div class="m-0">
										<!--begin::Number-->
										<span class="text-white fw-bolder d-block fs-2x lh-1 ls-n1 mb-1">300</span>
										<!--end::Number-->
										<!--begin::Desc-->
										<span class="text-white fw-bold fs-7">Tidak Aktif</span>
										<!--end::Desc-->
									</div>
									<!--end::Stats-->
								</div>
								<!--end::Items-->
							</div>
							<!--end::Col-->
							<!--begin::Col-->
							<div class="col-6">
								<!--begin::Items-->
								<div class="px-6 pt-7 card-rounded h-150px w-100 card theme-dark-bg-body"  style="background-color: #7ec4cf">
									<!--begin::Symbol-->
									<div class="symbol symbol-30px me-5 mb-8">
										<span class="symbol-label">
											<i class="ki-duotone ki-teacher fs-1 text-dark">
												<span class="path1"></span>
												<span class="path2"></span>
												<span class="path3"></span>
											</i>
										</span>
									</div>
									<!--end::Symbol-->
									<!--begin::Stats-->
									<div class="m-0">
										<!--begin::Number-->
										<span class="text-white fw-bolder d-block fs-2x lh-1 ls-n1 mb-1">470</span>
										<!--end::Number-->
										<!--begin::Desc-->
										<span class="text-white fw-semibold fs-7">Graduan</span>
										<!--end::Desc-->
									</div>
									<!--end::Stats-->
								</div>
								<!--end::Items-->
							</div>
							<!--end::Col-->
							<!--begin::Col-->
							<div class="col-6">
								<!--begin::Items-->
								<div class="px-6 pt-7 card-rounded h-150px w-100 card theme-dark-bg-body"  style="background-color: #9cadce">
									<!--begin::Symbol-->
									<div class="symbol symbol-30px me-5 mb-8">
										<span class="symbol-label">
											<i class="ki-duotone ki-book-open fs-1 text-dark">
												<span class="path1"></span>
												<span class="path2"></span>
												<span class="path3"></span>
											</i>
										</span>
									</div>
									<!--end::Symbol-->
									<!--begin::Stats-->
									<div class="m-0">
										<!--begin::Number-->
										<span class="text-white fw-bolder d-block fs-2x lh-1 ls-n1 mb-1">822</span>
										<!--end::Number-->
										<!--begin::Desc-->
										<span class="text-white fw-semibold fs-7">Menyambung Pelajaran</span>
										<!--end::Desc-->
									</div>
									<!--end::Stats-->
								</div>
								<!--end::Items-->
							</div>
							<!--end::Col-->
						</div>
						<!--end::Row-->
					</div>
					<!--end::Stats-->
				</div>
				<!--end::Body-->
			</div>
			<!--end::Lists Widget 19-->
			
		</div>
		<!--begin::Row-->

		<!--begin::Col-->
			<!--begin::Col-->
			<div class="col-xl-4 mb-xl-10">
			<!--begin::Lists Widget 19-->
			<div class="card card-flush h-xl-100">
				<!--begin::Heading-->
				<div class="card-header rounded bgi-no-repeat bgi-size-cover bgi-position-y-top bgi-position-x-center align-items-start h-250px" style="background-image:url('assets/media/svg/shapes/top-green.png" data-bs-theme="light">
					<!--begin::Title-->
					<h3 class="card-title align-items-start flex-column text-white pt-15">
						<span class="fw-bold fs-2x mb-3">Permohonan PPK</span>
						
					</h3>
					<!--end::Title-->
					<!--begin::Toolbar-->
					
					<!--end::Toolbar-->
				</div>
				<!--end::Heading-->
				<!--begin::Body-->
				<div class="card-body mt-n20">
					<!--begin::Stats-->
					<div class="mt-n20 position-relative">
						<!--begin::Row-->
						<div class="row g-3 g-lg-6">
							<!--begin::Col-->
							<div class="col-6">
								<!--begin::Items-->
								<div class="px-6 pt-7 card-rounded h-150px w-100 card theme-dark-bg-body"  style="background-color: #77dd77">
									<!--begin::Symbol-->
									<div class="symbol symbol-30px me-5 mb-8">
										<span class="symbol-label">
											<i class="ki-duotone ki-user-tick fs-1 text-dark">
												<span class="path1"></span>
												<span class="path2"></span>
											</i>
										</span>
									</div>
									<!--end::Symbol-->
									<!--begin::Stats-->
									<div class="m-0">
										<!--begin::Number-->
										<span class="text-white fw-bolder d-block fs-2x lh-1 ls-n1 mb-1">1689</span>
										<!--end::Number-->
										<!--begin::Desc-->
										<span class="text-white fw-bold fs-7">Aktif</span>
										<!--end::Number-->
										<!--begin::Desc-->
										
										<!--end::Desc-->
									</div>
									<!--end::Stats-->
								</div>
								<!--end::Items-->
							</div>
							<!--end::Col-->
							<!--begin::Col-->
							<div class="col-6">
								<!--begin::Items-->
								<div class="px-6 pt-7 card-rounded h-150px w-100 card theme-dark-bg-body"  style="background-color: #ff6961">
									<!--begin::Symbol-->
									<div class="symbol symbol-30px me-5 mb-8">
										<span class="symbol-label">
											<i class="ki-duotone ki-user fs-1 text-dark">
												<span class="path1"></span>
												<span class="path2"></span>
											</i>
										</span>
									</div>
									<!--end::Symbol-->
									<!--begin::Stats-->
									<div class="m-0">
										<!--begin::Number-->
										<span class="text-white fw-bolder d-block fs-2x lh-1 ls-n1 mb-1">500</span>
										<!--end::Number-->
										<!--begin::Desc-->
										<span class="text-white fw-bold fs-7">Tidak Aktif</span>
										<!--end::Desc-->
									</div>
									<!--end::Stats-->
								</div>
								<!--end::Items-->
							</div>
							<!--end::Col-->
							<!--begin::Col-->
							<div class="col-6">
								<!--begin::Items-->
								<div class="px-6 pt-7 card-rounded h-150px w-100 card theme-dark-bg-body"  style="background-color: #7ec4cf">
									<!--begin::Symbol-->
									<div class="symbol symbol-30px me-5 mb-8">
										<span class="symbol-label">
											<i class="ki-duotone ki-teacher fs-1 text-dark">
												<span class="path1"></span>
												<span class="path2"></span>
												<span class="path3"></span>
											</i>
										</span>
									</div>
									<!--end::Symbol-->
									<!--begin::Stats-->
									<div class="m-0">
										<!--begin::Number-->
										<span class="text-white fw-bolder d-block fs-2x lh-1 ls-n1 mb-1">300</span>
										<!--end::Number-->
										<!--begin::Desc-->
										<span class="text-white fw-semibold fs-7">Graduan</span>
										<!--end::Desc-->
									</div>
									<!--end::Stats-->
								</div>
								<!--end::Items-->
							</div>
							<!--end::Col-->
							<!--begin::Col-->
							<div class="col-6">
								<!--begin::Items-->
								<div class="px-6 pt-7 card-rounded h-150px w-100 card theme-dark-bg-body"  style="background-color: #9cadce">
									<!--begin::Symbol-->
									<div class="symbol symbol-30px me-5 mb-8">
										<span class="symbol-label">
											<i class="ki-duotone ki-book-open fs-1 text-dark">
												<span class="path1"></span>
												<span class="path2"></span>
												<span class="path3"></span>
											</i>
										</span>
									</div>
									<!--end::Symbol-->
									<!--begin::Stats-->
									<div class="m-0">
										<!--begin::Number-->
										<span class="text-white fw-bolder d-block fs-2x lh-1 ls-n1 mb-1">902</span>
										<!--end::Number-->
										<!--begin::Desc-->
										<span class="text-white fw-semibold fs-7">Menyambung Pelajaran</span>
										<!--end::Desc-->
									</div>
									<!--end::Stats-->
								</div>
								<!--end::Items-->
							</div>
							<!--end::Col-->
						</div>
						<!--end::Row-->
					</div>
					<!--end::Stats-->
				</div>
				<!--end::Body-->
			</div>
			<!--end::Lists Widget 19-->
			
		</div>
			
		</div>
	</div>										 --}}


</x-default-layout>

<x-default-layout> 
	<!--begin::Page title-->
<div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
	<!--begin::Title-->
	<h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Utama</h1>
	<!--end::Title-->
	<!--begin::Breadcrumb-->
	<ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
		<!--begin::Item-->
		<li class="breadcrumb-item text-muted">
			<a href="/" class="text-dark text-hover-primary" style="color:darkblue">Laman Utama</a>
		</li>
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
    <!--begin::Row-->
         <div class="row g-5 g-xl-8"> 
         <div class="col-xl-4">
									<!--begin::Mixed Widget 12-->
									<div class="card card-l-stretch mb-5 mb-xl-8">
									<div class="card-body p-0">
													<!--begin::Header-->
													<div class="px-9 pt-7 card-rounded h-275px w-100 card theme-dark-bg-body"  style="background-color: #32CD32">
														<!--begin::Heading-->
														<div class="d-flex flex-stack">
															<h3 class="m-0 text-white fw-bold fs-2">Permohonan</h3>															
														</div>
														<div class="d-flex text-center flex-column text-white pt-8">
															<span class="fw-semibold fs-5">Status</span>
															@foreach ($status as $status)
															<span class="fw-bold fs-2x pt-1">{{$status->status}}</span>
															@endforeach
														</div>
													</div>
													<div class="bg-body shadow-sm card-rounded mx-9 mb-9 px-6 py-9 position-relative z-index-1" style="margin-top: -125px">
														<div class="d-flex align-items-center mb-6">
															<div class="symbol symbol-45px w-40px me-5">
																<span class="symbol-label theme-dark-bg-body"  style="background-color: #50C878">
																<span class="menu-icon">{!! getIcon('document', 'fs-2qx') !!}</span>
																</span>
															</div>
															<div class="d-flex align-items-center flex-wrap w-100">
																<div class="mb-1 pe-3 flex-grow-1">
																	<a href="#" class="fs-5 text-gray-800 text-hover-primary fw-bold">Sesi Pengajian</a>
																	<div class="fs-5 text-gray-400 fw-bold">2023/2024</div>
																</div>
															</div>
														</div>
														<div class="d-flex align-items-center mb-6">
															<div class="symbol symbol-45px w-40px me-5">
																<span class="symbol-label theme-dark-bg-body"  style="background-color: #50C878">
																<span class="menu-icon">{!! getIcon('calendar', 'fs-2qx') !!}</span>
																</span>
															</div>
															<div class="d-flex align-items-center flex-wrap w-100">
																<div class="mb-1 pe-3 flex-grow-1">
																	<a href="#" class="fs-5 text-gray-800 text-hover-primary fw-bold">Semester Pengajian</a>
																	@foreach ($akademik as $akademik)
																	<div class="fs-5 text-gray-400 fw-bold">{{$akademik->sem_semasa}}</div>
																	@endforeach	
																</div>
															</div>	
														</div>
														<div class="d-flex align-items-center mb-6">
															<div class="symbol symbol-45px w-40px me-5">
																<span class="symbol-label theme-dark-bg-body"  style="background-color: #50C878">
																<span class="menu-icon">{!! getIcon('book-square', 'fs-2qx') !!}</span>
																</span>
															</div>
															<div class="d-flex align-items-center flex-wrap w-100">
																<div class="mb-1 pe-3 flex-grow-1">
																	<a href="#" class="fs-5 text-gray-800 text-hover-primary fw-bold">Perbaharui Permohonan</a>
																
																</div>
															</div>
														</div>
														<div class="d-flex align-items-center mb-6">
															<div class="symbol symbol-45px w-40px me-5">
																<span class="symbol-label theme-dark-bg-body"  style="background-color: #50C878">
																<span class="menu-icon">{!! getIcon('notepad', 'fs-2qx') !!}</span>
																<!-- <i class="ki-outline ki-notepad text-info fs-2qx"></i> -->
																</span>
															</div>
															<div class="d-flex align-items-center flex-wrap w-100">
																<div class="mb-1 pe-3 flex-grow-1">
																	<a href="#" class="fs-5 text-gray-800 text-hover-primary fw-bold">Sejarah Permohonan</a>
																
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
										<div class="col-xl-4">
											<!--begin::Mixed Widget 1-->
											<div class="card card-l-stretch mb-5 mb-xl-8">
												<!--begin::Body-->
												<div class="card-body p-0">
													<!--begin::Header-->
													<div class="px-9 pt-7 card-rounded h-275px w-100 card theme-dark-bg-body"  style="background-color: #78cdd7">
														<!--begin::Heading-->
														<div class="d-flex flex-stack">
															<h3 class="m-0 text-white fw-bold fs-2">Tuntutan</h3>
														</div>
														<!--end::Heading-->
														<!--begin::Balance-->
														<div class="d-flex text-center flex-column text-white pt-8">
															<span class="fw-semibold fs-5">Status</span>
															
															<span class="fw-bold fs-2x pt-1"></span>
															
														</div>
														<!--end::Balance-->
													</div>
													<div class="bg-body shadow-sm card-rounded mx-9 mb-9 px-6 py-9 position-relative z-index-1" style="margin-top: -125px">
														<!--begin::Item-->
														<div class="d-flex align-items-center mb-6">
															<!--begin::Symbol-->
															<div class="symbol symbol-45px w-40px me-5">
																<span class="symbol-label theme-dark-bg-body"  style="background-color: #44a1a0">
																<span class="menu-icon">{!! getIcon('status', 'fs-2qx') !!}</span>
																</span>
															</div>
															<!--end::Symbol-->
															<!--begin::Description-->
															<div class="d-flex align-items-center flex-wrap w-100">
																<!--begin::Title-->
																<div class="mb-1 pe-3 flex-grow-1">
																	<a href="#" class="fs-5 text-gray-800 text-hover-primary fw-bold">Status Tuntutan (Terkini)</a>
																	
																	<div class="fs-5 text-gray-400 fw-bold"></div>
																	
																	
																</div>
																<!--end::Title-->
															</div>
															<!--end::Description-->
														</div>
														<!--end::Item-->
														<!--begin::Item-->
														<div class="d-flex align-items-center mb-6">
															<!--begin::Symbol-->
															<div class="symbol symbol-45px w-40px me-5">
																<span class="symbol-label theme-dark-bg-body"  style="background-color: #44a1a0">
																<span class="menu-icon">{!! getIcon('calendar', 'fs-2qx') !!}</span>
																</span>
															</div>
															<!--end::Symbol-->
															<!--begin::Description-->
															<div class="d-flex align-items-center flex-wrap w-100">
																<!--begin::Title-->
																<div class="mb-1 pe-3 flex-grow-1">
																	<a href="#" class="fs-5 text-gray-800 text-hover-primary fw-bold">Tarikh Tuntutan (Dibuat)</a>
																	
																	<div class="fs-5 text-gray-400 fw-bold"></div>
																	
																</div>
																<!--end::Title-->
															</div>
															<!--end::Description-->
														</div>
														<div class="d-flex align-items-center mb-6">
															<div class="symbol symbol-45px w-40px me-5">
																<span class="symbol-label theme-dark-bg-body"  style="background-color: #44a1a0">
																<span class="menu-icon">{!! getIcon('notepad-edit', 'fs-2qx') !!}</span>
																</span>
															</div>
															<div class="d-flex align-items-center flex-wrap w-100">
																<div class="mb-1 pe-3 flex-grow-1">
																	<a href="#" class="fs-5 text-gray-800 text-hover-primary fw-bold">Kemaskini Tuntutan</a>
																	<!-- <div class="fs-5 text-gray-400 fw-bold">2022/2023</div> -->
																</div>
															</div>
														</div>
														<div class="d-flex align-items-center mb-6">
															<div class="symbol symbol-45px w-40px me-5">
																<span class="symbol-label theme-dark-bg-body"  style="background-color: #44a1a0">
																<span class="menu-icon">{!! getIcon('notepad', 'fs-2qx') !!}</span>
																</span>
															</div>
															<div class="d-flex align-items-center flex-wrap w-100">
																<div class="mb-1 pe-3 flex-grow-1">
																	<a href="#" class="fs-5 text-gray-800 text-hover-primary fw-bold">Sejarah Tuntutan</a>
																	<!-- <div class="fs-5 text-gray-400 fw-bold">2022/2023</div> -->
																</div>
															</div>
														</div>
														
													</div>
													<!--end::Items-->
												</div>
											<!--end::Stats-->
</div>
</div>

										<div class="col-xl-4">
											<!--begin::Statistics Widget 5-->
											<!-- <a href="#" class="card card-xl-stretch mb-5 mb-xl-8 theme-dark-bg-body"  style="background-color: #CBD4F4"> -->
											<a href="#" class="card theme-dark-bg-body"  style="background-color: #0d5c63">	
											<!--begin::Body-->
												<div class="card-body d-flex flex-column">
													<i class="ki-duotone ki-menu text-white fs-2qx ms-n1">
														<span class="path1"></span>
														<span class="path2"></span>
														<span class="path3"></span>
														<span class="path4"></span>
													</i>
													<div class="text-white fw-bold fs-2 mb-2 mt-5">Program Permohonan</div>
													@foreach ($tuntutanpermohonan as $tuntutanpermohonan)
													<div class="fw-semibold text-white">{{$tuntutanpermohonan->program}}</div>
													@endforeach	
												</div>
												<!--end::Body-->
											</a>
											<!--end::Statistics Widget 5-->
											<br>
											<!--begin::Statistics Widget 5-->
											<a href="#" class="card theme-dark-bg-body"  style="background-color: #0d5c63">
												<!--begin::Body-->
												<div class="card-body">
												<span class="menu-icon">{!! getIcon('teacher', 'fs-2x') !!}</span>
													<div class="text-white fw-bold fs-2 mb-2 mt-5">Peringkat Pengajian</div>
													@foreach ($sem as $sem)
													<div class="fw-semibold text-white">{{$sem->peringkat}}</div>
													@endforeach	
												</div>
												<!--end::Body-->
											</a>
											<!--end::Statistics Widget 5-->
											<br>
											<!--begin::Statistics Widget 5-->
											<a href="#" class="card theme-dark-bg-body"  style="background-color: #0d5c63">
												<!--begin::Body-->
												<div class="card-body">
												<span class="menu-icon">{!! getIcon('calendar', 'fs-2x') !!}</span>
													<div class="text-white fw-bold fs-2 mb-2 mt-5">Tempoh Penajaan</div>
													
													<div class="fw-semibold text-white"></div>
														
												</div>
												<!--end::Body-->
											</a>
											<!--end::Statistics Widget 5-->
										</div>
									</div>
</div>
									<!--end::Row-->
									<!--begin::Row-->
									
									<!--end::Row-->
									<!--begin::Row-->
</x-default-layout>

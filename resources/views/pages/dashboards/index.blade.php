<x-default-layout> 
<head>
   
   <!-- MAIN CSS -->
   <link rel="stylesheet" href="/assets/css/saringan.css">
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
   <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
   <script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js"></script>
   </head>
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
   <br>
<div id="kt_app_content" class="app-content flex-column-fluid">
								
								<div id="kt_app_content_container" class="app-container container-xxl">
									<!--begin::Layout-->
									<div class="d-flex flex-column flex-xl-row">
										<!--begin::Sidebar-->
										<div class="flex-column flex-lg-row-auto w-100 w-xl-350px mb-10">
											<!--begin::Card-->
											<div class="card mb-5 mb-xl-8">
												<!--begin::Card body-->
												<div class="card-body pt-15">
													<!--begin::Summary-->
													<div class="d-flex flex-center flex-column mb-5">
														<!--begin::Avatar-->
														<div class="symbol symbol-150px symbol-circle mb-7">
															<!-- <img src="assets/media/avatars/300-1.jpg" alt="image" /> -->
															<?php
																// $profile_picture = "";
																// if(Auth::user()->profile_photo_path !== null){
																// 	$profile_picture = Auth::user()->profile_photo_path;
																// }else{
																// 	$profile_picture = "default.jpg";
																// }
																// $img_path = "storage/app/public/profile_photo_path/".$profile_picture;
																// dd($img_path);
															?>
															@if(Auth::user()->profile_photo_path !== null)
															@foreach($user as $user1)
															<img class="image rounded-circle" src="assets/profile_photo_path/{{$user1->profile_photo_path}}" alt="profile_image" style="width: 80px;height: 80px; padding: 10px; margin: 0px; ">
															@endforeach
															@else
															<img class="image rounded-circle" src="assets/profile_photo_path/default.png" alt="profile_image" style="width: 80px;height: 80px; padding: 10px; margin: 0px; ">
															@endif
														</div>
														<!--end::Avatar-->
														<!--begin::Name-->
														@if(!empty($pelajar))
														<a href="#" class="fs-3 text-gray-800 text-dark fw-bold mb-1" style="text-align:center">{{$pelajar->nama_pelajar}}</a>
														@else
														@foreach($user as $user1)
														<a href="#" class="fs-3 text-gray-800 text-dark fw-bold mb-1" style="text-align:center">{{$user1->nama}}</a>
														@endforeach	
														@endif
														<!--end::Name-->
														<!--begin::Email-->
														@if(!empty($pelajar))

														<a href="#" class="fs-5 fw-semibold text-muted mb-6">{{$pelajar->emel}}</a>
														@else
														@foreach($user as $user1)
														<a href="#" class="fs-5 fw-semibold text-muted mb-6">{{$user1->email}}</a>
														@endforeach
														@endif

														<!--end::Email-->
													</div>
													<!--end::Summary-->
													<!--begin::Details toggle-->
													<div class="d-flex flex-stack fs-4 py-3">
														<div class="fw-bold">Maklumat Pelajar</div>
														<!--begin::Badge-->
														<!-- <div class="badge badge-light-info d-inline">Premium user</div> -->
														<!--begin::Badge-->
													</div>
													<!--end::Details toggle-->
													<div class="separator separator-dashed my-3"></div>
													<!--begin::Details content-->
													<div class="pb-5 fs-6">
														<!--begin::Details item-->
														{{-- <div class="fw-bold mt-5">No Matrik</div>
														<div class="text-gray-600">{{$akademik->no_pendaftaranpelajar}}</div> --}}
														<!--begin::Details item-->
														<!--begin::Details item-->
														<div class="fw-bold mt-5">Alamat Emel</div>
														<div class="text-gray-600">
															@if(!empty($pelajar))
															<a href="#" class="text-gray-600 text-hover-primary">{{$pelajar->emel}}</a>
															@else
															@foreach($user as $user1)
															<a href="#" class="text-gray-600 text-hover-primary">{{$user1->email}}</a>
															@endforeach
															@endif
														</div>
														<!--begin::Details item-->
														<!--begin::Details item-->
														<div class="fw-bold mt-5">Nama Kursus</div>
														<div class="text-gray-600">{{$akademik->nama_kursus}}</div>
														{{-- <div class="fw-bold mt-5">Mod Pengajian</div> --}}
														{{-- @if(!empty($modpengajian))
														<div class="text-gray-600">{{$modpengajian->mod}}
														@else
														<div class="text-gray-600">No data

														@endif --}}
														{{-- </div> --}}
														<!--begin::Details item-->
														<!--begin::Details item-->
														
														<!--begin::Details item-->
														<!--begin::Details item-->
														<!-- <div class="fw-bold mt-5">Latest Transaction</div>
														<div class="text-gray-600">
															<a href="../../demo1/dist/apps/ecommerce/sales/details.html" class="text-gray-600 text-hover-primary">#14534</a>
														</div> -->
														<!--begin::Details item-->
													</div>
													<!--end::Details content-->
												</div>
												<!--end::Card body-->
											</div>
											<!--end::Card-->
										</div>
										<!--end::Sidebar-->
										<!--begin::Content-->
										<div class="flex-lg-row-fluid ms-lg-15">
											<!--begin:::Tabs-->
											<ul class="nav nav-custom nav-tabs nav-line-tabs nav-line-tabs-2x border-0 fs-4 fw-semibold mb-8">
												<!--begin:::Tab item-->
												<li class="nav-item">
													<a class="nav-link text-active-primary pb-4 active" data-bs-toggle="tab" href="#kt_ecommerce_customer_overview">Permohonan</a>
												</li>
												<!--end:::Tab item-->
												<!--begin:::Tab item-->
												<li class="nav-item">
													<a class="nav-link text-active-primary pb-4" data-bs-toggle="tab" href="#kt_ecommerce_customer_general">Tuntutan</a>
												</li>
												
											</ul>
											<!--end:::Tabs-->
											<!--begin:::Tab content-->
											<div class="tab-content" id="myTabContent">
												<!--begin:::Tab pane-->
												<div class="tab-pane fade show active" id="kt_ecommerce_customer_overview" role="tabpanel">
													
													<!--begin::Card-->
													<div class="card pt-4 mb-6 mb-xl-9">
														<!--begin::Card header-->
														@if (session('message'))
														<div class="alert alert-success" style="color:black; text-align: center;">{{ session('message') }}</div>
													@endif

														<div class="card-header border-0">
															<!--begin::Card title-->
															<div class="card-title">
																<h2>Sejarah Permohonan</h2>
															</div>
															<!--end::Card title-->
														</div>
														<!--end::Card header-->
														<!--begin::Card body-->
														<div class="body">
															<!--begin::Table-->
															<div class="table-responsive">
	<table id="sortTable2" class="table table-striped table-hover dataTable js-exportable">
		<thead>
			<tr>
				<th>ID Permohonan</th>
				<th>Status</th>
				<th>Tarikh Kemaskini</th>
				{{--<th>Tindakan</th>--}}
				
			</tr>
		</thead>
		<tbody>
		@foreach($permohonan as $permohonan)
		<tr> 
			<td>{{$permohonan->id_permohonan}}</td>
			<td>{{ucwords(strtolower($permohonan->status))}}</td>
			<td>{{$permohonan->created_at->format('d/m/Y h:i:sa')}}</td>
			{{--<td><a href="{{ route('delete',  $permohonan->nokp_pelajar) }}" class="btn btn-primary">Batal</a> </td>--}}
			
			
		</tr>
		@endforeach
		</tbody>
	</table>
</div>
															<!--end::Table-->
														</div>
														<!--end::Card body-->
													</div>
													<!--end::Card-->
												</div>
												<!--end:::Tab pane-->
												<!--begin:::Tab pane-->
												<div class="tab-pane fade" id="kt_ecommerce_customer_general" role="tabpanel">
													<!--begin::Card-->
													<div class="card pt-4 mb-6 mb-xl-9">
														@if (session('message'))
														<div class="alert alert-success" style="color:black; text-align: center;">{{ session('message') }}</div>
													@endif
														<!--begin::Card header-->
														<div class="card-header border-0">
															<!--begin::Card title-->
															<div class="card-title">
																<h2>Sejarah Tuntutan</h2>
															</div>
															<!--end::Card title-->
														</div>
														<div class="body">
															<div class="table-responsive">
														<table id="sortTable2" class="table table-striped table-hover dataTable js-exportable">
															<thead>
														<tr class="fw-semibold fs-6 text-gray-700 border-bottom border-gray-200">
															<th>Id Tuntutan</th>
															{{-- <th>Semester</th> --}}
															<th>Jenis Yuran</th>
															<th>No resit</th>
															<th>Perihal</th>
															<th>Amaun</th>
															<th>Salinan</th>
														</tr>
														</thead>
														<tbody class="fw-semibold text-gray-600">
															@foreach ($tuntutan as $tuntutan)
															<tr>
																<td>{{ $tuntutan->id_tuntutan}}</td>
																{{-- <td>{{ $tuntutan->semester}}</td> --}}
																<td>{{ $tuntutan->yuran}}</td>
																<td>{{ $tuntutan->no_resit}}</td>
																<td>{{ $tuntutan->nota_resit}}</td>
																<td>RM{{ $tuntutan->amaun}}</td>
																<td><a href="/assets/dokumen/tuntutan/{{$tuntutan->resit}}" target="_blank">Papar</a></td>
																
															</tr>
															@endforeach	
														</tbody>
														</table>

													</div>		
													</div>
												</div>
													
											</div>
										
										</div>


</x-default-layout>

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
														<div class="fw-bold mt-5">No Matrik</div>
														<div class="text-gray-600">{{$akademik->no_pendaftaranpelajar}}</div>
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
			<td>{{$permohonan->status}} </td>
			<td>{{$permohonan->created_at->format('d/m/Y')}}</td>
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
														<!--begin::Card header-->
														<div class="card-header border-0">
															<!--begin::Card title-->
															<div class="card-title">
																<h2>Profil</h2>
															</div>
															<!--end::Card title-->
														</div>
														<!--end::Card header-->
														<!--begin::Card body-->
														<div class="card-body pt-0 pb-5">
															<!--begin::Form-->
															{{-- 147 line start store --}}
															<!-- <form class="form" action="#" id="kt_ecommerce_customer_profile"> -->
															{{-- <form action="{{route('dashboard.store')}}" method="POST" enctype="multipart/form-data"> --}}
																<!--begin::Input group-->
																@csrf
																<div class="mb-7">
																	<!--begin::Label-->
																	<label class="fs-6 fw-semibold mb-2">
																		<span>Update Avatar</span>
																		<span class="ms-1" data-bs-toggle="tooltip" title="Allowed file types: png, jpg, jpeg.">
																			<i class="ki-duotone ki-information fs-7">
																				<span class="path1"></span>
																				<span class="path2"></span>
																				<span class="path3"></span>
																			</i>
																		</span>
																	</label>
																	<!--end::Label-->
																	<!--begin::Image input wrapper-->
																	@foreach($user as $user)
																	<div class="mt-1">
																		<!--begin::Image input placeholder-->
																		<style>.image-input-placeholder { background-image: url('assets/media/svg/files/blank-image.svg'); } [data-bs-theme="dark"] .image-input-placeholder { background-image: url('assets/media/svg/files/blank-image-dark.svg'); }</style>
																		<!--end::Image input placeholder-->
																		<!--begin::Image input-->
																		<div class="image-input image-input-outline image-input-placeholder" data-kt-image-input="true">
																			<!--begin::Preview existing avatar-->
																			<div class="image-input-wrapper w-125px h-125px" style="background-image: url('assets/profile_photo_path/{{$user->profile_photo_path}}')"></div>
																			<!--end::Preview existing avatar-->
																			<!--begin::Edit-->
																			<label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="change" data-bs-toggle="tooltip" title="Change avatar">
																				<i class="ki-duotone ki-pencil fs-7">
																					<span class="path1"></span>
																					<span class="path2"></span>
																				</i>
																				<!--begin::Inputs-->
																				
																				<input type="file" name="profile_photo_path" accept=".png, .jpg, .jpeg" />
																				<input type="hidden" name="avatar_remove" />
																				<!-- </form> -->
																				<!--end::Inputs-->
																			</label>
																			<!--end::Edit-->
																			<!--begin::Cancel-->
																			<span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="cancel" data-bs-toggle="tooltip" title="Cancel avatar">
																				<i class="ki-duotone ki-cross fs-2">
																					<span class="path1"></span>
																					<span class="path2"></span>
																				</i>
																			</span>
																			<!--end::Cancel-->
																			<!--begin::Remove-->
																			<span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="remove" data-bs-toggle="tooltip" title="Remove avatar">
																				<i class="ki-duotone ki-cross fs-2">
																					<span class="path1"></span>
																					<span class="path2"></span>
																				</i>
																			</span>
																			<!--end::Remove-->
																		</div>
																		@endforeach	
																		<!--end::Image input-->
																	</div>
																	<!--end::Image input wrapper-->
																</div>
																<!--end::Input group-->
																<!--begin::Input group-->
																<div class="fv-row mb-7">
																	<!--begin::Label-->
																	<label class="fs-6 fw-semibold mb-2 required">Nama Pelajar</label>
																	<!--end::Label-->
																	<!--begin::Input-->
																	<input type="text" class="form-control form-control-solid" placeholder="" name="name" value="{{ $user->nama}}" />
																	<!--end::Input-->
																</div>
																<!--end::Input group-->
																<!--begin::Row-->
																<div class="row row-cols-1 row-cols-md-2">
																	<!--begin::Col-->
																	<div class="col">
																		<!--begin::Input group-->
																		<div class="fv-row mb-7">
																			<!--begin::Label-->
																			<label class="fs-6 fw-semibold mb-2">
																				<span class="required">Emel</span>
																				<span class="ms-1" data-bs-toggle="tooltip" title="Email address must be active">
																					<i class="ki-duotone ki-information fs-7">
																						<span class="path1"></span>
																						<span class="path2"></span>
																						<span class="path3"></span>
																					</i>
																				</span>
																			</label>
																			<!--end::Label-->
																			<!--begin::Input-->
																			<input type="email" class="form-control form-control-solid" placeholder="" name="email" value="{{ $user->email}}" />
																			<!--end::Input-->
																		</div>
																		<!--end::Input group-->
																	</div>
																	<!--end::Col-->
																	
																</div>
																
													</div>
													<!--end::Card-->
													<!--begin::Card-->
													<div class="card pt-4 mb-6 mb-xl-9">
														<!--begin::Card header-->
														<div class="card-header border-0">
															<!--begin::Card title-->
															<div class="card-title">
																<h2>Address Book</h2>
															</div>
															<!--end::Card title-->
															<!--begin::Card toolbar-->
															<div class="card-toolbar">
																<a href="#" class="btn btn-sm btn-flex btn-light-primary" data-bs-toggle="modal" data-bs-target="#kt_modal_add_address">
																<i class="ki-duotone ki-plus-square fs-3">
																	<span class="path1"></span>
																	<span class="path2"></span>
																	<span class="path3"></span>
																</i>Add new address</a>
															</div>
															<!--end::Card toolbar-->
														</div>
														<!--end::Card header-->
														<!--begin::Card body-->
														<div id="kt_ecommerce_customer_addresses" class="card-body pt-0 pb-5">
															<div class="accordion accordion-icon-toggle" id="kt_ecommerce_customer_addresses_accordion">
																<!--begin::Addresses-->
																<!--begin::Address-->
																<div class="py-0">
																	<!--begin::Header-->
																	<div class="py-3 d-flex flex-stack flex-wrap">
																		<!--begin::Toggle-->
																		<div class="accordion-header d-flex align-items-center collapsible collapsed rotate" data-bs-toggle="collapse" href="#kt_ecommerce_customer_addresses_1" role="button" aria-expanded="false" aria-controls="kt_customer_view_payment_method_1">
																			<!--begin::Arrow-->
																			<div class="accordion-icon me-3">
																				<i class="ki-duotone ki-right fs-4"></i>
																			</div>
																			<!--end::Arrow-->
																			<!--begin::Summary-->
																			<div class="me-3">
																				<div class="d-flex align-items-center">
																					<div class="fs-4 fw-bold">Home</div>
																					<div class="badge badge-light-primary ms-5">Default Address</div>
																				</div>
																				<div class="text-muted">101 Collin Street</div>
																			</div>
																			<!--end::Summary-->
																		</div>
																		<!--end::Toggle-->
																		<!--begin::Toolbar-->
																		<div class="d-flex my-3 ms-9">
																			<!--begin::Edit-->
																			<a href="#" class="btn btn-icon btn-active-light-primary w-30px h-30px me-3" data-bs-toggle="modal" data-bs-target="#kt_modal_update_address">
																				<span data-bs-toggle="tooltip" data-bs-trigger="hover" title="Edit">
																					<i class="ki-duotone ki-pencil fs-3">
																						<span class="path1"></span>
																						<span class="path2"></span>
																					</i>
																				</span>
																			</a>
																			<!--end::Edit-->
																			<!--begin::Delete-->
																			<a href="#" class="btn btn-icon btn-active-light-primary w-30px h-30px me-3" data-bs-toggle="tooltip" title="Delete" data-kt-customer-payment-method="delete">
																				<i class="ki-duotone ki-trash fs-3">
																					<span class="path1"></span>
																					<span class="path2"></span>
																					<span class="path3"></span>
																					<span class="path4"></span>
																					<span class="path5"></span>
																				</i>
																			</a>
																			<!--end::Delete-->
																			<!--begin::More-->
																			<a href="#" class="btn btn-icon btn-active-light-primary w-30px h-30px" data-bs-toggle="tooltip" title="More Options" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
																				<i class="ki-duotone ki-setting-3 fs-3">
																					<span class="path1"></span>
																					<span class="path2"></span>
																					<span class="path3"></span>
																					<span class="path4"></span>
																					<span class="path5"></span>
																				</i>
																			</a>
																			<!--begin::Menu-->
																			<div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold w-200px py-3" data-kt-menu="true">
																				<!--begin::Menu item-->
																				<div class="menu-item px-3">
																					<a href="#" class="menu-link px-3" data-kt-payment-mehtod-action="set_as_default">Set as default address</a>
																				</div>
																				<!--end::Menu item-->
																			</div>
																			<!--end::Menu-->
																			<!--end::More-->
																		</div>
																		<!--end::Toolbar-->
																	</div>
																	<!--end::Header-->
																	<!--begin::Body-->
																	<div id="kt_ecommerce_customer_addresses_1" class="collapse fs-6 ps-9" data-bs-parent="#kt_ecommerce_customer_addresses_accordion">
																		<!--begin::Details-->
																		<div class="d-flex flex-column pb-5">
																			<div class="fw-bold text-gray-600">Max Smith</div>
																			<div class="text-muted">101 Collin Street,
																			<br />Melbourne, VIC 3000,
																			<br />Australia</div>
																		</div>
																		<!--end::Details-->
																	</div>
																	<!--end::Body-->
																</div>
																<!--end::Address-->
																<!--begin::Address-->
																<div class="py-0">
																	<!--begin::Header-->
																	<div class="py-3 d-flex flex-stack flex-wrap">
																		<!--begin::Toggle-->
																		<div class="accordion-header d-flex align-items-center collapsible collapsed rotate" data-bs-toggle="collapse" href="#kt_ecommerce_customer_addresses_2" role="button" aria-expanded="false" aria-controls="kt_customer_view_payment_method_2">
																			<!--begin::Arrow-->
																			<div class="accordion-icon me-3">
																				<i class="ki-duotone ki-right fs-4"></i>
																			</div>
																			<!--end::Arrow-->
																			<!--begin::Summary-->
																			<div class="me-3">
																				<div class="d-flex align-items-center">
																					<div class="fs-4 fw-bold">Work</div>
																				</div>
																				<div class="text-muted">54 Spring Street</div>
																			</div>
																			<!--end::Summary-->
																		</div>
																		<!--end::Toggle-->
																		<!--begin::Toolbar-->
																		<div class="d-flex my-3 ms-9">
																			<!--begin::Edit-->
																			<a href="#" class="btn btn-icon btn-active-light-primary w-30px h-30px me-3" data-bs-toggle="modal" data-bs-target="#kt_modal_update_address">
																				<span data-bs-toggle="tooltip" data-bs-trigger="hover" title="Edit">
																					<i class="ki-duotone ki-pencil fs-3">
																						<span class="path1"></span>
																						<span class="path2"></span>
																					</i>
																				</span>
																			</a>
																			<!--end::Edit-->
																			<!--begin::Delete-->
																			<a href="#" class="btn btn-icon btn-active-light-primary w-30px h-30px me-3" data-bs-toggle="tooltip" title="Delete" data-kt-customer-payment-method="delete">
																				<i class="ki-duotone ki-trash fs-3">
																					<span class="path1"></span>
																					<span class="path2"></span>
																					<span class="path3"></span>
																					<span class="path4"></span>
																					<span class="path5"></span>
																				</i>
																			</a>
																			<!--end::Delete-->
																			<!--begin::More-->
																			<a href="#" class="btn btn-icon btn-active-light-primary w-30px h-30px" data-bs-toggle="tooltip" title="More Options" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
																				<i class="ki-duotone ki-setting-3 fs-3">
																					<span class="path1"></span>
																					<span class="path2"></span>
																					<span class="path3"></span>
																					<span class="path4"></span>
																					<span class="path5"></span>
																				</i>
																			</a>
																			<!--begin::Menu-->
																			<div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold w-200px py-3" data-kt-menu="true">
																				<!--begin::Menu item-->
																				<div class="menu-item px-3">
																					<a href="#" class="menu-link px-3" data-kt-payment-mehtod-action="set_as_default">Set as default address</a>
																				</div>
																				<!--end::Menu item-->
																			</div>
																			<!--end::Menu-->
																			<!--end::More-->
																		</div>
																		<!--end::Toolbar-->
																	</div>
																	<!--end::Header-->
																	<!--begin::Body-->
																	<div id="kt_ecommerce_customer_addresses_2" class="collapse fs-6 ps-9" data-bs-parent="#kt_ecommerce_customer_addresses_accordion">
																		<!--begin::Details-->
																		<div class="d-flex flex-column pb-5">
																			<div class="fw-bold text-gray-600">Max Smith</div>
																			<div class="text-muted">54 Spring Street,
																			<br />Melbourne, VIC 3000,
																			<br />Australia</div>
																		</div>
																		<!--end::Details-->
																	</div>
																	<!--end::Body-->
																</div>
																<!--end::Address-->
																<!--begin::Address-->
																<div class="py-0">
																	<!--begin::Header-->
																	<div class="py-3 d-flex flex-stack flex-wrap">
																		<!--begin::Toggle-->
																		<div class="accordion-header d-flex align-items-center collapsible collapsed rotate" data-bs-toggle="collapse" href="#kt_ecommerce_customer_addresses_3" role="button" aria-expanded="false" aria-controls="kt_customer_view_payment_method_3">
																			<!--begin::Arrow-->
																			<div class="accordion-icon me-3">
																				<i class="ki-duotone ki-right fs-4"></i>
																			</div>
																			<!--end::Arrow-->
																			<!--begin::Summary-->
																			<div class="me-3">
																				<div class="d-flex align-items-center">
																					<div class="fs-4 fw-bold">Family</div>
																				</div>
																				<div class="text-muted">1521 Broadway</div>
																			</div>
																			<!--end::Summary-->
																		</div>
																		<!--end::Toggle-->
																		<!--begin::Toolbar-->
																		<div class="d-flex my-3 ms-9">
																			<!--begin::Edit-->
																			<a href="#" class="btn btn-icon btn-active-light-primary w-30px h-30px me-3" data-bs-toggle="modal" data-bs-target="#kt_modal_update_address">
																				<span data-bs-toggle="tooltip" data-bs-trigger="hover" title="Edit">
																					<i class="ki-duotone ki-pencil fs-3">
																						<span class="path1"></span>
																						<span class="path2"></span>
																					</i>
																				</span>
																			</a>
																			<!--end::Edit-->
																			<!--begin::Delete-->
																			<a href="#" class="btn btn-icon btn-active-light-primary w-30px h-30px me-3" data-bs-toggle="tooltip" title="Delete" data-kt-customer-payment-method="delete">
																				<i class="ki-duotone ki-trash fs-3">
																					<span class="path1"></span>
																					<span class="path2"></span>
																					<span class="path3"></span>
																					<span class="path4"></span>
																					<span class="path5"></span>
																				</i>
																			</a>
																			<!--end::Delete-->
																			<!--begin::More-->
																			<a href="#" class="btn btn-icon btn-active-light-primary w-30px h-30px" data-bs-toggle="tooltip" title="More Options" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
																				<i class="ki-duotone ki-setting-3 fs-3">
																					<span class="path1"></span>
																					<span class="path2"></span>
																					<span class="path3"></span>
																					<span class="path4"></span>
																					<span class="path5"></span>
																				</i>
																			</a>
																			<!--begin::Menu-->
																			<div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold w-200px py-3" data-kt-menu="true">
																				<!--begin::Menu item-->
																				<div class="menu-item px-3">
																					<a href="#" class="menu-link px-3" data-kt-payment-mehtod-action="set_as_default">Set as default address</a>
																				</div>
																				<!--end::Menu item-->
																			</div>
																			<!--end::Menu-->
																			<!--end::More-->
																		</div>
																		<!--end::Toolbar-->
																	</div>
																	<!--end::Header-->
																	<!--begin::Body-->
																	<div id="kt_ecommerce_customer_addresses_3" class="collapse fs-6 ps-9" data-bs-parent="#kt_ecommerce_customer_addresses_accordion">
																		<!--begin::Details-->
																		<div class="d-flex flex-column pb-5">
																			<div class="fw-bold text-gray-600">Francis Mitcham</div>
																			<div class="text-muted">1521 Broadway,
																			<br />New York,
																			<br />Melbourne, NY 10036,
																			<br />United States</div>
																		</div>
																		<!--end::Details-->
																	</div>
																	<!--end::Body-->
																</div>
																<!--end::Address-->
																<!--end::Addresses-->
															</div>
														</div>
														<!--end::Card body-->
													</div>
													<!--end::Card-->
												</div>
												<!--end:::Tab pane-->
												<!--begin:::Tab pane-->
												<div class="tab-pane fade" id="kt_ecommerce_customer_advanced" role="tabpanel">
													<!--begin::Card-->
													<div class="card pt-4 mb-6 mb-xl-9">
														<!--begin::Card header-->
														<div class="card-header border-0">
															<!--begin::Card title-->
															<div class="card-title">
																<h2>Security Details</h2>
															</div>
															<!--end::Card title-->
														</div>
														<!--end::Card header-->
														<!--begin::Card body-->
														<div class="card-body pt-0 pb-5">
															<!--begin::Table wrapper-->
															<div class="table-responsive">
																<!--begin::Table-->
																<table class="table align-middle table-row-dashed gy-5" id="kt_table_users_login_session">
																	<!--begin::Table body-->
																	<tbody class="fs-6 fw-semibold text-gray-600">
																		<tr>
																			<td>Phone</td>
																			<td>+6141 234 567</td>
																			<td class="text-end">
																				<button type="button" class="btn btn-icon btn-active-light-primary w-30px h-30px ms-auto" data-bs-toggle="modal" data-bs-target="#kt_modal_update_phone">
																					<i class="ki-duotone ki-pencil fs-3">
																						<span class="path1"></span>
																						<span class="path2"></span>
																					</i>
																				</button>
																			</td>
																		</tr>
																		<tr>
																			<td>Password</td>
																			<td>******</td>
																			<td class="text-end">
																				<button type="button" class="btn btn-icon btn-active-light-primary w-30px h-30px ms-auto" data-bs-toggle="modal" data-bs-target="#kt_modal_update_password">
																					<i class="ki-duotone ki-pencil fs-3">
																						<span class="path1"></span>
																						<span class="path2"></span>
																					</i>
																				</button>
																			</td>
																		</tr>
																	</tbody>
																	<!--end::Table body-->
																</table>
																<!--end::Table-->
															</div>
															<!--end::Table wrapper-->
														</div>
														<!--end::Card body-->
													</div>
													<!--end::Card-->
													<!--begin::Card-->
													<div class="card pt-4 mb-6 mb-xl-9">
														<!--begin::Card header-->
														<div class="card-header border-0">
															<!--begin::Card title-->
															<div class="card-title flex-column">
																<h2 class="mb-1">Two Step Authentication</h2>
																<div class="fs-6 fw-semibold text-muted">Keep your account extra secure with a second authentication step.</div>
															</div>
															<!--end::Card title-->
															<!--begin::Card toolbar-->
															<div class="card-toolbar">
																<!--begin::Add-->
																<button type="button" class="btn btn-light-primary btn-sm" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
																<i class="ki-duotone ki-fingerprint-scanning fs-3">
																	<span class="path1"></span>
																	<span class="path2"></span>
																	<span class="path3"></span>
																	<span class="path4"></span>
																	<span class="path5"></span>
																</i>Add Authentication Step</button>
																<!--begin::Menu-->
																<div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-6 w-200px py-4" data-kt-menu="true">
																	<!--begin::Menu item-->
																	<div class="menu-item px-3">
																		<a href="#" class="menu-link px-3" data-bs-toggle="modal" data-bs-target="#kt_modal_add_auth_app">Use authenticator app</a>
																	</div>
																	<!--end::Menu item-->
																	<!--begin::Menu item-->
																	<div class="menu-item px-3">
																		<a href="#" class="menu-link px-3" data-bs-toggle="modal" data-bs-target="#kt_modal_add_one_time_password">Enable one-time password</a>
																	</div>
																	<!--end::Menu item-->
																</div>
																<!--end::Menu-->
																<!--end::Add-->
															</div>
															<!--end::Card toolbar-->
														</div>
														<!--end::Card header-->
														<!--begin::Card body-->
														<div class="card-body pb-5">
															<!--begin::Item-->
															<div class="d-flex flex-stack">
																<!--begin::Content-->
																<div class="d-flex flex-column">
																	<span>SMS</span>
																	<span class="text-muted fs-6">+6141 234 567</span>
																</div>
																<!--end::Content-->
																<!--begin::Action-->
																<div class="d-flex justify-content-end align-items-center">
																	<!--begin::Button-->
																	<button type="button" class="btn btn-icon btn-active-light-primary w-30px h-30px ms-auto me-5" data-bs-toggle="modal" data-bs-target="#kt_modal_add_one_time_password">
																		<i class="ki-duotone ki-pencil fs-3">
																			<span class="path1"></span>
																			<span class="path2"></span>
																		</i>
																	</button>
																	<!--end::Button-->
																	<!--begin::Button-->
																	<button type="button" class="btn btn-icon btn-active-light-primary w-30px h-30px ms-auto" id="kt_users_delete_two_step">
																		<i class="ki-duotone ki-trash fs-3">
																			<span class="path1"></span>
																			<span class="path2"></span>
																			<span class="path3"></span>
																			<span class="path4"></span>
																			<span class="path5"></span>
																		</i>
																	</button>
																	<!--end::Button-->
																</div>
																<!--end::Action-->
															</div>
															<!--end::Item-->
															<!--begin:Separator-->
															<div class="separator separator-dashed my-5"></div>
															<!--end:Separator-->
															<!--begin::Disclaimer-->
															<div class="text-gray-600">If you lose your mobile device or security key, you can
															<a href='#' class="me-1">generate a backup code</a>to sign in to your account.</div>
															<!--end::Disclaimer-->
														</div>
														<!--end::Card body-->
													</div>
													<!--end::Card-->
													<!--begin::Card-->
													<div class="card pt-4 mb-6 mb-xl-9">
														<!--begin::Card header-->
														<div class="card-header border-0">
															<!--begin::Card title-->
															<div class="card-title">
																<h2 class="fw-bold mb-0">Payment Methods</h2>
															</div>
															<!--end::Card title-->
															<!--begin::Card toolbar-->
															<div class="card-toolbar">
																<a href="#" class="btn btn-sm btn-flex btn-light-primary" data-bs-toggle="modal" data-bs-target="#kt_modal_new_card">
																<i class="ki-duotone ki-plus-square fs-3">
																	<span class="path1"></span>
																	<span class="path2"></span>
																	<span class="path3"></span>
																</i>Add new method</a>
															</div>
															<!--end::Card toolbar-->
														</div>
														<!--end::Card header-->
														<!--begin::Card body-->
														<div id="kt_customer_view_payment_method" class="card-body pt-0">
															<div class="accordion accordion-icon-toggle" id="kt_customer_view_payment_method_accordion">
																<!--begin::Option-->
																<div class="py-0" data-kt-customer-payment-method="row">
																	<!--begin::Header-->
																	<div class="py-3 d-flex flex-stack flex-wrap">
																		<!--begin::Toggle-->
																		<div class="accordion-header d-flex align-items-center" data-bs-toggle="collapse" href="#kt_customer_view_payment_method_1" role="button" aria-expanded="false" aria-controls="kt_customer_view_payment_method_1">
																			<!--begin::Arrow-->
																			<div class="accordion-icon me-2">
																				<i class="ki-duotone ki-right fs-4"></i>
																			</div>
																			<!--end::Arrow-->
																			<!--begin::Logo-->
																			<img src="assets/media/svg/card-logos/mastercard.svg" class="w-40px me-3" alt="" />
																			<!--end::Logo-->
																			<!--begin::Summary-->
																			<div class="me-3">
																				<div class="d-flex align-items-center">
																					<div class="text-gray-800 fw-bold">Mastercard</div>
																					<div class="badge badge-light-primary ms-5">Primary</div>
																				</div>
																				<div class="text-muted">Expires Dec 2024</div>
																			</div>
																			<!--end::Summary-->
																		</div>
																		<!--end::Toggle-->
																		<!--begin::Toolbar-->
																		<div class="d-flex my-3 ms-9">
																			<!--begin::Edit-->
																			<a href="#" class="btn btn-icon btn-active-light-primary w-30px h-30px me-3" data-bs-toggle="modal" data-bs-target="#kt_modal_new_card">
																				<span data-bs-toggle="tooltip" data-bs-trigger="hover" title="Edit">
																					<i class="ki-duotone ki-pencil fs-3">
																						<span class="path1"></span>
																						<span class="path2"></span>
																					</i>
																				</span>
																			</a>
																			<!--end::Edit-->
																			<!--begin::Delete-->
																			<a href="#" class="btn btn-icon btn-active-light-primary w-30px h-30px me-3" data-bs-toggle="tooltip" title="Delete" data-kt-customer-payment-method="delete">
																				<i class="ki-duotone ki-trash fs-3">
																					<span class="path1"></span>
																					<span class="path2"></span>
																					<span class="path3"></span>
																					<span class="path4"></span>
																					<span class="path5"></span>
																				</i>
																			</a>
																			<!--end::Delete-->
																			<!--begin::More-->
																			<a href="#" class="btn btn-icon btn-active-light-primary w-30px h-30px" data-bs-toggle="tooltip" title="More Options" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
																				<i class="ki-duotone ki-setting-3 fs-3">
																					<span class="path1"></span>
																					<span class="path2"></span>
																					<span class="path3"></span>
																					<span class="path4"></span>
																					<span class="path5"></span>
																				</i>
																			</a>
																			<!--begin::Menu-->
																			<div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold w-150px py-3" data-kt-menu="true">
																				<!--begin::Menu item-->
																				<div class="menu-item px-3">
																					<a href="#" class="menu-link px-3" data-kt-payment-mehtod-action="set_as_primary">Set as Primary</a>
																				</div>
																				<!--end::Menu item-->
																			</div>
																			<!--end::Menu-->
																			<!--end::More-->
																		</div>
																		<!--end::Toolbar-->
																	</div>
																	<!--end::Header-->
																	<!--begin::Body-->
																	<div id="kt_customer_view_payment_method_1" class="collapse show fs-6 ps-10" data-bs-parent="#kt_customer_view_payment_method_accordion">
																		<!--begin::Details-->
																		<div class="d-flex flex-wrap py-5">
																			<!--begin::Col-->
																			<div class="flex-equal me-5">
																				<table class="table table-flush fw-semibold gy-1">
																					<tr>
																						<td class="text-muted min-w-125px w-125px">Name</td>
																						<td class="text-gray-800">Emma Smith</td>
																					</tr>
																					<tr>
																						<td class="text-muted min-w-125px w-125px">Number</td>
																						<td class="text-gray-800">**** 4358</td>
																					</tr>
																					<tr>
																						<td class="text-muted min-w-125px w-125px">Expires</td>
																						<td class="text-gray-800">12/2024</td>
																					</tr>
																					<tr>
																						<td class="text-muted min-w-125px w-125px">Type</td>
																						<td class="text-gray-800">Mastercard credit card</td>
																					</tr>
																					<tr>
																						<td class="text-muted min-w-125px w-125px">Issuer</td>
																						<td class="text-gray-800">VICBANK</td>
																					</tr>
																					<tr>
																						<td class="text-muted min-w-125px w-125px">ID</td>
																						<td class="text-gray-800">id_4325df90sdf8</td>
																					</tr>
																				</table>
																			</div>
																			<!--end::Col-->
																			<!--begin::Col-->
																			<div class="flex-equal">
																				<table class="table table-flush fw-semibold gy-1">
																					<tr>
																						<td class="text-muted min-w-125px w-125px">Billing address</td>
																						<td class="text-gray-800">AU</td>
																					</tr>
																					<tr>
																						<td class="text-muted min-w-125px w-125px">Phone</td>
																						<td class="text-gray-800">No phone provided</td>
																					</tr>
																					<tr>
																						<td class="text-muted min-w-125px w-125px">Email</td>
																						<td class="text-gray-800">
																							<a href="#" class="text-gray-900 text-hover-primary">smith@kpmg.com</a>
																						</td>
																					</tr>
																					<tr>
																						<td class="text-muted min-w-125px w-125px">Origin</td>
																						<td class="text-gray-800">Australia
																						<div class="symbol symbol-20px symbol-circle ms-2">
																							<img src="assets/media/flags/australia.svg" />
																						</div></td>
																					</tr>
																					<tr>
																						<td class="text-muted min-w-125px w-125px">CVC check</td>
																						<td class="text-gray-800">Passed
																						<i class="ki-duotone ki-check-circle fs-2 text-success">
																							<span class="path1"></span>
																							<span class="path2"></span>
																						</i></td>
																					</tr>
																				</table>
																			</div>
																			<!--end::Col-->
																		</div>
																		<!--end::Details-->
																	</div>
																	<!--end::Body-->
																</div>
																<!--end::Option-->
																<div class="separator separator-dashed"></div>
																<!--begin::Option-->
																<div class="py-0" data-kt-customer-payment-method="row">
																	<!--begin::Header-->
																	<div class="py-3 d-flex flex-stack flex-wrap">
																		<!--begin::Toggle-->
																		<div class="accordion-header d-flex align-items-center collapsed" data-bs-toggle="collapse" href="#kt_customer_view_payment_method_2" role="button" aria-expanded="false" aria-controls="kt_customer_view_payment_method_2">
																			<!--begin::Arrow-->
																			<div class="accordion-icon me-2">
																				<i class="ki-duotone ki-right fs-4"></i>
																			</div>
																			<!--end::Arrow-->
																			<!--begin::Logo-->
																			<img src="assets/media/svg/card-logos/visa.svg" class="w-40px me-3" alt="" />
																			<!--end::Logo-->
																			<!--begin::Summary-->
																			<div class="me-3">
																				<div class="d-flex align-items-center">
																					<div class="text-gray-800 fw-bold">Visa</div>
																				</div>
																				<div class="text-muted">Expires Feb 2022</div>
																			</div>
																			<!--end::Summary-->
																		</div>
																		<!--end::Toggle-->
																		<!--begin::Toolbar-->
																		<div class="d-flex my-3 ms-9">
																			<!--begin::Edit-->
																			<a href="#" class="btn btn-icon btn-active-light-primary w-30px h-30px me-3" data-bs-toggle="modal" data-bs-target="#kt_modal_new_card">
																				<span data-bs-toggle="tooltip" data-bs-trigger="hover" title="Edit">
																					<i class="ki-duotone ki-pencil fs-3">
																						<span class="path1"></span>
																						<span class="path2"></span>
																					</i>
																				</span>
																			</a>
																			<!--end::Edit-->
																			<!--begin::Delete-->
																			<a href="#" class="btn btn-icon btn-active-light-primary w-30px h-30px me-3" data-bs-toggle="tooltip" title="Delete" data-kt-customer-payment-method="delete">
																				<i class="ki-duotone ki-trash fs-3">
																					<span class="path1"></span>
																					<span class="path2"></span>
																					<span class="path3"></span>
																					<span class="path4"></span>
																					<span class="path5"></span>
																				</i>
																			</a>
																			<!--end::Delete-->
																			<!--begin::More-->
																			<a href="#" class="btn btn-icon btn-active-light-primary w-30px h-30px" data-bs-toggle="tooltip" title="More Options" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
																				<i class="ki-duotone ki-setting-3 fs-3">
																					<span class="path1"></span>
																					<span class="path2"></span>
																					<span class="path3"></span>
																					<span class="path4"></span>
																					<span class="path5"></span>
																				</i>
																			</a>
																			<!--begin::Menu-->
																			<div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold w-150px py-3" data-kt-menu="true">
																				<!--begin::Menu item-->
																				<div class="menu-item px-3">
																					<a href="#" class="menu-link px-3" data-kt-payment-mehtod-action="set_as_primary">Set as Primary</a>
																				</div>
																				<!--end::Menu item-->
																			</div>
																			<!--end::Menu-->
																			<!--end::More-->
																		</div>
																		<!--end::Toolbar-->
																	</div>
																	<!--end::Header-->
																	<!--begin::Body-->
																	<div id="kt_customer_view_payment_method_2" class="collapse fs-6 ps-10" data-bs-parent="#kt_customer_view_payment_method_accordion">
																		<!--begin::Details-->
																		<div class="d-flex flex-wrap py-5">
																			<!--begin::Col-->
																			<div class="flex-equal me-5">
																				<table class="table table-flush fw-semibold gy-1">
																					<tr>
																						<td class="text-muted min-w-125px w-125px">Name</td>
																						<td class="text-gray-800">Melody Macy</td>
																					</tr>
																					<tr>
																						<td class="text-muted min-w-125px w-125px">Number</td>
																						<td class="text-gray-800">**** 8085</td>
																					</tr>
																					<tr>
																						<td class="text-muted min-w-125px w-125px">Expires</td>
																						<td class="text-gray-800">02/2022</td>
																					</tr>
																					<tr>
																						<td class="text-muted min-w-125px w-125px">Type</td>
																						<td class="text-gray-800">Visa credit card</td>
																					</tr>
																					<tr>
																						<td class="text-muted min-w-125px w-125px">Issuer</td>
																						<td class="text-gray-800">ENBANK</td>
																					</tr>
																					<tr>
																						<td class="text-muted min-w-125px w-125px">ID</td>
																						<td class="text-gray-800">id_w2r84jdy723</td>
																					</tr>
																				</table>
																			</div>
																			<!--end::Col-->
																			<!--begin::Col-->
																			<div class="flex-equal">
																				<table class="table table-flush fw-semibold gy-1">
																					<tr>
																						<td class="text-muted min-w-125px w-125px">Billing address</td>
																						<td class="text-gray-800">UK</td>
																					</tr>
																					<tr>
																						<td class="text-muted min-w-125px w-125px">Phone</td>
																						<td class="text-gray-800">No phone provided</td>
																					</tr>
																					<tr>
																						<td class="text-muted min-w-125px w-125px">Email</td>
																						<td class="text-gray-800">
																							<a href="#" class="text-gray-900 text-hover-primary">melody@altbox.com</a>
																						</td>
																					</tr>
																					<tr>
																						<td class="text-muted min-w-125px w-125px">Origin</td>
																						<td class="text-gray-800">United Kingdom
																						<div class="symbol symbol-20px symbol-circle ms-2">
																							<img src="assets/media/flags/united-kingdom.svg" />
																						</div></td>
																					</tr>
																					<tr>
																						<td class="text-muted min-w-125px w-125px">CVC check</td>
																						<td class="text-gray-800">Passed
																						<i class="ki-duotone ki-check fs-2 text-success"></i></td>
																					</tr>
																				</table>
																			</div>
																			<!--end::Col-->
																		</div>
																		<!--end::Details-->
																	</div>
																	<!--end::Body-->
																</div>
																<!--end::Option-->
																<div class="separator separator-dashed"></div>
																<!--begin::Option-->
																<div class="py-0" data-kt-customer-payment-method="row">
																	<!--begin::Header-->
																	<div class="py-3 d-flex flex-stack flex-wrap">
																		<!--begin::Toggle-->
																		<div class="accordion-header d-flex align-items-center collapsed" data-bs-toggle="collapse" href="#kt_customer_view_payment_method_3" role="button" aria-expanded="false" aria-controls="kt_customer_view_payment_method_3">
																			<!--begin::Arrow-->
																			<div class="accordion-icon me-2">
																				<i class="ki-duotone ki-right fs-4"></i>
																			</div>
																			<!--end::Arrow-->
																			<!--begin::Logo-->
																			<img src="assets/media/svg/card-logos/american-express.svg" class="w-40px me-3" alt="" />
																			<!--end::Logo-->
																			<!--begin::Summary-->
																			<div class="me-3">
																				<div class="d-flex align-items-center">
																					<div class="text-gray-800 fw-bold">American Express</div>
																					<div class="badge badge-light-danger ms-5">Expired</div>
																				</div>
																				<div class="text-muted">Expires Aug 2021</div>
																			</div>
																			<!--end::Summary-->
																		</div>
																		<!--end::Toggle-->
																		<!--begin::Toolbar-->
																		<div class="d-flex my-3 ms-9">
																			<!--begin::Edit-->
																			<a href="#" class="btn btn-icon btn-active-light-primary w-30px h-30px me-3" data-bs-toggle="modal" data-bs-target="#kt_modal_new_card">
																				<span data-bs-toggle="tooltip" data-bs-trigger="hover" title="Edit">
																					<i class="ki-duotone ki-pencil fs-3">
																						<span class="path1"></span>
																						<span class="path2"></span>
																					</i>
																				</span>
																			</a>
																			<!--end::Edit-->
																			<!--begin::Delete-->
																			<a href="#" class="btn btn-icon btn-active-light-primary w-30px h-30px me-3" data-bs-toggle="tooltip" title="Delete" data-kt-customer-payment-method="delete">
																				<i class="ki-duotone ki-trash fs-3">
																					<span class="path1"></span>
																					<span class="path2"></span>
																					<span class="path3"></span>
																					<span class="path4"></span>
																					<span class="path5"></span>
																				</i>
																			</a>
																			<!--end::Delete-->
																			<!--begin::More-->
																			<a href="#" class="btn btn-icon btn-active-light-primary w-30px h-30px" data-bs-toggle="tooltip" title="More Options" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
																				<i class="ki-duotone ki-setting-3 fs-3">
																					<span class="path1"></span>
																					<span class="path2"></span>
																					<span class="path3"></span>
																					<span class="path4"></span>
																					<span class="path5"></span>
																				</i>
																			</a>
																			<!--begin::Menu-->
																			<div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold w-150px py-3" data-kt-menu="true">
																				<!--begin::Menu item-->
																				<div class="menu-item px-3">
																					<a href="#" class="menu-link px-3" data-kt-payment-mehtod-action="set_as_primary">Set as Primary</a>
																				</div>
																				<!--end::Menu item-->
																			</div>
																			<!--end::Menu-->
																			<!--end::More-->
																		</div>
																		<!--end::Toolbar-->
																	</div>
																	<!--end::Header-->
																	<!--begin::Body-->
																	<div id="kt_customer_view_payment_method_3" class="collapse fs-6 ps-10" data-bs-parent="#kt_customer_view_payment_method_accordion">
																		<!--begin::Details-->
																		<div class="d-flex flex-wrap py-5">
																			<!--begin::Col-->
																			<div class="flex-equal me-5">
																				<table class="table table-flush fw-semibold gy-1">
																					<tr>
																						<td class="text-muted min-w-125px w-125px">Name</td>
																						<td class="text-gray-800">Max Smith</td>
																					</tr>
																					<tr>
																						<td class="text-muted min-w-125px w-125px">Number</td>
																						<td class="text-gray-800">**** 3554</td>
																					</tr>
																					<tr>
																						<td class="text-muted min-w-125px w-125px">Expires</td>
																						<td class="text-gray-800">08/2021</td>
																					</tr>
																					<tr>
																						<td class="text-muted min-w-125px w-125px">Type</td>
																						<td class="text-gray-800">American express credit card</td>
																					</tr>
																					<tr>
																						<td class="text-muted min-w-125px w-125px">Issuer</td>
																						<td class="text-gray-800">USABANK</td>
																					</tr>
																					<tr>
																						<td class="text-muted min-w-125px w-125px">ID</td>
																						<td class="text-gray-800">id_89457jcje63</td>
																					</tr>
																				</table>
																			</div>
																			<!--end::Col-->
																			<!--begin::Col-->
																			<div class="flex-equal">
																				<table class="table table-flush fw-semibold gy-1">
																					<tr>
																						<td class="text-muted min-w-125px w-125px">Billing address</td>
																						<td class="text-gray-800">US</td>
																					</tr>
																					<tr>
																						<td class="text-muted min-w-125px w-125px">Phone</td>
																						<td class="text-gray-800">No phone provided</td>
																					</tr>
																					<tr>
																						<td class="text-muted min-w-125px w-125px">Email</td>
																						<td class="text-gray-800">
																							<a href="#" class="text-gray-900 text-hover-primary">max@kt.com</a>
																						</td>
																					</tr>
																					<tr>
																						<td class="text-muted min-w-125px w-125px">Origin</td>
																						<td class="text-gray-800">United States of America
																						<div class="symbol symbol-20px symbol-circle ms-2">
																							<img src="assets/media/flags/united-states.svg" />
																						</div></td>
																					</tr>
																					<tr>
																						<td class="text-muted min-w-125px w-125px">CVC check</td>
																						<td class="text-gray-800">Failed
																						<i class="ki-duotone ki-cross fs-2 text-danger">
																							<span class="path1"></span>
																							<span class="path2"></span>
																						</i></td>
																					</tr>
																				</table>
																			</div>
																			<!--end::Col-->
																		</div>
																		<!--end::Details-->
																	</div>
																	<!--end::Body-->
																</div>
																<!--end::Option-->
															</div>
														</div>
														<!--end::Card body-->
													</div>
													<!--end::Card-->
												</div>
												<!--end:::Tab pane-->
											</div>
											<!--end:::Tab content-->
										</div>


</x-default-layout>

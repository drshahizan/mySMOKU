<x-default-layout> 
<head>
   <!-- MAIN CSS -->
   <link rel="stylesheet" href="/assets/css/saringan.css">
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
   <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
   <script src="/assets/lang/Malay.json"></script>
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
							@foreach($user as $user1)
								<div class="symbol symbol-150px symbol-circle mb-7">
									@if(Auth::user()->profile_photo_path !== null)
									<img class="image rounded-circle" src="/assets/profile_photo_path/{{$user1->profile_photo_path}}" alt="profile_image" style="width: 80px;height: 80px; padding: 10px; margin: 0px; ">
									@else
									<img class="image rounded-circle" src="/assets/profile_photo_path/default.png" alt="profile_image" style="width: 80px;height: 80px; padding: 10px; margin: 0px; ">
									@endif
								</div>
								<!--end::Avatar-->
								<!--begin::Name-->
								@if(!empty($pelajar))
								<div class="fs-5 text-gray-800 text-dark fw-bold mb-1">{{$pelajar->nama_pelajar}}</div>
								@else
								<div class="fs-5 text-gray-800 text-dark fw-bold mb-1">{{$user1->nama}}</div>
								@endif
								<!--end::Name-->
								<!--begin::Email-->
								@if(!empty($pelajar))
								<div class="fs-5 fw-semibold text-muted mb-6">{{$pelajar->emel}}</div>
								@else
								<div class="fs-5 fw-semibold text-muted mb-6">{{$user1->email}}</div>
								@endif
								<!--end::Email-->
							@endforeach
						</div>
						<!--end::Summary-->
						<!--begin::Details toggle-->
						<div class="d-flex flex-stack fs-4 py-3">
							<div class="fw-bold">Maklumat Pelajar</div>
						</div>
						<!--end::Details toggle-->
						<div class="separator separator-dashed my-3"></div>
						<!--begin::Details content-->
						<div class="pb-5 fs-6">
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
							<div class="fw-bold mt-5">Nama Kursus</div>
							@if(!empty($akademik))
								<div class="text-gray-600">{{$akademik->nama_kursus}}</div>
							@else
								<div class="fs-5 fw-semibold text-muted mb-6">Tiada</div>
							@endif
							<!--begin::Details item-->
							<div class="fw-bold mt-5">Nama Institusi</div>
							@if(!empty($akademik))
								<div class="text-gray-600">{{$akademik->nama_institusi}}</div>
							@else
								<div class="fs-5 fw-semibold text-muted mb-6">Tiada</div>
							@endif
							
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
									
									<table id="sortTable1" class="table text-center table-striped table-hover dataTable js-exportable">
										<thead>
											<tr>
												<th class="text-center">ID Permohonan</th>
												<th class="text-center">Tarikh Kemaskini</th>
												<th class="text-center">Status</th>
											</tr>
										</thead>
										<tbody>
											@foreach($permohonan as $permohonan)
											@php
												$jenis_institusi = DB::table('bk_info_institusi')->where('id_institusi', $akademik['id_institusi'])->value('jenis_institusi');
												
											@endphp
											<tr> 
												<td>{{$permohonan_id->no_rujukan_permohonan}}</td>
												<td>{{$permohonan->created_at->format('d/m/Y')}}</td>
												<td>
													@if ($permohonan_id->status == 1)
														<a href="{{ route('permohonan') }}">{{ ucwords(strtolower($permohonan->status)) }}</a>
													@elseif (($permohonan_id->status == 5) && ($permohonan->kod_status === $permohonan_id->status) && ($jenis_institusi == 'IPTS'))														<a href="{{ route('pelajar.sejarah.permohonan') }}">{{ ucwords(strtolower($permohonan->status)) }}</a>
													@else
													<?php //dd($permohonan->status); ?>
														@if ($permohonan->status == 'LAYAK')
															<?php $status = 'Berjaya'; ?>
														@elseif ($permohonan->status == 'DIHANTAR')
															<?php $status = 'Berjaya Dihantar'; ?>
														@else
															<?php $status = ucwords(strtolower($permohonan->status)); ?>
														@endif
														{{ $status }}
													@endif
													{{-- @else
														{{ ucwords(strtolower($permohonan->status)) }}
													@endif --}}
												</td>												
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
									<h2>Sejarah Tuntutan</h2>
								</div>
								<!--end::Card title-->
							</div>
							<div class="body">
								<div class="table-responsive">
									<table id="sortTable2" class="table text-center table-striped table-hover dataTable js-exportable">
										<thead>
											<tr>
												<th class="text-center">ID Tuntutan</th>
												<th class="text-center">Tarikh Kemaskini</th>
												<th class="text-center">Status</th>
											</tr>
										</thead>
										<tbody>
											@foreach($tuntutan as $tuntutan)
											<tr> 
												<td>{{$tuntutan->no_rujukan_tuntutan}}</td>
												<td>{{$tuntutan->created_at->format('d/m/Y')}}</td>
												<td>
													@if ($tuntutan->status_semasa == 1)
														<a href="{{ route('tuntutan.baharu') }}">{{ ucwords(strtolower($tuntutan->status)) }}</a>
													@else
													<?php //dd($tuntutan->status); ?>
														@if ($tuntutan->status == 'LAYAK')
															<?php $status = 'Berjaya'; ?>
														@elseif ($tuntutan->status == 'TIDAK LAYAK')
															<?php $status = 'Tidak Berjaya'; ?>
														@elseif ($tuntutan->status == 'DIHANTAR')
															<?php $status = 'Berjaya Dihantar'; ?>
														@else
															<?php $status = ucwords(strtolower($tuntutan->status)); ?>
														@endif
														{{ $status }}
													@endif
												</td>	
												{{-- <td>{{ucwords(strtolower($tuntutan->status))}}</td> --}}
												{{--<td><a href="{{ route('delete',  $permohonan->nokp_pelajar) }}" class="btn btn-primary">Batal</a> </td>--}}
											</tr>
											@endforeach
										</tbody>
									</table>
								</div>		
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	<div>
</div>
<script>
	$('#sortTable1').DataTable({
            ordering: true, // Enable manual sorting
            order: [], // Disable initial sorting
			language: {
				url: "/assets/lang/Malay.json"
			}
        });
	$('#sortTable2').DataTable({
            ordering: true, // Enable manual sorting
            order: [], // Disable initial sorting
			language: {
				url: "/assets/lang/Malay.json"
			}
        });
</script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script>
	@if(session('message'))
		Swal.fire({
			icon: 'success',
			title: 'Berjaya!',
			text: ' {!! session('message') !!}',
			confirmButtonText: 'OK'
		});
	@endif
	@if(session('permohonan'))
		Swal.fire({
			icon: 'error',
			title: 'Tiada Permohonan!',
			text: ' {!! session('permohonan') !!}',
			confirmButtonText: 'OK'
		});
	@endif
	@if(session('sem'))
		Swal.fire({
			icon: 'error',
			title: 'Tidak Berjaya!',
			text: ' {!! session('sem') !!}',
			confirmButtonText: 'OK'
		});
	@endif
</script>


</x-default-layout>

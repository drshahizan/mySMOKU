<x-default-layout> 
<head>
   <!-- MAIN CSS -->
   {{-- <link rel="stylesheet" href="/assets/css/saringan.css"> --}}
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
						<!--begin::Profile Summary-->
						<div class="d-flex flex-center flex-column mb-5">
							@foreach($user as $user1)
								<!--begin::Avatar-->
								<div class="symbol symbol-150px symbol-circle mb-4">
									<img 
										class="image rounded-circle" 
										src="{{ Auth::user()->profile_photo_path 
											? asset('assets/profile_photo_path/' . $user1->profile_photo_path) 
											: asset('assets/media/auth/default.png') }}" 
										alt="profile_image" 
										style="width: 100px; height: 100px; object-fit: cover;"
									>
								</div>
								<!--end::Avatar-->

								<!--begin::User Info-->
								<div class="text-center">
									<div class="fs-5 text-dark fw-bold mb-1">{{ $user1->nama }}</div>
									<div class="fs-6 fw-semibold text-muted">{{ $user1->email }}</div>
								</div>
								<!--end::User Info-->
							@endforeach
						</div>
						<!--end::Profile Summary-->

						<!--begin::Section Title-->
						<div class="d-flex flex-stack fs-4 py-3">
							<div class="fw-bold">Maklumat Pelajar</div>
						</div>
						<div class="separator separator-dashed my-3"></div>
						<!--end::Section Title-->

						<!--begin::Details Content-->
						<div class="pb-5 fs-6">
							<!-- Email -->
							<div class="mb-4">
								<div class="fw-bold">Alamat Emel</div>
								@foreach($user as $user1)
									<div>
										<a href="mailto:{{ $user1->email }}" class="text-gray-600 text-hover-primary">
											{{ $user1->email }}
										</a>
									</div>
								@endforeach
							</div>

							<!-- Course -->
							<div class="mb-4">
								<div class="fw-bold">Nama Kursus</div>
								<div class="text-gray-600">
									{{ !empty($akademik) ? $akademik->nama_kursus : 'Tiada' }}
								</div>
							</div>

							<!-- Institution -->
							<div>
								<div class="fw-bold">Nama Institusi</div>
								<div class="text-gray-600">
									{{ !empty($akademik) ? $akademik->nama_institusi : 'Tiada' }}
								</div>
							</div>
						</div>
						<!--end::Details Content-->
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
												// $jenis_institusi = DB::table('bk_info_institusi')->where('id_institusi', $akademik['id_institusi'])->value('jenis_institusi');
												
											@endphp
											<tr> 
												<td>{{$permohonan_id->no_rujukan_permohonan}}</td>
												<td>{{ $permohonan->created_at ? $permohonan->created_at->format('d/m/Y') : '-' }}</td>
												<td>
													@if ($permohonan_id->status == 1)
														<a href="{{ route('permohonan') }}">{{ ucwords(strtolower($permohonan->status)) }}</a>
													{{-- @elseif (($permohonan_id->status == 5) && ($permohonan->kod_status === $permohonan_id->status) && ($jenis_institusi == 'IPTS'))														<a href="{{ route('pelajar.sejarah.permohonan') }}">{{ ucwords(strtolower($permohonan->status)) }}</a> --}}
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
											@foreach($tuntutan as $row)
											<tr>
												<td>{{ $row->no_rujukan_tuntutan }}</td>
												<td>{{ \Carbon\Carbon::parse($row->tarikh_status)->format('d/m/Y') }}</td>
												<td>
													@if ($row->status_semasa == 1)
														<a href="{{ route('tuntutan.baharu') }}">{{ ucwords(strtolower($row->status)) }}</a>
													@else
														@php
															if ($row->status === 'LAYAK') {
																$status = 'Berjaya';
															} elseif ($row->status === 'TIDAK LAYAK') {
																$status = 'Tidak Berjaya';
															} elseif ($row->status === 'DIHANTAR') {
																$status = 'Berjaya Dihantar';
															} else {
																$status = ucwords(strtolower($row->status));
															}
														@endphp
														{{ $status }}
													@endif
												</td>
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
<style>
	.dataTables_filter {
		width: 100%;
	}

	.dataTables_filter label {
		width: 100%;
		display: flex;
		justify-content: flex-start; /* or center/right if you prefer */
	}

	.dataTables_filter input {
		width: 100% !important;
		max-width: 100% !important;
		box-sizing: border-box;
	}

</style>
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

<x-default-layout> 
		<!--begin::Page title-->
        <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
	<!--begin::Title-->
	<h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Saringan Permohonan</h1>
	<!--end::Title-->
	<!--begin::Breadcrumb-->
	<ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
		<!--begin::Item-->
		<li class="breadcrumb-item text-dark" style="color:darkblue">Permohonan
			
		</li>
		<!--end::Item-->
		<!--begin::Item-->
		<li class="breadcrumb-item">
			<span class="bullet bg-gray-400 w-5px h-2px"></span>
		</li>
		<!--end::Item-->
		<!--begin::Item-->
		<li class="breadcrumb-item text-dark" style="color:darkblue">Saringan Permohonan</li>
		<!--end::Item-->
	</ul>
	<!--end::Breadcrumb-->
</div>
<!--end::Page title-->
<br>

    <!-- MAIN CSS -->
    <!-- <link rel="stylesheet" href="assets/css/saringan.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js"></script>
    </head>
    <body> -->
    <div class="row g-5 g-xl-8">
										<div class="col-xl-3">
											<!--begin::Statistics Widget 5-->
											<a href="#" class="card theme-dark-bg-body"  style="background-color:#B9D9EB">
												<!--begin::Body-->
												<div class="card-body">
													<i class="ki-duotone ki-document text-primary fs-2x ms-n1">
														<span class="path1"></span>
														<span class="path2"></span>
														<span class="path3"></span>
														<span class="path4"></span>
													</i>
													<div class="text-gray-100 fw-bold fs-4 mb-2 mt-5">Jumlah Saringan (Keseluruhan)</div>
													<div class="fw-semibold text-gray-400">5000</div>
												</div>
												<!--end::Body-->
											</a>
											<!--end::Statistics Widget 5-->
										</div>
										<div class="col-xl-3">
											<!--begin::Statistics Widget 5-->
											<a href="#" class="card bg-dark hoverable card-xl-stretch mb-xl-8">
												<!--begin::Body-->
												<div class="card-body">
													<i class="ki-duotone ki-cheque text-gray-100 fs-2x ms-n1">
														<span class="path1"></span>
														<span class="path2"></span>
														<span class="path3"></span>
														<span class="path4"></span>
														<span class="path5"></span>
														<span class="path6"></span>
														<span class="path7"></span>
													</i>
													<div class="text-gray-100 fw-bold fs-2 mb-2 mt-5">+3000</div>
													<div class="fw-semibold text-gray-100">New Customers</div>
												</div>
												<!--end::Body-->
											</a>
											<!--end::Statistics Widget 5-->
										</div>
										<div class="col-xl-3">
											<!--begin::Statistics Widget 5-->
											<a href="#" class="card bg-warning hoverable card-xl-stretch mb-xl-8">
												<!--begin::Body-->
												<div class="card-body">
													<i class="ki-duotone ki-briefcase text-white fs-2x ms-n1">
														<span class="path1"></span>
														<span class="path2"></span>
													</i>
													<div class="text-white fw-bold fs-2 mb-2 mt-5">$50,000</div>
													<div class="fw-semibold text-white">Milestone Reached</div>
												</div>
												<!--end::Body-->
											</a>
											<!--end::Statistics Widget 5-->
										</div>
										<div class="col-xl-3">
											<!--begin::Statistics Widget 5-->
											<a href="#" class="card bg-info hoverable card-xl-stretch mb-5 mb-xl-8">
												<!--begin::Body-->
												<div class="card-body">
													<i class="ki-duotone ki-chart-pie-simple text-white fs-2x ms-n1">
														<span class="path1"></span>
														<span class="path2"></span>
													</i>
													<div class="text-white fw-bold fs-2 mb-2 mt-5">$50,000</div>
													<div class="fw-semibold text-white">Milestone Reached</div>
												</div>
												<!--end::Body-->
											</a>
											<!--end::Statistics Widget 5-->
										</div>
									</div>
									<!--end::Row-->
              
                                    <div class="card mb-5 mb-xxl-10">
										<!--begin::Card header-->
										<div class="card-header">
											<!--begin::Heading-->
											<div class="card-title">
												<h3>Senarai Saringan Permohonan
                                                <br><small>Klik ID Permohonan untuk melakukan saringan selanjutnya</small></h3>
											</div>
                                            <div class="card-toolbar">
												<div class="my-1 me-4">
                                                <a href="{{ url('cetak-senarai-pemohon') }}" target="_blank" class="btn btn-primary">Cetak</a>
                                            </div>
                                            </div>
                                        </div>
                                        <div class="card-body p-0">
											<!--begin::Table wrapper-->
											<div class="table-responsive">
												<!--begin::Table-->
												<table id="kt_profile_overview_table" class="table table-row-bordered table-row-dashed gy-4 align-middle fw-bold">
													<thead class="fs-7 text-gray-400 text-uppercase">
														<tr>
                                                        <th class="min-w-100px text-center">ID Permohonan</th>                                        
                                                        <th class="min-w-250px">Nama</th>
                                                        <th class="min-w-150px">Jenis Permohonan</th>
                                                        <th class="min-w-150px">Tarikh Permohonan</th>
                                                        <th class="min-w-150px text-center">Status Saringan</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody class="fs-6">
                                                        <tr>                                          
                                            <td class="text-center"><a href="{{ url('maklumat-pemohon') }}" title="" >980214089182M</a></td>
                                            <td><b>Mohd Ali Bin Abu Kassim<b></td>
                                            <td>BKOKU</td>
                                            <td class="text-center">7/7/2023</td>
                                            <td class="text-center"><span class="badge badge-light-danger fw-bold px-4 py-3">Belum Disemak</span></td>
                                        </tr>
                                        <tr>                                            
                                            <td class="text-center"><a href="{{ url('maklumat-pemohon') }}" title="">KKPPK000021</a></td>
                                            <td>Sarah Binti Yusri</td>
                                            <td>PPK</td>                                        
                                            <td class="text-center">5/7/2023</td>
                                            <td class="text-center"><button type="button" class="btn bg-green text-white"> Disokong</button></td>
                                        </tr> <tr>                                            
                                            <td class="text-center"><a href="{{ url('maklumat-pemohon') }}" title="">PHDBKOKU000021</a></td>
                                            <td>Aishah Binti Samsudin</td>
                                            <td>BKOKU</td>                                        
                                            <td class="text-center">2/7/2023</td>
                                            <td class="text-center"><button type="button" class="btn bg-green text-white"> Disokong</button></td>
                                        </tr> <tr>
                                            <td class="text-center"><a href="{{ url('maklumat-pemohon') }}" title="">DIPBKOKU000021</a></td>
                                            <td>Santosh A/L Ariyaran</td>
                                            <td>BKOKU</td>                                        
                                            <td class="text-center">10/7/2023</td>
                                            <td class="text-center"><button type="button" class="btn bg-green text-white"> Disokong</button></td>
                                        </tr> <tr>
                                            <td class="text-center"><a href="{{ url('maklumat-pemohon') }}" title="">SARJANABKOKU000021</a></td>
                                            <td>Ling Kai Jie</td>
                                            <td>BKOKU</td>                                        
                                            <td class="text-center">9/7/2023</td>
                                            <td class="text-center"><button type="button" class="btn bg-green text-white"> Disokong</button></td>
                                        </tr> <tr>
                                            <td class="text-center"><a href="{{ url('maklumat-pemohon') }}" title="">KKPPK40021</a></td>
                                            <td>Akmal Bin Kairuddin</td>
                                            <td>PPK</td>                                        
                                            <td class="text-center">7/7/2023</td>
                                            <td class="text-center"><button type="button" class="btn bg-green text-white"> Disokong</button></td>
                                        </tr>
                                        <tr>
                                            <td class="text-center"><a href="{{ url('maklumat-pemohon') }}" title="">KKPPK60021</a></td>
                                            <td>Santishwaran A/L Paven</td>
                                            <td>PPK</td>                                        
                                            <td class="text-center">5/7/2023</td>
                                            <td class="text-center"><button type="button" class="btn bg-green text-white"> Disokong</button></td>
                                        </tr>
                                        <tr>
                                            <td class="text-center"><a href="{{ url('maklumat-pemohon') }}" title="">DIPLOMABKOKU002011</a></td>
                                            <td>Choo Mei Ling</td>
                                            <td>BKOKU</td>
                                            <td class="text-center">7/6/2023</td>
                                            <td class="text-center"><span class="badge badge-light-dark fw-bold px-4 py-3">Dikembalikan</span></td>
                                        </tr>
                                        <tr>
                                            <td class="text-center"><a href="{{ url('maklumat-pemohon') }}" title="">PHDBKOKU000011</a></td>
                                            <td>Ezra Hanisah Binti Md Yunos</td>
                                            <td>BKOKU</td>                                    
                                            <td class="text-center">9/2/2023</td>
                                            <td class="text-center"><span class="badge badge-light-success fw-bold px-4 py-3">Disokong</span></td>
                                        </tr><tr>
                                            <td class="text-center"><a href="{{ url('maklumat-pemohon') }}" title="">KKPPK40021</a></td>
                                            <td>Akmal Bin Kairuddin</td>
                                            <td>PPK</td>                                        
                                            <td class="text-center">7/7/2023</td>
                                            <td class="text-center"><span class="badge badge-light-success fw-bold px-4 py-3">Disokong</span></td>
                                        </tr>
                                        <tr>
                                            <td class="text-center"><a href="{{ url('maklumat-pemohon') }}" title="">KKPPK60021</a></td>
                                            <td>Syed Abdul Kassim Hussain Yusof</td>
                                            <td>PPK</td>                                        
                                            <td class="text-center">5/7/2023</td>
                                            <td class="text-center"><button type="button" class="btn bg-green text-white"> Disokong</button></td>
                                        </tr>
                                        <tr>
                                            <td class="text-center"><a href="{{ url('maklumat-pemohon') }}" title="">DIPLOMABKOKU002011</a></td>
                                            <td>Shakira Mariam Aqilah Binti Syed Abdul Rahman</td>
                                            <td>BKOKU</td>                                        
                                            <td class="text-center">7/6/2023</td>
                                            <td class="text-center"><button type="button" class="btn bg-orange text-white"> Dikembalikan</button></td>
                                        </tr>
                                        <tr>
                                            <td class="text-center"><a href="{{ url('maklumat-pemohon') }}" title="">PHDBKOKU000011</a></td>
                                            <td>Rahman Mohammed Arshahad Al-dhaqm</td>
                                            <td>BKOKU</td>                                    
                                            <td class="text-center">9/2/2023</td>
                                            <td class="text-center"><span class="badge badge-light-success fw-bold px-4 py-3">Disokong</span></td>
                                        </tr>
                                    </tbody>
                                </table>       
                                    
</div>
</div>
</div>
</div>
</div>






















                                    

            
                       
    <script>
            <script src="assets/plugins/global/plugins.bundle.js"></script>
		    <script src="assets/js/scripts.bundle.js"></script>
        	<script src="assets/plugins/custom/datatables/datatables.bundle.js"></script>
            <script src="assets/js/custom/apps/projects/project/project.js"></script>
    </script>
    
   
</x-default-layout> 
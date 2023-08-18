<x-default-layout> 
<div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
	<!--begin::Title-->
	<h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Permohonan</h1>
	<!--end::Title-->
	<!--begin::Breadcrumb-->
	<ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
		<!--begin::Item-->
		<li class="breadcrumb-item text-muted">
			<a href="/" class="text-dark text-hover-primary" style="color:darkblue">Permohonan</a>
		</li>
		<!--end::Item-->
		<!--begin::Item-->
		<li class="breadcrumb-item">
			<span class="bullet bg-gray-400 w-5px h-2px"></span>
		</li>
		<!--end::Item-->
		<!--begin::Item-->
		<li class="breadcrumb-item text-dark" style="color:darkblue">Permohonan Baru</li>
		<!--end::Item-->
	</ul>
	<!--end::Breadcrumb-->
</div>
<br>
    <head>
    <!-- MAIN CSS -->
    <link rel="stylesheet" href="/assets/css/saringan.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js"></script>
    </head>
    <div class="row clearfix">
                <div class="col-lg-3 col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="icon-in-bg bg-indigo text-white rounded-circle"><i class="fa fa-file" style="color: white!important"></i></div>
                                <div class="ml-4">
                                    <span style="color: black!important">Jumlah Permohonan</span>
                                    <h4 class="mb-0 font-weight-medium">500</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="icon-in-bg bg-orange text-white rounded-circle"><i class="fa fa-search" style="color: white!important"></i></div>
                                <div class="ml-4">
                                    <span style="color: black!important">Deraf</span>
                                    <h4 class="mb-0 font-weight-medium">10</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-3 col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="icon-in-bg bg-green text-white rounded-circle"><i class="fa fa-check-circle" style="color: white!important"></i></div>
                                <div class="ml-4">
                                    <span style="color: black!important">Hantar</span>
                                    <h4 class="mb-0 font-weight-medium">23</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="icon-in-bg bg-yellow text-white rounded-circle"><i class="fa fa-reply-all" style="color: white!important"></i></div>
                                <div class="ml-4">
                                    <span style="color: black!important">Dikembalikan</span>
                                    <h4 class="mb-0 font-weight-medium">3</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                </div>
	
        <div class="row clearfix">
			<div class="col-lg-12">
				<div class="card">
					<div class="header">
						<h2>Senarai Permohonan</h2>
					</div>

					<div class="body">
						<div class="table-responsive">
							<table id="sortTable" class="table table-striped table-hover dataTable js-exportable">
								<thead>
									<tr>
										<th style="width: 17%"><b>ID Permohonan</b></th>                                        
										<th style="width: 33%"><b>Nama</b></th>
										<th style="width: 15%" class="text-center"><b>Tarikh Permohonan</b></th>
										<th style="width: 15%" class="text-center"><b>Status Permohonan</b></th>
									</tr>
								</thead>

                                <tbody>
                                    <tr>
                                        <td><a href="{{ url('maklumat-perbaharui') }}" title="">KPTPPK/3/970204052445</a></td>
                                        <td>Sarah Binti Yusri</td>
                                        <td class="text-center">05/03/2023</td>
                                        <td class="text-center"><button type="button" class="btn btn-success btn-sm">Hantar</button></td>
                                    </tr>  
                                        
                                        <tr>
                                            <td><a href="{{ url('maklumat-pemohon') }}" title="">KPTBKOKU/6/980112105666</a></td>
                                            <td>Aishah Binti Samsudin</td>
                                            <td class="text-center">02/03/2023</td>
                                            <td class="text-center"><button type="button" class="btn btn-warning btn-sm">Dikembalikan</button></td>
                                        </tr>

                                        <tr data-status="Baru">
                                            <td><a href="{{ url('maklumat-pemohon') }}" title="">KPTBKOKU/4/990404080221</a></td>
                                            <td>Mohd Ali Bin Abu Kassim</td>
                                            <td class="text-center">27/07/2023</td>
                                            <td class="text-center"><button type="button" class="btn btn-success btn-sm">Hantar</button></td>
                                        </tr>

                                        <tr data-status="Dikembalikan">
                                            <td><a href="{{ url('maklumat-pemohon') }}" title="">KPTBKOKU/4/960909105668</a></td>
                                            <td>Ling Kai Jie</td>
                                            <td class="text-center">09/04/2023</td>
                                            <td class="text-center"><button type="button" class="btn btn-warning btn-sm">Dikembalikan</button></td>
                                        </tr>
                                        
                                        <tr data-status="Saringan">
                                            <td><a href="{{ url('maklumat-pemohon') }}" title="">KPTPPK/6/950804082447</a></td>
                                            <td>Akmal Bin Kairuddin</td>
                                            <td class="text-center">27/4/2023</td>
                                            <td class="text-center"><button type="button" class="btn btn-warning btn-sm">Dikembalikan</button></td>
                                        </tr>

                                        <tr data-status="Tidak Layak">
                                            <td><a href="{{ url('maklumat-pemohon') }}" title="">KPTPPK/2/021212050334</a></td>
                                            <td>Santishwaran A/L Paven</td>
                                            <td class="text-center">05/06/2023</td>
                                            <td class="text-center"><button type="button" class="btn btn-success btn-sm">Layak</button></td>
                                        </tr>

                                        <tr>
                                            <td><a href="{{ url('maklumat-pemohon') }}" title="">KPTBKOKU/3/001205034745</a></td>
                                            <td>Choo Mei Ling</td>
                                            <td class="text-center">07/06/2023</td>
                                            <td class="text-center"><button type="button" class="btn btn-warning btn-sm">Dikembalikan</button></td>
                                        </tr>
                                        
                                        <tr data-status="Saringan">
                                            <td><a href="{{ url('maklumat-pemohon') }}" title="">KPTBKOKU/6/890201065225</a></td>
                                            <td>Ezra Hanisah Binti Md Yunos</td>
                                            <td class="text-center">19/02/2023</td>
                                            <td class="text-center"><button type="button" class="btn btn-sm" style="background-color:orange; color:white;">Deraf</button></td>
                                        </tr>
                                        
                                        <tr data-status="Layak">
                                            <td><a href="{{ url('maklumat-pemohon') }}" title="">KPTPPK/2/010305058473</a></td>
                                            <td>Arshahad Bin Kairul Zaman</td>
                                            <td class="text-center">26/05/2023</td>
                                            <td class="text-center"><button type="button" class="btn btn-success btn-sm">Layak</button></td>
                                        </tr>
                                        
                                        <tr data-status="Disokong">
                                            <td><a href="{{ url('maklumat-pemohon') }}" title="">KPTPPK/3/981004045253</a></td>
                                            <td>Syed Abdul Kassim Hussain Yusof</td>
                                            <td class="text-center">25/05/2023</td>
                                            <td class="text-center"><button type="button" class="btn btn-sm" style="background-color:orange; color:white;">Deraf</button></td>
                                        </tr>
                                        
                                        <tr data-status="Disokong">
                                            <td><a href="{{ url('maklumat-pemohon') }}" title="">KPTBKOKU/3/990201051446</a></td>
                                            <td>Shakira Mariam Aqilah Binti Syed Abdul Rahman</td>
                                            <td class="text-center">07/06/2023</td>
                                            <td class="text-center"><button type="button" class="btn btn-sm btn-success">Layak</button></td>
                                        </tr>
                                        
                                        <tr data-status="Baru">
                                            <td><a href="{{ url('maklumat-pemohon') }}" title="">KPTBKOKU/5/940524032341</a></td>
                                            <td>Rahman Mohammed Arshahad Al-dhaqm</td>
                                            <td class="text-center">09/07/2023</td>
                                            <td class="text-center"><button type="button" class="btn btn-warning btn-sm">Dikembalikan</button></td>
                                        </tr>
                                    </tbody>
							</table>
						</div>
					</div>
					{{-- End of Body --}}
				</div>
			</div>
		</div>                             
</x-default-layout> 
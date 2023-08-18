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
                                    <h4 class="mb-0 font-weight-medium"></h4>
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
						<h2>Senarai Permohonan Baru</h2>
					</div>

					<div class="body">
						<div class="table-responsive">
							<table id="sortTable" class="table table-striped table-hover dataTable js-exportable">
								<thead>
									<tr>
										<th style="width: 17%"><b>ID Permohonan</b></th>                                        
										<th style="width: 33%"><b>Nama</b></th>
										<th style="width: 15%"><b>Jenis Permohonan</b></th>
										<th style="width: 15%" class="text-center"><b>Tarikh Permohonan</b></th>
										<th style="width: 15%" class="text-center"><b>Status Saringan</b></th>
									</tr>
								</thead>
							</table>
						</div>
					</div>
					{{-- End of Body --}}
				</div>
			</div>
		</div>                             
</x-default-layout> 
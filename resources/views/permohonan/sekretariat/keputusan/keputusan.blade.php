<x-default-layout>
    <head>
        <title>Sekretariat BKOKU KPT</title>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">

        <!-- MAIN CSS -->
        <link rel="stylesheet" href="/assets/css/sekretariat.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
        <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/datetime/1.5.1/js/dataTables.dateTime.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>


        <style>
            /* .nav{
                margin-left: 20px!important;
            } */

            .custom-width-select {
                width: 400px !important; 
            }
            .form-select {
                    margin-left: 10px !important; 
            }
            .keputusan-status-btn {
                align-items: center;
                display: inline-flex;
                gap: 6px;
                justify-content: center;
                width: 125px;
            }

            .keputusan-status-pill {
                align-items: center;
                border: 0;
                border-radius: 8px;
                color: #fff !important;
                display: inline-flex;
                font-weight: 700;
                gap: 8px;
                justify-content: center;
                min-height: 40px;
                padding: 9px 14px;
                text-align: center;
                white-space: nowrap;
                width: 142px;
            }

            .keputusan-status-pill:hover {
                color: #fff !important;
                text-decoration: none;
            }

            .keputusan-status-layak { background-color: #50cd89; }
            .keputusan-status-tidak-layak { background-color: #f1416c; }

            @media (max-width: 768px) {
                .nav-tabs {
                    display: flex;
                    flex-direction: column;
                    gap: 10px; /* Add space between the buttons */
                    width: 100%; /* Ensure it takes full width */
                }

                .nav-tabs .nav-item {
                    flex: 1; /* Make each item take equal width */
                }

                .nav-tabs .nav-link {
                    display: block;
                    text-align: center;
                    width: 100%; 
                    padding: 10px;
                    font-size: 16px;
                    font-weight: bold;
                    border: none; /* Remove default borders */
                    border-radius: 5px; /* Add rounded corners */
                }

                .nav-tabs .nav-link.active {
                    background-color: #003366; /* Change active tab background color */
                    color: white; /* Active tab text color */
                }

                .nav-tabs .nav-link {
                    background-color: #f8f9fa; /* Inactive tab background color */
                    color: black; /* Inactive tab text color */
                }

                .custom-width-select {
                    width: 100% !important; /* override desktop */
                }

                .form-select {
                    margin-left: 0 !important; /* remove left margin */
                }
                
            }
        </style>
    </head>

    <!--begin::Page title-->
	<div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
		<!--begin::Title-->
		<h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Permohonan</h1>
		<!--end::Title-->
		<!--begin::Breadcrumb-->
		<ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
			<!--begin::Item-->
			<li class="breadcrumb-item text-dark" style="color:darkblue">Permohonan</li>
			<!--end::Item-->
			<!--begin::Item-->
			<li class="breadcrumb-item">
				<span class="bullet bg-gray-400 w-5px h-2px"></span>
			</li>
			<!--end::Item-->
			<!--begin::Item-->
			<li class="breadcrumb-item text-dark" style="color:darkblue">Keputusan</li>
			<!--end::Item-->
		</ul>
	<!--end::Breadcrumb-->
	</div>
	<!--end::Page title-->
    <br>

    <body>
        @if($notifikasi!=NULL)
            @if($keputusan=="Lulus")
                <div class="alert alert-success" role="alert" style="margin: 0px 15px 20px 15px; color:black!important;">
                    {{ $notifikasi }}
                </div>
            @elseif($keputusan=="Tidak Lulus")
                <div class="alert alert-danger" role="alert" style="margin: 0px 15px 20px 15px; color:black!important;">
                    {{ $notifikasi }}
                </div>
            @endif
        @endif

        <!-- Main body part  -->
        <div id="main-content">
            <div class="container-fluid">
                <div class="block-header">
                    <div class="row clearfix">
                        <div class="card">
                            <div class="header">
                                <h2>Senarai Keputusan Permohonan
                                    <br><small>Surat tawaran bagi permohonan berstatus layak boleh dimuat turun dengan klik pada kotak "Layak".</small>
                                </h2>
                            </div>

                            {{-- Javascript Nav Bar --}}
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active" id="keseluruhan-tab" data-toggle="tab" data-target="#keseluruhan" type="button" role="tab" aria-controls="keseluruhan" aria-selected="true">KESELURUHAN</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="bkokuUA-tab" data-toggle="tab" data-target="#bkokuUA" type="button" role="tab" aria-controls="bkokuUA" aria-selected="false">BKOKU UA</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="bkokuPOLI-tab" data-toggle="tab" data-target="#bkokuPOLI" type="button" role="tab" aria-controls="bkokuPOLI" aria-selected="true">BKOKU POLI</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="bkokuKK-tab" data-toggle="tab" data-target="#bkokuKK" type="button" role="tab" aria-controls="bkokuKK" aria-selected="true">BKOKU KK</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="bkokuIPTS-tab" data-toggle="tab" data-target="#bkokuIPTS" type="button" role="tab" aria-controls="bkokuIPTS" aria-selected="true">BKOKU IPTS</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="ppk-tab" data-toggle="tab" data-target="#ppk" type="button" role="tab" aria-controls="ppk" aria-selected="false">PPK</button>
                                </li>
                            </ul>

                            <!--begin::Card title-->
                            <div class="card-title">
                                <!--begin::Search-->
                                <div class="d-flex align-items-center position-relative my-1">
                                    <input type="hidden" data-kt-subscription-table-filter="search" >
                                </div>
                                <!--end::Search-->
                            </div>
                            <!--begin::Card title-->

                            <!--begin::Card toolbar-->
                            <div class="card-toolbar">
                                <!--begin::Toolbar-->
                                <div class="d-flex justify-content-between mt-5 mb-0" data-kt-subscription-table-toolbar="base">
                                    <!--begin::Filter-->
                                    <div class="col-md-12" data-kt-subscription-table-filter="form">
                                        <!--begin::Input group-->
                                        <div class="row g-3 align-items-center">

                                            <!-- Row 1: Date range -->
                                            <div class="col-md-8 d-flex align-items-center" style="margin-left:1%;">
                                                <input type="date" name="start_date" id="start_date" class="form-control me-2" />
                                                <span class="mx-2">-</span>
                                                <input type="date" name="end_date" id="end_date" class="form-control" />
                                            </div>

                                            <!-- Row 2: Keputusan + Institusi + Filter button -->
                                            <div class="col-md-4">
                                                <select id="status" name="status" class="form-select js-example-basic-single">
                                                    <option value="">Pilih Keputusan</option>
                                                    <option value="Lulus">Layak</option>
                                                    <option value="Tidak Lulus">Tidak Layak</option>
                                                </select>
                                            </div>

                                            <div class="col-md-4">
                                                <select id="institusiDropdown" name="institusi" class="form-select js-example-basic-single">
                                                    <option value="">Pilih Institusi Pengajian</option>
                                                </select>
                                            </div>
                                            <div class="col-md-1">
                                                
                                            </div>

                                            <div class="col-md-1 d-flex">
                                                <button type="submit" class="btn btn-primary fw-semibold"
                                                        data-kt-menu-dismiss="true"
                                                        data-kt-subscription-table-filter="filter"
                                                        onclick="applyFilter()">
                                                    <i class="ki-duotone ki-filter fs-2">
                                                        <span class="path1"></span>
                                                        <span class="path2"></span>
                                                    </i>
                                                </button>
                                            </div>

                                            <!-- Export buttons -->
                                            <div class="col-md-2 export-container" data-program-code="IPTS"> 
                                                <a id="exportIPTS" href="{{ route('senarai.keputusan.BKOKU.IPTS.pdf', [
                                                    'start_date' => Request::get('start_date'),
                                                    'end_date' => Request::get('end_date'),
                                                    'status' => Request::get('status'),
                                                    'institusi' => Request::get('institusi'),]) }}" 
                                                    target="_blank" class="btn btn-secondary btn-round" style="font-size:12px;">
                                                    <i class="fa fa-file-pdf" style="color: black;"></i> BKOKU IPTS
                                                </a>
                                            </div>

                                            <div class="col-md-2 export-container" data-program-code="POLI"> 
                                                <a id="exportPOLI" href="{{ route('senarai.keputusan.BKOKU.POLI.pdf', [
                                                    'start_date' => Request::get('start_date'),
                                                    'end_date' => Request::get('end_date'),
                                                    'status' => Request::get('status'),
                                                    'institusi' => Request::get('institusi'),]) }}" 
                                                    target="_blank" class="btn btn-secondary btn-round" style="font-size:12px;">
                                                    <i class="fa fa-file-pdf" style="color: black;"></i> BKOKU POLI
                                                </a>
                                            </div>

                                            <div class="col-md-2 export-container" data-program-code="KK"> 
                                                <a id="exportKK" href="{{ route('senarai.keputusan.BKOKU.KK.pdf', [
                                                    'start_date' => Request::get('start_date'),
                                                    'end_date' => Request::get('end_date'),
                                                    'status' => Request::get('status'),
                                                    'institusi' => Request::get('institusi'),]) }}" 
                                                    target="_blank" class="btn btn-secondary btn-round" style="font-size:12px;">
                                                    <i class="fa fa-file-pdf" style="color: black;"></i> BKOKU KK
                                                </a>
                                            </div>

                                            <div class="col-md-2 export-container" data-program-code="UA">
                                                <a id="exportUA" href="{{ route('senarai.keputusan.BKOKU.UA.pdf', [
                                                    'start_date' => Request::get('start_date'),
                                                    'end_date' => Request::get('end_date'),
                                                    'status' => Request::get('status'),
                                                    'institusi' => Request::get('institusi'),]) }}" 
                                                    target="_blank" class="btn btn-secondary btn-round" style="font-size:12px;">
                                                    <i class="fa fa-file-pdf" style="color: black;"></i> BKOKU UA
                                                </a>
                                            </div>
                    
                                            <div class="col-md-2 export-container" data-program-code="PPK">
                                                <a id="exportPPK" href="{{ route('senarai.keputusan.PPK.pdf', [
                                                    'start_date' => Request::get('start_date'),
                                                    'end_date' => Request::get('end_date'),
                                                    'status' => Request::get('status'),
                                                    'institusi' => Request::get('institusi'),]) }}"
                                                    target="_blank" class="btn btn-secondary btn-round" style="font-size:12px;">
                                                    <i class="fa fa-file-pdf" style="color: black;"></i> PPK
                                                </a>
                                            </div>
                                            
                                        </div>
                                        <!--end::Input group-->
                                    </div>
                                    <!--end::Filter-->
                                </div>
                                <!--end::Toolbar-->
                            </div>
                            <!--end::Card toolbar-->

                            {{-- Content Navigation Bar --}}
                            <div class="tab-content mt-0" id="myTabContent">
                                {{-- KESELURUHAN --}}
                                <div class="tab-pane fade show active" id="keseluruhan" role="tabpanel" aria-labelledby="keseluruhan-tab">
                                    <div class="body">
                                        <div class="table-responsive" id="table-responsive">
                                            <table id="sortTable6" class="table table-bordered table-striped" style="margin-top: 0 !important;">
                                                <thead>
                                                    <tr>
                                                        <th style="width: 10% !important;"><b>ID Permohonan</b></th>
                                                        <th class="text-center" style="width: 8% !important;"><b>Program</b></th>
                                                        <th style="width: 22% !important;"><b>Nama</b></th>
                                                        <th class="text-center" style="width: 20% !important;"><b>Institusi Pengajian</b></th>
                                                        <th class="text-center" style="width: 15%"><b>ID Institusi</b></th>
                                                        <th class="text-center" style="width: 10%"><b>Status</b></th>
                                                        <th class="text-center" style="width: 10% !important;"><b>Peringkat Pengajian</b></th>
                                                        <th class="text-center" style="width: 10% !important;"><b>Yuran Disokong (RM)</b></th>
                                                        <th class="text-center" style="width: 10% !important;"><b>Wang Saku Disokong (RM)</b></th>
                                                        <th class="text-center" style="width: 15% !important;"><b>No. Mesyuarat</b></th>
                                                        <th class="text-center" style="width: 10% !important;"><b>Tarikh Mesyuarat</b></th>
                                                        <th class="text-center" style="width: 10% !important;"><b>Status Permohonan</b></th>
                                                    </tr>
                                                </thead>
                                            </table>
                                        </div>
                                    </div>
                                </div>

                                {{-- BKOKU UA --}}
                                <div class="tab-pane fade" id="bkokuUA" role="tabpanel" aria-labelledby="bkokuUA-tab">
                                    <div class="body">
                                        <div class="table-responsive" id="table-responsive">
                                            <table id="sortTable4" class="table table-bordered table-striped" style="margin-top: 0 !important;">
                                                <thead>
                                                    <tr>
                                                        <th style="width: 10% !important;"><b>ID Permohonan</b></th>                                        
                                                        <th style="width: 25% !important;"><b>Nama</b></th>
                                                        <th class="text-center" style="width: 20% !important;"><b>Institusi Pengajian</b></th> 
                                                        <th class="text-center" style="width: 15%"><b>ID Institusi</b></th> 
                                                        <th class="text-center" style="width: 10%"><b>Status</b></th>
                                                        <th class="text-center" style="width: 10% !important;"><b>Peringkat Pengajian</b></th> 
                                                        <th class="text-center" style="width: 10% !important;"><b>Yuran Disokong (RM)</b></th> 
                                                        <th class="text-center" style="width: 10% !important;"><b>Wang Saku Disokong (RM)</b></th> 
                                                        <th class="text-center" style="width: 15% !important;"><b>No. Mesyuarat</b></th>
                                                        <th class="text-center" style="width: 10% !important;"><b>Tarikh Mesyuarat</b></th> 
                                                        <th class="text-center" style="width: 10% !important;"><b>Status Permohonan</b></th>
                                                    </tr>
                                                </thead>
                                            </table>
                                        </div>
                                    </div>
                                </div>

                                {{-- BKOKU POLI --}}
                                <div class="tab-pane fade" id="bkokuPOLI" role="tabpanel" aria-labelledby="bkokuPOLI-tab">
                                    <div class="body">
                                        <div class="table-responsive" id="table-responsive">
                                            <table id="sortTable2" class="table table-bordered table-striped" style="margin-top: 0 !important;">
                                                <thead>
                                                    <tr>
                                                        <th style="width: 10% !important;"><b>ID Permohonan</b></th>                                        
                                                        <th style="width: 25% !important;"><b>Nama</b></th>
                                                        <th class="text-center" style="width: 20% !important;"><b>Institusi Pengajian</b></th> 
                                                        <th class="text-center" style="width: 15%"><b>ID Institusi</b></th> 
                                                        <th class="text-center" style="width: 10%"><b>Status</b></th>
                                                        <th class="text-center" style="width: 10% !important;"><b>Peringkat Pengajian</b></th> 
                                                        <th class="text-center" style="width: 10% !important;"><b>Yuran Disokong (RM)</b></th> 
                                                        <th class="text-center" style="width: 10% !important;"><b>Wang Saku Disokong (RM)</b></th> 
                                                        <th class="text-center" style="width: 15% !important;"><b>No. Mesyuarat</b></th>
                                                        <th class="text-center" style="width: 10% !important;"><b>Tarikh Mesyuarat</b></th> 
                                                        <th class="text-center" style="width: 10% !important;"><b>Status Permohonan</b></th>
                                                    </tr>
                                                </thead>
                                            </table>
                                        </div>
                                    </div>
                                </div> 

                                {{-- BKOKU KK --}}
                                <div class="tab-pane fade" id="bkokuKK" role="tabpanel" aria-labelledby="bkokuKK-tab">
                                    <div class="body">
                                        <div class="table-responsive" id="table-responsive">
                                            <table id="sortTable3" class="table table-bordered table-striped" style="margin-top: 0 !important;">
                                                <thead>
                                                    <tr>
                                                        <th style="width: 10% !important;"><b>ID Permohonan</b></th>                                        
                                                        <th style="width: 25% !important;"><b>Nama</b></th>
                                                        <th class="text-center" style="width: 20% !important;"><b>Institusi Pengajian</b></th> 
                                                        <th class="text-center" style="width: 15%"><b>ID Institusi</b></th> 
                                                        <th class="text-center" style="width: 10%"><b>Status</b></th>
                                                        <th class="text-center" style="width: 10% !important;"><b>Peringkat Pengajian</b></th> 
                                                        <th class="text-center" style="width: 10% !important;"><b>Yuran Disokong (RM)</b></th> 
                                                        <th class="text-center" style="width: 10% !important;"><b>Wang Saku Disokong (RM)</b></th> 
                                                        <th class="text-center" style="width: 15% !important;"><b>No. Mesyuarat</b></th>
                                                        <th class="text-center" style="width: 10% !important;"><b>Tarikh Mesyuarat</b></th> 
                                                        <th class="text-center" style="width: 10% !important;"><b>Status Permohonan</b></th>
                                                    </tr>
                                                </thead>
                                            </table>
                                        </div>
                                    </div>
                                </div> 

                                {{-- BKOKU IPTS --}}
                                <div class="tab-pane fade" id="bkokuIPTS" role="tabpanel" aria-labelledby="bkokuIPTS-tab">
                                    <div class="body">
                                        <div class="table-responsive" id="table-responsive">
                                            <table id="sortTable1" class="table table-bordered table-striped" style="margin-top: 0 !important;">
                                                <thead>
                                                    <tr>
                                                        <th style="width: 10% !important;"><b>ID Permohonan</b></th>                                        
                                                        <th style="width: 25% !important;"><b>Nama</b></th>
                                                        <th class="text-center" style="width: 20% !important;"><b>Institusi Pengajian</b></th> 
                                                        <th class="text-center" style="width: 15%"><b>ID Institusi</b></th> 
                                                        <th class="text-center" style="width: 10%"><b>Status</b></th>
                                                        <th class="text-center" style="width: 10% !important;"><b>Peringkat Pengajian</b></th> 
                                                        <th class="text-center" style="width: 10% !important;"><b>Yuran Disokong (RM)</b></th> 
                                                        <th class="text-center" style="width: 10% !important;"><b>Wang Saku Disokong (RM)</b></th> 
                                                        <th class="text-center" style="width: 15% !important;"><b>No. Mesyuarat</b></th>
                                                        <th class="text-center" style="width: 10% !important;"><b>Tarikh Mesyuarat</b></th> 
                                                        <th class="text-center" style="width: 10% !important;"><b>Status Permohonan</b></th>
                                                    </tr>
                                                </thead>
                                               
                                            </table>
                                        </div>
                                    </div>
                                </div> 

                                {{-- PKK --}}
                                <div class="tab-pane fade" id="ppk" role="tabpanel" aria-labelledby="ppk-tab">
                                    <div class="body">
                                        <div class="table-responsive" id="table-responsive">
                                            <table id="sortTable5" class="table table-bordered table-striped" style="margin-top: 0 !important;">
                                                <thead>
                                                    <tr>
                                                        <th style="width: 10% !important;"><b>ID Permohonan</b></th>                                        
                                                        <th style="width: 25% !important;"><b>Nama</b></th>
                                                        <th class="text-center" style="width: 20% !important;"><b>Institusi Pengajian</b></th> 
                                                        <th class="text-center" style="width: 15%"><b>ID Institusi</b></th> 
                                                        <th class="text-center" style="width: 10%"><b>Status</b></th>
                                                        <th class="text-center" style="width: 10% !important;"><b>Peringkat Pengajian</b></th> 
                                                        <th class="text-center" style="width: 10% !important;"><b>Wang Saku Disokong (RM)</b></th> 
                                                        <th class="text-center" style="width: 15% !important;"><b>No. Mesyuarat</b></th>
                                                        <th class="text-center" style="width: 10% !important;"><b>Tarikh Mesyuarat</b></th> 
                                                        <th class="text-center" style="width: 10% !important;"><b>Status Permohonan</b></th>
                                                    </tr>
                                                </thead>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Javascript -->
        <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

        <script> 
            $(document).ready(function() {
                $('.js-example-basic-single').select2();
            });
        </script>   


        <script>
            $(document).ready(function() {
                // Initialize JavaScript variables with data from Blade
                var bkokuUAList = @json($institusiPengajianUA);
                var bkokuPOLIList = @json($institusiPengajianPOLI);
                var bkokuKKList = @json($institusiPengajianKK);
                var bkokuIPTSList = @json($institusiPengajianIPTS);
                var ppkList = @json($institusiPengajianPPK);
                var keseluruhanList = @json($institusiPengajianALL);

                function formatAmount(data) {
                    if (data === null || data === '') {
                        return '';
                    }

                    return parseFloat(data).toFixed(2);
                }

                $('.export-container[data-program-code="UA"]').hide();
                $('.export-container[data-program-code="POLI"]').hide();
                $('.export-container[data-program-code="KK"]').hide();
                $('.export-container[data-program-code="IPTS"]').hide();
                $('.export-container[data-program-code="PPK"]').hide();
                $('.none-container').show(); // Hide export elements


                // DataTable initialization functions
                function initializeDataTable6() {
                    $('#sortTable6').DataTable({
                        ordering: true,
                        order: [],
                        columnDefs: [
                            { orderable: false, targets: [0] },
                            { targets: [4], visible: false },
                            { targets: [5], visible: false },
                        ],
                        ajax: {
                            url: '{{ route("senarai.keputusan.ALL") }}',
                            dataSrc: ''
                        },
                        language: {
                            url: "/assets/lang/Malay.json"
                        },
                        columns: [
                            { data: 'no_rujukan_permohonan' },
                            {
                                data: 'program',
                                className: 'text-center',
                                render: function(data) {
                                    return data ? data.toUpperCase() : '';
                                }
                            },
                            {
                                data: 'smoku.nama',
                                render: function(data) {
                                    if (!data) {
                                        return '';
                                    }

                                    var conjunctions_lower = ['bin', 'binti'];
                                    var conjunctions_upper = ['A/L', 'A/P'];
                                    var words = data.split(' ');

                                    for (var i = 0; i < words.length; i++) {
                                        var word = words[i];

                                        if (conjunctions_lower.includes(word.toLowerCase())) {
                                            words[i] = word.toLowerCase();
                                        } else if (conjunctions_upper.includes(word.toUpperCase())) {
                                            words[i] = word.toUpperCase();
                                        } else if (word.charAt(0) === "'" && word.length > 1) {
                                            words[i] = "'" + word.charAt(1).toUpperCase() + word.slice(2).toLowerCase();
                                        } else {
                                            words[i] = word.charAt(0).toUpperCase() + word.slice(1).toLowerCase();
                                        }
                                    }

                                    return words.join(' ');
                                }
                            },
                            { data: 'akademik.infoipt.nama_institusi' },
                            { data: 'akademik.infoipt.id_institusi' },
                            {
                                data: null,
                                render: function(data, type, row) {
                                    return getKelulusanValue(row, 'keputusan');
                                }
                            },
                            {
                                data: 'akademik.peringkat.peringkat',
                                render: function(data) {
                                    if (!data) {
                                        return '';
                                    }

                                    var words = data.split(' ');
                                    for (var i = 0; i < words.length; i++) {
                                        words[i] = words[i].charAt(0).toUpperCase() + words[i].slice(1).toLowerCase();
                                    }

                                    return words.join(' ');
                                },
                                className: 'text-center'
                            },
                            {
                                data: 'yuran_disokong',
                                className: 'text-center',
                                render: function(data) {
                                    return formatAmount(data);
                                }
                            },
                            {
                                data: 'wang_saku_disokong',
                                className: 'text-center',
                                render: function(data) {
                                    return formatAmount(data);
                                }
                            },
                            {
                                data: null,
                                className: 'text-center',
                                render: function(data, type, row) {
                                    return getKelulusanValue(row, 'no_mesyuarat');
                                }
                            },
                            {
                                data: null,
                                render: function(data, type, row) {
                                    var tarikhMesyuarat = getKelulusanValue(row, 'tarikh_mesyuarat');
                                    if (type === 'display' || type === 'filter') {
                                        if (!tarikhMesyuarat) {
                                            return '';
                                        }

                                        var date = new Date(tarikhMesyuarat);
                                        var year = date.getFullYear();
                                        var month = ('0' + (date.getMonth() + 1)).slice(-2);
                                        var day = ('0' + date.getDate()).slice(-2);

                                        return day + '/' + month + '/' + year;
                                    }

                                    return tarikhMesyuarat;
                                },
                                className: 'text-center'
                            },
                            {
                                data: null,
                                render: function(data, type, row) {
                                    var status = '';
                                    var keputusan = getKelulusanValue(row, 'keputusan');

                                    switch (keputusan) {
                                        case 'Lulus':
                                            var route = row.program === 'PPK'
                                                ? "{{ route('generate-pdfPPK', ['permohonanId' => ':permohonanId']) }}"
                                                : "{{ route('generate-pdf', ['permohonanId' => ':permohonanId']) }}";
                                            var url = route.replace(':permohonanId', row.id);
                                            status = '<a href="' + url + '" class="keputusan-status-pill keputusan-status-layak">' +
                                                        '<i class="fa fa-download fa-sm custom-white-icon" style="color: white !important;"></i> Layak' +
                                                    '</a>';
                                            break;
                                        case 'Tidak Lulus':
                                            status = '<span class="keputusan-status-pill keputusan-status-tidak-layak">Tidak Layak</span>';
                                            break;
                                        default:
                                            status = '';
                                            break;
                                    }

                                    return status;
                                }
                            }
                        ]
                    });
                }

                function initializeDataTable4() {
                    $('#sortTable4').DataTable({
                        ordering: true, // Enable manual sorting
                            order: [], // Disable initial sorting
                            columnDefs: [
                                { orderable: false, targets: [0] },
                                { targets: [3], visible: false }, // Hide column (index 4)
                                { targets: [4], visible: false }, // Hide column (index 5)
                            ],
                        ajax: {
                            url: '{{ route("senarai.keputusan.UA") }}', // URL to fetch data from
                            dataSrc: '' // Property in the response object containing the data array
                            
                        },
                        language: {
                            url: "/assets/lang/Malay.json"
                        },
                        columns: [
                            { 
                                data: 'no_rujukan_permohonan',
                            }, 
                            { 
                                data: 'smoku.nama', 
                                render: function(data, type, row) {
                                    // Define conjunctions to be handled differently
                                    var conjunctions_lower = ['bin', 'binti'];
                                    var conjunctions_upper = ['A/L', 'A/P'];

                                    // Split the nama field into words
                                    var words = data.split(' ');

                                    // Process each word
                                    for (var i = 0; i < words.length; i++) {
                                        var word = words[i];

                                        // Check if the word is a conjunction to be displayed in lowercase
                                        if (conjunctions_lower.includes(word.toLowerCase())) {
                                            // Convert the word to lowercase
                                            words[i] = word.toLowerCase();
                                        } else if (conjunctions_upper.includes(word.toUpperCase())) {
                                            // Convert the word to uppercase
                                            words[i] = word.toUpperCase();
                                        } else {
                                            // Capitalize the first letter of other words
                                            if (word.charAt(0) === "'" && word.length > 1) {
                                                words[i] = "'" + word.charAt(1).toUpperCase() + word.slice(2).toLowerCase();
                                            } else {
                                                words[i] = word.charAt(0).toUpperCase() + word.slice(1).toLowerCase();
                                            }
                                        }
                                    }

                                    // Join the words back into a single string
                                    var formatted_nama = words.join(' ');

                                    return formatted_nama;
                                }
                            },
                            { data: 'akademik.infoipt.nama_institusi' }, 
                            { data: 'akademik.infoipt.id_institusi' },
                            { 
                                data: null,
                                render: function(data, type, row) {
                                    return getKelulusanValue(row, 'keputusan');
                                }
                            },
                            {
                                data: 'akademik.peringkat.peringkat',
                                className: 'text-center',
                                render: function(data, type, row) {
                                    // Split the string into an array of words
                                    var words = data.split(' ');

                                    // Capitalize the first letter of each word
                                    for (var i = 0; i < words.length; i++) {
                                        words[i] = words[i].charAt(0).toUpperCase() + words[i].slice(1).toLowerCase();
                                    }

                                    // Join the words back into a single string
                                    var formatted_data = words.join(' ');

                                    return formatted_data;
                                }
                            },
                            {
                                data: 'yuran_disokong',
                                className: 'text-center',
                                render: function(data, type, row) {
                                    return formatAmount(data);
                                }
                            },
                            {
                                data: 'wang_saku_disokong',
                                className: 'text-center',
                                render: function(data, type, row) {
                                    return formatAmount(data);
                                }
                            },
                            {
                                data: null,
                                className: 'text-center',
                                render: function(data, type, row) {
                                    return getKelulusanValue(row, 'no_mesyuarat');
                                }
                            },
                            {
                                data: null,
                                className: 'text-center',
                                render: function(data, type, row) {
                                    var tarikhMesyuarat = getKelulusanValue(row, 'tarikh_mesyuarat');
                                    if (type === 'display' || type === 'filter') {
                                        if (!tarikhMesyuarat) {
                                            return '';
                                        } else {
                                            // Convert the date to a JavaScript Date object
                                            var date = new Date(tarikhMesyuarat);

                                            // Get the year, month, and day components
                                            var year = date.getFullYear();
                                            var month = ('0' + (date.getMonth() + 1)).slice(-2); // Add leading zero if needed
                                            var day = ('0' + date.getDate()).slice(-2); // Add leading zero if needed

                                            // Return the formatted date as DD/MM/YYYY
                                            return day + '/' + month + '/' + year;
                                        }
                                    } else {
                                        // For sorting and other purposes, return the original data
                                        return tarikhMesyuarat;
                                    }
                                }
                            },
                            {
                                data: null,
                                className: 'text-center',
                                render: function(data, type, row) {
                                    var status = ''; // Initialize an empty string for the button HTML
                                    var keputusan = getKelulusanValue(row, 'keputusan');

                                    // Define the button HTML based on the status value
                                    switch (keputusan) {
                                        case 'Lulus':
                                            var route = "{{ route('generate-pdf', ['permohonanId' => ':permohonanId']) }}";
                                            var url = route.replace(':permohonanId', row.id);
                                            status = '<a href="' + url + '" class="keputusan-status-pill keputusan-status-layak">' +
                                                        '<i class="fa fa-download fa-sm custom-white-icon" style="color: white !important;"></i> Layak' +
                                                    '</a>';
                                            break;
                                        case 'Tidak Lulus':
                                            status = '<span class="keputusan-status-pill keputusan-status-tidak-layak">Tidak Layak</span>';
                                            break;
                                        default:
                                            status = ''; // Set empty string for unknown status values
                                            break;
                                    }
                                    return status;
                                }
                            }
                            
                        ]
                        

                    });
                }

                function getKelulusanValue(row, key) {
                    return row && row.kelulusan && row.kelulusan[key] ? row.kelulusan[key] : '';
                }

                function initializeDataTable1() {
                    $('#sortTable1').DataTable({
                        ordering: true, // Enable manual sorting
                            order: [], // Disable initial sorting
                            columnDefs: [
                                { orderable: false, targets: [0] },
                                { targets: [3], visible: false }, // Hide column (index 4)
                                { targets: [4], visible: false }, // Hide column (index 5)
                            ],
                        ajax: {
                            url: '{{ route("senarai.keputusan.IPTS") }}', // URL to fetch data from
                            dataSrc: '' // Property in the response object containing the data array
                            
                        },
                        language: {
                            url: "/assets/lang/Malay.json"
                        },
                        columns: [
                            { 
                                data: 'no_rujukan_permohonan',
                            }, 
                            { 
                                data: 'smoku.nama', 
                                render: function(data, type, row) {
                                    // Define conjunctions to be handled differently
                                    var conjunctions_lower = ['bin', 'binti'];
                                    var conjunctions_upper = ['A/L', 'A/P'];

                                    // Split the nama field into words
                                    var words = data.split(' ');

                                    // Process each word
                                    for (var i = 0; i < words.length; i++) {
                                        var word = words[i];

                                        // Check if the word is a conjunction to be displayed in lowercase
                                        if (conjunctions_lower.includes(word.toLowerCase())) {
                                            // Convert the word to lowercase
                                            words[i] = word.toLowerCase();
                                        } else if (conjunctions_upper.includes(word.toUpperCase())) {
                                            // Convert the word to uppercase
                                            words[i] = word.toUpperCase();
                                        } else {
                                            // Capitalize the first letter of other words
                                            if (word.charAt(0) === "'" && word.length > 1) {
                                                words[i] = "'" + word.charAt(1).toUpperCase() + word.slice(2).toLowerCase();
                                            } else {
                                                words[i] = word.charAt(0).toUpperCase() + word.slice(1).toLowerCase();
                                            }
                                        }
                                    }

                                    // Join the words back into a single string
                                    var formatted_nama = words.join(' ');

                                    return formatted_nama;
                                }
                            },
                            { data: 'akademik.infoipt.nama_institusi' }, 
                            { data: 'akademik.infoipt.id_institusi' },
                            { 
                                data: null,
                                render: function(data, type, row) {
                                    return getKelulusanValue(row, 'keputusan');
                                }
                            },
                            {
                                data: 'akademik.peringkat.peringkat',
                                render: function(data, type, row) {
                                    // Split the string into an array of words
                                    var words = data.split(' ');

                                    // Capitalize the first letter of each word
                                    for (var i = 0; i < words.length; i++) {
                                        words[i] = words[i].charAt(0).toUpperCase() + words[i].slice(1).toLowerCase();
                                    }

                                    // Join the words back into a single string
                                    var formatted_data = words.join(' ');

                                    return formatted_data;
                                },
                                className: 'text-center'
                            },
                            {
                                data: 'yuran_disokong',
                                className: 'text-center',
                                render: function(data, type, row) {
                                    return formatAmount(data);
                                }
                            },
                            {
                                data: 'wang_saku_disokong',
                                className: 'text-center',
                                render: function(data, type, row) {
                                    return formatAmount(data);
                                }
                            },
                            {
                                data: null,
                                className: 'text-center',
                                render: function(data, type, row) {
                                    return getKelulusanValue(row, 'no_mesyuarat');
                                }
                            },
                            {
                                data: null,
                                render: function(data, type, row) {
                                    var tarikhMesyuarat = getKelulusanValue(row, 'tarikh_mesyuarat');
                                    if (type === 'display' || type === 'filter') {
                                        if (!tarikhMesyuarat) {
                                            return '';
                                        } else {
                                            // Convert the date to a JavaScript Date object
                                            var date = new Date(tarikhMesyuarat);

                                            // Get the year, month, and day components
                                            var year = date.getFullYear();
                                            var month = ('0' + (date.getMonth() + 1)).slice(-2); // Add leading zero if needed
                                            var day = ('0' + date.getDate()).slice(-2); // Add leading zero if needed

                                            // Return the formatted date as DD/MM/YYYY
                                            return day + '/' + month + '/' + year;
                                        }
                                    } else {
                                        // For sorting and other purposes, return the original data
                                        return tarikhMesyuarat;
                                    }
                                },
                                className: 'text-center'
                            },
                            {
                                data: null,
                                render: function(data, type, row) {
                                    var status = ''; // Initialize an empty string for the button HTML
                                    var keputusan = getKelulusanValue(row, 'keputusan');

                                    // Define the button HTML based on the status value
                                    switch (keputusan) {
                                        case 'Lulus':
                                            var route = "{{ route('generate-pdf', ['permohonanId' => ':permohonanId']) }}";
                                            var url = route.replace(':permohonanId', row.id);
                                            status = '<a href="' + url + '" class="keputusan-status-pill keputusan-status-layak">' +
                                                        '<i class="fa fa-download fa-sm custom-white-icon" style="color: white !important;"></i> Layak' +
                                                    '</a>';
                                            break;
                                        case 'Tidak Lulus':
                                            status = '<span class="keputusan-status-pill keputusan-status-tidak-layak">Tidak Layak</span>';
                                            break;
                                        default:
                                            status = ''; // Set empty string for unknown status values
                                            break;
                                    }

                                    return status;
                                }
                            }
                        ]
                        

                    });
                }

                function initializeDataTable2() {
                    $('#sortTable2').DataTable({
                        ordering: true, // Enable manual sorting
                            order: [], // Disable initial sorting
                            columnDefs: [
                                { orderable: false, targets: [0] },
                                { targets: [3], visible: false }, // Hide column (index 4)
                                { targets: [4], visible: false }, // Hide column (index 5)
                            ],
                        ajax: {
                            url: '{{ route("senarai.keputusan.POLI") }}', // URL to fetch data from
                            dataSrc: '' // Property in the response object containing the data array
                            
                        },
                        language: {
                            url: "/assets/lang/Malay.json"
                        },
                        columns: [
                            { 
                                data: 'no_rujukan_permohonan',
                            }, 
                            { 
                                data: 'smoku.nama', 
                                render: function(data, type, row) {
                                    // Define conjunctions to be handled differently
                                    var conjunctions_lower = ['bin', 'binti'];
                                    var conjunctions_upper = ['A/L', 'A/P'];

                                    // Split the nama field into words
                                    var words = data.split(' ');

                                    // Process each word
                                    for (var i = 0; i < words.length; i++) {
                                        var word = words[i];

                                        // Check if the word is a conjunction to be displayed in lowercase
                                        if (conjunctions_lower.includes(word.toLowerCase())) {
                                            // Convert the word to lowercase
                                            words[i] = word.toLowerCase();
                                        } else if (conjunctions_upper.includes(word.toUpperCase())) {
                                            // Convert the word to uppercase
                                            words[i] = word.toUpperCase();
                                        } else {
                                            // Capitalize the first letter of other words
                                            if (word.charAt(0) === "'" && word.length > 1) {
                                                words[i] = "'" + word.charAt(1).toUpperCase() + word.slice(2).toLowerCase();
                                            } else {
                                                words[i] = word.charAt(0).toUpperCase() + word.slice(1).toLowerCase();
                                            }
                                        }
                                    }

                                    // Join the words back into a single string
                                    var formatted_nama = words.join(' ');

                                    return formatted_nama;
                                }
                            },
                            { data: 'akademik.infoipt.nama_institusi' }, 
                            { data: 'akademik.infoipt.id_institusi' },
                            { 
                                data: null,
                                render: function(data, type, row) {
                                    return getKelulusanValue(row, 'keputusan');
                                }
                            },
                            {
                                data: 'akademik.peringkat.peringkat',
                                render: function(data, type, row) {
                                    // Split the string into an array of words
                                    var words = data.split(' ');

                                    // Capitalize the first letter of each word
                                    for (var i = 0; i < words.length; i++) {
                                        words[i] = words[i].charAt(0).toUpperCase() + words[i].slice(1).toLowerCase();
                                    }

                                    // Join the words back into a single string
                                    var formatted_data = words.join(' ');

                                    return formatted_data;
                                },
                                className: 'text-center'
                            },
                            {
                                data: 'yuran_disokong',
                                className: 'text-center',
                                render: function(data, type, row) {
                                    return formatAmount(data);
                                }
                            },
                            {
                                data: 'wang_saku_disokong',
                                className: 'text-center',
                                render: function(data, type, row) {
                                    return formatAmount(data);
                                }
                            },
                            {
                                data: null,
                                className: 'text-center',
                                render: function(data, type, row) {
                                    return getKelulusanValue(row, 'no_mesyuarat');
                                }
                            },
                            {
                                data: null,
                                render: function(data, type, row) {
                                    var tarikhMesyuarat = getKelulusanValue(row, 'tarikh_mesyuarat');
                                    if (type === 'display' || type === 'filter') {
                                        if (!tarikhMesyuarat) {
                                            return '';
                                        } else {
                                            // Convert the date to a JavaScript Date object
                                            var date = new Date(tarikhMesyuarat);

                                            // Get the year, month, and day components
                                            var year = date.getFullYear();
                                            var month = ('0' + (date.getMonth() + 1)).slice(-2); // Add leading zero if needed
                                            var day = ('0' + date.getDate()).slice(-2); // Add leading zero if needed

                                            // Return the formatted date as DD/MM/YYYY
                                            return day + '/' + month + '/' + year;
                                        }
                                    } else {
                                        // For sorting and other purposes, return the original data
                                        return tarikhMesyuarat;
                                    }
                                },
                                className: 'text-center'
                            },
                            {
                                data: null,
                                render: function(data, type, row) {
                                    var status = ''; // Initialize an empty string for the button HTML
                                    var keputusan = getKelulusanValue(row, 'keputusan');

                                    // Define the button HTML based on the status value
                                    switch (keputusan) {
                                        case 'Lulus':
                                            var route = "{{ route('generate-pdf', ['permohonanId' => ':permohonanId']) }}";
                                            var url = route.replace(':permohonanId', row.id);
                                            status = '<a href="' + url + '" class="keputusan-status-pill keputusan-status-layak">' +
                                                        '<i class="fa fa-download fa-sm custom-white-icon" style="color: white !important;"></i> Layak' +
                                                    '</a>';
                                            break;
                                        case 'Tidak Lulus':
                                            status = '<span class="keputusan-status-pill keputusan-status-tidak-layak">Tidak Layak</span>';
                                            break;
                                        default:
                                            status = ''; 
                                            break;
                                    }

                                    return status;
                                }
                            }
                        ]
                    });
                }

                function initializeDataTable3() {
                    $('#sortTable3').DataTable({
                        ordering: true, // Enable manual sorting
                            order: [], // Disable initial sorting
                            columnDefs: [
                                { orderable: false, targets: [0] },
                                { targets: [3], visible: false }, // Hide column (index 4)
                                { targets: [4], visible: false }, // Hide column (index 5)
                            ],
                        ajax: {
                            url: '{{ route("senarai.keputusan.KK") }}', // URL to fetch data from
                            dataSrc: '' // Property in the response object containing the data array
                            
                        },
                        language: {
                            url: "/assets/lang/Malay.json"
                        },
                        columns: [
                            { 
                                data: 'no_rujukan_permohonan',
                            }, 
                            { 
                                data: 'smoku.nama', 
                                render: function(data, type, row) {
                                    // Define conjunctions to be handled differently
                                    var conjunctions_lower = ['bin', 'binti'];
                                    var conjunctions_upper = ['A/L', 'A/P'];

                                    // Split the nama field into words
                                    var words = data.split(' ');

                                    // Process each word
                                    for (var i = 0; i < words.length; i++) {
                                        var word = words[i];

                                        // Check if the word is a conjunction to be displayed in lowercase
                                        if (conjunctions_lower.includes(word.toLowerCase())) {
                                            // Convert the word to lowercase
                                            words[i] = word.toLowerCase();
                                        } else if (conjunctions_upper.includes(word.toUpperCase())) {
                                            // Convert the word to uppercase
                                            words[i] = word.toUpperCase();
                                        } else {
                                            // Capitalize the first letter of other words
                                            if (word.charAt(0) === "'" && word.length > 1) {
                                                words[i] = "'" + word.charAt(1).toUpperCase() + word.slice(2).toLowerCase();
                                            } else {
                                                words[i] = word.charAt(0).toUpperCase() + word.slice(1).toLowerCase();
                                            }
                                        }
                                    }

                                    // Join the words back into a single string
                                    var formatted_nama = words.join(' ');

                                    return formatted_nama;
                                }
                            },
                            { data: 'akademik.infoipt.nama_institusi' }, 
                            { data: 'akademik.infoipt.id_institusi' },
                            { 
                                data: null,
                                render: function(data, type, row) {
                                    return getKelulusanValue(row, 'keputusan');
                                }
                            },
                            {
                                data: 'akademik.peringkat.peringkat',
                                render: function(data, type, row) {
                                    // Split the string into an array of words
                                    var words = data.split(' ');

                                    // Capitalize the first letter of each word
                                    for (var i = 0; i < words.length; i++) {
                                        words[i] = words[i].charAt(0).toUpperCase() + words[i].slice(1).toLowerCase();
                                    }

                                    // Join the words back into a single string
                                    var formatted_data = words.join(' ');

                                    return formatted_data;
                                },
                                className: 'text-center'
                            },
                            {
                                data: 'yuran_disokong',
                                className: 'text-center',
                                render: function(data, type, row) {
                                    return formatAmount(data);
                                }
                            },
                            {
                                data: 'wang_saku_disokong',
                                className: 'text-center',
                                render: function(data, type, row) {
                                    return formatAmount(data);
                                }
                            },
                            {
                                data: null,
                                className: 'text-center',
                                render: function(data, type, row) {
                                    return getKelulusanValue(row, 'no_mesyuarat');
                                }
                            },
                            {
                                data: null,
                                render: function(data, type, row) {
                                    var tarikhMesyuarat = getKelulusanValue(row, 'tarikh_mesyuarat');
                                    if (type === 'display' || type === 'filter') {
                                        if (!tarikhMesyuarat) {
                                            return '';
                                        } else {
                                            // Convert the date to a JavaScript Date object
                                            var date = new Date(tarikhMesyuarat);

                                            // Get the year, month, and day components
                                            var year = date.getFullYear();
                                            var month = ('0' + (date.getMonth() + 1)).slice(-2); // Add leading zero if needed
                                            var day = ('0' + date.getDate()).slice(-2); // Add leading zero if needed

                                            // Return the formatted date as DD/MM/YYYY
                                            return day + '/' + month + '/' + year;
                                        }
                                    } else {
                                        // For sorting and other purposes, return the original data
                                        return tarikhMesyuarat;
                                    }
                                },
                                className: 'text-center'
                            },
                            {
                                data: null,
                                render: function(data, type, row) {
                                    var status = ''; // Initialize an empty string for the button HTML
                                    var keputusan = getKelulusanValue(row, 'keputusan');

                                    // Define the button HTML based on the status value
                                    switch (keputusan) {
                                        case 'Lulus':
                                            var route = "{{ route('generate-pdf', ['permohonanId' => ':permohonanId']) }}";
                                            var url = route.replace(':permohonanId', row.id);
                                            status = '<a href="' + url + '" class="keputusan-status-pill keputusan-status-layak">' +
                                                        '<i class="fa fa-download fa-sm custom-white-icon" style="color: white !important;"></i> Layak' +
                                                    '</a>';
                                            break;
                                        case 'Tidak Lulus':
                                            status = '<span class="keputusan-status-pill keputusan-status-tidak-layak">Tidak Layak</span>';
                                            break;
                                        default:
                                            status = ''; // Set empty string for unknown status values
                                            break;
                                    }

                                    return status;
                                }
                            }
                        ]
                    });
                }

                function initializeDataTable5() {
                    $('#sortTable5').DataTable({
                        ordering: true, // Enable manual sorting
                            order: [], // Disable initial sorting
                            columnDefs: [
                                { orderable: false, targets: [0] },
                                { targets: [3], visible: false }, // Hide column (index 4)
                                { targets: [4], visible: false }, // Hide column (index 5)
                            ],
                        ajax: {
                            url: '{{ route("senarai.keputusan.PPK") }}', // URL to fetch data from
                            dataSrc: '' // Property in the response object containing the data array
                            
                        },
                        language: {
                            url: "/assets/lang/Malay.json"
                        },
                        columns: [
                            { 
                                data: 'no_rujukan_permohonan',
                            }, 
                            { 
                                data: 'smoku.nama', 
                                render: function(data, type, row) {
                                    // Define conjunctions to be handled differently
                                    var conjunctions_lower = ['bin', 'binti'];
                                    var conjunctions_upper = ['A/L', 'A/P'];

                                    // Split the nama field into words
                                    var words = data.split(' ');

                                    // Process each word
                                    for (var i = 0; i < words.length; i++) {
                                        var word = words[i];

                                        // Check if the word is a conjunction to be displayed in lowercase
                                        if (conjunctions_lower.includes(word.toLowerCase())) {
                                            // Convert the word to lowercase
                                            words[i] = word.toLowerCase();
                                        } else if (conjunctions_upper.includes(word.toUpperCase())) {
                                            // Convert the word to uppercase
                                            words[i] = word.toUpperCase();
                                        } else {
                                            // Capitalize the first letter of other words
                                            if (word.charAt(0) === "'" && word.length > 1) {
                                                words[i] = "'" + word.charAt(1).toUpperCase() + word.slice(2).toLowerCase();
                                            } else {
                                                words[i] = word.charAt(0).toUpperCase() + word.slice(1).toLowerCase();
                                            }
                                        }
                                    }

                                    // Join the words back into a single string
                                    var formatted_nama = words.join(' ');

                                    return formatted_nama;
                                }
                            },
                            { data: 'akademik.infoipt.nama_institusi' }, 
                            { data: 'akademik.infoipt.id_institusi' },
                            { 
                                data: null,
                                render: function(data, type, row) {
                                    return getKelulusanValue(row, 'keputusan');
                                }
                            },
                            {
                                data: 'akademik.peringkat.peringkat',
                                render: function(data, type, row) {
                                    // Split the string into an array of words
                                    var words = data.split(' ');

                                    // Capitalize the first letter of each word
                                    for (var i = 0; i < words.length; i++) {
                                        words[i] = words[i].charAt(0).toUpperCase() + words[i].slice(1).toLowerCase();
                                    }

                                    // Join the words back into a single string
                                    var formatted_data = words.join(' ');

                                    return formatted_data;
                                },
                                className: 'text-center'
                            },
                            {
                                data: 'wang_saku_disokong',
                                className: 'text-center',
                                render: function(data, type, row) {
                                    return formatAmount(data);
                                }
                            },
                            {
                                data: null,
                                className: 'text-center',
                                render: function(data, type, row) {
                                    return getKelulusanValue(row, 'no_mesyuarat');
                                }
                            },
                            {
                                data: null,
                                render: function(data, type, row) {
                                    var tarikhMesyuarat = getKelulusanValue(row, 'tarikh_mesyuarat');
                                    if (type === 'display' || type === 'filter') {
                                        if (!tarikhMesyuarat) {
                                            return '';
                                        } else {
                                            // Convert the date to a JavaScript Date object
                                            var date = new Date(tarikhMesyuarat);

                                            // Get the year, month, and day components
                                            var year = date.getFullYear();
                                            var month = ('0' + (date.getMonth() + 1)).slice(-2); // Add leading zero if needed
                                            var day = ('0' + date.getDate()).slice(-2); // Add leading zero if needed

                                            // Return the formatted date as DD/MM/YYYY
                                            return day + '/' + month + '/' + year;
                                        }
                                    } else {
                                        // For sorting and other purposes, return the original data
                                        return tarikhMesyuarat;
                                    }
                                },
                                className: 'text-center'
                            },
                            {
                                data: null,
                                render: function(data, type, row) {
                                    var status = ''; // Initialize an empty string for the button HTML
                                    var keputusan = getKelulusanValue(row, 'keputusan');

                                    // Define the button HTML based on the status value
                                    switch (keputusan) {
                                        case 'Lulus':
                                            var route = "{{ route('generate-pdfPPK', ['permohonanId' => ':permohonanId']) }}";
                                            var url = route.replace(':permohonanId', row.id);
                                            status = '<a href="' + url + '" class="keputusan-status-pill keputusan-status-layak">' +
                                                        '<i class="fa fa-download fa-sm custom-white-icon" style="color: white !important;"></i> Layak' +
                                                    '</a>';
                                            break;
                                        case 'Tidak Lulus':
                                            status = '<span class="keputusan-status-pill keputusan-status-tidak-layak">Tidak Layak</span>';
                                            break;
                                        default:
                                            status = ''; // Set empty string for unknown status values
                                            break;
                                    }
                                    return status;
                                }
                            }
                        ]
                        

                    });
                }

                // Function to clear filters for all tables
                function clearFilters() {
                    if ($.fn.DataTable.isDataTable('#sortTable4')) {
                        $('#sortTable4').DataTable().destroy();
                    }
                    if ($.fn.DataTable.isDataTable('#sortTable1')) {
                        $('#sortTable1').DataTable().destroy();
                    }
                    if ($.fn.DataTable.isDataTable('#sortTable2')) {
                        $('#sortTable2').DataTable().destroy();
                    }
                    if ($.fn.DataTable.isDataTable('#sortTable3')) {
                        $('#sortTable3').DataTable().destroy();
                    }
                    if ($.fn.DataTable.isDataTable('#sortTable5')) {
                        $('#sortTable5').DataTable().destroy();
                    }
                    if ($.fn.DataTable.isDataTable('#sortTable6')) {
                        $('#sortTable6').DataTable().destroy();
                    }
                }

                // Function to update the institution dropdown
                function updateInstitusiDropdown(institusiList) {
                    // Clear existing options
                    $('#institusiDropdown').empty();

                    // Add default option
                    $('#institusiDropdown').append('<option value="">Pilih Institusi Pengajian</option>');

                    // Add options based on the selected tab
                    for (var i = 0; i < institusiList.length; i++) {
                        $('#institusiDropdown').append('<option value="' + institusiList[i].nama_institusi + '">' + institusiList[i].nama_institusi + '</option>');
                    }

                    $('#institusiDropdown').val('').trigger('change');
                }

                function clearDecisionFilters() {
                    $('#start_date').val('');
                    $('#end_date').val('');
                    $('#status').val('').trigger('change');
                    $('#institusiDropdown').val('').trigger('change');
                    $.fn.dataTable.ext.search = [];
                }

                function updateExportContainers(activeTabId) {
                    // Hide all export containers initially
                    $('.export-container').hide();

                    // Show the export container based on the active tab
                    var programCode = getProgramCode(activeTabId);
                    $('.export-container[data-program-code="' + programCode + '"]').show();
                }

                function getProgramCode(activeTabId) {
                    switch (activeTabId) {
                        case 'keseluruhan-tab':
                            return 'ALL';
                        case 'bkokuUA-tab':
                            return 'UA';
                        case 'bkokuIPTS-tab':
                            return 'IPTS';
                        case 'bkokuPOLI-tab':
                            return 'POLI';
                        case 'bkokuKK-tab':
                            return 'KK';
                        case 'ppk-tab':
                            return 'PPK';
                        default:
                            return '';
                    }
                }

                // Add an event listener for tab clicks
                $('#myTab .nav-link').on('click', function() {
                    // Get the ID of the active tab
                    var activeTabId = $(this).attr('id');

                    clearDecisionFilters();
                    updateExportLinks('', '', '', '');

                    // Clear filters when changing tabs
                    clearFilters();

                    updateExportContainers(activeTabId);

                    // Update the institution dropdown based on the active tab
                    switch (activeTabId) {
                        case 'keseluruhan-tab':
                            updateInstitusiDropdown(keseluruhanList);
                            initializeDataTable6();
                            break;
                        case 'bkokuUA-tab':
                            updateInstitusiDropdown(bkokuUAList);
                            initializeDataTable4();
                            break;
                        case 'bkokuIPTS-tab':
                            updateInstitusiDropdown(bkokuIPTSList);
                            initializeDataTable1();
                            break;
                        case 'bkokuPOLI-tab':
                            updateInstitusiDropdown(bkokuPOLIList);
                            initializeDataTable2();
                            break;
                        case 'bkokuKK-tab':
                            updateInstitusiDropdown(bkokuKKList);
                            initializeDataTable3();
                            break;
                        case 'ppk-tab':
                            updateInstitusiDropdown(ppkList);
                            initializeDataTable5();
                            break;
                    }
                });

                // Trigger the function for the default active tab
                updateInstitusiDropdown(keseluruhanList);
                initializeDataTable6();
            });

        </script>
      
        <script>

            function applyFilter() {
                var selectedInstitusi = $('[name="institusi"]').val();
                var startDate = $('#start_date').val();
                var endDate = $('#end_date').val();
                var status = $('#status').val();

                updateExportLinks(startDate, endDate, status, selectedInstitusi);

                var activeTabId = $('#myTab .nav-link.active').attr('id') || 'keseluruhan-tab';
                var tableConfig = {
                    'keseluruhan-tab': { selector: '#sortTable6', institusiColumn: 3, statusColumn: 5, dateColumn: 10 },
                    'bkokuUA-tab': { selector: '#sortTable4', institusiColumn: 2, statusColumn: 4, dateColumn: 9 },
                    'bkokuIPTS-tab': { selector: '#sortTable1', institusiColumn: 2, statusColumn: 4, dateColumn: 9 },
                    'bkokuPOLI-tab': { selector: '#sortTable2', institusiColumn: 2, statusColumn: 4, dateColumn: 9 },
                    'bkokuKK-tab': { selector: '#sortTable3', institusiColumn: 2, statusColumn: 4, dateColumn: 9 },
                    'ppk-tab': { selector: '#sortTable5', institusiColumn: 2, statusColumn: 4, dateColumn: 8 }
                };

                applyTableFilter(tableConfig[activeTabId], selectedInstitusi, startDate, endDate, status);
            }

            function updateExportLinks(startDate, endDate, status, selectedInstitusi) {
                var exportIPTS = document.getElementById('exportIPTS');
                exportIPTS.href = "{{ route('senarai.keputusan.BKOKU.IPTS.pdf') }}?start_date=" + startDate + "&end_date=" + endDate + "&status=" + status + "&institusi=" + selectedInstitusi;

                var exportPOLI = document.getElementById('exportPOLI');
                exportPOLI.href = "{{ route('senarai.keputusan.BKOKU.POLI.pdf') }}?start_date=" + startDate + "&end_date=" + endDate + "&status=" + status + "&institusi=" + selectedInstitusi;

                var exportKK = document.getElementById('exportKK');
                exportKK.href = "{{ route('senarai.keputusan.BKOKU.KK.pdf') }}?start_date=" + startDate + "&end_date=" + endDate + "&status=" + status + "&institusi=" + selectedInstitusi;
                
                var exportUA = document.getElementById('exportUA');
                exportUA.href = "{{ route('senarai.keputusan.BKOKU.UA.pdf') }}?start_date=" + startDate + "&end_date=" + endDate + "&status=" + status + "&institusi=" + selectedInstitusi;

                var exportPPK = document.getElementById('exportPPK');
                exportPPK.href = "{{ route('senarai.keputusan.PPK.pdf') }}?start_date=" + startDate + "&end_date=" + endDate + "&status=" + status + "&institusi=" + selectedInstitusi;
            }

            function parseDateInput(value) {
                if (!value) {
                    return null;
                }

                var parts = value.split('-');
                return new Date(Number(parts[0]), Number(parts[1]) - 1, Number(parts[2]));
            }

            function parseDateDisplay(value) {
                if (!value) {
                    return null;
                }

                var parts = value.split('/');
                if (parts.length !== 3) {
                    return null;
                }

                return new Date(Number(parts[2]), Number(parts[1]) - 1, Number(parts[0]));
            }

            function applyTableFilter(config, institusi, startDate, endDate, status) {
                if (!config || !$.fn.DataTable.isDataTable(config.selector)) {
                    return;
                }

                var table = $(config.selector).DataTable();

                table.columns().search('');
                $.fn.dataTable.ext.search = [];

                if (startDate || endDate) {
                    var startDateObj = parseDateInput(startDate);
                    var endDateObj = parseDateInput(endDate);
                    var tableId = config.selector.replace('#', '');

                    $.fn.dataTable.ext.search.push(function (settings, data) {
                        if (settings.nTable.id !== tableId) {
                            return true;
                        }

                        var dateAdded = parseDateDisplay(data[config.dateColumn]);
                        if (!dateAdded) {
                            return false;
                        }

                        return (!startDateObj || dateAdded >= startDateObj) &&
                            (!endDateObj || dateAdded <= endDateObj);
                    });
                }

                if (institusi) {
                    table.column(config.institusiColumn).search(institusi);
                }

                if (status) {
                    table.column(config.statusColumn).search(status);
                }

                table.page(0).draw(false);
            }

        </script>
    </body>
</x-default-layout> 

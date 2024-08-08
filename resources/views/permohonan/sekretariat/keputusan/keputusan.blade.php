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
        <script src="/assets/lang/Malay.json"></script>
        <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
        <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/datetime/1.5.1/js/dataTables.dateTime.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>

        <style>
            .nav{
                margin-left: 20px!important;
            }

            .dash {
                width: 15px;
                height: 1px;
                background: black;
                margin: 0 5px;
                margin-bottom: 20px;
                display: inline-block;
                background-color: #fff; /* Set background color to white or your container's background color */
            }

            .form-filter {
                margin-left: 20px !important; 
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
                                    <button class="nav-link active" id="bkokuUA-tab" data-toggle="tab" data-target="#bkokuUA" type="button" role="tab" aria-controls="bkokuUA" aria-selected="true">BKOKU UA</button>
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
                                        <div class="row form-filter" >
                                            <div class="col-md-4" style="display: flex; align-items: center;">
                                                <div class="flex-grow-1">
                                                    <input type="date" name="start_date" id="start_date" value="" class="form-control" />
                                                </div>
                                            
                                                <div class="dash">-</div>
                                            
                                                <div class="flex-grow-1">
                                                    <input type="date" name="end_date" id="end_date" value="" class="form-control" />
                                                </div>
                                            </div>
                                            
                                            <div class="col-md-2">
                                                <select id="status" name="status" class="form-select">
                                                    <option value="">Pilih Keputusan</option>
                                                    <option value="Lulus">Layak</option>
                                                    <option value="Tidak Lulus">Tidak Layak</option>
                                                </select>
                                            </div> 

                                            <div class="col-md-3">
                                                <select id="institusiDropdown" name="institusi" class="form-select js-example-basic-single">
                                                    <option value="">Pilih Institusi Pengajian</option>
                                                </select>
                                            </div>

                                            <div class="col-md-1 fv-row">
                                                <!--begin::Actions-->
                                                <button type="submit" class="btn btn-primary fw-semibold" data-kt-menu-dismiss="true" data-kt-subscription-table-filter="filter" onclick="applyFilter()">
                                                    <i class="ki-duotone ki-filter fs-2">
                                                        <span class="path1"></span>
                                                        <span class="path2"></span>
                                                    </i>
                                                </button>
                                                <!--end::Actions-->
                                            </div>
                                        
                                            <div class="col-md-2 export-container" data-program-code="IPTS"> 
                                                <a id="exportIPTS" href="{{ route('senarai.keputusan.BKOKU.IPTS.pdf', [
                                                    'start_date' => Request::get('start_date'),
                                                    'end_date' => Request::get('end_date'),
                                                    'status' => Request::get('status'),
                                                    'institusi' => Request::get('institusi'),]) }}" 
                                                    target="_blank" class="btn btn-secondary btn-round">
                                                    <i class="fa fa-file-pdf" style="color: black;"></i> BKOKU IPTS
                                                </a>
                                            </div>

                                            <div class="col-md-2 export-container" data-program-code="POLI"> 
                                                <a id="exportPOLI" href="{{ route('senarai.keputusan.BKOKU.POLI.pdf', [
                                                    'start_date' => Request::get('start_date'),
                                                    'end_date' => Request::get('end_date'),
                                                    'status' => Request::get('status'),
                                                    'institusi' => Request::get('institusi'),]) }}" 
                                                    target="_blank" class="btn btn-secondary btn-round">
                                                    <i class="fa fa-file-pdf" style="color: black;"></i> BKOKU POLI
                                                </a>
                                            </div>

                                            <div class="col-md-2 export-container" data-program-code="KK"> 
                                                <a id="exportKK" href="{{ route('senarai.keputusan.BKOKU.KK.pdf', [
                                                    'start_date' => Request::get('start_date'),
                                                    'end_date' => Request::get('end_date'),
                                                    'status' => Request::get('status'),
                                                    'institusi' => Request::get('institusi'),]) }}" 
                                                    target="_blank" class="btn btn-secondary btn-round">
                                                    <i class="fa fa-file-pdf" style="color: black;"></i> BKOKU KK
                                                </a>
                                            </div>

                                            <div class="col-md-2 export-container" data-program-code="UA">
                                                <a id="exportUA" href="{{ route('senarai.keputusan.BKOKU.UA.pdf', [
                                                    'start_date' => Request::get('start_date'),
                                                    'end_date' => Request::get('end_date'),
                                                    'status' => Request::get('status'),
                                                    'institusi' => Request::get('institusi'),]) }}" 
                                                    target="_blank" class="btn btn-secondary btn-round">
                                                    <i class="fa fa-file-pdf" style="color: black;"></i> BKOKU UA
                                                </a>
                                            </div>
                    
                                            <div class="col-md-2 export-container" data-program-code="PPK">
                                                <a id="exportPPK" href="{{ route('senarai.keputusan.PPK.pdf', [
                                                    'start_date' => '" + startDate + "',
                                                    'end_date' => '" + endDate + "',
                                                    'status' => '" + status + "',
                                                    'institusi' => '" + selectedInstitusi + "']) }}" 
                                                    target="_blank" class="btn btn-secondary btn-round">
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
                                {{-- BKOKU UA --}}
                                <div class="tab-pane fade show active" id="bkokuUA" role="tabpanel" aria-labelledby="bkokuUA-tab">
                                    <div class="body">
                                        <div class="table-responsive" id="table-responsive">
                                            <table id="sortTable4" class="table table-bordered table-striped" style="margin-top: 0 !important;">
                                                <thead>
                                                    <tr>
                                                        <th style="width: 10% !important;"><b>ID Permohonan</b></th>                                        
                                                        <th style="width: 25% !important;"><b>Nama</b></th>
                                                        <th class="text-center" style="width: 20% !important;"><b>Institusi Pengajian</b></th> 
                                                        <th class="text-center" style="width: 15%"><b>ID Institusi</b></th> 
                                                        <th class="text-center" style="width: 10% !important;"><b>Peringkat Pengajian</b></th> 
                                                        <th class="text-center" style="width: 15% !important;"><b>No. Mesyuarat</b></th>
                                                        <th class="text-center" style="width: 10% !important;"><b>Tarikh Mesyuarat</b></th> 
                                                        <th class="text-center" style="width: 10% !important;"><b>Status Permohonan</b></th>
                                                        <th class="text-center" style="width: 10%"><b>Status</b></th>
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
                                                        <th class="text-center" style="width: 15% !important;"><b>ID Institusi</b></th> 
                                                        <th class="text-center" style="width: 10% !important;"><b>Peringkat Pengajian</b></th> 
                                                        <th class="text-center" style="width: 15% !important;"><b>No. Mesyuarat</b></th>
                                                        <th class="text-center" style="width: 10% !important;"><b>Tarikh Mesyuarat</b></th> 
                                                        <th class="text-center" style="width: 10% !important;"><b>Status Permohonan</b></th>
                                                        <th class="text-center" style="width: 10% !important;"><b>Status</b></th>
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
                                                        <th class="text-center" style="width: 10% !important;"><b>Peringkat Pengajian</b></th> 
                                                        <th class="text-center" style="width: 15% !important;"><b>No. Mesyuarat</b></th>
                                                        <th class="text-center" style="width: 10% !important;"><b>Tarikh Mesyuarat</b></th> 
                                                        <th class="text-center" style="width: 10% !important;"><b>Status Permohonan</b></th>
                                                        <th class="text-center" style="width: 10%"><b>Status</b></th>
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
                                                        <th class="text-center" style="width: 10% !important;"><b>Peringkat Pengajian</b></th> 
                                                        <th class="text-center" style="width: 15% !important;"><b>No. Mesyuarat</b></th>
                                                        <th class="text-center" style="width: 10% !important;"><b>Tarikh Mesyuarat</b></th> 
                                                        <th class="text-center" style="width: 10% !important;"><b>Status Permohonan</b></th>
                                                        <th class="text-center" style="width: 10%;"><b>Status</b></th>
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
                                                        <th style="width: 10%"><b>ID Permohonan</b></th>                                        
                                                        <th style="width: 27%"><b>Nama</b></th>
                                                        <th class="text-center" style="width: 18%"><b>Institusi Pengajian</b></th> 
                                                        <th class="text-center" style="width: 15%"><b>ID Institusi</b></th> 
                                                        <th class="text-center" style="width: 10%"><b>Peringkat Pengajian</b></th> 
                                                        <th class="text-center" style="width: 15%"><b>No. Mesyuarat</b></th>
                                                        <th class="text-center" style="width: 10%"><b>Tarikh Mesyuarat</b></th> 
                                                        <th class="text-center" style="width: 10%"><b>Status Permohonan</b></th>
                                                        <th class="text-center" style="width: 10%"><b>Status</b></th>
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

        <style>
            .custom-width-btn {
                width: 105px; 
                height: 35px;
            }
            .custom-width-select {
                width: 400px !important; /* Important to override other styles */
            }
            .form-select {
                margin-left: 10px !important; 
            }
        </style>

        <script>
            $(document).ready(function() {
                // Initialize JavaScript variables with data from Blade
                var bkokuUAList = @json($institusiPengajianUA);
                var bkokuPOLIList = @json($institusiPengajianPOLI);
                var bkokuKKList = @json($institusiPengajianKK);
                var bkokuIPTSList = @json($institusiPengajianIPTS);
                var ppkList = @json($institusiPengajianPPK);

                $('.export-container[data-program-code="UA"]').show();
                $('.export-container[data-program-code="POLI"]').hide();
                $('.export-container[data-program-code="KK"]').hide();
                $('.export-container[data-program-code="IPTS"]').hide();
                $('.export-container[data-program-code="PPK"]').hide();
                $('.none-container').show(); // Hide export elements


                // DataTable initialization functions
                function initializeDataTable4() {
                    $('#sortTable4').DataTable({
                        ordering: true, // Enable manual sorting
                            order: [], // Disable initial sorting
                            columnDefs: [
                                { orderable: false, targets: [0] },
                                { targets: [3], visible: false }, // Hide column (index 4)
                                { targets: [8], visible: false } // Hide column (index 9)
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
                                            words[i] = word.charAt(0).toUpperCase() + word.slice(1).toLowerCase();
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
                                data: 'kelulusan.no_mesyuarat',
                                className: 'text-center',
                                render: function(data, type, row) {
                                    if (data === null) {
                                        return ''; // Return empty string if data is null
                                    } else {
                                        return data; // Return the original data if not null
                                    }
                                }
                            },
                            {
                                data: 'kelulusan.tarikh_mesyuarat',
                                className: 'text-center',
                                render: function(data, type, row) {
                                    if (type === 'display' || type === 'filter') {
                                        if (data === null) {
                                            return '';
                                        } else {
                                            // Convert the date to a JavaScript Date object
                                            var date = new Date(data);

                                            // Get the year, month, and day components
                                            var year = date.getFullYear();
                                            var month = ('0' + (date.getMonth() + 1)).slice(-2); // Add leading zero if needed
                                            var day = ('0' + date.getDate()).slice(-2); // Add leading zero if needed

                                            // Return the formatted date as DD/MM/YYYY
                                            return day + '/' + month + '/' + year;
                                        }
                                    } else {
                                        // For sorting and other purposes, return the original data
                                        return data;
                                    }
                                }
                            },
                            {
                                data: 'kelulusan.keputusan',
                                className: 'text-center',
                                render: function(data, type, row) {
                                    var status = ''; // Initialize an empty string for the button HTML

                                    // Define the button HTML based on the status value
                                    switch (data) {
                                        case 'Lulus':
                                            var route = "{{ route('generate-pdf', ['permohonanId' => ':permohonanId']) }}";
                                            var url = route.replace(':permohonanId', row.id);
                                            status = '<a href="' + url + '" class="btn bg-success btn-round btn-sm custom-width-btn text-white">' +
                                                        '<i class="fa fa-download fa-sm custom-white-icon" style="color: white !important;"></i> Layak' +
                                                    '</a>';
                                            break;
                                        case 'Tidak Lulus':
                                            status = '<button class="btn bg-danger text-white">Tidak Layak</button>';
                                            break;
                                        default:
                                            status = ''; // Set empty string for unknown status values
                                            break;
                                    }
                                    return status;
                                }
                            },
                            { data: 'kelulusan.keputusan' }
                        ]
                        

                    });
                }

                function initializeDataTable1() {
                    $('#sortTable1').DataTable({
                        ordering: true, // Enable manual sorting
                            order: [], // Disable initial sorting
                            columnDefs: [
                                { orderable: false, targets: [0] },
                                { targets: [3], visible: false }, // Hide column (index 4)
                                { targets: [8], visible: false } // Hide column (index 9)
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
                                            words[i] = word.charAt(0).toUpperCase() + word.slice(1).toLowerCase();
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
                                data: 'kelulusan.no_mesyuarat',
                                className: 'text-center',
                                render: function(data, type, row) {
                                    if (data === null) {
                                        return ''; // Return empty string if data is null
                                    } else {
                                        return data; // Return the original data if not null
                                    }
                                }
                            },
                            {
                                data: 'kelulusan.tarikh_mesyuarat',
                                render: function(data, type, row) {
                                    if (type === 'display' || type === 'filter') {
                                        if (data === null) {
                                            return '';
                                        } else {
                                            // Convert the date to a JavaScript Date object
                                            var date = new Date(data);

                                            // Get the year, month, and day components
                                            var year = date.getFullYear();
                                            var month = ('0' + (date.getMonth() + 1)).slice(-2); // Add leading zero if needed
                                            var day = ('0' + date.getDate()).slice(-2); // Add leading zero if needed

                                            // Return the formatted date as DD/MM/YYYY
                                            return day + '/' + month + '/' + year;
                                        }
                                    } else {
                                        // For sorting and other purposes, return the original data
                                        return data;
                                    }
                                },
                                className: 'text-center'
                            },
                            {
                                data: 'kelulusan.keputusan',
                                render: function(data, type, row) {
                                    var status = ''; // Initialize an empty string for the button HTML

                                    // Define the button HTML based on the status value
                                    switch (data) {
                                        case 'Lulus':
                                            var route = "{{ route('generate-pdf', ['permohonanId' => ':permohonanId']) }}";
                                            var url = route.replace(':permohonanId', row.id);
                                            status = '<a href="' + url + '" class="btn bg-success btn-round btn-sm custom-width-btn text-white">' +
                                                        '<i class="fa fa-download fa-sm custom-white-icon" style="color: white !important;"></i> Layak' +
                                                    '</a>';
                                            break;
                                        case 'Tidak Lulus':
                                            status = '<button class="btn bg-danger text-white">Tidak Layak</button>';
                                            break;
                                        default:
                                            status = ''; // Set empty string for unknown status values
                                            break;
                                    }

                                    return status;
                                }
                            },
                            { data: 'kelulusan.keputusan' }
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
                                { targets: [8], visible: false } // Hide column (index 9)
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
                                            words[i] = word.charAt(0).toUpperCase() + word.slice(1).toLowerCase();
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
                                data: 'kelulusan.no_mesyuarat',
                                className: 'text-center',
                                render: function(data, type, row) {
                                    if (data === null) {
                                        return ''; // Return empty string if data is null
                                    } else {
                                        return data; // Return the original data if not null
                                    }
                                }
                            },
                            {
                                data: 'kelulusan.tarikh_mesyuarat',
                                render: function(data, type, row) {
                                    if (type === 'display' || type === 'filter') {
                                        if (data === null) {
                                            return '';
                                        } else {
                                            // Convert the date to a JavaScript Date object
                                            var date = new Date(data);

                                            // Get the year, month, and day components
                                            var year = date.getFullYear();
                                            var month = ('0' + (date.getMonth() + 1)).slice(-2); // Add leading zero if needed
                                            var day = ('0' + date.getDate()).slice(-2); // Add leading zero if needed

                                            // Return the formatted date as DD/MM/YYYY
                                            return day + '/' + month + '/' + year;
                                        }
                                    } else {
                                        // For sorting and other purposes, return the original data
                                        return data;
                                    }
                                },
                                className: 'text-center'
                            },
                            {
                                data: 'kelulusan.keputusan',
                                render: function(data, type, row) {
                                    var status = ''; // Initialize an empty string for the button HTML

                                    // Define the button HTML based on the status value
                                    switch (data) {
                                        case 'Lulus':
                                            var route = "{{ route('generate-pdf', ['permohonanId' => ':permohonanId']) }}";
                                            var url = route.replace(':permohonanId', row.id);
                                            status = '<a href="' + url + '" class="btn bg-success btn-round btn-sm custom-width-btn text-white">' +
                                                        '<i class="fa fa-download fa-sm custom-white-icon" style="color: white !important;"></i> Layak' +
                                                    '</a>';
                                            break;
                                        case 'Tidak Lulus':
                                            status = '<button class="btn bg-danger text-white">Tidak Layak</button>';
                                            break;
                                        default:
                                            status = ''; 
                                            break;
                                    }

                                    return status;
                                }
                            },
                            { data: 'kelulusan.keputusan' }
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
                                { targets: [8], visible: false } // Hide column (index 9)
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
                                            words[i] = word.charAt(0).toUpperCase() + word.slice(1).toLowerCase();
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
                                data: 'kelulusan.no_mesyuarat',
                                className: 'text-center',
                                render: function(data, type, row) {
                                    if (data === null) {
                                        return ''; // Return empty string if data is null
                                    } else {
                                        return data; // Return the original data if not null
                                    }
                                }
                            },
                            {
                                data: 'kelulusan.tarikh_mesyuarat',
                                render: function(data, type, row) {
                                    if (type === 'display' || type === 'filter') {
                                        if (data === null) {
                                            return '';
                                        } else {
                                            // Convert the date to a JavaScript Date object
                                            var date = new Date(data);

                                            // Get the year, month, and day components
                                            var year = date.getFullYear();
                                            var month = ('0' + (date.getMonth() + 1)).slice(-2); // Add leading zero if needed
                                            var day = ('0' + date.getDate()).slice(-2); // Add leading zero if needed

                                            // Return the formatted date as DD/MM/YYYY
                                            return day + '/' + month + '/' + year;
                                        }
                                    } else {
                                        // For sorting and other purposes, return the original data
                                        return data;
                                    }
                                },
                                className: 'text-center'
                            },
                            {
                                data: 'kelulusan.keputusan',
                                render: function(data, type, row) {
                                    var status = ''; // Initialize an empty string for the button HTML

                                    // Define the button HTML based on the status value
                                    switch (data) {
                                        case 'Lulus':
                                            var route = "{{ route('generate-pdf', ['permohonanId' => ':permohonanId']) }}";
                                            var url = route.replace(':permohonanId', row.id);
                                            status = '<a href="' + url + '" class="btn bg-success btn-round btn-sm custom-width-btn text-white">' +
                                                        '<i class="fa fa-download fa-sm custom-white-icon" style="color: white !important;"></i> Layak' +
                                                    '</a>';
                                            break;
                                        case 'Tidak Lulus':
                                            status = '<button class="btn bg-danger text-white">Tidak Layak</button>';
                                            break;
                                        default:
                                            status = ''; // Set empty string for unknown status values
                                            break;
                                    }

                                    return status;
                                }
                            },
                            { data: 'kelulusan.keputusan' }
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
                                { targets: [8], visible: false } // Hide column (index 9)
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
                                            words[i] = word.charAt(0).toUpperCase() + word.slice(1).toLowerCase();
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
                                data: 'kelulusan.no_mesyuarat',
                                className: 'text-center',
                                render: function(data, type, row) {
                                    if (data === null) {
                                        return ''; // Return empty string if data is null
                                    } else {
                                        return data; // Return the original data if not null
                                    }
                                }
                            },
                            {
                                data: 'kelulusan.tarikh_mesyuarat',
                                render: function(data, type, row) {
                                    if (type === 'display' || type === 'filter') {
                                        if (data === null) {
                                            return '';
                                        } else {
                                            // Convert the date to a JavaScript Date object
                                            var date = new Date(data);

                                            // Get the year, month, and day components
                                            var year = date.getFullYear();
                                            var month = ('0' + (date.getMonth() + 1)).slice(-2); // Add leading zero if needed
                                            var day = ('0' + date.getDate()).slice(-2); // Add leading zero if needed

                                            // Return the formatted date as DD/MM/YYYY
                                            return day + '/' + month + '/' + year;
                                        }
                                    } else {
                                        // For sorting and other purposes, return the original data
                                        return data;
                                    }
                                },
                                className: 'text-center'
                            },
                            {
                                data: 'kelulusan.keputusan',
                                render: function(data, type, row) {
                                    var status = ''; // Initialize an empty string for the button HTML

                                    // Define the button HTML based on the status value
                                    switch (data) {
                                        case 'Lulus':
                                            var route = "{{ route('generate-pdf', ['permohonanId' => ':permohonanId']) }}";
                                            var url = route.replace(':permohonanId', row.id);
                                            status = '<a href="' + url + '" class="btn bg-success btn-round btn-sm custom-width-btn text-white">' +
                                                        '<i class="fa fa-download fa-sm custom-white-icon" style="color: white !important;"></i> Layak' +
                                                    '</a>';
                                            break;
                                        case 'Tidak Lulus':
                                            status = '<button class="btn bg-danger text-white">Tidak Layak</button>';
                                            break;
                                        default:
                                            status = ''; // Set empty string for unknown status values
                                            break;
                                    }
                                    return status;
                                }
                            },
                            { data: 'kelulusan.keputusan' }
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
                $('.nav-link').on('click', function() {
                    // Get the ID of the active tab
                    var activeTabId = $(this).attr('id');

                    // Clear filters when changing tabs
                    clearFilters();

                    updateExportContainers(activeTabId);

                    // Update the institution dropdown based on the active tab
                    switch (activeTabId) {
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

                // Trigger the function for the default active tab (bkoku-tab)
                updateInstitusiDropdown(bkokuUAList);
                initializeDataTable4(); // Initialize DataTable1 on page load
            });

        </script>
      
        <script>

            function applyFilter() {

                // Reinitialize DataTables
                initDataTable('#sortTable1', 'datatable1');
                initDataTable('#sortTable2', 'datatable2');
                initDataTable('#sortTable3', 'datatable3');
                initDataTable('#sortTable4', 'datatable4');
                initDataTable('#sortTable5', 'datatable5');

                function initDataTable(tableId, variableName) {
                    // Check if the datatable is already initialized
                    if ($.fn.DataTable.isDataTable(tableId)) {
                        // Destroy the existing DataTable instance
                        $(tableId).DataTable().destroy();
                    }

                    // Initialize the datatable and assign it to the global variable
                    window[variableName] = $(tableId).DataTable({
                        ordering: true, // Enable manual sorting
                        order: [], // Disable initial sorting
                        language: {
                            url: "/assets/lang/Malay.json"
                        },
                        columnDefs: [
                                { orderable: false, targets: [0] },
                                { targets: [3], visible: false }, // Hide column (index 4)
                                { targets: [8], visible: false } // Hide column (index 9)
                            ]
                    });
                }

                var selectedInstitusi = $('[name="institusi"]').val();
                var startDate = $('#start_date').val();
                var endDate = $('#end_date').val();
                var status = $('#status').val();
                console.log(selectedInstitusi);
                console.log(startDate);
                console.log(endDate);
                console.log(status);


                // Apply search filter and log data for all tables
                applyAndLogFilter('Table 1', datatable1, selectedInstitusi, startDate, endDate, status);
                applyAndLogFilter('Table 2', datatable2, selectedInstitusi, startDate, endDate, status);
                applyAndLogFilter('Table 3', datatable3, selectedInstitusi, startDate, endDate, status);
                applyAndLogFilter('Table 4', datatable4, selectedInstitusi, startDate, endDate, status);
                applyAndLogFilter('Table 5', datatable5, selectedInstitusi, startDate, endDate, status);


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

            function applyAndLogFilter(tableName, table, institusi, startDate, endDate, status) 
            {
                // Reset the search for all columns to ensure a clean filter
                table.columns().search('').draw();

                // Clear the previous search functions
                $.fn.dataTable.ext.search = [];

                // Apply date range filter
                if (startDate || endDate) {
                    $.fn.dataTable.ext.search.push(
                        function (settings, data, dataIndex) {
                            let startDateObj = startDate ? moment(startDate, 'YYYY-MM-DD') : null;
                            let endDateObj = endDate ? moment(endDate, 'YYYY-MM-DD') : null;

                            let dateAdded = moment(data[6], 'DD/MM/YYYY');

                            // Check if the date falls within the specified range
                            let result = (!startDateObj || dateAdded.isSameOrAfter(startDateObj)) &&
                                        (!endDateObj || dateAdded.isSameOrBefore(endDateObj));

                            if (result) {
                                console.log('Date Range Filter Result: true');
                                console.log('Formatted Start Date:', startDateObj ? startDateObj.format('DD/MM/YYYY') : null);
                                console.log('Formatted End Date:', endDateObj ? endDateObj.format('DD/MM/YYYY') : null);
                                console.log('Date Added:', dateAdded.format('YYYY-MM-DD'));
                            } else {
                                console.log('Date Range Filter Result: false');
                                console.log('Formatted Start Date:', startDateObj ? startDateObj.format('DD/MM/YYYY') : null);
                                console.log('Formatted End Date:', endDateObj ? endDateObj.format('DD/MM/YYYY') : null);
                                console.log('Date Added:', dateAdded.format('YYYY-MM-DD'));
                            }

                            return result;
                        }
                    );
                }

                // Apply search filter for institusi
                if (institusi) {
                    table.column(2).search(institusi).draw();
                }

                // Apply search filter for status
                if (status) {
                    console.log('Applying Status Filter:', status);
                    table.column(8).search(status).draw();
                } else {
                    console.log('No Status Filter Applied');
                }

                // Log filtered data
                console.log(`Filtered Data (${tableName}):`, table.rows({ search: 'applied' }).data().toArray());

                // Go to the first page for the table
                table.page(0).draw(false);

                // Log the data of visible rows on the first page for the table
                console.log(`Data on Visible Rows (${tableName}, First Page):`, table.rows({ page: 'current' }).data().toArray());
            }

        </script>
    </body>
</x-default-layout> 
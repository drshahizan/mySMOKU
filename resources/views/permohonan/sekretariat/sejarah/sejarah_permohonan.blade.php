<x-default-layout>
    <head>
        <title>Sekretariat BKOKU KPT</title>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">

        <!-- MAIN CSS -->
        <link rel="stylesheet" href="/assets/css/saringan.css">
        <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js"></script>
        <link href="/assets/css/style.bundle.css" rel="stylesheet" type="text/css" />

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
            #sortTable1 tbody td:last-child .status-wrap,
            #sortTable2 tbody td:last-child .status-wrap,
            #sortTable3 tbody td:last-child .status-wrap,
            #sortTable4 tbody td:last-child .status-wrap,
            #sortTable5 tbody td:last-child .status-wrap {
                align-items: center;
                display: inline-grid;
                justify-content: center;
                width: 156px;
            }
            #sortTable1 tbody td:last-child .status-pill,
            #sortTable2 tbody td:last-child .status-pill,
            #sortTable3 tbody td:last-child .status-pill,
            #sortTable4 tbody td:last-child .status-pill,
            #sortTable5 tbody td:last-child .status-pill {
                align-items: center;
                border-radius: 8px;
                color: #fff;
                display: inline-flex;
                font-weight: 700;
                justify-content: center;
                min-height: 34px;
                padding-left: 12px;
                padding-right: 12px;
                text-decoration: none;
                width: 156px;
            }
            .status-info { background-color: #7239ea; }
            .status-baharu { background-color: #1f73e8; }
            .status-saringan { background-color: #17a2b8; }
            .status-disokong { background-color: #ffc107; color: #fff !important; }
            .status-dikembalikan { background-color: #e65f4f; }
            .status-layak { background-color: #50cd89; }
            .status-tidak-layak { background-color: #f1416c; }
            .status-dibayar { background-color: #12a8b3; }
            .status-batal { background-color: #6c757d; }
            .status-pill i {
                color: #fff !important;
                margin-right: 6px;
            }
            #sortTable1 th:nth-child(2),
            #sortTable1 td:nth-child(2),
            #sortTable2 th:nth-child(2),
            #sortTable2 td:nth-child(2),
            #sortTable3 th:nth-child(2),
            #sortTable3 td:nth-child(2),
            #sortTable4 th:nth-child(2),
            #sortTable4 td:nth-child(2),
            #sortTable5 th:nth-child(2),
            #sortTable5 td:nth-child(2) {
                min-width: 180px;
                white-space: normal;
            }

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
            <li class="breadcrumb-item text-dark" style="color:darkblue">Sejarah</li>
            <!--end::Item-->
        </ul>
        <!--end::Breadcrumb-->
    </div>
    <!--end::Page title-->
    <br>
    <body>
    <!-- Main body part  -->
    <div id="main-content">
        <div class="container-fluid">
            <!-- Page header section  -->
            <div class="row clearfix">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="header">
                            <h2>Sejarah Permohonan<br><small>Klik ID Permohonan untuk melihat rekod permohonan pemohon.</small></h2>
                        </div>

                        {{-- top nav bar --}}
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="bkokuUA-tab" data-toggle="tab" data-target="#bkokuUA" type="button" role="tab" aria-controls="bkokuUA" aria-selected="false">BKOKU UA</button>
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
                        <div class="card-toolbar" style="margin-bottom: 0px!important; margin-top: 10px!important;">
                            <!--begin::Toolbar-->
                            <div class="d-flex justify-content-between" style="margin-left: 20px;" data-kt-subscription-table-toolbar="base">
                                <!--begin::Filter-->
                                <!--begin::Content-->
                                <div data-kt-subscription-table-filter="form">
                                    <!--begin::Input group-->
                                    <div class="row mb-0">
                                        <div class="col-md-8 fv-row">
                                            <select id="institusiDropdown" name="institusi" class="form-select custom-width-select js-example-basic-single">
                                                <option value="">Pilih Institusi Pengajian</option>
                                            </select>
                                        </div>
                                        <div class="col-md-2 fv-row none-container"> 
                                            
                                        </div>
                                        <div class="col-md-2 fv-row">
                                            <!--begin::Actions-->
                                            <button type="submit" class="btn btn-primary fw-semibold" data-kt-menu-dismiss="true" data-kt-subscription-table-filter="filter" onclick="applyFilter()">
                                                <i class="ki-duotone ki-filter fs-2">
                                                    <span class="path1"></span>
                                                    <span class="path2"></span>
                                                </i>
                                            </button>
                                            <!--end::Actions-->
                                        </div>
                                    </div>
                                    <!--end::Input group-->
                                </div>
                                <!--end::Content-->
                                <!--end::Filter-->
                            </div>
                            <!--end::Toolbar-->
                            <!--begin::Group actions-->
                            <div class="d-flex justify-content-end align-items-center d-none" data-kt-subscription-table-toolbar="selected">
                                <div class="fw-bold me-5">
                                <span class="me-2" data-kt-subscription-table-select="selected_count"></span>Selected</div>
                                <button type="button" class="btn btn-danger" data-kt-subscription-table-select="delete_selected">Delete Selected</button>
                            </div>
                            <!--end::Group actions-->
                        </div>
                        <!--end::Card toolbar-->

                        <div class="tab-content" id="myTabContent">
                            {{-- BKOKU UA --}}
                            <div class="tab-pane fade show active" id="bkokuUA" role="tabpanel" aria-labelledby="bkokuUA-tab">
                                <br>
                                <div class="body">
                                    <div class="table-responsive">
                                        <table id="sortTable4" class="table table-striped table-hover dataTable js-exportable">
                                            <thead>
                                                <tr>
                                                    <th>ID Permohonan</th>
                                                    <th>Nama</th>
                                                    <th>Institusi Pengajian</th>
                                                    <th>Peringkat Pengajian</th>
                                                    <th>Tarikh Permohonan</th>
                                                    <th>Tarikh Dibayar</th>
                                                    <th>Status Terkini</th>
                                                    <!-- Add more columns as needed -->
                                                </tr>
                                            </thead>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            {{-- BKOKU POLI --}}
                            <div class="tab-pane fade" id="bkokuPOLI" role="tabpanel" aria-labelledby="bkokuPOLI-tab">
                                <br>
                                <div class="body">
                                    <div class="table-responsive">
                                        <table id="sortTable2" class="table table-striped table-hover dataTable js-exportable">
                                            <thead>
                                                <tr>
                                                    <th>ID Permohonan</th>
                                                    <th>Nama</th>
                                                    <th>Institusi Pengajian</th>
                                                    <th>Peringkat Pengajian</th>
                                                    <th>Tarikh Permohonan</th>
                                                    <th>Tarikh Dibayar</th>
                                                    <th>Status Terkini</th>
                                                </tr>
                                            </thead>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            {{-- BKOKU KK --}}
                            <div class="tab-pane fade" id="bkokuKK" role="tabpanel" aria-labelledby="bkokuKK-tab">
                                <br>
                                <div class="body">
                                    <div class="table-responsive">
                                        <table id="sortTable3" class="table table-striped table-hover dataTable js-exportable">
                                            <thead>
                                                <tr>
                                                    <th>ID Permohonan</th>
                                                    <th>Nama</th>
                                                    <th>Institusi Pengajian</th>
                                                    <th>Peringkat Pengajian</th>
                                                    <th>Tarikh Permohonan</th>
                                                    <th>Tarikh Dibayar</th>
                                                    <th>Status Terkini</th>
                                                </tr>
                                            </thead>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            {{-- BKOKU IPTS --}}
                            <div class="tab-pane fade" id="bkokuIPTS" role="tabpanel" aria-labelledby="bkokuIPTS-tab">
                                <br>
                                <div class="body">
                                    <div class="table-responsive">
                                        <table id="sortTable1" class="table table-striped table-hover dataTable js-exportable">
                                            <thead>
                                                <tr>
                                                    <th>ID Permohonan</th>
                                                    <th>Nama</th>
                                                    <th>Institusi Pengajian</th>
                                                    <th>Peringkat Pengajian</th>
                                                    <th>Tarikh Permohonan</th>
                                                    <th>Tarikh Dibayar</th>
                                                    <th>Status Terkini</th>
                                                </tr>
                                            </thead>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            {{-- PPK --}}
                            <div class="tab-pane fade" id="ppk" role="tabpanel" aria-labelledby="ppk-tab">
                                <br>
                                <div class="body">
                                    <div class="table-responsive">
                                        <table id="sortTable5" class="table table-striped table-hover dataTable js-exportable">
                                            <thead>
                                                <tr>
                                                    <th>ID Permohonan</th>
                                                    <th>Nama</th>
                                                    <th>Institusi Pengajian</th>
                                                    <th>Peringkat Pengajian</th>
                                                    <th>Tarikh Tuntutan</th>
                                                    <th>Tarikh Dibayar</th>
                                                    <th>Status Terkini</th>
                                                    <!-- Add more columns as needed -->
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


    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <script>
        $(document).ready(function() {
            $('.js-example-basic-single').select2();
        });
    </script>

    <script>
        $(document).ready(function() {
            // Initialize JavaScript variables with data from Blade
            var bkokuIPTSList = @json($institusiPengajianIPTS);
            var bkokuPOLIList = @json($institusiPengajianPOLI);
            var bkokuKKList = @json($institusiPengajianKK);
            var bkokuUAList = @json($institusiPengajianUA);
            var ppkList = @json($institusiPengajianPPK);

            function statusBadge(label, className) {
                return '<span class="status-wrap"><span class="status-pill ' + className + '">' + label + '</span></span>';
            }

            function statusBadgeWithDownload(label, className, url) {
                return '<span class="status-wrap">' +
                    '<a href="' + url + '" class="status-pill ' + className + '" title="Muat turun">' +
                        '<i class="fa fa-download fa-sm"></i>' + label +
                    '</a>' +
                '</span>';
            }

            function formatNama(data) {
                if (!data) {
                    return '';
                }

                var conjunctions_lower = ['bin', 'binti'];
                var conjunctions_upper = ['A/L', 'A/P'];

                return data.split(' ').map(function(word) {
                    if (conjunctions_lower.includes(word.toLowerCase())) {
                        return word.toLowerCase();
                    }

                    if (conjunctions_upper.includes(word.toUpperCase())) {
                        return word.toUpperCase();
                    }

                    var lowerWord = word.toLowerCase();

                    if (lowerWord.charAt(0) === "'") {
                        return "'" + lowerWord.charAt(1).toUpperCase() + lowerWord.slice(2);
                    }

                    return lowerWord.charAt(0).toUpperCase() + lowerWord.slice(1);
                }).join(' ');
            }


            // DataTable initialization functions
            function initializeDataTable1() {
                $('#sortTable1').DataTable({
                    ordering: true, // Enable manual sorting
                        order: [], // Disable initial sorting
                        columnDefs: [
                            { orderable: false, targets: [0] }
                        ],
                    ajax: {
                        url: '{{ route("sejarah.permohonan.dataIPTS") }}', // URL to fetch data from
                        dataSrc: '' // Property in the response object containing the data array
                        
                    },
                    language: {
                        url: "/assets/lang/Malay.json"
                    },
                    columns: [
                    { 
                        data: 'no_rujukan_permohonan',
                        render: function(data, type, row) {
                            // Construct the URL using the permohonan id.
                            var url = "{{ route('rekod.permohonan.id', ['id' => ':permohonan_id']) }}".replace(':permohonan_id', row.id);// Create and return the link element
                            return '<a href="' + url + '" title="' + data + '">' + data + '</a>';
                        }
                    }, 
                    { 
                        data: 'smoku.nama', 
                        render: function(data, type, row) {
                            return formatNama(data);
                        }
                    },
                    { data: 'akademik.infoipt.nama_institusi' }, 
                    { data: 'akademik.peringkat.peringkat', defaultContent: '' },
                    {
                        data: 'tarikh_hantar',
                        render: function(data, type, row) {
                            if (type === 'display' || type === 'filter') {
                                if (!data) return ' '; // handle null, undefined, or empty string

                                var date = new Date(data);
                                if (isNaN(date.getTime())) return ' '; // handle invalid dates

                                // Get the year, month, and day components
                                var year = date.getFullYear();
                                var month = ('0' + (date.getMonth() + 1)).slice(-2); // Add leading zero if needed
                                var day = ('0' + date.getDate()).slice(-2); // Add leading zero if needed

                                // Return the formatted date as YYYY/MM/DD
                                return day + '/' + month + '/' + year;
                            } else {
                                // For sorting and other purposes, return the original data
                                return data;
                            }
                        }
                    },
                    {
                        data: 'tarikh_transaksi',
                        render: function(data, type, row) {
                            if (type === 'display' || type === 'filter') {
                                if (!data) return ' '; // handle null, undefined, or empty string

                                var date = new Date(data);
                                if (isNaN(date.getTime())) return ' '; // handle invalid dates

                                // Get the year, month, and day components
                                var year = date.getFullYear();
                                var month = ('0' + (date.getMonth() + 1)).slice(-2); // Add leading zero if needed
                                var day = ('0' + date.getDate()).slice(-2); // Add leading zero if needed

                                // Return the formatted date as YYYY/MM/DD
                                return day + '/' + month + '/' + year;
                            } else {
                                // For sorting and other purposes, return the original data
                                return data;
                            }
                        }
                    }, 
                    {
                        data: 'status',
                        render: function(data, type, row) {
                            var status = ''; // Initialize an empty string for the button HTML

                            // Define the button HTML based on the status value
                            switch (data) {
                                case '1':
                                    status = statusBadge('Deraf', 'status-info');
                                    break;
                                case '2':
                                    status = statusBadge('Baharu', 'status-baharu');
                                    break;
                                case '3':
                                    status = statusBadge('Sedang Disaring', 'status-saringan');
                                    break;
                                case '4':
                                    status = statusBadge('Disokong', 'status-disokong');
                                    break;
                                case '5':
                                    status = statusBadge('Dikembalikan', 'status-dikembalikan');
                                    break;
                                case '6':
                                    var route = "{{ route('generate-pdf', ['permohonanId' => ':permohonanId']) }}";
                                    var url = route.replace(':permohonanId', row.id);
                                    status = statusBadgeWithDownload('Layak', 'status-layak', url);
                                    break;
                                case '7':
                                    status = statusBadge('Tidak Layak', 'status-tidak-layak');
                                    break;
                                case '8':
                                    var route = "{{ route('generate-pdf', ['permohonanId' => ':permohonanId']) }}";
                                    var url = route.replace(':permohonanId', row.id);
                                    status = statusBadgeWithDownload('Dibayar', 'status-dibayar', url);
                                    break;
                                case '9':
                                    status = statusBadge('Batal', 'status-batal');
                                    break;
                                case '10':
                                    status = statusBadge('Berhenti', 'status-batal');
                                    break;    
                                default:
                                    status = ''; // Set empty string for unknown status values
                                    break;
                            }

                            return status;
                        }
                    }]

                });
            }

            function initializeDataTable2() {
                $('#sortTable2').DataTable({
                    ordering: true, // Enable manual sorting
                        order: [], // Disable initial sorting
                        columnDefs: [
                            { orderable: false, targets: [0] }
                        ],
                    ajax: {
                        url: '{{ route("sejarah.permohonan.dataPOLI") }}', // URL to fetch data from
                        dataSrc: '' // Property in the response object containing the data array
                        
                    },
                    language: {
                        url: "/assets/lang/Malay.json"
                    },
                    columns: [
                    { 
                        data: 'no_rujukan_permohonan',
                        render: function(data, type, row) {
                            // Construct the URL using the permohonan id.
                            var url = "{{ route('rekod.permohonan.id', ['id' => ':permohonan_id']) }}".replace(':permohonan_id', row.id);// Create and return the link element
                            return '<a href="' + url + '" title="' + data + '">' + data + '</a>';
                        }
                    }, 
                    { 
                        data: 'smoku.nama', 
                        render: function(data, type, row) {
                            return formatNama(data);
                        }
                    },
                    { data: 'akademik.infoipt.nama_institusi' }, 
                    { data: 'akademik.peringkat.peringkat', defaultContent: '' },
                    {
                        data: 'tarikh_hantar',
                        render: function(data, type, row) {
                            if (type === 'display' || type === 'filter') {
                                if (!data) return ' '; // handle null, undefined, or empty string

                                var date = new Date(data);
                                if (isNaN(date.getTime())) return ' '; // handle invalid dates

                                // Get the year, month, and day components
                                var year = date.getFullYear();
                                var month = ('0' + (date.getMonth() + 1)).slice(-2); // Add leading zero if needed
                                var day = ('0' + date.getDate()).slice(-2); // Add leading zero if needed

                                // Return the formatted date as YYYY/MM/DD
                                return day + '/' + month + '/' + year;
                            } else {
                                // For sorting and other purposes, return the original data
                                return data;
                            }
                        }
                    },
                    {
                        data: 'tarikh_transaksi',
                        render: function(data, type, row) {
                            if (type === 'display' || type === 'filter') {
                                if (!data) return ' '; // handle null, undefined, or empty string

                                var date = new Date(data);
                                if (isNaN(date.getTime())) return ' '; // handle invalid dates

                                // Get the year, month, and day components
                                var year = date.getFullYear();
                                var month = ('0' + (date.getMonth() + 1)).slice(-2); // Add leading zero if needed
                                var day = ('0' + date.getDate()).slice(-2); // Add leading zero if needed

                                // Return the formatted date as YYYY/MM/DD
                                return day + '/' + month + '/' + year;
                            } else {
                                // For sorting and other purposes, return the original data
                                return data;
                            }
                        }
                    }, 
                    {
                        data: 'status',
                        render: function(data, type, row) {
                            var status = ''; // Initialize an empty string for the button HTML

                            // Define the button HTML based on the status value
                            switch (data) {
                                case '1':
                                    status = statusBadge('Deraf', 'status-info');
                                    break;
                                case '2':
                                    status = statusBadge('Baharu', 'status-baharu');
                                    break;
                                case '3':
                                    status = statusBadge('Sedang Disaring', 'status-saringan');
                                    break;
                                case '4':
                                    status = statusBadge('Disokong', 'status-disokong');
                                    break;
                                case '5':
                                    status = statusBadge('Dikembalikan', 'status-dikembalikan');
                                    break;
                                    case '6':
                                    var route = "{{ route('generate-pdf', ['permohonanId' => ':permohonanId']) }}";
                                    var url = route.replace(':permohonanId', row.id);
                                    status = statusBadgeWithDownload('Layak', 'status-layak', url);
                                    break;
                                case '7':
                                    status = statusBadge('Tidak Layak', 'status-tidak-layak');
                                    break;
                                case '8':
                                    var route = "{{ route('generate-pdf', ['permohonanId' => ':permohonanId']) }}";
                                    var url = route.replace(':permohonanId', row.id);
                                    status = statusBadgeWithDownload('Dibayar', 'status-dibayar', url);
                                    break;
                                case '9':
                                    status = statusBadge('Batal', 'status-batal');
                                    break;
                                case '10':
                                    status = statusBadge('Berhenti', 'status-batal');
                                    break;    
                                default:
                                    status = ''; // Set empty string for unknown status values
                                    break;
                            }

                            return status;
                        }
                    }]

                });
            }

            function initializeDataTable3() {
                $('#sortTable3').DataTable({
                    ordering: true, // Enable manual sorting
                        order: [], // Disable initial sorting
                        columnDefs: [
                            { orderable: false, targets: [0] }
                        ],
                    ajax: {
                        url: '{{ route("sejarah.permohonan.dataKK") }}', // URL to fetch data from
                        dataSrc: '' // Property in the response object containing the data array
                        
                    },
                    language: {
                        url: "/assets/lang/Malay.json"
                    },
                    columns: [
                    { 
                        data: 'no_rujukan_permohonan',
                        render: function(data, type, row) {
                            // Construct the URL using the permohonan id.
                            var url = "{{ route('rekod.permohonan.id', ['id' => ':permohonan_id']) }}".replace(':permohonan_id', row.id);// Create and return the link element
                            return '<a href="' + url + '" title="' + data + '">' + data + '</a>';
                        }
                    }, 
                    { 
                        data: 'smoku.nama', 
                        render: function(data, type, row) {
                            return formatNama(data);
                        }
                    },
                    { data: 'akademik.infoipt.nama_institusi' }, 
                    { data: 'akademik.peringkat.peringkat', defaultContent: '' },
                    {
                        data: 'tarikh_hantar',
                        render: function(data, type, row) {
                            if (type === 'display' || type === 'filter') {
                                if (!data) return ' '; // handle null, undefined, or empty string

                                var date = new Date(data);
                                if (isNaN(date.getTime())) return ' '; // handle invalid dates

                                // Get the year, month, and day components
                                var year = date.getFullYear();
                                var month = ('0' + (date.getMonth() + 1)).slice(-2); // Add leading zero if needed
                                var day = ('0' + date.getDate()).slice(-2); // Add leading zero if needed

                                // Return the formatted date as YYYY/MM/DD
                                return day + '/' + month + '/' + year;
                            } else {
                                // For sorting and other purposes, return the original data
                                return data;
                            }
                        }
                    },
                    {
                        data: 'tarikh_transaksi',
                        render: function(data, type, row) {
                            if (type === 'display' || type === 'filter') {
                                if (!data) return ' '; // handle null, undefined, or empty string

                                var date = new Date(data);
                                if (isNaN(date.getTime())) return ' '; // handle invalid dates

                                // Get the year, month, and day components
                                var year = date.getFullYear();
                                var month = ('0' + (date.getMonth() + 1)).slice(-2); // Add leading zero if needed
                                var day = ('0' + date.getDate()).slice(-2); // Add leading zero if needed

                                // Return the formatted date as YYYY/MM/DD
                                return day + '/' + month + '/' + year;
                            } else {
                                // For sorting and other purposes, return the original data
                                return data;
                            }
                        }
                    }, 
                    {
                        data: 'status',
                        render: function(data, type, row) {
                            var status = ''; // Initialize an empty string for the button HTML

                            // Define the button HTML based on the status value
                            switch (data) {
                                case '1':
                                    status = statusBadge('Deraf', 'status-info');
                                    break;
                                case '2':
                                    status = statusBadge('Baharu', 'status-baharu');
                                    break;
                                case '3':
                                    status = statusBadge('Sedang Disaring', 'status-saringan');
                                    break;
                                case '4':
                                    status = statusBadge('Disokong', 'status-disokong');
                                    break;
                                case '5':
                                    status = statusBadge('Dikembalikan', 'status-dikembalikan');
                                    break;
                                    case '6':
                                    var route = "{{ route('generate-pdf', ['permohonanId' => ':permohonanId']) }}";
                                    var url = route.replace(':permohonanId', row.id);
                                    status = statusBadgeWithDownload('Layak', 'status-layak', url);
                                    break;
                                case '7':
                                    status = statusBadge('Tidak Layak', 'status-tidak-layak');
                                    break;
                                case '8':
                                    var route = "{{ route('generate-pdf', ['permohonanId' => ':permohonanId']) }}";
                                    var url = route.replace(':permohonanId', row.id);
                                    status = statusBadgeWithDownload('Dibayar', 'status-dibayar', url);
                                    break;
                                case '9':
                                    status = statusBadge('Batal', 'status-batal');
                                    break;
                                case '10':
                                    status = statusBadge('Berhenti', 'status-batal');
                                    break;    
                                default:
                                    status = ''; // Set empty string for unknown status values
                                    break;
                            }

                            return status;
                        }
                    }]

                });
            }

            function initializeDataTable4() {
                $('#sortTable4').DataTable({
                    ordering: true, // Enable manual sorting
                        order: [], // Disable initial sorting
                        columnDefs: [
                            { orderable: false, targets: [0] }
                        ],
                    ajax: {
                        url: '{{ route("sejarah.permohonan.dataUA") }}', // URL to fetch data from
                        dataSrc: '' // Property in the response object containing the data array
                        
                    },
                    language: {
                        url: "/assets/lang/Malay.json"
                    },
                    columns: [
                    { 
                        data: 'no_rujukan_permohonan',
                        render: function(data, type, row) {
                            // Construct the URL using the permohonan id.
                            var url = "{{ route('rekod.permohonan.id', ['id' => ':permohonan_id']) }}".replace(':permohonan_id', row.id);// Create and return the link element
                            return '<a href="' + url + '" title="' + data + '">' + data + '</a>';
                        }
                    }, 
                    { 
                        data: 'smoku.nama', 
                        render: function(data, type, row) {
                            return formatNama(data);
                        }
                    },
                    { data: 'akademik.infoipt.nama_institusi' }, 
                    { data: 'akademik.peringkat.peringkat', defaultContent: '' },
                    {
                        data: 'tarikh_hantar',
                        render: function(data, type, row) {
                            if (type === 'display' || type === 'filter') {
                                if (!data) return ' '; // handle null, undefined, or empty string

                                var date = new Date(data);
                                if (isNaN(date.getTime())) return ' '; // handle invalid dates

                                // Get the year, month, and day components
                                var year = date.getFullYear();
                                var month = ('0' + (date.getMonth() + 1)).slice(-2); // Add leading zero if needed
                                var day = ('0' + date.getDate()).slice(-2); // Add leading zero if needed

                                // Return the formatted date as YYYY/MM/DD
                                return day + '/' + month + '/' + year;
                            } else {
                                // For sorting and other purposes, return the original data
                                return data;
                            }
                        }
                    },
                    {
                        data: 'tarikh_transaksi',
                        render: function(data, type, row) {
                            if (type === 'display' || type === 'filter') {
                                if (!data) return ' '; // handle null, undefined, or empty string

                                var date = new Date(data);
                                if (isNaN(date.getTime())) return ' '; // handle invalid dates

                                // Get the year, month, and day components
                                var year = date.getFullYear();
                                var month = ('0' + (date.getMonth() + 1)).slice(-2); // Add leading zero if needed
                                var day = ('0' + date.getDate()).slice(-2); // Add leading zero if needed

                                // Return the formatted date as YYYY/MM/DD
                                return day + '/' + month + '/' + year;
                            } else {
                                // For sorting and other purposes, return the original data
                                return data;
                            }
                        }
                    }, 
                    {
                        data: 'status',
                        render: function(data, type, row) {
                            var status = ''; // Initialize an empty string for the button HTML

                            // Define the button HTML based on the status value
                            switch (data) {
                                case '1':
                                    status = statusBadge('Deraf', 'status-info');
                                    break;
                                case '2':
                                    status = statusBadge('Baharu', 'status-baharu');
                                    break;
                                case '3':
                                    status = statusBadge('Sedang Disaring', 'status-saringan');
                                    break;
                                case '4':
                                    status = statusBadge('Disokong', 'status-disokong');
                                    break;
                                case '5':
                                    status = statusBadge('Dikembalikan', 'status-dikembalikan');
                                    break;
                                    case '6':
                                    var route = "{{ route('generate-pdf', ['permohonanId' => ':permohonanId']) }}";
                                    var url = route.replace(':permohonanId', row.id);
                                    status = statusBadgeWithDownload('Layak', 'status-layak', url);
                                    break;
                                case '7':
                                    status = statusBadge('Tidak Layak', 'status-tidak-layak');
                                    break;
                                case '8':
                                    var route = "{{ route('generate-pdf', ['permohonanId' => ':permohonanId']) }}";
                                    var url = route.replace(':permohonanId', row.id);
                                    status = statusBadgeWithDownload('Dibayar', 'status-dibayar', url);
                                    break;
                                case '9':
                                    status = statusBadge('Batal', 'status-batal');
                                    break;
                                case '10':
                                    status = statusBadge('Berhenti', 'status-batal');
                                    break;    
                                default:
                                    status = ''; // Set empty string for unknown status values
                                    break;
                            }

                            return status;
                        }
                    }]

                });
            }

            function initializeDataTable5() {
                $('#sortTable5').DataTable({
                    ordering: true, // Enable manual sorting
                        order: [], // Disable initial sorting
                        columnDefs: [
                            { orderable: false, targets: [0] }
                        ],
                    ajax: {
                        url: '{{ route("sejarah.permohonan.dataPPK") }}', // URL to fetch data from
                        dataSrc: '' // Property in the response object containing the data array
                        
                    },
                    language: {
                        url: "/assets/lang/Malay.json"
                    },
                    columns: [
                    { 
                        data: 'no_rujukan_permohonan',
                        render: function(data, type, row) {
                            // Construct the URL using the permohonan id.
                            var url = "{{ route('rekod.permohonan.id', ['id' => ':permohonan_id']) }}".replace(':permohonan_id', row.id);// Create and return the link element
                            return '<a href="' + url + '" title="' + data + '">' + data + '</a>';
                        }
                    }, 
                    { 
                        data: 'smoku.nama', 
                        render: function(data, type, row) {
                            return formatNama(data);
                        }
                    },
                    { data: 'akademik.infoipt.nama_institusi' }, 
                    { data: 'akademik.peringkat.peringkat', defaultContent: '' },
                    {
                        data: 'tarikh_hantar',
                        render: function(data, type, row) {
                            if (type === 'display' || type === 'filter') {
                                if (!data) return ' '; // handle null, undefined, or empty string

                                var date = new Date(data);
                                if (isNaN(date.getTime())) return ' '; // handle invalid dates

                                // Get the year, month, and day components
                                var year = date.getFullYear();
                                var month = ('0' + (date.getMonth() + 1)).slice(-2); // Add leading zero if needed
                                var day = ('0' + date.getDate()).slice(-2); // Add leading zero if needed

                                // Return the formatted date as YYYY/MM/DD
                                return day + '/' + month + '/' + year;
                            } else {
                                // For sorting and other purposes, return the original data
                                return data;
                            }
                        }
                    },
                    {
                        data: 'tarikh_transaksi',
                        render: function(data, type, row) {
                            if (type === 'display' || type === 'filter') {
                                if (!data) return ' '; // handle null, undefined, or empty string

                                var date = new Date(data);
                                if (isNaN(date.getTime())) return ' '; // handle invalid dates

                                // Get the year, month, and day components
                                var year = date.getFullYear();
                                var month = ('0' + (date.getMonth() + 1)).slice(-2); // Add leading zero if needed
                                var day = ('0' + date.getDate()).slice(-2); // Add leading zero if needed

                                // Return the formatted date as YYYY/MM/DD
                                return day + '/' + month + '/' + year;
                            } else {
                                // For sorting and other purposes, return the original data
                                return data;
                            }
                        }
                    }, 
                    {
                        data: 'status',
                        render: function(data, type, row) {
                            var status = ''; // Initialize an empty string for the button HTML

                            // Define the button HTML based on the status value
                            switch (data) {
                                case '1':
                                    status = statusBadge('Deraf', 'status-info');
                                    break;
                                case '2':
                                    status = statusBadge('Baharu', 'status-baharu');
                                    break;
                                case '3':
                                    status = statusBadge('Sedang Disaring', 'status-saringan');
                                    break;
                                case '4':
                                    status = statusBadge('Disokong', 'status-disokong');
                                    break;
                                case '5':
                                    status = statusBadge('Dikembalikan', 'status-dikembalikan');
                                    break;
                                    case '6':
                                    var route = "{{ route('generate-pdfPPK', ['permohonanId' => ':permohonanId']) }}";
                                    var url = route.replace(':permohonanId', row.id);
                                    status = statusBadgeWithDownload('Layak', 'status-layak', url);
                                    break;
                                case '7':
                                    status = statusBadge('Tidak Layak', 'status-tidak-layak');
                                    break;
                                case '8':
                                    var route = "{{ route('generate-pdfPPK', ['permohonanId' => ':permohonanId']) }}";
                                    var url = route.replace(':permohonanId', row.id);
                                    status = statusBadgeWithDownload('Dibayar', 'status-dibayar', url);
                                    break;
                                case '9':
                                    status = statusBadge('Batal', 'status-batal');
                                    break;
                                case '10':
                                    status = statusBadge('Berhenti', 'status-batal');
                                    break;    
                                default:
                                    status = ''; // Set empty string for unknown status values
                                    break;
                            }

                            return status;
                        }
                    }]

                });
            }

            // Function to clear filters for all tables
            function clearFilters() {
                if ($.fn.DataTable.isDataTable('#sortTable1')) {
                    $('#sortTable1').DataTable().destroy();
                }
                if ($.fn.DataTable.isDataTable('#sortTable2')) {
                    $('#sortTable2').DataTable().destroy();
                }
                if ($.fn.DataTable.isDataTable('#sortTable3')) {
                    $('#sortTable3').DataTable().destroy();
                }
                if ($.fn.DataTable.isDataTable('#sortTable4')) {
                    $('#sortTable4').DataTable().destroy();
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

            // Add an event listener for tab clicks
            $('.nav-link').on('click', function() {
                // Get the ID of the active tab
                var activeTabId = $(this).attr('id');

                // Clear filters when changing tabs
                clearFilters();

                // Update the institution dropdown based on the active tab
                switch (activeTabId) {
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
                    case 'bkokuUA-tab':
                        updateInstitusiDropdown(bkokuUAList);
                        initializeDataTable4();
                        break;
                    case 'ppk-tab':
                        updateInstitusiDropdown(ppkList);
                        initializeDataTable5();
                        break;
                    // Add more cases if you have additional tabs
                }
            });

            // Trigger the function for the default active tab (bkoku-tab)
            updateInstitusiDropdown(bkokuUAList);
            initializeDataTable4(); // Initialize DataTable1 on page load
        });
    </script>
    
    <script>
        function applyFilter() 
        {
            var selectedInstitusi = $('[name="institusi"]').val();
            var activeTable = $('.tab-pane.active table.dataTable').attr('id');

            if (!activeTable || !$.fn.DataTable.isDataTable('#' + activeTable)) {
                return;
            }

            applyAndLogFilter($('#' + activeTable).DataTable(), selectedInstitusi);
        }

        function applyAndLogFilter(table, filterValue) {
            // Apply search filter to the table
            table.column(2).search(filterValue).draw();

            // Go to the first page for the table
            table.page(0).draw(false);

        }
    </script>

    </body>
</x-default-layout>

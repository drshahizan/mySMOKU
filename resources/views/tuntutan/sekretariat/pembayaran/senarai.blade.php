<x-default-layout>
    <head>
        <title>Sekretariat BKOKU KPT | Saringan Tuntutan</title>
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

            .payment-status-pill {
                align-items: center;
                border-radius: 7px;
                color: #fff !important;
                display: inline-flex;
                font-weight: 700;
                gap: 6px;
                justify-content: center;
                min-width: 120px;
                padding: 11px 18px;
                text-align: center;
                text-decoration: none;
            }
            .payment-status-pill:hover {
                color: #fff !important;
                text-decoration: none;
            }
            .status-info { background-color: #7239ea; }
            .status-baharu { background-color: #1b84ff; }
            .status-saringan { background-color: #ea4fb5; }
            .status-disokong { background-color: #ffc700; }
            .status-dikembalikan,
            .status-tidak-layak { background-color: #f1416c; }
            .status-layak { background-color: #50cd89; }
            .status-dibayar { background-color: #11a6af; }
            .status-batal { background-color: #6c757d; }

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
        <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Tuntutan</h1>
        <!--end::Title-->
        <!--begin::Breadcrumb-->
        <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
            <!--begin::Item-->
            <li class="breadcrumb-item text-dark" style="color:darkblue">Tuntutan</li>
            <!--end::Item-->
            <!--begin::Item-->
            <li class="breadcrumb-item">
                <span class="bullet bg-gray-400 w-5px h-2px"></span>
            </li>
            <!--end::Item-->
            <!--begin::Item-->
            <li class="breadcrumb-item text-dark" style="color:darkblue">Pembayaran</li>
            <!--end::Item-->
        </ul>
        <!--end::Breadcrumb-->
    </div>
    <!--end::Page title-->
    <br>

    {{-- begin alert --}}
    @if($status_kod == 0)
        {{-- none --}}
    @endif
    @if($status_kod == 2)
        <div class="alert alert-warning" role="alert" style="margin: 0px 15px 20px 15px; color:black!important;">
            {{ $status }}
        </div>
    @endif
    @if($status_kod == 1)
        <div class="alert alert-success" role="alert" style="margin: 0px 15px 20px 15px; color:black!important;">
            {{ $status }}
        </div>
    @endif
    {{-- end alert --}}

    <body>
    <!-- Main body part  -->
    <div id="main-content">
        <div class="container-fluid">
            <!-- Page header section  -->
            <div class="row clearfix">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="header">
                            <h2>Senarai Pembayaran<br><small>Klik ID Tuntutan untuk melihat maklumat pembayaran</small></h2>
                        </div>

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

                                        <div class="col-md-2 fv-row none-container"> </div>

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
                                        
                                        <div class="col-md-2 fv-row export-container"> 
                                            <a id="exportLink" href="{{ route('t.senarai.penyaluran.excel', ['programCode' => 'BKOKU']) }}" target="_blank" class="btn btn-secondary btn-round" style=" width: 150%;">
                                                <i class="fa fa-file-excel" style="color: black;"></i> Excel
                                            </a> 
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
                            {{-- KESELURUHAN --}}
                            <div class="tab-pane fade show active" id="keseluruhan" role="tabpanel" aria-labelledby="keseluruhan-tab">
                                <br>
                                <div class="body">
                                    <div class="table-responsive">
                                        <table id="sortTable6" class="table table-striped table-hover dataTable js-exportable">
                                            <thead>
                                                <tr>
                                                    <th>ID Tuntutan</th>
                                                    <th>Program</th>
                                                    <th>Nama</th>
                                                    <th>Institusi Pengajian</th>
                                                    <th>Peringkat Pengajian</th>
                                                    <th>Tarikh Tuntutan</th>
                                                    <th>Tarikh Dibayar</th>
                                                    <th>Status</th>
                                                </tr>
                                            </thead>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            {{-- BKOKU UA --}}
                            <div class="tab-pane fade" id="bkokuUA" role="tabpanel" aria-labelledby="bkokuUA-tab">
                                <br>
                                <div class="body">
                                    <div class="table-responsive">
                                        <form action="{{ route('t.sekretariat.infocek.submit') }}" method="POST">
                                        {{csrf_field()}}
                                            <!--begin::Table-->
                                            <table id="sortTable4" class="table table-striped table-hover dataTable js-exportable">
                                                <thead>
                                                    <tr>
                                                        <th class="text-center" style="width: 3% !important;"><input type="checkbox" name="select-all" id="select-all-bkokuUA" onclick="toggle('bkokuUA');" /></th>
                                                        <th>ID Tuntutan</th>
                                                        <th>Nama</th>
                                                        <th>Institusi Pengajian</th>
                                                        <th>Peringkat Pengajian</th>
                                                        <th>No Baucar</th>
                                                        <th>Tarikh Baucar</th>
                                                        <th>No Cek</th>
                                                        <th>Tarikh Dibayar</th>
                                                        <th>Status</th>
                                                    </tr>
                                                </thead>
                                            </table>
                                            <!--end::Table-->
                                            <!-- Button trigger modal --> 
                                            <button type="button" class="btn btn-primary btn-round float-end mb-10" data-bs-toggle="modal" data-bs-target="#baucer">
                                                Kemaskini
                                            </button>
                                            {{-- Modal --}}
                                            <div class="modal fade" id="baucer" tabindex="-1" aria-labelledby="baucer" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h1 class="modal-title fs-5" id="pengesahanModalLabelBKOKU2">Kemaskini Maklumat Penyaluran</h1>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>

                                                        <div class="modal-body">
                                                            <div class="mb-3">
                                                                <label for="recipient-name" class="col-form-label">No Cek:</label>
                                                                <input type="text" class="form-control" id="noCek" name="noCek" required oninvalid="this.setCustomValidity('Sila isi no cek.')" oninput="setCustomValidity('')">
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="message-text" class="col-form-label">Tarikh Transaksi:</label>
                                                                <input type="date" class="form-control" id="tarikhTransaksi" name="tarikhTransaksi" required oninvalid="this.setCustomValidity('Sila isi tarikh transaksi.')" oninput="setCustomValidity('')">
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                                <button type="submit" class="btn btn-primary btn-round float-end">Hantar</button>
                                                            </div>
                                                        </div>
                                                    </div> 
                                                </div>
                                            </div> 
                                        </form>
                                    </div>    
                                </div>
                            </div>

                            {{-- BKOKU POLI --}}
                            <div class="tab-pane fade" id="bkokuPOLI" role="tabpanel" aria-labelledby="bkokuPOLI-tab">
                                <div class="body">
                                    <div class="table-responsive">
                                        <br>
                                        <table id="sortTable2" class="table table-striped table-hover dataTable js-exportable">
                                            <thead>
                                                <tr>
                                                    <th>ID Tuntutan</th>
                                                    <th>Nama</th>
                                                    <th>Institusi Pengajian</th>
                                                    <th>Peringkat Pengajian</th>
                                                    <th>Tarikh Tuntutan</th>
                                                    <th>Tarikh Dibayar</th>
                                                    <th>Status</th>
                                                </tr>
                                            </thead>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            {{-- BKOKU KK --}}
                            <div class="tab-pane fade" id="bkokuKK" role="tabpanel" aria-labelledby="bkokuKK-tab">
                                <div class="body">
                                    <div class="table-responsive">
                                        <br>
                                        <table id="sortTable3" class="table table-striped table-hover dataTable js-exportable">
                                            <thead>
                                                <tr>
                                                    <th>ID Tuntutan</th>
                                                    <th>Nama</th>
                                                    <th>Institusi Pengajian</th>
                                                    <th>Peringkat Pengajian</th>
                                                    <th>Tarikh Tuntutan</th>
                                                    <th>Tarikh Dibayar</th>
                                                    <th>Status</th>
                                                </tr>
                                            </thead>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            {{-- BKOKU IPTS --}}
                            <div class="tab-pane fade" id="bkokuIPTS" role="tabpanel" aria-labelledby="bkokuIPTS-tab">
                                <div class="body">
                                    <div class="table-responsive">
                                        <br>
                                        <table id="sortTable1" class="table table-striped table-hover dataTable js-exportable">
                                            <thead>
                                                <tr>
                                                    <th>ID Tuntutan</th>
                                                    <th>Nama</th>
                                                    <th>Institusi Pengajian</th>
                                                    <th>Peringkat Pengajian</th>
                                                    <th>Tarikh Tuntutan</th>
                                                    <th>Tarikh Dibayar</th>
                                                    <th>Status</th>
                                                </tr>
                                            </thead>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            {{-- PPK --}}
                            <div class="tab-pane fade" id="ppk" role="tabpanel" aria-labelledby="ppk-tab">
                                <div class="body">
                                    <div class="table-responsive">
                                        <br>
                                        <table id="sortTable5" class="table table-striped table-hover dataTable js-exportable">
                                            <thead>
                                                <tr>
                                                    <th>ID Tuntutan</th>
                                                    <th>Nama</th>
                                                    <th>Institusi Pengajian</th>
                                                    <th>Peringkat Pengajian</th>
                                                    <th>Tarikh Tuntutan</th>
                                                    <th>Tarikh Dibayar</th>
                                                    <th>Status</th>
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

    <script>
        $(document).ready(function() {
            $('.js-example-basic-single').select2();
        });
    </script>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
        
    <script>
        // Define toggle function in the global scope
        function toggle(tab) {
            var selectAllCheckbox = document.getElementById('select-all-' + tab);
            var isChecked = selectAllCheckbox.checked;

            // Get all checkboxes in the active tab
            var checkboxes = document.querySelectorAll('#' + tab + ' input[name="selected_items[]"]');

            // Set the checked property of all checkboxes to match the "Select All" checkbox
            checkboxes.forEach(function(checkbox) {
                checkbox.checked = isChecked;
            });

            // Prepare an array to hold selected values
            var selectedid = [];

            // Loop through all checkboxes and get selected values
            checkboxes.forEach(function(checkbox) {
                if (checkbox.checked) {
                    selectedid.push(checkbox.value);
                }
            });

            // Log the selected values to the console
            console.log(selectedid);
        }


        $(document).ready(function() {
            // Initialize JavaScript variables with data from Blade
            var bkokuIPTSList = @json($institusiPengajianIPTS);
            var bkokuPOLIList = @json($institusiPengajianPOLI);
            var bkokuKKList = @json($institusiPengajianKK);
            var bkokuUAList = @json($institusiPengajianUA);
            var ppkList = @json($institusiPengajianPPK);
            var keseluruhanList = @json($institusiPengajianALL);

            function formatStudentName(data) {
                if (!data) {
                    return '';
                }

                function formatNamePart(part) {
                    return part.charAt(0).toUpperCase() + part.slice(1).toLowerCase();
                }

                var conjunctionsLower = ['bin', 'binti'];
                var conjunctionsUpper = ['A/L', 'A/P'];
                var words = data.trim().split(/\s+/);

                for (var i = 0; i < words.length; i++) {
                    var word = words[i];

                    if (conjunctionsLower.includes(word.toLowerCase())) {
                        words[i] = word.toLowerCase();
                    } else if (conjunctionsUpper.includes(word.toUpperCase())) {
                        words[i] = word.toUpperCase();
                    } else if (word.charAt(0) === "'" && word.length > 1) {
                        words[i] = "'" + word.charAt(1).toUpperCase() + word.slice(2).toLowerCase();
                    } else {
                        words[i] = word.split("'").map(formatNamePart).join("'");
                    }
                }

                return words.join(' ');
            }

            function renderPaymentStatus(data, row) {
                switch (String(data)) {
                    case '1':
                        return '<span class="payment-status-pill status-info">Deraf</span>';
                    case '2':
                        return '<span class="payment-status-pill status-baharu">Baharu</span>';
                    case '3':
                        return '<span class="payment-status-pill status-saringan">Sedang Disaring</span>';
                    case '4':
                        return '<span class="payment-status-pill status-disokong">Disokong</span>';
                    case '5':
                        return '<span class="payment-status-pill status-dikembalikan">Dikembalikan</span>';
                    case '6':
                        var routeLayak = "{{ route('generate-pdf', ['permohonanId' => ':permohonanId']) }}";
                        var urlLayak = routeLayak.replace(':permohonanId', row.id);
                        return '<a href="' + urlLayak + '" class="payment-status-pill status-layak">' +
                            '<i class="fa fa-download fa-sm custom-white-icon" style="color: white !important;"></i> Layak' +
                            '</a>';
                    case '7':
                        return '<span class="payment-status-pill status-tidak-layak">Tidak Layak</span>';
                    case '8':
                        var routeDibayar = "{{ route('generate-pdf', ['permohonanId' => ':permohonanId']) }}";
                        var urlDibayar = routeDibayar.replace(':permohonanId', row.id);
                        return '<a href="' + urlDibayar + '" class="payment-status-pill status-dibayar">' +
                            '<i class="fa fa-download fa-sm custom-white-icon" style="color: white !important;"></i> Dibayar' +
                            '</a>';
                    case '9':
                        return '<span class="payment-status-pill status-batal">Batal</span>';
                    case '10':
                        return '<span class="payment-status-pill status-batal">Berhenti</span>';
                    default:
                        return '';
                }
            }

            function formatPaymentDate(data, type) {
                if (type === 'display' || type === 'filter') {
                    if (!data) return ' ';
                    var date = new Date(data);
                    if (isNaN(date.getTime())) return ' ';
                    var year = date.getFullYear();
                    var month = ('0' + (date.getMonth() + 1)).slice(-2);
                    var day = ('0' + date.getDate()).slice(-2);
                    return day + '/' + month + '/' + year;
                }

                return data;
            }

            // DataTable initialization functions
            function initializeDataTable6() {
                $('#sortTable6').DataTable({
                    ordering: true,
                    order: [],
                    ajax: {
                        url: '{{ route("senarai.pembayaran.tuntutan.dataALL") }}',
                        dataSrc: ''
                    },
                    language: {
                        url: "/assets/lang/Malay.json"
                    },
                    columns: [
                    {
                        data: 'no_rujukan_tuntutan',
                        render: function(data, type, row) {
                            var url = "{{ url('tuntutan/sekretariat/pembayaran/papar/') }}" + '/' + row.id;
                            return '<a href="' + url + '" title="' + data + '">' + data + '</a>';
                        }
                    },
                    {
                        data: 'permohonan.program',
                        render: function(data) {
                            return data ? data.toUpperCase() : '';
                        }
                    },
                    {
                        data: 'smoku.nama',
                        render: function(data, type, row) {
                            return formatStudentName(data);
                        }
                    },
                    { data: 'akademik.infoipt.nama_institusi' },
                    { data: 'akademik.peringkat.peringkat', defaultContent: '' },
                    {
                        data: 'tarikh_hantar',
                        render: formatPaymentDate
                    },
                    {
                        data: 'tarikh_transaksi',
                        render: formatPaymentDate
                    },
                    {
                        data: 'status',
                        render: function(data, type, row) {
                            return renderPaymentStatus(data, row);
                        }
                    }]
                });
            }

            function initializeDataTable1() {
                $('#sortTable1').DataTable({
                    ordering: true, // Enable manual sorting
                        order: [], // Disable initial sorting
                        columnDefs: [
                            { orderable: false, targets: [0] }
                        ],
                    ajax: {
                        url: '{{ route("senarai.pembayaran.tuntutan.dataIPTS") }}', // URL to fetch data from
                        dataSrc: '' // Property in the response object containing the data array
                        
                    },
                    language: {
                        url: "/assets/lang/Malay.json"
                    },
                    columns: [
                    { 
                        data: 'no_rujukan_tuntutan',
                        render: function(data, type, row) {
                            // Construct the URL using the no_rujukan_permohonan value
                            // var url = "{{ url('tuntutan/sekretariat/sejarah/sejarah-tuntutan/') }}" + '/' + row.smoku_id;
                            var url = "{{ url('tuntutan/sekretariat/pembayaran/papar/') }}" + '/' + row.id;
                            return '<a href="' + url + '" title="' + data + '">' + data + '</a>';
                        }
                    }, 
                    { 
                        data: 'smoku.nama', 
                        render: function(data, type, row) {
                            return formatStudentName(data);
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
                            return renderPaymentStatus(data, row);
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
                        url: '{{ route("senarai.pembayaran.tuntutan.dataPOLI") }}', // URL to fetch data from
                        dataSrc: '' // Property in the response object containing the data array
                        
                    },
                    language: {
                        url: "/assets/lang/Malay.json"
                    },
                    columns: [
                    { 
                        data: 'no_rujukan_tuntutan',
                        render: function(data, type, row) {
                            // Construct the URL using the no_rujukan_permohonan value
                            // var url = "{{ url('tuntutan/sekretariat/sejarah/sejarah-tuntutan/') }}" + '/' + row.smoku_id;
                            var url = "{{ url('tuntutan/sekretariat/pembayaran/papar/') }}" + '/' + row.id;
                            return '<a href="' + url + '" title="' + data + '">' + data + '</a>';
                        }
                    }, 
                    { 
                        data: 'smoku.nama', 
                        render: function(data, type, row) {
                            return formatStudentName(data);
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
                            return renderPaymentStatus(data, row);
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
                        url: '{{ route("senarai.pembayaran.tuntutan.dataKK") }}', // URL to fetch data from
                        dataSrc: '' // Property in the response object containing the data array
                        
                    },
                    language: {
                        url: "/assets/lang/Malay.json"
                    },
                    columns: [
                    { 
                        data: 'no_rujukan_tuntutan',
                        render: function(data, type, row) {
                            // Construct the URL using the no_rujukan_permohonan value
                            // var url = "{{ url('tuntutan/sekretariat/sejarah/sejarah-tuntutan/') }}" + '/' + row.smoku_id;
                            var url = "{{ url('tuntutan/sekretariat/pembayaran/papar/') }}" + '/' + row.id;
                            return '<a href="' + url + '" title="' + data + '">' + data + '</a>';
                        }
                    }, 
                    { 
                        data: 'smoku.nama', 
                        render: function(data, type, row) {
                            return formatStudentName(data);
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
                            return renderPaymentStatus(data, row);
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
                        url: '{{ route("senarai.pembayaran.tuntutan.dataUA") }}', // URL to fetch data from
                        dataSrc: '' // Property in the response object containing the data array
                        
                    },
                    language: {
                        url: "/assets/lang/Malay.json"
                    },
                    columns: [
                    {
                        // Checkbox column
                        data: null,
                        render: function(data, type, row) {
                            return '<input type="checkbox" name="selected_items[]" value="' + row.id + '" />';
                        }
                    },   
                    { 
                        data: 'no_rujukan_tuntutan',
                        render: function(data, type, row) {
                            // Construct the URL using the no_rujukan_permohonan value
                            // var url = "{{ url('tuntutan/sekretariat/sejarah/sejarah-tuntutan/') }}" + '/' + row.smoku_id;
                            // var url = "{{ route('rekod.permohonan.id', ['id' => ':smoku_id']) }}".replace(':smoku_id', row.smoku_id);// Create and return the link element
                            
                            var url = "{{ url('tuntutan/sekretariat/pembayaran/papar/') }}" + '/' + row.id;
                            return '<a href="' + url + '" title="' + data + '">' + data + '</a>';
                        }
                    }, 
                    { 
                        data: 'smoku.nama', 
                        render: function(data, type, row) {
                            return formatStudentName(data);
                        }
                    },
                    { data: 'akademik.infoipt.nama_institusi' },
                    { data: 'akademik.peringkat.peringkat', defaultContent: '' },
                    { data: 'no_baucer' }, 
                    {
                        data: 'tarikh_baucer',
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
                    { data: 'no_cek' }, 
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
                            return renderPaymentStatus(data, row);
                        }
                    }
                    // ,
                    // {
                    //     // Checkbox column
                    //     data: null,
                    //     render: function(data, type, row) {
                    //         return '<td class="text-center" data-id="' + row.id + '" data-action="return">' +
                    //             '<span data-bs-toggle="tooltip" data-bs-trigger="hover" title="Kembali Kepada Penyelaras" style="cursor: pointer;">' +
                    //             '<i class="fa fa-undo fa-sm custom-white-icon" style="color: #000000;"></i>' +
                    //             '</span>' +
                    //             '</td>';
                    //     }
                    // }
                    ]

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
                        url: '{{ route("senarai.pembayaran.tuntutan.dataPPK") }}', // URL to fetch data from
                        dataSrc: '' // Property in the response object containing the data array
                        
                    },
                    language: {
                        url: "/assets/lang/Malay.json"
                    },
                    columns: [
                    { 
                        data: 'no_rujukan_tuntutan',
                        render: function(data, type, row) {
                            // Construct the URL using the no_rujukan_permohonan value
                            // var url = "{{ url('tuntutan/sekretariat/sejarah/sejarah-tuntutan/') }}" + '/' + row.smoku_id;
                            var url = "{{ url('tuntutan/sekretariat/pembayaran/papar/') }}" + '/' + row.id;
                            return '<a href="' + url + '" title="' + data + '">' + data + '</a>';
                        }
                    }, 
                    { 
                        data: 'smoku.nama', 
                        render: function(data, type, row) {
                            return formatStudentName(data);
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
                            return renderPaymentStatus(data, row);
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
            }

            $('.export-container').hide(); // Hide export elements
            $('.none-container').show(); // Hide export elements

            // Add an event listener for tab clicks
            $('.nav-link').on('click', function() {
                // Get the ID of the active tab
                var activeTabId = $(this).attr('id');

                // Clear filters when changing tabs
                clearFilters();

                // Check if the active tab is bkokuUA-tab
                if (activeTabId === 'bkokuUA-tab') {
                    $('.export-container').show(); // Show export elements
                    $('.none-container').hide(); // Hide export elements
                } else {
                    $('.export-container').hide(); // Hide export elements
                    $('.none-container').show(); // Hide export elements
                }

                // Update the institution dropdown based on the active tab
                switch (activeTabId) {
                    case 'keseluruhan-tab':
                        updateInstitusiDropdown(keseluruhanList);
                        initializeDataTable6();
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
                    case 'bkokuUA-tab':
                        updateInstitusiDropdown(bkokuUAList);
                        initializeDataTable4();
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

            // Reinitialize DataTables
            initDataTable('#sortTable1', 'datatable1');
            initDataTable('#sortTable2', 'datatable2');
            initDataTable('#sortTable3', 'datatable3');
            initDataTable('#sortTable4', 'datatable4');
            initDataTable('#sortTable5', 'datatable5');
            if ($.fn.DataTable.isDataTable('#sortTable6')) {
                datatable6 = $('#sortTable6').DataTable();
            }

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
                        { orderable: false, targets: [0] }
                    ]
                });
            }

            var selectedInstitusi = $('[name="institusi"]').val();

            // Apply search filter and log data for all tables
            applyAndLogFilter('Table 1', datatable1, selectedInstitusi);
            applyAndLogFilter('Table 2', datatable2, selectedInstitusi);
            applyAndLogFilter('Table 3', datatable3, selectedInstitusi);
            applyAndLogFilter('Table 4', datatable4, selectedInstitusi);
            applyAndLogFilter('Table 5', datatable5, selectedInstitusi);
            applyAndLogFilter('Table 6', datatable6, selectedInstitusi);

            // Update the export link with the selected institusi for Table 2
            var exportLink = document.getElementById('exportLink');
            exportLink.href = "{{ route('senarai.penyaluran.excel', ['programCode' => 'BKOKU']) }}?institusi=" + selectedInstitusi;
        }

        function applyAndLogFilter(tableName, table, filterValue) {
            if (!table) {
                return;
            }

            // Apply search filter to the table
            var institutionColumn = tableName === 'Table 4' || tableName === 'Table 6' ? 3 : 2;
            table.column(institutionColumn).search(filterValue).draw();

            // Go to the first page for the table
            table.page(0).draw(false);
        }
    </script>

    <!--begin::Global Javascript Bundle(mandatory for all pages)-->
    <script src="/assets/js/scripts.bundle.js"></script>
    <!--end::Global Javascript Bundle-->

    <!--begin::Custom Javascript(used for this page only)-->
    <script src="/assets/js/custom/apps/subscriptions/list/list.js"></script>
    <!--end::Custom Javascript-->

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

    <script>
        @if(session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Berjaya!',
                text: ' {!! session('success') !!}',
                confirmButtonText: 'OK'
            });
        @endif
        @if(session('failed'))
            Swal.fire({
                icon: 'error',
                title: 'Tiada Berjaya!',
                text: ' {!! session('failed') !!}',
                confirmButtonText: 'OK'
            });
        @endif
    </script>
</body>
</x-default-layout>

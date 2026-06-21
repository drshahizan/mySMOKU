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
        <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js"></script>
        <link href="/assets/css/style.bundle.css" rel="stylesheet" type="text/css" />

        <style>
            .nav{
                margin-left: 20px!important;
            }

            .history-status-pill {
                align-items: center;
                border-radius: 7px;
                color: #fff !important;
                display: inline-flex;
                font-weight: 700;
                justify-content: center;
                min-width: 130px;
                padding: 9px 18px;
                text-align: center;
            }
            .history-status-info { background-color: #7239ea; }
            .history-status-baharu { background-color: #1b84ff; }
            .history-status-saringan { background-color: #f6a000; }
            .history-status-disokong { background-color: #ffc700; }
            .history-status-dikembalikan { background-color: #e65f4f; }
            .history-status-tidak-layak { background-color: #f1416c; }
            .history-status-layak { background-color: #50cd89; }
            .history-status-dibayar { background-color: #11a6af; }
            .history-status-batal { background-color: #6c757d; }
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
            <li class="breadcrumb-item text-dark" style="color:darkblue">Sejarah</li>
            <!--end::Item-->
        </ul>
        <!--end::Breadcrumb-->
    </div>
    <!--end::Page title-->

    <br>

    <body>
        <div id="main-content">
            <div class="container-fluid">
                <!-- Page header section  -->
                <div class="row clearfix">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="header">
                                <h2>Sejarah Tuntutan<br><small>Klik ID Tuntutan untuk papar rekod tuntutan</small></h2>
                            </div>


                            <div class="tab-content" id="myTabContent">
                                <br>
                                <div class="body">
                                    <div class="table-responsive">
                                        <table id="sortTable1" class="table table-striped table-hover dataTable js-exportable">
                                            <thead>
                                                <tr>
                                                    <th>ID Tuntutan</th>
                                                    <th>No Baucer</th>
                                                    <th>Tarikh Baucer</th>
                                                    <th>Amaun Yuran (RM)</th>
                                                    <th>Amaun Wang Saku (RM)</th>
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

        <style>
            .custom-width-select {
                width: 400px !important; 
            }
            .form-select {
                    margin-left: 10px !important; 
            }
        </style>

        <script>
            $(document).ready(function() {
                $('.js-example-basic-single').select2();
            });
        </script>

        <script>
            const smoku_id = "{{ $smoku_id }}";

            $(document).ready(function() {
                function renderStatusPill(data) {
                    switch (String(data)) {
                        case '1':
                            return '<span class="history-status-pill history-status-info">Deraf</span>';
                        case '2':
                            return '<span class="history-status-pill history-status-baharu">Baharu</span>';
                        case '3':
                            return '<span class="history-status-pill history-status-saringan">Sedang Disaring</span>';
                        case '4':
                            return '<span class="history-status-pill history-status-disokong">Disokong</span>';
                        case '5':
                            return '<span class="history-status-pill history-status-dikembalikan">Dikembalikan</span>';
                        case '6':
                            return '<span class="history-status-pill history-status-layak">Layak</span>';
                        case '7':
                            return '<span class="history-status-pill history-status-tidak-layak">Tidak Layak</span>';
                        case '8':
                            return '<span class="history-status-pill history-status-dibayar">Dibayar</span>';
                        case '9':
                            return '<span class="history-status-pill history-status-batal">Batal</span>';
                        case '10':
                            return '<span class="history-status-pill history-status-batal">Berhenti</span>';
                        default:
                            return '';
                    }
                }

                // DataTable initialization functions
                function initializeDataTable1() {
                    $('#sortTable1').DataTable({
                        ordering: true, // Enable manual sorting
                            order: [], // Disable initial sorting
                            language: {
                                url: "/assets/lang/Malay.json"
                            },
                            columnDefs: [
                                { orderable: false, targets: [0] }
                            ],
                        ajax: {
                            url: '{{ route("sejarah.tuntutan.data", ["id" => ":smoku_id"]) }}'.replace(':smoku_id', smoku_id),
                            dataSrc: '' // Property in the response object containing the data array
                            
                        },
                        columns: [
                            { 
                                data: 'no_rujukan_tuntutan',
                                render: function(data, type, row) {
                                    // Construct the URL using the no_rujukan_permohonan value
                                    var url = "{{ url('tuntutan/sekretariat/sejarah/rekod-tuntutan/') }}" + '/' + row.id;
                                    // Create and return the link element
                                    return '<a href="' + url + '" title="' + data + '">' + data + '</a>';
                                }
                            },
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
                            {
                                data: 'yuran_dibayar',
                                render: function(data, type, row) {
                                    // If the data is being displayed, add .00 to the end
                                    if (data === null) {
                                        return '-';
                                    }
                                    // If the data is being displayed, add .00 to the end
                                    else if (type === 'display' || type === 'filter') {
                                        return data + '.00';
                                    }
                                    return data;
                                }
                            },  
                            {
                                data: 'wang_saku_dibayar',
                                render: function(data, type, row) {
                                    // If the data is being displayed, add .00 to the end
                                    if (data === null) {
                                        return '-';
                                    }
                                    // If the data is being displayed, add .00 to the end
                                    else if (type === 'display' || type === 'filter') {
                                        return data + '.00';
                                    }
                                    return data;
                                }
                            },  
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
                                    return renderStatusPill(data);
                                }
                            }
                        ]

                    });
                }

                initializeDataTable1(); // Initialize DataTable1 on page load

            });
        </script>
    </body>
</x-default-layout>

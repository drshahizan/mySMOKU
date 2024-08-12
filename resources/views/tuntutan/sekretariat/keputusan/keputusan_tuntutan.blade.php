<x-default-layout>
    <head>
        <title>Sekretariat BKOKU KPT</title>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">

        <!-- MAIN CSS -->
        <link rel="stylesheet" href="/assets/css/saringan.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>

        <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
        <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/datetime/1.5.1/js/dataTables.dateTime.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js"></script>
        <script src="/assets/lang/Malay.json"></script>

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
			<li class="breadcrumb-item text-dark" style="color:darkblue">Keputusan</li>
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
                <div class="block-header">
                    <div class="row clearfix">
                        <div class="card">
                            <div class="header">
                                <h2>Senarai Keputusan Tuntutan<br><small>Sila gunakan fungsi filter untuk menapis data yang ingin dipaparkan sahaja.</small></h2>
                            </div>
                            {{-- Javascript Nav Bar --}}
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
                                                    <option value="6">Layak</option>
                                                    <option value="7">Tidak Layak</option>
                                                </select>
                                            </div> 

                                            <div class="col-md-4">
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
                                {{-- BKOKU UA--}}
                                <div class="tab-pane fade show active" id="bkokuUA" role="tabpanel" aria-labelledby="bkokuUA-tab">
                                    <div class="body">
                                        <div class="table-responsive" id="table-responsive">
                                            <table id="sortTable4" class="table table-bordered table-striped">
                                                <thead>
                                                    <tr style="color: white; background-color:rgb(35, 58, 108);">
                                                        <th><b>ID Tuntutan</b></th>
                                                        <th><b>Nama</b></th>
                                                        <th class="text-center"><b>Institusi Pengajian</b></th>
                                                        <th class="text-center"><b>ID Institusi</b></th>
                                                        <th><b>Peringkat Pengajian</b></th>
                                                        <th class="text-center"><b>Tarikh Kemaskini Keputusan</b></th>
                                                        <th class="text-center">Status Tuntutan</th>
                                                        <th class="text-center">Status</th>
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
                                            <table id="sortTable2" class="table table-bordered table-striped">
                                                <thead>
                                                    <tr style="color: white; background-color:rgb(35, 58, 108);">
                                                        <th><b>ID Tuntutan</b></th>
                                                        <th><b>Nama</b></th>
                                                        <th class="text-center"><b>Institusi Pengajian</b></th>
                                                        <th class="text-center"><b>ID Institusi</b></th>
                                                        <th><b>Peringkat Pengajian</b></th>
                                                        <th class="text-center"><b>Tarikh Kemaskini Keputusan</b></th>
                                                        <th class="text-center">Status Tuntutan</th>
                                                        <th class="text-center">Status</th>
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
                                            <table id="sortTable3" class="table table-bordered table-striped">
                                                <thead>
                                                    <tr style="color: white; background-color:rgb(35, 58, 108);">
                                                        <th><b>ID Tuntutan</b></th>
                                                        <th><b>Nama</b></th>
                                                        <th class="text-center"><b>Institusi Pengajian</b></th>
                                                        <th class="text-center"><b>ID Institusi</b></th>
                                                        <th><b>Peringkat Pengajian</b></th>
                                                        <th class="text-center"><b>Tarikh Kemaskini Keputusan</b></th>
                                                        <th class="text-center">Status Tuntutan</th>
                                                        <th class="text-center">Status</th>
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
                                            <table id="sortTable1" class="table table-bordered table-striped">
                                                <thead>
                                                    <tr style="color: white; background-color:rgb(35, 58, 108);">
                                                        <th><b>ID Tuntutan</b></th>
                                                        <th><b>Nama</b></th>
                                                        <th class="text-center"><b>Institusi Pengajian</b></th>
                                                        <th class="text-center"><b>ID Institusi</b></th>
                                                        <th><b>Peringkat Pengajian</b></th>
                                                        <th class="text-center"><b>Tarikh Kemaskini Keputusan</b></th>
                                                        <th class="text-center">Status Tuntutan</th>
                                                        <th class="text-center">Status</th>
                                                    </tr>
                                                </thead>
                                            </table>
                                        </div>
                                    </div>
                                </div>

                                {{-- PKK --}}
                                <div class="tab-pane fade" id="ppk" role="tabpanel" aria-labelledby="ppk-tab">
                                    <div class="body">
                                        <div class="table-responsive">
                                            <table id="sortTable5" class="table table-bordered table-striped">
                                                <thead>
                                                    <tr style="color: white; background-color:rgb(35, 58, 108);">
                                                        <th><b>ID Tuntutan</b></th>
                                                        <th><b>Nama</b></th>
                                                        <th class="text-center"><b>Institusi Pengajian</b></th>
                                                        <th class="text-center"><b>ID Institusi</b></th>
                                                        <th><b>Peringkat Pengajian</b></th>
                                                        <th class="text-center"><b>Tarikh Kemaskini Keputusan</b></th>
                                                        <th class="text-center">Status Tuntutan</th>
                                                        <th class="text-center">Status</th>
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
                var bkokuIPTSList = @json($institusiPengajianIPTS);
                var bkokuPOLIList = @json($institusiPengajianPOLI);
                var bkokuKKList = @json($institusiPengajianKK);
                var bkokuUAList = @json($institusiPengajianUA);
                var ppkList = @json($institusiPengajianPPK);

                // DataTable initialization functions
                function initializeDataTable1() {
                    $('#sortTable1').DataTable({
                        ordering: true, // Enable manual sorting
                            order: [], // Disable initial sorting
                            columnDefs: [
                                { orderable: false, targets: [0] },
                                { targets: [3], visible: false }, // Hide column (index 4)
                                { targets: [7], visible: false } // Hide column (index 9)
                            ],
                        ajax: {
                            url: '{{ route("senarai.keputusan.tuntutan.IPTS") }}', // URL to fetch data from
                            dataSrc: '' // Property in the response object containing the data array
                            
                        },
                        language: {
                            url: "/assets/lang/Malay.json"
                        },
                        columns: [
                            { 
                                data: 'no_rujukan_tuntutan',
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
                                }
                            },
                            {
                                data: 'updated_at',
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
                                data: 'status',
                                render: function(data, type, row) {
                                    var status = ''; // Initialize an empty string for the button HTML

                                    // Define the button HTML based on the status value
                                    switch (data) {
                                        case '5':
                                            status = '<button class="btn bg-dikembalikan text-white">Dikembalikan</button>';
                                            break;
                                        case '6':
                                            var route = "{{ route('generate-pdf', ['permohonanId' => ':permohonanId']) }}";
                                            var url = route.replace(':permohonanId', row.permohonan_id);
                                            status = '<a href="' + url + '" class="btn bg-success btn-round btn-sm custom-width-btn text-white">' +
                                                        '<i class="fa fa-download fa-sm custom-white-icon" style="color: white !important;"></i> Layak' +
                                                    '</a>';
                                            break;
                                        case '7':
                                            status = '<button class="btn bg-danger text-white">Tidak Layak</button>';
                                            break;
                                        default:
                                            status = ''; // Set empty string for unknown status values
                                            break;
                                    }

                                    return status;
                                }
                            },
                            { data: 'status' }
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
                                { targets: [7], visible: false } // Hide column (index 9)
                            ],
                        ajax: {
                            url: '{{ route("senarai.keputusan.tuntutan.POLI") }}', // URL to fetch data from
                            dataSrc: '' // Property in the response object containing the data array
                            
                        },
                        language: {
                            url: "/assets/lang/Malay.json"
                        },
                        columns: [
                            { 
                                data: 'no_rujukan_tuntutan',
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
                                }
                            },
                            {
                                data: 'updated_at',
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
                                data: 'status',
                                render: function(data, type, row) {
                                    var status = ''; // Initialize an empty string for the button HTML

                                    // Define the button HTML based on the status value
                                    switch (data) {
                                        case '5':
                                            status = '<button class="btn bg-dikembalikan text-white">Dikembalikan</button>';
                                            break;
                                        case '6':
                                            var route = "{{ route('generate-pdf', ['permohonanId' => ':permohonanId']) }}";
                                            var url = route.replace(':permohonanId', row.permohonan_id);
                                            status = '<a href="' + url + '" class="btn bg-success btn-round btn-sm custom-width-btn text-white">' +
                                                        '<i class="fa fa-download fa-sm custom-white-icon" style="color: white !important;"></i> Layak' +
                                                    '</a>';
                                            break;
                                        case '7':
                                            status = '<button class="btn bg-danger text-white">Tidak Layak</button>';
                                            break;
                                        default:
                                            status = ''; // Set empty string for unknown status values
                                            break;
                                    }

                                    return status;
                                }
                            },
                            { data: 'status' }
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
                                { targets: [7], visible: false } // Hide column (index 9)
                            ],
                        ajax: {
                            url: '{{ route("senarai.keputusan.tuntutan.KK") }}', // URL to fetch data from
                            dataSrc: '' // Property in the response object containing the data array
                            
                        },
                        language: {
                            url: "/assets/lang/Malay.json"
                        },
                        columns: [
                            { 
                                data: 'no_rujukan_tuntutan',
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
                                }
                            },
                            {
                                data: 'updated_at',
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
                                data: 'status',
                                render: function(data, type, row) {
                                    var status = ''; // Initialize an empty string for the button HTML

                                    // Define the button HTML based on the status value
                                    switch (data) {
                                        case '5':
                                            status = '<button class="btn bg-dikembalikan text-white">Dikembalikan</button>';
                                            break;
                                        case '6':
                                            var route = "{{ route('generate-pdf', ['permohonanId' => ':permohonanId']) }}";
                                            var url = route.replace(':permohonanId', row.permohonan_id);
                                            status = '<a href="' + url + '" class="btn bg-success btn-round btn-sm custom-width-btn text-white">' +
                                                        '<i class="fa fa-download fa-sm custom-white-icon" style="color: white !important;"></i> Layak' +
                                                    '</a>';
                                            break;
                                        case '7':
                                            status = '<button class="btn bg-danger text-white">Tidak Layak</button>';
                                            break;
                                        default:
                                            status = ''; // Set empty string for unknown status values
                                            break;
                                    }

                                    return status;
                                }
                            },
                            { data: 'status' }
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
                                { targets: [7], visible: false } // Hide column (index 9)
                            ],
                        ajax: {
                            url: '{{ route("senarai.keputusan.tuntutan.BKOKUUA") }}', // URL to fetch data from
                            dataSrc: '' // Property in the response object containing the data array
                            
                        },
                        language: {
                            url: "/assets/lang/Malay.json"
                        },
                        columns: [
                            { 
                                data: 'no_rujukan_tuntutan',
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
                                }
                            },
                            {
                                data: 'updated_at',
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
                                data: 'status',
                                render: function(data, type, row) {
                                    var status = ''; // Initialize an empty string for the button HTML

                                    // Define the button HTML based on the status value
                                    switch (data) {
                                        case '5':
                                            status = '<button class="btn bg-dikembalikan text-white">Dikembalikan</button>';
                                            break;
                                        case '6':
                                            var route = "{{ route('generate-pdf', ['permohonanId' => ':permohonanId']) }}";
                                            var url = route.replace(':permohonanId', row.permohonan_id);
                                            status = '<a href="' + url + '" class="btn bg-success btn-round btn-sm custom-width-btn text-white">' +
                                                        '<i class="fa fa-download fa-sm custom-white-icon" style="color: white !important;"></i> Layak' +
                                                    '</a>';
                                            break;
                                        case '7':
                                            status = '<button class="btn bg-danger text-white">Tidak Layak</button>';
                                            break;
                                        default:
                                            status = ''; // Set empty string for unknown status values
                                            break;
                                    }

                                    return status;
                                }
                            },
                            { data: 'status' }
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
                                { targets: [7], visible: false } // Hide column (index 9)
                            ],
                        ajax: {
                            url: '{{ route("senarai.keputusan.tuntutan.PPK") }}', // URL to fetch data from
                            dataSrc: '' // Property in the response object containing the data array
                            
                        },
                        language: {
                            url: "/assets/lang/Malay.json"
                        },
                        columns: [
                            { 
                                data: 'no_rujukan_tuntutan',
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
                                }
                            },
                            {
                                data: 'updated_at',
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
                                data: 'status',
                                render: function(data, type, row) {
                                    var status = ''; // Initialize an empty string for the button HTML

                                    // Define the button HTML based on the status value
                                    switch (data) {
                                        case '5':
                                            status = '<button class="btn bg-dikembalikan text-white">Dikembalikan</button>';
                                            break;
                                        case '6':
                                            var route = "{{ route('generate-pdf', ['permohonanId' => ':permohonanId']) }}";
                                            var url = route.replace(':permohonanId', row.permohonan_id);
                                            status = '<a href="' + url + '" class="btn bg-success btn-round btn-sm custom-width-btn text-white">' +
                                                        '<i class="fa fa-download fa-sm custom-white-icon" style="color: white !important;"></i> Layak' +
                                                    '</a>';
                                            break;
                                        case '7':
                                            status = '<button class="btn bg-danger text-white">Tidak Layak</button>';
                                            break;
                                        default:
                                            status = ''; // Set empty string for unknown status values
                                            break;
                                    }

                                    return status;
                                }
                            },
                            { data: 'status' }
                        ]
                        

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
                                { targets: [7], visible: false } // Hide column (index 9)
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
            }

            function applyAndLogFilter(tableName, table, institusi, startDate, endDate, status) {
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

                            let dateAdded = moment(data[5], 'DD/MM/YYYY');

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
                    table.column(7).search(status).draw();
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

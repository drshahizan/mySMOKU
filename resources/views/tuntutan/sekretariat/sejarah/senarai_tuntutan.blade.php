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
                                <h2>Senarai Tuntutan<br><small>Klik ID Tuntutan untuk melakukan melihat sejarah tuntutan</small></h2>
                            </div>

                            {{-- top nav bar --}}
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active" id="bkoku-tab" data-toggle="tab" data-target="#bkoku" type="button" role="tab" aria-controls="bkoku" aria-selected="true">BKOKU</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="bkokuUA-tab" data-toggle="tab" data-target="#bkokuUA" type="button" role="tab" aria-controls="bkokuUA" aria-selected="true">BKOKU UA</button>
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
                                {{-- BKOKU --}}
                                <div class="tab-pane fade show active" id="bkoku" role="tabpanel" aria-labelledby="bkoku-tab">
                                    <br>
                                    <div class="body">
                                        <div class="table-responsive">
                                            <table id="sortTable1" class="table table-striped table-hover dataTable js-exportable">
                                                <thead>
                                                    <tr>
                                                        <th>ID Permohonan</th>
                                                        <th>Nama</th>
                                                        <th>Nama Kursus</th>
                                                        <th>Institusi Pengajian</th>
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
                                {{-- BKOKU UA--}}
                                <div class="tab-pane fade" id="bkokuUA" role="tabpanel" aria-labelledby="bkokuUA-tab">
                                    <br>
                                    <div class="body">
                                        <div class="table-responsive">
                                            <table id="sortTable1a" class="table table-striped table-hover dataTable js-exportable">
                                                <thead>
                                                    <tr>
                                                        <th>ID Permohonan</th>
                                                        <th>Nama</th>
                                                        <th>Nama Kursus</th>
                                                        <th>Institusi Pengajian</th>
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
                                {{-- PPK --}}
                                <div class="tab-pane fade" id="ppk" role="tabpanel" aria-labelledby="ppk-tab">
                                    <br>
                                    <div class="body">
                                        <div class="table-responsive">
                                            <table id="sortTable2" class="table table-striped table-hover dataTable js-exportable">
                                                <thead>
                                                    <tr>
                                                        <th>ID Permohonan</th>
                                                        <th>Nama</th>
                                                        <th>Nama Kursus</th>
                                                        <th>Institusi Pengajian</th>
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
    $(document).ready(function() {
        // Initialize JavaScript variables with data from Blade
        var bkokuList = @json($institusiPengajian);
        var bkokuUAList = @json($institusiPengajianUA);
        var ppkList = @json($institusiPengajianPPK);


        // DataTable initialization functions
        function initializeDataTable1() {
            $('#sortTable1').DataTable({
                ordering: true, // Enable manual sorting
                    order: [], // Disable initial sorting
                    columnDefs: [
                        { orderable: false, targets: [0] }
                    ],
                ajax: {
                    url: '{{ route("senarai.tuntutan.dataBKOKU") }}', // URL to fetch data from
                    dataSrc: '' // Property in the response object containing the data array
                    
                },
                columns: [
                { 
                    data: 'no_rujukan_permohonan',
                    render: function(data, type, row) {
                        // Construct the URL using the no_rujukan_permohonan value
                        // var url = "{{ url('tuntutan/sekretariat/sejarah/sejarah-tuntutan/') }}" + '/' + row.smoku_id;
                        var url = "{{ route('sejarah.tuntutan', ['id' => ':smoku_id']) }}".replace(':smoku_id', row.smoku_id);                        // Create and return the link element
                        return '<a href="' + url + '" title="' + data + '">' + data + '</a>';
                    }
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
                { 
                    data: 'akademik.nama_kursus',
                    render: function(data, type, row) {
                        // Check if data is null
                        if (data === null) {
                            return ''; // Return an empty string or any other placeholder value
                        }
                        // Define conjunctions to be handled differently
                        var conjunctions_lower = ['of', 'in', 'with', 'and'];

                        // Split the nama field into words
                        var words = data.split(' ');

                        // Process each word
                        for (var i = 0; i < words.length; i++) {
                            var word = words[i];

                            // Check if the word is a conjunction to be displayed in lowercase
                            if (conjunctions_lower.includes(word.toLowerCase())) {
                                // Convert the word to lowercase
                                words[i] = word.toLowerCase();
                            } else if (word.includes('(') && word.includes(')')) {
                                // Retain the original casing of words within brackets
                                // Extract the content within the brackets
                                var contentWithinBrackets = word.substring(word.indexOf('(') + 1, word.indexOf(')'));
                                // Capitalize the first letter of the content within brackets
                                var capitalizedContent = contentWithinBrackets.charAt(0).toUpperCase() + contentWithinBrackets.slice(1).toLowerCase();
                                // Replace the content within brackets with the capitalized version
                                words[i] = word.replace(contentWithinBrackets, capitalizedContent);
                            } else {
                                // Capitalize the first letter of other words
                                words[i] = word.charAt(0).toUpperCase() + word.slice(1).toLowerCase();
                            }


                        }

                        // Join the words back into a single string
                        var formatted_kursus = words.join(' ');

                        return formatted_kursus;
                    }
                }, 
                { data: 'akademik.infoipt.nama_institusi' }, 
                {
                    data: 'tuntutan.tarikh_hantar',
                    render: function(data, type, row) {
                        if (type === 'display' || type === 'filter') {
                            // Convert the date to a JavaScript Date object
                            var date = new Date(data);

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
                    data: 'tuntutan.tarikh_transaksi',
                    render: function(data, type, row) {
                        if (type === 'display' || type === 'filter') {
                            // Convert the date to a JavaScript Date object
                            var date = new Date(data);

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
                    data: 'tuntutan.status',
                    render: function(data, type, row) {
                        var status = ''; // Initialize an empty string for the button HTML

                        // Define the button HTML based on the status value
                        switch (data) {
                            case '1':
                                status = '<button class="btn bg-info text-white">Deraf</button>';
                                break;
                            case '2':
                                status = '<button class="btn bg-baharu text-white">Baharu</button>';
                                break;
                            case '3':
                                status = '<button class="btn bg-sedang-disaring text-white">Sedang Disaring</button>';
                                break;
                            case '4':
                                status = '<button class="btn bg-warning text-white">Disokong</button>';
                                break;
                            case '5':
                                status = '<button class="btn bg-dikembalikan text-white">Dikembalikan</button>';
                                break;
                            case '6':
                                status = '<button class="btn bg-success text-white">Layak</button>';
                                break;
                            case '7':
                                status = '<button class="btn bg-danger text-white">Tidak Layak</button>';
                                break;
                            case '8':
                                status = '<button class="btn bg-dibayar text-white">Dibayar</button>';
                                break;
                            case '9':
                                status = '<button class="btn bg-batal text-white">Batal</button>';
                                break;
                            case '10':
                                status = '<button class="btn bg-batal text-white">Berhenti</button>';
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

        function initializeDataTable1a() {
            $('#sortTable1a').DataTable({
                ordering: true, // Enable manual sorting
                    order: [], // Disable initial sorting
                    columnDefs: [
                        { orderable: false, targets: [0] }
                    ],
                ajax: {
                    url: '{{ route("senarai.tuntutan.dataUA") }}', // URL to fetch data from
                    dataSrc: '' // Property in the response object containing the data array
                },
                columns: [
                { 
                    data: 'no_rujukan_permohonan',
                    render: function(data, type, row) {
                        // Construct the URL using the no_rujukan_permohonan value
                        var url = "{{ url('tuntutan/sekretariat/sejarah/sejarah-tuntutan/') }}" + '/' + row.smoku_id;
                        // Create and return the link element
                        return '<a href="' + url + '" title="' + data + '">' + data + '</a>';
                    }
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
                { 
                    data: 'akademik.nama_kursus',
                    render: function(data, type, row) {
                        // Check if data is null
                        if (data === null) {
                            return ''; // Return an empty string or any other placeholder value
                        }
                        // Define conjunctions to be handled differently
                        var conjunctions_lower = ['of', 'in', 'with', 'and'];

                        // Split the nama field into words
                        var words = data.split(' ');

                        // Process each word
                        for (var i = 0; i < words.length; i++) {
                            var word = words[i];

                            // Check if the word is a conjunction to be displayed in lowercase
                            if (conjunctions_lower.includes(word.toLowerCase())) {
                                // Convert the word to lowercase
                                words[i] = word.toLowerCase();
                            } else if (word.includes('(') && word.includes(')')) {
                                // Retain the original casing of words within brackets
                                // Extract the content within the brackets
                                var contentWithinBrackets = word.substring(word.indexOf('(') + 1, word.indexOf(')'));
                                // Capitalize the first letter of the content within brackets
                                var capitalizedContent = contentWithinBrackets.charAt(0).toUpperCase() + contentWithinBrackets.slice(1).toLowerCase();
                                // Replace the content within brackets with the capitalized version
                                words[i] = word.replace(contentWithinBrackets, capitalizedContent);
                            } else {
                                // Capitalize the first letter of other words
                                words[i] = word.charAt(0).toUpperCase() + word.slice(1).toLowerCase();
                            }


                        }

                        // Join the words back into a single string
                        var formatted_kursus = words.join(' ');

                        return formatted_kursus;
                    }
                }, 
                { data: 'akademik.infoipt.nama_institusi' }, 
                {
                    data: 'tuntutan.tarikh_hantar',
                    render: function(data, type, row) {
                        if (type === 'display' || type === 'filter') {
                            // Convert the date to a JavaScript Date object
                            var date = new Date(data);

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
                    data: 'tuntutan.tarikh_transaksi',
                    render: function(data, type, row) {
                        if (type === 'display' || type === 'filter') {
                            // Convert the date to a JavaScript Date object
                            var date = new Date(data);

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
                    data: 'tuntutan.status',
                    render: function(data, type, row) {
                        var status = ''; // Initialize an empty string for the button HTML

                        // Define the button HTML based on the status value
                        switch (data) {
                            case '1':
                                status = '<button class="btn bg-info text-white">Deraf</button>';
                                break;
                            case '2':
                                status = '<button class="btn bg-baharu text-white">Baharu</button>';
                                break;
                            case '3':
                                status = '<button class="btn bg-sedang-disaring text-white">Sedang Disaring</button>';
                                break;
                            case '4':
                                status = '<button class="btn bg-warning text-white">Disokong</button>';
                                break;
                            case '5':
                                status = '<button class="btn bg-dikembalikan text-white">Dikembalikan</button>';
                                break;
                            case '6':
                                status = '<button class="btn bg-success text-white">Layak</button>';
                                break;
                            case '7':
                                status = '<button class="btn bg-danger text-white">Tidak Layak</button>';
                                break;
                            case '8':
                                status = '<button class="btn bg-dibayar text-white">Dibayar</button>';
                                break;
                            case '9':
                                status = '<button class="btn bg-batal text-white">Batal</button>';
                                break;
                            case '10':
                                status = '<button class="btn bg-batal text-white">Berhenti</button>';
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
                    url: '{{ route("senarai.tuntutan.dataPPK") }}', // URL to fetch data from
                    dataSrc: '' // Property in the response object containing the data array
                },
                columns: [
                { 
                    data: 'no_rujukan_permohonan',
                    render: function(data, type, row) {
                        // Construct the URL using the no_rujukan_permohonan value
                        var url = "{{ url('tuntutan/sekretariat/sejarah/sejarah-tuntutan/') }}" + '/' + row.smoku_id;
                        // Create and return the link element
                        return '<a href="' + url + '" title="' + data + '">' + data + '</a>';
                    }
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
                { 
                    data: 'akademik.nama_kursus',
                    render: function(data, type, row) {
                        // Check if data is null
                        if (data === null) {
                            return ''; // Return an empty string or any other placeholder value
                        }
                        // Define conjunctions to be handled differently
                        var conjunctions_lower = ['of', 'in', 'with', 'and'];

                        // Split the nama field into words
                        var words = data.split(' ');

                        // Process each word
                        for (var i = 0; i < words.length; i++) {
                            var word = words[i];

                            // Check if the word is a conjunction to be displayed in lowercase
                            if (conjunctions_lower.includes(word.toLowerCase())) {
                                // Convert the word to lowercase
                                words[i] = word.toLowerCase();
                            } else if (word.includes('(') && word.includes(')')) {
                                // Retain the original casing of words within brackets
                                // Extract the content within the brackets
                                var contentWithinBrackets = word.substring(word.indexOf('(') + 1, word.indexOf(')'));
                                // Capitalize the first letter of the content within brackets
                                var capitalizedContent = contentWithinBrackets.charAt(0).toUpperCase() + contentWithinBrackets.slice(1).toLowerCase();
                                // Replace the content within brackets with the capitalized version
                                words[i] = word.replace(contentWithinBrackets, capitalizedContent);
                            } else {
                                // Capitalize the first letter of other words
                                words[i] = word.charAt(0).toUpperCase() + word.slice(1).toLowerCase();
                            }


                        }

                        // Join the words back into a single string
                        var formatted_kursus = words.join(' ');

                        return formatted_kursus;
                    }
                }, 
                { data: 'akademik.infoipt.nama_institusi' }, 
                {
                    data: 'tuntutan.tarikh_hantar',
                    render: function(data, type, row) {
                        if (type === 'display' || type === 'filter') {
                            // Convert the date to a JavaScript Date object
                            var date = new Date(data);

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
                    data: 'tuntutan.tarikh_transaksi',
                    render: function(data, type, row) {
                        if (type === 'display' || type === 'filter') {
                            // Convert the date to a JavaScript Date object
                            var date = new Date(data);

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
                    data: 'tuntutan.status',
                    render: function(data, type, row) {
                        var status = ''; // Initialize an empty string for the button HTML

                        // Define the button HTML based on the status value
                        switch (data) {
                            case '1':
                                status = '<button class="btn bg-info text-white">Deraf</button>';
                                break;
                            case '2':
                                status = '<button class="btn bg-baharu text-white">Baharu</button>';
                                break;
                            case '3':
                                status = '<button class="btn bg-sedang-disaring text-white">Sedang Disaring</button>';
                                break;
                            case '4':
                                status = '<button class="btn bg-warning text-white">Disokong</button>';
                                break;
                            case '5':
                                status = '<button class="btn bg-dikembalikan text-white">Dikembalikan</button>';
                                break;
                            case '6':
                                status = '<button class="btn bg-success text-white">Layak</button>';
                                break;
                            case '7':
                                status = '<button class="btn bg-danger text-white">Tidak Layak</button>';
                                break;
                            case '8':
                                status = '<button class="btn bg-dibayar text-white">Dibayar</button>';
                                break;
                            case '9':
                                status = '<button class="btn bg-batal text-white">Batal</button>';
                                break;
                            case '10':
                                status = '<button class="btn bg-batal text-white">Berhenti</button>';
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
            if ($.fn.DataTable.isDataTable('#sortTable1a')) {
                $('#sortTable1a').DataTable().destroy();
            }
            if ($.fn.DataTable.isDataTable('#sortTable2')) {
                $('#sortTable2').DataTable().destroy();
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
                case 'bkoku-tab':
                    updateInstitusiDropdown(bkokuList);
                    initializeDataTable1();
                    break;
                case 'bkokuUA-tab':
                    updateInstitusiDropdown(bkokuUAList);
                    initializeDataTable1a();
                    break;
                case 'ppk-tab':
                    updateInstitusiDropdown(ppkList);
                    initializeDataTable2();
                    break;
                // Add more cases if you have additional tabs
            }
        });

        // Trigger the function for the default active tab (bkoku-tab)
        updateInstitusiDropdown(bkokuList);
        initializeDataTable1(); // Initialize DataTable1 on page load

    });
</script>
      
<script>

    function applyFilter() {

        // Reinitialize DataTables
        initDataTable('#sortTable1', 'datatable1');
        initDataTable('#sortTable1a', 'datatable');
        initDataTable('#sortTable2', 'datatable2');

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
                columnDefs: [
                    { orderable: false, targets: [0] }
                ]
            });
        }

        var selectedInstitusi = $('[name="institusi"]').val();

        // Apply search filter and log data for all tables
        applyAndLogFilter('Table 1', datatable1, selectedInstitusi);
        applyAndLogFilter('Table 2', datatable, selectedInstitusi);
        applyAndLogFilter('Table 3', datatable2, selectedInstitusi);
    }

    function applyAndLogFilter(tableName, table, filterValue) {
        // Apply search filter to the table
        table.column(3).search(filterValue).draw();

        // Go to the first page for the table
        table.page(0).draw(false);

    }

</script>

</body>
</x-default-layout>
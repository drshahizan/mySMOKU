<x-default-layout>
    <head>
        <title>Sekretariat BKOKU KPT | Saringan Permohonan</title>
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
        <script src="/assets/lang/Malay.json"></script>
        <link href="/assets/css/style.bundle.css" rel="stylesheet" type="text/css" />
    </head>

    <style>
        .nav{
            margin-left: 20px!important;
        }
        .custom-width-select {
            width: 400px !important; /* Important to override other styles */
        }
        .form-select {
                margin-left: 10px !important; 
        }
    </style>

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
    @if($status_kod == 3)
        <div class="alert alert-success" role="alert" style="margin: 0px 15px 20px 15px; color:black!important;">
            {{ $status }}
        </div>
    @endif
    {{-- end alert --}}

    <body>
        <div id="main-content">
            <div class="container-fluid">
                <!-- Page header section  -->
                <div class="row clearfix">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="header">
                                <h2>Senarai Pembayaran<br><small>Klik ID Permohonan untuk melihat maklumat pembayaran.</small></h2>
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
                            <div class="card-toolbar">
                                <!--begin::Toolbar-->
                                <div class="d-flex justify-content-between" style="margin-left: 20px;" data-kt-subscription-table-toolbar="base">
                                    <!--begin::Filter-->
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
                                                <a id="exportLink" href="{{ route('senarai.penyaluran.excel', ['programCode' => 'BKOKU']) }}" target="_blank" class="btn btn-secondary btn-round" style=" width: 150%;">
                                                    <i class="fa fa-file-excel" style="color: black;"></i> Muat Turun
                                                </a> 
                                            </div>
                                        </div>
                                        <!--end::Input group-->
                                    </div>
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

                            <div class="tab-content mt-0" id="myTabContent">
                                
                                {{-- BKOKU UA--}}
                                <div class="tab-pane fade show active" id="bkokuUA" role="tabpanel" aria-labelledby="bkokuUA-tab">
                                    <br>
                                    <div class="body">
                                        <form action="{{ route('sekretariat.infocek.submit') }}" method="POST">
                                        {{csrf_field()}}
                                            <!--begin::Table-->
                                            <table id="sortTable4" class="table table-striped table-hover dataTable js-exportable">
                                                <thead>
                                                    <tr>
                                                        <th class="text-center" style="width: 3% !important;"><input type="checkbox" name="select-all" id="select-all-bkokuUA" onclick="toggle('bkokuUA');" /></th>
                                                        <th>ID Permohonan</th>
                                                        <th>Nama</th>
                                                        <th>Institusi Pengajian</th>
                                                        <th>No Baucar</th>
                                                        <th>Tarikh Baucar</th>
                                                        <th>No Cek</th>
                                                        <th>Tarikh Dibayar</th>
                                                        <th>Status</th>
                                                        <th></th>
                                                    </tr>
                                                </thead>
                                            </table>
                                            <!--end::Table-->

                                            <!-- Button trigger modal --> 
                                            <button type="button" class="btn btn-primary btn-round float-end mb-10" data-bs-toggle="modal" data-bs-target="#baucer">
                                                Kemaskini
                                            </button>
                                            <!-- Modal --> 
                                            <div class="modal fade" id="baucer" tabindex="-1" aria-labelledby="baucer" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h1 class="modal-title fs-5" id="pengesahanModalLabelBKOKU2">Kemaskini Maklumat Penyaluran</h1>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>

                                                        <div class="modal-body">
                                                            <div class="mb-3">
                                                                <label for="recipient-name" class="col-form-label">No Cek / No EFT:</label>
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
                                                        <th>Nama Kursus</th>
                                                        <th>Institusi Pengajian</th>
                                                        <th>Tarikh Permohonan</th>
                                                        <th>Tarikh Dibayar</th>
                                                        <th>Status</th>
                                                    </tr>
                                                </thead>
                                            </table>
                                        </div>
                                    </div>
                                </div>

                                {{-- BKOKU POLI --}}
                                <div class="tab-pane fade" id="bkokuKK" role="tabpanel" aria-labelledby="bkokuKK-tab">
                                    <br>
                                    <div class="body">
                                        <div class="table-responsive">
                                            <table id="sortTable3" class="table table-striped table-hover dataTable js-exportable">
                                                <thead>
                                                    <tr>
                                                        <th>ID Permohonan</th>
                                                        <th>Nama</th>
                                                        <th>Nama Kursus</th>
                                                        <th>Institusi Pengajian</th>
                                                        <th>Tarikh Permohonan</th>
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
                                                        <th>Tarikh Permohonan</th>
                                                        <th>Tarikh Dibayar</th>
                                                        <th>Status</th>
                                                    </tr>
                                                </thead>
                                            </table>
                                        </div>
                                    </div>
                                </div>

                                {{-- PPK--}}
                                <div class="tab-pane fade" id="ppk" role="tabpanel" aria-labelledby="ppk-tab">
                                    <br>
                                    <div class="body">
                                        <div class="table-responsive">
                                            <table id="sortTable5" class="table table-striped table-hover dataTable js-exportable">
                                                <thead>
                                                    <tr>
                                                        <th>ID Permohonan</th>
                                                        <th>Nama</th>
                                                        <th>Nama Kursus</th>
                                                        <th>Institusi Pengajian</th>
                                                        <th>Tarikh Permohonan</th>
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

        <!--begin::Global Javascript Bundle(mandatory for all pages)-->
        <script src="/assets/js/scripts.bundle.js"></script>
        <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
        <!--begin::Custom Javascript(used for this page only)-->
        <script src="/assets/js/custom/apps/subscriptions/list/list.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
        <!--end::Custom Javascript-->

        <script>

            $(document).ready(function() {
                $('.js-example-basic-single').select2();
            });

            $(document).ready(function() {
                $('td[data-action="return"]').click(function() {
                    var itemId = $(this).data('id');

                    if (confirm('Adakah anda pasti ingin kembalikan permohonan ini?')) {
                        $.ajax({
                            type: 'POST',
                            url: '/permohonan/sekretariat/kembali/' + itemId,
                            data: { item_id: itemId },
                            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                            dataType: 'json',
                            success: function(response) {
                                alert(response.message);
                                location.reload(); // Refresh the page
                            },
                            error: function(error) {
                                console.error(error);
                                alert('Something went wrong. Please try again.');
                            }
                        });
                    }
                });
            });

        </script>
    
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


                // DataTable initialization functions
                function initializeDataTable1() {
                    $('#sortTable1').DataTable({
                        ordering: true, // Enable manual sorting
                            order: [], // Disable initial sorting
                            columnDefs: [
                                { orderable: false, targets: [0] }
                            ],
                        ajax: {
                            url: '{{ route("senarai.pembayaran.dataIPTS") }}', // URL to fetch data from
                            dataSrc: '' // Property in the response object containing the data array
                            
                        },
                        language: {
                            url: "/assets/lang/Malay.json"
                        },
                        columns: [
                        { 
                            data: 'no_rujukan_permohonan',
                            render: function(data, type, row) {
                                // Construct the URL using the no_rujukan_permohonan value
                                // var url = "{{ url('tuntutan/sekretariat/sejarah/sejarah-tuntutan/') }}" + '/' + row.smoku_id;
                                var url = "{{ url('permohonan/sekretariat/pembayaran/papar/') }}" + '/' + row.id;
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
                            data: 'tarikh_hantar',
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
                            data: 'tarikh_transaksi',
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
                            data: 'status',
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
                                        var route = "{{ route('generate-pdf', ['permohonanId' => ':permohonanId']) }}";
                                        var url = route.replace(':permohonanId', row.id);
                                        status = '<a href="' + url + '" class="btn bg-success btn-round btn-sm custom-width-btn text-white">' +
                                                    '<i class="fa fa-download fa-sm custom-white-icon" style="color: white !important;"></i> Layak' +
                                                '</a>';
                                        // status = '<button class="btn bg-danger text-white">Lulus</button>';
                                        break;
                                    case '7':
                                        status = '<button class="btn bg-danger text-white">Tidak Layak</button>';
                                        break;
                                    case '8':
                                        var route = "{{ route('generate-pdf', ['permohonanId' => ':permohonanId']) }}";
                                        var url = route.replace(':permohonanId', row.id);
                                        status = '<a href="' + url + '" class="btn bg-dibayar btn-round btn-sm custom-width-btn">' +
                                                    '<i class="fa fa-download fa-sm custom-white-icon" style="color: white !important;"></i> Dibayar' +
                                                '</a>';
                                        // status = '<button class="btn bg-danger text-white">Dibayar</button>';
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
                            url: '{{ route("senarai.pembayaran.dataPOLI") }}', // URL to fetch data from
                            dataSrc: '' // Property in the response object containing the data array
                            
                        },
                        language: {
                            url: "/assets/lang/Malay.json"
                        },
                        columns: [
                        { 
                            data: 'no_rujukan_permohonan',
                            render: function(data, type, row) {
                                // Construct the URL using the no_rujukan_permohonan value
                                // var url = "{{ url('tuntutan/sekretariat/sejarah/sejarah-tuntutan/') }}" + '/' + row.smoku_id;
                                var url = "{{ url('permohonan/sekretariat/pembayaran/papar/') }}" + '/' + row.id;
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
                            data: 'tarikh_hantar',
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
                            data: 'tarikh_transaksi',
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
                            data: 'status',
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
                                        var route = "{{ route('generate-pdf', ['permohonanId' => ':permohonanId']) }}";
                                        var url = route.replace(':permohonanId', row.id);
                                        status = '<a href="' + url + '" class="btn bg-success btn-round btn-sm custom-width-btn text-white">' +
                                                    '<i class="fa fa-download fa-sm custom-white-icon" style="color: white !important;"></i> Layak' +
                                                '</a>';
                                        // status = '<button class="btn bg-danger text-white">Lulus</button>';
                                        break;
                                    case '7':
                                        status = '<button class="btn bg-danger text-white">Tidak Layak</button>';
                                        break;
                                    case '8':
                                        var route = "{{ route('generate-pdf', ['permohonanId' => ':permohonanId']) }}";
                                        var url = route.replace(':permohonanId', row.id);
                                        status = '<a href="' + url + '" class="btn bg-dibayar btn-round btn-sm custom-width-btn">' +
                                                    '<i class="fa fa-download fa-sm custom-white-icon" style="color: white !important;"></i> Dibayar' +
                                                '</a>';
                                        // status = '<button class="btn bg-danger text-white">Dibayar</button>';
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

                function initializeDataTable3() {
                    $('#sortTable3').DataTable({
                        ordering: true, // Enable manual sorting
                            order: [], // Disable initial sorting
                            columnDefs: [
                                { orderable: false, targets: [0] }
                            ],
                        ajax: {
                            url: '{{ route("senarai.pembayaran.dataKK") }}', // URL to fetch data from
                            dataSrc: '' // Property in the response object containing the data array
                            
                        },
                        language: {
                            url: "/assets/lang/Malay.json"
                        },
                        columns: [
                        { 
                            data: 'no_rujukan_permohonan',
                            render: function(data, type, row) {
                                // Construct the URL using the no_rujukan_permohonan value
                                // var url = "{{ url('tuntutan/sekretariat/sejarah/sejarah-tuntutan/') }}" + '/' + row.smoku_id;
                                var url = "{{ url('permohonan/sekretariat/pembayaran/papar/') }}" + '/' + row.id;
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
                            data: 'tarikh_hantar',
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
                            data: 'tarikh_transaksi',
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
                            data: 'status',
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
                                        var route = "{{ route('generate-pdf', ['permohonanId' => ':permohonanId']) }}";
                                        var url = route.replace(':permohonanId', row.id);
                                        status = '<a href="' + url + '" class="btn bg-success btn-round btn-sm custom-width-btn text-white">' +
                                                    '<i class="fa fa-download fa-sm custom-white-icon" style="color: white !important;"></i> Layak' +
                                                '</a>';
                                        // status = '<button class="btn bg-danger text-white">Lulus</button>';
                                        break;
                                    case '7':
                                        status = '<button class="btn bg-danger text-white">Tidak Layak</button>';
                                        break;
                                    case '8':
                                        var route = "{{ route('generate-pdf', ['permohonanId' => ':permohonanId']) }}";
                                        var url = route.replace(':permohonanId', row.id);
                                        status = '<a href="' + url + '" class="btn bg-dibayar btn-round btn-sm custom-width-btn">' +
                                                    '<i class="fa fa-download fa-sm custom-white-icon" style="color: white !important;"></i> Dibayar' +
                                                '</a>';
                                        // status = '<button class="btn bg-danger text-white">Dibayar</button>';
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

                function initializeDataTable4() {
                    $('#sortTable4').DataTable({
                        ordering: true, // Enable manual sorting
                            order: [], // Disable initial sorting
                            columnDefs: [
                                { orderable: false, targets: [0] }
                            ],
                        ajax: {
                            url: '{{ route("senarai.pembayaran.dataUA") }}', // URL to fetch data from
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
                            data: 'no_rujukan_permohonan',
                            render: function(data, type, row) {
                                // Construct the URL using the no_rujukan_permohonan value
                                // var url = "{{ url('tuntutan/sekretariat/sejarah/sejarah-tuntutan/') }}" + '/' + row.smoku_id;
                                // var url = "{{ route('rekod.permohonan.id', ['id' => ':smoku_id']) }}".replace(':smoku_id', row.smoku_id);// Create and return the link element
                                
                                var url = "{{ url('permohonan/sekretariat/pembayaran/papar/') }}" + '/' + row.id;
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
                        { data: 'akademik.infoipt.nama_institusi' }, 
                        { data: 'no_baucer' }, 
                        {
                            data: 'tarikh_baucer',
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
                        { data: 'no_cek' }, 
                        {
                            data: 'tarikh_transaksi',
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
                            data: 'status',
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
                                        var route = "{{ route('generate-pdf', ['permohonanId' => ':permohonanId']) }}";
                                        var url = route.replace(':permohonanId', row.id);
                                        status = '<a href="' + url + '" class="btn bg-success btn-round btn-sm custom-width-btn text-white">' +
                                                    '<i class="fa fa-download fa-sm custom-white-icon" style="color: white !important;"></i> Layak' +
                                                '</a>';
                                        // status = '<button class="btn bg-danger text-white">Lulus</button>';
                                        break;
                                    case '7':
                                        status = '<button class="btn bg-danger text-white">Tidak Layak</button>';
                                        break;
                                    case '8':
                                        var route = "{{ route('generate-pdf', ['permohonanId' => ':permohonanId']) }}";
                                        var url = route.replace(':permohonanId', row.id);
                                        status = '<a href="' + url + '" class="btn bg-dibayar btn-round btn-sm custom-width-btn">' +
                                                    '<i class="fa fa-download fa-sm custom-white-icon" style="color: white !important;"></i> Dibayar' +
                                                '</a>';
                                        // status = '<button class="btn bg-danger text-white">Dibayar</button>';
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
                        },
                        {
                            // Checkbox column
                            data: null,
                            render: function(data, type, row) {
                                return '<td class="text-center" data-id="' + row.id + '" data-action="return">' +
                                    '<span data-bs-toggle="tooltip" data-bs-trigger="hover" title="Kembali Kepada Penyelaras" style="cursor: pointer;">' +
                                    '<i class="fa fa-undo fa-sm custom-white-icon" style="color: #000000;"></i>' +
                                    '</span>' +
                                    '</td>';
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
                            url: '{{ route("senarai.pembayaran.dataPPK") }}', // URL to fetch data from
                            dataSrc: '' // Property in the response object containing the data array
                            
                        },
                        language: {
                            url: "/assets/lang/Malay.json"
                        },
                        columns: [
                        { 
                            data: 'no_rujukan_permohonan',
                            render: function(data, type, row) {
                                // Construct the URL using the no_rujukan_permohonan value
                                // var url = "{{ url('tuntutan/sekretariat/sejarah/sejarah-tuntutan/') }}" + '/' + row.smoku_id;
                                var url = "{{ url('permohonan/sekretariat/pembayaran/papar/') }}" + '/' + row.id;
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
                            data: 'tarikh_hantar',
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
                            data: 'tarikh_transaksi',
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
                            data: 'status',
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
                                        var route = "{{ route('generate-pdf', ['permohonanId' => ':permohonanId']) }}";
                                        var url = route.replace(':permohonanId', row.id);
                                        status = '<a href="' + url + '" class="btn bg-success btn-round btn-sm custom-width-btn text-white">' +
                                                    '<i class="fa fa-download fa-sm custom-white-icon" style="color: white !important;"></i> Layak' +
                                                '</a>';
                                        // status = '<button class="btn bg-danger text-white">Lulus</button>';
                                        break;
                                    case '7':
                                        status = '<button class="btn bg-danger text-white">Tidak Layak</button>';
                                        break;
                                    case '8':
                                        var route = "{{ route('generate-pdf', ['permohonanId' => ':permohonanId']) }}";
                                        var url = route.replace(':permohonanId', row.id);
                                        status = '<a href="' + url + '" class="btn bg-dibayar btn-round btn-sm custom-width-btn">' +
                                                    '<i class="fa fa-download fa-sm custom-white-icon" style="color: white !important;"></i> Dibayar' +
                                                '</a>';
                                        // status = '<button class="btn bg-danger text-white">Dibayar</button>';
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

                // Update the export link with the selected institusi for Table 2
                var exportLink = document.getElementById('exportLink');
                exportLink.href = "{{ route('senarai.penyaluran.excel', ['programCode' => 'BKOKU']) }}?institusi=" + selectedInstitusi;
            }

            function applyAndLogFilter(tableName, table, filterValue) {
                // Apply search filter to the table
                table.column(3).search(filterValue).draw();

                // Go to the first page for the table
                table.page(0).draw(false);
            }

        </script>
    
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

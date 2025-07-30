<x-default-layout>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Senarai Pelajar</title>
    <!-- MAIN CSS -->
    <link rel="stylesheet" href="/assets/css/sekretariat.css">

    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js"></script>
    <link href="/assets/css/style.bundle.css" rel="stylesheet" type="text/css" />
    
</head>

<div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
    <!--begin::Title-->
    <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Pelaporan</h1>
    <!--end::Title-->
    <!--begin::Breadcrumb-->
    <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
        <!--begin::Item-->
        <li class="breadcrumb-item text-muted">
            <a href="/" class="text-dark text-hover-primary" style="color:darkblue">Pelaporan</a>
        </li>
        <!--end::Item-->
        <!--begin::Item-->
        <li class="breadcrumb-item">
            <span class="bullet bg-gray-400 w-5px h-2px"></span>
        </li>
        <!--end::Item-->
        <!--begin::Item-->
        <li class="breadcrumb-item text-dark" style="color:darkblue">Data Excel BKOKU</li>
        <!--end::Item-->
    </ul>
    <!--end::Breadcrumb-->
</div>  
<br>
<body>
    

    <div id="main-content">
        <div class="container-fluid">
            <!--begin::Content-->
            <div class="block-header">
                <!--begin::Content container-->
                <div class="row clearfix">
                    <!--begin::Card-->
                    <div class="card">
                        <!--begin::Header-->
                        <div class="header">
                            <h2>Senarai Permohonan BKOKU</h2>
                        </div>
                        <!--end::Header-->
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
                                <!--begin::Content-->
                                <div class="col-md-12" data-kt-subscription-table-filter="form">
                                    <!--begin::Input group-->
                                    <div class="row">
                                        <div class="col-md-5">
                                            <select id="institusiDropdown" name="institusi" class="form-select custom-width-select js-example-basic-single">
                                                <option>Pilih Institusi Pengajian</option>
                                            </select>
                                        </div>

                                        <div class="col-md-3 fv-row" style="margin-left: 20px;">
                                            <!--begin::Actions-->
                                            <button type="submit" class="btn btn-primary fw-semibold" data-kt-menu-dismiss="true" data-kt-subscription-table-filter="filter" onclick="applyFilter()">
                                                <i class="ki-duotone ki-filter fs-2">
                                                    <span class="path1"></span>
                                                    <span class="path2"></span>
                                                </i>
                                            </button>
                                            <!--end::Actions-->
                                        </div>

                                        <div class="col-md-3 fv-row" style="margin-left:65px;">
                                            <a id="exportExcelBKOKU" href="{{ route('senarai.bkoku.excel') }}" target="_blank" class="btn btn-secondary btn-round">
                                                <i class="fa fa-file-excel" style="color: black;"></i> Muat Turun Masterlist
                                            </a>
                                        </div>
                                    </div>
                                    <!--end::Input group-->
                                </div>
                                <!--end::Content-->
                                <!--end::Filter-->
                            </div>
                            <!--end::Toolbar-->
                        </div>
                        <!--end::Card toolbar-->

                        <!--begin::Card body-->
                        <div class="card-body pt-0">
                            <!--begin::Table-->
                            <div class="table-responsive">
                                <table id="sortTable1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th style="width: 25% !important;"><b>Nama</b></th>                                        
                                            <th><b>No. Kad Pengenalan</b></th>
                                            {{-- <th><b>Peringkat Pengajian</b></th>
                                            <th><b>Nama Kursus</b></th> --}}
                                            <th><b>Nama Institusi</b></th>
                                            <th><b>Tarikh Mula</b></th>
                                            <th><b>Tarikh Tamat</b></th>
                                            <th><b>Status</b></th>
                                            {{-- <th><b>Tindakan</b></th> --}}
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                            <!--end::Table-->
                        </div>
                        <!--end::Card body-->
                    </div>
                    <!--end::Card-->	
                </div>
                <!--end::Content container-->
            </div>
            <!--end::Content-->
        </div> 
    </div>

    <!--begin::Javascript-->
    <style>
        
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

          // DataTable initialization functions
          function initializeDataTable1() {
              $('#sortTable1').DataTable({
                  ordering: true, // Enable manual sorting
                      order: [], // Disable initial sorting
                      columnDefs: [
                          { orderable: false, targets: [0] }
                      ],
                  ajax: {
                      url: '{{ route("laporan.getExcelBKOKU") }}', // URL to fetch data from
                      dataSrc: '' // Property in the response object containing the data array
                  },
                  language: {
                      url: "/assets/lang/Malay.json"
                  },
                  columns: [ 
                    {
                        data: 'nama',
                        render: function(data, type, row) {
                            var conjunctions_lower = ['bin', 'binti'];
                            var conjunctions_upper = ['A/L', 'A/P'];

                            var words = data.split(' ');

                            for (var i = 0; i < words.length; i++) {
                                var word = words[i];

                                // Handle words starting with a single quote
                                if (word.startsWith("'")) {
                                    // Capitalize the character after the quote
                                    words[i] = "'" + word.charAt(1).toUpperCase() + word.slice(2).toLowerCase();
                                } 
                                else if (conjunctions_lower.includes(word.toLowerCase())) {
                                    words[i] = word.toLowerCase();
                                } 
                                else if (conjunctions_upper.includes(word.toUpperCase())) {
                                    words[i] = word.toUpperCase();
                                } 
                                else {
                                    words[i] = word.charAt(0).toUpperCase() + word.slice(1).toLowerCase();
                                }
                            }

                            return words.join(' ');
                        }
                    },
                    { data: 'no_kp' }, 
                    // { data: 'peringkat_pengajian' }, 
                    // { data: 'nama_kursus' }, 
                    { data: 'nama_institusi' },
                    { 
                            data: 'tarikh_mula',
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
                            data: 'tarikh_tamat',
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
                            data: 'status_aktif',
                            render: function (data, type, row) {
                                if (data) {
                                    return '<div class="badge badge-light-success fw-bold">Aktif</div>';
                                } else {
                                    return '<div class="badge badge-light-danger fw-bold">Tidak Aktif</div>';
                                }
                            },
                            className: 'text-center'
                    }
                    // ,
                    // {
                    //     data: 'permohonan_id',
                    //     render: function (data, type, row) {
                    //         var url = '';

                    //         if (row.program === 'BKOKU') {
                    //             url = "{{ route('generate-pdf', ['permohonanId' => ':permohonanId']) }}".replace(':permohonanId', data);
                    //         } else if (row.program === 'PPK') {
                    //             url = "{{ route('generate-pdfPPK', ['permohonanId' => ':permohonanId']) }}".replace(':permohonanId', data);
                    //         }

                    //         if (url) {
                    //             return '<a href="' + url + '" class="btn btn-icon btn-active-light-primary w-30px h-30px me-3" title="Muat Turun PDF">' +
                    //                 '<i class="fas fa-download"></i>' +
                    //                 '</a>';
                    //         } else {
                    //             return '-'; // Or any fallback if program is not BKOKU or PPK
                    //         }
                    //     },
                    //     orderable: false,
                    //     searchable: false,
                    //     className: 'text-center'
                    // }

                  ]
              });
          }

          // Function to clear filters for all tables
          function clearFilters() {
              if ($.fn.DataTable.isDataTable('#sortTable1')) {
                  $('#sortTable1').DataTable().destroy();
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

          // Trigger the function for the default active tab (bkoku-tab)
          updateInstitusiDropdown(bkokuList);
          initializeDataTable1(); // Initialize DataTable1 on page load
      });
    </script>
    <script>
        // Declare datatables in a higher scope to make them accessible
        var datatable1, datatable3, datatable2, datatable4, datatable5;

        $(document).ready(function() {
            // Initialize DataTables
            initDataTable('#sortTable1', 'datatable1');
            initDataTable('#sortTable2', 'datatable2');
            initDataTable('#sortTable3', 'datatable3');
            initDataTable('#sortTable4', 'datatable4');
            initDataTable('#sortTable5', 'datatable5');

            // Log data for all tables
            logTableData('Table 1 Data:', datatable1);
            logTableData('Table 2 Data:', datatable2);
            logTableData('Table 3 Data:', datatable3);
            logTableData('Table 4 Data:', datatable4);
            logTableData('Table 5 Data:', datatable5);
        });

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

        function applyFilter() 
        {
            // Reinitialize DataTables
            initDataTable('#sortTable1', 'datatable1');

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
            console.log(selectedInstitusi);

            // Apply search filter and log data for all tables
            applyAndLogFilter('Table 1', datatable1, selectedInstitusi);

            // If no filter selected, send request without query param
            if (selectedInstitusi) {
                exportExcelBKOKU.href = "{{ route('senarai.bkoku.excel') }}?institusi=" + encodeURIComponent(selectedInstitusi);
            } else {
                exportExcelBKOKU.href = "{{ route('senarai.bkoku.excel') }}";
            }
        }

        function applyAndLogFilter(tableName, table, filterValue) {
            // Apply search filter to the table
            table.column(2).search(filterValue).draw();

            // Go to the first page for the table
            table.page(0).draw(false);
        }

        function logTableData(message, table) {
            console.log(message, table.rows().data().toArray());
        }
    </script>


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
                title: 'Tidak Berjaya!',
                text: ' {!! session('failed') !!}',
                confirmButtonText: 'OK'
            });
        @endif
    </script>

    <!--end::Javascript--> 

  


</body>
</x-default-layout>

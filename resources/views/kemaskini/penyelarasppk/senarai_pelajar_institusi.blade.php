<x-default-layout>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Senarai Pelajar</title>
    <!-- Include Bootstrap CSS and Select2 CSS -->
    <link rel="stylesheet" href="/assets/css/saringan.css">

    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js"></script>
    <link href="/assets/css/style.bundle.css" rel="stylesheet" type="text/css" />
    
</head>

<body>
    <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
        <!--begin::Title-->
        <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Kemaskini</h1>
        <!--end::Title-->
        <!--begin::Breadcrumb-->
        <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
            <!--begin::Item-->
            <li class="breadcrumb-item text-muted">
                <a href="/" class="text-dark text-hover-primary" style="color:darkblue">Kemaskini</a>
            </li>
            <!--end::Item-->
            <!--begin::Item-->
            <li class="breadcrumb-item">
                <span class="bullet bg-gray-400 w-5px h-2px"></span>
            </li>
            <!--end::Item-->
            <!--begin::Item-->
            <li class="breadcrumb-item text-dark" style="color:darkblue">Senarai Pelajar</li>
            <!--end::Item-->
        </ul>
        <!--end::Breadcrumb-->
    </div>  
    <br>

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
                            <h2>Senarai Pelajar<br><small>Sila klik pada ikon pensil di kolum "Tindakan" untuk memaparkan profil diri bagi pelajar tersebut.</small></h2>
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

                        <!--begin::Card body-->
                        <div class="card-body pt-0">
                            <!--begin::Table-->
                            <div class="table-responsive">
                                <table id="sortTable1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th><b>Nama</b></th>                                        
                                            <th><b>No. Kad Pengenalan</b></th>
                                            <th><b>No. Kad JKM</b></th>
                                            <th><b>Nama Kursus</b></th>
                                            <th><b>Nama Institusi</b></th>
                                            <th><b>Tarikh Mula</b></th>
                                            <th><b>Tarikh Tamat</b></th>
                                            <th><b>Status</b></th>
                                            <th><b>Tindakan</b></th>
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
        .custom-width-select {
            width: 400px !important; /* Important to override other styles */
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

          // DataTable initialization functions
          function initializeDataTable1() {
              $('#sortTable1').DataTable({
                  ordering: true, // Enable manual sorting
                      order: [], // Disable initial sorting
                      columnDefs: [
                          { orderable: false, targets: [0] }
                      ],
                  ajax: {
                      url: '{{ route("ppk.penyelaras.getSenaraiPelajar") }}', // URL to fetch data from
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
                    
                    { data: 'no_daftar_oku' }, 
                    { data: 'nama_kursus' }, 
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
                    },
                    { 
                            data: 'smoku_id',
                            render: function (data, type, row) {
                                var url = "{{ route('ppk.profil.pelajar.institusi', ['id' => '__id__']) }}".replace('__id__', data);
                                return '<a href="' + url + '" class="btn btn-icon btn-active-light-primary w-30px h-30px me-3" title="Kemaskini Profil">' +
                                        '<i class="ki-solid ki-pencil text-dark fs-2"></i>' +
                                    '</a>';
                            },
                            orderable: false,
                            searchable: false,
                            className: 'text-center'
                    }
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
        }

        function applyAndLogFilter(tableName, table, filterValue) {
            // Apply search filter to the table
            table.column(4).search(filterValue).draw();

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

<x-default-layout>
    <head>
        <title>Sekretariat BKOKU KPT</title>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">

        <!-- MAIN CSS -->
        <link rel="stylesheet" href="/assets/css/saringan.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
        <script src="/assets/lang/Malay.json"></script>    
        <script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js"></script>
    </head>

    <body>
        <!--begin::Page title-->
	    <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
		<!--begin::Title-->
		<h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Laman Utama</h1>
		<!--end::Title-->
		<!--begin::Breadcrumb-->
		<ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
			<!--begin::Item-->
			<li class="breadcrumb-item text-dark" style="color:darkblue">Laman Utama</li>
			<!--end::Item-->
			<!--begin::Item-->
			<li class="breadcrumb-item">
				<span class="bullet bg-gray-400 w-5px h-2px"></span>
			</li>
			<!--end::Item-->

			<!--begin::Item-->
			<li class="breadcrumb-item text-dark" style="color:darkblue">Senarai Penajaan</li>
			<!--end::Item-->
            <!--begin::Item-->
			<li class="breadcrumb-item">
				<span class="bullet bg-gray-400 w-5px h-2px"></span>
			</li>
			<!--end::Item-->
            
            <!--begin::Item-->
			<li class="breadcrumb-item text-dark" style="color:darkblue">Keseluruhan</li>
			<!--end::Item-->
		</ul>
        <!--end::Breadcrumb-->
        </div>
        <!--end::Page title-->

        <br>

        <!-- Main body part  -->
        <div id="main-content">
            <div class="container-fluid">
                <div class="block-header">
                    <div class="row clearfix">
                        <div class="card">
                            {{-- Filter section --}}
                            <div class="card-toolbar">
                                <!--begin::Toolbar-->
                                <div class="d-flex justify-content-between mt-5 mb-0" data-kt-subscription-table-toolbar="base">
                                    <!--begin::Filter-->
                                    <div class="col-md-12" data-kt-subscription-table-filter="form">
                                        <!--begin::Input group-->
                                        <div class="row form-filter" >
                                            <div class="col-md-4" style="display: flex; align-items: center; padding-left:40px;">
                                                <div class="flex-grow-1" style="padding-right: 10px;">
                                                    <label for="start_date"><b>Dari:</b></label>
                                                    <input type="date" name="start_date" id="start_date" value="" class="form-control" />
                                                </div>
                                                
                                                <div class="flex-grow-1">
                                                    <label for="end_date"><b>Hingga:</b></label>
                                                    <input type="date" name="end_date" id="end_date" value="" class="form-control" />
                                                </div>
                                            </div>
                                            
                                            <div class="col-md-1 fv-row" style="padding-left:20px;">
                                                <!--begin::Actions-->
                                                <br>
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
                        
                            <div class="body">      
                                <table id="permohonanTable" class="table table-bordered table-striped">
                                    <thead>
                                        <tr style="color: white;">
                                            <th style="width: 15%"><b>ID Permohonan</b></th>                                        
                                            <th style="width: 45%"><b>Nama</b></th>
                                            <th style="width: 13%" class="text-center"><b>Tarikh Tamat</b></th> 
                                            <th class="text-center" style="width: 15%">Status Permohonan</th>
                                        </tr>
                                    </thead>
                                    
                                    <tbody></tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>   
        </div> 

        <!-- Javascript -->
        {{-- <script src="assets/bundles/libscripts.bundle.js"></script>    
        <script src="assets/bundles/vendorscripts.bundle.js"></script> --}}

        <script>
            $(document).ready(function() {
                var permohonanTable; 

                function initializeDataTable() {
                    $('#permohonanTable').DataTable({
                        ordering: true, // Enable manual sorting
                        order: [], // Disable initial sorting
                        language: {
                            "url": "/assets/lang/Malay.json"
                        },
                        ajax: {
                            url: '{{ route("senarai.P") }}', // URL to fetch data from
                            dataSrc: '' // Property in the response object containing the data array
                        },
                        columns: [
                            { data: 'no_rujukan_permohonan' },
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
                                data: 'akademik.tarikh_tamat',
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
                                data: 'status',
                                render: function(data, type, row) {
                                    var statusText;
                                    switch (data) {
                                        case '1':
                                            statusText = '<button class="btn bg-info text-white">Deraf</button>';
                                            break;
                                        case '2':
                                            statusText = '<button class="btn bg-baharu text-white">Baharu</button>';
                                            break;
                                        case '3':
                                            statusText = '<button class="btn bg-sedang-disaring text-white">Sedang Disaring</button>';
                                            break;
                                        case '4':
                                            statusText = '<button class="btn bg-warning text-white">Disokong</button>';
                                            break;
                                        case '5':
                                            statusText = '<button class="btn bg-dikembalikan text-white">Dikembalikan</button>';
                                            break;
                                        case '6':
                                            statusText = '<button class="btn bg-success text-white">Layak</button>';
                                            break;
                                        case '7':
                                            statusText = '<button class="btn bg-danger text-white">Tidak Layak</button>';
                                            break;
                                        case '8':
                                            statusText = '<button class="btn bg-dibayar text-white">Dibayar</button>';
                                            break;
                                        case '9':
                                            statusText = '<button class="btn bg-batal text-white">Batal</button>';
                                            break;
                                        case '10':
                                            statusText = '<button class="btn bg-batal text-white">Berhenti</button>';
                                            break;    
                                        default:
                                            statusText = 'Unknown';
                                    }
                                    return statusText;
                                },
                                className: 'text-center'
                            }
                        ]
                    });
                }

                initializeDataTable();

            });

        </script>

        <script>

            function applyFilter() {

                // Reinitialize DataTables
                initDataTable('#permohonanTable', 'datatable1');

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
                            "url": "/assets/lang/Malay.json"
                        },
                        columnDefs: [
                                { orderable: false, targets: [0] }
                            ]
                    });
                }

                var startDate = $('#start_date').val();
                var endDate = $('#end_date').val();

                console.log(startDate);
                console.log(endDate);

                // Apply search filter and log data for all tables
                applyAndLogFilter('Table 1', datatable1, startDate, endDate);
                
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

                            let dateAdded = moment(data[2], 'DD/MM/YYYY');

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
                else {
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


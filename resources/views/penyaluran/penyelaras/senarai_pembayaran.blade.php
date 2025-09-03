<x-default-layout>
    <head>
        <title>Sekretariat BKOKU KPT</title>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">

        <!-- MAIN CSS -->
        <link rel="stylesheet" href="/assets/css/sekretariat.css">
        {{-- <link href="assets/css/style.bundle.css" rel="stylesheet" type="text/css" /> --}}
        
        {{-- JAVASCRIPT --}}
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js"></script>

        <style>
            .nav{
                margin-left: 20px!important;
            }

            .form-filter {
                margin-left: 10px !important; 
            }

            #end_date {
                position: relative;
                z-index: 9999;
            }
        </style>
    </head>

    <!--begin::Page title-->
    <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
        <!--begin::Title-->
        <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Salur</h1>
        <!--end::Title-->
        <!--begin::Breadcrumb-->
        <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
            <!--begin::Item-->
            <li class="breadcrumb-item text-dark" style="color:darkblue">Muat Turun</li>
            <!--end::Item-->
            <!--begin::Item-->
            <li class="breadcrumb-item">
                <span class="bullet bg-gray-400 w-5px h-2px"></span>
            </li>
            <!--end::Item-->
            <!--begin::Item-->
            <li class="breadcrumb-item text-dark" style="color:darkblue">Borang SPBB 1, 1a, 2a</li>
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
                                <h2>Kemaskini Maklumat Pembayaran<br><small>Sila muat turun excel fail untuk mengisi maklumat baucar dan muat naik kembali ke dalam sistem untuk simpan maklumat berkenaan.</small></h2>
                            </div>

                            {{-- top nav bar --}}
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active" id="permohonan-tab" data-toggle="tab" data-target="#permohonan" type="button" role="tab" aria-controls="permohonan" aria-selected="true">Permohonan</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="tuntutan-tab" data-toggle="tab" data-target="#tuntutan" type="button" role="tab" aria-controls="tuntutan" aria-selected="true">Tuntutan</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="kutipan-tab" data-toggle="tab" data-target="#kutipan" type="button" role="tab" aria-controls="kutipan" aria-selected="true">Kutipan Balik</button>
                                </li>
                            </ul>

                            <!--begin::Card title-->
                            <div class="card-title">
                                <div class="d-flex align-items-center position-relative my-1">
                                    <input type="hidden" data-kt-subscription-table-filter="search" >
                                </div>
                            </div>
                            <!--begin::Card title-->

                            <!--begin::Card toolbar-->
                            <!-- PERMOHONAN / TUNTUTAN TOOLBAR -->
                            <div class="card-toolbar" id="permohonan-tuntutan-toolbar" data-kt-subscription-table-filter="form">
                                <div class="d-flex justify-content-between mt-5 mb-0" data-kt-subscription-table-toolbar="base">
                                    <div class="col-md-12">
                                        <div class="row form-filter align-items-center">

                                            <!-- DATE FILTER -->
                                            <div class="col-md-4 d-flex align-items-center">
                                                <div class="flex-fill pe-2">
                                                    <input type="date" name="start_date" id="start_date" class="form-control" />
                                                </div>
                                                <div class="px-2">-</div>
                                                <div class="flex-fill ps-2">
                                                    <input type="date" name="end_date" id="end_date" class="form-control" />
                                                </div>
                                            </div>

                                            <!-- FILTER BUTTON -->
                                            <div class="col-md-2 d-flex justify-content-center ms-6">
                                                <button type="submit" class="btn btn-primary fw-semibold" 
                                                        data-kt-menu-dismiss="true" 
                                                        data-kt-subscription-table-filter="filter" 
                                                        onclick="applyFilter()">
                                                    <i class="ki-duotone ki-filter fs-2">
                                                        <span class="path1"></span>
                                                        <span class="path2"></span>
                                                    </i>
                                                </button>
                                            </div>


                                            <!-- PERMOHONAN EXPORT -->
                                            <div class="col-md-3 export-container" data-program-code="permohonan">
                                                <a href="{{ route('penyelaras.dokumen.SPBB1a') }}" 
                                                class="btn btn-info btn-round w-100">
                                                    <i class="fas fa-download text-white"></i> SPBB 1a
                                                </a>
                                            </div>

                                            <!-- TUNTUTAN EXPORT -->
                                            <div class="col-md-3 export-container" data-program-code="tuntutan">
                                                <a href="{{ route('penyelaras.dokumen.SPBB1') }}" 
                                                class="btn btn-info btn-round w-100">
                                                    <i class="fas fa-download text-white"></i> SPBB 1
                                                </a>
                                            </div>

                                        </div><!-- /.row -->
                                    </div>
                                </div>
                            </div>


                            <!-- KUTIPAN TOOLBAR -->
                            <div class="card-toolbar" id="kutipan-toolbar" data-kt-subscription-table-filter="status">
                                <div class="d-flex justify-content-between mt-5 mb-0">
                                    <div class="col-md-12">
                                        <div class="row form-filter align-items-center">

                                            <!-- STATUS FILTER -->
                                            <div class="col-md-4">
                                                <select class="form-select" id="kutipan_status_filter">
                                                    <option value="">Pilih Status</option>
                                                    <option value="AKTIF">AKTIF</option>
                                                    <option value="TIDAK AKTIF">TIDAK AKTIF</option>
                                                </select>
                                            </div>

                                            <!-- FILTER BUTTON -->
                                            <div class="col-md-2 d-flex justify-content-center">
                                                <button type="button" class="btn btn-primary fw-semibold" onclick="applyStatusFilter()">
                                                    <i class="ki-duotone ki-filter fs-2">
                                                        <span class="path1"></span>
                                                        <span class="path2"></span>
                                                    </i>
                                                </button>
                                            </div>

                                            <!-- KUTIPAN EXPORT -->
                                            <div class="col-md-3 export-container" data-program-code="kutipan">
                                                <a href="{{ route('penyelaras.dokumen.SPBB2a') }}" 
                                                class="btn btn-info btn-round w-100">
                                                    <i class="fas fa-download text-white"></i> SPBB 2a
                                                </a>
                                            </div>

                                        </div><!-- /.row -->
                                    </div>
                                </div>
                            </div>


                            <!--end::Card toolbar-->

                            <div class="tab-content" id="myTabContent">
                                {{-- Permohonan --}}
                                <div class="tab-pane fade show active" id="permohonan" role="tabpanel" aria-labelledby="permohonan-tab">
                                    <div class="body">
                                        <table id="sortTable1" class="table table-bordered table-striped" style="margin-top: 0 !important;">
                                            <thead>
                                                <tr>
                                                    <th style="width: 15%"><b>ID Permohonan</b></th>                                                   
                                                    <th style="width: 45%"><b>Nama</b></th>
                                                    <th class="text-center" style="width: 10%"><b>Amaun Yuran</b></th>
                                                    <th class="text-center" style="width: 15%"><b>Amaun Wang Saku</b></th>
                                                    <th class="text-center" style="width: 15%"><b>Tarikh Permohonan</b></th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                @php
                                                    $i=0;
                                                @endphp
                                                @php
                                                    require_once app_path('helpers.php'); 
                                                @endphp
                                            
                                                @foreach ($permohonanLayak as $item)
                                                    @php
                                                        $i++;
                                                        $nama_pemohon = DB::table('smoku')->where('id', $item['smoku_id'])->value('nama');
                                                        
                                                        $infoipt = DB::table('bk_info_institusi')->where('id_institusi', Auth::user()->id_institusi)->first();

                                                        if ($infoipt && $infoipt->id_induk != null) {
                                                            $infoiptCollection = DB::table('bk_info_institusi')->where('id_induk', Auth::user()->id_institusi)->get();
                                                        } else {
                                                            $infoiptCollection = collect([$infoipt]); // Wrap single object in a collection for consistency
                                                        }

                                                        // Extract all `id_institusi` values (handles both single and multiple records)
                                                        $instiusi_user = $infoiptCollection->pluck('id_institusi');
                                                        // $instiusi_user = auth()->user()->id_institusi;
                                                        
                                                        $institusi_id = DB::table('smoku_akademik')
                                                        ->join('bk_info_institusi','bk_info_institusi.id_institusi','=','smoku_akademik.id_institusi' )
                                                        ->where('smoku_id', $item['smoku_id'])->value('bk_info_institusi.id_institusi');

                                                        // nama pemohon
                                                        $text = ucwords(strtolower($nama_pemohon)); 
                                                        $conjunctions = ['bin', 'binti'];
                                                        $words = explode(' ', $text);
                                                        $result = [];
                                                        foreach ($words as $word) {
                                                            if (in_array(Str::lower($word), $conjunctions)) {
                                                                $result[] = Str::lower($word);
                                                            } else {
                                                                $result[] = $word;
                                                            }
                                                        }
                                                        $pemohon = implode(' ', $result);
                                                    @endphp
                                                    
                                                    @if ($instiusi_user->contains($institusi_id))
                                                        <!-- Table rows -->
                                                        <tr>
                                                            {{-- <td class="text-center" style="width: 5%;"><input type="checkbox" name="selected_items[]" value="{{ $item->id }}" /></td>  --}}
                                                            {{-- <td style="width: 15%"><a href="#" class="open-modal-link-permohonan" data-bs-toggle="modal" data-bs-target="#baucerPermohonan{{$item['id']}}" data-no-rujukan="{{$item['no_rujukan_permohonan']}}">{{$item['no_rujukan_permohonan']}}</a></td>--}}                                   
                                                            <td style="width: 15%">{{$item['no_rujukan_permohonan']}}</td>                                          
                                                            <td style="width: 40%">{{$pemohon}}</td>
                                                            <td class="text-center" style="width: 10%">
                                                                @if ($item->yuran_disokong !== null)
                                                                    RM {{ number_format((float) preg_replace('/[^\d.]/', '', $item->yuran_disokong), 2) }}
                                                                @endif
                                                            </td>
                                                            <td class="text-center" style="width: 15%">
                                                                @if ($item->wang_saku_disokong !== null)
                                                                    RM {{ number_format((float) preg_replace('/[^\d.]/', '', $item->wang_saku_disokong), 2) }}
                                                                @endif
                                                            </td>
                                                            <td class="text-center" style="width: 15%">{{date('d/m/Y', strtotime($item->tarikh_hantar))}}</td>
                                                        </tr>

                                                    @endif
                                                @endforeach 
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                {{-- End of Permohonan --}}


                                {{-- Tuntutan --}}
                                <div class="tab-pane fade" id="tuntutan" role="tabpanel" aria-labelledby="tuntutan-tab">
                                    <div class="body">
                                        <table id="sortTable2" class="table table-bordered table-striped" style="margin-top: 0 !important;">
                                            <thead>
                                                <tr>
                                                    <th style="width: 15%"><b>ID Tuntutan</b></th>                                                   
                                                    <th style="width: 45%"><b>Nama</b></th>
                                                    <th class="text-center" style="width: 10%"><b>Amaun Yuran</b></th>
                                                    <th class="text-center" style="width: 15%"><b>Amaun Wang Saku</b></th>
                                                    <th class="text-center" style="width: 15%"><b>Tarikh Tuntutan</b></th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                @php
                                                    $i=0;
                                                @endphp
                                                @php
                                                    require_once app_path('helpers.php');
                                                @endphp
                                            
                                                @foreach ($tuntutanLayak as $item)
                                                    @php
                                                        $i++;
                                                        $nama_pemohon = DB::table('smoku')->where('id', $item['smoku_id'])->value('nama');
                                                        $institusi_id = DB::table('smoku_akademik')->join('bk_info_institusi','bk_info_institusi.id_institusi','=','smoku_akademik.id_institusi' )->where('smoku_id', $item['smoku_id'])->value('bk_info_institusi.id_institusi');
                                                        $instiusi_user = auth()->user()->id_institusi;

                                                        // nama pemohon
                                                        $text = ucwords(strtolower($nama_pemohon)); 
                                                        $conjunctions = ['bin', 'binti'];
                                                        $words = explode(' ', $text);
                                                        $result = [];
                                                        foreach ($words as $word) {
                                                            if (in_array(Str::lower($word), $conjunctions)) {
                                                                $result[] = Str::lower($word);
                                                            } else {
                                                                $result[] = $word;
                                                            }
                                                        }
                                                        $pemohon = implode(' ', $result);
                                                    @endphp
                                                    
                                                    @if ($institusi_id == $instiusi_user)
                                                        <!-- Table rows -->
                                                        <tr>
                                                            {{-- <td style="width: 15%"><a href="#" class="open-modal-link-tuntutan" data-bs-toggle="modal" data-bs-target="#baucerTuntutan" data-no-rujukan="{{$item['id']}}">{{$item['no_rujukan_tuntutan']}}</a></td>                                           --}}
                                                            <td style="width: 15%">{{$item['no_rujukan_tuntutan']}}</td>                                          
                                                            <td style="width: 45%">{{$pemohon}}</td>
                                                            <td class="text-center" style="width: 10%">
                                                                @if ($item->yuran_disokong !== null)
                                                                    RM {{ number_format($item->yuran_disokong, 2) }}
                                                                @endif
                                                            </td>
                                                            <td class="text-center" style="width: 15%">
                                                                @if ($item->wang_saku_disokong !== null)
                                                                    RM {{ number_format($item->wang_saku_disokong, 2) }}
                                                                @endif
                                                            </td>
                                                            <td class="text-center" style="width: 15%">{{date('d/m/Y', strtotime($item->tarikh_hantar))}}</td>
                                                        </tr>

                                                    @endif
                                                @endforeach 
                                            </tbody>
                                        </table>      
                                    </div>
                                </div>
                                {{-- End of Tuntutan --}}

                                {{-- Kutipan Balik --}}
                                <div class="tab-pane fade" id="kutipan" role="tabpanel" aria-labelledby="kutipan-tab">
                                    <div class="body">
                                        <table id="sortTable3" class="table table-bordered table-striped" style="margin-top: 0 !important;">
                                            <thead>
                                                <tr>
                                                    <th style="width: 35%"><b>Nama</b></th>
                                                    <th style="width: 30%"><b>Nama Kursus</b></th> 
                                                    <th class="text-center" style="width: 13%"><b>Jumlah Disokong</b></th>
                                                    <th class="text-center" style="width: 12%"><b>Jumlah Dibayar</b></th>
                                                    <th class="text-center" style="width: 10%"><b>Status</b></th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                @php
                                                    require_once app_path('helpers.php');
                                                    // dd($kutipanBalik);
                                                @endphp
                                            
                                                @foreach ($kutipanBalik as $item)
                                                    @php
                                                        $nama_pemohon = DB::table('smoku')->where('id', $item['smoku_id'])->value('nama');
                                                        $nama_kursus = DB::table('smoku_akademik')->where('smoku_id', $item['smoku_id'])->value('nama_kursus');
                                                        $institusi_pelajar = DB::table('smoku_akademik')->join('bk_info_institusi','bk_info_institusi.id_institusi','=','smoku_akademik.id_institusi' )->where('smoku_id', $item['smoku_id'])->value('bk_info_institusi.id_institusi');
                                                        
                                                        // nama pemohon
                                                        $text = ucwords(strtolower($nama_pemohon)); 
                                                        $conjunctions = ['bin', 'binti'];
                                                        $words = explode(' ', $text);
                                                        $result = [];
                                                        foreach ($words as $word) {
                                                            if (in_array(Str::lower($word), $conjunctions)) {
                                                                $result[] = Str::lower($word);
                                                            } else {
                                                                $result[] = $word;
                                                            }
                                                        }
                                                        $pemohon = implode(' ', $result);
                                                    @endphp
                                                    
                                                    @if ($institusiId == $institusi_pelajar)
                                                        <tr>
                                                            <td style="width: 35%">{{$pemohon}}</td>
                                                            <td style="width: 30%">{{$nama_kursus}}</td> 
                                                            <td class="text-center" style="width: 13%">
                                                                @if ($item->yuran_disokong !== null && is_numeric($item->yuran_disokong) && $item->wang_saku_disokong !== null && is_numeric($item->wang_saku_disokong))
                                                                    RM {{ number_format($item->yuran_disokong + $item->wang_saku_disokong, 2) }}                                                                    
                                                                @elseif ($item->yuran_disokong == null && $item->wang_saku_disokong !== null && is_numeric($item->wang_saku_disokong))
                                                                    RM {{ number_format($item->wang_saku_disokong, 2) }} 
                                                                @elseif ($item->yuran_disokong !== null && is_numeric($item->yuran_disokong) && $item->wang_saku_disokong == null)
                                                                    RM {{ number_format($item->yuran_disokong, 2) }}  
                                                                @endif
                                                            </td>
                                                            <td class="text-center" style="width: 12%">
                                                                @if ($item->yuran_dibayar !== null && is_numeric($item->yuran_dibayar) && $item->wang_saku_dibayar !== null && is_numeric($item->wang_saku_dibayar))
                                                                    RM {{ number_format($item->yuran_dibayar + $item->wang_saku_dibayar, 2) }}
                                                                @elseif ($item->yuran_dibayar == null && $item->wang_saku_dibayar !== null && is_numeric($item->wang_saku_dibayar))
                                                                    RM {{ number_format($item->wang_saku_dibayar, 2) }} 
                                                                @elseif ($item->yuran_dibayar !== null && is_numeric($item->yuran_dibayar) && $item->wang_saku_dibayar == null)
                                                                    RM {{ number_format($item->yuran_dibayar, 2) }}  
                                                                @endif
                                                            </td>
                                                            <td class="text-center" style="width: 10%">{{strtoupper($item->status_pemohon)}}</td>
                                                        </tr>
                                                    @endif
                                                @endforeach 
                                            </tbody>
                                        </table>     
                                    </div>
                                </div>
                                {{-- End of Kutipan Balik --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
        <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>

        <script>
            var datatable1, datatable2, datatable3;

            $(document).ready(function() 
            {
                // Initialize DataTables
                initDataTable('#sortTable1', 'datatable1');
                initDataTable('#sortTable2', 'datatable2');
                initDataTable('#sortTable3', 'datatable3');

                // Log data for all tables
                logTableData('Table 1 Data:', datatable1);
                logTableData('Table 2 Data:', datatable2);
                logTableData('Table 3 Data:', datatable3);
            });

            function initDataTable(tableId, variableName) 
            {
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
                        { orderable: false, targets: [0] },
                        { type: 'date', targets: [4] },
                    ],
                    language: {
                        url: "/assets/lang/Malay.json"
                    }
                });
            }

            function applyFilter() 
            {
                var startDate = $('#start_date').val();
                var endDate = $('#end_date').val();
                console.log(startDate);
                console.log(endDate);
                
                // Apply search filter and log data for all tables
                applyAndLogFilter('Table 1', datatable1, startDate, endDate);
                applyAndLogFilter('Table 2', datatable2, startDate, endDate);
            }

            function applyAndLogFilter(tableName, table, startDate, endDate) 
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

                            let dateAdded = moment(data[4], 'DD/MM/YYYY');

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

                // Log filtered data
                console.log(`Filtered Data (${tableName}):`, table.rows({ search: 'applied' }).data().toArray());

                // Go to the first page for the table
                table.page(0).draw(false);

                // Log the data of visible rows on the first page for the table
                console.log(`Data on Visible Rows (${tableName}, First Page):`, table.rows({ page: 'current' }).data().toArray());
            }

            function logTableData(message, table) 
            {
                console.log(message, table.rows().data().toArray());
            }
        </script>

        <script>
            function applyStatusFilter() 
            {
                console.log("Status filter button clicked");
                var selectedStatus = $('#kutipan_status_filter').val().toUpperCase();
                console.log("Selected Status:", selectedStatus);

                // Apply filter based on selected status
                if (datatable3) {
                    // Clear previous search
                    datatable3.columns().search('').draw();

                    // Apply status filter
                    if (selectedStatus == 'AKTIF' || selectedStatus == 'TIDAK AKTIF') {
                        datatable3.column(4).search(selectedStatus).draw();
                    } else {
                        datatable3.column(4).search('').draw(); // Clear the filter
                    }

                }
            }

            $(document).ready(function() {
                $('.export-container[data-program-code="permohonan"]').show();
                $('.export-container[data-program-code="tuntutan"]').hide();
                $('.export-container[data-program-code="kutipan"]').hide();
                $('.none-container').show(); 
                $('#kutipan-toolbar').hide();

                $('.nav-link').on('click', function() {
                    var activeTabId = $(this).attr('id');
                    clearFilters();
                    updateExportContainers(activeTabId);
                });

                // Bind applyStatusFilter function to click event of filter button
                $('#kutipan-toolbar button').on('click', function() {
                        applyStatusFilter();
                });

                function clearFilters() {
                    if (datatable1) {
                        datatable1.search('').columns().search('').draw();
                    }
                    if (datatable2) {
                        datatable2.search('').columns().search('').draw();
                    }
                    if (datatable3) {
                        datatable3.search('').columns().search('').draw();
                    }
                }

                function updateExportContainers(activeTabId) 
                {
                    $('.export-container').hide();
                    var programCode = getProgramCode(activeTabId);

                    // Hide all card toolbars
                    $('.card-toolbar').hide();

                    // Show the card toolbar based on the active tab
                    if (programCode === 'permohonan' || programCode === 'tuntutan') {
                        $('#permohonan-tuntutan-toolbar').show();
                    } else if (programCode === 'kutipan') {
                        $('#kutipan-toolbar').show();
                    }

                    // Show the corresponding export container based on the program code
                    $('.export-container[data-program-code="' + programCode + '"]').show();
                }

                function getProgramCode(activeTabId) {
                    switch (activeTabId) {
                        case 'permohonan-tab':
                            return 'permohonan';
                        case 'tuntutan-tab':
                            return 'tuntutan';
                        case 'kutipan-tab':
                            return 'kutipan';
                        default:
                            return '';
                    }
                }

                // Add this script for the "Muat Turun" button permohonan
                $('.export-container[data-program-code="permohonan"] form').on('submit', function() {
                    var startDate = $('#start_date').val();
                    var endDate = $('#end_date').val();
                    console.log('Start Date:', startDate);
                    console.log('End Date:', endDate);

                    // Format the dates as "YYYY-MM-DD"
                    startDate = moment(startDate, 'YYYY-MM-DD').format('YYYY-MM-DD');
                    endDate = moment(endDate, 'YYYY-MM-DD').format('YYYY-MM-DD');

                    // Set the hidden inputs with filter values before form submission
                    $('#permohonan_hidden_start_date').val(startDate);
                    $('#permohonan_hidden_end_date').val(endDate);
                });

                // Add this script for the "Muat Turun" button tuntutan
                $('.export-container[data-program-code="tuntutan"] form').on('submit', function() {
                    var startDate = $('#start_date').val();
                    var endDate = $('#end_date').val();
                    console.log('Start Date:', startDate);
                    console.log('End Date:', endDate);

                    // Format the dates as "YYYY-MM-DD"
                    startDate = moment(startDate, 'YYYY-MM-DD').format('YYYY-MM-DD');
                    endDate = moment(endDate, 'YYYY-MM-DD').format('YYYY-MM-DD');

                    // Set the hidden inputs with filter values before form submission
                    $('#tuntutan_hidden_start_date').val(startDate);
                    $('#tuntutan_hidden_end_date').val(endDate);
                });
            });
        </script>

        <script>
            //permohonan
            function uploadFilePermohonan() {
                // Trigger the click event of the hidden file input
                document.querySelector('input[name="modified_excel_file1"]').click();
            }

            function fileSelected1(event) {
                // Set the hidden input value to 1 when a file is selected
                document.getElementById('formSubmitted1').value = 1;
                // Submit the form
                document.getElementById('uploadForm1').submit();
            }

            //tuntutan
            function uploadFileTuntutan() {
                // Trigger the click event of the hidden file input
                document.querySelector('input[name="modified_excel_file2"]').click();
            }

            function fileSelected2(event) {
                // Set the hidden input value to 1 when a file is selected
                document.getElementById('formSubmitted2').value = 1;
                // Submit the form
                document.getElementById('uploadForm2').submit();
            }

            // Display SweetAlert for success and error messages after file import
            @if(session('success'))
                Swal.fire({
                    icon: 'success',
                    title: 'Berjaya!',
                    text: '{!! session('success') !!}',
                    confirmButtonText: 'OK'
                });
            @endif

            @if(session('failed'))
                Swal.fire({
                    icon: 'error',
                    title: 'Tidak Berjaya!',
                    text: '{!! session('failed') !!}',
                    confirmButtonText: 'OK'
                });
            @endif
        </script>
    </body>
</x-default-layout> 
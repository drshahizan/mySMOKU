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
                                    <button class="nav-link active" id="bkoku-tab" data-toggle="tab" data-target="#bkoku" type="button" role="tab" aria-controls="bkoku" aria-selected="true">BKOKU</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="bkokuUA-tab" data-toggle="tab" data-target="#bkokuUA" type="button" role="tab" aria-controls="bkokuUA" aria-selected="false">BKOKU UA</button>
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
                                                    <option value="Ya Lulus">Layak</option>
                                                    <option value="Tidak Lulus">Tidak Layak</option>
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
                                {{-- BKOKU --}}
                                <div class="tab-pane fade show active" id="bkoku" role="tabpanel" aria-labelledby="bkoku-tab">
                                    <div class="body">
                                        <div class="table-responsive" id="table-responsive">
                                            <table id="sortTable1" class="table table-bordered table-striped">
                                                <thead>
                                                    <tr style="color: white; background-color:rgb(35, 58, 108);">
                                                        <th style="width: 15%"><b>ID Tuntutan</b></th>
                                                        <th style="width: 25%"><b>Nama</b></th>
                                                        <th class="text-center" style="width: 20%"><b>Institusi Pengajian</b></th>
                                                        <th class="text-center" style="width: 20%"><b>ID Institusi</b></th>
                                                        <th style="width: 15%"><b>Peringkat Pengajian</b></th>
                                                        <th class="text-center" style="width: 17%"><b>Tarikh Kemaskini Keputusan</b></th>
                                                        <th class="text-center" style="width: 15%">Status Tuntutan</th>
                                                        <th class="text-center" style="width: 15%">Status</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($tuntutan as $item)
                                                        @php
                                                            $permohonan = DB::table('permohonan')->where('id', $item['permohonan_id'])->first();
                                                            $rujukan = explode("/", $item['no_rujukan_tuntutan']);
                                                            $peringkat = $rujukan[1];
                                                            $akademik = DB::table('smoku_akademik')->where('smoku_id', $item['smoku_id'])->where('peringkat_pengajian',$peringkat)->where('status', 1)->first();
                                                            $jenis_institusi = DB::table('bk_info_institusi')->where('id_institusi', $akademik->id_institusi)->value('jenis_institusi');
                                                            $institusi_pengajian = DB::table('smoku_akademik')->join('bk_info_institusi','bk_info_institusi.id_institusi','=','smoku_akademik.id_institusi' )->where('smoku_id', $item['smoku_id'])->where('peringkat_pengajian',$peringkat)->value('bk_info_institusi.nama_institusi');
                                                            $id_institusi = $item['id_institusi'];

                                                            $nama_peringkat = DB::table('bk_peringkat_pengajian')->where('kod_peringkat', $peringkat)->value('peringkat');

                                                            $nama_pemohon = DB::table('smoku')->where('id', $permohonan->smoku_id)->value('nama');
                                                            $status = DB::table('bk_status')->where('kod_status', $item['status'])->value('status');
                                                            $text = ucwords(strtolower($nama_pemohon)); // Assuming you're sending the text as a POST parameter
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

                                                            //institusi pengajian
                                                            $text3 = ucwords(strtolower($institusi_pengajian));
                                                            $conjunctions = ['of', 'in', 'and'];
                                                            $words = explode(' ', $text3);
                                                            $result = [];
                                                            foreach ($words as $word) {
                                                                if (in_array(Str::lower($word), $conjunctions)) {
                                                                    $result[] = Str::lower($word);
                                                                } else {
                                                                    $result[] = $word;
                                                                }
                                                            }
                                                            $institusi = implode(' ', $result);
                                                            $institusipengajian = transformBracketsToUppercase($institusi);
                                                        @endphp

                                                        @if($permohonan->program=="BKOKU")
                                                            @if ($jenis_institusi!="UA")
                                                            <tr>
                                                                <td>{{$item->no_rujukan_tuntutan}}</td>
                                                                <td style="width: 25%">{{$pemohon}}</td>
                                                                <td style="width: 20%">{{$institusipengajian}}</td>
                                                                <td style="width: 20%">{{$id_institusi}}</td>
                                                                <td>{{ucwords(strtolower($nama_peringkat))}}</td>
                                                                <td class="text-center"> {{ \Carbon\Carbon::parse($item['tarikh_keputusan'])->format('d/m/Y') }}</td>
                                                                @if($item['status'] == "6")
                                                                    <td class="text-center"><button type="button" class="btn btn-success btn-sm">{{ucwords(strtolower($status))}}</button></td>
                                                                @elseif ($item['status']=="5")
                                                                    <td class="text-center"><button type="button" class="btn bg-dikembalikan">{{ucwords(strtolower($status))}}</button></td>
                                                                @elseif($item['status'] == "7")
                                                                    <td class="text-center"><button type="button" class="btn btn-danger btn-sm">{{ucwords(strtolower($status))}}</button></td>
                                                                @endif
                                                                @if($item->keputusan == "LAYAK")
                                                                    <td style="width: 15%">Ya Lulus</td>
                                                                @elseif($item->keputusan == "TIDAK LAYAK")
                                                                    <td style="width: 15%">Tidak Lulus</td>
                                                                @endif

                                                            </tr>
                                                            @endif
                                                       @endif
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                 {{-- BKOKU UA--}}
                                <div class="tab-pane fade" id="bkokuUA" role="tabpanel" aria-labelledby="bkokuUA-tab">
                                    <div class="body">
                                        <div class="table-responsive" id="table-responsive">
                                            <table id="sortTable2" class="table table-bordered table-striped">
                                                <thead>
                                                <tr style="color: white; background-color:rgb(35, 58, 108);">
                                                    <th style="width: 15%"><b>ID Tuntutan</b></th>
                                                    <th style="width: 25%"><b>Nama</b></th>
                                                    <th class="text-center" style="width: 20%"><b>Institusi Pengajian</b></th>
                                                    <th class="text-center" style="width: 20%"><b>ID Institusi</b></th>
                                                    <th style="width: 15%"><b>Peringkat Pengajian</b></th>
                                                    <th class="text-center" style="width: 17%"><b>Tarikh Kemaskini Keputusan</b></th>
                                                    <th class="text-center" style="width: 15%">Status Tuntutan</th>
                                                    <th class="text-center" style="width: 15%">Status</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach ($tuntutan as $item)
                                                    @php
                                                        $permohonan = DB::table('permohonan')->where('id', $item['permohonan_id'])->first();
                                                        $rujukan = explode("/", $item['no_rujukan_tuntutan']);
                                                        $peringkat = $rujukan[1];
                                                        $akademik = DB::table('smoku_akademik')->where('smoku_id', $item['smoku_id'])->where('peringkat_pengajian',$peringkat)->where('status', 1)->first();
                                                        $jenis_institusi = DB::table('bk_info_institusi')->where('id_institusi', $akademik->id_institusi)->value('jenis_institusi');
                                                        $institusi_pengajian = DB::table('smoku_akademik')->join('bk_info_institusi','bk_info_institusi.id_institusi','=','smoku_akademik.id_institusi' )->where('smoku_id', $item['smoku_id'])->where('peringkat_pengajian',$peringkat)->value('bk_info_institusi.nama_institusi');
                                                        $id_institusi = $item['id_institusi'];

                                                        $nama_peringkat = DB::table('bk_peringkat_pengajian')->where('kod_peringkat', $peringkat)->value('peringkat');

                                                        $permohonan = DB::table('permohonan')->where('id', $item['permohonan_id'])->first();
                                                        $nama_pemohon = DB::table('smoku')->where('id', $permohonan->smoku_id)->value('nama');
                                                        $status = DB::table('bk_status')->where('kod_status', $item['status'])->value('status');
                                                        $text = ucwords(strtolower($nama_pemohon)); // Assuming you're sending the text as a POST parameter
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

                                                        //institusi pengajian
                                                        $text3 = ucwords(strtolower($institusi_pengajian));
                                                        $conjunctions = ['of', 'in', 'and'];
                                                        $words = explode(' ', $text3);
                                                        $result = [];
                                                        foreach ($words as $word) {
                                                            if (in_array(Str::lower($word), $conjunctions)) {
                                                                $result[] = Str::lower($word);
                                                            } else {
                                                                $result[] = $word;
                                                            }
                                                        }
                                                        $institusi = implode(' ', $result);
                                                        $institusipengajian = transformBracketsToUppercase($institusi);
                                                    @endphp

                                                    @if($permohonan->program=="BKOKU")
                                                        @if ($jenis_institusi=="UA")
                                                            <tr>
                                                                <td style="width: 13%">{{$item->no_rujukan_tuntutan}}</td>
                                                                <td style="width: 25%">{{$pemohon}}</td>
                                                                <td style="width: 20%">{{$institusipengajian}}</td>
                                                                <td style="width: 20%">{{$id_institusi}}</td>
                                                                <td style="width: 15%">{{ucwords(strtolower($nama_peringkat))}}</td>
                                                                <td class="text-center" style="width: 17%"> {{ \Carbon\Carbon::parse($item['tarikh_keputusan'])->format('d/m/Y') }}</td>
                                                                @if($item['status'] == "6")
                                                                    <td class="text-center" style="width: 15%"><button type="button" class="btn btn-success btn-sm">{{ucwords(strtolower($status))}}</button></td>
                                                                @elseif ($item['status']=="5")
                                                                    <td class="text-center" style="width: 15%"><button type="button" class="btn bg-dikembalikan">{{ucwords(strtolower($status))}}</button></td>
                                                                @elseif($item['status'] == "7")
                                                                    <td class="text-center" style="width: 15%"><button type="button" class="btn btn-danger btn-sm">{{ucwords(strtolower($status))}}</button></td>
                                                                @endif
                                                                @if($item->keputusan == "LAYAK")
                                                                    <td style="width: 15%">Ya Lulus</td>
                                                                @elseif($item->keputusan == "TIDAK LAYAK")
                                                                    <td style="width: 15%">Tidak Lulus</td>
                                                                @endif

                                                            </tr>
                                                        @endif
                                                    @endif
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                {{-- PKK --}}
                                <div class="tab-pane fade" id="ppk" role="tabpanel" aria-labelledby="ppk-tab">
                                    <div class="body">
                                        <div class="table-responsive">
                                            <table id="sortTable3" class="table table-bordered table-striped">
                                                <thead>
                                                    <tr style="color: white; background-color:rgb(35, 58, 108);">
                                                        <th style="width: 15%"><b>ID Tuntutan</b></th>
                                                        <th style="width: 25%"><b>Nama</b></th>
                                                        <th class="text-center" style="width: 20%"><b>Institusi Pengajian</b></th>
                                                        <th class="text-center" style="width: 20%"><b>ID Institusi</b></th>
                                                        <th style="width: 15%"><b>Peringkat Pengajian</b></th>
                                                        <th class="text-center" style="width: 17%"><b>Tarikh Kemaskini Keputusan</b></th>
                                                        <th class="text-center" style="width: 15%">Status Tuntutan</th>
                                                        <th class="text-center" style="width: 15%">Status</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($tuntutan as $item)
                                                        @php
                                                            $permohonan = DB::table('permohonan')->where('id', $item['permohonan_id'])->first();
                                                            $rujukan = explode("/", $item['no_rujukan_tuntutan']);
                                                            $peringkat = $rujukan[1];
                                                            $akademik = DB::table('smoku_akademik')->where('smoku_id', $item['smoku_id'])->where('peringkat_pengajian',$peringkat)->where('status', 1)->first();
                                                            $jenis_institusi = DB::table('bk_info_institusi')->where('id_institusi', $akademik->id_institusi)->value('jenis_institusi');
                                                            $institusi_pengajian = DB::table('smoku_akademik')->join('bk_info_institusi','bk_info_institusi.id_institusi','=','smoku_akademik.id_institusi' )->where('smoku_id', $item['smoku_id'])->where('peringkat_pengajian',$peringkat)->value('bk_info_institusi.nama_institusi');
                                                            $nama_peringkat = DB::table('bk_peringkat_pengajian')->where('kod_peringkat', $peringkat)->value('peringkat');
                                                            $id_institusi = $item['id_institusi'];

                                                            $nama_pemohon = DB::table('smoku')->where('id', $permohonan->smoku_id)->value('nama');
                                                            $status = DB::table('bk_status')->where('kod_status', $item['status'])->value('status');
                                                            $text = ucwords(strtolower($nama_pemohon)); // Assuming you're sending the text as a POST parameter
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

                                                            //institusi pengajian
                                                            $text3 = ucwords(strtolower($institusi_pengajian));
                                                            $conjunctions = ['of', 'in', 'and'];
                                                            $words = explode(' ', $text3);
                                                            $result = [];
                                                            foreach ($words as $word) {
                                                                if (in_array(Str::lower($word), $conjunctions)) {
                                                                    $result[] = Str::lower($word);
                                                                } else {
                                                                    $result[] = $word;
                                                                }
                                                            }
                                                            $institusi = implode(' ', $result);
                                                            $institusipengajian = transformBracketsToUppercase($institusi);
                                                        @endphp

                                                        @if($permohonan->program=="PPK")
                                                        <tr>
                                                            <td style="width: 13%">{{$item->no_rujukan_tuntutan}}</td>
                                                            <td style="width: 25%">{{$pemohon}}</td>
                                                            <td style="width: 20%">{{$institusipengajian}}</td>
                                                            <td style="width: 20%">{{$id_institusi}}</td>
                                                            <td style="width: 15%">{{ucwords(strtolower($nama_peringkat))}}</td>
                                                            <td class="text-center" style="width: 17%"> {{ \Carbon\Carbon::parse($item['tarikh_keputusan'])->format('d/m/Y') }}</td>
                                                            @if($item['status'] == "6")
                                                                <td class="text-center" style="width: 15%"><button type="button" class="btn btn-success btn-sm">{{ucwords(strtolower($status))}}</button></td>
                                                            @elseif ($item['status']=="5")
                                                                <td class="text-center" style="width: 15%"><button type="button" class="btn bg-dikembalikan">{{ucwords(strtolower($status))}}</button></td>
                                                            @elseif($item['status'] == "7")
                                                                <td class="text-center" style="width: 15%"><button type="button" class="btn btn-danger btn-sm">{{ucwords(strtolower($status))}}</button></td>
                                                            @endif
                                                            @if($item->keputusan == "LAYAK")
                                                                <td style="width: 15%">Ya Lulus</td>
                                                            @elseif($item->keputusan == "TIDAK LAYAK")
                                                                <td style="width: 15%">Tidak Lulus</td>
                                                            @endif
                                                        </tr>
                                                    @endif
                                                    @endforeach
                                                </tbody>
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
            // Initialize JavaScript variables with data from Blade
            var bkokuList = @json($institusiPengajian);
            var bkokuUAList = @json($institusiPengajianUA);
            var ppkList = @json($institusiPengajianPPK);

            $(document).ready(function() {
                $('.export-container[data-program-code="BKOKU"]').show();
                $('.export-container[data-program-code="UA"]').hide();
                $('.export-container[data-program-code="PPK"]').hide();

                $('.none-container').show(); // Hide export elements

                // Add an event listener for tab clicks
                $('.nav-link').on('click', function() {
                    // Get the ID of the active tab
                    var activeTabId = $(this).attr('id');

                    // Clear filters when changing tabs
                    clearFilters();

                    updateExportContainers(activeTabId);

                    // Update the institution dropdown based on the active tab
                    switch (activeTabId) {
                        case 'bkoku-tab':
                            updateInstitusiDropdown(bkokuList);
                            break;
                        case 'bkokuUA-tab':
                            updateInstitusiDropdown(bkokuUAList);
                            break;
                        case 'ppk-tab':
                            updateInstitusiDropdown(ppkList);
                            break;
                        // Add more cases if you have additional tabs
                    }
                });

                // Trigger the function for the default active tab (bkoku-tab)
                updateInstitusiDropdown(bkokuList);

                // Function to clear filters for all tables
                function clearFilters() {
                    if (datatable1) {
                        datatable1.search('').columns().search('').draw();
                    }
                    if (datatable) {
                        datatable.search('').columns().search('').draw();
                    }
                    if (datatable2) {
                        datatable2.search('').columns().search('').draw();
                    }
                }

                function updateExportContainers(activeTabId) {
                    // Hide all export containers initially
                    $('.export-container').hide();

                    // Show the export container based on the active tab
                    var programCode = getProgramCode(activeTabId);
                    $('.export-container[data-program-code="' + programCode + '"]').show();
                }

                function getProgramCode(activeTabId) {
                    switch (activeTabId) {
                        case 'bkoku-tab':
                            return 'BKOKU';
                        case 'bkokuUA-tab':
                            return 'UA';
                        case 'ppk-tab':
                            return 'PPK';
                        // Add more cases if you have additional tabs
                        default:
                            return '';
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
                        $('#institusiDropdown').append('<option value="' + institusiList[i].id_institusi + '">' + institusiList[i].nama_institusi + '</option>');
                    }
                }
            });
        </script>

        <script>
            // Declare datatables in a higher scope to make them accessible
            var datatable1, datatable, datatable2;

            $(document).ready(function() {
                // Initialize DataTables
                initDataTable('#sortTable1', 'datatable1');
                initDataTable('#sortTable2', 'datatable');
                initDataTable('#sortTable3', 'datatable2');

                // Log data for all tables
                logTableData('Table 1 Data:', datatable1);
                logTableData('Table 2 Data:', datatable);
                logTableData('Table 3 Data:', datatable2);
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
                        { orderable: false, targets: [0] },
                        { targets: [3], visible: false }, // Hide column (index 4)
                        { type: 'date', targets: [5] },
                        { targets: [7], visible: false } // Hide column (index 9)
                    ]
                });
            }

            function applyFilter() {
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
                applyAndLogFilter('Table 2', datatable, selectedInstitusi, startDate, endDate, status);
                applyAndLogFilter('Table 3', datatable2, selectedInstitusi, startDate, endDate, status);
            

                
                // var exportBKOKU = document.getElementById('exportBKOKU');
                // exportBKOKU.href = "{{ route('senarai.disokong.pdf', ['programCode' => 'BKOKU']) }}?institusi=" + selectedInstitusi;
                

                // var exportUA = document.getElementById('exportUA');
                // exportUA.href = "{{ route('senarai.disokong.pdf', ['programCode' => 'UA']) }}?institusi=" + selectedInstitusi;
            

                // var exportPPK = document.getElementById('exportPPK');
                // exportPPK.href = "{{ route('senarai.keputusan.PPK.pdf', ['start_date' =>'" + startDate + "', 'end_date' =>'" + endDate + "', 'status' =>'" + status + "', 'institusi' =>'" + selectedInstitusi + "']) }}";
            
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
                    table.column(3).search(institusi).draw();
                }

                // Apply search filter for status
                if (status) {
                    table.column(7).search(status).draw();
                }

                // Log filtered data
                console.log(`Filtered Data (${tableName}):`, table.rows({ search: 'applied' }).data().toArray());

                // Go to the first page for the table
                table.page(0).draw(false);

                // Log the data of visible rows on the first page for the table
                console.log(`Data on Visible Rows (${tableName}, First Page):`, table.rows({ page: 'current' }).data().toArray());
            }


            function logTableData(message, table) {
                console.log(message, table.rows().data().toArray());
            }
        </script>

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
    </body>
</x-default-layout>

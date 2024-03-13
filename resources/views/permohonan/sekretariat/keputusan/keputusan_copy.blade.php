<x-default-layout>
    <head>
        <title>Sekretariat BKOKU KPT</title>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">

        <!-- MAIN CSS -->
        <link rel="stylesheet" href="/assets/css/sekretariat.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
        
        <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
        <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/datetime/1.5.1/js/dataTables.dateTime.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>

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
			<li class="breadcrumb-item text-dark" style="color:darkblue">Keputusan</li>
			<!--end::Item-->
		</ul>
	<!--end::Breadcrumb-->
	</div>
	<!--end::Page title-->
    <br>

    <body>
        @if($notifikasi!=NULL)
            @if($keputusan=="Lulus")
                <div class="alert alert-success" role="alert" style="margin: 0px 15px 20px 15px; color:black!important;">
                    {{ $notifikasi }}
                </div>
            @elseif($keputusan=="Tidak Lulus")
                <div class="alert alert-danger" role="alert" style="margin: 0px 15px 20px 15px; color:black!important;">
                    {{ $notifikasi }}
                </div>
            @endif
        @endif

        <!-- Main body part  -->
        <div id="main-content">
            <div class="container-fluid">
                <div class="block-header">
                    <div class="row clearfix">
                        <div class="card">
                            <div class="header">
                                <h2>Senarai Keputusan Permohonan
                                    <br><small>Surat tawaran bagi permohonan berstatus layak boleh dimuat turun dengan klik pada kotak "Layak".</small>
                                </h2>
                            </div>

                            {{-- Javascript Nav Bar --}}
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

                                            <div class="col-md-3">
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
                                        
                                            <div class="col-md-2 export-container" data-program-code="BKOKU"> 
                                                <a id="exportBKOKU" href="{{ route('senarai.keputusan.BKOKU.pdf', [
                                                    'start_date' => Request::get('start_date'),
                                                    'end_date' => Request::get('end_date'),
                                                    'status' => Request::get('status'),
                                                    'institusi' => Request::get('institusi'),]) }}" 
                                                    target="_blank" class="btn btn-secondary btn-round">
                                                    <i class="fa fa-file-pdf" style="color: black;"></i> BKOKU
                                                </a>
                                            </div>

                                            <div class="col-md-2 export-container" data-program-code="UA">
                                                <a id="exportUA" href="{{ route('senarai.keputusan.BKOKU.UA.pdf', [
                                                    'start_date' => Request::get('start_date'),
                                                    'end_date' => Request::get('end_date'),
                                                    'status' => Request::get('status'),
                                                    'institusi' => Request::get('institusi'),]) }}" 
                                                    target="_blank" class="btn btn-secondary btn-round">
                                                    <i class="fa fa-file-pdf" style="color: black;"></i> BKOKU UA
                                                </a>
                                            </div>
                    
                                            <div class="col-md-2 export-container" data-program-code="PPK">
                                                <a id="exportPPK" href="{{ route('senarai.keputusan.PPK.pdf', [
                                                    'start_date' => '" + startDate + "',
                                                    'end_date' => '" + endDate + "',
                                                    'status' => '" + status + "',
                                                    'institusi' => '" + selectedInstitusi + "']) }}" 
                                                    target="_blank" class="btn btn-secondary btn-round">
                                                    <i class="fa fa-file-pdf" style="color: black;"></i> PPK
                                                </a>
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
                                            <table id="sortTable1" class="table table-bordered table-striped" style="margin-top: 0 !important;">
                                                <thead>
                                                    <tr style="color: white;">
                                                        {{-- <th style="width: 3%" class="text-center no-sort"><b>No.</b></th> --}}
                                                        <th style="width: 10%"><b>ID Permohonan</b></th>                                        
                                                        <th style="width: 30%"><b>Nama</b></th>
                                                        <th class="text-center" style="width: 15%"><b>Institusi Pengajian</b></th> 
                                                        <th class="text-center" style="width: 15%"><b>ID Institusi</b></th> 
                                                        <th class="text-center" style="width: 10%"><b>Peringkat Pengajian</b></th> 
                                                        <th class="text-center" style="width: 10%"><b>No. Mesyuarat</b></th>
                                                        <th class="text-center" style="width: 12%"><b>Tarikh Mesyuarat</b></th> 
                                                        <th class="text-center" style="width: 10%"><b>Status Permohonan</b></th>
                                                        <th class="text-center" style="width: 10%"><b>Status</b></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @php
                                                        $i = 1;
                                                    @endphp
                                                        
                                                    @foreach ($kelulusan as $item)
                                                        @php
                                                            $program = DB::table('permohonan')->where('id',$item['permohonan_id'])->value('program');
                                                            $no_rujukan_permohonan = DB::table('permohonan')->where('id',$item['permohonan_id'])->value('no_rujukan_permohonan');
                                                            $nama = DB::table('permohonan')->join('smoku', 'smoku.id', '=', 'permohonan.smoku_id')
                                                                        ->where('permohonan.id', $item['permohonan_id'])
                                                                        ->value('smoku.nama');
                                                            $jenis_institusi = DB::table('permohonan')->join('smoku_akademik', 'permohonan.smoku_id', '=', 'smoku_akademik.smoku_id')
							                                                       ->join('bk_info_institusi', 'smoku_akademik.id_institusi', '=', 'bk_info_institusi.id_institusi')
                                                                                   ->where('permohonan.id', $item['permohonan_id'])
                                                                                   ->value('bk_info_institusi.jenis_institusi');

                                                            $institusi_pengajian = DB::table('permohonan')->join('smoku_akademik', 'permohonan.smoku_id', '=', 'smoku_akademik.smoku_id')
                                                            ->join('bk_info_institusi', 'smoku_akademik.id_institusi', '=', 'bk_info_institusi.id_institusi')
                                                            ->where('permohonan.id', $item['permohonan_id'])
                                                            ->value('bk_info_institusi.nama_institusi');
                                                            $id_institusi = $item['id_institusi'];


                                                            //peringkat pengajian
                                                            preg_match('/\/(\d+)\//', $no_rujukan_permohonan, $matches); // Extract peringkat pengajian value using regular expression
                                                            $peringkat_pengajian = isset($matches[1]) ? $matches[1] : null; // $matches[1] will contain the extracted peringkat pengajian value
                                                            $nama_peringkat = DB::table('bk_peringkat_pengajian')->where('kod_peringkat', $peringkat_pengajian)->value('peringkat');
                                                         
                                                            //nama pelajar
                                                            $text = ucwords(strtolower($nama));
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

                                                        @if($program == "BKOKU")
                                                            @if ($jenis_institusi == "IPTS" || $jenis_institusi == "KK" || $jenis_institusi == "P")
                                                                <tr>
                                                                    {{-- <td class="text-center no-sort" style="width: 3%">{{$i++}}</td> --}}
                                                                    <td style="width: 10%">{{$no_rujukan_permohonan}}</td>
                                                                    <td style="width: 30%">{{$pemohon}}</td>
                                                                    <td style="width: 15%">{{$institusi_pengajian}}</td>
                                                                    <td style="width: 15%">{{$id_institusi}}</td>
                                                                    <td class="text-center" style="width: 10%">{{ucwords(strtolower($nama_peringkat))}}</td>
                                                                    <td class="text-center" style="width: 10%">{{$item->no_mesyuarat}}</td>
                                                                    <td class="text-center" style="width: 12%">{{date('d/m/Y', strtotime($item->tarikh_mesyuarat))}}</td>
                                                                    <td class="text-center" style="width: 10%">
                                                                        @if($item->keputusan == "Lulus")
                                                                            <a href="{{ route('generate-pdf', ['permohonanId' => $item->permohonan_id]) }}" class="btn btn-success btn-round btn-sm custom-width-btn">
                                                                                <i class="fa fa-download custom-white-icon" style="color: white !important; padding-right:7px;"></i> Layak
                                                                            </a>
                                                                        @elseif($item->keputusan == "Tidak Lulus")
                                                                            <div class="btn btn-danger btn-round btn-sm">Tidak Layak</div>
                                                                        @endif
                                                                    </td>
                                                                    @if($item->keputusan == "Lulus")
                                                                        <td style="width: 15%">Ya Lulus</td>
                                                                    @elseif($item->keputusan == "Tidak Lulus")
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

                                {{-- BKOKU UA --}}
                                <div class="tab-pane fade" id="bkokuUA" role="tabpanel" aria-labelledby="bkokuUA-tab">
                                    <div class="body">
                                        <div class="table-responsive" id="table-responsive">
                                            <table id="sortTable2" class="table table-bordered table-striped" style="margin-top: 0 !important;">
                                                <thead>
                                                    <tr style="color: white;">
                                                        {{-- <th style="width: 3%" class="text-center no-sort"><b>No.</b></th> --}}
                                                        <th style="width: 10%"><b>ID Permohonan</b></th>                                        
                                                        <th style="width: 30%"><b>Nama</b></th>
                                                        <th class="text-center" style="width: 15%"><b>Institusi Pengajian</b></th> 
                                                        <th class="text-center" style="width: 15%"><b>ID Institusi</b></th> 
                                                        <th class="text-center" style="width: 10%"><b>Peringkat Pengajian</b></th> 
                                                        <th class="text-center" style="width: 10%"><b>No. Mesyuarat</b></th>
                                                        <th class="text-center" style="width: 12%"><b>Tarikh Mesyuarat</b></th> 
                                                        <th class="text-center" style="width: 10%"><b>Status Permohonan</b></th>
                                                        <th class="text-center" style="width: 10%"><b>Status</b></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @php
                                                        $i = 1;
                                                    @endphp
                                                        
                                                    @foreach ($kelulusan as $item)
                                                        @php
                                                            $program = DB::table('permohonan')->where('id',$item['permohonan_id'])->value('program');
                                                            $no_rujukan_permohonan = DB::table('permohonan')->where('id',$item['permohonan_id'])->value('no_rujukan_permohonan');
                                                            $nama = DB::table('permohonan')->join('smoku', 'smoku.id', '=', 'permohonan.smoku_id')
                                                                        ->where('permohonan.id', $item['permohonan_id'])
                                                                        ->value('smoku.nama');
                                                            $jenis_institusi = DB::table('permohonan')->join('smoku_akademik', 'permohonan.smoku_id', '=', 'smoku_akademik.smoku_id')
							                                                       ->join('bk_info_institusi', 'smoku_akademik.id_institusi', '=', 'bk_info_institusi.id_institusi')
                                                                                   ->where('permohonan.id', $item['permohonan_id'])
                                                                                   ->value('bk_info_institusi.jenis_institusi');
                                                            $institusi_pengajian = DB::table('permohonan')->join('smoku_akademik', 'permohonan.smoku_id', '=', 'smoku_akademik.smoku_id')
                                                                                    ->join('bk_info_institusi', 'smoku_akademik.id_institusi', '=', 'bk_info_institusi.id_institusi')
                                                                                    ->where('permohonan.id', $item['permohonan_id'])
                                                                                    ->value('bk_info_institusi.nama_institusi');
                                                            $id_institusi = $item['id_institusi'];

                                                            //peringkat pengajian
                                                            preg_match('/\/(\d+)\//', $no_rujukan_permohonan, $matches); // Extract peringkat pengajian value using regular expression
                                                            $peringkat_pengajian = isset($matches[1]) ? $matches[1] : null; // $matches[1] will contain the extracted peringkat pengajian value
                                                            $nama_peringkat = DB::table('bk_peringkat_pengajian')->where('kod_peringkat', $peringkat_pengajian)->value('peringkat');
                                                         
                                                            //nama pelajar
                                                            $text = ucwords(strtolower($nama));
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

                                                        @if($program == "BKOKU")
                                                            @if ($jenis_institusi == "UA")
                                                                <tr>
                                                                    {{-- <td class="text-center" style="width: 3%">{{$i++}}</td> --}}
                                                                    <td style="width: 10%">{{$no_rujukan_permohonan}}</td>
                                                                    <td style="width: 30%">{{$pemohon}}</td>
                                                                    <td style="width: 15%">{{$institusi_pengajian}}</td>
                                                                    <td style="width: 15%">{{$id_institusi}}</td>
                                                                    <td class="text-center" style="width: 10%">{{ucwords(strtolower($nama_peringkat))}}</td>
                                                                    <td class="text-center" style="width: 10%">{{$item->no_mesyuarat}}</td>
                                                                    <td class="text-center" style="width: 12%">{{date('d/m/Y', strtotime($item->tarikh_mesyuarat))}}</td>
                                                                    <td class="text-center" style="width: 10%">
                                                                        @if($item->keputusan == "Lulus")
                                                                            <a href="{{ route('generate-pdf', ['permohonanId' => $item->permohonan_id]) }}" class="btn btn-success btn-round btn-sm custom-width-btn">
                                                                                <i class="fa fa-download custom-white-icon" style="color: white !important; padding-right:7px;"></i> Layak
                                                                            </a>
                                                                        @elseif($item->keputusan == "Tidak Lulus")
                                                                            <div class="btn btn-danger btn-round btn-sm">Tidak Layak</div>
                                                                        @endif
                                                                    </td>
                                                                    @if($item->keputusan == "Lulus")
                                                                        <td style="width: 15%">Ya Lulus</td>
                                                                    @elseif($item->keputusan == "Tidak Lulus")
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
                                        <div class="table-responsive" id="table-responsive">
                                            <table id="sortTable3" class="table table-bordered table-striped" style="margin-top: 0 !important;">
                                                <thead>
                                                    <tr style="color: white;">
                                                        {{-- <th style="width: 3%" class="text-center no-sort"><b>No.</b></th> --}}
                                                        <th style="width: 10%"><b>ID Permohonan</b></th>                                        
                                                        <th style="width: 30%"><b>Nama</b></th>
                                                        <th class="text-center" style="width: 15%"><b>Institusi Pengajian</b></th> 
                                                        <th class="text-center" style="width: 15%"><b>ID Institusi</b></th> 
                                                        <th class="text-center" style="width: 10%"><b>Peringkat Pengajian</b></th> 
                                                        <th class="text-center" style="width: 10%"><b>No. Mesyuarat</b></th>
                                                        <th class="text-center" style="width: 12%"><b>Tarikh Mesyuarat</b></th> 
                                                        <th class="text-center" style="width: 10%"><b>Status Permohonan</b></th>
                                                        <th class="text-center" style="width: 10%"><b>Status</b></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @php
                                                        $i = 1;
                                                    @endphp
                                                    
                                                    @foreach ($kelulusan as $item)
                                                        @php
                                                            $no_rujukan_permohonan = DB::table('permohonan')->where('id',$item['permohonan_id'])->value('no_rujukan_permohonan');
                                                            $nama = DB::table('permohonan')->join('smoku', 'smoku.id', '=', 'permohonan.smoku_id')->where('permohonan.id', $item['permohonan_id'])->value('smoku.nama');
                                                            $program = DB::table('permohonan')->where('id',$item['permohonan_id'])->value('program');
                                                            $institusi_pengajian = DB::table('permohonan')->join('smoku_akademik', 'permohonan.smoku_id', '=', 'smoku_akademik.smoku_id')
                                                                                    ->join('bk_info_institusi', 'smoku_akademik.id_institusi', '=', 'bk_info_institusi.id_institusi')
                                                                                    ->where('permohonan.id', $item['permohonan_id'])
                                                                                    ->value('bk_info_institusi.nama_institusi');
                                                            $id_institusi = $item['id_institusi'];

                                                            //peringkat pengajian
                                                            preg_match('/\/(\d+)\//', $no_rujukan_permohonan, $matches); // Extract peringkat pengajian value using regular expression
                                                            $peringkat_pengajian = isset($matches[1]) ? $matches[1] : null; // $matches[1] will contain the extracted peringkat pengajian value
                                                            $nama_peringkat = DB::table('bk_peringkat_pengajian')->where('kod_peringkat', $peringkat_pengajian)->value('peringkat');

                                                            // nama pemohon
                                                            $text = ucwords(strtolower($nama));
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

                                                        @if($program == "PPK")
                                                            <tr>
                                                                {{-- <td class="text-center" style="width: 3%">{{$i++}}</td> --}}
                                                                <td style="width: 10%">{{$no_rujukan_permohonan}}</td>
                                                                <td style="width: 30%">{{$pemohon}}</td>
                                                                <td style="width: 15%">{{$institusi_pengajian}}</td>
                                                                <td style="width: 15%">{{$id_institusi}}</td>
                                                                <td class="text-center" style="width: 10%">{{ucwords(strtolower($nama_peringkat))}}</td>
                                                                <td class="text-center" style="width: 10%">{{$item->no_mesyuarat}}</td>
                                                                <td class="text-center" style="width: 12%">{{date('d/m/Y', strtotime($item->tarikh_mesyuarat))}}</td>
                                                                <td class="text-center" style="width: 10%">
                                                                    @if($item->keputusan == "Lulus")
                                                                        <a href="{{ route('generate-pdf', ['permohonanId' => $item->permohonan_id]) }}" class="btn btn-success btn-round btn-sm custom-width-btn">
                                                                            <i class="fa fa-download custom-white-icon" style="color: white !important; padding-right:7px;"></i> Layak
                                                                        </a>
                                                                    @elseif($item->keputusan == "Tidak Lulus")
                                                                        <div class="btn btn-danger btn-round btn-sm">Tidak Layak</div>
                                                                    @endif
                                                                </td>
                                                                @if($item->keputusan == "Lulus")
                                                                    <td style="width: 15%">Ya Lulus</td>
                                                                @elseif($item->keputusan == "Tidak Lulus")
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
                        { type: 'date', targets: [6] },
                        { targets: [8], visible: false } // Hide column (index 9)
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
            

                
                var exportBKOKU = document.getElementById('exportBKOKU');
                exportBKOKU.href = "{{ route('senarai.keputusan.BKOKU.pdf') }}?start_date=" + startDate + "&end_date=" + endDate + "&status=" + status + "&institusi=" + selectedInstitusi;
                

                var exportUA = document.getElementById('exportUA');
                exportUA.href = "{{ route('senarai.keputusan.BKOKU.UA.pdf') }}?start_date=" + startDate + "&end_date=" + endDate + "&status=" + status + "&institusi=" + selectedInstitusi;


                var exportPPK = document.getElementById('exportPPK');
                exportPPK.href = "{{ route('senarai.keputusan.PPK.pdf') }}?start_date=" + startDate + "&end_date=" + endDate + "&status=" + status + "&institusi=" + selectedInstitusi;
            
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

                            let dateAdded = moment(data[6], 'DD/MM/YYYY');

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
                    console.log('Applying Status Filter:', status);
                    table.column(8).search(status).draw();
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
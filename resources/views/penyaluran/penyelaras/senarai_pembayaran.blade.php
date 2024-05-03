<x-default-layout>
    <head>
        <title>Sekretariat BKOKU KPT</title>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">

        <!-- MAIN CSS -->
        <link rel="stylesheet" href="/assets/css/sekretariat.css">
        <link href="assets/css/style.bundle.css" rel="stylesheet" type="text/css" />
        
        {{-- JAVASCRIPT --}}
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
        <script src="/assets/lang/Malay.json"></script>
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
                background-color: #fff;
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
            <li class="breadcrumb-item text-dark" style="color:darkblue">Penyaluran</li>
            <!--end::Item-->
            <!--begin::Item-->
            <li class="breadcrumb-item">
                <span class="bullet bg-gray-400 w-5px h-2px"></span>
            </li>
            <!--end::Item-->
            <!--begin::Item-->
            <li class="breadcrumb-item text-dark" style="color:darkblue">Senarai Layak</li>
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
                            <div class="card-toolbar" id="permohonan-tuntutan-toolbar" data-kt-subscription-table-filter="form">
                                <div class="d-flex justify-content-between mt-5 mb-0" data-kt-subscription-table-toolbar="base">
                                    <div class="col-md-12">
                                        <div class="row form-filter" >
                                            <div class="col-md-4" style="display: flex; align-items: center;">
                                                <div class="col-md-6">
                                                    <input type="date" name="start_date" id="start_date" value="" class="form-control" />
                                                </div>
                                            
                                                <div class="dash">-</div>
                                            
                                                <div class="col-md-6">
                                                    <input type="date" name="end_date" id="end_date" value="" class="form-control" />
                                                </div>
                                            </div>
                                            
                                            <div class="col-md-1">
                                                <button type="submit" class="btn btn-primary fw-semibold" style="margin-left: 20px;" data-kt-menu-dismiss="true" data-kt-subscription-table-filter="filter" onclick="applyFilter()">
                                                    <i class="ki-duotone ki-filter fs-2">
                                                        <span class="path1"></span>
                                                        <span class="path2"></span>
                                                    </i>
                                                </button>
                                            </div>
                                            
                                            {{-- PERMOHONAN --}}
                                            <div class="col-md-7 export-container" data-program-code="permohonan">
                                                <div class="row" style="margin-bottom:0px!important; margin-left:30px;"> 
                                                    <div class="col-md-3">
                                                        <a href="{{ route('penyelaras.dokumen.SPBB1a') }}" class="btn btn-info btn-round" style="width: 100%; margin: 0 auto;">
															<i class='fas fa-download' style='color:white !important;'></i>SPBB 1a
														</a>
                                                    </div>

                                                    <div class="col-md-4" style="padding-left:30px;">
                                                        <form action="{{ route('penyelaras.permohonan.senarai.layak.excel') }}" method="GET" target="_blank">
                                                            @csrf
                                                            <input type="hidden" name="start_date" id="permohonan_hidden_start_date">
                                                            <input type="hidden" name="end_date" id="permohonan_hidden_end_date">

                                                            <button type="submit" class="btn btn-secondary btn-round">
                                                                <i class="fas fa-download" style="color: black; padding-right:5px;"></i>Kemaskini
                                                            </button>
                                                        </form>
                                                    </div>
                                        
                                                    <div class="col-md-5">
                                                        <form id="uploadForm1" action="{{ route('modified.file.pembayaran.permohonan') }}" method="POST" enctype="multipart/form-data">
                                                            @csrf
                                                            <input type="file" name="modified_excel_file1" accept=".xlsx, .xls" style="display: none" onchange="fileSelected1(event)">
                                                            <input type="hidden" name="form_submitted1" id="formSubmitted1" value="0">
                                                            <button type="button" class="btn btn-secondary btn-round" onclick="uploadFilePermohonan()"> 
                                                                <i class="fa fa-upload" style="color: black; padding-right:5px;"></i>Maklumat Baucer
                                                            </button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>

                                            {{-- TUNTUTAN --}}
                                            <div class="col-md-7 export-container" data-program-code="tuntutan"> 
                                                <div class="row" style="margin-bottom:0px!important; margin-left:40px;"> 
                                                    <div class="col-md-3">
                                                        <a href="{{ route('penyelaras.dokumen.SPBB1') }}" class="btn btn-info btn-round">
															<i class='fas fa-download' style='color:white !important;'></i>SPBB 1
														</a>
                                                    </div>

                                                    <div class="col-md-4" style="padding-left:30px;">
                                                        <form action="{{ route('penyelaras.tuntutan.senarai.layak.excel') }}" method="GET" target="_blank">
                                                            @csrf
                                                            <input type="hidden" name="start_date" id="tuntutan_hidden_start_date">
                                                            <input type="hidden" name="end_date" id="tuntutan_hidden_end_date">

                                                            <button type="submit" class="btn btn-secondary btn-round">
                                                                <i class="fas fa-download" style="color: black; padding-right:5px;"></i>Kemaskini
                                                            </button>
                                                        </form>
                                                    </div>
                                            
                                                    <div class="col-md-5">
                                                        <form id="uploadForm2" action="{{ route('modified.file.pembayaran.tuntutan') }}" method="POST" enctype="multipart/form-data">
                                                            @csrf
                                                            <input type="file" name="modified_excel_file2" accept=".xlsx, .xls" style="display: none" onchange="fileSelected2(event)">
                                                            <input type="hidden" name="form_submitted2" id="formSubmitted2" value="0">
                                                            <button type="button" class="btn btn-secondary btn-round" onclick="uploadFileTuntutan()"> 
                                                                <i class="fa fa-upload" style="color: black; padding-right:5px;"></i>Maklumat Baucer
                                                            </button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card-toolbar" id="kutipan-toolbar" data-kt-subscription-table-filter="status">
                                <div class="d-flex justify-content-between mt-5 mb-0">
                                    <div class="col-md-12">
                                        <div class="row form-filter">
                                            <div class="col-md-2" style="display: flex; align-items: center;">
                                                <select class="form-select" id="kutipan_status_filter">
                                                    <option value="">Pilih Status</option>
                                                    <option value="AKTIF">AKTIF</option>
                                                    <option value="TIDAK AKTIF">TIDAK AKTIF</option>
                                                </select>
                                            </div>
                                            
                                            <div class="col-md-1">
                                                <button type="button" class="btn btn-primary fw-semibold" style="margin-left: 20px;" onclick="applyStatusFilter()">
                                                    <i class="ki-duotone ki-filter fs-2">
                                                        <span class="path1"></span>
                                                        <span class="path2"></span>
                                                    </i>
                                                </button>
                                            </div>

                                            <div class="col-md-9 export-container" data-program-code="kutipan"> 
                                                <div class="row justify-content-end" style="margin-bottom:0px!important; padding-right:20px;"> 
                                                    <div class="col-md-3">
                                                        <a href="{{ route('penyelaras.dokumen.SPBB2a') }}" class="btn btn-info btn-round">
                                                            <i class='fas fa-download' style='color:white !important;'></i>SPBB 2a
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
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
                                                            {{-- <td class="text-center" style="width: 5%;"><input type="checkbox" name="selected_items[]" value="{{ $item->id }}" /></td>  --}}
                                                            {{-- <td style="width: 15%"><a href="#" class="open-modal-link-permohonan" data-bs-toggle="modal" data-bs-target="#baucerPermohonan{{$item['id']}}" data-no-rujukan="{{$item['no_rujukan_permohonan']}}">{{$item['no_rujukan_permohonan']}}</a></td>--}}                                   
                                                            <td style="width: 15%">{{$item['no_rujukan_permohonan']}}</td>                                          
                                                            <td style="width: 40%">{{$pemohon}}</td>
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

                                                        {{-- Modal Baucer --}}
                                                        {{-- <div class="modal fade" id="baucerPermohonan{{$item['id']}}" tabindex="-1" aria-labelledby="baucerPermohonan" aria-hidden="true">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h1 class="modal-title fs-5" id="baucerPermohonan">Kemaskini Maklumat Pembayaran</h1>
                                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                    </div>

                                                                    <div class="modal-body">
                                                                        <!-- Form for single submission -->
                                                                        <form action="{{ route('permohonan.modal.submit', ['permohonan_id' => $item['id']]) }}" method="POST" class="modal-form">
                                                                            {{ csrf_field() }}
                                                                            <div class="mb-3">
                                                                                <label for="message-text" class="col-form-label">Yuran Dibayar (RM) :</label>
                                                                                <input type="number" step="0.01" class="form-control" id="yuranDibayar" name="yuranDibayar">
                                                                            </div>

                                                                            <div class="mb-3">
                                                                                <label for="message-text" class="col-form-label">Wang Saku Dibayar (RM) :</label>
                                                                                <input type="number" step="0.01" class="form-control" id="wangSakuDibayar" name="wangSakuDibayar">
                                                                            </div>

                                                                            <div class="mb-3">
                                                                                <label for="recipient-name" class="col-form-label">No Baucer :</label>
                                                                                <input type="text" class="form-control" id="noBaucer" name="noBaucer">
                                                                            </div>
                                                                            
                                                                            <div class="mb-3">
                                                                                <label for="message-text" class="col-form-label">Perihal :</label>
                                                                                <textarea class="form-control" id="perihal" name="perihal"></textarea>
                                                                            </div>

                                                                            <div class="mb-3">
                                                                                <label for="message-text" class="col-form-label">Tarikh Baucer :</label>
                                                                                <input type="date" class="form-control" id="tarikhBaucer" name="tarikhBaucer">
                                                                            </div>

                                                                            <input type="hidden" id="clickedNoRujukan1">

                                                                            <div class="modal-footer">
                                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                                                <button type="submit" class="btn btn-primary btn-round float-end">Hantar</button>
                                                                            </div>
                                                                        </form>
                                                                    </div>
                                                                </div> 
                                                            </div>
                                                        </div> --}}
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

                                                        {{-- Modal Baucer --}}
                                                        {{-- <div class="modal fade" id="baucerTuntutan{{$item['id']}}" tabindex="-1" aria-labelledby="baucerTuntutan" aria-hidden="true">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h1 class="modal-title fs-5" id="baucerTuntutan">Kemaskini Maklumat Pembayaran</h1>
                                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                    </div>

                                                                    <div class="modal-body">
                                                                        <!-- Form for single submission -->
                                                                        <form action="{{ route('tuntutan.modal.submit', ['tuntutan_id' => $item['id']]) }}" method="POST" class="modal-form">
                                                                            {{ csrf_field() }}
                                                                            <div class="mb-3">
                                                                                <label for="message-text" class="col-form-label">Yuran Dibayar (RM) :</label>
                                                                                <input type="number" step="0.01" class="form-control" id="yuranDibayar" name="yuranDibayar">
                                                                            </div>

                                                                            <div class="mb-3">
                                                                                <label for="message-text" class="col-form-label">Wang Saku Dibayar (RM) :</label>
                                                                                <input type="number" step="0.01" class="form-control" id="wangSakuDibayar" name="wangSakuDibayar">
                                                                            </div>

                                                                            <div class="mb-3">
                                                                                <label for="recipient-name" class="col-form-label">No Baucer :</label>
                                                                                <input type="text" class="form-control" id="noBaucer" name="noBaucer">
                                                                            </div>
                                                                            
                                                                            <div class="mb-3">
                                                                                <label for="message-text" class="col-form-label">Perihal :</label>
                                                                                <textarea class="form-control" id="perihal" name="perihal"></textarea>
                                                                            </div>

                                                                            <div class="mb-3">
                                                                                <label for="message-text" class="col-form-label">Tarikh Baucer :</label>
                                                                                <input type="date" class="form-control" id="tarikhBaucer" name="tarikhBaucer">
                                                                            </div>

                                                                            <input type="hidden" id="clickedNoRujukan2">

                                                                            <div class="modal-footer">
                                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                                                <button type="submit" class="btn btn-primary btn-round float-end">Hantar</button>
                                                                            </div>
                                                                        </form>
                                                                    </div>
                                                                </div> 
                                                            </div>
                                                        </div> --}}
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
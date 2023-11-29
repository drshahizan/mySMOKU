<x-default-layout>
    <head>
        <title>Sekretariat BKOKU KPT</title>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">

        <!-- MAIN CSS -->
        <link rel="stylesheet" href="/assets/css/sekretariat.css">
        <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css"/>
        
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
            <li class="breadcrumb-item text-dark" style="color:darkblue">Kemaskini Baucer</li>
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
                            {{-- top nav bar --}}
                            <ul class="nav nav-tabs" id="myTab" role="tablist" style="margin-top:20px;">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active" id="permohonan-tab" data-toggle="tab" data-target="#permohonan" type="button" role="tab" aria-controls="permohonan" aria-selected="true">Permohonan</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="tuntutan-tab" data-toggle="tab" data-target="#tuntutan" type="button" role="tab" aria-controls="tuntutan" aria-selected="true">Tuntutan</button>
                                </li>
                            </ul>

                            <div class="tab-content" id="myTabContent">
                                {{-- Permohonan --}}
                                <div class="tab-pane fade show active" id="permohonan" role="tabpanel" aria-labelledby="permohonan-tab">
                                    <div class="header">
                                        <h2>Senarai Permohonan yang Layak<br><small>Klik ID Permohonan atau muat turun excel fail senarai layak untuk kemaskini baucer pemohon.</small></h2>
                                    </div>
                                    <div class="row" style="margin-left: 15px;">
                                        <form action="{{ url('penyelaras/penyaluran/permohonan/layak') }}" method="GET" class="col-md-5">
                                            <div class="row">
                                                <div class="col-md-5">
                                                    <label for="start_date"><b>Dari:</b></label>
                                                    <input type="date" name="start_date" id="start_date" value="{{ Request::get('start_date') }}" class="form-control" />
                                                </div>
                                    
                                                <div class="col-md-5">
                                                    <label for="end_date"><b>Hingga:</b></label>
                                                    <input type="date" name="end_date" id="end_date" value="{{ Request::get('end_date') }}" class="form-control" />
                                                </div>
                                    
                                                <div class="col-md-2">
                                                    <br>
                                                    <button type="submit" class="btn btn-primary">
                                                        <i class="fa fa-filter" style="font-size: 12px;"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </form>

                                        <div class="col-md-7" style="padding-left: 280px;">
                                            <br>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <a href="{{ route('penyelaras.senarai.layak.excel') }}" target="_blank" class="btn btn-secondary btn-round">
                                                        <i class="fa fa-file-excel" style="color: black; padding-right:5px;"></i>Muat Turun
                                                    </a>
                                                </div>
                                        
                                                <div class="col-md-6">
                                                    <form id="uploadForm" action="{{ route('modified.file.pembayaran') }}" method="POST" enctype="multipart/form-data">
                                                        @csrf
                                                        <input type="file" name="modified_excel_file" accept=".xlsx, .xls" style="display: none" onchange="fileSelected(event)">
                                                        <input type="hidden" name="form_submitted" id="formSubmitted" value="0">
                                                        <button type="button" class="btn btn-secondary btn-round" onclick="uploadFile()"> 
                                                            <i class="fa fa-upload" style="color: black; padding-right:5px;"></i>Muat Naik
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="body">
                                        {{-- <form action="{{ route('penyelaras.bulk.submit') }}" method="POST" id="modalForm">
                                            {{csrf_field()}} --}}
                                            <table id="sortTable1" class="table table-bordered table-striped" style="margin-top: 0 !important;">
                                                <thead>
                                                    <tr>
                                                        {{-- <th class="text-center" style="width: 5%;"><input type="checkbox" name="select-all" id="select-all" onclick="toggle(this);" /></th> --}}
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
                                                        require_once app_path('helpers.php'); // Replace with the actual path to your helper file
                                                    @endphp
                                                
                                                    @foreach ($layak as $item)
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
                                                                <td style="width: 15%"><a href="#" class="open-modal-link" data-bs-toggle="modal" data-bs-target="#baucerPermohonan" data-no-rujukan="{{$item['no_rujukan_permohonan']}}">{{$item['no_rujukan_permohonan']}}</a></td>                                          
                                                                <td style="width: 40%">{{$pemohon}}</td>
                                                                <td class="text-center" style="width: 10%">RM {{$item->yuran_disokong}}</td>
                                                                <td class="text-center" style="width: 15%">RM {{$item->wang_saku_disokong}}</td>                                       
                                                                <td class="text-center" style="width: 15%">{{date('d/m/Y', strtotime($item->created_at))}}</td>
                                                            </tr>

                                                            {{-- Modal Baucer --}}
                                                            <div class="modal fade" id="baucerPermohonan" tabindex="-1" aria-labelledby="baucerPermohonan" aria-hidden="true">
                                                                <div class="modal-dialog">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h1 class="modal-title fs-5" id="baucerPermohonan">Kemaskini Maklumat Pembayaran</h1>
                                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                        </div>

                                                                        <div class="modal-body">
                                                                            <!-- Form for single submission -->
                                                                            <form action="{{ route('penyelaras.modal.submit', ['permohonan_id' => $item['id']]) }}" method="POST" class="modal-form">
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

                                                                                <input type="hidden" id="clickedNoRujukan">

                                                                                <div class="modal-footer">
                                                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                                                    <button type="submit" class="btn btn-primary btn-round float-end">Hantar</button>
                                                                                </div>
                                                                            </form>
                                                                        </div>
                                                                    </div> 
                                                                </div>
                                                            </div>
                                                        @endif
                                                    @endforeach 
                                                </tbody>
                                            </table>

                                            <!-- Button trigger modal --> 
                                            {{-- <button type="button" class="btn btn-primary btn-round float-end mb-10" data-bs-toggle="modal" data-bs-target="#cekKPT">
                                                Kemaskini
                                            </button> --}}

                                            {{-- Modal Cek --}}
                                            {{-- <div class="modal fade" id="cekKPT" tabindex="-1" aria-labelledby="cekKPT" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h1 class="modal-title fs-5" id="pengesahanModalLabelBKOKU2">Kemaskini Maklumat Penyaluran</h1>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>

                                                        <div class="modal-body">
                                                            <div class="mb-3">
                                                                <label for="recipient-name" class="col-form-label">No Cek:</label>
                                                                <input type="text" class="form-control" id="noCek" name="noCek">
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="message-text" class="col-form-label">Tarikh Transaksi:</label>
                                                                <input type="date" class="form-control" id="tarikhTransaksi" name="tarikhTransaksi">
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                                <button type="submit" class="btn btn-primary btn-round float-end">Hantar</button>
                                                            </div>
                                                        </div>
                                                    </div> 
                                                </div>
                                            </div>  --}}
                                            {{-- <br><br>                                       
                                        </form> --}}
                                    </div>
                                </div>
                                {{-- End of Permohonan --}}

                                {{-- Tuntutan --}}
                                <div class="tab-pane fade show active" id="tuntutan" role="tabpanel" aria-labelledby="tuntutan-tab">
                                    <div class="header">
                                        <h2>Senarai Tuntutan yang Layak<br><small>Klik ID Tuntutan atau muat turun excel fail senarai layak untuk kemaskini baucer pemohon.</small></h2>
                                    </div>
                                    <div class="row" style="margin-left: 15px;">
                                        <form action="{{ url('penyelaras/penyaluran/permohonan/layak') }}" method="GET" class="col-md-5">
                                            <div class="row">
                                                <div class="col-md-5">
                                                    <label for="start_date"><b>Dari:</b></label>
                                                    <input type="date" name="start_date" id="start_date" value="{{ Request::get('start_date') }}" class="form-control" />
                                                </div>
                                    
                                                <div class="col-md-5">
                                                    <label for="end_date"><b>Hingga:</b></label>
                                                    <input type="date" name="end_date" id="end_date" value="{{ Request::get('end_date') }}" class="form-control" />
                                                </div>
                                    
                                                <div class="col-md-2">
                                                    <br>
                                                    <button type="submit" class="btn btn-primary">
                                                        <i class="fa fa-filter" style="font-size: 12px;"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </form>

                                        <div class="col-md-7" style="padding-left: 280px;">
                                            <br>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <a href="{{ route('penyelaras.senarai.layak.excel') }}" target="_blank" class="btn btn-secondary btn-round">
                                                        <i class="fa fa-file-excel" style="color: black; padding-right:5px;"></i>Muat Turun
                                                    </a>
                                                </div>
                                        
                                                <div class="col-md-6">
                                                    <form id="uploadForm" action="{{ route('modified.file.pembayaran') }}" method="POST" enctype="multipart/form-data">
                                                        @csrf
                                                        <input type="file" name="modified_excel_file" accept=".xlsx, .xls" style="display: none" onchange="fileSelected(event)">
                                                        <input type="hidden" name="form_submitted" id="formSubmitted" value="0">
                                                        <button type="button" class="btn btn-secondary btn-round" onclick="uploadFile()"> 
                                                            <i class="fa fa-upload" style="color: black; padding-right:5px;"></i>Muat Naik
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="body">
                                        {{-- <form action="{{ route('penyelaras.bulk.submit') }}" method="POST" id="modalForm">
                                            {{csrf_field()}} --}}
                                            <table id="sortTable2" class="table table-bordered table-striped" style="margin-top: 0 !important;">
                                                <thead>
                                                    <tr>
                                                        {{-- <th class="text-center" style="width: 5%;"><input type="checkbox" name="select-all" id="select-all" onclick="toggle(this);" /></th> --}}
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
                                                        require_once app_path('helpers.php'); // Replace with the actual path to your helper file
                                                    @endphp
                                                
                                                    @foreach ($layak as $item)
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
                                                                <td style="width: 15%"><a href="#" class="open-modal-link" data-bs-toggle="modal" data-bs-target="#baucerPenyelaras" data-no-rujukan="{{$item['no_rujukan_permohonan']}}">{{$item['no_rujukan_permohonan']}}</a></td>                                          
                                                                <td style="width: 40%">{{$pemohon}}</td>
                                                                <td class="text-center" style="width: 10%">RM {{$item->yuran_disokong}}</td>
                                                                <td class="text-center" style="width: 15%">RM {{$item->wang_saku_disokong}}</td>                                       
                                                                <td class="text-center" style="width: 15%">{{date('d/m/Y', strtotime($item->created_at))}}</td>
                                                            </tr>

                                                            {{-- Modal Baucer --}}
                                                            <div class="modal fade" id="baucerTuntutan" tabindex="-1" aria-labelledby="baucerTuntutan" aria-hidden="true">
                                                                <div class="modal-dialog">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h1 class="modal-title fs-5" id="baucerTuntutan">Kemaskini Maklumat Pembayaran</h1>
                                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                        </div>

                                                                        <div class="modal-body">
                                                                            <!-- Form for single submission -->
                                                                            <form action="{{ route('penyelaras.modal.submit', ['permohonan_id' => $item['id']]) }}" method="POST" class="modal-form">
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

                                                                                <input type="hidden" id="clickedNoRujukan">

                                                                                <div class="modal-footer">
                                                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                                                    <button type="submit" class="btn btn-primary btn-round float-end">Hantar</button>
                                                                                </div>
                                                                            </form>
                                                                        </div>
                                                                    </div> 
                                                                </div>
                                                            </div>
                                                        @endif
                                                    @endforeach 
                                                </tbody>
                                            </table>

                                            <!-- Button trigger modal --> 
                                            {{-- <button type="button" class="btn btn-primary btn-round float-end mb-10" data-bs-toggle="modal" data-bs-target="#cekKPT">
                                                Kemaskini
                                            </button> --}}

                                            {{-- Modal Cek --}}
                                            {{-- <div class="modal fade" id="cekKPT" tabindex="-1" aria-labelledby="cekKPT" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h1 class="modal-title fs-5" id="pengesahanModalLabelBKOKU2">Kemaskini Maklumat Penyaluran</h1>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>

                                                        <div class="modal-body">
                                                            <div class="mb-3">
                                                                <label for="recipient-name" class="col-form-label">No Cek:</label>
                                                                <input type="text" class="form-control" id="noCek" name="noCek">
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="message-text" class="col-form-label">Tarikh Transaksi:</label>
                                                                <input type="date" class="form-control" id="tarikhTransaksi" name="tarikhTransaksi">
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                                <button type="submit" class="btn btn-primary btn-round float-end">Hantar</button>
                                                            </div>
                                                        </div>
                                                    </div> 
                                                </div>
                                            </div>  --}}
                                            {{-- <br><br>                                       
                                        </form> --}}
                                    </div>
                                </div>
                                {{-- End of Tuntutan --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

        <script>
            //sorting function
            $('#sortTable1').DataTable();
            $('#sortTable2').DataTable();
            
            function uploadFile() {
                // Trigger the click event of the hidden file input
                document.querySelector('input[name="modified_excel_file"]').click();
            }
        
            function fileSelected(event) {
                // Set the hidden input value to 1 when a file is selected
                document.getElementById('formSubmitted').value = 1;
                // Submit the form
                document.getElementById('uploadForm').submit();
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
           
            // check all checkboxes at once
            function toggle(source) {
                var checkboxes = document.querySelectorAll('input[name="selected_items[]"]');
                for (var i = 0; i < checkboxes.length; i++) {
                    checkboxes[i].checked = source.checked;
                }
            }

            // Add a click event listener to the links with the "open-modal-link" class
            document.querySelectorAll('.open-modal-link').forEach(function(link) {
                link.addEventListener('click', function() {
                    // Get the value of the data-no-rujukan attribute
                    var noRujukan = link.getAttribute('data-no-rujukan');

                    // Set the value to the hidden input in the modal
                    document.getElementById('clickedNoRujukan').value = noRujukan;

                    // Set the permohonan id value in the form action URL
                    var permohonanId = link.getAttribute('data-permohonan-id');
                    var form = document.getElementById('modalForm');
                    form.action = form.action.replace(/\/\d+$/, '/' + permohonanId);
                });
            });
        </script>
    </body>
</x-default-layout> 
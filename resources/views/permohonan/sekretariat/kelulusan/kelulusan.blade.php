<x-default-layout>
    <head>
        <title>Sekretariat BKOKU KPT</title>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">

        <!-- MAIN CSS -->
        <link rel="stylesheet" href="/assets/css/sekretariat.css">
        <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css"/>
        <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/default.min.css"/>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9">

         <!-- Bootstrap --> 
         <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>

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
            <li class="breadcrumb-item text-dark" style="color:darkblue">Permohonan</li>
            <!--end::Item-->
            <!--begin::Item-->
            <li class="breadcrumb-item">
                <span class="bullet bg-gray-400 w-5px h-2px"></span>
            </li>
            <!--end::Item-->
            <!--begin::Item-->
            <li class="breadcrumb-item text-dark" style="color:darkblue">Kelulusan</li>
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
                                <h2>Senarai Permohonan untuk Kelulusan JKKBKOKU<br><small>Klik ID Permohonan untuk meluluskan permohonan pelajar tersebut.</small></h2>
                            </div>

                            {{-- top nav bar --}}
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
                                                <a id="exportLink" href="{{ route('senarai.disokong.pdf', ['programCode' => 'BKOKU'] + $filters) }}" target="_blank" class="btn btn-secondary btn-round">
                                                    <i class="fa fa-file-pdf" style="color: black;"></i> PDF
                                                </a>
                                                <a id="exportLink" href="{{ route('senarai.disokong.excel', ['programCode' => 'BKOKU'] + $filters) }}" target="_blank" class="btn btn-secondary btn-round">
                                                    <i class="fa fa-file-excel" style="color: black;"></i> Excel
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

                            <div class="tab-content" id="myTabContent">
                                {{-- BKOKU IPTS, KK, P --}}
                                <div class="tab-pane fade show active" id="bkoku" role="tabpanel" aria-labelledby="bkoku-tab">
                                    <br>
                                    {{-- <form action="{{ url('permohonan/sekretariat/kelulusan') }}" method="GET">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <select name="institusi" class="form-select js-example-basic-single">
                                                    <option value="">Pilih Institusi Pengajian</option>
                                                    @foreach ($institusiBKOKU as $institusi)
                                                        <option value="{{ $institusi->id_institusi }}" {{ Request::get('institusi') == $institusi->id_institusi ? 'selected' : '' }}>{{ $institusi->nama_institusi }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                    
                                            <div class="col-md-3" style="margin-left: 10px; margin-right:150px;">
                                                <button type="submit" class="btn btn-primary" style="width: 15%; padding-left: 10px;">
                                                    <i class="fa fa-filter" style="font-size: 15px;"></i>
                                                </button>
                                            </div>

                                            <div class="col-md-3" style="padding-left: 50px;">  
                                                <a href="{{ route('senarai.disokong.pdf', ['programCode' => 'BKOKU'] + $filters) }}" target="_blank" class="btn btn-secondary btn-round">
                                                    <i class="fa fa-file-pdf" style="color: black;"></i> PDF
                                                </a>
                                                <a href="{{ route('senarai.disokong.excel', ['programCode' => 'BKOKU'] + $filters) }}" target="_blank" class="btn btn-secondary btn-round">
                                                    <i class="fa fa-file-excel" style="color: black;"></i> Excel
                                                </a>                                               
                                            </div>
                                        </div>
                                    </form>   --}}

                                    <div class="body">
                                        <form action="{{ route('bulk.approval') }}" method="POST">
                                            {{csrf_field()}}
                                            <table id="sortTable2" class="table table-bordered table-striped" style="margin-top: 0 !important;">
                                                <thead>
                                                    <tr>
                                                        <th class="text-center" style="width: 3%;"><input type="checkbox" name="select-all" id="select-all" onclick="toggle(this);" /></th>
                                                        <th class="text-center" style="width: 10%"><b>ID Permohonan</b></th>                                                   
                                                        <th class="text-center" style="width: 20%"><b>Nama</b></th>
                                                        <th class="text-center" style="width: 10%"><b>Jenis Kecacatan</b></th>
                                                        <th class="text-center" style="width: 17%"><b>Nama Kursus</b></th>
                                                        <th class="text-center" style="width: 20%"><b>Institusi Pengajian</b></th>
                                                        <th class="text-center" style="width: 10%"><b>Tarikh Mula Pengajian</b></th>
                                                        <th class="text-center" style="width: 10%"><b>Tarikh Tamat Pengajian</b></th>
                                                    </tr>
                                                </thead>

                                                <tbody>
                                                    @php
                                                        $i=0;
                                                    @endphp
                                                    @php
                                                        require_once app_path('helpers.php'); // Replace with the actual path to your helper file
                                                    @endphp
                                                
                                                    @foreach ($kelulusan as $item)
                                                        @if ($item['program']=="BKOKU")
                                                            @php
                                                                $i++;
                                                                $nama_pemohon = DB::table('smoku')->where('id', $item['smoku_id'])->value('nama');
                                                                $nama_kursus = DB::table('smoku_akademik')->where('smoku_id', $item['smoku_id'])->value('nama_kursus');
                                                                $no_kp = DB::table('smoku')->where('id', $item['smoku_id'])->value('no_kp');
                                                                $jenis_kecacatan = DB::table('smoku')->join('bk_jenis_oku', 'bk_jenis_oku.kod_oku', '=', 'smoku.kategori')->where('smoku.id', $item['smoku_id'])->value('bk_jenis_oku.kecacatan');
                                                                $institusi_pengajian = DB::table('smoku_akademik')->join('bk_info_institusi','bk_info_institusi.id_institusi','=','smoku_akademik.id_institusi' )->where('smoku_id', $item['smoku_id'])->value('bk_info_institusi.nama_institusi');
                                                                $jenis_institusi = DB::table('smoku_akademik')->join('bk_info_institusi','bk_info_institusi.id_institusi','=','smoku_akademik.id_institusi' )->where('smoku_id', $item['smoku_id'])->value('bk_info_institusi.jenis_institusi');
                                                                $tarikh_mula = DB::table('smoku_akademik')->where('smoku_id', $item['smoku_id'])->value('tarikh_mula');
                                                                $tarikh_tamat = DB::table('smoku_akademik')->where('smoku_id', $item['smoku_id'])->value('tarikh_tamat');
                                                                
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

                                                                //nama kursus
                                                                $text2 = ucwords(strtolower($nama_kursus)); 
                                                                $conjunctions = ['of', 'in', 'and'];
                                                                $words = explode(' ', $text2);
                                                                $result = [];
                                                                foreach ($words as $word) {
                                                                    if (in_array(Str::lower($word), $conjunctions)) {
                                                                        $result[] = Str::lower($word);
                                                                    } else {
                                                                        $result[] = $word;
                                                                    }
                                                                }
                                                                $kursus = implode(' ', $result);
                                                                $namakursus = transformBracketsToCapital($kursus);

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
                                                            
                                                            @if ($jenis_institusi != "UA")
                                                                <tr>
                                                                    <td class="text-center" style="width: 3%;"><input type="checkbox" name="selected_items[]" value="{{ $item->id }}" /></td>                                           
                                                                    <td style="width: 10%"><a href="{{ url('permohonan/sekretariat/kelulusan/'. $item['id']) }}" target="_blank">{{$item['no_rujukan_permohonan']}}</a></td>
                                                                    <td style="width: 20%">{{$pemohon}}</td>
                                                                    <td style="width: 10%">{{ucwords(strtolower($jenis_kecacatan))}}</td>                                       
                                                                    <td style="width: 17%">{{$namakursus}}</td>
                                                                    <td style="width: 20%">{{$institusipengajian}}</td>
                                                                    <td class="text-center" style="width: 10%">{{date('d/m/Y', strtotime($tarikh_mula))}}</td>
                                                                    <td class="text-center" style="width: 10%">{{date('d/m/Y', strtotime($tarikh_tamat))}}</td>
                                                                </tr>
                                                            @endif  
                                                        @endif
                                                    @endforeach 
                                                </tbody>
                                            </table>

                                            <!-- Button trigger modal -->
                                            <button type="button" class="btn btn-primary btn-round float-end mb-10" data-bs-toggle="modal" data-bs-target="#pengesahanModalBKOKU1">
                                                Sahkan
                                            </button>
                                        
                                            {{-- Modal --}}
                                            <div class="modal fade" id="pengesahanModalBKOKU1" tabindex="-1" aria-labelledby="pengesahanModalLabelBKOKU1" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h1 class="modal-title fs-5" id="pengesahanModalLabelBKOKU1">Rekod Keputusan Permohonan</h1>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>

                                                        <div class="modal-body">
                                                            <div class="mb-3">
                                                                <label for="recipient-name" class="col-form-label">No. Mesyuarat:</label>
                                                                <input type="text" class="form-control" id="noMesyuarat" name="noMesyuarat">
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="message-text" class="col-form-label">Tarikh Mesyuarat:</label>
                                                                <input type="date" class="form-control" id="tarikhMesyuarat" name="tarikhMesyuarat">
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="message-text" class="col-form-label">Keputusan Permohonan:</label>
                                                                <select onchange="select1()" class="form-control" id="keputusan" name="keputusan">
                                                                    <option value="">Pilih Keputusan</option>
                                                                    <option value="Lulus" {{Request::get('status') == 'Lulus' ? 'selected':'' }} >Lulus</option>
                                                                    <option value="Tidak Lulus" {{Request::get('status') == 'Tidak Lulus' ? 'selected':'' }} >Tidak Lulus</option>
                                                                </select>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="message-text" class="col-form-label">Catatan:</label>
                                                                <textarea class="form-control" id="catatan" name="catatan"></textarea>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                                <button type="submit" class="btn btn-primary btn-round float-end">Hantar</button>
                                                            </div>
                                                        </div>
                                                    </div> 
                                                </div>
                                            </div> 
                                            <br><br>                                       
                                        </form>
                                    </div>
                                </div>

                                {{-- BKOKU UA --}}
                                <div class="tab-pane fade" id="bkokuUA" role="tabpanel" aria-labelledby="bkokuUA-tab">
                                    <br>
                                    {{-- <form action="{{ url('permohonan/sekretariat/kelulusan') }}" method="GET">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <select name="institusi" class="form-select js-example-basic-single">
                                                    <option value="">Pilih Institusi Pengajian</option>
                                                    @foreach ($institusiUA as $institusi)
                                                        <option value="{{ $institusi->id_institusi }}" {{ Request::get('institusi') == $institusi->id_institusi ? 'selected' : '' }}>{{ $institusi->nama_institusi }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                
                                            <div class="col-md-3" style="margin-left: 10px; margin-right:150px;">
                                                <button type="submit" class="btn btn-primary" style="width: 15%; padding-left: 10px;">
                                                    <i class="fa fa-filter" style="font-size: 15px;"></i>
                                                </button>
                                            </div>

                                            <div class="col-md-3" style="padding-left: 50px;">  
                                                <a href="{{ route('senarai.disokong.pdf', ['programCode' => 'UA'] + $filters) }}" target="_blank" class="btn btn-secondary btn-round">
                                                    <i class="fa fa-file-pdf" style="color: black;"></i> PDF
                                                </a>
                                                <a href="{{ route('senarai.disokong.excel', ['programCode' => 'UA'] + $filters) }}" target="_blank" class="btn btn-secondary btn-round">
                                                    <i class="fa fa-file-excel" style="color: black;"></i> Excel
                                                </a> 
                                            </div>
                                        </div>
                                    </form>   --}}

                                    <div class="body">
                                        <form action="{{ route('bulk.approval') }}" method="POST">
                                            {{csrf_field()}}
                                            <table id="sortTable1" class="table table-bordered table-striped" style="margin-top: 0 !important;">
                                                <thead>
                                                    <tr>
                                                        <th class="text-center" style="width: 3%;"><input type="checkbox" name="select-all" id="select-all" onclick="toggle(this);" /></th>
                                                        <th class="text-center" style="width: 10%"><b>ID Permohonan</b></th>                                                   
                                                        <th class="text-center" style="width: 20%"><b>Nama</b></th>
                                                        <th class="text-center" style="width: 10%"><b>Jenis Kecacatan</b></th>
                                                        <th class="text-center" style="width: 17%"><b>Nama Kursus</b></th>
                                                        <th class="text-center" style="width: 20%"><b>Institusi Pengajian</b></th>
                                                        <th class="text-center" style="width: 10%"><b>Tarikh Mula Pengajian</b></th>
                                                        <th class="text-center" style="width: 10%"><b>Tarikh Tamat Pengajian</b></th>
                                                    </tr>
                                                </thead>

                                                <tbody>
                                                    @php
                                                        $i=0;
                                                    @endphp
                                                    @php
                                                        require_once app_path('helpers.php'); // Replace with the actual path to your helper file
                                                    @endphp
                                                
                                                    @foreach ($kelulusan as $item)
                                                        @if ($item['program']=="BKOKU")
                                                            @php
                                                                $i++;
                                                                $nama_pemohon = DB::table('smoku')->where('id', $item['smoku_id'])->value('nama');
                                                                $nama_kursus = DB::table('smoku_akademik')->where('smoku_id', $item['smoku_id'])->value('nama_kursus');
                                                                $no_kp = DB::table('smoku')->where('id', $item['smoku_id'])->value('no_kp');
                                                                $jenis_kecacatan = DB::table('smoku')->join('bk_jenis_oku', 'bk_jenis_oku.kod_oku', '=', 'smoku.kategori')->where('smoku.id', $item['smoku_id'])->value('bk_jenis_oku.kecacatan');
                                                                $institusi_pengajian = DB::table('smoku_akademik')->join('bk_info_institusi','bk_info_institusi.id_institusi','=','smoku_akademik.id_institusi' )->where('smoku_id', $item['smoku_id'])->value('bk_info_institusi.nama_institusi');
                                                                $jenis_institusi = DB::table('smoku_akademik')->join('bk_info_institusi','bk_info_institusi.id_institusi','=','smoku_akademik.id_institusi' )->where('smoku_id', $item['smoku_id'])->value('bk_info_institusi.jenis_institusi');
                                                                $tarikh_mula = DB::table('smoku_akademik')->where('smoku_id', $item['smoku_id'])->value('tarikh_mula');
                                                                $tarikh_tamat = DB::table('smoku_akademik')->where('smoku_id', $item['smoku_id'])->value('tarikh_tamat');
                                                                
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

                                                                //nama kursus
                                                                $text2 = ucwords(strtolower($nama_kursus)); 
                                                                $conjunctions = ['of', 'in', 'and'];
                                                                $words = explode(' ', $text2);
                                                                $result = [];
                                                                foreach ($words as $word) {
                                                                    if (in_array(Str::lower($word), $conjunctions)) {
                                                                        $result[] = Str::lower($word);
                                                                    } else {
                                                                        $result[] = $word;
                                                                    }
                                                                }
                                                                $kursus = implode(' ', $result);
                                                                $namakursus = transformBracketsToCapital($kursus);

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
                                                            
                                                            @if ($jenis_institusi == "UA")
                                                                <tr>
                                                                    <td class="text-center" style="width: 3%;"><input type="checkbox" name="selected_items[]" value="{{ $item->id }}" /></td>                                           
                                                                    <td style="width: 10%"><a href="{{ url('permohonan/sekretariat/kelulusan/'. $item['id']) }}" target="_blank">{{$item['no_rujukan_permohonan']}}</a></td>
                                                                    <td style="width: 20%">{{$pemohon}}</td>
                                                                    <td style="width: 10%">{{ucwords(strtolower($jenis_kecacatan))}}</td>                                       
                                                                    <td style="width: 17%">{{$namakursus}}</td>
                                                                    <td style="width: 20%">{{$institusipengajian}}</td>
                                                                    <td class="text-center" style="width: 10%">{{date('d/m/Y', strtotime($tarikh_mula))}}</td>
                                                                    <td class="text-center" style="width: 10%">{{date('d/m/Y', strtotime($tarikh_tamat))}}</td>
                                                                </tr>
                                                            @endif
                                                        @endif
                                                    @endforeach 
                                                </tbody>
                                            </table>

                                            <!-- Button trigger modal -->
                                            <button type="button" class="btn btn-primary btn-round float-end mb-10" data-bs-toggle="modal" data-bs-target="#pengesahanModalBKOKU2">
                                                Sahkan
                                            </button>
                                        
                                            {{-- Modal --}}
                                            <div class="modal fade" id="pengesahanModalBKOKU2" tabindex="-1" aria-labelledby="pengesahanModalLabelBKOKU2" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h1 class="modal-title fs-5" id="pengesahanModalLabelBKOKU2">Rekod Keputusan Permohonan</h1>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>

                                                        <div class="modal-body">
                                                            <div class="mb-3">
                                                                <label for="recipient-name" class="col-form-label">No. Mesyuarat:</label>
                                                                <input type="text" class="form-control" id="noMesyuarat" name="noMesyuarat">
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="message-text" class="col-form-label">Tarikh Mesyuarat:</label>
                                                                <input type="date" class="form-control" id="tarikhMesyuarat" name="tarikhMesyuarat">
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="message-text" class="col-form-label">Keputusan Permohonan:</label>
                                                                <select onchange="select1()" class="form-control" id="keputusan" name="keputusan">
                                                                    <option value="">Pilih Keputusan</option>
                                                                    <option value="Lulus" {{Request::get('status') == 'Lulus' ? 'selected':'' }} >Lulus</option>
                                                                    <option value="Tidak Lulus" {{Request::get('status') == 'Tidak Lulus' ? 'selected':'' }} >Tidak Lulus</option>
                                                                </select>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="message-text" class="col-form-label">Catatan:</label>
                                                                <textarea class="form-control" id="catatan" name="catatan"></textarea>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                                <button type="submit" class="btn btn-primary btn-round float-end">Hantar</button>
                                                            </div>
                                                        </div>
                                                    </div> 
                                                </div>
                                            </div> 
                                            <br><br>                                       
                                        </form>
                                    </div>
                                </div>

                                {{-- PPK --}}
                                <div class="tab-pane fade " id="ppk" role="tabpanel" aria-labelledby="ppk-tab">
                                    <br>
                                    {{-- <form action="{{ url('permohonan/sekretariat/kelulusan') }}" method="GET">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <select name="institusi" class="form-select js-example-basic-single">
                                                    <option value="">Pilih Institusi Pengajian</option>
                                                    @foreach ($institusiPPK as $institusi)
                                                        <option value="{{ $institusi->id_institusi }}" {{ Request::get('institusi') == $institusi->id_institusi ? 'selected' : '' }}>{{ $institusi->nama_institusi }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                    
                                            <div class="col-md-3" style="margin-left: 10px; margin-right:150px;">
                                                <button type="submit" class="btn btn-primary" style="width: 15%; padding-left: 10px;">
                                                    <i class="fa fa-filter" style="font-size: 15px;"></i>
                                                </button>
                                            </div>

                                            <div class="col-md-3" style="padding-left: 50px;">
                                                <a href="{{ route('senarai.disokong.pdf', ['programCode' => 'PPK'] + $filters) }}" target="_blank" class="btn btn-secondary btn-round">
                                                    <i class="fa fa-file-pdf" style="color: black;"></i> PDF
                                                </a>
                                                <a href="{{ route('senarai.disokong.excel', ['programCode' => 'PPK'] + $filters) }}" target="_blank" class="btn btn-secondary btn-round">
                                                    <i class="fa fa-file-excel" style="color: black;"></i> Excel
                                                </a>                         
                                            </div>
                                        </div>
                                    </form>   --}}

                                    <div class="body">
                                        <form action="{{ route('bulk.approval') }}" method="POST">
                                            {{csrf_field()}}
                                            <table id="sortTable3" class="table table-bordered table-striped" style="margin-top: 0 !important;">
                                                <thead>
                                                    <tr>
                                                        <th class="text-center" style="width: 3% !important;"><input type="checkbox" name="select-all" id="select-all" onclick="toggle(this);" /></th>
                                                        <th class="text-center" style="width: 10% !important;"><b>ID Permohonan</b></th>                                                   
                                                        <th class="text-center" style="width: 20% !important;"><b>Nama</b></th>
                                                        <th class="text-center" style="width: 10% !important;"><b>Jenis Kecacatan</b></th>
                                                        <th class="text-center" style="width: 17% !important;"><b>Nama Kursus</b></th>
                                                        <th class="text-center" style="width: 20% !important;"><b>Institusi Pengajian</b></th>
                                                        <th class="text-center" style="width: 10% !important;"><b>Tarikh Mula Pengajian</b></th>
                                                        <th class="text-center" style="width: 10% !important;"><b>Tarikh Tamat Pengajian</b></th>
                                                    </tr>
                                                </thead>

                                                <tbody>
                                                    @php
                                                        $i=0;
                                                    @endphp
                                                    @php
                                                        require_once app_path('helpers.php'); 
                                                    @endphp
                                                
                                                    @foreach ($kelulusan as $item)
                                                        @if ($item['program']=="PPK")
                                                            @php
                                                                $i++;
                                                                $nama_pemohon = DB::table('smoku')->where('id', $item['smoku_id'])->value('nama');
                                                                $nama_kursus = DB::table('smoku_akademik')->where('smoku_id', $item['smoku_id'])->value('nama_kursus');
                                                                $no_kp = DB::table('smoku')->where('id', $item['smoku_id'])->value('no_kp');
                                                                $jenis_kecacatan = DB::table('smoku')->join('bk_jenis_oku', 'bk_jenis_oku.kod_oku', '=', 'smoku.kategori')->where('smoku.id', $item['smoku_id'])->value('bk_jenis_oku.kecacatan');
                                                                $institusi_pengajian = DB::table('smoku_akademik')->join('bk_info_institusi','bk_info_institusi.id_institusi','=','smoku_akademik.id_institusi' )->where('smoku_id', $item['smoku_id'])->value('bk_info_institusi.nama_institusi');
                                                                $tarikh_mula = DB::table('smoku_akademik')->where('smoku_id', $item['smoku_id'])->value('tarikh_mula');
                                                                $tarikh_tamat = DB::table('smoku_akademik')->where('smoku_id', $item['smoku_id'])->value('tarikh_tamat');
                                                                
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

                                                                //nama kursus
                                                                $text2 = ucwords(strtolower($nama_kursus)); 
                                                                $conjunctions = ['of', 'in', 'and'];
                                                                $words = explode(' ', $text2);
                                                                $result = [];
                                                                foreach ($words as $word) {
                                                                    if (in_array(Str::lower($word), $conjunctions)) {
                                                                        $result[] = Str::lower($word);
                                                                    } else {
                                                                        $result[] = $word;
                                                                    }
                                                                }
                                                                $kursus = implode(' ', $result);
                                                                $namakursus = transformBracketsToCapital($kursus);

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
                                                            
                                                            <tr>
                                                                <td class="text-center" style="width:3%;"><input type="checkbox" name="selected_items[]" value="{{ $item->id }}" /></td>                                           
                                                                <td style="width: 10%;"><a href="{{ url('permohonan/sekretariat/kelulusan/'. $item['id']) }}" target="_blank">{{$item['no_rujukan_permohonan']}}</a></td>
                                                                <td style="width: 20%;">{{$pemohon}}</td>
                                                                <td style="width: 10%;">{{ucwords(strtolower($jenis_kecacatan))}}</td>                                       
                                                                <td style="width: 17%;">{{$namakursus}}</td>
                                                                <td style="width: 20%;">{{$institusipengajian}}</td>
                                                                <td class="text-center"  style="width: 10%;">{{date('d/m/Y', strtotime($tarikh_mula))}}</td>
                                                                <td class="text-center"  style="width: 10%;">{{date('d/m/Y', strtotime($tarikh_tamat))}}</td>
                                                            </tr>
                                                        @endif
                                                    @endforeach 
                                                </tbody>
                                            </table>

                                            <!-- Button trigger modal -->
                                            <button type="button" class="btn btn-primary btn-round float-end mb-10" data-bs-toggle="modal" data-bs-target="#pengesahanModalPPK">
                                                Sahkan
                                            </button>
                                        
                                            {{-- Modal --}}
                                            <div class="modal fade" id="pengesahanModalPPK" tabindex="-1" aria-labelledby="pengesahanModalLabelPPK" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h1 class="modal-title fs-5" id="pengesahanModalLabelPPK">Rekod Keputusan Permohonan</h1>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>

                                                        <div class="modal-body">
                                                            <div class="mb-3">
                                                                <label for="recipient-name" class="col-form-label">No. Mesyuarat:</label>
                                                                <input type="text" class="form-control" id="noMesyuarat" name="noMesyuarat">
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="message-text" class="col-form-label">Tarikh Mesyuarat:</label>
                                                                <input type="date" class="form-control" id="tarikhMesyuarat" name="tarikhMesyuarat">
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="message-text" class="col-form-label">Keputusan Permohonan:</label>
                                                                <select onchange="select1()" class="form-control" id="keputusan" name="keputusan">
                                                                    <option value="">Pilih Keputusan</option>
                                                                    <option value="Lulus" {{Request::get('status') == 'Lulus' ? 'selected':'' }} >Lulus</option>
                                                                    <option value="Tidak Lulus" {{Request::get('status') == 'Tidak Lulus' ? 'selected':'' }} >Tidak Lulus</option>
                                                                </select>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="message-text" class="col-form-label">Catatan:</label>
                                                                <textarea class="form-control" id="catatan" name="catatan"></textarea>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                                <button type="submit" class="btn btn-primary btn-round float-end">Hantar</button>
                                                            </div>
                                                        </div>
                                                    </div> 
                                                </div>
                                            </div> 
                                            <br><br>                                       
                                        </form>                                    
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- search in filter --}}
        <style>
            .form-select {
                margin-left: 20px !important; 
            }
        </style>

        {{-- sort table --}}
        <script>
            //sorting function
            $('#sortTable1').DataTable({
                ordering: true, // Enable manual sorting
                order: [] // Disable initial sorting
            });
            $('#sortTable2').DataTable({
                ordering: true, // Enable manual sorting
                order: [] // Disable initial sorting
            });
            $('#sortTable3').DataTable({
                ordering: true, // Enable manual sorting
                order: [] // Disable initial sorting
            });

            // check all checkboxes at once for bulk approval "kelulusan"
            function toggle(source) {
                var checkboxes = document.querySelectorAll('input[name="selected_items[]"]');
                for (var i = 0; i < checkboxes.length; i++) {
                    checkboxes[i].checked = source.checked;
                }
            }

            $(document).ready(function() {
			    $('.js-example-basic-single').select2();
			});
        </script>

        {{-- filter --}}
        <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
            
        <script>
            // Initialize JavaScript variables with data from Blade
            var bkokuList = @json($institusiBKOKU);
            var bkokuUAList = @json($institusiUA);
            var ppkList = @json($institusiPPK);

            $(document).ready(function() {
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
            });
        </script>

        <script>
            // Declare datatables in a higher scope to make them accessible
            var datatable1, datatable, datatable2;

            $(document).ready(function() {
                // Initialize DataTables
                initDataTable('#sortTable1', 'datatable1');
                initDataTable('#kt_subscriptions_table', 'datatable');
                initDataTable('#sortTable2', 'datatable2');

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
                        { orderable: false, targets: [0] }
                    ]
                });
            }

            function applyFilter() {
                var selectedInstitusi = $('[name="institusi"]').val();

                // Apply search filter and log data for all tables
                applyAndLogFilter('Table 1', datatable1, selectedInstitusi);
                applyAndLogFilter('Table 2', datatable, selectedInstitusi);
                applyAndLogFilter('Table 3', datatable2, selectedInstitusi);

                // Update the export link with the selected institusi for Table 2
                var exportLink = document.getElementById('exportLink');
                exportLink.href = "{{ route('senarai.disokong.pdf', ['programCode' => 'BKOKU']) }}?institusi=" + selectedInstitusi;

                var exportLink = document.getElementById('exportLink');
                exportLink.href = "{{ route('senarai.disokong.excel', ['programCode' => 'BKOKU']) }}?institusi=" + selectedInstitusi;
            }

            function applyAndLogFilter(tableName, table, filterValue) {
                // Apply search filter to the table
                table.column(3).search(filterValue).draw();

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
    </body>
</x-default-layout> 
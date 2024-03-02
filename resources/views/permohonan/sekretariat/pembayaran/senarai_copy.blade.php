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
		<link href="/assets/css/style.bundle.css" rel="stylesheet" type="text/css" />
    </head>

    <style>
        .nav{
            margin-left: 20px!important;
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
    <!-- Main body part  -->
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
                            {{-- BKOKU --}}
                            <div class="tab-pane fade show active" id="bkoku" role="tabpanel" aria-labelledby="bkoku-tab">
                                <br><br>
                                <div class="body">
                                    <div class="table-responsive">
                                        <table id="sortTable1" class="table table-striped table-hover dataTable js-exportable">
                                            <thead>
                                            <tr>
                                                <th style="width: 10%"><b>ID Permohonan</b></th>
                                                <th style="width: 20%"><b>Nama</b></th>
                                                <th style="width: 21%"><b>Nama Kursus</b></th>
                                                <th style="width: 25%"><b>Institusi Pengajian</b></th>
                                                <th style="width: 8%" class="text-center"><b>Tarikh Permohonan</b></th>
                                                <th style="width: 8%" class="text-center"><b>Tarikh Dibayar</b></th>
                                                <th style="width: 8%" class="text-center"><b>Status</b></th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @php
                                                $i=0;
                                            @endphp
                                            @foreach ($permohonan as $item)
                                                @if ($item['program']=="BKOKU")
                                                    @php
                                                        $i++;

                                                        $rujukan = explode("/", $item['no_rujukan_permohonan']);
                                                        $peringkat = $rujukan[1];
                                                        $akademik = DB::table('smoku_akademik')->where('smoku_id', $item['smoku_id'])->where('peringkat_pengajian', $peringkat)->first();
                                                        $nama_institusi = DB::table('bk_info_institusi')->where('id_institusi', $akademik->id_institusi)->value('nama_institusi');
                                                        $jenis_institusi = DB::table('bk_info_institusi')->where('id_institusi', $akademik->id_institusi)->value('jenis_institusi');
                                                        $tkh_bayaran = DB::table('sejarah_permohonan')->where('permohonan_id', $item['id'])->where('status', 8)->value('created_at');
                                                        $nama_pemohon = DB::table('smoku')->where('id', $item['smoku_id'])->value('nama');
                                                        $nokp = DB::table('smoku')->where('id', $item['smoku_id'])->value('no_kp');
                                                        $status = DB::table('bk_status')->where('kod_status', $item['status'])->value('status');
                                                        if ($item['status']==2){
                                                            $status='Baharu';
                                                        }
                                                        if ($item['status']==3){
                                                            $status='Sedang Disaring';
                                                        }
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

                                                        //nama kursus
                                                        $text2 = ucwords(strtolower($akademik->nama_kursus));
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

                                                        //institusi pengajian
                                                        $text3 = ucwords(strtolower($nama_institusi));
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
                                                    @endphp
                                                    @if ($jenis_institusi!="UA")
                                                    <tr>
                                                        <td>
                                                            <a href="{{ url('permohonan/sekretariat/pembayaran/papar/'. $item['id']) }}" title="">{{$item['no_rujukan_permohonan']}}</a>
                                                        </td>
                                                        <td>{{$pemohon}}</td>
                                                        <td>{{$kursus}}</td>
                                                        <td>{{$nama_institusi}}</td>
                                                        <td class="text-center">{{$item['created_at']->format('d/m/Y')}}</td>
                                                        <td class="text-center">{{date('d/m/Y', strtotime($item['tarikh_transaksi']))}}</td>
                                                        @if ($item['status']=='6')
                                                            <td class="text-center"><button class="btn bg-success text-white">{{ucwords(strtolower($status))}}</button></td>
                                                        @elseif ($item['status']=='8')
                                                            <td class="text-center"><button class="btn bg-dibayar text-white">{{ucwords(strtolower($status))}}</button></td>
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
                                <br>
                                <div class="card-body pt-0">
                                    <form action="{{ route('sekretariat.infocek.submit') }}" method="POST">
                                    {{csrf_field()}}
                                        <!--begin::Table-->
                                        <table class="table table-striped table-hover dataTable js-exportable" id="kt_subscriptions_table">
                                            <thead>
                                                <tr>
                                                    <th class="text-center" style="width: 3% !important;"><input type="checkbox" name="select-all" id="select-all-bkokuUA" onclick="toggle('bkokuUA');" /></th>
                                                    <th style="width: 10%"><b>ID Permohonan</b></th>
                                                    <th style="width: 20%"><b>Nama</b></th>
                                                    <th style="width: 25%" class="text-center"><b>Institusi Pengajian</b></th>
                                                    <th style="width: 21%" class="text-center"><b>No Baucer</b></th>
                                                    <th style="width: 8%" class="text-center"><b>Tarikh Baucer</b></th>
                                                    <th style="width: 8%" class="text-center"><b>No Cek</b></th>
                                                    <th style="width: 8%" class="text-center"><b>Tarikh Dibayar</b></th>
                                                    <th style="width: 5%" class="text-center"><b>Status</b></th>
                                                    <th style="width: 8%" class="text-center"></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                
                                                @php
                                                $i=0;
                                                @endphp
                                                @foreach ($permohonan as $item)
                                                    @if ($item['program']=="BKOKU")
                                                        @php
                                                            $i++;

                                                            $rujukan = explode("/", $item['no_rujukan_permohonan']);
                                                            $peringkat = $rujukan[1];
                                                            $akademik = DB::table('smoku_akademik')->where('smoku_id', $item['smoku_id'])->where('peringkat_pengajian', $peringkat)->first();
                                                            $nama_institusi = DB::table('bk_info_institusi')->where('id_institusi', $akademik->id_institusi)->value('nama_institusi');
                                                            $jenis_institusi = DB::table('bk_info_institusi')->where('id_institusi', $akademik->id_institusi)->value('jenis_institusi');
                                                            $tkh_bayaran = DB::table('sejarah_permohonan')->where('permohonan_id', $item['id'])->where('status', 8)->value('created_at');
                                                            $nama_pemohon = DB::table('smoku')->where('id', $item['smoku_id'])->value('nama');
                                                            $nokp = DB::table('smoku')->where('id', $item['smoku_id'])->value('no_kp');
                                                            $status = DB::table('bk_status')->where('kod_status', $item['status'])->value('status');
                                                            if ($item['status']==2){
                                                                $status='Baharu';
                                                            }
                                                            if ($item['status']==3){
                                                                $status='Sedang Disaring';
                                                            }
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

                                                        @endphp
                                                        @if ($jenis_institusi=="UA")
                                                            <tr>
                                                                                                                
                                                                <td class="text-center" style="width: 5%;"><input type="checkbox" name="selected_items[]" value="{{ $item['id'] }}" /></td> 
                                                                <td style="width: 10%">
                                                                    <a href="{{ url('permohonan/sekretariat/pembayaran/papar/'. $item['id']) }}" title="">{{$item['no_rujukan_permohonan']}}</a>
                                                                </td>
                                                                <td style="width: 20%">{{$pemohon}}</td>
                                                                <td style="width: 25%">{{$nama_institusi}}</td>
                                                                <td class="text-center" style="width: 21%">{{$item['no_baucer']}}</td>
                                                                <td class="text-center" style="width: 8%">
                                                                    {{ $item['tarikh_baucer'] ? date('d/m/Y', strtotime($item['tarikh_baucer'])) : '' }}
                                                                </td>
                                                                <td class="text-center" style="width: 21%">{{$item['no_cek']}}</td>
                                                                <td class="text-center" style="width: 8%">
                                                                    {{ $item['tarikh_transaksi'] ? date('d/m/Y', strtotime($item['tarikh_transaksi'])) : '' }}
                                                                </td>                                                                
                                                                @if ($item['status']=='6')
                                                                    <td class="text-center" style="width: 5%"><button class="btn bg-success text-white">{{ucwords(strtolower($status))}}</button></td>
                                                                @elseif ($item['status']=='8')
                                                                    <td class="text-center" style="width: 5%"><button class="btn bg-dibayar text-white">{{ucwords(strtolower($status))}}</button></td>
                                                                @endif
                                                                <td class="text-center" data-id="{{ $item['id'] }}" data-action="return">
                                                                    <span data-bs-toggle="tooltip" data-bs-trigger="hover" title="Kembali Kepada Penyelaras" style="cursor: pointer;">
                                                                        <i class="fa fa-undo fa-sm custom-white-icon" style="color: #000000;"></i>
                                                                    </span>
                                                                </td>
                                                            </tr>
                                                        @endif
                                                    @endif
                                                @endforeach
                                            </tbody>
                                        </table>
                                        <!--end::Table-->

                                        <!-- Button trigger modal --> 
                                        <button type="button" class="btn btn-primary btn-round float-end mb-10" data-bs-toggle="modal" data-bs-target="#baucer">
                                            Kemaskini
                                        </button>
                                        {{-- Modal --}}
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
                            {{-- PPK--}}
                            <div class="tab-pane fade" id="ppk" role="tabpanel" aria-labelledby="ppk-tab">
                                <br>
                                <div class="body">
                                    <div class="table-responsive">
                                        <table id="sortTable2" class="table table-striped table-hover dataTable js-exportable">
                                            <thead>
                                            <tr>
                                                <th style="width: 10%"><b>ID Permohonan</b></th>
                                                <th style="width: 20%"><b>Nama</b></th>
                                                <th style="width: 21%"><b>Nama Kursus</b></th>
                                                <th style="width: 25%"><b>Institusi Pengajian</b></th>
                                                <th style="width: 8%" class="text-center"><b>Tarikh Permohonan</b></th>
                                                <th style="width: 8%" class="text-center"><b>Tarikh Dibayar</b></th>
                                                <th style="width: 8%" class="text-center"><b>Status</b></th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @php
                                                $i=0;
                                            @endphp
                                            @foreach ($permohonan as $item)
                                                @if ($item['program']=="PPK")
                                                    @php
                                                        $i++;

                                                    $rujukan = explode("/", $item['no_rujukan_permohonan']);
                                                    $peringkat = $rujukan[1];
                                                    $akademik = DB::table('smoku_akademik')->where('smoku_id', $item['smoku_id'])->where('peringkat_pengajian', $peringkat)->first();
                                                    $nama_institusi = DB::table('bk_info_institusi')->where('id_institusi', $akademik->id_institusi)->value('nama_institusi');
                                                    $tkh_bayaran = DB::table('sejarah_permohonan')->where('permohonan_id', $item['id'])->where('status', 8)->value('created_at');
                                                    $nama_pemohon = DB::table('smoku')->where('id', $item['smoku_id'])->value('nama');
                                                    $nokp = DB::table('smoku')->where('id', $item['smoku_id'])->value('no_kp');
                                                    $status = DB::table('bk_status')->where('kod_status', $item['status'])->value('status');
                                                    if ($item['status']==2){
                                                        $status='Baharu';
                                                    }
                                                    if ($item['status']==3){
                                                        $status='Sedang Disaring';
                                                    }
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

                                                    //nama kursus
                                                    $text2 = ucwords(strtolower($akademik->nama_kursus));
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

                                                    //institusi pengajian
                                                    $text3 = ucwords(strtolower($nama_institusi));
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
                                                    @endphp
                                                    <tr>
                                                        <td style="width: 10%">
                                                            <a href="{{ url('permohonan/sekretariat/pembayaran/papar/'. $item['id']) }}" title="">{{$item['no_rujukan_permohonan']}}</a>
                                                        </td>
                                                        <td style="width: 20%">{{$pemohon}}</td>
                                                        <td style="width: 21%">{{$kursus}}</td>
                                                        <td style="width: 25%">{{$nama_institusi}}</td>
                                                        <td class="text-center" style="width: 8%">{{$item['created_at']->format('d/m/Y')}}</td>
                                                        <td class="text-center" style="width: 8%">{{date('d/m/Y', strtotime($item['tarikh_transaksi']))}}</td>
                                                        @if ($item['status']=='6')
                                                            <td class="text-center" style="width: 8%"><button class="btn bg-success text-white">{{ucwords(strtolower($status))}}</button></td>
                                                        @elseif ($item['status']=='8')
                                                            <td class="text-center" style="width: 8%"><button class="btn bg-dibayar text-white">{{ucwords(strtolower($status))}}</button></td>
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
    </div>
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


        // check all checkboxes at once
        // function toggle(source) {
        //     var checkboxes = document.querySelectorAll('input[name="selected_items[]"]');
        //     for (var i = 0; i < checkboxes.length; i++) {
        //         checkboxes[i].checked = source.checked;
        //     }
        // }
        function toggle(tab) {
            var selectAllCheckbox = document.getElementById('select-all-' + tab);
            var isChecked = selectAllCheckbox.checked;

            // Get all checkboxes in the active tab
            var checkboxes = document.querySelectorAll('#' + tab + ' input[name="selected_items[]"]');
            
            // Set the checked property of all checkboxes to match the "Select All" checkbox
            checkboxes.forEach(function(checkbox) {
                checkbox.checked = isChecked;
            });

            // Prepare an array to hold selected no_kp values
            var selectedid = [];

            // Loop through all checkboxes and get selected nokp values
            checkboxes.forEach(function(checkbox) {
                if (checkbox.checked) {
                    selectedid.push(checkbox.value);
                }
            });
        }


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
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    
    <script>
        // Initialize JavaScript variables with data from Blade
        var bkokuList = @json($institusiPengajian);
        var bkokuUAList = @json($institusiPengajianUA);
        var ppkList = @json($institusiPengajianPPK);
    
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
            exportLink.href = "{{ route('senarai.penyaluran.excel', ['programCode' => 'BKOKU']) }}?institusi=" + selectedInstitusi;
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
    
    
    
    <!--begin::Javascript-->

		<!--begin::Global Javascript Bundle(mandatory for all pages)-->
		<script src="/assets/js/scripts.bundle.js"></script>
		<!--end::Global Javascript Bundle-->

		<!--begin::Custom Javascript(used for this page only)-->
		<script src="/assets/js/custom/apps/subscriptions/list/list.js"></script>
		
		<!--end::Custom Javascript-->
	<!--end::Javascript-->
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
                title: 'Tiada Berjaya!',
                text: ' {!! session('failed') !!}',
                confirmButtonText: 'OK'
            });
        @endif

    </script>

    </body>
</x-default-layout>

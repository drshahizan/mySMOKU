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
            margin-left: 10px!important;
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
                            <h2>Senarai Pembayaran<br><small>Klik ID Permohonan untuk melihat maklumat pembayaran</small></h2>
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


                        <div class="tab-content" id="myTabContent">
                            {{-- BKOKU --}}
                            <div class="tab-pane fade show active" id="bkoku" role="tabpanel" aria-labelledby="bkoku-tab">
                                <br>
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
                                        <!--begin::Content-->
                                        <div data-kt-subscription-table-filter="form">
                                            <!--begin::Input group-->
                                            <div class="row mb-10">
                                                <div class="col-md-8 fv-row">
                                                    <select name="institusi" class="form-select custom-width-select js-example-basic-single">
                                                        <option value="">Pilih Institusi Pengajian</option>
                                                        @foreach ($institusiPengajian as $institusi)
                                                            <option value="{{ $institusi->nama_institusi }}" >{{ $institusi->nama_institusi }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
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
                                                <div class="col-md-2 text-end fv-row" >  
                                                    <a id="exportLink" href="{{ route('senarai.penyaluran.excel', ['programCode' => 'BKOKU']) }}" target="_blank" class="btn btn-secondary btn-round" style=" width: 150%;">
                                                        <i class="fa fa-file-excel" style="color: black;"></i> Excel
                                                    </a> 
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
                                <div class="card-body pt-0">
                                    <form action="{{ route('sekretariat.infocek.submit') }}" method="POST">
                                    {{csrf_field()}}
                                        <!--begin::Table-->
                                        <table class="table table-striped table-hover dataTable js-exportable" id="kt_subscriptions_table">
                                            <thead>
                                                <tr>
                                                    <th class="text-center" style="width: 3% !important;"><input type="checkbox" name="select-all" id="select-all" onclick="toggle(this);" /></th>
                                                    <th style="width: 10%"><b>ID Permohonan</b></th>
                                                    <th style="width: 20%"><b>Nama</b></th>
                                                    <th style="width: 25%"><b>Institusi Pengajian</b></th>
                                                    <th style="width: 21%"><b>No Baucer</b></th>
                                                    <th style="width: 8%" class="text-center"><b>Tarikh Baucer</b></th>
                                                    <th style="width: 8%" class="text-center"><b>No Cek</b></th>
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
                                                        @if ($jenis_institusi=="UA")
                                                            <tr>
                                                                                                                
                                                                <td class="text-center" style="width: 5%;"><input type="checkbox" name="selected_items[]" value="{{ $item['id'] }}" /></td> 
                                                                <td style="width: 10%">
                                                                    <a href="{{ url('permohonan/sekretariat/pembayaran/papar/'. $item['id']) }}" title="">{{$item['no_rujukan_permohonan']}}</a>
                                                                </td>
                                                                <td style="width: 20%">{{$pemohon}}</td>
                                                                <td style="width: 25%">{{$nama_institusi}}</td>
                                                                <td style="width: 21%">{{$item['no_baucer']}}</td>
                                                                <td class="text-center" style="width: 8%">{{date('d/m/Y', strtotime($item['tarikh_baucer']))}}</td>
                                                                <td style="width: 21%">{{$item['no_cek']}}</td>
                                                                <td class="text-center" style="width: 8%">{{date('d/m/Y', strtotime($item['tarikh_transaksi']))}}</td>
                                                                @if ($item['status']=='6')
                                                                    <td class="text-center" style="width: 8%"><button class="btn bg-success text-white">{{ucwords(strtolower($status))}}</button></td>
                                                                @elseif ($item['status']=='8')
                                                                    <td class="text-center" style="width: 8%"><button class="btn bg-dibayar text-white">{{ucwords(strtolower($status))}}</button></td>
                                                                @endif
                                                            </tr>
                                                        @endif
                                                    @endif
                                                @endforeach
                                            </tbody>
                                        </table>
										<!--end::Table-->

                                        <!-- Button trigger modal //syafiqah. kiv jap tak siap lagi--> 
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
    <style>
        .custom-width-select {
            width: 400px !important; /* Important to override other styles */
        }
    </style>
    <script>
        $('#sortTable1').DataTable({
            ordering: true, // Enable manual sorting
            order: [] // Disable initial sorting
        });
        $('#kt_subscriptions_table').DataTable({
            ordering: true, // Enable manual sorting
            order: [], // Disable initial sorting
            
        });
        $('#sortTable2').DataTable({
            ordering: true, // Enable manual sorting
            order: [] // Disable initial sorting
        });

        $(document).ready(function() {
			$('.js-example-basic-single').select2();
		});


        // check all checkboxes at once
        function toggle(source) {
            var checkboxes = document.querySelectorAll('input[name="selected_items[]"]');
            for (var i = 0; i < checkboxes.length; i++) {
                checkboxes[i].checked = source.checked;
            }
        }

    </script>
    <script>
        function applyFilter() {
            var selectedInstitusi = $('[name="institusi"]').val();
            // alert(selectedInstitusi);
            
            // Update the export link with the selected institusi
            var exportLink = document.getElementById('exportLink');
            exportLink.href = "{{ route('senarai.penyaluran.excel', ['programCode' => 'BKOKU']) }}?institusi=" + selectedInstitusi;
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

    </body>
</x-default-layout>

<x-default-layout>
    <head>
        <title>Sekretariat BKOKU KPT</title>
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
            <li class="breadcrumb-item text-dark" style="color:darkblue">Sejarah</li>
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
            <!-- Page header section  -->
            <div class="row clearfix">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="header">
                            <h2>Sejarah Permohonan<br><small>Klik ID Permohonan untuk melihat rekod permohonan pemohon.</small></h2>
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
                                        <div class="col-md-2 fv-row none-container"> 
                                            
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

                        <div class="tab-content" id="myTabContent">
                            {{-- BKOKU --}}
                            <div class="tab-pane fade show active" id="bkoku" role="tabpanel" aria-labelledby="bkoku-tab">
                                <br>
                                <div class="body">
                                    <div class="table-responsive">
                                        <table id="sortTable1" class="table table-striped table-hover dataTable js-exportable">
                                            <thead>
                                            <tr>
                                                <th style="width: 15%"><b>ID Permohonan</b></th>
                                                <th style="width: 35%"><b>Nama</b></th>
                                                <th class="text-center" style="width: 20%"><b>Institusi Pengajian</b></th>
                                                <th style="width: 15%" class="text-center"><b>Tarikh Permohonan</b></th>
                                                <th style="width: 15%" class="text-center"><b>Status Terkini</b></th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            
                                            @foreach ($permohonan as $item)
                                                @if ($item['program']=="BKOKU")
                                                    @php
                                                        $rujukan = explode("/", $item['no_rujukan_permohonan']);
                                                        $peringkat = $rujukan[1];
                                                        $akademik = DB::table('smoku_akademik')->where('smoku_id', $item['smoku_id'])->where('peringkat_pengajian',$peringkat)->where('status', 1)->first();
                                                        if ($akademik) {
                                                            $jenis_institusi = DB::table('bk_info_institusi')->where('id_institusi', $akademik->id_institusi)->value('jenis_institusi');
                                                        }
                                                      
                                                        $institusi_pengajian = DB::table('smoku_akademik')->join('bk_info_institusi','bk_info_institusi.id_institusi','=','smoku_akademik.id_institusi' )->where('smoku_id', $item['smoku_id'])->where('peringkat_pengajian',$peringkat)->value('bk_info_institusi.nama_institusi');
                                                        $nama_pemohon = DB::table('smoku')->where('id', $item['smoku_id'])->value('nama');
                                                        $status = DB::table('bk_status')->where('kod_status', $item['status'])->value('status');
                                                        if ($item['status']==2){
                                                            $status='Baharu';
                                                        }
                                                        if ($item['status']==3){
                                                            $status='Sedang Disaring';
                                                        }
                                                        

                                                        //nama pemohon
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
                                                    @if ($jenis_institusi!="UA")
                                                    
                                                    <tr>
                                                        <td>
                                                            <a href="{{ url('permohonan/sekretariat/sejarah/rekod-permohonan/'. $item['id']) }}" title="">{{$item['no_rujukan_permohonan']}}</a>
                                                        </td>
                                                        <td>{{$pemohon}}</td>
                                                        <td>{{$institusipengajian}}</td>
                                                        <td class="text-center">{{date('d/m/Y', strtotime($item->tarikh_hantar))}}</td>
                                                        @if ($item['status']=='1')
                                                            <td class="text-center"><button class="btn bg-info text-white">{{ucwords(strtolower($status))}}</button></td>
                                                        @elseif ($item['status']=='2')
                                                            <td class="text-center"><button class="btn bg-baharu text-white">{{ucwords(strtolower($status))}}</button></td>
                                                        @elseif ($item['status']=='3')
                                                            <td class="text-center"><button class="btn bg-sedang-disaring text-white">{{ucwords(strtolower($status))}}</button></td>
                                                        @elseif ($item['status']=='4')
                                                            <td class="text-center"><button class="btn bg-warning text-white">{{ucwords(strtolower($status))}}</button></td>
                                                        @elseif ($item['status']=='5')
                                                            <td class="text-center"><button class="btn bg-dikembalikan text-white">{{ucwords(strtolower($status))}}</button></td>
                                                        @elseif ($item['status']=='6')
                                                            <td class="text-center">
                                                                <a href="{{ route('generate-pdf', ['permohonanId' => $item['id']]) }}" class="btn bg-success btn-round btn-sm custom-width-btn text-white">
                                                                    <i class="fa fa-download fa-sm custom-white-icon" style="color: white !important;"></i> Layak
                                                                </a>
                                                            </td>
                                                           
                                                        @elseif ($item['status']=='7')
                                                            <td class="text-center"><button class="btn bg-danger text-white">{{ucwords(strtolower($status))}}</button></td>
                                                        @elseif ($item['status']=='8')
                                                            <td class="text-center">
                                                                <a href="{{ route('generate-pdf', ['permohonanId' => $item['id']]) }}" class="btn bg-dibayar btn-round btn-sm custom-width-btn">
                                                                    <i class="fa fa-download fa-sm custom-white-icon" style="color: white !important;"></i> Dibayar
                                                                </a>
                                                            </td>
                                                        @elseif ($item['status']=='9')
                                                            <td class="text-center"><button class="btn bg-batal text-white">{{ucwords(strtolower($status))}}</button></td>
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
                                <br>
                                <div class="body">
                                    <div class="table-responsive">
                                        <table id="sortTable1a" class="table table-striped table-hover dataTable js-exportable">
                                            <thead>
                                                <tr>
                                                    <th style="width: 15%"><b>ID Permohonan</b></th>
                                                    <th style="width: 35%"><b>Nama</b></th>
                                                    <th class="text-center" style="width: 20%"><b>Institusi Pengajian</b></th>
                                                    <th style="width: 15%" class="text-center"><b>Tarikh Permohonan</b></th>
                                                    <th style="width: 15%" class="text-center"><b>Status Terkini</b></th>
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
                                                        $akademik = DB::table('smoku_akademik')->where('smoku_id', $item['smoku_id'])->where('status', 1)->first();
                                                        $jenis_institusi = DB::table('bk_info_institusi')->where('id_institusi', $akademik->id_institusi)->value('jenis_institusi');
                                                        $institusi_pengajian = DB::table('smoku_akademik')->join('bk_info_institusi','bk_info_institusi.id_institusi','=','smoku_akademik.id_institusi' )->where('smoku_id', $item['smoku_id'])->where('peringkat_pengajian',$peringkat)->value('bk_info_institusi.nama_institusi');
                                                        $nama_pemohon = DB::table('smoku')->where('id', $item['smoku_id'])->value('nama');
                                                        $status = DB::table('bk_status')->where('kod_status', $item['status'])->value('status');

                                                        if ($item['status']==2){
                                                            $status='Baharu';
                                                        }
                                                        if ($item['status']==3){
                                                            $status='Sedang Disaring';
                                                        }

                                                        //nama pemohon
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
                                                    @if ($jenis_institusi=="UA")
                                                        <tr>
                                                            <td style="width: 15%">
                                                                <a href="{{ url('permohonan/sekretariat/sejarah/rekod-permohonan/'. $item['id']) }}" title="">{{$item['no_rujukan_permohonan']}}</a>
                                                            </td>
                                                            <td style="width: 35%">{{$pemohon}}</td>
                                                            <td style="width: 20%">{{$institusipengajian}}</td>
                                                            <td class="text-center" style="width: 15%">{{date('d/m/Y', strtotime($item->tarikh_hantar))}}</td>
                                                            @if ($item['status']=='1')
                                                                <td class="text-center" style="width: 15%"><button class="btn bg-info text-white">{{ucwords(strtolower($status))}}</button></td>
                                                            @elseif ($item['status']=='2')
                                                                <td class="text-center" style="width: 15%"><button class="btn bg-baharu text-white">{{ucwords(strtolower($status))}}</button></td>
                                                            @elseif ($item['status']=='3')
                                                                <td class="text-center" style="width: 15%"><button class="btn bg-sedang-disaring text-white">{{ucwords(strtolower($status))}}</button></td>
                                                            @elseif ($item['status']=='4')
                                                                <td class="text-center" style="width: 15%"><button class="btn bg-warning text-white">{{ucwords(strtolower($status))}}</button></td>
                                                            @elseif ($item['status']=='5')
                                                                <td class="text-center" style="width: 15%"><button class="btn bg-dikembalikan text-white">{{ucwords(strtolower($status))}}</button></td>
                                                            @elseif ($item['status']=='6')
                                                                <td class="text-center">
                                                                    <a href="{{ route('generate-pdf', ['permohonanId' => $item['id']]) }}" class="btn bg-success btn-round btn-sm custom-width-btn text-white">
                                                                        <i class="fa fa-download fa-sm custom-white-icon" style="color: white !important;"></i> Layak
                                                                    </a>
                                                                </td>
                                                            @elseif ($item['status']=='7')
                                                                <td class="text-center" style="width: 15%"><button class="btn bg-danger text-white">{{ucwords(strtolower($status))}}</button></td>
                                                            @elseif ($item['status']=='8')
                                                                <td class="text-center">
                                                                    <a href="{{ route('generate-pdf', ['permohonanId' => $item['id']]) }}" class="btn bg-dibayar btn-round btn-sm custom-width-btn">
                                                                        <i class="fa fa-download fa-sm custom-white-icon" style="color: white !important;"></i> Dibayar
                                                                    </a>
                                                                </td>
                                                            @elseif ($item['status']=='9')
                                                                <td class="text-center" style="width: 15%"><button class="btn bg-batal text-white">{{ucwords(strtolower($status))}}</button></td>
                                                            @elseif ($item['status']=='10')
                                                                <td class="text-center"><button class="btn btn-round btn-sm custom-width-btn text-white" style="background-color: #488BCD">{{ucwords(strtolower($status))}}</button></td>
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
                            {{-- PPK --}}
                            <div class="tab-pane fade" id="ppk" role="tabpanel" aria-labelledby="ppk-tab">
                                <br>
                                <div class="body">
                                    <div class="table-responsive">
                                        <table id="sortTable2" class="table table-striped table-hover dataTable js-exportable">
                                            <thead>
                                                <tr>
                                                    <th style="width: 15%"><b>ID Permohonan</b></th>
                                                    <th style="width: 35%"><b>Nama</b></th>
                                                    <th class="text-center" style="width: 20%"><b>Institusi Pengajian</b></th>
                                                    <th style="width: 15%" class="text-center"><b>Tarikh Permohonan</b></th>
                                                    <th style="width: 15%" class="text-center"><b>Status Terkini</b></th>
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
                                                        $akademik = DB::table('smoku_akademik')->where('smoku_id', $item['smoku_id'])->where('status', 1)->first();
                                                        $jenis_institusi = DB::table('bk_info_institusi')->where('id_institusi', $akademik->id_institusi)->value('jenis_institusi');
                                                        $institusi_pengajian = DB::table('smoku_akademik')->join('bk_info_institusi','bk_info_institusi.id_institusi','=','smoku_akademik.id_institusi' )->where('smoku_id', $item['smoku_id'])->where('peringkat_pengajian',$peringkat)->value('bk_info_institusi.nama_institusi');
                                                        $nama_pemohon = DB::table('smoku')->where('id', $item['smoku_id'])->value('nama');
                                                        $status = DB::table('bk_status')->where('kod_status', $item['status'])->value('status');
                                                        if ($item['status']==2){
                                                            $status='Baharu';
                                                        }
                                                        if ($item['status']==3){
                                                            $status='Sedang Disaring';
                                                        }

                                                        //nama pemohon
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
                                                    <tr>
                                                        <td style="width: 15%">
                                                            <a href="{{ url('permohonan/sekretariat/sejarah/rekod-permohonan/'. $item['id']) }}" title="">{{$item['no_rujukan_permohonan']}}</a>
                                                        </td>
                                                        <td style="width: 35%">{{$pemohon}}</td>
                                                        <td style="width: 20%">{{$institusipengajian}}</td>
                                                        <td class="text-center" style="width: 15%">{{date('d/m/Y', strtotime($item->tarikh_hantar))}}</td>
                                                        @if ($item['status']=='1')
                                                            <td class="text-center" style="width: 15%"><button class="btn bg-info text-white">{{ucwords(strtolower($status))}}</button></td>
                                                        @elseif ($item['status']=='2')
                                                            <td class="text-center" style="width: 15%"><button class="btn bg-baharu text-white">{{ucwords(strtolower($status))}}</button></td>
                                                        @elseif ($item['status']=='3')
                                                            <td class="text-center" style="width: 15%"><button class="btn bg-sedang-disaring text-white">{{ucwords(strtolower($status))}}</button></td>
                                                        @elseif ($item['status']=='4')
                                                            <td class="text-center" style="width: 15%"><button class="btn bg-warning text-white">{{ucwords(strtolower($status))}}</button></td>
                                                        @elseif ($item['status']=='5')
                                                            <td class="text-center" style="width: 15%"><button class="btn bg-dikembalikan text-white">{{ucwords(strtolower($status))}}</button></td>
                                                        @elseif ($item['status']=='6')
                                                            <td class="text-center">
                                                                <a href="{{ route('generate-pdf', ['permohonanId' => $item['id']]) }}" class="btn bg-success btn-round btn-sm custom-width-btn text-white">
                                                                    <i class="fa fa-download fa-sm custom-white-icon" style="color: white !important;"></i> Layak
                                                                </a>
                                                            </td>
                                                        @elseif ($item['status']=='7')
                                                            <td class="text-center" style="width: 15%"><button class="btn bg-danger text-white">{{ucwords(strtolower($status))}}</button></td>
                                                        @elseif ($item['status']=='8')
                                                            <td class="text-center">
                                                                <a href="{{ route('generate-pdf', ['permohonanId' => $item['id']]) }}" class="btn bg-dibayar btn-round btn-sm custom-width-btn">
                                                                    <i class="fa fa-download fa-sm custom-white-icon" style="color: white !important;"></i> Dibayar
                                                                </a>
                                                            </td>
                                                        @elseif ($item['status']=='9')
                                                            <td class="text-center" style="width: 15%"><button class="btn bg-batal text-white">{{ucwords(strtolower($status))}}</button></td>
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
        .custom-width-btn {
                width: 131px; 
                height: 30px;
        }
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
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    
    <script>
        // Initialize JavaScript variables with data from Blade
        var bkokuList = @json($institusiPengajian);
        var bkokuUAList = @json($institusiPengajianUA);
        var ppkList = @json($institusiPengajianPPK);
    
        $(document).ready(function() {
            $('.none-container').show(); // Hide export elements
    
            // Add an event listener for tab clicks
            $('.nav-link').on('click', function() {
                // Get the ID of the active tab
                var activeTabId = $(this).attr('id');
    
                // Clear filters when changing tabs
                clearFilters();
    
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
            initDataTable('#sortTable1a', 'datatable');
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
            table.column(2).search(filterValue).draw();
    
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

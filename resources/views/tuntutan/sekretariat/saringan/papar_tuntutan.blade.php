<x-default-layout>
    <link rel="stylesheet" href="/assets/css/saringan.css">
<style>
    body{
        margin: 20px!important;
    }
    .maklumat, .maklumat td{
        border: none!important;
        padding:2px 8px!important;
    }
    .maklumat2, .maklumat2 td{
        border: none!important;
    }
    .table{
        table-layout: fixed;
        width: 90%;
    }
    select{
        padding: 3px 6px!important;
        border: 1px solid #ccc!important;
        border-radius: 6px!important;
        font-size: 13px!important;
    }
    .small-td{
        width: 11%;
    }
    .table td, .table th, .table2 td, .table2 th{
        padding: 7px!important;
    }
    .white{
        color: white!important;
    }
    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }
    input[type=number]{
        width: 80px;
        text-align: right;
        border: 1px solid #ccc;
        border-radius: 6px;
        padding: 2px 5px;
        font-size: 13px!important;
    }
    textarea{
        border: 1px solid #ccc;
        border-radius: 6px;
        padding: 2px 5px;
        font-size: 13px!important;
    }
    .bold{
        font-weight: bold!important;
    }
    .space{
        width: 15%;
    }
    .red-color{
        color: red!important;
    }
    button{
        margin: 5px;
        width:150px!important;
    }
    .vertical-top{
        vertical-align: top!important;
    }
    /* .th-yellow{
        background-color: #a27a00!important;
    }
    .th-green{
        background-color: #007842!important;
    } */
</style>
<body>
<!-- Main body part  -->
<div id="main-content">
    <div class="container-fluid">
        <!-- Page header section  -->
        <div class="row clearfix">
            <div class="col-12">
                <nav class="navbar navbar-expand-lg navbar-light bg-light page_menu">
                    <!--<a class="navbar-brand" href="#">M.</a>-->
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                        <i class="fa fa-bars text-muted"></i>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNavDropdown">
                        <ul class="navbar-nav mr-auto">
                            <li class="nav-item vivify swoopInTop delay-150 active"><b>Saring Tuntutan</b></li>
                        </ul>
                        <div class="ml-auto">
                            <a href="{{url('tuntutan/sekretariat/saringan/kemaskini-tuntutan/'.$sejarah_t->id)}}">
                                <button type="button" class="btn btn-sm my-btn btn-default" title="Kemaskini">
                                    <i>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                            <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                            <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                                        </svg>
                                        &nbsp;&nbsp;Kemaskini
                                    </i>
                                </button>
                            </a>
                        </div>
                    </div>
                </nav>
            </div>
            <div class="col-lg-12">
                <div class="card">
                    <div class="body">
                        <div class="col-md-6 col-sm-6">
                            <br>
                            @php
                                if($tuntutan->status==5){
                                    $tarikh_status = DB::table('sejarah_tuntutan')->where('tuntutan_id', $tuntutan->id)->where('status', 4)->value('created_at');
                                }
                                elseif($tuntutan->status==6){
                                    $tarikh_status = DB::table('sejarah_tuntutan')->where('tuntutan_id',$tuntutan->id)->where('status', 6)->value('created_at');
                                }
                                elseif($tuntutan->status==7){
                                    $tarikh_status = DB::table('sejarah_tuntutan')->where('tuntutan_id',$tuntutan->id)->where('status', 7)->value('created_at');
                                }

                                $peringkat = DB::table('bk_peringkat_pengajian')->where('kod_peringkat', $akademik->peringkat_pengajian)->value('peringkat');
                                $nama_institusi = DB::table('bk_info_institusi')->where('id_institusi', $akademik->id_institusi)->value('nama_institusi');
                                $nama_penaja = DB::table('bk_penaja')->where('id', $akademik->nama_penaja)->value('penaja');

                                $user_id = DB::table('sejarah_tuntutan')->where('tuntutan_id', $tuntutan->id)->where('status', $tuntutan->status)->latest()->value('dilaksanakan_oleh');

                                if($user_id==null){
                                    $user_name = "Tiada Maklumat";
                                }
                                else{
                                    $user_name = DB::table('users')->where('id', $user_id)->value('nama');
                                    $text = ucwords(strtolower($user_name)); // Assuming you're sending the text as a POST parameter
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
                                    $user_name = implode(' ', $result);
                                }

                                $status = DB::table('bk_status')->where('kod_status', $sejarah_t->status)->value('status');
                                $status_tuntutan = DB::table('bk_status')->where('kod_status', $saringan->status)->value('status');
                                // nama pemohon
                                $text = ucwords(strtolower($smoku->nama)); // Assuming you're sending the text as a POST parameter
                                $conjunctions = ['bin', 'binti', 'of', 'in', 'and'];
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
                                $text2 = ucwords(strtolower($akademik->nama_kursus)); // Assuming you're sending the text as a POST parameter
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
                                $text3 = ucwords(strtolower($nama_institusi)); // Assuming you're sending the text as a POST parameter
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
                            <table class="maklumat">
                                <tr>
                                    <td><strong>ID Tuntutan</strong></td>
                                    <td>:</td>
                                    <td>{{$tuntutan->no_rujukan_tuntutan}}</td>
                                    <td class="space">&nbsp;</td>
                                    <td><strong>Kursus</strong></td>
                                    <td>:</td>
                                    <td>{{$kursus}}</td>
                                </tr>
                                <tr>
                                    <td><strong>Nama</strong></td>
                                    <td>:</td>
                                    <td>{{$pemohon}}</td>
                                    <td class="space">&nbsp;</td>
                                    <td><strong>Institusi</strong></td>
                                    <td>:</td>
                                    <td>{{$nama_institusi}}</td>
                                </tr>
                                <tr>
                                    <td><strong>No. Kad Pengenalan</strong></td>
                                    <td>:</td>
                                    <td>{{$smoku->no_kp}}</td>
                                    <td class="space">&nbsp;</td>
                                    <td><strong>Peringkat</strong></td>
                                    <td>:</td>
                                    <td>{{ucwords(strtolower($peringkat))}}</td>
                                </tr>
                                <tr>
                                    <td><strong>Tarikh Tuntutan</strong></td>
                                    <td>:</td>
                                    <td>{{date('d/m/Y', strtotime($tuntutan->tarikh_hantar))}}</td>
                                    <td class="space">&nbsp;</td>
                                    <td><strong>Sesi/Semester</strong></td>
                                    <td>:</td>
                                    <td>{{$tuntutan->sesi}}-0{{$tuntutan->semester}}</td>
                                </tr>
                                <tr>
                                    <td><strong>Status Penajaan</strong></td>
                                    <td>:</td>
                                    @if($akademik->nama_penaja == '99')
                                        <td>Ditaja ({{ $akademik->penaja_lain }})</td>
                                    @elseif($akademik->nama_penaja != null)
                                        <td>Ditaja ({{ $nama_penaja }})</td>
                                    @else
                                        <td>Tidak Ditaja</td>
                                    @endif
                                    <td class="space">&nbsp;</td>
                                    <td><strong>Status</strong></td>
                                    <td>:</td>
                                    <td>{{ucwords(strtolower($status_tuntutan))}} ({{date('d/m/Y', strtotime($tarikh_status))}} oleh {{$user_name}})</td>
                                </tr>
                            </table>
                            <hr>
                            <br>
                            <h6>Maklumat tuntutan:</h6>
                            <br>
                            @php
                                if ($sama_semester==false)
                                    $i = 2;
                                else{
                                    $i=1;
                                }
                            @endphp
                            <div class="row clearfix">
                                <div class="col-md-12">
                                    <div class="table-responsive">
                                        <table class="table table-hover table-bordered mb-5">
                                            <thead class="table-primary">
                                            <tr>
                                                <th style="width: 5%;">No.</th>
                                                <th style="width: 20%;">Item</th>
                                                <th style="width: 15%;">Keputusan Saringan</th>
                                                <th style="width: 20%;">No. Resit</th>
                                                <th style="width: 40%;">Perihal</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @if($sama_semester==false)
                                                    @php
                                                        $salinan = DB::table('permohonan_peperiksaan')->where('permohonan_id', $permohonan->id)->orderBy('id', 'DESC')->first();
                                                        // dd($keputusan);
                                                    @endphp
                                                <tr>
                                                    <td style="text-align:left;">1</td>
                                                    <td>
                                                        @if($salinan->kepPeperiksaan)
                                                            <span><a href="{{ url('tuntutan/sekretariat/saringan/keputusan-peperiksaan') }}" target="_blank">Keputusan Peperiksaan</a></span>
                                                        @else
                                                            <span>Keputusan Peperiksaan</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        {{$saringan->saringan_kep_peperiksaan}}
                                                    </td>
                                                    <td>
                                                        CGPA - {{$salinan->cgpa}}
                                                    </td>
                                                    <td>
                                                        Keseluruhan keputusan peperiksaan
                                                    </td>
                                                </tr>
                                            @endif
                                            @foreach($tuntutan_item as $item)
                                                @php
                                                    $invoisResit = "/assets/dokumen/tuntutan/".$item['resit'];
                                                @endphp
                                                <tr>
                                                    <td style="text-align:left;">{{$i++}}</td>
                                                    <td>
                                                        @if($item->resit)
                                                            <span><a href="{{ url($invoisResit) }}" target="_blank">{{$item['jenis_yuran']}}</a></span>
                                                        @else
                                                            <span>{{$item['jenis_yuran']}}</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        {{$item['kep_saringan']}}
                                                    </td>
                                                    <td>
                                                        {{$item['no_resit']}}
                                                    </td>
                                                    <td>
                                                        {{$item['nota_resit']}}
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <h6>Pengiraan:</h6>
                            <br>
                            <p>Baki Terdahulu (RM) : {{number_format($baki_terdahulu, 2)}}</p>
                            <!--begin: Invoice body-->
                            @if($permohonan->program == "BKOKU" && $tuntutan->yuran == "1" && $tuntutan->wang_saku == "1")
                                @php
                                    $yuran = 0;
                                    foreach ($tuntutan_item as $item){
                                        if($item['amaun'] == null){
                                            $item['amaun'] = 0;
                                            $yuran = $yuran + $item['amaun'];
                                        }
                                        else{
                                            $yuran = $yuran + $item['amaun'];
                                        }
                                    }

                                    if($tuntutan->amaun_wang_saku == null){
                                        $tuntutan->amaun_wang_saku = 0;
                                    }
                                    $jumlah = $yuran + $tuntutan->amaun_wang_saku;
                                    $baki_y = $baki_terdahulu - $jumlah;
                                @endphp
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                        <tr>
                                            <th class="border-top-0 pr-0 py-4 font-size-h6 font-weight-boldest bold white">Jenis Tuntutan</th>
                                            <th class="th-yellow border-top-0 pr-0 py-4 font-size-h6 font-weight-boldest bold white">Dituntut (RM)</th>
                                            <th class="th-yellow border-top-0 pr-0 py-4 font-size-h6 font-weight-boldest bold white">Baki (RM)</th>
                                            <th class="th-green border-top-0 pr-0 py-4 font-size-h6 font-weight-boldest bold white">Disokong (RM)</th>
                                            <th class="th-green border-top-0 pr-0 py-4 font-size-h6 font-weight-boldest bold white">Baki (RM)</th>
                                            {{--                                                    <th class="th-green border-top-0 pr-0 py-4 font-size-h6 font-weight-boldest bold white">Dibayar (RM)</th>--}}
                                            {{--                                                    <th class="th-green border-top-0 pr-0 py-4 font-size-h6 font-weight-boldest bold white">Baki (RM)</th>--}}
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr class="font-weight-bolder font-size-lg">
                                            <td class="border-top-0 pr-0 py-4 font-size-h6 font-weight-boldest">Yuran Pengajian</td>
                                            <td class="border-top-0 pr-0 py-4 font-size-h6 font-weight-boldest text-right">{{number_format($yuran, 2)}}</td>
                                            <td class="border-top-0 pr-0 py-4 font-size-h6 font-weight-boldest text-right">{{number_format($baki_y, 2)}}</td>
                                            <td class="border-top-0 pr-0 py-4 font-size-h6 font-weight-boldest text-right">{{number_format($tuntutan->yuran_disokong, 2)}}</td>
                                            <td class="border-top-0 pr-0 py-4 font-size-h6 font-weight-boldest text-right">{{number_format($tuntutan->baki_disokong, 2)}}</td>
                                        </tr>
                                        <tr class="font-weight-bolder font-size-lg">
                                            <td class="border-top-0 pr-0 py-4 font-size-h6 font-weight-boldest">Wang Saku</td>
                                            <td class="border-top-0 pr-0 py-4 font-size-h6 font-weight-boldest text-right">{{number_format($tuntutan->amaun_wang_saku, 2)}}</td>
                                            <td class="border-top-0 pr-0 py-4 font-size-h6 font-weight-boldest text-right">{{number_format(0, 2)}}</td>
                                            <td class="border-top-0 pr-0 py-4 font-size-h6 font-weight-boldest text-right">{{number_format($tuntutan->wang_saku_disokong, 2)}}</td>
                                            <td class="border-top-0 pr-0 py-4 font-size-h6 font-weight-boldest text-right">{{number_format(0, 2)}}</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                    <table class="maklumat2">
                                        <tr>
                                            <td>Jumlah tuntutan yang disokong (RM)</td>
                                            <td>:</td>
                                            <td>{{number_format($tuntutan->yuran_disokong + $tuntutan->wang_saku_disokong, 2)}}</td>
                                        </tr>
                                        {{--                                                <tr>--}}
                                        {{--                                                    <td>Jumlah tuntutan yang dibayar (RM)</td>--}}
                                        {{--                                                    <td>:</td>--}}
                                        {{--                                                    <td>{{number_format($tuntutan->yuran_dibayar + $tuntutan->wang_saku_dibayar, 2)}}</td>--}}
                                        {{--                                                </tr>--}}
                                        <tr>
                                            <td>Catatan</td>
                                            <td>:</td>
                                            <td>{{$saringan->catatan}}</td>
                                        </tr>
                                        <tr>
                                            <td>Keputusan Akhir</td>
                                            <td>:</td>
                                            <td>{{ucwords(strtolower($status_tuntutan))}}</td>
                                        </tr>
                                    </table>
                                </div>
                            @elseif($permohonan->program == "BKOKU" && $tuntutan->yuran == NULL)
                                @php
                                    if($tuntutan->amaun_wang_saku == null){
                                        $tuntutan->amaun_wang_saku = 0;
                                    }
                                    $jumlah = $tuntutan->amaun_wang_saku;
                                @endphp
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                        <tr>
                                            <th class="border-top-0 pr-0 py-4 font-size-h6 font-weight-boldest bold white">Jenis Tuntutan</th>
                                            <th class="th-yellow border-top-0 pr-0 py-4 font-size-h6 font-weight-boldest bold white">Dituntut (RM)</th>
                                            <th class="th-green border-top-0 pr-0 py-4 font-size-h6 font-weight-boldest bold white">Disokong (RM)</th>
                                            {{--                                                    <th class="th-green border-top-0 pr-0 py-4 font-size-h6 font-weight-boldest bold white">Dibayar (RM)</th>--}}
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr class="font-weight-bolder font-size-lg">
                                            <td class="border-top-0 pr-0 py-4 font-size-h6 font-weight-boldest">Wang Saku</td>
                                            <td class="border-top-0 pr-0 py-4 font-size-h6 font-weight-boldest text-right">{{number_format($tuntutan->amaun_wang_saku, 2)}}</td>
                                            <td class="border-top-0 pr-0 py-4 font-size-h6 font-weight-boldest text-right">{{number_format($tuntutan->wang_saku_disokong, 2)}}</td>
                                            {{--                                                    <td class="border-top-0 pr-0 py-4 font-size-h6 font-weight-boldest text-right">{{number_format($tuntutan->wang_saku_dibayar, 2)}}</td>--}}
                                        </tr>
                                        </tbody>
                                    </table>
                                    <table class="maklumat2">
                                        <tr>
                                            <td>Jumlah tuntutan yang disokong (RM)</td>
                                            <td>:</td>
                                            <td>{{number_format($tuntutan->wang_saku_disokong, 2)}}</td>
                                        </tr>
                                        <tr>
                                            <td>Catatan</td>
                                            <td>:</td>
                                            <td>{{$saringan->catatan}}</td>
                                        </tr>
                                        <tr>
                                            <td>Keputusan Akhir</td>
                                            <td>:</td>
                                            <td>{{ucwords(strtolower($status_tuntutan))}}</td>
                                        </tr>
                                    </table>
                                </div>
                            @elseif($permohonan->program == "BKOKU" && $tuntutan->wang_saku == NULL)
                                @php
                                    $yuran = 0;
                                    foreach ($tuntutan_item as $item){
                                        if($item['amaun'] == null){
                                            $item['amaun'] = 0;
                                            $yuran = $yuran + $item['amaun'];
                                        }
                                        else{
                                            $yuran = $yuran + $item['amaun'];
                                        }
                                    }
                                    $jumlah = $yuran;
                                    $baki_y = $baki_terdahulu - $jumlah;
                                @endphp
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                        <tr>
                                            <th class="border-top-0 pr-0 py-4 font-size-h6 font-weight-boldest bold white">Jenis Tuntutan</th>
                                            <th class="th-yellow border-top-0 pr-0 py-4 font-size-h6 font-weight-boldest bold white">Dituntut (RM)</th>
                                            <th class="th-yellow border-top-0 pr-0 py-4 font-size-h6 font-weight-boldest bold white">Baki (RM)</th>
                                            <th class="th-green border-top-0 pr-0 py-4 font-size-h6 font-weight-boldest bold white">Disokong (RM)</th>
                                            <th class="th-green border-top-0 pr-0 py-4 font-size-h6 font-weight-boldest bold white">Baki (RM)</th>
                                            {{--                                                    <th class="th-green border-top-0 pr-0 py-4 font-size-h6 font-weight-boldest bold white">Dibayar (RM)</th>--}}
                                            {{--                                                    <th class="th-green border-top-0 pr-0 py-4 font-size-h6 font-weight-boldest bold white">Baki (RM)</th>--}}
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr class="font-weight-bolder font-size-lg">
                                            <td class="border-top-0 pr-0 py-4 font-size-h6 font-weight-boldest">Yuran Pengajian</td>
                                            <td class="border-top-0 pr-0 py-4 font-size-h6 font-weight-boldest text-right">{{number_format($yuran, 2)}}</td>
                                            <td class="border-top-0 pr-0 py-4 font-size-h6 font-weight-boldest text-right">{{number_format($baki_y, 2)}}</td>
                                            <td class="border-top-0 pr-0 py-4 font-size-h6 font-weight-boldest text-right">{{number_format($tuntutan->yuran_disokong, 2)}}</td>
                                            <td class="border-top-0 pr-0 py-4 font-size-h6 font-weight-boldest text-right">{{number_format($tuntutan->baki_disokong, 2)}}</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                    <table class="maklumat2">
                                        <tr>
                                            <td>Jumlah tuntutan yang disokong (RM)</td>
                                            <td>:</td>
                                            <td>{{number_format($tuntutan->yuran_disokong, 2)}}</td>
                                        </tr>
                                        <tr>
                                            <td>Catatan</td>
                                            <td>:</td>
                                            <td>{{$saringan->catatan}}</td>
                                        </tr>
                                        <tr>
                                            <td>Keputusan Akhir</td>
                                            <td>:</td>
                                            <td>{{ucwords(strtolower($status_tuntutan))}}</td>
                                        </tr>
                                    </table>
                                </div>
                            @elseif($permohonan->program == "PPK")
                                @php
                                    if($tuntutan->amaun_wang_saku == null){
                                        $tuntutan->amaun_wang_saku = 0;
                                    }
                                    $jumlah = $tuntutan->amaun_wang_saku;
                                @endphp
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                        <tr>
                                            <th class="border-top-0 pr-0 py-4 font-size-h6 font-weight-boldest bold white">Jenis Tuntutan</th>
                                            <th class="th-yellow border-top-0 pr-0 py-4 font-size-h6 font-weight-boldest bold white">Dituntut (RM)</th>
                                            <th class="th-green border-top-0 pr-0 py-4 font-size-h6 font-weight-boldest bold white">Disokong (RM)</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr class="font-weight-bolder font-size-lg">
                                            <td class="border-top-0 pr-0 py-4 font-size-h6 font-weight-boldest">Wang Saku</td>
                                            <td class="border-top-0 pr-0 py-4 font-size-h6 font-weight-boldest text-right">{{number_format($tuntutan->amaun_wang_saku, 2)}}</td>
                                            <td class="border-top-0 pr-0 py-4 font-size-h6 font-weight-boldest text-right">{{number_format($tuntutan->wang_saku_disokong, 2)}}</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                    <table class="maklumat2">
                                        <tr>
                                            <td>Jumlah tuntutan yang disokong (RM)</td>
                                            <td>:</td>
                                            <td>{{number_format($tuntutan->wang_saku_disokong, 2)}}</td>
                                        </tr>
                                        <tr>
                                            <td>Catatan</td>
                                            <td>:</td>
                                            <td>{{$saringan->catatan}}</td>
                                        </tr>
                                        <tr>
                                            <td>Keputusan Akhir</td>
                                            <td>:</td>
                                            <td>{{ucwords(strtolower($status_tuntutan))}}</td>
                                        </tr>
                                    </table>
                                </div>
                            @endif
                            <!--end: Invoice body-->
                            <div class="col-md-6 text-right">
                                <a href="{{ url('tuntutan/sekretariat/saringan/senarai-tuntutan') }}" class="white"><button class="btn btn-primary theme-bg gradient action-btn" value="Simpan" id="check">Teruskan </button></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</x-default-layout>


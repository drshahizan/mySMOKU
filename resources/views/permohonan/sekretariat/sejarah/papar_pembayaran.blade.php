<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" {!! printHtmlAttributes('html') !!}>
<!--begin::Head-->
<head>
    <title>{{ config('app.name', 'SistemBKOKU') }}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <meta property="og:type" content="article"/>
    <link rel="stylesheet" href="/assets/css/style.bundle.css">
    <link rel="stylesheet" href="/assets/css/saringan.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
</head>
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
        width: 90%;
        table-layout: fixed;
        margin-left:5px!important;
    }
    h6{
        margin-left:5px!important;
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
        width: 70px;
        text-align: right;
        border: 1px solid #ccc;
        border-radius: 6px;
        padding: 2px 5px;
        font-size: 13px!important;
    }
    select{
        width: 230px!important;
        padding: 3px 6px!important;
        border: 1px solid #ccc!important;
        border-radius: 6px!important;
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
    .my-btn{
        width:100px!important;
    }
    .bi bi-pen-fill{
        color: black!important;
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
        <!--begin::Item-->
        <li class="breadcrumb-item">
            <span class="bullet bg-gray-400 w-5px h-2px"></span>
        </li>
        <!--end::Item-->
        <!--begin::Item-->
        <li class="breadcrumb-item text-dark" style="color:darkblue">Maklumat Pembayaran</li>
        <!--end::Item-->
    </ul>
    <!--end::Breadcrumb-->
</div>
<!--end::Page title-->
<br>

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
                            <li class="nav-item vivify swoopInTop delay-150 active"><b>Maklumat Pembayaran</b></li>
                        </ul>
                    </div>
                </nav>
            </div>
            <div class="col-lg-12">
                <div class="card">
                    <div class="body">
                        <div class="col-md-6 col-sm-6">
                            <br>
                            @php
                                $peringkat = DB::table('bk_peringkat_pengajian')->where('kod_peringkat', $akademik->peringkat_pengajian)->value('peringkat');
                                $nama_institusi = DB::table('bk_info_institusi')->where('id_institusi', $akademik->id_institusi)->value('nama_institusi');
                                $nama_penaja = DB::table('bk_penaja')->where('id', $akademik->nama_penaja)->value('penaja');
                                $tkh_bayaran = DB::table('sejarah_permohonan')->where('id', $sejarah_p->id)->value('created_at');
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
                            @endphp
                            
                            <table class="maklumat">
                                <tr>
                                    <td><strong>ID Tuntutan</strong></td>
                                    <td>:</td>
                                    <td>{{$permohonan->no_rujukan_permohonan}}</td>
                                    <td class="space">&nbsp;</td>
                                    <td><strong>Kursus</strong></td>
                                    <td>:</td>
                                    <td>{{$akademik->nama_kursus}}</td>
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
                                    <td>{{date('d/m/Y', strtotime($permohonan->tarikh_hantar))}}</td>
                                    <td class="space">&nbsp;</td>
                                    <td><strong>Sesi/Semester</strong></td>
                                    <td>:</td>
                                    <td>{{$akademik->sesi}}-0{{$akademik->sem_semasa}}</td>
                                </tr>
                                <tr>
                                    <td><strong>Status Penajaan</strong></td>
                                    <td>:</td>
                                    @if($akademik->nama_penaja!=null)
                                        <td>Ditaja ({{$nama_penaja}})</td>
                                    @else
                                        <td>Tidak Ditaja</td>
                                    @endif
                                    <td class="space">&nbsp;</td>
                                    <td><strong>Tarikh Bayaran</strong></td>
                                    <td>:</td>
                                    <td>{{date('d/m/Y', strtotime($tkh_bayaran))}}</td>
                                </tr>
                            </table>
                            <hr>
                            <!--begin: Invoice body-->
                            @if($permohonan->program == "BKOKU" && $permohonan->yuran == "1" && $permohonan->wang_saku == "1")
                                @php
                                    if($permohonan->amaun_yuran == null){
                                        $permohonan->amaun_yuran = 0;
                                    }
                                    if($permohonan->amaun_wang_saku == null){
                                        $permohonan->amaun_wang_saku = 0;
                                    }
                                    if($permohonan->yuran_dibayar == null){
                                        $permohonan->yuran_dibayar = $permohonan->yuran_disokong;
                                    }
                                    if($permohonan->wang_saku_dibayar == null){
                                        $permohonan->wang_saku_dibayar = $permohonan->wang_saku_disokong;
                                    }
                                    if($permohonan->baki_dibayar == null){
                                        $permohonan->baki_dibayar = $permohonan->baki_disokong;
                                    }
                                    $jumlah = $permohonan->amaun_yuran + $permohonan->amaun_wang_saku;
                                    $baki_y = 5000 - $jumlah;
                                @endphp
                                <br>
                                <h6>Pengiraan:</h6>
                                <br>
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                        <tr>
                                            <th class="border-top-0 pr-0 py-4 font-size-h6 font-weight-boldest bold white">Jenis Tuntutan</th>
                                            <th class="th-yellow border-top-0 pr-0 py-4 font-size-h6 font-weight-boldest bold white">Dituntut (RM)</th>
                                            <th class="th-yellow border-top-0 pr-0 py-4 font-size-h6 font-weight-boldest bold white">Baki (RM)</th>
                                            <th class="th-green border-top-0 pr-0 py-4 font-size-h6 font-weight-boldest bold white">Disokong (RM)</th>
                                            <th class="th-green border-top-0 pr-0 py-4 font-size-h6 font-weight-boldest bold white">Baki (RM)</th>
                                            <th class="th-green border-top-0 pr-0 py-4 font-size-h6 font-weight-boldest bold white">Dibayar (RM)</th>
                                            <th class="th-green border-top-0 pr-0 py-4 font-size-h6 font-weight-boldest bold white">Baki (RM)</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr class="font-weight-bolder font-size-lg">
                                            <td class="border-top-0 pr-0 py-4 font-size-h6 font-weight-boldest">Yuran Pengajian</td>
                                            <td class="border-top-0 pr-0 py-4 font-size-h6 font-weight-boldest text-right">{{number_format($permohonan->amaun_yuran, 2)}}</td>
                                            <td class="border-top-0 pr-0 py-4 font-size-h6 font-weight-boldest text-right">{{number_format($baki_y, 2)}}</td>
                                            <td class="border-top-0 pr-0 py-4 font-size-h6 font-weight-boldest text-right">{{number_format($permohonan->yuran_disokong, 2)}}</td>
                                            <td class="border-top-0 pr-0 py-4 font-size-h6 font-weight-boldest text-right">{{number_format($permohonan->baki_disokong, 2)}}</td>
                                            <td class="border-top-0 pr-0 py-4 font-size-h6 font-weight-boldest text-right">{{number_format($permohonan->yuran_dibayar, 2)}}</td>
                                            <td class="border-top-0 pr-0 py-4 font-size-h6 font-weight-boldest text-right">{{number_format($permohonan->baki_dibayar, 2)}}</td>
                                        </tr>
                                        <tr class="font-weight-bolder font-size-lg">
                                            <td class="border-top-0 pr-0 py-4 font-size-h6 font-weight-boldest">Wang Saku</td>
                                            <td class="border-top-0 pr-0 py-4 font-size-h6 font-weight-boldest text-right">{{number_format($permohonan->amaun_wang_saku, 2)}}</td>
                                            <td class="border-top-0 pr-0 py-4 font-size-h6 font-weight-boldest text-right">{{number_format(0, 2)}}</td>
                                            <td class="border-top-0 pr-0 py-4 font-size-h6 font-weight-boldest text-right">{{number_format($permohonan->wang_saku_disokong, 2)}}</td>
                                            <td class="border-top-0 pr-0 py-4 font-size-h6 font-weight-boldest text-right">{{number_format(0, 2)}}</td>
                                            <td class="border-top-0 pr-0 py-4 font-size-h6 font-weight-boldest text-right">{{number_format($permohonan->wang_saku_dibayar, 2)}}</td>
                                            <td class="border-top-0 pr-0 py-4 font-size-h6 font-weight-boldest text-right">{{number_format(0, 2)}}</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                    <table class="maklumat2">
                                        <tr>
                                            <td>Jumlah tuntutan yang disokong (RM)</td>
                                            <td>:</td>
                                            <td>{{number_format($permohonan->yuran_disokong + $permohonan->wang_saku_disokong, 2)}}</td>
                                        </tr>
                                        <tr>
                                            <td>Jumlah tuntutan yang dibayar (RM)</td>
                                            <td>:</td>
                                            <td>{{number_format($permohonan->yuran_dibayar + $permohonan->wang_saku_dibayar, 2)}}</td>
                                        </tr>
                                        <tr>
                                            <td class="vertical-top">Catatan</td>
                                            <td class="vertical-top">:</td>
                                            <td class="vertical-top">{{$permohonan->catatan_dibayar}}</td>
                                        </tr>
                                    </table>
                                </div>
                            @elseif($permohonan->program == "BKOKU" && $permohonan->yuran == NULL)
                                @php
                                    if($permohonan->amaun_wang_saku == null){
                                        $permohonan->amaun_wang_saku = 0;
                                    }
                                    if($permohonan->wang_saku_dibayar == null){
                                        $permohonan->wang_saku_dibayar = $permohonan->wang_saku_disokong;
                                    }
                                    if($permohonan->baki_dibayar == null){
                                        $permohonan->baki_dibayar = $permohonan->baki_disokong;
                                    }
                                    $jumlah = $permohonan->amaun_wang_saku;
                                @endphp
                                <br>
                                <h6>Pengiraan:</h6>
                                <br>
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                        <tr>
                                            <th class="border-top-0 pr-0 py-4 font-size-h6 font-weight-boldest bold white">Jenis Tuntutan</th>
                                            <th class="th-yellow border-top-0 pr-0 py-4 font-size-h6 font-weight-boldest bold white">Dituntut (RM)</th>
                                            <th class="th-green border-top-0 pr-0 py-4 font-size-h6 font-weight-boldest bold white">Disokong (RM)</th>
                                            <th class="th-green border-top-0 pr-0 py-4 font-size-h6 font-weight-boldest bold white">Dibayar (RM)</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr class="font-weight-bolder font-size-lg">
                                            <td class="border-top-0 pr-0 py-4 font-size-h6 font-weight-boldest">Wang Saku</td>
                                            <td class="border-top-0 pr-0 py-4 font-size-h6 font-weight-boldest text-right">{{number_format($permohonan->amaun_wang_saku, 2)}}</td>
                                            <td class="border-top-0 pr-0 py-4 font-size-h6 font-weight-boldest text-right">{{number_format($permohonan->wang_saku_disokong, 2)}}</td>
                                            <td class="border-top-0 pr-0 py-4 font-size-h6 font-weight-boldest text-right">{{number_format($permohonan->wang_saku_dibayar, 2)}}</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                    <table class="maklumat2">
                                        <tr>
                                            <td>Jumlah tuntutan yang disokong (RM)</td>
                                            <td>:</td>
                                            <td>{{number_format($permohonan->wang_saku_disokong, 2)}}</td>
                                        </tr>
                                        <tr>
                                            <td>Jumlah tuntutan yang dibayar (RM)</td>
                                            <td>:</td>
                                            <td>{{number_format($permohonan->wang_saku_dibayar, 2)}}</td>
                                        </tr>
                                        <tr>
                                            <td class="vertical-top">Catatan</td>
                                            <td class="vertical-top">:</td>
                                            <td class="vertical-top">{{$permohonan->catatan_dibayar}}</td>
                                        </tr>
                                    </table>
                                </div>
                            @elseif($permohonan->program == "BKOKU" && $permohonan->wang_saku == NULL)
                                @php
                                    if($permohonan->amaun_yuran == null){
                                        $permohonan->amaun_yuran = 0;
                                    }
                                    if($permohonan->yuran_dibayar == null){
                                        $permohonan->yuran_dibayar = $permohonan->yuran_disokong;
                                    }
                                    if($permohonan->baki_dibayar == null){
                                        $permohonan->baki_dibayar = $permohonan->baki_disokong;
                                    }
                                    $jumlah = $permohonan->amaun_yuran + $permohonan->amaun_wang_saku;
                                    $baki_y = 5000 - $jumlah;
                                @endphp
                                <br>
                                <h6>Pengiraan:</h6>
                                <br>
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                        <tr>
                                            <th class="border-top-0 pr-0 py-4 font-size-h6 font-weight-boldest bold white">Jenis Tuntutan</th>
                                            <th class="th-yellow border-top-0 pr-0 py-4 font-size-h6 font-weight-boldest bold white">Dituntut (RM)</th>
                                            <th class="th-yellow border-top-0 pr-0 py-4 font-size-h6 font-weight-boldest bold white">Baki (RM)</th>
                                            <th class="th-green border-top-0 pr-0 py-4 font-size-h6 font-weight-boldest bold white">Disokong (RM)</th>
                                            <th class="th-green border-top-0 pr-0 py-4 font-size-h6 font-weight-boldest bold white">Baki (RM)</th>
                                            <th class="th-green border-top-0 pr-0 py-4 font-size-h6 font-weight-boldest bold white">Dibayar (RM)</th>
                                            <th class="th-green border-top-0 pr-0 py-4 font-size-h6 font-weight-boldest bold white">Baki (RM)</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr class="font-weight-bolder font-size-lg">
                                            <td class="border-top-0 pr-0 py-4 font-size-h6 font-weight-boldest">Yuran Pengajian</td>
                                            <td class="border-top-0 pr-0 py-4 font-size-h6 font-weight-boldest text-right">{{number_format($permohonan->amaun_yuran, 2)}}</td>
                                            <td class="border-top-0 pr-0 py-4 font-size-h6 font-weight-boldest text-right">{{number_format($baki_y, 2)}}</td>
                                            <td class="border-top-0 pr-0 py-4 font-size-h6 font-weight-boldest text-right">{{number_format($permohonan->yuran_disokong, 2)}}</td>
                                            <td class="border-top-0 pr-0 py-4 font-size-h6 font-weight-boldest text-right">{{number_format($permohonan->baki_disokong, 2)}}</td>
                                            <td class="border-top-0 pr-0 py-4 font-size-h6 font-weight-boldest text-right">{{number_format($permohonan->yuran_dibayar, 2)}}</td>
                                            <td class="border-top-0 pr-0 py-4 font-size-h6 font-weight-boldest text-right">{{number_format($permohonan->baki_dibayar, 2)}}</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                    <table class="maklumat2">
                                        <tr>
                                            <td>Jumlah tuntutan yang disokong (RM)</td>
                                            <td>:</td>
                                            <td>{{number_format($permohonan->yuran_disokong, 2)}}</td>
                                        </tr>
                                        <tr>
                                            <td>Jumlah tuntutan yang dibayar (RM)</td>
                                            <td>:</td>
                                            <td>{{number_format($permohonan->yuran_dibayar, 2)}}</td>
                                        </tr>
                                        <tr>
                                            <td class="vertical-top">Catatan</td>
                                            <td class="vertical-top">:</td>
                                            <td class="vertical-top">{{$permohonan->catatan_dibayar}}</td>
                                        </tr>
                                    </table>
                                </div>
                            @elseif($permohonan->program == "PPK")
                                @php
                                    if($permohonan->amaun_wang_saku == null){
                                        $permohonan->amaun_wang_saku = 0;
                                    }
                                    if($permohonan->wang_saku_dibayar == null){
                                        $permohonan->wang_saku_dibayar = $permohonan->wang_saku_disokong;
                                    }
                                    if($permohonan->baki_dibayar == null){
                                        $permohonan->baki_dibayar = $permohonan->baki_disokong;
                                    }
                                    $jumlah = $permohonan->amaun_wang_saku;
                                @endphp
                                <br>
                                <h6>Pengiraan:</h6>
                                <br>
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                        <tr>
                                            <th class="border-top-0 pr-0 py-4 font-size-h6 font-weight-boldest bold white">Jenis Tuntutan</th>
                                            <th class="th-yellow border-top-0 pr-0 py-4 font-size-h6 font-weight-boldest bold white">Dituntut (RM)</th>
                                            <th class="th-green border-top-0 pr-0 py-4 font-size-h6 font-weight-boldest bold white">Disokong (RM)</th>
                                            <th class="th-green border-top-0 pr-0 py-4 font-size-h6 font-weight-boldest bold white">Dibayar (RM)</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr class="font-weight-bolder font-size-lg">
                                            <td class="border-top-0 pr-0 py-4 font-size-h6 font-weight-boldest">Wang Saku</td>
                                            <td class="border-top-0 pr-0 py-4 font-size-h6 font-weight-boldest text-right">{{number_format($permohonan->amaun_wang_saku, 2)}}</td>
                                            <td class="border-top-0 pr-0 py-4 font-size-h6 font-weight-boldest text-right">{{number_format($permohonan->wang_saku_disokong, 2)}}</td>
                                            <td class="border-top-0 pr-0 py-4 font-size-h6 font-weight-boldest text-right">{{number_format($permohonan->wang_saku_dibayar, 2)}}</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                    <table class="maklumat2">
                                        <tr>
                                            <td>Jumlah tuntutan yang disokong (RM)</td>
                                            <td>:</td>
                                            <td>{{number_format($permohonan->wang_saku_disokong, 2)}}</td>
                                        </tr>
                                        <tr>
                                            <td>Jumlah tuntutan yang dibayar (RM)</td>
                                            <td>:</td>
                                            <td>{{number_format($permohonan->wang_saku_dibayar, 2)}}</td>
                                        </tr>
                                        <tr>
                                            <td class="vertical-top">Catatan</td>
                                            <td class="vertical-top">:</td>
                                            <td class="vertical-top">{{$permohonan->catatan_dibayar}}</td>
                                        </tr>
                                    </table>
                                </div>
                            @endif
                            <!--end: Invoice body-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</html>

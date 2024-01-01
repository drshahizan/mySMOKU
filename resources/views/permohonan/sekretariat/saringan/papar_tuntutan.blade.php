<x-default-layout>
    <link rel="stylesheet" href="/assets/css/saringan.css">
    <style>
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
        textarea{
            border: 1px solid #ccc;
            border-radius: 6px;
            padding: 2px 5px;
            font-size: 13px!important;
        }
        .vertical-top{
            vertical-align: top!important;
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
			<li class="breadcrumb-item text-dark" style="color:darkblue">Saringan</li>
			<!--end::Item-->
            <!--begin::Item-->
			<li class="breadcrumb-item">
				<span class="bullet bg-gray-400 w-5px h-2px"></span>
			</li>
			<!--end::Item-->
			<!--begin::Item-->
			<li class="breadcrumb-item text-dark" style="color:darkblue">Maklumat Permohonan</li>
			<!--end::Item-->
            <!--begin::Item-->
			<li class="breadcrumb-item">
				<span class="bullet bg-gray-400 w-5px h-2px"></span>
			</li>
			<!--end::Item-->
			<!--begin::Item-->
			<li class="breadcrumb-item text-dark" style="color:darkblue">Maklumat Tuntutan</li>
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
                                <li class="nav-item vivify swoopInTop delay-150 active"><b>Maklumat Tuntutan</b></li>
                            </ul>
                            <div class="ml-auto">
                                <a href="{{url('permohonan/sekretariat/saringan/kemaskini-saringan/'.$permohonan->id)}}">
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
                                        if($permohonan->status==4){
                                            $tarikh_status = DB::table('sejarah_permohonan')->where('permohonan_id', $permohonan->id)->where('status', 4)->value('created_at');
                                        }
                                        elseif($permohonan->status==5){
                                            $tarikh_status = DB::table('sejarah_permohonan')->where('permohonan_id',$permohonan->id)->where('status', 5)->value('created_at');
                                        }
                                        $status = DB::table('bk_status')->where('kod_status', $permohonan->status)->value('status');
                                        $peringkat = DB::table('bk_peringkat_pengajian')->where('kod_peringkat', $akademik->peringkat_pengajian)->value('peringkat');
                                        $nama_institusi = DB::table('bk_info_institusi')->where('id_institusi', $akademik->id_institusi)->value('nama_institusi');
                                        $nama_penaja = DB::table('bk_penaja')->where('id', $akademik->nama_penaja)->value('penaja');
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
                                            <td>{{$permohonan->no_rujukan_permohonan}}</td>
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
                                            <td>{{$institusi}}</td>
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
                                            <td><strong>Status</strong></td>
                                            <td>:</td>
                                            <td>{{ucwords(strtolower($status))}} ({{date('d/m/Y', strtotime($tarikh_status))}})</td>
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
                                                $jumlah = $permohonan->amaun_yuran + $permohonan->amaun_wang_saku;
                                                $baki_y = $j_tuntutan->jumlah - $jumlah;
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
{{--                                                        <th class="th-green border-top-0 pr-0 py-4 font-size-h6 font-weight-boldest bold white">Dibayar (RM)</th>--}}
{{--                                                        <th class="th-green border-top-0 pr-0 py-4 font-size-h6 font-weight-boldest bold white">Baki (RM)</th>--}}
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <tr class="font-weight-bolder font-size-lg">
                                                        <td class="border-top-0 pr-0 py-4 font-size-h6 font-weight-boldest">Yuran Pengajian</td>
                                                        <td class="border-top-0 pr-0 py-4 font-size-h6 font-weight-boldest text-right">{{number_format($permohonan->amaun_yuran, 2)}}</td>
                                                        <td class="border-top-0 pr-0 py-4 font-size-h6 font-weight-boldest text-right">{{number_format($baki_y, 2)}}</td>
                                                        <td class="border-top-0 pr-0 py-4 font-size-h6 font-weight-boldest text-right">{{number_format($permohonan->yuran_disokong, 2)}}</td>
                                                        <td class="border-top-0 pr-0 py-4 font-size-h6 font-weight-boldest text-right">{{number_format($j_tuntutan->jumlah - $permohonan->yuran_disokong - $permohonan->wang_saku_disokong, 2)}}</td>
{{--                                                        <td class="border-top-0 pr-0 py-4 font-size-h6 font-weight-boldest text-right">{{number_format($permohonan->yuran_dibayar, 2)}}</td>--}}
{{--                                                        <td class="border-top-0 pr-0 py-4 font-size-h6 font-weight-boldest text-right">{{number_format($j_tuntutan->jumlah - $permohonan->yuran_dibayar - $permohonan->wang_saku_dibayar, 2)}}</td>--}}
                                                    </tr>
                                                    <tr class="font-weight-bolder font-size-lg">
                                                        <td class="border-top-0 pr-0 py-4 font-size-h6 font-weight-boldest">Wang Saku</td>
                                                        <td class="border-top-0 pr-0 py-4 font-size-h6 font-weight-boldest text-right">{{number_format($permohonan->amaun_wang_saku, 2)}}</td>
                                                        <td class="border-top-0 pr-0 py-4 font-size-h6 font-weight-boldest text-right">{{number_format(0, 2)}}</td>
                                                        <td class="border-top-0 pr-0 py-4 font-size-h6 font-weight-boldest text-right">{{number_format($permohonan->wang_saku_disokong, 2)}}</td>
                                                        <td class="border-top-0 pr-0 py-4 font-size-h6 font-weight-boldest text-right">{{number_format(0, 2)}}</td>
{{--                                                        <td class="border-top-0 pr-0 py-4 font-size-h6 font-weight-boldest text-right">{{number_format($permohonan->wang_saku_dibayar, 2)}}</td>--}}
{{--                                                        <td class="border-top-0 pr-0 py-4 font-size-h6 font-weight-boldest text-right">{{number_format(0, 2)}}</td>--}}
                                                    </tr>
                                                    </tbody>
                                                </table>
                                                <table class="maklumat2">
                                                    <tr>
                                                        <td>Jumlah tuntutan yang disokong (RM)</td>
                                                        <td>:</td>
                                                        <td>{{number_format($permohonan->yuran_disokong + $permohonan->wang_saku_disokong, 2)}}</td>
                                                    </tr>
{{--                                                    <tr>--}}
{{--                                                        <td>Jumlah tuntutan yang dibayar (RM)</td>--}}
{{--                                                        <td>:</td>--}}
{{--                                                        <td>{{number_format($permohonan->yuran_dibayar + $permohonan->wang_saku_dibayar, 2)}}</td>--}}
{{--                                                    </tr>--}}
                                                    <tr>
                                                        <td class="vertical-top">Catatan</td>
                                                        <td class="vertical-top">:</td>
                                                        <td class="vertical-top">{{$permohonan->catatan_disokong}}</td>
                                                    </tr>
                                                </table>
                                            </div>
                                        @elseif($permohonan->program == "BKOKU" && $permohonan->yuran == NULL)
                                            @php
                                                if($permohonan->amaun_wang_saku == null){
                                                    $permohonan->amaun_wang_saku = 0;
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
{{--                                                        <th class="th-green border-top-0 pr-0 py-4 font-size-h6 font-weight-boldest bold white">Dibayar (RM)</th>--}}
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <tr class="font-weight-bolder font-size-lg">
                                                        <td class="border-top-0 pr-0 py-4 font-size-h6 font-weight-boldest">Wang Saku</td>
                                                        <td class="border-top-0 pr-0 py-4 font-size-h6 font-weight-boldest text-right">{{number_format($permohonan->amaun_wang_saku, 2)}}</td>
                                                        <td class="border-top-0 pr-0 py-4 font-size-h6 font-weight-boldest text-right">{{number_format($permohonan->wang_saku_disokong, 2)}}</td>
{{--                                                        <td class="border-top-0 pr-0 py-4 font-size-h6 font-weight-boldest text-right">{{number_format($permohonan->wang_saku_dibayar, 2)}}</td>--}}
                                                    </tr>
                                                    </tbody>
                                                </table>
                                                <table class="maklumat2">
                                                    <tr>
                                                        <td>Jumlah tuntutan yang disokong (RM)</td>
                                                        <td>:</td>
                                                        <td>{{number_format($permohonan->wang_saku_disokong, 2)}}</td>
                                                    </tr>
{{--                                                    <tr>--}}
{{--                                                        <td>Jumlah tuntutan yang dibayar (RM)</td>--}}
{{--                                                        <td>:</td>--}}
{{--                                                        <td>{{number_format($permohonan->wang_saku_dibayar, 2)}}</td>--}}
{{--                                                    </tr>--}}
                                                    <tr>
                                                        <td class="vertical-top">Catatan</td>
                                                        <td class="vertical-top">:</td>
                                                        <td class="vertical-top">{{$permohonan->catatan_disokong}}</td>
                                                    </tr>
                                                </table>
                                            </div>
                                        @elseif($permohonan->program == "BKOKU" && $permohonan->wang_saku == NULL)
                                            @php
                                                if($permohonan->amaun_yuran == null){
                                                    $permohonan->amaun_yuran = 0;
                                                }
                                                $jumlah = $permohonan->amaun_yuran + $permohonan->amaun_wang_saku;
                                                $baki_y = $j_tuntutan->jumlah - $jumlah;
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
{{--                                                        <th class="th-green border-top-0 pr-0 py-4 font-size-h6 font-weight-boldest bold white">Dibayar (RM)</th>--}}
{{--                                                        <th class="th-green border-top-0 pr-0 py-4 font-size-h6 font-weight-boldest bold white">Baki (RM)</th>--}}
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <tr class="font-weight-bolder font-size-lg">
                                                        <td class="border-top-0 pr-0 py-4 font-size-h6 font-weight-boldest">Yuran Pengajian</td>
                                                        <td class="border-top-0 pr-0 py-4 font-size-h6 font-weight-boldest text-right">{{number_format($permohonan->amaun_yuran, 2)}}</td>
                                                        <td class="border-top-0 pr-0 py-4 font-size-h6 font-weight-boldest text-right">{{number_format($baki_y, 2)}}</td>
                                                        <td class="border-top-0 pr-0 py-4 font-size-h6 font-weight-boldest text-right">{{number_format($permohonan->yuran_disokong, 2)}}</td>
                                                        <td class="border-top-0 pr-0 py-4 font-size-h6 font-weight-boldest text-right">{{number_format($j_tuntutan->jumlah - $permohonan->yuran_disokong, 2)}}</td>
{{--                                                        <td class="border-top-0 pr-0 py-4 font-size-h6 font-weight-boldest text-right">{{number_format($permohonan->yuran_dibayar, 2)}}</td>--}}
{{--                                                        <td class="border-top-0 pr-0 py-4 font-size-h6 font-weight-boldest text-right">{{number_format($j_tuntutan->jumlah - $permohonan->yuran_dibayar, 2)}}</td>--}}
                                                    </tr>
                                                    </tbody>
                                                </table>
                                                <table class="maklumat2">
                                                    <tr>
                                                        <td>Jumlah tuntutan yang disokong (RM)</td>
                                                        <td>:</td>
                                                        <td>{{number_format($permohonan->yuran_disokong, 2)}}</td>
                                                    </tr>
{{--                                                    <tr>--}}
{{--                                                        <td>Jumlah tuntutan yang dibayar (RM)</td>--}}
{{--                                                        <td>:</td>--}}
{{--                                                        <td>{{number_format($permohonan->yuran_dibayar, 2)}}</td>--}}
{{--                                                    </tr>--}}
                                                    <tr>
                                                        <td class="vertical-top">Catatan</td>
                                                        <td class="vertical-top">:</td>
                                                        <td class="vertical-top">{{$permohonan->catatan_disokong}}</td>
                                                    </tr>
                                                </table>
                                            </div>
                                        @elseif($permohonan->program == "PPK")
                                            @php
                                                if($permohonan->amaun_wang_saku == null){
                                                    $permohonan->amaun_wang_saku = 0;
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
{{--                                                        <th class="th-green border-top-0 pr-0 py-4 font-size-h6 font-weight-boldest bold white">Dibayar (RM)</th>--}}
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <tr class="font-weight-bolder font-size-lg">
                                                        <td class="border-top-0 pr-0 py-4 font-size-h6 font-weight-boldest">Wang Saku</td>
                                                        <td class="border-top-0 pr-0 py-4 font-size-h6 font-weight-boldest text-right">{{number_format($permohonan->amaun_wang_saku, 2)}}</td>
                                                        <td class="border-top-0 pr-0 py-4 font-size-h6 font-weight-boldest text-right">{{number_format($permohonan->wang_saku_disokong, 2)}}</td>
{{--                                                        <td class="border-top-0 pr-0 py-4 font-size-h6 font-weight-boldest text-right">{{number_format($permohonan->wang_saku_dibayar, 2)}}</td>--}}
                                                    </tr>
                                                    </tbody>
                                                </table>
                                                <table class="maklumat2">
                                                    <tr>
                                                        <td>Jumlah tuntutan yang disokong (RM)</td>
                                                        <td>:</td>
                                                        <td>{{number_format($permohonan->wang_saku_disokong, 2)}}</td>
                                                    </tr>
{{--                                                    <tr>--}}
{{--                                                        <td>Jumlah tuntutan yang dibayar (RM)</td>--}}
{{--                                                        <td>:</td>--}}
{{--                                                        <td>{{number_format($permohonan->wang_saku_dibayar, 2)}}</td>--}}
{{--                                                    </tr>--}}
                                                    <tr>
                                                        <td class="vertical-top">Catatan</td>
                                                        <td class="vertical-top">:</td>
                                                        <td class="vertical-top">{{$permohonan->catatan_disokong}}</td>
                                                    </tr>
                                                </table>
                                            </div>
                                        @endif
                                <!--end: Invoice body-->
                                <div class="col-md-6 text-right">
                                    <a href="{{ url('permohonan/sekretariat/saringan/senarai-permohonan') }}" class="white"><button class="btn btn-primary theme-bg gradient action-btn" value="Simpan" id="check">Teruskan </button></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-default-layout>

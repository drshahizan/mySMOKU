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
        textarea{
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
            width: 5%;
        }
        .red-color{
            color: red!important;
        }
        /* Clearfix (clear floats) */
        .row::after {
            content: "";
            clear: both;
            display: table;
        }
        .row {
            margin-left:-5px;
            margin-right:-5px;
        }

        .column {
            float: left;
            width: 50%;
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
                            {{-- <div class="ml-auto">
                                <a href="{{ url('cetak-maklumat-pemohon') }}" target="_blank" class="btn btn-primary">Cetak</a>
                            </div> --}}
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
                                            <td><strong>ID Permohonan</strong></td>
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
                                            <td>{{ ucwords(strtolower($peringkat))}}</td>
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
                                        </tr>
                                    </table>
                                <hr>
                                <td>
                                    <form method="POST" action="{{ url('permohonan/sekretariat/saringan/saring-tuntutan/'.$permohonan->id) }}" id="saring">
                                        {{csrf_field()}}
                                    @if($permohonan->program == "BKOKU" && $permohonan->yuran == "1" && $permohonan->wang_saku == "1")
                                        <!--begin: Invoice body-->
                                        @php
                                            if($permohonan->amaun_yuran == null){
                                                $permohonan->amaun_yuran = 0;
                                            }
                                            if($permohonan->amaun_wang_saku == null){
                                                $permohonan->amaun_wang_saku = 0;
                                            }
                                            $jumlah = $permohonan->amaun_yuran + $permohonan->amaun_wang_saku;
                                            $baki_y = $j_tuntutan->jumlah - $jumlah;
                                            if($permohonan->baki_disokong == null){
                                                $permohonan->baki_disokong = $baki_y;
                                            }
                                        @endphp
                                            <input type="hidden" name="j_tuntutan" id="j_tuntutan" value="{{$j_tuntutan->jumlah}}">
                                            <input type="hidden" name="baki" id="baki" value="{{$baki_y}}">
                                            <input type="hidden" name="baki_disokong" id="baki_disokong" value="{{$permohonan->baki_disokong}}">
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
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr class="font-weight-bolder font-size-lg">
                                                        <td class="border-top-0 pr-0 py-4 font-size-h6 font-weight-boldest">Yuran Pengajian</td>
                                                        <td class="border-top-0 pr-0 py-4 font-size-h6 font-weight-boldest text-right">{{number_format($permohonan->amaun_yuran, 2)}}</td>
                                                        <td class="border-top-0 pr-0 py-4 font-size-h6 font-weight-boldest text-right">{{number_format($baki_y, 2)}}</td>
                                                        <td class="border-top-0 pr-0 py-4 font-size-h6 font-weight-boldest text-right"><input type="number" step="0.01" name="yuran_disokong" id="yuran_disokong" value="{{number_format($permohonan->amaun_yuran, 2, '.', '')}}"></td>
                                                        <td class="border-top-0 pr-0 py-4 font-size-h6 font-weight-boldest text-right" id="y_baki_disokong">{{number_format($permohonan->baki_disokong, 2)}}</td>
                                                    </tr>
                                                    <tr class="font-weight-bolder font-size-lg">
                                                        <td class="border-top-0 pr-0 py-4 font-size-h6 font-weight-boldest">Wang Saku</td>
                                                        <td class="border-top-0 pr-0 py-4 font-size-h6 font-weight-boldest text-right">{{number_format($permohonan->amaun_wang_saku, 2)}}</td>
                                                        <td class="border-top-0 pr-0 py-4 font-size-h6 font-weight-boldest text-right">{{number_format(0, 2)}}</td>
                                                        <td class="border-top-0 pr-0 py-4 font-size-h6 font-weight-boldest text-right"><input type="number" step="0.01" name="w_saku_disokong" id="w_saku_disokong" value="{{number_format($permohonan->amaun_wang_saku, 2, '.', '')}}"></td>
                                                        <td class="border-top-0 pr-0 py-4 font-size-h6 font-weight-boldest text-right" id="w_baki_disokong">{{number_format(0, 2)}}</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                            <table class="maklumat2">
                                                <tr>
                                                    <td>Jumlah tuntutan yang disokong (RM)</td>
                                                    <td>:</td>
                                                    <td><input type="number" step="0.01" id="jumlah_disokong" name="jumlah_disokong" value="{{number_format($jumlah, 2, '.', '')}}" oninvalid="this.setCustomValidity('Sila isi ruang ini')" oninput="setCustomValidity('')" required></td>
                                                </tr>

                                                <tr>
                                                    <td class="vertical-top">Catatan</td>
                                                    <td class="vertical-top">:</td>
                                                    <td class="vertical-top"><textarea name="catatan" id="catatan" cols="30" rows="3"></textarea></td>
                                                </tr>
                                            </table>
                                        </div>
                                        <script>
                                            document.getElementById("yuran_disokong").addEventListener("input", SokongY);
                                            document.getElementById("w_saku_disokong").addEventListener("input", SokongY);
                                            function SokongY(){
                                                var yuran = document.getElementById('yuran_disokong').value;
                                                var j_tuntutan = document.getElementById('j_tuntutan').value;
                                                var w_saku = document.getElementById('w_saku_disokong').value;
                                                var baki = j_tuntutan - yuran - w_saku;
                                                var jumlah = parseFloat(w_saku) + parseFloat(yuran);
                                                baki = Number(parseFloat(baki).toFixed(2)).toLocaleString('en', {
                                                    minimumFractionDigits: 2
                                                });
                                                document.getElementById('y_baki_disokong').innerHTML = baki;
                                                document.getElementById('jumlah_disokong').value= parseFloat(jumlah).toFixed(2);
                                                document.getElementById('baki_disokong').value= j_tuntutan - yuran - w_saku;
                                            }
                                            
                                        </script>
                                    @elseif($permohonan->program == "BKOKU" && $permohonan->yuran == NULL)
                                        @php
                                            if($permohonan->amaun_wang_saku == null){
                                                $permohonan->amaun_wang_saku = 0;
                                            }
                                            $jumlah = $permohonan->amaun_wang_saku;
                                        @endphp
                                            <input type="hidden" name="baki" id="baki" value="NULL">
                                            <input type="hidden" name="baki_disokong" id="baki_disokong_2" value="NULL">
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
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <tr class="font-weight-bolder font-size-lg">
                                                    <td class="border-top-0 pr-0 py-4 font-size-h6 font-weight-boldest">Wang Saku</td>
                                                    <td class="border-top-0 pr-0 py-4 font-size-h6 font-weight-boldest text-right">{{number_format($permohonan->amaun_wang_saku, 2)}}</td>
                                                    <td class="border-top-0 pr-0 py-4 font-size-h6 font-weight-boldest text-right"><input type="number" step="0.01" name="w_saku_disokong" id="w_saku_disokong_2" value="{{number_format($permohonan->amaun_wang_saku, 2, '.', '')}}"></td>
                                                </tr>
                                                </tbody>
                                            </table>
                                            <table class="maklumat2">
                                                <tr>
                                                    <td>Jumlah tuntutan yang disokong (RM)</td>
                                                    <td>:</td>
                                                    <td><input type="number" step="0.01" id="jumlah_disokong_2" name="jumlah_disokong" value="{{number_format($jumlah, 2, '.', '')}}" oninvalid="this.setCustomValidity('Sila isi ruang ini')" oninput="setCustomValidity('')" required></td>
                                                </tr>
                                                <tr>
                                                    <td class="vertical-top">Catatan</td>
                                                    <td class="vertical-top">:</td>
                                                    <td class="vertical-top"><textarea name="catatan" id="catatan" cols="30" rows="3"></textarea></td>
                                                </tr>
                                            </table>
                                        </div>
                                        <script>
                                            document.getElementById("w_saku_disokong_2").addEventListener("input", SokongW);
                                            function SokongW(){
                                                var w_saku = document.getElementById('w_saku_disokong_2').value;
                                                w_saku = parseFloat(w_saku);
                                                document.getElementById('jumlah_disokong_2').value= parseFloat(w_saku).toFixed(2);
                                            }
                                        </script>
                                        @elseif($permohonan->program == "BKOKU" && $permohonan->wang_saku == NULL)
                                            @php
                                                if($permohonan->amaun_wang_saku == null){
                                                    $permohonan->amaun_wang_saku = 0;
                                                }
                                                $jumlah = $permohonan->amaun_yuran;
                                                $baki_y = $j_tuntutan->jumlah - $jumlah;
                                                if($permohonan->baki_disokong == null){
                                                    $permohonan->baki_disokong = $baki_y;
                                                }
                                            @endphp
                                            <input type="hidden" name="j_tuntutan" id="j_tuntutan" value="{{$j_tuntutan->jumlah}}">
                                            <input type="hidden" name="baki" id="baki" value="{{$baki_y}}">
                                            <input type="hidden" name="baki_disokong" id="baki_disokong_3" value="{{$permohonan->baki_disokong}}">
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
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <tr class="font-weight-bolder font-size-lg">
                                                        <td class="border-top-0 pr-0 py-4 font-size-h6 font-weight-boldest">Yuran Pengajian</td>
                                                        <td class="border-top-0 pr-0 py-4 font-size-h6 font-weight-boldest text-right">{{number_format($permohonan->amaun_yuran, 2)}}</td>
                                                        <td class="border-top-0 pr-0 py-4 font-size-h6 font-weight-boldest text-right">{{number_format($baki_y, 2)}}</td>
                                                        <td class="border-top-0 pr-0 py-4 font-size-h6 font-weight-boldest text-right"><input type="number" step="0.01" name="yuran_disokong" id="yuran_disokong_3" value="{{number_format($permohonan->amaun_yuran, 2, '.', '')}}"></td>
                                                        <td class="border-top-0 pr-0 py-4 font-size-h6 font-weight-boldest text-right" id="y_baki_disokong_3">{{number_format($permohonan->baki_disokong, 2)}}</td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                                <table class="maklumat2">
                                                    <tr>
                                                        <td>Jumlah tuntutan yang disokong (RM)</td>
                                                        <td>:</td>
                                                        <td><input type="number" step="0.01" id="jumlah_disokong_3" name="jumlah_disokong" value="{{number_format($jumlah, 2, '.', '')}}" oninvalid="this.setCustomValidity('Sila isi ruang ini')" oninput="setCustomValidity('')" required></td>
                                                    </tr>

                                                    <tr>
                                                        <td class="vertical-top">Catatan</td>
                                                        <td class="vertical-top">:</td>
                                                        <td class="vertical-top"><textarea name="catatan" id="catatan" cols="30" rows="3"></textarea></td>
                                                    </tr>
                                                </table>
                                            </div>
                                            <script>
                                                document.getElementById("yuran_disokong_3").addEventListener("input", SokongY);
                                                function SokongY(){
                                                    var yuran = document.getElementById('yuran_disokong_3').value;
                                                    var j_tuntutan = document.getElementById('j_tuntutan').value;
                                                    var baki = j_tuntutan - yuran;
                                                    var jumlah = parseFloat(yuran);
                                                    baki = Number(parseFloat(baki).toFixed(2)).toLocaleString('en', {
                                                        minimumFractionDigits: 2
                                                    });
                                                    document.getElementById('y_baki_disokong_3').innerHTML = baki;
                                                    document.getElementById('jumlah_disokong_3').value= parseFloat(jumlah).toFixed(2);
                                                    document.getElementById('baki_disokong_3').value= j_tuntutan - yuran;
                                                }
                                            </script>
                                    @elseif($permohonan->program == "PPK")
                                        @php
                                            if($permohonan->amaun_wang_saku == null){
                                                $permohonan->amaun_wang_saku = 0;
                                            }
                                            $jumlah = $permohonan->amaun_wang_saku;
                                        @endphp
                                            <input type="hidden" name="baki" id="baki" value="NULL">
                                            <input type="hidden" name="baki_disokong" id="baki_disokong_ppk" value="NULL">
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
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <tr class="font-weight-bolder font-size-lg">
                                                    <td class="border-top-0 pr-0 py-4 font-size-h6 font-weight-boldest">Wang Saku</td>
                                                    <td class="border-top-0 pr-0 py-4 font-size-h6 font-weight-boldest text-right">{{number_format($permohonan->amaun_wang_saku, 2)}}</td>
                                                    <td class="border-top-0 pr-0 py-4 font-size-h6 font-weight-boldest text-right"><input type="number" step="0.01" name="w_saku_disokong" id="w_saku_disokong_ppk" value="{{number_format($permohonan->amaun_wang_saku, 2, '.', '')}}"></td>
                                                </tr>
                                                </tbody>
                                            </table>
                                            <table class="maklumat2">
                                                <tr>
                                                    <td>Jumlah tuntutan yang disokong (RM)</td>
                                                    <td>:</td>
                                                    <td><input type="number" step="0.01" id="jumlah_disokong_ppk" name="jumlah_disokong" value="{{number_format($jumlah, 2, '.', '')}}" oninvalid="this.setCustomValidity('Sila isi ruang ini')" oninput="setCustomValidity('')" required></td>
                                                </tr>
                                                <tr>
                                                    <td class="vertical-top">Catatan</td>
                                                    <td class="vertical-top">:</td>
                                                    <td class="vertical-top"><textarea name="catatan" id="catatan" cols="30" rows="3"></textarea></td>
                                                </tr>
                                            </table>
                                        </div>
                                        <script>
                                            document.getElementById("w_saku_disokong_ppk").addEventListener("input", SokongPPK);

                                            function SokongPPK(){
                                                var w_saku = document.getElementById('w_saku_disokong_ppk').value;
                                                w_saku = parseFloat(w_saku);
                                                document.getElementById('jumlah_disokong_ppk').value= parseFloat(w_saku).toFixed(2);
                                            }
                                        </script>
                                    @endif
                                <!--end: Invoice body-->
                                <div class="col-md-6 text-right">
                                    <button type="submit" name="submit" class="btn btn-primary theme-bg gradient action-btn" value="Simpan">Teruskan</button>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-default-layout>

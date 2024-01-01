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
                                        <td>{{date('d/m/Y', strtotime($tuntutan->tarikh_hantar))}}</td>
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
                                <br>
                                @php
                                    $i = 2;
                                @endphp
                                <form method="POST" action="{{ url('tuntutan/sekretariat/pembayaran/hantar/'.$tuntutan->id) }}" id="saring">
                                    <h6>Pengiraan:</h6>
                                    <br>
                                    <p>Baki Terdahulu (RM) : {{number_format($permohonan->baki_dibayar, 2)}}</p>
                                    {{csrf_field()}}
                                    @if($permohonan->program == "BKOKU" && $tuntutan->yuran == "1" && $tuntutan->wang_saku == "1")
                                        <!--begin: Invoice body-->
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
                                            if($tuntutan->yuran_dibayar == null){
                                                $tuntutan->yuran_dibayar = $tuntutan->yuran_disokong;
                                            }
                                            if($tuntutan->wang_saku_dibayar == null){
                                                $tuntutan->wang_saku_dibayar = $tuntutan->wang_saku_disokong;
                                            }
                                            if($tuntutan->baki_dibayar == null){
                                                $tuntutan->baki_dibayar = $tuntutan->baki_disokong;
                                            }

                                            if($tuntutan->amaun_wang_saku == null){
                                                $tuntutan->amaun_wang_saku = 0;
                                            }
                                            $jumlah = $yuran + $tuntutan->amaun_wang_saku;
                                            $baki_y = $permohonan->baki_dibayar - $jumlah;
                                        @endphp
                                        <input type="hidden" name="baki" id="baki" value="{{$baki_y}}">
                                        <input type="hidden" name="baki_y" id="baki_y" value="{{$permohonan->baki_dibayar}}">
                                        <input type="hidden" name="baki_disokong" id="baki_disokong" value="">
                                        <input type="hidden" name="baki_dibayar" id="baki_dibayar" value="">
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
                                                    <td class="border-top-0 pr-0 py-4 font-size-h6 font-weight-boldest text-right">{{number_format($yuran, 2)}}</td>
                                                    <td class="border-top-0 pr-0 py-4 font-size-h6 font-weight-boldest text-right">{{number_format($baki_y, 2)}}</td>
                                                    <td class="border-top-0 pr-0 py-4 font-size-h6 font-weight-boldest text-right"><input type="number" step="0.01" name="yuran_disokong" id="yuran_disokong" value="{{number_format($tuntutan->yuran_disokong, 2, '.', '')}}"></td>
                                                    <td class="border-top-0 pr-0 py-4 font-size-h6 font-weight-boldest text-right" id="y_baki_disokong">{{number_format($tuntutan->baki_disokong, 2)}}</td>
                                                    <td class="border-top-0 pr-0 py-4 font-size-h6 font-weight-boldest text-right"><input type="number" step="0.01" name="yuran_dibayar" id="yuran_dibayar" value="{{number_format($tuntutan->yuran_dibayar, 2, '.', '')}}"></td>
                                                    <td class="border-top-0 pr-0 py-4 font-size-h6 font-weight-boldest text-right" id="y_baki_dibayar">{{number_format($tuntutan->baki_dibayar, 2)}}</td>
                                                </tr>
                                                <tr class="font-weight-bolder font-size-lg">
                                                    <td class="border-top-0 pr-0 py-4 font-size-h6 font-weight-boldest">Wang Saku</td>
                                                    <td class="border-top-0 pr-0 py-4 font-size-h6 font-weight-boldest text-right">{{number_format($tuntutan->amaun_wang_saku, 2)}}</td>
                                                    <td class="border-top-0 pr-0 py-4 font-size-h6 font-weight-boldest text-right">{{number_format(0, 2)}}</td>
                                                    <td class="border-top-0 pr-0 py-4 font-size-h6 font-weight-boldest text-right"><input type="number" step="0.01" name="w_saku_disokong" id="w_saku_disokong" value="{{number_format($tuntutan->wang_saku_disokong, 2, '.', '')}}"></td>
                                                    <td class="border-top-0 pr-0 py-4 font-size-h6 font-weight-boldest text-right" id="w_baki_disokong">{{number_format(0, 2)}}</td>
                                                    <td class="border-top-0 pr-0 py-4 font-size-h6 font-weight-boldest text-right"><input type="number" step="0.01" name="w_saku_dibayar" id="w_saku_dibayar" value="{{number_format($tuntutan->wang_saku_dibayar, 2, '.', '')}}"></td>
                                                    <td class="border-top-0 pr-0 py-4 font-size-h6 font-weight-boldest text-right" id="w_baki_dibayar">{{number_format(0, 2)}}</td>
                                                </tr>
                                                </tbody>
                                            </table>
                                            <table class="maklumat2">
                                                <tr>
                                                    <td>Jumlah tuntutan yang disokong (RM)</td>
                                                    <td>:</td>
                                                    <td><input type="number" step="0.01" id="jumlah_disokong" name="jumlah_disokong" value="{{number_format($tuntutan->yuran_disokong + $tuntutan->wang_saku_disokong, 2, '.', '')}}" oninvalid="this.setCustomValidity('Sila isi ruang ini')" oninput="setCustomValidity('')" required></td>
                                                </tr>
                                                <tr>
                                                    <td>Jumlah tuntutan yang dibayar (RM)</td>
                                                    <td>:</td>
                                                    <td><input type="number" step="0.01" id="jumlah_dibayar" name="jumlah_dibayar" value="{{number_format($tuntutan->yuran_dibayar + $tuntutan->wang_saku_disokong, 2, '.', '')}}" oninvalid="this.setCustomValidity('Sila isi ruang ini')" oninput="setCustomValidity('')" required></td>
                                                </tr>
                                                <tr>
                                                    <td class="vertical-top">Catatan</td>
                                                    <td class="vertical-top">:</td>
                                                    <td class="vertical-top"><textarea name="catatan_dibayar" id="catatan_dibayar" cols="30" rows="3">{{$tuntutan->catatan_dibayar}}</textarea></td>
                                                </tr>

                                            </table>
                                        </div>
                                        <script>
                                            document.getElementById("yuran_disokong").addEventListener("input", SokongY);
                                            document.getElementById("yuran_dibayar").addEventListener("input", BayarY);
                                            document.getElementById("w_saku_disokong").addEventListener("input", SokongY);
                                            document.getElementById("w_saku_dibayar").addEventListener("input", BayarY);
                                            function SokongY(){
                                                var yuran = document.getElementById('yuran_disokong').value;
                                                var w_saku = document.getElementById('w_saku_disokong').value;
                                                var baki_y = document.getElementById('baki_y').value;
                                                var baki = baki_y - yuran - w_saku;
                                                var jumlah = parseFloat(w_saku) + parseFloat(yuran);
                                                baki = Number(parseFloat(baki).toFixed(2)).toLocaleString('en', {
                                                    minimumFractionDigits: 2
                                                });
                                                document.getElementById('y_baki_disokong').innerHTML = baki;
                                                document.getElementById('jumlah_disokong').value= parseFloat(jumlah).toFixed(2);
                                                document.getElementById('baki_disokong').value= 5000 - yuran - w_saku;
                                            }
                                            function BayarY(){
                                                var yuran = document.getElementById('yuran_dibayar').value;
                                                var w_saku = document.getElementById('w_saku_dibayar').value;
                                                var baki_y = document.getElementById('baki_y').value;
                                                var baki = baki_y - yuran - w_saku;
                                                var jumlah = parseFloat(yuran) + parseFloat(w_saku);
                                                baki = Number(parseFloat(baki).toFixed(2)).toLocaleString('en', {
                                                    minimumFractionDigits: 2
                                                });
                                                document.getElementById('y_baki_dibayar').innerHTML = baki;
                                                document.getElementById('jumlah_dibayar').value= parseFloat(jumlah).toFixed(2);
                                                document.getElementById('baki_dibayar').value= 5000 - yuran - w_saku;
                                            }
                                        </script>
                                    @elseif($permohonan->program == "BKOKU" && $tuntutan->yuran == NULL)
                                        @php
                                            if($tuntutan->amaun_wang_saku == null){
                                                $tuntutan->amaun_wang_saku = 0;
                                            }
                                            if($tuntutan->wang_saku_dibayar == null){
                                                $tuntutan->wang_saku_dibayar = $tuntutan->wang_saku_disokong;
                                            }
                                            $jumlah = $tuntutan->amaun_wang_saku;
                                        @endphp
                                        <input type="hidden" name="baki" id="baki" value="NULL">
                                        <input type="hidden" name="baki_disokong" id="baki_disokong_2" value="NULL">
                                        <input type="hidden" name="baki_dibayar" id="baki_dibayar_2" value="NULL">
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
                                                    <td class="border-top-0 pr-0 py-4 font-size-h6 font-weight-boldest text-right">{{number_format($tuntutan->amaun_wang_saku, 2)}}</td>
                                                    <td class="border-top-0 pr-0 py-4 font-size-h6 font-weight-boldest text-right"><input type="number" step="0.01" name="w_saku_disokong" id="w_saku_disokong_2" value="{{number_format($tuntutan->wang_saku_disokong, 2, '.', '')}}"></td>
                                                    <td class="border-top-0 pr-0 py-4 font-size-h6 font-weight-boldest text-right"><input type="number" step="0.01" name="w_saku_dibayar" id="w_saku_dibayar_2" value="{{number_format($tuntutan->wang_saku_dibayar, 2, '.', '')}}"></td>
                                                </tr>
                                                </tbody>
                                            </table>
                                            <table class="table table-striped table-hover dataTable js-exportable">
                                                <tr>
                                                    <td>Jumlah tuntutan yang disokong (RM)</td>
                                                    <td>:</td>
                                                    <td><input type="number" step="0.01" id="jumlah_disokong_2" name="jumlah_disokong" value="{{number_format($tuntutan->wang_saku_disokong, 2, '.', '')}}" oninvalid="this.setCustomValidity('Sila isi ruang ini')" oninput="setCustomValidity('')" required></td>
                                                </tr>
                                                <tr>
                                                    <td>Jumlah tuntutan yang dibayar (RM)</td>
                                                    <td>:</td>
                                                    <td><input type="number" step="0.01" id="jumlah_dibayar_2" name="jumlah_dibayar" value="{{number_format($tuntutan->wang_saku_dibayar, 2, '.', '')}}" oninvalid="this.setCustomValidity('Sila isi ruang ini')" oninput="setCustomValidity('')" required></td>
                                                </tr>
                                                <tr>
                                                    <td class="vertical-top">Catatan</td>
                                                    <td class="vertical-top">:</td>
                                                    <td class="vertical-top"><textarea name="catatan_dibayar" id="catatan_dibayar" cols="30" rows="3">{{$tuntutan->catatan_dibayar}}</textarea></td>
                                                </tr>

                                            </table>
                                        </div>
                                        <script>
                                            document.getElementById("w_saku_disokong_2").addEventListener("input", SokongW);
                                            document.getElementById("w_saku_dibayar_2").addEventListener("input", BayarW);
                                            function SokongW(){
                                                var w_saku = document.getElementById('w_saku_disokong_2').value;
                                                w_saku = parseFloat(w_saku);
                                                document.getElementById('jumlah_disokong_2').value= parseFloat(w_saku).toFixed(2);
                                            }
                                            function BayarW(){
                                                var w_saku = document.getElementById('w_saku_dibayar_2').value;
                                                w_saku = parseFloat(w_saku);
                                                document.getElementById('jumlah_dibayar_2').value= parseFloat(w_saku).toFixed(2);
                                            }
                                        </script>
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
                                            if($tuntutan->yuran_dibayar == null){
                                                $tuntutan->yuran_dibayar = $tuntutan->yuran_disokong;
                                            }
                                            if($tuntutan->baki_dibayar == null){
                                                $tuntutan->baki_dibayar = $tuntutan->baki_disokong;
                                            }
                                            $jumlah = $yuran;
                                            $baki_y = $permohonan->baki_dibayar - $jumlah;
                                        @endphp
                                        <input type="hidden" name="baki" id="baki" value="{{$baki_y}}">
                                        <input type="hidden" name="baki_y" id="baki_y_2" value="{{$permohonan->baki_dibayar}}">
                                        <input type="hidden" name="baki_disokong" id="baki_disokong_3" value="">
                                        <input type="hidden" name="baki_dibayar" id="baki_dibayar_3" value="">
                                        <input type="hidden" name="baki_y" id="baki_y" value="{{$permohonan->baki_dibayar}}">
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
                                                    <td class="border-top-0 pr-0 py-4 font-size-h6 font-weight-boldest text-right">{{number_format($yuran, 2)}}</td>
                                                    <td class="border-top-0 pr-0 py-4 font-size-h6 font-weight-boldest text-right">{{number_format($tuntutan->baki, 2)}}</td>
                                                    <td class="border-top-0 pr-0 py-4 font-size-h6 font-weight-boldest text-right"><input type="number" step="0.01" name="yuran_disokong" id="yuran_disokong_3" value="{{number_format($tuntutan->yuran_disokong, 2, '.', '')}}"></td>
                                                    <td class="border-top-0 pr-0 py-4 font-size-h6 font-weight-boldest text-right" id="y_baki_disokong_3">{{number_format($baki_y, 2)}}</td>
                                                    <td class="border-top-0 pr-0 py-4 font-size-h6 font-weight-boldest text-right"><input type="number" step="0.01" name="yuran_dibayar" id="yuran_dibayar_3" value="{{number_format($tuntutan->yuran_dibayar, 2, '.', '')}}"></td>
                                                    <td class="border-top-0 pr-0 py-4 font-size-h6 font-weight-boldest text-right" id="y_baki_dibayar_3">{{number_format($baki_y, 2)}}</td>
                                                </tr>
                                                </tbody>
                                            </table>
                                            <table class="maklumat2">
                                                <tr>
                                                    <td>Jumlah tuntutan yang disokong (RM)</td>
                                                    <td>:</td>
                                                    <td><input type="number" step="0.01" id="jumlah_disokong_3" name="jumlah_disokong" value="{{number_format($tuntutan->yuran_disokong, 2, '.', '')}}" oninvalid="this.setCustomValidity('Sila isi ruang ini')" oninput="setCustomValidity('')" required></td>
                                                </tr>
                                                <tr>
                                                    <td>Jumlah tuntutan yang dibayar (RM)</td>
                                                    <td>:</td>
                                                    <td><input type="number" step="0.01" id="jumlah_dibayar_3" name="jumlah_dibayar" value="{{number_format($tuntutan->yuran_dibayar, 2, '.', '')}}" oninvalid="this.setCustomValidity('Sila isi ruang ini')" oninput="setCustomValidity('')" required></td>
                                                </tr>
                                                <tr>
                                                    <td class="vertical-top">Catatan</td>
                                                    <td class="vertical-top">:</td>
                                                    <td class="vertical-top"><textarea name="catatan_dibayar" id="catatan_dibayar" cols="30" rows="3">{{$tuntutan->catatan_dibayar}}</textarea></td>
                                                </tr>

                                            </table>
                                        </div>
                                        <script>
                                            document.getElementById("yuran_disokong_3").addEventListener("input", SokongY);
                                            document.getElementById("yuran_dibayar_3").addEventListener("input", BayarY);
                                            function SokongY(){
                                                var yuran = document.getElementById('yuran_disokong_3').value;
                                                var baki_y = document.getElementById('baki_y_2').value;
                                                var baki = baki_y - yuran;
                                                var jumlah = parseFloat(yuran);
                                                baki = Number(parseFloat(baki).toFixed(2)).toLocaleString('en', {
                                                    minimumFractionDigits: 2
                                                });
                                                document.getElementById('y_baki_disokong_3').innerHTML = baki;
                                                document.getElementById('jumlah_disokong_3').value= parseFloat(jumlah).toFixed(2);
                                                document.getElementById('baki_disokong_3').value= 5000 - yuran;
                                            }
                                            function BayarY(){
                                                var yuran = document.getElementById('yuran_dibayar_3').value;
                                                var baki_y = document.getElementById('baki_y_2').value;
                                                var baki = baki_y - yuran;
                                                var jumlah = parseFloat(yuran);
                                                baki = Number(parseFloat(baki).toFixed(2)).toLocaleString('en', {
                                                    minimumFractionDigits: 2
                                                });
                                                document.getElementById('y_baki_dibayar_3').innerHTML = baki;
                                                document.getElementById('jumlah_dibayar_3').value= parseFloat(jumlah).toFixed(2);
                                                document.getElementById('baki_dibayar_3').value= 5000 - yuran;
                                            }
                                        </script>
                                    @elseif($permohonan->program == "PPK")
                                        @php
                                            if($tuntutan->amaun_wang_saku == null){
                                                $tuntutan->amaun_wang_saku = 0;
                                            }
                                            if($tuntutan->yuran_dibayar == null){
                                                $tuntutan->yuran_dibayar = $tuntutan->yuran_disokong;
                                            }
                                            if($tuntutan->wang_saku_dibayar == null){
                                                $tuntutan->wang_saku_dibayar = $tuntutan->wang_saku_disokong;
                                            }
                                            $jumlah = $tuntutan->amaun_wang_saku;
                                        @endphp
                                        <input type="hidden" name="baki" id="baki" value="NULL">
                                        <input type="hidden" name="baki_disokong" id="baki_disokong_ppk" value="NULL">
                                        <input type="hidden" name="baki_dibayar" id="baki_dibayar_ppk" value="NULL">
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
                                                    <td class="border-top-0 pr-0 py-4 font-size-h6 font-weight-boldest text-right">{{number_format($tuntutan->amaun_wang_saku, 2)}}</td>
                                                    <td class="border-top-0 pr-0 py-4 font-size-h6 font-weight-boldest text-right"><input type="number" step="0.01" name="w_saku_disokong" id="w_saku_disokong_ppk" value="{{number_format($tuntutan->wang_saku_disokong, 2, '.', '')}}"></td>
                                                    <td class="border-top-0 pr-0 py-4 font-size-h6 font-weight-boldest text-right"><input type="number" step="0.01" name="w_saku_dibayar" id="w_saku_dibayar_ppk" value="{{number_format($tuntutan->wang_saku_dibayar, 2, '.', '')}}"></td>
                                                </tr>
                                                </tbody>
                                            </table>
                                            <table class="maklumat2">
                                                <tr>
                                                    <td>Jumlah tuntutan yang disokong (RM)</td>
                                                    <td>:</td>
                                                    <td><input type="number" step="0.01" id="jumlah_disokong_ppk" name="jumlah_disokong" value="{{number_format($tuntutan->wang_saku_disokong, 2, '.', '')}}" oninvalid="this.setCustomValidity('Sila isi ruang ini')" oninput="setCustomValidity('')" required></td>
                                                </tr>
                                                <tr>
                                                    <td>Jumlah tuntutan yang dibayar (RM)</td>
                                                    <td>:</td>
                                                    <td><input type="number" step="0.01" id="jumlah_dibayar_ppk" name="jumlah_dibayar" value="{{number_format($tuntutan->wang_saku_dibayar, 2, '.', '')}}" oninvalid="this.setCustomValidity('Sila isi ruang ini')" oninput="setCustomValidity('')" required></td>
                                                </tr>
                                                <tr>
                                                    <td class="vertical-top">Catatan</td>
                                                    <td class="vertical-top">:</td>
                                                    <td class="vertical-top"><textarea name="catatan_dibayar" id="catatan_dibayar" cols="30" rows="3">{{$tuntutan->catatan_dibayar}}</textarea></td>
                                                </tr>

                                            </table>
                                        </div>
                                        <script>
                                            document.getElementById("w_saku_disokong_ppk").addEventListener("input", SokongPPK);
                                            document.getElementById("w_saku_dibayar_ppk").addEventListener("input", BayarPPK);

                                            function SokongPPK(){
                                                var w_saku = document.getElementById('w_saku_disokong_ppk').value;
                                                w_saku = parseFloat(w_saku);
                                                document.getElementById('jumlah_disokong_ppk').value= parseFloat(w_saku).toFixed(2);
                                            }
                                            function BayarPPK(){
                                                var w_saku = document.getElementById('w_saku_dibayar_ppk').value;
                                                w_saku = parseFloat(w_saku);
                                                document.getElementById('jumlah_dibayar_ppk').value= parseFloat(w_saku).toFixed(2);
                                            }
                                        </script>
                                    @endif
                                    <!--end: Invoice body-->
                                    <div class="col-md-6 text-right">
                                        <button type="submit" class="btn btn-primary theme-bg gradient action-btn" value="Hantar" id="check">Hantar</button>
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

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
                                    $tkh_bayaran = DB::table('sejarah_permohonan')->where('permohonan_id', $permohonan->id)->where('status', 8)->value('created_at');
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
                                        <td>{{date('d/m/Y', strtotime($permohonan->tarikh_transaksi))}}</td>
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
                                        </table>
                                    </div>
                                @endif
                                
                                
                                <!--begin::Form REQUERY TO ESP-->
                                <form class="form" id="hantar_maklumat">
                                    <textarea name="token" id="token" rows="10" cols="50"></textarea>
                                    <textarea name="data" id="data" rows="10" cols="50"></textarea>
                                    <!--begin::Button-->
                                    <div class="row">
                                        <div class="col-md-12 text-left">
                                            <input type="button" value="Set Semula" onclick="sendData()" class="btn btn-danger">
                                        </div>
                                    </div>
                                    <!--end::Button-->
                                </form>
                                <!--end::Form-->
                                <div class="col-md-6 text-right">
                                    <a href="{{ url('permohonan/sekretariat/pembayaran/senarai') }}" class="white">
                                        <button class="btn btn-primary theme-bg gradient action-btn" value="Simpan" id="check">Kembali</button>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        #token {
          display: none;
        }
        #data {
          display: none;
        }
    </style>

    <!--begin::Javascript-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/3.1.9-1/crypto-js.js"></script>

    <script>

        function sendData() {
            const secretKey = "{{ $secretKey }}";
            const time = {{ time() }}; 
            const token = generateToken(secretKey, time);

            const id_permohonan = "{{$permohonan->no_rujukan_permohonan}}";
            // alert(id_permohonan);
            const noic = "{{$smoku->no_kp}}";
            const id_tuntutan = "";

            // Construct the JSON array with the token
            const tokenArray = [{ "token": token }];

            // Set the JSON array in the textarea
            const tokenTextarea = document.getElementById('token');
            tokenTextarea.value = JSON.stringify(tokenArray, null, 2);
            // console.log("Token JSON:", tokenTextarea.value);

            const dataArray = [{ "id_permohonan": id_permohonan, "id_tuntutan": id_tuntutan, "noic": noic}];
            // Set the JSON array in the textarea
            const dataTextarea = document.getElementById('data');
            dataTextarea.value = JSON.stringify(dataArray, null, 2);
            // console.log("Data JSON:", dataTextarea.value);

            const form = document.getElementById('hantar_maklumat');
            const data = new FormData(form);

            fetch('https://espb.mohe.gov.my/api/studentsStatus.php', {
                method: 'POST',
                body: data
            })
            .then(response => response.json())
            .then(data => {
                console.log(data); // Log the API response to the console

                // Convert the API response to a string for display in the alert
                const responseDataString = JSON.stringify(data, null, 2);
                if (data.status === 'error'){
                    Swal.fire({
                    icon: 'error',
                    title: 'Tidak Berjaya',
                    text: 'Sila cuba sekali lagi.',
                    }).then((result) => {
                        // Check if the user clicked OK
                        if (result.isConfirmed) {
                            // Reload the page
                            location.reload();
                        }
                    });
                    // alert(`Data tidak berjaya hantar ke ESP. Sila hantar sekali lagi.`);
                    // alert(`Data tidak berjaya di hantar ke ESP\n\nAPI Response:\n${responseDataString}`);
                    
                }else{
                    Swal.fire({
                    icon: 'success',
                    title: 'Berjaya',
                    text: 'Requery berjaya.',
                    }).then((result) => {
                        // Check if the user clicked OK
                        if (result.isConfirmed) {
                            // Reload the page
                            location.reload();
                        }
                    });

                    // alert(`Data berjaya di hantar ke ESP. Semak ESP`); // Show success message and API response in alert
                    // alert(`Data berjaya di hantar ke ESP\n\nAPI Response:\n${responseDataString}`); // Show success message and API response in alert
                }

                // location.reload(); // Refresh the page
            })

            .catch(error => {
                console.error('API Request failed:', error);
                location.reload(); // Refresh the page
            });
        }

        function generateToken(secretKey, time) {
        const dataToHash = secretKey + time;
        const hash = CryptoJS.SHA256(dataToHash).toString(CryptoJS.enc.Hex);
        return hash;
        }
    </script>
    <!--end::Javascript-->
</x-default-layout>

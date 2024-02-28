<x-default-layout>
<!--begin::Head-->
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
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
                                $invoisResit = "/assets/dokumen/tuntutan/salinan_invoisResit_KPTBKOKU-2-989876543210.pdf";
                            @endphp
                            <h6>Pengiraan:</h6>
                            <br>
                            <p>Baki Terdahulu (RM) : {{number_format($permohonan->baki_dibayar, 2)}}</p>
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
                                    $baki_y = $permohonan->baki_dibayar - $jumlah;
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
                                            <th class="th-green border-top-0 pr-0 py-4 font-size-h6 font-weight-boldest bold white">Dibayar (RM)</th>
                                            <th class="th-green border-top-0 pr-0 py-4 font-size-h6 font-weight-boldest bold white">Baki (RM)</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr class="font-weight-bolder font-size-lg">
                                            <td class="border-top-0 pr-0 py-4 font-size-h6 font-weight-boldest">Yuran Pengajian</td>
                                            <td class="border-top-0 pr-0 py-4 font-size-h6 font-weight-boldest text-right">{{number_format($yuran, 2)}}</td>
                                            <td class="border-top-0 pr-0 py-4 font-size-h6 font-weight-boldest text-right">{{number_format($baki_y, 2)}}</td>
                                            <td class="border-top-0 pr-0 py-4 font-size-h6 font-weight-boldest text-right">{{number_format($tuntutan->yuran_disokong, 2)}}</td>
                                            <td class="border-top-0 pr-0 py-4 font-size-h6 font-weight-boldest text-right">{{number_format($tuntutan->baki_disokong, 2)}}</td>
                                            <td class="border-top-0 pr-0 py-4 font-size-h6 font-weight-boldest text-right">{{number_format($tuntutan->yuran_dibayar, 2)}}</td>
                                            <td class="border-top-0 pr-0 py-4 font-size-h6 font-weight-boldest text-right">{{number_format($tuntutan->baki_dibayar, 2)}}</td>
                                        </tr>
                                        <tr class="font-weight-bolder font-size-lg">
                                            <td class="border-top-0 pr-0 py-4 font-size-h6 font-weight-boldest">Wang Saku</td>
                                            <td class="border-top-0 pr-0 py-4 font-size-h6 font-weight-boldest text-right">{{number_format($tuntutan->amaun_wang_saku, 2)}}</td>
                                            <td class="border-top-0 pr-0 py-4 font-size-h6 font-weight-boldest text-right">{{number_format(0, 2)}}</td>
                                            <td class="border-top-0 pr-0 py-4 font-size-h6 font-weight-boldest text-right">{{number_format($tuntutan->wang_saku_disokong, 2)}}</td>
                                            <td class="border-top-0 pr-0 py-4 font-size-h6 font-weight-boldest text-right">{{number_format(0, 2)}}</td>
                                            <td class="border-top-0 pr-0 py-4 font-size-h6 font-weight-boldest text-right">{{number_format($tuntutan->wang_saku_dibayar, 2)}}</td>
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
                                        <tr>
                                        <td>Jumlah tuntutan yang dibayar (RM)</td>
                                        <td>:</td>
                                        <td>{{number_format($tuntutan->yuran_dibayar + $tuntutan->wang_saku_dibayar, 2)}}</td>
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
                                            <th class="th-green border-top-0 pr-0 py-4 font-size-h6 font-weight-boldest bold white">Dibayar (RM)</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr class="font-weight-bolder font-size-lg">
                                            <td class="border-top-0 pr-0 py-4 font-size-h6 font-weight-boldest">Wang Saku</td>
                                            <td class="border-top-0 pr-0 py-4 font-size-h6 font-weight-boldest text-right">{{number_format($tuntutan->amaun_wang_saku, 2)}}</td>
                                            <td class="border-top-0 pr-0 py-4 font-size-h6 font-weight-boldest text-right">{{number_format($tuntutan->wang_saku_disokong, 2)}}</td>
                                            <td class="border-top-0 pr-0 py-4 font-size-h6 font-weight-boldest text-right">{{number_format($tuntutan->wang_saku_dibayar, 2)}}</td>
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
                                        <td>Jumlah tuntutan yang dibayar (RM)</td>
                                        <td>:</td>
                                        <td>{{number_format($tuntutan->wang_saku_dibayar, 2)}}</td>
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
                                    $baki_y = $permohonan->baki_dibayar - $jumlah;
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
                                            <th class="th-green border-top-0 pr-0 py-4 font-size-h6 font-weight-boldest bold white">Dibayar (RM)</th>
                                            <th class="th-green border-top-0 pr-0 py-4 font-size-h6 font-weight-boldest bold white">Baki (RM)</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr class="font-weight-bolder font-size-lg">
                                            <td class="border-top-0 pr-0 py-4 font-size-h6 font-weight-boldest">Yuran Pengajian</td>
                                            <td class="border-top-0 pr-0 py-4 font-size-h6 font-weight-boldest text-right">{{number_format($yuran, 2)}}</td>
                                            <td class="border-top-0 pr-0 py-4 font-size-h6 font-weight-boldest text-right">{{number_format($baki_y, 2)}}</td>
                                            <td class="border-top-0 pr-0 py-4 font-size-h6 font-weight-boldest text-right">{{number_format($tuntutan->yuran_disokong, 2)}}</td>
                                            <td class="border-top-0 pr-0 py-4 font-size-h6 font-weight-boldest text-right">{{number_format($tuntutan->baki_disokong, 2)}}</td>
                                            <td class="border-top-0 pr-0 py-4 font-size-h6 font-weight-boldest text-right">{{number_format($tuntutan->yuran_dibayar, 2)}}</td>
                                            <td class="border-top-0 pr-0 py-4 font-size-h6 font-weight-boldest text-right">{{number_format($tuntutan->baki_dibayar, 2)}}</td>
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
                                            <td>Jumlah tuntutan yang dibayar (RM)</td>
                                            <td>:</td>
                                            <td>{{number_format($tuntutan->yuran_dibayar, 2)}}</td>
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
                                            <th class="th-green border-top-0 pr-0 py-4 font-size-h6 font-weight-boldest bold white">Dibayar (RM)</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr class="font-weight-bolder font-size-lg">
                                            <td class="border-top-0 pr-0 py-4 font-size-h6 font-weight-boldest">Wang Saku</td>
                                            <td class="border-top-0 pr-0 py-4 font-size-h6 font-weight-boldest text-right">{{number_format($tuntutan->amaun_wang_saku, 2)}}</td>
                                            <td class="border-top-0 pr-0 py-4 font-size-h6 font-weight-boldest text-right">{{number_format($tuntutan->wang_saku_disokong, 2)}}</td>
                                            <td class="border-top-0 pr-0 py-4 font-size-h6 font-weight-boldest text-right">{{number_format($tuntutan->wang_saku_dibayar, 2)}}</td>
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
                                        <td>Jumlah tuntutan yang dibayar (RM)</td>
                                        <td>:</td>
                                        <td>{{number_format($tuntutan->wang_saku_dibayar, 2)}}</td>
                                        </tr>
                                    </table>
                                </div>
                            @endif
                            <!--end: Invoice body-->
                            <!--begin::Form REQUERY TO ESP-->
                            <form class="form" id="hantar_maklumat">
                                <textarea name="token" id="token" rows="10" cols="50"></textarea>
                                <textarea name="data" id="data" rows="10" cols="50"></textarea>
                                <!--begin::Button-->
                                <div class="row">
                                    <div class="col-md-12 text-left">
                                        <input type="button" value="Requery" onclick="sendData()" class="btn btn-danger">
                                    </div>
                                </div>
                                <!--end::Button-->
                            </form>
                            <!--end::Form-->
                            <div class="col-md-6 text-right">
                                <a href="{{ url('tuntutan/sekretariat/pembayaran/senarai') }}" class="white">
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
    const id_tuntutan = "{{$tuntutan->no_rujukan_tuntutan}}";

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
</body>

</x-default-layout>

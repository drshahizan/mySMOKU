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
            width: 80%;
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
        {{-- begin alert --}}
        @if($status_kod==1)
            <div class="alert alert-success" role="alert" style="margin: 0px 15px 20px 15px; color:black!important;">
                {{ $status }}
            </div>
        @endif
        {{-- end alert --}}
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
                                        $akademik = DB::table('maklumatakademik')->where('nokp_pelajar', $pelajar->nokp_pelajar)->first();
                                        $institusi = DB::table('bk_infoipt')->where('idipt', $akademik->id_institusi)->value('namaipt');
                                        $peringkat = DB::table('bk_peringkatpengajian')->where('kodperingkat', $akademik->peringkat_pengajian)->value('peringkat');
                                        // nama pemohon
                                        $text = ucwords(strtolower($pelajar->nama_pelajar)); // Assuming you're sending the text as a POST parameter
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
                                        $text3 = ucwords(strtolower($institusi)); // Assuming you're sending the text as a POST parameter
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
                                            <td>{{$permohonan->id_permohonan}}</td>
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
                                            <td>{{$pelajar->nokp_pelajar}}</td>
                                            <td class="space">&nbsp;</td>
                                            <td><strong>Peringkat</strong></td>
                                            <td>:</td>
                                            <td>{{ ucwords(strtolower($peringkat))}}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Tarikh Tuntutan</strong></td>
                                            <td>:</td>
                                            <td>{{$permohonan->created_at->format('d/m/Y')}}</td>
                                            <td class="space">&nbsp;</td>
                                            <td><strong>Sesi/Semester</strong></td>
                                            <td>:</td>
                                            <td>{{$akademik->sesi}}-0{{$akademik->sem_semasa}}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Status Penajaan</strong></td>
                                            <td>:</td>
                                            @if($akademik->nama_penaja!=null)
                                                <td>Ditaja ({{$akademik->nama_penaja}})</td>
                                            @else
                                                <td>Tidak Ditaja</td>
                                            @endif
                                        </tr>
                                    </table>   
                                <hr>
                                <td>
                                    <form method="POST" action="{{ url('saring/tuntutan/'.$pelajar->nokp_pelajar) }}" id="saring">
                                    {{csrf_field()}}     
                                    <!--begin: Invoice body-->
                                    @php
                                        $jumlah = $permohonan->amaun + $akademik->bil_bulanpersem * 300;
                                        if($jumlah > 5000){
                                            $jumlah = 5000;
                                        }
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
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr class="font-weight-bolder font-size-lg">
                                                    <td class="border-top-0 pr-0 py-4 font-size-h6 font-weight-boldest">Yuran Pengajian</td>
                                                    <td class="border-top-0 pr-0 py-4 font-size-h6 font-weight-boldest text-right">{{number_format($permohonan->amaun, 2)}}</td>
                                                    <td class="border-top-0 pr-0 py-4 font-size-h6 font-weight-boldest text-right">{{number_format(5000 - $permohonan->amaun - $akademik->bil_bulanpersem * 300, 2)}}</td>
                                                    <td class="border-top-0 pr-0 py-4 font-size-h6 font-weight-boldest text-right"><input type="number" name="yuran" id="yuran" value="{{number_format($permohonan->amaun, 2, '.', '')}}"></td>
                                                    <td class="border-top-0 pr-0 py-4 font-size-h6 font-weight-boldest text-right">{{number_format(5000 - $permohonan->amaun - $akademik->bil_bulanpersem * 300, 2)}}</td>
                                                </tr>
                                                <tr class="font-weight-bolder font-size-lg">
                                                    <td class="border-top-0 pr-0 py-4 font-size-h6 font-weight-boldest">Wang Saku</td>
                                                    <td class="border-top-0 pr-0 py-4 font-size-h6 font-weight-boldest text-right">{{number_format($akademik->bil_bulanpersem * 300, 2)}}</td>
                                                    <td class="border-top-0 pr-0 py-4 font-size-h6 font-weight-boldest text-right">{{number_format(0, 2)}}</td>
                                                    <td class="border-top-0 pr-0 py-4 font-size-h6 font-weight-boldest text-right"><input type="number" name="yuran" id="yuran" value="{{number_format($akademik->bil_bulanpersem * 300, 2, '.', '')}}"></td>
                                                    <td class="border-top-0 pr-0 py-4 font-size-h6 font-weight-boldest text-right" id="baki">{{number_format(0, 2)}}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <table class="maklumat2">
                                            <tr>
                                                <td>Jumlah tuntutan yang disokong (RM)</td>
                                                <td>:</td>
                                                <td><input type="number" name="layak_tuntut" value="{{number_format($jumlah, 2, '.', '')}}" oninvalid="this.setCustomValidity('Sila isi ruang ini')" oninput="setCustomValidity('')" required></td>
                                            </tr>
                                        </table>
                                    </div>
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
   <script> 
        function select3(){
            var catatan1 = document.getElementById('salinan_dokumen').value;
            if(catatan1=="tak_lengkap"){
                document.getElementById("checkbox3a").disabled = false;
                document.getElementById("checkbox3b").disabled = false;
                document.getElementById("checkbox3c").disabled = false;
                document.getElementById("checkbox3d").disabled = false;
            }
            else{
                document.getElementById("checkbox3a").disabled = true;
                document.getElementById("checkbox3b").disabled = true;
                document.getElementById("checkbox3c").disabled = true;
                document.getElementById("checkbox3d").disabled = true;
            }
        }

        function confirmButton() {
            confirm("Press a button!");
        }
   </script>
</x-default-layout> 
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
            width: 45%;
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
    <!-- Main body part  -->
        {{-- begin alert --}}
        @if($status=="Permohonan Telah Disokong")
            <div class="alert alert-success" role="alert" style="margin: 0px 15px 20px 15px">
                {{ $status }}
            </div>
        @endif
        @if($status=="Permohonan Telah Dikembalikan")
            <div class="alert alert-warning" role="alert" style="margin: 0px 15px 20px 15px">
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
                                    @endphp
                                    <table class="maklumat">
                                        <tr>
                                            <td><strong>ID Tuntutan</strong></td>
                                            <td>:</td>
                                            <td>{{$permohonan->id_permohonan}}</td>
                                            <td class="space">&nbsp;</td>
                                            <td><strong>Kursus</strong></td>
                                            <td>:</td>
                                            <td>{{$akademik->nama_kursus}}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Nama</strong></td>
                                            <td>:</td>
                                            <td>{{$pelajar->nama_pelajar}}</td>
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
                                            <td>{{$peringkat}}</td>
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
                                    </table>   
                                <hr>
                                <br>
                                <td>
                                    <form method="POST" action="{{ url('saring/tuntutan') }}" id="saring">
                                    {{csrf_field()}}     
                                    <!--begin: Invoice body-->
                                    @php
                                        $jumlah = $permohonan->amaun + $akademik->bil_bulanpersem * 300;
                                    @endphp
                                    <div class="table-responsive">
                                        <table class="maklumat2">
                                            <tr>
                                                <td>Jumlah Layak Tuntut (RM)</td>
                                                <td>:</td>
                                                <td><input type="number" name="layak_tuntut" value="{{$jumlah}}" oninvalid="this.setCustomValidity('Sila isi ruang ini')" oninput="setCustomValidity('')" required></td>
                                            </tr>
                                        </table>
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th class="border-top-0 pr-0 py-4 font-size-h6 font-weight-boldest bold white">Jenis Tuntutan</th>
                                                    <th class="border-top-0 pr-0 py-4 font-size-h6 font-weight-boldest bold white">Jumlah (RM)</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr class="font-weight-bolder font-size-lg">
                                                    <td class="border-top-0 pr-0 py-4 font-size-h6 font-weight-boldest">
                                                        Yuran Pengajian
                                                    </td>
                                                    <td class="border-top-0 pr-0 py-4 font-size-h6 font-weight-boldest text-right">{{number_format($permohonan->amaun, 2)}}</td>
                                                </tr>
                                                <tr class="font-weight-bolder font-size-lg">
                                                    <td class="border-top-0 pr-0 py-4 font-size-h6 font-weight-boldest">
                                                        Wang Saku
                                                    </td>
                                                    <td class="border-top-0 pr-0 py-4 font-size-h6 font-weight-boldest text-right">{{number_format($akademik->bil_bulanpersem * 300, 2)}}</td>
                                                </tr>
                                                <tr class="font-weight-bolder font-size-lg">
                                                    <td class="border-top-0 pr-0 py-4 font-size-h6 font-weight-boldest">
                                                        Keseluruhan
                                                    </td>
                                                    <td class="border-top-0 pr-0 py-4 font-size-h6 font-weight-boldest text-right">{{number_format($permohonan->amaun + $akademik->bil_bulanpersem * 300, 2)}}</td>
                                                </tr>
                                            </tbody>
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
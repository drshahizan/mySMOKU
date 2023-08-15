<x-default-layout> 
    <link rel="stylesheet" href="/assets/css/saringan.css">
    <style>
        .maklumat, .maklumat td{
            border: none!important;
            padding:4px 8px!important;
        }
        .number{
            width: 70px!important;
            text-align: right;
            padding-right:10px!important; 
        }
        .white{
            color: white!important;
        }
        .content{
            width: 220px;
        }
        .content2{
            width: 160px;
        }
        .border{
            border-top: 1px solid black!important;
            border-bottom: 1px solid black!important;
            border-left: none!important;
            border-right: none!important;
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
            border-radius: 4px;
            padding: 2px;
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
                                <li class="nav-item vivify swoopInTop delay-150 active"><b>Saring Tuntutan</b></li>
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
                                    <table class="maklumat">
                                        <tr>
                                            <td><strong>Nama</strong></td>
                                            <td>:</td>
                                            <td>{{$pelajar->nama_pelajar}}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>No. Kad Pengenalan</strong></td>
                                            <td>:</td>
                                            <td>{{$pelajar->nokp_pelajar}}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Tarikh Permohonan</strong></td>
                                            <td>:</td>
                                            <td>{{$permohonan->created_at->format('d/m/Y')}}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>ID Permohonan</strong></td>
                                            <td>:</td>
                                            <td>{{$permohonan->id_permohonan}}</td>
                                        </tr>
                                    </table>                  
                                
                                <hr>
                                <table class="maklumat">
                                    <tr>
                                        <td><strong>Penerangan:</strong></td>
                                    </tr>
                                </table> 
                                <form method="POST" action="{{ url('saring-tuntutan') }}" id="saring">
                                {{csrf_field()}}     
                                <!--begin: Invoice body-->
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th class="pt-1 pb-9 pl-0 font-weight-bolder text-muted font-size-lg text-uppercase white">Jenis Tuntutan</th>
                                                <th class="pt-1 pb-9 text-right font-weight-bolder text-muted font-size-lg text-uppercase white">Tempoh</th>
                                                <th class="pt-1 pb-9 text-right font-weight-bolder text-muted font-size-lg text-uppercase white">Kadar Tuntutan</th>
                                                <th class="pt-1 pb-9 text-right pr-0 font-weight-bolder text-muted font-size-lg text-uppercase white">Jumlah</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr class="font-weight-bolder font-size-lg">
                                                <td class="text-right pt-7">
                                                    Yuran Pengajian
                                                </td>
                                                <td class="text-right pt-7">1 (semester)</td>
                                                <td class="text-right pt-7">RM2500</td>
                                                <td class="pr-0 pt-7 font-size-h6 font-weight-boldest text-right">RM2500</td>
                                            </tr>
                                            <tr class="font-weight-bolder border-bottom-0 font-size-lg">
                                                <td class="text-right pt-7">
                                                    Wang Saku
                                                </td>
                                                <td class="border-top-0 text-right py-4">6 (bulan)</td>
                                                <td class="border-top-0 text-right py-4">RM300</td>
                                                <td class="border-top-0 pr-0 py-4 font-size-h6 font-weight-boldest text-right">RM1800</td>
                                            </tr>
                                            <tr class="font-weight-bolder border-bottom-0 font-size-lg">
                                                <td colspan="3" class="text-right pt-7">
                                                    Keseluruhan
                                                </td>
                                                <td class="border-top-0 pr-0 py-4 font-size-h6 font-weight-boldest text-right">RM4300</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th class="pt-1 pb-9 pl-0 font-weight-bolder text-muted font-size-lg text-uppercase white">Tuntutan</th>
                                                <th class="pt-1 pb-9 text-right pr-0 font-weight-bolder text-muted font-size-lg text-uppercase white">Jumlah</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr class="font-weight-bolder font-size-lg">
                                                <td class="border-top-0 pl-0 pt-7 d-flex align-items-center">
                                                    Pelajar Tuntut
                                                </td>
                                                <td class="pr-0 pt-7 font-size-h6 font-weight-boldest text-right">RM2500</td>
                                            </tr>
                                            <tr class="font-weight-bolder border-bottom-0 font-size-lg">
                                                <td class="border-top-0 pl-0 py-4 d-flex align-items-center">
                                                    Baki
                                                </td>
                                                <td class="border-top-0 pr-0 py-4 font-size-h6 font-weight-boldest text-right">RM1000</td>
                                            </tr>
                                            <tr class="font-weight-bolder border-bottom-0 font-size-lg">
                                                <td class="text-right pt-7">
                                                    Layak
                                                </td>
                                                <td class="border-top-0 pr-0 py-4 font-size-h6 font-weight-boldest text-right"><input type="number" name="layak_tuntut" id="layak_tuntut" value="1500"></td>
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
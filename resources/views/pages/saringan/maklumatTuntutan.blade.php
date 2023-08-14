<x-default-layout> 
    <link rel="stylesheet" href="/assets/css/saringan.css">
    <style>
        table, tr, td{
            border: none!important;
            padding:4px 8px!important;
        }
        .number{
            width: 70px!important;
            text-align: right;
            padding-right:10px!important; 
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
                            <div class="row clearfix">
                                <div class="col-md-6 col-sm-6">
                                    <br>
                                    <table>
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
                                </div>
                                <hr>
                            </div>
                            <form method="POST" action="{{ url('saring-tuntutan') }}" id="saring">
                                {{csrf_field()}}         
                                <table class="calculation">
                                    <tr>
                                        <td colspan="3"><strong>Jumlah Tuntutan:</strong></td>
                                    </tr>
                                    <tr>
                                        <td class="content">Jumlah Yuran (RM)</td>
                                        <td class="content2">2500 x 1 (semester)</td>
                                        <td class="number">2500</td>
                                    </tr>
                                    <tr>
                                        <td class="content">Jumlah Elaun Wang Saku (RM)</td>
                                        <td class="content2">300 x 6 (bulan)</td>
                                        <td class="number">1200</td>
                                    </tr>
                                    <tr>
                                        <td class="content border" colspan="2">Jumlah Keseluruhan (RM)</td>
                                        <td class="number border">3700</td>
                                    </tr>
                                </table>  
                                <br>
                                <table class="calculation">
                                    <tr>
                                        <td colspan="3"><strong>Jumlah Layak Tuntutan:</strong></td>
                                    </tr>
                                    <tr>
                                        <td class="content">Jumlah Pelajar Tuntut (RM)</td>
                                        <td class="number">2500</td>
                                    </tr>
                                    <tr>
                                        <td class="content">Baki Tuntutan (RM)</td>
                                        <td class="number">2000</td>
                                    </tr>
                                    <tr>
                                        <td class="content border">Jumlah Layak Tuntutan (RM)</td>
                                        <td class="border"><input type="number" name="layak_tuntut" id="layak_tuntut" value="2000"></td>
                                    </tr>
                                </table>                                
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
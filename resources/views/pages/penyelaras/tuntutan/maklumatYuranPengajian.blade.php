<x-default-layout> 
    <link rel="stylesheet" href="/assets/css/saringan.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <!-- Main body part  -->
    <style>
        .maklumat, .maklumat td{
            border: none!important;
            padding:4px 8px!important;
        }
        .maklumat2, .maklumat2 td{
            border: none!important;
            padding:8px 10px!important;
        }
        td{
            vertical-align: top!important;
        }
        input[type=date], input[type=number], textarea {
            width: 100%;
            display: inline-block;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
    </style>
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
                                <li class="nav-item vivify swoopInTop delay-150 active"><b>Maklumat Tuntutan Yuran Pengajian</b></li>
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
                                    <table class="maklumat">
                                        <tr>
                                            <td><strong>Nama</strong></td>
                                            <td>:</td>
                                            <td>Choo Mei Ling</td>
                                        </tr>
                                        <tr>
                                            <td><strong>No. Kad Pengenalan</strong></td>
                                            <td>:</td>
                                            <td>001205034745</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Tarikh Tuntutan</strong></td>
                                            <td>:</td>
                                            <td>07/06/2023</td>
                                        </tr>
                                        <tr>
                                            <td><strong>ID Tuntutan</strong></td>
                                            <td>:</td>
                                            <td>KPTBKOKU/3/001205034745</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Jenis Tuntutan</strong></td>
                                            <td>:</td>
                                            <td>Yuran Pengajian</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Sesi/Semester</strong></td>
                                            <td>:</td>
                                            <td>2022/2023-3</td>
                                        </tr>
                                    </table>                           
                                </div>
                            </div>
                            <hr>
                            <form method="post">
                            <div class="row clearfix">
                                <div class="col-md-12">
                                <br>
                                <h6 style="padding-left:10px!important;">Sila lengkapkan maklumat tuntutan.</h6>
                                <br>
                                    <table class="maklumat2">
                                        <tr>
                                            <td>Tarikh Resit</td>
                                            <td>:</td>
                                            <td><input type="date" name="tkh_resit" id="tkh_resit"></td>
                                        </tr>
                                        <tr>
                                            <td>Jumlah Tuntutan (RM)</td>
                                            <td>:</td>
                                            <td><input type="number" name="jumlah" id="jumlah" value="" placeholder="{{number_format(2500, 2)}}"></td>
                                        </tr>
                                        <tr>
                                            <td>Catatan</td>
                                            <td>:</td>
                                            <td><textarea name="catatan" id="catatan" cols="20" rows="4"></textarea></td>
                                        </tr>
                                        <tr>
                                            <td>Salinan Resit Tuntutan</td>
                                            <td>:</td>
                                            <td><input type="file" name="resit" id="resit"></td>
                                        </tr>
                                    </table>
        
                                </div>
                            </div>
                            <div class="row clearfix">
                                <div class="col-md-6">
                                    </div>
                                <div class="col-md-6 text-right">
                                    <button type="submit" name="submit" class="btn btn-primary theme-bg gradient action-btn" value="Simpan" id="check">Simpan</button>
                                </form>
                            </div> 
                        </div>
                    </div>                                       
                </div>
            </div>
        </div>
    </div>
</x-default-layout> 
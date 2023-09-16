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
        .space{
            width: 24%;
        }
        .space2{
            width: 11%;
        }
        h6{
            padding-left:10px!important;
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
                            <div class="col-md-6 col-sm-6">
                                <br>
                                <table class="maklumat">
                                    <tr>
                                        <td><strong>ID Tuntutan</strong></td>
                                        <td>:</td>
                                        <td>KPTBKOKU/3/001205034745</td>
                                        <td class="space">&nbsp;</td>
                                        <td><strong>Tarikh Tuntutan</strong></td>
                                        <td>:</td>
                                        <td>07/06/2023</td>
                                        
                                    </tr>
                                    <tr>
                                        <td><strong>Nama</strong></td>
                                        <td>:</td>
                                        <td>Choo Mei Ling</td>
                                        <td class="space">&nbsp;</td>
                                        <td><strong>Jenis Tuntutan</strong></td>
                                        <td>:</td>
                                        <td>Yuran Pengajian dan Wang Saku</td>
                                    </tr>
                                    <tr>
                                        <td><strong>No. Kad Pengenalan</strong></td>
                                        <td>:</td>
                                        <td>001205034745</td>
                                        <td class="space">&nbsp;</td>
                                        <td><strong>Sesi/Semester</strong></td>
                                        <td>:</td>
                                        <td>2022/2023-3</td>
                                    </tr>
                                </table>                           
                            </div>
                            <hr>
                            <form method="post" action="">
                            <div class="row clearfix">
                                <div class="col-md-12">
                                <br>
                                <h6>Sila lengkapkan maklumat tuntutan.</h6>
                                <br>
                                    <table class="maklumat2">
                                        <tr>
                                            <td colspan="3"><strong>A. Wang Saku</strong></td>
                                            <td class="space2">&nbsp;</td>
                                            <td colspan="3"><strong>B. Yuran Pengajian</strong></td>
                                        </tr>
                                        <tr>
                                            <td>Tarikh Resit</td>
                                            <td>:</td>
                                            <td><input type="date" name="tkh_resit1" id="tkh_resit1"></td>
                                            <td class="space2">&nbsp;</td>
                                            <td>Tarikh Resit</td>
                                            <td>:</td>
                                            <td><input type="date" name="tkh_resit2" id="tkh_resit2"></td>
                                        </tr>
                                        <tr>
                                            <td>Jumlah Tuntutan (RM)</td>
                                            <td>:</td>
                                            <td><input type="number" name="jumlah1" id="jumlah1" placeholder="{{number_format(1800, 2)}}"></td>
                                            <td class="space2">&nbsp;</td>
                                            <td>Jumlah Tuntutan (RM)</td>
                                            <td>:</td>
                                            <td><input type="number" name="jumlah2" id="jumlah2" placeholder="{{number_format(2500, 2)}}"></td>
                                        </tr>
                                        <tr>
                                            <td>Salinan Resit Tuntutan</td>
                                            <td>:</td>
                                            <td><input type="file" name="resit1" id="resit1"></td>
                                            <td class="space2">&nbsp;</td>
                                            <td>Salinan Resit Tuntutan</td>
                                            <td>:</td>
                                            <td><input type="file" name="resit2" id="resit2"></td>
                                        </tr>
                                        <tr>
                                            <td>Keterangan/Deskripsi</td>
                                            <td>:</td>
                                            <td><textarea name="keterangan1" id="keterangan1" cols="20" rows="4"></textarea></td>
                                            <td class="space2">&nbsp;</td>
                                            <td>Keterangan/Deskripsi</td>
                                            <td>:</td>
                                            <td><textarea name="keterangan2" id="keterangan2" cols="20" rows="4"></textarea></td>
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
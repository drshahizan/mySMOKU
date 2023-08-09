<x-default-layout> 
    <link rel="stylesheet" href="assets/css/saringan.css">
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
                                <li class="nav-item vivify swoopInTop delay-150 active"><b>Maklumat Pemohon</b></li>
                            </ul>
                            <div class="ml-auto">
                                <a href="{{ url('cetak-maklumat-pemohon') }}" target="_blank"><button type="button" class="btn btn-sm btn-default" title="Print"><i class="fa fa-print"></i></button></a>
                                {{-- <button type="button" class="btn btn-sm btn-default" title="Delete" onclick="confirmButton()"><i class="fa fa-trash"></i></button> --}}
                            </div>
                        </div>
                    </nav>
                </div>
                <div class="col-lg-12">
                    <div class="card">
                        <div class="body">
                            <div class="d-flex align-items-center">
                                <img class="img" src="https://www.shareicon.net/data/128x128/2016/05/24/770085_man_512x512.png" data-toggle="tooltip" data-placement="top" title="" alt="Avatar" class="w35 h35 rounded" data-original-title="Avatar Name">
                                <div class="ml-3">
                                    Ali Bin Abu
                                    <p class="mb-0">alibinabu@graduate.utm.my</p>
                                </div>
                            </div>
                            <hr>
                            <div class="row clearfix">
                                <div class="col-md-6 col-sm-6">
                                    <p class="m-b-0"><strong>Tarikh Permohonan: </strong> 6/7/2023 </p>
                                    <p><strong>ID Permohonan: </strong> IJAZAHBKOKU0001</p>                                    
                                </div>
                            </div>
                            <form method="POST" action="{{ url('saring-maklumat-pemohon') }}" id="saring">
                                {{csrf_field()}}
                                <div class="row clearfix">
                                    <div class="col-md-12">
                                        <div class="table-responsive">
                                            <table class="table table-hover table-bordered mb-5">
                                                <thead class="table-primary">
                                                    <tr>
                                                        <th style="width: 5%;">Bil</th>                                                        
                                                        <th style="width: 20%;">Item</th>
                                                        <th style="width: 25%;">Keputusan Saringan</th>
                                                        <th style="width: 50%;">Catatan</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>1</td>
                                                        <td>
                                                            <span><a href="{{ url('maklumat-profil-diri') }}" target="_blank">Maklumat Profil Diri</a></span>
                                                        </td>           
                                                        <td class="hidden-sm-down">
                                                        
                                                            <div class="form-group c_form_group">
                                                            <select name="maklumat_profil_diri" class="form-control">
                                                                <option value="">Pilih</option>
                                                                <option value="lengkap">Lengkap</option>
                                                                <option value="tak_lengkap">Tidak Lengkap</option>
                                                            </select>
                                                        </div>
                                                    </td>
                                                <td><div class="form-group c_form_group">
                                                    <label>Berikan Catatan Anda.</label>
                                                    <textarea name="catatan_profil_diri" rows="2" type="text" class="form-control" placeholder=""></textarea>
                                                </div> </td>
                                                    </tr>
                                                    <tr>
                                                        <td>2</td>
                                                        <td>
                                                            <span><a href="{{ url('maklumat-akademik') }}" target="_blank">Maklumat Akademik</a></span>
                                                        </td>
                                                        <td class="hidden-sm-down">
                                                            <div class="form-group c_form_group">
                                                            <select name="maklumat_akademik" class="form-control">
                                                                <option value="">Pilih</option>
                                                                <option value="lengkap">Lengkap</option>
                                                                <option value="tak_lengkap">Tidak Lengkap</option>
                                                            </select>
                                                        </div>
                                                        <td><div class="fancy-checkbox">
                                                            <label><input type="checkbox" name="catatan_maklumat_akademik" value="1"><span>Terdapat butiran yang tidak benar dalam Maklumat Akademik</span></label>
                                                        </div></td>
                                                    </td> 
                                                    </tr>
                                                    <tr>
                                                        <td>3</td>
                                                        <td>
                                                            <span><a href="{{ url('salinan-dokumen') }}" target="_blank">Salinan Dokumen</a></span>
                                                        </td>
                                                        <td class="hidden-sm-down">
                                                            <!--<div class="col-lg-12 col-md-12">-->
                                                            <div class="form-group c_form_group">
                                                            <select name="salinan_dokumen" class="form-control">
                                                                <option value="">Pilih</option>
                                                                <option value="lengkap">Lengkap</option>
                                                                <option value="tak_lengkap">Tidak Lengkap</option>
                                                            </select>
                                                        </div>       
                                                    </td>
                                                    <td>
                                                    <div class="fancy-checkbox">
                                                        <label><input type="checkbox" name="catatan_salinan_dokumen" value="2"><span>Terdapat butiran yang tidak benar dalam Salinan Dokumen</span></label>
                                                    </div></td>
                                                    </tr>                                                
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row clearfix">
                                    <div class="col-md-6 text-right">
                                        <a href="{{ url('suratTawaran') }}" target="_blank" class="btn btn-success btn-round btn-sm"><i class="fa fa-download"></i> Muat Turun Surat Tawaran</a>
                                    </div>
                                </div>
                            </form>
                                    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalCenterTitle">Kembalikan Permohonan</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                </div>
                                                <div class="modal-body text-center">
                                                    <p>Permohonan ini akan dikembalikan kepada pemohon</p>
                                                </div>
                                                <div class="row clearfix">
                                                    <div class="col-lg-12">
                                                        <div class="fancy-checkbox">
                                                            <label><input type="checkbox"><span>Terdapat butiran yang tidak benar dalam Maklumat Profil Diri</span></label>
                                                        </div>
                                                        <div class="fancy-checkbox">
                                                            <label><input type="checkbox" ><span>Terdapat butiran yang tidak benar dalam Maklumat Akademik</span></label>
                                                        </div>
                                                        <div class="fancy-checkbox">
                                                            <label><input type="checkbox"><span>Terdapat butiran yang tidak benar dalam Salinan Dokumen</span></label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <br>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                                                    <a href="saring-permohonan.html"  class="btn btn-primary theme-bg gradient">Ya</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
            
                                </div>
                                
                            </div> 
                        </div>
                    </div>                                       
                </div>
            </div>
        </div>
    </div>
   <script>
    function confirmButton() {
        confirm("Press a button!");
    }
   </script>
</x-default-layout> 
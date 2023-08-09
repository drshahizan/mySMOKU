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
                                <li class="nav-item vivify swoopInTop delay-150 active"><b>Saring Permohonan</b></li>
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
                            <div class="d-flex align-items-center">
                                <img class="img" src="https://www.shareicon.net/data/128x128/2016/05/24/770085_man_512x512.png" data-toggle="tooltip" data-placement="top" title="" alt="Avatar" class="w35 h35 rounded" data-original-title="Avatar Name">
                                <div class="ml-3">
                                    Mohd Ali Bin Abu Kassim
                                    <p class="mb-0">aliabukassim@graduate.utm.my</p>
                                </div>
                            </div>
                            <hr>
                            <div class="row clearfix">
                                <div class="col-md-6 col-sm-6">
                                    <p class="m-b-0"><strong>Tarikh Permohonan: </strong> 7/7/2023 </p>
                                    <p><strong>ID Permohonan: </strong> KPTBKOKUB990404080221</p>                                    
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
                                                    <th style="width: 5%; text-align:right;">No.</th>                                                        
                                                    <th style="width: 20%;">Item</th>
                                                    <th style="width: 25%;">Keputusan Saringan</th>
                                                    <th style="width: 50%;">Catatan</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td style="text-align:right;">1</td>
                                                    <td>
                                                        <span><a href="{{ url('maklumat-akademik') }}" target="_blank">Maklumat Akademik</a></span>
                                                    </td>
                                                    <td class="hidden-sm-down">
                                                        <div class="form-group c_form_group">
                                                        <select id="maklumat_akademik" name="maklumat_akademik" class="form-control" onchange="select1()">
                                                            <option value="">Pilih</option>
                                                            <option value="lengkap">Lengkap</option>
                                                            <option value="tak_lengkap">Tidak Lengkap</option>
                                                        </select>
                                                    </div>
                                                    <td>
                                                    <div class="fancy-checkbox">
                                                        <label>
                                                            <input id="checkbox1a" type="checkbox" name="catatan_maklumat_akademik" value="1" disabled="disabled"><span> Perkara 1</span><br>
                                                            <input id="checkbox1b" type="checkbox" name="catatan_maklumat_akademik" value="1" disabled="disabled"><span> Perkara 2</span><br>
                                                            <input id="checkbox1c" type="checkbox" name="catatan_maklumat_akademik" value="1" disabled="disabled"><span> Perkara 3</span><br>
                                                            <input id="checkbox1d" type="checkbox" name="catatan_maklumat_akademik" value="1" disabled="disabled"><span> Perkara 4</span>
                                                        </label>
                                                    </div></td>
                                                </td> 
                                                </tr>                                 
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row clearfix">
                                <div class="col-md-6">
                                    </div>
                                <div class="col-md-6 text-right">
                                    <button type="submit" name="submit" class="btn btn-primary theme-bg gradient action-btn" value="Simpan">Teruskan</button>
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
                                                            <label><input id="checkbox" type="checkbox"><span>Terdapat butiran yang tidak benar dalam Maklumat Profil Diri</span></label>
                                                        </div>
                                                        <div class="fancy-checkbox">
                                                            <label><input id="checkbox" type="checkbox" ><span>Terdapat butiran yang tidak benar dalam Maklumat Akademik</span></label>
                                                        </div>
                                                        <div class="fancy-checkbox">
                                                            <label><input id="checkbox" type="checkbox"><span>Perkara </span></label>
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
        function select1(){
            var catatan1 = document.getElementById('maklumat_akademik').value;
            if(catatan1=="tak_lengkap"){
                document.getElementById("checkbox1a").disabled = false;
                document.getElementById("checkbox1b").disabled = false;
                document.getElementById("checkbox1c").disabled = false;
                document.getElementById("checkbox1d").disabled = false;
            }
            else{
                document.getElementById("checkbox1a").disabled = true;
                document.getElementById("checkbox1b").disabled = true;
                document.getElementById("checkbox1c").disabled = true;
                document.getElementById("checkbox1d").disabled = true;
            }
        }

        function confirmButton() {
            confirm("Press a button!");
        }
   </script>
</x-default-layout> 
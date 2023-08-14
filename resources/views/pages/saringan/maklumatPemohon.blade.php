<x-default-layout> 
    <link rel="stylesheet" href="/assets/css/saringan.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
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
                                    {{$pelajar->nama_pelajar}}
                                    <p class="mb-0">{{$pelajar->email}}</p>
                                </div>
                            </div>
                            <hr>
                            <div class="row clearfix">
                                <div class="col-md-6 col-sm-6">
                                    <p class="m-b-0"><strong>Tarikh Permohonan: </strong> {{$permohonan->created_at->format('d/m/Y')}} </p>
                                    <p><strong>ID Permohonan: </strong> {{$permohonan->id_permohonan}} </p>                                    
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
                                                        <span><a href="{{ url('maklumat-profil-diri/'.$pelajar->nokp_pelajar) }}" target="_blank">Maklumat Profil Diri</a></span>
                                                    </td>           
                                                    <td class="hidden-sm-down">
                                                       
                                                        <div class="form-group c_form_group">
                                                        <select id="maklumat_profil_diri" name="maklumat_profil_diri" class="form-control" onchange="select1()" oninvalid="this.setCustomValidity('Sila pilih item dalam senarai')" oninput="setCustomValidity('')" required>
                                                            <option value="">Pilih</option>
                                                            <option value="lengkap">Lengkap</option>
                                                            <option value="tak_lengkap">Tidak Lengkap</option>
                                                        </select>
                                                    </div>
                                                </td>
                                                <td><div class="form-group c_form_group">
                                                    <label>Berikan Catatan Anda.</label>
                                                    <textarea id="textarea1" rows="2" type="text" class="form-control" placeholder="" disabled="disabled" oninvalid="this.setCustomValidity('Sila isi ruang ini')" oninput="setCustomValidity('')" required></textarea>
                                                </div> </td>
                                                </tr>
                                                <tr>
                                                    <td style="text-align:right;">2</td>
                                                    <td>
                                                        <span><a href="{{ url('maklumat-akademik/'.$pelajar->nokp_pelajar) }}" target="_blank">Maklumat Akademik</a></span>
                                                    </td>
                                                    <td class="hidden-sm-down">
                                                        <div class="form-group c_form_group">
                                                        <select id="maklumat_akademik" name="maklumat_akademik" class="form-control" onchange="select2()" oninvalid="this.setCustomValidity('Sila pilih item dalam senarai')" oninput="setCustomValidity('')" required>
                                                            <option value="">Pilih</option>
                                                            <option value="lengkap">Lengkap</option>
                                                            <option value="tak_lengkap">Tidak Lengkap</option>
                                                        </select>
                                                    </div>
                                                    <td>
                                                    <div class="checkbox-group">
                                                        <input class="checkbox1" id="checkbox2a" type="checkbox" name="catatan_maklumat_akademik" value="2" disabled="disabled"><span> Perkara 1</span><br>
                                                        <input class="checkbox1" id="checkbox2b" type="checkbox" name="catatan_maklumat_akademik" value="2" disabled="disabled"><span> Perkara 2</span><br>
                                                        <input class="checkbox1" id="checkbox2c" type="checkbox" name="catatan_maklumat_akademik" value="2" disabled="disabled"><span> Perkara 3</span><br>
                                                        <input class="checkbox1" id="checkbox2d" type="checkbox" name="catatan_maklumat_akademik" value="2" disabled="disabled"><span> Perkara 4</span>
                                                        <p id="checkedValue"></p>
                                                    </div></td>
                                                </td> 
                                                </tr>
                                                <tr>
                                                    <td style="text-align:right;">3</td>
                                                    <td>
                                                        <span><a href="{{ url('salinan-dokumen/'.$pelajar->nokp_pelajar) }}" target="_blank">Salinan Dokumen</a></span>
                                                    </td>
                                                    <td class="hidden-sm-down">
                                                        <!--<div class="col-lg-12 col-md-12">-->
                                                        <div class="form-group c_form_group">
                                                        <select id="salinan_dokumen" name="salinan_dokumen" class="form-control" onchange="select3()" oninvalid="this.setCustomValidity('Sila pilih item dalam senarai')" oninput="setCustomValidity('')" required>
                                                            <option value="">Pilih</option>
                                                            <option value="lengkap">Lengkap</option>
                                                            <option value="tak_lengkap">Tidak Lengkap</option>
                                                        </select>
                                                    </div>       
                                                </td>
                                                <td>
                                                    <div class="checkbox-group">
                                                        <input class="checkbox2" id="checkbox3a" type="checkbox" name="catatan_salinan_dokumen" value="3" disabled="disabled"><span> Ralat pada surat tawaran</span><br>
                                                        <input class="checkbox2" id="checkbox3b" type="checkbox" name="catatan_salinan_dokumen" value="3" disabled="disabled"><span> Ralat pada penyata bank</span><br>
                                                        <input class="checkbox2" id="checkbox3c" type="checkbox" name="catatan_salinan_dokumen" value="3" disabled="disabled"><span> Ralat pada resit</span><br>
                                                        <input class="checkbox2" id="checkbox3d" type="checkbox" name="catatan_salinan_dokumen" value="3" disabled="disabled"><span> Ralat pada keputusan peperiksaan</span>
                                                    </div></td>
                                                </tr>                                                
                                            </tbody>
                                        </table>
                                        <span id="checkedValue"></span>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row clearfix">
                                <div class="col-md-6">
                                    </div>
                                <div class="col-md-6 text-right">
                                    <button type="submit" name="submit" class="btn btn-primary theme-bg gradient action-btn" value="Simpan" id="check">Teruskan</button>
                                </form>                                
                            </div> 
                        </div>
                    </div>                                       
                </div>
            </div>
        </div>
    </div>
    <script> 
        var btn = document.getElementById('check');
        btn.addEventListener('click', function() {
            if (document.getElementById('checkbox2a').checked||document.getElementById('checkbox2b').checked||document.getElementById('checkbox2c').checked||document.getElementById('checkbox2d').checked) {
                document.getElementById("checkbox2a").required = false;
            }
            else{
                document.getElementById("checkbox2a").required = true;
            }
        })

        btn.addEventListener('click', function() {
            if (document.getElementById('checkbox3a').checked||document.getElementById('checkbox3b').checked||document.getElementById('checkbox3c').checked||document.getElementById('checkbox3d').checked) {
                document.getElementById("checkbox3a").required = false;
            }
            else{
                document.getElementById("checkbox3a").required = true;
            }
        })

        

        function select1(){
            var catatan1 = document.getElementById('maklumat_profil_diri').value;
            if(catatan1=="tak_lengkap"){
                document.getElementById("textarea1").disabled = false;
            }
            else{
                document.getElementById("textarea1").disabled = true;
            }
        }
        
        function select2(){
            var catatan1 = document.getElementById('maklumat_akademik').value;
            if(catatan1=="tak_lengkap"){
                document.getElementById("checkbox2a").disabled = false;
                document.getElementById("checkbox2b").disabled = false;
                document.getElementById("checkbox2c").disabled = false;
                document.getElementById("checkbox2d").disabled = false;
            }
            else{
                document.getElementById("checkbox2a").disabled = true;
                document.getElementById("checkbox2b").disabled = true;
                document.getElementById("checkbox2c").disabled = true;
                document.getElementById("checkbox2d").disabled = true;
            }
        }

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
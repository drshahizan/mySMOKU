<x-default-layout> 
    <link rel="stylesheet" href="/assets/css/saringan.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <!-- Main body part  -->
    <style>
        .maklumat, .maklumat td{
            border: none!important;
            padding:2px 8px!important;
        }
        td{
            vertical-align: top!important;
        }
        .space{
            width: 15%;
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
                                <div class="col-md-6 col-sm-6">
                                    <br>
                                    @php
                                        $akademik = DB::table('maklumatakademik')->where('nokp_pelajar', $pelajar->nokp_pelajar)->first();
                                    @endphp
                                    <table class="maklumat">
                                        <tr>
                                            <td><strong>ID Permohonan</strong></td>
                                            <td>:</td>
                                            <td>{{$permohonan->id_permohonan}}</td>
                                            <td class="space">&nbsp;</td>
                                            <td><strong>Tarikh Permohonan</strong></td>
                                            <td>:</td>
                                            <td>{{$permohonan->created_at->format('d/m/Y')}}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Nama</strong></td>
                                            <td>:</td>
                                            <td>{{$pelajar->nama_pelajar}}</td>
                                            <td class="space">&nbsp;</td>
                                            <td><strong>Semester Semasa</strong></td>
                                            <td>:</td>
                                            <td>{{$akademik->sem_semasa}}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>No. Kad Pengenalan</strong></td>
                                            <td>:</td>
                                            <td>{{$pelajar->nokp_pelajar}}</td>
                                        </tr>
                                    </table>                           
                                </div>
                                <br>
                            <form method="POST" action="{{ url('saring-maklumat-pemohon/'.$pelajar->nokp_pelajar) }}" id="saring">
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
                                                    <input class="checkbox1a" id="checkbox1a" type="checkbox" name="catatan_maklumat_profil_diri[]" value="Terdapat maklumat yang tidak benar pada Maklumat Profil Diri" disabled="disabled"><span> Terdapat maklumat yang tidak benar pada Maklumat Profil Diri</span><br>
                                                    <input class="checkbox1b" id="checkbox1b" type="checkbox" name="catatan_maklumat_profil_diri[]" value="Terdapat maklumat yang tidak lengkap pada Maklumat Profil Diri" disabled="disabled"><span> Terdapat maklumat yang tidak lengkap pada Maklumat Profil Diri</span><br>
                                                </div> </td>
                                                </tr>
                                                <tr>
                                                    <td style="text-align:right;">2</td>
                                                    <td>
                                                        <span><a href="{{ url('maklumat-akademik/'.$pelajar->nokp_pelajar) }}" target="_blank">Maklumat Akademik</a></span>
                                                    </td>
                                                    <td class="hidden-sm-down">
                                                        <div class="form-group c_form_group">
                                                        <select id="maklumat_akademik" name="maklumat_akademik" class="form-control" onchange="select2()"  oninvalid="this.setCustomValidity('Sila tandakan sekurang-kurangnya satu kotak')" oninput="setCustomValidity('')" required>
                                                            {{-- oninvalid="this.setCustomValidity('Sila pilih item dalam senarai')" oninput="setCustomValidity('')"  --}}
                                                            <option value="">Pilih</option>
                                                            <option value="lengkap">Lengkap</option>
                                                            <option value="tak_lengkap">Tidak Lengkap</option>
                                                        </select>
                                                    </div>
                                                    <td>
                                                    <div class="checkbox-group">
                                                        <input class="checkbox2a" id="checkbox2a" type="checkbox" name="catatan_maklumat_akademik[]" value="Terdapat maklumat yang tidak benar pada Maklumat Akademik" disabled="disabled"><span> Terdapat maklumat yang tidak benar pada Maklumat Akademik</span><br>
                                                        <input class="checkbox2b" id="checkbox2b" type="checkbox" name="catatan_maklumat_akademik[]" value="Terdapat maklumat yang tidak lengkap pada Maklumat Akademik" disabled="disabled"><span> Terdapat maklumat yang tidak lengkap pada Maklumat Akademik</span><br>
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
                                                        <input class="checkbox3a" id="checkbox3a" type="checkbox" name="catatan_salinan_dokumen[]" value="Ralat pada surat tawaran" disabled="disabled"><span> Ralat pada surat tawaran</span><br>
                                                        <input class="checkbox3b" id="checkbox3b" type="checkbox" name="catatan_salinan_dokumen[]" value="Ralat pada penyata bank" disabled="disabled"><span> Ralat pada penyata bank</span><br>
                                                        <input class="checkbox3c" id="checkbox3c" type="checkbox" name="catatan_salinan_dokumen[]" value="Ralat pada resit" disabled="disabled"><span> Ralat pada resit</span><br>
                                                        <input class="checkbox3d" id="checkbox3d" type="checkbox" name="catatan_salinan_dokumen[]" value="Ralat pada keputusan peperiksaan" disabled="disabled"><span> Ralat pada keputusan peperiksaan</span>
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
            if (document.getElementById('checkbox1a').checked||document.getElementById('checkbox1b').checked) {
                document.getElementById("checkbox1a").required = false;
            }
            else{
                document.getElementById("checkbox1a").required = true;
            }

            if (document.getElementById('checkbox2a').checked||document.getElementById('checkbox2b').checked) {
                document.getElementById("checkbox2a").required = false;
            }
            else{
                document.getElementById("checkbox2a").required = true;
            }

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
                document.getElementById("checkbox1a").disabled = false;
                document.getElementById("checkbox1b").disabled = false;
            }
            else{
                document.getElementById("checkbox1a").disabled = true;
                document.getElementById("checkbox1b").disabled = true;
            }
        }
        
        function select2(){
            var catatan1 = document.getElementById('maklumat_akademik').value;
            if(catatan1=="tak_lengkap"){
                document.getElementById("checkbox2a").disabled = false;
                document.getElementById("checkbox2b").disabled = false;
                // document.getElementById("checkbox2c").disabled = false;
                // document.getElementById("checkbox2d").disabled = false;
            }
            else{
                document.getElementById("checkbox2a").disabled = true;
                document.getElementById("checkbox2b").disabled = true;
                // document.getElementById("checkbox2c").disabled = true;
                // document.getElementById("checkbox2d").disabled = true;
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
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
        input[type=text]{
            width: 65%;
            display: inline-block;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
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
		</ul>
	<!--end::Breadcrumb-->
	</div>
	<!--end::Page title-->
    <br>

    <div id="main-content">
        <div class="container-fluid">
            <!-- Page header section  -->
            <div class="row clearfix">
                <div class="col-12">
                    <nav class="navbar navbar-expand-lg navbar-light bg-light page_menu">
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                        <i class="fa fa-bars text-muted"></i>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarNavDropdown">
                            <ul class="navbar-nav mr-auto">
                                <li class="nav-item vivify swoopInTop delay-150 active"><b>Maklumat Permohonan</b></li>
                            </ul>
                             <div class="ml-auto">
                                <a href="{{ url('permohonan/sekretariat/saringan/set-semula-status/'.$permohonan->id) }}" class="btn btn-primary btn-sm">Set Semula Saringan</a>
                            </div>
                        </div>
                    </nav>
                </div>

                <div class="col-12">
                    <div class="card">
                        <div class="body">
                            <div class="col-md-6 col-sm-6">
                                <br>
                                @php
                                    // nama pemohon
                                    $text = ucwords(strtolower($smoku->nama)); // Assuming you're sending the text as a POST parameter
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
                                @endphp
                                <table class="maklumat">
                                    <tr>
                                        <td><strong>ID Permohonan</strong></td>
                                        <td>:</td>
                                        <td>{{$permohonan->no_rujukan_permohonan}}</td>
                                        <td class="space">&nbsp;</td>
                                        <td><strong>Tarikh Permohonan</strong></td>
                                        <td>:</td>
                                        <td>{{date('d/m/Y', strtotime($permohonan->tarikh_hantar))}}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Nama</strong></td>
                                        <td>:</td>
                                        <td>{{$pemohon}}</td>
                                        <td class="space">&nbsp;</td>
                                        <td><strong>Sesi/Semester</strong></td>
                                        <td>:</td>
                                        <td>{{$akademik->sesi}}-0{{$akademik->sem_semasa}}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>No. Kad Pengenalan</strong></td>
                                        <td>:</td>
                                        <td>{{$smoku->no_kp}}</td>
                                    </tr>
                                </table>
                            </div>

                            <br>

                            <form method="POST" action="{{ url('permohonan/sekretariat/saringan/saring-permohonan/'.$permohonan->id) }}" id="saring">
                                {{csrf_field()}}
                                <div class="row clearfix">
                                    <div class="col-md-12">
                                        <div class="table-responsive">
                                            <table class="table table-bordered">
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
                                                        <span><a href="{{ url('permohonan/sekretariat/saringan/maklumat-profil-diri/'.$permohonan->id) }}" target="_blank">Maklumat Profil Diri</a></span>
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
                                                    <td>
                                                        <div class="form-group c_form_group">
                                                            <input class="checkbox1a" id="checkbox1a" type="checkbox" name="catatan_maklumat_profil_diri[]" value="Terdapat maklumat yang tidak benar pada Maklumat Profil Diri" disabled="disabled"><span> Terdapat maklumat yang tidak benar pada Maklumat Profil Diri</span><br>
                                                            <input class="checkbox1b" id="checkbox1b" type="checkbox" name="catatan_maklumat_profil_diri[]" value="Terdapat maklumat yang tidak lengkap pada Maklumat Profil Diri" disabled="disabled"><span> Terdapat maklumat yang tidak lengkap pada Maklumat Profil Diri</span><br>
                                                            <input class="checkbox1c" id="checkbox1c" type="checkbox" name="catatan_maklumat_profil_diri[]" value="" disabled="disabled"><span> Lain-lain: <input type="text" name="lain1" id="lain1" disabled="disabled"></span><br>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="text-align:right;">2</td>
                                                    <td>
                                                        <span><a href="{{ url('permohonan/sekretariat/saringan/maklumat-akademik/'.$permohonan->id) }}" target="_blank">Maklumat Akademik</a></span>
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
                                                            <input class="checkbox2c" id="checkbox2c" type="checkbox" name="catatan_maklumat_akademik[]" value="" disabled="disabled"><span> Lain-lain: <input type="text" name="lain2" id="lain2" disabled="disabled"></span><br>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="text-align:right;">3</td>
                                                    <td>
                                                        <span><a href="{{ url('permohonan/sekretariat/saringan/salinan-dokumen/'.$permohonan->id) }}" target="_blank">Salinan Dokumen</a></span>
                                                    </td>
                                                    <td class="hidden-sm-down">
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
                                                            <input class="checkbox3c" id="checkbox3c" type="checkbox" name="catatan_salinan_dokumen[]" value="Ralat pada resit" disabled="disabled"><span> Ralat pada resit/invois</span><br>
                                                            <input class="checkbox3d" id="checkbox3d" type="checkbox" name="catatan_salinan_dokumen[]" value="Ralat pada keputusan peperiksaan" disabled="disabled"><span> Ralat pada keputusan peperiksaan</span><br>
                                                            <input class="checkbox3e" id="checkbox3e" type="checkbox" name="catatan_salinan_dokumen[]" value="" disabled="disabled"><span> Lain-lain: <input type="text" name="lain3" id="lain3" disabled="disabled"></span>
                                                        </div>
                                                    </td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

                                    <div class="col-md-12 text-right">
                                        <button type="submit" name="submit" class="btn btn-primary theme-bg gradient action-btn" value="Simpan" id="check" style="margin-bottom: 10px;">Teruskan</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        var btn = document.getElementById('check');
        btn.addEventListener('click', function() {
            if (document.getElementById('checkbox1a').checked||document.getElementById('checkbox1b').checked||document.getElementById('checkbox1c').checked) {
                document.getElementById("checkbox1a").required = false;
            }
            else{
                document.getElementById("checkbox1a").required = true;
            }

            if (document.getElementById('checkbox2a').checked||document.getElementById('checkbox2b').checked||document.getElementById('checkbox2c').checked) {
                document.getElementById("checkbox2a").required = false;
            }
            else{
                document.getElementById("checkbox2a").required = true;
            }

            if (document.getElementById('checkbox3a').checked||document.getElementById('checkbox3b').checked||document.getElementById('checkbox3c').checked||document.getElementById('checkbox3d').checked||document.getElementById('checkbox3e').checked) {
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
                document.getElementById("checkbox1c").disabled = false;
            }
            else{
                document.getElementById("checkbox1a").disabled = true;
                document.getElementById("checkbox1b").disabled = true;
                document.getElementById("checkbox1c").disabled = true;
            }
        }

        function select2(){
            var catatan1 = document.getElementById('maklumat_akademik').value;
            if(catatan1=="tak_lengkap"){
                document.getElementById("checkbox2a").disabled = false;
                document.getElementById("checkbox2b").disabled = false;
                document.getElementById("checkbox2c").disabled = false;
                // document.getElementById("checkbox2d").disabled = false;
            }
            else{
                document.getElementById("checkbox2a").disabled = true;
                document.getElementById("checkbox2b").disabled = true;
                document.getElementById("checkbox2c").disabled = true;
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
                document.getElementById("checkbox3e").disabled = false;
            }
            else{
                document.getElementById("checkbox3a").disabled = true;
                document.getElementById("checkbox3b").disabled = true;
                document.getElementById("checkbox3c").disabled = true;
                document.getElementById("checkbox3d").disabled = true;
                document.getElementById("checkbox3e").disabled = true;
            }
        }
        //enable input text 'lain-lain'
        document.getElementById("checkbox1c").addEventListener('click', function() {
            if(document.getElementById("checkbox1c").checked){
                document.getElementById("lain1").required = true;
                document.getElementById("lain1").disabled = false;
            }
            else{
                document.getElementById("lain1").disabled = true;
            }
        })
        document.getElementById("checkbox2c").addEventListener('click', function() {
            if(document.getElementById("checkbox2c").checked){
                document.getElementById("lain2").required = true;
                document.getElementById("lain2").disabled = false;
            }
            else{
                document.getElementById("lain2").disabled = true;
            }
        })
        document.getElementById("checkbox3e").addEventListener('click', function() {
            if(document.getElementById("checkbox3e").checked){
                document.getElementById("lain3").required = true;
                document.getElementById("lain3").disabled = false;
            }
            else{
                document.getElementById("lain3").disabled = true;
            }
        })

        //get input text 'lain-lain' value
        document.getElementById("lain1").addEventListener('input', function() {
            document.getElementById("checkbox1c").value = document.getElementById("lain1").value;
        })
        document.getElementById("lain2").addEventListener('input', function() {
            document.getElementById("checkbox2c").value = document.getElementById("lain2").value;
        })
        document.getElementById("lain3").addEventListener('input', function() {
            document.getElementById("checkbox3e").value = document.getElementById("lain3").value;
        })

    </script>
</x-default-layout>

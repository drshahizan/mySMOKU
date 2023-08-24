<x-default-layout>
    <head>
        <title>Sekretariat BKOKU KPT</title>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">

        <!-- MAIN CSS -->
        <link rel="stylesheet" href="/assets/css/sekretariat.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js"></script>
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9">
        <!-- CSS -->
        <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css"/>
        <!-- Default theme -->
        <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/default.min.css"/>
    </head>

    <body>
        <!-- Main body part  -->
        <div id="main-content">
            <div class="container-fluid">
                <div class="block-header">
                    <div class="row clearfix">
                        {{-- Filter Function --}}
                            {{-- <form action="" method="GET">
                                <div class="row">
                                    <div class="col-md-2">
                                        <input type="date" name="date" value="{{Request::get('date')?? ' '}}" class="form-control"/>
                                    </div>
    
                                    <div class="col-md-6">
                                        <button type="submit" class="btn btn-primary" style="width: 10%;"><i class="fa fa-filter" style="font-size: 15px;"></i></button>
                                    </div>
                                </div>
                            </form>
                            --}}

                        <div class="card">
                            <div class="header">
                                {{-- <small>Sila klik pada ID permohonan untuk meluluskan permohonan</small> --}}
                                <h1><b>Senarai Permohonan untuk Kelulusan JKKBKOKU</b></h1>
                                <ul class="header-dropdown dropdown" style="color: black;">
                                    <li><a href="{{ url('cetak-senarai-pemohon') }}" target="_blank" class="btn btn-secondary btn-round btn-sm"><i class="fa fa-file-pdf" style="color: black;"></i> PDF</a></li>
                                    <li><a href="{{ url('senarai-disokong-excel') }}" target="_blank" class="btn btn-secondary btn-round btn-sm"><i class="fa fa-file-excel" style="color: black;"></i> Excel</a></li>
                                </ul>
                            </div>

                            <div class="table-responsive">
                                <div class="body">
                                    <form action="{{ url('hantar-keputusan') }}" method="POST">
                                        {{csrf_field()}}
                                        <table id="sortTable" class="table table-bordered table-striped">
                                            <thead>
                                                <tr>
                                                    <th class="text-center" style="width:3%;"><input type="checkbox" name="select-all" id="select-all" onclick="toggle(this);" /></th>
                                                    <th class="text-center" style="width: 10%"><b>ID Permohonan</b></th>                                                   
                                                    <th class="text-center" style="width: 20%"><b>Nama</b></th>
                                                    <th class="text-center" style="width: 10%"><b>Jenis Kecacatan</b></th>
                                                    {{-- <th class="text-center" style="width: 10%"><b>Tahap Pengajian</b></th> --}}
                                                    <th class="text-center" style="width: 17%"><b>Nama Kursus</b></th>
                                                    <th class="text-center" style="width: 20%"><b>Institusi Pengajian</b></th>
                                                    <th class="text-center" style="width: 10%"><b>Tarikh Mula Pengajian</b></th>
                                                    <th class="text-center" style="width: 10%"><b>Tarikh Tamat Pengajian</b></th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                @php
                                                    $i=0;
                                                @endphp
                                                @foreach ($akademik as $item)
                                                    {{-- @if ($item['status']=="4") --}}
                                                        @php
                                                            $i++;
                                                            $id_permohonan = DB::table('permohonan')->where('nokp_pelajar', $item['nokp_pelajar'])->value('id_permohonan');
                                                            $nama_pemohon = DB::table('pelajar')->where('nokp_pelajar', $item['nokp_pelajar'])->value('nama_pelajar');
                                                            $jenis_kecacatan = DB::table('pelajar')->join('bk_jenisoku','bk_jenisoku.kodoku','=','pelajar.kecacatan' )->where('nokp_pelajar', $item['nokp_pelajar'])->value('bk_jenisoku.kecacatan'); //PH,SD
                                                            $nama_kursus = DB::table('maklumatakademik')->value('nama_kursus');
                                                            $institusi_pengajian = DB::table('bk_infoipt')->where('idipt', $item['id_institusi'])->value('namaipt');
                                                            // $mula_pengajian = DB::table('maklumatakademik')->value('tkh_mula');
                                                            // $tamat_pengajian = DB::table('maklumatakademik')->value('tkh_tamat');

                                                            // nama pemohon
                                                            $text = ucwords(strtolower($nama_pemohon)); // Assuming you're sending the text as a POST parameter
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

                                                            //nama kursus
                                                            $text2 = ucwords(strtolower($nama_kursus)); // Assuming you're sending the text as a POST parameter
                                                            $conjunctions = ['of', 'in', 'and'];
                                                            $words = explode(' ', $text2);
                                                            $result = [];
                                                            foreach ($words as $word) {
                                                                if (in_array(Str::lower($word), $conjunctions)) {
                                                                    $result[] = Str::lower($word);
                                                                } else {
                                                                    $result[] = $word;
                                                                }
                                                            }
                                                            $kursus = implode(' ', $result);

                                                            //institusi pengajian
                                                            $text3 = ucwords(strtolower($institusi_pengajian)); // Assuming you're sending the text as a POST parameter
                                                            $conjunctions = ['of', 'in', 'and'];
                                                            $words = explode(' ', $text3);
                                                            $result = [];
                                                            foreach ($words as $word) {
                                                                if (in_array(Str::lower($word), $conjunctions)) {
                                                                    $result[] = Str::lower($word);
                                                                } else {
                                                                    $result[] = $word;
                                                                }
                                                            }
                                                            $institusi = implode(' ', $result);
                                                        @endphp
                                                        <tr>
                                                            
                                                            <td class="text-center"><input type="checkbox" name="checkbox-1" id="checkbox-1" /></td>                                           
                                                            <td><a href="{{ url('maklumat-keputusan') }}" target="_blank">{{$id_permohonan}}</a></td>
                                                            <td>{{$pemohon}}</td>
                                                            <td>{{ucwords(strtolower($jenis_kecacatan))}}</td>                                       
                                                            <td>{{$kursus}}</td>
                                                            <td>{{$institusi}}</td>
                                                            {{-- <td>{{$item['tkh_mula']->format('d/m/Y')}}</td> --}}
                                                            <td class="text-center">{{date('d/m/Y', strtotime($item['tkh_mula']))}}</td>
                                                            <td class="text-center">{{date('d/m/Y', strtotime($item['tkh_tamat']))}}</td>
                                                        </tr>
                                                    {{-- @endif --}}
                                                @endforeach 
                                                {{-- <tr>
                                                    <td class="text-center"><input type="checkbox" name="checkbox-2" id="checkbox-2" /></td>                                          
                                                    <td><a href="{{ url('maklumat-keputusan') }}" target="_blank">KPTBKOKU/2/970703041223</a></td>
                                                    <td>Mohd Ali Bin Abu Kassim</td>
                                                    <td>Penglihatan</td>
                                                    <td>Diploma In Information And Communication Technology</td>
                                                    <td>INTI</td>
                                                    <td class="text-center">03/09/2019</td>
                                                    <td class="text-center">27/07/2023</td>
                                                </tr> 
                                                <tr> 
                                                    <td class="text-center"><input type="checkbox" name="checkbox-3" id="checkbox-3" /></td>                                           
                                                    <td><a href="{{ url('maklumat-keputusan') }}" target="_blank">KPT/BKOKU/3/970204052445</a></td>
                                                    <td>Sarah Binti Yusri</td>
                                                    <td>Penglihatan</td>
                                                    <td>Bachelor Of Science In Psychology With Management</td>
                                                    <td>UiTM(Shah Alam)</td>
                                                    <td class="text-center">15/09/2019</td>
                                                    <td class="text-center">05/07/2023</td>
                                                </tr> 
                                                <tr>
                                                    <td class="text-center"><input type="checkbox" name="checkbox-4" id="checkbox-4" /></td>                                           
                                                    <td><a href="{{ url('maklumat-keputusan') }}" target="_blank">KPT/BKOKU/5/970703041223</a></td>
                                                    <td>Santosh A/L Ariyaran</td>
                                                    <td>Fizikal</td>
                                                    <td>Master Of Science Data Science</td>
                                                    <td>UTP</td>                                     
                                                    <td class="text-center">10/7/2021</td>
                                                    <td class="text-center">03/08/2024</td>
                                                </tr> 
                                                <tr>
                                                    <td class="text-center"><input type="checkbox" name="checkbox-5" id="checkbox-5" /></td>                                           
                                                    <td><a href="{{ url('maklumat-keputusan') }}" target="_blank">KPT/BKOKU/6/960909105668</a></td>
                                                    <td>Ling Kai Jie</td>
                                                    <td>Pertuturan</td>                                        
                                                    <td>Doctor Of Philosophy (Phd) In Social Science And Humanities</td>
                                                    <td>UiTM(Shah Alam)</td>
                                                    <td class="text-center">08/07/2022</td>
                                                    <td class="text-center">08/07/2024</td>
                                                </tr> 
                                                <tr>
                                                    <td class="text-center"><input type="checkbox" name="checkbox-6" id="checkbox-6" /></td>                                           
                                                    <td><a href="{{ url('maklumat-keputusan') }}" target="_blank">KPT/BKOKU/6/950804082447</a></td>
                                                    <td>Akmal Bin Kairuddin</td>
                                                    <td>Pertuturan</td>                                        
                                                    <td>Doctor Of Philosophy (Phd) Creative Industries & Art Practice</td>
                                                    <td>Universiti Limkokwing</td>
                                                    <td class="text-center">07/07/2023</td>
                                                    <td class="text-center">18/07/2025</td>
                                                </tr>
                                                <tr>
                                                    <td class="text-center"><input type="checkbox" name="checkbox-7" id="checkbox-7" /></td>                                           
                                                    <td><a href="{{ url('maklumat-keputusan') }}" target="_blank">KPT/BKOKU/3/021212050334</a></td>
                                                    <td>Santishwaran A/L Paven</td>
                                                    <td>Pertuturan</td>                                        
                                                    <td>Bachelor Of Science Computer Science</td>
                                                    <td>UTM</td>
                                                    <td class="text-center">05/09/2021</td>
                                                    <td class="text-center">05/08/2025</td>
                                                </tr>
                                                <tr>
                                                    <td class="text-center"><input type="checkbox" name="checkbox-8" id="checkbox-8" /></td>                                           
                                                    <td><a href="{{ url('maklumat-keputusan') }}" target="_blank">KPT/PPK/3/990201065225</a></td>
                                                    <td>Ezra Hanisah Binti Md Yunos</td>
                                                    <td>Pendengaran</td>                                    
                                                    <td>Bachelor Of Science Computer Science</td>
                                                    <td>UTM</td>
                                                    <td class="text-center">05/09/2020</td>
                                                    <td class="text-center">05/07/2024</td>
                                                </tr>
                                                <tr>
                                                    <td class="text-center"><input type="checkbox" name="checkbox-9" id="checkbox-9" /></td>                                           
                                                    <td><a href="{{ url('maklumat-keputusan') }}" target="_blank">KPT/BKOKU/3/010305058473</a></td>
                                                    <td>Arshahad Bin Kairul Zaman</td>
                                                    <td>Fizikal</td>                                        
                                                    <td>Bachelor Of Public Administration (Honours)</td>
                                                    <td>UiTM(Dungun)</td>
                                                    <td class="text-center">07/09/2021</td>
                                                    <td class="text-center">20/07/2025</td>
                                                </tr>
                                                <tr>
                                                    <td class="text-center"><input type="checkbox" name="checkbox-10" id="checkbox-10" /></td>                                           
                                                    <td><a href="{{ url('maklumat-keputusan') }}" target="_blank">KPT/BKOKU/3/981004045253</a></td>
                                                    <td>Syed Abdul Kassim Hussain Yusof</td>
                                                    <td>Pembelajaran</td>
                                                    <td>Bachelor Of Business Administration (Honours) Healthcare Management</td>
                                                    <td>UiTM(Shah Alam)</td>                                        
                                                    <td class="text-center">05/09/2022</td>
                                                    <td class="text-center">20/07/2025</td>
                                                </tr> --}}
                                            </tbody>
                                        </table>

                                        <!-- Button trigger modal -->
                                        <button type="button" class="btn btn-primary btn-round float-end" data-bs-toggle="modal" data-bs-target="#pengesahanModal">
                                            Sahkan
                                        </button>
                                    
                                        {{-- Modal --}}
                                        <div class="modal fade" id="pengesahanModal" tabindex="-1" aria-labelledby="pengesahanModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                              <div class="modal-content">
                                                <div class="modal-header">
                                                  <h1 class="modal-title fs-5" id="pengesahanModalLabel">Rekod Keputusan Permohonan</h1>
                                                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>

                                                <div class="modal-body">
                                                    <form  action="{{ url('hantar-keputusan') }}" method="POST">
                                                        {{csrf_field()}}
                                                        <div class="mb-3">
                                                            <label for="recipient-name" class="col-form-label">No. Mesyuarat:</label>
                                                            <input type="text" class="form-control" id="no">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="message-text" class="col-form-label">Tarikh Mesyuarat:</label>
                                                            <input type="date" id="tarikh" class="form-control">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="message-text" class="col-form-label">Keputusan Permohonan:</label>
                                                            <select id="keputusan" onchange="select1()" class="form-control">
                                                                <option value="">Pilih Keputusan</option>
                                                                <option value="Lulus" {{Request::get('status') == 'Lulus' ? 'selected':'' }} >Lulus</option>
                                                                <option value="Tidak Lulus" {{Request::get('status') == 'Tidak Lulus' ? 'selected':'' }} >Tidak Lulus</option>
                                                            </select>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="message-text" class="col-form-label">Catatan:</label>
                                                            <textarea class="form-control" id="message-text"></textarea>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                            <a href="{{ url('hantar-keputusan') }}" class="btn btn-primary btn-round float-end" data-bs-toggle="modal" data-bs-target="#pengesahanModal">Hantar</a>
                                                            {{-- <button type="button" class="btn btn-primary ajaxstudent-save">Hantar</button> --}}
                                                        </div>
                                                    </form>
                                                </div>
                                              </div> 
                                            </div>
                                        </div> 
                                        <br><br>                                       
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script>
            //sorting function
            $('#sortTable').DataTable();

            // check all checkboxes at once
            function toggle(source) {
                var checkboxes = document.querySelectorAll('input[type="checkbox"]');
                for (var i = 0; i < checkboxes.length; i++) {
                    if (checkboxes[i] != source)
                        checkboxes[i].checked = source.checked;
                }
            }

            //input maklumat for kelulusan
            function myinput(){
                var no = prompt("No. Mesyuarat:");
                var tarikh = prompt("Tarikh Mesyuarat:");
                var keputusan = prompt("Kelulusan:");
                var catatan = prompt("Catatan:");
		    }

            // submit modal
            $(document).ready(function() {
                $(document).on('click','ajaxstudent-save', function(){
                    alert("Emel notifikasi telah dihantar kepada pemohon");
                }); 
            });
        </script>
        
        <!-- Vedor js file and create bundle with grunt  --> 
        <script src="assets/bundles/flotscripts.bundle.js"></script><!-- flot charts Plugin Js -->
        <script src="assets/bundles/c3.bundle.js"></script>
        <script src="assets/bundles/apexcharts.bundle.js"></script>
        <script src="assets/bundles/jvectormap.bundle.js"></script>
        <script src="assets/vendor/toastr/toastr.js"></script>
        
        <!-- Project core js file minify with grunt --> 
        <script src="assets/bundles/mainscripts.bundle.js"></script>
        <script src="../js/index.js"></script>
        
        <!-- Vedor js file and create bundle with grunt  --> 
        <script src="assets/bundles/morrisscripts.bundle.js"></script><!-- Morris Plugin Js -->
        
        <!-- Vedor js file and create bundle with grunt  -->    
        <script src="assets/bundles/datatablescripts.bundle.js"></script>
        <script src="assets/vendor/jquery-datatable/buttons/dataTables.buttons.min.js"></script>
        <script src="assets/vendor/jquery-datatable/buttons/buttons.bootstrap4.min.js"></script>
        <script src="assets/vendor/jquery-datatable/buttons/buttons.colVis.min.js"></script>
        <script src="assets/vendor/jquery-datatable/buttons/buttons.html5.min.js"></script>
        <script src="assets/vendor/jquery-datatable/buttons/buttons.print.min.js"></script>
        <script src="assets/vendor/sweetalert/sweetalert.min.js"></script>

        <!-- SweetAlert Plugin Js --> 
        <script src="../js/pages/forms/form-wizard.js"></script>
        <script src="../js/pages/tables/jquery-datatable.js"></script>
        <script src="../js/pages/charts/morris.js"></script>
        <script src="../js/pages/charts/c3.js"></script>

        <!-- Javascript -->
        <script src="assets/bundles/libscripts.bundle.js"></script>    
        <script src="assets/bundles/vendorscripts.bundle.js"></script>
        <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>

        <!-- Project core js file minify with grunt --> 
        <script src="assets/bundles/mainscripts.bundle.js"></script>

        <!-- Bootstrap --> 
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    </body>
</x-default-layout> 
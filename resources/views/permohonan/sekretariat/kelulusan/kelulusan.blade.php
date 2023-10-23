<x-default-layout>
    <head>
        <title>Sekretariat BKOKU KPT</title>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">

        <!-- MAIN CSS -->
        <link rel="stylesheet" href="/assets/css/sekretariat.css">
        <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css"/>
        <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/default.min.css"/>

        {{-- JAVASCRIPT --}}
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9">
        <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js"></script>
    </head>

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
            <li class="breadcrumb-item text-dark" style="color:darkblue">Kelulusan</li>
            <!--end::Item-->
        </ul>
        <!--end::Breadcrumb-->
    </div>
    <!--end::Page title-->
    <br>

    <body>
        <!-- Main body part  -->
        <div id="main-content">
            <div class="container-fluid">
                <div class="block-header">
                    <div class="row clearfix">
                        <div class="card">
                            <div class="header">
                                <h2>Senarai Permohonan untuk Kelulusan JKKBKOKU<br><small>Klik ID Permohonan untuk meluluskan permohonan</small></h2>
                            </div>

                            {{-- top nav bar --}}
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active" id="bkoku-tab" data-toggle="tab" data-target="#bkoku" type="button" role="tab" aria-controls="bkoku" aria-selected="true">BKOKU</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="ppk-tab" data-toggle="tab" data-target="#ppk" type="button" role="tab" aria-controls="ppk" aria-selected="false">PPK</button>
                                </li>
                            </ul>

                            <div class="tab-content" id="myTabContent">
                                {{-- BKOKU --}}
                                <div class="tab-pane fade show active" id="bkoku" role="tabpanel" aria-labelledby="bkoku-tab">
                                    <br>
                                    <form action="#" method="GET">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <select name="institusi" class="form-select" style="margin-left: 20px">
                                                    <option value="">Pilih Institusi Pengajian</option>
                                                    @foreach ($institusiPengajian as $institusi)
                                                        <option value="{{ $institusi->id_institusi }}" {{ Request::get('institusi') == $institusi->nama_institusi ? 'selected' : '' }}>{{ $institusi->nama_institusi }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                    
                                            <div class="col-md-5" style="margin-left: 10px; margin-right:80px;">
                                                <button type="submit" class="btn btn-primary" style="width: 6%; padding-left: 6px;">
                                                    <i class="fa fa-filter" style="font-size: 15px;"></i>
                                                </button>
                                            </div>

                                            <div class="col-md-3" style="padding-left: 80px;">
                                                <a href="{{ route('senarai.disokong.pdf', ['programCode' => 'BKOKU']) }}" target="_blank" class="btn btn-secondary btn-round">
                                                    <i class="fa fa-file-pdf" style="color: black;"></i> PDF
                                                </a>
                                                <a href="{{ route('senarai.disokong.excel', ['programCode' => 'BKOKU']) }}" target="_blank" class="btn btn-secondary btn-round">
                                                    <i class="fa fa-file-excel" style="color: black;"></i> Excel
                                                </a>
                                            </div>
                                        </div>
                                    </form>  

                                    <div class="body">
                                        <form action="{{ route('bulk.approval') }}" method="POST">
                                            {{csrf_field()}}
                                            <table id="sortTable1" class="table table-bordered table-striped">
                                                <thead>
                                                    <tr>
                                                        <th class="text-center" style="width:3%;"><input type="checkbox" name="select-all" id="select-all" onclick="toggle(this);" /></th>
                                                        <th class="text-center" style="width: 10%"><b>ID Permohonan</b></th>                                                   
                                                        <th class="text-center" style="width: 20%"><b>Nama</b></th>
                                                        <th class="text-center" style="width: 10%"><b>Jenis Kecacatan</b></th>
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
                                                    @php
                                                        require_once app_path('helpers.php'); // Replace with the actual path to your helper file
                                                    @endphp
                                                
                                                    @foreach ($kelulusan as $item)
                                                        @if ($item['program']=="BKOKU")
                                                            @php
                                                                $i++;
                                                                $nama_pemohon = DB::table('smoku')->where('id', $item['smoku_id'])->value('nama');
                                                                $nama_kursus = DB::table('smoku_akademik')->where('smoku_id', $item['smoku_id'])->value('nama_kursus');
                                                                $no_kp = DB::table('smoku')->where('id', $item['smoku_id'])->value('no_kp');
                                                                $jenis_kecacatan = DB::table('smoku')->join('bk_jenis_oku', 'bk_jenis_oku.kod_oku', '=', 'smoku.kategori')->where('smoku.id', $item['smoku_id'])->value('bk_jenis_oku.kecacatan');
                                                                $institusi_pengajian = DB::table('smoku_akademik')->join('bk_info_institusi','bk_info_institusi.id_institusi','=','smoku_akademik.id_institusi' )->where('smoku_id', $item['smoku_id'])->value('bk_info_institusi.nama_institusi');
                                                                $tarikh_mula = DB::table('smoku_akademik')->where('smoku_id', $item['smoku_id'])->value('tarikh_mula');
                                                                $tarikh_tamat = DB::table('smoku_akademik')->where('smoku_id', $item['smoku_id'])->value('tarikh_tamat');
                                                                
                                                                // nama pemohon
                                                                $text = ucwords(strtolower($nama_pemohon)); 
                                                                $conjunctions = ['bin', 'binti'];
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
                                                                $text2 = ucwords(strtolower($nama_kursus)); 
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
                                                                $namakursus = transformBracketsToCapital($kursus);

                                                                //institusi pengajian
                                                                $text3 = ucwords(strtolower($institusi_pengajian)); 
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
                                                                $institusipengajian = transformBracketsToUppercase($institusi);
                                                            @endphp
                                                            
                                                            <tr>
                                                                <td class="text-center"><input type="checkbox" name="selected_items[]" value="{{ $item->id }}" /></td>                                           
                                                                <td><a href="{{ url('permohonan/sekretariat/kelulusan/'. $item['id']) }}" target="_blank">{{$item['no_rujukan_permohonan']}}</a></td>
                                                                <td>{{$pemohon}}</td>
                                                                <td>{{ucwords(strtolower($jenis_kecacatan))}}</td>                                       
                                                                <td>{{$namakursus}}</td>
                                                                <td>{{$institusipengajian}}</td>
                                                                <td class="text-center">{{date('d/m/Y', strtotime($tarikh_mula))}}</td>
                                                                <td class="text-center">{{date('d/m/Y', strtotime($tarikh_tamat))}}</td>
                                                            </tr>
                                                        @endif
                                                    @endforeach 
                                                </tbody>
                                            </table>

                                            <!-- Button trigger modal -->
                                            <button type="button" class="btn btn-primary btn-round float-end mb-10" data-bs-toggle="modal" data-bs-target="#pengesahanModalBKOKU">
                                                Sahkan
                                            </button>
                                        
                                            {{-- Modal --}}
                                            <div class="modal fade" id="pengesahanModalBKOKU" tabindex="-1" aria-labelledby="pengesahanModalLabelBKOKU" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h1 class="modal-title fs-5" id="pengesahanModalLabelBKOKU">Rekod Keputusan Permohonan</h1>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>

                                                        <div class="modal-body">
                                                            <div class="mb-3">
                                                                <label for="recipient-name" class="col-form-label">No. Mesyuarat:</label>
                                                                <input type="text" class="form-control" id="noMesyuarat" name="noMesyuarat">
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="message-text" class="col-form-label">Tarikh Mesyuarat:</label>
                                                                <input type="date" class="form-control" id="tarikhMesyuarat" name="tarikhMesyuarat">
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="message-text" class="col-form-label">Keputusan Permohonan:</label>
                                                                <select onchange="select1()" class="form-control" id="keputusan" name="keputusan">
                                                                    <option value="">Pilih Keputusan</option>
                                                                    <option value="Lulus" {{Request::get('status') == 'Lulus' ? 'selected':'' }} >Lulus</option>
                                                                    <option value="Tidak Lulus" {{Request::get('status') == 'Tidak Lulus' ? 'selected':'' }} >Tidak Lulus</option>
                                                                </select>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="message-text" class="col-form-label">Catatan:</label>
                                                                <textarea class="form-control" id="catatan" name="catatan"></textarea>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                                <button type="submit" class="btn btn-primary btn-round float-end">Hantar</button>
                                                            </div>
                                                        </div>
                                                    </div> 
                                                </div>
                                            </div> 
                                            <br><br>                                       
                                        </form>
                                    </div>
                                </div>

                                {{-- PPK --}}
                                <div class="tab-pane fade" id="ppk" role="tabpanel" aria-labelledby="ppk-tab">
                                    <br>
                                    <form action="#" method="GET">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <select name="institusi" class="form-select" style="margin-left: 20px">
                                                    <option value="">Pilih Institusi Pengajian</option>
                                                    @foreach ($institusiPengajian as $institusi)
                                                        <option value="{{ $institusi->id_institusi }}" {{ Request::get('institusi') == $institusi->nama_institusi ? 'selected' : '' }}>{{ $institusi->nama_institusi }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                    
                                            <div class="col-md-5" style="margin-left: 10px; margin-right:80px;">
                                                <button type="submit" class="btn btn-primary" style="width: 6%; padding-left: 6px;">
                                                    <i class="fa fa-filter" style="font-size: 15px;"></i>
                                                </button>
                                            </div>

                                            <div class="col-md-3" style="padding-left: 80px;">
                                                <a href="{{ route('senarai.disokong.pdf', ['programCode' => 'PPK']) }}" target="_blank" class="btn btn-secondary btn-round">
                                                    <i class="fa fa-file-pdf" style="color: black;"></i> PDF
                                                </a>
                                                <a href="{{ route('senarai.disokong.excel', ['programCode' => 'PPK']) }}" target="_blank" class="btn btn-secondary btn-round">
                                                    <i class="fa fa-file-excel" style="color: black;"></i> Excel
                                                </a>
                                            </div>
                                        </div>
                                    </form>  

                                    <div class="body">
                                        <form action="{{ route('bulk.approval') }}" method="POST">
                                            {{csrf_field()}}
                                            <table id="sortTable2" class="table table-bordered table-striped">
                                                <thead>
                                                    <tr>
                                                        <th class="text-center" style="width:3%;"><input type="checkbox" name="select-all" id="select-all" onclick="toggle(this);" /></th>
                                                        <th class="text-center" style="width: 10%"><b>ID Permohonan</b></th>                                                   
                                                        <th class="text-center" style="width: 20%"><b>Nama</b></th>
                                                        <th class="text-center" style="width: 10%"><b>Jenis Kecacatan</b></th>
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
                                                    @php
                                                        require_once app_path('helpers.php'); // Replace with the actual path to your helper file
                                                    @endphp
                                                
                                                    @foreach ($kelulusan as $item)
                                                        @if ($item['program']=="PPK")
                                                            @php
                                                                $i++;
                                                                $nama_pemohon = DB::table('smoku')->where('id', $item['smoku_id'])->value('nama');
                                                                $nama_kursus = DB::table('smoku_akademik')->where('smoku_id', $item['smoku_id'])->value('nama_kursus');
                                                                $no_kp = DB::table('smoku')->where('id', $item['smoku_id'])->value('no_kp');
                                                                $jenis_kecacatan = DB::table('smoku')->join('bk_jenis_oku', 'bk_jenis_oku.kod_oku', '=', 'smoku.kategori')->where('smoku.id', $item['smoku_id'])->value('bk_jenis_oku.kecacatan');
                                                                $institusi_pengajian = DB::table('smoku_akademik')->join('bk_info_institusi','bk_info_institusi.id_institusi','=','smoku_akademik.id_institusi' )->where('smoku_id', $item['smoku_id'])->value('bk_info_institusi.nama_institusi');
                                                                $tarikh_mula = DB::table('smoku_akademik')->where('smoku_id', $item['smoku_id'])->value('tarikh_mula');
                                                                $tarikh_tamat = DB::table('smoku_akademik')->where('smoku_id', $item['smoku_id'])->value('tarikh_tamat');
                                                                
                                                                // nama pemohon
                                                                $text = ucwords(strtolower($nama_pemohon)); 
                                                                $conjunctions = ['bin', 'binti'];
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
                                                                $text2 = ucwords(strtolower($nama_kursus)); 
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
                                                                $namakursus = transformBracketsToCapital($kursus);

                                                                //institusi pengajian
                                                                $text3 = ucwords(strtolower($institusi_pengajian)); 
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
                                                                $institusipengajian = transformBracketsToUppercase($institusi);
                                                            @endphp
                                                            
                                                            <tr>
                                                                <td class="text-center"><input type="checkbox" name="selected_items[]" value="{{ $item->id }}" /></td>                                           
                                                                <td><a href="{{ url('permohonan/sekretariat/kelulusan/'. $item['id']) }}" target="_blank">{{$item['no_rujukan_permohonan']}}</a></td>
                                                                <td>{{$pemohon}}</td>
                                                                <td>{{ucwords(strtolower($jenis_kecacatan))}}</td>                                       
                                                                <td>{{$namakursus}}</td>
                                                                <td>{{$institusipengajian}}</td>
                                                                <td class="text-center">{{date('d/m/Y', strtotime($tarikh_mula))}}</td>
                                                                <td class="text-center">{{date('d/m/Y', strtotime($tarikh_tamat))}}</td>
                                                            </tr>
                                                        @endif
                                                    @endforeach 
                                                </tbody>
                                            </table>

                                            <!-- Button trigger modal -->
                                            <button type="button" class="btn btn-primary btn-round float-end mb-10" data-bs-toggle="modal" data-bs-target="#pengesahanModalPPK">
                                                Sahkan
                                            </button>
                                        
                                            {{-- Modal --}}
                                            <div class="modal fade" id="pengesahanModalPPK" tabindex="-1" aria-labelledby="pengesahanModalLabelPPK" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h1 class="modal-title fs-5" id="pengesahanModalLabelPPK">Rekod Keputusan Permohonan</h1>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>

                                                        <div class="modal-body">
                                                            <div class="mb-3">
                                                                <label for="recipient-name" class="col-form-label">No. Mesyuarat:</label>
                                                                <input type="text" class="form-control" id="noMesyuarat" name="noMesyuarat">
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="message-text" class="col-form-label">Tarikh Mesyuarat:</label>
                                                                <input type="date" class="form-control" id="tarikhMesyuarat" name="tarikhMesyuarat">
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="message-text" class="col-form-label">Keputusan Permohonan:</label>
                                                                <select onchange="select1()" class="form-control" id="keputusan" name="keputusan">
                                                                    <option value="">Pilih Keputusan</option>
                                                                    <option value="Lulus" {{Request::get('status') == 'Lulus' ? 'selected':'' }} >Lulus</option>
                                                                    <option value="Tidak Lulus" {{Request::get('status') == 'Tidak Lulus' ? 'selected':'' }} >Tidak Lulus</option>
                                                                </select>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="message-text" class="col-form-label">Catatan:</label>
                                                                <textarea class="form-control" id="catatan" name="catatan"></textarea>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                                <button type="submit" class="btn btn-primary btn-round float-end">Hantar</button>
                                                            </div>
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
        </div>

        <script>
            //sorting function
            $('#sortTable1').DataTable();
            $('#sortTable2').DataTable();

            // check all checkboxes at once
            function toggle(source) {
                var checkboxes = document.querySelectorAll('input[name="selected_items[]"]');
                for (var i = 0; i < checkboxes.length; i++) {
                    checkboxes[i].checked = source.checked;
                }
            }
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

        <!-- Bootstrap --> 
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    </body>
</x-default-layout> 
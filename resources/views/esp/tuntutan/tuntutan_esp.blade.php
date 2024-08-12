<x-default-layout> 
  <head>
    <!-- MAIN CSS -->
    <link rel="stylesheet" href="/assets/css/saringan.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js"></script>
    <script src="/assets/lang/Malay.json"></script>
    <link href="/assets/css/style.bundle.css" rel="stylesheet" type="text/css" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <style>
      .nav{
          margin-left: 20px!important;
      }
    </style>
  </head>

  <!--begin::Page title-->
  <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
    <!--begin::Title-->
    <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Tuntutan</h1>
    <!--end::Title-->
    <!--begin::Breadcrumb-->
    <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
        <!--begin::Item-->
        <li class="breadcrumb-item text-dark" style="color:darkblue">Tuntutan</li>
        <!--end::Item-->
        <!--begin::Item-->
        <li class="breadcrumb-item">
            <span class="bullet bg-gray-400 w-5px h-2px"></span>
        </li>
        <!--end::Item-->
        <!--begin::Item-->
        <li class="breadcrumb-item text-dark" style="color:darkblue">Maklumat ESP</li>
        <!--end::Item-->
    </ul>
    <!--end::Breadcrumb-->
</div>
<!--end::Page title-->

<br>

<body>
  <div id="main-content">
    <div class="container-fluid">
      <!--begin::Content-->
      <div id="block-header">
        <!--begin::Content container-->
        <div id="row clearfix">
          <!--begin::Card-->
          <div class="card">
            <!--begin::Card header-->
            <div class="header">
              <h2>Senarai Tuntutan Layak<br><small>Sila tanda pada kotak kecil dan klik "Hantar" untuk menyerahkan data pemohon kepada ESP.</small></h2>
            </div>
            <!--end::Card header-->

            {{-- Javascript Nav Bar --}}
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                  <button class="nav-link active" id="bkokuUA-tab" data-toggle="tab" data-target="#bkokuUA" type="button" role="tab" aria-controls="bkokuUA" aria-selected="false">BKOKU UA</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="bkokuPOLI-tab" data-toggle="tab" data-target="#bkokuPOLI" type="button" role="tab" aria-controls="bkokuPOLI" aria-selected="true">BKOKU POLI</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="bkokuKK-tab" data-toggle="tab" data-target="#bkokuKK" type="button" role="tab" aria-controls="bkokuKK" aria-selected="true">BKOKU KK</button>
                </li>
                <li class="nav-item" role="presentation">
                  <button class="nav-link" id="bkokuIPTS-tab" data-toggle="tab" data-target="#bkokuIPTS" type="button" role="tab" aria-controls="bkokuIPTS" aria-selected="true">BKOKU IPTS</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="ppk-tab" data-toggle="tab" data-target="#ppk" type="button" role="tab" aria-controls="ppk" aria-selected="false">PPK</button>
                </li>
            </ul>

            <!--begin::Card title-->
            <div class="card-title">
              <!--begin::Search-->
              <div class="d-flex align-items-center position-relative my-1">
                  <input type="hidden" data-kt-subscription-table-filter="search" >
              </div>
              <!--end::Search-->
            </div>
            <!--begin::Card title-->

            <!--begin::Card toolbar-->
            <div class="card-toolbar" style="margin-bottom: 0px!important; margin-top: 10px!important;">
                <!--begin::Toolbar-->
                <div class="d-flex justify-content-between" style="margin-left: 20px;" data-kt-subscription-table-toolbar="base">
                    <!--begin::Filter-->
                    <!--begin::Content-->
                    <div data-kt-subscription-table-filter="form">
                        <!--begin::Input group-->
                        <div class="row mb-0">
                            <div class="col-md-8 fv-row">
                                <select id="institusiDropdown" name="institusi" class="form-select custom-width-select js-example-basic-single">
                                    <option value="">Pilih Institusi Pengajian</option>
                                </select>
                            </div>

                            <div class="col-md-2 fv-row none-container"> </div>

                            <div class="col-md-2 fv-row">
                                <button type="submit" class="btn btn-primary fw-semibold" data-kt-menu-dismiss="true" data-kt-subscription-table-filter="filter" onclick="applyFilter()">
                                    <i class="ki-duotone ki-filter fs-2">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>
                                </button>
                            </div>
                        </div>
                        <!--end::Input group-->
                    </div>
                    <!--end::Content-->
                    <!--end::Filter-->
                </div>
                
                <!--end::Toolbar-->
                <!--begin::Group actions-->
                <div class="d-flex justify-content-end align-items-center d-none" data-kt-subscription-table-toolbar="selected">
                    <div class="fw-bold me-5">
                    <span class="me-2" data-kt-subscription-table-select="selected_count"></span>Selected</div>
                    <button type="button" class="btn btn-danger" data-kt-subscription-table-select="delete_selected">Delete Selected</button>
                </div>
                <!--end::Group actions-->
            </div>
            <!--end::Card toolbar-->
            
            {{-- Content Navigation Bar --}}
            <div class="tab-content" id="myTabContent">
                {{-- BKOKU UA --}}
                <div class="tab-pane fade show active" id="bkokuUA" role="tabpanel" aria-labelledby="bkokuUA-tab">
                  <br>
                    <!--begin::Card body-->
                    <div class="card-body pt-0">
                      <!--begin::Table-->
                      <div class="table-responsive">
                        <table id="sortTable4" class="table table-bordered table-striped">
                          <thead>
                            <tr>
                              <th class="text-center" style="width:3%;">
                                <input type="checkbox" name="select-all" id="select-all-bkokuUA" onclick="toggleSelectAll('bkokuUA');" />
                              </th>
                              <th class="text-center" style="width: 15%"><b>ID Permohonan</b></th>                                                   
                              <th class="text-center" style="width: 10%"><b>ID Tuntutan</b></th>                                                   
                              <th class="text-center" style="width: 15%"><b>Nama</b></th>
                              <th class="text-center" style="width: 15%"><b>Nama Kursus</b></th>
                              <th class="text-center" style="width: 15%"><b>Institusi Pengajian</b></th>
                              <th class="text-center" style="width: 15%"><b>Yuran Disokong (RM)</b></th>
                              <th class="text-center" style="width: 15%"><b>Wang Saku Disokong (RM)</b></th>
                          </thead>
                          <tbody>
                            @php
                              $i=0;
                            @endphp

                            @foreach ($kelulusan as $bkoku)
                              @php
                              // dd($bkoku);
                                $i++;
                                $nama_pemohon = DB::table('smoku')->where('id', $bkoku['smoku_id'])->value('nama');
                                $nama_kursus = DB::table('smoku_akademik')->where('smoku_id', $bkoku['smoku_id'])->value('nama_kursus');
                                $no_kp = DB::table('smoku')->where('id', $bkoku['smoku_id'])->value('no_kp');
                                $jenis_kecacatan = DB::table('smoku')->join('bk_jenis_oku', 'bk_jenis_oku.kod_oku', '=', 'smoku.kategori')->where('smoku.id', $bkoku['smoku_id'])->value('bk_jenis_oku.kecacatan');
                                $institusi_pengajian = DB::table('smoku_akademik')->join('bk_info_institusi','bk_info_institusi.id_institusi','=','smoku_akademik.id_institusi' )->where('smoku_id', $bkoku['smoku_id'])->value('bk_info_institusi.nama_institusi');
                                $jenis_institusi = DB::table('smoku_akademik')->join('bk_info_institusi','bk_info_institusi.id_institusi','=','smoku_akademik.id_institusi' )->where('smoku_id', $bkoku['smoku_id'])->where('smoku_akademik.status', 1)->value('bk_info_institusi.jenis_institusi');
                                $tarikh_mula = DB::table('smoku_akademik')->where('smoku_id', $bkoku['smoku_id'])->value('tarikh_mula');
                                $tarikh_tamat = DB::table('smoku_akademik')->where('smoku_id', $bkoku['smoku_id'])->value('tarikh_tamat');
                                $program = DB::table('permohonan')->where('id',$bkoku['permohonan_id'])->value('program');
                                // dd($bkoku['permohonan_id']);
                                $dokumen = DB::table('permohonan_dokumen')->where('permohonan_id', $bkoku['permohonan_id'])->get();

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
                              @if($program == "BKOKU")  
                                @if ($jenis_institusi == "UA") 
                                  <tr>
                                    <td class="text-center"><input type="checkbox" class="select-checkbox" name="selected_items[]" value="{{ $no_kp }}" /></td>
                                    <td class="text-center">
                                      <a href="#" class="open-modal-link-permohonan" data-bs-toggle="modal" data-bs-target="#dokumenUA{{$bkoku['id']}}" data-no-rujukan="{{$bkoku['no_rujukan_permohonan']}}">{{ $bkoku->no_rujukan_permohonan}}</a>
                                    </td>                                  
                                    <td class="text-center">{{ $bkoku->no_rujukan_tuntutan}}</td>
                                    <td>{{$pemohon}}</td>
                                    <td>{{$namakursus}}</td>
                                    <td>{{$institusipengajian}}</td>
                                    <td class="text-right">{{ $bkoku->yuran_disokong}}</td>
                                    <td class="text-right">{{ $bkoku->wang_saku_disokong}}</td>
                                  </tr>
                                @endif  
                              @endif
                              {{-- Modal --}}
                              <div class="modal fade" id="dokumenUA{{$bkoku['id']}}" tabindex="-1" aria-labelledby="dokumenUA{{$bkoku['id']}}" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="modaldokumen{{$bkoku['id']}}">Salinan Dokumen Pemohon</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                          <!--begin::Accordion-->
                                          <div class="accordion" id="accordionPanelsStayOpenExample">
                                              @php 
                                                $i=1; $n=1;
                                              @endphp
                                              @foreach($dokumen as $item)
                                                @php
                                                  $dokumen_path = "/assets/dokumen/permohonan/".$item->dokumen;
                                                  
                                                  if ($item->id_dokumen == 1) {
                                                      $dokumen_name = "No. Akaun Bank Islam";
                                                  } elseif ($item->id_dokumen == 2) {
                                                      $dokumen_name = "Surat Tawaran";
                                                  } elseif ($item->id_dokumen == 3) {
                                                      $dokumen_name = "Invois/Resit";
                                                  } elseif ($item->id_dokumen == 4) {
                                                      $dokumen_name = "Dokumen Tambahan " . $n;
                                                      $n++;
                                                  }
                                              
                                                  $i++;
                                                @endphp
                                                <div class="accordion-item">
                                                    <h2 class="accordion-header" id="panelsStayOpen-heading{{$i}}">
                                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapse{{$i}}" aria-expanded="false" aria-controls="panelsStayOpen-collapse{{$i}}">
                                                            <b style="color: black!important">{{$dokumen_name}}</b>
                                                        </button>
                                                    </h2>
                                                    <div id="panelsStayOpen-collapse{{$i}}" class="accordion-collapse collapse" aria-labelledby="panelsStayOpen-heading{{$i}}">
                                                        <div class="accordion-body" style="text-align: center">
                                                            <p>Catatan: {{$item->catatan}}</p>
                                                            <!-- Display Download link for PNG only if it's not a PDF -->
                                                            @if (pathinfo($dokumen_path, PATHINFO_EXTENSION) != 'pdf')
                                                              <a href="{{$dokumen_path}}" download="{{$dokumen_name}}.png">
                                                                  <img src="{{$dokumen_path}}" alt="Muat Turun" width="90%" height="650px"/>
                                                              </a>
                                                            @endif
                                                            <embed src="{{$dokumen_path}}" width="90%" height="650px"/>
                                                        </div>
                                                    </div>
                                                </div>
                                              @endforeach
                                          </div>
                                          <!--end::Accordion-->
                                          <div class="modal-footer">
                                              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                          </div>
                                        </div>
                                    </div> 
                                </div>
                              </div> 
                            @endforeach
                          </tbody>
                        </table>
                      </div>
                      <!--end::Table-->
                    </div>
                    <!--end::Card body-->
                </div>

                {{-- BKOKU POLI --}}
                <div class="tab-pane fade" id="bkokuPOLI" role="tabpanel" aria-labelledby="bkokuPOLI-tab">
                  <br>
                    <!--begin::Card body-->
                    <div class="card-body pt-0">
                      <!--begin::Table-->
                      <div class="table-responsive">
                        <table id="sortTable2" class="table table-bordered table-striped">
                          <thead>
                            <tr>
                              <th class="text-center" style="width:3%;">
                                <input type="checkbox" name="select-all" id="select-all-bkokuPOLI" onclick="toggleSelectAll('bkokuPOLI');" />
                              </th>
                              <th class="text-center" style="width: 15%"><b>ID Permohonan</b></th>                                                   
                              <th class="text-center" style="width: 10%"><b>ID Tuntutan</b></th>                                                   
                              <th class="text-center" style="width: 15%"><b>Nama</b></th>
                              <th class="text-center" style="width: 15%"><b>Nama Kursus</b></th>
                              <th class="text-center" style="width: 15%"><b>Institusi Pengajian</b></th>
                              <th class="text-center" style="width: 15%"><b>Yuran Disokong (RM)</b></th>
                              <th class="text-center" style="width: 15%"><b>Wang Saku Disokong (RM)</b></th>
                          </thead>
                          <tbody>
                            @php
                              $i=0;
                            @endphp
                            @foreach ($kelulusan as $bkoku)

                              @php
                                $i++;
                                $nama_pemohon = DB::table('smoku')->where('id', $bkoku['smoku_id'])->value('nama');
                                $nama_kursus = DB::table('smoku_akademik')->where('smoku_id', $bkoku['smoku_id'])->value('nama_kursus');
                                $no_kp = DB::table('smoku')->where('id', $bkoku['smoku_id'])->value('no_kp');
                                $jenis_kecacatan = DB::table('smoku')->join('bk_jenis_oku', 'bk_jenis_oku.kod_oku', '=', 'smoku.kategori')->where('smoku.id', $bkoku['smoku_id'])->value('bk_jenis_oku.kecacatan');
                                $institusi_pengajian = DB::table('smoku_akademik')->join('bk_info_institusi','bk_info_institusi.id_institusi','=','smoku_akademik.id_institusi' )->where('smoku_id', $bkoku['smoku_id'])->value('bk_info_institusi.nama_institusi');
                                $jenis_institusi = DB::table('smoku_akademik')->join('bk_info_institusi','bk_info_institusi.id_institusi','=','smoku_akademik.id_institusi' )->where('smoku_id', $bkoku['smoku_id'])->where('smoku_akademik.status', 1)->value('bk_info_institusi.jenis_institusi');
                                $tarikh_mula = DB::table('smoku_akademik')->where('smoku_id', $bkoku['smoku_id'])->value('tarikh_mula');
                                $tarikh_tamat = DB::table('smoku_akademik')->where('smoku_id', $bkoku['smoku_id'])->value('tarikh_tamat');
                                $program = DB::table('permohonan')->where('id',$bkoku['id'])->value('program');
                                //dd($bkoku['smoku_id']);
                                $dokumen = DB::table('permohonan_dokumen')->where('permohonan_id', $bkoku['id'])->get();

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
                              @if($program == "BKOKU")  
                                @if ($jenis_institusi == "P") 
                                  <tr>
                                    <td class="text-center"><input type="checkbox" class="select-checkbox" name="selected_items[]" value="{{ $no_kp }}" /></td>
                                    <td class="text-center">
                                      <a href="#" class="open-modal-link-permohonan" data-bs-toggle="modal" data-bs-target="#dokumenPOLI{{$bkoku['id']}}" data-no-rujukan="{{$bkoku['no_rujukan_permohonan']}}">{{ $bkoku->no_rujukan_permohonan}}</a>
                                    </td>                                  
                                    <td class="text-center">{{ $bkoku->no_rujukan_tuntutan}}</td>
                                    <td>{{$pemohon}}</td>
                                    <td>{{$namakursus}}</td>
                                    <td>{{$institusipengajian}}</td>
                                    <td class="text-right">{{ $bkoku->yuran_disokong}}</td>
                                    <td class="text-right">{{ $bkoku->wang_saku_disokong}}</td>
                                  </tr>
                                @endif  
                              @endif
                              {{-- Modal --}}
                              <div class="modal fade" id="dokumenPOLI{{$bkoku['id']}}" tabindex="-1" aria-labelledby="dokumenPOLI{{$bkoku['id']}}" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="modaldokumen{{$bkoku['id']}}">Salinan Dokumen Pemohon</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                          <!--begin::Accordion-->
                                          <div class="accordion" id="accordionPanelsStayOpenExample">
                                              @php 
                                                $i=1; $n=1;
                                              @endphp
                                              @foreach($dokumen as $item)
                                                @php
                                                  $dokumen_path = "/assets/dokumen/permohonan/".$item->dokumen;
                                                  
                                                  if ($item->id_dokumen == 1) {
                                                      $dokumen_name = "No. Akaun Bank Islam";
                                                  } elseif ($item->id_dokumen == 2) {
                                                      $dokumen_name = "Surat Tawaran";
                                                  } elseif ($item->id_dokumen == 3) {
                                                      $dokumen_name = "Invois/Resit";
                                                  } elseif ($item->id_dokumen == 4) {
                                                      $dokumen_name = "Dokumen Tambahan " . $n;
                                                      $n++;
                                                  }
                                              
                                                  $i++;
                                                @endphp
                                                <div class="accordion-item">
                                                    <h2 class="accordion-header" id="panelsStayOpen-heading{{$i}}">
                                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapse{{$i}}" aria-expanded="false" aria-controls="panelsStayOpen-collapse{{$i}}">
                                                            <b style="color: black!important">{{$dokumen_name}}</b>
                                                        </button>
                                                    </h2>
                                                    <div id="panelsStayOpen-collapse{{$i}}" class="accordion-collapse collapse" aria-labelledby="panelsStayOpen-heading{{$i}}">
                                                        <div class="accordion-body" style="text-align: center">
                                                            <p>Catatan: {{$item->catatan}}</p>
                                                            <!-- Display Download link for PNG only if it's not a PDF -->
                                                            @if (pathinfo($dokumen_path, PATHINFO_EXTENSION) != 'pdf')
                                                              <a href="{{$dokumen_path}}" download="{{$dokumen_name}}.png">
                                                                  <img src="{{$dokumen_path}}" alt="Muat Turun" width="90%" height="650px"/>
                                                              </a>
                                                            @endif
                                                            <embed src="{{$dokumen_path}}" width="90%" height="650px"/>
                                                        </div>
                                                    </div>
                                                </div>
                                              @endforeach
                                          </div>
                                          <!--end::Accordion-->
                                          <div class="modal-footer">
                                              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                          </div>
                                        </div>
                                    </div> 
                                </div>
                              </div> 
                            @endforeach
                          </tbody>
                        </table>
                      </div>
                      <!--end::Table-->
                    </div>
                    <!--end::Card body-->
                </div>

                {{-- BKOKU KK --}}
                <div class="tab-pane fade" id="bkokuKK" role="tabpanel" aria-labelledby="bkokuKK-tab">
                  <br>
                    <!--begin::Card body-->
                    <div class="card-body pt-0">
                      <!--begin::Table-->
                      <div class="table-responsive">
                        <table id="sortTable3" class="table table-bordered table-striped">
                          <thead>
                            <tr>
                              <th class="text-center" style="width:3%;">
                                <input type="checkbox" name="select-all" id="select-all-bkokuKK" onclick="toggleSelectAll('bkokuKK');" />
                              </th>
                              <th class="text-center" style="width: 15%"><b>ID Permohonan</b></th>                                                   
                              <th class="text-center" style="width: 10%"><b>ID Tuntutan</b></th>                                                   
                              <th class="text-center" style="width: 15%"><b>Nama</b></th>
                              <th class="text-center" style="width: 15%"><b>Nama Kursus</b></th>
                              <th class="text-center" style="width: 15%"><b>Institusi Pengajian</b></th>
                              <th class="text-center" style="width: 15%"><b>Yuran Disokong (RM)</b></th>
                              <th class="text-center" style="width: 15%"><b>Wang Saku Disokong (RM)</b></th>
                          </thead>
                          <tbody>
                            @php
                              $i=0;
                            @endphp
                            @foreach ($kelulusan as $bkoku)

                              @php
                                $i++;
                                $nama_pemohon = DB::table('smoku')->where('id', $bkoku['smoku_id'])->value('nama');
                                $nama_kursus = DB::table('smoku_akademik')->where('smoku_id', $bkoku['smoku_id'])->value('nama_kursus');
                                $no_kp = DB::table('smoku')->where('id', $bkoku['smoku_id'])->value('no_kp');
                                $jenis_kecacatan = DB::table('smoku')->join('bk_jenis_oku', 'bk_jenis_oku.kod_oku', '=', 'smoku.kategori')->where('smoku.id', $bkoku['smoku_id'])->value('bk_jenis_oku.kecacatan');
                                $institusi_pengajian = DB::table('smoku_akademik')->join('bk_info_institusi','bk_info_institusi.id_institusi','=','smoku_akademik.id_institusi' )->where('smoku_id', $bkoku['smoku_id'])->value('bk_info_institusi.nama_institusi');
                                $jenis_institusi = DB::table('smoku_akademik')->join('bk_info_institusi','bk_info_institusi.id_institusi','=','smoku_akademik.id_institusi' )->where('smoku_id', $bkoku['smoku_id'])->where('smoku_akademik.status', 1)->value('bk_info_institusi.jenis_institusi');
                                $tarikh_mula = DB::table('smoku_akademik')->where('smoku_id', $bkoku['smoku_id'])->value('tarikh_mula');
                                $tarikh_tamat = DB::table('smoku_akademik')->where('smoku_id', $bkoku['smoku_id'])->value('tarikh_tamat');
                                $program = DB::table('permohonan')->where('id',$bkoku['id'])->value('program');
                                //dd($bkoku['smoku_id']);
                                $dokumen = DB::table('permohonan_dokumen')->where('permohonan_id', $bkoku['id'])->get();

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
                              @if($program == "BKOKU")  
                                @if ($jenis_institusi == "KK") 
                                  <tr>
                                    <td class="text-center"><input type="checkbox" class="select-checkbox" name="selected_items[]" value="{{ $no_kp }}" /></td>
                                    <td class="text-center">
                                      <a href="#" class="open-modal-link-permohonan" data-bs-toggle="modal" data-bs-target="#dokumenKK{{$bkoku['id']}}" data-no-rujukan="{{$bkoku['no_rujukan_permohonan']}}">{{ $bkoku->no_rujukan_permohonan}}</a>
                                    </td>                                  
                                    <td class="text-center">{{ $bkoku->no_rujukan_tuntutan}}</td>
                                    <td>{{$pemohon}}</td>
                                    <td>{{$namakursus}}</td>
                                    <td>{{$institusipengajian}}</td>
                                    <td class="text-right">{{ $bkoku->yuran_disokong}}</td>
                                    <td class="text-right">{{ $bkoku->wang_saku_disokong}}</td>
                                  </tr>
                                @endif  
                              @endif
                              {{-- Modal --}}
                              <div class="modal fade" id="dokumenKK{{$bkoku['id']}}" tabindex="-1" aria-labelledby="dokumenKK{{$bkoku['id']}}" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="modaldokumen{{$bkoku['id']}}">Salinan Dokumen Pemohon</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                          <!--begin::Accordion-->
                                          <div class="accordion" id="accordionPanelsStayOpenExample">
                                              @php 
                                                $i=1; $n=1;
                                              @endphp
                                              @foreach($dokumen as $item)
                                                @php
                                                  $dokumen_path = "/assets/dokumen/permohonan/".$item->dokumen;
                                                  
                                                  if ($item->id_dokumen == 1) {
                                                      $dokumen_name = "No. Akaun Bank Islam";
                                                  } elseif ($item->id_dokumen == 2) {
                                                      $dokumen_name = "Surat Tawaran";
                                                  } elseif ($item->id_dokumen == 3) {
                                                      $dokumen_name = "Invois/Resit";
                                                  } elseif ($item->id_dokumen == 4) {
                                                      $dokumen_name = "Dokumen Tambahan " . $n;
                                                      $n++;
                                                  }
                                              
                                                  $i++;
                                                @endphp
                                                <div class="accordion-item">
                                                    <h2 class="accordion-header" id="panelsStayOpen-heading{{$i}}">
                                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapse{{$i}}" aria-expanded="false" aria-controls="panelsStayOpen-collapse{{$i}}">
                                                            <b style="color: black!important">{{$dokumen_name}}</b>
                                                        </button>
                                                    </h2>
                                                    <div id="panelsStayOpen-collapse{{$i}}" class="accordion-collapse collapse" aria-labelledby="panelsStayOpen-heading{{$i}}">
                                                        <div class="accordion-body" style="text-align: center">
                                                            <p>Catatan: {{$item->catatan}}</p>
                                                            <!-- Display Download link for PNG only if it's not a PDF -->
                                                            @if (pathinfo($dokumen_path, PATHINFO_EXTENSION) != 'pdf')
                                                              <a href="{{$dokumen_path}}" download="{{$dokumen_name}}.png">
                                                                  <img src="{{$dokumen_path}}" alt="Muat Turun" width="90%" height="650px"/>
                                                              </a>
                                                            @endif
                                                            <embed src="{{$dokumen_path}}" width="90%" height="650px"/>
                                                        </div>
                                                    </div>
                                                </div>
                                              @endforeach
                                          </div>
                                          <!--end::Accordion-->
                                          <div class="modal-footer">
                                              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                          </div>
                                        </div>
                                    </div> 
                                </div>
                              </div> 
                            @endforeach
                          </tbody>
                        </table>
                      </div>
                      <!--end::Table-->
                    </div>
                    <!--end::Card body-->
                </div>

                {{-- BKOKU IPTS --}}
                <div class="tab-pane fade" id="bkokuIPTS" role="tabpanel" aria-labelledby="bkokuIPTS-tab">
                  <br>
                    <!--begin::Card body-->
                    <div class="card-body pt-0">
                      <!--begin::Table-->
                      <div class="table-responsive">
                        <table id="sortTable1" class="table table-bordered table-striped">
                          <thead>
                            <tr>
                              <th class="text-center" style="width:3%;">
                                <input type="checkbox" name="select-all" id="select-all-bkokuIPTS" onclick="toggleSelectAll('bkokuIPTS');" />
                              </th>
                              <th class="text-center" style="width: 15%"><b>ID Permohonan</b></th>                                                   
                              <th class="text-center" style="width: 10%"><b>ID Tuntutan</b></th>                                                   
                              <th class="text-center" style="width: 15%"><b>Nama</b></th>
                              <th class="text-center" style="width: 15%"><b>Nama Kursus</b></th>
                              <th class="text-center" style="width: 15%"><b>Institusi Pengajian</b></th>
                              <th class="text-center" style="width: 15%"><b>Yuran Disokong (RM)</b></th>
                              <th class="text-center" style="width: 15%"><b>Wang Saku Disokong (RM)</b></th>
                            </tr>
                          </thead>
                          <tbody>
                            @php
                              $i=0;
                            @endphp
                            @foreach ($kelulusan as $bkoku)

                              @php
                                $i++;
                                $nama_pemohon = DB::table('smoku')->where('id', $bkoku['smoku_id'])->value('nama');
                                $nama_kursus = DB::table('smoku_akademik')->where('smoku_id', $bkoku['smoku_id'])->value('nama_kursus');
                                $no_kp = DB::table('smoku')->where('id', $bkoku['smoku_id'])->value('no_kp');
                                $jenis_kecacatan = DB::table('smoku')->join('bk_jenis_oku', 'bk_jenis_oku.kod_oku', '=', 'smoku.kategori')->where('smoku.id', $bkoku['smoku_id'])->value('bk_jenis_oku.kecacatan');
                                $institusi_pengajian = DB::table('smoku_akademik')->join('bk_info_institusi','bk_info_institusi.id_institusi','=','smoku_akademik.id_institusi' )->where('smoku_id', $bkoku['smoku_id'])->value('bk_info_institusi.nama_institusi');
                                $jenis_institusi = DB::table('smoku_akademik')->join('bk_info_institusi','bk_info_institusi.id_institusi','=','smoku_akademik.id_institusi' )->where('smoku_id', $bkoku['smoku_id'])->where('smoku_akademik.status', 1)->value('bk_info_institusi.jenis_institusi');
                                $tarikh_mula = DB::table('smoku_akademik')->where('smoku_id', $bkoku['smoku_id'])->value('tarikh_mula');
                                $tarikh_tamat = DB::table('smoku_akademik')->where('smoku_id', $bkoku['smoku_id'])->value('tarikh_tamat');
                                $program = DB::table('permohonan')->where('id',$bkoku['id'])->value('program');
                                //dd($bkoku['smoku_id']);
                                $dokumen = DB::table('permohonan_dokumen')->where('permohonan_id', $bkoku['id'])->get();


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
                              @if($program == "BKOKU") 
                                @if ($jenis_institusi == "IPTS")  
                                  <tr>
                                    <td class="text-center"><input type="checkbox" class="select-checkbox" name="selected_items[]" value="{{ $no_kp }}" /></td>
                                    <td class="text-center">
                                      <a href="#" class="open-modal-link-permohonan" data-bs-toggle="modal" data-bs-target="#dokumenIPTS{{$bkoku['id']}}" data-no-rujukan="{{$bkoku['no_rujukan_permohonan']}}">{{ $bkoku->no_rujukan_permohonan}}</a>
                                    </td>                                  
                                    <td class="text-center">{{ $bkoku->no_rujukan_tuntutan}}</td>
                                    <td>{{$pemohon}}</td>
                                    <td>{{$namakursus}}</td>
                                    <td>{{$institusipengajian}}</td>
                                    <td class="text-right">{{ $bkoku->yuran_disokong}}</td>
                                    <td class="text-right">{{ $bkoku->wang_saku_disokong}}</td>
                                  </tr>
                                @endif   
                              @endif
                              {{-- Modal --}}
                              <div class="modal fade" id="dokumenIPTS{{$bkoku['id']}}" tabindex="-1" aria-labelledby="dokumenIPTS{{$bkoku['id']}}" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="modaldokumen{{$bkoku['id']}}">Salinan Dokumen Pemohon</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                          <!--begin::Accordion-->
                                          <div class="accordion" id="accordionPanelsStayOpenExample">
                                              @php 
                                                $i=1; $n=1;
                                              @endphp
                                              @foreach($dokumen as $item)
                                                @php
                                                  $dokumen_path = "/assets/dokumen/permohonan/".$item->dokumen;
                                                  
                                                  if ($item->id_dokumen == 1) {
                                                      $dokumen_name = "No. Akaun Bank Islam";
                                                  } elseif ($item->id_dokumen == 2) {
                                                      $dokumen_name = "Surat Tawaran";
                                                  } elseif ($item->id_dokumen == 3) {
                                                      $dokumen_name = "Invois/Resit";
                                                  } elseif ($item->id_dokumen == 4) {
                                                      $dokumen_name = "Dokumen Tambahan " . $n;
                                                      $n++;
                                                  }
                                              
                                                  $i++;
                                                @endphp
                                                <div class="accordion-item">
                                                    <h2 class="accordion-header" id="panelsStayOpen-heading{{$i}}">
                                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapse{{$i}}" aria-expanded="false" aria-controls="panelsStayOpen-collapse{{$i}}">
                                                            <b style="color: black!important">{{$dokumen_name}}</b>
                                                        </button>
                                                    </h2>
                                                    <div id="panelsStayOpen-collapse{{$i}}" class="accordion-collapse collapse" aria-labelledby="panelsStayOpen-heading{{$i}}">
                                                        <div class="accordion-body" style="text-align: center">
                                                            <p>Catatan: {{$item->catatan}}</p>
                                                            <!-- Display Download link for PNG only if it's not a PDF -->
                                                            @if (pathinfo($dokumen_path, PATHINFO_EXTENSION) != 'pdf')
                                                              <a href="{{$dokumen_path}}" download="{{$dokumen_name}}.png">
                                                                  <img src="{{$dokumen_path}}" alt="Muat Turun" width="90%" height="650px"/>
                                                              </a>
                                                            @endif
                                                            <embed src="{{$dokumen_path}}" width="90%" height="650px"/>
                                                        </div>
                                                    </div>
                                                </div>
                                              @endforeach
                                          </div>
                                          <!--end::Accordion-->
                                          <div class="modal-footer">
                                              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                          </div>
                                        </div>
                                    </div> 
                                </div>
                              </div> 
                            @endforeach
                          </tbody>
                        </table>
                      </div>
                      <!--end::Table-->
                    </div>
                    <!--end::Card body-->
                </div>

                {{-- PKK --}}
                <div class="tab-pane fade" id="ppk" role="tabpanel" aria-labelledby="ppk-tab">
                  <br>
                    <!--begin::Card body-->
                    <div class="card-body pt-0">
                      <!--begin::Table-->
                      <div class="table-responsive">
                        <table id="sortTable5"  class="table table-bordered table-striped">
                          <thead>
                            <tr>
                              <th class="text-center" style="width:3%;">
                                <input type="checkbox" name="select-all" id="select-all-ppk" onclick="toggleSelectAll('ppk');" />
                              </th>
                              <th class="text-center" style="width: 10%"><b>ID Permohonan</b></th>                                                   
                              <th class="text-center" style="width: 10%"><b>ID Tuntutan</b></th>                                                   
                              <th class="text-center" style="width: 20%"><b>Nama</b></th>
                              <th class="text-center" style="width: 17%"><b>Nama Kursus</b></th>
                              <th class="text-center" style="width: 20%"><b>Institusi Pengajian</b></th>
                              <th class="text-center" style="width: 10%"><b>Wang Saku Disokong (RM)</b></th>
                            </tr>
                          </thead>
                          <tbody>
                            @php
                              $i=0;
                            @endphp
                            @foreach ($kelulusan as $item)

                              @php
                                $i++;
                                $nama_pemohon = DB::table('smoku')->where('id', $item['smoku_id'])->value('nama');
                                $nama_kursus = DB::table('smoku_akademik')->where('smoku_id', $item['smoku_id'])->value('nama_kursus');
                                $no_kp = DB::table('smoku')->where('id', $item['smoku_id'])->value('no_kp');
                                $jenis_kecacatan = DB::table('smoku')->join('bk_jenis_oku', 'bk_jenis_oku.kod_oku', '=', 'smoku.kategori')->where('smoku.id', $item['smoku_id'])->value('bk_jenis_oku.kecacatan');
                                $institusi_pengajian = DB::table('smoku_akademik')->join('bk_info_institusi','bk_info_institusi.id_institusi','=','smoku_akademik.id_institusi' )->where('smoku_id', $item['smoku_id'])->value('bk_info_institusi.nama_institusi');
                                $tarikh_mula = DB::table('smoku_akademik')->where('smoku_id', $item['smoku_id'])->value('tarikh_mula');
                                $tarikh_tamat = DB::table('smoku_akademik')->where('smoku_id', $item['smoku_id'])->value('tarikh_tamat');
                                $program = DB::table('permohonan')->where('id',$item['id'])->value('program');
                                $dokumen = DB::table('permohonan_dokumen')->where('permohonan_id', $item['id'])->get();

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
                              @if($program == "PPK")
                                <tr>
                                  <td class="text-center"><input type="checkbox" class="select-checkbox" name="selected_items[]" value="{{ $no_kp }}" /></td>
                                  <td class="text-center">
                                    <a href="#" class="open-modal-link-permohonan" data-bs-toggle="modal" data-bs-target="#dokumenPPK{{$item['id']}}" data-no-rujukan="{{$item['no_rujukan_permohonan']}}">{{ $item->no_rujukan_permohonan}}</a>
                                  </td>                                 
                                  <td class="text-center">{{ $item->no_rujukan_tuntutan}}</td>
                                  <td>{{$pemohon}}</td>
                                  <td>{{$namakursus}}</td>
                                  <td>{{$institusipengajian}}</td>
                                  <td class="text-right">{{ $item->wang_saku_disokong}}.00</td>
                                </tr>
                              @endif
                              {{-- Modal --}}
                              <div class="modal fade" id="dokumenPPK{{$item['id']}}" tabindex="-1" aria-labelledby="dokumenPPK{{$item['id']}}" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="modaldokumen{{$item['id']}}">Salinan Dokumen Pemohon</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                          <!--begin::Accordion-->
                                          <div class="accordion" id="accordionPanelsStayOpenExample">
                                              @php 
                                                $i=1; $n=1;
                                              @endphp
                                              @foreach($dokumen as $itemdokumen)
                                                @php
                                                  $dokumen_path = "/assets/dokumen/permohonan/".$itemdokumen->dokumen;
                                                  
                                                  if ($itemdokumen->id_dokumen == 1) {
                                                      $dokumen_name = "No. Akaun Bank Islam";
                                                  } elseif ($itemdokumen->id_dokumen == 2) {
                                                      $dokumen_name = "Surat Tawaran";
                                                  } elseif ($itemdokumen->id_dokumen == 3) {
                                                      $dokumen_name = "Invois/Resit";
                                                  } elseif ($itemdokumen->id_dokumen == 4) {
                                                      $dokumen_name = "Dokumen Tambahan " . $n;
                                                      $n++;
                                                  }
                                              
                                                  $i++;
                                                @endphp
                                                <div class="accordion-item">
                                                    <h2 class="accordion-header" id="panelsStayOpen-heading{{$i}}">
                                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapse{{$i}}" aria-expanded="false" aria-controls="panelsStayOpen-collapse{{$i}}">
                                                            <b style="color: black!important">{{$dokumen_name}}</b>
                                                        </button>
                                                    </h2>
                                                    <div id="panelsStayOpen-collapse{{$i}}" class="accordion-collapse collapse" aria-labelledby="panelsStayOpen-heading{{$i}}">
                                                        <div class="accordion-body" style="text-align: center">
                                                            <p>Catatan: {{$itemdokumen->catatan}}</p>
                                                            <!-- Display Download link for PNG only if it's not a PDF -->
                                                            @if (pathinfo($dokumen_path, PATHINFO_EXTENSION) != 'pdf')
                                                                <a href="{{$dokumen_path}}" download="{{$dokumen_name}}.png">
                                                                    <img src="{{$dokumen_path}}" alt="Muat Turun" width="90%" height="650px"/>
                                                                </a>
                                                            @endif
                                                            <embed src="{{$dokumen_path}}" width="90%" height="650px"/>
                                                        </div>
                                                    </div>
                                                </div>
                                              @endforeach
                                          </div>
                                          <!--end::Accordion-->
                                          <div class="modal-footer">
                                              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                          </div>
                                        </div>
                                    </div> 
                                </div>
                              </div>   
                            @endforeach
                          </tbody>
                        </table>
                      </div>
                      <!--end::Table-->
                    </div>
                    <!--end::Card body-->
                </div> 
            </div>  

            <!--begin::Card body-->
            <div class="card-body pt-0">
              <!--begin::Form-->
              <form class="form" id="hantar_maklumat">
                <textarea name="token" id="token" rows="10" cols="50"></textarea>
                <textarea name="data" id="data" rows="10" cols="50"></textarea>

                <!--begin::Button-->
                <div class="footer">
                  <input type="button" value="Hantar" onclick="sendData()" class="btn btn-primary">
                </div>
                <!--end::Button-->
              </form>
              <!--end::Form-->
            </div>
            <!--end::Card body-->
          </div>
          <!--end::Card-->	
        </div>
        <!--end::Content container-->
      </div>
      <!--end::Content-->
    </div>
  </div>

    <style>
      .custom-width-select {
          width: 400px !important; /* Important to override other styles */
      }
      .form-select {
              margin-left: 10px !important; 
      }
    </style>
    <script>
      $(document).ready(function() {
          $('#sortTable1, #sortTable2, #sortTable3, #sortTable4, #sortTable5').DataTable({
              "language": {
                  "url": "/assets/lang/Malay.json"
              }
          });
      });
    </script>

    <script>
        $(document).ready(function() {
            $('.js-example-basic-single').select2();
        });

        function toggleSelectAll(tab) {
            var selectAllCheckbox = document.getElementById('select-all-' + tab);
            var isChecked = selectAllCheckbox.checked;

            // Get all checkboxes in the active tab
            var checkboxes = document.querySelectorAll('#' + tab + ' input[name="selected_items[]"]');
            
            // Set the checked property of all checkboxes to match the "Select All" checkbox
            checkboxes.forEach(function(checkbox) {
                checkbox.checked = isChecked;
            });

            // Prepare an array to hold selected no_kp values
            var selectedNokps = [];

            // Loop through all checkboxes and get selected nokp values
            checkboxes.forEach(function(checkbox) {
                if (checkbox.checked) {
                    selectedNokps.push(checkbox.value);
                }
            });

            // Send selectedNokps to the controller via AJAX
            $.ajax({
                type: "POST",
                url: "{{ route('tuntutan.esp') }}",
                data: {
                    selectedNokps: selectedNokps
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    // Handle the response from the controller here
                    var jsonData = response.data;
                    var jsonString = JSON.stringify(jsonData, null, 2);
                    $('#data').val(jsonString);
                },
                error: function(xhr, status, error) {
                    // Handle AJAX errors here if needed
                    console.error(xhr.responseText);
                }
            });

            // If no checkboxes are checked, clear the data in the textarea
            if (selectedNokps.length === 0) {
                $('#data').val('');
            }
        }

        // jQuery script to handle checkbox selection and update textarea
        $(document).ready(function() {

            // Event delegation for checkbox change
            $(document).on('change', '.select-checkbox', function() {
                var selectedNokps = [];

                // Loop through all checkboxes and get selected nokp values
                $('.select-checkbox:checked').each(function() {
                    selectedNokps.push($(this).val());
                });

                if(selectedNokps.length === 0) {
                    // If no checkboxes are selected, clear the data
                    $('#data').val('');
                    //$('#token').val('');

                } else {
                    // Send selectedNokps to the controller via AJAX
                    $.ajax({
                        type: "POST",
                        url: "{{ route('tuntutan.esp') }}",
                        data: {
                            selectedNokps: selectedNokps
                        },
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(response) {
                            // Handle the response from the controller here
                            var jsonData = response.data;

                            // Convert the jsonData array to a JSON string
                            var jsonString = JSON.stringify(jsonData, null, 2);

                            // Update the textarea with the JSON data
                            $('#data').val(jsonString);
                        },
                        error: function(xhr, status, error) {
                            // Handle AJAX errors here if needed
                            console.error(xhr.responseText);
                        }
                    });
                }
            });

        });
    </script>

    <style>
      #token {
        display: none;
      }
      #data {
        display: none;
      }
    </style>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
      
    <script>
        // Initialize JavaScript variables with data from Blade
        var bkokuUAList = @json($institusiPengajianUA);
        var bkokuPOLIList = @json($institusiPengajianPOLI);
        var bkokuKKList = @json($institusiPengajianKK);
        var bkokuIPTSList = @json($institusiPengajianIPTS);
        var ppkList = @json($institusiPengajianPPK);

        $(document).ready(function() {
            $('.none-container').show(); // Hide export elements

            // Add an event listener for tab clicks
            $('.nav-link').on('click', function() {
                // Get the ID of the active tab
                var activeTabId = $(this).attr('id');

                // Clear filters when changing tabs
                clearFilters();

                // Update the institution dropdown based on the active tab
                switch (activeTabId) {
                    case 'bkokuIPTS-tab':
                        updateInstitusiDropdown(bkokuIPTSList);
                        break;
                    case 'bkokuPOLI-tab':
                        updateInstitusiDropdown(bkokuPOLIList);
                        break;
                    case 'bkokuKK-tab':
                        updateInstitusiDropdown(bkokuKKList);
                        break;
                    case 'bkokuUA-tab':
                        updateInstitusiDropdown(bkokuUAList);
                        break;
                    case 'ppk-tab':
                        updateInstitusiDropdown(ppkList);
                        break;
                }
            });

            // Trigger the function for the default active tab (bkoku-tab)
            updateInstitusiDropdown(bkokuUAList);

            // Function to clear filters for all tables
            function clearFilters() {
                if (datatable1) {
                    datatable1.search('').columns().search('').draw();
                }
                if (datatable2) {
                    datatable2.search('').columns().search('').draw();
                }
                if (datatable3) {
                    datatable3.search('').columns().search('').draw();
                }
                if (datatable4) {
                    datatable4.search('').columns().search('').draw();
                }
                if (datatable5) {
                    datatable5.search('').columns().search('').draw();
                }
            }


            // Function to update the institution dropdown
            function updateInstitusiDropdown(institusiList) {
                // Clear existing options
                $('#institusiDropdown').empty();

                // Add default option
                $('#institusiDropdown').append('<option value="">Pilih Institusi Pengajian</option>');

                // Add options based on the selected tab
                for (var i = 0; i < institusiList.length; i++) {
                    $('#institusiDropdown').append('<option value="' + institusiList[i].nama_institusi + '">' + institusiList[i].nama_institusi + '</option>');
                }
            }
        });
    </script>

    <script>
        // Declare datatables in a higher scope to make them accessible
        var datatable1, datatable2, datatable3, datatable4, datatable5;

        $(document).ready(function() {
            // Initialize DataTables
            initDataTable('#sortTable1', 'datatable1');
            initDataTable('#sortTable2', 'datatable2');
            initDataTable('#sortTable3', 'datatable3');
            initDataTable('#sortTable4', 'datatable4');
            initDataTable('#sortTable5', 'datatable5');

            // Log data for all tables
            logTableData('Table 1 Data:', datatable1);
            logTableData('Table 2 Data:', datatable2);
            logTableData('Table 3 Data:', datatable3);
            logTableData('Table 4 Data:', datatable4);
            logTableData('Table 5 Data:', datatable5);
        });

        function initDataTable(tableId, variableName) {
            // Check if the datatable is already initialized
            if ($.fn.DataTable.isDataTable(tableId)) {
                // Destroy the existing DataTable instance
                $(tableId).DataTable().destroy();
            }

            // Initialize the datatable and assign it to the global variable
            window[variableName] = $(tableId).DataTable({
                ordering: true, // Enable manual sorting
                order: [], // Disable initial sorting
                columnDefs: [
                    { orderable: false, targets: [0] }
                ]
            });
        }

        function applyFilter() {
          // Reinitialize DataTables
          initDataTable('#sortTable1', 'datatable1');
          initDataTable('#sortTable2', 'datatable2');
          initDataTable('#sortTable3', 'datatable3');
          initDataTable('#sortTable4', 'datatable4');
          initDataTable('#sortTable5', 'datatable5');

          function initDataTable(tableId, variableName) {
              // Check if the datatable is already initialized
              if ($.fn.DataTable.isDataTable(tableId)) {
                  // Destroy the existing DataTable instance
                  $(tableId).DataTable().destroy();
              }

              // Initialize the datatable and assign it to the global variable
              window[variableName] = $(tableId).DataTable({
                  ordering: true, // Enable manual sorting
                  order: [], // Disable initial sorting
                  language: {
                      url: "/assets/lang/Malay.json"
                  },
                  columnDefs: [
                          { orderable: false, targets: [0] }
                      ]
              });
          }
          var selectedInstitusi = $('[name="institusi"]').val();

          // Apply search filter and log data for all tables
          applyAndLogFilter('Table 1', datatable1, selectedInstitusi);
          applyAndLogFilter('Table 2', datatable2, selectedInstitusi);
          applyAndLogFilter('Table 3', datatable3, selectedInstitusi);
          applyAndLogFilter('Table 4', datatable4, selectedInstitusi);
          applyAndLogFilter('Table 5', datatable5, selectedInstitusi);
        }

        function applyAndLogFilter(tableName, table, filterValue) {
            // Apply search filter to the table
            table.column(5).search(filterValue).draw();

            // Log filtered data
            console.log(`Filtered Data (${tableName}):`, table.rows({ search: 'applied' }).data().toArray());

            // Go to the first page for the table
            table.page(0).draw(false);

            // Log the data of visible rows on the first page for the table
            console.log(`Data on Visible Rows (${tableName}, First Page):`, table.rows({ page: 'current' }).data().toArray());
        }

        function logTableData(message, table) {
            console.log(message, table.rows().data().toArray());
        }
    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/3.1.9-1/crypto-js.js"></script>

    <script>

      function sendData() {
        const secretKey = "{{ $secretKey }}";
        const time = {{ time() }}; 
        const token = generateToken(secretKey, time);

        // console.log("Token:", token);

        // Construct the JSON array with the token
        const tokenArray = [{ "token": token }];

        // Set the JSON array in the textarea
        const tokenTextarea = document.getElementById('token');
        tokenTextarea.value = JSON.stringify(tokenArray, null, 2);
        // console.log("Token JSON:", tokenTextarea.value);

        const form = document.getElementById('hantar_maklumat');
        const data = new FormData(form);

        fetch('https://espb.mohe.gov.my/api/studentsInfo.php', {
            method: 'POST',
            body: data
        })
        .then(response => response.json())
        .then(data => {
            console.log(data); // Log the API response to the console

            // Convert the API response to a string for display in the alert
            const responseDataString = JSON.stringify(data, null, 2);

            if (data.status === 'error'){
              Swal.fire({
                icon: 'error',
                title: 'Tidak Berjaya',
                text: 'Data tidak berjaya hantar ke ESP. Sila hantar sekali lagi.',
              }).then((result) => {
                  // Check if the user clicked OK
                  if (result.isConfirmed) {
                      // Reload the page
                      location.reload();
                  }
              });
              
              // alert(`Data tidak berjaya hantar ke ESP. Sila hantar sekali lagi.`);
              // alert(`Data tidak berjaya di hantar ke ESP\n\nAPI Response:\n${responseDataString}`);
              
            }else{
              Swal.fire({
                icon: 'success',
                title: 'Berjaya',
                text: 'Data berjaya di hantar ke ESP. Semak ESP',
              }).then((result) => {
                  // Check if the user clicked OK
                  if (result.isConfirmed) {
                      // Reload the page
                      location.reload();
                  }
              });
              // alert(`Data berjaya di hantar ke ESP. Semak ESP`); // Show success message and API response in alert
              // alert(`Data berjaya di hantar ke ESP\n\nAPI Response:\n${responseDataString}`); // Show success message and API response in alert
            }

            // location.reload(); // Refresh the page
        })

        .catch(error => {
            console.error('API Request failed:', error);
            location.reload(); // Refresh the page
        });
        

      }
      function generateToken(secretKey, time) {
        const dataToHash = secretKey + time;
        const hash = CryptoJS.SHA256(dataToHash).toString(CryptoJS.enc.Hex);
        return hash;
      }

    </script>
  </body>
</x-default-layout>
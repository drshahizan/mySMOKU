
{{-- <x-default-layout>  --}}
  <head>
  
    <!-- MAIN CSS -->
    <link rel="stylesheet" href="/assets/css/saringan.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js"></script>
    <link href="assets/css/style.bundle.css" rel="stylesheet" type="text/css" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
  </head>
    <!--begin::Page title-->
    <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
      <!--begin::Title-->
      <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Status Dibayar</h1>
      <!--end::Title-->
    </div>
    <br>
    <!--end::Page title-->
    <div class="table-responsive">
      <!--begin::Content-->
      <div id="kt_app_content" class="app-content flex-column-fluid">
        <!--begin::Content container-->
        <div id="kt_app_content_container" class="app-container container-xxl">
          <!--begin::Card-->
          <div class="card">
            <!--begin::Card header-->
            <div class="card-header border-0 pt-6">
              <!--begin::Card title-->
              <div class="card-title">
                <!--begin::Search-->
                <div class="d-flex align-items-center position-relative my-1">
                  <i>
                    <span class="path1"></span>
                    <span class="path2"></span>
                  </i>
                  
                </div>
                <!--end::Search-->
              </div>
              <!--begin::Card title-->
            </div>
            <!--end::Card header-->
            <!--begin::Card body-->
            <div class="card-body pt-0">
              <!--begin::Table-->
              <div class="table-responsive">
                <table class="table align-center table-row-dashed fs-6 gy-5" id="sortTable1">
                  <thead>
                    <tr class="text-start align-center text-gray-400 fw-bold fs-7 gs-0">
                      <th class="text-center">Bil</th>
                      <th class="text-center"><b>ID Permohonan</b></th>                                                   
                      <th class="text-center"><b>ID Tuntutan</b></th>                                                   
                      <th class="text-center"><b>Nama</b></th>
                      <th class="text-center"><b>Nama Kursus</b></th>
                      <th class="text-center"><b>Institusi Pengajian</b></th>
                      <th class="text-center"><b>Amaun Yuran</b></th>
                      <th class="text-center"><b>Amaun Wang Saku</b></th>
                      <th class="text-center"><b>Tarikh Transaksi</b></th>
                      <th class="text-center"><b>Status</b></th>
                    </tr>
                  </thead>
                  <tbody class="fw-semibold text-gray-600">
                    @php
                      $i=0;
                    @endphp
                    @foreach ($kelulusan as $item)
  
                      @php
                        $i++;
                        $nama_pemohon = DB::table('smoku')->where('id', $item['smoku_id'])->value('nama');
                        $nama_kursus = DB::table('smoku_akademik')->where('smoku_id', $item['smoku_id'])->value('nama_kursus');
                        $no_kp = DB::table('smoku')->where('id', $item['smoku_id'])->value('no_kp');
                        $status = DB::table('bk_status')->where('kod_status', $item['status'])->value('status');
                      
                        $institusi_pengajian = DB::table('smoku_akademik')->join('bk_info_institusi','bk_info_institusi.id_institusi','=','smoku_akademik.id_institusi' )->where('smoku_id', $item['smoku_id'])->value('bk_info_institusi.nama_institusi');

                        
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
                      <td>{{ $loop->iteration }}.</td>
                      <td>{{ $item->no_rujukan_permohonan}}</td>
                      <td>{{ $item->no_rujukan_tuntutan}}</td>
                      <td>{{$pemohon}}</td>                                    
                      <td>{{$namakursus}}</td>
                      <td>{{$institusipengajian}}</td>
                      <td>RM {{number_format($item->yuran_dibayar, 2)}}</td>
                      <td>RM {{number_format($item->wang_saku_dibayar, 2)}}</td>
                      <td class="text-center">{{date('d/m/Y', strtotime($item->tarikh_transaksi))}}</td>
                      <td>{{$status}}</td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
              <!--end::Table-->
            </div>
            <!--end::Card body-->
          </div>
          <!--end::Card-->	
        </div>
        <!--end::Content container-->
      </div>
      <!--end::Content-->
    </div>
  
    <script>
      //sorting function
      // $('#sortTable1').DataTable();
  
    </script>
  
  <!-- Your existing JavaScript code -->
  
  <!--begin::Javascript-->
  
  <!--end::Javascript-->
  
  
  
  
  
  {{-- </x-default-layout> --}}
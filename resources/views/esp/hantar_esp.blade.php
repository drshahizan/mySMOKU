{{-- <x-default-layout>  --}}
  <head>
  
  <!-- MAIN CSS -->
  <link rel="stylesheet" href="/assets/css/saringan.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js"></script>
  <link href="assets/css/style.bundle.css" rel="stylesheet" type="text/css" />
  
  </head>
      <!--begin::Page title-->
  <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
    <!--begin::Title-->
    <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Maklumat ESP</h1>
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
              <table class="table align-center table-row-dashed fs-6 gy-5" id="kt_customers_table">
                <thead>
                  <tr class="text-start align-center text-gray-400 fw-bold fs-7 gs-0">
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
                    <td>{{ $item->no_rujukan_permohonan}}</td>
                    <td>{{$pemohon}}</td>
                    <td>{{ucwords(strtolower($jenis_kecacatan))}}</td>                                       
                    <td>{{$namakursus}}</td>
                    <td>{{$institusipengajian}}</td>
                    <td class="text-center">{{date('d/m/Y', strtotime($tarikh_mula))}}</td>
                    <td class="text-center">{{date('d/m/Y', strtotime($tarikh_tamat))}}</td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
            <!--end::Table-->
          </div>
          <!--end::Card body-->
          <!--begin::Card body-->
          <div class="card-body pt-0">
            <!--begin::Form-->
            <form class="form" action="http://espbdev.mohe.gov.my/api/studentsInfo.php" method="post">
                
                <textarea name="data" id="data" rows="10" cols="50">
                    {{$jsonContent}}
                    {{-- [
                      {
                        "nokp": "1234567890",
                        "nama": "John Doe",
                        "tarikh_lahir": "1990-01-15",
                        "negeri_lahir": "Selangor",
                        "jantina": "Male",
                        "agama": "Islam",
                        "keturunan": "Malay",
                        "warganegara": "Malaysian",
                        "alamat1": "123 Main Street",
                        "alamat2": "Apt 4B",
                        "poskod": "12345",
                        "bandar": "Cityville",
                        "negeri": "Selangor",
                        "telefon_hp": "555-123-4567",
                        "alamat01": "456 Elm Street",
                        "alamat02": "Unit 7C",
                        "alamat03": "",
                        "telefon_o": "555-987-6543",
                        "program": "Bachelor of Science",
                        "peringkat": "Degree",
                        "tahun_tawar": "2023",
                        "tahun_taja": "2023",
                        "tempoh_taja": "4 years",
                        "tarikh_taja": "2023-09-01",
                        "sesi_mula": "September",
                        "sesi_tamat": "June",
                        "institut": "University of Example",
                        "kursus": "Computer Science",
                        "tarikh_tamat": "2027-06-30",
                        "no_akaun": "1234567890",
                        "nama_akaun": "John Doe",
                        "kod_bank": "ABC123",
                        "nama_bank": "Example Bank",
                        "id_permohonan": "987654321"
                      },
                      {
                        "nokp": "9876543210",
                        "nama": "Jane Smith",
                        "tarikh_lahir": "1992-05-20",
                        "negeri_lahir": "Kuala Lumpur",
                        "jantina": "Female",
                        "agama": "Christian",
                        "keturunan": "Chinese",
                        "warganegara": "Malaysian",
                        "alamat1": "456 Oak Avenue",
                        "alamat2": "Suite 2C",
                        "poskod": "54321",
                        "bandar": "Townsville",
                        "negeri": "Selangor",
                        "telefon_hp": "555-987-6543",
                        "alamat01": "789 Pine Street",
                        "alamat02": "Unit 3D",
                        "alamat03": "",
                        "telefon_o": "555-123-4567",
                        "program": "Master of Business Administration",
                        "peringkat": "Master's",
                        "tahun_tawar": "2024",
                        "tahun_taja": "2024",
                        "tempoh_taja": "2 years",
                        "tarikh_taja": "2024-08-15",
                        "sesi_mula": "August",
                        "sesi_tamat": "May",
                        "institut": "Business School",
                        "kursus": "MBA",
                        "tarikh_tamat": "2026-05-30",
                        "no_akaun": "9876543210",
                        "nama_akaun": "Jane Smith",
                        "kod_bank": "XYZ789",
                        "nama_bank": "Another Bank",
                        "id_permohonan": "123456789"
                      }
                    ] --}}
                </textarea>
                <!--begin::action-->
                <div class="footer">
                  <!--begin::Button-->
                  <button type="submit" id="kt_modal_add_customer_submit" class="btn btn-primary">
                    <span class="indicator-label">Hantar</span>
                    <span class="indicator-progress">Sila tunggu...
                    <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                  </button>
                  <!--end::Button-->
                </div>
                <!--end::action-->
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

<!--begin::Javascript-->

<!--end::Javascript-->





{{-- </x-default-layout> --}}
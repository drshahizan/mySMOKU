<x-default-layout> 
  <head>
      <!-- MAIN CSS -->
      <link rel="stylesheet" href="/assets/css/sekretariat.css">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.min.css">
      <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
      <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
      <script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js"></script>
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
      <div class="block-header">
        <!--begin::Content container-->
        <div class="row clearfix">
          <!--begin::Card-->
          <div class="card">
            <!--begin::Card header-->
            <div class="header">
                <h2>Senarai Permohonan Layak<br><small>Sila tanda pada kotak kecil dan klik "Hantar" untuk menyerahkan data pemohon kepada ESP.</small></h2>
            </div>
            <!--end::Card header-->

            {{-- Javascript Nav Bar --}}
            <ul class="nav nav-tabs" id="myTab" role="tablist">
              <li class="nav-item" role="presentation">
                  <button class="nav-link active" id="bkoku-tab" data-toggle="tab" data-target="#bkoku" type="button" role="tab" aria-controls="bkoku" aria-selected="true">BKOKU</button>
              </li>
              <li class="nav-item" role="presentation">
                <button class="nav-link" id="bkokuUA-tab" data-toggle="tab" data-target="#bkokuUA" type="button" role="tab" aria-controls="bkokuUA" aria-selected="true">BKOKU UA</button>
              </li>
              <li class="nav-item" role="presentation">
                  <button class="nav-link" id="ppk-tab" data-toggle="tab" data-target="#ppk" type="button" role="tab" aria-controls="ppk" aria-selected="false">PPK</button>
              </li>
            </ul>

            {{-- Content Navigation Bar --}}
            <div class="tab-content" id="myTabContent">
              {{-- BKOKU --}}
              <div class="tab-pane fade show active" id="bkoku" role="tabpanel" aria-labelledby="bkoku-tab">
                <br>
                  <!--begin::Card body-->
                  <div class="card-body pt-0">
                    <!--begin::Table-->
                    <div class="table-responsive">
                      <table id="sortTable1" class="table table-bordered table-striped">
                        <thead>
                          <tr>
                            <th class="text-center" style="width:4%;">
                              <input type="checkbox" name="select-all" id="select-all-bkoku" onclick="toggleSelectAll('bkoku');" />
                            </th>
                            <th class="text-center" style="width: 15%"><b>ID Permohonan</b></th>                                                   
                            <th class="text-center" style="width: 20%"><b>Nama</b></th>
                            <th class="text-center" style="width: 20%"><b>Nama Kursus</b></th>
                            <th class="text-center" style="width: 15%"><b>Institusi Pengajian</b></th>
                            <th class="text-center" style="width: 13%"><b>Yuran Disokong (RM)</b></th>
                            <th class="text-center" style="width: 13%"><b>Wang Saku Disokong (RM)</b></th>
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
                                $institusi_pengajian = DB::table('smoku_akademik')->join('bk_info_institusi','bk_info_institusi.id_institusi','=','smoku_akademik.id_institusi' )->where('smoku_id', $bkoku['smoku_id'])->where('smoku_akademik.status', 1)->value('bk_info_institusi.nama_institusi');
                                $jenis_institusi = DB::table('smoku_akademik')->join('bk_info_institusi','bk_info_institusi.id_institusi','=','smoku_akademik.id_institusi' )->where('smoku_id', $bkoku['smoku_id'])->where('smoku_akademik.status', 1)->value('bk_info_institusi.jenis_institusi');
                                $tarikh_mula = DB::table('smoku_akademik')->where('smoku_id', $bkoku['smoku_id'])->value('tarikh_mula');
                                $tarikh_tamat = DB::table('smoku_akademik')->where('smoku_id', $bkoku['smoku_id'])->value('tarikh_tamat');
                                $program = DB::table('permohonan')->where('id',$bkoku['id'])->value('program');

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
                                @if ($jenis_institusi != "UA") 
                                  <tr>
                                    <td class="text-center"><input type="checkbox" class="select-checkbox" name="selected_items[]" value="{{ $no_kp }}" /></td>
                                    <td class="text-center">{{ $bkoku->no_rujukan_permohonan}}</td>
                                    <td>{{$pemohon}}</td>
                                    <td>{{$namakursus}}</td>
                                    <td>{{$institusipengajian}}</td>
                                    <td class="text-right">{{$bkoku->yuran_disokong}}</td>
                                    <td class="text-right">{{$bkoku->wang_saku_disokong}}</td>
                                  </tr>
                                @endif  
                              @endif
                          @endforeach
                        </tbody>
                      </table>
                    </div>
                    <!--end::Table-->
                  </div>
                  <!--end::Card body-->
              </div>
              {{-- BKOKU UA--}}
              <div class="tab-pane fade" id="bkokuUA" role="tabpanel" aria-labelledby="bkokuUA-tab">
                <br>
                  <!--begin::Card body-->
                  <div class="card-body pt-0">
                    <!--begin::Table-->
                    <div class="table-responsive">
                      <table id="sortTable1a" class="table table-bordered table-striped">
                        <thead>
                          <tr>
                            <th class="text-center" style="width:3%;">
                              <input type="checkbox" name="select-all" id="select-all-bkokuUA" onclick="toggleSelectAll('bkokuUA');" />
                            </th>
                            <th class="text-center" style="width: 15%"><b>ID Permohonan</b></th>                                                   
                            <th class="text-center" style="width: 20%"><b>Nama</b></th>
                            <th class="text-center" style="width: 20%"><b>Nama Kursus</b></th>
                            <th class="text-center" style="width: 15%"><b>Institusi Pengajian</b></th>
                            <th class="text-center" style="width: 13%"><b>Yuran Disokong (RM)</b></th>
                            <th class="text-center" style="width: 13%"><b>Wang Saku Disokong (RM)</b></th>
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
                                $institusi_pengajian = DB::table('smoku_akademik')->join('bk_info_institusi','bk_info_institusi.id_institusi','=','smoku_akademik.id_institusi' )->where('smoku_id', $bkoku['smoku_id'])->where('smoku_akademik.status', 1)->value('bk_info_institusi.nama_institusi');
                                $jenis_institusi = DB::table('smoku_akademik')->join('bk_info_institusi','bk_info_institusi.id_institusi','=','smoku_akademik.id_institusi' )->where('smoku_id', $bkoku['smoku_id'])->where('smoku_akademik.status', 1)->value('bk_info_institusi.jenis_institusi');
                                $tarikh_mula = DB::table('smoku_akademik')->where('smoku_id', $bkoku['smoku_id'])->value('tarikh_mula');
                                $tarikh_tamat = DB::table('smoku_akademik')->where('smoku_id', $bkoku['smoku_id'])->value('tarikh_tamat');
                                $program = DB::table('permohonan')->where('id',$bkoku['id'])->value('program');

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
                                @if ($jenis_institusi=="UA") 
                                  <tr>
                                    <td class="text-center" style="width: 4%"><input type="checkbox" class="select-checkbox" name="selected_items[]" value="{{ $no_kp }}" /></td>
                                    <td class="text-center" style="width: 15%">{{ $bkoku->no_rujukan_permohonan}}</td>
                                    <td style="width: 20%">{{$pemohon}}</td>
                                    <td style="width: 20%">{{$namakursus}}</td>
                                    <td style="width: 15%">{{$institusipengajian}}</td>
                                    <td class="text-right" style="width: 13%">{{$bkoku->yuran_disokong}}</td>
                                    <td class="text-right" style="width: 13%">{{$bkoku->wang_saku_disokong}}</td>
                                  </tr>
                                @endif   
                              @endif
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
                      <table id="sortTable2"  class="table table-bordered table-striped">
                        <thead>
                          <tr>
                            <th class="text-center" style="width:3%;">
                              <input type="checkbox" name="select-all" id="select-all-ppk" onclick="toggleSelectAll('ppk');" />
                            </th>
                            <th class="text-center" style="width: 15%"><b>ID Permohonan</b></th>                                                   
                            <th class="text-center" style="width: 25%"><b>Nama</b></th>
                            <th class="text-center" style="width: 25%"><b>Nama Kursus</b></th>
                            <th class="text-center" style="width: 20%"><b>Institusi Pengajian</b></th>
                            <th class="text-center" style="width: 12%"><b>Wang Saku Disokong (RM)</b></th>
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
                                <td class="text-center" style="width: 4%"><input type="checkbox" class="select-checkbox" name="selected_items[]" value="{{ $no_kp }}" /></td>
                                <td class="text-center" style="width: 15%">{{ $item->no_rujukan_permohonan}}</td>
                                <td style="width: 25%">{{$pemohon}}</td>
                                <td style="width: 25%">{{$namakursus}}</td>
                                <td style="width: 20%">{{$institusipengajian}}</td>
                                <td class="text-right" style="width: 12%">{{$item->wang_saku_disokong}}</td>
                              </tr>
                            @endif  
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

  <script>
      $('#sortTable1').DataTable({
          ordering: true, // Enable manual sorting
          order: [] // Disable initial sorting
      });
      $('#sortTable1a').DataTable({
          ordering: true, // Enable manual sorting
          order: [] // Disable initial sorting
      });
      $('#sortTable2').DataTable({
          ordering: true, // Enable manual sorting
          order: [] // Disable initial sorting
      });
  </script>

  <script>
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
            url: "{{ route('maklumat.esp') }}",
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
                    url: "{{ route('maklumat.esp') }}",
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

  <!--begin::Javascript-->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/3.1.9-1/crypto-js.js"></script>

  <script>
    function sendData() {
      const secretKey = "{{ $secretKey }}";
      const time = {{ time() }}; 
      const token = generateToken(secretKey, time);

      // Construct the JSON array with the token
      const tokenArray = [{ "token": token }];

      // Set the JSON array in the textarea
      const tokenTextarea = document.getElementById('token');
      tokenTextarea.value = JSON.stringify(tokenArray, null, 2);
      // console.log("Token JSON:", tokenTextarea.value);

      const form = document.getElementById('hantar_maklumat');
      const data = new FormData(form);

      fetch('http://espbstg.mohe.gov.my/api/studentsInfo.php', {
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
  <!--end::Javascript-->

</body>
</x-default-layout>
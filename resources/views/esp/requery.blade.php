{{-- <x-default-layout>  --}}
  <head>
  
  <!-- MAIN CSS -->
  <link rel="stylesheet" href="/assets/css/sekretariat.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js"></script>
  <link href="assets/css/style.bundle.css" rel="stylesheet" type="text/css" />
  <meta name="csrf-token" content="{{ csrf_token() }}">
  
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
          {{-- Javascript Nav Bar --}}
          <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="bkokuUA-tab" data-toggle="tab" data-target="#bkokuUA" type="button" role="tab" aria-controls="bkokuUA" aria-selected="true">BKOKU UA</button>
            </li>
          </ul>
          {{-- Content Navigation Bar --}}
          <div class="tab-content" id="myTabContent">
            {{-- BKOKU --}}
            <div class="tab-pane fade show active" id="bkokuUA" role="tabpanel" aria-labelledby="bkokuUA-tab">
              <br>
                <!--begin::Card body-->
                <div class="card-body pt-0">
                  <!--begin::Table-->
                  <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                      <thead>
                        <tr>
                          <th class="text-center" style="width:3%;">
                            <input type="checkbox" name="select-all" id="select-all-bkokuUA" onclick="toggleSelectAll('bkokuUA');" />
                          </th>
                          <th style="width: 10%" class="text-center"><b>ID Permohonan</b></th>
                          <th style="width: 20%" class="text-center"><b>Nama</b></th>
                          <th style="width: 21%" class="text-center"><b>Nama Kursus</b></th>
                          <th style="width: 25%" class="text-center"><b>Institusi Pengajian</b></th>
                          <th style="width: 8%" class="text-center"><b>Tarikh Permohonan</b></th>
                          <th style="width: 8%" class="text-center"><b>Amaun Yuran</b></th>
                          <th style="width: 8%" class="text-center"><b>Amaun Wang Saku</b></th>
                          <th style="width: 8%" class="text-center"><b>Tarikh Dibayar</b></th>
                          <th style="width: 8%" class="text-center"><b>Status</b></th>
                        </tr>
                      </thead>
                      <tbody class="fw-semibold text-gray-600">
                        @php
                          $i=0;
                        @endphp
                        @foreach ($bkokuUA as $bkoku)

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
                            $status = DB::table('bk_status')->where('kod_status', $bkoku['status'])->value('status');
                            //dd($bkoku['smoku_id']);

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
                                <td class="text-center"><input type="checkbox" class="select-checkbox" name="selected_items[]" value="{{ $no_kp }}" /></td>
                                <td class="text-center">{{ $bkoku->no_rujukan_permohonan}}</td>
                                <td class="text-center">{{$pemohon}}</td>
                                <td class="text-center">{{$namakursus}}</td>
                                <td class="text-center">{{$institusipengajian}}</td>
                                <td class="text-center">{{date('d/m/Y', strtotime($bkoku->created_at))}}</td>
                                <td class="text-center">{{ $bkoku->yuran_dibayar}}</td>
                                <td class="text-center">{{ $bkoku->wang_saku_dibayar}}</td>
                                <td class="text-center">{{date('d/m/Y', strtotime($bkoku->tarikh_transaksi))}}</td>
                                <td class="text-center">{{ $status}}</td>
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
          </div>     
          <!--begin::Card body-->
          <div class="card-body pt-0">
            <!--begin::Form-->
            <form class="form" action="http://espbstg.mohe.gov.my/api/studentsStatus.php" method="post">
              @csrf
                
                <textarea name="data" id="data" rows="10" cols="50">
                {{-- [
                  {
                    "noic": "950623031212",
                    "id_permohonan": "B/4/950623031212",
                    "id_tuntutan": ""
                  }
                ] --}}
                </textarea>
                <!--begin::action-->
                <div class="footer">
                  <!--begin::Button-->
                  <button type="submit" id="kt_modal_add_customer_submit" class="btn btn-primary">
                    <span class="indicator-label">Hantar</span>
                    
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

  </script>

<!-- Your existing JavaScript code -->
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
        url: "{{ route('kemaskini.esp') }}",
        data: {
            selectedNokps: selectedNokps
        },
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(response) {
          //alert('siniii');
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
                url: "{{ route('kemaskini.esp') }}",
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
  /* #token {
    display: none;
  }
  #data {
    display: none;
  } */
</style>


<!--begin::Javascript-->
<script>
  // function sendData() {
  //     const form = document.getElementById('hantar_maklumat');
  //     const data = new FormData(form);

  //     fetch('http://espbstg.mohe.gov.my/api/studentsInfo.php', {
  //         method: 'POST',
  //         body: data
  //     })
  //     .then(response => response.json())
  //     .then(data => {
  //         console.log(data); // Log the API response to the console
  //         //alert ('Data berjaya di hantar ke ESP');
  //     })
  //     .catch(error => {
  //         console.error('API Request failed:', error);
  //     });
  // }


</script>
<!--end::Javascript-->





{{-- </x-default-layout> --}}
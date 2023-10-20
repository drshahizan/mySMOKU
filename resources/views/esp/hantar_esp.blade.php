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
                    <th class="text-center" style="width:3%;">
                      <input type="checkbox" name="select-all" id="select-all" onclick="toggleSelectAll();" />
                    </th>
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
                    <td class="text-center"><input type="checkbox" class="select-checkbox" name="selected_items[]" value="{{ $no_kp }}" /></td>
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
            <form class="form" action="http://espbstg.mohe.gov.my/api/studentsInfo.php" method="post">
                
                <textarea name="data" id="data" rows="10" cols="50">
{{-- {{$jsonContent}} --}}
{{-- [{
	"nokp":"950623031212",
	"nama":"SOFEA AINA BINTI MUHAMMAD AMIR",
	"tarikh_lahir":"23/06/1995",
	"negeri_lahir":"1",
	"jantina":"P",
	"agama":"I",
	"keturunan":"1",
	"warganegara":"M01",
	"alamat1":"B 8/5/4 KUARTERS PDRM FLAT PADANG HILIRAN KUALA TERENGGANU TER 21100 KUALA TERENGGANU TERENGGANU",
	"alamat2":"",
	"poskod":null,
	"bandar":null,
	"negeri":null,
	"telefon_hp":"0199400011",
	"alamat01":"B 8/5/4 KUARTERS PDRM FLAT PADANG HILIRAN KUALA TERENGGANU TER 21100 KUALA TERENGGANU TERENGGANU",
	"alamat02":"",
	"alamat03":"",
	"telefon_o":"",
	"program":"OKU",
	"peringkat":"22",
	"tahun_tawar":"01/10/2023",
	"tahun_taja":"01/10/2023",
	"tempoh_taja":"48",
	"tarikh_taja":"01/10/2023",
	"sesi_mula":"2023",
	"sesi_tamat":"2027",
	"institut":"M0101014",
	"kursus":"BACHELOR OF ARTS (HONOURS) IN MEDIA AND COMMUNICATION STUDIES",
	"tarikh_tamat":"30/09/2027",
	"no_akaun":"99999999999999",
	"nama_akaun":"SOFEA AINA BINTI MUHAMMAD AMIR",
	"kod_bank":"45",
	"nama_bank":"BANK ISLAM MALAYSIA BERHAD",
	"id_permohonan":"B/2/950623031212"
},
  
{
	"nokp":"920623011905",
	"nama":"MUHAMMAD KAMAL BIN HALIM",
	"tarikh_lahir":"23/06/1995",
	"negeri_lahir":"1",
	"jantina":"P",
	"agama":"I",
	"keturunan":"1",
	"warganegara":"M01",
	"alamat1":"B 8/5/4 KUARTERS PDRM FLAT PADANG HILIRAN KUALA TERENGGANU TER 21100 KUALA TERENGGANU TERENGGANU",
	"alamat2":"",
	"poskod":null,
	"bandar":null,
	"negeri":null,
	"telefon_hp":"0199400011",
	"alamat01":"B 8/5/4 KUARTERS PDRM FLAT PADANG HILIRAN KUALA TERENGGANU TER 21100 KUALA TERENGGANU TERENGGANU",
	"alamat02":"",
	"alamat03":"",
	"telefon_o":"",
	"program":"OKU",
	"peringkat":"22",
	"tahun_tawar":"01/10/2023",
	"tahun_taja":"01/10/2023",
	"tempoh_taja":"48",
	"tarikh_taja":"01/10/2023",
	"sesi_mula":"2023",
	"sesi_tamat":"2027",
	"institut":"M0101014",
	"kursus":"J0307",
	"tarikh_tamat":"30/09/2027",
	"no_akaun":"99999999999999",
	"nama_akaun":"SOFEA AINA BINTI MUHAMMAD AMIR",
	"kod_bank":"45",
	"nama_bank":"BANK ISLAM MALAYSIA BERHAD",
	"id_permohonan":"B/2/920623011905"
}] --}}
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

  </script>

<!-- Your existing JavaScript code -->
<script>


  $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

function toggleSelectAll() {
    var selectAllCheckbox = document.getElementById('select-all');
    var isChecked = selectAllCheckbox.checked;

    // Get all checkboxes in the table
    var checkboxes = document.querySelectorAll('input[name="selected_items[]"]');

    // Set the checked property of all checkboxes to match the "Select All" checkbox
    checkboxes.forEach(function(checkbox) {
        checkbox.checked = isChecked;
    });

    // Prepare an array to hold selected no_kp values
    var selectedNokps = [];

    // If "Select All" checkbox is checked, set the selectAll parameter to true
    var selectAll = isChecked;

    // Loop through all checkboxes and get selected nokp values
    checkboxes.forEach(function(checkbox) {
        if (checkbox.checked) {
            selectedNokps.push(checkbox.value);
        }
    });

    // Send selectedNokps and selectAll to the controller via AJAX
    $.ajax({
        type: "POST",
        url: "{{ route('maklumat.esp') }}",
        data: {
            selectedNokps: selectedNokps,
            selectAll: selectAll
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
}

  // jQuery script to handle checkbox selection and update textarea
  $(document).ready(function() {
    // Event listener for checkbox change
    $('.select-checkbox').change(function() {
        var selectedNokps = [];

        // Loop through all checkboxes and get selected nokp values
        $('.select-checkbox:checked').each(function() {
            selectedNokps.push($(this).val());
        });

        // Send selectedNokps to the controller via AJAX
        $.ajax({
            type: "POST",
            url: "{{ route('maklumat.esp') }}",
            data: {
                selectedNokps: selectedNokps
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
    });
});


// document.addEventListener("DOMContentLoaded", function() {
//     // Get the submit button by its ID
//     var submitButton = document.getElementById("kt_modal_add_customer_submit");

//     // Add event listener to the submit button
//     submitButton.addEventListener("click", function(event) {
//         // Prevent the default form submission behavior
//         event.preventDefault();

//         // Show a confirmation popup
//         var confirmed = confirm("Pasti?");

//         // Check if the user confirmed
//         if (confirmed) {
//             // You can perform form validation or any other necessary tasks here

//             // Redirect to another page
//             window.location.href = "{{ route('maklumat.esp') }}"; // Replace this URL with the desired redirect URL
//         } else {
//             // If the user cancels, do nothing or handle it accordingly
//         }
//     });
// });


</script>


<!--begin::Javascript-->

<!--end::Javascript-->





{{-- </x-default-layout> --}}
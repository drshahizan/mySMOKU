<x-default-layout> 
  <head>
      <title>Sekretariat BKOKU KPT | Permohonan ESP</title>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1">
      <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
      <!-- MAIN CSS -->
      <link rel="stylesheet" href="/assets/css/saringan.css">

      <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
      <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
      <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
      <script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js"></script>

      <link href="/assets/css/style.bundle.css" rel="stylesheet" type="text/css" />
      <meta name="csrf-token" content="{{ csrf_token() }}">

      <style>
          /* .nav{
              margin-left: 20px!important;
          } */

          .custom-width-select {
              width: 400px !important; 
          }
          .form-select {
                  margin-left: 10px !important; 
          }

          @media (max-width: 768px) {
              .nav-tabs {
                  display: flex;
                  flex-direction: column;
                  gap: 10px; /* Add space between the buttons */
                  width: 100%; /* Ensure it takes full width */
              }

              .nav-tabs .nav-item {
                  flex: 1; /* Make each item take equal width */
              }

              .nav-tabs .nav-link {
                  display: block;
                  text-align: center;
                  width: 100%; 
                  padding: 10px;
                  font-size: 16px;
                  font-weight: bold;
                  border: none; /* Remove default borders */
                  border-radius: 5px; /* Add rounded corners */
              }

              .nav-tabs .nav-link.active {
                  background-color: #003366; /* Change active tab background color */
                  color: white; /* Active tab text color */
              }

              .nav-tabs .nav-link {
                  background-color: #f8f9fa; /* Inactive tab background color */
                  color: black; /* Inactive tab text color */
              }

              .custom-width-select {
                  width: 100% !important; /* override desktop */
              }

              .form-select {
                  margin-left: 0 !important; /* remove left margin */
              }
              
          }
      </style>
  </head>

<body>
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
                  <button class="nav-link active" id="bkokuUA-tab" data-toggle="tab" data-target="#bkokuUA" type="button" role="tab" aria-controls="bkokuUA" aria-selected="true">
                    BKOKU UA
                    @if ($countUA > 0)
                      <span class="badge badge-danger">{{ $countUA }}</span>
                    @endif
                  </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="bkokuPOLI-tab" data-toggle="tab" data-target="#bkokuPOLI" type="button" role="tab" aria-controls="bkokuPOLI" aria-selected="true">
                      BKOKU POLI
                      @if ($countPOLI > 0)
                        <span class="badge badge-danger">{{ $countPOLI }}</span>
                      @endif
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="bkokuKK-tab" data-toggle="tab" data-target="#bkokuKK" type="button" role="tab" aria-controls="bkokuKK" aria-selected="true">
                      BKOKU KK
                      @if ($countKK > 0)
                        <span class="badge badge-danger">{{ $countKK }}</span>
                      @endif
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                  <button class="nav-link" id="bkokuIPTS-tab" data-toggle="tab" data-target="#bkokuIPTS" type="button" role="tab" aria-controls="bkokuIPTS" aria-selected="true">
                    BKOKU IPTS
                    @if ($countIPTS > 0)
                      <span class="badge badge-danger">{{ $countIPTS }}</span>
                    @endif
                  </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="ppk-tab" data-toggle="tab" data-target="#ppk" type="button" role="tab" aria-controls="ppk" aria-selected="false">
                      PPK
                      @if ($countPPK > 0)
                        <span class="badge badge-danger">{{ $countPPK }}</span>
                      @endif 
                    </button>
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
                                <!--begin::Actions-->
                                <button type="submit" class="btn btn-primary fw-semibold" data-kt-menu-dismiss="true" data-kt-subscription-table-filter="filter" onclick="applyFilter()">
                                    <i class="ki-duotone ki-filter fs-2">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>
                                </button>
                                <!--end::Actions-->
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
                {{-- BKOKU UA--}}
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
                              <th><b>ID Permohonan</b></th>                                                   
                              <th><b>Nama</b></th>
                              <th><b>Nama Kursus</b></th>
                              <th><b>Institusi Pengajian</b></th>
                              <th><b>Yuran Disokong (RM)</b></th>
                              <th><b>Wang Saku Disokong (RM)</b></th>
                            </tr>
                          </thead>
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
                              <th class="text-center" style="width:4%;">
                                <input type="checkbox" name="select-all" id="select-all-bkokuPOLI" onclick="toggleSelectAll('bkokuPOLI');" />
                              </th>
                              <th><b>ID Permohonan</b></th>                                                   
                              <th><b>Nama</b></th>
                              <th><b>Nama Kursus</b></th>
                              <th><b>Institusi Pengajian</b></th>
                              <th><b>Yuran Disokong (RM)</b></th>
                              <th><b>Wang Saku Disokong (RM)</b></th>
                            </tr>
                          </thead>
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
                              <th class="text-center" style="width:4%;">
                                <input type="checkbox" name="select-all" id="select-all-bkokuKK" onclick="toggleSelectAll('bkokuKK');" />
                              </th>
                              <th><b>ID Permohonan</b></th>                                                   
                              <th><b>Nama</b></th>
                              <th><b>Nama Kursus</b></th>
                              <th><b>Institusi Pengajian</b></th>
                              <th><b>Yuran Disokong (RM)</b></th>
                              <th><b>Wang Saku Disokong (RM)</b></th>
                            </tr>
                          </thead>
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
                              <th>
                                <input type="checkbox" name="select-all" id="select-all-bkokuIPTS" onclick="toggleSelectAll('bkokuIPTS');" />
                              </th>
                              <th><b>ID Permohonan</b></th>                                                   
                              <th><b>Nama</b></th>
                              <th><b>Nama Kursus</b></th>
                              <th><b>Institusi Pengajian</b></th>
                              <th><b>Yuran Disokong (RM)</b></th>
                              <th><b>Wang Saku Disokong (RM)</b></th>
                            </tr>
                          </thead>
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
                              <th><b>ID Permohonan</b></th>                                                   
                              <th><b>Nama</b></th>
                              <th><b>Nama Kursus</b></th>
                              <th><b>Institusi Pengajian</b></th>
                              <th><b>Wang Saku Disokong (RM)</b></th>
                            </tr>
                          </thead>
                        </table>
                      </div>
                      <!--end::Table-->
                    </div>
                    <!--end::Card body-->
                </div>

                <!--begin::MODAL-->
                <div class="modal fade" id="dokumenModal" tabindex="-1" aria-hidden="true">
                  <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title">Salinan Dokumen Pemohon</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                      </div>
                      <div class="modal-body" id="modalDokumenContent">
                        <p>Sedang dimuatkan...</p>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                      </div>
                    </div>
                  </div>
                </div>

            </div> 
            
            <!--begin::Card body-->
            <div class="card-body pt-0">
                <!--begin::Form-->
                <form class="form" id="hantar_maklumat" style="text-align: right;">
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
    #token {
      display: none;
    }
    #data {
      display: none;
    } 
  </style>

  <script>
    $(document).ready(function() {
			$('.js-example-basic-single').select2();
		});

    function toggleSelectAll(tab) {
        var selectAllCheckbox = document.getElementById('select-all-' + tab);
        if (!selectAllCheckbox) {
            console.error('Select All checkbox not found for tab:', tab);
            return;
        }

        var isChecked = selectAllCheckbox.checked;

        // Get all checkboxes in the active tab
        var checkboxes = document.querySelectorAll('#' + tab + ' input[name="selected_items[]"]');

        if (checkboxes.length === 0) {
            console.warn('No checkboxes found in tab:', tab);
            return;
        }

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

        // If no checkboxes are checked, clear the data in the textarea
        if (selectedNokps.length === 0) {
            $('#data').val('');
            return;
        }

        // Send selectedNokps to the controller via AJAX
        $.ajax({
            type: "POST",
            url: "{{ route('maklumat.esp') }}", // Ensure this URL is correct
            data: {
                selectedNokps: selectedNokps
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                // Handle the response from the controller here
                if (response.data) {
                    var jsonData = response.data;
                    var jsonString = JSON.stringify(jsonData, null, 2);
                    $('#data').val(jsonString);
                } else {
                    console.warn('Unexpected response format:', response);
                }
            },
            error: function(xhr, status, error) {
                // Handle AJAX errors here if needed
                console.error('AJAX Error:', xhr.responseText);
            }
        });
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

 
    
  <script>
      $(document).ready(function() {
          // Initialize JavaScript variables with data from Blade
          var bkokuIPTSList = @json($institusiPengajianIPTS);
          var bkokuPOLIList = @json($institusiPengajianPOLI);
          var bkokuKKList = @json($institusiPengajianKK);
          var bkokuUAList = @json($institusiPengajianUA);
          var ppkList = @json($institusiPengajianPPK);

          // DataTable initialization functions
          function initializeDataTable1() {
              $('#sortTable1').DataTable({
                  ordering: true, // Enable manual sorting
                      order: [], // Disable initial sorting
                      columnDefs: [
                          { orderable: false, targets: [0] }
                      ],
                  ajax: {
                      url: '{{ route("senarai.esp.BKOKUIPTS") }}', // URL to fetch data from
                      dataSrc: '' // Property in the response object containing the data array
                  },
                  language: {
                      url: "/assets/lang/Malay.json"
                  },
                  columns: [ 
                  {
                      data: 'smoku.no_kp', // Assuming 'no_kp' is a unique identifier in your dataset
                      className: 'text-center',
                      width: '4%',
                      render: function (data, type, row, meta) {
                          return `<input type="checkbox" class="select-checkbox" name="selected_items[]" value="${data}" />`;
                      }
                  },
                  {
                      data: 'no_rujukan_permohonan',
                      render: function(data, type, row) {
                        return `
                          <a href="#" 
                            class="open-modal-link" 
                            data-id="${row.id}" 
                            data-type="IPTS"
                            data-bs-toggle="modal" 
                            data-bs-target="#dokumenModal">
                            ${data}
                          </a>`;
                      }
                  }, 
                  { 
                      data: 'smoku.nama', 
                      render: function(data, type, row) {
                          // Define conjunctions to be handled differently
                          var conjunctions_lower = ['bin', 'binti'];
                          var conjunctions_upper = ['A/L', 'A/P'];

                          // Split the nama field into words
                          var words = data.split(' ');

                          // Process each word
                          for (var i = 0; i < words.length; i++) {
                              var word = words[i];

                              // Check if the word is a conjunction to be displayed in lowercase
                              if (conjunctions_lower.includes(word.toLowerCase())) {
                                  // Convert the word to lowercase
                                  words[i] = word.toLowerCase();
                              } else if (conjunctions_upper.includes(word.toUpperCase())) {
                                  // Convert the word to uppercase
                                  words[i] = word.toUpperCase();
                              } else {
                                  // Capitalize the first letter of other words
                                  words[i] = word.charAt(0).toUpperCase() + word.slice(1).toLowerCase();
                              }
                          }

                          // Join the words back into a single string
                          var formatted_nama = words.join(' ');

                          return formatted_nama;
                      }
                  },
                  { data: 'akademik.nama_kursus' }, 
                  { data: 'akademik.infoipt.nama_institusi' }, 
                  { data: 'yuran_disokong' },
                  { data: 'wang_saku_disokong' }
                  ]
              });
          }

          function initializeDataTable2() {
              $('#sortTable2').DataTable({
                  ordering: true, // Enable manual sorting
                      order: [], // Disable initial sorting
                      columnDefs: [
                          { orderable: false, targets: [0] }
                      ],
                  ajax: {
                      url: '{{ route("senarai.esp.BKOKUPOLI") }}', // URL to fetch data from
                      dataSrc: '' // Property in the response object containing the data array
                  },
                  language: {
                      url: "/assets/lang/Malay.json"
                  },
                  columns: [ 
                  {
                      data: 'smoku.no_kp', // Assuming 'no_kp' is a unique identifier in your dataset
                      className: 'text-center',
                      width: '4%',
                      render: function (data, type, row, meta) {
                          return `<input type="checkbox" class="select-checkbox" name="selected_items[]" value="${data}" />`;
                      }
                  },
                  {
                      data: 'no_rujukan_permohonan',
                      render: function(data, type, row) {
                        return `
                          <a href="#" 
                            class="open-modal-link" 
                            data-id="${row.id}" 
                            data-type="POLI"
                            data-bs-toggle="modal" 
                            data-bs-target="#dokumenModal">
                            ${data}
                          </a>`;
                      }
                  }, 
                  { 
                      data: 'smoku.nama', 
                      render: function(data, type, row) {
                          // Define conjunctions to be handled differently
                          var conjunctions_lower = ['bin', 'binti'];
                          var conjunctions_upper = ['A/L', 'A/P'];

                          // Split the nama field into words
                          var words = data.split(' ');

                          // Process each word
                          for (var i = 0; i < words.length; i++) {
                              var word = words[i];

                              // Check if the word is a conjunction to be displayed in lowercase
                              if (conjunctions_lower.includes(word.toLowerCase())) {
                                  // Convert the word to lowercase
                                  words[i] = word.toLowerCase();
                              } else if (conjunctions_upper.includes(word.toUpperCase())) {
                                  // Convert the word to uppercase
                                  words[i] = word.toUpperCase();
                              } else {
                                  // Capitalize the first letter of other words
                                  words[i] = word.charAt(0).toUpperCase() + word.slice(1).toLowerCase();
                              }
                          }

                          // Join the words back into a single string
                          var formatted_nama = words.join(' ');

                          return formatted_nama;
                      }
                  },
                  { data: 'akademik.nama_kursus' }, 
                  { data: 'akademik.infoipt.nama_institusi' }, 
                  { data: 'yuran_disokong' },
                  { data: 'wang_saku_disokong' }
                  ]
              });
          }

          function initializeDataTable3() {
              $('#sortTable3').DataTable({
                  ordering: true, // Enable manual sorting
                      order: [], // Disable initial sorting
                      columnDefs: [
                          { orderable: false, targets: [0] }
                      ],
                  ajax: {
                      url: '{{ route("senarai.esp.BKOKUKK") }}', // URL to fetch data from
                      dataSrc: '' // Property in the response object containing the data array
                  },
                  language: {
                      url: "/assets/lang/Malay.json"
                  },
                  columns: [ 
                  {
                      data: 'smoku.no_kp', // Assuming 'no_kp' is a unique identifier in your dataset
                      className: 'text-center',
                      width: '4%',
                      render: function (data, type, row, meta) {
                          return `<input type="checkbox" class="select-checkbox" name="selected_items[]" value="${data}" />`;
                      }
                  },
                  {
                      data: 'no_rujukan_permohonan',
                      render: function(data, type, row) {
                        return `
                          <a href="#" 
                            class="open-modal-link" 
                            data-id="${row.id}" 
                            data-type="KK"
                            data-bs-toggle="modal" 
                            data-bs-target="#dokumenModal">
                            ${data}
                          </a>`;
                      }
                  }, 
                  { 
                      data: 'smoku.nama', 
                      render: function(data, type, row) {
                          // Define conjunctions to be handled differently
                          var conjunctions_lower = ['bin', 'binti'];
                          var conjunctions_upper = ['A/L', 'A/P'];

                          // Split the nama field into words
                          var words = data.split(' ');

                          // Process each word
                          for (var i = 0; i < words.length; i++) {
                              var word = words[i];

                              // Check if the word is a conjunction to be displayed in lowercase
                              if (conjunctions_lower.includes(word.toLowerCase())) {
                                  // Convert the word to lowercase
                                  words[i] = word.toLowerCase();
                              } else if (conjunctions_upper.includes(word.toUpperCase())) {
                                  // Convert the word to uppercase
                                  words[i] = word.toUpperCase();
                              } else {
                                  // Capitalize the first letter of other words
                                  words[i] = word.charAt(0).toUpperCase() + word.slice(1).toLowerCase();
                              }
                          }

                          // Join the words back into a single string
                          var formatted_nama = words.join(' ');

                          return formatted_nama;
                      }
                  },
                  { data: 'akademik.nama_kursus' }, 
                  { data: 'akademik.infoipt.nama_institusi' }, 
                  { data: 'yuran_disokong' },
                  { data: 'wang_saku_disokong' }
                  ]
              });
          }

          function initializeDataTable4() {
              $('#sortTable4').DataTable({
                  ordering: true, // Enable manual sorting
                      order: [], // Disable initial sorting
                      columnDefs: [
                          { orderable: false, targets: [0] }
                      ],
                  ajax: {
                      url: '{{ route("senarai.esp.BKOKUUA") }}', // URL to fetch data from
                      dataSrc: '' // Property in the response object containing the data array
                  },
                  language: {
                      url: "/assets/lang/Malay.json"
                  },
                  columns: [ 
                  {
                      data: 'smoku.no_kp', // Assuming 'no_kp' is a unique identifier in your dataset
                      className: 'text-center',
                      width: '4%',
                      render: function (data, type, row, meta) {
                          return `<input type="checkbox" class="select-checkbox" name="selected_items[]" value="${data}" />`;
                      }
                  },
                  {
                      data: 'no_rujukan_permohonan',
                      render: function(data, type, row) {
                        return `
                          <a href="#" 
                            class="open-modal-link" 
                            data-id="${row.id}" 
                            data-type="UA"
                            data-bs-toggle="modal" 
                            data-bs-target="#dokumenModal">
                            ${data}
                          </a>`;
                      }
                  }, 
                  { 
                      data: 'smoku.nama', 
                      render: function(data, type, row) {
                          // Define conjunctions to be handled differently
                          var conjunctions_lower = ['bin', 'binti'];
                          var conjunctions_upper = ['A/L', 'A/P'];

                          // Split the nama field into words
                          var words = data.split(' ');

                          // Process each word
                          for (var i = 0; i < words.length; i++) {
                              var word = words[i];

                              // Check if the word is a conjunction to be displayed in lowercase
                              if (conjunctions_lower.includes(word.toLowerCase())) {
                                  // Convert the word to lowercase
                                  words[i] = word.toLowerCase();
                              } else if (conjunctions_upper.includes(word.toUpperCase())) {
                                  // Convert the word to uppercase
                                  words[i] = word.toUpperCase();
                              } else {
                                  // Capitalize the first letter of other words
                                  words[i] = word.charAt(0).toUpperCase() + word.slice(1).toLowerCase();
                              }
                          }

                          // Join the words back into a single string
                          var formatted_nama = words.join(' ');

                          return formatted_nama;
                      }
                  },
                  { data: 'akademik.nama_kursus' }, 
                  { data: 'akademik.infoipt.nama_institusi' }, 
                  { data: 'yuran_disokong' },
                  { data: 'wang_saku_disokong' }
                  ]
              });
          }

          function initializeDataTable5() {
              $('#sortTable5').DataTable({
                  ordering: true, // Enable manual sorting
                      order: [], // Disable initial sorting
                      columnDefs: [
                          { orderable: false, targets: [0] }
                      ],
                  ajax: {
                      url: '{{ route("senarai.esp.PPK") }}', // URL to fetch data from
                      dataSrc: '' // Property in the response object containing the data array
                  },
                  language: {
                      url: "/assets/lang/Malay.json"
                  },
                  columns: [ 
                  {
                      data: 'smoku.no_kp', // Assuming 'no_kp' is a unique identifier in your dataset
                      className: 'text-center',
                      width: '4%',
                      render: function (data, type, row, meta) {
                          return `<input type="checkbox" class="select-checkbox" name="selected_items[]" value="${data}" />`;
                      }
                  },
                  {
                      data: 'no_rujukan_permohonan',
                      render: function(data, type, row) {
                        return `
                          <a href="#" 
                            class="open-modal-link" 
                            data-id="${row.id}" 
                            data-type="PPK"
                            data-bs-toggle="modal" 
                            data-bs-target="#dokumenModal">
                            ${data}
                          </a>`;
                      }
                  }, 
                  { 
                      data: 'smoku.nama', 
                      render: function(data, type, row) {
                          // Define conjunctions to be handled differently
                          var conjunctions_lower = ['bin', 'binti'];
                          var conjunctions_upper = ['A/L', 'A/P'];

                          // Split the nama field into words
                          var words = data.split(' ');

                          // Process each word
                          for (var i = 0; i < words.length; i++) {
                              var word = words[i];

                              // Check if the word is a conjunction to be displayed in lowercase
                              if (conjunctions_lower.includes(word.toLowerCase())) {
                                  // Convert the word to lowercase
                                  words[i] = word.toLowerCase();
                              } else if (conjunctions_upper.includes(word.toUpperCase())) {
                                  // Convert the word to uppercase
                                  words[i] = word.toUpperCase();
                              } else {
                                  // Capitalize the first letter of other words
                                  words[i] = word.charAt(0).toUpperCase() + word.slice(1).toLowerCase();
                              }
                          }

                          // Join the words back into a single string
                          var formatted_nama = words.join(' ');

                          return formatted_nama;
                      }
                  },
                  { data: 'akademik.nama_kursus' }, 
                  { data: 'akademik.infoipt.nama_institusi' }, 
                  { data: 'wang_saku_disokong' }
                  ]
              });
          }

          // Function to clear filters for all tables
          function clearFilters() {
              if ($.fn.DataTable.isDataTable('#sortTable1')) {
                  $('#sortTable1').DataTable().destroy();
              }
              if ($.fn.DataTable.isDataTable('#sortTable2')) {
                  $('#sortTable2').DataTable().destroy();
              }
              if ($.fn.DataTable.isDataTable('#sortTable3')) {
                  $('#sortTable3').DataTable().destroy();
              }
              if ($.fn.DataTable.isDataTable('#sortTable4')) {
                  $('#sortTable4').DataTable().destroy();
              }
              if ($.fn.DataTable.isDataTable('#sortTable5')) {
                  $('#sortTable5').DataTable().destroy();
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
                      initializeDataTable1();
                      break;
                  case 'bkokuPOLI-tab':
                      updateInstitusiDropdown(bkokuPOLIList);
                      initializeDataTable2();
                      break;
                  case 'bkokuKK-tab':
                      updateInstitusiDropdown(bkokuKKList);
                      initializeDataTable3();
                      break;
                  case 'bkokuUA-tab':
                      updateInstitusiDropdown(bkokuUAList);
                      initializeDataTable4();
                      break;
                  case 'ppk-tab':
                      updateInstitusiDropdown(ppkList);
                      initializeDataTable5();
                      break;
              }
          });

          // Trigger the function for the default active tab (bkoku-tab)
          updateInstitusiDropdown(bkokuUAList);
          initializeDataTable4(); // Initialize DataTable1 on page load
      });
  </script>

  <script>
      // Declare datatables in a higher scope to make them accessible
      var datatable1, datatable3, datatable2, datatable4, datatable5;

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

      function applyFilter() 
      {
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
          table.column(4).search(filterValue).draw();

          // Go to the first page for the table
          table.page(0).draw(false);
      }

      function logTableData(message, table) {
          console.log(message, table.rows().data().toArray());
      }
  </script>


  <script>
    $(document).on('click', '.open-modal-link', function(e) {
      e.preventDefault();

      const id = $(this).data('id');
      
      const type = $(this).data('type');
      // alert (type);

      $('#modalDokumenContent').html('<p>Memuatkan dokumen...</p>');

      $.ajax({
        url: `/getDokumen/${type}/${id}`,
        type: 'GET',
        success: function(response) {
          // response should be raw HTML accordion from controller
          $('#modalDokumenContent').html(response);
        },
        error: function() {
          $('#modalDokumenContent').html('<p class="text-danger">Gagal memuatkan dokumen.</p>');
        }
      });
    });
  </script>


  <script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/3.1.9-1/crypto-js.js"></script>

  <script>
    function sendData() {
      const secretKey = "{{ $secretKey }}";
      const time = {{ time() }}; 
      const token = generateToken(secretKey);
      // console.log("Time:", time);

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
          console.log(responseDataString);
          console.log(data.status);
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

    // function generateToken(secretKey, time) {
    //   const dataToHash = secretKey + time;
    //   const hash = CryptoJS.SHA256(dataToHash).toString(CryptoJS.enc.Hex);
    //   return hash;
    // }

    function generateToken(secretKey) {
      const dataToHash = secretKey;
      const hash = CryptoJS.SHA256(dataToHash).toString(CryptoJS.enc.Hex);
      return hash;
    }
  </script>
</body>
</x-default-layout>
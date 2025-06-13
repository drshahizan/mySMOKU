<x-default-layout>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Senarai Pelajar</title>
    <!-- Include Bootstrap CSS and Select2 CSS -->
    <link rel="stylesheet" href="/assets/css/saringan.css">

    <!-- Include jQuery, Bootstrap JS, Popper.js, and Select2 JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
    <script src="/assets/lang/Malay.json"></script>
    <script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js"></script>
    
    <style>
        /* Optional styling for better appearance */
        #searchable-dropdown {
        width: 100%;
        }
    </style>
</head>
<div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
  <!--begin::Title-->
  <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Kemaskini</h1>
  <!--end::Title-->
  <!--begin::Breadcrumb-->
  <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
      <!--begin::Item-->
      <li class="breadcrumb-item text-muted">
          <a href="/" class="text-dark text-hover-primary" style="color:darkblue">Kemaskini</a>
      </li>
      <!--end::Item-->
      <!--begin::Item-->
      <li class="breadcrumb-item">
          <span class="bullet bg-gray-400 w-5px h-2px"></span>
      </li>
      <!--end::Item-->
      <!--begin::Item-->
      <li class="breadcrumb-item text-dark" style="color:darkblue">Senarai Pelajar</li>
      <!--end::Item-->
  </ul>
  <!--end::Breadcrumb-->
</div>  
<br>

<div class="row clearfix">
  <!--begin::Content-->
  <div class="col-lg-12">
      <!--begin::Card-->
      <div class="card">
          <!--begin::Header-->
          <div class="header">
              <h2>Senarai Pelajar<br><small>Sila klik pada ikon pensil di kolum "Tindakan" untuk memaparkan profil diri bagi pelajar tersebut.</small></h2>
          </div>
          <!--end::Header-->
          <!--begin::Card body-->
          <div class="body">
              <!--begin::Table-->
              <div class="table-responsive">
                  <table id="sortTable2" class="table table-striped table-hover dataTable js-exportable">
                      <thead>
                        @php
                            $showInstitusi = $pelajar->contains(function ($p) {
                                return $p->id_induk !== null;
                            });
                        @endphp
                          <tr>
                              <th class="text-center"><b>Nama</b></th>                                        
                              <th class="text-center"><b>No. Kad Pengenalan</b></th>
                              <th class="text-center"><b>No. Kad JKM</b></th>
                              <th class="text-center"><b>Nama Kursus</b></th>
                              @if ($showInstitusi)
                                <th class="text-center"><b>Nama Institusi</b></th>
                              @endif
                              <th class="text-center"><b>Tarikh Mula</b></th>
                              <th class="text-center"><b>Tarikh Tamat</b></th>
                              <th class="text-center"><b>Status</b></th>
                              <th class="text-center"><b>Tindakan</b></th>
                          </tr>
                      </thead>
                      <tbody>
                          @foreach ($pelajar as $pelajar)
                              
                          <tr>
                            <td>{{ $pelajar->nama}}</td>
                            <td>{{ $pelajar->no_kp}}</td>
                            <td>{{ $pelajar->no_daftar_oku}}</td>
                            <td>{{ $pelajar->nama_kursus}}</td>
                            @if ($showInstitusi)
                            <td>
                                @if ($pelajar->id_induk !== null)
                                {{ $pelajar->nama_institusi }}
                                @endif
                            </td>
                            @endif
                            <td>
                                {{ $pelajar->tarikh_mula ? \Carbon\Carbon::parse($pelajar->tarikh_mula)->format('d/m/Y') : '' }}
                            </td>
                            <td>
                                {{ $pelajar->tarikh_tamat ? \Carbon\Carbon::parse($pelajar->tarikh_tamat)->format('d/m/Y') : '' }}
                            </td>
                            <td class="text-center">
                                @if($pelajar->tarikh_tamat >= \Carbon\Carbon::now())
                                    <div class="badge badge-light-success fw-bold">Aktif</div>
                                @else
                                    <div class="badge badge-light-danger fw-bold">Tidak Aktif</div>
                                @endif

                            </td>
                            
                            <td class="text-center">
                                <a href=" {{route('profil.pelajar.institusi', ['id' => $pelajar->smoku_id ])}}" class="btn btn-icon btn-active-light-primary w-30px h-30px me-3">
                                    <span data-bs-toggle="tooltip" data-bs-trigger="hover" title="Profil Diri Pelajar">
                                        <i class="ki-solid ki-pencil text-dark fs-2"></i>
                                    </span>
                                </a>
                                
                            </td>
                            
                               
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
  <!--end::Content-->
</div>
  

<!--begin::Javascript-->

<script>
    $(document).ready(function() {
        // Initialize Select2
        $('.searchable-dropdown').select2();
    });
</script>
<script>
	$('#sortTable2').DataTable({
            ordering: true, // Enable manual sorting
            order: [], // Disable initial sorting
			language: {
				url: "/assets/lang/Malay.json"
			}
        });
</script>


<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script>
	@if(session('success'))
		Swal.fire({
			icon: 'success',
			title: 'Berjaya!',
			text: ' {!! session('success') !!}',
			confirmButtonText: 'OK'
		});
	@endif
	@if(session('failed'))
		Swal.fire({
			icon: 'error',
			title: 'Tidak Berjaya!',
			text: ' {!! session('failed') !!}',
			confirmButtonText: 'OK'
		});
	@endif
</script>

<!--end::Javascript--> 

  



</x-default-layout>

<x-default-layout>
<head>
    <!-- MAIN CSS -->
    <link rel="stylesheet" href="/assets/css/saringan.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
    <script src="/assets/lang/Malay.json"></script>
    <script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js"></script>
</head>    
<div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
    <!--begin::Title-->
    <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Tuntutan</h1>
    <!--end::Title-->
    <!--begin::Breadcrumb-->
    <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
        <!--begin::Item-->
        <li class="breadcrumb-item text-muted">
            <a href="/" class="text-dark text-hover-primary" style="color:darkblue">Tuntutan</a>
        </li>
        <!--end::Item-->
        <!--begin::Item-->
        <li class="breadcrumb-item">
            <span class="bullet bg-gray-400 w-5px h-2px"></span>
        </li>
        <!--end::Item-->
        <!--begin::Item-->
        <li class="breadcrumb-item text-dark" style="color:darkblue">Tuntutan Layak Mohon</li>
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
                <h2>Senarai Tuntutan Layak Mohon<br><small>Sila klik pada ikon-ikon di kolum "Tindakan" untuk mengisi keputusan peperiksaan dan membuat tuntutan baharu bagi pelajar tersebut.</small></h2>
            </div>
            <!--end::Header-->
            <!--begin::Card body-->
            <div class="body">
                <!--begin::Table-->
                <div class="table-responsive">
                    <table id="sortTable2" class="table table-striped table-hover dataTable js-exportable">
                        <thead>
                            <tr>
                                <th class="text-center"><b>ID Permohonan</b></th>                                        
								<th class="text-center"><b>Nama</b></th>
								<th class="text-center"><b>Nama Kursus</b></th>
                                <th class="text-center"><b>Tempoh Penajaan</b></th>
                                <th class="text-center"><b>Status</b></th>
                                <th class="text-center"><b>Tindakan</b></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($layak as $layak)
                                @php
                                    $status = DB::table('bk_status')->where('kod_status', $layak->tuntutan_status)->value('status');
                                                
                                    $text = ucwords(strtolower($layak->nama)); // Assuming you're sending the text as a POST parameter
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
                                @endphp

                                @php
                                    // Retrieve data from bk_tarikh_iklan table
                                    $bk_tarikh_iklan = DB::table('bk_tarikh_iklan')->orderBy('created_at', 'desc')->first();

                                    // Get current date and time
                                    $currentDateTime = now();

                                    // Check if current date and time fall within the allowed range
                                    $tarikhMula = \Carbon\Carbon::parse($bk_tarikh_iklan->tarikh_mula . ' ' . $bk_tarikh_iklan->masa_mula);
                                    $tarikhTamat = \Carbon\Carbon::parse($bk_tarikh_iklan->tarikh_tamat . ' ' . $bk_tarikh_iklan->masa_tamat);

                                    // Check if current date and time fall within the allowed range
                                    $isWithinRange = $currentDateTime->between($tarikhMula, $tarikhTamat);
                                @endphp
                                <tr>
                                    <td>{{ $layak->no_rujukan_permohonan}}</td>
                                    <td>{{ $pemohon}}</td>
                                    <td>{{ $layak->nama_kursus}}</td>
                                    <td>
                                        {{ \Carbon\Carbon::createFromFormat('Y-m-d', $layak->tarikh_mula)->format('d/m/Y') }} - 
                                        {{ \Carbon\Carbon::createFromFormat('Y-m-d', $layak->tarikh_tamat)->format('d/m/Y') }}
                                    </td>
                                    @if($status != null)

                                        @if ($layak->tuntutan_status=='1')
                                            <td class="text-center"><button class="btn bg-info text-white">{{ucwords(strtolower($status))}}</button></td>
                                        @elseif ($layak->tuntutan_status=='2')
                                            <td class="text-center"><button class="btn bg-baharu text-white">{{ucwords(strtolower($status))}}</button></td>
                                        @elseif ($layak->tuntutan_status=='3')
                                            <td class="text-center"><button class="btn bg-sedang-disaring text-white">{{ucwords(strtolower($status))}}</button></td>
                                        @elseif ($layak->tuntutan_status=='4')
                                            <td class="text-center"><button class="btn bg-warning text-white">{{ucwords(strtolower($status))}}</button></td>
                                        @elseif ($layak->tuntutan_status=='5')
                                            <td class="text-center"><button class="btn bg-dikembalikan text-white">{{ucwords(strtolower($status))}}</button></td>
                                        @elseif ($layak->tuntutan_status=='6')
                                            <td class="text-center"><button class="btn bg-success text-white">{{ucwords(strtolower($status))}}</button></td>
                                        @elseif ($layak->tuntutan_status=='7')
                                            <td class="text-center"><button class="btn bg-danger text-white">{{ucwords(strtolower($status))}}</button></td>
                                        @elseif ($layak->tuntutan_status=='8')
                                            <td class="text-center"><button class="btn bg-dibayar text-white">{{ucwords(strtolower($status))}}</button></td>
                                        @elseif ($layak->tuntutan_status=='9')
                                            <td class="text-center"><button class="btn bg-batal text-white">{{ucwords(strtolower($status))}}</button></td>
                                        @endif
                                    @else
                                        <td class="text-center"><button class="btn bg-primary text-white">Belum Tuntut</button></td>
                                    @endif
                                    
                                    <td class="text-center">
                                        <div>
                                            <!--begin::Edit-->
                                            <a href="{{ route('bkoku.kemaskini.keputusan', $layak->smoku_id)}}" class="btn btn-icon btn-active-light-primary w-10px h-10px me-1">
                                                <span data-bs-toggle="tooltip" data-bs-trigger="hover" title="Kemaskini Keputusan Peperiksaan">
                                                    <i class="ki-solid ki-pencil text-dark fs-2"></i>
                                                </span>
                                            </a>

                                            @if($isWithinRange)
                                                <a href="{{ route('bkoku.tuntutan.baharu', $layak->smoku_id)}}" class="btn btn-icon btn-active-light-primary w-10px h-10px me-1">
                                                    <span data-bs-toggle="tooltip" data-bs-trigger="hover" title="Borang Tuntutan">
                                                        <i class="fa-solid fa-money-check-dollar fs-2"  style="color: #000000;"></i>
                                                    </span>
                                                </a>
                                            @else
                                                <a href="#" class="btn btn-icon btn-active-light-primary w-10px h-10px me-1">
                                                    <span data-bs-toggle="tooltip" data-bs-trigger="hover" title="Borang Tuntutan">
                                                        <i class="fa-solid fa-money-check-dollar fs-2"  style="color: #000000;" onclick="showAlertTuntutan()"></i>
                                                    </span>
                                                </a>
                                            @endif
                                            <!--end::Edit-->
                                        </div>
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
	@if(session('message'))
		Swal.fire({
			icon: 'success',
			title: 'Berjaya!',
			text: ' {!! session('message') !!}',
			confirmButtonText: 'OK'
		});
	@endif
	@if(session('permohonan'))
		Swal.fire({
			icon: 'error',
			title: 'Tiada Permohonan!',
			text: ' {!! session('permohonan') !!}',
			confirmButtonText: 'OK'
		});
	@endif
	@if(session('sem'))
		Swal.fire({
			icon: 'error',
			title: 'Tidak Berjaya!',
			text: ' {!! session('sem') !!}',
			confirmButtonText: 'OK'
		});
	@endif
</script>
<script>
    function showAlertTuntutan() 
    {
        Swal.fire({
        icon: 'error',
        title: 'Tuntutan telah ditutup.',
        text: ' {!! session('failed') !!}',
        confirmButtonText: 'OK'
        });
    }
</script>
<!--end::Javascript-->     
</x-default-layout>
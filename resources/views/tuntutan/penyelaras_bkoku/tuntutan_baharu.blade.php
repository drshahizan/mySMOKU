<x-default-layout>
<head>
    <!-- MAIN CSS -->
    <link rel="stylesheet" href="/assets/css/saringan.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
	<script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js"></script>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.min.css">
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
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
								<th class="text-center"><b>Nama Institusi</b></th>
								<th class="text-center"><b>Peringkat Pengajian</b></th>
								<th class="text-center"><b>Nama Kursus</b></th>
                                <th class="text-center"><b>Tempoh Penajaan</b></th>
                                <th class="text-center"><b>Status</b></th>
                                <th class="text-center"><b>Tindakan</b></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($layak as $layak)
                                @if ($layak->program=="BKOKU")
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
                                        $permohonan = DB::table('permohonan')
                                            ->orderBy('id', 'desc')->where('smoku_id',$layak->smoku_id)->first();

                                        $akademik = DB::table('smoku_akademik')
                                            ->where('smoku_id',$layak->smoku_id)
                                            ->where('smoku_akademik.status', 1)
                                            ->first();
                                        
                                        $smoku = DB::table('smoku')
                                            ->where('id',$layak->smoku_id)->first();

                                        $bilSem = ($akademik->bil_bulan_per_sem == 6) ? 2 : 3;
                                        $totalSemesters = $akademik->tempoh_pengajian * $bilSem;
                                        $currentDate = Carbon::now();

                                        $tarikhMula = Carbon::parse($akademik->tarikh_mula);
                                        $tarikhTamat = Carbon::parse($akademik->tarikh_tamat);

                                        $bulanMula  = $tarikhMula->format('n');
                                        $isSpecialStart = in_array($bulanMula, [1, 2, 3, 4, 5, 6]);

                                        // Initialize tahun sesi
                                        $tahunSesi = $isSpecialStart ? $tarikhMula->year - 1 : $tarikhMula->year;
                                        $sesiMula = $tahunSesi . '/' . ($tahunSesi + 1);

                                        // Define semester pattern
                                        if (in_array($bulanMula, [1, 2, 3, 4, 5, 6])) {
                                            if ($akademik->bil_bulan_per_sem == 6) {
                                                $pattern = [1, 2];
                                            } elseif ($akademik->bil_bulan_per_sem == 4) {
                                                $pattern = [2, 3];
                                            } else {
                                                $pattern = [$bilSem];
                                            }
                                        } else {
                                            $pattern = [$bilSem];
                                        }

                                        $patternIndex = 0;
                                        $currentPattern = $pattern[$patternIndex];
                                        $semInCurrentSesi = 0;

                                        $tarikhNextSem = clone $tarikhMula;
                                        $nextSemesterDates = [];
                                        $semCounter = 0;
                                        $semSemasa = 1;

                                        // if (!$akademik || empty($akademik->bil_bulan_per_sem)) {
                                        //     dd('AKADEMIK INVALID', $layak->smoku_id, $akademik);
                                        // }
                                        

                                        // Build all semesters
                                        while ($tarikhNextSem < $tarikhTamat) {
                                            $bulanMasuk = $tarikhNextSem->month;
                                            //     // 10092025 - tak kira semester dah. kira sesi 1 dan sesi 2 
                                            //     // sesi 1 untuk kemasukan bulan julai sehingga disember
                                            //     // sesi 2 untuk kemasukan bulan januari sehingga jun
                                            $sesi_bulan = in_array($bulanMasuk, [7,8,9,10,11,12]) ? 1 : 2;

                                            $nextSemesterDates[] = [
                                                'date'       => $tarikhNextSem->format('F Y'),
                                                'semester'   => $semSemasa,
                                                'sesi'       => $sesiMula,    // tahun akademik
                                                'sesi_bulan' => $sesi_bulan,  // sesi 1 atau 2
                                            ];

                                            $semSemasa++;
                                            $semCounter++;
                                            $semInCurrentSesi++;

                                            $tarikhNextSem->add(new DateInterval("P{$akademik->bil_bulan_per_sem}M"));

                                            if ($isSpecialStart) {
                                                if ($semInCurrentSesi >= $currentPattern) {
                                                    $semInCurrentSesi = 0;
                                                    $tahunSesi++;
                                                    $sesiMula = $tahunSesi . '/' . ($tahunSesi + 1);

                                                    if ($patternIndex < count($pattern) - 1) {
                                                        $patternIndex++;
                                                    }
                                                    $currentPattern = $pattern[$patternIndex] ?? $pattern[count($pattern) - 1];
                                                }
                                            } else {
                                                if ($semCounter % $bilSem == 0) {
                                                    $tahunSesi++;
                                                    $sesiMula = $tahunSesi . '/' . ($tahunSesi + 1);
                                                }
                                            }
                                        }

                                        // Vars to store current/previous
                                        $currentSesi = null;
                                        $previousSesi = null;
                                        $semSemasa = null;
                                        $sesiSemasa = null;

                                        // Find current semester/session
                                        foreach ($nextSemesterDates as $key => $data) {
                                            $dateOfSemester = Carbon::parse($data['date']);

                                            $nextSemesterStartDate = isset($nextSemesterDates[$key + 1]) 
                                                ? Carbon::parse($nextSemesterDates[$key + 1]['date']) 
                                                : null;

                                            $semesterEndDate = $nextSemesterStartDate 
                                                ? $nextSemesterStartDate->subSecond() 
                                                : ($tarikhTamat ? $tarikhTamat->endOfDay()->subSecond() : $dateOfSemester->endOfDay()->subSecond());

                                            if ($currentDate->between($dateOfSemester->startOfDay(), $semesterEndDate)) {
                                                $currentSesi = $data['sesi'];        // tahun akademik (eg. 2025/2026)
                                                $sesiSemasa  = $data['sesi_bulan'];  // sesi 1 atau 2
                                                $semSemasa   = $data['semester'];
                                                $semLepas    = $data['semester'] - 1;

                                                $sesiLepas = isset($nextSemesterDates[$key - 1]) 
                                                    ? $nextSemesterDates[$key - 1]['sesi_bulan'] 
                                                    : 'Tiada';
                                                $previousSesi = isset($nextSemesterDates[$key - 1]) 
                                                    ? $nextSemesterDates[$key - 1]['sesi'] 
                                                    : $data['sesi'];    
                                            }
                                        }

                                        $tuntutan = DB::table('tuntutan')
                                            ->where('smoku_id', $layak->smoku_id)
                                            ->where('permohonan_id', $permohonan->id)
                                            ->whereNotIn('status', [6,7,8,9])
                                            ->whereNull('data_migrate')
                                            ->orderBy('tuntutan.id', 'desc')
                                            ->first(['tuntutan.*']);

                                        //semak keputusan    
                                        if ($currentDate <= $semesterEndDate ) {
                                            // if($currentSesi != $previousSesi){
                                                // semak dah upload result ke belum
                                                $result = DB::table('permohonan_peperiksaan')
                                                ->where('permohonan_id', $permohonan->id)
                                                ->where('sesi', $previousSesi)
                                                ->where('semester', $sesiLepas)
                                                ->first();
                                                
                                            // }
                                            
                                        }   

                
                                    @endphp

                                    @php

                                        $tuntutan_latest = DB::table('tuntutan')
                                            ->where('smoku_id', $layak->smoku_id)
                                            ->where('permohonan_id', $permohonan->id)
                                            ->whereNull('data_migrate')
                                            ->orderBy('tuntutan.id', 'desc')
                                            ->first();

                                        // Retrieve data from bk_tarikh_iklan table
                                        $bk_tarikh_iklan = DB::table('bk_tarikh_iklan')->orderBy('created_at', 'desc')->first();

                                        // Get current date and time
                                        $currentDateTime = now();

                                        // Check if current date and time fall within the allowed range
                                        $tarikhMula = \Carbon\Carbon::parse($bk_tarikh_iklan->tarikh_mula . ' ' . $bk_tarikh_iklan->masa_mula);
                                        $tarikhTamat = \Carbon\Carbon::parse($bk_tarikh_iklan->tarikh_tamat . ' ' . $bk_tarikh_iklan->masa_tamat);

                                        // Check if current date and time fall within the allowed range
                                        $isWithinRange = $currentDateTime->between($tarikhMula, $tarikhTamat);

                                        // Check if student already submitted a claim during the current session window
                                        $hasClaimInRange = false;
                                        if ($tuntutan_latest && $tuntutan_latest->tarikh_hantar) {
                                            $tarikhHantar = \Carbon\Carbon::parse($tuntutan_latest->tarikh_hantar);
                                            // Only consider claims in the current range and not with status 2 or 5
                                            if ($tarikhHantar->between($tarikhMula, $tarikhTamat) && !in_array($tuntutan_latest->status, [1, 2, 5])) {
                                                $hasClaimInRange = true;
                                            }
                                        }

                                        // Retrieve amount ews // penerima biasiswa sedia ada, amaun masih 2400
                                        if ($akademik->sumber_biaya == 1){
                                            $amaun = DB::table('bk_jumlah_tuntutan')->where('program', 'BKOKU')->where('jenis', 'Wang Saku')->where('semester', 'B')->first();
                                        } else{
                                            $amaun = DB::table('bk_jumlah_tuntutan')->where('program', 'BKOKU')->where('jenis', 'Wang Saku')->first();
                                        }
                                        
                                    @endphp
                                    <tr>
                                        <td>{{ $layak->no_rujukan_permohonan}}</td>
                                        <td>{{ $pemohon}}</td>
                                        <td>{{ $layak->nama_institusi}}</td>
                                        <td>{{ $layak->akademik_peringkat ?? $layak->peringkat_pengajian }}</td>
                                        <td>{{ $layak->nama_kursus}}</td>
                                        <td>
                                            {{ !empty($layak->tarikh_mula) ? \Carbon\Carbon::parse($layak->tarikh_mula)->format('d/m/Y') : 'N/A' }}
                                            -
                                            {{ !empty($layak->tarikh_tamat) ? \Carbon\Carbon::parse($layak->tarikh_tamat)->format('d/m/Y') : 'N/A' }}
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
                                            @elseif ($layak->tuntutan_status=='10')
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
                                                    @if($hasClaimInRange)
                                                        {{-- Already has claim in this session --}}
                                                        <a href="#" class="btn btn-icon btn-active-light-primary w-30px h-30px me-3"
                                                            data-bs-toggle="tooltip" data-bs-trigger="hover" 
                                                            title="Borang Tuntutan. Hanya satu kali tuntutan bagi sesi pengajian yang sama"
                                                            onclick="showAlertTuntutanOnce()">
                                                            <span>
                                                                <i class="fa-solid fa-money-check-dollar fs-2" style="color: #000000;"></i>
                                                            </span>
                                                        </a>
                                                    @else
                                                        {{-- Normal behavior --}}
                                                        <a href="{{ $semSemasa <= $totalSemesters && $result == null && $currentDate < ($tarikhTamat) ? route('bkoku.kemaskini.keputusan', $layak->smoku_id) : '#' }}" 
                                                            class="btn btn-icon btn-active-light-primary w-30px h-30px me-3" 
                                                            @if(!$tuntutan || ($tuntutan && $tuntutan->status == 8 || $tuntutan->status == 1 || $tuntutan->status == 2 || $tuntutan->status == 5))
                                                                @if($semSemasa <= $totalSemesters && $currentDate < ($tarikhTamat))
                                                                    @if (!$result && !$tuntutan && $sesiLepas != 'Tiada')
                                                                        data-bs-toggle="tooltip" data-bs-trigger="hover" title="Borang Tuntutan. Sila kemaskini keputusan peperiksaan semester lepas terlebih dahulu."
                                                                    @elseif ($result && $result->pengesahan_rendah== 1)
                                                                        data-bs-toggle="tooltip" data-bs-trigger="hover" title="Borang Tuntutan. Keputusan peperiksaan pelajar dengan PNG bawah 2.00 masih dalam semakan sekretariat KPT."    
                                                                    @else
                                                                        data-bs-toggle="modal" data-bs-trigger="hover" title="Borang Tuntutan" data-bs-target="#kt_modal_tuntutan{{$layak->smoku_id}}"
                                                                    @endif
                                                                @elseif($currentDate->greaterThan($tarikhTamat))  
                                                                    data-bs-toggle="tooltip" data-bs-trigger="hover" title="Pelajar telah tamat pengajian."
                                                                @endif
                                                            @elseif($tuntutan && ($tuntutan->status == 3 || $tuntutan->status == 4))
                                                                data-bs-toggle="tooltip" data-bs-trigger="hover" title="Tuntutan masih dalam semakan."  
                                                            @endif
                                                        >
                                                            <span>
                                                                <i class="fa-solid fa-money-check-dollar fs-2"  style="color: #000000;"></i>
                                                            </span>
                                                        </a>
                                                    @endif
                                                @else
                                                    <a href="#" class="btn btn-icon btn-active-light-primary w-10px h-10px me-1">
                                                        <span data-bs-toggle="tooltip" data-bs-trigger="hover" title="Borang Tuntutan">
                                                            <i class="fa-solid fa-money-check-dollar fs-2" style="color: #000000;" onclick="showAlertTuntutan()"></i>
                                                        </span>
                                                    </a>
                                                @endif

                                                <!--end::Edit-->
                                            </div>
                                           <!--// app.debug -->
                                        </td>
                                    </tr>
                                    <!--begin::Modal Tuntutan-->
                                        @include('tuntutan.penyelaras_bkoku.modal_tuntutan', [
                                            'layak' => $layak
                                        ]) 
                                    <!--end::Modal Tuntutan-->
                                @endif    
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
    function showAlertTuntutanOnce() 
    {
        Swal.fire({
        icon: 'error',
        title: 'Tidak Berjaya!',
        text: 'Hanya satu kali tuntutan bagi sesi pengajian yang sama.',
        confirmButtonText: 'OK'
        });
    }
    function showAlertTuntutan() 
    {
        Swal.fire({
        icon: 'error',
        title: 'Tidak Berjaya!',
        text: 'Tuntutan telah ditutup.',
        confirmButtonText: 'OK'
        });
    }
    
</script>
<!--begin::Javascript-->
<script>
$(document).ready(function() {
    $(document).on('shown.bs.modal', function (e) {
        var $modal = $(e.target);

        $modal.find('[data-control="select2"]').each(function() {
            var $select = $(this);

            if ($select.data('select2')) {
                $select.select2('destroy');
            }

            $select.select2({
                dropdownParent: $modal.find('.modal-content'),
                width: '100%',
                placeholder: 'Pilih'
            });

        });
    });
});
</script>




<!--end::Javascript-->     
</x-default-layout>

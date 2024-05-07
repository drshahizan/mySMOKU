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
                <h2>Senarai Tuntutan Layak Mohon</h2>
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
                            
                                    //institusi pengajian
                                    $text3 = ucwords(strtolower($layak->nama_kursus)); // Assuming you're sending the text as a POST parameter
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
                                    $kursus = implode(' ', $result);
                                @endphp

                                @php
                                    $permohonan = DB::table('permohonan')
                                        ->orderBy('id', 'desc')->where('smoku_id',$layak->smoku_id)->first();

                                    $akademik = DB::table('smoku_akademik')
                                        ->where('smoku_id',$layak->smoku_id)
                                        ->where('smoku_akademik.status', 1)
                                        ->first();
                                    
                                    $tuntutan = DB::table('tuntutan')
                                        ->where('smoku_id', $layak->smoku_id)
                                        ->where('permohonan_id', $layak->permohonan_id)
                                        ->orderBy('tuntutan.id', 'desc')
                                        ->first(['tuntutan.*']);
                                    
                                    
                                    $semSemasa = 1;

                                    if($akademik->bil_bulan_per_sem == 6){
                                        $bilSem = 2;
                                    } else {
                                        $bilSem = 3;
                                    }
                                    $totalSemesters = $akademik->tempoh_pengajian * $bilSem;
                                    $currentYear = date('Y');

                                    $currentDate = Carbon::now();
                                    $tarikhMula = Carbon::parse($akademik->tarikh_mula);
                                    $tarikhTamat = Carbon::parse($akademik->tarikh_tamat);
                                    $sesiMula = $tarikhMula->format('Y') . '/' . ($tarikhMula->format('Y') + 1);

                                    $tarikhNextSem = clone $tarikhMula; // Clone to avoid modifying the original date
                                    $nextSemesterDates = [];
                                    $firstIteration = true;

                                    while ($tarikhNextSem < $tarikhTamat) {
                                        

                                        $nextSemesterDates[] = [
                                            'date' => $tarikhNextSem->format('Y-m-d'),
                                            'semester' => $semSemasa,
                                            'sesi' => $sesiMula,
                                        ];

                                        $semSemasa++;
                                        $awal = $tarikhNextSem->format('Y');
                                        
                                        $akhir = $tarikhNextSem->format('Y') + 1;
                                        
                                        $sesiMula = $awal . '/' . $akhir;

                                        $tarikhNextSem->add(new DateInterval("P{$akademik->bil_bulan_per_sem}M"));

                                    }

                                    $currentSesi = null; // Initialize a variable to store the current session
                                    $previousSesi = null; // Initialize a variable to store the previous session
                                    $semSemasa = null; // Initialize a variable to store the current semester
                                    $sesiSemasa = null; // Initialize a variable to store the current session
                                    $isInNextSemester = false;

                                    foreach ($nextSemesterDates as $key => $data) {
                                        // echo 'Date: ' . $data['date'] . ', Semester: ' . $data['semester'] . ', Sesi: ' . $data['sesi'];

                                        $dateOfSemester = \Carbon\Carbon::parse($data['date']);
                                        
                                        // Set the end date to be just before the start of the next semester
                                        $nextSemesterStartDate = isset($nextSemesterDates[$key + 1]) ? \Carbon\Carbon::parse($nextSemesterDates[$key + 1]['date']) : null;
                                        // $semesterEndDate = $nextSemesterStartDate ? $nextSemesterStartDate->subSecond() : $dateOfSemester->endOfDay();
                                        $semesterEndDate = $nextSemesterStartDate ? $nextSemesterStartDate->subSecond() : ($tarikhTamat ? $tarikhTamat->endOfDay()->subSecond() : $dateOfSemester->endOfDay()->subSecond());

                                        // Check if the current date is within the range of the semester
                                        if ($currentDate->between($dateOfSemester->startOfDay(), $semesterEndDate)) {
                                            $currentSesi = $data['sesi'];
                                            $semSemasa = $data['semester'];
                                            $semLepas = $data['semester'] - 1;
                                            $sesiSemasa = $data['sesi'];
                                            $previousSesi = isset($nextSemesterDates[$key - 1]) ? $nextSemesterDates[$key - 1]['sesi'] : null;
                                        
                                            
                                        } 
                                        
                                        // echo "Date Next Semester: " . ($dateOfSemester);
                                        if ($currentDate->isAfter($semesterEndDate)) {
                                            // If true, the current date is in the next semester
                                            $isInNextSemester = true;
                                                
                                        }

                                        // echo "Is In Next Semester: " . ($isInNextSemester ? 'true' : 'false');

                                    }
                                    if ($semLepas != 0 ) {
                                        if($semSemasa != $semLepas){
                                            // semak dah upload result ke belum
                                            $result = DB::table('permohonan_peperiksaan')->where('permohonan_id', $permohonan->id)
                                            ->where('semester', $semLepas)
                                            ->first();
                                            // if($result == null){
                                            //     return redirect()->route('bkoku.kemaskini.keputusan', ['id' => $id])->with('error', 'Sila kemaskini keputusan peperiksaan semester lepas terlebih dahulu.');
                                            // }
                                        }
                                        
                                    }
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
                                    <td class="text-center">{{ $layak->no_rujukan_permohonan}}</td>
                                    <td>{{ $pemohon}}</td>
                                    <td>{{ $layak->nama_kursus}}</td>
                                    <td class="text-center">
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
                                            <a href="{{ route('ppk.kemaskini.keputusan', $layak->smoku_id)}}" class="btn btn-icon btn-active-light-primary w-30px h-30px me-3">
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
                                                <a href="{{ route('bkoku.tuntutan.baharu', $layak->smoku_id)}}" class="btn btn-icon btn-active-light-primary w-10px h-10px me-1" onclick="showAlertTuntutan()">
                                                    <span data-bs-toggle="tooltip" data-bs-trigger="hover" title="Borang Tuntutan">
                                                        <i class="fa-solid fa-money-check-dollar fs-2"  style="color: #000000;"></i>
                                                    </span>
                                                </a>
                                            @endif

                                            @if($isWithinRange)
                                                <a href="{{ $isInNextSemester === true && $semSemasa <= $totalSemesters && $result == null && $currentDate < ($tarikhTamat) ? route('ppk.kemaskini.keputusan', $layak->smoku_id) : '#' }}" class="btn btn-icon btn-active-light-primary w-30px h-30px me-3" 
                                        
                                                    @if(!$tuntutan || ($tuntutan && $tuntutan->status == 8))
                                                        @if($isInNextSemester === true && $semSemasa <= $totalSemesters && $currentDate < ($tarikhTamat))
                                                            @if ($result == null)
                                                                data-bs-toggle="tooltip" data-bs-trigger="hover" title="Sila kemaskini keputusan peperiksaan semester lepas terlebih dahulu."
                                                            @else
                                                                data-bs-toggle="modal" data-bs-trigger="hover" title="Hantar Tuntutan" data-bs-target="#kt_modal_tuntutan{{$layak->smoku_id}}"
                                                            @endif
                                                        @elseif($currentDate->greaterThan($tarikhTamat))  
                                                            data-bs-toggle="tooltip" data-bs-trigger="hover" title="Pelajar telah tamat pengajian."
                                                        @elseif($isInNextSemester === false)
                                                            data-bs-toggle="tooltip" data-bs-trigger="hover" title="Tuntutan hanya boleh dikemukakan pada semester seterusnya."
                                                        @endif
                                                    @else
                                                        data-bs-toggle="tooltip" data-bs-trigger="hover" title="Tuntutan masih dalam semakan."  
                                                    @endif

                                                >
                                                    <span>
                                                        <i class="fa-solid fa-money-check-dollar fs-2"  style="color: #000000;"></i>
                                                    </span>
                                                </a>
                                            @else
                                                <a href="#" class="btn btn-icon btn-active-light-primary w-30px h-30px me-3">
                                                    <span>
                                                        <i class="fa-solid fa-money-check-dollar fs-2"  style="color: #000000;" onclick="showAlertTuntutan()"></i>
                                                    </span>
                                                </a>
                                            @endif
                                            <!--end::Edit-->
                                        </div>
                                    </td>
                                    
                                    <!--begin::Modal Tuntutan-->
                                    <div class="modal fade" id="kt_modal_tuntutan{{$layak->smoku_id}}" tabindex="-1" aria-hidden="true">
                                        <!--begin::Modal dialog-->
                                        <div class="modal-dialog modal-dialog-centered mw-650px">
                                            <!--begin::Modal content-->
                                            <div class="modal-content">
                                                <!--begin::Modal header-->
                                                <div class="modal-header">
                                                    <!--begin::Modal title-->
                                                    <h2>Tuntutan Wang Saku</h2>
                                                    <!--end::Modal title-->
                                                    <!--begin::Close-->
                                                    <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                                                        <i class="ki-duotone ki-cross fs-1">
                                                            <span class="path1"></span>
                                                            <span class="path2"></span>
                                                        </i>
                                                    </div>
                                                    <!--end::Close-->
                                                </div>
                                                <!--end::Modal header-->
                                                <!--begin::Modal body-->
                                                <div class="modal-body scroll-y mx-5 mx-xl-15 my-7">
                                                    <!--begin::Form-->
                                                    <form class="form" id="kt_modal_new_card_form" action="{{ route('ppk.tuntutan.hantar',$layak->smoku_id) }}" method="post" enctype="multipart/form-data">
                                                        @csrf
                                                        <!--begin::Scroll-->
                                                        <div class="scroll-y me-n7 pe-7" id="kt_modal_add_customer_scroll" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_add_customer_header" data-kt-scroll-wrappers="#kt_modal_add_customer_scroll" data-kt-scroll-offset="300px">
                                                            <!--begin::Input group-->
                                                            <div class="fv-row mb-7">
                                                                <!--begin::Label-->
                                                                <label class="fs-6 fw-semibold mb-2">Sesi Pengajian</label>
                                                                <!--end::Label-->
                                                                <!--begin::Input-->
                                                                <input type="text" id="sesi" name="sesi" class="form-control form-control-solid" placeholder="" value="{{$sesiSemasa}}" readonly/>
                                                                <!--end::Input-->
                                                            </div>
                                                            <!--end::Input group-->
                                                            <!--begin::Input group-->
                                                            <div class="fv-row mb-7">
                                                                <!--begin::Label-->
                                                                <label class="fs-6 fw-semibold mb-2">Semester</label>
                                                                <!--end::Label-->
                                                                <!--begin::Input-->
                                                                <input type="text" id="semester" name="semester" class="form-control form-control-solid" placeholder="" value="{{$semSemasa}}" readonly/>
                                                                <!--end::Input-->
                                                            </div>
                                                            <!--end::Input group-->
                                                            <div class="col-6">
                                                                <input class="form-check-input" type="checkbox" value="1" id="wang_saku"  name="wang_saku" onclick="return false" checked/>
                                                                <label class="fs-6 fw-semibold form-label">
                                                                    Tuntut Elaun Wang Saku
                                                                </label>
                                                            </div>
                                                            <br> 
                                                            <!--begin::Input group-->
                                                            <div class="fv-row mb-7">
                                                                <!--begin::Label-->
                                                                <label class="fs-6 fw-semibold mb-2">Amaun Wang Saku</label>
                                                                <!--end::Label-->
                                                                <div class="d-flex">
                                                                    <!--begin::Input-->
                                                                    <span class="input-group-text">RM</span>
                                                                    <input type="number" name="amaun_wang_saku" class="form-control form-control-solid" placeholder="RM" value="{{ '3360.00' }}" step="0.01" inputmode="decimal" readonly/>
                                                                    <!--end::Input-->
                                                                </div>
                                                            </div>
                                                            <!--end::Input group-->    
                                                        </div>
                                                        <!--end::Scroll-->
                                                        
                                                        <!--begin::Actions-->
                                                        <div class="text-center pt-15">
                                                            <button type="submit" id="kt_modal_new_card_submit" class="btn btn-primary">
                                                                <span class="indicator-label">Hantar</span>
                                                                <span class="indicator-progress">Sila tunggu...
                                                                <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                                            </button>
                                                        </div>
                                                        <!--end::Actions-->
                                                    </form>
                                                    <!--end::Form-->
                                                </div>
                                                <!--end::Modal body-->
                                            </div>
                                            <!--end::Modal content-->
                                        </div>
                                        <!--end::Modal dialog-->
                                    </div>
                                    <!--end::Modal Tuntutan-->
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
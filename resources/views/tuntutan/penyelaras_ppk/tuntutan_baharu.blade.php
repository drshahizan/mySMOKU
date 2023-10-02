<x-default-layout> 
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
            <li class="breadcrumb-item text-dark" style="color:darkblue">Tuntutan Baharu</li>
            <!--end::Item-->
        </ul>
        <!--end::Breadcrumb-->
    </div>

    <head>
        <!-- MAIN CSS -->
        <link rel="stylesheet" href="/assets/css/saringan.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js"></script>
        <link href="assets/css/style.bundle.css" rel="stylesheet" type="text/css" />
    
    </head>
           
    <br>
    @if (session('message'))
        <div class="alert alert-success" style="color:black; text-align: center;">{{ session('message') }}</div>
    @endif
    
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
                            <h2>Senarai Tuntutan Baharu</h2>
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
                            <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_customers_table">
                                <thead>
                                    <tr class="text-start text-gray-400 fw-bold fs-7 gs-0">
                                        <th>ID Permohonan</th>
                                        <th>Nama Pelajar</th>
                                        <th>Nama Kursus</th>
                                        <th>Tempoh Penajaan</th>
                                        <th>Status</th>
                                        <th>Tindakan</th>
                                    </tr>
                                </thead>
                                <tbody class="fw-semibold text-gray-600">
                                    @foreach ($layak as $layak)
                                        @php
                                            $status = DB::table('bk_status')->where('kod_status', $layak->permohonan_status)->value('status');
                                                        
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
                                    <tr>
                                        <td>{{ $layak->no_rujukan_permohonan}}</td>
                                        <td>{{ $pemohon}}</td>
                                        <td>{{ $kursus}}</td>
                                        <td>
                                            {{ \Carbon\Carbon::createFromFormat('Y-m-d', $layak->tarikh_mula)->format('d/m/Y') }} - 
                                            {{ \Carbon\Carbon::createFromFormat('Y-m-d', $layak->tarikh_tamat)->format('d/m/Y') }}
                                        </td>
                                        <td class="text-center"><button class="btn bg-success text-white">{{ucwords(strtolower($status))}}</button></td>
                                        <td>
                                            <!--begin::Toolbar-->
                                            <div class="d-flex">
                                                <!--begin::Edit-->
                                                <a href="#" class="btn btn-icon btn-active-light-primary w-30px h-30px me-3" data-bs-toggle="modal" data-bs-target="#kt_modal_new_card{{$layak->smoku_id}}">
                                                    <span data-bs-toggle="tooltip" data-bs-trigger="hover" title="Tuntutan">
                                                        <i class="ki-solid ki-pencil text-dark fs-2"></i>
                                                    </span>
                                                </a>
                                                <a href="#" class="btn btn-icon btn-active-light-primary w-30px h-30px me-3" data-bs-toggle="modal" data-bs-target="#kt_modal_view_sejarah{{$layak->smoku_id}}">
                                                    <span data-bs-toggle="tooltip" data-bs-trigger="hover" title="Sejarah">
                                                        <i class="ki-solid ki-search-list text-dark fs-2"></i>
                                                    </span>
                                                </a>
                                                <!--end::Edit-->
                                            </div>
                                            <!--end::Toolbar-->
                                        </td>
                                        <!--begin::Modals-->
                                        <div class="modal fade" id="kt_modal_new_card{{$layak->smoku_id}}" tabindex="-1" aria-hidden="true">
                                            <!--begin::Modal dialog-->
                                            <div class="modal-dialog modal-dialog-centered mw-650px">
                                                <!--begin::Modal content-->
                                                <div class="modal-content">
                                                    <!--begin::Modal header-->
                                                    <div class="modal-header">
                                                        <!--begin::Modal title-->
                                                        <h2>Keputusan Peperiksaan Baru</h2>
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
                                                                    <select id="sesi" name="sesi" class="form-select form-select-solid" data-control="select2" data-hide-search="true">
                                                                        <option value="">Pilih</option>
                                                                            @php
                                                                                $currentYear = date('Y');
                                                                            @endphp
                                                                            @for($year = $currentYear; $year <= ($currentYear + 1); $year++)
                                                                                @php
                                                                                    $sesi = $year . '/' . ($year + 1);
                                                                                @endphp
                                                                                <option value="{{ $sesi }}">{{ $sesi }}</option>
                                                                            @endfor
                                                                    </select>
                                                                    <!--end::Input-->
                                                                </div>
                                                                <!--end::Input group-->
                                                                <!--begin::Input group-->
                                                                <div class="fv-row mb-7">
                                                                    <!--begin::Label-->
                                                                    <label class="fs-6 fw-semibold mb-2">Semester</label>
                                                                    <!--end::Label-->
                                                                    <!--begin::Input-->
                                                                    <select name="semester" id="semester" class="form-select form-select-solid" data-control="select2" data-placeholder="Pilih">
                                                                        <option value="">Pilih</option>
                                                                        <option value="2">2</option>
                                                                        <option value="3">3</option>
                                                                        <option value="4">4</option>
                                                                    </select>
                                                                    <!--end::Input-->
                                                                </div>
                                                                <!--end::Input group-->
                                                                <!--begin::Input group-->
                                                                <div class="fv-row mb-7">
                                                                    <!--begin::Label-->
                                                                    <label class="fs-6 fw-semibold mb-2">CGPA</label>
                                                                    <!--end::Label-->
                                                                    <!--begin::Input-->
                                                                    <input type="text" name="cgpa" class="form-control form-control-solid"  placeholder="" />
                                                                    <!--end::Input-->
                                                                </div>
                                                                <!--end::Input group-->
                                                                <!--begin::Input group-->
                                                                <div class="fv-row mb-7">
                                                                    <!--begin::Label-->
                                                                    <label class="fs-6 fw-semibold mb-2">Salinan Keputusan Pengajian</label>
                                                                    <!--end::Label-->
                                                                    <!--begin::Input-->
                                                                    <input type="file" class="form-control form-control-sm" id="kepPeperiksaan" name="kepPeperiksaan"/></td>
                                                                    <!--end::Input-->
                                                                </div>
                                                                <!--end::Input group-->
                                                                <div class="col-6">
                                                                    <input class="form-check-input" type="checkbox" value="1" id="wang_saku"  name="wang_saku" onclick="return false" checked/>
                                                                    <label class="fs-6 fw-semibold form-label">
                                                                        Tuntut Elaun Wang Saku
                                                                    </label>
                                                                </div> 
                                                                <!--begin::Input group-->
                                                                <div class="fv-row mb-7">
                                                                    <!--begin::Label-->
                                                                    <label class="fs-6 fw-semibold mb-2">Amaun Wang Saku</label>
                                                                    <!--end::Label-->
                                                                    <!--begin::Input-->
                                                                    <input type="text" name="amaun_wang_saku" class="form-control form-control-solid"  placeholder="RM" value= "{{3360}}" readonly/>
                                                                    <!--end::Input-->
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
                                        <!--end::Modals-->
                                        
                                        <!--begin::Sejarah Modals-->
                                        <div class="modal fade" id="kt_modal_view_sejarah{{$layak->smoku_id}}" tabindex="-1" aria-hidden="true">
                                            <!--begin::Modal dialog-->
                                            <div class="modal-dialog mw-650px">
                                                <!--begin::Modal content-->
                                                <div class="modal-content">
                                                    <!--begin::Modal header-->
                                                    <div class="modal-header pb-0 border-0 justify-content-end">
                                                        <!--begin::Close-->
                                                        <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                                                            <i class="ki-duotone ki-cross fs-1">
                                                                <span class="path1"></span>
                                                                <span class="path2"></span>
                                                            </i>
                                                        </div>
                                                        <!--end::Close-->
                                                    </div>
                                                    <!--begin::Modal header-->
                                                    <!--begin::Modal body-->
                                                    <div class="modal-body scroll-y mx-5 mx-xl-18 pt-0 pb-15">
                                                        <!--begin::Heading-->
                                                        <div class="text-center mb-13">
                                                            <!--begin::Title-->
                                                            <h1 class="mb-3">Browse Users</h1>
                                                            <!--end::Title-->
                                                            <!--begin::Description-->
                                                            <div class="text-muted fw-semibold fs-5">If you need more info, please check out our
                                                            <a href="#" class="link-primary fw-bold">Users Directory</a>.</div>
                                                            <!--end::Description-->
                                                        </div>
                                                        <!--end::Heading-->
                                                        <!--begin::Users-->
                                                        <div class="mb-15">
                                                            <!--begin::List-->
                                                            <div class="mh-375px scroll-y me-n7 pe-7">
                                                                <!--begin::User-->
                                                                <div class="d-flex flex-stack py-5 border-bottom border-gray-300 border-bottom-dashed">
                                                                    <!--begin::Details-->
                                                                    @php
                                                                        $tuntutan = DB::table('tuntutan')->where('smoku_id', $layak->smoku_id)->get();
                                                                        // dd($tuntutan);
                                                                    @endphp
                                                                    @foreach ($tuntutan as $index => $singleTuntutan)
                                                                    <div class="d-flex align-items-center">
                                                                        <!-- Display no_rujukan_tuntutan -->
                                                                        <div class="ms-6">
                                                                            @if($singleTuntutan->no_rujukan_tuntutan)
                                                                                <div class="d-flex align-items-center fs-5 fw-bold text-dark">
                                                                                    No Rujukan Tuntutan: {{ $singleTuntutan->no_rujukan_tuntutan }}
                                                                                </div>
                                                                            @else
                                                                                <div class="d-flex align-items-center fs-5 fw-bold text-dark">
                                                                                    No data available
                                                                                </div>
                                                                            @endif
                                                                        </div>
                                                                
                                                                        <!-- Display amaun_wang_saku -->
                                                                        <div class="ms-6">
                                                                            @if($singleTuntutan->amaun_wang_saku)
                                                                                <div class="d-flex align-items-center fs-5 fw-bold text-dark">
                                                                                    Amaun Wang Saku: {{ $singleTuntutan->amaun_wang_saku }}
                                                                                </div>
                                                                            @else
                                                                                <div class="d-flex align-items-center fs-5 fw-bold text-dark">
                                                                                    No data available
                                                                                </div>
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                
                                                                    <!-- Display second no_rujukan_tuntutan and amaun_wang_saku in second row if available -->
                                                                    @if ($index == 1 && $tuntutan[1]->no_rujukan_tuntutan && $tuntutan[1]->amaun_wang_saku)
                                                                        <div class="d-flex align-items-center mt-3">
                                                                            <div class="ms-6">
                                                                                <div class="d-flex align-items-center fs-5 fw-bold text-dark">
                                                                                    No Rujukan Tuntutan: {{ $tuntutan[1]->no_rujukan_tuntutan }}
                                                                                </div>
                                                                            </div>
                                                                
                                                                            <div class="ms-6">
                                                                                <div class="d-flex align-items-center fs-5 fw-bold text-dark">
                                                                                    Amaun Wang Saku: {{ $tuntutan[1]->amaun_wang_saku }}
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    @endif
                                                                @endforeach

                                                                </div>
                                                                <!--end::User-->
                                                            </div>
                                                            <!--end::List-->
                                                        </div>
                                                        <!--end::Users-->
                                                    </div>
                                                    <!--end::Modal body-->
                                                </div>
                                                <!--end::Modal content-->
                                            </div>
                                            <!--end::Modal dialog-->
                                        </div>
                                        <!--end::Sejarah Modals--> 
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
    
    <!--begin::Javascript-->

    <!--end::Javascript-->
        
    
    
    
    
    </x-default-layout>
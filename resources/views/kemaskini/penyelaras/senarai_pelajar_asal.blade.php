<x-default-layout>
    <head>
        <!-- Include your CSS and JS dependencies -->
        {{-- <link rel="stylesheet" href="/assets/css/saringan.css">
        <script src="https://cdn.jsdelivr.net/npm/jquery@latest/dist/jquery.min.js"></script> --}}
        {{-- <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script> --}}
        {{-- <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js"></script> --}}
        {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@latest/dist/css/select2.min.css"> --}}

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
        <li class="breadcrumb-item text-dark" style="color:darkblue">Institusi Pengajian</li>
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
                <h2>Senarai Pelajar</h2>
            </div>
            <!--end::Header-->
            <!--begin::Card body-->
            <div class="body">
                <!--begin::Table-->
                <div class="table-responsive">
                    <table id="sortTable2" class="table table-striped table-hover dataTable js-exportable">
                        <thead>
                            <tr>
                                <th class="text-center"><b>Nama</b></th>                                        
								<th class="text-center"><b>No. Kad Pengenalan</b></th>
								<th class="text-center"><b>Nama Kursus</b></th>
                                <th class="text-center"><b>Tarikh Daftar</b></th>
                                <th class="text-center"><b>Status</b></th>
                                <th class="text-center"><b>Tindakan</b></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pelajar as $pelajar)
                                @php
                                // dd ($layak);
                                                
                                    $text = ucwords(strtolower($pelajar->nama)); // Assuming you're sending the text as a POST parameter
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
                                    
                                    // dd($pelajar->jenis_institusi);
                                    $tukar_institusi = DB::table('tukar_institusi')
                                        ->orderBy('id', 'desc')
                                        ->where('smoku_id', $pelajar['smoku_id'])
                                        ->first(); 
                                                                     
                                    
                                @endphp
                            <tr>
                                <td>{{ $pemohon}}</td>
                                <td>{{ $pelajar->no_kp}}</td>
                                <td>{{ $pelajar->nama_kursus}}</td>
                                <td>
                                    {{ \Carbon\Carbon::parse($pelajar->tarikh_daftar)->format('d/m/Y h:i:sa') }}
                                </td>
                                
                               
                                    <td class="text-center">
                                        @if($pelajar->status == 1)
											<div class="badge badge-light-success fw-bold">Aktif</div>
										@else
											<div class="badge badge-light-danger fw-bold">Tidak Aktif</div>
										@endif
                                        @if($tukar_institusi != null && $tukar_institusi->status == 0)
											<div class="badge badge-light-warning fw-bold">Tukar Institusi</div>
                                        @elseif($tukar_institusi != null && $tukar_institusi->status == 1 && $tukar_institusi->id_institusi_baru != $pelajar->id_institusi)
											<div class="badge badge-light-warning fw-bold">Terima Pelajar</div>
                                        @endif
                                    </td>
                                
                                
                                
                                <td class="text-center">
                                    <!--begin::Edit-->
                                    @if ($tukar_institusi != null && $tukar_institusi->status == 1 && $tukar_institusi->id_institusi_baru != $pelajar->id_institusi)
                                    <a href="#" class="btn btn-icon btn-active-light-primary w-30px h-30px me-3" data-bs-toggle="modal" data-bs-target="#kt_modal_terima{{$pelajar->no_kp}}">
                                        <span data-bs-toggle="tooltip" data-bs-trigger="hover" title="Terima Pelajar">
                                            <i class="ki-solid ki-pencil text-dark fs-2"></i>
                                        </span>
                                    </a>
                                    @else
                                    <a href="#" class="btn btn-icon btn-active-light-primary w-30px h-30px me-3" data-bs-toggle="modal" data-bs-target="#kt_modal_new_card{{$pelajar->no_kp}}">
                                        <span data-bs-toggle="tooltip" data-bs-trigger="hover" title="Tukar Institusi">
                                            <i class="ki-solid ki-pencil text-dark fs-2"></i>
                                        </span>
                                    </a>
                                    @endif
                                    <!--end::Edit-->
                                </td>
                                <!--begin::Modal - terima-->
                                <div class="modal fade" id="kt_modal_terima{{$pelajar->no_kp}}" tabindex="-1" aria-hidden="true">
                                    <!--begin::Modal dialog-->
                                    <div class="modal-dialog modal-dialog-centered mw-650px">
                                        <!--begin::Modal content-->
                                        <div class="modal-content">
                                            <!--begin::Modal header-->
                                            <div class="modal-header">
                                                <!--begin::Modal title-->
                                                <h2>Terima Pelajar</h2>
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
                                            @php
                                            $institusi_asal = DB::table('bk_info_institusi')->where('id_institusi', $pelajar->id_institusi)->value('nama_institusi');
                                            // dd($institusi_asal);
                                            $institusi_baru = DB::table('bk_info_institusi')->where('id_institusi', $pelajar->id_institusi_baru)->value('nama_institusi');
                                            @endphp
                                            <!--begin::Modal body-->
                                            <div class="modal-body scroll-y mx-5 mx-xl-15 my-7">
                                                <!--begin::Form-->
                                                <form class="form" id="kt_modal_terima_form" action="{{route('terima.pelajar', ['id' => $pelajar->smoku_id ])}}" method="post">
                                                    @csrf
                                                    <!--begin::Scroll-->

                                                    <div class="scroll-y me-n7 pe-7" id="kt_modal_add_customer_scroll" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_add_customer_header" data-kt-scroll-wrappers="#kt_modal_add_customer_scroll" data-kt-scroll-offset="300px">
                                                        <!--begin::Input group-->
                                                        <div class="fv-row mb-7">
                                                            <!--begin::Label-->
                                                            <label class="fs-6 fw-semibold mb-2">Nama Institusi Asal</label>
                                                            <!--end::Label-->
                                                            <!--begin::Input-->
                                                            <input type="hidden" class="form-control form-control-solid" placeholder="" id="id_asal" name="id_asal" value="{{ $pelajar->id_institusi }}"  readonly/>
                                                            <input type="text" class="form-control form-control-solid" placeholder="" id="id_institusi_lama" name="id_institusi_lama" value="{{ $institusi_asal }}"  readonly/>
                                                            <!--end::Input-->
                                                        </div>
                                                        <!--end::Input group-->
                                                        <!--begin::Input group-->
                                                        <div class="fv-row mb-7">
                                                            <label class="fs-6 fw-semibold mb-2">Nama Institusi Baru</label>
                                                            <input type="hidden" class="form-control form-control-solid" placeholder="" id="id_baru" name="id_baru" value="{{ $pelajar->id_institusi_baru }}"  readonly/>
                                                            <input type="text" class="form-control form-control-solid" placeholder="" id="id_institusi_baru" name="id_institusi_baru" value="{{ $institusi_baru }}"  readonly/>
                                                        </div>
                                                        <!--end::Input group-->

                                                    </div>
                                                    <!--end::Scroll-->

                                                    <!--begin::Actions-->
                                                    <div class="text-center pt-15">
                                                        <button type="submit" id="kt_modal_terima_submit" class="btn btn-primary">
                                                            <span class="indicator-label">Terima</span>
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
                                <!--end::Modal - terima-->

                                <!--begin::Modal - Tukar-->
                                <div class="modal fade" id="kt_modal_new_card{{$pelajar->no_kp}}" tabindex="-1" aria-hidden="true">
                                    <!--begin::Modal dialog-->
                                    <div class="modal-dialog modal-dialog-centered mw-650px">
                                        <!--begin::Modal content-->
                                        <div class="modal-content">
                                            <!--begin::Modal header-->
                                            <div class="modal-header">
                                                <!--begin::Modal title-->
                                                <h2>Tukar Institusi</h2>
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
                                                <form class="form" id="kt_modal_new_card_form" action="{{route('tukar.institusi', ['id' => $pelajar->smoku_id ])}}" method="post">
                                                    @csrf
                                                    <!--begin::Scroll-->

                                                    <div class="scroll-y me-n7 pe-7" id="kt_modal_add_customer_scroll" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_add_customer_header" data-kt-scroll-wrappers="#kt_modal_add_customer_scroll" data-kt-scroll-offset="300px">
                                                        <!--begin::Input group-->
                                                        <div class="fv-row mb-7">
                                                            <!--begin::Label-->
                                                            <label class="fs-6 fw-semibold mb-2">Jenis Institusi</label>
                                                            <!--end::Label-->
                                                            <!--begin::Input-->
                                                            <select name="jenis_institusi" id="jenis_institusi{{$pelajar->no_kp}}" class="form-select form-select-lg form-select-solid js-example-basic-single"  data-control="select2" data-placeholder="pilih">
                                                                <option></option>
                                                                <option value="UA">UNIVERSITI AWAM</option>
                                                                <option value="IPTS">INSTITUSI PENGAJIAN TINGGI SWASTA</option>
                                                                <option value="P">POLITEKNIK</option>
                                                                <option value="KK">KOLEJ KOMUNITI</option>
                                                            </select>
                                                                                                                            
                                                            <!--end::Input-->
                                                        </div>
                                                        <!--end::Input group-->
                                                        <!--begin::Input group-->
                                                        <div class="fv-row mb-7">
                                                            <label class="fs-6 fw-semibold mb-2">Nama Institusi</label>
                                                            
                                                            <input type="hidden" class="form-control form-control-solid" placeholder="" id="id_institusi_asal" name="id_institusi_asal" value="{{$pelajar->id_institusi}}" />
                                                            <select name="id_institusi" id="id_institusi{{$pelajar->no_kp}}" class="form-select form-select-lg form-select-solid js-example-basic-single"  data-control="select2" data-hide-search="false" data-placeholder="pilih">
                                                                <!-- Options will be dynamically populated using JavaScript -->
                                                            </select>
                                                        </div>
                                                        <!--end::Input group-->

                                                    </div>
                                                    <!--end::Scroll-->
                                                    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
                                                    <script type='text/javascript'>
                                                    console.log("Script loaded.");
                                                        $(document).ready(function () {
                                                            
                                                        
                                                            $('.js-example-basic-single').select2();


                                                            // Enable search input in Select2 dropdown
                                                            function enableSearchInput($select2Element) {
                                                                var $searchInput = $select2Element.data('select2').$dropdown.find('.select2-search__field');

                                                                // Check if the search input exists
                                                                if ($searchInput.length) {
                                                                    $searchInput.prop('disabled', false);

                                                                    // Trigger an input event to ensure the input is recognized
                                                                    $searchInput.trigger('input');
                                                                    $searchInput.focus(); // Focus on the search input
                                                                    console.log("Search input enabled and focused.");
                                                                } else {
                                                                    console.log("Search input not found.");
                                                                }
                                                            }

                    
                                                        
                                                            // Store options for each jenis_institusi
                                                            var jenisOptions = {
                                                                'UA': {!! json_encode($infoipt) !!},
                                                                'IPTS': {!! json_encode($infoiptIPTS) !!},
                                                                'P': {!! json_encode($infoiptP) !!},
                                                                'KK': {!! json_encode($infoiptKK) !!}
                                                            };
                                                        
                                                            // Update id_institusi dropdown based on the selected jenis_institusi
                                                            $('#jenis_institusi{{$pelajar->no_kp}}').on('change', function () {
                                                                // Update selectedValue when jenis_institusi changes
                                                                selectedValue = $(this).val();
                                                                
                                                        
                                                                var options = jenisOptions[selectedValue];
                                                        
                                                                // Clear existing options
                                                                $('#id_institusi{{$pelajar->no_kp}}').empty();
                                                        
                                                                // Add new options
                                                                options.forEach(function (info) {
                                                                    var isSelected = (info.id_institusi == $('#id_institusi_asal').val());
                                                                    $('#id_institusi{{$pelajar->no_kp}}').append($('<option>', {
                                                                        value: info.id_institusi,
                                                                        text: info.nama_institusi.toUpperCase(),
                                                                        selected: isSelected
                    
                                                                    }));
                                                                });
                                                        
                                                                // Trigger Select2 to update the UI
                                                                $('#id_institusi{{$pelajar->no_kp}}').trigger('change');
                                                            });
                                                        });
                                                        
                                                    </script>

                                                    <!--begin::Actions-->
                                                    <div class="text-center pt-15">
                                                        <button type="submit" id="kt_modal_new_card_submit" class="btn btn-primary">
                                                            <span class="indicator-label">Simpan</span>
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
                                <!--end::Modal - Tukar-->
                               
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
    $('#sortTable1').DataTable({
            ordering: true, // Enable manual sorting
            order: [] // Disable initial sorting
        });
	$('#sortTable2').DataTable({
            ordering: true, // Enable manual sorting
            order: [] // Disable initial sorting
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
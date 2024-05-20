<x-default-layout>
    <head>
        <!-- Include your CSS and JS dependencies -->
        <link rel="stylesheet" href="/assets/css/saringan.css">
        <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js"></script>
        <script src="/assets/lang/Malay.json"></script>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0/dist/css/select2.min.css">

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
								<th class="text-center"><b>Semester</b></th>
                                <th class="text-center"><b>GPA</b></th>
                                <th class="text-center"><b>Status</b></th>
                                <th class="text-center"><b>Pengesahan</b></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pengesahan_cgpa as $pelajar)
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
                                                                   
                            

                                @endphp
                            <tr>
                                <td>
                                    {{ $pemohon}}
                                </td>
                                <td class="text-center">
                                    {{ $pelajar->no_kp}}
                                </td>
                                <td class="text-center">
                                    {{ $pelajar->semester}}
                                </td>
                                <td class="text-center">
                                    <a href="{{ asset('assets/dokumen/peperiksaan/' . $pelajar->kepPeperiksaan) }}" target="_blank" class="btn btn-info btn-sm">{{ $pelajar->cgpa}}</a>
                                </td>
                                
                               
                                    <td class="text-center">
                                        @if($pelajar->pengesahan_rendah == 2)
											<div class="badge badge-light-success fw-bold">Berjaya</div>
										@elseif($pelajar->pengesahan_rendah == 1)
                                            <div class="badge badge-light-warning fw-bold">Pengesahan GPA</div>
                                        @else    
											<div class="badge badge-light-danger fw-bold">Tidak Berjaya</div>
										@endif
                                        
                                    </td>
                                
                                
                                
                                <td class="text-center">
                                    <!--begin::Edit-->
                                    <form action="{{ route('kemaskini.pengesahan.cgpa', $pelajar->permohonan_id) }}" method="post">
                                        @csrf
                                        <select name="status" style="padding: 6px;" class="form-select" onchange="submitForm(this)">
                                            <option>Pilih</option>
                                            <option value="2">Disokong</option>
                                            <option value="0">Tidak Disokong</option>
                                            
                                        </select>
                                    </form>
                                    <!--end::Edit-->
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
    function submitForm(selectElement) {
        // Show confirmation dialog
        const confirmation = confirm("Teruskan untuk kemaskini pengesahan GPA pelajar?");
        
        // If user confirms, proceed to submit the form
        if (confirmation) {
            // Get the selected value
            const selectedValue = selectElement.value;

            // Find the associated form
            const form = selectElement.closest('form');

            // Set the selected value as a hidden input
            const input = document.createElement('input');
            input.type = 'hidden';
            input.name = 'status'; // Change to your desired input name
            input.value = selectedValue;
            form.appendChild(input);

            // Submit the form
            form.submit();
        }
    }

</script>
<script>
	$('#sortTable2').DataTable({
            ordering: true, // Enable manual sorting
            order: [], // Disable initial sorting
            language: {
                "url": "/assets/lang/Malay.json"
            }
        });
</script>


<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script>
	@if(session('success'))
		Swal.fire({
			icon: 'success',
			title: 'Disokong!',
			text: ' {!! session('success') !!}',
			confirmButtonText: 'OK'
		});
	@endif
	@if(session('failed'))
		Swal.fire({
			icon: 'error',
			title: 'Tidak Disokong!',
			text: ' {!! session('failed') !!}',
			confirmButtonText: 'OK'
		});
	@endif
</script>

<!--end::Javascript-->     
</x-default-layout>
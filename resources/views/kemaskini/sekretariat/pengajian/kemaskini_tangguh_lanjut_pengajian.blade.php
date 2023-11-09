<x-default-layout>
    <head>
        <title>Sekretariat BKOKU KPT</title>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">

        <!-- MAIN CSS -->
        <link rel="stylesheet" href="/assets/css/sekretariat.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
        
        <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
        <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/datetime/1.5.1/js/dataTables.dateTime.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js"></script>
    </head>

    <!--begin::Page title-->
	<div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
		<!--begin::Title-->
		<h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Kemaskini</h1>
		<!--end::Title-->
		<!--begin::Breadcrumb-->
		<ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
			<!--begin::Item-->
			<li class="breadcrumb-item text-dark" style="color:darkblue">Kemaskini</li>
			<!--end::Item-->
			<!--begin::Item-->
			<li class="breadcrumb-item">
				<span class="bullet bg-gray-400 w-5px h-2px"></span>
			</li>
			<!--end::Item-->
			<!--begin::Item-->
			<li class="breadcrumb-item text-dark" style="color:darkblue">Penangguhan / Pelanjutan Pengajian</li>
			<!--end::Item-->
		</ul>
	<!--end::Breadcrumb-->
	</div>
	<!--end::Page title-->
    <br>

    <body>
        <!-- Main body part  -->
        <div id="main-content">
            <div class="container-fluid">
                <div class="block-header">
                    <div class="row clearfix">
                        <div class="card">
                            <div class="header">
                                <h2>Senarai Permohonan BKOKU untuk Dikemaskini Permohonan Penangguhan / Pelanjutan Pengajian<br><small>Sila lihat dokumen yang dimuat naik sebagai pengesahan sebelum mengemaskini permohonan penangguhan / pelanjutan pengajian pemohon.</small></h2>
                            </div>

                            <div class="body">
                                <div class="table-responsive" id="table-responsive">
                                    <table id="sortTable1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr style="color: white; background-color:rgb(35, 58, 108);">
                                                <th style="width: 5%" class="text-center no-sort"><b>No.</b></th>                                        
                                                <th style="width: 35%"><b>Nama</b></th>
                                                <th style="width: 15%" class="text-center"><b>Peringkat Pengajian</b></th>
                                                <th style="width: 15%" class="text-center"><b>Sijil Tamat Pengajian</b></th>
                                                <th style="width: 15%" class="text-center"><b>Salinan Transkrip</b></th> 
                                                <th class="text-center" style="width: 15%">Kemaskini Tarikh Baru Tamat Pengajian</th>
                                                <th class="text-center" style="width: 15%">Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $i=0;
                                            @endphp

                                            @foreach ($recordsBKOKU as $items)
                                                @php
                                                    $text = ucwords(strtolower($items->nama));
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
                                                    <td class="text-center" data-no="{{ $i++ }}">{{$i++}}</td>
                                                    <td>{{$pemohon}}</td>
                                                    <td>{{ucwords(strtolower($items->peringkat))}}</td>
                                                    <td class="text-center">
                                                        <a href="{{ asset('assets/dokumen/surat_tangguh/' . $items->surat_tangguh) }}" target="_blank" class="btn btn-info btn-sm">
                                                        Lihat
                                                        <i class='fas fa-eye' style='color:white; font-size:10px; padding-left:20px;'></i>
                                                    </td>
                                                    <td class="text-center">
                                                        <a href="{{ asset('assets/dokumen/surat_tangguh/' . $items->dokumen_sokongan) }}" target="_blank" class="btn btn-info btn-sm">
                                                        Lihat
                                                        <i class='fas fa-eye' style='color:white; font-size:10px; padding-left:20px;'></i>
                                                    </td>
                                                    <form action="{{ route('kemaskini.tarikh.pengajian', $items->smoku_id) }}" method="post" id="myForm">
                                                    @csrf
                                                        <td class="text-center">
                                                            <input type="date" class="form-control form-control-solid" placeholder="" id="tarikh_tamat_baru" name="tarikh_tamat_baru" value="" />
                                                        </td>
                                                        <td class="text-center">
                                                            <select id="status" name="status" style="padding: 6px;" onchange="submitForm()">
                                                                <option value="">Pilih</option>
                                                                <option value="1">Diluluskan</option>
                                                                <option value="0">Tidak Diluluskan</option>
                                                            </select>
                                                        </td>
                                                    </form>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Javascript -->
        <script src="assets/bundles/libscripts.bundle.js"></script>    
        <script src="assets/bundles/vendorscripts.bundle.js"></script>

        <script>
            function submitForm() {
                console.log('Function called');
                // Get the selected value from the select input
                const statusInput = document.getElementById('status');
                const statusValue = statusInput.value;
               
                // Get the date value from the date input
                const dateInput = document.getElementById('tarikh_tamat_baru');
                const dateValue = dateInput.value;

                // Find the associated form
                const form = document.getElementById('myForm');
                console.log('Function aaa');
                // Create hidden inputs for both date and selected value
                const dateHiddenInput = document.createElement('input');
                dateHiddenInput.type = 'hidden';
                dateHiddenInput.name = 'tarikh_tamat_baru'; // Change to your desired input name for date
                dateHiddenInput.value = dateValue;
                form.appendChild(dateHiddenInput);

                const statusHiddenInput = document.createElement('input');
                statusHiddenInput.type = 'hidden';
                statusHiddenInput.name = 'status'; // Change to your desired input name for selected value
                statusHiddenInput.value = statusValue;
                form.appendChild(statusHiddenInput);

                // Submit the form
                form.submit();
            }

        </script>
        
        <script>
            $(document).ready(function() {
                var table = $('#sortTable1').DataTable({
                    "columnDefs": [
                        {
                            "targets": 'no-sort',
                            "orderable": false
                        }
                    ],
                });

                // Disable sorting for the "No" column
                table.on('order.dt', function() {
                    table.column(0, { order: 'applied' }).nodes().each(function(cell, i) {
                        cell.innerHTML = i + 1;
                    });
                }).draw();
            });
        </script>



<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script>
	// Check if there is a flash message
	@if(session('success'))
		Swal.fire({
			icon: 'success',
			title: 'Berjaya!',
			text: ' {!! session('success') !!}',
			confirmButtonText: 'OK'
		});
	@endif



		
</script>
    </body>
</x-default-layout> 
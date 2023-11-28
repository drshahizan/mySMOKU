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
			<li class="breadcrumb-item text-dark" style="color:darkblue">Peringkat Pengajian</li>
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
                                <h2>Senarai Permohonan BKOKU untuk Dikemaskini Peringkat Pengajian<br><small>Sila lihat dokumen yang dimuat naik sebagai pengesahan sebelum mengemaskini peringkat pengajian pemohon.</small></h2>
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
                                                <th class="text-center" style="width: 15%">Kemaskini</th>
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
                                                        <a href="{{ asset('assets/dokumen/sijil_tamat/' . $items->sijil_tamat) }}" target="_blank" class="btn btn-info btn-sm">
                                                        Lihat
                                                        <i class='fas fa-eye' style='color:white; font-size:10px; padding-left:20px;'></i>
                                                    </td>
                                                    <td class="text-center">
                                                        <a href="{{ asset('assets/dokumen/salinan_transkrip/' . $items->transkrip) }}" target="_blank" class="btn btn-info btn-sm">
                                                        Lihat
                                                        <i class='fas fa-eye' style='color:white; font-size:10px; padding-left:20px;'></i>
                                                    </td>
                                                    <td class="text-center">
                                                        <form action="{{ route('kemaskini.peringkat.pengajian', $items->smoku_id) }}" method="post">
                                                            @csrf
                                                            <select name="peringkat_pengajian" style="padding: 6px;" onchange="submitForm(this)">
                                                                <option value="">Kemaskini</option>
                                                                @foreach ($peringkatPengajian as $peringkat)
                                                                    <option value="{{ $peringkat->kod_peringkat }}" {{ Request::get('peringkat_pengajian') == $peringkat->kod_peringkat ? 'selected' : '' }}>{{ $peringkat->peringkat }}</option>
                                                                @endforeach
                                                            </select>
                                                        </form>
                                                    </td>
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
            function submitForm(selectElement) {
                // Get the selected value
                const selectedValue = selectElement.value;
        
                // Find the associated form
                const form = selectElement.closest('form');
        
                // Set the selected value as a hidden input
                const input = document.createElement('input');
                input.type = 'hidden';
                input.name = 'peringkat_pengajian'; // Change to your desired input name
                input.value = selectedValue;
                form.appendChild(input);
        
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
    </body>
</x-default-layout> 
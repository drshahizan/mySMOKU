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
		<h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Pengajian</h1>
		<!--end::Title-->
		<!--begin::Breadcrumb-->
		<ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
			<!--begin::Item-->
			<li class="breadcrumb-item text-dark" style="color:darkblue">Pengajian</li>
			<!--end::Item-->
			<!--begin::Item-->
			<li class="breadcrumb-item">
				<span class="bullet bg-gray-400 w-5px h-2px"></span>
			</li>
			<!--end::Item-->
			<!--begin::Item-->
			<li class="breadcrumb-item text-dark" style="color:darkblue">Kemaskini Peringkat</li>
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
                                <h2>Senarai Permohonan untuk Dikemaskini Peringkat Pengajian<br><small>Sila lihat dokumen yang dimuat naik sebagai pengesahan sebelum mengemaskini peringkat pengajian pemohon.</small></h2>
                            </div>

                            {{-- Javascript Nav Bar --}}
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active" id="bkoku-tab" data-toggle="tab" data-target="#bkoku" type="button" role="tab" aria-controls="bkoku" aria-selected="true">BKOKU</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="ppk-tab" data-toggle="tab" data-target="#ppk" type="button" role="tab" aria-controls="ppk" aria-selected="false">PPK</button>
                                </li>
                            </ul>

                            {{-- Content Navigation Bar --}}
                            <div class="tab-content" id="myTabContent">
                                {{-- BKOKU --}}
                                <div class="tab-pane fade show active" id="bkoku" role="tabpanel" aria-labelledby="bkoku-tab">
                                    <br>
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

                                                    @foreach ($pengajian as $item)
                                                        @php
                                                            $nama = DB::table('smoku')->where('id',$item['smoku_id'])->value('nama');
                                                            $text = ucwords(strtolower($nama));
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
                                                            $program = DB::table('permohonan')->where('smoku_id',$item['smoku_id'])->value('program');
                                                            $peringkat = DB::table('smoku_akademik')->join('bk_peringkat_pengajian', 'bk_peringkat_pengajian.kod_peringkat', '=', 'smoku_akademik.peringkat_pengajian')->where('smoku_akademik.smoku_id',$item['smoku_id'])->value('bk_peringkat_pengajian.peringkat')
                                                        @endphp

                                                        @if($program == "BKOKU")
                                                            <tr>
                                                                <td class="text-center" data-no="{{ $i++ }}">{{$i++}}</td>
                                                                <td>{{$pemohon}}</td>
                                                                <td>{{ucwords(strtolower($peringkat))}}</td>
                                                                <td class="text-center">
                                                                    <a href="{{ asset('assets/dokumen/sijil_tamat/' . $item->sijil_tamat) }}" target="_blank" class="btn btn-info btn-sm">
                                                                    Lihat
                                                                    <i class='fas fa-eye' style='color:white; font-size:10px; padding-left:20px;'></i>
                                                                </td>
                                                                <td class="text-center">
                                                                    <a href="{{ asset('assets/dokumen/salinan_transkrip/' . $item->transkrip) }}" target="_blank" class="btn btn-info btn-sm">
                                                                    Lihat
                                                                    <i class='fas fa-eye' style='color:white; font-size:10px; padding-left:20px;'></i>
                                                                </td>
                                                                <td class="text-center">
                                                                    <form action="{{ route('kemaskini.peringkat.pengajian', $item->smoku_id) }}" method="post">
                                                                        @csrf
                                                                        <select name="peringkat_pengajian" style="padding: 6px;" onchange="submitForm(this)">
                                                                            <option value="">Kemaskini</option>
                                                                            <option value="1">Sijil</option>
                                                                            <option value="2">Diploma</option>
                                                                            <option value="3">Sarjana Muda</option>
                                                                            <option value="4">Diploma Lepasan Ijazah</option>
                                                                            <option value="5">Ijazah Sarjana</option>
                                                                            <option value="6">Doktor Falsafah</option>
                                                                        </select>
                                                                    </form>
                                                                </td>
                                                            </tr>
                                                        @endif
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div> 

                                {{-- PKK --}}
                                <div class="tab-pane fade" id="ppk" role="tabpanel" aria-labelledby="ppk-tab">
                                    <br>
                                    <div class="body">
                                        <div class="table-responsive" id="table-responsive">
                                            <table id="sortTable2" class="table table-bordered table-striped">
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

                                                    @foreach ($pengajian as $item)
                                                        @php
                                                            $nama = DB::table('smoku')->where('id',$item['smoku_id'])->value('nama');
                                                            $text = ucwords(strtolower($nama));
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
                                                            $program = DB::table('permohonan')->where('smoku_id',$item['smoku_id'])->value('program');
                                                            $peringkat = DB::table('smoku_akademik')->join('bk_peringkat_pengajian', 'bk_peringkat_pengajian.kod_peringkat', '=', 'smoku_akademik.peringkat_pengajian')->where('smoku_akademik.smoku_id',$item['smoku_id'])->value('bk_peringkat_pengajian.peringkat')
                                                        @endphp

                                                        @if($program == "PPK")
                                                            <tr>
                                                                <td class="text-center" data-no="{{ $i++ }}">{{$i++}}</td>
                                                                <td>{{$pemohon}}</td>
                                                                <td>{{ucwords(strtolower($peringkat))}}</td>
                                                                <td class="text-center">
                                                                    <a href="{{ asset('assets/dokumen/sijil_tamat/' . $item->sijil_tamat) }}" target="_blank" class="btn btn-info btn-sm">
                                                                        Lihat
                                                                    <i class='fas fa-eye' style='color:white; font-size:10px; padding-left:20px;'></i>
                                                                </td>
                                                                <td class="text-center">
                                                                    <a href="{{ asset('assets/dokumen/salinan_transkrip/' . $item->transkrip) }}" target="_blank" class="btn btn-info btn-sm">
                                                                        Lihat
                                                                    <i class='fas fa-eye' style='color:white; font-size:10px; padding-left:20px;'></i>
                                                                </td>
                                                                <td class="text-center">
                                                                    <form action="{{ route('kemaskini.peringkat.pengajian', $item->smoku_id) }}" method="post">
                                                                        @csrf
                                                                        <select name="peringkat_pengajian" style="padding: 6px;" onchange="submitForm(this)">
                                                                            <option value="">Kemaskini</option>
                                                                            <option value="1">Sijil</option>
                                                                            <option value="2">Diploma</option>
                                                                            <option value="3">Sarjana Muda</option>
                                                                            <option value="4">Diploma Lepasan Ijazah</option>
                                                                            <option value="5">Ijazah Sarjana</option>
                                                                            <option value="6">Doktor Falsafah</option>
                                                                        </select>
                                                                    </form>
                                                                </td>
                                                            </tr>
                                                        @endif
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

            $(document).ready(function() {
                var table = $('#sortTable2').DataTable({
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
</x-default-layout> 
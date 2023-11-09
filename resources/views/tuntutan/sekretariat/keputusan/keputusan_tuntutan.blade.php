<x-default-layout>
    <head>
        <title>Sekretariat BKOKU KPT</title>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">

        <!-- MAIN CSS -->
        <link rel="stylesheet" href="/assets/css/saringan.css">
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
		<h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Tuntutan</h1>
		<!--end::Title-->
		<!--begin::Breadcrumb-->
		<ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
			<!--begin::Item-->
			<li class="breadcrumb-item text-dark" style="color:darkblue">Tuntutan</li>
			<!--end::Item-->
			<!--begin::Item-->
			<li class="breadcrumb-item">
				<span class="bullet bg-gray-400 w-5px h-2px"></span>
			</li>
			<!--end::Item-->
			<!--begin::Item-->
			<li class="breadcrumb-item text-dark" style="color:darkblue">Keputusan</li>
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
                                <h2>Senarai Keputusan Tuntutan<br><small>Sila gunakan fungsi filter untuk menapis data yang ingin dipaparkan sahaja.</small></h2>
                            </div>
                            {{-- Javascript Nav Bar --}}
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active" id="bkoku-tab" data-toggle="tab" data-target="#bkoku" type="button" role="tab" aria-controls="bkoku" aria-selected="true">BKOKU</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="bkokuUA-tab" data-toggle="tab" data-target="#bkokuUA" type="button" role="tab" aria-controls="bkokuUA" aria-selected="false">BKOKU UA</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="ppk-tab" data-toggle="tab" data-target="#ppk" type="button" role="tab" aria-controls="ppk" aria-selected="false">PPK</button>
                                </li>
                            </ul>
                            {{-- Content Navigation Bar --}}
                            <div class="tab-content" id="myTabContent">
                                {{-- BKOKU --}}
                                <div class="tab-pane fade show active" id="bkoku" role="tabpanel" aria-labelledby="bkoku-tab">
                                    <br><br>
                                    <form action="{{route('keputusan.tuntutan')}}" method="GET">
                                        <div class="row" style="margin-left:15px;">
                                            <div class="col-md-3 black">
                                                Pilih Julat Tarikh:
                                                <input type="text" name="daterange" id="daterange" value="{{ Request::get('daterange') }}" class="form-control"/>
                                            </div>

                                            <div class="col-md-3 black">
                                                Pilih Keputusan:
                                                <select name="status" id="status" class="form-select">
                                                    <option value="">Sila Pilih</option>
                                                    <option value="Layak">Layak</option>
                                                    <option value="Tidak Layak">Tidak Layak</option>
                                                    <option value="Dikembalikan">Dikembalikan</option>
                                                </select>
                                            </div>
                                        </div>
                                    </form>

                                    <div class="body">
                                        <div class="table-responsive" id="table-responsive">
                                            <table id="sortTable1" class="table table-bordered table-striped">
                                                <thead>
                                                    <tr style="color: white; background-color:rgb(35, 58, 108);">
                                                        <th style="width: 13%"><b>ID Tuntutan</b></th>
                                                        <th style="width: 40%"><b>Nama</b></th>
                                                        <th style="width: 15%"><b>Peringkat Pengajian</b></th>
                                                        <th class="text-center" style="width: 17%"><b>Tarikh Kemaskini Keputusan</b></th>
                                                        <th class="text-center" style="width: 15%">Status Tuntutan</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($tuntutan as $item)
                                                        @php
                                                            $permohonan = DB::table('permohonan')->where('id', $item['permohonan_id'])->first();
                                                            $rujukan = explode("/", $permohonan->no_rujukan_permohonan);
                                                            $peringkat = $rujukan[1];
                                                            $akademik = DB::table('smoku_akademik')->where('smoku_id', $item['smoku_id'])->where('peringkat_pengajian', $peringkat)->first();
                                                            $jenis_institusi = DB::table('bk_info_institusi')->where('id_institusi', $akademik->id_institusi)->value('jenis_institusi');

                                                            $no_ruj_tuntutan = $item->no_rujukan_tuntutan;
                                                            $nama_pemohon = DB::table('smoku')->where('id', $permohonan->smoku_id)->value('nama');
                                                            $status = DB::table('bk_status')->where('kod_status', $item['status'])->value('status');
                                                            $text = ucwords(strtolower($nama_pemohon)); // Assuming you're sending the text as a POST parameter
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

                                                            //peringkat pengajian
                                                            preg_match('/\/(\d+)\//', $no_ruj_tuntutan, $matches); // Extract peringkat pengajian value using regular expression
                                                            $peringkat_pengajian = isset($matches[1]) ? $matches[1] : null; // $matches[1] will contain the extracted peringkat pengajian value
                                                            $nama_peringkat = DB::table('bk_peringkat_pengajian')->where('kod_peringkat', $peringkat_pengajian)->value('peringkat');
                                                        @endphp

                                                        @if($permohonan->program=="BKOKU")
                                                            @if ($jenis_institusi!="UA")
                                                            <tr>
                                                                <td>{{$no_ruj_tuntutan}}</td>
                                                                <td>{{$pemohon}}</td>
                                                                <td>{{ucwords(strtolower($nama_peringkat))}}</td>
                                                                <td class="text-center">{{$item['created_at']->format('Y-m-d')}}</td>
                                                                @if($item['status'] == "6")
                                                                    <td class="text-center"><button type="button" class="btn btn-success btn-sm">{{ucwords(strtolower($status))}}</button></td>
                                                                @elseif ($item['status']=="5")
                                                                    <td class="text-center"><button type="button" class="btn bg-dikembalikan">{{ucwords(strtolower($status))}}</button></td>
                                                                @elseif($item['status'] == "7")
                                                                    <td class="text-center"><button type="button" class="btn btn-danger btn-sm">{{ucwords(strtolower($status))}}</button></td>
                                                                @endif
                                                            </tr>
                                                            @endif
                                                       @endif
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="bkokuUA" role="tabpanel" aria-labelledby="bkokuUA-tab">
                                    <br><br>
                                    <form action="{{route('keputusan.tuntutan')}}" method="GET">
                                        <div class="row" style="margin-left:15px;">
                                            <div class="col-md-3 black">
                                                Pilih Julat Tarikh:
                                                <input type="text" name="daterange" id="daterange" value="{{ Request::get('daterange') }}" class="form-control"/>
                                            </div>

                                            <div class="col-md-3 black">
                                                Pilih Keputusan:
                                                <select name="status" id="status" class="form-select">
                                                    <option value="">Sila Pilih</option>
                                                    <option value="Layak">Layak</option>
                                                    <option value="Tidak Layak">Tidak Layak</option>
                                                    <option value="Dikembalikan">Dikembalikan</option>
                                                </select>
                                            </div>
                                        </div>
                                    </form>

                                    <div class="body">
                                        <div class="table-responsive" id="table-responsive">
                                            <table id="sortTable1a" class="table table-bordered table-striped">
                                                <thead>
                                                <tr style="color: white; background-color:rgb(35, 58, 108);">
                                                    <th style="width: 13%"><b>ID Tuntutan</b></th>
                                                    <th style="width: 40%"><b>Nama</b></th>
                                                    <th style="width: 15%"><b>Peringkat Pengajian</b></th>
                                                    <th class="text-center" style="width: 17%"><b>Tarikh Kemaskini Keputusan</b></th>
                                                    <th class="text-center" style="width: 15%">Status Tuntutan</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach ($tuntutan as $item)
                                                    @php
                                                        $permohonan = DB::table('permohonan')->where('id', $item['permohonan_id'])->first();
                                                        $rujukan = explode("/", $permohonan->no_rujukan_permohonan);
                                                        $peringkat = $rujukan[1];
                                                        $akademik = DB::table('smoku_akademik')->where('smoku_id', $item['smoku_id'])->where('peringkat_pengajian', $peringkat)->first();
                                                        $jenis_institusi = DB::table('bk_info_institusi')->where('id_institusi', $akademik->id_institusi)->value('jenis_institusi');

                                                        $no_ruj_tuntutan = $item->no_rujukan_tuntutan;
                                                        $permohonan = DB::table('permohonan')->where('id', $item['permohonan_id'])->first();
                                                        $nama_pemohon = DB::table('smoku')->where('id', $permohonan->smoku_id)->value('nama');
                                                        $status = DB::table('bk_status')->where('kod_status', $item['status'])->value('status');
                                                        $text = ucwords(strtolower($nama_pemohon)); // Assuming you're sending the text as a POST parameter
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

                                                        //peringkat pengajian
                                                        preg_match('/\/(\d+)\//', $no_ruj_tuntutan, $matches); // Extract peringkat pengajian value using regular expression
                                                        $peringkat_pengajian = isset($matches[1]) ? $matches[1] : null; // $matches[1] will contain the extracted peringkat pengajian value
                                                        $nama_peringkat = DB::table('bk_peringkat_pengajian')->where('kod_peringkat', $peringkat_pengajian)->value('peringkat');
                                                    @endphp

                                                    @if($permohonan->program=="BKOKU")
                                                        @if ($jenis_institusi=="UA")
                                                            <tr>
                                                                <td style="width: 13%">{{$no_ruj_tuntutan}}</td>
                                                                <td style="width: 40%">{{$pemohon}}</td>
                                                                <td style="width: 15%">{{ucwords(strtolower($nama_peringkat))}}</td>
                                                                <td class="text-center" style="width: 17%">{{$item['created_at']->format('d/m/Y')}}</td>
                                                                @if($item['status'] == "6")
                                                                    <td class="text-center" style="width: 15%"><button type="button" class="btn btn-success btn-sm">{{ucwords(strtolower($status))}}</button></td>
                                                                @elseif ($item['status']=="5")
                                                                    <td class="text-center" style="width: 15%"><button type="button" class="btn bg-dikembalikan">{{ucwords(strtolower($status))}}</button></td>
                                                                @elseif($item['status'] == "7")
                                                                    <td class="text-center" style="width: 15%"><button type="button" class="btn btn-danger btn-sm">{{ucwords(strtolower($status))}}</button></td>
                                                                @endif
                                                            </tr>
                                                        @endif
                                                    @endif
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                {{-- PKK --}}
                                <div class="tab-pane fade" id="ppk" role="tabpanel" aria-labelledby="ppk-tab">
                                    <br><br>
                                    <form action="" method="GET">
                                        <div class="row" style="margin-left:15px;">
                                            <div class="col-md-3">
                                                <input type="daterange" name="daterange" id="daterange" value="{{ Request::get('daterange') }}" class="form-control"/>
                                            </div>

                                            <div class="col-md-3">
                                                <select name="status2" class="form-select">
                                                    <option value="">Pilih Keputusan</option>
                                                    <option value="Layak" {{Request::get('status') == 'Layak' ? 'selected':'' }} >Layak</option>
                                                    <option value="Tidak Layak" {{Request::get('status') == 'Tidak Layak' ? 'selected':'' }} >Tidak Layak</option>
                                                </select>
                                            </div>
                                        </div>
                                    </form>

                                    <div class="body">
                                        <div class="table-responsive">
                                            <table id="sortTable2" class="table table-bordered table-striped">
                                                <thead>
                                                    <tr style="color: white; background-color:rgb(35, 58, 108);">
                                                        <th style="width: 13%"><b>ID Tuntutan</b></th>
                                                        <th style="width: 40%"><b>Nama</b></th>
                                                        <th style="width: 15%"><b>Peringkat Pengajian</b></th>
                                                        <th class="text-center" style="width: 17%"><b>Tarikh Kemaskini Keputusan</b></th>
                                                        <th class="text-center" style="width: 15%">Status Tuntutan</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($tuntutan as $item)
                                                        @php
                                                            $no_ruj_tuntutan = $item->no_rujukan_tuntutan;
                                                            $permohonan = DB::table('permohonan')->where('id', $item['permohonan_id'])->first();
                                                            $nama_pemohon = DB::table('smoku')->where('id', $permohonan->smoku_id)->value('nama');
                                                            $status = DB::table('bk_status')->where('kod_status', $item['status'])->value('status');
                                                            $text = ucwords(strtolower($nama_pemohon)); // Assuming you're sending the text as a POST parameter
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

                                                            //peringkat pengajian
                                                            preg_match('/\/(\d+)\//', $no_ruj_tuntutan, $matches); // Extract peringkat pengajian value using regular expression
                                                            $peringkat_pengajian = isset($matches[1]) ? $matches[1] : null; // $matches[1] will contain the extracted peringkat pengajian value
                                                            $nama_peringkat = DB::table('bk_peringkat_pengajian')->where('kod_peringkat', $peringkat_pengajian)->value('peringkat');
                                                        @endphp

                                                        @if($permohonan->program=="PPK")
                                                        <tr>
                                                            <td style="width: 13%">{{$no_ruj_tuntutan}}</td>
                                                            <td style="width: 40%">{{$pemohon}}</td>
                                                            <td style="width: 15%">{{ucwords(strtolower($nama_peringkat))}}</td>
                                                            <td class="text-center" style="width: 17%">{{$item['created_at']->format('d/m/Y')}}</td>
                                                            @if($item['status'] == "6")
                                                                <td class="text-center" style="width: 15%"><button type="button" class="btn btn-success btn-sm">{{ucwords(strtolower($status))}}</button></td>
                                                            @elseif ($item['status']=="5")
                                                                <td class="text-center" style="width: 15%"><button type="button" class="btn bg-dikembalikan">{{ucwords(strtolower($status))}}</button></td>
                                                            @elseif($item['status'] == "7")
                                                                <td class="text-center" style="width: 15%"><button type="button" class="btn btn-danger btn-sm">{{ucwords(strtolower($status))}}</button></td>
                                                            @endif
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

        <script>
            $('#sortTable1a').DataTable();
            $('#sortTable2').DataTable();
            //$('input[name="daterange"]').daterangepicker();
        </script>

        <script>
            $(document).ready(function() {
                var table = $('#sortTable1').DataTable();
                $('#daterange').daterangepicker({
                    opens: 'left',
                    locale: {
                        format: 'DD/MM/YYYY' // Set the desired format for the date range picker
                    }
                }, function(start, end, label) {
                    let startDate = start.format('DD/MM/YYYY'); // Convert to match your table format
                    let endDate = end.format('DD/MM/YYYY');     // Convert to match your table format

                    DataTable.ext.search.push(function (settings, data, dataIndex) {
                        let date = new Date(data[3]).toLocaleDateString('en-GB');

                        if (
                            (startDate === null && endDate === null) ||
                            (startDate === null && date <= endDate) ||
                            (startDate <= date && endDate === null) ||
                            (startDate <= date && date <= endDate)
                        ) {
                            return true;
                        }
                        return false;
                    });
                    table.draw();
                });

                $('#status').on('change', function() {
                    var status = $(this).val();

                    // Use column(4) if that's the column containing your status data.
                    table.column(4).search(status).draw();
                });

            });
        </script>

        {{-- <script>
            $(document).ready(function() {
                var table = $('#sortTable1').DataTable();

                $('#daterange').daterangepicker({
                    opens: 'left',
                }, function(start, end, label) {
                    var startDate = start.format('YYYY-MM-DD');
                    var endDate = end.format('YYYY-MM-DD');

                    console.log('startDate: ' + startDate); // Add this line
                    console.log('endDate: ' + endDate);     // Add this line

                    // Use column(3) if that's the column containing your date data.
                    // Make sure the date format matches the format in your table.
                    table.column(3).search(startDate + ' - ' + endDate).draw();
                });

                $('#status').on('change', function() {
                    var status = $(this).val();

                    console.log('status: ' + status); // Add this line

                    // Use column(4) if that's the column containing your status data.
                    table.column(4).search(status).draw();
                });
            });
        </script>                       --}}
</x-default-layout>

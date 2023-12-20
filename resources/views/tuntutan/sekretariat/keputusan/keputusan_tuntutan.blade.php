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

        <style>
            .nav{
                margin-left: 20px!important;
            }
        </style>
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
                                    <form action="{{ url('tuntutan/sekretariat/keputusan/keputusan-tuntutan') }}" method="GET">
                                        <div class="row" style="margin-left: 15px;">
                                            <div class="col-md-2">
                                                <label for="start_date">Dari:</label>
                                                <input type="date" name="start_date" id="start_date" value="{{ Request::get('start_date') }}" class="form-control" />
                                            </div>

                                            <div class="col-md-2">
                                                <label for="end_date">Hingga:</label>
                                                <input type="date" name="end_date" id="end_date" value="{{ Request::get('end_date') }}" class="form-control" />
                                            </div>

                                            <div class="col-md-3">
                                                <label for="end_date">Pilih Keputusan:</label>
                                                <select name="status" class="form-select">
                                                    <option value="">Semua Keputusan</option>
                                                    <option value="5" {{ Request::get('status') == '5' ? 'selected' : '' }}>Dikembalikan</option>
                                                    <option value="6" {{ Request::get('status') == '6' ? 'selected' : '' }}>Layak</option>
                                                    <option value="7" {{ Request::get('status') == '7' ? 'selected' : '' }}>Tidak Layak</option>
                                                </select>
                                            </div>

                                            <div class="col-md-4">
                                                <label for="institusi">Pilih Institusi:</label>
                                                <select name="institusi" class="form-select js-example-basic-single">
                                                    <option value="">Pilih Institusi Pengajian</option>
                                                    @foreach ($institusiBKOKU as $institusi)
                                                        <option value="{{ $institusi->id_institusi }}" {{ Request::get('institusi') == $institusi->id_institusi ? 'selected' : '' }}>{{ $institusi->nama_institusi }}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="col-md-1">
                                                <br>
                                                <button type="submit" class="btn btn-primary" style="width: 10%; padding-left: 10px;">
                                                    <i class="fa fa-filter" style="font-size: 15px;"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </form>

                                    <div class="body">
                                        <div class="table-responsive" id="table-responsive">
                                            <table id="sortTable1" class="table table-bordered table-striped">
                                                <thead>
                                                    <tr style="color: white; background-color:rgb(35, 58, 108);">
                                                        <th style="width: 15%"><b>ID Tuntutan</b></th>
                                                        <th style="width: 25%"><b>Nama</b></th>
                                                        <th class="text-center" style="width: 20%"><b>Institusi Pengajian</b></th>
                                                        <th style="width: 15%"><b>Peringkat Pengajian</b></th>
                                                        <th class="text-center" style="width: 17%"><b>Tarikh Kemaskini Keputusan</b></th>
                                                        <th class="text-center" style="width: 15%">Status Tuntutan</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($tuntutan as $item)
                                                        @php
                                                            $permohonan = DB::table('permohonan')->where('id', $item['permohonan_id'])->first();
                                                            $rujukan = explode("/", $item['no_rujukan_tuntutan']);
                                                            $peringkat = $rujukan[1];
                                                            $akademik = DB::table('smoku_akademik')->where('smoku_id', $item['smoku_id'])->where('peringkat_pengajian',$peringkat)->where('status', 1)->first();
                                                            $jenis_institusi = DB::table('bk_info_institusi')->where('id_institusi', $akademik->id_institusi)->value('jenis_institusi');
                                                            $institusi_pengajian = DB::table('smoku_akademik')->join('bk_info_institusi','bk_info_institusi.id_institusi','=','smoku_akademik.id_institusi' )->where('smoku_id', $item['smoku_id'])->where('peringkat_pengajian',$peringkat)->value('bk_info_institusi.nama_institusi');

                                                            $nama_peringkat = DB::table('bk_peringkat_pengajian')->where('kod_peringkat', $peringkat)->value('peringkat');

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

                                                            //institusi pengajian
                                                            $text3 = ucwords(strtolower($institusi_pengajian));
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
                                                            $institusi = implode(' ', $result);
                                                            $institusipengajian = transformBracketsToUppercase($institusi);
                                                        @endphp

                                                        @if($permohonan->program=="BKOKU")
                                                            @if ($jenis_institusi!="UA")
                                                            <tr>
                                                                <td>{{$item->no_rujukan_tuntutan}}</td>
                                                                <td style="width: 25%">{{$pemohon}}</td>
                                                                <td style="width: 20%">{{$institusipengajian}}</td>
                                                                <td>{{ucwords(strtolower($nama_peringkat))}}</td>
                                                                <td class="text-center"> {{ \Carbon\Carbon::parse($item['tarikh_keputusan'])->format('d/m/Y') }}</td>
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
                                 {{-- BKOKU UA--}}
                                <div class="tab-pane fade" id="bkokuUA" role="tabpanel" aria-labelledby="bkokuUA-tab">
                                    <br><br>
                                    <form action="{{ url('tuntutan/sekretariat/keputusan/keputusan-tuntutan') }}" method="GET">
                                        <div class="row" style="margin-left: 15px;">
                                            <div class="col-md-2">
                                                <label for="start_date">Dari:</label>
                                                <input type="date" name="start_date" id="start_date" value="{{ Request::get('start_date') }}" class="form-control" />
                                            </div>

                                            <div class="col-md-2">
                                                <label for="end_date">Hingga:</label>
                                                <input type="date" name="end_date" id="end_date" value="{{ Request::get('end_date') }}" class="form-control" />
                                            </div>

                                            <div class="col-md-3">
                                                <label for="end_date">Pilih Keputusan:</label>
                                                <select name="status" class="form-select">
                                                    <option value="">Semua Keputusan</option>
                                                    <option value="5" {{ Request::get('status') == '5' ? 'selected' : '' }}>Dikembalikan</option>
                                                    <option value="6" {{ Request::get('status') == '6' ? 'selected' : '' }}>Layak</option>
                                                    <option value="7" {{ Request::get('status') == '7' ? 'selected' : '' }}>Tidak Layak</option>
                                                </select>
                                            </div>

                                            <div class="col-md-4">
                                                <label for="institusi">Pilih Institusi:</label>
                                                <select name="institusi" class="form-select js-example-basic-single">
                                                    <option value="">Pilih Institusi Pengajian</option>
                                                    @foreach ($institusiUA as $institusi)
                                                        <option value="{{ $institusi->id_institusi }}" {{ Request::get('institusi') == $institusi->id_institusi ? 'selected' : '' }}>{{ $institusi->nama_institusi }}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="col-md-1">
                                                <br>
                                                <button type="submit" class="btn btn-primary" style="width: 10%; padding-left: 10px;">
                                                    <i class="fa fa-filter" style="font-size: 15px;"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </form>

                                    <div class="body">
                                        <div class="table-responsive" id="table-responsive">
                                            <table id="sortTable1a" class="table table-bordered table-striped">
                                                <thead>
                                                <tr style="color: white; background-color:rgb(35, 58, 108);">
                                                    <th style="width: 15%"><b>ID Tuntutan</b></th>
                                                    <th style="width: 25%"><b>Nama</b></th>
                                                    <th class="text-center" style="width: 20%"><b>Institusi Pengajian</b></th>
                                                    <th style="width: 15%"><b>Peringkat Pengajian</b></th>
                                                    <th class="text-center" style="width: 17%"><b>Tarikh Kemaskini Keputusan</b></th>
                                                    <th class="text-center" style="width: 15%">Status Tuntutan</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach ($tuntutan as $item)
                                                    @php
                                                        $permohonan = DB::table('permohonan')->where('id', $item['permohonan_id'])->first();
                                                        $rujukan = explode("/", $item['no_rujukan_tuntutan']);
                                                        $peringkat = $rujukan[1];
                                                        $akademik = DB::table('smoku_akademik')->where('smoku_id', $item['smoku_id'])->where('peringkat_pengajian',$peringkat)->where('status', 1)->first();
                                                        $jenis_institusi = DB::table('bk_info_institusi')->where('id_institusi', $akademik->id_institusi)->value('jenis_institusi');
                                                        $institusi_pengajian = DB::table('smoku_akademik')->join('bk_info_institusi','bk_info_institusi.id_institusi','=','smoku_akademik.id_institusi' )->where('smoku_id', $item['smoku_id'])->where('peringkat_pengajian',$peringkat)->value('bk_info_institusi.nama_institusi');

                                                        $nama_peringkat = DB::table('bk_peringkat_pengajian')->where('kod_peringkat', $peringkat)->value('peringkat');

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

                                                        //institusi pengajian
                                                        $text3 = ucwords(strtolower($institusi_pengajian));
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
                                                        $institusi = implode(' ', $result);
                                                        $institusipengajian = transformBracketsToUppercase($institusi);
                                                    @endphp

                                                    @if($permohonan->program=="BKOKU")
                                                        @if ($jenis_institusi=="UA")
                                                            <tr>
                                                                <td style="width: 13%">{{$item->no_rujukan_tuntutan}}</td>
                                                                <td style="width: 25%">{{$pemohon}}</td>
                                                                <td style="width: 20%">{{$institusipengajian}}</td>
                                                                <td style="width: 15%">{{ucwords(strtolower($nama_peringkat))}}</td>
                                                                <td class="text-center" style="width: 17%"> {{ \Carbon\Carbon::parse($item['tarikh_keputusan'])->format('d/m/Y') }}</td>
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
                                    <form action="{{ url('tuntutan/sekretariat/keputusan/keputusan-tuntutan') }}" method="GET">
                                        <div class="row" style="margin-left: 15px;">
                                            <div class="col-md-2">
                                                <label for="start_date">Dari:</label>
                                                <input type="date" name="start_date" id="start_date" value="{{ Request::get('start_date') }}" class="form-control" />
                                            </div>

                                            <div class="col-md-2">
                                                <label for="end_date">Hingga:</label>
                                                <input type="date" name="end_date" id="end_date" value="{{ Request::get('end_date') }}" class="form-control" />
                                            </div>

                                            <div class="col-md-3">
                                                <label for="end_date">Pilih Keputusan:</label>
                                                <select name="status" class="form-select">
                                                    <option value="">Semua Keputusan</option>
                                                    <option value="5" {{ Request::get('status') == '5' ? 'selected' : '' }}>Dikembalikan</option>
                                                    <option value="6" {{ Request::get('status') == '6' ? 'selected' : '' }}>Layak</option>
                                                    <option value="7" {{ Request::get('status') == '7' ? 'selected' : '' }}>Tidak Layak</option>
                                                </select>
                                            </div>
                                            <div class="col-md-4">
                                                <label for="institusi">Pilih Institusi:</label>
                                                <select name="institusi" class="form-select js-example-basic-single">
                                                    <option value="">Pilih Institusi Pengajian</option>
                                                    @foreach ($institusiPPK as $institusi)
                                                        <option value="{{ $institusi->id_institusi }}" {{ Request::get('institusi') == $institusi->id_institusi ? 'selected' : '' }}>{{ $institusi->nama_institusi }}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="col-md-1">
                                                <br>
                                                <button type="submit" class="btn btn-primary" style="width: 10%; padding-left: 10px;">
                                                    <i class="fa fa-filter" style="font-size: 15px;"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </form>

                                    <div class="body">
                                        <div class="table-responsive">
                                            <table id="sortTable2" class="table table-bordered table-striped">
                                                <thead>
                                                    <tr style="color: white; background-color:rgb(35, 58, 108);">
                                                        <th style="width: 15%"><b>ID Tuntutan</b></th>
                                                        <th style="width: 25%"><b>Nama</b></th>
                                                        <th class="text-center" style="width: 20%"><b>Institusi Pengajian</b></th>
                                                        <th style="width: 15%"><b>Peringkat Pengajian</b></th>
                                                        <th class="text-center" style="width: 17%"><b>Tarikh Kemaskini Keputusan</b></th>
                                                        <th class="text-center" style="width: 15%">Status Tuntutan</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($tuntutan as $item)
                                                        @php
                                                            $permohonan = DB::table('permohonan')->where('id', $item['permohonan_id'])->first();
                                                            $rujukan = explode("/", $item['no_rujukan_tuntutan']);
                                                            $peringkat = $rujukan[1];
                                                            $akademik = DB::table('smoku_akademik')->where('smoku_id', $item['smoku_id'])->where('peringkat_pengajian',$peringkat)->where('status', 1)->first();
                                                            $jenis_institusi = DB::table('bk_info_institusi')->where('id_institusi', $akademik->id_institusi)->value('jenis_institusi');
                                                            $institusi_pengajian = DB::table('smoku_akademik')->join('bk_info_institusi','bk_info_institusi.id_institusi','=','smoku_akademik.id_institusi' )->where('smoku_id', $item['smoku_id'])->where('peringkat_pengajian',$peringkat)->value('bk_info_institusi.nama_institusi');
                                                            $nama_peringkat = DB::table('bk_peringkat_pengajian')->where('kod_peringkat', $peringkat)->value('peringkat');

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

                                                            //institusi pengajian
                                                            $text3 = ucwords(strtolower($institusi_pengajian));
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
                                                            $institusi = implode(' ', $result);
                                                            $institusipengajian = transformBracketsToUppercase($institusi);
                                                        @endphp

                                                        @if($permohonan->program=="PPK")
                                                        <tr>
                                                            <td style="width: 13%">{{$item->no_rujukan_tuntutan}}</td>
                                                            <td style="width: 25%">{{$pemohon}}</td>
                                                            <td style="width: 20%">{{$institusipengajian}}</td>
                                                            <td style="width: 15%">{{ucwords(strtolower($nama_peringkat))}}</td>
                                                            <td class="text-center" style="width: 17%"> {{ \Carbon\Carbon::parse($item['tarikh_keputusan'])->format('d/m/Y') }}</td>
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

        <!-- Javascript -->
        <script src="assets/bundles/libscripts.bundle.js"></script>
        <script src="assets/bundles/vendorscripts.bundle.js"></script>

        <script>
        $('#sortTable1').DataTable({
            ordering: true, // Enable manual sorting
            order: [] // Disable initial sorting
        });
        $('#sortTable1a').DataTable({
            ordering: true, // Enable manual sorting
            order: [] // Disable initial sorting
        });
	    $('#sortTable2').DataTable({
            ordering: true, // Enable manual sorting
            order: [] // Disable initial sorting
        });
        </script>
        <script> 
            $(document).ready(function() {
                 $('.js-example-basic-single').select2();
             });
         </script> 

</x-default-layout>

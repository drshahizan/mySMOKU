<x-default-layout>
    <head>
        <title>Sekretariat BKOKU KPT | Saringan Permohonan</title>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">

        <!-- MAIN CSS -->
        <link rel="stylesheet" href="/assets/css/saringan.css">
        <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js"></script>
    </head>

    <style>
        .nav{
            margin-left: 10px!important;
        }
    </style>

    <!--begin::Page title-->
	<div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
		<!--begin::Title-->
		<h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Permohonan</h1>
		<!--end::Title-->
		<!--begin::Breadcrumb-->
		<ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
			<!--begin::Item-->
			<li class="breadcrumb-item text-dark" style="color:darkblue">Permohonan</li>
			<!--end::Item-->
			<!--begin::Item-->
			<li class="breadcrumb-item">
				<span class="bullet bg-gray-400 w-5px h-2px"></span>
			</li>
			<!--end::Item-->
			<!--begin::Item-->
			<li class="breadcrumb-item text-dark" style="color:darkblue">Saringan</li>
			<!--end::Item-->
		</ul>
	<!--end::Breadcrumb-->
	</div>
	<!--end::Page title-->
    <br>

    {{-- begin alert --}}
    @if($status_kod == 0)
     {{-- none --}}
    @endif
    @if($status_kod == 2)
        <div class="alert alert-warning" role="alert" style="margin: 0px 15px 20px 15px; color:black!important;">
            {{ $status }}
        </div>
    @endif
    @if($status_kod == 3)
        <div class="alert alert-success" role="alert" style="margin: 0px 15px 20px 15px; color:black!important;">
            {{ $status }}
        </div>
    @endif
    {{-- end alert --}}

    <body>
        <!-- Main body part  -->
        <div id="main-content">
            <div class="container-fluid">
                <!-- Page header section  -->
                <div class="row clearfix">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="header">
                                <h2>Senarai Saringan Permohonan<br><small>Klik ID Permohonan untuk melakukan saringan selanjutnya.</small></h2>
                            </div>

                            {{-- top nav bar --}}
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


                            <div class="tab-content" id="myTabContent">
                                {{-- BKOKU --}}
                                <div class="tab-pane fade show active" id="bkoku" role="tabpanel" aria-labelledby="bkoku-tab">
                                    <br>
                                    <div class="body">
                                        <div class="table-responsive">
                                            <form action="{{ url('permohonan/sekretariat/saringan/senarai-permohonan') }}" method="GET">
                                                <div class="row" style="margin-left: 10px;">
                                                    <div class="col-md-4">
                                                        <select name="institusi" class="form-select js-example-basic-single">
                                                            <option value="">Pilih Institusi Pengajian</option>
                                                            @foreach ($institusiPengajian as $institusi)
                                                                <option value="{{ $institusi->id_institusi }}" {{ Request::get('institusi') == $institusi->id_institusi ? 'selected' : '' }}>{{ $institusi->nama_institusi }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>

                                                    <div class="col-md-3" style="margin-left: 10px; margin-right:150px;">
                                                        <button type="submit" class="btn btn-primary" style="width: 15%; padding-left: 10px;">
                                                            <i class="fa fa-filter" style="font-size: 15px;"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </form>
                                            
                                            <table id="sortTable1" class="table table-striped table-hover dataTable js-exportable">
                                                <thead>
                                                    <tr>
                                                        <th class="text-center" style="width: 12%"><b>ID Permohonan</b></th>
                                                        <th class="text-center" style="width: 30%"><b>Nama</b></th>
                                                        <th class="text-center" style="width: 20%"><b>Institusi Pengajian</b></th>
                                                        <th class="text-center" style="width: 18%"><b>Tarikh Permohonan</b></th>
                                                        <th class="text-center" style="width: 10%"><b>Status Saringan</b></th>
                                                        <th class="text-center" style="width: 10%!important;"><b>Disaring Oleh</b></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @php
                                                        $i=0;
                                                    @endphp
                                                    @foreach ($permohonan as $item)
                                                    @if ($item['program']=="BKOKU")
                                                    @php
                                                        $i++;

                                                        $rujukan = explode("/", $item['no_rujukan_permohonan']);
                                                        $peringkat = $rujukan[1];
                                                        $akademik = DB::table('smoku_akademik')->where('smoku_id', $item['smoku_id'])->where('peringkat_pengajian', $peringkat)->first();
                                                        $bil_akademik = DB::table('smoku_akademik')->where('smoku_id', $item['smoku_id'])->count();
                                                        $jenis_institusi = DB::table('bk_info_institusi')->where('id_institusi', $akademik->id_institusi)->value('jenis_institusi');
                                                        $institusi_pengajian = DB::table('smoku_akademik')->join('bk_info_institusi','bk_info_institusi.id_institusi','=','smoku_akademik.id_institusi' )->where('smoku_id', $item['smoku_id'])->value('bk_info_institusi.nama_institusi');

                                                        $nama_pemohon = DB::table('smoku')->where('id', $item['smoku_id'])->value('nama');
                                                        $nokp = DB::table('smoku')->where('id', $item['smoku_id'])->value('no_kp');
                                                        $status = DB::table('bk_status')->where('kod_status', $item['status'])->value('status');
                                                        $user_id = DB::table('sejarah_permohonan')->where('permohonan_id', $item['id'])->where('status', $item['status'])->latest()->value('dilaksanakan_oleh');

                                                        if($user_id==null){
                                                            $user_name = "Tiada Maklumat";
                                                        }
                                                        else{
                                                            $user_name = DB::table('users')->where('id', $user_id)->value('nama');
                                                            $text = ucwords(strtolower($user_name)); // Assuming you're sending the text as a POST parameter
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
                                                            $user_name = implode(' ', $result);
                                                        }

                                                        if ($item['status']==2){
                                                            $status='Baharu';
                                                        }
                                                        if ($item['status']==3){
                                                            $status='Sedang Disaring';
                                                        }

                                                        //nama pemohon
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
                                                        @if ($jenis_institusi!="UA")
                                                        <tr>
                                                            <td>
                                                                @if($item['status']==4 || $item['status']==5)
                                                                    @if($bil_akademik>1)
                                                                        <a href="{{ url('permohonan/sekretariat/saringan/papar-permohonan-diperbaharui/'. $item['id']) }}" title="">{{$item['no_rujukan_permohonan']}}</a>
                                                                    @else
                                                                        <a href="{{ url('permohonan/sekretariat/saringan/papar-permohonan/'. $item['id']) }}" title="">{{$item['no_rujukan_permohonan']}}</a>
                                                                    @endif
                                                                @elseif($item['status']==3 && $user_id==Auth::user()->id)
                                                                    @if($bil_akademik>1)
                                                                        <a href="{{ url('permohonan/sekretariat/saringan/maklumat-permohonan-diperbaharui/'. $item['id']) }}" title="">{{$item['no_rujukan_permohonan']}}</a>
                                                                    @else
                                                                        <a href="{{ url('permohonan/sekretariat/saringan/maklumat-permohonan/'. $item['id']) }}" title="">{{$item['no_rujukan_permohonan']}}</a>
                                                                    @endif
                                                                @elseif($item['status']==3 && $user_id!=Auth::user()->id)
                                                                    {{$item['no_rujukan_permohonan']}}
                                                                @else
                                                                    @if($bil_akademik>1)
                                                                        <a href="{{ url('permohonan/sekretariat/saringan/maklumat-permohonan-diperbaharui/'. $item['id']) }}" title="">{{$item['no_rujukan_permohonan']}}</a>
                                                                    @else
                                                                        <a href="{{ url('permohonan/sekretariat/saringan/maklumat-permohonan/'. $item['id']) }}" title="">{{$item['no_rujukan_permohonan']}}</a>
                                                                    @endif
                                                                @endif
                                                            </td>
                                                            <td>{{$pemohon}}</td>
                                                            <td>{{$institusipengajian}}</td>
                                                            <td class="text-center">{{date('d/m/Y', strtotime($item['tarikh_hantar']))}}</td>
                                                                @if ($item['status']=='2')
                                                                    <td class="text-center"><button class="btn bg-baharu text-white">{{ucwords(strtolower($status))}}</button></td>
                                                                @elseif ($item['status']=='3')
                                                                    <td class="text-center"><button class="btn bg-sedang-disaring text-white">{{ucwords(strtolower($status))}}</button></td>
                                                                @elseif ($item['status']=='4')
                                                                    <td class="text-center"><button class="btn bg-warning text-white">{{ucwords(strtolower($status))}}</button></td>
                                                                @elseif ($item['status']=='5')
                                                                    <td class="text-center"><button class="btn bg-dikembalikan text-white">{{ucwords(strtolower($status))}}</button></td>
                                                                @endif
                                                            <td>{{$user_name}}</td>
                                                        </tr>
                                                        @endif
                                                    @endif
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>

                                {{-- BKOKU UA --}}
                                <div class="tab-pane fade" id="bkokuUA" role="tabpanel" aria-labelledby="bkokuUA-tab">
                                    <br>
                                    <div class="body">
                                        <div class="table-responsive">
                                            <form action="{{ url('permohonan/sekretariat/saringan/senarai-permohonan') }}" method="GET">
                                                <div class="row" style="margin-left: 10px;">
                                                    <div class="col-md-4">
                                                        <select name="institusi" class="form-select js-example-basic-single">
                                                            <option value="">Pilih Institusi Pengajian</option>
                                                            @foreach ($institusiPengajian as $institusi)
                                                                <option value="{{ $institusi->id_institusi }}" {{ Request::get('institusi') == $institusi->id_institusi ? 'selected' : '' }}>{{ $institusi->nama_institusi }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>

                                                    <div class="col-md-3" style="margin-left: 10px; margin-right:150px;">
                                                        <button type="submit" class="btn btn-primary" style="width: 15%; padding-left: 10px;">
                                                            <i class="fa fa-filter" style="font-size: 15px;"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </form>

                                            <table id="sortTable1a" class="table table-striped table-hover dataTable js-exportable">
                                                <thead>
                                                    <tr>
                                                        <th class="text-center" style="width: 12%"><b>ID Permohonan</b></th>
                                                        <th class="text-center" style="width: 30%"><b>Nama</b></th>
                                                        <th class="text-center" style="width: 20%"><b>Institusi Pengajian</b></th>
                                                        <th class="text-center" style="width: 18%"><b>Tarikh Permohonan</b></th>
                                                        <th class="text-center" style="width: 10%"><b>Status Saringan</b></th>
                                                        <th class="text-center" style="width: 10%!important;"><b>Disaring Oleh</b></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                @php
                                                    $i=0;
                                                @endphp
                                                @foreach ($permohonan as $item)
                                                    @if ($item['program']=="BKOKU")
                                                        @php
                                                            $i++;

                                                            $rujukan = explode("/", $item['no_rujukan_permohonan']);
                                                            $peringkat = $rujukan[1];
                                                            $akademik = DB::table('smoku_akademik')->where('smoku_id', $item['smoku_id'])->where('peringkat_pengajian', $peringkat)->first();
                                                            $bil_akademik = DB::table('smoku_akademik')->where('smoku_id', $item['smoku_id'])->count();
                                                            $jenis_institusi = DB::table('bk_info_institusi')->where('id_institusi', $akademik->id_institusi)->value('jenis_institusi');
                                                            $institusi_pengajian = DB::table('smoku_akademik')->join('bk_info_institusi','bk_info_institusi.id_institusi','=','smoku_akademik.id_institusi' )->where('smoku_id', $item['smoku_id'])->value('bk_info_institusi.nama_institusi');

                                                            $nama_pemohon = DB::table('smoku')->where('id', $item['smoku_id'])->value('nama');
                                                            $nokp = DB::table('smoku')->where('id', $item['smoku_id'])->value('no_kp');
                                                            $status = DB::table('bk_status')->where('kod_status', $item['status'])->value('status');
                                                            $user_id = DB::table('sejarah_permohonan')->where('permohonan_id', $item['id'])->where('status', $item['status'])->latest()->value('dilaksanakan_oleh');

                                                            if($user_id==null){
                                                                $user_name = "Tiada Maklumat";
                                                            }
                                                            else{
                                                                $user_name = DB::table('users')->where('id', $user_id)->value('nama');
                                                                $text = ucwords(strtolower($user_name)); // Assuming you're sending the text as a POST parameter
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
                                                                $user_name = implode(' ', $result);
                                                            }

                                                            if ($item['status']==2){
                                                                $status='Baharu';
                                                            }
                                                            if ($item['status']==3){
                                                                $status='Sedang Disaring';
                                                            }

                                                            //nama pemohon
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
                                                        @if ($jenis_institusi=="UA")
                                                            <tr>
                                                                <td style="width: 12%!important;">
                                                                    @if($item['status']==4 || $item['status']==5)
                                                                        @if($bil_akademik>1)
                                                                            <a href="{{ url('permohonan/sekretariat/saringan/papar-permohonan-diperbaharui/'. $item['id']) }}" title="">{{$item['no_rujukan_permohonan']}}</a>
                                                                        @else
                                                                            <a href="{{ url('permohonan/sekretariat/saringan/papar-permohonan/'. $item['id']) }}" title="">{{$item['no_rujukan_permohonan']}}</a>
                                                                        @endif
                                                                    @elseif($item['status']==3 && $user_id==Auth::user()->id)
                                                                        @if($bil_akademik>1)
                                                                            <a href="{{ url('permohonan/sekretariat/saringan/maklumat-permohonan-diperbaharui/'. $item['id']) }}" title="">{{$item['no_rujukan_permohonan']}}</a>
                                                                        @else
                                                                            <a href="{{ url('permohonan/sekretariat/saringan/maklumat-permohonan/'. $item['id']) }}" title="">{{$item['no_rujukan_permohonan']}}</a>
                                                                        @endif
                                                                    @elseif($item['status']==3 && $user_id!=Auth::user()->id)
                                                                        {{$item['no_rujukan_permohonan']}}
                                                                    @else
                                                                        @if($bil_akademik>1)
                                                                            <a href="{{ url('permohonan/sekretariat/saringan/maklumat-permohonan-diperbaharui/'. $item['id']) }}" title="">{{$item['no_rujukan_permohonan']}}</a>
                                                                        @else
                                                                            <a href="{{ url('permohonan/sekretariat/saringan/maklumat-permohonan/'. $item['id']) }}" title="">{{$item['no_rujukan_permohonan']}}</a>
                                                                        @endif
                                                                    @endif
                                                                </td>
                                                                <td style="width: 30%!important">{{$pemohon}}</td>
                                                                <td style="width: 20%!important">{{$institusipengajian}}</td>
                                                                <td class="text-center" style="width: 18%!important;">{{date('d/m/Y', strtotime($item['tarikh_hantar']))}}</td>
                                                                @if ($item['status']=='2')
                                                                    <td class="text-center" style="width: 10%!important;"><button class="btn bg-baharu text-white">{{ucwords(strtolower($status))}}</button></td>
                                                                @elseif ($item['status']=='3')
                                                                    <td class="text-center" style="width: 10%!important;"><button class="btn bg-sedang-disaring text-white">{{ucwords(strtolower($status))}}</button></td>
                                                                @elseif ($item['status']=='4')
                                                                    <td class="text-center" style="width: 10%!important;"><button class="btn bg-warning text-white">{{ucwords(strtolower($status))}}</button></td>
                                                                @elseif ($item['status']=='5')
                                                                    <td class="text-center" style="width: 10%!important;"><button class="btn bg-dikembalikan text-white">{{ucwords(strtolower($status))}}</button></td>
                                                                @endif
                                                                <td style="width: 20%!important">{{$user_name}}</td>
                                                            </tr>
                                                        @endif
                                                    @endif
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>

                                {{-- PPK --}}
                                <div class="tab-pane fade" id="ppk" role="tabpanel" aria-labelledby="ppk-tab">
                                    <br>
                                    <div class="body">
                                        <div class="table-responsive">
                                            <form action="{{ url('permohonan/sekretariat/saringan/senarai-permohonan') }}" method="GET">
                                                <div class="row" style="margin-left: 10px;">
                                                    <div class="col-md-4">
                                                        <select name="institusi" class="form-select js-example-basic-single">
                                                            <option value="">Pilih Institusi Pengajian</option>
                                                            @foreach ($institusiPengajian as $institusi)
                                                                <option value="{{ $institusi->id_institusi }}" {{ Request::get('institusi') == $institusi->id_institusi ? 'selected' : '' }}>{{ $institusi->nama_institusi }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>

                                                    <div class="col-md-3" style="margin-left: 10px; margin-right:150px;">
                                                        <button type="submit" class="btn btn-primary" style="width: 15%; padding-left: 10px;">
                                                            <i class="fa fa-filter" style="font-size: 15px;"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </form>

                                            <table id="sortTable2" class="table table-striped table-hover dataTable js-exportable">
                                                <thead>
                                                    <tr>
                                                        <th class="text-center" style="width: 12%"><b>ID Permohonan</b></th>
                                                        <th class="text-center" style="width: 30%"><b>Nama</b></th>
                                                        <th class="text-center" style="width: 20%"><b>Institusi Pengajian</b></th>
                                                        <th class="text-center" style="width: 18%"><b>Tarikh Permohonan</b></th>
                                                        <th class="text-center" style="width: 10%"><b>Status Saringan</b></th>
                                                        <th class="text-center" style="width: 10%!important;"><b>Disaring Oleh</b></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @php
                                                        $i=0;
                                                    @endphp
                                                    @foreach ($permohonan as $item)
                                                    @if ($item['program']=="PPK")
                                                    @php
                                                        $rujukan = explode("/", $item['no_rujukan_permohonan']);
                                                        $peringkat = $rujukan[1];
                                                        $akademik = DB::table('smoku_akademik')->where('smoku_id', $item['smoku_id'])->where('peringkat_pengajian', $peringkat)->first();
                                                        $bil_akademik = DB::table('smoku_akademik')->where('smoku_id', $item['smoku_id'])->count();
                                                        $jenis_institusi = DB::table('bk_info_institusi')->where('id_institusi', $akademik->id_institusi)->value('jenis_institusi');
                                                        $institusi_pengajian = DB::table('smoku_akademik')->join('bk_info_institusi','bk_info_institusi.id_institusi','=','smoku_akademik.id_institusi' )->where('smoku_id', $item['smoku_id'])->value('bk_info_institusi.nama_institusi');

                                                        $nama_pemohon = DB::table('smoku')->where('id', $item['smoku_id'])->value('nama');
                                                        $nokp = DB::table('smoku')->where('id', $item['smoku_id'])->value('no_kp');
                                                        $status = DB::table('bk_status')->where('kod_status', $item['status'])->value('status');
                                                        $user_id = DB::table('sejarah_permohonan')->where('permohonan_id', $item['id'])->where('status', $item['status'])->latest()->value('dilaksanakan_oleh');

                                                        if($user_id==null){
                                                            $user_name = "Tiada Maklumat";
                                                        }
                                                        else{
                                                            $user_name = DB::table('users')->where('id', $user_id)->value('nama');
                                                            $text = ucwords(strtolower($user_name)); // Assuming you're sending the text as a POST parameter
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
                                                            $user_name = implode(' ', $result);
                                                        }

                                                        if ($item['status']==2){
                                                            $status='Baharu';
                                                        }
                                                        if ($item['status']==3){
                                                            $status='Sedang Disaring';
                                                        }

                                                        //nama pemohon
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
                                                    <tr>
                                                        <td style="width: 12%!important;">
                                                            @if($item['status']==4 || $item['status']==5)
                                                                @if($bil_akademik>1)
                                                                    <a href="{{ url('permohonan/sekretariat/saringan/papar-permohonan-diperbaharui/'. $item['id']) }}" title="">{{$item['no_rujukan_permohonan']}}</a>
                                                                @else
                                                                    <a href="{{ url('permohonan/sekretariat/saringan/papar-permohonan/'. $item['id']) }}" title="">{{$item['no_rujukan_permohonan']}}</a>
                                                                @endif
                                                            @elseif($item['status']==3 && $user_id==Auth::user()->id)
                                                                @if($bil_akademik>1)
                                                                    <a href="{{ url('permohonan/sekretariat/saringan/maklumat-permohonan-diperbaharui/'. $item['id']) }}" title="">{{$item['no_rujukan_permohonan']}}</a>
                                                                @else
                                                                    <a href="{{ url('permohonan/sekretariat/saringan/maklumat-permohonan/'. $item['id']) }}" title="">{{$item['no_rujukan_permohonan']}}</a>
                                                                @endif
                                                            @elseif($item['status']==3 && $user_id!=Auth::user()->id)
                                                                {{$item['no_rujukan_permohonan']}}
                                                            @else
                                                                @if($bil_akademik>1)
                                                                    <a href="{{ url('permohonan/sekretariat/saringan/maklumat-permohonan-diperbaharui/'. $item['id']) }}" title="">{{$item['no_rujukan_permohonan']}}</a>
                                                                @else
                                                                    <a href="{{ url('permohonan/sekretariat/saringan/maklumat-permohonan/'. $item['id']) }}" title="">{{$item['no_rujukan_permohonan']}}</a>
                                                                @endif
                                                            @endif
                                                        </td>
                                                        <td style="width: 30%!important">{{$pemohon}}</td>
                                                        <td style="width: 20%!important">{{$institusipengajian}}</td>
                                                        <td class="text-center" style="width: 18%!important;">{{date('d/m/Y', strtotime($item['tarikh_hantar']))}}</td>
                                                            @if ($item['status']=='2')
                                                                <td class="text-center" style="width: 10%!important;"><button class="btn bg-baharu text-white">{{ucwords(strtolower($status))}}</button></td>
                                                            @elseif ($item['status']=='3')
                                                                <td class="text-center" style="width: 10%!important;"><button class="btn bg-sedang-disaring text-white">{{ucwords(strtolower($status))}}</button></td>
                                                            @elseif ($item['status']=='4')
                                                                <td class="text-center" style="width: 10%!important;"><button class="btn bg-warning text-white">{{ucwords(strtolower($status))}}</button></td>
                                                            @elseif ($item['status']=='5')
                                                                <td class="text-center" style="width: 10%!important;"><button class="btn bg-dikembalikan text-white">{{ucwords(strtolower($status))}}</button></td>
                                                            @endif
                                                        <td style="width: 20%!important">{{$user_name}}</td>
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

            $(document).ready(function() {
                    $('.js-example-basic-single').select2();
                });
        </script>
    </body>
</x-default-layout>

<x-default-layout>
    <head>
    <title>Sekretariat BKOKU KPT | Saringan Tuntutan</title>
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
    @if($status_kod == 1)
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
                            <h2>Senarai Saringan Tuntutan<br><small>Klik ID Permohonan untuk melakukan saringan selanjutnya</small></h2>
                        </div>
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active" id="bkoku-tab" data-toggle="tab" data-target="#bkoku" type="button" role="tab" aria-controls="bkoku" aria-selected="true">BKOKU</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="ppk-tab" data-toggle="tab" data-target="#ppk" type="button" role="tab" aria-controls="ppk" aria-selected="false">PPK</button>
                                </li>
                            </ul>
                            <div class="tab-content" id="myTabContent">
                                <div class="tab-pane fade show active" id="bkoku" role="tabpanel" aria-labelledby="bkoku-tab">
                                    <div class="body">
                                    <div class="table-responsive">
                                        <br>
                                        <table id="sortTable1" class="table table-striped table-hover dataTable js-exportable">
                                            <thead>
                                                <tr>
                                                    <th style="width: 17%"><b>ID Tuntutan</b></th>
                                                    <th><b>Nama</b></th>
                                                    <th style="width: 15%" class="text-center"><b>Tarikh Tuntutan</b></th>
                                                    <th style="width: 15%" class="text-center"><b>Status Saringan</b></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($permohonan as $item)
                                                @php
                                                    $nama_pemohon = DB::table('pelajar')->where('nokp_pelajar', $item['nokp_pelajar'])->value('nama_pelajar');
                                                    $nokp = DB::table('pelajar')->where('nokp_pelajar', $item['nokp_pelajar'])->value('nokp_pelajar');
                                                    $status = DB::table('statusinfo')->where('kodstatus', $item['status'])->value('status');
                                                    if ($item['status']==2){
                                                        $status='Baharu';
                                                    }
                                                    if ($item['status']==3){
                                                        $status='Sedang Disaring';
                                                    }
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
                                                @endphp
                                                @if($item['program']=="BKOKU")
                                                    <tr>
                                                        <td><a href="{{ url('tuntutan/sekretariat/saringan/maklumat-tuntutan-kedua/'. $nokp) }}" title="">{{$item['id_permohonan']}}</a></td>
                                                        {{-- <td><a href="{{ url('tuntutan-telah-disaring/'.$item['nokp_pelajar']) }}" title="">{{$item['id_permohonan']}}</a></td> --}}
                                                        <td>{{$pemohon}}</td>
                                                        <td class="text-center">{{$item['created_at']->format('d/m/Y')}}</td>
                                                        @if ($item['status']=='2')
                                                        <td class="text-center"><button class="btn bg-baharu text-white">{{ucwords(strtolower($status))}}</button></td>
                                                        @elseif ($item['status']=='3')
                                                            <td class="text-center"><button class="btn bg-sedang-disaring text-white">{{ucwords(strtolower($status))}}</button></td>
                                                        @elseif ($item['status']=='4')
                                                            <td class="text-center"><button class="btn bg-warning text-white">{{ucwords(strtolower($status))}}</button></td>
                                                        @elseif ($item['status']=='5')
                                                            <td class="text-center"><button class="btn bg-dikembalikan text-white">{{ucwords(strtolower($status))}}</button></td>
                                                        @endif
                                                    </tr>
                                                @endif
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="ppk" role="tabpanel" aria-labelledby="ppk-tab">
                                    <div class="body">
                                    <div class="table-responsive">
                                        <br>
                                        <table id="sortTable2" class="table table-striped table-hover dataTable js-exportable">
                                            <thead>
                                                <tr>
                                                    <th style="width: 17%"><b>ID Tuntutan</b></th>
                                                    <th><b>Nama</b></th>
                                                    <th style="width: 15%" class="text-center"><b>Tarikh Tuntutan</b></th>
                                                    <th style="width: 15%" class="text-center"><b>Status Saringan</b></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($permohonan as $item)
                                                @php
                                                    $nama_pemohon = DB::table('pelajar')->where('nokp_pelajar', $item['nokp_pelajar'])->value('nama_pelajar');
                                                    $nokp = DB::table('pelajar')->where('nokp_pelajar', $item['nokp_pelajar'])->value('nokp_pelajar');
                                                    $status = DB::table('statusinfo')->where('kodstatus', $item['status'])->value('status');
                                                    if ($item['status']==2){
                                                        $status='Baharu';
                                                    }
                                                    if ($item['status']==3){
                                                        $status='Sedang Disaring';
                                                    }
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
                                                @endphp
                                                @if($item['program']=="PPK")
                                                    <tr>
                                                        <td><a href="{{ url('tuntutan/sekretariat/saringan/maklumat-tuntutan-kedua/'. $nokp) }}" title="">{{$item['id_permohonan']}}</a></td>
                                                        {{-- <td><a href="{{ url('tuntutan-telah-disaring/'.$item['nokp_pelajar']) }}" title="">{{$item['id_permohonan']}}</a></td> --}}
                                                        <td>{{$pemohon}}</td>
                                                        <td class="text-center">{{$item['created_at']->format('d/m/Y')}}</td>
                                                        @if ($item['status']=='2')
                                                        <td class="text-center"><button class="btn bg-baharu text-white">{{ucwords(strtolower($status))}}</button></td>
                                                        @elseif ($item['status']=='3')
                                                            <td class="text-center"><button class="btn bg-sedang-disaring text-white">{{ucwords(strtolower($status))}}</button></td>
                                                        @elseif ($item['status']=='4')
                                                            <td class="text-center"><button class="btn bg-warning text-white">{{ucwords(strtolower($status))}}</button></td>
                                                        @elseif ($item['status']=='5')
                                                            <td class="text-center"><button class="btn bg-dikembalikan text-white">{{ucwords(strtolower($status))}}</button></td>
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
        $('#sortTable1').DataTable();
        $('#sortTable2').DataTable();
    </script>

    </body>
</x-default-layout>

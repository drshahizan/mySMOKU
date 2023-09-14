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
			<li class="breadcrumb-item text-dark" style="color:darkblue">Keputusan</li>
			<!--end::Item-->
		</ul>
	<!--end::Breadcrumb-->
	</div>
	<!--end::Page title-->
    <br>

    <body>
        @if($notifikasi!=NULL)
            <div class="alert alert-success" role="alert" style="margin: 0px 15px 20px 15px; color:black!important;">
                {{ $notifikasi }}
            </div>
        @endif
        <!-- Main body part  -->
        <div id="main-content">
            <div class="container-fluid">
                <div class="block-header">
                    <div class="row clearfix">
                        <div class="card">
                            <div class="header">
                                <h2>Senarai Keputusan Permohonan</h2>
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
                                    <br><br>
                                    <form action="" method="GET">
                                        <div class="row" style="margin-left:15px;">
                                            <div class="col-md-3">
                                                <input type="date" name="date" value="{{Request::get('date')?? ' '}}" class="form-control"/>
                                            </div>
            
                                            <div class="col-md-3">
                                                <select name="status" class="form-select">
                                                    <option value="">Pilih Semua Keputusan</option>
                                                    <option value="6" {{Request::get('status') == '5' ? 'selected':'' }} >Dikembalikan</option>
                                                    <option value="6" {{Request::get('status') == '6' ? 'selected':'' }} >Layak</option>
                                                    <option value="7" {{Request::get('status') == '7' ? 'selected':'' }} >Tidak Layak</option>
                                                </select>
                                            </div>

                                            <div class="col-md-4 right">
                                                <button type="submit" class="btn btn-primary" style="width: 10%; padding-left:10px;"><i class="fa fa-filter" style="font-size: 15px;"></i></button>
                                            </div>
                                        </div>
                                    </form>
                
                                    <div class="body">
                                        <div class="table-responsive" id="table-responsive">
                                            <table id="sortTable1" class="table table-bordered table-striped">
                                                <thead>
                                                    <tr style="color: white; background-color:rgb(35, 58, 108);">
                                                        <th style="width: 15%"><b>ID Permohonan</b></th>                                        
                                                        <th style="width: 45%"><b>Nama</b></th>
                                                        <th style="width: 10%" class="text-center"><b>No. Mesyuarat</b></th>
                                                        <th style="width: 15%" class="text-center"><b>Tarikh Kemaskini Keputusan</b></th> 
                                                        <th class="text-center" style="width: 15%">Status Permohonan</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($permohonan as $item)
                                                    @if($item['program']=="BKOKU")
                                                        @if($item['status']=="5" || $item['status']=="6" || $item['status']=="7")
                                                            @php
                                                                $id_permohonan = DB::table('permohonan')->where('id_permohonan', $item['id_permohonan'])->value('id_permohonan');
                                                                $kelulusan = DB::table('permohonan')->where('id_permohonan', $item['id_permohonan'])->value('id');
                                                                $no_mesyuarat = DB::table('permohonan_kelulusan')->where('id_permohonan', $kelulusan)->value('no_mesyuarat');
                                                                $nama = DB::table('pelajar')->where('nokp_pelajar', $item['nokp_pelajar'])->value('nama_pelajar');
                                                                $tarikh = DB::table('permohonan_kelulusan')->where('id_permohonan', $kelulusan)->value('tarikh_mesyuarat');
                                                                $status = DB::table('statusinfo')->where('kodstatus', $item['status'])->value('status');

                                                                $text = ucwords(strtolower($nama)); // Assuming you're sending the text as a POST parameter
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
                                                                //dd($no_mesyuarat);
                                                            @endphp
                                                            <tr>
                                                                <td>{{$id_permohonan}}</td>
                                                                <td>{{$pemohon}}</td>
                                                                <td class="text-center">{{$no_mesyuarat}}</td>
                                                                <td class="text-center">{{date('d/m/Y', strtotime($tarikh))}}</td>
                                                                @if($item['status'] == "6")
                                                                    <td class="text-center"><button type="button" class="btn btn-success btn-sm">{{ucwords(strtolower($status))}}</button></td>
                                                                @elseif ($item['status']=="5")
                                                                    <td class="text-center"><button type="button" class="btn btn-sm text-white" style="background-color: #d75b50">{{ucwords(strtolower($status))}}</button></td>
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

                                {{-- PKK --}}
                                <div class="tab-pane fade" id="ppk" role="tabpanel" aria-labelledby="ppk-tab">
                                    <br><br>
                                    <form action="" method="GET">
                                        <div class="row" style="margin-left:15px;">
                                            <div class="col-md-3">
                                                <input type="date" name="date" value="{{Request::get('date')?? ' '}}" class="form-control"/>
                                            </div>
            
                                            <div class="col-md-3">
                                                <select name="status" class="form-select">
                                                    <option value="">Pilih Semua Keputusan</option>
                                                    <option value="6" {{Request::get('status') == '6' ? 'selected':'' }} >Layak</option>
                                                    <option value="7" {{Request::get('status') == '7' ? 'selected':'' }} >Tidak Layak</option>
                                                </select>
                                            </div>

                                            <div class="col-md-4 right">
                                                <button type="submit" class="btn btn-primary" style="width: 10%; padding-left:10px;"><i class="fa fa-filter" style="font-size: 15px;"></i></button>
                                            </div>
                                        </div>
                                    </form>
                
                                    <div class="body">
                                        <div class="table-responsive">
                                            <table id="sortTable2" class="table table-bordered table-striped">
                                                <thead>
                                                    <tr style="color: white; background-color:rgb(35, 58, 108);">
                                                        <th style="width: 15%"><b>ID Permohonan</b></th>                                        
                                                        <th style="width: 45%"><b>Nama</b></th>
                                                        <th style="width: 10%" class="text-center"><b>No. Mesyuarat</b></th>
                                                        <th style="width: 15%" class="text-center"><b>Tarikh Kemaskini Keputusan</b></th> 
                                                        <th class="text-center" style="width: 15%">Status Permohonan</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($permohonan as $item)
                                                    @if($item['program']=="PPK")
                                                        @if($item['status']=="6" || $item['status']=="7")
                                                            @php
                                                                $id_permohonan = DB::table('permohonan')->where('id_permohonan', $item['id_permohonan'])->value('id_permohonan');
                                                                $program = DB::table('permohonan')->where('id_permohonan', $item['id_permohonan'])->value('program');
                                                                $nama = DB::table('pelajar')->where('nokp_pelajar', $item['nokp_pelajar'])->value('nama_pelajar');
                                                                $status = DB::table('statusinfo')->where('kodstatus', $item['status'])->value('status');
                                                                $text = ucwords(strtolower($nama)); // Assuming you're sending the text as a POST parameter
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
                                                                <td>{{$id_permohonan}}</td>
                                                                <td>{{$pemohon}}</td>
                                                                <td class="text-center">AM1234</td>
                                                                <td class="text-center">{{$item['created_at']->format('d/m/Y')}}</td>
                                                                @if($item['status'] == "6")
                                                                    <td class="text-center"><button type="button" class="btn btn-success btn-sm">{{ucwords(strtolower($status))}}</button></td>
                                                                @elseif ($item['status']=="5")
                                                                    <td class="text-center"><button type="button" class="btn btn-warning">{{ucwords(strtolower($status))}}</button></td>
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
             $('#sortTable1').DataTable();
            $('#sortTable2').DataTable();
        </script>
        
        <!-- Vedor js file and create bundle with grunt  --> 
        <script src="assets/bundles/flotscripts.bundle.js"></script><!-- flot charts Plugin Js -->
        <script src="assets/bundles/c3.bundle.js"></script>
        <script src="assets/bundles/apexcharts.bundle.js"></script>
        <script src="assets/bundles/jvectormap.bundle.js"></script>
        <script src="assets/vendor/toastr/toastr.js"></script>
        
        <!-- Project core js file minify with grunt --> 
        <script src="assets/bundles/mainscripts.bundle.js"></script>
        <script src="../js/index.js"></script>
        
        <!-- Vedor js file and create bundle with grunt  --> 
        <script src="assets/bundles/morrisscripts.bundle.js"></script><!-- Morris Plugin Js -->
        
        <!-- Vedor js file and create bundle with grunt  -->    
        <script src="assets/bundles/datatablescripts.bundle.js"></script>
        <script src="assets/vendor/jquery-datatable/buttons/dataTables.buttons.min.js"></script>
        <script src="assets/vendor/jquery-datatable/buttons/buttons.bootstrap4.min.js"></script>
        <script src="assets/vendor/jquery-datatable/buttons/buttons.colVis.min.js"></script>
        <script src="assets/vendor/jquery-datatable/buttons/buttons.html5.min.js"></script>
        <script src="assets/vendor/jquery-datatable/buttons/buttons.print.min.js"></script>
        <script src="assets/vendor/sweetalert/sweetalert.min.js"></script>

        <!-- SweetAlert Plugin Js --> 
        <script src="../js/pages/forms/form-wizard.js"></script>
        <script src="../js/pages/tables/jquery-datatable.js"></script>
        <script src="../js/pages/charts/morris.js"></script>
        <script src="../js/pages/charts/c3.js"></script>
</x-default-layout> 
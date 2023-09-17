<x-default-layout>
    <head>
        <title>Sekretariat BKOKU KPT</title>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">

        <!-- MAIN CSS -->
        <link rel="stylesheet" href="/assets/css/sekretariat.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js"></script>
    </head>

    <body>
        <!--begin::Page title-->
	    <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
		<!--begin::Title-->
		<h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Laman Utama</h1>
		<!--end::Title-->
		<!--begin::Breadcrumb-->
		<ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
			<!--begin::Item-->
			<li class="breadcrumb-item text-dark" style="color:darkblue">Laman Utama</li>
			<!--end::Item-->
			<!--begin::Item-->
			<li class="breadcrumb-item">
				<span class="bullet bg-gray-400 w-5px h-2px"></span>
			</li>
			<!--end::Item-->
			<!--begin::Item-->
			<li class="breadcrumb-item text-dark" style="color:darkblue">Senarai</li>
			<!--end::Item-->
		</ul>
        <!--end::Breadcrumb-->
        </div>
        <!--end::Page title-->

        <br>

        <!-- Main body part  -->
        <div id="main-content">
            <div class="container-fluid">
                <div class="block-header">
                    <div class="row clearfix">
                        <div class="card">
                            <div class="header">
                                <h2>Senarai Permohonan PPK</h2>
                            </div>

                            {{-- Filter section --}}
                            <form action="" method="GET">
                                <div class="row" style="margin-left:15px;">
                                    <div class="col-md-2">
                                        <input type="date" name="date" value="{{Request::get('date')?? ' '}}" class="form-control"/>
                                    </div>
    
                                    {{-- <div class="col-md-3">
                                        <select name="status" class="form-select">
                                            <option value="">Semua Status Permohonan</option>
                                            <option value="1" {{Request::get('status') == '1' ? 'selected':'' }} >Deraf</option>
                                            <option value="2" {{Request::get('status') == '2' ? 'selected':'' }} >Baharu</option>
                                            <option value="3" {{Request::get('status') == '3' ? 'selected':'' }} >Saringan</option>
                                            <option value="4" {{Request::get('status') == '4' ? 'selected':'' }} >Disokong</option>
                                            <option value="5" {{Request::get('status') == '5' ? 'selected':'' }} >Dikembalikan</option>
                                            <option value="6" {{Request::get('status') == '6' ? 'selected':'' }} >Layak</option>
                                            <option value="7" {{Request::get('status') == '7' ? 'selected':'' }} >Tidak Layak</option>
                                        </select>
                                    </div> --}}

                                    <div class="col-md-4 right">
                                        <button type="submit" class="btn btn-primary" style="width: 10%; padding-left:10px;"><i class="fa fa-filter" style="font-size: 15px;"></i></button>
                                    </div>
                                </div>
                            </form>

                            <div class="table-responsive">
                                <div class="body">      
                                    <table id="sortTable" class="table table-bordered table-striped">
                                        <thead>
                                            <tr style="color: white; background-color:rgb(35, 58, 108);">
                                                <th style="width: 15%"><b>ID Permohonan</b></th>                                        
                                                <th style="width: 45%"><b>Nama</b></th>
                                                <th style="width: 13%" class="text-center"><b>Tarikh Permohonan</b></th> 
                                                <th class="text-center" style="width: 15%">Status Permohonan</th>
                                            </tr>
                                        </thead>
                                        
                                        <tbody>
                                            @foreach ($keseluruhan as $item)
                                                @php
                                                    $id_permohonan = DB::table('permohonan')->where('id_permohonan', $item['id_permohonan'])->value('id_permohonan');
                                                    $program = DB::table('permohonan')->where('id_permohonan', $item['id_permohonan'])->value('program');
                                                    $nama = DB::table('pelajar')->where('nokp_pelajar', $item['nokp_pelajar'])->value('nama_pelajar');
                                                    $status = DB::table('statusinfo')->where('kodstatus', $item['status'])->value('status');

                                                    // nama pemohon
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

                                                @if($item['program']=="PPK")
                                                    <tr>
                                                        <td>{{$id_permohonan}}</td>
                                                        <td>{{$pemohon}}</td>
                                                        <td class="text-center">{{$item['created_at']->format('d/m/Y')}}</td>
                                                        @if($item['status'] == "1")
                                                            <td class="text-center"><button type="button" class="btn btn-info text-white">{{ucwords(strtolower($status))}}</button></td>
                                                        @elseif($item['status'] == "2")
                                                            <td class="text-center"><button type="button" class="btn btn-primary text-white">Baharu</button></td>
                                                        @elseif($item['status'] == "3")
                                                            <td class="text-center"><button type="button" class="btn bg-sedang-disaring text-white">{{ucwords(strtolower($status))}}</button></td>
                                                        @elseif($item['status'] == "4")
                                                            <td class="text-center"><button type="button" class="btn bg-warning text-white">{{ucwords(strtolower($status))}}</button></td>
                                                        @elseif($item['status'] == "5")
                                                            <td class="text-center"><button type="button" class="btn bg-dikembalikan text-white">{{ucwords(strtolower($status))}}</button></td>
                                                        @elseif($item['status'] == "6")
                                                            <td class="text-center"><button type="button" class="btn btn-success text-white">{{ucwords(strtolower($status))}}</button></td>
                                                        @elseif($item['status'] == "7")
                                                            <td class="text-center"><button type="button" class="btn btn-danger text-white">{{ucwords(strtolower($status))}}</button></td>
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

        
        <!-- Javascript -->
        <script src="assets/bundles/libscripts.bundle.js"></script>    
        <script src="assets/bundles/vendorscripts.bundle.js"></script>

        <script>
            $('#sortTable').DataTable();
        </script>

        <script>
            $('button[data-toggle="tab"]').on('#nav-home', function (event) {
                event.target // newly activated tab
                event.relatedTarget // previous active tab
            })
            $('button[data-toggle="tab"]').on('#nav-profile', function (event) {
                event.target // newly activated tab
                event.relatedTarget // previous active tab
            })
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


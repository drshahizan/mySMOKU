<x-default-layout>
    <head>
        <title>Sekretariat BKOKU KPT</title>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">

        <!-- MAIN CSS -->
        <link rel="stylesheet" href="assets/css/sekretariat.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js"></script>
    </head>

    <body>
        <!-- Main body part  -->
        <div id="main-content">
            <div class="container-fluid">
                {{-- Table section --}}
                <div class="row clearfix">
                    <!-- Page header2 section  -->
                    <div class="block-header">
                        <div class="row clearfix">
                            <div class="col-lg-4 col-md-12 col-sm-12">
                                <h1>Senarai Permohonan</h1>
                            </div>
                            <hr>
                        </div>
                    </div>

                    {{-- Javascript Nav Bar --}}
                    {{-- <nav>
                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                          <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">BKOKU</a>
                          <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">PPK</a>
                        </div>
                    </nav> --}}
                    <nav>
                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                          <button class="nav-link active" id="nav-home-tab" data-toggle="tab" data-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true"><b>BKOKU</b></button>
                          <button class="nav-link" id="nav-profile-tab" data-toggle="tab" data-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false"><b>PPK</b></button>
                        </div>
                    </nav>
                    {{-- Content Navigation Bar --}}
                    <div class="tab-content" id="nav-tabContent">
                        {{-- BKOKU --}}
                        <div class="tab-pane fade show active" id="nav-home" role="tabpanel" data-target="#nav-home" aria-labelledby="nav-home-tab">
                            <br><br>
                            {{-- Filter section --}}
                            <form action="" method="GET">
                                <div class="row">
                                    <div class="col-md-4">
                                        <select name="status" class="form-select">
                                            <option value="">Semua Status Permohonan</option>
                                            <option value="2" {{Request::get('status') == '2' ? 'selected':'' }} >Baru</option>
                                            <option value="3" {{Request::get('status') == '3' ? 'selected':'' }} >Saringan</option>
                                            <option value="4" {{Request::get('status') == '4' ? 'selected':'' }} >Disokong</option>
                                            <option value="5" {{Request::get('status') == '5' ? 'selected':'' }} >Dikembalikan</option>
                                            <option value="6" {{Request::get('status') == '6' ? 'selected':'' }} >Layak</option>
                                            <option value="7" {{Request::get('status') == '7' ? 'selected':'' }} >Tidak Layak</option>
                                        </select>
                                    </div>

                                    {{-- <div class="col-md-4 right">
                                        <button type="submit" class="btn btn-primary" style="width: 10%; padding-left:7px;"><i class="fa fa-filter" style="font-size: 15px;"></i></button>
                                    </div> --}}
                                </div>
                            </form>

                            {{-- Table senarai --}}
                            <div class="row clearfix">
                                <div class="col-lg-12">
                                <div class="table-responsive">
                                    <div class="body">      
                                        <table id="sortTable" class="table table-bordered table-striped">
                                            <thead>
                                                <tr style="color: white; background-color:rgb(35, 58, 108);">
                                                    <th style="width: 15%"><b>ID Permohonan</b></th>                                        
                                                    <th style="width: 45%"><b>Nama</b></th>
                                                    <th style="width: 12%" class="text-center"><b>Jenis Permohonan</b></th>
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
                                                @endphp
                                                <tr>
                                                    <td>{{$id_permohonan}}</td>
                                                    <td>{{$nama}}</td>
                                                    <td>{{$program}}</td>
                                                    <td class="text-center">{{$item['created_at']->format('d/m/Y')}}</td>
                                                    @if($item['status'] == "1")
                                                        <td class="text-center"><button type="button" class="btn btn-primary btn-sm">{{ucwords(strtolower($status))}}</button></td>
                                                    @elseif($item['status'] == "2")
                                                        <td class="text-center"><button type="button" class="btn btn-info btn-sm">Baru</button></td>
                                                    @elseif($item['status'] == "3")
                                                        <td class="text-center"><button type="button" class="btn btn-sm" style="background-color:coral; color:white;">{{ucwords(strtolower($status))}}</button></td>
                                                    @elseif($item['status'] == "4")
                                                        <td class="text-center"><button type="button" class="btn btn-sm" style="background-color:cornflowerblue; color:white;">{{ucwords(strtolower($status))}}</button></td>
                                                    @elseif($item['status'] == "5")
                                                        <td class="text-center"><button type="button" class="btn btn-warning btn-sm">{{ucwords(strtolower($status))}}</button></td>
                                                    @elseif($item['status'] == "6")
                                                        <td class="text-center"><button type="button" class="btn btn-success btn-sm">{{ucwords(strtolower($status))}}</button></td>
                                                    @elseif($item['status'] == "7")
                                                        <td class="text-center"><button type="button" class="btn btn-danger btn-sm">{{ucwords(strtolower($status))}}</button></td>
                                                    @endif
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- PKK --}}
                        <div class="tab-pane fade" id="nav-profile" role="tabpanel" data-target="#nav-profile" aria-labelledby="nav-profile-tab">
                            {{-- Filter section --}}
                            <form action="" method="GET">
                                <div class="row">
                                    <div class="col-md-4">
                                        <select name="status" class="form-select">
                                            <option value="">Semua Status Permohonan</option>
                                            <option value="2" {{Request::get('status') == '2' ? 'selected':'' }} >Baru</option>
                                            <option value="3" {{Request::get('status') == '3' ? 'selected':'' }} >Saringan</option>
                                            <option value="4" {{Request::get('status') == '4' ? 'selected':'' }} >Disokong</option>
                                            <option value="5" {{Request::get('status') == '5' ? 'selected':'' }} >Dikembalikan</option>
                                            <option value="6" {{Request::get('status') == '6' ? 'selected':'' }} >Layak</option>
                                            <option value="7" {{Request::get('status') == '7' ? 'selected':'' }} >Tidak Layak</option>
                                        </select>
                                    </div>
                                </div>
                            </form>

                            <br>

                            {{-- Table senarai --}}
                            <div class="row clearfix">
                                <div class="col-lg-12">
                                <div class="table-responsive">
                                    <div class="body">      
                                        <table id="sortTable" class="table table-bordered table-striped">
                                            <thead>
                                                <tr style="color: white; background-color:rgb(35, 58, 108);">
                                                    <th style="width: 15%"><b>ID Permohonan</b></th>                                        
                                                    <th style="width: 45%"><b>Nama</b></th>
                                                    <th style="width: 12%" class="text-center"><b>Jenis Permohonan</b></th>
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
                                                @endphp
                                                <tr>
                                                    <td>{{$id_permohonan}}</td>
                                                    <td>{{$nama}}</td>
                                                    <td>{{$program}}</td>
                                                    <td class="text-center">{{$item['created_at']->format('d/m/Y')}}</td>
                                                    @if($item['status'] == "1")
                                                        <td class="text-center"><button type="button" class="btn btn-primary btn-sm">{{ucwords(strtolower($status))}}</button></td>
                                                    @elseif($item['status'] == "2")
                                                        <td class="text-center"><button type="button" class="btn btn-info btn-sm">Baru</button></td>
                                                    @elseif($item['status'] == "3")
                                                        <td class="text-center"><button type="button" class="btn btn-sm" style="background-color:coral; color:white;">{{ucwords(strtolower($status))}}</button></td>
                                                    @elseif($item['status'] == "4")
                                                        <td class="text-center"><button type="button" class="btn btn-sm" style="background-color:cornflowerblue; color:white;">{{ucwords(strtolower($status))}}</button></td>
                                                    @elseif($item['status'] == "5")
                                                        <td class="text-center"><button type="button" class="btn btn-warning btn-sm">{{ucwords(strtolower($status))}}</button></td>
                                                    @elseif($item['status'] == "6")
                                                        <td class="text-center"><button type="button" class="btn btn-success btn-sm">{{ucwords(strtolower($status))}}</button></td>
                                                    @elseif($item['status'] == "7")
                                                        <td class="text-center"><button type="button" class="btn btn-danger btn-sm">{{ucwords(strtolower($status))}}</button></td>
                                                    @endif
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
            $('#sortTable').DataTable();
        </script>

        <script>
            // $('#myTab button[data-target="#nav-home"]').tab('show') // Select tab by name
            // $('#myTab button[data-target="#nav-profile"]').tab('show') // Select tab by name

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


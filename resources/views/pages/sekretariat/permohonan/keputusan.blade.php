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
                <div class="block-header">
                    <div class="row clearfix">
                        <div class="col-lg-6 col-md-12 col-sm-12">
                            <h1>Keputusan Permohonan BKOKU dan PPK</h1>
                        </div>
                        <hr>

                        {{-- Card Tile --}}
                        <div class="col-lg-4 col-md-8">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <div class="icon-in-bg bg-success text-white rounded-circle" style="padding-left:0;"><i class="fa fa-check"></i></div>
                                        <div class="ml-4">
                                            <span style="color: black;">Permohonan Layak</span>
                                            <h4 class="mb-0 font-weight-medium">3700</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-8">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <div class="icon-in-bg bg-danger rounded-circle" style="padding-left:0;"><i class="fa fa-close" style="color: white"></i></div>
                                        <div class="ml-4">
                                            <span style="color: black;">Permohonan Tidak Layak</span>
                                            <h4 class="mb-0 font-weight-medium">200</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-8">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <div class="icon-in-bg bg-warning rounded-circle" style="padding-left:0;"><i class="fa fa-mail-reply" style="color: white"></i></div>
                                        <div class="ml-4">
                                            <span style="color: black;">Permohonan Dikembalikan</span>
                                            <h4 class="mb-0 font-weight-medium">1200</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- End of Card Tile --}}
                            
                        <div class="card-body">
                            <form action="" method="GET">
                                <div class="row">
                                    <div class="col-md-2">
                                        {{-- <label style="color:black">Tapis mengikut Tarikh</label> --}}
                                        <input type="date" name="date" value="{{Request::get('date')?? ' '}}" class="form-control"/>
                                    </div>
    
                                    <div class="col-md-2">
                                        {{-- <label style="color:black">Tapis mengikut Keputusan</label> --}}
                                        <select name="status" class="form-select">
                                            <option value="">Pilih Keputusan</option>
                                            <option value="Layak" {{Request::get('status') == 'Layak' ? 'selected':'' }} >Layak</option>
                                            <option value="Dikembalikan" {{Request::get('status') == 'Dikembalikan' ? 'selected':'' }} >Dikembalikan</option>
                                            <option value="Tidak Layak" {{Request::get('status') == 'Tidak Layak' ? 'selected':'' }} >Tidak Layak</option>
                                        </select>
                                    </div>
    
                                    <div class="col-md-6">
                                        <button type="submit" class="btn btn-primary" style="width: 10%;"><i class="fa fa-filter" style="font-size: 15px;"></i></button>
                                    </div>
                                </div>
                            </form>
    
                            <div class="body">
                                <div class="table-responsive">
                                    <table id="sortTable" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th style="width: 15%">ID Permohonan</th>
                                                <th style="width: 40%">Nama</th>
                                                <th style="width: 15%">Jenis Permohonan</th>
                                                <th style="width: 15%" class="text-center">Tarikh Kelulusan</th>
                                                <th style="width: 15%" class="text-center">Keputusan Permohonan</th>
                                            </tr>
                                        </thead>
                                            
                                        <tbody> 
                                            <tr>
                                                <td><a href="{{ url('maklumat-keputusan') }}" target="_blank">KPT/BKOKU/D/020223015001</a></td> 
                                                <td>Ali Bin Abu</td> 
                                                <td>BKOKU</td>
                                                <td class="text-center">21/07/2023</td>
                                                <td class="text-center"><button type="button" class="btn btn-success btn-sm"> Layak</button></td>
                                            </tr>

                                            <tr>
                                                <td><a href="{{ url('maklumat-keputusan') }}" target="_blank">KPT/PPK/B/011221038712</a></td> 
                                                <td>Arina Binti Saleh</td>
                                                <td>PPK</td> 
                                                <td class="text-center">04/06/2023</td>
                                                <td class="text-center"><button type="button" class="btn btn-success btn-sm"> Layak</button></td>
                                            </tr>

                                            <tr>
                                                <td><a href="{{ url('maklumat-keputusan') }}" target="_blank">KPT/BKOKU/M/011221034612</a></td> 
                                                <td>Choo Mei Ling</td> 
                                                <td>BKOKU</td>
                                                <td class="text-center">05/07/2023</td>
                                                <td class="text-center"><button type="button" class="btn btn-success btn-sm"> Layak</button></td>
                                            </tr>

                                            <tr>
                                                <td><a href="{{ url('maklumat-keputusan') }}" target="_blank">KPT/BKOKU/B/001121035602</a></td> 
                                                <td>Sarah Binti Md Yunos</td>
                                                <td>BKOKU</td>
                                                <td class="text-center">12/06/2023</td>
                                                <td class="text-center"><button type="button" class="btn btn-danger btn-sm"> Tidak Layak</button></td>
                                                {{-- <td>Anda tidak disahkan sebagai pelajar OKU</td>  --}}
                                            </tr>

                                            <tr>
                                                <td><a href="{{ url('maklumat-keputusan') }}" target="_blank">KPT/PPK/B/970804110016</a></td>
                                                <td>Tamila A/P Ganesh</td>
                                                <td>PPK</td>
                                                <td class="text-center">20/06/2023</td>
                                                <td class="text-center"><button type="button" class="btn btn-warning btn-sm"> Dikembalikan</button></td>
                                                {{-- <td>Terdapat kesilapan dalam butiran resit </td> --}}
                                            </tr>
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
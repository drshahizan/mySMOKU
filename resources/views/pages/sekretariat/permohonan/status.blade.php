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
                <!-- Page header section  -->
                <div class="block-header">
                    <div class="row clearfix">
                        <div class="col-lg-6 col-md-12 col-sm-12">
                            <h1>Status Permohonan BKOKU dan PPK</h1>
                        </div>
                        <hr>

                        <div class="row">
                        {{-- Small Card Section Level 1--}}
                            <div class="col-lg-2 col-md-4">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center">
                                            <div class="icon-in-bg bg-info text-white rounded-circle"><i class="fa fa-bookmark" style="color: white"></i></div>
                                            <div class="ml-4">
                                                <span style="color: black;"> Baru</span>
                                                <h4 class="mb-0 font-weight-medium">1090</h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-2 col-md-4">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center">
                                            <div class="icon-in-bg text-white rounded-circle" style="background-color: coral;"><i class="fa fa-users" style="color: white"></i></div>
                                            <div class="ml-4">
                                                <span style="color: black"> Saringan</span>
                                                <h4 class="mb-0 font-weight-medium">500</h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-lg-2 col-md-4">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center">
                                            <div class="icon-in-bg bg-primary text-white rounded-circle"><i class="fa fa-user-check" style="color: white"></i></div>
                                            <div class="ml-4">
                                                <span style="color: black"> Disokong</span>
                                                <h4 class="mb-0 font-weight-medium">2408</h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-lg-2 col-md-4">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center">
                                            <div class="icon-in-bg bg-warning text-white rounded-circle"><i class="fa fa-mail-reply" style="color: white"></i></div>
                                            <div class="ml-4">
                                                <span style="color: black"> Dikembalikan</span>
                                                <h4 class="mb-0 font-weight-medium">54</h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-2 col-md-2">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center">
                                            <div class="icon-in-bg bg-success text-white rounded-circle"><i class="fa fa-check"></i></div>
                                            <div class="ml-4">
                                                <span style="color: black;"> Layak</span>
                                                <h4 class="mb-0 font-weight-medium">1230</h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-2 col-md-4">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center">
                                            <div class="icon-in-bg bg-danger text-white rounded-circle"><i class="fa fa-times" style="color: white"></i></div>
                                            <div class="ml-4">
                                                <span style="color: black"> Tidak Layak</span>
                                                <h4 class="mb-0 font-weight-medium">25</h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-2 col-md-4">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center">
                                            <div class="icon-in-bg text-white rounded-circle" style="background-color: brown"><i class="fa fa-warning" style="color: white"></i></div>
                                            <div class="ml-4">
                                                <span style="color: black"> Tidak Aktif</span>
                                                <h4 class="mb-0 font-weight-medium">195</h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- End of Small card section --}}
                </div>

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

                    {{-- Filter section --}}
                    <div class="row">
                        <div class="col-md-3">
                            {{-- <label style="color:black"><b>Tapis Status Permohonan</b> --}}
                            <select name="status" class="form-select">
                                <option value="">Semua Status Permohonan</option>
                                <option value="Baru" {{Request::get('status') == 'Baru' ? 'selected':'' }} >Baru</option>
                                <option value="Saringan" {{Request::get('status') == 'Saringan' ? 'selected':'' }} >Saringan</option>
                                <option value="Disokong" {{Request::get('status') == 'Disokong' ? 'selected':'' }} >Disokong</option>
                                <option value="Layak" {{Request::get('status') == 'Layak' ? 'selected':'' }} >Layak</option>
                                <option value="Tidak Layak" {{Request::get('status') == 'Tidak Layak' ? 'selected':'' }} >Tidak Layak</option>
                                <option value="Dikembalikan" {{Request::get('status') == 'Dikembalikan' ? 'selected':'' }} >Dikembalikan</option>
                                <option value="Tidak Aktif" {{Request::get('status') == 'Tidak Aktif' ? 'selected':'' }} >Tidak Aktif</option>
                            </select>
                        </div>

                        <div class="col-md-3">
                            {{-- <label style="color:black"><b>Tapis Jenis Permohonan</b> --}}
                            <select name="status" class="form-select">
                                <option value="">Semua Jenis Permohonan</option>
                                <option value="BKOKU" {{Request::get('jenis') == 'BKOKU' ? 'selected':'' }} >BKOKU</option>
                                <option value="PPK" {{Request::get('jenis') == 'PPK' ? 'selected':'' }} >PPK</option>
                            </select>
                        </div>

                        <div class="col-md-4 right">
                            <button type="submit" class="btn btn-primary" style="width: 15%;"><i class="fa fa-filter" style="font-size: 15px;"></i></button>
                        </div>
                    </div>
                    <br>

                    {{-- Table senarai --}}
                    <div class="row clearfix">
                    <div class="col-lg-12">
                        <div class="table-responsive">
                            <div class="body">      
                                <table id="sortTable" class="table table-bordered table-striped">
                                    <thead>
                                        <tr style="color: white; background-color:rgb(35, 58, 108);">
                                            <th style="width: 25%">ID Permohonan</th> 
                                            <th style="width: 40%">Nama Pemohon</th>
                                            <th style="width: 15%">Jenis Permohonan</th>  
                                            <th class="text-center" style="width: 20%">Status Permohonan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>KPTBKOKUB011221038715</td>
                                            <td>Ali Bin Abu</td>
                                            <td>BKOKU</td>
                                            <td class="text-center"><button type="button" class="btn btn-sm" style="background-color:coral; color:white;">Saringan</button></td>
                                        </tr>

                                        {{-- <tr data-status="Aktif">
                                            <td>SARJANAMUDABKOKU00012</td>
                                            <td>Afiq Hazim Bin Abdul Malik</td>
                                            <td>BKOKU</td>
                                            <td class="text-center"><button type="button" class="btn btn-success btn-sm">Aktif</button></td>
                                        </tr> --}}

                                        <tr data-status="Tidak Aktif">
                                            <td>KPTBKOKUB011221038712</td>
                                            <td>Alia Dania</td>
                                            <td>BKOKU</td>
                                            <td class="text-center"><button type="button" class="btn btn-danger btn-sm">Tidak Layak</button></td>
                                        </tr>  

                                        <tr data-status="Disokong">
                                            <td>KPTPPKB011221038714</td>
                                            <td>Amirah Binti Akmal</td>
                                            <td>PPK</td>
                                            <td class="text-center"><button type="button" class="btn btn-sm" style="background-color:cornflowerblue; color:white;">Disokong</button></td>
                                        </tr>

                                        <tr data-status="Baru">
                                            <td>KPTBKOKUB011221038016</td>
                                            <td>Chai Jing Si</td>
                                            <td>BKOKU</td>
                                            <td class="text-center"><button type="button" class="btn btn-info btn-sm">Baru</button></td>
                                        </tr>

                                        <tr data-status="Dikembalikan">
                                            <td>KPTBKOKUB011221038712</td>
                                            <td>Clarrisa Yong Chu Ni </td>
                                            <td>BKOKU</td>
                                            <td class="text-center"><button type="button" class="btn btn-warning btn-sm">Dikembalikan</button></td>
                                        </tr>
                                        
                                        <tr data-status="Saringan">
                                            <td>KPTBKOKUB011221038716</td>
                                            <td>Eng Mei Ying</td>
                                            <td>BKOKU</td>
                                            <td class="text-center"><button type="button" class="btn btn-sm" style="background-color:cornflowerblue; color:white;">Disokong</button></td>
                                        </tr>

                                        <tr data-status="Tidak Layak">
                                            <td>KPTBKOKUB011221038717</td>
                                            <td>Ganesan Rao A/L Puven</td>
                                            <td>BKOKU</td>
                                            <td class="text-center"><button type="button" class="btn btn-danger btn-sm">Tidak Layak</button></td>
                                        </tr>

                                        <tr>
                                            <td>KPTPPKB011221038718</td>
                                            <td>Sarah Yunos</td>
                                            <td>PPK</td>
                                            <td class="text-center"><button type="button" class="btn btn-sm" style="background-color:coral; color:white;">Saringan</button></td>
                                        </tr>
                                        
                                        <tr data-status="Saringan">
                                            <td>KPTBKOKUB991221038716</td>
                                            <td>Tan Yu Heng</td>
                                            <td>BKOKU</td>
                                            <td class="text-center"><button type="button" class="btn btn-sm" style="background-color:coral; color:white;">Saringan</button></td>
                                        </tr>
                                        
                                        <tr data-status="Layak">
                                            <td>KPTBKOKUB011221033712</td>
                                            <td>Puah Chu Er</td>
                                            <td>BKOKU</td>
                                            <td class="text-center"><button type="button" class="btn btn-success btn-sm">Layak</button></td>
                                        </tr>
                                        
                                        <tr data-status="Disokong">
                                            <td>KPTBKOKUB011221034712</td>
                                            <td>Hanisah Binti Yusri</td>
                                            <td>BKOKU</td>
                                            <td class="text-center"><button type="button" class="btn btn-sm" style="background-color:cornflowerblue; color:white;">Disokong</button></td>
                                        </tr>
                                        
                                        <tr data-status="Disokong">
                                            <td>KPTBKOKUB011221032712</td>
                                            <td>Ramli Bin Sarip</td>
                                            <td>BKOKU</td>
                                            <td class="text-center"><button type="button" class="btn btn-sm btn-success">Layak</button></td>
                                        </tr>
                                        
                                        <tr data-status="Baru">
                                            <td>KPTBKOKUB011221038712</td>
                                            <td>Norhayati Binti Sam</td>
                                            <td>BKOKU</td>
                                            <td class="text-center"><button type="button" class="btn btn-info btn-sm">Baru</button></td>
                                        </tr>
                                        
                                        <tr data-status="Disokong">
                                            <td>KPTBKOKUB011221038712</td>
                                            <td>Shamsiah Binti Yusof</td>
                                            <td>BKOKU</td>
                                            <td class="text-center"><button type="button" class="btn btn-sm" style="background-color:cornflowerblue; color:white;">Disokong</button></td>
                                        </tr>

                                        <tr data-status="Dikembalikan">
                                            <td>KPTBKOKUB011221038712</td>
                                            <td>Siti Farah Binti Muazin</td>
                                            <td>BKOKU</td>
                                            <td class="text-center"><button type="button" class="btn btn-warning btn-sm">Dikembalikan</button></td>
                                        </tr>
                                        
                                        {{-- <tr data-status="Disokong">
                                            <td>
                                               Gayathri A/P Ganeshnaran
                                            </td>
                                            <td>
                                                BKOKU
                                            </td>
                                            <td>
                                               SARJANAMUDABKOKU22012
                                            </td>
                                            
                                            <td>Disokong</td>
                                        </tr>
                                        
                                        <tr data-status="Disokong">
                                            <td>
                                               Najwa Binti Hanan
                                            </td>
                                            <td>
                                                PPK
                                            </td>
                                            <td>
                                               DIPPPK00012
                                            </td>
                                            
                                            <td>Disokong</td>
                                        </tr> --}}
                                        
                                        {{-- <tr data-status="Aktif">
                                            <td>
                                                Puah Chu Er
                                             </td>
                                             <td>
                                                 BKOKU
                                             </td>
                                             <td>
                                                SARJANABKOKU02012
                                             </td>
                                             
                                             <td>Aktif</td>
                                        </tr> --}}             
                                    </tbody>
                                </table>
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


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
                        {{-- Small Card Section --}}
                        <div class="col-lg-3 col-md-6">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <div class="icon-in-bg bg-indigo text-white rounded-circle" style="padding-left:0;"><i class="fa fa-check"></i></div>
                                        <div class="ml-4">
                                            <span style="color: black;"> Aktif BKOKU</span>
                                            <h4 class="mb-0 font-weight-medium">2000</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-6">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <div class="icon-in-bg bg-azura text-white rounded-circle"><i class="fa fa-times" style="color: white"></i></div>
                                        <div class="ml-4">
                                            <span style="color: black"> Tidak Aktif BKOKU</span>
                                            <h4 class="mb-0 font-weight-medium">25</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-lg-3 col-md-6">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <div class="icon-in-bg bg-orange text-white rounded-circle"><i class="fa fa-check"></i></div>
                                        <div class="ml-4">
                                            <span style="color: black"> Aktif PPK</span>
                                            <h4 class="mb-0 font-weight-medium">1200</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-lg-3 col-md-6">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <div class="icon-in-bg bg-pink text-white rounded-circle"><i class="fa fa-times" style="color: white"></i></div>
                                        <div class="ml-4">
                                            <span style="color: black"> Tidak Aktif PPK</span>
                                            <h4 class="mb-0 font-weight-medium">54</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- End of Small card section --}}
                </div>
             
                {{-- Card section --}}
                
                {{-- End of Card section --}}

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
                                <option value="Aktif" {{Request::get('status') == 'Aktif' ? 'selected':'' }} >Aktif</option>
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
                                            <th>Nama Pemohon</th>
                                            <th>Jenis Permohonan</th>
                                            <th>ID Permohonan</th>  
                                            <th>Status Permohonan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                Ali Bin Abu
                                            </td>
                                            <td>
                                                BKOKU
                                            </td>
                                            <td>
                                               SARJANABKOKU00012
                                            </td>
                                            <td><button type="button" class="btn btn-sm" style="background-color:gray; color:white;">Saringan</button></td>
                                        </tr>

                                        <tr data-status="Aktif">
                                            <td>
                                                Afiq Hazim Bin Abdul Malik
                                            </td>
                                            <td>
                                                BKOKU
                                            </td>
                                            <td>
                                               SARJANAMUDABKOKU00012
                                            </td>
                                            <td><button type="button" class="btn btn-success btn-sm">Aktif</button></td>
                                        </tr>

                                        <tr data-status="Tidak Aktif">
                                            <td>
                                                Alia Dania
                                            </td>
                                            <td>
                                                BKOKU
                                            </td>
                                            <td>
                                               SARJANABKOKU00012
                                            </td>
                                            <td><button type="button" class="btn btn-sm" style="background-color:brown; color:white;">Tidak Aktif</button></td>
                                        </tr>  

                                        <tr data-status="Disokong">
                                            <td>
                                                Amirah Binti Akmal
                                            </td>
                                            <td>
                                                PPK
                                            </td>
                                            <td>
                                               DIPPPK80012
                                            </td>
                                            <td><button type="button" class="btn btn-sm" style="background-color:cornflowerblue; color:white;">Disokong</button></td>
                                        </tr>

                                        <tr data-status="Baru">
                                            <td>
                                                Chai Jing Si
                                            </td>
                                            <td>
                                                BKOKU
                                            </td>
                                            <td>
                                               SARJANABKOKU22012
                                            </td>
                                            <td><button type="button" class="btn btn-info btn-sm">Baru</button></td>
                                        </tr>

                                        <tr data-status="Dikembalikan">
                                            <td>
                                                Clarrisa Yong Chu Ni 
                                            </td>
                                            <td>
                                                BKOKU
                                            </td>
                                            <td>
                                               SARJANAMUDABKOKU00012
                                            </td>
                                            <td><button type="button" class="btn btn-warning btn-sm">Dikembalikan</button></td>
                                        </tr>
                                        
                                        <tr data-status="Saringan">
                                            <td>
                                              Eng Mei Ying
                                            </td>
                                            <td>
                                                BKOKU
                                            </td>
                                            <td>
                                               PHDBKOKU30012
                                            </td>
                                            <td><button type="button" class="btn btn-sm" style="background-color:cornflowerblue; color:white;">Disokong</button></td>
                                        </tr>

                                        <tr data-status="Tidak Layak">
                                            <td>
                                                Ganesan Rao A/L Puven
                                            </td>
                                            <td>
                                                BKOKU
                                            </td>
                                            <td>
                                               SARJANABKOKU03412
                                            </td>
                                            <td><button type="button" class="btn btn-danger btn-sm">Tidak Layak</button></td>
                                        </tr>

                                        <tr>
                                            <td>
                                               Sarah Yunos
                                            </td>
                                            <td>
                                               PPK
                                            </td>
                                            <td>
                                               DIPPPK01012
                                            </td>
                                            
                                            <td><button type="button" class="btn btn-sm" style="background-color:gray; color:white;">Saringan</button></td>
                                        </tr>
                                        
                                        <tr data-status="Saringan">
                                            <td>
                                                Tan Yu Heng
                                            </td>
                                            <td>
                                                BKOKU
                                            </td>
                                            <td>
                                               SARJANAMUDABKOKU90012
                                            </td>
                                            
                                            <td><button type="button" class="btn btn-sm" style="background-color:gray; color:white;">Saringan</button></td>
                                        </tr>
                                        
                                        <tr data-status="Layak">
                                            <td>
                                               Puah Chu Er
                                            </td>
                                            <td>
                                                BKOKU
                                            </td>
                                            <td>
                                               SARJANABKOKU02012
                                            </td>
                                            
                                            <td><button type="button" class="btn btn-success btn-sm">Layak</button></td>
                                        </tr>
                                        
                                        <tr data-status="Disokong">
                                            <td>
                                                Hanisah Binti Yusri
                                            </td>
                                            <td>
                                                BKOKU
                                            </td>
                                            <td>
                                               SARJANAMUDABKOKU66012
                                            </td>
                                            
                                            <td><button type="button" class="btn btn-sm" style="background-color:cornflowerblue; color:white;">Disokong</button></td>
                                        </tr>
                                        
                                        <tr data-status="Disokong">
                                            <td>
                                                Ramli Bin Sarip
                                            </td>
                                            <td>
                                                BKOKU
                                            </td>
                                            <td>
                                               SARJANAMUDABKOKU77012
                                            </td>
                                            
                                            <td><button type="button" class="btn btn-sm" style="background-color:cornflowerblue; color:white;">Disokong</button></td>
                                        </tr>
                                        
                                        {{-- <tr data-status="Tidak Layak">
                                            <td>
                                             Choo Mei Er
                                            </td>
                                            <td>
                                                BKOKU
                                            </td>
                                            <td>
                                               SARJANAMUDABKOKU00012
                                            </td>
                                            
                                            <td>Tidak Layak</td>
                                        </tr> --}}
                                        
                                        <tr data-status="Baru">
                                            <td>
                                               Norhayati Binti Sam
                                            </td>
                                            <td>
                                                BKOKU
                                            </td>
                                            <td>
                                               SARJANABKOKU09012
                                            </td>
                                            
                                            <td><button type="button" class="btn btn-info btn-sm">Baru</button></td>
                                        </tr>
                                        
                                        <tr data-status="Disokong">
                                            <td>
                                               Shamsiah Binti Yusof
                                            </td>
                                            <td>
                                                BKOKU
                                            </td>
                                            <td>
                                               SARJANABKOKU88012
                                            </td>
                                            
                                            <td><button type="button" class="btn btn-sm" style="background-color:cornflowerblue; color:white;">Disokong</button></td>
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
                                        
                                        <tr data-status="Dikembalikan">
                                            <td>
                                               Siti Farah Binti Muazin
                                            </td>
                                            <td>
                                                BKOKU
                                            </td>
                                            <td>
                                               SARJANABKOKU50012
                                            </td>
                                            
                                            <td><button type="button" class="btn btn-warning btn-sm">Dikembalikan</button></td>
                                        </tr>
                                        
                                        
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


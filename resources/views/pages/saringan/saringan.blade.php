<x-default-layout>
    <head>
    <title>Sekretariat BKOKU KPT | Saringan Permohonan</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">

    <!-- MAIN CSS -->
    <link rel="stylesheet" href="assets/css/saringan.css">

    </head>
    <body>
    <!-- Main body part  -->
    <div id="main-content">
        <div class="container-fluid">
            <!-- Page header section  -->
            <div class="block-header">
                <div class="row clearfix">
                    <div class="col-lg-4 col-md-12 col-sm-12">
                        <h1>Saring Permohonan</h1>
                    </div>
                </div>
            </div>        
            <div class="row clearfix">
                <div class="col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="icon-in-bg bg-indigo text-white rounded-circle"><i class="fa fa-file"></i></div>
                                <div class="ml-4">
                                    <span>Jumlah Saringan</span>
                                    <h4 class="mb-0 font-weight-medium">5000</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="icon-in-bg bg-azura text-white rounded-circle"><i class="fa fa-search"></i></div>
                                <div class="ml-4">
                                    <span>Belum Disemak</span>
                                    <h4 class="mb-0 font-weight-medium">4992</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="icon-in-bg bg-orange text-white rounded-circle"><i class="fa fa-check-circle"></i></div>
                                <div class="ml-4">
                                    <span>Disokong</span>
                                    <h4 class="mb-0 font-weight-medium">8</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="icon-in-bg bg-pink text-white rounded-circle"><i class="fa fa-reply-all"></i></div>
                                <div class="ml-4">
                                    <span>Dikembalikan</span>
                                    <h4 class="mb-0 font-weight-medium">259</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row clearfix">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="header">
                            <h2>Senarai Saringan Permohonan<small>Tekan ID Permohonan untuk melakukan saringan selanjutnya</small></h2>
                            <ul class="header-dropdown dropdown">
                                
                                <li><a href="javascript:void(0);" class="full-screen"><i class="fa fa-expand"></i></a></li>
                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"></a>
                                    <ul class="dropdown-menu theme-bg gradient">
                                        <li><a href="javascript:void(0);"><i class="dropdown-icon fa fa-eye"></i> View Details</a></li>
                                        <li><a href="javascript:void(0);"><i class="dropdown-icon fa fa-share-alt"></i> Share</a></li>
                                        <li><a href="javascript:void(0);"><i class="dropdown-icon fa fa-copy"></i> Copy to</a></li>
                                        <li><a href="javascript:void(0);"><i class="dropdown-icon fa fa-folder"></i> Move to</a></li>
                                        <li><a href="javascript:void(0);"><i class="dropdown-icon fa fa-edit"></i> Rename</a></li>
                                        <li><a href="javascript:void(0);"><i class="dropdown-icon fa fa-trash"></i> Delete</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-striped table-hover dataTable js-exportable">
                                    <thead>
                                        <tr>
                                        
                                            <th>Nama</th>
                                            <th>ID Permohonan</th>
                                            <th>Jenis Permohonan</th>
                                            <th>Tarikh Permohonan</th>
                                            <th>Status Saringan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Ali Bin Abu</td>
                                            <td><a href="maklumat-pemohon.html" title="">SARJANABKOKU000011</a></td>
                                            <td>BKOKU</td>
                                            <td>7/7/2023</td>
                                            <td><button type="button" class="btn btn-danger"> Belum Disemak </button></td>
                                        </tr>
                                        <tr>
                                            <td>Ali Bin Abu</td>
                                            <td><a href="maklumat-pemohon.html" title="">SARJANABKOKU000011</a></td>
                                            <td>BKOKU</td>
                                            <td>7/7/2023</td>
                                            <td><button type="button" class="btn btn-danger"> Belum Disemak </button></td>
                                        </tr>
                                        <tr>
                                            <td>Sarah Binti Yusri</td>
                                            <td><a href="maklumat-pemohon.html" title="">KKPPK000021</a></td>
                                            <td>PPK</td>
                                        
                                            <td>5/7/2023</td>
                                            <td><button type="button" class="btn btn-success"> Disokong</button></td>
                                        </tr> <tr>
                                            <td>Aishah Binti Samsudin</td>
                                            <td><a href="maklumat-pemohon.html" title="">PHDBKOKU000021</a></td>
                                            <td>BKOKU</td>
                                        
                                            <td>2/7/2023</td>
                                            <td><button type="button" class="btn btn-success"> Disokong</button></td>
                                        </tr> <tr>
                                            <td>Santosh A/L Ariyaran</td>
                                            <td><a href="maklumat-pemohon.html" title="">DIPBKOKU000021</a></td>
                                            <td>BKOKU</td>
                                        
                                            <td>10/7/2023</td>
                                            <td><button type="button" class="btn btn-success"> Disokong</button></td>
                                        </tr> <tr>
                                            <td>Ling Kai Jie</td>
                                            <td><a href="maklumat-pemohon.html" title="">SARJANABKOKU000021</a></td>
                                            <td>BKOKU</td>
                                        
                                            <td>9/7/2023</td>
                                            <td><button type="button" class="btn btn-success"> Disokong</button></td>
                                        </tr> <tr>
                                            <td>Akmal Bin Kairuddin</td>
                                            <td><a href="maklumat-pemohon.html" title="">KKPPK40021</a></td>
                                            <td>PPK</td>
                                        
                                            <td>7/7/2023</td>
                                            <td><button type="button" class="btn btn-success"> Disokong</button></td>
                                        </tr>
                                        <tr>
                                            <td>Santishwaran A/L Paven</td>
                                            <td><a href="maklumat-pemohon.html" title="">KKPPK60021</a></td>
                                            <td>PPK</td>
                                        
                                            <td>5/7/2023</td>
                                            <td><button type="button" class="btn btn-success"> Disokong</button></td>
                                        </tr>
                                        <tr>
                                            <td>Choo Mei Ling</td>
                                            <td><a href="maklumat-pemohon.html" title="">DIPLOMABKOKU002011</a></td>
                                            <td>BKOKU</td>
                                        
                                            <td>7/6/2023</td>
                                            <td><button type="button" class="btn btn-warning"> Dikembalikan</button></td>
                                        </tr>
                                        <tr>
                                            <td>Ezra Hanisah Binti Md Yunos</td>
                                            <td><a href="maklumat-pemohon.html" title="">PHDBKOKU000011</a></td>
                                            <td>BKOKU</td>
                                    
                                            <td>9/2/2023</td>
                                            <td><button type="button" class="btn btn-success"> Disokong</button></td>
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

    <script src="assets/bundles/datatablescripts.bundle.js"></script>
    <script src="assets/vendor/jquery-datatable/buttons/dataTables.buttons.min.js"></script>
    <script src="assets/vendor/jquery-datatable/buttons/buttons.bootstrap4.min.js"></script>
    <script src="assets/vendor/jquery-datatable/buttons/buttons.colVis.min.js"></script>
    <script src="assets/vendor/jquery-datatable/buttons/buttons.html5.min.js"></script>
    <script src="assets/vendor/jquery-datatable/buttons/buttons.print.min.js"></script>
    <script src="assets/vendor/sweetalert/sweetalert.min.js"></script><!-- SweetAlert Plugin Js --> 
    <script src="../js/pages/tables/jquery-datatable.js"></script>
    </body>
</x-default-layout> 
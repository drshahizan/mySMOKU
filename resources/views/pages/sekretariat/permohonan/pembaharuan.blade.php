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
                        <div class="col-lg-4 col-md-12 col-sm-12">
                            <h1>Pembaharuan Permohonan</h1>
                            <hr>
                        </div>
                    </div>
                    <br>
                    <div class="row clearfix">
                    {{-- <div class="col-lg-6 col-md-12">
                        <div class="card">
                            <div class="header">
                                <h2>Jumlah Keseluruhan Permohonan</h2>
                            </div>
                            <div class="body">
                                <div id="chart-pie" style="height: 380px"></div>
                            </div>
                        </div> 
                    </div>
                    <div class="col-lg-6 col-md-12">
                        <div class="card">
                            <div class="header">
                                <h2>Jumlah Keseluruhan Permohonan Terkini</h2>
                                <!--<small class="text-muted">Sales Performance for Online and Offline Revenue <a href="">Learn more</a></small>-->
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
                                <div class="d-flex flex-row">
                                    <div class="pb-3">
                                        <h5 class="mb-0">50</h5>
                                        <small class="text-muted font-11">Jumlah Didaftarkan</small>
                                    </div>
                                    <div class="pb-3 pl-4 pr-4">
                                        <h5 class="mb-0">45</h5>
                                        <small class="text-muted font-11">Permohonan Aktif</small>
                                    </div>
                                    <div class="pb-3">
                                        <h5 class="mb-0">48</h5>
                                        <small class="text-muted font-11">Permohonan Tidak Aktif</small>
                                    </div>
                                    <div class="ml-auto">
                                        <select class="form-control">
                                            <option selected="selected">Bulan</option>
                                            <option>Hari</option>
                                            <option>Tahun</option>
                                        </select>
                                    </div>
                                </div>
                                <div id="bar-chart" style="height: 300px"></div>
                            </div>
                        </div>
                    </div> --}}
                </div>
                <div class="row clearfix">
                    <div class="col-12">
                        <nav class="navbar navbar-expand-lg navbar-light bg-light page_menu">
                            <!--<a class="navbar-brand" href="#">M.</a>-->
                            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                            <i class="fa fa-bars text-muted"></i>
                            </button>
                            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                                <ul class="navbar-nav mr-auto">
                                    <li class="nav-item vivify swoopInTop delay-150 active"><a class="nav-link" href="">Senarai Keseluruhan Permohonan</a></li>
                                   
                                </ul>
                               
                            </div>
                        </nav>
                    </div>

                    <div class="col-12">
                        <div class="card">
                            <div class="body">
                                <div class="table-responsive invoice_list">
                                    <table class="table table-hover js-basic-example dataTable">
                                        <thead>
                                            <tr> 
                                                <th style="width: 20px;">Bil</th>
                                                <th>Nama Pelajar</th>
                                                <th style="width: 80px;">ID Permohonan</th>
                                                <th style="width: 80px;">Tarikh Lulus Permohonan</th>
                                                <th style="width: 80px;">Tarikh Akhir Pengajian</th>
                                                <th style="width: 80px;">Status Permohonan</th>
                                                <th style="width: 80px;">Status Perbaharui Permohonan</th>
                                                <th style="width: 80px;">Tindakan</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <span>01</span>
                                                </td>
                                                <td>
                                                    <span>Ali Bin Abu</span>                                              
                                                </td>
                                                <td>SARJANABKOKU000011</td>
                                                <td>6/7/2023</td>
                                                <td>8/7/2027</td>
                                                <td>Aktif</td>
                                                <td> <button type="button" class="btn btn-info ">Belum Perbaharui</button></td>
                                                <td>
                                                    <a href="baharui-Ali.html" class="btn btn-warning btn-round"><i class="icon-plus"></i> Perbaharui</a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <span>02</span>
                                                </td>
                                                <td>
                                                    <span>Zoe Baker</span>
                                                        
                                                           
                                                                                          
                                                </td>
                                                <td>DIPLOMABKOKU002011</td>
                                                <td>5/7/2022</td>
                                                <td>4/7/2023</td>
                                                <td>Tidak Aktif</td>
                                                <td> <button type="button" class="btn btn-danger ">Tamat</button></td>
                                                <td>
                                                    <button type="button" class="btn btn-danger ">Tamat</button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <span>03</span>
                                                </td>
                                                <td>   
                                                    <span>Sarah Binti Hashim</span>                                  
                                                                                              
                                                </td>
                                                <td>PHDBKOKU202011</td>
                                                <td>3/7/2021</td>
                                                <td>4/7/2024</td>
                                                <td> Aktif</td>
                                                <td> <button type="button" class="btn btn-default ">Edit</button></td>
                                                <td>
                                                    <a href="baharui-sarah.html" class="btn btn-primary btn-round"><i class="icon-pencil"></i> Edit</a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <span>04</span>
                                                </td>
                                                <td>
                                                    <span>Akmal Bin Mahmod</span>   
                                                  
                                                          
                                                </td>
                                                <td>SARJANABKOKU12011</td>
                                                <td>1/6/2022</td>
                                                <td>4/7/2024</td>
                                                <td> Aktif</td>
                                                <td> <button type="button" class="btn btn-success ">Telah Dihantar</button></td>
                                                <td>
                                                    <a href="permohonan-baharui.html" class="btn btn-success"><i class="icon-check"></i> Menunggu Keputusan</a>
                                                </td>
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
<x-default-layout>
    <head>
        <title>Penyelaras IPT | Permohonan Baru</title>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
        <meta name="description" content="Bantuan Kewangan Pelajar Orang Kurang Upaya(OKU) Di Institusi Pengajian Tinggi (IPT)">
        <meta name="author" content="Prototype Mockup">

        <!-- MAIN CSS -->
        <link rel="stylesheet" href="assets/css/sekretariat.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js"></script>

        <!-- VENDOR CSS -->
        <link rel="stylesheet" href="assets/vendor/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="assets/vendor/font-awesome/css/font-awesome.min.css">
        <link rel="stylesheet" href="assets/vendor/animate-css/vivify.min.css">

        <link rel="stylesheet" href="assets/vendor/chartist/css/chartist.min.css">
        <link rel="stylesheet" href="assets/vendor/chartist-plugin-tooltip/chartist-plugin-tooltip.css">
        <link rel="stylesheet" href="assets/vendor/c3/c3.min.css"/>
        <link rel="stylesheet" href="assets/vendor/toastr/toastr.min.css">
        <link rel="stylesheet" href="assets/vendor/jvectormap/jquery-jvectormap-2.0.3.min.css"/>

        <link rel="stylesheet" href="assets/vendor/jquery-datatable/dataTables.bootstrap4.min.css">
        <link rel="stylesheet" href="assets/vendor/jquery-datatable/fixedeader/dataTables.fixedcolumns.bootstrap4.min.css">
        <link rel="stylesheet" href="assets/vendor/jquery-datatable/fixedeader/dataTables.fixedheader.bootstrap4.min.css">
        <link rel="stylesheet" href="assets/vendor/sweetalert/sweetalert.css"/>
    </head>

    <body>
        <!-- Main body part  -->
        <div id="main-content">
            <div class="container-fluid">
                <!-- Page header section  -->
                <div class="block-header">
                    <div class="row clearfix">
                        <div class="col-lg-4 col-md-12 col-sm-12">
                            <h1>Permohonan Baru</h1>
                          
                        </div>
                        <div class="col-lg-8 col-md-12 col-sm-12 text-right">
                            <div class="body">
                                <button type="button" class="btn btn-success btn-round" data-toggle="modal" data-target=".launch-pricing-modal">Tambah Pelajar</button> <!-- launch-pricing -->
                                <div class="modal fade launch-pricing-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">                                            
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                            </div>
                                            <div class="modal-body pricing_page text-center pt-4 mb-4">
                                                    <div class="col-lg-12">
                                                        <div class="card">
                                                            <div class="header">
                                                                <h2>Maklumat Pelajar</h2>
                                                            </div>
                                                            <div class="body">
                                                                <div class="form-group c_form_group">
                                                                    <div class="input-group">
                                                                        <div class="input-group-prepend">
                                                                            <span class="input-group-text">Nama</span>
                                                                        </div>
                                                                        <input type="text" class="form-control" aria-label="Username" aria-describedby="basic-addon1">
                                                                    </div>
                                                                </div>
                                                                <div class="form-group c_form_group">
                                                                    <div class="input-group">
                                                                        <div class="input-group-prepend">
                                                                            <span class="input-group-text">No.Pendaftaran Pelajar/ No.Kad Matrik</span>
                                                                        </div>
                                                                        <input type="text" class="form-control" aria-label="Username" aria-describedby="basic-addon1">
                                                                    </div>
                                                                </div>
                                            
                                                </div> 
                                                        </div>
                                                   </div>
                                
                                                <div class="col-12">
                                                    
                                                    <a href="mohon-baru.html"  class="btn btn-success btn-round">Hantar</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div></div>
                        </div>
                        <br>
                    </div>
                    <br>
                 
                    <div class="row clearfix">
                    <div class="col-lg-6 col-md-12">
                        <div class="card">
                            <div class="header">
                                <h2>Permohonan Baru (Keseluruhan)</h2>
                                <small class="font-12">Jumlah Keseluruhan Permohonan Baru Yang Terkini</small>
                            </div>
                            <div class="body">
                                <div id="chart-donut-d" style="height: 180px"></div>
                                <div class="mt-2">
                                    <div class="form-group">
                                        <label class="d-block">Deraf <span class="float-right">12</span></label>
                                        <div class="progress progress-xs">
                                            <div class="progress-bar" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: 20%; background-color: #2c83b6;"></div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="d-block">Belum Memohon<span class="float-right">18</span></label>
                                        <div class="progress progress-xs">
                                            <div class="progress-bar" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width: 70%; background-color: #a5d8a2;"></div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="d-block">Telah Dihantar<span class="float-right">15</span></label>
                                        <div class="progress progress-xs">
                                            <div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%; background-color: #9367b4;"></div>
                                        </div>
                                    </div>
                                   
                                </div>
                            </div>
                        </div>
                    </div>
                   
                        <div class="col-lg-6 col-md-12">
                            <div class="card">
                                <div class="header">
                                    <h2>Jumlah Keseluruhan Permohonan Yang Dihantar</h2>
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
                                            <h5 class="mb-0">27%</h5>
                                            <small class="text-muted font-11">Deraf</small>
                                        </div>
                                        <div class="pb-3">
                                            <h5 class="mb-0">63%</h5>
                                            <small class="text-muted font-11">Telah Dihantar</small>
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
                        </div>
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
                                        <li class="nav-item vivify swoopInTop delay-150 active"><a class="nav-link" href="">Senarai Pelajar</a></li>
                                       
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
                                                    <th style="width: 120px;">Kad Pendaftaran Pelajar/ Kad Matrik</th>
                                                    <th style="width: 80px;">Status Permohonan</th>
                                                    <th style="width: 100px;">Tindakan</th>
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
                                                    <td>ACS203009</td>
                                                    <td> <button type="button" class="btn btn-info ">Belum Memohon</button></td>
                                                    <td>
                                                        <a href="permohonan-baru.html" class="btn btn-warning btn-round"><i class="icon-plus"></i> Mohon</a>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <span>02</span>
                                                    </td>
                                                    <td>
                                                        <span>Zoe Baker</span>
                                                            
                                                               
                                                                                              
                                                    </td>
                                                    <td>AMS203009</td>
                                                    <td> <button type="button" class="btn btn-default ">Deraf</button></td>
                                                    <td>
                                                        <a href="permohonan-baru.html" class="btn btn-primary btn-round"><i class="icon-pencil"></i> Edit</a>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <span>03</span>
                                                    </td>
                                                    <td>   
                                                        <span>Sarah Binti Hashim</span>                                  
                                                                                                  
                                                    </td>
                                                    <td>CCS202009</td>
                                                    <td> <button type="button" class="btn btn-info ">Belum Memohon</button></td>
                                                    <td>
                                                        <a href="permohonan-baru.html" class="btn btn-warning btn-round"><i class="icon-plus"></i> Mohon</a>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <span>04</span>
                                                    </td>
                                                    <td>
                                                        <span>Akmal Bin Mahmod</span>   
                                                      
                                                              
                                                    </td>
                                                    <td>ARS201009</td>
                                                    <td> <button type="button" class="btn btn-success ">Telah Dihantar</button></td>
                                                    <td>
                                                        <a href="permohonan-baru.html" class="btn btn-success"><i class="icon-check"></i> Menunggu Keputusan</a>
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
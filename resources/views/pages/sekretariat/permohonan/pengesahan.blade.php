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
                            <h1>Pengesahan Permohonan</h1>
                        </div>
                    </div>
                </div>        
                
                <div class="row clearfix">
                    <div class="col-lg-6 col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="icon-in-bg bg-indigo text-white rounded-circle"><i class="fa fa-file" style="color: white"></i></div>
                                    <div class="ml-4" style="color: black;">
                                        <span>Permohonan BKOKU</span>
                                        <h4 class="mb-0 font-weight-medium">7000</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="icon-in-bg bg-pink text-white rounded-circle"><i class="fa fa-check"></i></div>
                                    <div class="ml-4" style="color: black;">
                                        <span>Permohonan BKOKU</span>
                                        <h4 class="mb-0 font-weight-medium">3000</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- <div class="col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="icon-in-bg bg-danger text-white rounded-circle"><i class="fa fa-warning" style="color: white"></i></div>
                                    <div class="ml-4" style="color: black;">
                                        <span>Tidak Layak</span>
                                        <h4 class="mb-0 font-weight-medium">200</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="icon-in-bg bg-warning text-white rounded-circle"><i class="fa fa-reply" style="color: white"></i></div>
                                    <div class="ml-4" style="color: black;">
                                        <span>Dikembalikan</span>
                                        <h4 class="mb-0 font-weight-medium">165</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> --}}
                </div>

                <div class="row clearfix">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="header">
                                <h2>Senarai Permohonan untuk Disahkan<br><small>Sila tandakan pada kotak untuk mengesahkan permohonan yang disokong</small></h2>
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

                            {{-- TABLE --}}
                            <div class="body">
                                <div class="table-responsive">
                                    <table id="sortTable" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th class="text-center" style="width:15%;"><input type="checkbox" name="select_all" value="1" id="example-select-all">  Sahkan Semua</th>
                                                <th style="width:15%;">ID Permohonan</th>
                                                <th style="width:40%;">Nama</th>
                                                <th style="width:15%;">Jenis Permohonan</th>
                                                <th class="text-center" style="width:15%;">Tarikh Permohonan</th>
                                                {{-- <th class="text-center">Status Permohonan</th> --}}
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td class="text-center"><input type="checkbox" name="select_all" value="1" id="example-select-all"></td>
                                                <td><a href="{{url('maklumat-keputusan')}}" title="">KPTBKOKUB011221038712</a></td>
                                                <td>Arina Binti Saleh</td>
                                                <td>BKOKU</td>
                                                <td class="text-center">07/07/2023</td>
                                                {{-- <td class="text-center"><button class="btn btn-info btn-sm" data-toggle="modal" data-target="#exampleModalCenter"><i class="icon-check"></i> Pengesahan</button> --}}
                                                    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalCenterTitle">Pengesahan Permohonan</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                                </div>
                                                                <div class="modal-body text-center">
                                                                    <p>Permohonan ini</p>
                                                                </div>
                                                                <div class="row clearfix text-center">
                                                                    <div class="col-lg-12">
                                                                        <div class="fancy-radio">
                                                                            <label><input name="lulus" value="male" type="radio"><span><i></i> Layak menerima BKOKU/PPK</span></label>
                                                                        </div>
                                                                        <div class="fancy-radio">
                                                                            <label><input name="tidak_lulus" value="female" type="radio"><span><i></i> Tidak layak menerima BKOKU/PPK</span></label>
                                                                        </div>
                                                                        <br>
                                                                    </div>
                                                                </div>
                                                                <br>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                                                                    <a href="sahkan-permohonan.html" class="btn btn-success btn-round">Ya</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div></td>
                                              
                                            </tr>
                                            <tr>
                                                <td class="text-center"><input type="checkbox" name="select_all" value="1" id="example-select-all"></td>
                                                <td><a href="{{url('maklumat-keputusan')}}" title="">KPTBKOKUB011221034612</a></td>
                                                <td>Choo Mei Ling</td>
                                                <td>BKOKU</td>
                                                <td class="text-center">09/07/2023</td>
                                                {{-- <td class="text-center"><button type="button" class="btn btn-danger btn-sm"> Tidak Layak</button></td> --}}
                                            </tr>
                                            <tr>
                                                <td class="text-center"><input type="checkbox" name="select_all" value="1" id="example-select-all"></td>
                                                <td><a href="{{url('maklumat-keputusan')}}" title="">KPTBKOKUB970804110016</a></td>
                                                <td>Tamila A/P Ganesh</td>
                                                <td>BKOKU</td>
                                                <td class="text-center">09/07/2023</td>
                                                {{-- <td class="text-center"><button type="button" class="btn btn-warning btn-sm"> Kembalikan</button></td> --}}
                                            </tr>
                                            <tr>
                                                <td class="text-center"><input type="checkbox" name="select_all" value="1" id="example-select-all"></td>
                                                <td><a href="{{url('maklumat-keputusan')}}" title="">KPTBKOKUB980306082018</a></td>
                                                <td>Arissa Binti Saleh</td>
                                                <td>BKOKU</td>
                                                <td class="text-center">07/07/2023</td>
                                                {{-- <td class="text-center"><button type="button" class="btn btn-success btn-sm"> Layak</button></td> --}}
                                            </tr>
                                        </tbody>
                                    </table>

                                    <br>

                                    <div class="pengesahan">
                                        <button class="btn btn-info btn-round" data-toggle="modal" data-target="#exampleModalCenter"><i class="icon-check"></i> Pengesahan</button>
                                        <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalCenterTitle">Kembalikan Permohonan</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                    </div>
                                                    <div class="modal-body text-center">
                                                        <p>Pengesahan Permohonan ini</p>
                                                    </div>
                                                    <div class="row clearfix text-center">
                                                        <div class="col-lg-12">
                                                            <div class="fancy-radio">
                                                                <label><input name="lulus" value="male" type="radio"><span><i></i> Layak menerima BKOKU/PPK</span></label>
                                                            </div>
                                                            <div class="fancy-radio">
                                                                <label><input name="tidak_lulus" value="female" type="radio"><span><i></i> Tidak layak menerima BKOKU/PPK</span></label>
                                                            </div>
                                                            <br>
                                                        </div>
                                                    </div>
                                                    <br>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                                                        <a href="sahkan-permohonan.html"  class="btn btn-success btn-round">Ya</a>
                                                    </div>
                                                </div>
                                            </div>
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
    </body>
</x-default-layout> 
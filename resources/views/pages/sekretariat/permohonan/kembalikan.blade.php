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
                            <h1>Permohonan Dikembalikan</h1>
                        </div>
                    </div>
                </div>        
                <hr>
                <div class="row clearfix">
                    <div class="col-lg-3 col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="icon-in-bg bg-indigo text-white rounded-circle"><i class="fa fa-mail-reply" style="color: white"></i></div>
                                    <div class="ml-4" style="color: black;">
                                        <span>Permohonan Dikembali</span>
                                        <h4 class="mb-0 font-weight-medium">9</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="icon-in-bg bg-azura text-white rounded-circle"><i class="fa fa-check"></i></div>
                                    <div class="ml-4" style="color: black;">
                                        <span>Permohonan yang layak dimohon semula</span>
                                        <h4 class="mb-0 font-weight-medium">1</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-5 col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="icon-in-bg bg-orange text-white rounded-circle"><i class="fa fa-exclamation" style="color: white"></i></div>
                                    <div class="ml-4" style="color: black;">
                                        <span>Permohonan yang tidak layak dimohon semula</span>
                                        <h4 class="mb-0 font-weight-medium">1</h4>
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
                                <h2>Senarai Permohonan yang Dikembalikan</h2><hr>
                            </div>
                            <div class="body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-hover dataTable js-exportable">
                                        <thead>
                                            <tr>
                                                <th class="text-center" style="width: 20%">Nama</th>
                                                <th class="text-center" style="width: 10%">Jenis Permohonan</th>
                                                <th class="text-center" style="width: 10%">Tarikh Permohonan</th>
                                                <th class="text-center" style="width: 10%">Tarikh Kembalikan</th>
                                                <th class="text-center" style="width: 20%">Status</th>
                                                <th class="text-center" style="width: 30%">Sebab</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                               
                                                <td>Arina Binti Yunos</td>
                                                <td class="text-center">BKOKU</td>
                                                <td class="text-center">2/4/2023</td>
                                                <td class="text-center">5/5/2023</td>
                                                <td><div style="color: red;">Tidak layak menerima BKOKU</div></td>
                                                <td>Pelajar ini didapati menerima biasiswa yang lain tetapi pelajar ini akan dapat elaun wang saku</td>
                                                {{-- <td><button type="button" class="btn btn-danger btn-sm"> Tidak layak menerima BKOKU</button></td> --}}
                                            </tr>
                                            <tr>
                                                <td>Athira Binti Zainal</td>
                                                <td class="text-center">PPK</td>
                                                <td class="text-center">7/4/2023</td>
                                                <td class="text-center">19/6/2023</td>
                                                <td><div style="color: green;">Pemohon layak memohon lagi</div></td>
                                                <td>Pelajar ini didapati menghantar borang yang tidak benar</td>
                                                {{-- <td><button type="button" class="btn btn-warning btn-sm"> Pemohon layak memohon sekali lagi</button></td> --}}
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
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
                            <h1>Rekod Permohonan</h1>
                        </div>
                        <hr>

                        {{-- Filter Function --}}
                            {{-- <form action="" method="GET">
                                <div class="row">
                                    <div class="col-md-2">
                                        <input type="date" name="date" value="{{Request::get('date')?? ' '}}" class="form-control"/>
                                    </div>
    
                                    <div class="col-md-6">
                                        <button type="submit" class="btn btn-primary" style="width: 10%;"><i class="fa fa-filter" style="font-size: 15px;"></i></button>
                                    </div>
                                </div>
                            </form>
                            --}}

                        <div class="card">
                            <div class="header">
                                <h2>Senarai Permohonan untuk Diluluskan<br><small>Sila klik pada ID permohonan untuk meluluskan permohonan</small></h2>
                                <ul class="header-dropdown dropdown" style="color: black;">
                                    <li><a href="{{ url('cetak-senarai-pemohon') }}" target="_blank" class="btn btn-secondary btn-round btn-sm"><i class="fa fa-print"></i>  Senarai Pendek</a></li>
                                </ul>
                                {{-- <ul class="header-dropdown dropdown">
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
                                </ul> --}}
                            </div>
                            <div class="body">
                                <div class="table-responsive">
                                    <table id="sortTable" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th style="width: 15%">ID Permohonan</th>
                                                <th style="width: 50%">Nama</th>
                                                <th style="width: 15%" class="text-center">Tarikh Permohonan</th>
                                                <th style="width: 20%" class="text-center">Status Permohonan</th>
                                            </tr>
                                        </thead>
                                            
                                        <tbody> 
                                            <tr>
                                                <td><a href="{{ url('maklumat-keputusan') }}" target="_blank">KPTBKOKUD020223015001</a></td> 
                                                <td>Ali Bin Abu</td> 
                                                <td class="text-center">02/07/2023</td>
                                                <td class="text-center"><button type="button" class="btn btn-sm" style="background-color:cornflowerblue; color:white;"> Disokong</button></td>
                                            </tr>

                                            <tr>
                                                <td><a href="{{ url('maklumat-keputusan') }}" target="_blank">KPTBKOKUB011221038712</a></td> 
                                                <td>Arina Binti Saleh</td> 
                                                <td class="text-center">04/07/2023</td>
                                                <td class="text-center"><button type="button" class="btn btn-sm" style="background-color:cornflowerblue; color:white;"> Disokong</button></td>
                                            </tr>

                                            <tr>
                                                <td><a href="{{ url('maklumat-keputusan') }}" target="_blank">KPTBKOKUB011221034612</a></td> 
                                                <td>Choo Mei Ling</td> 
                                                <td class="text-center">05/07/2023</td>
                                                <td class="text-center"><button type="button" class="btn btn-sm" style="background-color:cornflowerblue; color:white;"> Disokong</button></td>
                                            </tr>

                                            <tr>
                                                <td><a href="{{ url('maklumat-keputusan') }}" target="_blank">KPTBKOKUB001121035602</a></td> 
                                                <td>Sarah Binti Md Yunos</td>
                                                <td class="text-center">12/06/2023</td>
                                                <td class="text-center"><button type="button" class="btn btn-sm" style="background-color:cornflowerblue; color:white;"> Disokong</button></td>
                                                {{-- <td>Anda tidak disahkan sebagai pelajar OKU</td>  --}}
                                            </tr>

                                            <tr>
                                                <td><a href="{{ url('maklumat-keputusan') }}" target="_blank">KPTBKOKUB970804110016</a></td>
                                                <td>Tamila A/P Ganesh</td>
                                                <td class="text-center">20/06/2023</td>
                                                <td class="text-center"><button type="button" class="btn btn-sm" style="background-color:cornflowerblue; color:white;"> Disokong</button></td>
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
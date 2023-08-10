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
                                                <th style="width: 20%"><b>ID Permohonan</b></th>                                        
                                                <th style="width: 30%"><b>Nama</b></th>
                                                <th style="width: 15%"><b>Jenis Permohonan</b></th>
                                                <th style="width: 15%" class="text-center"><b>Tarikh Permohonan</b></th> 
                                                <th class="text-center" style="width: 15%">Status Permohonan</th>
                                            </tr>
                                        </thead>
                                        
                                        <tbody>
                                            <tr>
                                                <td><a href="{{ url('maklumat-keputusan') }}" title="">KPTBKOKU/3/990404080221</a></td>
                                                <td>Santosh A/L Ariyaran</td>
                                                <td>BKOKU</td>
                                                <td class="text-center">07/02/2023</td>
                                                <td class="text-center"><button type="button" class="btn btn-sm" style="background-color:cornflowerblue; color:white;">Disokong</button></td>
                                            </tr>
    
                                            <tr>
                                                <td><a href="{{ url('maklumat-keputusan') }}" title="">KPTPPK/5/970204052445</a></td>
                                                <td>Sarah Binti Yusri</td>
                                                <td>PPK</td>                                        
                                                <td class="text-center">05/03/2023</td>
                                                <td class="text-center"><button type="button" class="btn btn-sm" style="background-color:cornflowerblue; color:white;">Disokong</button></td>
                                            </tr>  
    
                                            <tr data-status="Disokong">
                                                <td><a href="{{ url('maklumat-keputusan') }}" title="">KPTBKOKU/3/980112105666</a></td>
                                                <td>Aishah Binti Samsudin</td>
                                                <td>BKOKU</td>                                       
                                                <td class="text-center">02/03/2023</td>
                                                <td class="text-center"><button type="button" class="btn btn-sm" style="background-color:cornflowerblue; color:white;">Disokong</button></td>
                                            </tr>
    
                                            <tr data-status="Disokong">
                                                <td><a href="{{ url('maklumat-keputusan') }}" title="">KPT/BKOKU/M/970703041223</a></td>
                                                <td>Mohd Ali Bin Abu Kassim</td>
                                                <td>BKOKU</td>                                        
                                                <td class="text-center">06/08/2023</td>
                                                <td class="text-center"><button type="button" class="btn btn-sm" style="background-color:cornflowerblue; color:white;">Disokong</button></td>
                                            </tr>
    
                                            <tr data-status="Disokong">
                                                <td><a href="{{ url('maklumat-keputusan') }}" title="">KPTBKOKU/4/960909105668</a></td>
                                                <td>Ling Kai Jie</td>
                                                <td>BKOKU</td>                                        
                                                <td class="text-center">09/04/2023</td>
                                                <td class="text-center"><button type="button" class="btn btn-sm" style="background-color:cornflowerblue; color:white;">Disokong</button></td>
                                            </tr>
    
                                            <tr data-status="Disokong">
                                                <td><a href="{{ url('maklumat-keputusan') }}" title="">KPTPPK/2/021212050334</a></td>
                                                <td>Santishwaran A/L Paven</td>
                                                <td>PPK</td>                                        
                                                <td class="text-center">05/06/2023</td>
                                                <td class="text-center"><button type="button" class="btn btn-sm" style="background-color:cornflowerblue; color:white;">Disokong</button></td>
                                            </tr>
    
                                            <tr>
                                                <td><a href="{{ url('maklumat-keputusan') }}" title="">KPTBKOKU/3/001205034745</a></td>
                                                <td>Choo Mei Ling</td>
                                                <td>BKOKU</td>
                                                <td class="text-center">07/06/2023</td>
                                                <td class="text-center"><button type="button" class="btn btn-sm" style="background-color:cornflowerblue; color:white;">Disokong</button></td>
                                            </tr>
                                            
                                            <tr data-status="Disokong">
                                                <td><a href="{{ url('maklumat-keputusan') }}" title="">KPTBKOKU/6/890201065225</a></td>
                                                <td>Ezra Hanisah Binti Md Yunos</td>
                                                <td>BKOKU</td>                                    
                                                <td class="text-center">19/02/2023</td>
                                                <td class="text-center"><button type="button" class="btn btn-sm" style="background-color:cornflowerblue; color:white;">Disokong</button></td>
                                            </tr>
                                            
                                            <tr data-status="Disokong">
                                                <td><a href="{{ url('maklumat-keputusan') }}" title="">KPTPPK/5/981004045253</a></td>
                                                <td>Syed Abdul Kassim Hussain Yusof</td>
                                                <td>PPK</td>                                        
                                                <td class="text-center">25/05/2023</td>
                                                <td class="text-center"><button type="button" class="btn btn-sm" style="background-color:cornflowerblue; color:white;">Disokong</button></td>
                                            </tr>
                                            
                                            <tr data-status="Disokong">
                                                <td><a href="{{ url('maklumat-keputusan') }}" title="">KPTBKOKU/5/940524032341</a></td>
                                                <td>Rahman Mohammed Arshahad Al-dhaqm</td>
                                                <td>BKOKU</td>                                    
                                                <td class="text-center">09/07/2023</td>
                                                <td class="text-center"><button type="button" class="btn btn-sm" style="background-color:cornflowerblue; color:white;">Disokong</button></td>
                                            </tr>
                                            
                                            <tr data-status="Disokong">
                                                <td><a href="{{ url('maklumat-keputusan') }}" title="">KPTBKOKU/4/950623035672</a></td>
                                                <td>Wan Nurul Syafiqah Binti Wan Sahak</td>
                                                <td>BKOKU</td>
                                                <td class="text-center">09/08/2023</td>
                                                <td class="text-center"><button type="button" class="btn btn-sm" style="background-color:cornflowerblue; color:white;">Disokong</button></td>
                                            </tr>
    
                                            <tr data-status="Disokong">
                                                <td><a href="{{ url('maklumat-keputusan') }}" title="">KPTBKOKU/6/930907030098</a></td>
                                                <td>Siti Aisyah Binti Ismail</td>
                                                <td>BKOKU</td>
                                                <td class="text-center">21/05/2023</td>
                                                <td class="text-center"><button type="button" class="btn btn-sm" style="background-color:cornflowerblue; color:white;">Disokong</button></td>
                                            </tr>
    
                                            <tr data-status="Disokong">
                                                <td><a href="{{ url('maklumat-keputusan') }}" title="">KPTPPK/5/950523098909</a></td>
                                                <td>Muhammad Aiman Bin Hamid</td>
                                                <td>PPK</td>
                                                <td class="text-center">29/07/2023</td>
                                                <td class="text-center"><button type="button" class="btn btn-sm" style="background-color:cornflowerblue; color:white;">Disokong</button></td>
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
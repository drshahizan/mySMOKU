<x-default-layout>
    <head>
        <title>Sekretariat BKOKU KPT</title>
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
                            <h1>Status Permohonan BKOKU</h1>
                        </div>
                        <hr>
                    </div>
                </div>
                {{-- Card section --}}
                <div class="row clearfix">
                    <div class="col-lg-6 col-md-12">
                        {{-- Jumlah --}}
                        <div class="card" style="padding: 20px;">
                            <div class="header">
                                <h2>Jumlah Keseluruhan Permohonan</h2>
                            </div>
                            
                            <div class="card-body">
                                <div class="row text-center">
                                    <div class="col-6 border-right pb-4 pt-4">
                                        <label class="3">Permohonan BKOKU</label>
                                        <h4 class="font-30 font-weight-bold text-col-blue">2,025</h4>
                                    </div>
                                    <div class="col-6 pb-4 pt-4">
                                        <label class="mb-0">Permohonan PPK</label>
                                        <h4 class="font-30 font-weight-bold text-col-blue">1,254</h4>
                                    </div>
                                </div>
                            </div>
                                
                            <div class="card">
                                <div class="body">
                                    <ul class="list-group">
                                        <li class="list-group-item d-flex justify-content-between align-items-center">Draf<span>14</span></li>
                                        <li class="list-group-item d-flex justify-content-between align-items-center">Baru<span>200</span></li>
                                        <li class="list-group-item d-flex justify-content-between align-items-center">Saringan<span>1000</span></li>
                                        <li class="list-group-item d-flex justify-content-between align-items-center">Dikembalikan<span>4</span></li>
                                        <li class="list-group-item d-flex justify-content-between align-items-center">Disokong<span>2000</span></li>
                                        <li class="list-group-item d-flex justify-content-between align-items-center">Layak<span>3277</span></li>
                                        <li class="list-group-item d-flex justify-content-between align-items-center">Tidak Layak<span>2</span></li>
                                    </ul>
                                </div>
                            </div>
                            </div>
                        </div>
                    
                    <div class="col-lg-6 col-md-12">
                        {{-- Kategori --}}
                        <div class="card" style="padding: 20px;">
                            <div class="header">
                                <h2>Kategori Permohonan</h2>
                            </div>
                            <div class="body">
                                <ul class="nav nav-tabs2">
                                    <li class="nav-item"><a class="nav-link active show" data-toggle="tab" href="#Home-new">BKOKU</a></li>
                                    <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#Profile-new">PPK</a></li>
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane show vivify flipInX active" id="Home-new">
                                        <br>
                                        <h6>Permohonan BKOKU</h6>
                                        <div class="row clearfix">
                                            <div class="col-lg-12 col-md-12">
                                            <div class="card">
                                                <div class="body">
                                                    <ul class="list-group">
                                                        <li class="list-group-item d-flex justify-content-between align-items-center">Draf<span class="badge badge-default">14</span></li>
                                                        <li class="list-group-item d-flex justify-content-between align-items-center">Baru<span class="badge badge-primary">2</span></li>
                                                        <li class="list-group-item d-flex justify-content-between align-items-center">Saringan<span class="badge badge-info">1900</span></li>
                                                        <li class="list-group-item d-flex justify-content-between align-items-center">Dikembalikan<span class="badge badge-warning">1400</span></li>
                                                        <li class="list-group-item d-flex justify-content-between align-items-center">Disokong<span class="badge badge-success">2000</span></li>
                                                        <li class="list-group-item d-flex justify-content-between align-items-center">Layak<span class="badge badge-success">1400</span></li>
                                                        <li class="list-group-item d-flex justify-content-between align-items-center">Tidak Layak<span class="badge badge-danger">2</span></li>
                                                    </ul>
                                                </div>
                                            </div>
                                            
                                            </div>
                                            
                                            </div>
                                    
                                    </div>    
                                    
                                
                                    <div class="tab-pane vivify flipInX" id="Profile-new">
                                        <br>
                                        <h6>Permohonan Program Pendidikan Khas (PPK)</h6>
                                        <div class="row clearfix">
                                            <div class="col-lg-12 col-md-12">
                                            <div class="card">
                                                <div class="body">
                                                    <ul class="list-group">
                                                        <li class="list-group-item d-flex justify-content-between align-items-center">Draf<span class="badge badge-default">11</span></li>
                                                        <li class="list-group-item d-flex justify-content-between align-items-center">Baru<span class="badge badge-primary">2</span></li>
                                                        <li class="list-group-item d-flex justify-content-between align-items-center">Saringan<span class="badge badge-info">1000</span></li>
                                                        <li class="list-group-item d-flex justify-content-between align-items-center">Dikembalikan<span class="badge badge-warning">12</span></li>
                                                        <li class="list-group-item d-flex justify-content-between align-items-center">Disokong<span class="badge badge-success">3000</span></li>
                                                        <li class="list-group-item d-flex justify-content-between align-items-center">Layak<span class="badge badge-success">1000</span></li>
                                                        <li class="list-group-item d-flex justify-content-between align-items-center">Tidak Layak<span class="badge badge-danger">2</span></li>
                                                    </ul>
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
                {{-- End of Card section --}}

                <br>

                {{-- Small card section --}}
                <div class="row clearfix">
                        <div class="col-lg-3 col-md-6">
                            <div class="card">
                                <div class="card-body top_counter">
                                    <div class="icon bg-success text-black"><i class="fa fa-check-circle-o"></i> </div>
                                    <div class="content" style="text-align: center; color:black">
                                        <span style="font-size:small;">Permohonan Aktif BKOKU</span>
                                        <h5 class="number mb-0">2000</h5>
                                    </div>
                                </div>                        
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <div class="card">
                                <div class="card-body top_counter">
                                    <div class="icon bg-danger text-black"><i class="fa fa-times"></i> </div>
                                    <div class="content" style="text-align: center; color:black">
                                        <span style="font-size:small;">Permohonan Tidak Aktif BKOKU</span>
                                        <h5 class="number mb-0">25</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <div class="card">
                                <div class="card-body top_counter">
                                    <div class="icon bg-success text-black"><i class="fa fa-check-circle-o"></i> </div>
                                    <div class="content" style="text-align: center; color:black">
                                        <span style="font-size:small;">Permohonan Aktif PPK</span>
                                        <h5 class="number mb-0">1200</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <div class="card">
                                <div class="card-body top_counter">
                                    <div class="icon bg-danger text-black"><i class="fa fa-times"></i> </div>
                                    <div class="content" style="text-align: center; color:black">
                                        <span style="font-size:small;">Permohonan Tidak Aktif PPK</span>
                                        <h5 class="number mb-0">54</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- Small card section --}}

                    <br>

                    {{-- Filter section --}}
                    <div class="row clearfix">
                        <div class="col-lg-4 col-md-12 col-sm-12">
                            <h4>Tapis Status Permohonan</h4> 
                        </div>

                        <div class="col-lg-8 col-md-12 col-sm-12 text-lg-right">
                            <button type="button" class="btn btn-default btn-filter" data-target="all">Semua</button>
                            <button type="button" class="btn btn-primary btn-filter" data-target="Baru">Baru</button>
                            <button type="button" class="btn btn-info btn-filter" data-target="Saringan">Saringan</button>
                            <button type="button" class="btn btn-secondary btn-filter" data-target="Disokong">Disokong</button>
                            <button type="button" class="btn btn-success btn-filter" data-target="Layak">Layak</button>
                            <button type="button" class="btn btn-danger btn-filter" data-target="Tidak Layak">Tidak Layak</button>
                            <button type="button" class="btn btn-warning btn-filter" data-target="Dikembalikan">Dikembalikan</button>
                            <button type="button" class="btn btn-success btn-filter" data-target="Aktif">Aktif</button>
                            <button type="button" class="btn btn-danger btn-filter" data-target="Tidak Aktif">Tidak Aktif</button>
                        </div>
                    </div>
                    <div class="col-md-3 align-right">
                        <label style="color:black">Tapis Status Permohonan
                        <select name="status" class="form-select">
                            <option value="">Pilih Keputusan Tuntutan</option>
                            <option value="Layak" {{Request::get('status') == 'Layak' ? 'selected':'' }} >Layak</option>
                            <option value="Dikembalikan" {{Request::get('status') == 'Dikembalikan' ? 'selected':'' }} >Dikembalikan</option>
                            <option value="Tidak Layak" {{Request::get('status') == 'Tidak Layak' ? 'selected':'' }} >Tidak Layak</option>
                        </select>
                    </div>

                    {{-- Table senarai --}}
                    <div class="row clearfix">
                    <div class="col-lg-12">
                        <div class="card bg-clear">
                            <div class="header">
                                <h2>Senarai Permohonan</h2>
                                 
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
                              
                                <table class="table table-hover table-custom spacing">
                                    <!--<thead>
                                        <tr> 
                                            <th>Nama Pemohon</th>
                                            <th>Jenis Permohonan</th>
                                            <th>ID Permohonan</th>  
                                            <th>Status Permohonan</th>
                                        </tr>
                                    </thead>-->
                                    <thead>
                                        <tr> 
                                            <th>Nama Pemohon</th>
                                            <th>Jenis Permohonan</th>
                                            <th>ID Permohonan</th>  
                                            <th>Status Permohonan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr data-status="Saringan">
                                            <td>
                                                Ali Bin Abu
                                            </td>
                                            <td>
                                                BKOKU
                                            </td>
                                            <td>
                                               SARJANABKOKU00012
                                            </td>
                                            
                                            <td>Saringan</td>
                                        </tr>
                                        <tr data-status="Saringan">
                                            <td>
                                               Sarah Yunos
                                            </td>
                                            <td>
                                               PPK
                                            </td>
                                            <td>
                                               DIPPPK01012
                                            </td>
                                            
                                            <td>Saringan</td>
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
                                            
                                            <td>Saringan</td>
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
                                            
                                            <td>Saringan</td>
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
                                            
                                            <td>Disokong</td>
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
                                            
                                            <td>Layak</td>
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
                                            
                                            <td>Disokong</td>
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
                                            
                                            <td>Disokong</td>
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
                                            
                                            <td>Tidak Layak</td>
                                        </tr>
                                        
                                        <tr data-status="Tidak Layak">
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
                                            
                                            <td>Baru</td>
                                        </tr>
                                        
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
                                            
                                            <td>Baru</td>
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
                                            
                                            <td>Disokong</td>
                                        </tr>
                                        
                                        <tr data-status="Disokong">
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
                                            
                                            <td>Aktif</td>
                                        </tr>
                                        
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
                                            
                                            <td>Dikembalikan</td>
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
                                            
                                            <td>Dikembalikan</td>
                                        </tr>
                                        
                                        <tr data-status="Aktif">
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
                                            
                                            <td>Aktif</td>
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
                                            
                                            <td>Tidak Aktif</td>
                                        </tr>               
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
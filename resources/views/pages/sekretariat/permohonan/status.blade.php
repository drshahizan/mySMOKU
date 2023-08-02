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
                <div class="block-header">
                    <div class="row clearfix">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="header" style="background-color:lightgrey; padding:10px;">
                                    <h2><b>Status Permohonan BKOKU</b></h2>
                                </div>
                                
                                <div class="body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-striped">
                                            <thead>
                                                <tr style="color: black; font-size:14px; text-align:center;">
                                                    <th >Nama</th>       
                                                    <th >ID Tuntutan</th>
                                                    <th >Tarikh Tuntutan</th>
                                                    <th >Keputusan Tuntutan</th>
                                                    <th >Catatan</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr style="color:black">
                                                    <td>Ali Bin Abu</td> 
                                                    <td><a href="tuntut-Ali.html">TTBKOKU00012</a></td> 
                                                    <td>2/7/2023</td>
                                                    <td> <button type="button" class="btn btn-success "> Layak</button></td>
                                                    <td>
                                                        <a href="#" class="btn btn-success btn-round"><i class="icon-check"></i> Dikreditkan pada 12/7/2023</a>
                                                    </td>
                                                </tr>
                                            
                                                <tr style="color:black">
                                                    <td>Sarah Binti Md Yunos</td> 
                                                    <td><a href="#">TTBKOKU01012</a></td> 
                                                    <td>4/7/2022</td>
                                                    <td> <button type="button" class="btn btn-success "> Layak</button></td>
                                                    <td>
                                                        <a href="#" class="btn btn-success btn-round"><i class="icon-check"></i> Dikreditkan pada 12/7/2022</a>
                                                    </td>
                                                </tr>

                                                <tr style="color:black">
                                                    <td> Eng Mei Ying </td>
                                                    <td><a href="#">TTBKOKU90012</a></td>
                                                    <td>2/2/2022</td>
                                                    <td> <button type="button" class="btn btn-warning ">Dikembalikan</button></td>
                                                    <td> Terdapat kesilapan dalam butiran resit </td>
                                                </tr>
                                                
                                                <tr style="color:black">
                                                    <td>Tan Yu Heng</td>
                                                    <td>
                                                        <a href="#">TTBKOKU09012</a>
                                                    </td>
                                                    <td>2/2/2023</td>
                                                    <td> <button type="button" class="btn btn-warning ">Dikembalikan</button></td>
                                                    <td> Terdapat kesilapan dalam butiran salinan resit </td>
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
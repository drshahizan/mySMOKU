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
        <div class="py-3 py-md-5">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="shadow bg-white p-3">
                            <div class="card-header" style="background-color:aliceblue; padding:5px;">
                                <h1><b>Keputusan Permohonan BKOKU</b>
                            </div>
                            <hr>
                            
                            <div class="card-body">
                                <form action="" method="GET">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label style="color:black">Tapis mengikut Tarikh</label>
                                            <input type="date" name="date" value="{{Request::get('date')?? ' '}}" class="form-control"/>
                                        </div>
        
                                        <div class="col-md-3">
                                            <label style="color:black">Tapis mengikut Keputusan</label>
                                            <select name="status" class="form-select">
                                                <option value="">Pilih Keputusan Tuntutan</option>
                                                <option value="Layak" {{Request::get('status') == 'Layak' ? 'selected':'' }} >Layak</option>
                                                <option value="Dikembalikan" {{Request::get('status') == 'Dikembalikan' ? 'selected':'' }} >Dikembalikan</option>
                                                <option value="Tidak Layak" {{Request::get('status') == 'Tidak Layak' ? 'selected':'' }} >Tidak Layak</option>
                                            </select>
                                        </div>
        
                                        <div class="col-md-6">
                                            <br>
                                            <button type="submit" class="btn btn-primary">Filter</button>
                                        </div>
                                    </div>
                                </form>
                                <hr>
        
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped">
                                        <thead>
                                            <tr style="color:black; font-size:12px;">
                                                <th>Nama</th>
                                                <th>ID Tuntutan</th>
                                                <th>Tarikh Tuntutan</th>
                                                <th>Keputusan Tuntutan</th>
                                                <th>Catatan</th>
                                            </tr>
                                        </thead>
                                            
                                        <tbody> 
                                                <tr>
                                                    <td style="color:black">Ali Bin Abu</td> 
                                                    <td><a href="tuntut-Ali.html">TTBKOKU00012</a></td> 
                                                    <td style="color:black">2/7/2023</td>
                                                    <td> <button type="button" class="btn btn-success btn-sm"> Layak</button></td>
                                                    <td style="color:black">Dikreditkan pada 12/7/2023</td>
                                                </tr>

                                                <tr style="color:black">
                                                    <td>Sarah Binti Md Yunos</td> 
                                                    <td><a href="#">TTBKOKU01012</a></td> 
                                                    <td>4/7/2022</td>
                                                    <td> <button type="button" class="btn btn-danger btn-sm"> Tidak Layak</button></td>
                                                    <td>Anda tidak disahkan sebagai pelajar OKU</td>
                                                </tr>

                                                <tr>
                                                    <td style="color:black"> Eng Mei Ying </td>
                                                    <td><a href="#">TTBKOKU90012</a></td>
                                                    <td style="color:black">2/2/2022</td>
                                                    <td><button type="button" class="btn btn-warning btn-sm"> Dikembalikan</button></td>
                                                    <td style="color:black"> Terdapat kesilapan dalam butiran resit </td>
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
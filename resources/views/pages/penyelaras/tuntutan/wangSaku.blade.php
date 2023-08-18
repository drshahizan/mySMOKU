<x-default-layout>
    <head>
        <title>Penyelaras BKOKU KPT</title>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">

        <!-- MAIN CSS -->
        <link rel="stylesheet" href="assets/css/sekretariat.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js"></script>
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9">
        <!-- CSS -->
        <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css"/>
        <!-- Default theme -->
        <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/default.min.css"/>
    </head>

    <body>
        <!-- Main body part  -->
        <div id="main-content">
            <div class="container-fluid">
                <div class="block-header">
                    <div class="row clearfix">
                        <div class="col-lg-6 col-md-12 col-sm-12">
                            <h1>Tuntutan Wang Saku</h1>
                        </div>
                        <hr>
                        <div class="card">
                            <div class="header">
                                <h2>Senarai Pelajar Yang Layak untuk Tuntutan Wang Saku<br><small>Sila klik pada ID tuntutan untuk melengkapkan borang Tuntutan Wang Saku</small></h2>
                            </div>

                            <div class="table-responsive">
                                <div class="body">
                                    <table id="sortTable" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th style="width: 15%"><b>ID Tuntutan</b></th>                                        
                                                <th style="width: 50%"><b>Nama</b></th>
                                                <th style="width: 15%"><b>Jenis Permohonan</b></th>
                                                <th style="width: 15%" class="text-center"><b>Tarikh Tuntutan</b></th> 
                                            </tr>
                                        </thead>
                                        
                                        <tbody>
                                            <tr>
                                                <td><a href="{{ url('maklumat-tuntutan-wang-saku') }}" title="">KPTBKOKU/3/990404080221</a></td>
                                                <td>Santosh A/L Ariyaran</td>
                                                <td>BKOKU</td>
                                                <td class="text-center">07/02/2023</td>
                                            </tr>
                                            <tr>
                                                <td><a href="{{ url('maklumat-tuntutan-wang-saku') }}" title="">KPTBKOKU/3/980112105666</a></td>
                                                <td>Aishah Binti Samsudin</td>
                                                <td>BKOKU</td>                                       
                                                <td class="text-center">02/03/2023</td>
                                            </tr>
                                            <tr>
                                                <td><a href="{{ url('maklumat-tuntutan-wang-saku') }}" title="">KPTBKOKU/4/970703041223</a></td>
                                                <td>Mohd Ali Bin Abu Kassim</td>
                                                <td>BKOKU</td>                                        
                                                <td class="text-center">08/07/2023</td>
                                            </tr>
                                            <tr>
                                                <td><a href="{{ url('maklumat-tuntutan-wang-saku') }}" title="">KPTBKOKU/6/890201065225</a></td>
                                                <td>Ezra Hanisah Binti Md Yunos</td>
                                                <td>BKOKU</td>                                    
                                                <td class="text-center">19/02/2023</td>
                                            </tr>
                                            <tr>
                                                <td><a href="{{ url('maklumat-tuntutan-wang-saku') }}" title="">KPTBKOKU/5/940524032341</a></td>
                                                <td>Rahman Mohammed Arshahad Al-dhaqm</td>
                                                <td>BKOKU</td>                                    
                                                <td class="text-center">09/07/2023</td>
                                            </tr>
                                            <tr>
                                                <td><a href="{{ url('maklumat-tuntutan-wang-saku') }}" title="">KPTBKOKU/6/930907030098</a></td>
                                                <td>Siti Aisyah Binti Ismail</td>
                                                <td>BKOKU</td>
                                                <td class="text-center">21/05/2023</td>
                                            </tr>
                                            <tr>
                                                <td><a href="{{ url('maklumat-tuntutan-wang-saku') }}" title="">KPTBKOKU/5/950523098909</a></td>
                                                <td>Muhammad Aiman Bin Hamid</td>
                                                <td>BKOKU</td>
                                                <td class="text-center">29/07/2023</td>
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
    </body>
    <script>
        $('#sortTable').DataTable();
    </script>
</x-default-layout> 
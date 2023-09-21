<x-default-layout> 
    <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
        <!--begin::Title-->
        <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Tuntutan</h1>
        <!--end::Title-->
        <!--begin::Breadcrumb-->
        <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
            <!--begin::Item-->
            <li class="breadcrumb-item text-muted">
                <a href="/" class="text-dark text-hover-primary" style="color:darkblue">Tuntutan</a>
            </li>
            <!--end::Item-->
            <!--begin::Item-->
            <li class="breadcrumb-item">
                <span class="bullet bg-gray-400 w-5px h-2px"></span>
            </li>
            <!--end::Item-->
            <!--begin::Item-->
            <li class="breadcrumb-item text-dark" style="color:darkblue">Keseluruhan Tuntutan</li>
            <!--end::Item-->
        </ul>
        <!--end::Breadcrumb-->
    </div>
    <br>
        <head>
        <!-- MAIN CSS -->
        <link rel="stylesheet" href="/assets/css/saringan.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js"></script>
        </head>
    
            <div class="row clearfix">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="header">
                            <h2>Senarai Keseluruhan Tuntutan</h2>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table id="sortTable" class="table table-striped table-hover dataTable js-exportable">
                                    <thead>
                                        <tr>
                                            <th style="width: 17%"><b>ID Tuntutan</b></th>                                        
                                            <th style="width: 33%"><b>Nama</b></th>
                                            <th style="width: 33%"><b>Institusi</b></th>
                                            <th style="width: 15%" class="text-center"><b>Tarikh Tuntutan</b></th>
                                            <th style="width: 15%" class="text-center"><b>Status Tuntutan</b></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
                                        <tr>
                                            <td><a href="">P/</a></td>
                                            <td>404</td>
                                            <td>404</td>
                                            <td class="text-center">404</td>
                                            <td class="text-center"><button class="btn bg-batal text-white">Belum Mohon</button></td> 
                                        </tr>  
                                       
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        {{-- End of Body --}}
                    </div>
                </div>
            </div>                             
    </x-default-layout> 
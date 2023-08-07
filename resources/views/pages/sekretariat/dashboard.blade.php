{{-- <x-default-layout>
    <h1>Selamat Datang, Sekretariat KPT</h1>
</x-default-layout> --}}

<x-default-layout>
    <head>
        <title>Dashboard Sekretariat</title>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">

        <!-- MAIN CSS -->
        <link rel="stylesheet" href="assets/css/sekretariat.css">
    </head>

    <body>
        <div class="main-content">
            <div class="container-fluid">
                <div class="block-header">
                    <div class="row clearfix">
                        <div class="col-lg-6 col-md-12 col-sm-12">
                            <h1>Selamat Datang ke Dashboard Sekretariat</h1>
                        </div>
                        <hr>
                        {{-- Level 1 of Section --}}
                        <div class="col-lg-3 col-md-6">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <div class="icon-in-bg bg-indigo text-white rounded-circle" style="padding-left:0;"><i class="fa fa-check"></i></div>
                                        <div class="ml-4">
                                            <span style="color: black;"> Aktif BKOKU</span>
                                            <h4 class="mb-0 font-weight-medium">2000</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-6">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <div class="icon-in-bg bg-azura text-white rounded-circle"><i class="fa fa-times" style="color: white"></i></div>
                                        <div class="ml-4">
                                            <span style="color: black"> Tidak Aktif BKOKU</span>
                                            <h4 class="mb-0 font-weight-medium">25</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-lg-3 col-md-6">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <div class="icon-in-bg bg-orange text-white rounded-circle"><i class="fa fa-check"></i></div>
                                        <div class="ml-4">
                                            <span style="color: black"> Aktif PPK</span>
                                            <h4 class="mb-0 font-weight-medium">1200</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-lg-3 col-md-6">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <div class="icon-in-bg bg-pink text-white rounded-circle"><i class="fa fa-times" style="color: white"></i></div>
                                        <div class="ml-4">
                                            <span style="color: black"> Tidak Aktif PPK</span>
                                            <h4 class="mb-0 font-weight-medium">54</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr>

                    {{-- Level 2 of Card Section --}}
                    <div class="row clearfix">
                        <div class="col-lg-3 col-md-6">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <div class="icon-in-bg bg-indigo text-white rounded-circle" style="padding-left:0;"><i class="fa fa-check"></i></div>
                                        <div class="ml-4">
                                            <span style="color: black;"> Aktif BKOKU</span>
                                            <h4 class="mb-0 font-weight-medium">2000</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-6">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <div class="icon-in-bg bg-azura text-white rounded-circle"><i class="fa fa-times" style="color: white"></i></div>
                                        <div class="ml-4">
                                            <span style="color: black"> Tidak Aktif BKOKU</span>
                                            <h4 class="mb-0 font-weight-medium">25</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-lg-3 col-md-6">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <div class="icon-in-bg bg-orange text-white rounded-circle"><i class="fa fa-check"></i></div>
                                        <div class="ml-4">
                                            <span style="color: black"> Aktif PPK</span>
                                            <h4 class="mb-0 font-weight-medium">1200</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-lg-3 col-md-6">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <div class="icon-in-bg bg-pink text-white rounded-circle"><i class="fa fa-times" style="color: white"></i></div>
                                        <div class="ml-4">
                                            <span style="color: black"> Tidak Aktif PPK</span>
                                            <h4 class="mb-0 font-weight-medium">54</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr>

                    {{-- Level 3 of Card Section --}}
                    <div class="row clearfix">
                        <div class="col-lg-3 col-md-6">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <div class="icon-in-bg bg-indigo text-white rounded-circle" style="padding-left:0;"><i class="fa fa-check"></i></div>
                                        <div class="ml-4">
                                            <span style="color: black;"> Aktif BKOKU</span>
                                            <h4 class="mb-0 font-weight-medium">2000</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-6">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <div class="icon-in-bg bg-azura text-white rounded-circle"><i class="fa fa-times" style="color: white"></i></div>
                                        <div class="ml-4">
                                            <span style="color: black"> Tidak Aktif BKOKU</span>
                                            <h4 class="mb-0 font-weight-medium">25</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-lg-3 col-md-6">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <div class="icon-in-bg bg-orange text-white rounded-circle"><i class="fa fa-check"></i></div>
                                        <div class="ml-4">
                                            <span style="color: black"> Aktif PPK</span>
                                            <h4 class="mb-0 font-weight-medium">1200</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-lg-3 col-md-6">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <div class="icon-in-bg bg-pink text-white rounded-circle"><i class="fa fa-times" style="color: white"></i></div>
                                        <div class="ml-4">
                                            <span style="color: black"> Tidak Aktif PPK</span>
                                            <h4 class="mb-0 font-weight-medium">54</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</x-default-layout>

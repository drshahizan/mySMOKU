<head>
    <title>{{ config('app.name', 'SistemBKOKU') }}</title>
    <link rel="stylesheet" href="/assets/css/style.bundle.css">
    <link rel="stylesheet" href="/assets/css/sekretariat.css">
    <style>
        body{
            margin: 20px!important;
        }
        table, td, tr{
            border: none!important;
            padding:2px 8px!important;
            font-size: 10pt;
        }
        td{
            vertical-align: top!important;
        }
        .space{
            width: 15%;
        }
    </style>
</head>

<body>
    <!--begin::Page title-->
    <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
        <!--begin::Title-->
        <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Permohonan</h1>
        <!--end::Title-->
        <!--begin::Breadcrumb-->
        <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
            <!--begin::Item-->
            <li class="breadcrumb-item text-dark" style="color:darkblue">Permohonan</li>
            <!--end::Item-->
            <!--begin::Item-->
            <li class="breadcrumb-item">
                <span class="bullet bg-gray-400 w-5px h-2px"></span>
            </li>
            <!--end::Item-->
            <!--begin::Item-->
            <li class="breadcrumb-item text-dark" style="color:darkblue">Sejarah</li>
            <!--end::Item-->
            <!--begin::Item-->
            <li class="breadcrumb-item">
                <span class="bullet bg-gray-400 w-5px h-2px"></span>
            </li>
            <!--end::Item-->
            <!--begin::Item-->
            <li class="breadcrumb-item text-dark" style="color:darkblue">Rekod Maklumat Permohonan</li>
            <!--end::Item-->
        </ul>
        <!--end::Breadcrumb-->
    </div>
    <!--end::Page title-->

    <br>

    <!-- Main body part  -->
    <div id="main-content">
        <div class="container-fluid">
            <!-- Page header section  -->
            <div class="row clearfix">
                <div class="col-12">
                    <nav class="navbar navbar-expand-sm navbar-light bg-light page_menu">
                        <div class="collapse navbar-collapse" id="navbarNavDropdown">
                            <ul class="navbar-nav mr-auto">
                                <li class="nav-item vivify swoopInTop delay-150 active"><b>Rekod Keputusan Permohonan</b></li>
                            </ul>
                        </div>
                    </nav>
                </div>

                <div class="col-lg-12">
                    <div class="card">
                        <div class="body">
                            <div class="row clearfix">
                                <div class="col-md-6 col-sm-6">
                                    <br>
                                    <table class="maklumat">
                                        @php
                                            $status = DB::table('bk_status')->where('kod_status', $sejarah_p->status)->value('status');
                                        @endphp
                                        <tr>
                                            <td><strong>Nama </strong></td>
                                            <td><b>:</b></td>
                                            <td >{{$smoku->nama}}</td>
                                            <td class="space">&nbsp;</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Tarikh Permohonan </strong></td>
                                            <td><b>:</b></td>
                                            <td>{{$permohonan['created_at']->format('d/m/Y')}}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>ID Permohonan </strong></td>
                                            <td><b>:</b></td>
                                            <td>{{$permohonan->no_rujukan_permohonan}}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Status Permohonan </strong></td>
                                            <td><b>:</b></td>
                                            <td>{{$status}}</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>

                            <hr><br>

                            <div class="col-md-6 col-sm-6">
                                <table>
                                    <tr>
                                        <td><b>No. Mesyuarat</b></td>
                                        <td><b>:</b></td>
                                        <td>{{$kelulusan->no_mesyuarat}}</td>
                                    </tr>
                                    <tr>
                                        <td><b>Tarikh Mesyuarat</b></td>
                                        <td><b>:</b></td>
                                        <td>{{date('d/m/Y', strtotime($kelulusan->tarikh_mesyuarat))}}</td>
                                    </tr>
                                    <tr>
                                        <td><b>Keputusan</b></td>
                                        <td><b>:</b></td>
                                        <td>
                                            {{$kelulusan->keputusan}}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><b>Catatan</b></td>
                                        <td><b>:</b></td>
                                        <td>{{$kelulusan->catatan}}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

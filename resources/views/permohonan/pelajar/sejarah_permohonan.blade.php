<x-default-layout>
    <head>
        <title>Sekretariat BKOKU KPT</title>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">

        <!-- MAIN CSS -->
        <link rel="stylesheet" href="/assets/css/saringan.css">
        <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js"></script>
    </head>

    <style>
        .nav{
            margin-left: 10px!important;
        }
    </style>

    <!--begin::Page title-->
    <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
        <!--begin::Title-->
        <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Tuntutan</h1>
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
        </ul>
        <!--end::Breadcrumb-->
    </div>
    <!--end::Page title-->
    <br>
    <body>
    <!-- Main body part  -->
    <div id="main-content">
        <div class="container-fluid">
            <!-- Page header section  -->
            <div class="row clearfix">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="header">
                            <h2>Sejarah Permohonan</h2>
                        </div>

                        <div class="tab-content" id="myTabContent">

                            <div class="tab-pane fade show active" id="ppk" role="tabpanel" aria-labelledby="ppk-tab">
                                <br>
                                <div class="body">
                                    <div class="table-responsive">
                                        <table id="sortTable2" class="table table-striped table-hover dataTable js-exportable">
                                            <thead>
                                            <tr>
                                                <th style="width: 17%"><b>ID Permohonan</b></th>
                                                <th style="width: 15%" class="text-center"><b>Tarikh Permohonan</b></th>
                                                <th style="width: 15%" class="text-center"><b>Peringkat Pengajian</b></th>
                                                <th style="width: 15%" class="text-center"><b>Status Terkini</b></th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                                
                                                @foreach ($permohonan as $item)
                                                
                                                    @php
                                                        
                                                        $status = DB::table('bk_status')->where('kod_status', $item['status'])->value('status');

                                                        $no_rujukan_permohonan = $item['no_rujukan_permohonan'];

                                                        // Extract peringkat pengajian value using regular expression
                                                        preg_match('/\/(\d+)\//', $no_rujukan_permohonan, $matches);

                                                        // $matches[1] will contain the extracted peringkat pengajian value
                                                        $peringkat_pengajian = isset($matches[1]) ? $matches[1] : null;
                                                        $peringkat = DB::table('bk_peringkat_pengajian')->where('kod_peringkat', $peringkat_pengajian)->value('peringkat');
                                                    @endphp
                                                    
                                                    <tr>
                                                        <td>{{$item['no_rujukan_permohonan']}}</td>
                                                        <td class="text-center">{{$item['updated_at']->format('d/m/Y')}}</td>
                                                        <td class="text-center">{{ucwords(strtolower($peringkat))}}</td>

                                                        @if ($item['status']=='1')
                                                            <td class="text-center"><button class="btn bg-info text-white">{{ucwords(strtolower($status))}}</button></td>
                                                        @elseif ($item['status']=='2')
                                                            <td class="text-center"><button class="btn bg-baharu text-white">{{ucwords(strtolower($status))}}</button></td>
                                                        @elseif ($item['status']=='3')
                                                            <td class="text-center"><button class="btn bg-sedang-disaring text-white">{{ucwords(strtolower($status))}}</button></td>
                                                        @elseif ($item['status']=='4')
                                                            <td class="text-center"><button class="btn bg-warning text-white">{{ucwords(strtolower($status))}}</button></td>
                                                        @elseif ($item['status']=='5')
                                                            <td class="text-center"><button class="btn bg-dikembalikan text-white">{{ucwords(strtolower($status))}}</button></td>
                                                        @elseif ($item['status']=='6')
                                                            <td class="text-center">
                                                                <a href="{{ route('generate-pdf', ['permohonanId' => $item['id']]) }}" class="btn btn-success btn-round btn-sm custom-width-btn">
                                                                    <i class="fa fa-download fa-sm custom-white-icon" style="color: white !important;"></i> Layak
                                                                </a>
                                                            </td>
                                                        @elseif ($item['status']=='7')
                                                            <td class="text-center"><button class="btn bg-danger text-white">{{ucwords(strtolower($status))}}</button></td>
                                                        @elseif ($item['status']=='8')
                                                            <td class="text-center"><button class="btn bg-dibayar text-white">{{ucwords(strtolower($status))}}</button></td>
                                                        @elseif ($item['status']=='9')
                                                            <td class="text-center"><button class="btn bg-batal text-white">{{ucwords(strtolower($status))}}</button></td>
                                                        @endif
                                                    </tr>
                                                
                                            @endforeach
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
    </div>
    <script>
        $('#sortTable1').DataTable();
        $('#sortTable2').DataTable();
    </script>

<style>
    .custom-width-btn {
        width: 130px; 
        height: 30px;
    }
</style>

    </body>
</x-default-layout>

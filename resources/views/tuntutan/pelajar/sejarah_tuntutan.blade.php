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
        <script src="/assets/lang/Malay.json"></script>
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
            <li class="breadcrumb-item text-dark" style="color:darkblue">Tuntutan</li>
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
                            <h2>Sejarah Tuntutan<br>
                                <small>
                                    Sejarah pembayaran hanya disediakan bagi peringkat pengajian terkini sahaja. 
                                    <br> Jika ingin mendapatkan sejarah pembayaran bagi peringkat pengajian terdahulu, sila buat semakan di pautan: 
                                    <a href="https://biasiswa.mohe.gov.my/ledger/home.php" target="_blank">Sistem Semakan Penyata</a> 
                                </small>
                            </h2>
                        </div>

                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="ppk" role="tabpanel" aria-labelledby="ppk-tab">
                                <div class="body">
                                    <div class="table-responsive">
                                        <table id="sortTable2" class="table table-striped table-hover dataTable js-exportable">
                                            <thead>
                                            <tr>
                                                <th><b>ID Tuntutan</b></th>
                                                <th class="text-center"><b>Tarikh Tuntutan</b></th>
                                                <th class="text-center"><b>Peringkat Pengajian</b></th>
                                                <th class="text-center"><b>Amaun Yuran Dibayar</b></th>
                                                <th class="text-center"><b>Amaun Wang Saku Dibayar</b></th>
                                                <th class="text-center"><b>Tarikh Dibayar</b></th>
                                                <th class="text-center"><b>Status Terkini</b></th>
                                                @if ($institusi->jenis_institusi == 'IPTS')
                                                <th class="text-center"><b>Tindakan</b></th>
                                                @endif
                                            </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($tuntutan as $item)
                                                
                                                    @php
                                                        $status = DB::table('bk_status')->where('kod_status', $item['status'])->value('status');

                                                        $no_rujukan_tuntutan = $item['no_rujukan_tuntutan'];

                                                        // Extract peringkat pengajian value using regular expression
                                                        preg_match('/\/(\d+)\//', $no_rujukan_tuntutan, $matches);

                                                        // $matches[1] will contain the extracted peringkat pengajian value
                                                        $peringkat_pengajian = isset($matches[1]) ? $matches[1] : null;
                                                        $peringkat = DB::table('bk_peringkat_pengajian')->where('kod_peringkat', $peringkat_pengajian)->value('peringkat');
                                                    
                                                    @endphp
                                                    
                                                    <tr>
                                                        <td>{{$item['no_rujukan_tuntutan']}}</td>
                                                        <td class="text-center">{{$item['updated_at']->format('d/m/Y')}}</td>
                                                        <td class="text-center">{{ucwords(strtolower($peringkat))}}</td>
                                                        <td class="text-center">
                                                            {{ !empty($item['yuran_dibayar']) ? 'RM '.$item['yuran_dibayar'] : '-' }}
                                                        </td>
                                                        <td class="text-center">
                                                            {{ !empty($item['wang_saku_dibayar']) ? 'RM '.$item['wang_saku_dibayar'] : '-' }}
                                                        </td>
                                                        <td class="text-center">{{\Carbon\Carbon::parse($item['tarikh_transaksi'])->format('d/m/Y')}}</td>
                                                        
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
                                                            <td class="text-center"><button class="btn bg-success text-white">{{ucwords(strtolower($status))}}</button></td>
                                                        @elseif ($item['status']=='7')
                                                            <td class="text-center"><button class="btn bg-danger text-white">{{ucwords(strtolower($status))}}</button></td>
                                                        @elseif ($item['status']=='8')
                                                            <td class="text-center"><button class="btn bg-dibayar text-white">{{ucwords(strtolower($status))}}</button></td>
                                                        @elseif ($item['status']=='9')
                                                            <td class="text-center"><button class="btn bg-batal text-white">{{ucwords(strtolower($status))}}</button></td>
                                                        @endif

                                                        @if ($institusi->jenis_institusi == 'IPTS')
                                                            @if ($item['status']=='1')
                                                            <td class="text-center">
                                                                <a href="{{ route('tuntutan.baharu') }}" onclick="return confirm('Adakah anda pasti ingin kemaskini tuntutan ini?')">
                                                                    <span data-bs-toggle="tooltip" data-bs-trigger="hover" title="Kemaskini Tuntutan">
                                                                        <i class="fa-solid fa-pen-to-square" style="color: #000000;"></i>
                                                                    </span>
                                                                </a>
                                                                <a href="{{ route('tuntutan.delete', ['id' => $item['smoku_id']]) }}" onclick="return confirm('Adakah anda pasti ingin padam tuntutan ini?')">
                                                                    <span data-bs-toggle="tooltip" data-bs-trigger="hover" title="Padam Tuntutan">
                                                                        <i class="fa fa-trash fa-sm custom-white-icon"></i>
                                                                    </span>
                                                                </a>
                                                            </td>
                                                            @elseif ($item['status']=='2')
                                                            <td class="text-center">
                                                                <a href="{{ route('tuntutan.batal', ['id' => $item['smoku_id']]) }}" onclick="return confirm('Adakah anda pasti ingin membatalkan tuntutan ini?')">
                                                                    <span data-bs-toggle="tooltip" data-bs-trigger="hover" title="Batal Tuntutan">
                                                                        <i class="fa fa-times-circle fa-sm custom-white-icon" style="color: red"></i>
                                                                    </span>
                                                                </a>
                                                            </td>
                                                            @elseif ($item['status']=='5')
                                                            <td class="text-center">
                                                                <a href="{{ route('tuntutan.baharu') }}" onclick="return confirm('Adakah anda pasti ingin kemaskini tuntutan ini?')">
                                                                    <span data-bs-toggle="tooltip" data-bs-trigger="hover" title="Kemaskini Tuntutan">
                                                                        <i class="fa-solid fa-pen-to-square" style="color: #000000;"></i>
                                                                    </span>
                                                                </a>
                                                            </td>
                                                            @else
                                                            <td class="text-center"></td>                                                            
                                                            @endif
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
        $('#sortTable2').DataTable({
            ordering: true, // Enable manual sorting
            order: [], // Disable initial sorting
			language: {
				url: "/assets/lang/Malay.json"
			}
        });
    </script>

    </body>
</x-default-layout>

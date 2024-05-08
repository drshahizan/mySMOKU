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
                            <h2>Sejarah Permohonan <br><small> Klik ID Permohonan untuk melihat maklumat lanjut rekod permohonan</small></h2>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table id="sortTable1" class="table table-striped table-hover dataTable js-exportable">
                                    <thead>
                                    <tr>
                                        <th style="width: 50%"><b>ID Permohonan</b></th>
                                        <th style="width: 15%" class="text-center"><b>Tarikh</b></th>
                                        <th style="width: 15%" class="text-center"><b>Status</b></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @php
                                        $i=0;
                                    @endphp
                                    @foreach ($sejarah_p as $item)
                                            @php
                                                $i++;
                                                $status = DB::table('bk_status')->where('kod_status', $item['status'])->value('status');
                                                if ($item['status']==2){
                                                    $status='Baharu';
                                                }
                                                if ($item['status']==3){
                                                    $status='Sedang Disaring';
                                                }
                                            @endphp
                                            <tr>
                                                @if ($item['status']=='1')
                                                    <td><a href="{{route('bkoku.papar.rekod.permohonan',$item['id'])}}" target="_blank">{{$permohonan->no_rujukan_permohonan}}</a></td>
                                                @elseif ($item['status']=='2')
                                                    <td><a href="{{route('bkoku.papar.rekod.permohonan',$item['id'])}}" target="_blank">{{$permohonan->no_rujukan_permohonan}}</a></td>
                                                @elseif ($item['status']=='3')
                                                    <td><a href="{{route('bkoku.papar.rekod.permohonan',$item['id'])}}" target="_blank">{{$permohonan->no_rujukan_permohonan}}</a></td>
                                                @elseif ($item['status']=='4')
                                                    <td><a href="{{route('bkoku.papar.rekod.saringan',$item['id'])}}" target="_blank">{{$permohonan->no_rujukan_permohonan}}</a></td>
                                                @elseif ($item['status']=='5')
                                                    <td><a href="{{route('bkoku.papar.rekod.saringan',$item['id'])}}" target="_blank">{{$permohonan->no_rujukan_permohonan}}</a></td>
                                                @elseif ($item['status']=='6')
                                                    <td><a href="{{route('bkoku.papar.rekod.kelulusan',$item['id'])}}" target="_blank">{{$permohonan->no_rujukan_permohonan}}</a></td>
                                                @elseif ($item['status']=='7')
                                                    <td><a href="{{route('bkoku.papar.rekod.kelulusan',$item['id'])}}" target="_blank">{{$permohonan->no_rujukan_permohonan}}</a></td>
                                                @elseif ($item['status']=='8')
                                                    <td><a href="{{route('bkoku.papar.rekod.saringan',$item['id'])}}" target="_blank">{{$permohonan->no_rujukan_permohonan}}</a></td>
                                                @elseif ($item['status']=='9')
                                                    <td><a href="{{route('bkoku.papar.rekod.permohonan',$item['id'])}}" target="_blank">{{$permohonan->no_rujukan_permohonan}}</a></td>
                                                @elseif ($item['status']=='10')
                                                    <td><a href="{{route('bkoku.papar.rekod.permohonan',$item['id'])}}" target="_blank">{{$permohonan->no_rujukan_permohonan}}</a></td>
                                                @endif

                                                <td class="text-center">{{$item['created_at']->format('d/m/Y')}}</td>

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
                                                @elseif ($item['status']=='10')
                                                    <td class="text-center"><button class="btn btn-round btn-sm custom-width-btn text-white" style="background-color: #488BCD">{{ucwords(strtolower($status))}}</button></td>
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
    <script>
        $('#sortTable1').DataTable({
            ordering: true, // Enable manual sorting
            order: [], // Disable initial sorting
			language: {
				url: "/assets/lang/Malay.json"
			}
        });
    </script>

    </body>
</x-default-layout>

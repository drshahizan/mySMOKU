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
        body{
            margin: 20px!important;
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
                            <h2>Sejarah Tuntutan <br><small> Klik ID Tuntutan untuk melihat maklumat lanjut rekod tuntutan</small></h2>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table id="sortTable1" class="table table-striped table-hover dataTable js-exportable">
                                    <thead>
                                    <tr>
                                        <th style="width: 50%"><b>ID Tuntutan</b></th>
                                        <th style="width: 15%" class="text-center"><b>Tarikh</b></th>
                                        <th style="width: 15%" class="text-center"><b>Status</b></th>
                                        <th style="width: 15%" class="text-center"><b>Dilaksanakan Oleh</b></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @php
                                        $i=0;
                                    @endphp
                                    @foreach ($sejarah_t as $item)
                                        @php
                                            $i++;
                                            $status = DB::table('bk_status')->where('kod_status', $item['status'])->value('status');
                                            if ($item['status']==2){
                                                $status='Baharu';
                                            }
                                            if ($item['status']==3){
                                                $status='Sedang Disaring';
                                            }
                                            if($item['dilaksanakan_oleh']==null){
                                                $oleh = "Tiada Maklumat";
                                            }
                                            else{
                                                $user_name = DB::table('users')->where('id', $item['dilaksanakan_oleh'])->value('nama');
                                                $text = ucwords(strtolower($user_name)); // Assuming you're sending the text as a POST parameter
                                                $conjunctions = ['bin', 'binti'];
                                                $words = explode(' ', $text);
                                                $result = [];
                                                foreach ($words as $word) {
                                                    if (in_array(Str::lower($word), $conjunctions)) {
                                                        $result[] = Str::lower($word);
                                                    } else {
                                                        $result[] = $word;
                                                    }
                                                }
                                                $oleh = implode(' ', $result);
                                            }
                                        @endphp
                                        <tr>
                                            @if ($item['status']=='1')
                                                <td><a href="{{url('tuntutan/sekretariat/sejarah/papar-tuntutan/'.$item['id'])}}" target="_blank">{{$tuntutan->no_rujukan_tuntutan}}</a></td>
                                            @elseif ($item['status']=='2')
                                                <td><a href="{{url('tuntutan/sekretariat/sejarah/papar-tuntutan/'.$item['id'])}}" target="_blank">{{$tuntutan->no_rujukan_tuntutan}}</a></td>
                                            @elseif ($item['status']=='3')
                                                <td><a href="{{url('tuntutan/sekretariat/sejarah/papar-saringan/'.$item['id'])}}" target="_blank">{{$tuntutan->no_rujukan_tuntutan}}</a></td>
                                            @elseif ($item['status']=='5')
                                                <td><a href="{{url('tuntutan/sekretariat/sejarah/papar-saringan/'.$item['id'])}}" target="_blank">{{$tuntutan->no_rujukan_tuntutan}}</a></td>
                                            @elseif ($item['status']=='6')
                                                <td><a href="{{url('tuntutan/sekretariat/sejarah/papar-saringan/'.$item['id'])}}" target="_blank">{{$tuntutan->no_rujukan_tuntutan}}</a></td>
                                            @elseif ($item['status']=='7')
                                                <td><a href="{{url('tuntutan/sekretariat/sejarah/papar-saringan/'.$item['id'])}}" target="_blank">{{$tuntutan->no_rujukan_tuntutan}}</a></td>
                                            @elseif ($item['status']=='8')
                                                <td><a href="{{url('tuntutan/sekretariat/sejarah/papar-pembayaran/'.$item['id'])}}" target="_blank">{{$tuntutan->no_rujukan_tuntutan}}</a></td>
                                            @elseif ($item['status']=='9')
                                                <td><a href="{{url('tuntutan/sekretariat/sejarah/papar-tuntutan/'.$item['id'])}}" target="_blank">{{$tuntutan->no_rujukan_tuntutan}}</a></td>
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
                                            @endif
                                            <td>{{$oleh}}</td>
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
        $('#sortTable1').DataTable();
        $('#sortTable2').DataTable();
    </script>

    </body>
</x-default-layout>

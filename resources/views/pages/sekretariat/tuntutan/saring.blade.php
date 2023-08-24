<x-default-layout> 
    <head>
    <title>Sekretariat BKOKU KPT | Saringan Tuntutan</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">

    <!-- MAIN CSS -->
    <link rel="stylesheet" href="/assets/css/saringan.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

    </head>
    {{-- begin alert --}}
    @if($status == "Permohonan Telah Disokong")
        <div class="alert alert-success" role="alert" style="margin: 0px 15px 20px 15px">
            {{ $status }}
        </div>
    @endif
    @if($status == "Permohonan Telah Dikembalikan")
        <div class="alert alert-warning" role="alert" style="margin: 0px 15px 20px 15px">
            {{ $status }}
        </div>
    @endif
    @if($status == "Tuntutan Telah Disokong")
        <div class="alert alert-success" role="alert" style="margin: 0px 15px 20px 15px">
            {{ $status }}
        </div>
    @endif
    {{-- end alert --}}
    <body>
    <!-- Main body part  -->
    <div id="main-content">
        <div class="container-fluid">
            <!-- Page header section  -->
            <div class="block-header">
                <div class="row clearfix">
                    <div class="col-lg-4 col-md-12 col-sm-12">
                        <h1>Saring Permohonan</h1>
                    </div>
                </div>
            </div> 
            @php
                $belum_disaring = DB::table('permohonan')->where('status', 2)->count();
                $dikembalikan = DB::table('permohonan')->where('status', 5)->count();
                $disokong = DB::table('permohonan')->where('status', 4)->count();
                $keseluruhan = $belum_disaring + $dikembalikan + $disokong;
            @endphp       
            <div class="row clearfix">
                <div class="col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="icon-in-bg bg-indigo text-white rounded-circle"><i class="fa fa-file" style="color: white!important"></i></div>
                                <div class="ml-4">
                                    <span style="color: black!important">Jumlah Saringan</span>
                                    <h4 class="mb-0 font-weight-medium">{{$keseluruhan}}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="icon-in-bg bg-orange text-white rounded-circle"><i class="fa fa-search" style="color: white!important"></i></div>
                                <div class="ml-4">
                                    <span style="color: black!important">Belum Disaring</span>
                                    <h4 class="mb-0 font-weight-medium">{{$belum_disaring}}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="icon-in-bg bg-green text-white rounded-circle"><i class="fa fa-check-circle" style="color: white!important"></i></div>
                                <div class="ml-4">
                                    <span style="color: black!important">Disokong</span>
                                    <h4 class="mb-0 font-weight-medium">{{$disokong}}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="icon-in-bg bg-yellow text-white rounded-circle"><i class="fa fa-reply-all" style="color: white!important"></i></div>
                                <div class="ml-4">
                                    <span style="color: black!important">Dikembalikan</span>
                                    <h4 class="mb-0 font-weight-medium">{{$dikembalikan}}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row clearfix">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="header">
                            <h2>Senarai Saringan Tuntutan<br><small>Klik ID Permohonan untuk melakukan saringan selanjutnya</small></h2>
                            {{-- <ul class="header-dropdown dropdown">
                                <li>
                                    <a href="{{ url('cetak-senarai-pemohon') }}" target="_blank" class="btn btn-primary" style="color: white">
                                        <i class="fa fa-print" style="color: white!important"></i> 
                                        Cetak Senarai Pendek
                                    </a>
                                </li>
                            </ul> --}}
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <ul class="nav nav-tabs" id="myTab" role="tablist">
                                    <li class="nav-item" role="presentation">
                                      <button class="nav-link active" id="home-tab" data-toggle="tab" data-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">BKOKU</button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                      <button class="nav-link" id="profile-tab" data-toggle="tab" data-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">PPK</button>
                                    </li>
                                </ul>
                                <div class="tab-content" id="myTabContent">
                                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                        <table id="sortTable" class="table table-striped table-hover dataTable js-exportable">
                                            <thead>
                                                <tr>
                                                    <th style="width: 17%"><b>ID Tuntutan</b></th>                                        
                                                    <th style="width: 33%"><b>Nama</b></th>
                                                    <th style="width: 15%"><b>Jenis Permohonan</b></th>
                                                    <th style="width: 15%" class="text-center"><b>Tarikh Tuntutan</b></th>
                                                    <th style="width: 15%" class="text-center"><b>Status Saringan</b></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($permohonan as $item)
                                                @php
                                                    $nama_pemohon = DB::table('pelajar')->where('nokp_pelajar', $item['nokp_pelajar'])->value('nama_pelajar');
                                                    $nokp = DB::table('pelajar')->where('nokp_pelajar', $item['nokp_pelajar'])->value('nokp_pelajar');
                                                    $status = DB::table('statusinfo')->where('kodstatus', $item['status'])->value('status');
                                                    if ($item['status']==2){
                                                        $status='Belum Disaring';
                                                    }
                                                    if ($item['status']==3){
                                                        $status='Sedang Disaring';
                                                    }
                                                @endphp
                                                @if($item['program']=="BKOKU")
                                                    <tr>                                            
                                                        <td><a href="{{ url('maklumat-tuntutan-2/'. $nokp) }}" title="">{{$item['id_permohonan']}}</a></td>
                                                        {{-- <td><a href="{{ url('tuntutan-telah-disaring/'.$item['nokp_pelajar']) }}" title="">{{$item['id_permohonan']}}</a></td> --}}
                                                        <td>{{$nama_pemohon}}</td>
                                                        <td>{{$item['program']}}</td>
                                                        <td class="text-center">{{$item['created_at']->format('d/m/Y')}}</td>
                                                        @if ($item['status']=='2')
                                                        <td class="text-center"><button class="btn bg-orange text-white">{{ucwords(strtolower($status))}}</button></td>
                                                        @elseif ($item['status']=='3')
                                                            <td class="text-center"><button class="btn bg-pink text-white">{{ucwords(strtolower($status))}}</button></td>
                                                        @elseif ($item['status']=='4')
                                                            <td class="text-center"><button class="btn bg-green text-white">{{ucwords(strtolower($status))}}</button></td>
                                                        @elseif ($item['status']=='5')
                                                            <td class="text-center"><button class="btn btn-warning">{{ucwords(strtolower($status))}}</button></td>
                                                        @endif
                                                    </tr>
                                                @endif
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                        <table id="sortTable" class="table table-striped table-hover dataTable js-exportable">
                                            <thead>
                                                <tr>
                                                    <th style="width: 17%"><b>ID Tuntutan</b></th>                                        
                                                    <th style="width: 33%"><b>Nama</b></th>
                                                    <th style="width: 15%"><b>Jenis Permohonan</b></th>
                                                    <th style="width: 15%" class="text-center"><b>Tarikh Tuntutan</b></th>
                                                    <th style="width: 15%" class="text-center"><b>Status Saringan</b></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($permohonan as $item)
                                                @php
                                                    $nama_pemohon = DB::table('pelajar')->where('nokp_pelajar', $item['nokp_pelajar'])->value('nama_pelajar');
                                                    $nokp = DB::table('pelajar')->where('nokp_pelajar', $item['nokp_pelajar'])->value('nokp_pelajar');
                                                    $status = DB::table('statusinfo')->where('kodstatus', $item['status'])->value('status');
                                                    if ($item['status']==2){
                                                        $status='Belum Disaring';
                                                    }
                                                    if ($item['status']==3){
                                                        $status='Sedang Disaring';
                                                    }
                                                @endphp
                                                @if($item['program']=="PPK")
                                                    <tr>                                            
                                                        <td><a href="{{ url('maklumat-tuntutan-2/'. $nokp) }}" title="">{{$item['id_permohonan']}}</a></td>
                                                        {{-- <td><a href="{{ url('tuntutan-telah-disaring/'.$item['nokp_pelajar']) }}" title="">{{$item['id_permohonan']}}</a></td> --}}
                                                        <td>{{$nama_pemohon}}</td>
                                                        <td>{{$item['program']}}</td>
                                                        <td class="text-center">{{$item['created_at']->format('d/m/Y')}}</td>
                                                        @if ($item['status']=='2')
                                                        <td class="text-center"><button class="btn bg-orange text-white">{{ucwords(strtolower($status))}}</button></td>
                                                        @elseif ($item['status']=='3')
                                                            <td class="text-center"><button class="btn bg-pink text-white">{{ucwords(strtolower($status))}}</button></td>
                                                        @elseif ($item['status']=='4')
                                                            <td class="text-center"><button class="btn bg-green text-white">{{ucwords(strtolower($status))}}</button></td>
                                                        @elseif ($item['status']=='5')
                                                            <td class="text-center"><button class="btn btn-warning">{{ucwords(strtolower($status))}}</button></td>
                                                        @endif
                                                    </tr>
                                                @endif
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
        $('#sortTable').DataTable();
    </script>
    
    </body>
</x-default-layout> 
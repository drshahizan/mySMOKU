<x-default-layout> 
    <head>
    <title>Sekretariat BKOKU KPT | Saringan Permohonan</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">

    <!-- MAIN CSS -->
    <link rel="stylesheet" href="/assets/css/saringan.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js"></script>
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
                            <h2>Senarai Saringan Permohonan<br><small>Klik ID Permohonan untuk melakukan saringan selanjutnya</small></h2>
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
                                <table id="sortTable" class="table table-striped table-hover dataTable js-exportable">
                                    <thead>
                                        <tr>
                                            <th style="width: 17%"><b>ID Permohonan</b></th>                                        
                                            <th style="width: 33%"><b>Nama</b></th>
                                            <th style="width: 15%"><b>Jenis Permohonan</b></th>
                                            <th style="width: 15%" class="text-center"><b>Tarikh Permohonan</b></th>
                                            <th style="width: 15%" class="text-center"><b>Status Saringan</b></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($permohonan as $item)
                                        @php
                                            $nama_pemohon = DB::table('pelajar')->where('nokp_pelajar', $item['nokp_pelajar'])->value('nama_pelajar');
                                            $nokp = DB::table('pelajar')->where('nokp_pelajar', $item['nokp_pelajar'])->value('nokp_pelajar');
                                            $status = DB::table('statustransaksi')->where('nokp_pelajar', $item['nokp_pelajar'])->value('status');
                                            if ($status=2){
                                                $status='Belum Disaring';
                                            }
                                        @endphp
                                        <tr>                                            
                                            <td><a href="{{ url('maklumat-pemohon/'. $nokp) }}" title="">{{$item['id_permohonan']}}</a></td>
                                            <td>{{$nama_pemohon}}</td>
                                            <td>{{$item['program']}}</td>
                                            <td class="text-center">{{$item['created_at']->format('d/m/Y')}}</td>
                                            <td class="text-center"><button class="btn bg-orange text-white">{{$status}}</button></td>
                                        </tr>
                                        @endforeach
                                        {{-- <tr>
                                            <td>Ali Bin Abu</td>
                                            <td><a href="{{ url('maklumat-pemohon'. $row['id_permohonan']) }}" title="">SARJANABKOKU000011</a></td>
                                            <td>BKOKU</td>
                                            <td>7/07/2023</td>
                                            <td><button class="btn bg-orange text-white"> Belum Disaring </button></td>
                                        </tr> --}}
                                        {{-- <tr>                                            
                                            <td><a href="{{ url('maklumat-perbaharui') }}" title="">KPTBKOKU/3/950623035672</a></td>
                                            <td>Wan Nurul Syafiqah Binti Wan Sahak</td>
                                            <td>BKOKU</td>
                                            <td class="text-center">05/07/2023</td>
                                            <td class="text-center"><button class="btn bg-orange text-white"> Belum Disaring </button></td>
                                        </tr>
                                        <tr>                                            
                                            <td><a href="{{ url('maklumat-perbaharui') }}" title="">KPTBKOKU/3/898987890098</a></td>
                                            <td>Siti Aisyah Binti Ismail</td>
                                            <td>BKOKU</td>
                                            <td class="text-center">07/07/2023</td>
                                            <td class="text-center"><button class="btn bg-orange text-white"> Belum Disaring </button></td>
                                        </tr>
                                        <tr>                                            
                                            <td><a href="{{ url('maklumat-perbaharui') }}" title="">KPTBKOKU/6/900623035672</a></td>
                                            <td>Wan Aminah Binti Wan Hasan</td>
                                            <td>BKOKU</td>
                                            <td class="text-center">09/07/2023</td>
                                            <td class="text-center"><button class="btn btn-warning"> Sedang Disaring </button></td>
                                        </tr>
                                        <tr>                                            
                                            <td><a href="{{ url('maklumat-perbaharui') }}" title="">KPTBKOKU/2/950623098909</a></td>
                                            <td>Muhammad Aiman Bin Hamid</td>
                                            <td>BKOKU</td>
                                            <td class="text-center">29/07/2023</td>
                                            <td class="text-center"><button class="btn bg-orange text-white"> Belum Disaring </button></td>
                                        </tr>
                                        <tr>                                            
                                            <td><a href="{{ url('maklumat-pemohon') }}" title="">KPTBKOKU/2/990404080221</a></td>
                                            <td>Mohd Ali Bin Abu Kassim</td>
                                            <td>BKOKU</td>
                                            <td class="text-center">04/07/2023</td>
                                            <td class="text-center"><button class="btn bg-orange text-white"> Belum Disaring </button></td>
                                        </tr>
                                        <tr>                                            
                                            <td><a href="{{ url('maklumat-perbaharui') }}" title="">KPTPPK/2/970204052445</a></td>
                                            <td>Sarah Binti Yusri</td>
                                            <td>PPK</td>                                        
                                            <td class="text-center">05/07/2023</td>
                                            <td class="text-center"><button type="button" class="btn btn-warning"> Sedang Disaring</button></td>
                                        </tr> <tr>                                            
                                            <td><a href="{{ url('maklumat-pemohon') }}" title="">KPTBKOKU/2/980112105666</a></td>
                                            <td>Aishah Binti Samsudin</td>
                                            <td>BKOKU</td>                                       
                                            <td class="text-center">02/07/2023</td>
                                            <td class="text-center"><button class="btn bg-orange text-white"> Belum Disaring</button></td>
                                        </tr> <tr>
                                            <td><a href="{{ url('maklumat-pemohon') }}" title="">KPTBKOKU/3/970703041223</a></td>
                                            <td>Santosh A/L Ariyaran</td>
                                            <td>BKOKU</td>                                        
                                            <td class="text-center">10/07/2023</td>
                                            <td class="text-center"><button class="btn bg-orange text-white"> Belum Disaring</button></td>
                                        </tr> <tr>
                                            <td><a href="{{ url('maklumat-pemohon') }}" title="">KPTBKOKU/3/960909105668</a></td>
                                            <td>Ling Kai Jie</td>
                                            <td>BKOKU</td>                                        
                                            <td class="text-center">09/07/2023</td>
                                            <td class="text-center"><button type="button" class="btn btn-warning"> Sedang Disaring</button></td>
                                        </tr> <tr>
                                            <td><a href="{{ url('maklumat-pemohon') }}" title="">KPTPPK/3/950804082447</a></td>
                                            <td>Akmal Bin Kairuddin</td>
                                            <td>PPK</td>                                        
                                            <td class="text-center">07/07/2023</td>
                                            <td class="text-center"><button class="btn bg-orange text-white"> Belum Disaring</button></td>
                                        </tr>
                                        <tr>
                                            <td><a href="{{ url('maklumat-pemohon') }}" title="">KPTPPK/1/021212050334</a></td>
                                            <td>Santishwaran A/L Paven</td>
                                            <td>PPK</td>                                        
                                            <td class="text-center">05/07/2023</td>
                                            <td class="text-center"><button class="btn bg-orange text-white"> Belum Disaring</button></td>
                                        </tr>
                                        <tr>
                                            <td><a href="{{ url('maklumat-pemohon') }}" title="">KPTPPK/1/001205034745</a></td>
                                            <td>Choo Mei Ling</td>
                                            <td>BKOKU</td>
                                            <td class="text-center">07/06/2023</td>
                                            <td class="text-center"><button class="btn bg-orange text-white"> Belum Disaring</button></td>
                                        </tr>
                                        <tr>
                                            <td><a href="{{ url('maklumat-pemohon') }}" title="">KPTBKOKU/4/890201065225</a></td>
                                            <td>Ezra Hanisah Binti Md Yunos</td>
                                            <td>BKOKU</td>                                    
                                            <td class="text-center">09/02/2023</td>
                                            <td class="text-center"><button class="btn bg-orange text-white"> Belum Disaring</button></td>
                                        </tr><tr>
                                            <td><a href="{{ url('maklumat-pemohon') }}" title="">KPTPPK/1/010305058473</a></td>
                                            <td>Arshahad Bin Kairul Zaman</td>
                                            <td>PPK</td>                                        
                                            <td class="text-center">07/07/2023</td>
                                            <td class="text-center"><button class="btn bg-orange text-white"> Belum Disaring</button></td>
                                        </tr>
                                        <tr>
                                            <td><a href="{{ url('maklumat-pemohon') }}" title="">KPTPPK/2/981004045253</a></td>
                                            <td>Syed Abdul Kassim Hussain Yusof</td>
                                            <td>PPK</td>                                        
                                            <td class="text-center">05/07/2023</td>
                                            <td class="text-center"><button class="btn bg-orange text-white"> Belum Disaring</button></td>
                                        </tr>
                                        <tr>
                                            <td><a href="{{ url('maklumat-pemohon') }}" title="">KPTBKOKU/1/990201051446</a></td>
                                            <td>Shakira Mariam Aqilah Binti Syed Abdul Rahman</td>
                                            <td>BKOKU</td>                                        
                                            <td class="text-center">07/06/2023</td>
                                            <td class="text-center"><button class="btn bg-orange text-white"> Belum Disaring</button></td>
                                        </tr>
                                        <tr>
                                            <td><a href="{{ url('maklumat-pemohon') }}" title="">KPTBKOKU/4/940524032341</a></td>
                                            <td>Rahman Mohammed Arshahad Al-dhaqm</td>
                                            <td>BKOKU</td>                                    
                                            <td class="text-center">09/02/2023</td>
                                            <td class="text-center"><button class="btn bg-orange text-white"> Belum Disaring</button></td>
                                        </tr> --}}
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
        $('#sortTable').DataTable();
    </script>
    
    </body>
</x-default-layout> 
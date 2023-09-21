<x-default-layout>
    <head>
        <title>Sekretariat BKOKU KPT</title>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">

        <!-- MAIN CSS -->
        <link rel="stylesheet" href="/assets/css/sekretariat.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>

        <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
        <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/datetime/1.5.1/js/dataTables.dateTime.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js"></script>
    </head>

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
            <li class="breadcrumb-item text-dark" style="color:darkblue">Keputusan</li>
            <!--end::Item-->
        </ul>
        <!--end::Breadcrumb-->
    </div>
    <!--end::Page title-->
    <br>

    <body>
    @if($notifikasi!=NULL)
        @if($keputusan=="Lulus")
            <div class="alert alert-success" role="alert" style="margin: 0px 15px 20px 15px; color:black!important;">
                {{ $notifikasi }}
            </div>
        @elseif($keputusan=="Tidak Lulus")
            <div class="alert alert-danger" role="alert" style="margin: 0px 15px 20px 15px; color:black!important;">
                {{ $notifikasi }}
            </div>
        @endif
    @endif

    <!-- Main body part  -->
    <div id="main-content">
        <div class="container-fluid">
            <div class="block-header">
                <div class="row clearfix">
                    <div class="card">
                        <div class="header">
                            <h2>Senarai Keputusan Permohonan</h2>
                        </div>

                        {{-- Javascript Nav Bar --}}
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="bkoku-tab" data-toggle="tab" data-target="#bkoku" type="button" role="tab" aria-controls="bkoku" aria-selected="true">BKOKU</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="ppk-tab" data-toggle="tab" data-target="#ppk" type="button" role="tab" aria-controls="ppk" aria-selected="false">PPK</button>
                            </li>
                        </ul>

                        {{-- Content Navigation Bar --}}
                        <div class="tab-content" id="myTabContent">
                            {{-- BKOKU --}}
                            <div class="tab-pane fade show active" id="bkoku" role="tabpanel" aria-labelledby="bkoku-tab">
                                <br><br>
                                <form action="{{ url('permohonan/sekretariat/keputusan') }}" method="GET">
                                    <div class="row" style="margin-left: 15px;">
                                        <div class="col-md-2">
                                            <label for="start_date"><b>Dari:</b></label>
                                            <input type="date" name="start_date" id="start_date" value="{{ Request::get('start_date') }}" class="form-control" />
                                        </div>

                                        <div class="col-md-2">
                                            <label for="end_date"><b>Hingga:</b></label>
                                            <input type="date" name="end_date" id="end_date" value="{{ Request::get('end_date') }}" class="form-control" />
                                        </div>

                                        <div class="col-md-3">
                                            <label for="end_date"><b>Keputusan:</b></label>
                                            <select name="status" class="form-select">
                                                <option value="">Pilih Semua Keputusan</option>
                                                <option value="Lulus" {{ Request::get('status') == 'Lulus' ? 'selected' : '' }}>Layak</option>
                                                <option value="Tidak Lulus" {{ Request::get('status') == 'Tidak Lulus' ? 'selected' : '' }}>Tidak Layak</option>
                                            </select>
                                        </div>

                                        <div class="col-md-4 right">
                                            <br>
                                            <button type="submit" class="btn btn-primary" style="width: 10%; padding-left: 10px;">
                                                <i class="fa fa-filter" style="font-size: 15px;"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>

                                <div class="body">
                                    <div class="table-responsive" id="table-responsive">
                                        <table id="sortTable1" class="table table-bordered table-striped">
                                            <thead>
                                            <tr style="color: white; background-color:rgb(35, 58, 108);">
                                                <th style="width: 15%"><b>ID Permohonan</b></th>
                                                <th style="width: 45%"><b>Nama</b></th>
                                                <th style="width: 10%" class="text-center"><b>No. Mesyuarat</b></th>
                                                <th style="width: 15%" class="text-center"><b>Tarikh Kemaskini Keputusan</b></th>
                                                <th class="text-center" style="width: 15%">Status Permohonan</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach ($kelulusan as $item)
                                                @php
                                                    $id_permohonan = DB::table('permohonan')->where('id',$item['permohonan_id'])->value('no_rujukan_permohonan');
                                                    $nama = DB::table('permohonan')->join('smoku', 'smoku.id', '=', 'permohonan.smoku_id')->where('permohonan.id', $item['permohonan_id'])->value('smoku.nama');
                                                    $program = DB::table('permohonan')->where('id',$item['permohonan_id'])->value('program');

                                                    $text = ucwords(strtolower($nama));
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
                                                    $pemohon = implode(' ', $result);
                                                @endphp

                                                @if($program == "BKOKU")
                                                    <tr>
                                                        <td>{{$id_permohonan}}</td>
                                                        <td>{{$pemohon}}</td>
                                                        <td class="text-center">{{$item->no_mesyuarat}}</td>
                                                        <td class="text-center">{{date('d/m/Y', strtotime($item->tarikh_mesyuarat))}}</td>
                                                        @if($item->keputusan == "Lulus")
                                                            <td class="text-center"><button type="button" class="btn btn-success btn-sm">{{$item->keputusan}}</button></td>
                                                        @elseif($item->keputusan == "Tidak Lulus")
                                                            <td class="text-center"><button type="button" class="btn btn-danger btn-sm">{{$item->keputusan}}</button></td>
                                                        @endif
                                                    </tr>
                                                @endif
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            {{-- PKK --}}
                            <div class="tab-pane fade" id="ppk" role="tabpanel" aria-labelledby="ppk-tab">
                                <br><br>
                                <form action="{{ url('permohonan/sekretariat/keputusan') }}" method="GET">
                                    <div class="row" style="margin-left: 15px;">
                                        <div class="col-md-2">
                                            <label for="start_date"><b>Dari:</b></label>
                                            <input type="date" name="start_date" id="start_date" value="{{ Request::get('start_date') }}" class="form-control" />
                                        </div>

                                        <div class="col-md-2">
                                            <label for="end_date"><b>Hingga:</b></label>
                                            <input type="date" name="end_date" id="end_date" value="{{ Request::get('end_date') }}" class="form-control" />
                                        </div>

                                        <div class="col-md-3">
                                            <label for="end_date"><b>Keputusan:</b></label>
                                            <select name="status" class="form-select">
                                                <option value="">Pilih Semua Keputusan</option>
                                                <option value="Lulus" {{ Request::get('status') == 'Lulus' ? 'selected' : '' }}>Layak</option>
                                                <option value="Tidak Lulus" {{ Request::get('status') == 'Tidak Lulus' ? 'selected' : '' }}>Tidak Layak</option>
                                            </select>
                                        </div>

                                        <div class="col-md-4 right">
                                            <br>
                                            <button type="submit" class="btn btn-primary" style="width: 10%; padding-left: 10px;">
                                                <i class="fa fa-filter" style="font-size: 15px;"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>

                                <div class="body">
                                    <div class="table-responsive" id="table-responsive">
                                        <table id="sortTable1" class="table table-bordered table-striped">
                                            <thead>
                                            <tr style="color: white; background-color:rgb(35, 58, 108);">
                                                <th style="width: 15%"><b>ID Permohonan</b></th>
                                                <th style="width: 45%"><b>Nama</b></th>
                                                <th style="width: 10%" class="text-center"><b>No. Mesyuarat</b></th>
                                                <th style="width: 15%" class="text-center"><b>Tarikh Kemaskini Keputusan</b></th>
                                                <th class="text-center" style="width: 15%">Status Permohonan</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach ($kelulusan as $item)
                                                @php
                                                    $id_permohonan = DB::table('permohonan')->where('id',$item['permohonan_id'])->value('no_rujukan_permohonan');
                                                    $nama = DB::table('permohonan')->join('smoku', 'smoku.id', '=', 'permohonan.smoku_id')->where('permohonan.id', $item['permohonan_id'])->value('smoku.nama');
                                                    $program = DB::table('permohonan')->where('id',$item['permohonan_id'])->value('program');

                                                    $text = ucwords(strtolower($nama));
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
                                                    $pemohon = implode(' ', $result);
                                                @endphp

                                                @if($program == "PPK")
                                                    <tr>
                                                        <td>{{$id_permohonan}}</td>
                                                        <td>{{$pemohon}}</td>
                                                        <td class="text-center">{{$item->no_mesyuarat}}</td>
                                                        <td class="text-center">{{date('d/m/Y', strtotime($item->tarikh_mesyuarat))}}</td>
                                                        @if($item->keputusan == "Lulus")
                                                            <td class="text-center"><button type="button" class="btn btn-success btn-sm">{{$item->keputusan}}</button></td>
                                                        @elseif($item->keputusan == "Tidak Lulus")
                                                            <td class="text-center"><button type="button" class="btn btn-danger btn-sm">{{$item->keputusan}}</button></td>
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

    <!-- Javascript -->
    <script src="assets/bundles/libscripts.bundle.js"></script>
    <script src="assets/bundles/vendorscripts.bundle.js"></script>

    <script>
        $('#sortTable1').DataTable();
        $('#sortTable2').DataTable();
    </script>
</x-default-layout>

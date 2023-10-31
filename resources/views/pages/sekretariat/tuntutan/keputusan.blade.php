<x-default-layout>
    <head>
        <title>Sekretariat BKOKU KPT</title>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">

        <!-- MAIN CSS -->
        <link rel="stylesheet" href="assets/css/saringan.css">
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
			<li class="breadcrumb-item text-dark" style="color:darkblue">Keputusan</li>
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
                <div class="block-header">
                    <div class="row clearfix">
                        <div class="card">
                            <div class="header">
                                <h2>Senarai Keputusan Tuntutan<br><small>Klik ID Permohonan untuk melihat maklumat tuntutan</small></h2>
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
                                    <form action="" method="GET">
                                        <div class="row" style="margin-left:15px;">
                                            <div class="col-md-3 black">
                                                Pilih Julat Tarikh:
                                                <input type="text" name="daterange" id="daterange" value="08/01/2023 - 08/30/2023" class="form-control"/>
                                                <script>
                                                    $(function() {
                                                        $('input[name="daterange"]').daterangepicker({
                                                            opens: 'left'
                                                        }, function(start, end, label) {
                                                            // Custom filtering function which will search data in column four between two values
                                                            DataTable.ext.search.push(function (settings, data, dataIndex) {
                                                                let min = new Date(start).toLocaleDateString();
                                                                let max = new Date(end).toLocaleDateString();

                                                                let date = new Date(data[2]).toLocaleDateString();

                                                                if (
                                                                    (min === null && max === null) ||
                                                                    (min === null && date <= max) ||
                                                                    (min <= date && max === null) ||
                                                                    (min <= date && date <= max)
                                                                ) {
                                                                    return true;
                                                                }
                                                                return false;
                                                            });

                                                            // DataTables initialisation
                                                            let table = new DataTable('#sortTable1');
                                                            table.draw();
                                                        });
                                                    });
                                                </script>
                                            </div>
                                            <div class="col-md-3 black">
                                                Pilih Keputusan:
                                                <select name="status" id="status" class="form-select">
                                                    <option value="">Sila Pilih</option>
                                                    <option value="Layak">Layak</option>
                                                    <option value="Tidak Layak">Tidak Layak</option>
                                                </select>
                                            </div>
                                        </div>
                                    </form>

                                    <div class="body">
                                        <div class="table-responsive" id="table-responsive">
                                            <table id="sortTable1" class="table table-bordered table-striped">
                                                <thead>
                                                    <tr style="color: white; background-color:rgb(35, 58, 108);">
                                                        <th style="width: 15%"><b>ID Tuntutan</b></th>
                                                        <th style="width: 45%"><b>Nama</b></th>
                                                        <th style="width: 13%" class="text-center"><b>Tarikh Tuntutan</b></th>
                                                        <th class="text-center" style="width: 15%">Status Tuntutan</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($permohonan as $item)
                                                    @if($item['program']=="BKOKU")
                                                        @php
                                                            $id_permohonan = DB::table('permohonan')->where('id_permohonan', $item['id_permohonan'])->value('id_permohonan');
                                                            $program = DB::table('permohonan')->where('id_permohonan', $item['id_permohonan'])->value('program');
                                                            $nama = DB::table('pelajar')->where('nokp_pelajar', $item['nokp_pelajar'])->value('nama_pelajar');
                                                            $status = DB::table('statusinfo')->where('kodstatus', $item['status'])->value('status');
                                                            $text = ucwords(strtolower($nama)); // Assuming you're sending the text as a POST parameter
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
                                                        <tr>
                                                            <td>{{$id_permohonan}}</td>
                                                            <td>{{$pemohon}}</td>
                                                            <td class="text-center">{{$item['created_at']->format('Y-m-d')}}</td>
                                                            @if($item['status'] == "6")
                                                                <td class="text-center"><button type="button" class="btn btn-success btn-sm">{{ucwords(strtolower($status))}}</button></td>
                                                            @elseif ($item['status']=="5")
                                                                <td class="text-center"><button type="button" class="btn bg-dikembalikan">{{ucwords(strtolower($status))}}</button></td>
                                                            @elseif($item['status'] == "7")
                                                                <td class="text-center"><button type="button" class="btn btn-danger btn-sm">{{ucwords(strtolower($status))}}</button></td>
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
                                    <form action="" method="GET">
                                        <div class="row" style="margin-left:15px;">
                                            <div class="col-md-3">
                                                <input type="date" name="date" value="{{Request::get('date')?? ' '}}" class="form-control"/>
                                            </div>

                                            <div class="col-md-3">
                                                <select name="status2" class="form-select">
                                                    <option value="">Pilih Keputusan</option>
                                                    <option value="Layak" {{Request::get('status') == 'Layak' ? 'selected':'' }} >Layak</option>
                                                    <option value="Tidak Layak" {{Request::get('status') == 'Tidak Layak' ? 'selected':'' }} >Tidak Layak</option>
                                                </select>
                                            </div>
                                        </div>
                                    </form>

                                    <div class="body">
                                        <div class="table-responsive">
                                            <table id="sortTable2" class="table table-bordered table-striped">
                                                <thead>
                                                    <tr style="color: white; background-color:rgb(35, 58, 108);">
                                                        <th style="width: 15%!important;"><b>ID Tuntutan</b></th>
                                                        <th style="width: 37%!important;"><b>Nama</b></th>
                                                        <th style="width: 13%!important;" class="text-center"><b>Tarikh Tuntutan</b></th>
                                                        <th class="text-center" style="width: 15%!important;">Status Tuntutan</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($permohonan as $item)
                                                    @if($item['program']=="PPK")
                                                        @php
                                                            $id_permohonan = DB::table('permohonan')->where('id_permohonan', $item['id_permohonan'])->value('id_permohonan');
                                                            $program = DB::table('permohonan')->where('id_permohonan', $item['id_permohonan'])->value('program');
                                                            $nama = DB::table('pelajar')->where('nokp_pelajar', $item['nokp_pelajar'])->value('nama_pelajar');
                                                            $status = DB::table('statusinfo')->where('kodstatus', $item['status'])->value('status');
                                                            $text = ucwords(strtolower($nama)); // Assuming you're sending the text as a POST parameter
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
                                                        <tr>
                                                            <td style="width: 15%!important;">{{$id_permohonan}}</td>
                                                            <td style="width: 37%!important;">{{$pemohon}}</td>
                                                            <td class="text-center" style="width: 13%!important;">{{$item['created_at']->format('d/m/Y')}}</td>
                                                            @if($item['status'] == "6")
                                                                <td class="text-center" style="width: 15%!important;"><button type="button" class="btn btn-success btn-sm">{{ucwords(strtolower($status))}}</button></td>
                                                            @elseif ($item['status']=="5")
                                                                <td class="text-center" style="width: 15%!important;"><button type="button" class="btn bg-dikembalikan">{{ucwords(strtolower($status))}}</button></td>
                                                            @elseif($item['status'] == "7")
                                                                <td class="text-center" style="width: 15%!important;"><button type="button" class="btn btn-danger btn-sm">{{ucwords(strtolower($status))}}</button></td>
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
            $('#sortTable1').DataTable();
            $('#sortTable2').DataTable();
            $('input[name="dates"]').daterangepicker();
        </script>
        <script>

        </script>
        {{-- <script>
           $('#status').on('change', function(){
            $('#sortTable1').DataTable().search(this.value).draw();
          });
        </script> --}}
</x-default-layout>

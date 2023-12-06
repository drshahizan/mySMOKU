<x-default-layout>
    <head>
        <title>Sekretariat BKOKU KPT</title>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">

        <!-- MAIN CSS -->
        <link rel="stylesheet" href="/assets/css/saringan.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js"></script>
    </head>

    <body>
        <!--begin::Page title-->
	    <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
		<!--begin::Title-->
		<h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Laman Utama</h1>
		<!--end::Title-->
		<!--begin::Breadcrumb-->
		<ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
			<!--begin::Item-->
			<li class="breadcrumb-item text-dark" style="color:darkblue">Laman Utama</li>
			<!--end::Item-->
            <!--begin::Item-->
			<li class="breadcrumb-item">
				<span class="bullet bg-gray-400 w-5px h-2px"></span>
			</li>
			<!--end::Item-->

			
            <!--begin::Item-->
			<li class="breadcrumb-item text-dark" style="color:darkblue">Senarai Permohonan</li>
			<!--end::Item-->
            <!--begin::Item-->
			<li class="breadcrumb-item">
				<span class="bullet bg-gray-400 w-5px h-2px"></span>
			</li>
			<!--end::Item-->
            
            <!--begin::Item-->
			<li class="breadcrumb-item text-dark" style="color:darkblue">PPK</li>
			<!--end::Item-->
		</ul>
        <!--end::Breadcrumb-->
        </div>
        <!--end::Page title-->

        <br>

        <!-- Main body part  -->
        <div id="main-content">
            <div class="container-fluid">
                <div class="block-header">
                    <div class="row clearfix">
                        <div class="card">
                            {{-- Filter section --}}
                            <form action="{{url('sekretariat/permohonan/PPK/keseluruhan')}}" method="GET">
                                <div class="row" style="margin-left:15px; margin-top:30px;">
                                    <div class="col-md-2">
                                        <label for="start_date"><b>Dari:</b></label>
                                        <input type="date" name="start_date" id="start_date" value="{{ Request::get('start_date') }}" class="form-control" />
                                    </div>
                            
                                    <div class="col-md-2">
                                        <label for="end_date"><b>Hingga:</b></label>
                                        <input type="date" name="end_date" id="end_date" value="{{ Request::get('end_date') }}" class="form-control" />
                                    </div>
    
                                    <div class="col-md-4 right">
                                        <br>
                                        <button type="submit" class="btn btn-primary" style="width: 10%; padding-left:10px;"><i class="fa fa-filter" style="font-size: 15px;"></i></button>
                                    </div>
                                </div>
                            </form>

                            <div class="table-responsive">
                                <div class="body">      
                                    <table id="sortTable" class="table table-bordered table-striped">
                                        <thead>
                                            <tr style="color: white;">
                                                <th style="width: 15%"><b>ID Permohonan</b></th>                                        
                                                <th style="width: 45%"><b>Nama</b></th>
                                                <th style="width: 13%" class="text-center"><b>Tarikh Permohonan</b></th> 
                                                <th class="text-center" style="width: 15%">Status Permohonan</th>
                                            </tr>
                                        </thead>
                                        
                                        <tbody>
                                            @foreach ($permohonan as $item)
                                                @php
                                                    // nama pemohon
                                                    $nama = DB::table('smoku')->where('id', $item['smoku_id'])->value('nama');
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

                                                    //status permohonan
                                                    $status = DB::table('bk_status')->where('kod_status', $item['status'])->value('status');

                                                    //tarikh
                                                    $item['tarikh_hantar'] = new DateTime($item['tarikh_hantar']);
                                                    $formattedDate = $item['tarikh_hantar']->format('d/m/Y');
                                                @endphp

                                                @if($item['program']=="PPK")
                                                    <tr>
                                                        <td>{{$item->no_rujukan_permohonan}}</td>
                                                        <td>{{$pemohon}}</td>
                                                        <td class="text-center">{{$formattedDate}}</td>
                                                        @if($item['status'] == "1")
                                                            <td class="text-center"><button type="button" class="btn btn-info text-white">{{ucwords(strtolower($status))}}</button></td>
                                                        @elseif($item['status'] == "2")
                                                            <td class="text-center"><button type="button" class="btn bg-baharu text-white">Baharu</button></td>
                                                        @elseif($item['status'] == "3")
                                                            <td class="text-center"><button type="button" class="btn bg-sedang-disaring text-white">{{ucwords(strtolower($status))}}</button></td>
                                                        @elseif($item['status'] == "4")
                                                            <td class="text-center"><button type="button" class="btn bg-warning text-white">{{ucwords(strtolower($status))}}</button></td>
                                                        @elseif($item['status'] == "5")
                                                            <td class="text-center"><button type="button" class="btn bg-dikembalikan text-white">{{ucwords(strtolower($status))}}</button></td>
                                                        @elseif($item['status'] == "6")
                                                            <td class="text-center"><button type="button" class="btn btn-success text-white">{{ucwords(strtolower($status))}}</button></td>
                                                        @elseif($item['status'] == "7")
                                                            <td class="text-center"><button type="button" class="btn btn-danger text-white">{{ucwords(strtolower($status))}}</button></td>
                                                        @elseif($item['status'] == "8")
                                                            <td class="text-center"><button type="button" class="btn bg-dibayar text-white">{{ucwords(strtolower($status))}}</button></td>
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

        
        <!-- Javascript -->
        <script src="assets/bundles/libscripts.bundle.js"></script>    
        <script src="assets/bundles/vendorscripts.bundle.js"></script>

        <script>
            $('#sortTable').DataTable();
        </script>

        <script>
            $('button[data-toggle="tab"]').on('#nav-home', function (event) {
                event.target // newly activated tab
                event.relatedTarget // previous active tab
            })
            $('button[data-toggle="tab"]').on('#nav-profile', function (event) {
                event.target // newly activated tab
                event.relatedTarget // previous active tab
            })
        </script>
</x-default-layout> 


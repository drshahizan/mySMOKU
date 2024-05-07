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
                            <h2>Sejarah Tuntutan<br><small>Klik ID Tuntutan untuk melihat rekod tuntutan</small></h2>
                        </div>

                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="ppk" role="tabpanel" aria-labelledby="ppk-tab">
                                <div class="body">
                                    <div class="table-responsive">
                                        <table id="sortTable2" class="table table-striped table-hover dataTable js-exportable">
                                            <thead>
                                            <tr>
                                                <th style="width: 17%"><b>ID Tuntutan</b></th>
                                                <th style="width: 33%"><b>Nama</b></th>
                                                <th style="width: 15%" class="text-center"><b>Tarikh Tuntutan</b></th>
                                                <th style="width: 15%" class="text-center"><b>Status Terkini</b></th>
                                                <th style="width: 15%" class="text-center"><b>Tindakan</b></th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                                @php
                                                    $i=0;
                                                @endphp
                                                @foreach ($tuntutan as $item)
                                                    @php
                                                        $i++;
                                                        $permohonan = DB::table('permohonan')->where('id', $item['permohonan_id'])->first();
                                                        $nama_pemohon = DB::table('smoku')->where('id', $permohonan->smoku_id)->value('nama');
                                                        $status = DB::table('bk_status')->where('kod_status', $item['status'])->value('status');
                                                        
                                                        $text = ucwords(strtolower($nama_pemohon)); // Assuming you're sending the text as a POST parameter
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
                                                    @if ($permohonan->program=="PPK")
                                                    <tr>
                                                        <td>
                                                            <a href="{{ route('ppk.rekod.tuntutan', $item['id']) }}" title="">{{$item['no_rujukan_tuntutan']}}</a>
                                                        </td>
                                                        <td>{{$pemohon}}</td>
                                                        <td class="text-center"> {{ \Carbon\Carbon::createFromFormat('Y-m-d', $item['tarikh_hantar'])->format('d/m/Y') }}</td>
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

                                                        @if ($item['status']=='2')
                                                        <td class="text-center">
                                                            <a href="{{ route('ppk.tuntutan.batal', ['id' => $item['smoku_id']]) }}" onclick="return confirm('Adakah anda pasti ingin membatalkan tuntutan ini?')">
                                                                <span data-bs-toggle="tooltip" data-bs-trigger="hover" title="Batal Tuntutan">
                                                                    <i class="fa fa-times-circle fa-sm custom-white-icon" style="color: red"></i>
                                                                </span>
                                                            </a>
                                                        </td>
                                                        @elseif ($item['status']=='5')
                                                        <td class="text-center">
                                                            <a href="{{ route('senarai.ppk.tuntutanBaharu') }}" onclick="return confirm('Adakah anda pasti ingin kemaskini tuntutan ini?')">
                                                                <span data-bs-toggle="tooltip" data-bs-trigger="hover" title="Kemaskini Tuntutan">
                                                                    <i class="fa-solid fa-pen-to-square" style="color: #000000;"></i>
                                                                </span>
                                                            </a>
                                                        </td>
                                                        @else
                                                        <td class="text-center"></td>                                                            
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
        $('#sortTable2').DataTable({
            ordering: true, // Enable manual sorting
            order: [], // Disable initial sorting
			language: {
				url: "/assets/lang/Malay.json"
			}
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script>
        @if(session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Berjaya!',
                text: ' {!! session('success') !!}',
                confirmButtonText: 'OK'
            });
        @endif
        @if(session('failed'))
            Swal.fire({
                icon: 'error',
                title: 'Tidak Berjaya!',
                text: ' {!! session('failed') !!}',
                confirmButtonText: 'OK'
            });
        @endif
    </script>

    </body>
</x-default-layout>

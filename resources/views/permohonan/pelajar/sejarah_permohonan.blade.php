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
                            <h2>Sejarah Permohonan<br>
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
                                                <th><b>ID Permohonan</b></th>
                                                <th class="text-center"><b>Tarikh Permohonan</b></th>
                                                <th class="text-center"><b>Peringkat Pengajian</b></th>
                                                @if (!$program || $program->program == 'BKOKU')
                                                <th class="text-center"><b>Amaun Yuran Dibayar</b></th>
                                                @endif
                                                <th class="text-center"><b>Amaun Wang Saku Dibayar</b></th>
                                                <th class="text-center"><b>Tarikh Dibayar</b></th>
                                                <th class="text-center"><b>Status Terkini</b></th>
                                                @if ($institusi->jenis_institusi == 'IPTS')
                                                <th class="text-center"><b>Tindakan</b></th>
                                                @endif
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

                                                        $permohonan_latest = DB::table('permohonan')->orderBy('id', 'DESC')->first();

                                                        $item['tarikh_hantar'] = new DateTime($item['tarikh_hantar']);
								                        $formattedDate = $item['tarikh_hantar']->format('d/m/Y');

                                                        if ($item['tarikh_transaksi'] !== null) {
                                                            $item['tarikh_transaksi'] = new DateTime($item['tarikh_transaksi']);
                                                            $tarikh_transaksi = $item['tarikh_transaksi']->format('d/m/Y');
                                                        } else {
                                                            $tarikh_transaksi = 'Dalam Proses';
                                                        }
                                                    @endphp
                                                    
                                                    <tr>
                                                        <td>{{$item['no_rujukan_permohonan']}}</td>
                                                        <td class="text-center">{{$formattedDate}}</td>
                                                        <td class="text-center">{{ucwords(strtolower($peringkat))}}</td>
                                                        @if ($program->program == 'BKOKU')
                                                        <td class="text-center">
                                                            {{ !empty($item['yuran_dibayar']) ? 'RM '.$item['yuran_dibayar'] : '-' }}
                                                        </td>
                                                        @endif
                                                        <td class="text-center">
                                                            {{ !empty($item['wang_saku_dibayar']) ? 'RM '.$item['wang_saku_dibayar'] : '-' }}
                                                        </td>
                                                        <td class="text-center">{{$tarikh_transaksi}}</td>

                                                        @if ($item['status']=='1')
                                                            <td class="text-center"><button class="btn bg-info text-white">{{ucwords(strtolower($status))}}</button></td>
                                                        @elseif ($item['status']=='2')
                                                            <td class="text-center"><button class="btn bg-baharu text-white">{{ucwords(strtolower($status))}}</button></td>
                                                        @elseif ($item['status']=='3')
                                                            <td class="text-center"><button class="btn bg-sedang-disaring text-white">{{ucwords(strtolower($status))}}</button></td>
                                                        @elseif ($item['status']=='4')
                                                            <td class="text-center"><button class="btn bg-warning text-white">{{ucwords(strtolower($status))}}</button></td>
                                                        @elseif ($item['status']=='5')
                                                            <td class="text-center"><button class="btn bg-dikembalikan text-white" data-bs-toggle="modal" data-bs-target="#dikembalikan">
                                                                <span data-bs-toggle="tooltip" data-bs-trigger="hover" title="Papar sebab dikembalikan">
                                                                {{ucwords(strtolower($status))}}</span>
                                                            </button></td>
                                                        @elseif ($item['status']=='6')
                                                            <td class="text-center">
                                                                <a href="{{ route('generate-pdf', ['permohonanId' => $item['id']]) }}" class="btn btn-success btn-round btn-sm custom-width-btn">
                                                                    <i class="fa fa-download fa-sm custom-white-icon" style="color: white !important;"></i> Layak
                                                                </a>
                                                            </td>
                                                        @elseif ($item['status']=='7')
                                                            <td class="text-center"><button class="btn bg-danger text-white">{{ucwords(strtolower($status))}}</button></td>
                                                        @elseif ($item['status']=='8')
                                                        <td class="text-center">
                                                            <a href="{{ route('generate-pdf', ['permohonanId' => $item['id']]) }}" class="btn bg-dibayar btn-round btn-sm custom-width-btn">
                                                                <i class="fa fa-download fa-sm custom-white-icon" style="color: white !important;"></i> Dibayar
                                                            </a>
                                                        </td>
                                                        @elseif ($item['status']=='9')
                                                            <td class="text-center"><button class="btn bg-batal text-white">{{ucwords(strtolower($status))}}</button></td>
                                                        @endif
                                                        
                                                        @if ($institusi->jenis_institusi == 'IPTS')
                                                            @if ($item['status']=='1')
                                                                <td class="text-center">
                                                                    <div>
                                                                        <a href="{{ route('permohonan') }}" class="btn btn-icon btn-active-light-primary w-10px h-30px me-3">
                                                                            <span data-bs-toggle="tooltip" data-bs-trigger="hover" title="Kemaskini Permohonan">
                                                                                <i class="ki-solid ki-pencil text-dark fs-2"></i>
                                                                            </span>
                                                                        </a>
                                                                        <a href="{{ route('permohonan.delete', ['id' => $item['smoku_id']]) }}" class="btn btn-icon btn-active-light-primary w-10px h-30px me-3" onclick="return confirm('Adakah anda pasti ingin padam permohonan ini?')">
                                                                            <span data-bs-toggle="tooltip" data-bs-trigger="hover" title="Padam Permohonan">
                                                                                <i class="fa fa-trash fa-sm custom-white-icon"></i>
                                                                            </span>
                                                                        </a>
                                                                    
                                                                    </div>
                                                                </td>
                                                            @elseif ($item['status']=='2')
                                                                <td class="text-center">
                                                                    <a href="{{ route('permohonan.batal', ['id' => $item['smoku_id']]) }}" onclick="return confirm('Adakah anda pasti ingin membatalkan permohonan ini?')">
                                                                        <span data-bs-toggle="tooltip" data-bs-trigger="hover" title="Batal Permohonan">
                                                                            <i class="fa fa-times-circle fa-sm custom-white-icon" style="color: red"></i>
                                                                        </span>
                                                                    </a>
                                                                </td>
                                                            @elseif ($item['status']=='5')
                                                                <td class="text-center">
                                                                    <a href="{{ route('permohonan') }}" onclick="return confirm('Adakah anda pasti ingin kemaskini permohonan ini?')">
                                                                        <span data-bs-toggle="tooltip" data-bs-trigger="hover" title="Kemaskini Permohonan">
                                                                            <i class="fa-solid fa-pen-to-square" style="color: #000000;"></i>
                                                                        </span>
                                                                    </a>
                                                                </td>     
                                                            @elseif ($permohonan_latest->status=='9')
                                                                <td class="text-center">
                                                                    <a href="{{ route('permohonan') }}" onclick="return confirm('Adakah anda pasti ingin hantar permohonan ini?')">
                                                                        <span data-bs-toggle="tooltip" data-bs-trigger="hover" title="Hantar Semula Permohonan">
                                                                            <i class="fa-solid fa-pen-to-square" style="color: #000000;"></i>
                                                                        </span>
                                                                    </a>
                                                                </td>
                                                            @else
                                                            <td class="text-center"></td>                                                          
                                                            @endif
                                                        @endif    
                                                        {{--<td><a href="{{ route('delete',  $permohonan->nokp_pelajar) }}" class="btn btn-primary">Batal</a> </td>--}}
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>

                                        {{-- Modal --}}
                                        <div class="modal fade" id="dikembalikan" tabindex="-1" aria-labelledby="dikembalikan" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="pengesahanModalLabelBKOKU2">Permohonan anda tidak lengkap disebabkan oleh perkara berikut:</h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>

                                                    <div class="modal-body">
                                                        @php
                                                            function generateOrderedList($str) {
                                                                $strArr = explode(",", $str);
                                                                for ($i = 0; $i < count($strArr) - 1; $i++) {
                                                                    echo "<li>" . $strArr[$i] . "</li>";
                                                                }
                                                            }
                                                        @endphp

                                                        <ol type="1">
                                                            @php generateOrderedList($catatan->catatan_profil_diri ?? ''); @endphp
                                                            @php generateOrderedList($catatan->catatan_akademik  ?? ''); @endphp
                                                            @php generateOrderedList($catatan->catatan_salinan_dokumen  ?? ''); @endphp
                                                        </ol>


                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Ok</button>
                                                        </div>
                                                    </div>
                                                </div> 
                                            </div>
                                        </div> 
                                        <!--modal -->
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

    <style>
        .custom-width-btn {
            width: 130px; 
            height: 30px;
        }
    </style>
    </body>
</x-default-layout>

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
                            <h2>Sejarah Permohonan<br><small>Klik ID Permohonan untuk melihat sejarah permohonan dan sila klik pada butang "Layak" untuk memuat turun surat tawaran bagi pelajar tersebut.</small></h2>
                        </div>
                        <div class="tab-content" id="myTabContent">
                            <div class="body">
                                <div class="table-responsive">
                                    <table id="sortTable2" class="table table-striped table-hover dataTable js-exportable">
                                        <thead>
                                        <tr>
                                            <th style="width: 17%"><b>ID Permohonan</b></th>
                                            <th style="width: 33%"><b>Nama</b></th>
                                            <th style="width: 15%" class="text-center"><b>Tarikh Permohonan</b></th>
                                            <th style="width: 15%" class="text-center"><b>Status Terkini</b></th>
                                            <th style="width: 5%" class="text-center"><b>Tindakan</b></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        
                                        @foreach ($permohonan as $item)
                                            @if ($item['program']=="BKOKU")
                                                @php
                                                    
                                                    $nama_pemohon = DB::table('smoku')->where('id', $item['smoku_id'])->value('nama');
                                                    $status = DB::table('bk_status')->where('kod_status', $item['status'])->value('status');
                                                    if ($item['status']==3){
                                                        $status='Sedang Disaring';
                                                    }
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

                                                    $permohonan_latest = DB::table('permohonan')->orderBy('id', 'DESC')->first();

                                                    $item['tarikh_hantar'] = new DateTime($item['tarikh_hantar']);
                                                    $formattedDate = $item['tarikh_hantar']->format('d/m/Y');
                                                @endphp
                                                <tr>
                                                    <td>
                                                        <a href="{{ route('bkoku.rekod.permohonan', $item['id']) }}" title="">{{$item['no_rujukan_permohonan']}}</a>
                                                    </td>
                                                    <td>{{$pemohon}}</td>
                                                    <td class="text-center">{{$formattedDate}}</td>
                                                    @if ($item['status']=='1')
                                                        <td class="text-center"><button class="btn bg-info text-white">{{ucwords(strtolower($status))}}</button></td>
                                                    @elseif ($item['status']=='2')
                                                        <td class="text-center"><button class="btn bg-baharu text-white">{{ucwords(strtolower($status))}}</button></td>
                                                    @elseif ($item['status']=='3')
                                                        <td class="text-center"><button class="btn bg-sedang-disaring text-white">{{ucwords(strtolower($status))}}</button></td>
                                                    @elseif ($item['status']=='4')
                                                        <td class="text-center"><button class="btn bg-warning text-white">{{ucwords(strtolower($status))}}</button></td>
                                                    @elseif ($item['status']=='5')
                                                    <td class="text-center">
                                                        <button class="btn bg-dikembalikan text-white" data-bs-toggle="modal" data-bs-target="#dikembalikan{{$item['id']}}">
                                                            <span data-bs-toggle="tooltip" data-bs-trigger="hover" title="Papar sebab dikembalikan">{{ucwords(strtolower($status))}}</span>
                                                        </button>
                                                    </td>

                                                    {{-- Modal --}}
                                                    <div class="modal fade" id="dikembalikan{{$item['id']}}" tabindex="-1" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h1 class="modal-title fs-5" id="pengesahanModalLabelBKOKU2">Permohonan anda tidak lengkap disebabkan oleh perkara berikut:</h1>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>

                                                                <div class="modal-body">
                                                                    @php
                                                                        $catatan = DB::table('permohonan_saringan')
                                                                            ->orderBy('id', 'desc')
                                                                            ->where('permohonan_id', $item['id'])
                                                                            ->first();

                                                                        if (!function_exists('generateOrderedList')) {
                                                                            function generateOrderedList($str) {
                                                                                $strArr = explode(",", $str);
                                                                                $html = '';

                                                                                foreach ($strArr as $item) {
                                                                                    $trimmedItem = trim($item);
                                                                                    if (!empty($trimmedItem)) {
                                                                                        $html .= "<li>" . $trimmedItem . "</li>";
                                                                                    }
                                                                                }

                                                                                return $html;
                                                                            }
                                                                        }
                                                                    @endphp

                                                                    <ol type="1">
                                                                        {!! generateOrderedList($catatan->catatan_profil_diri ?? '') !!}
                                                                        {!! generateOrderedList($catatan->catatan_akademik ?? '') !!}
                                                                        {!! generateOrderedList($catatan->catatan_salinan_dokumen ?? '') !!}
                                                                    </ol>

                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Ok</button>
                                                                    </div>
                                                                </div>
                                                            </div> 
                                                        </div>
                                                    </div> 
                                                    {{-- Modal --}}

                                                    @elseif ($item['status']=='6')
                                                        <td class="text-center">
                                                            <a href="{{ route('generate-pdf', ['permohonanId' => $item['id']]) }}" class="btn btn-success btn-round btn-sm custom-width-btn">
                                                                <i class="fa fa-download fa-sm custom-white-icon" style="color: white !important;"></i> Layak
                                                            </a>
                                                        </td>
                                                    @elseif ($item['status']=='7')
                                                        <td class="text-center"><button class="btn bg-danger btn-round btn-sm custom-width-btn">{{ucwords(strtolower($status))}}</button></td>
                                                    @elseif ($item['status']=='8')
                                                        <td class="text-center">
                                                            <a href="{{ route('generate-pdf', ['permohonanId' => $item['id']]) }}" class="btn bg-dibayar btn-round btn-sm custom-width-btn">
                                                                <i class="fa fa-download fa-sm custom-white-icon" style="color: white !important;"></i> Dibayar
                                                            </a>
                                                        </td>
                                                    @elseif ($item['status']=='9')
                                                        <td class="text-center"><button class="btn bg-batal btn-round btn-sm custom-width-btn">{{ucwords(strtolower($status))}}</button></td>
                                                    @elseif ($item['status']=='10')
                                                        <td class="text-center"><button class="btn btn-round btn-sm custom-width-btn text-white" style="background-color: #488BCD">{{ucwords(strtolower($status))}}</button></td>
                                                    @endif

                                                        
                                                    @if ($item['status']=='1')
                                                        <td class="text-center">
                                                            <a href="{{ route('penyelaras.permohonan.baharu', $item['smoku_id']) }}" onclick="return confirm('Adakah anda pasti ingin kemaskini permohonan ini?')">
                                                                <span data-bs-toggle="tooltip" data-bs-trigger="hover" title="Kemaskini Permohonan">
                                                                    <i class="fa-solid fa-pen-to-square" style="color: #000000;"></i>
                                                                </span>
                                                            </a>
                                                            <a href="{{ route('bkoku.permohonan.delete', ['id' => $item['smoku_id']]) }}" onclick="return confirm('Adakah anda pasti ingin padam permohonan ini?')">
                                                                <span data-bs-toggle="tooltip" data-bs-trigger="hover" title="Padam Permohonan">
                                                                    <i class="fa fa-trash fa-sm custom-white-icon"></i>
                                                                </span>
                                                            </a>
                                                        </td>
                                                    @elseif ($item['status']=='2')
                                                        <td class="text-center">
                                                            <a href="{{ route('bkoku.permohonan.batal', ['id' => $item['smoku_id']]) }}" onclick="return confirm('Adakah anda pasti ingin membatalkan permohonan ini?')">
                                                                <span data-bs-toggle="tooltip" data-bs-trigger="hover" title="Batal Permohonan">
                                                                    <i class="fa fa-times-circle fa-sm custom-white-icon" style="color: red"></i>
                                                                </span>
                                                            </a>
                                                        </td>
                                                    @elseif ($item['status']=='5')
                                                        <td class="text-center">
                                                            <a href="{{ route('penyelaras.permohonan.baharu', $item['smoku_id']) }}" onclick="return confirm('Adakah anda pasti ingin kemaskini permohonan ini?')">
                                                                <span data-bs-toggle="tooltip" data-bs-trigger="hover" title="Kemaskini Permohonan">
                                                                    <i class="fa-solid fa-pen-to-square" style="color: #000000;"></i>
                                                                </span>
                                                            </a>
                                                        </td>         
                                                    @elseif ($permohonan_latest->status=='9')
                                                        <td class="text-center">
                                                            <a href="{{ route('penyelaras.permohonan.baharu', ['id' => $item['smoku_id']]) }}" onclick="return confirm('Adakah anda pasti ingin hantar permohonan ini?')">
                                                                <span data-bs-toggle="tooltip" data-bs-trigger="hover" title="Hantar Semula Permohonan">
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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

    <script>
        // Check if there is a flash message
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

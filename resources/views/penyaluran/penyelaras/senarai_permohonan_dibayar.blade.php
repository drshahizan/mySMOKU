<x-default-layout>
    <head>
        <title>Sekretariat BKOKU KPT</title>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">

        <!-- MAIN CSS -->
        <link rel="stylesheet" href="/assets/css/sekretariat.css">
        <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css"/>
        <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/default.min.css"/>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9">

         <!-- Bootstrap --> 
         <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>

        {{-- JAVASCRIPT --}}
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js"></script>

        <style>
            .nav{
                margin-left: 20px!important;
            }
        </style>
    </head>

    <!--begin::Page title-->
    <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
        <!--begin::Title-->
        <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Permohonan</h1>
        <!--end::Title-->
        <!--begin::Breadcrumb-->
        <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
            <!--begin::Item-->
            <li class="breadcrumb-item text-dark" style="color:darkblue">Penyaluran</li>
            <!--end::Item-->
            <!--begin::Item-->
            <li class="breadcrumb-item">
                <span class="bullet bg-gray-400 w-5px h-2px"></span>
            </li>
            <!--end::Item-->
            <!--begin::Item-->
            <li class="breadcrumb-item text-dark" style="color:darkblue">Keputusan Pembayaran</li>
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
                            {{-- top nav bar --}}
                            <ul class="nav nav-tabs" id="myTab" role="tablist" style="margin-top:20px;">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active" id="permohonan-tab" data-toggle="tab" data-target="#permohonan" type="button" role="tab" aria-controls="permohonan" aria-selected="true">Permohonan</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="tuntutan-tab" data-toggle="tab" data-target="#tuntutan" type="button" role="tab" aria-controls="tuntutan" aria-selected="true">Tuntutan</button>
                                </li>
                            </ul>
                            
                            <div class="tab-content" id="myTabContent">
                                {{-- Permohonan --}}
                                <div class="tab-pane fade show active" id="permohonan" role="tabpanel" aria-labelledby="permohonan-tab">
                                    <div class="header">
                                        <h2>Senarai Permohonan yang Telah Dibayar</h2>
                                    </div>
        
                                    <form action="{{ url('penyelaras/penyaluran/permohonan/dibayar') }}" method="GET">
                                        <div class="row" style="margin-left: 15px;">
                                            <div class="col-md-2">
                                                <label for="start_date"><b>Dari:</b></label>
                                                <input type="date" name="start_date" id="start_date" value="{{ Request::get('start_date') }}" class="form-control" />
                                            </div>
                                    
                                            <div class="col-md-2">
                                                <label for="end_date"><b>Hingga:</b></label>
                                                <input type="date" name="end_date" id="end_date" value="{{ Request::get('end_date') }}" class="form-control" />
                                            </div>
                                    
                                            <div class="col-md-8 right">
                                                <br>
                                                <button type="submit" class="btn btn-primary" style="width: 5%; padding-left: 10px;">
                                                    <i class="fa fa-filter" style="font-size: 15px;"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </form>  

                                    <div class="body">
                                        <table id="sortTable1" class="table table-bordered table-striped" style="margin-top: 0 !important;">
                                            <thead>
                                                <tr>
                                                    <th style="width: 15%"><b>ID Permohonan</b></th>                                                   
                                                    <th style="width: 40%"><b>Nama</b></th>
                                                    <th class="text-center" style="width: 15%"><b>Amaun Yuran</b></th>
                                                    <th class="text-center" style="width: 15%"><b>Amaun Wang Saku</b></th>
                                                    <th class="text-center" style="width: 15%"><b>Tarikh Transaksi</b></th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                @php
                                                    $i=0;
                                                @endphp
                                                @php
                                                    require_once app_path('helpers.php'); // Replace with the actual path to your helper file
                                                @endphp
                                            
                                                @foreach ($permohonanDibayar as $item)
                                                    @php
                                                        $i++;
                                                        $nama_pemohon = DB::table('smoku')->where('id', $item['smoku_id'])->value('nama');
                                                        $institusi_id = DB::table('smoku_akademik')->join('bk_info_institusi','bk_info_institusi.id_institusi','=','smoku_akademik.id_institusi' )->where('smoku_id', $item['smoku_id'])->value('bk_info_institusi.id_institusi');
                                                        $instiusi_user = auth()->user()->id_institusi;

                                                        // nama pemohon
                                                        $text = ucwords(strtolower($nama_pemohon)); 
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
                                                    
                                                    @if ($institusi_id == $instiusi_user)
                                                        <tr>
                                                            <td style="width: 15%"><a href="#" class="open-modal-link-permohonan" data-bs-toggle="modal" data-bs-target="#baucerPermohonan{{$item['id']}}" data-no-rujukan="{{$item['no_rujukan_permohonan']}}">{{$item['no_rujukan_permohonan']}}</a></td>
                                                            <td style="width: 40%">{{$pemohon}}</td>
                                                            <td class="text-center" style="width: 15%">
                                                                @if ($item->yuran_dibayar !== null)
                                                                    RM {{ number_format($item->yuran_dibayar, 2) }}
                                                                @endif
                                                            </td>
                                                            <td class="text-center" style="width: 15%">
                                                                @if ($item->wang_saku_dibayar !== null)
                                                                    RM {{ number_format($item->wang_saku_dibayar, 2) }}
                                                                @endif
                                                            </td>      
                                                            <td class="text-center" style="width: 15%">{{date('d/m/Y', strtotime($item->tarikh_baucer))}}</td>
                                                        </tr>

                                                        <!-- Modal for Baucer -->
                                                        <div class="modal fade" id="baucerPermohonan{{$item['id']}}" tabindex="-1" aria-labelledby="baucerPermohonanLabel{{$item['id']}}" aria-hidden="true">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h1 class="modal-title fs-5" id="baucerPermohonanLabel{{$item['id']}}">Kemaskini Maklumat Pembayaran</h1>
                                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <!-- Form for single submission -->
                                                                        <form action="{{ route('update.maklumat.baucer', ['permohonanId' => $item['id']]) }}" method="POST" class="modal-form">
                                                                            @csrf
                                                                            <div class="mb-3">
                                                                                <label for="yuranDibayar" class="col-form-label">Yuran Dibayar (RM) :</label>
                                                                                <input type="number" step="0.01" class="form-control" id="yuranDibayar{{$item['id']}}" name="yuranDibayar" value="{{ $item->yuran_dibayar ?? '' }}">
                                                                            </div>

                                                                            <div class="mb-3">
                                                                                <label for="message-text" class="col-form-label">Wang Saku Dibayar (RM) :</label>
                                                                                <input type="number" step="0.01" class="form-control" id="wangSakuDibayar{{$item['id']}}" name="wangSakuDibayar"  value="{{ $item->wang_saku_dibayar ?? '' }}">
                                                                            </div>

                                                                            <div class="mb-3">
                                                                                <label for="recipient-name" class="col-form-label">No Baucer :</label>
                                                                                <input type="text" class="form-control" id="noBaucer" name="noBaucer{{$item['id']}}"  value="{{ $item->no_baucer ?? '' }}">
                                                                            </div>
                                                                            
                                                                            <div class="mb-3">
                                                                                <label for="message-text" class="col-form-label">Perihal :</label>
                                                                                <textarea class="form-control" id="perihal" name="perihal{{$item['id']}}"  value="{{ $item->perihal ?? '' }}">{{$item->perihal}}</textarea>
                                                                            </div>

                                                                            <div class="mb-3">
                                                                                <label for="message-text" class="col-form-label">Tarikh Baucer :</label>
                                                                                <input type="date" class="form-control" id="tarikhBaucer{{$item['id']}}" name="tarikhBaucer"  value="{{ $item->tarikh_baucer ?? '' }}">
                                                                            </div>

                                                                            <input type="hidden" name="permohonan_id" value="{{ $item['id'] }}">

                                                                            <div class="modal-footer">
                                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                                                <button type="submit" class="btn btn-primary btn-round float-end">Hantar</button>
                                                                            </div>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endif
                                                @endforeach 
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                {{-- Tuntutan --}}
                                <div class="tab-pane fade" id="tuntutan" role="tabpanel" aria-labelledby="tuntutan-tab">
                                    <div class="header">
                                        <h2>Senarai Tuntutan yang Telah Dibayar</h2>
                                    </div>
        
                                    <form action="{{ url('penyelaras/penyaluran/permohonan/dibayar') }}" method="GET">
                                        <div class="row" style="margin-left: 15px;">
                                            <div class="col-md-2">
                                                <label for="start_date"><b>Dari:</b></label>
                                                <input type="date" name="start_date" id="start_date" value="{{ Request::get('start_date') }}" class="form-control" />
                                            </div>
                                    
                                            <div class="col-md-2">
                                                <label for="end_date"><b>Hingga:</b></label>
                                                <input type="date" name="end_date" id="end_date" value="{{ Request::get('end_date') }}" class="form-control" />
                                            </div>
                                    
                                            <div class="col-md-8 right">
                                                <br>
                                                <button type="submit" class="btn btn-primary" style="width: 5%; padding-left: 10px;">
                                                    <i class="fa fa-filter" style="font-size: 15px;"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </form>  

                                    <div class="body">
                                        <table id="sortTable2" class="table table-bordered table-striped" style="margin-top: 0 !important;">
                                            <thead>
                                                <tr>
                                                    <th style="width: 15%"><b>ID Tuntutan</b></th>                                                   
                                                    <th style="width: 40%"><b>Nama</b></th>
                                                    <th class="text-center" style="width: 15%"><b>Amaun Yuran</b></th>
                                                    <th class="text-center" style="width: 15%"><b>Amaun Wang Saku</b></th>
                                                    <th class="text-center" style="width: 15%"><b>Tarikh Transaksi</b></th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                @php
                                                    $i=0;
                                                @endphp
                                                @php
                                                    require_once app_path('helpers.php'); // Replace with the actual path to your helper file
                                                @endphp
                                            
                                                @foreach ($tuntutanDibayar as $item)
                                                    @php
                                                        $i++;
                                                        $nama_pemohon = DB::table('smoku')->where('id', $item['smoku_id'])->value('nama');
                                                        $institusi_id = DB::table('smoku_akademik')->join('bk_info_institusi','bk_info_institusi.id_institusi','=','smoku_akademik.id_institusi' )->where('smoku_id', $item['smoku_id'])->value('bk_info_institusi.id_institusi');
                                                        $instiusi_user = auth()->user()->id_institusi;

                                                        // nama pemohon
                                                        $text = ucwords(strtolower($nama_pemohon)); 
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
                                                    
                                                    @if ($institusi_id == $instiusi_user)
                                                        <tr>
                                                            <td style="width: 15%">{{$item['no_rujukan_tuntutan']}}</td>
                                                            <td style="width: 40%">{{$pemohon}}</td>
                                                            <td class="text-center" style="width: 15%">
                                                                @if ($item->yuran_dibayar !== null)
                                                                    RM {{ number_format($item->yuran_dibayar, 2) }}
                                                                @endif
                                                            </td>
                                                            <td class="text-center" style="width: 15%">
                                                                @if ($item->wang_saku_dibayar !== null)
                                                                    RM {{ number_format($item->wang_saku_dibayar, 2) }}
                                                                @endif
                                                            </td>       
                                                            <td class="text-center" style="width: 15%">{{date('d/m/Y', strtotime($item->tarikh_baucer))}}</td>
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
            //sorting table
            $('#sortTable1').DataTable({
                ordering: true, // Enable manual sorting
                order: [] // Disable initial sorting
            });
            $('#sortTable2').DataTable({
                ordering: true, 
                order: [] 
            });

            $(document).ready(function () {
                $('.open-modal-link-permohonan').on('click', function () {
                    var permohonanId = $(this).data('no-rujukan');
                     // Make an Ajax request to retrieve data
                     $.ajax({
                        url: '/penyelaras/maklumat/baucer/' + permohonanId,
                        type: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}',
                            yuranDibayar: $('#yuranDibayar' + permohonanId).val(),
                            wangSakuDibayar: $('#wangSakuDibayar' + permohonanId).val(),
                            noBaucer: $('#noBaucer' + permohonanId).val(),
                            perihal: $('[name="perihal' + permohonanId + '"]').text(),
                            tarikhBaucer: $('#tarikhBaucer' + permohonanId).val(),
                        },
                        success: function (response) {
                            if (response.status === 'success') {
                                // Display sweet alert on success
                                swal({
                                    title: 'Success!',
                                    text: response.message,
                                    icon: 'success',
                                }).then((value) => {
                                    // Redirect to the original page
                                    window.location.href = '/penyelaras/penyaluran/permohonan/dibayar';
                                });
                            } else {
                                // Handle other cases if needed
                                console.error('Error updating data:', response);
                            }
                        },
                        error: function (error) {
                            console.error('Error fetching data:', error);
                        }
                    });
                });
            });

        </script>
    </body>
</x-default-layout> 
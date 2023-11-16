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
            <li class="breadcrumb-item text-dark" style="color:darkblue">Kemaskini Baucer</li>
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
                                <h2>Senarai Permohonan yang Layak<br><small>Klik ID Permohonan untuk kemaskini baucer pemohon.</small></h2>
                            </div>

                            <div class="tab-content" id="myTabContent">
                                <form action="{{ url('penyelaras/penyaluran/baucer/permohonan') }}" method="GET">
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
                                    <form action="{{ route('bulk.approval') }}" method="POST">
                                        {{csrf_field()}}
                                        <table id="sortTable1" class="table table-bordered table-striped" style="margin-top: 0 !important;">
                                            <thead>
                                                <tr>
                                                    <th class="text-center" style="width: 5%;"><input type="checkbox" name="select-all" id="select-all" onclick="toggle(this);" /></th>
                                                    <th class="text-center" style="width: 15%"><b>ID Permohonan</b></th>                                                   
                                                    <th class="text-center" style="width: 40%"><b>Nama</b></th>
                                                    <th class="text-center" style="width: 10%"><b>Amaun Yuran</b></th>
                                                    <th class="text-center" style="width: 15%"><b>Amaun Wang Suka</b></th>
                                                    <th class="text-center" style="width: 15%"><b>Tarikh Permohonan</b></th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                @php
                                                    $i=0;
                                                @endphp
                                                @php
                                                    require_once app_path('helpers.php'); // Replace with the actual path to your helper file
                                                @endphp
                                            
                                                @foreach ($layak as $item)
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
                                                            <td class="text-center" style="width: 5%;"><input type="checkbox" name="selected_items[]" value="{{ $item->id }}" /></td>                                           
                                                            <td style="width: 15%"><a href="#" target="_blank">{{$item['no_rujukan_permohonan']}}</a></td>
                                                            <td style="width: 40%">{{$pemohon}}</td>
                                                            <td style="width: 10%">{{$item->yuran_dibayar}}</td>
                                                            <td style="width: 15%">{{$item->wang_saku_dibayar}}</td>                                       
                                                            <td class="text-center" style="width: 15%">{{date('d/m/Y', strtotime($item->created_at))}}</td>
                                                        </tr>
                                                    @endif
                                                @endforeach 
                                            </tbody>
                                        </table>

                                        <!-- Button trigger modal -->
                                        <button type="button" class="btn btn-primary btn-round float-end mb-10" data-bs-toggle="modal" data-bs-target="#pengesahanModalBKOKU2">
                                            Sahkan
                                        </button>
                                    
                                        {{-- Modal --}}
                                        <div class="modal fade" id="pengesahanModalBKOKU2" tabindex="-1" aria-labelledby="pengesahanModalLabelBKOKU2" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="pengesahanModalLabelBKOKU2">Rekod Keputusan Permohonan</h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>

                                                    <div class="modal-body">
                                                        <div class="mb-3">
                                                            <label for="recipient-name" class="col-form-label">No. Mesyuarat:</label>
                                                            <input type="text" class="form-control" id="noMesyuarat" name="noMesyuarat">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="message-text" class="col-form-label">Tarikh Mesyuarat:</label>
                                                            <input type="date" class="form-control" id="tarikhMesyuarat" name="tarikhMesyuarat">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="message-text" class="col-form-label">Keputusan Permohonan:</label>
                                                            <select onchange="select1()" class="form-control" id="keputusan" name="keputusan">
                                                                <option value="">Pilih Keputusan</option>
                                                                <option value="Lulus" {{Request::get('status') == 'Lulus' ? 'selected':'' }} >Lulus</option>
                                                                <option value="Tidak Lulus" {{Request::get('status') == 'Tidak Lulus' ? 'selected':'' }} >Tidak Lulus</option>
                                                            </select>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="message-text" class="col-form-label">Catatan:</label>
                                                            <textarea class="form-control" id="catatan" name="catatan"></textarea>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                            <button type="submit" class="btn btn-primary btn-round float-end">Hantar</button>
                                                        </div>
                                                    </div>
                                                </div> 
                                            </div>
                                        </div> 
                                        <br><br>                                       
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script>
            //sorting function
            $('#sortTable1').DataTable();
           
            // check all checkboxes at once
            function toggle(source) {
                var checkboxes = document.querySelectorAll('input[name="selected_items[]"]');
                for (var i = 0; i < checkboxes.length; i++) {
                    checkboxes[i].checked = source.checked;
                }
            }
        </script>
    </body>
</x-default-layout> 
<x-default-layout>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">

        <!-- MAIN CSS -->
        <link rel="stylesheet" href="/assets/css/sekretariat.css">
        <link rel="stylesheet" href="/assets/css/saringan.css">
        <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

        <style>
            .nav{
                margin-left: 20px!important;
            }
        </style>
    </head>


    <!--begin::Page title-->
    <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
        <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Kemaskini</h1>
        <!--begin::Breadcrumb-->
        <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
            <li class="breadcrumb-item text-dark" style="color:darkblue">Kemaskini</li>
            <li class="breadcrumb-item">
                <span class="bullet bg-gray-400 w-5px h-2px"></span>
            </li>
            <li class="breadcrumb-item text-dark" style="color:darkblue">Pendaftaran Pelajar Sedia Ada</li>
        </ul>
        <!--end::Breadcrumb-->
    </div>
    <!--end::Page title-->

    <br>

    {{-- Body Content --}}
    <div id="main-content">
        <div class="container-fluid">
            <div class="block-header">
                <div class="row clearfix">
                    <div class="card align-items-center">
                        <div class="tab-content" id="myTabContent">
							<!--begin::Body-->
                            <div class="card-body">
                                <div class="row g-5 g-xl-8">
                                    <!--begin::Semak SMOKU-->
                                    <div class="col-xl-4">
                                        <!--begin::Engage widget 9-->
                                        <div class="card h-lg-100" style="background:  #ffffff )">
                                            <!--begin::Body-->
                                            <div class="card-body">
                                                <!--begin::Row-->
                                                <div class="row align-items-center">
                                                    <!--begin::form-->
                                                    <form class="form w-100" action="{{ route('kemaskini.sekretariat.semak.pelajar')}}" method="post"> 
                                                    @csrf 
                                                        <!--begin::Heading-->
                                                        <div class="text-center mb-11">
                                                            <br>
                                                            <!--begin::Subtitle-->
                                                            <h2 class="text-dark fw-bolder mb-3">
                                                                Sistem Maklumat Orang Kurang Upaya (SMOKU)
                                                            </h2>
                                                            <!--end::Subtitle--->
                                                        </div>
                                                        <!--begin::logo-->
                                                        <div class="text-center mb-11">
                                                            <img alt="Logo" src="{{ image('logos/logo.png') }}" class="h-100px h-lg-90px"/>        
                                                        </div>
                                                        <!--end::logo-->
                                                        <!--begin::Input group-"-->
                                                        <div class="col-xs-3">
                                                        <!--begin::Name-->
                                                        <input type="text" placeholder="No Kad Pengenalan" name="no_kp" maxlength="12" autocomplete="off" class="form-control bg-transparent" style="text-align:center; display: block;margin-left: auto; margin-right: auto;"/>
                                                        <!--end::Name-->
                                                        </div>
                                                        <!--begin::Submit button-->
                                                        <div class="d-flex flex-center mt-15">
                                                            <button type="submit"  class="btn btn-primary">
                                                                Daftar
                                                            </button>
                                                        </div>
                                                    </form>
                                                    <!--end::form-->
                                                </div>
                                            </div>
                                            <!--end::Body-->
                                        </div>
                                    </div>
                                    <!--end::Semak SMOKU-->
                                    
                                    <!--begin::List-->
                                    <div class="col-xl-8">
                                        <!--begin::Table widget 9-->
                                        <div class="card card-flush h-xl-100">
                                            <!--begin::Header-->
                                            <div class="card-header pt-5">
                                                <!--begin::Title-->
                                                <h3 class="card-title align-items-start flex-column">
                                                    <span class="card-label fw-bold text-gray-800">Pendaftaran Pelajar Sedia Ada</span>
                                                    <!--<span class="text-gray-400 pt-1 fw-semibold fs-6">Program BKOKU</span>-->
                                                </h3>
                                                <!--end::Title-->
                                            
                                            </div>
                                            <!--end::Header-->
                                            <!--begin::Body-->
                                            <div class="body">
                                                <!--begin::Table container-->
                                                <div class="table-responsive">
                                                    <!--begin::Table-->
                                                    <table id="sortTable1" class="table table-bordered table-striped">
                                                        <!--begin::Table head-->
                                                        <thead>
                                                            <tr>
                                                                <th class="text-center">Bil</th>
                                                                <th class="text-center">No. Kad Pengenalan</th>
                                                                <th class="text-center">No. Kad JKM</th>
                                                                <th class="text-center">Nama</th>
                                                                <th class="text-center">Tindakan</th>
                                                                <th class="text-center"></th>
                                                            </tr>
                                                        </thead>
                                                        <!--end::Table head-->
                                                        <!--begin::Table body-->
                                                        <tbody>
                                                            @foreach ($smoku as $smoku)
                                                                @php
                                                                    $text = ucwords(strtolower($smoku->nama)); 
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

                                                                @php
                                                                    // Retrieve data from bk_tarikh_iklan table
                                                                    $bk_tarikh_iklan = DB::table('bk_tarikh_iklan')->orderBy('created_at', 'desc')->first();
                                                            
                                                                    // Get current date and time
                                                                    $currentDateTime = now();
                                                            
                                                                    // Check if current date and time fall within the allowed range
                                                                    $tarikhMula = \Carbon\Carbon::parse($bk_tarikh_iklan->tarikh_mula . ' ' . $bk_tarikh_iklan->masa_mula);
                                                                    $tarikhTamat = \Carbon\Carbon::parse($bk_tarikh_iklan->tarikh_tamat . ' ' . $bk_tarikh_iklan->masa_tamat);
                                                            
                                                                    // Check if current date and time fall within the allowed range
                                                                    $isWithinRange = $currentDateTime->between($tarikhMula, $tarikhTamat);
                                                                @endphp
                                                            <tr>
                                                                <td class="text-center">{{ $loop->iteration }}.</td>
                                                                <td class="text-center">{{ $smoku->no_kp}}</td>
                                                                <td class="text-center">{{ $smoku->no_daftar_oku}}</td>
                                                                <td class="text-center">{{$pemohon}}</td>
                                                                <td class="text-center">
                                                                    <a href="{{route('kemaskini.sekretariat.daftar',$smoku->smoku_id)}}">
                                                                        <button class="btn bg-primary text-white">Kemaskini</button>
                                                                    </a>
                                                                </td>
                                                                
                                                                <td class="text-center">
                                                                    <a href="{{ route('pendaftaran.delete', ['id' => $smoku->smoku_id]) }}" onclick="return confirm('Adakah anda pasti ingin padam pendaftaran ini?')">
                                                                        <span data-bs-toggle="tooltip" data-bs-trigger="hover" title="Padam Pendaftaran">
                                                                            <i class="fa fa-trash fa-sm custom-white-icon"></i>
                                                                        </span>
                                                                    </a>
                                                                </td>
                                                            </tr>
                                                            @endforeach	
                                                        </tbody>
                                                        <!--end::Table body-->
                                                    </table>
                                                    <!--end::Table-->
                                                </div>
                                                <!--end::Table container-->
                                            </div>
                                            <!--end::Body-->
                                        </div>
                                        <!--end::Table Widget 9-->
                                    </div>
                                </div>
                            </div>
                            <!--end::Body-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

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

</x-default-layout>

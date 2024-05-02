<x-default-layout>
    <head>
        <link rel="stylesheet" href="/assets/css/saringan.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js"></script>
        <script src="/assets/lang/Malay.json"></script>    
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10">
    </head>
    <!--begin::Page title-->
    <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
        <!--begin::Title-->
        <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Utama</h1>
        <!--end::Title-->
        <!--begin::Breadcrumb-->
        <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
            <!--begin::Item-->
            <li class="breadcrumb-item text-muted">
                <a href="/" class="text-dark text-hover-primary" style="color:darkblue">Laman Utama</a>
            </li>
            <!--end::Item-->
            <!--begin::Item-->
            <li class="breadcrumb-item">
                <span class="bullet bg-gray-400 w-5px h-2px"></span>
            </li>
            <!--end::Item-->
            <!--begin::Item-->
            <li class="breadcrumb-item text-dark" style="color:darkblue">Paparan Pemuka</li>
            <!--end::Item-->
        </ul>
        <!--end::Breadcrumb-->
    </div>
    
    <br>
                                 
    <!--begin::Row-->
    <div class="row g-5 g-xl-8">
        <!--begin::Col-->
        <div class="col-xl-4">
            <!--begin::Engage widget 9-->
            <div class="card h-lg-100" style="background:  #ffffff )">
                <!--begin::Body-->
                <div class="card-body">
                    <!--begin::Row-->
                    <div class="row align-items-center">
                        <!--begin::form-->
                        <form class="form w-100" action="{{ route('penyelaras.ppk.dashboard')}}" method="post"> 
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
        <!--end::Col-->
        <!--begin::Col-->
        <div class="col-xl-8">
            <!--begin::Table widget 9-->
            <div class="card card-flush h-xl-100">
                <!--begin::Header-->
                <div class="card-header pt-5">
                    <!--begin::Title-->
                    <h3 class="card-title align-items-start flex-column">
                        <span class="card-label fw-bold text-gray-800">Pendaftaran Pelajar PPK</span>
                    </h3>
                    <!--end::Title-->
                   
                </div>
                <!--end::Header-->
                <!--begin::Body-->
                <div class="body">
                    <!--begin::Table container-->
                    <div class="table-responsive">
                        <!--begin::Table-->
                        <table id="sortTable" class="table table-bordered table-striped">
                            <!--begin::Table head-->
                            <thead>
                                <tr>
                                    <th class="text-center">Bil</th>
                                    <th class="text-center">No. Kad Pengenalan</th>
                                    <th class="text-center">No. Kad JKM</th>
                                    <th class="text-center">Nama</th>
                                    <th class="text-center">Status</th>
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
                                    @if($isWithinRange)
                                        <td class="text-center">
                                            <a href="{{route('penyelaras.ppk.permohonan.baharu',$smoku->smoku_id)}}">
                                                @if ($smoku->status == 1)
                                                    <button class="btn bg-info text-white">Deraf</button>
                                                @elseif ($smoku->status == 9)
                                                    <button class="btn bg-batal text-white">Batal</button>
                                                @else 
                                                    <button class="btn bg-primary text-white">Belum Mohon</button>
                                                @endif
                                            </a>
                                        </td>
                                    @else
                                        <td class="text-center">
                                            @if ($smoku->status == 1)
                                                <button class="btn bg-info text-white" onclick="showAlert()">Deraf</button>
                                            @elseif ($smoku->status == 9)
                                                <button class="btn bg-batal text-white">Batal</button>
                                            @else 
                                                <button class="btn bg-primary text-white" onclick="showAlert()">Belum Mohon</button>
                                            @endif
                                        </td>
                                    @endif
                                    <td class="text-center">
                                        @if ($smoku->status < 1)
                                            <a href="{{ route('ppk.pendaftaran.delete', ['id' => $smoku->smoku_id]) }}" onclick="return confirm('Adakah anda pasti ingin padam pendaftaran ini?')">
                                                <span data-bs-toggle="tooltip" data-bs-trigger="hover" title="Padam Pendaftaran">
                                                    <i class="fa fa-trash fa-sm custom-white-icon"></i>
                                                </span>
                                            </a>
                                        @elseif ($smoku->status == 1)
                                            <a href="{{ route('ppk.permohonan.delete', ['id' => $smoku->smoku_id]) }}" onclick="return confirm('Adakah anda pasti ingin padam permohonan ini?')">
                                                <span data-bs-toggle="tooltip" data-bs-trigger="hover" title="Padam Permohonan">
                                                    <i class="fa fa-trash fa-sm custom-white-icon"></i>
                                                </span>
                                            </a>    
                                        @endif    
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
        </div> <script>
            $(document).ready(function() {
                $('#sortTable').DataTable({
                    "language": {
                        "url": "/assets/lang/Malay.json"
                    }
                });
            });
        </script>
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
        function showAlert() 
        {
            Swal.fire({
            icon: 'error',
            title: 'Permohonan telah ditutup.',
            text: ' {!! session('failed') !!}',
            confirmButtonText: 'OK'
            });
        }
    </script>
</x-default-layout>
    
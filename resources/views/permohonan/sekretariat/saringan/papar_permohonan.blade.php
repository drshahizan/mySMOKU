<x-default-layout>
    <link rel="stylesheet" href="/assets/css/saringan.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <!-- Main body part  -->
    <style>
        .maklumat, .maklumat td{
            border: none!important;
            padding:2px 8px!important;
        }
        td{
            vertical-align: top!important;
        }
        .space{
            width: 15%;
        }
        .white{
            color: white!important;
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
			<li class="breadcrumb-item text-dark" style="color:darkblue">Saringan</li>
			<!--end::Item-->
            <!--begin::Item-->
			<li class="breadcrumb-item">
				<span class="bullet bg-gray-400 w-5px h-2px"></span>
			</li>
			<!--end::Item-->
			<!--begin::Item-->
			<li class="breadcrumb-item text-dark" style="color:darkblue">Maklumat Permohonan</li>
			<!--end::Item-->
		</ul>
	<!--end::Breadcrumb-->
	</div>
	<!--end::Page title-->
    <br>

    <div id="main-content">
        <div class="container-fluid">
            <!-- Page header section  -->
            <div class="row clearfix">
                <div class="col-12">
                    <nav class="navbar navbar-expand-lg navbar-light bg-light page_menu">
                        <!--<a class="navbar-brand" href="#">M.</a>-->
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                        <i class="fa fa-bars text-muted"></i>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarNavDropdown">
                            <ul class="navbar-nav mr-auto">
                                <li class="nav-item vivify swoopInTop delay-150 active"><b>Saring Permohonan</b></li>
                            </ul>
                            {{-- <div class="ml-auto">
                                <a href="{{ url('cetak-maklumat-pemohon') }}" target="_blank" class="btn btn-primary">Cetak</a>
                            </div> --}}
                        </div>
                    </nav>
                </div>
                <div class="col-lg-12">
                    <div class="card">
                        <div class="body">
                                <div class="col-md-6 col-sm-6">
                                    <br>
                                    @php
                                        if($permohonan->status==4){
                                            $tarikh_status = DB::table('sejarah_permohonan')->where('permohonan_id', $permohonan->id)->where('status', 4)->value('created_at');
                                        }
                                        elseif($permohonan->status==5){
                                            $tarikh_status = DB::table('sejarah_permohonan')->where('permohonan_id',$permohonan->id)->where('status', 5)->value('created_at');
                                        }

                                        $user_id = DB::table('sejarah_permohonan')->where('permohonan_id', $permohonan->id)->where('status', $permohonan->status)->latest()->value('dilaksanakan_oleh');

                                        if($user_id==null){
                                            $user_name = "Tiada Maklumat";
                                        }
                                        else{
                                            $user_name = DB::table('users')->where('id', $user_id)->value('nama');
                                            $text = ucwords(strtolower($user_name)); // Assuming you're sending the text as a POST parameter
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
                                            $user_name = implode(' ', $result);
                                        }

                                        $status = DB::table('bk_status')->where('kod_status', $permohonan->status)->value('status');
                                        $text = ucwords(strtolower($smoku->nama)); // Assuming you're sending the text as a POST parameter
                                        $conjunctions = ['bin', 'binti', 'of', 'in', 'and'];
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
                                    <table class="maklumat">
                                        <tr>
                                            <td><strong>ID Permohonan</strong></td>
                                            <td>:</td>
                                            <td>{{$permohonan->no_rujukan_permohonan}}</td>
                                            <td class="space">&nbsp;</td>
                                            <td><strong>Tarikh Permohonan</strong></td>
                                            <td>:</td>
                                            <td>{{date('d/m/Y', strtotime($permohonan->tarikh_hantar))}}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Nama</strong></td>
                                            <td>:</td>
                                            <td>{{$pemohon}}</td>
                                            <td class="space">&nbsp;</td>
                                            <td><strong>Sesi/Semester</strong></td>
                                            <td>:</td>
                                            <td>{{$akademik->sesi}}-0{{$akademik->sem_semasa}}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>No. Kad Pengenalan</strong></td>
                                            <td>:</td>
                                            <td>{{$smoku->no_kp}}</td>
                                            <td class="space">&nbsp;</td>
                                            <td><strong>Status</strong></td>
                                            <td>:</td>
                                            <td>{{ucwords(strtolower($status))}} ({{date('d/m/Y', strtotime($tarikh_status))}} oleh {{$user_name}})</td>
                                        </tr>
                                    </table>
                                </div>
                                <br>
                            <div class="row clearfix">
                                <div class="col-md-12">
                                    <div class="table-responsive">
                                        @if($permohonan->status==4)
                                            <table class="table table-hover table-bordered mb-5">
                                                <thead class="table-primary">
                                                    <tr>
                                                        <th style="width: 5%; text-align:right;">No.</th>
                                                        <th style="width: 20%;">Item</th>
                                                        <th style="width: 25%;">Keputusan Saringan</th>
                                                        <th style="width: 50%;">Catatan</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td style="text-align:right;">1</td>
                                                        <td>
                                                            <span><a href="{{ url('permohonan/sekretariat/saringan/maklumat-profil-diri/'.$permohonan->id) }}" target="_blank">Maklumat Profil Diri</a></span>
                                                        </td>
                                                        <td class="hidden-sm-down">
                                                            Lengkap
                                                        </td>
                                                        <td>
                                                            &nbsp;
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td style="text-align:right;">2</td>
                                                        <td>
                                                            <span><a href="{{ url('permohonan/sekretariat/saringan/maklumat-akademik/'.$permohonan->id) }}" target="_blank">Maklumat Akademik</a></span>
                                                        </td>
                                                        <td class="hidden-sm-down">
                                                            Lengkap
                                                        </td>
                                                        <td>
                                                            &nbsp;
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td style="text-align:right;">3</td>
                                                        <td>
                                                            <span><a href="{{ url('permohonan/sekretariat/saringan/salinan-dokumen/'.$permohonan->id) }}" target="_blank">Salinan Dokumen</a></span>
                                                        </td>
                                                    <td class="hidden-sm-down">
                                                        Lengkap
                                                    </td>
                                                    <td>
                                                       &nbsp;
                                                    </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        @elseif($permohonan->status==5)
                                            <table class="table table-hover table-bordered mb-5">
                                                <thead class="table-primary">
                                                    <tr>
                                                        <th style="width: 5%; text-align:right;">No.</th>
                                                        <th style="width: 20%;">Item</th>
                                                        <th style="width: 25%;">Keputusan Saringan</th>
                                                        <th style="width: 50%;">Catatan</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td style="text-align:right;">1</td>
                                                        <td>
                                                            <span><a href="{{ url('permohonan/sekretariat/saringan/maklumat-profil-diri/'.$permohonan->id) }}" target="_blank">Maklumat Profil Diri</a></span>
                                                        </td>
                                                        <td class="hidden-sm-down">
                                                            @if ($catatan->catatan_profil_diri == null)
                                                                Lengkap
                                                            @else
                                                                Tidak Lengkap
                                                            @endif
                                                        </td>
                                                        <td>
                                                            @php
                                                                $str = $catatan->catatan_profil_diri;
                                                                $strArr = explode(",", $str);
                                                            @endphp
                                                            @for ($i = 0; $i < count($strArr)-1; $i++)
                                                            {{$i+1}}. {{$strArr[$i]}} <br>
                                                            @endfor
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td style="text-align:right;">2</td>
                                                        <td>
                                                            <span><a href="{{ url('permohonan/sekretariat/saringan/maklumat-akademik/'.$permohonan->id) }}" target="_blank">Maklumat Akademik</a></span>
                                                        </td>
                                                        <td class="hidden-sm-down">
                                                            @if ($catatan->catatan_akademik == null)
                                                                Lengkap
                                                            @else
                                                                Tidak Lengkap
                                                            @endif
                                                        </td>
                                                        <td>
                                                            @php
                                                                $str = $catatan->catatan_akademik;
                                                                $strArr = explode(",", $str);
                                                            @endphp
                                                            @for ($i = 0; $i < count($strArr)-1; $i++)
                                                            {{$i+1}}. {{$strArr[$i]}} <br>
                                                            @endfor
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td style="text-align:right;">3</td>
                                                        <td>
                                                            <span><a href="{{ url('permohonan/sekretariat/saringan/salinan-dokumen/'.$permohonan->id) }}" target="_blank">Salinan Dokumen</a></span>
                                                        </td>
                                                    <td class="hidden-sm-down">
                                                        @if ($catatan->catatan_salinan_dokumen == null)
                                                            Lengkap
                                                        @else
                                                            Tidak Lengkap
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @php
                                                            $str = $catatan->catatan_salinan_dokumen;
                                                            $strArr = explode(",", $str);
                                                        @endphp
                                                        @for ($i = 0; $i < count($strArr)-1; $i++)
                                                        {{$i+1}}. {{$strArr[$i]}} <br>
                                                        @endfor
                                                    </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        @endif

                                    </div>
                                </div>
                            </div>

                            <div class="row clearfix">
                                <div class="col-md-6">
                                    </div>
                                <div class="col-md-6 text-right">
                                    @if($permohonan->status == 4)
                                        <a href="{{ url('permohonan/sekretariat/saringan/papar-tuntutan/'.$permohonan->id) }}" class="white"><button class="btn btn-primary theme-bg gradient action-btn" value="Simpan" id="check">Teruskan </a></button>
                                    @else
                                        <a href="{{ url('permohonan/sekretariat/saringan/senarai-permohonan') }}" class="white"><button class="btn btn-primary theme-bg gradient action-btn" value="Simpan" id="check">Teruskan </a></button>
                                    @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-default-layout>

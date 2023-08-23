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
    </style>
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
                                        $akademik = DB::table('maklumatakademik')->where('nokp_pelajar', $pelajar->nokp_pelajar)->first();
                                    @endphp
                                    <table class="maklumat">
                                        <tr>
                                            <td><strong>ID Permohonan</strong></td>
                                            <td>:</td>
                                            <td>{{$permohonan->id_permohonan}}</td>
                                            <td class="space">&nbsp;</td>
                                            <td><strong>Tarikh Permohonan</strong></td>
                                            <td>:</td>
                                            <td>{{$permohonan->created_at->format('d/m/Y')}}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Nama</strong></td>
                                            <td>:</td>
                                            <td>{{$pelajar->nama_pelajar}}</td>
                                            <td class="space">&nbsp;</td>
                                            <td><strong>Semester Semasa</strong></td>
                                            <td>:</td>
                                            <td>{{$akademik->sem_semasa}}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>No. Kad Pengenalan</strong></td>
                                            <td>:</td>
                                            <td>{{$pelajar->nokp_pelajar}}</td>
                                            <td class="space">&nbsp;</td>
                                            <td><strong>Status</strong></td>
                                            <td>:</td>
                                            <td>{{DB::table('statusinfo')->where('kodstatus', $permohonan->status)->value('status')}}</td>
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
                                                            <span><a href="{{ url('maklumat/profil/diri/'.$pelajar->nokp_pelajar) }}" target="_blank">Maklumat Profil Diri</a></span>
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
                                                            <span><a href="{{ url('maklumat/akademik/'.$pelajar->nokp_pelajar) }}" target="_blank">Maklumat Akademik</a></span>
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
                                                            <span><a href="{{ url('salinan/dokumen/'.$pelajar->nokp_pelajar) }}" target="_blank">Salinan Dokumen</a></span>
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
                                                            <span><a href="{{ url('maklumat/profil/diri/'.$pelajar->nokp_pelajar) }}" target="_blank">Maklumat Profil Diri</a></span>
                                                        </td>  
                                                        <td class="hidden-sm-down">
                                                            @if ($catatan->catatan_profilDiri == null)
                                                                Lengkap
                                                            @else
                                                                Tidak Lengkap
                                                            @endif
                                                        </td>
                                                        <td>
                                                            @php
                                                                $str = $catatan->catatan_profilDiri;
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
                                                            <span><a href="{{ url('maklumat/akademik/'.$pelajar->nokp_pelajar) }}" target="_blank">Maklumat Akademik</a></span>
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
                                                            <span><a href="{{ url('salinan/dokumen/'.$pelajar->nokp_pelajar) }}" target="_blank">Salinan Dokumen</a></span>
                                                        </td>
                                                    <td class="hidden-sm-down">
                                                        @if ($catatan->catatan_salinanDokumen == null)
                                                            Lengkap
                                                        @else
                                                            Tidak Lengkap
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @php
                                                            $str = $catatan->catatan_salinanDokumen;
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
                                   <a href="{{ url('tuntutan/telah/disaring/'.$pelajar->nokp_pelajar) }}"><button class="btn btn-primary theme-bg gradient action-btn" value="Simpan" id="check">Teruskan </a></button>
                                                               
                            </div> 
                        </div>
                    </div>                                       
                </div>
            </div>
        </div>
    </div>
</x-default-layout> 
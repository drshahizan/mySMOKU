<x-default-layout> 
<head>
    <link rel="stylesheet" href="/assets/css/sekretariat.css">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <!-- CSS -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css"/>
    <!-- Default theme -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/default.min.css"/>
    <style>
        
        table, td, tr{
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
</head>
    
<body>
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
			<li class="breadcrumb-item text-dark" style="color:darkblue">Kelulusan</li>
			<!--end::Item-->
            <!--begin::Item-->
			<li class="breadcrumb-item">
				<span class="bullet bg-gray-400 w-5px h-2px"></span>
			</li>
			<!--end::Item-->
			<!--begin::Item-->
			<li class="breadcrumb-item text-dark" style="color:darkblue">Keputusan Permohonan</li>
			<!--end::Item-->
		</ul>
	<!--end::Breadcrumb-->
	</div>
	<!--end::Page title-->

    <br>

    <!-- Main body part  -->
    <div id="main-content">
        <div class="container-fluid">
            <!-- Page header section  -->
            <div class="row clearfix">
                <div class="col-12">
                    <nav class="navbar navbar-expand-sm navbar-light bg-light page_menu">
                        <div class="collapse navbar-collapse" id="navbarNavDropdown">
                            <ul class="navbar-nav mr-auto">
                                <li class="nav-item vivify swoopInTop delay-150 active"><b>Rekod Keputusan Permohonan</b></li>
                            </ul>
                        </div>
                        {{-- <div class="ml-auto" style="color:black;">
                            <a href="{{ url('surat-tawaran') }}" target="_blank" class="btn btn-secondary btn-round btn-sm"><i class="fa fa-download"></i> Surat Tawaran</a>
                        </div> --}}
                    </nav>
                </div>

                <div class="col-lg-12">
                    <div class="card">
                        <div class="body">
                            <div class="row clearfix">
                                <div class="col-md-6 col-sm-6">
                                    <br>
                                    <table class="maklumat">
                                            @php
                                                $nama = DB::table('pelajar')->where('nokp_pelajar', $permohonan['nokp_pelajar'])->value('nama_pelajar');
                                                $status = DB::table('statusinfo')->where('kodstatus',$permohonan['status'])->value('status');
                                            @endphp
                                            <tr>
                                                <td><strong>Nama </strong></td>
                                                <td><b>:</b></td>
                                                <td >{{$nama}}</td>
                                                <td class="space">&nbsp;</td>
                                            </tr>
                                            <tr>
                                                <td><strong>Tarikh Permohonan </strong></td>
                                                <td><b>:</b></td>
                                                <td>{{$permohonan['created_at']->format('d/m/Y')}}</td>
                                            </tr>
                                            <tr>
                                                <td><strong>ID Permohonan </strong></td>
                                                <td><b>:</b></td>
                                                <td>{{$permohonan->id_permohonan}}</td>
                                                <td class="space">&nbsp;</td>
                                            </tr>
                                            <tr>
                                                <td><strong>Status Permohonan </strong></td>
                                                <td><b>:</b></td>
                                                <td>{{$status}}</td>
                                            </tr>
                                    </table>                               
                                </div>
                            </div>
                        
                            {{-- <div class="row clearfix">
                                <div class="col-md-12">
                                    <div class="table-responsive">
                                        @if($permohonan->status==4)
                                            <table class="table table-hover table-bordered mb-5" style="border: 2px important!;">
                                                <thead class="table-primary">
                                                    <tr>
                                                        <th style="width: 3%; text-align:right;">No.</th>                                                        
                                                        <th style="width: 20%;">Item</th>
                                                        <th style="width: 17%;">Keputusan Saringan</th>
                                                        <th style="width: 60%;">Catatan</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td style="text-align:right;">1</td>
                                                        <td>
                                                            <span><a href="{{ url('maklumat-profil-diri/'.$pelajar->nokp_pelajar) }}" target="_blank">Maklumat Profil Diri</a></span>
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
                                                            <span><a href="{{ url('maklumat-akademik/'.$pelajar->nokp_pelajar) }}" target="_blank">Maklumat Akademik</a></span>
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
                                                            <span><a href="{{ url('salinan-dokumen/'.$pelajar->nokp_pelajar) }}" target="_blank">Salinan Dokumen</a></span>
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
                                                            <span><a href="{{ url('maklumat-profil-diri/'.$pelajar->nokp_pelajar) }}" target="_blank">Maklumat Profil Diri</a></span>
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
                                                            <span><a href="{{ url('maklumat-akademik/'.$pelajar->nokp_pelajar) }}" target="_blank">Maklumat Akademik</a></span>
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
                                                            <span><a href="{{ url('salinan-dokumen/'.$pelajar->nokp_pelajar) }}" target="_blank">Salinan Dokumen</a></span>
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
                            </div> --}}

                            <hr><br>

                            <div class="col-md-6 col-sm-6">
                                <form action="{{ url('keputusan/'.$pelajar->nokp_pelajar) }}" method="POST" id="kelulusan">
                                    {{csrf_field()}}
                                    <table>
                                        <tr>
                                            <td><b>No. Mesyuarat</b></td>
                                            <td><b>:</b></td>
                                            <td><input type="text" id="noMesyuarat" name="noMesyuarat" style="padding: 5px; margin-right:50px;" required></td>
                                        </tr>
                                        <tr>
                                            <td><b>Tarikh Mesyuarat</b></td>
                                            <td><b>:</b></td>
                                            <td><input type="date" id="tarikhMesyuarat" name="tarikhMesyuarat" style="padding: 5px;" required></td>
                                        </tr>
                                        <tr>
                                            <td><b>Keputusan</b></td>
                                            <td><b>:</b></td>
                                            <td>
                                                <select id="keputusan" name="keputusan" style="padding: 6px;" onchange="select1()" oninvalid="this.setCustomValidity('Sila pilih keputusan dalam senarai')" oninput="setCustomValidity('')" required required>
                                                    <option value="">Pilih Keputusan</option>
                                                    <option value="Lulus">Lulus</option>
                                                    <option value="Tidak Lulus">Tidak Lulus</option>
                                                </select>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><b>Catatan</b></td>
                                            <td><b>:</b></td>
                                            <td><input type="text" id="catatan" name="catatan" style="padding: 5px; width:500px;"></td>
                                        </tr>
                                    </table>
                                    <br>
                                    <div class="submit" style="text-align: right;">
                                        <button type="submit" id="submit" value="submit" class="btn btn-primary text-white">Hantar</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>                                      
                </div>
            </div>
        </div>
    </div>  

    <!-- Javascript -->
    <script>
        // input validation
        var btn = document.getElementById('submit');
        btn.addEventListener('click', function() {
            if (document.getElementById('noMesyuarat').checked) {
                document.getElementById("noMesyuarat").required = false;
            }
            else{
                document.getElementById("noMesyuarat").required = true;
            }

            if (document.getElementById('tarikh').checked) {
                document.getElementById("tarikh").required = false;
            }
            else{
                document.getElementById("tarikh").required = true;
            }
            if (document.getElementById('keputusan').checked) {
                document.getElementById("keputusan").required = false;
            }
            else{
                document.getElementById("keputusan").required = true;
            }
        })      

        // sweet alert
        $(btn).ready(function() {
            alertify.set('notifier','position', 'top-center');
            alertify.success('Emel notifikasi telah dihantar kepada pemohon');

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name+"csrf-token"]').attr('content')
                }
            });
        });
    </script>

    <script src="assets/bundles/libscripts.bundle.js"></script>    
    <script src="assets/bundles/vendorscripts.bundle.js"></script>
    <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
</body>
</x-default-layout> 
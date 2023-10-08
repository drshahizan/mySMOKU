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
                                                $nama = DB::table('smoku')->where('id', $permohonan['smoku_id'])->value('nama');
                                                $status = DB::table('bk_status')->where('kod_status',$permohonan['status'])->value('status');
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
                                                <td>{{$permohonan->no_rujukan_permohonan}}</td>
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
                        
                            <hr><br>

                            <div class="col-md-6 col-sm-6">
                                <form action="{{ url('permohonan/sekretariat/hantar/keputusan/'.$permohonan->id) }}" method="POST" id="kelulusan">
                                    {{csrf_field()}}
                                    <table>
                                        <tr>
                                            <td><b>No. Mesyuarat</b></td>
                                            <td><b>:</b></td>
                                            <td><input type="text" id="noMesyuarat" name="noMesyuarat" style="padding: 5px; width:40%;" required></td>
                                        </tr>
                                        <tr>
                                            <td><b>Tarikh Mesyuarat</b></td>
                                            <td><b>:</b></td>
                                            <td><input type="date" id="tarikhMesyuarat" name="tarikhMesyuarat" style="padding: 5px; width:40%;" required></td>
                                        </tr>
                                        <tr>
                                            <td><b>Keputusan</b></td>
                                            <td><b>:</b></td>
                                            <td>
                                                <select id="keputusan" name="keputusan" style="padding: 7px; width:40%;" onchange="select1()" oninvalid="this.setCustomValidity('Sila pilih keputusan dalam senarai')" oninput="setCustomValidity('')" required>
                                                    <option value="">Pilih Keputusan</option>
                                                    <option value="Lulus">Lulus</option>
                                                    <option value="Tidak Lulus">Tidak Lulus</option>
                                                </select>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><b>Catatan</b></td>
                                            <td><b>:</b></td>
                                            <td><textarea name="catatan" id="catatan" cols="50" rows="3"></textarea></td>
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